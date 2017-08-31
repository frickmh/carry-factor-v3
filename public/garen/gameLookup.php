<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$getData = filter_input_array(INPUT_GET);

$region = $getData['region'];
$name = $getData['name'];

$region1 = strtoupper($region) . '1';

$url = "https://$region.api.pvp.net/api/lol/$region/v1.4/summoner/by-name/" . $name . '?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833';

$response = json_decode(get_web_page("https://$region.api.pvp.net/api/lol/$region/v1.4/summoner/by-name/" . $name . '?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833')['body'], true);

$id = $response[$name]['id'];

$url = "https://$region.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$region1/$id?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833";

$response = json_decode(get_web_page($url)['body'], true);

//echo "<pre><div style='text-align: left'><br>Match Data:"; print_r($response); echo "</div></pre>";
echo json_encode($response);

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