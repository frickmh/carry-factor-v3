module.exports = {
  //Requires a valid region (e.g. 'na1') and a valid number of threads (20 threads is about 2400 matches/min, which is about what I want)
  start: function(region, threads) {
    var Spider = require('node-spider');

    var BuildMatch = require('./nodeSpiderModules/buildMatchData.js');
    var ReadBuffer = require('./nodeSpiderModules/readBuffer.js');
    var BasicQuery = require('./nodeSpiderModules/basicQuery.js');
    var MatchLimits = require('./nodeSpiderModules/matchLimits.js');

    var mysql = require('mysql');
    var fs = require("fs");

    var spider = new Spider({
            // How many requests can be run in parallel
            concurrent: threads,
            // How long to wait after each request
            delay: 0,
            // A stream to where internal logs are sent, optional
            logs: process.stderr,
            // Re-visit visited URLs, false by default
            allowDuplicates: true,
            // If `true` all queued handlers will be try-catch'd, errors go to `error` callback
            catchErrors: true,
            // If `true` the spider will set the Referer header automatically on subsequent requests
            addReferrer: false,
            // If `true` adds the X-Requested-With:XMLHttpRequest header
            xhr: false,
            // If `true` adds the Connection:keep-alive header and forever option on request module
            keepAlive: false,
            // Called when there's an error, throw will be used if none is provided
            error: function(err, url) {
              var pieces = url.split('/');

              var match = parseInt(pieces[pieces.length - 1].split('?')[0]) + 1;

              module.currentMatch ++;

              var myUrl = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + module.currentMatch + "?api_key=" + api_key;
              console.log(myUrl);
 
              console.log(err);

              if (module.currentMatch <= endMatch) {
                spider.queue(myUrl, handleRequest);
              } else {
                console.log("Sleeping, then continuing...");                
                setTimeout(function() {
                    endMatch = MatchLimits.readEnd(region);
                    console.log("End Match: " + endMatch);
                    spider.queue(myUrl, handleRequest);
                }, 5000);
              }
            },
            // Called when there are no more requests
            done: function() {
            },

            //- All options are passed to `request` module, for example:
            headers: { 'user-agent': 'node-spider' },
            encoding: 'utf8'
    });

    var handleRequest = function(doc) {
            // new page crawled
            //console.log(doc.res); // response object
            console.log(doc.url); // page url
            console.log(doc.res.statusCode);
            // uses cheerio, check its docs for more info

            var matchData = BuildMatch.build(doc.res);

            if (matchData.gameId != undefined) {
              buffer.push(matchData);
            }

            console.log("Buffer Length: " + buffer.length);

            if (buffer.length > 10) {
              var bufferData = ReadBuffer.read(buffer);

              console.log(bufferData);

              BasicQuery.query(con, bufferData.sql);

              MatchLimits.writeStart(region, bufferData.bufferLastMatch);

              buffer = [];


            }


            module.currentMatch++;

            var url = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + module.currentMatch + "?api_key=" + api_key;

            if ([403, 429, 502, 503, 504].includes(doc.res.statusCode)) {
              setTimeout(function(){
                spider.queue(url, handleRequest);
              }, 30000);
            } else {
              spider.queue(url, handleRequest);
            }
    };

    module.currentMatch = MatchLimits.readStart(region);
    var endMatch = MatchLimits.readStart(region);

    console.log("Start: " + module.currentMatch + ", End: " + endMatch);

    var api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3';

    var buffer = [];

    var con = mysql.createConnection({
        host: "localhost",
        user: "frickmh",
        password: "rbbsbfh11",
        database: "carryfactor_" + region
    });

    // start crawling
    for (var i = 0; i < threads; i++) {
      spider.queue("https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + module.currentMatch + "?api_key=" + api_key, handleRequest);
    }
  }
}
