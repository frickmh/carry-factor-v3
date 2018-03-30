var https = require("https");

var $ = require("jquery");

console.log("Started!");

    //Number of callbacks received in the current task
    var callbacks_done_count = 0;

    var callbacks_to_checkpoint = 0;

    var httpError;

    var myUrl = "https://translate.google.com/#en/de/hello";




    function processLanguage(data, i, j) {
      console.log("Processing!");



      console.log($(data));


    }

    function finalizeTranslate() {
      console.log("Finalizing!");
    }

    //Wrapper to hold an index with each AJAX request
    // to help track player number
    //Form: URL, Index, Secondary Index (optional), SYNCHRONOUS function, finish function
    getHttp = function(url, i, j, funcStep, funcDone) {
      callbacks_to_checkpoint++;

      var req = https.get(url, function(res) {
        const { statusCode } = res;
        console.log("Got Request! Status Code: " + statusCode);

        if (statusCode == 403) {
          output.message = "Error: Forbidden";
          resModule.status(403);
          resModule.send(output);
          return;
        }

        var body = "";

        res.on('data', function(chunk) {

          body += chunk.toString();

        });

        res.on('end', function() {
          //console.log("I guess we ended.");
          //console.log(body);
          //console.log(body.slice(0, 300) + (body.length > 300 ? "..." : ""));

          //console.log("Body length: " + body.length);
          //data = JSON.parse(body);
          funcStep(body, i, j);
          callbacks_done_count++;

          if (callbacks_done_count == callbacks_to_checkpoint) {
            console.log("Got a round of callbacks!");
            callbacks_done_count = 0;
            callbacks_to_checkpoint = 0;

            //Got the ID's!  Time to use the ID's to get player data!
            //callPlayerData();
            if (funcDone != null)
              funcDone();
          }


        });
      }).on('error', (e) => {
        console.error(e);
        resModule.status(400);
        httpError = "Error getting response!";
      });;
    }


    getHttp(myUrl, 0, 0, processLanguage, finalizeTranslate);
