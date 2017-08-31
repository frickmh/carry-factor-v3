<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Carry-Factor.com Bug List</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="website/diamond_i_favicon.png">
        <link rel="stylesheet" type="text/css" href="bronzodia.css">
    </head>
    <body>
                <div id="main_content_div" align="center">
		<div style='width: 100%;' class="brown"><a href="index.html"><img src='website/banner-carry-factor.png' alt='Carry-Factor.com - LoL Stats Command Center.  Stats, Counterpicks, and Cooldowns'></a></div>

        <div>
            
            <h2>List of bugs:</h2>

            <div  align="center" style='margin: 0 auto'>
                <button class='bigButton shadow' onclick="returnToHome();">Done</button>
                <button class='bigButton shadow' onclick="reportBug();">Report Another Bug</button>

            </div>        
        
        </div>
        
        
        
        
        
        <table><tr><td>
        <div style='text-align:left'>
        
        <?php
        // put your code here
            
            echo "<h3>List of Bugs:</h3>";
            
            $lines = file('bugsList.txt');
            
            foreach ($lines as $line_num => $line) {
                //echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
                echo htmlspecialchars($line) . "<br />\n";
            }
        
            /*
            $myfile = fopen("bugsList.txt", "rb") or die("Unable to open file!");
            echo fread($myfile,filesize("bugsList.txt"));
            fclose($myfile);*/
        ?>
            
        </div>
        </td></tr></table>
        
        <div  align="center" style='margin: 0 auto'>
            <button class='bigButton shadow' onclick="returnToHome();">Done</button>
            <button class='bigButton shadow' onclick="reportBug();">Report Another Bug</button>
        
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
            
            function reportBug() {
                window.location.href = 'bugs.html';    
            }
            
        
        </script>
        
    </body>
</html>
