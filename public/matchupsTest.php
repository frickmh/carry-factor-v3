<html>

    <head>
        <meta charset="UTF-8">        
    </head>
    <style>
        select.monospace {
            font-family:"Courier New", Courier, monospace;
            margin: 1px;
            border: 1px solid #111;
            background: transparent;
            width: 34px;
            padding: 5px 35px 5px 5px;
            font-size: 24px;
            border: 1px solid #ccc;
            border-radius: 50px;
            height: 42px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: 5% / 15% no-repeat #eee;        
            cursor: pointer;
            
        }
        
        select.role {
            font-family:"Courier New", Courier, monospace;
            margin: 1px;
            border: 1px solid #111;
            background: transparent;
            width: 25px;
            padding: 5px 15px 5px 5px;
            font-size: 24px;
            border: 1px solid #ccc;
            border-radius: 50px;
            height: 25px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: 5% / 15% no-repeat #eee;        
            cursor: pointer;
            background: url(roleicons/Fill.png) 0% / 100% no-repeat;
            vertical-align: middle;
            
        }
        
        
    </style>
    
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	//Base PHP for Matchups in results.php
	//Calls matchups.php and matchupsOpponent.php

    
    $getData = filter_input_array(INPUT_GET);

    $k = $getData['k'];
	
	$patchFull = $getData['patchFull'];
	
    //$urlChamps = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
	$urlChamps = "./data/champsListByName.json";
	
    $responseChamps = read_file($urlChamps);
    $responseJSONChamps = json_decode($responseChamps['body'], true);
	
    ksort($responseJSONChamps['data']);

	//echo "<pre><div style='text-align: left'><br>Champs List:<br>"; print_r($responseJSONChamps); echo "</div></pre>";
	
    $tableChamps .= "<div style='font-size:115%; margin-top:-.35vw;text-align:center'>Counterpicks<span class='tooltip' title=\"Winrates for Plat+.\n  - Counter power is the % difference between the average of the two champion win percents, and the matchup win %.\n  - Positive (Blue) values indicate the Left Champion (Your teammate) is stronger.\n  - Negative (Red) values indicate the Right Champion (Your opponent) is stronger.\">?</span></div><table><tr><td><select id='champMatchups$k' onChange='getRoles($k, true);' class='monospace'><br>";

    $tableChampsInner = "";
    
    $tableChampsInner .= "<option id='None' value='None'></option>";

    $tableChampsInner .= "<option id='Reset' value='Reset'>(Reset)</option>";

    foreach ($responseJSONChamps['data'] as $key => $data)
    {
		//echo "<pre><div style='text-align: left'><br>Champs List:<br>"; print_r($data); echo "</div></pre>";

        $champID = $data['key'];

        $tableChampsInner .= "<option id='$champID' value='$champID'>$champID</option>";
    }
    
    echo "<script>var tableChampsInner = \"$tableChampsInner\"</script>";
    
    $tableChamps .= $tableChampsInner;
    

    $tableChamps .= "</select>"
			//. "<table><tr><td><button>Reset</button></td></tr><tr><td><select id='matchupRole$k' onChange='getMatchups($k)' class='role'></select>vs.</td></tr></table>" //New
			. "</td><td><table style='margin:-8px'><tr><td><button onclick='resetCounters($k)'><div style='margin:-3px -9px'>Reset<div></button></td></tr><tr><td><select id='matchupRole$k' onChange='getMatchups($k)' class='role'></select>vs.</td></tr></table></td><td>" //New, wrapped Line 3 in Table
			//. "<select id='matchupRole$k' onChange='getMatchups($k)' class='role'></select>vs." //Original
			. "<select id='matchupWinPct$k' class='monospace' onChange='getRoles($k, false);'>" . $tableChampsInner . "</select></td><td id='matchupPct$k'>Win %</td><td>(<span id='champDelta$k'>Counter Power</span>)</td></tr>" //Original (Both)
            //. "<tr><td><span id='champ1_$k'>Win %</span><span id='champ2_$k' style='float:right'>Win %</span></td></tr></table>"; //Original
			. "<tr><td><span id='champ1_$k'>Win %</span></td><td></td><td><span id='champ2_$k' style='float:right'>Win %</span></td></tr></table>"; //New

    echo $tableChamps;    


    function get_web_page($url) {
        //header('Content-Type: text/html; charset=UTF-8');

        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            //CURLOPT_VERBOSE => true,
            CURLOPT_HEADER         => true,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "UTF-8",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',

        ); 

        $attempts_left = 3;
        $try = true;

        while ($try && $attempts_left > 0)
        {              
            //$url = utf8_encode($url);
            //$url = iconv("UTF-8","Windows-1252//IGNORE",$url);  
            //$url = @iconv("UTF-8","Windows-1252//IGNORE",$url);  

            //$url = iconv("UTF-8","Windows-1252//IGNORE",$url);  

            //ISO-8859-1
            //$url = iconv("UTF-8","ANSI", $url);

            $ch = curl_init($url);
            curl_setopt_array($ch, $options);

            $content  = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $body = substr($content, $header_size);

            $retry_after = 10;

            if ($code == 429)
            {
                $header = substr($content, 0, $header_size);

                //echo "<br><br><br>*************************************************ERROR!!!!! GOT CODE 429 HERE!!!!********************************************<br><br><br>";
                //echo "<br><br><br>*** Warning: Server is busy.  If your results do not show completely, please try again in 10 seconds.  ***<br><br><br>";               

                $header_lines = explode("\n", $header);

                $lines_count = count($header_lines);

                $find = "Retry-After: ";         

                //var_dump($find);

                for ($z = 0; $z < $lines_count; $z++)
                {
                    $position = strpos($header_lines[$z], $find);


                    //Check if header line contains 'Retry-After: '
                    if ( $position !== false && $position !== NULL && $position != -1)
                    {
                        //Set Retry
                        $retry_after = (int)substr($header_lines[$z], $position + strlen($find));

                        sleep($retry_after);

                    }


                }

            } else {$try = false;}

            $attempts_left--;
        }


        $output_array = [
            "response_code" => $code,
            "body" => $body,
            "retry" => $retry_after
        ];
        curl_close($ch);

        return $output_array;        
    }
	
	
	function read_file($file) {
		$output = array();
		
		$output['body'] = file_get_contents($file);
		
		return $output;
	}

