/*
  This module will retrieve player stats for a particular champion from the database.
*/
module.exports = {
  getStats : function(req, res) {

    //console.log(req);

    var mysql = require('mysql');

    var summonerId = req.query.summoner;
    var champId = req.query.champ;
    var region = req.query.region;

    console.log(summonerId + ", " + champId + ", " + region);

    var con = mysql.createConnection({
        host: "localhost",
        user: "frickmh",
        password: "rbbsbfh11",
        database: "carryfactor_" + region
    });

    con.connect(function(err) {
        if (err) throw err;
            console.log("Connected!");
            var sql = "SELECT * FROM `matches` WHERE (summonerId0 = " + summonerId + " AND champId0 = " + champId + ") OR (summonerId1 = " + summonerId + " AND champId1 = " + champId + ") OR (summonerId2 = " + summonerId + " AND champId2 = " + champId + ") OR (summonerId3 = " + summonerId + " AND champId3 = " + champId + ") OR (summonerId4 = " + summonerId + " AND champId4 = " + champId + ") OR (summonerId5 = " + summonerId + " AND champId5 = " + champId + ") OR (summonerId6 = " + summonerId + " AND champId6 = " + champId + ") OR (summonerId7 = " + summonerId + " AND champId7 = " + champId + ") OR (summonerId8 = " + summonerId + " AND champId8 = " + champId + ") OR (summonerId9 = " + summonerId + " AND champId9 = " + champId + ")";

            //console.log(sql);
            //con.query("SELECT * FROM `" + champId + "` WHERE summonerId = " + summonerId, 
            //con.query("SELECT * FROM `matches` WHERE summonerId0 = " + summonerId + " OR summonerId1 = " + summonerId + " OR summonerId2 = " + summonerId + " OR summonerId3 = " + summonerId + " OR summonerId4 = " + summonerId + " OR summonerId5 = " + summonerId + " OR summonerId6 = " + summonerId + " OR summonerId7 = " + summonerId + " OR summonerId8 = " + summonerId + " OR summonerId9 = " + summonerId, 
            con.query(sql, 
                function(err, result, fields){
                  if (err) {
                    res.send(err);

                  } else {

                    try {

                      if (result[0] != undefined) {
                        //console.log(result);
                        //console.log(result[0].kills);
                        res.send(result);
                      } else {
                        res.send({});
                      }

                    } catch(err) {
                      res.send(err.message);
                    }
                  }

                });

        });


  }
}
