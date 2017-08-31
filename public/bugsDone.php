<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Carry-Factor.com Bug reporting</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="website/diamond_i_favicon.png">
        <link rel="stylesheet" type="text/css" href="bronzodia.css">
    </head>
    <body>
                <div id="main_content_div" align="center">
		<div style='width: 100%;' class="brown"><a href="index.html"><img src='website/banner-carry-factor.png' alt='Carry-Factor.com - LoL Stats Command Center.  Stats, Counterpicks, and Cooldowns'></a></div>

        <div>
            <h2>Bug Report Received!</h2>


        
        
        </div>
        
        
        <?php
        // put your code here
            $postData = filter_input_array(INPUT_POST);
            
            $summonerName = $postData['summonerName'];
            $region = $postData['region'];
            $browser = $postData['browser'];
            $url = $postData['url'];
            $description = $postData['description'];
            $steps = $postData['steps'];
            
            $recaptcha = $postData['g-recaptcha-response'];
            
            $urlRecaptcha = "https://www.google.com/recaptcha/api/siteverify";
            
            $dataRecaptcha = array(
                "secret" => "6Ld54hYUAAAAABcJorc-ID28Jd0BvZAMNHjZ179r",
                "response" => $recaptcha
            );
            
            $response = curl_post($urlRecaptcha, $dataRecaptcha);
            
            //$response = post_web_page($urlRecaptcha, $dataRecaptcha);
                        
            $recaptchaJSON = json_decode($response, TRUE);

            //echo "<div style='text-align:left'><pre><br>Recaptcha:<br>"; print_r($recaptchaJSON); echo "<br></pre></div>";
            
            echo "<h3>Summary of bug report:</h3>";
        
            echo "<table>"
                . "<tr><td>$summonerName</td></tr>"
                . "<tr><td>$region</td></tr>"
                . "<tr><td>$browser</td></tr>"
                . "<tr><td>$url</td></tr>"
                . "<tr><td>$description</td></tr>"
                . "<tr><td>$steps</td></tr>"
                . "<tr><td></td></tr></table>";
            
            
            if ($recaptchaJSON['success']) {
                
                $myfile = fopen("bugsList.txt", "a") or die("Unable to open file!");
                fwrite($myfile, date('l F jS Y h:i:s A') . "\n");
                fwrite($myfile, $summonerName . "\n");
                fwrite($myfile, $region . "\n");
                fwrite($myfile, $browser . "\n");
                fwrite($myfile, $url . "\n");
                fwrite($myfile, $description . "\n");
                fwrite($myfile, $steps . "\n\n\n");
                fclose($myfile);
            }
            
            /**
            * Send a POST requst using cURL
            * @param string $url to request
            * @param array $post values to send
            * @param array $options for cURL
            * @return string
            */ 
            function curl_post($url, array $post = NULL, array $options = array())
            {
                $defaults = array(
                    CURLOPT_POST => 1,
                    CURLOPT_HEADER => 0,
                    CURLOPT_URL => $url,
                    CURLOPT_FRESH_CONNECT => 1,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FORBID_REUSE => 1,
                    CURLOPT_TIMEOUT => 4,
                    CURLOPT_POSTFIELDS => http_build_query($post)
                );

                $ch = curl_init();
                curl_setopt_array($ch, ($options + $defaults));
                if( ! $result = curl_exec($ch))
                {
                    trigger_error(curl_error($ch));
                }
                curl_close($ch);
                return $result;
            } 
            
            
            function post_web_page($url, $data_to_post) {
                    //url-ify the data for the POST
                    
                    //open connection
                    $ch = curl_init();

                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST, 1);
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $data_to_post);
                    curl_setopt(CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    
                    //execute post
                    $result = curl_exec($ch);
                    //echo $result;
                    
                    /*

                    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

                    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    $body = substr($result, $header_size);

                    $output_array = [
                        "response_code" => $code,
                        "body" => $body,
                    ];
                    
                    curl_close($ch);*/

                    return $output_array;        
                }
            
        ?>
        
        <div  align="center" style='margin: 0 auto'>
            <button class='bigButton shadow' onclick="returnToHome();">Done</button>
            <button class='bigButton shadow' onclick="reportBug();">Report Another Bug</button>
            <button class='bigButton shadow' onclick="viewBugsList();">View Bug List</button>
            
        
        </div>
        <br><br>
                <div style='width: 100%;' class='brown'><table><tr><td><img src="website/diamond_i.png" alt='diamond_i.png'></td><td style='width: 100%; font-size: 36px; text-align: center; color: #FFFFFF'>
                <div id="LeaderboardBottom"  style='box-shadow: 10px 10px 5px rgba(50, 50, 50, .6);width:728px;height:90px;text-align: center; margin: 0 auto' align='center'>
              
                </div>
            </td><td><img src="website/diamond_i.png" alt='diamond_i.png' style="filter: fliph"></td></tr></table></div>
        </div>
        
        <script>
            function returnToHome() {
                window.location.href = 'index.html';
            }
            
            function viewBugsList() {
                window.location.href = 'bugsList.php';
    
            }
            
            function reportBug() {
                window.location.href = 'bugs.html';    
            }            
        
        </script>
        
    </body>
</html>
