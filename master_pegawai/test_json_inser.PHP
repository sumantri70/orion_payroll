<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');            
    $json   =  $_POST['data'];
    // $nama       = $_POST['nama'];
    // $keterangan = $_POST['keterangan'];    
    // $status     = $_POST['status'];
    //$json = stripslashes($json);
    //echo "<br><br><br><br>";
    //echo stripslashes(json_encode($json));
    //echo json_encode($json);
    //echo "<br><br><br><br>";

    //$hasil ="";
    // $hasil = stripslashes(json_encode($json));
    // echo $hasil;
    // echo "<br><br><br><br> ieuuuuuuuuuu";
    // json_decode($hasil, ture);
    // echo json_encode($hasil);
    // echo "<br><br><br><br> jon hasilllll";

    $hasil = array();
    $hasil = json_decode($json, true);
    

    class emp{}
    
    foreach($hasil as $item) {                 
        $kode       = $item['kode'];
        $nama       = $item['nama'];
        $keterangan = $item['keterangan'];    
        $status     = $item['status'];

        $sql = "INSERT INTO master_tunjangan (kode, nama, keterangan, status)  
                VALUES('$kode', '$nama', '$keterangan', '$status')";    
        $qry = mysqli_query($connect, $sql); 
    }

    // if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data berhasil di simpan";
		die(json_encode($response));
    // }else{        
    //     $response = new emp();
	// 	$response->success = 0;
	// 	$response->message = "Error simpan Data";
	// 	die(json_encode($response)); 
    // }
?>

