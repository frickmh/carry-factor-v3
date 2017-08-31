<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

    <head>
        <title>Carry-Factor.com - LoL Stats Command Center.  Stats, Counterpicks, and Cooldowns</title>
        <link rel="shortcut icon" href="website/diamond_i_favicon.png">
        <meta content="LoL Stats Command Center.  Scout your opponents and punish their weakest link.  Dynamic Counterpick tool." name='description'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Pre-game Lobby Stats for League of Legends">
        <meta name="keywords" content="pre-game lobby stats, League of Legends, Champion Select, Statistics, Summoner info, Bronzodia, Bronzodia.com, stats, lol, bronzodia, carry-factor, carry factor, counterpick, counterpicks, counter power, educational, learning, tutorial, coaching, jungling, carrying, pressure ">

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

            img.center {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
            }

            .center {
                margin-left: auto;
                margin-right: auto;
                width: 115em;
            }
            
            .current_match table, .current_match td, .current_match tr {
                //border: 1px solid #BBBBBB;
                font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
                //font-size:.8vw;
            }
            
            tr.currentMatchPlayer:hover {
                opacity: .9;
            }
            
            tr.currentMatchPlayer:active {
                opacity: .9;
            }
            
			.placeholder {

				width: 1290px;
				height: 74px;
				
			}		

			.matchupWinRate {
				font-weight: bold;
			}

			
			.counterPower {
				font-weight: bold;
				color: blue;
			}
			
			 .counterPower[data*="-"] { color: red; }
			 
			
            
        </style>
    </head>
    <body>
		<script src = "src/jquery/jquery-2.2.4.min.js"></script>
		<!--<script src = "src/jquery/jquery-sortable.js"></script-->
		<script src = "src/jquery/jquery-ui.min.js"></script>
	
        <div id="main_content_div" align="center">
        <div></div>
		
        <table><tr><td>
                    
        <!--
        <div id='skyscraperContainer' style='height:600px; width: 160px;margin-right: 50px; background-color: #CFDFFF' class='shadow'>
        -->
            

            <!-- Garen Skyscraper 1 -->
            <!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-6399216573107712"
                 data-ad-slot="1928757185"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>-->
            
            
            <!-- Bronzodia Portrait 1 -->
            <!--
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:1050px"
                 data-ad-client="ca-pub-6399216573107712"
                 data-ad-slot="6422659989"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>-->
        
		
		
        <!-- Bronzodia In-Game Wide Skyscraper 160x600 -->
        
		
        <div id='skyscraperContainer' style='height:600px; width: 160px;margin-right: 50px; background-color: #CFDFFF'>			
			<button style='float: left;' onclick="this.parentNode.remove();">X</button>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<ins class="adsbygoogle"
				 style="display:inline-block;width:160px;height:600px; margin-right: 50px;"
				 data-ad-client="ca-pub-6399216573107712"
				 data-ad-slot="1622310788"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>			
        </div>
        
                    
                    </td><td>
        
        

		
        <h2 style="text-align: center;" align="center">Current Match Statistics</h2>
        

                <iframe name="iframe_showMasteries" class='shadow_round' id='iframe_showMasteries' src="black_screen.html" width="841" height='480' style='background-color: #222222; position: absolute; right: 24%; top: 55%; visibility: hidden;'></iframe>
                <button style='font-size: 150%'  id='iframe_closeButton' onclick="hideMasteries()" style='background-color: #888888; visibility: hidden;' class='xbutton'>X</button>
                
                
                
                <script>
                    function showMasteries(player)
                    {
                        
                        var formMasteries = document.getElementById('formMasteries');                

                        var playerNumber = document.getElementById('playerNumber');

                        playerNumber.value = player;

                        formMasteries.submit();
                        
                        var iframeMasteries = document.getElementById('iframe_showMasteries');
                        iframeMasteries.style.visibility = 'visible';
                        
                        var iframe_closeButton = document.getElementById('iframe_closeButton');
                        iframe_closeButton.style.visibility = 'visible';

                    }
                    
                    function hideMasteries()
                    {
                        var iframeMasteries = document.getElementById('iframe_showMasteries');
                        iframeMasteries.style.visibility = 'hidden';
                        
                        var iframe_closeButton = document.getElementById('iframe_closeButton');
                        iframe_closeButton.style.visibility = 'hidden';
                    }
                    
                    function openResultsWindow() {              
                      

                      var region = document.getElementById('regionvisible').value;


                      var formHidden = document.getElementById('formhidden');
                      var regionHidden = document.getElementById('region');
                      var playerNamesHidden = document.getElementById('playerNames')

                      var lobbyChat = document.getElementById('lobbychatvisible').value;

                      regionHidden.value = document.getElementById('regionvisible').value;

                      var lobbyChatLines = lobbyChat.split(/\r?\n/);

                      var playersList = [];

                      for (i = 0; i < lobbyChatLines.length; i++) {
                            if (lobbyChatLines[i].indexOf(':') > 0) {
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


                      playerNamesHidden.value = params;

                      formHidden.submit();

                      document.getElementById('buttonvisible').innerHTML = "Loading...";
                      document.getElementById('buttonvisible').disabled = true;

                    };


                    function setCookies() {
                        alert("Starting to set cookies.");

                        var d = new Date();
                        d.setTime(d.getTime() + (90*24*60*60*1000));
                        var expires = "expires=" + d.toGMTString();

                        var e = document.getElementById("regionvisible");

                        alert("Got e.");

                        document.cookie = "username=" + document.getElementById("userName").value;

                        alert("Username added to cookie.");

                        document.cookie = "region=" + e.options[e.selectedIndex].value;

                        alert("Region added to cookie.");

                        document.cookie = expires;

                        alert("Cookies assigned.");

                        //alert(document.cookie);
                    }

                    // Arguments :
                    //  verb : 'GET'|'POST'
                    //  target : an optional opening target (a name, or "_blank"), defaults to "_self"
                    openNewWindow = function () { //function(verb, url, data, target) {

                      alert("openNewWindow called.");

                      var formHidden = document.getElementById('formhidden');
                      var regionHidden = document.getElementById('region');
                      var lobbyChatHidden = document.getElementById('lobbychat');

                      alert("Values assigned.");

                      regionHidden.value = document.getElementById('regionvisible').value;

                      alert(regionHidden.value);

                      lobbyChatHidden.value = document.getElementById('lobbychatvisible').value;

                      alert(lobbyChatHidden.value);


                      formHidden.submit();

                      alert("Submit attempted.");


                    };

					
                    //alert(document.getElementById('postDataContinuePlayer').value);
                    

                </script>
                <script>
                    function getChampSpells(i, champ, region, cooldown_flat, cooldown_scaling, spell1, spell2, cooldown_SS1, cooldown_SS2) {
                        var url = '/champSpells.php';
						
                
                        var xmlhttpChampSpells = new XMLHttpRequest();
                        
                        
                        xmlhttpChampSpells.onreadystatechange = function() {
                            
                            
                            var spellsRaw = xmlhttpChampSpells.responseText;
                            
                           
                            var spellSlot = document.getElementById('spellSlot');
                            
                            spellSlot.innerHTML = spellsRaw;
                            
                            
                            
                        };

                        xmlhttpChampSpells.open("POST", url, false);
                        
                        xmlhttpChampSpells.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                        xmlhttpChampSpells.send('region=' + region + '&champ=' + champ + '&cooldown_flat=' + cooldown_flat + '&cooldown_scaling=' + cooldown_scaling 
                                + '&spell1=' + spell1 + '&spell2=' + spell2 + '&cooldown_SS1=' + cooldown_SS1 + '&cooldown_SS2=' + cooldown_SS2);
                        
                        
                    }
                </script>
                
                
                <?php
				
				
				//Looks like carry-factor.com
				$server = "$_SERVER[HTTP_HOST]";
                
				
                $getData = filter_input_array(INPUT_POST);
                
                
                
                $postDataJSON = json_decode($getData['post'], true);
                    
                $region = $postDataJSON['region'];
                
				$patchFull = $postDataJSON['patchFull'];
				$patchShort = $postDataJSON['patchShort'];
				
                $globalApiCalls = 0;
                
				if ($patchFull == NULL) {
					$files = scandir("./datadragon");
					
					foreach ($files as $file) {
						if (is_numeric($file[0])) {
							//echo "<br>$file";
							$patchFull = $file;
							//echo "<br>$patchFull";
							$patchNamePieces = explode(".", $patchFull);
							$patchShort = "$patchNamePieces[0].$patchNamePieces[1]";
						}				
					}				
				}
				
                
                $playerMasteriesCount = array();
				$playerMasteriesInsight = array();
                $playerKeystoneMasteries = array();
                $playerKeystoneMasteriesDescription = array();
                getMasteriesCount();
                getKeystoneMastery();

				$url = "datadragon/$patchFull/data/en_US/summoner.json";

                //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx Get Leagues data and Stats xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                //Need to get $idsArray.
                
                
                $idsArray = array();
                $champsArray = array();
                
                foreach ($postDataJSON['participants'] as $player => $data)
                {
                    array_push($idsArray, $data['summonerId']);
                    array_push($champsArray, $data['championId']);
                }
                //echo "<pre><div style='text-align: left'><br>Player IDs:<br>"; print_r($idsArray); echo "</div></pre>";
                //echo "<pre><div style='text-align: left'><br>Champion IDs:<br>"; print_r($champsArray); echo "</div></pre>";

                $idsString = "";
                
                $idCount = 0;
                
                foreach ($idsArray as $key => $id )
                {
                    $idsString .= $id;
                    
                    $idCount = $idCount + 1;
                    
                    if ($idCount < count($idsArray))
                    {
                        $idsString = $idsString . ',';
                    }
                    
                }
                //echo "<pre><div style='text-align: left'><br>IDs String:<br>"; print_r($idsString); echo "</div></pre>";
                
                
                //echo "<pre><div style='text-align: left'><br>Player Leagues:<br>"; print_r($leaguesArray); echo "</div></pre>";echo "<pre><div style='text-align: left'><br>Player Leagues:<br>"; print_r($leaguesArray); echo "</div></pre>";

                $everyoneLeagues = $leaguesArray;
                $everyoneChamps = array();
                $everyoneSeasonWins = array();
                $everyoneSeasonLosses = array();
                $everyoneGamesPlayed = array();
                $everyoneKillsPerGame = array();
                $everyoneDeathsPerGame = array();
                $everyoneAssistsPerGame = array();
                $everyoneKDA = array();
                $everyoneWinPercent = array();
                
                $everyoneRolesString = array();
                $everyoneGamesData = array();

                $everyoneCDR_Flat = array();
                $everyoneCDR_Scaling = array();
                
                $everyone_spell1 = array();
                $everyone_spell2 = array();

                $everyoneSS1_CD_raw = array();
                $everyoneSS2_CD_raw = array();
                
				//Multi Curl:  curl_multi executes simultaneous CURL Requests to save on page loading time.
				
				//$s = microtime(true);
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
				
				
				array_push($urls, "https://$region.api.pvp.net/api/lol/$region/v2.5/league/by-summoner/" . $idsString . "/entry?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"); //20 (League info)
				
				array_push($urls, "http://$server/datadragon/$patchFull/data/en_US/summoner.json"); //21 (summoner spells, global)
				array_push($urls, "http://$server/datadragon/$patchFull/data/en_US/rune.json"); //22 (runes, global)
				array_push($urls, "http://$server/data/champSpells.json"); //23 (champ abilities)
				array_push($urls, "http://$server/data/championgg/allChampRoles.json"); //24 (Champion.gg roles, global)
				array_push($urls, "http://$server/data/championsSummary.json"); //25
				

                
				//echo "<pre><div style='text-align: left'><br>URLs:<br>"; print_r($urls); echo "</div></pre>";
				
				$testArray = Array ("https://na.api.pvp.net/api/lol/na/v1.3/stats/by-summoner/50019204/ranked?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/stats/by-summoner/349795/ranked?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/stats/by-summoner/292926/ranked?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/stats/by-summoner/20204830/ranked?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/stats/by-summoner/25388173/ranked?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/50019204/recent?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/349795/recent?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/292926/recent?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/20204830/recent?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/25388173/recent?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833","https://na.api.pvp.net/api/lol/na/v2.5/league/by-summoner/50019204,349795,292926,20204830,25388173/entry?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833");

				//get_web_page seems to set a curl option that is required for ParallelGet to work.
				get_web_page("http://$server/riot.txt");
				
				$pg = new ParallelGet($urls);
				

				$leaguesJSON = json_decode($pg->output[20], TRUE);
				$summonerSpellsJSON = json_decode($pg->output[21], TRUE);
				$runesJSON = json_decode($pg->output[22], TRUE);
				$champSpellsJSON = json_decode($pg->output[23], TRUE);
				$champRolesGlobal = json_decode($pg->output[24], TRUE);
				$championsSummaryJSON = json_decode($pg->output[25], TRUE);

				//echo "<pre><div style='text-align: left'><br>Runes:<br>"; print_r($runesJSON); echo "</div></pre>";
				
				
                $leaguesArray = array();
                $lpArray = array();
                
                $rankCount = 0;
                $rankAvg = 0;

                //Get the wins and league of each player.
                for($i = 0; $i < count($idsArray); $i++)
                {
                    $rank = ucfirst(strtolower($leaguesJSON[$idsArray[$i]][0]['tier'])) . ' ' . strtoupper($leaguesJSON[$idsArray[$i]][0]['entries'][0]['division']);
                    
                    $rankTemp = 0;
                    
                    switch ($leaguesJSON[$idsArray[$i]][0]['tier']) {
                        case "BRONZE":
                            $rankCount++;
                            break;
                        case "SILVER":
                            $rankAvg += 500;
                            $rankCount++;
                            break;
                        case "GOLD":
                            $rankAvg += 1000;
                            $rankCount++;
                            break;
                        case "PLATINUM":
                            $rankAvg += 1500;
                            $rankCount++;
                            break;
                        case "DIAMOND":
                            $rankAvg += 2000;
                            $rankCount++;
                            break;
                        case "MASTER":
                            $rankAvg += 2500;
                            $rankCount++;
                            break;
                        case "CHALLENGER":
                            $rankAvg += 2500;
                            $rankCount++;
                            break;
                        default:
                            break;
                    }
                    
                    $tier = $leaguesJSON[$idsArray[$i]][0]['tier'];
                    
                    if ($tier == "BRONZE" || $tier == "SILVER" || $tier == "GOLD" || $tier == "PLATINUM" || $tier == "DIAMOND") {
                        switch ($leaguesJSON[$idsArray[$i]][0]['entries'][0]['division']) {
                        case "IV":
                            $rankAvg += 100;
                            break;
                        case "III":
                            $rankAvg += 200;
                            break;
                        case "II":
                            $rankAvg += 300;
                            break;
                        case "I":
                            $rankAvg += 400;
                            break;
                        default:
                            break;
                        }
                    }
                    
                    if ($leaguesJSON[$idsArray[$i]][0]['entries'][0]['leaguePoints'] !== NULL) {
                        $rankAvg += $leaguesJSON[$idsArray[$i]][0]['entries'][0]['leaguePoints'];
                        $rankTemp += $leaguesJSON[$idsArray[$i]][0]['entries'][0]['leaguePoints'];
                    }
                    
                    //echo "$rankTemp, ";

                    $lp = "";
					
					if ($leaguesJSON[$idsArray[$i]][0]['entries'][0]['miniSeries'] !== NULL) {

                        $lp = $leaguesJSON[$idsArray[$i]][0]['entries'][0]['miniSeries']['progress'];

                        $lp = str_replace("W", "<font style='color:green'>&#x2714;</font>&nbsp", $lp);
                        $lp = str_replace("L", "<font style='color:red'>&#x2716;</font>&nbsp", $lp);
                        $lp = str_replace("N", "<font style='color:grey'>&#x2796;</font>&nbsp", $lp);

                    } else {
                        $lp = $leaguesJSON[$idsArray[$i]][0]['entries'][0]['leaguePoints'] . " LP";
                    }


                    if (strlen($rank) < 3)
                    {
                        $rank = "Unranked";
                    }

                    array_push($leaguesArray, $rank);
                    array_push($lpArray, $lp);
                }				
				
				
				

				
                //Get each Summoner's stats
                for ($j = 0; $j < count($idsArray); $j++)
                {
                    if ($idsArray[$j] == NULL)
                    {
                        continue;
                    }

					$statsJSON = json_decode($pg->output[$j], TRUE);
					
					$responseJSON = json_decode($pg->output[$j + 10], TRUE);

                    //Working on getting data from recent games Here.

                    $playerMatchHistory = array();                        

                    $playerGamesData = array();
                    
                    $adcCount = 0;
                    $supCount = 0;
                    $midCount = 0;
                    $topCount = 0;
                    $jungCount = 0;
                    $gamesCount = 0;



                    foreach ($responseJSON['games'] as $key => $data)
                    {
                        if ($data['mapId'] != 11 || $data['gameMode'] <> 'CLASSIC' || $data['gameType'] <> 'MATCHED_GAME' || $data['subType'] == 'BOT') {

                        } else {
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
                            
                            $win = $data['stats']['win'];
                            $kills = $data['stats']['championsKilled'];
                            $deaths = $data['stats']['numDeaths'];
                            $assists = $data['stats']['assists'];
                            $gameDate = date("m-d-Y H:i", $data['createDate']/1000);
                            $champ = getChampName($data['championId']);
                            
                            $gameData = array (
                                "win" => $win,
                                "kills" => $kills,
                                "deaths" => $deaths,
                                "assists" => $assists,
                                "gameDate" => $gameDate,
                                "champ" => $champ,
                            );
                            
                            array_push($playerGamesData, $gameData);
                            


                        }

                    }
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
                    
                    $rolesString = "";
                    
                    foreach ($rolesArray as $roleWorking => $pct) {
                        if ($pct > 0)
                        {                            
                            $rolesString .= "$roleWorking: $pct%<br>";
                        }
                    }
                        
                    //echo "<pre><div style='text-align: left'><br>Stats:<br>"; print_r($statsJSON); echo "</div></pre>";
                    
                    $champStats = NULL;
                    $seasonStats = NULL;
                    
                    foreach ($statsJSON['champions'] as $champId => $data)
                    {
                        //echo "<pre><div style='text-align: left'><br>Champ Data:<br>"; print_r($data); echo "</div></pre>";
                        if ($champsArray[$j] == $data['id'])
                        {
                            $champStats = $data;
                        }
                        if (0 == $data['id'])
                        {
                            $seasonStats = $data;
                        }

                    }
                    
                    //echo "<pre><div style='text-align: left'><br>Champ Stats:<br>"; print_r($champStats); echo "</div></pre>";
                    //echo "<pre><div style='text-align: left'><br>Stats:<br>" print_r($statsJSON); echo "</div></pre>";
                    //echo "<pre><div style='text-align: left'><br>Season Stats:<br>"; print_r($seasonStats); echo "</div></pre>";
                    
                    $champGamesPlayed = $champStats['stats']['totalSessionsPlayed'] === NULL ? 0 : $champStats['stats']['totalSessionsPlayed'];
                    $rankedWins = $seasonStats['stats']['totalSessionsWon'];
                    $rankedLosses = $seasonStats['stats']['totalSessionsLost'];
                    $champAvgKills = round($champStats['stats']['totalChampionKills'] / $champGamesPlayed, 1);
                    $champAvgDeaths = round($champStats['stats']['totalDeathsPerSession'] / $champGamesPlayed, 1);
                    $champAvgAssists = round($champStats['stats']['totalAssists'] / $champGamesPlayed, 1);
                    $champKDA = ($champStats['stats']['totalDeathsPerSession'] == 0) ? ($champGamesPlayed == 0 ? "No Games" : "Perfect") : round(($champStats['stats']['totalChampionKills'] + $champStats['stats']['totalAssists']) / $champStats['stats']['totalDeathsPerSession'], 2);
                    $champWinPct = round(100 * $champStats['stats']['totalSessionsWon'] / $champGamesPlayed, 1);
                    
                    array_push($everyoneGamesPlayed, $champGamesPlayed);
                    array_push($everyoneSeasonWins, $rankedWins);
                    array_push($everyoneSeasonLosses, $rankedLosses);
                    array_push($everyoneKillsPerGame, $champAvgKills);
                    array_push($everyoneDeathsPerGame, $champAvgDeaths);
                    array_push($everyoneAssistsPerGame, $champAvgAssists);
                    array_push($everyoneKDA, $champKDA);
                    array_push($everyoneWinPercent, $champWinPct);
                    
                    array_push($everyoneRolesString, $rolesString);
                    
                    array_push($everyoneGamesData, $playerGamesData);
                }

                //echo "<pre><div style='text-align: left'><br>Ranked Wins:<br>"; print_r($rankedWins); echo "</div></pre>";




                
                //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx Build Table xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                
                
                $tableList = array();
                
                for ($j = 0; $j < 2; $j++)
                {
                    $table = "<table style='border: 1px solid #BBBBBB;' class='shadow_round current_match'>";
                    
					$table .= "<thead><tr class='fields'><th style='width:7.8vw'>Summoner</th><th style='width:4.75vw'>Recent Roles</th><th style='width:9.1vw'>Champion (Games)</th><th style='width:4.2vw' style='text-align:center;'>Rank</th><th style='width:4.2vw' style='text-align:center;'>Carry<br>Factor</th><th style='text-align:center;width:4.2vw;'>Ranked<br>W/L</th><th style='width:5.7vw' style='text-align:center'>KDA</th><th style='text-align:center;'>Win %<br>(Games)</th><th style='width:10.4vw'>Runes</th><th>Masteries</th><th>Cooldowns<br>(Testing)</th><th>Insight</th><th>Counter<br> Power<span class='tooltip' title=\"Winrates for Plat+.\n  - The Black Value is the overall win % for this champion in this matchup.\n  - The number in '( )' is the Counter Power.\n  - Counter power is the % difference between the average of the two champion win percents, and the matchup win %.\n  - Positive (Blue) values indicate this champion is statistically favored against their lane matchup.\n  - Negative (Red) values indicate their lane opponent is statistically favored in this matchup.\n  - Matchups must have 100+ games in Plat+ to be shown.\">?</span></th></tr></thead>";
					
                    $table .= "<tbody class='current_match_tbody' id='current_match_team_$j'>";
                    
					
					$tableRowsPlayers = array();
					$champNamesList = array();
					
                    for ($i = 0; $i < 5; $i++)
                    {
                        $k = $i + 5 * $j;

                        //Get data for recent roles here.

                        $recentWins = "<table style='border-collapse: collapse;'><tr>";
                        
                        $carry = 0;
                        
                        $carryString = "";
                        
                        $delta = 0;
                        $streak = 0;
                        
						$tableRow = "";
						
						//Calculate recent games and display results
                        $winRate = $everyoneSeasonWins[$k]/ ($everyoneSeasonLosses[$k] + $everyoneSeasonWins[$k]);
                        
                        $count = count($everyoneGamesData[$k]);
                                                
                        for ($l = 0; $l < count($everyoneGamesData[$k]); $l++) {
                            //echo "<pre><div style='text-align: left'><br>Post Data:<br>"; print_r($everyoneGamesData[$k][$i]['win']); echo "</div></pre>";
                            
                            
                            
                            $kills = $everyoneGamesData[$k][$l]['kills'] != NULL ? $everyoneGamesData[$k][$l]['kills'] : 0;
                            $deaths = $everyoneGamesData[$k][$l]['deaths'] != NULL ? $everyoneGamesData[$k][$l]['deaths'] : 0 ;
                            $assists = $everyoneGamesData[$k][$l]['assists'] != NULL ? $everyoneGamesData[$k][$l]['assists'] : 0;
                            $champ = $everyoneGamesData[$k][$l]['champ'];
                            
                            $gameDate = $everyoneGamesData[$k][$l]['gameDate'];
                            
                            $portrait = getChampPortrait($champ);
                            
                            if ($everyoneGamesData[$k][$l]['win'] == NULL) {
                                //echo "<br>$k,$l: LOSS<br>";
                                $recentWins .= "<td class='loss' title='$champ LOSS\n$kills/$deaths/$assists\n$gameDate' style='width:.6vw;height:.6vw;font-size:100%;border: 1px solid #BBBBBB;text-align:center;cursor:default;'><img src='$portrait' style='width:.9vw; display:block;'></td>";
                            } else {
                                //echo "<br>$k,$l: WIN<br>";
                                $recentWins .= "<td class='win' title='$champ WIN\n$kills/$deaths/$assists\n$gameDate' style='width:.5vw;height:.8vw;font-size:100%; border: 1px solid #BBBBBB;;text-align:center;cursor:default;'><img src='$portrait' style='width:.9vw; display:block;'></td>";
                            }
                        }
                        
                        //Count oldest to newest to get streak.
                        for ($l = count($everyoneGamesData[$k]) - 1; $l >= 0; $l--) {
                            if ($everyoneGamesData[$k][$l]['win'] == NULL) {
                                //echo "<br>$k,$l: LOSS<br>";
                                $delta -= 1;
                                $streak = $streak > 0 ? -1 : $streak - 1; 
                            } else {
                                //echo "<br>$k,$l: WIN<br>";
                                $delta += 1;
                                $streak = $streak < 0 ? 1 : $streak + 1; 
                            }

                        }
                        
                        $carryString .= "Carry Factors:";
                        
                        //Modify Carry rating by Win/Loss streak.
                        if ($streak >= 6) {
                            $carry += 2;
                            $carryString .= "\nMajor Win Streak";
                        } else if ($streak >= 4) {
                            $carry++;
                            $carryString .= "\nWin Streak";
                        } else if ($streak <= -6) {
                            $carry -= 2;
                            $carryString .= "\nMajor Loss Streak";
                        } else if ($streak <= -4) {
                            $carryString .= "\nLoss Streak";
                            $carry--;
                        }
                        
                        
                        
                        //Modify Carry rating by recent Win/Loss ratio
                        if ($delta / $count >= .6) {
                            $carry +=2;
                            $carryString .= "\nExcellent Recent Winrate";
                        } else if ($delta / $count >= .4) {
                            $carry++;
                            $carryString .= "\nGood Recent Winrate";
                        } else if ($delta / $count <= -.6) {
                            $carry -=2;
                            $carryString .= "\nVery Poor Recent Winrate";
                        } else if ($delta / $count <= -.4) {
                            $carry--;
                            $carryString .= "\nPoor Recent Winrate";
                        }
                        
                        if ($winRate > .6) {
                            $carry++;
                            $carryString .= "\nSmurf";
                        }
                        
                        //Modify Carry rating for Champion Win % and Champion KDA
                        if ($everyoneGamesPlayed[$k] >= 20) {
                            if ($everyoneWinPercent[$k] >= 60) {
                                $carry += 2;
                                $carryString .= "\n60% Champ Win %";                                
                            } else if ($everyoneWinPercent[$k] >= 55) {
                                $carry ++;
                                $carryString .= "\n55% Champ Win %";                                
                            } else if ($everyoneWinPercent[$k] <= 40) {
                                $carry -= 2;
                                $carryString .= "\n40% Champ Win %";                                
                            } else if ($everyoneWinPercent[$k] <= 45) {
                                $carry --;
                                $carryString .= "\n45% Champ Win %";                                
                            }
                            
                            if ($everyoneKDA[$k] >= 3.5) {
                                $carry += 2;
                                $carryString .= "\n> 3.5 KDA";
                            } else if ($everyoneKDA[$k] >= 3) {
                                $carry ++;
                                $carryString .= "\n> 3.0 KDA";
                            } else if ($everyoneKDA[$k] <= 1.5) {
                                $carry -= 2;
                                $carryString .= "\n< 1.5 KDA";
                            } else if ($everyoneKDA[$k] <= 2) {
                                $carry --;
                                $carryString .= "\n< 2.0 KDA";
                            }
                            
                            
                            
                        }
                        
                        if ($everyoneGamesPlayed[$k] < 5) {
                            $carry--;
                            $carryString .= "\n<5 Ranked Games on Champ";
                        }
                        
                        //echo "<div title='$carryString'>Carry Factor: $carry</div>";
                        
                        
                        
                        //echo "<br>Streak: $streak, Delta: $delta, Games: $count, Carry: $carry";
                        
                        $recentWins .= "</tr></table>";
                        
                        //Put Leagues data here.
                        


                        //Put Stats data here.

                        $champName = getChampName($postDataJSON['participants'][$k]['championId']);

                        $tableRow .= "<tr class='currentMatchPlayer' id='$champName'><td class='tablePaneUpper'>";

                        $win = $everyoneGamesData[$k][0]['win'];
						
						$opggPlayerName = $postDataJSON['participants'][$k]['summonerName'];
                                                
                        $tableRow .= "<div id='nameContainer$k'><a href='https://$region.op.gg/summoner/userName=$opggPlayerName' target='_blank'>" . $postDataJSON['participants'][$k]['summonerName'] . "</a></div><div style='font-size:50%; '>Recent<br>&nbspNewest&nbsp&#8592;&#8594;&nbspOldest<br>$recentWins</div></td>";
                        
                        $portrait = getChampPortrait($champName);
                        $spell1 = getSpell($postDataJSON['participants'][$k]['spell1Id']);
                        $spell2 = getSpell($postDataJSON['participants'][$k]['spell2Id']);
                        
                        array_push($everyone_spell1, $spell1);
                        array_push($everyone_spell2, $spell2);
                        
						
						
                        foreach ($summonerSpellsJSON['data'] as $key => $data) {
                            if ($postDataJSON['participants'][$k]['spell1Id'] == $data['key']) {
                                array_push($everyoneSS1_CD_raw, $data['cooldown'][0]);
                            }
                            if ($postDataJSON['participants'][$k]['spell2Id'] == $data['key']) {
                                array_push($everyoneSS2_CD_raw, $data['cooldown'][0]);
                            }
                        }
						
						
                        
                        $leagueIcon = getLeagueIcon($leaguesArray[$k]);

                        $runes = $postDataJSON['participants'][$k]['runes'];

                        $cdr_flat = 0;
                        $cdr_scaling = 0;
                        
                        $runesDisplay = getRunesReadable($runes, $region, $cdr_flat, $cdr_scaling);
                        
                        array_push($everyoneCDR_Flat, $cdr_flat);
                        array_push($everyoneCDR_Scaling, $cdr_scaling);

                        $masteries = $playerMasteriesCount[$k];
                        $keystone = $playerKeystoneMasteries[$k];
                        $keystoneLabel = $playerKeystoneMasteriesDescription[$k];
                        
                        $spellNum = 0;
                        
                        $spellCooldownString = "";
                        
                        foreach($champSpellsJSON['data'][$champName]['spells'] as $key => $data) {
                            $spellLetter = "";        
                            switch ($spellNum) {
                                case 0: $spellLetter = "Q";
                                    break;
                                case 1: $spellLetter = "W";
                                    break;
                                case 2: $spellLetter = "E";
                                    break;
                                case 3: $spellLetter = "R";
                                    break;
                                default:
                                    break;
                            }
                            
                            $spellNum++;
                            
                            $spellDescription = $data['sanitizedDescription'];
                            
                            $spellCooldownString .= "<span class='tooltip' title=\"$spellDescription\">$spellLetter</span>" . ": " . $data['cooldownBurn'] . " <br>";
                            
                        }
                        
                        //$f = $w * $G - $w * $L * $G - $w * $G * $r ** ($w - 1) + $w * L * G * $r ** ($w * $L - 1);
                        
                        //echo "<br>$f";

						$masteryImageDirectory = "datadragon/$patchFull/img/mastery/";
						
						//echo "<br>$masteryImageDirectory";
                        
                        $tableRow .= "<td style='font-size: 85%' class='tablePaneUpper'>$everyoneRolesString[$k]</td>";
                        
                        $tableRow .= "<td class='tablePaneUpper'><table style='border-collapse: collapse;'><tr><td><img src='$portrait' alt='$champName' style='width:2.8vw;'></td><td><div><img src='ssicons/$spell1.png' alt='$spell1' style='width:1.25vw;'></div><div><img src='ssicons/$spell2.png' alt='$spell2' style='width:1.25vw;'></div></td><td><div id='champNameContainer$k'>$champName</div><div>($everyoneGamesPlayed[$k])</div></td></tr></table></td>";
                        
                        $tableRow .= "<td class='tablePaneUpper'><div style='text-align:center'><img src='$leagueIcon' class='center' alt='$leaguesArray[$k]' style='width:2vw'></div><div style='text-align:center; font-size:85%'>$leaguesArray[$k]<br>$lpArray[$k]</div></td>";
                        
                        $tableRow .= "<td class='padleft' style='text-align:center;'><span>$carry<span class='tooltip' title='$carryString'>+</span></span></td>";

                        $tableRow .= "<td class='padleft' style='text-align:center;'>$everyoneSeasonWins[$k]/$everyoneSeasonLosses[$k]</td>";
                        
                        //$tableRow .= "<td class='tablePaneUpper' style='text-align:center'>$everyoneKDA[$k]<span class='tooltip' title='Avg Score: $kills/$deaths/$assists   $cs CS'>+</span></td>";
                        
                        $tableRow .= "<td class='tablePaneUpper' style='text-align:center'>$everyoneKDA[$k]<span class='tooltip' title='$everyoneKillsPerGame[$k]/$everyoneDeathsPerGame[$k]/$everyoneAssistsPerGame[$k]'>+</span></td>";
                        
                        $tableRow .= "<td class='padleft' style='text-align:center;'>$everyoneWinPercent[$k]%<br>($everyoneGamesPlayed[$k])</td>";

                        $tableRow .= "<td class='tablePaneUpper'><div style='font-size: 75%'>$runesDisplay</div></td>";

                        $tableRow .= "<td class='tablePaneUpper'><button id='$k' onclick='showMasteries(this.id)' style='font-size:1vh'>$masteries</button><div style='text-align: center; margin-top: .2vw;'><img src='$masteryImageDirectory/$keystone.png' alt='$keystone' title=\"Keystone: $keystoneLabel\" style='width:1.5vw;'></div></td>";
                        
                        $tableRow .= "<td class='tablePaneUpper'>$spellCooldownString</td>";
						
						$tableRow .= "<td class='tablePaneUpper'>$playerMasteriesInsight[$k]</td>";
						
						$tableRow .= "<td class='tablePaneUpper'><div class='matchupWinRate'>-</div><div>(<span class='counterPower'>-</span>)</div></td>";
                        
                        $tableRow .= "</tr>";
						
						$tableRowsPlayers[$champName] = $tableRow;
						
						$champNamesList["$champName"] = array();
						
						//echo $champName;

                    }
					
					
					//$highestTop
					
					

					
					foreach($champNamesList as $key => $champName) {
						
						$champNamesList["$key"]['Top'] = 0;
						$champNamesList["$key"]['Jungle'] = 0;
						$champNamesList["$key"]['Middle'] = 0;
						$champNamesList["$key"]['ADC'] = 0;
						$champNamesList["$key"]['Support'] = 0;
						
						
						//$tableRowPlayers[$key]['row'] = $row;
						//echo $key . "<br>";
						
						//$champNamesList["$key"]['Hello'] = "Hello to you too!";
						
						
						
						foreach ($championsSummaryJSON[$key]['role'] as $keyRole => $role) {
							
							//echo "<pre><div style='text-align: left'><br>$key $keyRole Role Percent Played:<br>"; print_r($role['percentPlayed']); echo "</div></pre>";
							$champNamesList["$key"]["$keyRole"] = $role['percentPlayed'];
							//$tableRowPlayers[$keyChamp]['Top'] = "Hello";
							//echo "<pre><div style='text-align: left'><br>$keyChamp $keyRole Role Percent Played:<br>"; print_r($tableRowPlayers[$keyChamp][$keyRole]); echo "</div></pre>";

							
							//echo "<pre><div style='text-align: left'><br>% Played Check: <br>"; print_r($tableRowPlayers[$keyChamp][$keyRole]); echo "</div></pre>";
						}
				
						
						
						
					}
			
					

					//echo "<pre><div style='text-align: left'><br>Roles Summary:<br>"; print_r($tableRowPlayers); echo "</div></pre>";
					
					$rolesArray = array("Top" => null, "Jungle" => null, "Middle" => null, "ADC" => null, "Support" => null);
					
					//ksort($tableRowPlayers, )
					
					foreach($rolesArray as $keyRole => $role) {
						
						//echo "Key: " . $keyRole . "<br>";
						//echo "Role: " . $role . "<br>";
						//echo "<pre><div style='text-align: left'><br>Champion Names List: <br>"; print_r($champNamesList); echo "</div></pre>";
						
						$roleScore = 0;
						
						//ksort($champNamesList["$keyRole"]['playPercent']);
						
						//echo "Key Roles: " . $champNamesList . " $keyRole<br>";
						
						//echo var_dump($champNamesList) . " keyRole<br>";
						//echo "<pre><div style='text-align: left'><br>Champion Names List: <br>"; print_r($champNamesList); echo "</div></pre>";

						$highScore = 0;
						$highChamp = null;
						
						
						foreach($champNamesList as $champName => $champData) {
							
							if ($champData["$keyRole"] > $highScore) {
								$highChamp = $champName;
								$highScore = $champData["$keyRole"];
							}
							
		
							
						}
						
						//echo "<br>Results: $highChamp $keyRole:" . $highScore . "<br>";
						
						$rolesArray["$keyRole"] = $highChamp;
						
						unset($champNamesList["$highChamp"]);
						
						//echo "<pre><div style='text-align: left'><br>Champion Names List: <br>"; print_r($champNamesList); echo "</div></pre>";
						

					}
					
					//echo "<pre><div style='text-align: left'><br>Champion Names List: <br>"; print_r($champNamesList); echo "</div></pre>";					
					
					//Assign roles to off-meta picks.
					foreach($rolesArray as $role => $champ) {
						if ($champ == null) {
							
							//echo "<br><br>Unfilled Role: $role<br>";
							
							
							$shift = array_splice( $champNamesList, 0, 1 );
							
							//echo "<pre><div style='text-align: left'><br>Array Shift:<br>"; print_r($shift); echo "</div></pre>";
							
							$rolesArray["$role"] = key($shift);
							
							
							
							//unset(reset($chamNamesList));
						}
						
					}
		
					//echo "<br><br>Top: " . $tableRowsPlayers[$rolesArray["Top"]];
					
					
					$table .= $tableRowsPlayers[$rolesArray["Top"]];
					$table .= $tableRowsPlayers[$rolesArray["Jungle"]];
					$table .= $tableRowsPlayers[$rolesArray["Middle"]];
					$table .= $tableRowsPlayers[$rolesArray["ADC"]];
					$table .= $tableRowsPlayers[$rolesArray["Support"]];
					
					
					//echo "<pre><div style='text-align: left'><br>Roles Array:<br>"; print_r($rolesArray); echo "</div></pre>";
					
					
                    $table .= "</tbody></table>";
                    
                    array_push($tableList, $table);
					
					unset($tableRowPlayers);
					unset($champNamesList);
                }
                
                if ($rankCount > 0)
                {
                    $rankAvg = $rankAvg / $rankCount;
                }
                
                $rankPrint = "Unranked";
                $lpPrint = 0;
                
                if ($rankAvg > 3000)
                {
                    $rankPrint = "Challenger I";                    
                    $lpPrint = $rankAvg - 2500;
                } else if ($rankAvg > 2500) {
                    $rankPrint = "Master I";                    
                    $lpPrint = $rankAvg - 2500;
                }


                
                if ($rankAvg > 0 && $rankAvg < 2500) {
                    if ($rankAvg >= 2000) {
                        $rankPrint = "Diamond";
                    } else if ($rankAvg >= 1500) {
                        $rankPrint = "Platinum";
                    } else if ($rankAvg >= 1000) {
                        $rankPrint = "Gold";
                    } else if ($rankAvg >= 500) {
                        $rankPrint = "Silver";
                    } else if ($rankAvg > 0) {
                        $rankPrint = "Bronze";
                    }
                    
                    switch (floor(($rankAvg % 500) / 100)) {
                        case 0: $rankPrint .= " V";
                            break;
                        case 1: $rankPrint .= " IV";
                            break;
                        case 2: $rankPrint .= " III";
                            break;
                        case 3: $rankPrint .= " II";
                            break;
                        case 4: $rankPrint .= " I";
                            break;
                        default:
                            break;
                    }

                    $lpPrint = floor($rankAvg % 100);

                    
                }
                
                
                if ($lpPrint !== NULL) {
                    $lpPrint = floor($lpPrint);
                }
                
                if ($rankAvg !== NULL) {
                    $rankAvg = round1($rankAvg);
                }
                
                
                $rankIconPrint = getLeagueIcon($rankPrint);
                
                
                print_r($tableList[0]);
                
                echo "<div style='text-align:center;margin: 0 auto;'><div style='height:.5vw;'></div><button onclick=\"scoutOpponents('$region')\" class='freljord shadow_low' style='background-size: 20%;'>Scout Opponents</button></div><div style='height:.5vw;'></div>";
                
                echo "<div style='text-align:center;margin: 0 auto'>Avg Rank: <img src='$rankIconPrint' alt='$rankIconPrint' title='$rankPrint' style='width:1vw'>$rankPrint $lpPrint LP ($rankAvg MMR)</div>";
                
                print_r($tableList[1]);
                
                $tableSpellsButtons = "<br><br><table><tr>";
                
                for ($i = 0; $i < count($postDataJSON['participants']); $i++) {
                    
                    //echo "Hello";
                    
                    $champName = getChampName($postDataJSON['participants'][$i]['championId']);
                    
                    //$cooldown_Masteries = getChampName($postDataJSON['participants'][$i]['masteries']);
                    $cooldown_flat = $everyoneCDR_Flat[$i];
                    $cooldown_scaling = $everyoneCDR_Scaling[$i];
                    //$cooldown_Masteries = 0;
                    
                    $cooldown_SS = 0;
                    
                    foreach ($postDataJSON['participants'][$i]['masteries'] as $key => $data) {
                        if ($data['masteryId'] == 6241) {
                            $cooldown_SS = .15;
                            //echo "<br>$cooldown_SS";
                            
                            $everyoneSS1_CD_raw[$i] = $everyoneSS1_CD_raw[$i] * (1 - $cooldown_SS);
                            $everyoneSS2_CD_raw[$i] = $everyoneSS2_CD_raw[$i] * (1 - $cooldown_SS);                            
                        }
                        if ($data['masteryId'] == 6352) {
                            $cooldown_flat -= .05;
                            //$cooldown_Masteries = .05;
                            //echo "<br>Cooldown Flat: $cooldown_flat";
                        }
                    }
                    
                    //CDR/lvl Blues:
                    //5052: -0.05% cooldowns per level (-0.93% at champion level 18)
                    //5174: -0.07% cooldowns per level (-1.3% at champion level 18)
                    //5296: -0.09% cooldowns per level (-1.67% at champion level 18)
                    //
                    //CDR/lvl Quints:
                    //5296: -0.09% cooldowns per level (-1.67% at champion level 18)
                    //5234: -0.21% cooldowns per level (-3.9% at champion level 18)
                    //5356: -0.28% cooldowns per level (-5% at champion level 18)
                    //
                    //Cooldown Quints:
                    //5111: -1.4% cooldowns
                    //5233: -1.95% cooldowns
                    //5355: -2.5% cooldowns
                    //
                    //Cooldown Blues:
                    //5051: -0.47% cooldowns
                    //8003: -0.75% cooldowns
                    //5295: -0.83% cooldowns
                    
                    
                    //6241:  Insight (+15% SS CDR)
                    //6352:  Intelligence (+5% CDR)
                    
                    
                    //$cooldown_Masteries;
                    
                    //echo "<br>$everyone_spell1[$i]";
                    //echo "<br>$everyone_spell2[$i]";
                    
                    $tableSpellsButtons .= "<td><button onclick='getChampSpells($i,\"$champName\",\"$region\",\"$cooldown_flat\",\"$cooldown_scaling\",\"$everyone_spell1[$i]\",\"$everyone_spell2[$i]\",\"$everyoneSS1_CD_raw[$i]\",\"$everyoneSS2_CD_raw[$i]\")'>$champName Spells</button></td>";
                    
                    //echo "<br>Cooldown_SS1: $everyoneSS1_CD_raw[$i]<br>";
                    //echo "<br>Cooldown_SS2: $everyoneSS2_CD_raw[$i]<br>";
                    //echo "<br>Cooldown_Masteries: $cooldown_Masteries<br>";
                    //echo "<br>Cooldown_Flat: $cooldown_flat<br>";
                    //echo "<br>Cooldown_Scaling: $cooldown_scaling<br>";
                }

                $tableSpellsButtons .= "</tr></table>";
                
                echo $tableSpellsButtons;
				
                
                //echo "<table><tr><td><button>Hello</button></td></tr></table>";
                
                //echo "<br><div><pre id='spellSlot' style='text-align:left'>Spells</pre></div>";
                echo "<br><div id='spellSlot' style='text-align:left; background-color:#8888FF22;'>Spells</div>";
                
                
				$postDataJSON['patchFull'] = $patchFull;
				$postDataJSON['patchShort'] = $patchShort;
				
                $outputPostData = json_encode($postDataJSON);

                //DON'T COMMENT THIS OUT!
                echo "<form id='formMasteries' action='mastery_iframe_1.php' method='post' target='iframe_showMasteries' style='visibility: hidden'> <input id='playerNumber' type='text' name='playerNumber'><textarea name='post' id='postData'>$outputPostData</textarea><input type='submit' value='Do Stuff!' /></form>";

                //echo "</div></pre>";

                /*
                echo "<pre><div style='text-align: left'><br>Post Data:<br>"; print_r($postDataJSON); echo "</div></pre>";

                echo "<pre><div style='text-align: left'><br>IDs String:<br>"; print_r($idsString); echo "</div></pre>";
                
                echo "<pre><div style='text-align: left'><br>IDs Array:<br>"; print_r($idsArray); echo "</div></pre>";
                
                echo "<pre><div style='text-align: left'><br>Leagues JSON:<br>"; print_r($leaguesJSON); echo "</div></pre>";

                echo "<pre><div style='text-align: left'><br>Leagues Array:<br>"; print_r($leaguesArray); echo "</div></pre>";

                echo "<pre><div style='text-align: left'><br>Stats Array:<br>"; print_r($statsJSON); echo "</div></pre>";
                */
                
                //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx FUNCTIONS xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                
                function get_web_page($url) {
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
                        $time = date('h:i:sa');
                        
                        //echo "<br>Attempting Get of $url at " . "$time" ."<br>";
                        
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
                            //echo "<br><br><br>*** Warning: Server is busy.  If your results do not show completely, please try again in 10 seconds."   . " $time   " ."***<br><br><br>";               

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
                                    
                                    if ($retry_after < 2)
                                    {
                                        $retry_after = 2;
                                    }

                                    //echo "<br>Auto Retrying after $retry_after seconds.<br>";

                                    //echo "<br>The time is " . date("h:i:sa") . "<br>";
                                    
                                    sleep($retry_after);
                                    
                                    //echo "<br>The time is " . date("h:i:sa") . "<br>";
                                }


                            }

                        } else {
                            $try = false;
                            //echo "<br>Get Page Successful at $time.<br>";
                        }

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
                        echo "<br>Attempting Post...<br>";
                        
                        $ch = curl_init();
                        curl_setopt_array($ch, $options);
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, ['post' => $data_to_post, 'region' => $region]);                        

                        $content  = curl_exec($ch);

                        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

                        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        $body = substr($content, $header_size);

                        $retry_after = 10;

                        if ($code == 429)
                        {
                            $header = substr($content, 0, $header_size);

                            echo "<br><br><br>*************************************************ERROR!!!!! GOT CODE 429 HERE!!!!********************************************<br><br><br>";
                            echo "<br><br><br>*** Warning: Server is busy.  If your results do not show completely, please try again in 10 seconds.  ***<br><br><br>";               

                            $header_lines = explode("\n", $header);

                            $lines_count = count($header_lines);
                            
                            $find = "Retry-After: ";

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
                
                
                function getChampName($champ_id)
                {
                    $champName = "";
                    
                    
                    
                    //Retrieve Champ Name from my own static JSON, because retrieving it from DataDragon is slow.  (7 sec vs 25 sec in this case)
					$url = "./data/champsList.json";
                    $response = json_decode(read_file($url)['body'], true)['data'];

					$champName = $response[$champ_id]['key'];
	
                    
                    return $champName;
                }
                
                function getSpell($spell_ID) {
                    
                    $spell_name = "";
                    
                    if ($spell_ID == 	1	) {$spell_name = "cleanse";} 
                        else if ($spell_ID == 	12	) {$spell_name = "teleport";} 
                        else if ($spell_ID == 	30	) {$spell_name = "to the king!";} 
                        else if ($spell_ID == 	14	) {$spell_name = "ignite";} 
                        else if ($spell_ID == 	6	) {$spell_name = "ghost";} 
                        else if ($spell_ID == 	32	) {$spell_name = "mark";} 
                        else if ($spell_ID == 	7	) {$spell_name = "heal";} 
                        else if ($spell_ID == 	11	) {$spell_name = "smite";} 
                        else if ($spell_ID == 	3	) {$spell_name = "exhaust";} 
                        else if ($spell_ID == 	31	) {$spell_name = "poro toss";} 
                        else if ($spell_ID == 	13	) {$spell_name = "clarity";} 
                        else if ($spell_ID == 	21	) {$spell_name = "barrier";} 
                        else if ($spell_ID == 	2	) {$spell_name = "clairvoyance";} 
                        else if ($spell_ID == 	4	) {$spell_name = "flash";} 
                        else if ($spell_ID == 	17	) {$spell_name = "garrison";} 
                        else {$spell_name = "Other";}				

                        return "$spell_name";
                }
                
                function getChampPortrait($champName)
                {
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
                
                function getRunesReadable($runes, $region, &$cdr_flat, &$cdr_scaling) {
                    $runesOutput = "";
                    
                    global $runesJSON;

                    $totalRunes = array();
                    
                    foreach ($runes as $rune)
                    {
                        $count = $rune['count'];
                        $runeId = $rune['runeId'];
                        $description = $runesJSON['data'][$runeId]['description'];
                        
						//5402":{"name":"Greater Mark of Precision",
						//5253":{"name":"Greater Mark of Lethality"
						//5418":{"name":"Greater Quintessence of Precision
						//5343":{"name":"Greater Quintessence of Lethality","description":"+3.20 lethality",
						
						//5401":{"name":"Mark of Precision","description":"+0.7 Leth / +0.48 M.Pen
						//5131":{"name":"Mark of Lethality","description":"+1.25 lethality
						//5417":{"name":"Quintessence of Precision","description":"+1.74 Lethality / +1.09 Magic Penetration
						//5221":{"name":"Quintessence of Lethality","description":"+2.49 lethality
						
						//Still need to do Hybrid Pen runes (Precision runes)
						
						if (strpos($description, 'Lethality') !== false || strpos($description, 'lethality') !== false ) {
							
							//echo "<pre><div style='text-align: left'><br>Rune:<br>"; print_r($rune); echo "</div></pre>";
							
							//preg_match_all('((?:\d+)(?:\.\d*)?)/', $description, $runeStats);
							preg_match_all('/[0-9]+[\.][0-9]+/', $description, $runeStats);
														
							
                            //Check if total runes contains the stat
                            if (array_key_exists('Lethality', $totalRunes))
                            {	
								
								//echo "$description";
						
								//echo "<pre><div style='text-align: left'><br>New Lethality:<br>"; print_r($runeStats); echo "</div></pre>";
								
								//echo $runeStats['0']['0'];
						
								
								//echo "<br>RuneStats: $runeStats";
						
								$lethality = $runeStats['0']['0'];
								
								//echo "<br>New Lethality: $lethality";
								
								//echo "<pre><div style='text-align: left'><br>New Lethality:<br>"; print_r($lethality); echo "</div></pre>";
								
								
								
								
                                //Add rune stats to total.
                                $totalRunes['Lethality']['scalar'] += $count * $lethality;
								
                            }
                            else
                            {
								
								//echo "$description";
								
								//echo "<pre><div style='text-align: left'><br>Add Lethality:<br>"; print_r($runeStats); echo "</div></pre>";

								//echo $runeStats['0']['0'];
								
								
								//echo "<br>RuneStats: $runeStats";
								
								$lethality = $runeStats['0']['0'];
								
								//echo "Add Lethality: $lethality";
								
								//echo "<pre><div style='text-align: left'><br>Add Lethality:<br>"; print_r($lethality); echo "</div></pre>";
								
								
								
								
                                //Create a new stat category.
                                $totalRunes['Lethality']['scalar'] = $count * $lethality ;
                                $totalRunes['Lethality']['description'] = "+2.01 Lethality";
								
                            }
							
							//rFlatMagicPenetrationMod
						}
						
                        foreach ($runesJSON['data'][$runeId]['stats'] as $key => $runeStat)
                        {
							//echo "<br>" . $runesJSON['data'][$runeId]['stats'] . ", " . $key . ", " . $runeStat;
							
							//Check if it contains Precision.
							if (strpos($runesJSON['data'][$runeId]['name'], 'precision') !== FALSE || strpos($runesJSON['data'][$runeId]['name'], 'Precision') !== FALSE) {
								//Do Precision Stuff.
								//echo "<br>Precision Stuff!";
								
								//Precision Runes only contain Magic Pen Stat, Lethality is no tincluded in 7.2.  Might have to fix later.
								//Check if total runes contains the stat
								if (array_key_exists($key, $totalRunes))
								{
									//Add rune stats to total.
									$totalRunes['rFlatMagicPenetrationMod']['scalar'] += $count * $runeStat;
								}
								else
								{
									//Create a new stat category.
									$totalRunes['rFlatMagicPenetrationMod']['scalar'] = $count * $runeStat;
									$totalRunes['rFlatMagicPenetrationMod']['description'] = "+2.01 magic penetration";
								}								
								
							} else							
                            //Check if total runes contains the stat
                            if (array_key_exists($key, $totalRunes))
                            {
                                //Add rune stats to total.
                                $totalRunes[$key]['scalar'] += $count * $runeStat;
                            }
                            else
                            {
                                //Create a new stat category.
                                $totalRunes[$key]['scalar'] = $count * $runeStat;
                                $totalRunes[$key]['description'] = $description;
                            }
                            
                        }
                    }
                    
                    foreach ($totalRunes as $key => $sumRuneStat)
                    {                    
                        $keyReadable = "";
                        //echo "<br>Key: $key";
                        //Find Cooldowns
                        if (strpos($key, 'Cooldown') !== FALSE) {
                            if (strpos($key, 'PerLevel') !== FALSE) {
                                $cdr_scaling += $sumRuneStat['scalar'];
                                //echo "<br>Scaling"; echo $cdr_scaling;
                            } else {
                                $cdr_flat += $sumRuneStat['scalar'];
                                //echo "<br>Flat"; echo $cdr_flat;
                            }
                        }
                        
                        //Add '+', if necessary.
                        if ($sumRuneStat['scalar'] > 0)
                        {
                            $keyReadable .= "+";
                        }
                        
                        //Add Percent, if necessary.
                        if (strpos($key, 'Percent') !== FALSE) {
                            //echo 'Found it';
                            $statRounded = round(100 * $sumRuneStat['scalar'], 2);
                            
                            $keyReadable .= $statRounded . "%";
                        }
                        else { 
                            //echo "nope!";
                            $statRounded = round($sumRuneStat['scalar'], 2);
                            $keyReadable .= $statRounded;
                        }
                        
                        if (strpos($key, '5 sec.') !== FALSE) {
                            //echo 'Found it';
                            $statRounded = round(5 * $sumRuneStat['scalar'], 2);
                        }
                        
                        
                        //Add rest of description string, check for Scaling rune
                        if (strpos($key, 'PerLevel') !== FALSE) {
                            //echo 'Found it';
                            $keyReadable .= substr($sumRuneStat['description'], strpos($sumRuneStat['description'], ' '), strpos($sumRuneStat['description'], '(') - strpos($sumRuneStat['description'], ' ')); 
                            $keyReadable .= '(';
                            
                            if ($sumRuneStat['scalar'] > 0)
                            {
                                $keyReadable .= "+";
                            }

                            //Add Percent at Level 18, if necessary.
                            if (strpos($key, 'Percent') !== FALSE) {
                                //echo 'Found it';
                                $statRounded = round((100 * 18 * $sumRuneStat['scalar']), 2);
                                $keyReadable .=  $statRounded . "%";
                            }
                            else { 
                                //echo "nope!";
                                $statRounded = round(18 * $sumRuneStat['scalar'], 2);
                                $keyReadable .= $statRounded;
                            }
                            
                            $keyReadable .= " @ 18)";
                            
                            
                            if (strpos($keyReadable, 'per level (') !== FALSE) {
                                $keyReadable = str_replace('per level (', ' / lvl (', $keyReadable);
                            }
                            
                        } else {
                            //echo "nope!";                            
                            $keyReadable .= substr($sumRuneStat['description'], strpos($sumRuneStat['description'], ' ')); 

                        }
                        
                        
                        //$runesOutput .= $sumRuneStat['scalar'] . ' ' . $key . '<br>';
                        
                        $runesOutput .= $keyReadable . '<br>';
                    }
                    
                    return $runesOutput;                    
                }
                
                function cleanRunesNames()
                {
                    
                }
                
                function splitMasteries()
                {
                    $url = "./mastery/mastery.json";
                    
                    $masteriesJSON = json_decode(read_file($url)['body'], true);
                    
                    print_r($masteriesJSON);
                    
                    $masteryIdsList = array();
                    
                    foreach($masteriesJSON['data'] as $id => $mastery)
                    {
                        array_push($masteryIdsList, $id);
                    }
                    
                    print_r($masteryIdsList);
                    
                    $width = 48;
                    $height = 48;
                    
                    $source = imagecreatefrompng( "http://$server/mastery/gray_mastery0.png" );
                    $source_width = imagesx( $source );
                    $source_height = imagesy( $source );
                    
                    echo( "<br>Source width: $source_width\n" );
                    echo( "<br>Source height: $source_height\n" );

                    $i = 0;
                    
                    for( $row = 0; $row < $source_height / $height; $row++)
                    {
                        for( $col = 0; $col < $source_width / $width; $col++)
                        {
                            echo "Image: ";
                            $fn = sprintf( "gray_$masteryIdsList[$i].jpg", $col, $row );
                            echo( "$fn\n" );

                            $im = imagecreatetruecolor( $width, $height );
                            imagecopyresized( $im, $source, 0, 0,
                                $col * $width, $row * $height, $width, $height,
                                $width, $height );
                            imagejpeg( $im, $fn );
                            imagedestroy( $im );
                            
                            $i++;
                        }
                    } 
                }
                
                function layerMasteriesStatic()
                {
                    $url = "./mastery/mastery.json";
                    
                    $masteriesJSON = json_decode(read_file($url)['body'], true);
                    
                    $masteryIdsList = array();
                    
                    foreach($masteriesJSON['data'] as $id => $mastery)
                    {
                        array_push($masteryIdsList, $id);
                    }
                    
                    $source = imagecreatefromjpeg("http://$server/mastery/masteryback.jpg");
                    $source_width = imagesx( $source );
                    $source_height = imagesy( $source );
                    
                    echo( "<br>Source width: $source_width\n" );
                    echo( "<br>Source height: $source_height\n" );
                    
                    echo "Image: ";
                    $fn = sprintf( "TestBackground1.jpg");
                    echo( "$fn\n" );
                    
                    //imagesavealpha($final_img, true);

                    //$trans_colour = imagecolorallocatealpha($final_img, 0, 0, 0, 127);
                    //imagefill($final_img, 0, 0, $trans_colour);

                 
                    $imageOut = $source;
                    
                        
                    foreach ($masteryIdsList as $id => $key) {
                        
                        //echo( "<br>Id: $id\n" );
                        //echo( "<br>Key: $key\n" );
                        
                        $pad_out_x = 24;
                        $pad_in_x = 12;
                        
                        $pad_out_y = 20;
                        $pad_in_y = 22;
                        
                        $page_width = 273;
                        
                        $image_layer = imagecreatefromjpeg("http://$server/mastery/gray_$key.jpg");
                        
                        $page = floor(floor(($key % 1000)) / 100) - 1;
                        $row = floor(floor(($key % 100)) / 10) - 1;
                        $col = ($key % 10) - 1;
                        
                        echo( "<br>Page: $page\n" );
                        echo( "<br>Row: $row\n" );
                        echo( "<br>Col: $col\n" );
                        
                        $layer_width = imagesx($image_layer);
                        $layer_height = imagesy($image_layer);
                        
                        echo( "<br>Layer width: $layer_width\n" );
                        echo( "<br>Layer height: $layer_height\n" );
                        
                        
                        $dst_x = $page * $page_width + $pad_out_x + $col * ($layer_width + $pad_in_x);
                        $dst_y = $pad_out_y + $row * ($layer_height + $pad_in_y);
                        

                        
                        //echo( "<br>Key: $key\n" );
                        
                        $output_width = imagesx($imageOut);
                        $output_height = imagesy($imageOut);
                        
                        //echo( "<br>Output width: $output_width\n" );
                        //echo( "<br>Output height: $output_height\n" );

                        //imagecopy($dst_im, $src_im, $page_width, $pad_in, $pad_out, $y, $x, $src_h)
                                              
                        $color = imagecolorallocate($image_layer, 50, 50, 50);
                        drawBorder($image_layer, $color, 1);
                        
                        imagecopy($imageOut, $image_layer, $dst_x, $dst_y, 0, 0, $layer_width, $layer_height);
                        
                        $output_width = imagesx($imageOut);
                        $output_height = imagesy($imageOut);
                        
                        //echo( "<br>Output width: $output_width\n" );
                        //echo( "<br>Output height: $output_height\n" );
                        

                        
                        //This works
                        imagejpeg($imageOut, $fn);                        
                        
                        echo "\nGot Here.";
                    }

                    //imagealphablending($final_img, true);
                    //imagesavealpha($final_img, true);
                    //imagealphablending($final_img, true);


                    //header('Content-Type: image/png');
                    imagejpg($imageOut, $fn);
                    
                    echo "\nShould be copied.";
                }
                
                
                //The iFrame must be called in JavaScript.  We should count offense/defense here though.
                function getMasteriesCount()
                {
                    global $postDataJSON;
                    

                    
                    foreach ($postDataJSON['participants'] as $id => $player)
                    {
                        global $playerMasteriesCount;
						global $playerMasteriesInsight;
                        
                        $offenseCount = 0;
                        $defenseCount = 0;
                        $utilityCount = 0;
                        
						$insight = false;
												
                        foreach ($player['masteries'] as $index => $mastery)
                        {
                            if ((((int)$mastery['masteryId']) % 1000) < 200)
                            {
                                $offenseCount += $mastery['rank'];
                            }
                            else if ((((int)$mastery['masteryId']) % 1000) < 300)
                            {
                                $defenseCount += $mastery['rank'];
                            } 
                            else 
                            {
                                $utilityCount += $mastery['rank'];
                            } 
							
							if (((int)$mastery['masteryId']) == 6241) {
								$insight = true;
							}
                        }
                        
                        array_push($playerMasteriesCount, "$offenseCount / $utilityCount / $defenseCount");
						array_push($playerMasteriesInsight, $insight);
						
                    }
                    



                }
                
                function getKeystoneMastery() {
                    global $postDataJSON;
                    
                    global $playerKeystoneMasteries;
                    global $playerKeystoneMasteriesDescription;
					
					global $patchFull;
                    
                    $i = 0;
                    
                    $url = "./datadragon/$patchFull/data/en_US/mastery.json";

					
					
                    $masteriesJSON_Global = json_decode(read_file($url)['body'], true);

                    $masteryIdsList = $masteriesJSON_Global['data'];
                    
                    //$masteries = $postDataJSON['participants'][$i]['masteries'];                    
                    //echo "<pre>" . print_r($masteries) . "</pre>";
                    
                    foreach ($postDataJSON['participants'] as $id => $player)
                    {   
                        $keystone = "X";
                        $keystoneDescription = "No keystone mastery.";
                        
                        foreach ($postDataJSON['participants'][$i]['masteries'] as $key => $data)
                        {
                            
                            
                            if ($data['masteryId'] % 100 > 60) {
                                $keystone = $data['masteryId'];
                                $keystoneDescription = $masteryIdsList[$keystone]['name'] . ". \n" . $masteryIdsList[$keystone]['description'][0];
                                //echo "<pre>" . print_r($masteryIdsList[$keystone]['description']) . "</pre>";
                            }
                        }
                                
                        $i++;

                        array_push($playerKeystoneMasteries, $keystone);
                        array_push($playerKeystoneMasteriesDescription, $keystoneDescription);
                    }


                }
                
                
                function drawBorder(&$img, &$color, $thickness = 1) 
                {
                    $x1 = 0; 
                    $y1 = 0; 
                    $x2 = ImageSX($img) - 1; 
                    $y2 = ImageSY($img) - 1; 

                    for($i = 0; $i < $thickness; $i++) 
                    { 
                        ImageRectangle($img, $x1++, $y1++, $x2--, $y2--, $color); 
                    } 
                }
                
                function getLeagueIcon($leagueName)
                {
                    return "rankicons/" . str_replace(" ", "_", strtolower($leagueName)) . ".png";
                }
                
                function round1($input) {
                    return round($input, 1, PHP_ROUND_HALF_UP);
                }
                function round2($input) {
                    return round($input, 2, PHP_ROUND_HALF_UP);
                }
                
                function _bot_detected() {

                    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
                      return TRUE;
                    }
                    else {
                      return FALSE;
                    }

                } 
                /*
				// Class to run parallel GET requests and return the transfer
				class ParallelGet
				{
					public $output = array();
					//public $test = "Hello, I'm a variable in the Class scope!";
					
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
					  //echo "<br>Adding $i: $url";
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
					  //echo "<br>Error!";
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
						//echo "Curl error on handle $i: $curlError<br>";
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

				  

				}*/

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
                
                
                
        </td>
        <td>
            <div id='skyscraperContainer2' style='height:600px; width: 160px;margin-left: 50px; background-color: #CFDFFF' class='shadow'>			
				<button style='float: left;' onclick="this.parentNode.remove();">X</button>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					 style="display:inline-block;width:160px;height:600px; margin-right: 50px;"
					 data-ad-client="ca-pub-6399216573107712"
					 data-ad-slot="1622310788"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>		
			</div>
            
        </td></tr></table>
        </div>  <!-- End main content div -->
		
		<script>
			
			var checkList = "" + 
				"<div style='font-size: x-small;'>" + 
				"<div>Mental Checklist:</div>" + 
				"<br>" + 
				"<div>Early Game:</div>" + 
				"<div>Statistical outliers?</div>" + 
				"<div>Runes/Masteries?</div>" + 
				"<div>Trade Mechanics?</div>" + 
				"<div>Jg Skirmishing power?</div>" + 
				"<div>Jungle paths?</div>" + 
				"<div>Posture okay?</div>" + 
				"<div>Hand in stable position?</div>" + 
				"<div>Level 1 invades?</div>" + 
				"<div>Power spikes?</div>" + 
				"<div>Which lanes have priority?</div>" + 
				"<div>Snowball potential?</div>" + 
				"<div>Who wants to roam?</div>" + 
				"<div>Should I TP or push?</div>" + 
				"<div>Am I safe to push?</div>" + 
				"<div>Or should I freeze?</div>" + 
				"<div>How long am I safe to push?</div>" + 
				"<div>Where is everybody?</div>" + 
				"<br>" + 
				"<div>Mid Game:</div>" + 
				"<div>Who is strong?</div>" + 
				"<div>Should we siege or pick?</div>" + 
				"<div>Should I group or split?</div>" + 
				"<div>Which team has more tanks?</div>" + 
				"<div>Who has initiation/pick?</div>" + 
				"<div>What's my job in skirmishes?</div>" + 
				"<div>What's my job on the map?</div>" + 
				"<div>Rotate, get Drake, or shove?</div>" + 
				"<br>" + 
				"<div>Late Game:</div>" + 
				"<div>How do teamfights work?</div>" + 
				"<div>What's my job?</div>" + 
				"<div>DPS? Zone? Protect? Initiate?</div>" + 
				"<div>Will I get zoned?</div>" + 
				"<div>Biggest threat to my carries?</div>" + 
				"<div>Biggest threat to me?</div>" + 
				"</div>";
				
				
			//Swap Ad Frame from left to right, randomly.
			if (new Date().getTime() % 2 == 0) {
				document.getElementById("skyscraperContainer2").innerHTML = checkList;
				
			} else {
				document.getElementById("skyscraperContainer").innerHTML = checkList;
				
			}
		</script>

		<script>
			$(document).ready(function(){
				getCounterData();

				
				
			});
			
			$( ".current_match_tbody" ).sortable({
				update: function(event, ui) {}
			});
			
			 	

			$( ".current_match_tbody" ).on( "sortupdate", function( event, ui ) {
				//Code to execute upon sorting.
				getCounterData();
			} );
			
			
			function getCounterData() {
				var current_match_team_0 = document.getElementById("current_match_team_0");
				
				//var team_0_rows = current_match_team_0.getElementsByTagName("tr");
				var team_0_rows = current_match_team_0.childNodes;
				
				//console.log(team_0_rows);
				
				var current_match_team_1 = document.getElementById("current_match_team_1");
				
				//var team_1_rows = current_match_team_1.getElementsByTagName("tr");
				var team_1_rows = current_match_team_1.childNodes;
				
				//var counterOutputTest = team_0_rows[0].getAttribute('id') + " vs " + team_1_rows[0].getAttribute('id') + " Top";
				
				
				$.getJSON("/data/championsSummary.json", function(championsSummary){
					
					//"Vladimir":{"role":{"Top":{"percentPlayed":57.57,"winRate":"46.77"},"Middle":
					
					var roles = ["Top", "Jungle", "Middle", "ADC", "Support"];
					
					$.each(roles, function(k, role){
						
						

						var role_team_0 = team_0_rows[k].getAttribute('id');
						var role_team_1 = team_1_rows[k].getAttribute('id');
						
						
						var matchupWinRateObject_0 = team_0_rows[k].getElementsByClassName('matchupWinRate')[0];
						var counterPowerObject_0 = team_0_rows[k].getElementsByClassName('counterPower')[0];

						var matchupWinRateObject_1 = team_1_rows[k].getElementsByClassName('matchupWinRate')[0];
						var counterPowerObject_1 = team_1_rows[k].getElementsByClassName('counterPower')[0];

						
						
						if (championsSummary[role_team_0] == undefined || championsSummary[role_team_0]['role'] == undefined || championsSummary[role_team_0]['role'][role] == undefined || championsSummary[role_team_0]['role'][role]['winRate'] == undefined 
							|| championsSummary[role_team_1] == undefined || championsSummary[role_team_1]['role'] == undefined || championsSummary[role_team_1]['role'][role] == undefined || championsSummary[role_team_1]['role'][role]['winRate'] == undefined) {
								//alert(role_team_0 + " vs " + role_team_1 + " has undefined!");
								matchupWinRateObject_0.innerHTML = '-';
								counterPowerObject_0.innerHTML = '-';
								
								matchupWinRateObject_0.setAttribute("data", null);
								counterPowerObject_0.setAttribute("data", null);								
								
								matchupWinRateObject_1.innerHTML = '-';
								counterPowerObject_1.innerHTML = '-';
								
								matchupWinRateObject_1.setAttribute("data", null);
								counterPowerObject_1.setAttribute("data", null);							
								
								
							} else {
								
										

								
								//championsSummary[role_team_1] == undefined || championsSummary[role_team_1]['role'] == undefined || championsSummary[role_team_1]['role'][role] == undefined || championsSummary[role_team_1]['role'][role]['winRate'] == undefined) 
									
									
								var role_team_0_global_winrate = championsSummary[role_team_0]['role'][role]['winRate'];
								var role_team_1_global_winrate = championsSummary[role_team_1]['role'][role]['winRate'];
								
								var avg = (parseFloat(role_team_0_global_winrate) + parseFloat(role_team_1_global_winrate)) / 2.0;					
								
								$.getJSON("/data/championgg/" + role_team_0 + '.json', function(result){
									
									
									
									
									$.each(result, function(i, field){
										//$("div").append(field + " ");
										//alert(i);
										
										//alert(role);
										if (field['role'] == role) {
											//alert(field['role']);
											
											field['matchups'][role_team_1];
											//alert(JSON.stringify(field['matchups']));
											
											$.each(field['matchups'], function(j, matchup) {
												if (matchup['key'] == role_team_1 && matchup['games'] >= 100) {
													var winRateMatchup = parseFloat(matchup['winRate']);
													
													var counterPower = (parseFloat(winRateMatchup) - parseFloat(avg)).toFixed(1);
													
													//alert(role_team_0 + " vs " + role_team_1 + " " + role + ":" + winRateMatchup + " (" + counterPower + ")");
													
													matchupWinRateObject_0.innerHTML = winRateMatchup;
													counterPowerObject_0.innerHTML = counterPower;													
													
													matchupWinRateObject_0.setAttribute("data", winRateMatchup);
													counterPowerObject_0.setAttribute("data", counterPower);
								
													matchupWinRateObject_1.innerHTML = 100 - winRateMatchup;
													counterPowerObject_1.innerHTML = -counterPower;
													
													matchupWinRateObject_1.setAttribute("data", 100 - winRateMatchup);
													counterPowerObject_1.setAttribute("data", -counterPower);
													
												} else if (matchup['key'] == role_team_1 && matchup['games'] < 100) {
													//alert("Only " + matchup['games'] + " played in " + role_team_0 + " vs " + role_team_1);
													matchupWinRateObject_0.innerHTML = '-';
													counterPowerObject_0.innerHTML = '-';
													
													matchupWinRateObject_0.setAttribute("data", null);
													counterPowerObject_0.setAttribute("data", null);
													
													matchupWinRateObject_1.innerHTML = '-';
													counterPowerObject_1.innerHTML = '-';													
													
													matchupWinRateObject_1.setAttribute("data", null);
													counterPowerObject_1.setAttribute("data", null);
												}
											});
										}
									});
									
									//alert(JSON.stringify(result));
								});									
								
								
								
							
							
							
							}
							
							
							
						

					});
					
				
				});
				
				

				
				//alert(counterOutputTest);

				}
			

		</script>        

    </body>

