module.exports = {
  //This module basically provides a single method 'checkGame'.  It is a stripped-down version of 'getCurrentGameJSON'.
  //If called with the correct parameters while a current game is active,
  //a simple json will return.
  //The 'status' property will equal 'Live'.
  //Example URL would be <domain>/checkgame?region=na1&names=NovaDisk
  enter : function(req, resModule) {

    var express = require('express');

    var https = require("https");

    var app = express();

    var fs = require('fs');

    var mysql = require('mysql');

    var buildMatchData = require('./nodeSpiderModules/buildMatchData.js');
    var readBuffer = require('./nodeSpiderModules/readBuffer.js');
    var basicQuery = require('./nodeSpiderModules/basicQuery.js');

    //var api_key = '55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
    var api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3';
    //Process URL parameters to extract names and region to query the Riot API
    //var gameId = req.query.match;
    //var champId = req.query.champ;
    var region = req.query.region;

    var matches = JSON.parse(req.query.matches);
    var matchesData = [];

    console.log(req.query);

    var output = { 'matches' : { } };

    var validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"];
    
    if (region == undefined || !validRegions.includes(region.toLowerCase())) {
      output['error'] = "Error:  Invalid or missing region.";
      resModule.status(400);
      resModule.send(output)
      console.log("Invalid or missing region.");
      return;
    }


    //Number of callbacks received in the current task
    var callbacks_done_count = 0;

    var callbacks_to_checkpoint = 0;

    var httpError;

    //Wrapper to hold an index with each AJAX request
    // to help track player number 
    //Form: URL, Index, Secondary Index (optional), SYNCHRONOUS function, finish function
    getHttpEnterMultiple = function(url, i, j, funcStep, funcDone) {
      callbacks_to_checkpoint++;

      var req = https.get(url, function(res) {
        const { statusCode } = res;
        console.log("Multiple Got Request! Status Code: " + statusCode);

        if (statusCode == 403) {
          output.message = "Error: Forbidden";
          resModule.status(403);
          resModule.send(output);
          return;
        }

        var body = "";
 
        res.on('data', function(chunk) {  

          body += chunk.toString();

        });
 
        res.on('end', function() {
          //console.log("I guess we ended.");
          //console.log(body);
          //console.log(body.slice(0, 300) + (body.length > 300 ? "..." : ""));

          //console.log("Body length: " + body.length);
          data = JSON.parse(body);
          funcStep(data, i, j);
          callbacks_done_count++;

          console.log("getHttp completed " + callbacks_done_count + " of " +  callbacks_to_checkpoint);

          if (callbacks_done_count == callbacks_to_checkpoint) {
            console.log("Got a round of callbacks!");
            console.log(output);
            callbacks_done_count = 0;
            callbacks_to_checkpoint = 0;

            console.log("Funcstep is null? " + (funcStep == null));
            console.log(funcStep);
            console.log("Funcdone is null? " + (funcDone == null));

            //Call the finishing function.
            if (funcDone != null)
              funcDone();
          }


        });
      }).on('error', (e) => {
        console.error(e);
        resModule.status(400);
        httpError = "Error getting response!";
      });;
    }
 
    //Send requests to the Summoner method to get Summoner IDs and Account IDs
    function callMatches() { 

      for (var i = 0; i < matches.length; i++) {
        console.log("Multiple callMatches: " + matches[i]);
        myUrl = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + parseInt(matches[i].gameid) + "?api_key=" + api_key;

        console.log(myUrl);

        getHttpEnterMultiple(myUrl, i, 0, processMatch, recordData);
      }
      
    }

    function processMatch(data, i, j) {

      console.log("Multiple is Processing Match!");

      //console.log(data.participants);      
      for (var k = 0; k < data.participants.length; k++) {
        //console.log(data.participants[k].championId);
        //console.log(champId)

        console.log(data.gameId);

        if (output.matches[data.gameId] == undefined) {
          output.matches[data.gameId] = {};
        }

        var champId = matches[i].champ.id;

        if (data.participants[k].championId == champId) {
          if (output.matches[data.gameId].champIds == undefined) {
            output.matches[data.gameId].champIds = {};
          }

          if (output.matches[data.gameId].champIds[champId] == undefined) {
            output.matches[data.gameId].champIds[champId] = {};
          }

          output.matches[data.gameId].champIds[champId].slot = matches[i].slot;

          output.matches[data.gameId].champIds[champId].kills = data.participants[k].stats.kills;
          output.matches[data.gameId].champIds[champId].deaths = data.participants[k].stats.deaths;
          output.matches[data.gameId].champIds[champId].assists = data.participants[k].stats.assists;
          output.matches[data.gameId].champIds[champId].win = data.participants[k].stats.win ? 1 : 0;
        }
      }

      console.log( output.matches[data.gameId].champIds[champId]);

      var queueId = data.queueId;
      var gameId = data.gameId;

      console.log(queueId);
        
      if (parseInt(queueId) == 420) {
        console.log("Solo Queue!");

        matchesData.push(data);



      }  
    }

    //Write match data to SQL server.
    function recordData() {


      //Skip the rest of the request if there aren't any matches that need to be updated.
      if (matchesData.length == 0) {
        completeData();
        return;
      }

      console.log("Recording Data!");

      var matchesBuffer = [];

      for (match in matchesData) {


        var matchData = buildMatchData.build({statusCode: "200", body: JSON.stringify(matchesData[match])});

        matchesBuffer.push(matchData);

      }

      console.log("Matches Buffer:");

      console.log(matchesBuffer);

      var bufferOutput = readBuffer.read(matchesBuffer);

      console.log(bufferOutput);

			var con = mysql.createConnection({
				host: "localhost",
				user: "frickmh",
				password: "rbbsbfh11",
				database: "carryfactor_" + region
			});   

      completeData();

      basicQuery.query(con, bufferOutput.sql);

    }


    //This function is the last step.  After all data is gathered, polish it up, and send the response to the client.
    function completeData() {
      console.log("Multiple Got the third round of callbacks!  Ready to send output response to client!");
   
      resModule.send(output);
     
      //var process = spawn('python',["./src_srv/enterSingleMatch.py", region, output.gameId]);

    }

 
    callMatches();

    
  }
}
