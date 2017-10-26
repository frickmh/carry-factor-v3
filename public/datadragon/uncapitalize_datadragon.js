var fs = require('fs');
var path = require('path');
var mv = require('mv');

var walk = function(dir, done) {
  var results = [];
  fs.readdir(dir, function(err, list) {
    if (err) return done(err);
    var i = 0;
    (function next() {
      var file = list[i++];
      if (!file) return done(null, results);
      file = dir + '/' + file;
      fs.stat(file, function(err, stat) {
        if (stat && stat.isDirectory()) {
          file_lc = file.toLowerCase();
          fs.renameSync(file, file_lc);
          walk(file_lc, function(err, res) {
            results = results.concat(res);
            next();
          });
        } else {
          file_lc = file.toLowerCase();
          fs.renameSync(file, file_lc);
          results.push(file_lc);
          next();
        }
      });
    })();
  });
};


console.log(__dirname);
var patch = fs.readFileSync(__dirname + "/patchFull.txt",'utf8');

walk(__dirname + "/" + patch, function(err, results) {
  if (err) throw err;
  console.log(results);
});
