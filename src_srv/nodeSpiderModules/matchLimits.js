var path = require("path");
var fs = require("fs");


module.exports = { 
  init: function() {
    console.log("readStartMatch.js initialized.");
  },
  readStart: function(region) {
    console.log("Getting Start Match!");
    var startFile = path.join(__dirname, "../cfspider/cfspider/spiders/limits/start_" + region + ".txt");

    readStart = parseInt(fs.readFileSync(startFile));

    return readStart != undefined ? readStart : 2587058003;

  },
  readEnd: function(region) {
    console.log("Getting End Match!");
    var endFile = path.join(__dirname, "../cfspider/cfspider/spiders/limits/end_" + region + ".txt");

    readEnd = parseInt(fs.readFileSync(endFile));

    return readEnd != undefined ? readEnd : 2587058003;

  },
  writeStart: function(region, match) {
    var myFile = path.join(__dirname, "../cfspider/cfspider/spiders/limits/start_" + region + ".txt");
    fs.writeFile(myFile, match, function(err){
	if (!err) {
	    console.log('Wrote Start Match: ' + match);
	} else {
	    console.log(err);
	}
    });

  }

}

