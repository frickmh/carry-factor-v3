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

    var spawn = require("child_process").spawn;

    //var api_key = '55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
    var api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3';
    //Process URL parameters to extract names and region to query the Riot API
    var gameId = req.query.match;
    var champId = req.query.champ;
    var region = req.query.region;

    console.log(req.query);

    var output = { 'gameId' : gameId, 'match' : { } };

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
    function callMatch() { 

      myUrl = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + parseInt(gameId) + "?api_key=" + api_key;

      console.log(myUrl);

      getHttp(myUrl, 0, 0, processMatch, completeData);
      
    }

    function processMatch(data, i, j) {
      //console.log(data.participants);      
      for (var k = 0; k < data.participants.length; k++) {
        //console.log(data.participants[k].championId);
        //console.log(champId)

        if (data.participants[k].championId == champId) {
          output.match.kills = data.participants[k].stats.kills;
          output.match.deaths = data.participants[k].stats.deaths;
          output.match.assists = data.participants[k].stats.assists;
          output.match.win = data.participants[k].stats.win ? 1 : 0;
        }
      }

      var queueId = data.queueId;
      var gameId = data.gameId;

      console.log(queueId);
        
      if (parseInt(queueId) == 420) {
        console.log("Solo Queue!");
        var gameCreation = parseInt(data.gameCreation / 1000);

        var sqlInsertInto = "INSERT INTO `matches` (gameId, responseCode, gameCreation ";
        var sqlValues = "VALUES (" + gameId + ", " + 200 + ", " + gameCreation;
        var sqlOnDuplicate = "ON DUPLICATE KEY UPDATE responseCode = " + 200 + ", gameCreation = " + gameCreation;

	for (participantIdentity in data.participantIdentities) {
	  var participantId = data.participantIdentities[participantIdentity].participantId;
	  var summonerId = data.participantIdentities[participantIdentity].player.summonerId;
	  var summonerName = data.participantIdentities[participantIdentity].player.summonerName;

	  for (participant in data.participants) {
	    if (data.participants[participant].participantId == participantId) {
	      var stats = data.participants[participant]['stats'];
	      var championId = data.participants[participant]['championId'];
	      var win = stats['win'];
	      var kills = stats['kills'];
	      var deaths = stats['deaths'];
	      var assists = stats['assists'];
	      var cs = parseInt(stats['totalMinionsKilled']) + parseInt(stats['neutralMinionsKilled']);

	      var pid = participantId - 1;

	      sqlInsertInto += ", summonerId" + pid + ", champId" + pid + ", kills" + pid + ", deaths" + pid + ", assists" + pid + ", win" + pid;

	      sqlValues += ", " + summonerId + ", " + championId + ", " + kills + ", " + deaths  + ", " + assists + ", " + (win == true ? "b'1'" : "b'0'");

	      sqlOnDuplicate += ", summonerId" + pid + " = " + summonerId + ", champId" + pid + " = " + championId + ", kills" + pid + " = " + kills + ", deaths" + pid + " = " + deaths + ", assists" + pid + " = " + assists + ", win" + pid + " = " + (win == true ? "b'1'" : "b'0'");
            }
	  }
	
	}
     
	//Check if the average rank is Platinum.
        var platCount = 0;

	for (var j = 0; j < 10; j++) {
	    var tier = data.participants[j].highestAchievedSeasonTier;
	    if (tier == "PLATINUM" || tier == "DIAMOND" || tier == "MASTER" || tier == "CHALLENGER")
		platCount += 1;
        }

	var elo = "";

	if (platCount > 5) {
	    //Do stuff here if the average rank is Platinum.
	    elo = "Plat";
	    sqlInsertInto += ", isPlatinum";
	    sqlValues += ", 1";
	    sqlOnDuplicate += ", isPlatinum = 1";
	} else {
	    sqlInsertInto += ", isPlatinum";
	    sqlValues += ", 0";
	    sqlOnDuplicate += ", isPlatinum = 0";
        }

        //More Plat Stuff (Possibly replace Champion.gg in the future)


	sqlInsertInto += ") ";
	sqlValues += ") ";
	sqlOnDuplicate += ";";

	var sql = sqlInsertInto + sqlValues + sqlOnDuplicate;
 
        console.log(sql); 

        var mysql = require('mysql');

	var con = mysql.createConnection({
	    host: "localhost",
	    user: "frickmh",
	    password: "rbbsbfh11",
	    database: "carryfactor_" + region
	});

    con.connect(function(err) {
      if (err) throw err;
      console.log("Connected!");

      con.query(sql,
	function(err, result, fields){
	  if (err) {
	    res.send(err);

	  } else {

	    try {

	      if (result[0] != undefined) {
		console.log(result);
		//console.log(result[0].kills);
		//res.send(result);
	      } else {
                console.log("result[0] is undefined.");
		//res.send({});
	      }

	    } catch(err) {
	      //res.send(err.message);
	      console.log(err.message);
	    }
	  }

	});

    });


      }  
    }

    //This function is the last step.  After all data is gathered, polish it up, and send the response to the client.
    function completeData() {
      console.log("Got the third round of callbacks!  Ready to send output response to client!");
   
      resModule.send(output);
     
      //var process = spawn('python',["./src_srv/enterSingleMatch.py", region, output.gameId]);

    }

 
    callMatch();

    
  }
}
