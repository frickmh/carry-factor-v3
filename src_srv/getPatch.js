/*
  This module provides methods that simply read files that store the DataDragon patch number.  The response is simply a string containing the patch number.
*/
module.exports = {
  getPatchShort : function(req, res) {

    fs = require('fs')
    fs.readFile('./public/datadragon/patchShort.txt', 'utf8', function (err,data) {
    if (err) {
      return console.log(err);
    }
      console.log(data);
      if (res != undefined && req != undefined)
        res.send(data);
      else
        return data;
    });
  },

  getPatchFull : function(req, res) {

    fs = require('fs')
    fs.readFile('./public/datadragon/patchFull.txt', 'utf8', function (err,data) {
    if (err) {
      return console.log(err);
    }
      console.log(data);
      if (res != undefined && req != undefined)
        res.send(data);
      else
        return data;
    });
  }

}
