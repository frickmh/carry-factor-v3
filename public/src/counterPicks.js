//This script MUST be called from results.html, since it accesses objects defined in results.html!
    
    var matchupStats;
    var isTeammateGlobal = true;

    var patchFull;
    
    console.log("Hello from counterPicks.js!");

    if (matchupStats === undefined) {
        matchupStats = [];
    } else {
        matchupStats.push(null);
    }
    
    var matchupWinPct;

    if (matchupWinPct === undefined) {
        matchupWinPct = [];
    } else {
        matchupWinPct.push(null);
    }

    function counterPicks__init__() {

      console.log('counterPicks.js initialized!');
      patchFull = document.getElementById('patchDisplay').innerHTML;
    }
    
    function getRolesFromResultsPage(i, champ) {
        if (isTeammateGlobal) {
            document.getElementsByClassName("counterSelectChamp1 slot" + i)[0].value = champ;            
            getRoles(i, true);            
        } else {
            var resultsPageMatchups = document.getElementsByClassName("counterSelectChamp1 slot" + i)[0];
            for (var i_results = 0; i_results < resultsPageMatchups.length; i_results++){
                console.log("Option Value = " + resultsPageMatchups.options[i_results].getAttribute("name") + ", champ = " + champ );
                if (resultsPageMatchups.options[i_results].getAttribute("name") == champ){
                    resultsPageMatchups.selectedIndex = i_results;
                    getMatchupDetails(i, false);
                }
            }
        }
    }
	
	function resetCounters(i) {
                var select1 = document.getElementsByClassName("counterSelectChamp1 slot" + i)[0];
                var select2 = document.getElementsByClassName("counterSelectChamp2 slot" + i)[0];


                var matchupRole = document.getElementsByClassName("matchupRole slot" + i)[0];
                var champDelta = document.getElementsByClassName("champDelta slot" + i)[0];
                var matchupPct = document.getElementsByClassName("matchupPct slot" + i)[0];
                var champ1 = document.getElementsByClassName("champ1 slot" + i)[0];
                var champ2 = document.getElementsByClassName("champ2 slot" + i)[0];

		select1.innerHTML = tableChampsInner;
		select2.innerHTML = tableChampsInner;
		
		select1.setAttribute( "onChange", 'getRoles(' + i + ', true);' );
		select2.setAttribute( "onChange", 'getRoles(' + i + ', false);' );
		
		
		select1.style.background = "";
		select2.style.background = "";
		matchupRole.style.background = "url(/roleicons/Fill.png) 0% / 100% no-repeat";

		champDelta.innerHTML = "Counter Power";
		matchupPct.innerHTML = "Win %";
		matchupRole.innerHTML = "";
		
		champ1.innerHTML = "Win %";
		champ2.innerHTML = "Win %";
		
		champDelta.setAttribute( "class", 'champDelta' );
		
		isTeammateGlobal = true;		
	}

    function getRoles(i, isTeammate) {
        var select1 = document.getElementsByClassName("counterSelectChamp1 slot" + i)[0]; 
        var select1 = document.getElementsByClassName("counterSelectChamp1 slot" + i)[0];
 
        console.log(i);
        console.log(select1);
        var select2 = document.getElementsByClassName("counterSelectChamp2 slot" + i)[0]; 
        
        isTeammateGlobal = isTeammate;
        
        var champ;
        
        if (isTeammate) {
            champ = select1.value;
            //console.log(document.getElementsByClassName("counterSelectChamp1")[i]);
        } else
        {
            champ = select2.value;
        }
        
        if (champ === "Reset") {
            //alert("Reset WiP");
            //alert(tableChampsInner);
            
			resetCounters(i);
            
        }


        //alert(i + ', ' + id + ", " + champ + ", " + region);

        //var url = '/data/matchups.php?champ=' + champ;
        var url = '../data/championgg/' + champ + '.json';

        console.log(url);

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {

            if (xmlhttp.readyState === 4) {
                
            } else {
                return;
            }
            console.log("Response Text " + champ);
			
			console.log("Response Text " + xmlhttp.responseText);
			
            matchupStats[i] = JSON.parse(xmlhttp.responseText);
            			
            console.log(JSON.parse(xmlhttp.responseText));
            
            var matchupRole= document.getElementsByClassName("matchupRole slot" + i)[0];
            
            console.log("289 matchupStats[i].length = " + matchupStats[i].length);
                       
            //Populate Role dropdown.
            var roleOptions = "";
            var addRole = false;
           
            for (var role = 0; role < matchupStats[i].length; role++) {
                console.log("295 matchupStats[i][role]['matchups'].length = " + matchupStats[i][role]['matchups'].length);
                
				/*
				for (var roleMatchup = 0; roleMatchup < matchupStats[i][role]['matchups'].length; roleMatchup++)
                {
                    //console.log("297 role = " + role + ", games = " + matchupStats[i][role]['matchups'][roleMatchup].games);
                    if (matchupStats[i][role]['matchups'][roleMatchup].games > 100) {
                        //alert(role);
                        addRole = true;
                    }

                }
                //console.log("297 role = " + role + ", games = " + matchupStats[i][role]['matchups'][role].games);
                //alert(JSON.stringify(matchupStats[i][role]['matchups']));
                
                if (addRole) {
                    roleOptions += "<option>" + matchupStats[i][role]['role'] + "</option>";
                }*/
				
				roleOptions += "<option>" + matchupStats[i][role]['role'] + "</option>";
            }
           
            matchupRole.innerHTML = roleOptions;
           
            //alert(JSON.stringify(matchupStats[0]));
            
            console.log("309 Getting Matchups for " + champ);
            
            getMatchups(i);
            
            var matchupChamp;
            var matchupOpponent;
                    
            if (isTeammate) {
                matchupChamp = select1;
                matchupOpponent = select2;
            } else {
                matchupChamp = select2;
                matchupOpponent = select1;
            }
			
			var matchupChampName2 = matchupChamp[matchupChamp.selectedIndex].innerHTML;
			
			//alert("Testing 363");
			
			var champPath = "datadragon/"+ patchFull + "/img/champion/";
			
			if (matchupChampName2 == "FiddleSticks") {
				matchupChampName2 = "Fiddlesticks";
			}
			
			
            //var backgroundImage = "champicons/" + matchupChamp[matchupChamp.selectedIndex].innerHTML.toLowerCase() + "_square_0.png";
			
			var backgroundImage = champPath + matchupChampName2 + '.png';
            
			//alert(backgroundImage);
			
            matchupChamp.style.background = "url(" + backgroundImage + ") 25% / 115% no-repeat #eee";
            
            if (matchupRole[matchupRole.selectedIndex] > -1) {
                backgroundImage = "roleicons/" + matchupRole[matchupRole.selectedIndex].innerHTML + ".png";

                matchupRole.style.background = "url(" + backgroundImage + ") 25% / 115% no-repeat #eee";
            } else {
                //matchupOpponent.style.background = "";
            }
            
            
            
            //$.fn.gotof(i, -1);

        };
        //var params = "id=" + id + "&champ=" + champ + "&region=" + region;

        //url += "?" + params;

        //alert(url);


        //Temporarily Removed while Champion.gg API issue is resolved.
        
        xmlhttp.open("GET", url, false);
        
        //alert("Opened.");

        xmlhttp.send(null);
        

        //alert("xmlHTTP Sent.");

    }
    
    function getMatchups(i) {

            var select1 = document.getElementsByClassName("counterSelectChamp1 slot" + i)[0]; 
            var select2 = document.getElementsByClassName("counterSelectChamp2 slot" + i)[0]; 

            var matchupRole = document.getElementsByClassName("matchupRole slot" + i)[0];

            var isTeammate = isTeammateGlobal;
            console.log("363 matchupStats[i].length = " + matchupStats[i].length);
            for (var role = 0; role < matchupStats[i].length; role++) {
                console.log("366 matchupRole.value = " + matchupRole.value + ", matchupStats[i][role]['role'] = " + matchupStats[i][role]['role']);
                if (matchupRole.value === matchupStats[i][role]['role']) {


                    var matchupString = "";
                    var longestString = 0;
                    
                    var matchupChampName;

                    console.log("370 matchupRole.value: " + matchupRole.value);

                    for (var matchup = 0; matchup < matchupStats[i][role]['matchups'].length; matchup++) {

                        matchupChampName = matchupStats[i][role]['matchups'][matchup].key;
                        
                        if (matchupStats[i][role]['matchups'][matchup].games > 100) {
                            if (matchupChampName.length > longestString) {
                                longestString = matchupChampName.length;
                                
                            }                        
                        }
                    }
                    
                    console.log("Got here! 384");

                    for (var matchup = 0; matchup < matchupStats[i][role]['matchups'].length; matchup++) {
                        
                        matchupChampName = matchupStats[i][role]['matchups'][matchup].key;
                        
                        //var padding = longestString - matchupChampName.toString().length;
                        
                        //alert(matchupChampName.toString() + ": " + padding);
                        
                        //alert(matchupChampName.toString() + ": " + padding + "," + matchupChampName.toString().padRight(longestString,"*"));
                        
                        
                        if (matchupStats[i][role]['matchups'][matchup].games > 100) {
							
							//alert("Testing 457");
							

							var champPath = "datadragon/" + patchFull + "/img/champion/";
							
							
							if (matchupChampName == "FiddleSticks") {
								matchupChampName = "Fiddlesticks";
							}
							
							var champImg = champPath + matchupChampName + '.png';
							
							//alert(champImg);
							
                            //var champImg = 'champicons/' + matchupChampName.toLowerCase() + '_square_0.png';
                            
                            //var newString = "&nbsp&nbsp&nbsp" + matchupChampName.toString().padRight(longestString + 2,"&nbsp");
                            var newString = matchupChampName.toString().padRight(longestString + 2,"&nbsp");
                            
                            //alert(newString.length);
                            
                            var winRate = matchupStats[i][role]['matchups'][matchup].winRate;
                            
                            matchupString += "<option data='" + winRate + "' name='" + matchupChampName + "' style='background-image:url(" + champImg + ");background-size:10%;background-repeat:no-repeat'>" + newString + winRate + "</option>";
                            
                            
                        
                        }
                    }

                    //alert("Got Here! 413");

                    if (isTeammate) {
                        matchupWinPct[i] = select2;
                        select2.setAttribute( "onChange", 'getMatchupDetails(' + i + ', true);' );

                    } else {
                        matchupWinPct[i] = select1;
                        select1.setAttribute( "onChange", 'getMatchupDetails(' + i + ', false);' );
                    }
                    
                    matchupWinPct[i].innerHTML = matchupString;

                    console.log("426 MatchupWinPct: " + matchupWinPct[i].selectedIndex);
                    
                    var backgroundImage;
                    
					
					backgroundImage = "roleicons/" + matchupRole[matchupRole.selectedIndex].innerHTML + ".png";
					matchupRole.style.background = "url(" + backgroundImage + ") 25% / 115% no-repeat #eee";					
					
                    if ( matchupWinPct[i].selectedIndex > -1 ) {
                        backgroundImage = matchupWinPct[i][matchupWinPct[i].selectedIndex].style.backgroundImage;
                        matchupWinPct[i].style.background = backgroundImage + "0% / 115% no-repeat #eee";


                    }
                    

                    console.log("439 MatchupStats.length: " + matchupStats[i].length);

                    var champ1 = matchupStats[i][role]['patchWin'][matchupStats[i][role]['patchWin'].length - 1];
                    

                    var champ1Element = document.getElementsByClassName("champ1 slot" + i)[0];
                    var champ2Element = document.getElementsByClassName("champ2 slot" + i)[0];

                    if (isTeammate) {                    
                        champ1Element.innerHTML = champ1 + "%";
                        champ1Element.setAttribute('data', champ1);
                    } else {
                        champ2Element.innerHTML = champ1 + "%";
                        champ2Element.setAttribute('data', champ1);
                    }
                    
                    //alert(document.getElementsByClassName("champ1")[i].getAttribute('data'));
                    
                    getMatchupDetails(i, isTeammate);
            
                }
            }
            
        console.log("Got Here! 458 matchupStats[i].length: " + matchupStats[i].length);
    
    }
    
    function getMatchupDetails(i, isTeammate) {
		
		//alert(matchupWinPct[i].childNodes.length);
		
		if (matchupWinPct[i].childNodes.length == 0) {
			//alert("No Matchups with 100 games!");
			
			matchupWinPct[i].style.background =  "25% / 115% no-repeat #eee";

			document.getElementsByClassName("matchupPct slot" + i)[0].innerHTML = "N/A";
			
			var champDelta = document.getElementsByClassName("champDelta slot" + i)[0];
            
            champDelta.innerHTML = "0";

			
            if (isTeammate) {
                champ1 = document.getElementsByClassName("champ1 slot" + i)[0].getAttribute('data');
                document.getElementsByClassName("champ2 slot" + i)[0].innerHTML = "Not enough data";

            } else {
                champ2 = document.getElementsByClassName("champ2 slot" + i)[0].getAttribute('data');
                document.getElementsByClassName("champ1 slot" + i)[0].innerHTML = "Not enough data";

            }



			
			
			return;
		}
	
        //Set Background Image
        var backgroundImage = matchupWinPct[i][matchupWinPct[i].selectedIndex].style.backgroundImage;
        matchupWinPct[i].style.background = backgroundImage + "25% / 115% no-repeat #eee";
        
        var champ = matchupWinPct[i][matchupWinPct[i].selectedIndex].getAttribute('name');
        
        var matchupRole = document.getElementsByClassName("matchupRole slot" + i)[0];
        
        var role = matchupRole[matchupRole.selectedIndex].innerHTML;
        
        var url = '/data/championgg/general/' + champ + ".json";

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4) {
            } else {
                return;
            }
        console.log(url);
        console.log(xmlhttp.responsetext);			
