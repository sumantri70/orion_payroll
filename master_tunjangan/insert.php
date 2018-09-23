<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $kode       = $_POST['kode'];
    $nama       = $_POST['nama'];
    $keterangan = $_POST['keterangan'];    
    $status     = $_POST['status'];
    
    class emp{}

    $sql = "INSERT INTO master_tunjangan (kode, nama, keterangan, status)  
            VALUES('$kode', '$nama', '$keterangan', '$status')";    
    $qry = mysqli_query($connect, $sql); 

    if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data berhasil di simpan";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error simpan Data";
		die(json_encode($response)); 
    }
?>

