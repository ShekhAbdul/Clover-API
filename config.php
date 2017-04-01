<?php 
date_default_timezone_set("Asia/Kolkata"); 
	
	$servername="localhost";
	$username="democons_cloverb";
	$password="cloverbackend@";
	$dbname="democons_clover_backend";
	
	$con=mysqli_connect($servername,$username,$password);
	$condb=mysqli_select_db($con,$dbname);
	
	if( !$con )

	{

		die("Database Connection Failed" . mysqli_error());

	}
	$select_db = mysqli_select_db($con, $dbname);

	if( !$select_db )

	{

		die("Database selection failed" . mysqli_error());

	}
	
	error_reporting(0);
?>