//Converts the input file 'perks.json', which is a simple array of perks, to 'perksById.json', which is a dictionary indexed by the perk id. 
var fs = require('fs');
var path = require("path");

var perksFile = path.join(__dirname, "./perks.json");

var perksIn = JSON.parse(fs.readFileSync(perksFile));

var perksOut = {};

for (perk in perksIn) {
  perksOut[perksIn[perk].id] = perksIn[perk];


}

perksOutFile = path.join(__dirname, "./perksById.json");

fs.writeFileSync(perksOutFile, JSON.stringify(perksOut));

console.log("perksById.json written!");

