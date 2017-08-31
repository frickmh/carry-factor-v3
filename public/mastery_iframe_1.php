<html>
    <style>
        img {
            position: absolute;
            top: 0px;
            left: 0px;
        }
        h3 {
            position: absolute;
            top: 0px;
            left: 0px;
            color: #FFFFFF;
        }
        img.mastery {
            border-style: solid;
            border-width: 2px;
            color: #555555;
        }
        div.mastery {
            position:absolute;
            background: #000000;
            border-style: solid;
            border-width: 1px;
            color: #888888;
            font-size: small;
        }
    </style>
    <head></head>
    <body>
        <!--
		<img src="mastery/masteryback.jpg" alt="Masteries" style="top:0px; left: 0px">
		-->
		<img src="mastery/Masteries_Background.png" alt="Masteries" style="top:0px; left: 0px">

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$getData = filter_input_array(INPUT_POST);
$postDataJSON = json_decode($getData['post'], true);
$region = $postDataJSON['region'];
$patchFull = $postDataJSON['patchFull'];
$patchShort = $postDataJSON['patchShort'];
$playerNumber = json_decode($getData['playerNumber'], true);


//echo "<pre><div style='text-align: left'>";
//print_r($playerNumber);

//print_r($postDataJSON);

$masteriesPlayer = $postDataJSON['participants'][$playerNumber]['masteries'];

//print_r($masteriesPlayer);
//echo "</div></pre>";

$url = "./datadragon/$patchFull/data/en_US/mastery.json";

$masteriesJSON_Global = json_decode(read_file($url)['body'], true);


$masteryIdsList = $masteriesJSON_Global['data'];

foreach($masteryIdsList as $id => $mastery)
{
    array_merge($masteryIdsList[$id]['rank'], array('rank' => 0));
    //$masteryIdsList[$id]['rank'] = 0;
}

$url = "./datadragon/$patchFull/data/en_US/mastery.json";
$masteriesJSON_Global = json_decode(read_file($url)['body'], true);

$offenseCount = 0;
$defenseCount = 0;
$utilityCount = 0;

//var_dump("<br><p>Global Masteries Test:</p><br>");
//var_dump($masteriesJSON_Global);

//var_dump("<br>Player Masteries Test:<br>");
//var_dump($masteriesPlayer);



foreach ($masteriesPlayer as $key => $data) {
    //echo "Updated!<br>";
    //var_dump($key);
    //var_dump($data);
    //var_dump($masteryIdsList[$data['masteryId']]);
    $masteryIdsList[$data['masteryId']]['rank'] = $data['rank'];
    //array_replace($masteryIdsList[$data['masteryId']]['rank'], $data['rank']);

}

//var_dump($masteryIdsList);
//echo "($masteriesPlayer)";