?>

<script>
    
    /*
    for (var index = 0; index < 5; index++) {

    alert("Testing: " + index);

    var test;
        
    if (test === undefined) {
        test = [];
        alert(test);
    } else {
        test.push(5);
        alert(test);
    }
    
    }*/
    
    var matchupStats;
    var isTeammateGlobal = true;
	
	var patchFull = "<?php 
		$files = scandir("./datadragon");
					
					foreach ($files as $file) {
						if (is_numeric($file[0])) {
							$patchFull = $file;
						}				
					}		
	echo $patchFull ?>";
	
    
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
    
    function getRolesFromResultsPage(i, champ) {
        if (isTeammateGlobal) {
            document.getElementById("champMatchups" + i).value = champ;            
            getRoles(i, true);            
        } else {
            var resultsPageMatchups = document.getElementById("champMatchups" + i);
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
		document.getElementById("champMatchups" + i).innerHTML = tableChampsInner;
		document.getElementById("matchupWinPct" + i).innerHTML = tableChampsInner;
		
		document.getElementById("champMatchups" + i).setAttribute( "onChange", 'getRoles(' + i + ', true);' );
		document.getElementById("matchupWinPct" + i).setAttribute( "onChange", 'getRoles(' + i + ', false);' );
		
		
		document.getElementById("champMatchups" + i).style.background = "";
		document.getElementById("matchupWinPct" + i).style.background = "";
		document.getElementById("matchupRole" + i).style.background = "url(roleicons/Fill.png) 0% / 100% no-repeat";

		document.getElementById("champDelta" + i).innerHTML = "Counter Power";
		document.getElementById("matchupPct" + i).innerHTML = "Win %";
		document.getElementById("matchupRole" + i).innerHTML = "";
		
		document.getElementById("champ1_" + i).innerHTML = "Win %";
		document.getElementById("champ2_" + i).innerHTML = "Win %";
		
		document.getElementById("champDelta" + i).setAttribute( "class", '' );
		
		isTeammateGlobal = true;		
	}

    function getRoles(i, isTeammate) {
        
        
        isTeammateGlobal = isTeammate;
        
        var champ;
        
        if (isTeammate) {
            champ = document.getElementById("champMatchups" + i).value;
        } else
        {
            champ = document.getElementById("matchupWinPct" + i).value;
        }
        
        if (champ === "Reset") {
            //alert("Reset WiP");
            //alert(tableChampsInner);
            
			resetCounters(i);
            
        }


        //alert(i + ', ' + id + ", " + champ + ", " + region);

        //var url = '/data/matchups.php?champ=' + champ;
        var url = '/data/championgg/' + champ + '.json';

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
            
            var matchupRole= document.getElementById('matchupRole' + i);
            
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
                matchupChamp = document.getElementById('champMatchups' + i);
                matchupOpponent = document.getElementById('matchupWinPct' + i);
            } else {
                matchupChamp = document.getElementById('matchupWinPct' + i);
                matchupOpponent = document.getElementById('champMatchups' + i);
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
            var isTeammate = isTeammateGlobal;
            console.log("363 matchupStats[i].length = " + matchupStats[i].length);
            for (var role = 0; role < matchupStats[i].length; role++) {
                var matchupRole = document.getElementById('matchupRole' + i);
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
                        matchupWinPct[i] = document.getElementById('matchupWinPct' + i);
                        document.getElementById("matchupWinPct" + i).setAttribute( "onChange", 'getMatchupDetails(' + i + ', true);' );

                    } else {
                        matchupWinPct[i] = document.getElementById('champMatchups' + i);
                        document.getElementById("champMatchups" + i).setAttribute( "onChange", 'getMatchupDetails(' + i + ', false);' );
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
                    
                    if (isTeammate) {                    
                        document.getElementById("champ1_" + i).innerHTML = champ1 + "%";
                        document.getElementById("champ1_" + i).setAttribute('data', champ1);
                    } else {
                        document.getElementById("champ2_" + i).innerHTML = champ1 + "%";
                        document.getElementById("champ2_" + i).setAttribute('data', champ1);
                    }
                    
                    //alert(document.getElementById("champ1_" + i).getAttribute('data'));
                    
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

			document.getElementById('matchupPct' + i).innerHTML = "N/A";
			
			var champDelta = document.getElementById('champDelta' + i);
            
            champDelta.innerHTML = "0";

			
            if (isTeammate) {
                champ1 = document.getElementById("champ1_" + i).getAttribute('data');
                document.getElementById('champ2_' + i).innerHTML = "Not enough data";

            } else {
                champ2 = document.getElementById("champ2_" + i).getAttribute('data');
                document.getElementById('champ1_' + i).innerHTML = "Not enough data";

            }



			
			
			return;
		}
	
        //Set Background Image
        var backgroundImage = matchupWinPct[i][matchupWinPct[i].selectedIndex].style.backgroundImage;
        matchupWinPct[i].style.background = backgroundImage + "25% / 115% no-repeat #eee";
        
        var champ = matchupWinPct[i][matchupWinPct[i].selectedIndex].getAttribute('name');
        
        var matchupRole = document.getElementById('matchupRole' + i);
        
        var role = matchupRole[matchupRole.selectedIndex].innerHTML;
        
        var url = '/matchupsOpponent.php?champ=' + champ + "&role=" + role;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4) {
            } else {
                return;
            }
			
			//alert("Okay!");
			
            
            var matchupOpponent = JSON.parse(xmlhttp.responseText);
			
			console.log(matchupOpponent);
			
			
            var champ1;
            var champ2;
                        
            if (isTeammate) {
                champ1 = document.getElementById("champ1_" + i).getAttribute('data');
                champ2 = matchupOpponent.winPercent.val;
                document.getElementById('champ2_' + i).innerHTML = (matchupOpponent.winPercent.val) + "%";

            } else {
                champ2 = document.getElementById("champ2_" + i).getAttribute('data');
                champ1 = matchupOpponent.winPercent.val;
                document.getElementById('champ1_' + i).innerHTML = (matchupOpponent.winPercent.val) + "%";

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
            
            
            document.getElementById('matchupPct' + i).innerHTML = matchupPct;
            
            //var winDelta = (isTeammate ? 1 : -1) * Math.round(10.0 * (matchupPct - champAvg)) / 10.0;;
            
            var winDelta = Math.round(10.0 * (matchupPct - champAvg)) / 10.0;;

            //alert(matchupPct + " - " + champAvg + " = " + winDelta);

            var champDelta = document.getElementById('champDelta' + i);
            
            champDelta.innerHTML = winDelta;
            
            if (winDelta < 0) {
                champDelta.className = 'scorePoor';
            } else if (winDelta > 0) {
                champDelta.className = 'scoreGood';
            }
            
            


        };

        //Temporarily removed while Champion.gg API issue is resolved
        
        xmlhttp.open("GET", url, false);

        xmlhttp.send(null);
        
    
    }
    
    String.prototype.padRight = function(l,c) {return this+Array(l-this.length+1).join(c||" ")};
    
</script>

</html>