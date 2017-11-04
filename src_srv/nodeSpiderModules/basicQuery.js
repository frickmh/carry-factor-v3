//Use an existing mysql connection to execute a query.
module.exports = {
  init: function() {
    console.log("basicQuery.js initialized.");
  },
  query: function(con, sqlIn) {
      console.log("Starting Query!");
      con.query(sqlIn,
	  function(err, result, fields){
	    if (err) {
	      console.log(err);


	    } else {

	      try {

		if (result != undefined) {
		  //console.log(result);
		  //console.log(result[0].kills);
		  console.log("Query result:");

      if (result.length > 200)
   		  console.log(result.slice(0,200) + " ...");
      else
        console.log(result);


		} else {
		  console.log("Query completed with no output.");
		}

	      } catch(err) {
		console.log(err.message);
	      }
	    }

      });

  }


}
