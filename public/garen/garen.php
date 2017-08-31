<html>
    <head>
        <title>Garen Ultimate Calculator</title>
        <meta name="description" content="Calculate your Garen ultimate damage perfectly, against any champion.">
        <meta name="keywords" content="Garen Ultimate Calculator, Garen's Ultimate Calculator, Garen Ultimate Damage, Garen r damage, Garen lethal damage, Garen lethal ult, League of Legends">
        <link rel="shortcut icon" href="Garen_Passive.png">
        <!-- Google Analytics Tracking Script -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-60328206-6', 'auto');
            ga('send', 'pageview');

        </script>
        <script src="src/jquery-2.2.4.min.js"></script>		
    <style>
        body {
            background: #222222;
            color: #FFFFFF;
        }
        
        select {
            font-size: x-large;
        }
        
        button {
            margin-top: 20px;
            height: 30px;
        }
        
        .highlight {
            background: #005555;
        }
        
        .invisible {
            width: 500px;
        }
        
        .center {
            margin-left: auto;
            margin-right: auto;
            width: 115em;
        }
        
        .bigtext {
            font-size: x-large;            
        }
        
        .hugetext {
            font-size: 45px;
            text-align: center;
        }
		
		.democlass {
			color: #FF0000;
			background-color: #111111F8;
			width: 80vw;
			height: 50vw;
			position: absolute;
			left: 10vw;
			top: 12vw;
			text-align: center;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
        
    </style>
    </head>
    <body>

	
        <div style='width: 100%; background: #111111' align='center'><a href=""><img src='garen_banner.jpg' alt='Garen Ult Calculator'></a></div>
        <div name='mainDivision' class='center'>
            <table><tr><td style="padding-right: 80px; vertical-align: top; padding-top: 50px; ">

                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Garen Skyscraper 1 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:600px"
                     data-ad-client="ca-pub-6399216573107712"
                     data-ad-slot="1928757185"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                
                <div style="padding-top: 250px">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Garen Skyscraper 2 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:600px"
                     data-ad-client="ca-pub-6399216573107712"
                     data-ad-slot="1713274382"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                </div>
 
            </td>
            <td>
                        
                    
            <div>

    <table><tr>
    
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $getData = filter_input_array(INPUT_GET);
    
    //$summonerName = $getData('summoner') == NULL ? "" : $getData('summoner');

    $url = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";

    $response = get_web_page($url);
    
    $responseJSON = json_decode($response['body'], true);
    
    ksort($responseJSON['data']);
    
    //print_r($responseJSON['body']);
    
    echo "<td><table><tr><td><div>Your Name (Lookup)</div></td><td></td><td><div>Garen's Target</div></td></tr><tr><td><input value='$summonerName' id='summoner' type='text'></td><td><div>vs.</div></td><td><select id='champName' onChange='calcStats()'><br>";
    
    foreach ($responseJSON['data'] as $key => $data)
    {
        $champID = $data['id'];
        
        echo "<option id='$champID' value='$key'>$key</option>";
    }
    
    echo "</select></td></tr></table></td>";
    
    /*
    echo "<td><table><tr><td><div>Level</div></td></tr><tr><td><select id='level' onChange='calcStats()'><br>";

    for ($i = 1; $i < 19; $i++)
    {
        echo "<option value='$i'>$i</option>";
    }
    
    echo "</select></td></tr></table></td>";
     */
    
    echo "<td><button id='autoFill' onclick='autoFill()'>Lookup Runes/Masteries</button></td>";
    
    





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
                                //echo "<br>Line:<br>";
                                //var_dump($header_lines[$z]);
                                    
                                $position = strpos($header_lines[$z], $find);
                                
                                //echo "<br>Position: </br>";
                                
                                //var_dump($position);
                                
                                //echo "<br>Header Lines Count: </br>";
                                
                                //var_dump($count);
                                
                                //Check if header line contains 'Retry-After: '
                                if ( $position !== false && $position !== NULL && $position != -1)
                                {
                                    //echo "<br>Got Here!<br>";
                                    
                                    //echo "<br>Header:<br>";
                                    //var_dump($header);
                                    
                                    //echo "<br>Line:<br>";
                                    //var_dump($header_lines[$z]);
                                    
                                    //echo "<br>Position:<br>";
                                    //var_dump($position[$z]);
                                    
                                    //echo "<br>Length of key:<br>";
                                    //var_dump(strlen($find));
                                    
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
                    
                    /*
                    var_dump($code);
                    
                    echo "<br>";
                    
                    var_dump($body);
                    
                    echo "<br>";                    
                    */
                    
                    $output_array = [
                        "response_code" => $code,
                        "body" => $body,
                        "retry" => $retry_after
                    ];
                    
                    //var_dump($output_array);
                    
                    curl_close($ch);

                    return $output_array;        
                }



?>
            <td>
                <div>                
                    <select id="region" style="margin-top: 20px; font-size: medium">
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
                    </select>
                </div>
                <td><div id='lookupResult' style="margin-top: 20px; margin-left: 20px;"></div></td>
            </td>
        </tr>
    </table>

        <div class='bigtext'>Target's Masteries</div>
    <table>
        <tr>
            <td>
                <table><tr><td><div>Armor Flat</div></td></tr><tr><td><input value="9" id='armorFlat' type='number' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Armor Scaling @ 18</div></td></tr><tr><td><input value="0" id='armorScaling' type='number' onChange='calcStats()'></input></td></tr></table>
            </td>
            
            <td>
                <table><tr><td><div>MR Flat</div></td></tr><tr><td><input value="0" id='mrFlat' type='number' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>MR Scaling @ 18</div></td></tr><tr><td><input value="27" id='mrScaling' type='number' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>HP Flat</div></td></tr><tr><td><input value="0" id='hpFlat' type='number' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>HP Scaling @ 18</div></td></tr><tr><td><input value="0" id='hpScaling' type='number' onChange='calcStats()'></input></td></tr></table>
            </td>            
            <td>
                <table><tr><td><div>Veteran's Scars</div></td></tr><tr><td><input type='number' value="0" id='veteransScars' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Juggernaut</div></td></tr><tr><td><input type='checkbox' id='juggernaut' onChange='calcStats()' ></input></td></tr></table>
            </td>
        </tr>
        <tr>
            <td>
                <table><tr><td><div>Unyielding</div></td></tr><tr><td><input type='checkbox' id='unyielding' onChange='calcStats()' ></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Adaptive Armor</div></td></tr><tr><td><input type='checkbox' id='adaptiveArmor' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Enchanted Armor</div></td></tr><tr><td><input type='number' value="0" id='enchantedArmor' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Oppression</div></td></tr><tr><td><input type='checkbox' id='oppression' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Legendary Guardian</div></td></tr><tr><td><input type='checkbox' id='legendaryGuardian' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>MR from Items</div></td></tr><tr><td><input type='number' value="0" id='itemMr' onChange='calcStats()'></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>HP from Items</div></td></tr><tr><td><input type='number' value="0" id='itemHp' onChange='calcStats()'></input></td></tr></table>
            </td>
        </tr>
    </table>
    
    <div class='bigtext'>Garen's Masteries</div>
    <table>
        <tr>
            <td>
                <table><tr><td><div>Double Edged Sword</div></td></tr><tr><td><input type='checkbox' id='doubleEdgedSword' onChange='calcStats()' ></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Expose Weakness</div></td></tr><tr><td><input type='checkbox' id='exposeWeakness' onChange='calcStats()' ></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Battle Trance Stacks</div></td></tr><tr><td><input type='number' value="0" id='spellWeaving' onChange='calcStats()'></input></td></tr></table>
            </td>            
            <td>
                <table><tr><td><div>Executioner</div></td></tr><tr><td><input type='checkbox' id='executioner' onChange='calcStats()' ></input></td></tr></table>
            </td>
            <td>
                <table><tr><td><div>Battering Blows Points</div></td></tr><tr><td><input type='number' value="0" id='devastatingStrikes' onChange='calcStats()'></input></td></tr></table>
            </td>            
            <td>
                <table><tr><td><div>Havoc</div></td></tr><tr><td><input type='checkbox' id='havoc' onChange='calcStats()' ></input></td></tr></table>
            </td>
       
        </tr>
    </table>
    
    <table id='champStats'>
        <tr><td><div>Level</div></td><td><div>HP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td><td><div>Armor&nbsp;&nbsp;</div></td><td><div style='padding-right: 15em'>MR</div></td><td><div>Level</div></td><td><div>Lethal</div></td></tr>
        
        <?php
            for ($i = 1; $i < 19; $i++)
            {
                $class = "";
                
                if ($i == 6 || $i == 11 || $i == 16 ) {
                    $class = " class='highlight'";
                }
                
                echo "<tr><td $class><div>$i</div></td><td><div>0</div></td><td><div>0</div></td><td><div>0</div></td><td $class><div><b>$i</b></div></td><td $class><div><b>0</b></div></td></tr>";
            }
        ?>
    </table>
    <br><br><br>
    <div style="padding-left: 200px;">
    <h1>Game Readable Lethal Table</h1>
    <div class='bigtext'>Display:</div>
    <table><tr><td><table><tr><td><div>HP</div></td><td><input id='displayHp' type="checkbox" onclick="updateDisplay()" checked></td></tr></table></td><td><table><tr><td><div>Percent</div></td><td><input id='displayPercent' type="checkbox" onclick="updateDisplay()"></td><tr></table></td></tr></table>
    <br><br>
    <table id='lethalTable'>
        <colgroup>
            <col>
            <col id='hpColumn'>
            <col id='percentColumn'>
        </colgroup>
        <tr><td><div class='bigtext' style='padding-right: 25px'>Level</div></td><td><div class='bigtext' style='padding-left: 25px; padding-right: 25px'>Lethal HP</div></td><td><div class='bigtext' style='padding-left: 25px'>Lethal %</div></td></tr>
        
        <?php
            for ($i = 6; $i < 19; $i++)
            {
                $class = "class='hugetext'";
                
                if ($i == 6 || $i == 11 || $i == 16 ) {
                    $class = " class='highlight hugetext'";
                }
                
                echo "<tr><td $class><div>$i</div></td><td $class><div><b></b></div></td><td $class><div><b></b></div></td></tr>";
            }
        ?>
    </table>
    
    </div>
    
    <div id='id01'></div>
    
    <script>
        function calcStats() {
			
			
            var xmlhttp = new XMLHttpRequest();
            
            var url='https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
			
			
			$.ajax({
                    type: 'GET',
                    url: url,
                    //data: namesToSubmit,
                    
                    //dataType: Text,
                    beforeSend: function( xhr ) {
                        xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                    }            
                }).done(function(data) {
					//console.log("Ajax Champs: ");
					//console.log(JSON.parse(data));
						
					//var myArr = JSON.parse(xmlhttp.responseText);
					var myArr = JSON.parse(data);
					
					var name = document.getElementById('champName').value;
					
					//alert(name);

					//document.getElementById("id01").innerHTML = JSON.stringify(myArr.data[name]);
					
					var id = myArr.data[name].id;
					
					//alert(id);
					
					
					var xmlhttpStats = new XMLHttpRequest();
				
					var urlStats = 'https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/' + id + '?champData=stats&api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
				
					$.ajax({
							type: 'GET',
							url: urlStats,
							//data: namesToSubmit,
							
							//dataType: Text,
							beforeSend: function( xhr ) {
								xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
							}            
						}).done(function(data2) {					
							//console.log(data2);
							//console.log("Ajax ChampStats: ");
							//console.log(JSON.parse(data2));
							
							var stats = JSON.parse(data2);
							updateStats(stats);
							
						});
					
					/*
				
					xmlhttpStats.onreadystatechange = function() {
						var stats = JSON.parse(xmlhttpStats.responseText);
					   
						//console.log(stats.stats);
						console.log(xmlhttpStats.responseText);
					   
						//document.getElementById("id01").innerHTML = JSON.stringify(stats);
						
						updateStats(stats);
					};
					
					xmlhttpStats.open("GET", urlStats, false);
					xmlhttpStats.send();					
					*/
				});
			
            /*
        //Get the summoner ID's.
            xmlhttp.onreadystatechange = function() {
				

                var myArr = JSON.parse(xmlhttp.responseText);
                
                var name = document.getElementById('champName').value;
                
                //alert(name);

                //document.getElementById("id01").innerHTML = JSON.stringify(myArr.data[name]);
                
                var id = myArr.data[name].id;
                
                //alert(id);
                
                
                var xmlhttpStats = new XMLHttpRequest();
            
                var urlStats = 'https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/' + id + '?champData=stats&api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833';
            
                
                
            
                xmlhttpStats.onreadystatechange = function() {
                    var stats = JSON.parse(xmlhttpStats.responseText);
                   
				    //console.log(stats.stats);
					console.log(xmlhttpStats.responseText);
				   
                    //document.getElementById("id01").innerHTML = JSON.stringify(stats);
                    
                    updateStats(stats);
                };
                
                xmlhttpStats.open("GET", urlStats, false);
                xmlhttpStats.send();
				

            };
            xmlhttp.open("GET", url, false);
            xmlhttp.send();
			*/
            
        }        
        
        function updateStats(stats) {
            var unyielding = document.getElementById('unyielding');
                    
            stats.stats.attackrange > 200 ? unyielding.name = 'ranged' : unyielding.name = 'melee';
            
            for (var i = 1; i < 19; i++) {
                var statTable = document.getElementById('champStats');
                
                var lethalTable = document.getElementById('lethalTable');
                
                var level = i;
                
                var runesHpFlat = Number(document.getElementById('hpFlat').value);
                var runesHpScaling = Number(document.getElementById('hpScaling').value);
                
                var runesArmor = Number(document.getElementById('armorFlat').value);
                var runesArmorScaling = Number(document.getElementById('armorScaling').value);
                
                var runesMR = Number(document.getElementById('mrFlat').value);
                var runesMRScaling = Number(document.getElementById('mrScaling').value);
                
                var veteransScars = 10 * Number(document.getElementById('veteransScars').value);
                var juggernaut = 1.0 + .03 * Number(document.getElementById('juggernaut').checked);
                                
                var enchantedArmor = Number(document.getElementById('enchantedArmor').value);
                
                var hpBase = getStat(stats.stats.hp, stats.stats.hpperlevel, level);
                var arBase = getStat(stats.stats.armor, stats.stats.armorperlevel, level);
                var mrBase = getStat(stats.stats.spellblock, stats.stats.spellblockperlevel, level);
                
                var armorBonus = runesArmor + runesArmorScaling * level / 18.0;
                var mrBonus = runesMR + runesMRScaling * level / 18.0;
                
                mrBonus += Number(document.getElementById('itemMr').value);
                
                var hpItems = Number(document.getElementById('itemHp').value);
                
                if (document.getElementById('adaptiveArmor').checked)
                {
                    if (armorBonus > mrBonus) {
                        mrBonus *= 1.04;
                    }                    
                    if (mrBonus > armorBonus) {
                        armorBonus *= 1.04;
                    }
                }

                if (document.getElementById('legendaryGuardian').checked) {
                    armorBonus +=3;
                    mrBonus +=3;
                }
                
                armorBonus *= 1 + .025 * Number(document.getElementById('enchantedArmor').value);
                mrBonus *= 1 + .025 * Number(document.getElementById('enchantedArmor').value);

                var hp = (hpBase + hpItems + veteransScars + runesHpFlat + (runesHpScaling * level / 18.0)) * juggernaut;
                var armor = arBase + armorBonus;
                var mr = mrBase + mrBonus;
                
                var multiplier = damageBonus();
                var reduction = reductionCoefficient(mr);

                var lethal = lethalHP(reduction, multiplier, hp, i);

                statTable.rows[i].cells[1].innerHTML = Math.round(hp * 10) / 10;
                statTable.rows[i].cells[2].innerHTML = Math.round(armor * 10) / 10;
                statTable.rows[i].cells[3].innerHTML = Math.round(mr * 10) / 10;
                statTable.rows[i].cells[4].innerHTML = i;
                statTable.rows[i].cells[5].innerHTML = lethal;           
                
            }
            
            updateDisplay();
            
        }
        
        function damageBonus()
        {
            modifier = 1;
            
            document.getElementById('doubleEdgedSword').checked ? modifier += .05 : modifier = modifier;
            document.getElementById('exposeWeakness').checked ? modifier += .03 : modifier = modifier;
            document.getElementById('executioner').checked ? modifier += .05 : modifier = modifier;
            document.getElementById('havoc').checked ? modifier += .03 : modifier = modifier;
            modifier += .01 * Number(document.getElementById('spellWeaving').value);
            
            return modifier;            
        }
        
        function reductionCoefficient(resistance)
        {
            var shred = 1;
            
            var oppression = 1.0;
            
            document.getElementById('oppression').checked ? oppression = .98 : oppression = 1.0; 
            
            shred *= (1 - .014 * Number(document.getElementById('devastatingStrikes').value));
            
            var reduction = (100 + shred * resistance) / (100 * oppression);
            
            return reduction;
        }
        
        function lethalHP(reduction, multiplier, totalHP, level) 
        {   
            
            var unyieldingName = document.getElementById('unyielding').name;

            var unyieldingDR = 0;
            
            if (document.getElementById('unyielding').checked) {
                unyieldingName === 'melee' ? unyieldingDR = 2 : unyieldingDR = 1;
            }
            
            var coefficient = 0;
            var base = 0;
            
            switch(true)
            {
                case (level < 6): return 0; break;
                case (level >= 6 && level < 11): 
                    coefficient = 2.0 / 7.0; 
                    base = 175;
                    break;
                case (level >= 11 && level < 16): 
                    coefficient = 2.0 / 6.0; 
                    base = 350;
                    break;
                case (level >= 16): 
                    coefficient = 2.0/5.0; 
                    base = 525;
                    break;
                default: return 0; break;
            }                
            
            var M = multiplier;
            var B = base;
            var C = coefficient;
            var R = reduction;
            var HPt = totalHP;
            var U = unyieldingDR;
            
            
            lethal = ( M * ( B + C * HPt ) - U ) / ( R + M * C);
            
            return Math.floor(lethal);
        }
        
        function getStat(base, perLevelCoeff, level) {
            var B = base;
            var x = perLevelCoeff;
            var n = level;
            
			
			
			var growth = 0;
					
			for (var l = 1; l <= level; l++) {
				
				//console.log(l);
				
				if (l == 2)
					growth = growth + 0.72;
				
				if (l == 3)
					growth = growth + 0.755;
				
				if (l == 4)
					growth = growth + 0.79;
							 
				if (l >= 5 && l <= 17)
					growth = growth + l * 0.035 - 0.07 + 0.72;
			 
				if (l == 18)
					growth = growth + 1.28;
				
				//console.log(growth);
				
			}
			
			var stat = base + perLevelCoeff * growth;
				
			
            //var stat = B + x * ((7.0 /400.0) * (Math.pow(n, 2) - 1) + 267.0/400.0 * (n - 1));
            
            return stat;            
        }
        
        function autoFill()
        {
            //alert("Auto Fill Lookup WiP, Coming soon!");
            
            var name = document.getElementById('summoner').value;
            var region = document.getElementById('region').value;
            
            var xmlhttpGameInfo = new XMLHttpRequest();

            var urlGameInfo = 'gameLookup.php?region=' + region + '&name=' + name;

            xmlhttpGameInfo.onreadystatechange = function() {
                
                if (xmlhttpGameInfo.responseText.length > 0)
                {
                    document.getElementById('lookupResult').innerHTML = '';
                    
                    document.getElementById('armorFlat').value = 0;
                    document.getElementById('armorScaling').value = 0;
                    document.getElementById('mrFlat').value = 0;
                    document.getElementById('mrScaling').value = 0;
                    document.getElementById('hpFlat').value = 0;
                    document.getElementById('hpScaling').value = 0;
                    
                    document.getElementById('veteransScars').value = 0;
                    document.getElementById('juggernaut').checked = false;
                    document.getElementById('unyielding').checked = false;
                    document.getElementById('adaptiveArmor').checked = false;
                    document.getElementById('enchantedArmor').value = 0;
                    document.getElementById('oppression').checked = false;
                    document.getElementById('legendaryGuardian').checked = false;                    
                    
                    document.getElementById('doubleEdgedSword').checked = false;
                    document.getElementById('exposeWeakness').checked = false;
                    document.getElementById('spellWeaving').value = "0";
                    document.getElementById('executioner').checked = false;
                    document.getElementById('devastatingStrikes').value = "0";
                    document.getElementById('havoc').value = false;                    


                    //document.getElementById('id01').innerHTML = xmlhttpGameInfo.responseText;
                    var gameInfo = JSON.parse(xmlhttpGameInfo.responseText);                    
                    
                    
                    for(var i = 0; i < gameInfo.participants.length; i++) {
                        var id = JSON.stringify(gameInfo.participants[i].championId);
                        
                        var champName = document.getElementById(id).value;
                        
                        var selectedChamp = document.getElementById('champName').value;
                        
                        //alert("Champion Name: " + champName + "    Selected: " + selectedChamp);
                        
                        if (champName.valueOf() == selectedChamp.valueOf()) {
                            document.getElementById('lookupResult').innerHTML += 'Found ' + champName + '! ';

                            
                            for (var j = 0; j < gameInfo.participants[i].runes.length; j++) {
                                
                                
                                
                                if (gameInfo.participants[i].runes[j].runeId == 5317) {
                                    document.getElementById('armorFlat').value = Number(document.getElementById('armorFlat').value) + Number(gameInfo.participants[i].runes[j].count);
                                }
                                if (gameInfo.participants[i].runes[j].runeId == 5225) {
                                    document.getElementById('armorFlat').value = Number(document.getElementById('armorFlat').value) + Number(gameInfo.participants[i].runes[j].count) * 3.32;
                                }
                                
                                if (gameInfo.participants[i].runes[j].runeId == 5318) {
                                    document.getElementById('armorScaling').value = Number(document.getElementById('armorScaling').value) + Number(gameInfo.participants[i].runes[j].count) * 3;
                                }
                                if (gameInfo.participants[i].runes[j].runeId == 5348) {
                                    document.getElementById('armorScaling').value = Number(document.getElementById('armorScaling').value) + Number(gameInfo.participants[i].runes[j].count) * 6.84;
                                }
                                
                                if (gameInfo.participants[i].runes[j].runeId == 5289) {
                                    document.getElementById('mrFlat').value = Number(document.getElementById('mrFlat').value) + Number(gameInfo.participants[i].runes[j].count) * 1.34;
                                }
                                if (gameInfo.participants[i].runes[j].runeId == 5349) {
                                    document.getElementById('mrFlat').value = Number(document.getElementById('mrFlat').value) + Number(gameInfo.participants[i].runes[j].count) * 4;
                                }
                                
                                if (gameInfo.participants[i].runes[j].runeId == 5290) {
                                    document.getElementById('mrScaling').value = Number(document.getElementById('mrScaling').value) + Number(gameInfo.participants[i].runes[j].count) * 3;
                                }
                                if (gameInfo.participants[i].runes[j].runeId == 5350) {
                                    document.getElementById('mrScaling').value = Number(document.getElementById('mrScaling').value) + Number(gameInfo.participants[i].runes[j].count) * 6.66;
                                }
                                
                                if (gameInfo.participants[i].runes[j].runeId == 5315) {
                                    document.getElementById('hpFlat').value = Number(document.getElementById('hpFlat').value) + Number(gameInfo.participants[i].runes[j].count) * 8;
                                }
                                if (gameInfo.participants[i].runes[j].runeId == 5350) {
                                    document.getElementById('hpFlat').value = Number(document.getElementById('hpFlat').value) + Number(gameInfo.participants[i].runes[j].count) * 26;
                                }
                                
                                if (gameInfo.participants[i].runes[j].runeId == 5316) {
                                    document.getElementById('hpScaling').value = Number(document.getElementById('hpScaling').value) + Number(gameInfo.participants[i].runes[j].count) * 24;
                                }
                                if (gameInfo.participants[i].runes[j].runeId == 5346) {
                                    document.getElementById('hpScaling').value = Number(document.getElementById('hpScaling').value) + Number(gameInfo.participants[i].runes[j].count) * 48.6;
                                }                                
                        
                            }
                            
                            for (var j = 0; j < gameInfo.participants[i].masteries.length; j++) {
                                
                                if (gameInfo.participants[i].masteries[j].masteryId == 4221) {
                                    document.getElementById('unyielding').checked = true;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4222) {
                                    document.getElementById('veteransScars').value = Number(gameInfo.participants[i].masteries[j].rank);
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4232) {
                                    document.getElementById('juggernaut').checked = true;
                                }                                
                                if (gameInfo.participants[i].masteries[j].masteryId == 4233) {
                                    document.getElementById('armorFlat').value = Number(document.getElementById('armorFlat').value) + .5;
                                    document.getElementById('armorFlat').value = Number(document.getElementById('armorFlat').value) + Number(gameInfo.participants[i].masteries[j].rank) * 1.5;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4234) {
                                    document.getElementById('mrFlat').value = Number(document.getElementById('mrFlat').value) + .5;
                                    document.getElementById('mrFlat').value = Number(document.getElementById('mrFlat').value) + Number(gameInfo.participants[i].masteries[j].rank) * 1.5;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4242) {
                                    document.getElementById('adaptiveArmor').checked = true;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4252) {
                                    document.getElementById('enchantedArmor').value = Number(gameInfo.participants[i].masteries[j].rank);
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4253) {
                                    document.getElementById('oppression').checked = true;
                                }                                
                                if (gameInfo.participants[i].masteries[j].masteryId == 4262) {
                                    document.getElementById('legendaryGuardian').checked = true;
                                }                                
                            }
                        }
                        
                        if (champName.valueOf() == 'Garen') {
                            document.getElementById('lookupResult').innerHTML += 'Found Garen! ';

                            
                            
                            
                            for (var j = 0; j < gameInfo.participants[i].masteries.length; j++) {
                                if (gameInfo.participants[i].masteries[j].masteryId == 4111) {
                                    document.getElementById('doubleEdgedSword').checked = true;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4121) {
                                    document.getElementById('exposeWeakness').checked = true;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4131) {
                                    document.getElementById('spellWeaving').value = 2;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4134) {
                                    document.getElementById('executioner').checked = true;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4152) {
                                    document.getElementById('devastatingStrikes').value = gameInfo.participants[i].masteries[j].rank;
                                }
                                if (gameInfo.participants[i].masteries[j].masteryId == 4162) {
                                    document.getElementById('havoc').checked = true;
                                }                                
                            }

                        }
                        
                    };
                    document.getElementById('lookupResult').innerHTML += 'Game lookup successful!';
                    
                    calcStats();
                    
                } else {
                    document.getElementById('lookupResult').innerHTML = 'Game lookup failed.';
                }                 
            };

            xmlhttpGameInfo.open("GET", urlGameInfo, false);
            xmlhttpGameInfo.send();
        }
        
        function updateDisplay()
        {
            var lethalTable = document.getElementById('lethalTable');
            var statTable = document.getElementById('champStats');
            
            var cell = 1;
            
            if (document.getElementById('displayHp').checked) {
                lethalTable.rows[0].cells[1].childNodes[0].innerHTML = 'Lethal HP';
                
                for (var i = 1; i < 14; i++){
                    lethalTable.rows[i].cells[1].childNodes[0].innerHTML = statTable.rows[i + 5].cells[5].innerHTML;
                }

            } else {
                lethalTable.rows[0].cells[1].childNodes[0].innerHTML = '';
                
                for (var i = 1; i < 14; i++){
                    lethalTable.rows[i].cells[1].childNodes[0].innerHTML = "";
                }
            }
            if (document.getElementById('displayPercent').checked) {
                lethalTable.rows[0].cells[2].childNodes[0].innerHTML = 'Lethal %';
                
                for (var i = 1; i < 14; i++){
                    lethalTable.rows[i].cells[2].childNodes[0].innerHTML = Math.round(100 * Number(statTable.rows[i + 5].cells[5].innerHTML) * 10 / Number(statTable.rows[i + 5].cells[1].innerHTML)) / 10 + " %";
                }
                
            } else {
                lethalTable.rows[0].cells[2].childNodes[0].innerHTML = '';
                
                for (var i = 1; i < 14; i++){
                    lethalTable.rows[i].cells[2].childNodes[0].innerHTML = "";
                }
            }
        }
    </script>

	
    </div>
            <br><br><br><br><br>
            <h3>Advertising Support</h3>
            

            <div>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Garen Bottom Leaderboard 1 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-6399216573107712"
                     data-ad-slot="7835689986"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <br>
            <p>The Garen Ult Calculator isn't endorsed by Riot Games and doesn't reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends &#169; Riot Games, Inc.</p>
            </td><td >
                <div style="width: 300px; background: #880088;">

                </div></td></tr></table>
        </div> <!-- Close main Division -->
		
		<script src="ads2.js"></script>
		<script>
		if( window.canRunAdsGaren2 === undefined ){
			
			//I should probably make an image so it's not filtered out.
			var div = document.createElement("div");
			div.setAttribute("class", "democlass"); 
			
			var para = document.createElement("h2");
			div.appendChild(para);
			var t = document.createTextNode("We do what is Right!");
			para.appendChild(t);			
			
			var para = document.createElement("h3");
			div.appendChild(para);
			var t = document.createTextNode("AdBlock is ON!");
			para.appendChild(t);
			
			var para = document.createElement("p");
			div.appendChild(para);
			var t = document.createTextNode("Please help me continue to dispense Justice by paying for the cost of the server!  Please disable AdBlock, then Refresh the page.");
			para.appendChild(t);
			
			var img = document.createElement("img");
			img.setAttribute("src", "GarenSword.png"); 
			img.setAttribute("height", "800"); 
			div.appendChild(img);
			//var t = document.createTextNode("Please help me continue to dispense Justice by paying for the cost of the server!  Please disable AdBlock, then Refresh the page.");
			para.appendChild(t);

			document.body.appendChild(div);
			
		}
		</script>		
	
    </body>

</html>