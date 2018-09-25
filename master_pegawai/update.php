<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
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
    $keterangan      = $_POST['keterangan'];
    $status          = $_POST['status'];

    // $id              = $_GET['id'];
    // $nik             = $_GET['nik'];
    // $nama            = $_GET['nama'];
    // $alamat          = $_GET['alamat'];
    // $no_telpon_1     = $_GET['no_telpon_1'];
    // $no_telpon_2     = $_GET['no_telpon_2'];
    // $email           = $_GET['email'];
    // $tgl_lahir       = $_GET['tgl_lahir'];
    // $tgl_mulai_kerja = $_GET['tgl_mulai_kerja'];
    // $gaji_pokok      = $_GET['gaji_pokok'];
    // $keterangan      = $_GET['keterangan'];
    // $status          = $_GET['status'];

    
    
    class emp{}
    $sql = "UPDATE master_pegawai SET 
                    nik = '$nik',
                    nama = '$nama',
                    alamat = '$alamat',
                    no_telpon_1 = '$no_telpon_1',
                    no_telpon_2 = '$no_telpon_2',
                    email = '$email',
                    tgl_lahir = '$tgl_lahir',
                    tgl_mulai_kerja = '$tgl_mulai_kerja',
                    gaji_pokok = '$gaji_pokok',
                    keterangan = '$keterangan',
                    status = '$status'
            WHERE id = '$id' ";    
    $qry = mysqli_query($connect, $sql);     

    if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data berhasil di ubah";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error update Data";
		die(json_encode($response)); 
    }
?>