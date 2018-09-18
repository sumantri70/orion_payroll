<?php
    include($_SERVER['DOCUMENT_ROOT'].'koneksi.php');
    $id              = $_POST['id'];
    $nik             = $_POST['nik'];
    $nama            = $_POST['nama'];
    $alamat          = $_POST['alamat'];
    $no_telpon_1     = $_POST['no_telpon_1'];
    $no_telpon_2     = $_POST['no_telpon_2'];
    $email           = $_POST['email'];
    $tgl_lahir       = $_POST['tgl_lahir'];
    $tgl_mulai_kerja = $_POST['tgl_mulai_kerja'];
    $gaji_pokok      = $_POST['gaji_pokok'];
    $status          = $_POST['status'];
    
    class emp{}

    $sql = "INSERT INTO master_pegawai (id, nik, nama, alamat, no_telpon_1, no_telpon_2, email, tgl_lahir, tgl_mulai_kerja, gaji_pokok, status)  
            '$id', '$nik', '$nama', '$alamat', '$no_telpon_1', '$no_telpon_2', '$email', '$tgl_lahir', '$tgl_mulai_kerja', '$gaji_pokok', '$status')";
    $qry = mysqli_query($connect,$sql); 

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

