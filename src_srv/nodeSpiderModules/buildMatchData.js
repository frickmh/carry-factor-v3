module.exports = {
  init: function() {

  },
  build: function(response) {

    console.log("Building!");

    var data = JSON.parse(response.body);

    output = {};

    console.log("Game ID: " + data.gameId + ", Queue ID:" + data.queueId);

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

    console.log(output);

    return output;
  }
        
        
}
