<?php
	//get data from clover webhook and write it on data.txt
	$file='data.txt';
 	$resp=file_get_contents("php://input",True);
  	$fp = fopen($file, "w");
  	fwrite($fp, $resp);
  	fclose($fp);
  
  ?>
  