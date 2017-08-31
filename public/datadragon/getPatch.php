<?php

	header('Content-Type: text/html; charset=UTF-8');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET,POST');
	header('Access-Control-Allow-Headers: Content-Type');

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
	
	echo $patchFull;
	
?>