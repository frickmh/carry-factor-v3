//Simple module opens a match file and compares it to the matchup number passed as the argument.  The file contents are replaced if the match number is greater.
//Required parameters:  JSON object with 'region' and 'match' properties.
module.exports = {
  update : function(req, res) {

    var fs = require('fs');

    var region = req.region.toLowerCase();
    var matchIn = req.match;

    console.log(region);
    console.log(matchIn);

    var validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"];

    if (region == undefined || !validRegions.includes(region.toLowerCase()) || matchIn == undefined || isNaN(parseInt(matchIn)) || !isFinite(matchIn)) {
      return(console.log("Invalid arguments!  Please check Region and Match format! (example 'updateCurrentMatch.update({region:'na1', match:'12345'});'"));
      
    }

    var matchFile = './cfspider/cfspider/spiders/limits/start_' + region + '.txt';

    fs.readFile(matchFile, 'utf8', function (err,data) {
      if (err) {
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
