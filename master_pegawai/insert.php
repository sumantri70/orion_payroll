<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $nik             = $_POST['nik'];
    $nama            = $_POST['nama'];
    $alamat          = $_POST['alamat'];
    $no_telpon_1     = $_POST['no_telpon_1'];
    $no_telpon_2     = $_POST['no_telpon_2'];
    $email           = $_POST['email'];
    $tgl_lahir       = $_POST['tgl_lahir'];
    $tgl_mulai_kerja = $_POST['tgl_mulai_kerja'];
    $gaji_pokok      = $_POST['gaji_pokok'];
    $keterangan      = $_POST['keterangan'];
    $status          = $_POST['status'];
    
    class emp{}

    $sql = "INSERT INTO master_pegawai (nik, nama, alamat, no_telpon_1, no_telpon_2, email, tgl_lahir, tgl_mulai_kerja, gaji_pokok, keterangan, status)  
            VALUES('$nik', '$nama', '$alamat', '$no_telpon_1', '$no_telpon_2', '$email', '$tgl_lahir', '$tgl_mulai_kerja', '$gaji_pokok', '$keterangan', '$status')";    
    $qry = mysqli_query($connect,$sql); 


    // $sql = "INSERT INTO detail_tunjangan_pegawai (id_pegawai, id_tunjangan, jumlah)  
    //         VALUES('$id_pegawai', '$id_tunjangan', '$jumlah')";    
    // $qry = mysqli_query($connect,$sql); 

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

