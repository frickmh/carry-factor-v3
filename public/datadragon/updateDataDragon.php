<?php

	//The path to DataDragon.
	chdir("~/carry-factor-v3/public/datadragon");

	$url = "https://na1.api.riotgames.com/lol/static-data/v3/versions?api_key=RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3";
	
	$responseJSON = json_decode(get_web_page($url)['body']);
	
	$currentLOLVersion = $responseJSON[0];

	echo "<pre><div style='text-align: left'><br>Current Patch:"; print_r($currentLOLVersion); echo "</div></pre>";	
	
	
	//Get Installed Datadragon Patch
	$files = scandir("./");
	
	$patchFull = "6.15.1";
	$patchShort = "6.15";
	
	foreach ($files as $file) {
		if (is_numeric($file[0])) {
			$patchFull = $file;
			$patchNamePieces = explode(".", $patchFull);
			$patchShort = "$patchNamePieces[0].$patchNamePieces[1]";
		}				
	}
	
	echo "<pre><div style='text-align: left'><br>Current Installed Datadragon:"; print_r($patchFull); echo "</div></pre>";	
        
	//DataDragon patch!
	$url = "http://ddragon.leagueoflegends.com/cdn/dragontail-$currentLOLVersion.tgz";
	
        $currentPieces = explode(".", $currentLOLVersion);
        $currentLOLVersionShort = "$currentPieces[0].$currentPieces[1]";

        file_put_contents('patchFull.txt', $currentLOLVersion);
        file_put_contents('patchShort.txt', $currentLOLVersionShort);

	//Check if the installed DataDragon is different from the current LoL version.
	if ($patchFull !== $currentLOLVersion) {

			echo "<br>Current DataDragonVersion does NOT match the current LoL version!";
			
		//If they're different, check to see if the DataDragon tool is available for the latest LoL version.
		$file = $url;
		$file_headers = @get_headers($file);
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
			$exists = false;
			echo "\n<br>DDragon Ready: False!";
			echo "\n<br>Exiting...";
		}
		else {
			$exists = true;
			echo "\n<br>DDragon Ready: True!";
			
			echo "\n<br>Updating DataDragon...";
			
			//Download DataDragon here.
			set_time_limit(0);
			//This is the file where we save the    information
			$fp = fopen (dirname(__FILE__) . "/dragontail-$currentLOLVersion.tgz", 'w+');
			//Here is the file we are downloading, replace spaces with %20
			$ch = curl_init(str_replace(" ","%20",$url));
			curl_setopt($ch, CURLOPT_TIMEOUT, 1800);
			// write curl response to file
			curl_setopt($ch, CURLOPT_FILE, $fp); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

			/*
			//Progress functions.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');
			curl_setopt($ch, CURLOPT_NOPROGRESS, false); // needed to make progress function work
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);*/	
			
			$millisecondsStart = round(microtime(true) * 1000);
			
			echo "\nStarting Download at $millisecondsStart.";
			
			
			// get curl response
			curl_exec($ch); 
			curl_close($ch);
			fclose($fp);
			
			$millisecondsEnd = round(microtime(true) * 1000) - $millisecondsStart;			
			
			echo "\nDownload completed in $millisecondsEnd ms.";
			
			/*
			function progress($resource,$download_size, $downloaded, $upload_size, $uploaded)
			{
				if($download_size > 0)
					 echo $downloaded / $download_size  * 100;
				ob_flush();
				flush();
				sleep(1); // just to see effect
			}

			echo "Done";
			ob_flush();
			flush();			
			*/
			
			exec("tar -xvzf dragontail-$currentLOLVersion.tgz");
			
			
			//Scan the directory to remove old files and folders.
			exec("rm dragontail-$currentLOLVersion.tgz");
			echo "<br>Removed DataDragon tarball dragontail-$currentLOLVersion.tgz.";
			
			$files = scandir("./");
			
			foreach ($files as $file) {
				//Delete the old folders.
				if (is_numeric($file[0])) {
					if ($currentLOLVersion !== $file)
					{
						exec("rm -r $file");
						echo "<br>Removed old #.#.# folder.";
					}
				}
				if ($file == "lolpatch_$patchShort") {
					//Remove the old file.
					exec("rm -r $file");
					echo "<br>Removed old lolpatch_#.# folder.";
				}
				
			}			
			
                        $patchFull = $currentLOLVersion;
                        shell_exec("bash shrinkChampImages.sh $patchFull"); 

			echo "<br>DataDragon updated!  Old DataDragon removed!";

			
			
		}	
	}



	echo "<br>Script Complete.";
	
	/*
	echo "<br>URL $url Exists: "; $exists; echo "<br>";
	
	//Test if Current Patch exists!
	//NA Datadragon, to be used in final design
	$url = "http://ddragon.leagueoflegends.com/tool/na/en_US";
	
	$doc = new DOMDocument();
	//Load HTML from a file
	$doc->loadHTMLFile($url);
	// saveHTML() Dumps the internal document into a string using HTML formatting 
	echo $doc->saveHTML();
	
	

	

	//$x = $doc->documentElement;
	
	//echo "HTML Doc: "; echo $htmlDoc;

	
	$links = $doc->getElementsByTagName('a');
	//echo $img->attributes->getNamedItem("src")->value;
	
	foreach($links as $link) {
		
		echo "<pre><div style='text-align: left'><br>Node:", print_r($link); echo "</div></pre>";
		echo "<pre><div style='text-align: left'><br>Node:", var_dump($link->attributes); echo "</div></pre>";
		echo "<br><br>";
		
	}
	
	*/

	
	
	//echo $response;

                //******************************************************************** FUNCTIONS ***********************************************************************************
                
				
				function url_exists($url) {
					if (!$fp = curl_init($url)) return false;
					return true;
				}
				
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
				
?>				
