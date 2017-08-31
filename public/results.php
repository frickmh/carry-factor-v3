<!DOCTYPE html>
<html>
    <head>
        <title>Carry-Factor.com - LoL Stats Command Center.  Stats, Counterpicks, and Cooldowns</title>
        <link rel="shortcut icon" href="website/diamond_i_favicon.png">
        <meta charset="UTF-8">
        <!--<meta charset="ISO-8859-1">-->
        <!--<meta charset="ANSI">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Pre-game Lobby Stats for League of Legends">
        <meta content="LoL Stats Command Center.  Scout your opponents and punish their weakest link.  Dynamic Counterpick tool." name='description'>
        <meta name="keywords" content="pre-game lobby stats, League of Legends, Champion Select, Statistics, Summoner info, Bronzodia, Bronzodia.com, stats, lol, bronzodia, carry-factor, carry factor, counterpick, counterpicks, counter power, , educational, learning, tutorial, coaching, jungling, carrying, pressure ">
        
        
        <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" type="text/css" href="bronzodia.css">
        <link rel="stylesheet" type="text/css" href="bronzodia_Dark.css" id='dark-styles'>        
        <link rel="stylesheet" type="text/css" href="bronzodia_Light.css" id='light-styles'>      

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/color/jquery.color-2.1.2.min.js"></script>
		
		<script src="src/standardFunctions.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">


        
        <!-- Google Analytics Tracking Script -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-60328206-5', 'auto');
            ga('send', 'pageview');

        </script>
        <style>
            

            td {
                font-size:.74vw;
            }
            
            
            /*
            @media screen and (min-width: 600px) {
                body {
                    background-color: red;
                }
            }*/
            input[type=text].hidden {
                width:0px;
                height:0px;
            }
            textArea.hidden {
                width:0px;
            }

            .tinytext {
                font-size: xx-small;
                font-style: normal;
            }
            input[type=submit] {padding:5px 15px; 
                cursor:pointer;
                
                //font-weight:bold;

            }
            table.tableOuter {
                background-image: url("website/zwartevilt.png");
                box-shadow: 10px 10px 5px rgba(50, 50, 50, .3);
                border-radius: 10px;

            }
            b.tableOuter {
                color: #EEEEEE;
            }
            
            table.tableInner {
                background: #FFFFFF;
                height: 100%;
            }
            
            
            table.notStats {
                border-collapse: collapse;
                border: none;
            }

            .notStats table, .notStats tbody, .notStats td, .notStats tr {
                border: none;
                border-collapse: collapse;
            }
            
            .recentScoresTable tr, .recentScoresTable div {
                font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
                font-size:.8vw;
            }
            
            iframe.addPlayers {
                position:absolute;
                right: 33%;
                top: 60%;
                height: 20vw;
                width: 33vw;
                //visibility: hidden;
            }
			

            
        </style>
    </head>
    <body>
        <div id="main_content_div" align="center">
                <div style='width: 100%;' class='brown'><a href="index.html"><img class='banner' style='width:57.65%' src='website/banner-carry-factor.png' alt='Carry-Factor.com: LoL Stats Command Center'></a></div>
                <br>
                
                
                
                <div id="LeaderboardTop" style='box-shadow: 10px 10px 5px rgba(50, 50, 50, .3);width:728px;height:90px;'>
					
                    <!-- Leaderboard Bronzodia - Google AdSense-->
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:728px;height:90px"
                         data-ad-client="ca-pub-6399216573107712"
                         data-ad-slot="2427748385"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <!-- Large Leaderboard Top Bronzodia -->
                    <!--
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>                
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:970px;height:90px"
                         data-ad-client="ca-pub-6399216573107712"
                         data-ad-slot="2985489185"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>-->
                    <button style='float: left;' onclick="this.parentNode.remove();">X</button>
                </div>

				<div>
				<form style="visibility: hidden; height:1px" id='formhidden' action='results.php' method="get" target="_self"><input name='region' id='region' value="Region"><input type='checkbox' name='scout' id='scoutHidden'><input name='playerNames' id='playerNames' value="Players"><!--<textarea name='lobbychat' id='lobbychat'>Hello!</textarea>--><input id="inputhidden" type="submit" value="Submit"></form>

				<h3>Enter Names, then Submit.</h3>
					<textarea style="height: 135px; width: 25%" class="lobbyChat" id="lobbychatvisible" spellcheck="false" title='Paste chat here.  Type missing player names in a seperate line.  Non-case sensitive, ignores spaces.'>NovaDisk joined the lobby.
