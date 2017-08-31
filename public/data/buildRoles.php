<?php

	echo "Starting buildRoles.php...";
	
	echo "Starting buildRoles.php again...";
	
	chdir("/var/www/public_html/data");
	
	echo "\n Directory changed!";
	
	$host = "http://www.carry-factor.com";
	
	$url = $host . "/data/championgg/allChampRoles.json";

	//echo "\n" . json_decode(get_web_page($url)['body'], true) . "\n";

	echo "\n Testing All Champ Roles:";

	
	$allChampRoles = json_decode(get_web_page($url)['body'], true);
	
	echo "\n Got Web Page.";
	
	echo "<pre><div style='text-align: left'><br>Champs List:<br>"; print_r($allChampRoles); echo "</div></pre>";
	
	$outputJSON = array();
	
		
	
	
	foreach($allChampRoles as $champJSON) {
		$champName = $champJSON['key'];
		
		
		//echo "\nChampion: " . $champName;
		
		
		//echo "<pre><div style='text-align: left'><br>Champs List:<br>"; print_r($champJSON['roles']); echo "</div></pre>";

		foreach($champJSON['roles'] as $role) {
			
			//echo("\nChampion: " . $champName . " \t\tRole: " . $role['name'] . "\n");

			//echo "\n\n<pre><div style='text-align: left'><br>Role:<br>"; print_r($role); echo "</div></pre>";
			
			$outputJSON[$champName]['role'][$role['name']]['percentPlayed'] = $role['percentPlayed']; //dd.dd
			
			
			$url = $host . "/data/championgg/general/$champName.json";
			$champDetails = json_decode(get_web_page($url)['body'], true);
			
			
			//Get Role winrate next.
			//$outputJSON['$champName']['role']['winRate'] = $champDetails[];
			
			//Need another forEach loop.
			
			
			foreach($champDetails as $roleDetailed) {
				$outputJSON[$champName]['role'][$roleDetailed['role']]['winRate'] = $roleDetailed['winPercent']['val'];
			}
			
			
		}
		
		
		
		
	}
	
	//echo "<pre><div style='text-align: left'><br>Champs List:<br>"; print_r($outputJSON); echo "</div></pre>";
	
	$file = "championsSummary.json";
	
	file_put_contents($file, json_encode($outputJSON,TRUE));
	
	
	
	//$fp = fopen (dirname(__FILE__) . '/dragontail-$currentLOLVersion.tgz', 'w+');
	
	/*
	{
		"Ryze": {
					"Roles" : {
								"Mid" : {
									"percentPlayed" : "40%",
									"winRate" : "49%"
								},
								"Top" : {
									"percentPlayed" : "50%",
									"winRate" : "51%"
									
								}
							
							}
				},
	}
	*/
	
	
	
//************************** FUNCTIONS ***************************************
	
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

	



	
?>