<?php
	// $server		= "192.168.43.59";	
	// $user		= "root"; 
	// $password	= "sumantri"; 
	// $database	= "orion_payroll"; 
	// $connect = mysqli_connect($server, $user, $password, $database);
	// $query = mysqli_query($connect,"SET SESSION time_zone = '+7:00'");
	// $mysql = new mysqli($server, $user, $password, $database);

	$server		= "localhost";	
	$user		= "root"; 
	$password	= ""; 
	$database	= "orion_payroll"; 
	$connect = mysqli_connect($server, $user, $password, $database);
	$query = mysqli_query($connect,"SET SESSION time_zone = '+7:00'");
	$mysql = new mysqli($server, $user, $password, $database);

?>