hashinshin joined the lobby.
Super Metroid joined the lobby.
MarineRevenge joined the lobby.
GundayMonday joined the lobby.
					</textarea>

					<div>                
						<select id="regionvisible" onchange="setRegion()">
							<option value="na" selected="selected">NA</option>
							<option value="euw">EUW</option>
							<option value="eune">EUNE</option>
							<option value="br">BR</option>
							<option value="kr">KR</option>
							<option value="lan">LAN</option>
							<option value="las">LAS</option>
							<option value="oce">OCE</option>
							<option value="ru">RU</option>
							<option value="tr">TR</option>
							<option value="jp">JP</option>
						</select>
					</div>
					<br>

					
					<button  id='buttonvisible' style="height: 50px; width: 150px" onclick="openResultsWindow()" class='freljord' title="Look up summoner info.  If a player hasn't said anything in the lobby, just enter their name on a separate line followed by a ':' (Similar to TheOddone in the example text)">Submit</button>
                                												
				</div>

                <!--<table><tr><td><p>Advertisement.</p></td></tr><tr><td><table border='1'><tr><td><script type="text/javascript" src="//eclkspbn.com/adServe/banners?tid=42108_62839_5"></script></td></tr></table></td></tr></table>-->

				<script>
					function getCookie(cookieLoad) {
						//alert(cookieLoad);
						
						var cookieLength = cookieLoad.length + 1;
						
						var cookieString;
						
						if (document.cookie !== null && document.cookie.indexOf(cookieLoad) > -1)
						{
							var afterCookie = document.cookie.substr(document.cookie.indexOf(cookieLoad + "=") + cookieLength);                    

							//alert (afterCookie);
							if (afterCookie.indexOf(";") > -1) {
								cookieString = afterCookie.substr(0,afterCookie.indexOf(';'));
								//alert ('afterCookie: ' + afterCookie + '\nif cookieString: ' + cookieString);
							} else {
								cookieString = afterCookie;
								//alert ('afterRegion: ' + afterRegion + '\nelse cookieString: ' + cookieString);
							}
						}
						
						return cookieString;
						
					}
					
					function setRegion() {
						var region = document.getElementById('regionvisible').value;
						document.cookie = "region=" + region + "; expires=Thu, 18 Dec 2020 12:00:00 UTC;";
						//alert (document.cookie);
						
					}					
					
					if (getCookie("region") != null) {
						var val = getCookie("region");
						var sel = document.getElementById('regionvisible');
						var opts = sel.options;
						for(var opt, j = 0; opt = opts[j]; j++) {
							if(opt.value == val) {
								sel.selectedIndex = j;
								break;
							}
						}
					}
					
					
				</script>
				
        
            <?php
                //header('Content-Type: text/html; charset=ISO-8859-1');
                header('Content-Type: text/html; charset=UTF-8');
                //header('Content-Type: text/html; charset=ANSI');
                //echo 'Got here!';

                if (_bot_detected()) {
                    //exit("Web crawler detected.");
                }
				
				
				//Get Installed Datadragon Patch
				$files = scandir("./datadragon");
				
				$patchFull = "6.15.1";
				$patchShort = "6.15";
				
				foreach ($files as $file) {
					if (is_numeric($file[0])) {
						$patchFull = $file;
						$patchNamePieces = explode(".", $patchFull);
						$patchShort = "$patchNamePieces[0].$patchNamePieces[1]";
					}				
				}

				file_put_contents("patch.json",json_encode(array("patchFull" => $patchFull, "patchShort" => $patchShort)));
				
				echo "<br>Patch: $patchFull<br>";
				
				//echo "$_SERVER[HTTP_HOST]";
			
            
                $getData = filter_input_array(INPUT_GET);

                $postInput = json_encode($_POST);
                
                //echo "<pre><div style='text-align: left'><br>Post Data Input:"; print_r($postInput); echo "</div></pre>";
                
                //var_dump($postData);
                
                $response_code = 0;
                
                $response_retry = 0;

                
                //$chatString = implode("", $_POST[0]);
                $chatString = $getData['playerNames'];
                
                //echo "<pre>"; print_r($chatString); echo "</pre>";

                $region = $getData['region'];
                
                $scout = $getData['scout'];
                

                $chatStringArray = explode(",", $chatString);

                $namesArray = $chatStringArray;

                $names = "";

				//$namesIdsObject = json_encode (json_decode ("{}"));
				



				/*
				$data[0]['id']="8488";
				$data[0]['name']="Tenby";
				$data[0]['area']="Area1";

				$data[1]['id']="8489";
				$data[1]['name']="Harbour";
				$data[1]['area']="Area1";

				$data[2]['id']="8490";
				$data[2]['name']="Mobius";
				$data[2]['area']="Area1";

				echo json_encode($data)."<br/>";

				//Add Image element (or whatever) into the array according to your needs

				$data[0]['image']="1278.jpg";
				$data[1]['image']="1279.jpg";
				$data[2]['image']="1280.jpg";

				echo json_encode($data);            
				*/

				
				//echo "<pre style='text-align:left'>namesArray: "; print_r($namesArray); echo "</pre>";     

                //Add each entry of $namesArray to $names.
                for ($i = 0; $i < count($namesArray); $i++)
                {
                    $names .= $namesArray[$i];

                    //echo $i;

                    //echo count($namesArray);
					
					//$url = "https://$region1.api.riotgames.com/lol/summoner/v3/summoners/by-name/". $namesArray[$i] . "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
					
					//$response = get_web_page($url);
					
					//$namesArray[$i]["Hello"] = $i;
					
					//echo "<pre style='text-align:left'>Names Array: "; print_r($namesArray); echo "</pre>";                                                            


                    if ($i + 1 < count($namesArray)) 
                    {
                        $names .= ",";
                    }

                }

                $curl = curl_init();
                
                $region1 = strtoupper($region) . '1';
                
                if ($region1 == "EUNE1")
                {
                    $region1 = "EUN1";
                }

                if ($region1 == "OCE1")
                {
                    $region1 = "OC1";
                }
				
				if ($region1 == "LAS1")
				{
					$region1 = "LA2";
				}
				
				if ($region1 == "RU1") {
					$region1 = "RU";
				}
				
				if ($region1 == "KR1") {
					$region1 = "KR";
				}
				

				$namesIdsObject = array_fill_keys($namesArray, array());
				$idsArray = Array();
				$response_code = 0;
				$response = Array();
				
				//Due to the deprecation of Summoner v1.4 in July 2017, I need to determine each Summoner ID individually, with 5 API requests.  
				//I can simplify my code by introducing '$namesIdsObject', an array that contains a summoner name paired with matching ID in each array item.
				//Here, we are creating a structure identical to '$namesData', and will simply replace it with the below for loop.
				for ($i = 0; $i < count($namesArray); $i++) {
					//$namesIdsObject[$namesArray[$i]] = json_encode (json_decode ("{}"));
					//$namesIdsObject["Hello"] = json_encode (json_decode ("{}"));
					
					
					$url = "https://$region1.api.riotgames.com/lol/summoner/v3/summoners/by-name/". $namesArray[$i] . "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
					
					$response = get_web_page($url);
					$response_body = $response['body'];
					$response_JSON = json_decode($response_body, true);
					//$response_code = $response['response_code'];
					
					$response_code = $response['response_code'];
					
					
					if ($response_JSON["id"] != null) {
						$namesIdsObject[$namesArray[$i]]["id"] = $response_JSON["id"];
						array_push($idsArray, $response_JSON["id"]);
					}
					$namesIdsObject[$namesArray[$i]]["slot"] = $i;
					$namesIdsObject[$namesArray[$i]]["name"] = $namesArray[$i];
					
					//echo "<pre style='text-align:left'>Url: "; print_r($url); echo "</pre>";     
					
					//echo "<pre style='text-align:left'>Response: "; print_r($response['body']); echo "</pre>";     
				}				

				//echo "<pre style='text-align:left'>Response Code: "; print_r($response_code); echo "</pre>";     					
				//echo "<pre style='text-align:left'>namesIdsObject: "; print_r($namesIdsObject); echo "</pre>";    
				
                //echo $url;
				
				$idsString = "";
				
				//Commented this line out on 7-8-2017.  Riot API v1.x is being deprecated on 7-24-2017, and all API methods must be replaced with their v3 equivalents, wherever possible.
				
				
				$url = "https://$region.api.pvp.net/api/lol/$region/v1.4/summoner/by-name/" . $names . '?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
				//$url = "https://$region1.api.riotgames.com/lol/summoner/v3/summoners/by-name/". $namesArray[0] . "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
                
				//echo "<br>" . $url;
				//echo "<pre style='text-align:left'>Response: "; print_r($response); echo "</pre>";     
				$response = get_web_page($url);
				
                
				
				
				//echo "<br><br>";
				//echo "<pre style='text-align:left'>Response: "; print_r($response); echo "</pre>";                                                            
			    /*          
				//echo "<pre style='text-align:left'>Response: "; print_r($response); echo "</pre>";                                                            
				//exit("<br><h1 style='color:black;'>Website Maintenance in Progress!!!</h1>");
				
                //$response = get_web_page("https://NA1.api.riotgames.com/lol/summoner/v3/summoners/by-name/". $names . "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833");
				
				//https://NA1.api.riotgames.com/lol/summoner/v3/summoners/by-name/NovaDisk?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833
				$response_body = $response['body'];
                
                $response_code = $response['response_code'];
				
				echo "<pre style='text-align:left'>Response Code: "; print_r($response_code); echo "</pre>";                                                            


				
                $namesJSON = json_decode($response_body, true);

				
				//echo "<pre style='text-align:left'>Names: "; print_r($namesJSON); echo "</pre>";                                                            

                

                
                
				
				$idsArray = Array();
				
				$namesData = array_fill_keys($namesArray, array());
                

				$i = 0;
				
				
                foreach ($namesArray as $nKey => $nData) {
                    $found = false;
					
					foreach ($namesJSON as $key => $data) {
                        
                        
                        if (strtolower(str_replace(" ", "", $data['name'])) == strtolower(str_replace(" ", "", $nData))) {
                            //echo "<pre style='text-align:left'>Data[id]: "; print_r($data['name']); echo ",</pre>";                                                            
                            array_push($idsArray, $data['id']);
							
							$namesData["$nData"]["id"] = $data['id'];
							
							$found = true;
                        }


                    }
					
					$namesData["$nData"]["slot"] = $i;
					$namesData["$nData"]["name"] = $nData;
					$i++;
					
                }
				*/

				//echo "<pre style='text-align:left'>namesJSON: "; print_r($namesJSON); echo ",</pre>";  
				//echo "<pre style='text-align:left'>idsArray: "; print_r($idsArray); echo ",</pre>";                                                            
				//echo "<pre style='text-align:left'>namesArray: "; print_r($namesArray); echo ",</pre>";                                                            
				//echo "<pre style='text-align:left'>namesData: "; print_r($namesData); echo ",</pre>";  				
				//echo "<pre style='text-align:left'>namesIdsObject: "; print_r($namesIdsObject); echo ",</pre>";  				
				
				//echo "<br><br>EQUAL: " . $namesData == $namesIdsObject . "<br>";
				//echo "<br><br>EQUAL: <br>"; echo $namesData == $namesIdsObject; echo "<br><br>";
				
				//Testing this code, to replace $namesData with $namesIdsObject
				$namesData = $namesIdsObject;
				
				

				//echo "<pre style='text-align:left'>Data[id]: "; print_r($namesData); echo ",</pre>";                                                            
				
				//echo "<pre style='text-align:left'>idsArray: "; print_r($idsArray); echo ",</pre>";                                                            
				//echo "<pre style='text-align:left'>namesArray: "; print_r($namesArray); echo ",</pre>";                                                            
				//echo "<pre style='text-align:left'>namesData: "; print_r($namesData); echo ",</pre>";  
				
				//I need to test overwriting '$idsArray' and '$namesArray' here.  I might need to replace all of them manually.
				/*
				for ($i = 0; $i < count($namesIdsObject); $i++) {
					$idsArray[$i] = $namesIdsObject[$i]["id"];
					$namesArray[$i] = $namesIdsObject[$i]["name"];
				}*/
                
                
                for ($i = 0; $i < count($idsArray); $i++) {
                    $idsString .= $idsArray[$i];
                    //$idsString .= "Hello $i, ";
                    
                    if ($i + 1 < count($idsArray))
                    {
                        $idsString .= ',';
                    }
                }
                
                
                //NovaDisk:  50019204
                //Annie Bot: 35590582
                //LiquidHandsoap: 69981918
                
                //echo "<br>$idsString";
                
                //Sample Match: https://na.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/NA1/35590582?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833
                
				//echo "<pre style='text-align:left'>Response: "; print_r($response); echo "</pre>";                                                            
				//exit("<br><h1 style='color:black;'>Website Maintenance in Progress!!!</h1>");


                //$urlMatch = "https://$region.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region1/$idsArray[0]?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
                
				$urlMatch = "https://$region1.api.riotgames.com/lol/spectator/v3/active-games/by-summoner/$idsArray[0]?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
				//$urlMatch = "https://$region1.api.riotgames.com/lol/spectator/v3/active-games/by-summoner/39709811?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
                
				//Spornts Summoner ID:	39709811
				
				//TEST BLOCK
				//echo "<pre style='text-align:left'>"; print_r($urlMatch); echo "</pre>";                                                            
				//exit("<br><h1 style='color:black;'>Website Maintenance in Progress!!!  Please check back soon!</h1>");				
				
				echo "<br><h1 style='color:black;'>Website Maintenance in Progress!!!  Please check back soon!</h1>";
				
                //$pos = strpos($urlMatch, '?');
                //$substr = substr($urlMatch, 0, $pos);

                //echo "<br>Url Match: $substr<br>";
                
                if ($response_code != 429)
                {
                    $response = get_web_page($urlMatch);

                    $response_body = $response['body'];

                    $response_code = $response['response_code'];
					
					//echo "<br><br>Response code is NOT 429!<br><br>";
                    
                } else {                    
                    $response_body= '';
                }

				//echo "<pre style='text-align:left'>Response: "; print_r($response); echo "</pre>";    
                
				
				
                if ($response_code == 404 || $scout =='true' || $scout == 'on' || $response_code == 0)
                {
                    //Run the rest of the script
                    echo "<br><div><br><form action='demo.php' target='_blank'><input type='submit' class='bigButton shadow' value='Demo Video'></form></div><br>";
                    
                    //echo "<br><br>********* GOT RESPONSE $response_code *******************<br><br>";



                    $everyoneChamps = array();
                    $everyoneGamesPlayed = array();
                    $everyoneKillsPerGame = array();
                    $everyoneDeathsPerGame = array();
                    $everyoneAssistsPerGame = array();
                    $everyoneKDA = array();
                    $everyoneCS = array();
                    $everyoneWinPercent = array();
                    $everyoneAllChampsMatchHistory = array();
                    
                    $everyoneAllChampsMatchHistoryTable = array();

					
					//Multi Curl:  curl_multi executes simultaneous CURL Requests to save on page loading time.
					// Define the URLs
					$urls = array();
					
					//Get Stats Array.
					for ($j = 0; $j < count($idsArray); $j++)
					{
						if ($idsArray[$j] == NULL)
						{
							continue;
						}
						
						array_push($urls, "https://$region.api.pvp.net/api/lol/$region/v1.3/stats/by-summoner/" . $idsArray[$j] . "/ranked?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833");
					}
					
					//Get Current Game Array.
					for ($j = 0; $j < count($idsArray); $j++)
					{
						if ($idsArray[$j] == NULL)
						{
							continue;
						}
						
						array_push($urls, "https://$region.api.pvp.net/api/lol/$region/v1.3/game/by-summoner/$idsArray[$j]/recent?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833");
					}				
					
					

                    //If NOT in a match, print league and stats.
                    $url = "https://$region.api.pvp.net/api/lol/$region/v2.5/league/by-summoner/" . $idsString . "/entry?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
                    
					array_push($urls, $url);
			
					echo "<pre><div style='text-align: left'><br>URLs:<br>"; print_r($urls); echo "</div></pre>";

					$pg = new ParallelGet($urls);
					
					//exit("<br>Exiting at test break point!<br>");  

					
                    $leaguesJSON = json_decode($pg->output[count($pg->output) - 1], TRUE);

                    
                    $winsArray = array();
                    
                    $lpArray = array();
                    
                    $lossesArray = array();

                    $leaguesArray = array();
                    
                  

                    //Get the wins and league of each player.
                    for($i = 0; $i < count($idsArray); $i++)
                    {
                        $rank = ucfirst(strtolower($leaguesJSON[$idsArray[$i]][0]['tier'])) . ' ' . strtoupper($leaguesJSON[$idsArray[$i]][0]['entries'][0]['division']);
                        
                        $lp = "";
                        
                        if ($leaguesJSON[$idsArray[$i]][0]['entries'][0]['miniSeries'] !== NULL) {
                            
                            $lp = "Series: " . $leaguesJSON[$idsArray[$i]][0]['entries'][0]['miniSeries']['progress'];
                            
                            $lp = str_replace("W", "<font style='color:green'>&#x2714;</font>&nbsp", $lp);
                            $lp = str_replace("L", "<font style='color:red'>&#x2716;</font>&nbsp", $lp);
                            $lp = str_replace("N", "<font style='color:grey'>&#x2796;</font>&nbsp", $lp);
                            
                        } else {
                            $lp = $leaguesJSON[$idsArray[$i]][0]['entries'][0]['leaguePoints'] . " LP";
                        }
                        
                        $wins = $leaguesJSON[$idsArray[$i]][0]['entries'][0]['wins'];
                        
                        $losses = $leaguesJSON[$idsArray[$i]][0]['entries'][0]['losses'];

                        if (strlen($rank) < 3)
                        {
                            $rank = "Unranked";
                        }

                        if ($wins == NULL)
                        {
                            $wins = 0;            
                        }

                        if ($losses == NULL)
                        {
                            $losses = 0;            
                        }
                        
                        //Removed for testing, trying to get Placements W/L.
                        //array_push($winsArray, $wins);
                        //array_push($lossesArray, $losses);

                        array_push($lpArray, $lp);
                        
                        array_push($leaguesArray, $rank);
                    }			
					
					
					
					//The variable used to reference the index in the ID's array.  This will change between the increment of the array to read, and zero, depending on whether the entry in the name array corresponds with a null ID.
					$o = -1;
					
					//This variable will increment only.  This points to the slot in the $idsArray to read.
					$n = -1;
					
					//echo var_dump($namesArray);
					
					$holes = 0;
					
					//echo "<br><br>Names Array: " . var_dump($namesArray);
					
					//echo "<pre style='text-align:left'>Names Array: "; print_r($namesArray); echo "</pre>";                                                            

					
					
                    for ($j = 0; $j < count($namesArray); $j++)
                    {						
				
						for ($i = 0; $i < count($namesArray); $i++) { 
							//echo "<br>" . $namesData["$namesArray[$j]"]["name"] . ", " . $namesArray[$i];
						
							if ($namesData["$namesArray[$i]"]["name"] == $namesArray[$j]) {
								//echo " MATCH!";
								
								//echo " ID: " . $namesData["$namesArray[$j]"]["id"] . " == NULL: " . ($namesData["$namesArray[$j]"]["id"] == null);
								
								if ($namesData["$namesArray[$j]"]["id"] == null) {
									
									//echo "... Adding Hole!";
									
									$holes++;
								}
								$slot = $namesData["$namesArray[$j]"]["slot"];
							}
						
						}
						
						//echo "<br>Slot New: " . $slot;
				
						
						
						
						/*
						for ($i = 0; $i < $j; $i++) {
							if ($namesData["$namesArray[$i]"]["id"] == null) {
								$holes++;
								
								echo "<br>" . $namesData["$namesArray[$i]"]["name"] . ", " . $namesArray[$i];
								
							}

						}
						*/
						//echo "<br>Holes: " . $holes;
						
						//$slot = $namesData["$namesArray[$j]"]["slot"];
						//$slot = $j + $holes;
						
						//echo var_dump($namesArray[$j]);
						

						
						
						if ($namesData["$namesArray[$j]"]["id"] !== null) {
							$n++;
							$o = $n;
						} else {
							$o = -1;
						}						

						//echo "<br>j: " . $j . ", Slot: " . $slot . ", id: " . $namesData["$namesArray[$slot]"]["id"] . ", Name: " . $namesData["$namesArray[$slot]"]["name"] . ", Holes: " . $holes . ", o: " . $o;

						/*
                        if ($idsArray[$j] == NULL)
                        {
                            continue;
                        }*/

						//Commented out due to curl_multi

						
						$statsJSON = json_decode($pg->output[$o], TRUE);

                        
                        usort($statsJSON['champions'], function($a, $b) {
                            return ($b['stats']['totalSessionsPlayed'] - $a['stats']['totalSessionsPlayed']);
                        });

                        //echo '<p>SORTED STATS</p>';        

                        
                        $topChampIdsArray = array();

                        $topChampsNamesArray = array();

                        $topChampsGamesPlayed = array();

                        $topChampsWinPercent = array();

                        $topChampsKillsPerGame = array();
                        $topChampsDeathsPerGame = array();
                        $topChampsAssistsPerGame = array();
                        $topChampsKDA = array();
                        
                        $topChampsCS = array();
                        
                        
                        //Code attempting to capture data for 2016 Placement Matches.
                        foreach ($statsJSON['champions'] as $key => $data) {
                            //echo "<br>" . $data['id'];
                            
                            if ($data['id'] == 0) {
                                
                                //echo "<br>" . $data . "<br>";
                                
                                //echo "<br>W/L: " . $data['stats']['totalSessionsWon'] . "/" . $data['stats']['totalSessionsLost'] . "<br>";
                                
                                array_push($winsArray, $data['stats']['totalSessionsWon']);

                                array_push($lossesArray, $data['stats']['totalSessionsLost']);

                            }
                        }
                        


                        //echo "<p>Champion Stats:</p>";

                        for ($i = 0; ($i < count($statsJSON['champions']) && $i < 11); $i++)
                        {
                            $champID = $statsJSON['champions'][$i]['id'];

							if ($champID == 0) {
								continue;
							}
							
                            array_push($topChampIdsArray, $champID);

                            //$responseJSON = json_decode(get_web_page("https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/$champID?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"), TRUE);

                            //$champName = $responseJSON['name'];

                            $champName = getChampName($champID);

                            array_push($topChampsNamesArray, $champName);
							
							//echo "ChampName: $champName<br>";
							//echo "ChampID: $champID<br>";

                            $gamesPlayed = $statsJSON['champions'][$i]['stats']['totalSessionsPlayed'];
                            $wins = $statsJSON['champions'][$i]['stats']['totalSessionsWon'];

                            //echo "$gamesPlayed<br>";

                            array_push($topChampsGamesPlayed, $gamesPlayed);
                            array_push($topChampsWinPercent, round1(100 * (double)$wins / (double)$gamesPlayed));

                            $kills = $statsJSON['champions'][$i]['stats']['totalChampionKills'];
                            $deaths = $statsJSON['champions'][$i]['stats']['totalDeathsPerSession'];
                            $assists = $statsJSON['champions'][$i]['stats']['totalAssists'];

                            array_push($topChampsKillsPerGame, round1((double)$kills / (double)$gamesPlayed));
                            array_push($topChampsDeathsPerGame, round1((double)$deaths / (double)$gamesPlayed));
                            array_push($topChampsAssistsPerGame, round1((double)$assists / (double)$gamesPlayed));

                            $cs = $statsJSON['champions'][$i]['stats']['totalMinionKills'];

                            array_push($topChampsCS, round0((double)$cs / (double)$gamesPlayed));

                            $kda = round2((double)($kills + $assists) / (double)$deaths);

                            array_push($topChampsKDA, $kda);
                        }
      
						
                        $responseJSON = json_decode($pg->output[$o + count($idsArray)], TRUE);
						
                        //echo "<pre><div style='text-align: left'><br>Match Data:"; print_r($responseJSON); echo "</div></pre>";
                        
                        $playerMatchHistory = array();                        
                        
                        $adcCount = 0;
                        $supCount = 0;
                        $midCount = 0;
                        $topCount = 0;
                        $jungCount = 0;
                        $gamesCount = 0;
                        
                        $topChamps = array();
                        $jungChamps = array();
                        $midChamps = array();
                        $adcChamps = array();
                        $supChamps = array();
                        
                        
                        
                        foreach ($responseJSON['games'] as $key => $data)
                        {
                            if ($data['mapId'] != 11 || $data['gameMode'] <> 'CLASSIC' || $data['gameType'] <> 'MATCHED_GAME' || $data['subType'] == 'BOT') {
                                continue;
                            }
                            
                            //echo "<pre><div style='text-align: left'><br>Match Data:"; print_r($data); echo "</div></pre>";
                            
                            $matchChampId = $data['championId'];
                            
                            //$matchChampId = $data['participants'][0]['championId'];
                            $matchChampName = getChampName($matchChampId);
                            
                            $matchKills = $data['stats']['championsKilled'] != NULL ? $data['stats']['championsKilled'] : 0;
                            $matchDeaths = $data['stats']['numDeaths'] != NULL ? $data['stats']['numDeaths'] : 0;
                            $matchAssists = $data['stats']['assists'] != NULL ? $data['stats']['assists'] : 0;
                            $matchWinner = $data['stats']['win'];
                            

                            
                            $laneWorking = $data['stats']['playerPosition'];
                            $roleWorking = $data['stats']['playerRole'];
                            
                            $gamesCount++;
                            
                            if ($laneWorking == 1) {
                                $topCount++;
                                $role = "Top";
                            } else if ($laneWorking == 2 || $laneWorking =='MIDDLE') {
                                $midCount++;
                                $role = "Mid";
                            } else if ($laneWorking == 3) {
                                $jungCount++;
                                $role = "Jungle";
                            } else if ($laneWorking == 4 || $laneWorking == 'BOTTOM') {
                                if ($roleWorking == 3) {
                                    $adcCount++;
                                    $role = "Adc";
                                } else if ($roleWorking == 2) {
                                    $supCount++;
                                    $role = "Support";
                                }
                            }
                            
                            if ($role == 'Top') {
                                if ($topChamps[$matchChampName] !== NULL)
                                {
                                    $topChamps[$matchChampName] = $topChamps[$matchChampName] + 1;
                                } else {
                                    $topChamps = array_merge($topChamps, array($matchChampName => 1));
                                }
                            }
                            if ($role == 'Mid') {
                                if ($midChamps[$matchChampName] !== NULL)
                                {
                                    $midChamps[$matchChampName] = $midChamps[$matchChampName] + 1;
                                } else {
                                    $midChamps = array_merge($midChamps, array($matchChampName => 1));
                                }
                            }                            
                            if ($role == 'Jungle') {
                                if ($jungChamps[$matchChampName] !== NULL)
                                {
                                    $jungChamps[$matchChampName] = $jungChamps[$matchChampName] + 1;
                                } else {
                                    $jungChamps = array_merge($jungChamps, array($matchChampName => 1));
                                }
                            }                            
                            if ($role == 'Adc') {
                                if ($adcChamps[$matchChampName] !== NULL)
                                {
                                    $adcChamps[$matchChampName] = $adcChamps[$matchChampName] + 1;
                                } else {
                                    $adcChamps = array_merge($adcChamps, array($matchChampName => 1));
                                }
                            }                            
                            if ($role == 'Support') {
                                if ($supChamps[$matchChampName] !== NULL)
                                {
                                    $supChamps[$matchChampName] = $supChamps[$matchChampName] + 1;
                                } else {
                                    $supChamps = array_merge($supChamps, array($matchChampName => 1));
                                }
                            }                            
                            //$portrait = getChampPortrait($matchChampName);
                            
                            $matchData = array('championId' => $matchChampId, 'championName'=> $matchChampName, 'role' => $role, 'kills' => $matchKills, 'deaths' => $matchDeaths, 'assists' => $matchAssists, 'winner' => $matchWinner);
                            
                            array_push($playerMatchHistory, $matchData);


                        }                
                        
                        /*
                        echo "<pre><div style='text-align: left'><br>Match Data:"; 
                            print_r($playerMatchHistory); 
                            echo "</div></pre>";
                        */
                        
                       arsort($topChamps);
                       arsort($jungChamps);
                       arsort($midChamps);
                       arsort($adcChamps);
                       arsort($supChamps);

                        $playerMatchHistoryTable = "<hr><div style='font-size:115%; margin-top:-.35vw;'>Recent Roles<span class='tooltip' title=\"Matchmade games, Summoner's Rift, Ranked and Normal.\nRoles are about 95% accurate.\">?</span></div>";
                        
                        $topPct = round(100 * $topCount / $gamesCount, 1);
                        $jungPct = round(100 * $jungCount / $gamesCount, 1);
                        $midPct = round(100 * $midCount / $gamesCount, 1);
                        $adcPct = round(100 * $adcCount / $gamesCount, 1);
                        $supPct = round(100 * $supCount / $gamesCount, 1);
                        
                        $rolesArray = array();
                        $rolesArray = array_merge($rolesArray, array('Top' => $topPct));                        
                        $rolesArray = array_merge($rolesArray, array('Jungle' => $jungPct));
                        $rolesArray = array_merge($rolesArray, array('Mid' => $midPct));
                        $rolesArray = array_merge($rolesArray, array('Adc' => $adcPct));
                        $rolesArray = array_merge($rolesArray, array('Support' => $supPct));
                        
                        arsort($rolesArray);
                        
                        $playerMatchHistoryTable .= "<table style='border-collapse: collapse; margin-top:-.15vw;'>";

                        foreach ($rolesArray as $roleWorking => $pct) {
                            if ($pct > 0)
                            {
                                $displayChamps = array();
                                
                                if ($roleWorking == 'Top') {
                                    $displayChamps = $topChamps;
                                } elseif ($roleWorking == 'Jungle') {
                                    $displayChamps = $jungChamps;
                                } elseif ($roleWorking == 'Mid') {
                                    $displayChamps = $midChamps;
                                } elseif ($roleWorking == 'Adc') {
                                    $displayChamps = $adcChamps;
                                } elseif ($roleWorking == 'Support') {
                                    $displayChamps = $supChamps;
                                }
                                
                                $tableDisplayChamps = "<table style='border-collapse: collapse;'><tr>";
                                
                                foreach ($displayChamps as $name => $count)
                                {
                                    $portrait = getChampPortrait($name);
                                    
									
									//$tableDisplayChamps .= "<br>Slot: " . $slot . ", Holes: " . $holes;
									
                                    $tableDisplayChamps .= "<td><img src='$portrait' alt='$name' class='champ' title='$count games' style='width:1.5vw;cursor:pointer;display:block;box-shadow: 1.5px 1.5px .75px grey; border-radius:3px;' onClick='selectStats(\"$name\",$slot,\"$region\",\"$idsArray[$o]\")'></td>";
                                }
                                
                                $tableDisplayChamps .= "</tr></table>";
                                
                                $playerMatchHistoryTable .= "<tr><td>$tableDisplayChamps</td><td><div style='font-weight: normal;'>$roleWorking:&nbsp$pct%</div></td></tr>";                                
                                //$playerMatchHistoryTable .= "<div style='font-size: 90%; font-weight: normal;'>$role:&nbsp$pct%</div>";                                
                            } else
                            {
                                //$playerMatchHistoryTable .= "<br>";
                                
								
                                $portrait = getChampPortrait('blank');
                                $tableDisplayChamps = "<table style='border-collapse: collapse;'><tr><td><img src='$portrait' alt='$name' title='$count games' style='width:1.5vw;cursor:pointer;display:block;box-shadow: 1.5px 1.5px .75px grey; border-radius:3px;opacity:.05;'></td></tr></table>";                                
                                $playerMatchHistoryTable .= "<tr><td>$tableDisplayChamps</td><td><div style='font-weight: normal;'></div></td></tr>";
                            }
                        }

                        $playerMatchHistoryTable .= "</table>";

                        
                        $playerMatchHistoryTable .= "<table class='recentScoresTable' style='border-collapse: collapse;'><hr style='margin-top:-.10vw;'><tr><div style='font-size:115%; margin-top:-.35vw;'>Recent Scores</div></tr><tr style='text-align:left;'><div>&nbspNewest&nbsp&#8592;&#8594;&nbspOldest</div></tr><tr><td style='padding-top:1.3vw; padding-right:.1vw;line-height: 88%;'>K<br>D<br>A<br></td>";

                        //for ($l = count($playerMatchHistory); $l > 0; $l-- )
                        for ($l = 0; $l < count($playerMatchHistory); $l++ )
                        {
                            $m = $l - 0;
                            
                            $matchChampId = $playerMatchHistory[$m]['championId'];
                            $matchChampName = getChampName($matchChampId);
                            $matchKills = $playerMatchHistory[$m]['kills'];
                            $matchDeaths = $playerMatchHistory[$m]['deaths'];
                            $matchAssists = $playerMatchHistory[$m]['assists'];
                            $matchWinner = $playerMatchHistory[$m]['winner'];

                            $class = $matchWinner ? "win" : "loss";
                            $portrait = getChampPortrait($matchChampName);
                            
                            $playerMatchHistoryTable .= "<td class='$class'><div><img src='$portrait' class='champ' alt='$matchChampName' title='$matchChampName' style='width:1.4vw;cursor:pointer;display:block;box-shadow: 1.5px 1.5px .75px grey; border-radius:3px;' onClick='selectStats(\"$matchChampName\",$slot,\"$region\",\"$idsArray[$o]\")'></div><div style='font-weight: normal;line-height: 88%;'>$matchKills<br>$matchDeaths<br>$matchAssists</div></td>";
                            
                        }
                        

                        
                        array_push($everyoneAllChampsMatchHistory, $playerMatchHistory);
                        
                        $playerMatchHistoryTable .= "</tr></table>";
                        
                        $namesData["$namesArray[$o]"]["matchHistoryTable"] = $playerMatchHistoryTable;
                        
                        array_push($everyoneAllChampsMatchHistoryTable, $playerMatchHistoryTable);
                        
                        

                        array_push($everyoneChamps, $topChampsNamesArray);

                        array_push($everyoneGamesPlayed, $topChampsGamesPlayed);

                        array_push($everyoneWinPercent, $topChampsWinPercent);

                        array_push($everyoneKillsPerGame, $topChampsKillsPerGame);

                        array_push($everyoneDeathsPerGame, $topChampsDeathsPerGame);

                        array_push($everyoneAssistsPerGame, $topChampsAssistsPerGame);

                        array_push($everyoneKDA, $topChampsKDA);

                        
                        array_push($everyoneCS, $topChampsCS);

                    }


					//Right now there are less than 5 in the IDs array.
					
                    $tableChampsArray = array();

                    $countNames = count($namesArray) - 1;
                    
					//The variable used to reference the index in the ID's array.  This will change between the increment of the array to read, and zero, depending on whether the entry in the name array corresponds with a null ID.
					$m = -1;
					
					//This variable will increment only.  This points to the slot in the $idsArray to read.
					$n = -1;
					
                    for ($k = 0; $k < count($namesArray); $k++)
                    {
						//echo "<br>$namesArray[$k] id: " . $namesData["$namesArray[$k]"]["id"];
						
						if ($namesData["$namesArray[$k]"]["id"] !== null) {
							//$k = $m;
							$n++;
							$m = $n;
						} else {
							$m = -1;
						}
						
						
						
                        $tableChamps = "<div id='divPlayer$k'>";
                        
                        $tableChamps .= "<table id='tablePlayer$k' border='1' style='border:solid #000; border-width: 0 1px;' cellpadding='1' class='tableInner'><tbody>";
						
						//echo "<br>League: " . $leaguesArray[$m];
						
                        $leagueIcon = getLeagueIcon($leaguesArray[$m]);

                        $tableChamps .= "<tr><div align='center' style='margin-top:-0.5vw;'><b class='tableOuter'>Move Slot</b></div></tr>";
                        
                        $tableChamps .= "<tr><div align='center'><button class='arrow' onClick='swapFarLeft($k, $countNames)' title='Swap to Far Left'><<</button><button class='arrow' onClick='swapLeft($k, $countNames)' title='Swap to Left'><</button><button class='arrow' onClick='swapRight($k, $countNames)' title='Swap to Right'>></button><button class='arrow' onClick='swapFarRight($k, $countNames)' title='Swap to Far Right'>>></button></div></tr>";

						//echo "<br>Names Data: " . $namesData["$namesArray[$k]"]["matchHistoryTable"];
						
						$matchHistoryTable = $namesData["$namesArray[$m]"]["matchHistoryTable"];


						
                        //$tableChamps .= "<tr><th colspan='5' text-align:center' class='tablePaneUpper'><div style='text-align:center'><b style='font-size: 150%; text-shadow: 4px 4px 3px rgba(100, 100, 100, 0.2);'><a href='https://$region.op.gg/summoner/userName=$namesArray[$k]' target='_blank'>$namesArray[$k]</a></b></div><div style='font-size: 0;'><img src='$leagueIcon' alt='$leaguesArray[$m]' title='$leaguesArray[$m]' style='width:3.9vw; text-align:center; margin-top:-.25vw;'></div><div style='text-align:center; font-size=125%'>$leaguesArray[$m] ($lpArray[$m])</div><div style='text-align:center; font-size:75%;margin-bottom:-.05vw;'></div><div style='text-align:center; font-size:80%;margin-bottom:-.05vw;'>$winsArray[$m] / $lossesArray[$m] W/L</div><div style='margin-top:-.4vw;'>$everyoneAllChampsMatchHistoryTable[$m]</div>";
						$tableChamps .= "<tr><th colspan='5' text-align:center' class='tablePaneUpper'><div style='text-align:center'><b style='font-size: 150%; text-shadow: 4px 4px 3px rgba(100, 100, 100, 0.2);'><a href='https://$region.op.gg/summoner/userName=$namesArray[$k]' target='_blank'>$namesArray[$k]</a></b></div>";
						

						if ($m == -1) {
							$tableChamps .= "<div><br><br><br><br><br><br><br><br>Player not found on " . strtoupper($region) . " server.<br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>";
						} else {
							$tableChamps .= "<div style='font-size: 0;'><img src='$leagueIcon' alt='$leaguesArray[$m]' title='$leaguesArray[$m]' style='width:3.9vw; text-align:center; margin-top:-.25vw;'></div><div style='text-align:center; font-size=125%'>$leaguesArray[$m] ($lpArray[$m])</div><div style='text-align:center; font-size:75%;margin-bottom:-.05vw;'></div><div style='text-align:center; font-size:80%;margin-bottom:-.05vw;'>$winsArray[$m] / $lossesArray[$m] W/L</div>";
							$tableChamps .= "<div style='margin-top:-.4vw;'>$matchHistoryTable</div>";
						}

						//$tableChamps .= "<br>k: " . $k . "<br>";
						
                        $tableChamps .= "<hr><div class='counters'>" . read_file("http://$_SERVER[HTTP_HOST]/matchupsTest.php?k=$k&patchFull=$patchFull")['body'] . "</div>";
						
                        $tableChamps .= "<div style='font-size:115%; margin-top:-.5vw;'><hr style='margin-bottom:-.05vw;'>Most Played Champs</div></th></tr>";

                        $tableChamps .= "<tr><td><table class='statsTable'><tbody>";
                        
                        $tableChamps .= "<tr class='tableTopChampsHeader'><td>&nbspTop Champs&nbsp</td><td style='width:3vw;'>&nbspGames&nbsp</td><!--<td>&nbspAvg Score&nbsp</td>--><td style='width:3.5vw;'>&nbspWin Pct&nbsp</td><td style='width:3.5vw;'>&nbspKDA&nbsp</td></tr>";     

                        $tableChamps .= "<tr class='topChamps' id='selectContainer$k'><td style='height:1.45vw'>";
                        
                        //$urlChamps = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";
						
						$urlChamps = "./datadragon/$patchFull/data/en_US/champion.json";
						
                        $responseChamps = read_file($urlChamps);
                        $responseJSONChamps = json_decode($responseChamps['body'], true);
                        ksort($responseJSONChamps['data']);
                        
                        $tableChamps .= "<select id='champName$k' onChange='getStats($k, $idsArray[$m], \"$region\")'><br>";

                        foreach ($responseJSONChamps['data'] as $key => $data)
                        {
                            $champID = $data['id'];

                            $tableChamps .= "<option id='$champID' value='$key'>$key</option>";
                        }
                        
                        $tableChamps .= "</select></td><td id='games$k'>-</td><!--<td  style='font-size:90%' id='avgScore$k'>-</td>--><td id='winPct$k'>-</td><td id='kda$k'>-</td></tr>";
                        
                        for ($i = 0; $i < 10; $i++)
                        {

                            $row = "<tr class='topChamps'>";

                            $champs = $everyoneChamps[$k][$i];
                            $played = $everyoneGamesPlayed[$k][$i];
                            $kills = $everyoneKillsPerGame[$k][$i];
                            $deaths = $everyoneDeathsPerGame[$k][$i];
                            $assists = $everyoneAssistsPerGame[$k][$i];
                            $cs = $everyoneCS[$k][$i];
                            $kda = $everyoneKDA[$k][$i];
                            $winPct = $everyoneWinPercent[$k][$i];
							
                            $portrait = getChampPortrait($champs);
                            
                            $kdaClass = 'scoreAvg';
                            $winPctClass = 'scoreAvg';
                            
                            if ($played > 9 && $winPct <= 30 ) {$winPctClass = 'scorePoor';}
                            if ($played > 3 && $winPct <= 25 ) {$winPctClass = 'scorePoor';}
                            
                            if ($played > 20) {
                                if ($kda > 3) { $kdaClass = 'scoreAboveAvg'; }
                                if ($kda > 3.5) { $kdaClass = 'scoreGood'; }
                                if ($kda > 4) { $kdaClass = 'scoreVeryGood'; }
                                if ($kda > 5) { $kdaClass = 'scoreExcellent'; }
                                if ($kda < 1.5) { $kdaClass = 'scorePoor'; }
                                if ($winPct < 40) { $winPctClass = 'scorePoor'; }

                                if ($played > 30)
                                {
                                    if ($winPct > 55) { $winPctClass = 'scoreAboveAvg'; }
                                    if ($winPct > 60) { $winPctClass = 'scoreGood'; }
                                    if ($winPct > 65) { $winPctClass = 'scoreVeryGood'; }
                                    if ($winPct > 70) { $winPctClass = 'scoreExcellent'; }
                                    if ($winPct < 40) { $winPctClass = 'scorePoor'; }
                                }
                            }

                            //$row .= "<td>$everyoneChamps[$j][$i]</td><td>$everyoneGamesPlayed[$j][$i]</td><td>$everyoneKillsPerGame[$j][$i]/$everyoneDeathsPerGame[$j][$i]/$everyoneAssistsPerGame[$j][$i] ($everyoneKDA[$j][$i])</td><td>$everyoneWinPercent[$j][$i] %</td>";
                            $row .= "<td style='font-size:0;'><table class='notStats' style='float:left;font-size:0;margin-top:-.06vw;margin-bottom:-.06vw;'><tr><td style='display:block; style='font-size:0;'><img src='$portrait' class='champ' onerror='this.src=\"champicons/blank_square_0.png\"' alt='$champs' title='$champs' style='width:1.5vw; cursor:pointer;float:left;box-shadow: 1.5px 1.5px .75px grey; border-radius:3px;' onClick='selectStats(\"$champs\",$k,\"$region\",\"$idsArray[$m]\");' style='font-size:0;'></td><td id='notStatsChamp$k'>$champs</td></tr></table></td><td>$played</td><!--<td style='font-size:90%'>$kills/$deaths/$assists</td>--><td class='$winPctClass'>$winPct %</td><td class='$kdaClass'>$kda&nbsp<span class='tooltip' title='Avg Score: $kills/$deaths/$assists   $cs CS'>+</span></td>";

                            $row .= "<tr>";

                            $tableChamps .= $row;

                        }
                                                
                        $tableChamps .= "</td></tr></tbody></table></td></tr>";
                        
                        $tableChamps .= "</tbody></table>";
                        
                        $tableChamps .= "</div>";



                        array_push($tableChampsArray, $tableChamps);
						
						$namesData["$namesArray[$k]"]["tableChamps"] = $tableChamps;

                        //echo "<br>";

                    }

                    $tablePlayers = "<table border='3' cellpadding='8' class='tableOuter'><tbody>";

					//Removed 'Add Player(s)' because it is now redundant.
                    //$tablePlayers .= "<tr style='text-align:center;'><th colspan='5'><h2 style='color:#DDDDDD;margin: 0 auto;margin-top:-.35vw;margin-bottom:-.3vw;'>Pre-game Lobby Statistics<button style='float:right' onclick='addPlayersDialog();'>Add Player(s)</button><iframe class='addPlayers' id='iframe_addPlayers' style='visibility: hidden;' src='playerNames_iframe.html'>Test iFrame</iframe></th></tr></h2>";
                    $tablePlayers .= "<tr style='text-align:center;'><th colspan='5'><h2 style='color:#DDDDDD;margin: 0 auto;margin-top:-.35vw;margin-bottom:-.3vw;'>Pre-game Lobby Statistics</th></tr></h2>";
                    
                    $tablePlayers 
                            .= "<tr style='text-align:center;'>"
                                ."<th colspan='5'>"
                                    ."<div><table style='margin: 0 auto; border-collapse: collapse; margin-bottom:-.6vw; margin-top:-0.5vw;display:inline-block'>"
                                        ."<tr style='text-align:center;'>"
                                            . "<td>"
                                                . "<form action='http://www.carry-factor.com'>"
                                                    //. "<input class='navButton' style='padding:10px; float:left;' type='submit' value='Go Back' title='Return to previous page.'>"
                                                    . "<textarea style='visibility: hidden;  float:left;' class='hidden'></textarea>"
                                                . "</form>"
                                            . "</td>"
                                            . "<td>"
                                                . "<form action='results.php' id='postDataContinueForm' method='get'>"
                                                    . "<textarea id='postDataContinueTextArea' style='visibility: hidden' class='hidden'></textarea>"
                                                    . "<input type='text' id='postDataContinueRegion' name='region' value='Hello!' style='visibility: hidden' class='hidden'>"
                                                    . "<input type='text' id='playerNames' name='playerNames' value='$chatString' style='visibility: hidden; float:left;' class='hidden'>"
                                                    . "<input class='navButton' id='continueButton' style='padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:45px; float:left;' type='submit' value='Continue to Live Stats' title='Once the splash screen loads, Continue to In-game Stats will bring you to a page that displays information for both teams.  If the game has not started yet, the current page will simply reload.' onClick='reloadPage();'>"
													//. "<input class='navButton' id='continueButton' style='padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:45px; float:left;' type='submit' value='Continue to Live Stats' title='Once the splash screen loads, Continue to In-game Stats will bring you to a page that displays information for both teams.  If the game has not started yet, the current page will simply reload.' onClick='window.location.href=document.location.toString() + \"&continue=true\";'>"
													
                                                . "</form>"
                                            . "</td>"
                                        ."</tr>"
                                    ."</table>"
                                    . "<span style='float:right;display:inline-block'><input type='checkbox' id='autofillCounter' onclick='setAutofill();'><span style='color:#EEEEEE;font-size:.72vw;font-weight:normal;vertical-align:top'>Autofill Counterpick</span></span>"
                                    . "</div>"
                                ."</th>"
                            . "</tr>";
                     
                     

                    
                    $tablePlayers .= "<tr>";
                    
                    //$tablePlayers .= "<tr><td><b style='text-align: center'>Summoner</b></td><td><b style='text-align: center'>Champion Stats</b></td></tr>";

                    for ($i = 0; $i < count($namesArray); $i++)
                    {
                        $div = "<td text-align:center' id='tableSlot$i'>";

                        $leagueIcon = getLeagueIcon($leaguesArray[$i]);

                        //$row .= "<td text-align:center'><div style='text-align:center'><b>$namesArray[$i]</b></div><div><img src='$leagueIcon' alt='$leaguesArray[$i]' style='width:90px; text-align:center'></div><div style='text-align:center'>$leaguesArray[$i]</div><div style='text-align:center'><br>$winsArray[$i] Wins</div></td><td><div></div></td><td></td><td>$tableChampsArray[$i]</td>";

                        $div .= "$tableChampsArray[$i]";

                        $div .= "</td>";

                        $tablePlayers .= $div;
                    }

                    $tablePlayers .= "</tr></tbody></table>";

                    
                    //echo "<br>";

                    print_r($tablePlayers);

                    //echo "<br>";
                } else {
                    //Open current_match.php
                    
                    $responseJSON = json_decode($response_body, true);
                    
                    $responseJSON['region'] = $region;
					
					$response_body = json_encode($responseJSON);
                    
                    
                    $responseCurrentMatch = post_web_page("http://www.carry-factor.com/process_current_match.php", $response_body, $region);
                    
                    $responseCurrentMatch_body = $responseCurrentMatch['body'];

                    $responseCurrentMatch_code = $responseCurrentMatch['response_code'];
                    
                    //echo "</pre><br><br>Current Match Response Code: $responseCurrentMatch_code<br><br>";
                    
                    print_r($responseCurrentMatch_body);
                    
                }
                
                $postOutput = json_encode($_POST);
                
                //echo "<pre><div style='text-align: left'><br>Post Data:"; print_r($postOutput); echo "</div></pre>";
                //echo "<pre><div style='text-align: left'><br>Region:"; print_r($_POST['region']); echo "</div></pre>";
                //echo "<pre><div style='text-align: left'><br>Lobby Chat:"; print_r($_POST['lobbychat']); echo "</div></pre>";
                
                //$outputLobbyChat = $_POST['lobbychat'];
                
                //DON'T COMMENT THIS OUT!
                echo "<form id='formPostData' action='results.php' method='post' target='_self' style='visibility: hidden'> <textarea id='postDataLobbyChat'>$outputLobbyChat</textarea><input type='text' value='$region' id='postDataRegion'><input type='submit' value='Do Stuff!' /></form>";

                
        //************ FUNCTIONS ******************

                function get_web_page($url) {
                    //header('Content-Type: text/html; charset=UTF-8');
                    
                    $options = array(
                        CURLOPT_RETURNTRANSFER => true,   // return web page
                        CURLOPT_VERBOSE => true,
                        CURLOPT_HEADER         => true,  // don't return headers
                        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                        CURLOPT_ENCODING       => "UTF-8",     // handle compressed
                        CURLOPT_USERAGENT      => "test", // name of client
                        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                        CURLOPT_TIMEOUT        => 120,    // time-out on response
                    ); 

                    $attempts_left = 3;
                    $try = true;
                    
                    while ($try && $attempts_left > 0)
                    {              
                        
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

                            //var_dump($header);

                            $header_lines = explode("\n", $header);
                            
                            //var_dump($header_lines);

                            $lines_count = count($header_lines);
                            
                            //var_dump($lines_count);
                            
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

                                    //echo "<br>Retrying after $retry_after seconds.<br>";

                                    //echo "<br>The time is " . date("h:i:sa") . "<br>";
                                    
                                    sleep($retry_after);
                                    
                                    //echo "<br>The time is " . date("h:i:sa") . "<br>";
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
				
                
                function post_web_page($url, $data_to_post, $region) {
                    $options = array(
                        CURLOPT_RETURNTRANSFER => true,   // return web page
                        CURLOPT_VERBOSE => true,
                        CURLOPT_HEADER         => true,  // don't return headers
                        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                        CURLOPT_ENCODING       => "",     // handle compressed
                        CURLOPT_USERAGENT      => "test", // name of client
                        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                        CURLOPT_TIMEOUT        => 120,    // time-out on response
                    ); 

                    $attempts_left = 3;
                    $try = true;
                    
                    while ($try && $attempts_left > 0)
                    {                    
                        $ch = curl_init();
                        curl_setopt_array($ch, $options);
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, ['post' => $data_to_post, 'region' => $region]);
                        

                        $content  = curl_exec($ch);
                        
                        //var_dump($content);

                        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

                        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        $body = substr($content, $header_size);

                        $retry_after = 10;

                        if ($code == 429)
                        {
                            $header = substr($content, 0, $header_size);

                            //echo "<br><br><br>*************************************************ERROR!!!!! GOT CODE 429 HERE!!!!********************************************<br><br><br>";
                            //echo "<br><br><br>*** Warning: Server is busy.  If your results do not show completely, please try again in 10 seconds.  ***<br><br><br>";               

                            //var_dump($header);

                            $header_lines = explode("\n", $header);
                            
                            //var_dump($header_lines);

                            $lines_count = count($header_lines);
                            
                            //var_dump($lines_count);
                            
                            $find = "Retry-After: ";         
                            
                            //var_dump($find);

                            for ($z = 0; $z < $lines_count; $z++)
                            {
                                //echo "<br>Line:<br>";
                                //var_dump($header_lines[$z]);
                                    
                                $position = strpos($header_lines[$z], $find);

                                
                                //Check if header line contains 'Retry-After: '
                                if ( $position !== false && $position !== NULL && $position != -1)
                                {
                                    
                                    //Set Retry
                                    $retry_after = (int)substr($header_lines[$z], $position + strlen($find));

                                    //echo "<br>Retrying after $retry_after seconds.<br>";

                                    //echo "<br>The time is " . date("h:i:sa") . "<br>";
                                    
                                    sleep($retry_after);
                                    
                                    //echo "<br>The time is " . date("h:i:sa") . "<br>";
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
                    
                    //var_dump($output_array);
                    
                    curl_close($ch);

                    return $output_array;        
                }

                function build_sorter($key) {
                    return function ($a, $b) use ($key) {
                        //return strnatcmp($a[$key], $b[$key]);
                        return ($a['totalSessionsPlayed'] < $b['totalSessionsPlayed'] ? 1 : -1);
                    };
                }
                
                function round0($input) {
                    return round($input, 0, PHP_ROUND_HALF_UP);
                }
                function round1($input) {
                    return round($input, 1, PHP_ROUND_HALF_UP);
                }
                function round2($input) {
                    return round($input, 2, PHP_ROUND_HALF_UP);
                }
                
                function getChampPortrait($champName)
                {
					if ($champName == 'blank') {
						return "champicons/blank_square_0.png";
					}
					
					global $patchFull;
					
                    $champPath = "datadragon/$patchFull/img/champion/";
                    					
                    $champImg = $champName;
					
					if ($champImg == "FiddleSticks") {
						$champImg = "Fiddlesticks";
					}

                    $champImg = str_replace(" ", "", $champImg);
                    $champImg = str_replace("'", "", $champImg);
                    $champImg = str_replace(".", "", $champImg);
                    $champImg .= ".png";
					
					$champImg = $champPath . $champImg;
										
                    return $champImg;

                }
                
                function getLeagueIcon($leagueName)
                {
					if ($leagueName == null) {
						return "rankicons/blank.png";
					} else {
						return "rankicons/" . str_replace(" ", "_", strtolower($leagueName)) . ".png";
					}
                }
                
                function getChampName($champ_id)
                {
                    $champName = "";
                    
					//Retrieve Champ Name from my own static JSON, because retrieving it from DataDragon is slow.  (7 sec vs 25 sec in this case)
                    $url = "./data/champsList.json";
                    $response = json_decode(read_file($url)['body'], true)['data'];

					$champName = $response[$champ_id]['key'];    
                    
                    
                    return $champName;
                }
                
                function _bot_detected() {

                    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
                      return TRUE;
                    }
                    else {
                      return FALSE;
                    }

                }
                
				// Class to run parallel GET requests and return the transfer
				class ParallelGet
				{
					public $output = "Empty Output.";
					public $test = "Hello, I'm a variable in the Class scope!";
					
				  function __construct($urls)
				  {
					// Create get requests for each URL
					$mh = curl_multi_init();
					foreach($urls as $i => $url)
					{
					  $ch[$i] = curl_init($url);
					  curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
					  curl_setopt($ch[$i], CURLOPT_TIMEOUT, 120);
					  curl_multi_add_handle($mh, $ch[$i]);
					}

					// Start performing the request
					do {
						$execReturnValue = curl_multi_exec($mh, $runningHandles);
					} while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);
					// Loop and continue processing the request
					while ($runningHandles && $execReturnValue == CURLM_OK) {
					  // Wait forever for network
					  $numberReady = curl_multi_select($mh);
					  if ($numberReady != -1) {
						// Pull in any new data, or at least handle timeouts
						do {
						  $execReturnValue = curl_multi_exec($mh, $runningHandles);
						} while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);
					  }
					}

					// Check for any errors
					if ($execReturnValue != CURLM_OK) {
					  trigger_error("Curl multi read error $execReturnValue\n", E_USER_WARNING);
					}

					// Extract the content
					foreach($urls as $i => $url)
					{
					  // Check for errors
					  $curlError = curl_error($ch[$i]);
					  if($curlError == "") {
						$res[$i] = curl_multi_getcontent($ch[$i]);
					  } else {
						print "Curl error on handle $i: $curlError\n";
					  }
					  // Remove and close the handle
					  curl_multi_remove_handle($mh, $ch[$i]);
					  curl_close($ch[$i]);
					}
					// Clean up the curl_multi handle
					curl_multi_close($mh);
					
					// Print the response data
					//print_r($res);
					
					//echo "<pre><div style='text-align: left'><br>Res:<br>"; print_r(json_decode($res[0])); echo "</div></pre>";
					
					$this->output = $res;

					
					//return $res;
					
				  }

				  

				}	                

            ?>

		<span style='float:right;display:inline-block'><input type='checkbox' id='useDark' onclick='changeColors();'><span style='font-size:.72vw;font-weight:normal;vertical-align:top'>Dark Color Scheme</span></span>
        </div>
        
        <div style='text-align: center; margin: 0 auto'>Please Copy and Paste the URL (with Summoner Names) in the Lobby Chat!<span title='This supports our Website, and help your team WIN!' class='tooltip'>?</span></div>
        <br>

        <!--<table><tr><td><p>Advertisement.</p></td></tr><tr><td><table border='1'><tr><td><script type="text/javascript" src="//eclkspbn.com/adServe/banners?tid=42108_62839_4"></script></td></tr></table></td></tr></table>-->
        <div style='width: 100%;' class='brown'><table><tr><td><img src="website/diamond_i.png" alt='diamond_i.png'></td><td style='width: 100%; font-size: 36px; text-align: center; color: #FFFFFF'>
                <div id="LeaderboardBottom"  style='box-shadow: 10px 10px 5px rgba(50, 50, 50, .6);width:728px;height:90px;text-align: center; margin: 0 auto' align='center'>
					<button style='float: left;' onclick="this.parentNode.remove();">X</button>
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Bottom Leaderboard Bronzodia -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:728px;height:90px"
                         data-ad-client="ca-pub-6399216573107712"
                         data-ad-slot="7253070786"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>                
            </td><td><img src="website/diamond_i.png" alt='diamond_i.png' style="filter: fliph"></td></tr></table></div>
        <table style='text-align: center' align='center'><tr><td><a href='aboutus.html'>About us</a></td><td><a href="contact.html">Contact</a></td><td><a href="privacy_policy.html">Privacy Policy</a></td><td><a href="terms_of_use.html">Terms of Use</a></td><td><a href="credits.html">Credits</a></td><td><a href="https://www.reddit.com/user/NovaDisk1/">Reddit</a></td></tr></table>

		
		
        <script>
            enableContinueToGameStats();
            
            function enableContinueToGameStats() {
                var postDataLobbyChat = document.getElementById('postDataLobbyChat').value;
                var postDataRegion = document.getElementById('postDataRegion').value;
                
                //var postDataContinueForm = document.getElementById('postDataContinueForm');
                var postDataContinueTextArea = document.getElementById('postDataContinueTextArea');
                var postDataContinueRegion = document.getElementById('postDataContinueRegion');
                
                postDataContinueTextArea.value = postDataLobbyChat;
                postDataContinueRegion.value = postDataRegion;
                
                //postDataContinueForm.innerHTML = 'Loading...';
                //postDataContinueForm.disabled = true;
            }
        </script>
        
        <script src="ads.js"></script>
        <script>
			//alert("Before Checking");
			addWall();
			
			console.log(getUrlParameter("region"));
		
		/*
            if( window.canRunAds === undefined ){

				for (var i = 0; i < 3; i++)
					{
						//I should probably make an image so it's not filtered out.
						var div = document.createElement("div");
						//div.setAttribute("class", "democlass"); 
						//div.setAttribute("class", "democlass"); 
						
						var opacity = Math.random() * .06 + .92;
						
						//Random digits.
						var int1 = Math.floor((Math.random() * 10)); 
						var int2 = Math.floor((Math.random() * 10)); 
						var int3 = Math.floor((Math.random() * 10)); 
						
						var bgColor = "#0" + int1 + "0" + int2 + "0" + int3;
						var textColor = "#F" + int1 + "0" + int2 + "0" + int3;
						
						var widthShield = "80.0" + int1 + "vw";
						var heightShield = "100.0" + int2 + "vw";
						var leftShield = "10.0" + int2 + "vw";
						var topShield = "12.0" + int2 + "vw";
						
						//var styleShield = "background-color: " + bgColor + "; opacity: " + opacity + "; color: red; width: " + widthShield + "; height: " + heightShield + "; position: absolute; left: " + leftShield + "; top: " + topShield + "; text-align: center;";
						
						//alert (styleShield);
						
						div.setAttribute("style", "background-color: " + bgColor + "; opacity: " + opacity + "; color: red; width: " + widthShield + "; height: " + heightShield + "; position: absolute; left: " + leftShield + "; top: " + topShield + "; text-align: center;"); 

						
						var para = document.createElement("h2");
						div.appendChild(para);
						var t = document.createTextNode("\"Question Mark?\"");
						para.appendChild(t);			
						
						var para = document.createElement("h3");
						div.appendChild(para);
						var t = document.createTextNode("AdBlock is ON!");
						para.appendChild(t);
						
						var para = document.createElement("p");
						div.appendChild(para);

						var t = document.createTextNode("We can't help you Carry with Knowledge without paying for the cost of the server!  Please disable AdBlock, then Refresh the page."
							+ "<\\n\\nNOTE:  We understand your concerns of computer security with regards to ads.  This is why we only use ads from the Google Adsense network."
							+ "<br> Many of our competitors will circumvent adblock by serving ads from less reputable sources (Taboola etc)."
							+ "<br> If you find one of our ads dangerous, offensive, or overly annoying, please send us the URL, and we will block it and report it to Google."
							+ "<br> Addionally, you can use AdChoices (Triangle in upper-right corner of ad pane) to configure your ad preferences.");

						var t = document.createTextNode("We can't help you Carry with Knowledge without paying for the cost of the server!  Please disable AdBlock, then Refresh the page.");
						
						para.appendChild(t);
						
						
						
						
						var img = document.createElement("img");
						img.setAttribute("src", "website/bronze_v.png"); 
						img.setAttribute("height", "1200"); 
						div.appendChild(img);
						//var t = document.createTextNode("Please help me continue to dispense Justice by paying for the cost of the server!  Please disable AdBlock, then Refresh the page.");
						para.appendChild(t);

						document.body.appendChild(div);
					}
						 
    
    
    
    
            }*/
			
            
        </script>
        <script>
            

            
            function getStats(i, id, region) {
                
                
                var champ = document.getElementById("champName" + i).value;
        
                //alert(i + ', ' + id + ", " + champ + ", " + region);
                
                
                var url = '/champStatsXmlHttp.php';
                
                var xmlhttp = new XMLHttpRequest();
                
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4) {
                    } else {
                        return;
                    }
                    

					
					console.log("Ready State: " + xmlhttp.readyState);
					
                    var stats = JSON.parse(xmlhttp.responseText);
					
					
                   
                    //document.getElementById("id01").innerHTML = JSON.stringify(stats);
                    
                    //updateStats(stats);
                    
                    document.getElementById('games' + i).innerHTML = stats.games;
                    //document.getElementById('avgScore' + i).innerHTML = stats.avgScore;
                    document.getElementById('kda' + i).innerHTML = stats.kda;
                    document.getElementById('winPct' + i).innerHTML = stats.winPct;
                    
                    $.fn.gotof(i, -1);
                    
                };
                var params = "id=" + id + "&champ=" + champ + "&region=" + region;
                
                url += "?" + params;
                
                //alert(url);
                
                xmlhttp.open("GET", url, false);
                
                //alert("Opened.");
                
                xmlhttp.send(null);
                
                //alert("xmlHTTP Sent.");
                
                if (document.getElementById('autofillCounter').checked) {
                    getRolesFromResultsPage(i, champ);
                }                
                
            }
            
            function selectStats(champ, j, region, id) {
                //alert(champ);
                
                //alert(j);
                document.getElementById("champName" + j).value = champ;
                
                
                getStats(j, id, region);

            }
        
        </script>
        
        <script>
            $(document).ready(function(){

               
               $('#continueButton').click(function(){
                   $(this).prop("value", 'Loading...');
                   //$(this).prop("disabled", true);
                   
               });
               
               
               
               if (getUrlParameter('scout') == 'true') {
                    
                   
                    var playerList = getUrlParameter('playerNames').split(',');
                    var champNamesList = getUrlParameter('champNames').split(',');
                    
                    for (var i = 0; i < playerList.length; i++) {
                        //alert("Scouting..." + playerList[i] + " playing " + champNamesList[i]);
                        if (champNamesList[i] != null) {
                            document.getElementById('champName' + i).value = champNamesList[i];
                            
                            document.getElementById('champName' + i).onchange();
                        }
            
                        
                    
                    }
                }
				
				
					/*
					var src;
					$("iframe").each(function() { 
						var src= $(this).attr('src');
						$(this).attr('src',src);  
					});	
					alert(src);*/				
				
				//STOP TALKING ADS!
				//Need to block ALL iframes that contain the string 'ads by' (Flash ads logo), or 'video'.
				//setInterval(myFunction, 5000);
                
            });
			
			function myFunction() {
				
				var element = document.getElementById('LeaderboardBottom');
				
				if(window.Prototype) {
					delete Object.prototype.toJSON;
					delete Array.prototype.toJSON;
					delete Hash.prototype.toJSON;
					delete String.prototype.toJSON;
				}				
				
				console.log(JSON.stringify(element));
				
				$.each($('audio'), function () {
					console.log("Audio Paused.");
					this.pause();
				});		
/*				
				$('#audio_id').AudioPlayerV1('pause');
				
				$.each($('audio'), function () {
					$(this).AudioPlayerV1('pause');
				});
*/				
				//alert("Hello myFunction!");
					var srcTest;
					
					//var srcTest = "hello";
					$("iframe").each(function() { 
						//srcTest += "\n" + $(this).attr('src');
						srcTest += "\n" + $(this);

						
						
						//This is the Body of the Ad Element.
						var obj = $(this).contents().context.contentDocument.documentElement.childNodes[1];
						
						
						/*
						console.log("Stringified Object:");
						console.log(JSON.stringify(obj, null, 4));
						
						console.log("To Source:");
						console.log(obj.toSource());
						
						console.log("Object:");
						console.log(obj);
						*/
						
						//alert(JSON.stringify($(this).contents().context.contentDocument.documentElement.childNodes[1], null, 2));
						//console.log($(this).contents().context.contentDocument.documentElement.childNodes[1]);
						//console.log($(this).contents().context.contentDocument.documentElement.childNodes[1].getElementsByTagName['iframe'].childNodes[0].childNodes[0].getElementsByTagName['body']);
						//console.log($(this).contents().context.contentDocument.documentElement.childNodes[1].getElementsByTagName['iframe'].length);
						//console.log($(this).contents().context.contentDocument.documentElement.childNodes[1].childNodes);

						var node = $(this).contents().context.contentDocument.documentElement.childNodes[1];
						
						/*
						console.log(findNode('videoaaa', node));
						
						
						function findNode(id, currentNode) {
							var ii,
								currentChild,
								result;

							if (currentNode.innerHTML.indexOf(id) != -1 || searchAttributes(id, currentNode)) {
								return currentNode;
							} else {

								// Use a for loop instead of forEach to avoid nested functions
								// Otherwise "return" will not work properly
								
								for (ii = 0; ii < currentNode.children.length; ii += 1) {
									currentChild = currentNode.children[ii];
									
									console.log(currentChild);

									// Search in the current child
									result = findNode(id, currentChild);

									// Return the result if the node has been found
									if (result !== false) {
										return result;
									}
								}
								

								// The node has not been found and we have no more options
								return false;
							}
						}						
						
						function searchAttributes(searchString, myNode) {
							for (var jj = 0; jj < myNode.attributes.length; jj++) {
								//console.log(myNode.attributes[jj].nodeValue);
								if (myNode.attributes[jj].nodeValue.toLowerCase().indexOf(searchString.toLowerCase()) != -1) {
									return true;
								}
							}
							
							return false;
						}*/
						
						//Working code that searches for Element IDs.
						
						console.log(findNode('aniplayer', node));
						$.each($(this).contents().find("*"), function(){
							//$.each()
							//console.log($(this));
							
						});
						
						function findNode(id, currentNode) {
							var ii,
								currentChild,
								result;

							if (id == currentNode.id) {
								return currentNode;
							} else {

								// Use a for loop instead of forEach to avoid nested functions
								// Otherwise "return" will not work properly
								if (currentNode !== null && currentNode.children !== null) {
									for (ii = 0; ii < currentNode.children.length; ii += 1) {
										currentChild = currentNode.children[ii];

										// Search in the current child
										result = findNode(id, currentChild);

										// Return the result if the node has been found
										if (result !== false) {
											return result;
										}
									}
								}

								// The node has not been found and we have no more options
								return false;
							}
						}
						
						
						//$(this).attr('src',srcTest);  
					});	
					//console.log(srcTest);
			}
            
            $.fn.gotof = function(i, j) {
                //alert("I am calling form jquery. Var: " + i);
                
                
                if (j >= 0) {
                    $('#divPlayer' + i).animate({opacity: '0'}, 10);
                    $('#divPlayer' + i).animate({opacity: '1'}, "fast");

                    $('#divPlayer' + j).animate({opacity: '0'}, 10);
                    $('#divPlayer' + j).animate({opacity: '1'}, "fast");
                } else
                {
                    //alert(j);
                    //var block = $(e.target);

                    var block = $('#selectContainer' + i);

                    //var color = $.Color(block.css('backgroundColor'));
                    var color = $.Color('#DDDDDD');
                    
                        block.animate({backgroundColor: '#3366CC'}, 50, function() {
                        block.animate({backgroundColor: color}, 300);
                    });
                    
                    //$('#games' + i).animate({opacity: '0'}, 10);
                   // $('#games' + i).animate({opacity: '1'}, "fast");
                    
                    $('#avgScore' + i).animate({opacity: '0'}, 10);
                    $('#avgScore' + i).animate({opacity: '1'}, "fast");

                    $('#kda' + i).animate({opacity: '0'}, 10);
                    $('#kda' + i).animate({opacity: '1'}, "fast");
                    
                    $('#winPct' + i).animate({opacity: '0'}, 10);
                    $('#winPct' + i).animate({opacity: '1'}, "fast");

                }
            };
            
            function swapFarLeft(i, j) {
                var playerOldSlot = document.getElementById('tablePlayer' + i);
                var playerFarLeft = document.getElementById('tablePlayer0');
                
                var tempPlayerData = playerFarLeft.innerHTML;
                
                playerFarLeft.innerHTML = playerOldSlot.innerHTML;
                playerOldSlot.innerHTML = tempPlayerData;
                
                swapNamesUrl(i, 0);
                
                $.fn.gotof(i, 0);


            }
            
            function swapFarRight(i, j) {
                var playerOldSlot = document.getElementById('tablePlayer' + i);
                var playerFarRight = document.getElementById('tablePlayer' + j);

                var tempPlayerData = playerFarRight.innerHTML;

                playerFarRight.innerHTML = playerOldSlot.innerHTML;
                playerOldSlot.innerHTML = tempPlayerData;   
                
                swapNamesUrl(i, j);
                
                $.fn.gotof(i, j);
            }
            
            function swapLeft(i, j) {
                
                var k = i - 1;
                
                if (i === 0) { return; }

                var playerOldSlot = document.getElementById('tablePlayer' + i);
                var playerLeft = document.getElementById('tablePlayer' + k);

                var tempPlayerData = playerLeft.innerHTML;

                playerLeft.innerHTML = playerOldSlot.innerHTML;
                playerOldSlot.innerHTML = tempPlayerData;

                swapNamesUrl(i, k);
                
                $.fn.gotof(i, k);
            }
            
            function swapRight(i, j) {
                
                //alert("Swapping Right");
                
                var k = i + 1;
                
                if (i === j) { return; }

                var playerOldSlot = document.getElementById('tablePlayer' + i);
                var playerRight = document.getElementById('tablePlayer' + k);

                var tempPlayerData = playerRight.innerHTML;

                playerRight.innerHTML = playerOldSlot.innerHTML;
                playerOldSlot.innerHTML = tempPlayerData;

                swapNamesUrl(i, k);
                
                $.fn.gotof(i, k);
            }
            
            function swapNamesUrl(i, j) {
                //var playerNames = (document.location.toString().substring(document.location.toString().indexOf("playerNames=")).split('=')[1]).split('%2C');
                
                //alert(getUrlParameter('playerNames').split(',').length);
                
                var playerNames = getUrlParameter('playerNames').split(',');
                
                //alert(playerNames);
                
                var playerTemp = playerNames[i];
                playerNames[i] = playerNames[j];
                playerNames[j] = playerTemp;

                var url = document.location.toString().substring(0, document.location.toString().indexOf("playerNames=")) + ('playerNames=');
                
                for (var k = 0; k < playerNames.length; k++) {
                    url += playerNames[k];
                    
                    if (k < playerNames.length - 1) {
                        url += '%2C';
                    }
                }

                window.history.pushState({"html":'response.html',"pageTitle":'response.pageTitle'},"", url);
                
            }
            
        
        </script>
        <script>
            function scoutOpponents(region) {
                //var playerNames = (document.location.toString().substring(document.location.toString().indexOf("playerNames=")).split('=')[1]).split('%2C');
                
                //alert("Hello");
                
                var playerNames = getUrlParameter('playerNames').split(',');
                
                //alert(playerNames);
                
                var team = 0;
                
                for (var i = 0; i < 10; i++)
                {
                    var player = document.getElementById('nameContainer' + i).innerHTML;
                                        
                    for (var j = 0; j < playerNames.length; j++) {
                        
                        //alert('playerNames[j]: ' + playerNames[j].toLowerCase() + '\nplayer: ' + player.toLowerCase() + '\nEqual: ' + String(playerNames[j].toLowerCase() == player.toLowerCase()).valueOf() );
                        
                        if (playerNames[j].toLowerCase() == player.toLowerCase()) {
                            //team = player + "," + playerNames[j];
                            team = i;
                            
                        }
                    }
                }
                
                team = Math.floor(team / 5);
                
                //alert('Team: ' + team);
                

                
                if (team == 0) {
                    team = 1;
                } else {
                    team = 0;
                }

                //alert('Team: ' + team);

                
                var playerNamesNew = "playerNames=";
                
                var champNamesNew = "champNames=";
                
                for (var i = team * 5; i < 5 + team * 5; i++)
                {
                    var player = document.getElementById('nameContainer' + i).childNodes[0].innerHTML;
                    player = player.replace(/\s+/g, '');
                    
                    var champ = document.getElementById('champNameContainer' + i).innerHTML;

                    playerNamesNew += player;
                    champNamesNew += champ;

                    if (i < 4 + team * 5) {                    
                        playerNamesNew += "%2C";
                        champNamesNew += "%2C";
                    }
                }
                
                //Need to add Region.
                
                var url = "/results.php?" + "region=" + region + "&scout=true" + "&" + playerNamesNew + "&" + champNamesNew;


                //alert("Coming soon!\nTeam: " + playerNamesNew + "\nChamps: " + champNamesNew);
                //alert("Url: " + url);
                
                var win = window.open(url, '_blank');
                win.focus();
            } 
        
        </script>
        <script>
        var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : sParameterName[1];
                    }
                }
            };
        </script>
        
        <script>
        var setUrlParameter = function setUrlParameter(sParam, newParam) {
                var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i,
                    newUrl = "";

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {                        
                        newUrl += sParameterName[0] + '=' + newParam;
                    } else {
                        newUrl += sURLVariables[i];
                    }
                    
                    if (i + 1 < sURLVariables.length) {
                        newUrl += "&";
                    }
                }
                
                return newUrl;
                
            };
        </script>
        
        <script>
            function addPlayersDialog() {

                //alert(setUrlParameter('playerNames','Hello'));
                
                iframeAddPlayers = document.getElementById('iframe_addPlayers');
                
                if (iframeAddPlayers.style.visibility === 'hidden') {
                    iframeAddPlayers.style.visibility = 'visible';
                    
                    var iframeDoc = iframeAddPlayers.contentDocument || iframeAddPlayers.contentWindow.document;
                    
                    iframeDoc.getElementById('playersList').value = getUrlParameter('playerNames');                    
                } else {
                    iframeAddPlayers.style.visibility = 'hidden';
                }
            }
            
            function editPlayersIframe() {
                var iframeDoc = iframeAddPlayers.contentDocument || iframeAddPlayers.contentWindow.document;
                var playerListIframe = iframeDoc.getElementById('playersList');
                var newPlayerList = playerListIframe.value.replace(/\s+/g, '');;
                
                iframeDoc.getElementById('buttonEditPlayers').innerHTML = "Loading...";

                window.location.href = "results.php?" + setUrlParameter('playerNames', newPlayerList);
            }
            
            function rePasteLobbyChat() {
                var iframeDoc = iframeAddPlayers.contentDocument || iframeAddPlayers.contentWindow.document;
                var newLobbyChatIframe = iframeDoc.getElementById('newLobbyChat');
                var newPlayerList2 = findPlayerNames(newLobbyChatIframe.value);
                
                iframeDoc.getElementById('buttonRePasteLobbyChat').innerHTML = "Loading...";

                window.location.href = "results.php?" + setUrlParameter('playerNames', newPlayerList2);
            }
        </script>
        
        <script>
            function reloadPage() {
                //alert('Attempting reload...');
                //window.location.href = window.location.href;
                window.location.reload();
                
            };
        
        </script>
        
        <!--<script src="sharedFunctions.js"></script>-->
        
        <script>
            function findPlayerNames(chat) {
                var lobbyChatLines = chat.split(/\r?\n/);

                var playersList = [];

                for (i = 0; i < lobbyChatLines.length; i++) {
                      if (lobbyChatLines[i].indexOf('You are now in a chat room with your full champion select team.') > -1) {


                      } else if (lobbyChatLines[i].indexOf("A player did not lock in their pick or ban. Your group was returned to matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf("A player didn't accept the AFK check. Your group was returned to matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf("did not accept the AFK check. Your group was removed from matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf("cancelled matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf('A player left champ select. Your group was returned to matchmaking.') > -1) {


                      } else if (lobbyChatLines[i].indexOf('You are now back in a chat room with just your premade.') > -1) {


                      } else if (lobbyChatLines[i].indexOf(':') > 0) {
                          var name = lobbyChatLines[i].split(':')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' joined the room.') > 0) {

                          var name = lobbyChatLines[i].split(' joined the room.')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' joined the lobby') > 0) {

                          var name = lobbyChatLines[i].split(' joined the lobby')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' a rejoint le salon') > 0) {

                          var name = lobbyChatLines[i].split(' a rejoint le salon')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' se unió a la sala') > 0) {
							//Spanish
                          var name = lobbyChatLines[i].split(' se unió a la sala')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' entrou no saguão') > 0) {
							//Spanish
                          var name = lobbyChatLines[i].split(' entrou no saguão')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' присоединился к лобби') > 0) {
							//Spanish
                          var name = lobbyChatLines[i].split(' присоединился к лобби')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' everek lobiye katıldı') > 0) {
							//Spanish
                          var name = lobbyChatLines[i].split(' everek lobiye katıldı')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' がロビーに参加しました') > 0) {
							//Spanish
                          var name = lobbyChatLines[i].split(' がロビーに参加しました')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].replace(/\s/g, '').length > 1){
                          var name = lobbyChatLines[i].replace(/\s/g, '');
                          //alert(name);
                          /*if (name.toUpperCase() === "LIQUIDHANDSOAP")
                          {
                              alert(name);
                          }*/

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });                       

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);
                          }                        
                          //playersList.push(name);
                      }

              }

              var params = '';

              for (i = 0; i < playersList.length; i++) {

                    params += playersList[i];


                    if (i < playersList.length - 1) {
                        params +=',';
                    } else {

                    }

              }

              return params;               

            };      

			
			function openResultsWindow() {
				



				var formHidden = document.getElementById('formhidden');
				var regionHidden = document.getElementById('region');
				var scoutHidden = document.getElementById('scoutHidden');
				//var lobbyChatHidden = document.getElementById('lobbychat');
				var playerNamesHidden = document.getElementById('playerNames')

				var lobbyChat = document.getElementById('lobbychatvisible').value;

				//alert("Values assigned.");

				regionHidden.value = document.getElementById('regionvisible').value;
				//scoutHidden.checked = document.getElementById('scoutVisible').checked;




				playerNamesHidden.value = findPlayerNames(lobbyChat);


				//alert("Action, method, and target assigned.");

				formHidden.submit();

				document.getElementById('buttonvisible').innerHTML = "Loading...";				
				
				
				//alert(innerDoc.getElementById('buttonRePasteLobbyChat'));
				
			}
        
        </script>
        
        <script>
            function setAutofill() {
                var autoFill = document.getElementById('autofillCounter');
                
                document.cookie =  "autofillCounter=" + autoFill.checked + "; expires=Thu, 18 Dec 2020 12:00:00 UTC;";

            }
            
            function getCookie(cookieLoad) {
                //alert(cookieLoad);
                
                var cookieLength = cookieLoad.length + 1;
                
                var cookieString;
                
                if (document.cookie !== null && document.cookie.indexOf(cookieLoad) > -1)
                {
                    var afterCookie = document.cookie.substr(document.cookie.indexOf(cookieLoad + "=") + cookieLength);                    

                    //alert (afterCookie);
                    if (afterCookie.indexOf(";") > -1) {
                        cookieString = afterCookie.substr(0,afterCookie.indexOf(';'));
                        //alert ('afterCookie: ' + afterCookie + '\nif cookieString: ' + cookieString);
                    } else {
                        cookieString = afterCookie;
                        //alert ('afterRegion: ' + afterRegion + '\nelse cookieString: ' + cookieString);
                    }
                }
                
                return cookieString;
                
            }
            
            document.getElementById('autofillCounter').checked = getCookie('autofillCounter') !== undefined ? JSON.parse(getCookie('autofillCounter')) : true;

                        
        </script>
        
        <script>
            function changeColors() {
                document.cookie = "darkScheme=" + document.getElementById('useDark').checked + "; expires=Thu, 18 Dec 2020 12:00:00 UTC;";
                
                if (document.getElementById('useDark').checked) {
                    document.getElementById('dark-styles').disabled = false;
                    document.getElementById('light-styles').disabled = true;
                } else {
                    document.getElementById('dark-styles').disabled = true;
                    document.getElementById('light-styles').disabled = false;
                }
            }
            
            if (getCookie('darkScheme') == 'true') {
                document.getElementById('useDark').checked = true;
                document.getElementById('dark-styles').disabled = false;
                document.getElementById('light-styles').disabled = true;
            } else {
                document.getElementById('useDark').checked = false;
                document.getElementById('dark-styles').disabled = true;
                document.getElementById('light-styles').disabled = false;
            }
		
     
        
        </script>

    
        
    </body>
</html>