foreach ($masteryIdsList as $key => $data) {

    //echo( "<br>Id: $id\n" );
    //echo( "<br>Key: $key\n" );

    $pad_out_x = 24;
    $pad_in_x = 12;

    $pad_out_y = 21;
    $pad_in_y = 23.3;

    $page_width = 275;

    //$id = $data['masteryId'];
    $id = $key;
    $ranks = $data['rank'] !== NULL ? $data['rank'] : 0;
    $description = $data['name'] . ": ";
    
    //var_dump($key);
    //var_dump($description);
    //var_dump($data);
    
    
    if ($ranks == 0)
    {
        $description .= $data['description'][0];
    } else
    {
        $description .= $data['description'][$ranks - 1];
    }
    
    $description = str_replace('<br>', '&#10;', $description);
    $description = str_replace("'", "&#39;", $description);
    
    $maxRanks = $masteriesJSON_Global['data'][$id]['ranks'];
    
    if ($maxRanks == NULL) {
        continue;
    }
    
    //print_r($key);
    
    if ($id % 1000 < 200) { $offenseCount += $ranks; } else if ($id % 1000 < 300) { $defenseCount += $ranks; } else { $utilityCount += $ranks; }
    

    $page = floor(floor(($id % 1000)) / 100) - 1;
    
    if ($page == 1) {
        $page = 2;
    } else if ($page == 2) {
        $page = 1;
    }
    
    $row = floor(floor(($id % 100)) / 10) - 1;
    $col = ($id % 10) - 1;
    
    //Fix Ferocity page
    if ($page == 0) {
        if ($row == 5 && $col == 3) {
            $col = 2;
        } else if ($col == 3) {
            $col = 1;
        }
    }
    
    //Fix Cunning page
    if ($page == 1) {
        if ($row == 3) {
            /*if ($col == 1) {
                $col = 0;
            } else if ($col == 2) {
                $col = 1;
            }*/
        }
    }
    
    //Fix Resolve page
    if ($page == 2) {
        if ($row == 1) {
            if ($col ==2) {
                $col = 1;
            }
			else if ($col ==1) {
                $col = 2;
            }

        }
    }
    

    //echo( "<br>Page: $page\n" );
    //echo( "<br>Row: $row\n" );
    //echo( "<br>Col: $col\n" );

    //$layer_width = imagesx($image_layer);
    //$layer_height = imagesy($image_layer);
    $layer_width = 48;
    $layer_height = 48;

    //echo( "<br>Layer width: $layer_width\n" );
    //echo( "<br>Layer height: $layer_height\n" );
    
    $row_space_first = 20;
    $row_space_next = 83;
    
    if ($row % 2 == 1) {
        $row_space_first = 56;
        $row_space_next = 20;
    }
    
	//Fix horizontal alignment of rows with 3 Masteries in them (Might have to write dynamic code later, but for now it's okay)
    if ($row == 5 || ($page == 1 && $row == 1) || ($page == 1 && $row == 3) || ($page == 0 && $row == 1) || ($page == 0 && $row == 3) || ($page == 2 && $row == 1) || ($page == 2 && $row == 3)) {
        $row_space_first = 22;
        $row_space_next = 19;
    }


    $dst_x = $page * $page_width + $pad_out_x + $row_space_first + $col * ($layer_width + $row_space_next);
    $dst_y = $pad_out_y + $row * ($layer_height + $pad_in_y);
    $dst_x_string = $dst_x . 'px';
    $dst_y_string = $dst_y . 'px';

    $dst_x_label = $dst_x + 25;
    $dst_y_label = $dst_y + 40;
    $dst_x_label_string = $dst_x_label . 'px';
    $dst_y_label_string = $dst_y_label . 'px';


    $color_border = "555555";
    if ($ranks > 0 && $ranks < $maxRanks)
    {
        $color_border = "55FF55";
    } else if ($ranks == $maxRanks)
    {
        $color_border = "FFFF55";
    }
    
    //echo "<img src='mastery/buildMasteryTile.php?id=$id&rank=$ranks&maxRank=$maxRanks' alt='$id' title='$description' style='top:$dst_y_string; left:$dst_x_string'>";

    if ($ranks > 0) {
        //echo "<img src='mastery/$id.jpg' alt='$id' title='$description' class='mastery' style='top:$dst_y_string; left:$dst_x_string; border-color:#$color_border; background-color:#999999; height: 48px;'>";
		echo "<img src='datadragon/$patchFull/img/mastery/$id.png' alt='$id' title='$description' class='mastery' style='top:$dst_y_string; left:$dst_x_string; border-color:#$color_border; background-color:#999999; height: 48px;'>";
    } else {
        //echo "<img src='mastery/gray_$id.jpg' alt='$id' title='$description' class='mastery' style='top:$dst_y_string; left:$dst_x_string; border-color:#$color_border; background-color:#999999; height: 48px;'>";
		echo "<img src='datadragon/$patchFull/img/mastery/gray_$id.png' alt='$id' title='$description' class='mastery' style='top:$dst_y_string; left:$dst_x_string; border-color:#$color_border; background-color:#999999; height: 48px;'>";
    }
    
    $color_text = "888888";
    if ($ranks > 0 && $ranks < $maxRanks)
    {
        $color_text = "30FF30";
    } else if ($ranks == $maxRanks)
    {
        $color_text = "FFFF30";
    }
    
    //echo "<img src='mastery/buildMasteryRank.php?id=$id&rank=$ranks&maxRank=$maxRanks' alt='$id' title='$description' style='top:$dst_y_label_string; left:$dst_x_label_string'>";
    echo "<div class='mastery' style='top:$dst_y_label_string; left:$dst_x_label_string; color: #$color_text'>&nbsp&nbsp$ranks/$maxRanks&nbsp&nbsp</div>";

    //echo( "<br>Key: $key\n" );

    //$output_width = imagesx($imageOut);
    //$output_height = imagesy($imageOut);

    //echo( "<br>Output width: $output_width\n" );
    //echo( "<br>Output height: $output_height\n" );

    //imagecopy($dst_im, $src_im, $page_width, $pad_in, $pad_out, $y, $x, $src_h)

    /*
    if ($ranks < $maxRanks)
    {
        $color = imagecolorallocate($image_layer, 50, 255, 50);
    } else
    {
        $color = imagecolorallocate($image_layer, 255, 255, 50);
    }    
    drawBorder($image_layer, $color, 2);

    imagecopy($imageOut, $image_layer, $dst_x, $dst_y, 0, 0, $layer_width, $layer_height);

    $output_width = imagesx($imageOut);
    $output_height = imagesy($imageOut);

    //echo( "<br>Output width: $output_width\n" );
    //echo( "<br>Output height: $output_height\n" );




    
    //This works
    //imagejpeg($imageOut, $fn);          
    
    // Create a blank image and add some text
    $imageMasteryRank = imagecreatetruecolor(30, 20);
    if ($ranks < $maxRanks)
    {
        $text_color = imagecolorallocate($imageMasteryRank, 55, 255, 55);
    } else {
        $text_color = imagecolorallocate($imageMasteryRank, 255, 255, 55);
    }
    imagestring($imageMasteryRank, 2, 6, 4,  "$ranks/$maxRanks", $text_color);
    
    
    if ($ranks < $maxRanks)
    {
        $color = imagecolorallocate($imageMasteryRank, 30, 255, 30);        
    } else {
        $color = imagecolorallocate($imageMasteryRank, 255, 255, 30);     
    }
    drawBorder($imageMasteryRank, $color, 1);
    
    $imageMasteryRank_Width = imagesx($imageMasteryRank);
    $imageMasteryRank_Height = imagesy($imageMasteryRank);
    
    imagecopy($imageOut, $imageMasteryRank, $dst_x + 20, $dst_y + 40, 0, 0, $imageMasteryRank_Width, $imageMasteryRank_Height);

    //echo "\nGot Here.";
     
     */
}

//imagealphablending($final_img, true);
//imagesavealpha($final_img, true);
//imagealphablending($final_img, true);



//header('Content-Type: image/png');
/*
$color = imagecolorallocate($imageOut, 255, 255, 255);     
imagestring($imageOut, 5, 30, 435,  "Offense: $offenseCount", $color);
imagestring($imageOut, 5, 305, 435,  "Defense: $defenseCount", $color);
imagestring($imageOut, 5, 580, 435,  "Utility: $utilityCount", $color);
*/

echo "<h3 style='top:426px; left:30px'>Ferocity: $offenseCount</h3>";
echo "<h3 style='top:426px; left:305px'>Cunning: $utilityCount</h3>";
echo "<h3 style='top:426px; left:585px'>Resolve: $defenseCount</h3>";


//$font = 'arial.ttf';
//imagettftext($imageOut, 15, 0, 30, 435, $color, $font, $offenseCount);


//header("Content-Type:image/jpeg");

//echo "<p>Some text";
//imagejpeg($imageOut);
//echo "</p>";

//echo "\nShould be copied.";


//********************** FUNCTIONS ***************************************
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

function read_file($file) {
	$output = array();
	
	$output['body'] = file_get_contents($file);
	
	return $output;
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


?>
    </body>
</html>
