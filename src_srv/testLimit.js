module.exports = {
  //This module basically provides a single method 'checkGame'.  It is a stripped-down version of 'getCurrentGameJSON'.
  //If called with the correct parameters while a current game is active,
  //a simple json will return.
  //The 'status' property will equal 'Live'.
  //Example URL would be <domain>/checkgame?region=na1&names=NovaDisk
  checkGame : function(req, resModule) {

    var express = require('express');

    var $ = require("jquery");

    var https = require("https");

    var app = express();

    var fs = require('fs');

    //var api_key = '55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
    var api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3';
    //Process URL parameters to extract names and region to query the Riot API
    var namesRaw = req.query.names;
    var region = req.query.region;

    var output = { 'region' : region, 'players' : {} };

    var validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"];
    
    if (region == undefined || !validRegions.includes(region.toLowerCase())) {
      output['error'] = "Error:  Invalid or missing region.";
      resModule.status(400);
      resModule.send(output)
      console.log("Invalid or missing region.");
      return;
    }

    if (namesRaw == undefined || namesRaw.length == 0) {
      resModule.send(output);
      console.log("Empty Request.");
      return;
    }

    if (namesRaw[namesRaw.length - 1] == ',') 
      namesRaw = namesRaw.substring(0,namesRaw.length - 1);

    //console.log(namesRaw);

    var names = namesRaw != undefined ? namesRaw.split(',') : [];


    //Number of callbacks received in the current task
    var callbacks_done_count = 0;

    var callbacks_to_checkpoint = 0;

    var httpError;

    console.log("Names: " + names);

 
    //Wrapper to hold an index with each AJAX request
    // to help track player number 
    //Form: URL, Index, Secondary Index (optional), SYNCHRONOUS function, finish function
    getHttp = function(url, i, j, funcStep, funcDone) {
      callbacks_to_checkpoint++;

      var req = https.get(url, function(res) {
        const { statusCode } = res;
        console.log("Got Request! Status Code: " + statusCode);

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

          if (callbacks_done_count == callbacks_to_checkpoint) {
            console.log("Got a round of callbacks!");
            console.log(output);
            callbacks_done_count = 0;
            callbacks_to_checkpoint = 0;

            //Got the ID's!  Time to use the ID's to get player data!
            //callPlayerData();
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
    function callNamesToIds() { 

      if (names[0] == "") { res.send({});}

      myUrl = "https://" + region + ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" + encodeURIComponent(names[0]) + "?api_key=" + api_key;

      console.log(myUrl);

      getHttp(myUrl, 0, 0, checkForCurrentMatch, null);
      
    }

    function checkForCurrentMatch(data, i, j) {

      //This should be the summoner info.
      console.log(data);

      var myUrl = "https://" + region + ".api.riotgames.com/lol/spectator/v3/active-games/by-summoner/" + data.id + "?api_key=" + api_key;

      output.players["0"] = { "name" : data.name, "id" : data.id};


      console.log(myUrl);


      getHttp(myUrl, 0, 0, checkIfLiveGame, null);
      //getHttp(myUrl, 0, 0, processCurrentMatch, null);
    }


    function checkIfLiveGame(data, i, j) {

      console.log(data);

      if (data.gameId != undefined) {
        output.status = "Live";i
      } else {
        console.log("No live match found.");
      }


      console.log("Completing!");
      completeData();
    }

    //This function is the last step.  After all data is gathered, polish it up, and send the response to the client.
    function completeData() {
      console.log("Got the third round of callbacks!  Ready to send output response to client!");
   
      resModule.send(output);
    }

 
    callNamesToIds();

    
  }
}