/*
var url = "./data/championgg/general/" + champ + ".json";

//Still half PHP.  Just copy paste this, it'll be too hard and not worth it to u
se a separate file.
$response = read_file($url);

$statsJSON = json_decode($response['body'], true);


foreach ($statsJSON as $key => $data) {


    if ($data['role'] == $role) {
        print_r(json_encode($data));
    }
}		
*/

	//alert("Okay!");
			
        var responseJSON = JSON.parse(xmlhttp.responseText);

        var opponentJSON;

        for (var responseRole in responseJSON) {
          if (responseJSON[responseRole].role == role) {
            opponentJSON = responseJSON[responseRole];
            console.log("Found role! " + role);
          }
        }
 
        console.log(opponentJSON);
    
            var matchupOpponent = opponentJSON; 
			
			console.log(matchupOpponent);
			
			
            var champ1;
            var champ2;
                        
            if (isTeammate) {
                champ1 = document.getElementsByClassName("champ1 slot" + i)[0].getAttribute('data');
                champ2 = matchupOpponent.winPercent.val;
                document.getElementsByClassName("champ2 slot" + i)[0].innerHTML = (matchupOpponent.winPercent.val) + "%";

            } else {
                champ2 = document.getElementsByClassName("champ2 slot" + i)[0].getAttribute('data');
                champ1 = matchupOpponent.winPercent.val;
                document.getElementsByClassName("champ1 slot" + i)[0].innerHTML = (matchupOpponent.winPercent.val) + "%";

            }

            //alert("Is Teammate? " + isTeammate);

            //Simple mean of the two champion's overall win rates.
            var champAvg = Math.round(5.0 * ((Number(champ1) + Number(champ2)))) / 10.0;

            //alert("( " + Number(champ1) + " + " + Number(champ2) + " ) /2 = " + winDelta);

            var matchupPct;
            
            if (isTeammate) {
                matchupPct = matchupWinPct[i][matchupWinPct[i].selectedIndex].getAttribute('data');
            } else {
                matchupPct = 100 - matchupWinPct[i][matchupWinPct[i].selectedIndex].getAttribute('data');
            }

            //document.getElementById('champAvg' + i).innerHTML = (isTeammate ? 0 : 100) + (isTeammate ? 1 : -1) * matchupPct;
            
            
            document.getElementsByClassName("matchupPct slot" + i)[0].innerHTML = matchupPct;
            
            //var winDelta = (isTeammate ? 1 : -1) * Math.round(10.0 * (matchupPct - champAvg)) / 10.0;;
            
            var winDelta = Math.round(10.0 * (matchupPct - champAvg)) / 10.0;;

            //alert(matchupPct + " - " + champAvg + " = " + winDelta);

            console.log(i);

            var champDelta = document.getElementsByClassName("champDelta slot" + i)[0];
            
            champDelta.innerHTML = winDelta;
            
            if (winDelta < 0) {
                champDelta.className = 'scorePoor champDelta slot' + i;
            } else if (winDelta > 0) {
                champDelta.className = 'scoreGood champDelta slot' +i;
            }
            
            


        };

        //Temporarily removed while Champion.gg API issue is resolved
        
        xmlhttp.open("GET", url, false);

        xmlhttp.send(null);
        
    
    }
    
    String.prototype.padRight = function(l,c) {return this+Array(l-this.length+1).join(c||" ")};
    

