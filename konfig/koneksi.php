<?php
	$server		= "192.168.43.59";	
	//$server		= "localhost";	
	$user		= "root"; 
	$password	= "sumantri"; 
	$database	= "orion_payroll"; 
	$connect = mysqli_connect($server, $user, $password, $database);
	$query0 = mysqli_query($connect,"SET SESSION time_zone = '+7:00'");
?>