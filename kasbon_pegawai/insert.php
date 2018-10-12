<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $nomor      = $_POST['nomor'];
    $tanggal    = $_POST['tanggal'];
    $id_pegawai = $_POST['id_pegawai'];
    $jumlah     = $_POST['jumlah'];
    $cicilan    = $_POST['cicilan'];
    $sisa       = $_POST['sisa'];
    $keterangan = $_POST['keterangan'];
    $user_id    = $_POST['user_id'];
    $tgl_input  = "now()";
    $user_edit  = "";
    $tgl_edit   = "null";

    
    class emp{}

    $sql = "INSERT INTO kasbon_pegawai (nomor, tanggal, id_pegawai, jumlah, cicilan, sisa, keterangan, user_id, tgl_input, user_edit, tgl_edit)  
            VALUES('$nomor', '$tanggal', '$id_pegawai', '$jumlah', '$cicilan', '$sisa', '$keterangan', '$user_id', '$tgl_input', '$user_edit', '$tgl_edit')";
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