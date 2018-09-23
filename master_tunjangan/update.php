<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $id         = $_POST['id'];
    $kode       = $_POST['kode'];
    $nama       = $_POST['nama'];
    $keterangan = $_POST['keterangan'];    
    $status     = $_POST['status'];

    // $id         = $_GET['id'];
    // $kode       = $_GET['kode'];
    // $nama       = $_GET['nama'];
    // $keterangan = $_GET['keterangan'];    
    // $status     = $_GET['status'];
    
    class emp{}
    $sql = "UPDATE master_tunjangan SET 
                   kode = '$kode',
                   nama = '$nama',
                   keterangan = '$keterangan',
                   status = '$status' 
            WHERE id = '$id' ";    
    echo($sql);
    $qry = mysqli_query($connect, $sql);     

    if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data berhasil di simpan";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error update Data";
		die(json_encode($response)); 
    }
?>

