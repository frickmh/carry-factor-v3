//Reads the buffer which was written by the spider.
module.exports = {
  init: function() {
    console.log("readBuffer.js initialized.");
  },
  read: function(buffer) {

        console.log("Reading!");

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
	//console.log(sql);

	//basicQuery(sql);

	//console.log(buffer);

        /*
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
        */
        return { sql: sql, bufferLastMatch: bufferLastMatch };
  }


}
