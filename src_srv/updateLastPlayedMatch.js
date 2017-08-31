//Simple module opens a match file and compares it to the matchup number passed as the argument.  The file contents are replaced if the match number is greateri, and the match occured longer than 6 hours ago.
//Required parameters:  JSON object with 'region' and 'match' properties.
module.exports = {
  update : function(req, res) {

    var fs = require('fs');

    var region = req.region.toLowerCase();
    var matchIn = req.match;
    var gameCreation = req.gameCreation;

    console.log(region);
    console.log(matchIn);

    //Validate arguments.
    var validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"];

    if (region == undefined || !validRegions.includes(region.toLowerCase()) || matchIn == undefined || isNaN(parseInt(matchIn)) || !isFinite(matchIn) || gameCreation == undefined || isNaN(parseInt(gameCreation))) {
      return(console.log("Invalid arguments!  Please check Region and Match format! (example 'updateCurrentMatch.update({region:'na1', match:'12345', gameCreation:'15015015015015'});'.  Game Creation is Epoch Milliseconds."));
      
    }

    //Get game age from arguments and Date.now().
    var gameAgeMs = Date.now() - gameCreation;

    console.log("Created " + gameAgeMs + " ms ago.");

    var gameAgeHrs = gameAgeMs / (1000.0 * 60 * 60);

    console.log("Created " + gameAgeHrs + " hrs ago.");

    //Delay in hours for retrieving stats.
    var newestAllowed = 6;

    if (gameAgeHrs < newestAllowed) {
      console.log("Created " + gameAgeHrs + " hrs ago.");
      console.log("Game too recent, skipping... (Minimum game age: " + newestAllowed + " hours)");
      return false;
    }




    //Read the match file.
    var matchFile = __dirname + '/cfspider/cfspider/spiders/limits/end_' + region + '.txt';

    fs.readFile(matchFile, 'utf8', function (err,data) {
      if (err) {
        //console.log(process.argv[1]);
        //console.logg("Error ah!");
        console.log(err);
        //Create file if it doesn't exist.
        if (err.code='ENOENT') {
	  fs.writeFile(matchFile, matchIn, function (err) {
	    console.log('Match File Created > ' + matchFile);
	  });          
        } else {
	  if (err) return console.log(err);
        }
       
        //return console.log(err);
      }
      console.log("No error! Comparing!");
      console.log(matchIn);
      console.log(data);  

      //console.log(process.argv[1]);
      //console.logg("ah!");
      //Update the most recent match if the match number is higher.
      if (parseInt(matchIn) > parseInt(data)) {
        fs.writeFile(matchFile, matchIn, function(err) {
          if (err) {
            return console.log(err);
          }
          console.log("Test match newer than old match!  Updating!");
          return matchIn;
        });
        
      }
      else {
        console.log("Test Match older than old match, continuing...");
        return data;
      }
 
    });    




  }

}
