<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
	//Called by matchupsTest.php
	
	//chdir("/var/www/public_html/datadragon");

    $getData = filter_input_array(INPUT_GET);
    
    $champ = $getData['champ'];
    
    $outputUrl = "championgg/$champ.json";
    //$outputUrl = "championgg_data.php";

    
    /*
    echo "Testing: <br>";
    echo "File exists: <br>";
    print_r(file_exists($outputUrl) ? "Yes<br>" : "No<br>");
    
    echo "End test. <br>";*/

    if (file_exists($outputUrl)) {
        get_existing_champData();
    } else {
        create_new_champData();
    }
    
    
    //print_r($response);

    
    function get_existing_champData() {
        $getData = filter_input_array(INPUT_GET);
        $champ = $getData['champ'];        
        $url = getcwd() . "/championgg/$champ.json";
        
		echo "Hello from matchups.php!  URL: $url.";
		
        $responseJSON = json_decode(read_file($url)['body'], true);
        

		echo "\n" . var_dump($responseJSON['updated']);

        
        echo "Update Age:<br>";
        
        $age = time() - intval($responseJSON['updated']);
        
        print_r($age);
        
        if($age > 12*60*60) {
            create_new_champData();
        } else {
            $response = json_encode($responseJSON);
            print_r($response);
        }
    }
    
    function create_new_champData() {
        $getData = filter_input_array(INPUT_GET);
        
        $champ = $getData['champ'];

        $key = '41619a09cb6cbe21e7c399d7f7053993';
        
        $url = "http://api.champion.gg/champion/$champ?api_key=$key";

        $response = get_web_page($url);



        $responseJSON = json_decode($response['body'], TRUE);


        $outputJSON = array();

        foreach($responseJSON as $key => $data){

            usort($data['matchups'], function($a, $b) {
                return ($a['statScore'] - $b['statScore']) > 0 ? 1 : -1;
            });

            array_push($outputJSON, $data);

        }
        
        array_push($outputJSON, array(['updated'] => time()));
        
        
        $outputUrl = "./championgg/$champ.json";
        
        $outputFile = fopen($outputUrl, "w") or die ("Unable to open file!");
        
        $response = json_encode($outputJSON);
        
        fwrite($outputFile, $response);
        
        fclose($outputFile);

        
        
        //echo "<br><br><br>JSON Contents: <br><br>";
        
        print_r($response);
    }



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
    