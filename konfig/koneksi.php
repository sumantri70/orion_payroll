<?php
	$server		= "localhost";
	$user		= "root"; 
	$password	= ""; 
	$database	= "db_orion_payroll"; 
	$connect = mysqli_connect($server, $user, $password, $database);
	$query0 = mysqli_query($connect,"SET SESSION time_zone = '+7:00'");
?>