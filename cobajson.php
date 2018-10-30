<?php
$myObj = new stdClass();
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode($myObj); //obj --> json
echo $myJSON;
$test = json_decode($myJSON); //json -->obj
echo $test->name; //akses obj

?>




//  <?php 
//     include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
//     include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/fungsi_general/fungsi_general.php');    
    
//     $json   =  $_POST['data'];     
//     class emp{}

//     //$JsonMaster = json_decode($json);    
//     $JsonMaster = json_decode($json)->master;    
//     $test = $JsonMaster->id_pegawai;    

    
//     $response = new emp();
//     $response->success = 1;
//     $response->message = $test;
//     die(json_encode($response));

