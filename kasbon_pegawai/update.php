<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $id         = $_POST['id'];
    $nomor      = $_POST['nomor'];
    $tanggal    = $_POST['tanggal'];
    $id_pegawai = $_POST['id_pegawai'];
    $jumlah     = $_POST['jumlah'];
    $cicilan    = $_POST['cicilan'];
    $sisa       = $_POST['sisa'];
    $keterangan = $_POST['keterangan'];
    $user_id    = $_POST['user_id'];
    $tgl_input  = $_POST['tgl_input'];
    $user_edit  = $_POST['user_edit'];
    $tgl_edit   = $_POST['tgl_edit'];
    
    class emp{}
    $sql = "UPDATE kasbon_pegawai SET 
                    nomor      = '$nomor',
                    tanggal    = '$tanggal',
                    id_pegawai = '$id_pegawai',
                    jumlah     = '$jumlah',
                    cicilan    = '$cicilan',
                    sisa       = '$sisa',
                    keterangan = '$keterangan',
                    user_id    = '$user_id',
                    tgl_input  = '$tgl_input'
                    user_edit  = '$user_edit'
                    tgl_edit   = '$tgl_edit'
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