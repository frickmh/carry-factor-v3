module.exports = {
  //This module basically provides a single method 'getPreGameJSON' which uses  URL query data to build output JSON which will typically be passed to 'results.html' to display pre-game (out-of-game) information in a graphical table.  This JSON will be assembled with multiple (~50) queries to the Riot API.
  getPreGameJSON : function(req, resModule) {

    var express = require('express');

    var $ = require("jquery");

    var https = require("https");

    var app = express();

    var fs = require('fs');

    var mysql = require('mysql');

    var updateLastPlayedMatch = require("./updateLastPlayedMatch.js");

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

    //console.log(output);
  
    //Use the result from the Summoner API Query to build account info for each player.
    buildIds = function(data, i, j) {
      //console.log(data);
      //If no data is found, create an empty entry then continue.
      if (data['name'] == undefined) {
        output['players'][i] = {};
        output['players'][i]['name'] = names[i];
        return;
      }

      output['players'][i] = {};      
      output['players'][i]['id'] = data['id'];      
      output['players'][i]['accountId'] = data['accountId'];
      output['players'][i]['name'] = data['name'];
    }

    //Use the result from the Leagues API Query to build League data for each player.
    buildLeagues = function(data, i, j) {
      output.players[i].leagues = {};

      for (league in data) {
        //console.log("League: " + data[league].queueType);
        if (data[league].queueType == "RANKED_SOLO_5x5") {
          output.players[i].leagues.tier = data[league].tier;
          output.players[i].leagues.rank = data[league].rank;
          output.players[i].leagues.leaguePoints = data[league].leaguePoints;
          output.players[i].leagues.wins = data[league].wins;
          output.players[i].leagues.losses = data[league].losses;
          output.players[i].leagues.miniSeries = data[league].miniSeries;
        }
      }
      //console.log(output.players[i].leagues);
    }

    //Build matchlist, and store some simple data (Role count)
    //0 is the most recent match.
    buildMatchlist = function(data, i, j) {
 
      console.log("\nbuildMatchlist:\n");
      //console.log(data);

      output.players[i].matchList = data

      if (output.players[i] == undefined || output.players[i] == {} || data.matches == undefined)
        return;

      if (output.players[i] != undefined) { 
        output.players[i].matches = {};
        output.players[i].positions = {};
        output.players[i].matchCount = 0;
      }
      
 
      
      for (var j = 0; j < 20; j++) {
        var match = data.matches[j];

        if (match == undefined)
          continue;

        //console.log("Match: " + match);        
/*           
        output.players[i].matchCount++;

        var role = "";
        if (match.lane == 'BOTTOM') {
          role = match.role == 'DUO_CARRY' ? 'ADC' : 'Support';
        } else {
          role = match.lane;
          role = role.charAt(0) + role.slice(1).toLowerCase();
        }

        if (output.players[i].positions[role] == undefined) {
          output.players[i].positions[role] = {};
          output.players[i].positions[role].champs = {};
          output.players[i].positions[role].count = 1;
        } else {
          output.players[i].positions[role].count++;
        }

        var championId = data.matches[j].champion;

        //console.log("Champion ID: " + championId);
 
        if (output.players[i].positions[role].champs[championId] == undefined) {
          output.players[i].positions[role].champs[championId] = {};
          output.players[i].positions[role].champs[championId].count = 1;
          output.players[i].positions[role].champs[championId].key = champsJSON.data[championId].key;
          output.players[i].positions[role].champs[championId].name = champsJSON.data[championId].name;
        } else {
          output.players[i].positions[role].champs[championId].count++;
        }
*/
        //Update most recent match, if applicable.
        if (j == 0) {
          console.log("Updating Recent! " + output.region + ", " + match.gameId + ", " + match.timestamp);
          updateLastPlayedMatch.update({region:output.region, match:match.gameId, gameCreation:match.timestamp});
        }

        if (j < 10) {
          output.players[i].matches[j] = {};
          output.players[i].matches[j].gameId = match.gameId;
        }
        //Sort champs here.  Just kidding, we are going to sort them in jQuery where the sort function already exists.

      }
      //console.log(output.players[i].positions);
      //console.log(output.players[i].matches);

    }
/*
    //Record some data in the Output JSON for each match.
    buildMatch = function(data, i, j) {
      console.log("Building Match!"); 
      var summonerId = output.players[i].id;
      var participantId;
      
      //console.log(output.players[i]);
      //console.log(output.players[i].matches[j]);

      data.participantIdentities.forEach( function(participant, index){
        //console.log(participant.player.summonerId);      
        if (summonerId == participant.player.summonerId){
          participantId = participant.participantId;
          //console.log("Found! " + participant.player.summonerId + ", " + participantId);
        }
      });

      //Participant Data!  I'll need to keep this for the current game stats!
      //Participant ID ranges from 1-10, corresponding with indicies 0-9.
      var participant = data.participants[participantId - 1];
      //console.log(participant);      
      if (participant != undefined) {
        try {
          output.players[i].matches[j].championKey = champsJSON.data[participant.championId].key;
          output.players[i].matches[j].championName = champsJSON.data[participant.championId].name;
        } catch(err) {
          output.players[i].matches[j].championKey = 0;
          output.players[i].matches[j].championName = "Unknown";
        }

        output.players[i].matches[j].championId = participant.championId;
        output.players[i].matches[j].win    = participant.stats.win;
        output.players[i].matches[j].kills  = participant.stats.kills;
        output.players[i].matches[j].deaths = participant.stats.deaths;
        output.players[i].matches[j].assists= participant.stats.assists;
        output.players[i].matches[j].cs  = participant.stats.totalMinionsKilled + participant.stats.neutralMinionsKilled;
        output.players[i].matches[j].dateTime = data.gameCreation;
      }
      //output.players[i].matches[j].championId = participant.championId;
      
    }
*/
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

          //console.log(res);

          console.log("getHttp Body: " + body.slice(0,50) + " ...");

          //console.log("Body length: " + body.length);
          data = JSON.parse(body);
          if (funcStep != null){
            funcStep(data, i, j);}
          callbacks_done_count++;

          if (callbacks_done_count == callbacks_to_checkpoint) {
            console.log("Got a round of callbacks!");
            console.log(output);
            callbacks_done_count = 0;
            callbacks_to_checkpoint = 0;

            //Got the ID's!  Time to use the ID's to get player data!
            //callPlayerData();
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
       
      for (var i = 0; i < names.length; i++) {

        if (names[i] == "") { resModule.send({}); break;}

        myUrl = "https://" + region + ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" + encodeURIComponent(names[i]) + "?api_key=" + api_key;

        console.log(myUrl);

        getHttp(myUrl, i, 0, buildIds, callPlayerData);
      }
    }

    //Checkpoint after gathering a round of callbacks!  
    //Direct the control loop to gather the next round of AJAX data!
    function callPlayerData() {
      console.log("Got the first round of callbacks!  Starting Second:");
      var anyPlayersFound = false;
      for (var i = 0; i < names.length; i++) {
        
        var id = output.players[i].id;
        var accountId = output.players[i].accountId;

        if (accountId != undefined) { anyPlayersFound = true; }

        urlLeagues = "https://" + region + ".api.riotgames.com/lol/league/v3/positions/by-summoner/" + id + "?api_key=" + api_key;

        urlMatchlist = "https://" + region + ".api.riotgames.com/lol/match/v3/matchlists/by-account/" + accountId + "?queue=420&endIndex=20&beginIndex=0&api_key=" + api_key;
       
        getHttp(urlLeagues, i, 0, buildLeagues, callMatchData);
        getHttp(urlMatchlist, i, 0, buildMatchlist, callMatchData);
      }
      if (!anyPlayersFound) {
        resModule.send(output);
        console.log("No valid players found.");
      }      
    }

    function callMatchData() {

      var noPlayersWithMatchesFound = true;

      var ids = "(";

      for (var i = 0; i < names.length; i++) {
        var id = output.players[i].id;
        /*
        var accountId = output.players[i].accountId;
        var region = output.region;

        console.log("Player! " + i + ", " + id + ", " + accountId);

        console.log(output.players[i].matches);

        if (output.players[i].matches != undefined) {

          noPlayersWithMatchesFound = false;

          for (var j in output.players[i].matches) {

            console.log(j);


            var match = output.players[i].matches[j].gameId;
            //console.log(match);
            urlMatch = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + match + "?api_key=" + api_key;
            
            //getHttp(urlMatch, i, j, buildMatch, completeData);
          }
        } 
        */
       
        ids += id;

        if (i < names.length - 1) {
          ids += ", ";
        } else {
          ids += ")";
        }


      }

      var sql = "SELECT * FROM `matches` WHERE ";

      for (var i = 0; i < 10; i++) {
        sql += "(summonerId" + i + " IN " + ids + ")";

        if (i < 9) {
          sql += " OR ";
        } else {
          sql += ";";
        }
      }

      var con = mysql.createConnection({
	  host: "localhost",
	  user: "frickmh",
	  password: "rbbsbfh11",
	  database: "carryfactor_" + region
      });

      con.connect(function(err) {
	  if (err) throw err;
	  console.log("Connected!");

	  console.log(sql);

          setTimeout(function(){ console.log(sql);}, 5000);

	  con.query(sql,
	      function(err, result, fields){
		if (err) {
		  console.log(err);


		} else {

		  try {

		    if (result[0] != undefined) {
		      //console.log(result);
		      //console.log(result[0].kills);
		      console.log(result[0]);
                      
                      output.matches = result;   
                      completeData();


		    } else {
		      console.log({});
                      output.matches = [];
                      completeData();
		    }

		  } catch(err) {
		    console.log(err.message);
		  }
		}

	  });

      });
/*
      if (noPlayersWithMatchesFound == false)
      {
        console.log("Undefined!");
        setTimeout(function() { 
          if (!resModule.headersSent) {
            completeData();
          }},5000);
      }
*/        
    }

    //This function is the last step.  After all data is gathered, polish it up, and send the response to the client.
    function completeData() {
      console.log("Got the third round of callbacks!  Ready to send output response to client!");
      //console.log(output.players[0].matches);
      //Attempt to add the patch to the output data!
      fs.readFile('./public/datadragon/patchFull.txt', 'utf8', function (err,data) {
        if (err) {
          output.patch = err;
          resModule.send(output);
        }
        output.patch = data;
        output.patchShort = data.split(".")[0] + "." + data.split(".")[1];
        console.log(data);
        resModule.send(output);
        //setTimeout(function(){ resModule.send(output); }, 3000);
      }); 
    
    }

    //The beginning of the main control loop.
    //Build JSON array of champ names, then begin calling the APIs.
    champsJSON = JSON.parse(fs.readFileSync('./public/data/champsList.json','utf8'));   
 
    callNamesToIds();

    //resModule.send("Hello from module!");
    
  }
}
