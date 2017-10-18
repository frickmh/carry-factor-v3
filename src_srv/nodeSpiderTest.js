module.region = "";

module.THREADS = 20;

module.exports = {

  init: function(region, threadCount) {

    if (["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"].includes(region.toLowerCase())) {
      module.region = region.toLowerCase();
    } else {
      console.log("Please enter a valid region. (Example: 'na1')");
    }

    if (threadCount < 0 || threadCount.isNaN) {
      console.log("Please enter a positive number between 1 and 35.");
    } else if (threadCount > 35) {
      console.log("Too many threads, rate limit or CPU limit will be exceeded.  Please enter a number between 1 and 35.");
    } else {
      module.THREADS = threadCount;
    }
  },

  //Node spider testing...
  test: function(req, resModule) {

    if (!["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"].includes(module.region.toLowerCase())) {
      console.log("Please initialize the module with a valid region and thread count. (Example: thisModule.init('na1', 20) )");
      return 0;
    }

    console.log(module.region);

    var fs = require("fs");

    var request = require("request");
 
    var https = require("https");

    var api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3';

    var mysql = require('mysql');

    var startMatch = 2587058003;

    var currentMatch = startMatch;

    var endMatch = startMatch + 100;

    var startTime = Date.now();

    var matchesRecorded = {};

    var matchBuffer = [];

    var readStart;
    var readEnd;
/*
    fs.readFile("./cfspider/cfspider/spiders/limits/start_" + module.region.toLowerCase() + ".txt", {encoding: 'utf-8'}, function(err,data){
	if (!err) {
	    console.log('received data: ' + data);
	    //response.writeHead(200, {'Content-Type': 'text/html'});
	    //response.write(data);
	    //iresponse.end();
            readStart = parseInt(data);
            console.log("readStart: " + readStart);
	} else {
	    console.log(err);
	}
    });
*/
    readStart = parseInt(fs.readFileSync("./cfspider/cfspider/spiders/limits/start_" + module.region.toLowerCase() + ".txt"));

    readEnd = parseInt(fs.readFileSync("./cfspider/cfspider/spiders/limits/end_" + module.region.toLowerCase() + ".txt"));
/*
    fs.readFile("./cfspider/cfspider/spiders/limits/end_" + module.region.toLowerCase() + ".txt", {encoding: 'utf-8'}, function(err,data){
	if (!err) {
	    console.log('received data: ' + data);
            readEnd = parseInt(data);
	    //response.writeHead(200, {'Content-Type': 'text/html'});
	    //response.write(data);
	    //iresponse.end();
	} else {
	    console.log(err);
	}
    });
*/
    console.log("Read Start: " + readStart);
    console.log("Read End: " + readEnd);

    if (readStart != undefined) {
      startMatch = readStart;
      currentMatch = startMatch;
    }

    if (readEnd != undefined) {
      endMatch = readEnd;
    }

    var con = mysql.createConnection({
	host: "localhost",
	user: "frickmh",
	password: "rbbsbfh11",
	database: "carryfactor_" + module.region
    });   


    var basicQuery = function(sqlIn) {
        con.query(sqlIn,
            function(err, result, fields){
              if (err) {
                console.log(err);


              } else {

                try {

                  if (result != undefined) {
                    //console.log(result);
                    //console.log(result[0].kills);
                    console.log("Query result:");
                    console.log(result);


                  } else {
                    console.log("Query completed with no output.");
                  }

                } catch(err) {
                  console.log(err.message);
                }
              }

        });
    }




    con.connect(function(err) {
	if (err) throw err;
	console.log("Connected!");

        var sql = "CREATE TABLE IF NOT EXISTS `matches` (" + 
          "gameId BIGINT UNSIGNED UNIQUE, responseCode SMALLINT UNSIGNED, gameCreation INT UNSIGNED, isPlatinum BIT(1), " + 
          "summonerId0 INT UNSIGNED, champId0 SMALLINT UNSIGNED, kills0 TINYINT UNSIGNED, deaths0 TINYINT UNSIGNED, assists0 TINYINT UNSIGNED, win0 BIT(1)," + 
          "summonerId1 INT UNSIGNED, champId1 SMALLINT UNSIGNED, kills1 TINYINT UNSIGNED, deaths1 TINYINT UNSIGNED, assists1 TINYINT UNSIGNED, win1 BIT(1)," + 
          "summonerId2 INT UNSIGNED, champId2 SMALLINT UNSIGNED, kills2 TINYINT UNSIGNED, deaths2 TINYINT UNSIGNED, assists2 TINYINT UNSIGNED, win2 BIT(1)," + 
          "summonerId3 INT UNSIGNED, champId3 SMALLINT UNSIGNED, kills3 TINYINT UNSIGNED, deaths3 TINYINT UNSIGNED, assists3 TINYINT UNSIGNED, win3 BIT(1)," + 
          "summonerId4 INT UNSIGNED, champId4 SMALLINT UNSIGNED, kills4 TINYINT UNSIGNED, deaths4 TINYINT UNSIGNED, assists4 TINYINT UNSIGNED, win4 BIT(1)," + 
          "summonerId5 INT UNSIGNED, champId5 SMALLINT UNSIGNED, kills5 TINYINT UNSIGNED, deaths5 TINYINT UNSIGNED, assists5 TINYINT UNSIGNED, win5 BIT(1)," + 
          "summonerId6 INT UNSIGNED, champId6 SMALLINT UNSIGNED, kills6 TINYINT UNSIGNED, deaths6 TINYINT UNSIGNED, assists6 TINYINT UNSIGNED, win6 BIT(1)," + 
          "summonerId7 INT UNSIGNED, champId7 SMALLINT UNSIGNED, kills7 TINYINT UNSIGNED, deaths7 TINYINT UNSIGNED, assists7 TINYINT UNSIGNED, win7 BIT(1)," + 
          "summonerId8 INT UNSIGNED, champId8 SMALLINT UNSIGNED, kills8 TINYINT UNSIGNED, deaths8 TINYINT UNSIGNED, assists8 TINYINT UNSIGNED, win8 BIT(1)," + 
          "summonerId9 INT UNSIGNED, champId9 SMALLINT UNSIGNED, kills9 TINYINT UNSIGNED, deaths9 TINYINT UNSIGNED, assists9 TINYINT UNSIGNED, win9 BIT(1)" + 
          ");";

	console.log(sql);

	//setTimeout(function(){ console.log(sql);}, 5000);

        basicQuery(sql);
    });    

    console.log("Starting at: " + startMatch);

    //var myUrl = "https://na1.api.riotgames.com/lol/static-data/v3/items?locale=en_US&api_key=" + api_key;
    var myUrl = "https://" + module.region + ".api.riotgames.com/lol/match/v3/matches/" + startMatch + "?api_key=" + api_key;
    //var myUrl = "https://na1.api.riotgames.com/lol/summoner/v3/summoners/by-name/NovaDisk?api_key=" + api_key;
    var callback = function(url, i) {
      //console.log(url);
      request( {url: url, reqUrl: url, index: i}, function(error, response, body) {
            //console.log(response);
            //console.log(this);
            console.log("Index: " + this.index);
            //console.log("reqUrl: " + this.reqUrl);


            console.log(this.reqUrl);
            console.log(response.statusCode);

            //console.log(JSON.parse(response.body));
            //console.log(response.toJSON);


            matchesRecorded[currentMatch] = response.statusCode;

            var myUrl = "https://" + module.region + ".api.riotgames.com/lol/match/v3/matches/" + currentMatch + "?api_key=" + api_key;


            console.log(myUrl);

            currentMatch += 1;

            var output = {};

            if (currentMatch - 1 < endMatch && response.statusCode != 429) {
              //Do stuff with the data.
              if (response.statusCode < 400) {
                var data = JSON.parse(response.body);
                console.log(data.gameId);

                if (data.queueId == 420) {
                  output.gameId = data.gameId;
                  output.responseCode = response.statusCode;
                  output.gameCreation = Math.round(data.gameCreation / 1000);
                  
                  var platCount = 0;

                  for (var j = 0; j < data.participants.length; j++) {

                    if (["PLATINUM", "DIAMOND", "MASTER", "CHALLENGER"].includes(data.participants.highestAchievedSeasonTier)) {
                      platCount++;
                    }

                    output["summonerId" + j] = data.participantIdentities[j].player.summonerId;
                    output["champId" + j] = data.participants[j].championId;
                    output["kills" + j] = data.participants[j].stats.kills;
                    output["deaths" + j] = data.participants[j].stats.deaths;
                    output["assists" + j] = data.participants[j].stats.assists;
                    output["win" + j] = (data.participants[j].stats.win ? "b'1'" : "b'0'");

                  }

                  output.isPlatinum = platCount > 5 ? "b'1'" : "b'0'";

                }

              }

              //Call the next match.
              setTimeout(function() {
                  callback(myUrl, currentMatch - 1);
                  }, Math.random * 1);
            } else if (response.statusCode == 429 || response.statusCode >= 500) {

              setTimeout(function() {
                  callback(myUrl, currentMatch - 1);
                  }, 10000);
            } else {
              //Finish code!
              THREADS_DONE ++;

              console.log("Thread Done! " + THREADS_DONE);

              if (THREADS_DONE == module.THREADS) {
                //console.log(matchesRecorded);
                console.log("ALL THREADS DONE! Executed " + (endMatch - startMatch) + " in " + ((Date.now() - startTime) / 1000.0) + "s");

                for (var i = startMatch; i <= endMatch; i++) {
                  if (matchesRecorded[i] == undefined) {
                    console.log("WARNING!! Missed " + i + "!");
                  } else {

                  }

                }

                writeBuffer(matchBuffer);

                setTimeout(function() {

                    readEnd = parseInt(fs.readFileSync("./cfspider/cfspider/spiders/limits/end_" + module.region.toLowerCase() + ".txt"));

                    if (readEnd != undefined) {
                      endMatch = readEnd;
                    }

                    var newUrl = "https://" + module.region + ".api.riotgames.com/lol/match/v3/matches/" + startMatch + "?api_key=" + api_key;
                    //callback(newUrl, currentMatch - 1);

                    THREADS_DONE = 0;

                    for (var i = 0; i < module.THREADS; i++) {
                      callback(newUrl, startMatch);
                //      currentMatch += 1;
                    }


                    console.log(newUrl);
                    }
                , 10000);

              }
              
            }

            //Write to buffer HERE.
            if (Object.keys(output).length > 0){
              matchBuffer.push(output);
              if (output.responseCode > 399) 
                console.log(output);

              if (matchBuffer.length > 100) {
                console.log("Writing Buffer! " + matchBuffer.length + " matches");
                writeBuffer(matchBuffer);

                matchBuffer = [];

              }

            }

            });

    }

    var writeBuffer = function(buffer) {

            if (buffer.length == 0) {
              console.log("Buffer is empty!  0 records written!");
              return 0;
            }


            var sqlInsertInto = "INSERT INTO `matches` (gameId, responseCode, gameCreation, " +
              "summonerId0, champId0, kills0, deaths0, assists0, win0, " +
              "summonerId1, champId1, kills1, deaths1, assists1, win1, " +
              "summonerId2, champId2, kills2, deaths2, assists2, win2, " +
              "summonerId3, champId3, kills3, deaths3, assists3, win3, " +
              "summonerId4, champId4, kills4, deaths4, assists4, win4, " +
              "summonerId5, champId5, kills5, deaths5, assists5, win5, " +
              "summonerId6, champId6, kills6, deaths6, assists6, win6, " +
              "summonerId7, champId7, kills7, deaths7, assists7, win7, " +
              "summonerId8, champId8, kills8, deaths8, assists8, win8, " +
              "summonerId9, champId9, kills9, deaths9, assists9, win9, " +
              "isPlatinum) ";
            var sqlValues = "VALUES ";

            var bufferLastMatch = 0;

            for (var j = 0; j < buffer.length; j++) {

               console.log(bufferLastMatch + ", " + buffer[j].gameId);



               if (parseInt(buffer[j].gameId) > bufferLastMatch) {
                 bufferLastMatch = parseInt(buffer[j].gameId);
               }

               console.log(buffer[j].gameId);

               sqlValues = sqlValues.concat("(", buffer[j].gameId, ", ", buffer[j].responseCode, ", ", buffer[j].gameCreation, ", ",
                 buffer[j].summonerId0, ", ", buffer[j].champId0, ", ", buffer[j].kills0, ", ", buffer[j].deaths0, ", ", buffer[j].assists0, ", ", buffer[j].win0, ", ",
                 buffer[j].summonerId1, ", ", buffer[j].champId1, ", ", buffer[j].kills1, ", ", buffer[j].deaths1, ", ", buffer[j].assists1, ", ", buffer[j].win1, ", ",
                 buffer[j].summonerId2, ", ", buffer[j].champId2, ", ", buffer[j].kills2, ", ", buffer[j].deaths2, ", ", buffer[j].assists2, ", ", buffer[j].win2, ", ",
                 buffer[j].summonerId3, ", ", buffer[j].champId3, ", ", buffer[j].kills3, ", ", buffer[j].deaths3, ", ", buffer[j].assists3, ", ", buffer[j].win3, ", ",
                 buffer[j].summonerId4, ", ", buffer[j].champId4, ", ", buffer[j].kills4, ", ", buffer[j].deaths4, ", ", buffer[j].assists4, ", ", buffer[j].win4, ", ",
                 buffer[j].summonerId5, ", ", buffer[j].champId5, ", ", buffer[j].kills5, ", ", buffer[j].deaths5, ", ", buffer[j].assists5, ", ", buffer[j].win5, ", ",
                 buffer[j].summonerId6, ", ", buffer[j].champId6, ", ", buffer[j].kills6, ", ", buffer[j].deaths6, ", ", buffer[j].assists6, ", ", buffer[j].win6, ", ",
                 buffer[j].summonerId7, ", ", buffer[j].champId7, ", ", buffer[j].kills7, ", ", buffer[j].deaths7, ", ", buffer[j].assists7, ", ", buffer[j].win7, ", ",
                 buffer[j].summonerId8, ", ", buffer[j].champId8, ", ", buffer[j].kills8, ", ", buffer[j].deaths8, ", ", buffer[j].assists8, ", ", buffer[j].win8, ", ",
                 buffer[j].summonerId9, ", ", buffer[j].champId9, ", ", buffer[j].kills9, ", ", buffer[j].deaths9, ", ", buffer[j].assists9, ", ", buffer[j].win9, ", ",
                 buffer[j].isPlatinum, ")");
               if (j < buffer.length - 1)
                 sqlValues += ", ";
            }

            var sqlOnDuplicate = " ON DUPLICATE KEY UPDATE responseCode = VALUES(responseCode), gameCreation = VALUES(gameCreation), " +
              "summonerId0 = VALUES(summonerId0), champId0 = VALUES(champId0), kills0 = VALUES(kills0), deaths0 = VALUES(deaths0), assists0 = VALUES(assists0), win0 = VALUES(win0), " +
              "summonerId1 = VALUES(summonerId1), champId1 = VALUES(champId1), kills1 = VALUES(kills1), deaths1 = VALUES(deaths1), assists1 = VALUES(assists1), win1 = VALUES(win1), " +
              "summonerId2 = VALUES(summonerId2), champId2 = VALUES(champId2), kills2 = VALUES(kills2), deaths2 = VALUES(deaths2), assists2 = VALUES(assists2), win2 = VALUES(win2), " +
              "summonerId3 = VALUES(summonerId3), champId3 = VALUES(champId3), kills3 = VALUES(kills3), deaths3 = VALUES(deaths3), assists3 = VALUES(assists3), win3 = VALUES(win3), " +
              "summonerId4 = VALUES(summonerId4), champId4 = VALUES(champId4), kills4 = VALUES(kills4), deaths4 = VALUES(deaths4), assists4 = VALUES(assists4), win4 = VALUES(win4), " +
              "summonerId5 = VALUES(summonerId5), champId5 = VALUES(champId5), kills5 = VALUES(kills5), deaths5 = VALUES(deaths5), assists5 = VALUES(assists5), win5 = VALUES(win5), " +
              "summonerId6 = VALUES(summonerId6), champId6 = VALUES(champId6), kills6 = VALUES(kills6), deaths6 = VALUES(deaths6), assists6 = VALUES(assists6), win6 = VALUES(win6), " +
              "summonerId7 = VALUES(summonerId7), champId7 = VALUES(champId7), kills7 = VALUES(kills7), deaths7 = VALUES(deaths7), assists7 = VALUES(assists7), win7 = VALUES(win7), " +
              "summonerId8 = VALUES(summonerId8), champId8 = VALUES(champId8), kills8 = VALUES(kills8), deaths8 = VALUES(deaths8), assists8 = VALUES(assists8), win8 = VALUES(win8), " +
              "summonerId9 = VALUES(summonerId9), champId9 = VALUES(champId9), kills9 = VALUES(kills9), deaths9 = VALUES(deaths9), assists9 = VALUES(assists9), win9 = VALUES(win9), " +
              "isPlatinum = VALUES(isPlatinum);";

            sql = sqlInsertInto + sqlValues + sqlOnDuplicate;

            //console.log(sql.slice(0, 300));
            console.log(sql);

            basicQuery(sql);

            //console.log(buffer);

            if (bufferLastMatch > 0) {
              fs.writeFile("./cfspider/cfspider/spiders/limits/start_" + module.region.toLowerCase() + ".txt", bufferLastMatch, function(err){
                  if (!err) {
                      console.log('Wrote Start Match: ' + bufferLastMatch);
                      //response.writeHead(200, {'Content-Type': 'text/html'});
                      //response.write(data);
                      //iresponse.end();
                  } else {
                      console.log(err);
                  }
              });

            }

    }


    //var THREADS = 20;

    var THREADS_DONE = 0;

    for (var i = 0; i < module.THREADS; i++) {
      callback(myUrl, startMatch);
//      currentMatch += 1;
    }
    
  }
}
