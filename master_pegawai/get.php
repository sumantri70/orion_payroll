<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
	$id = $_GET['id'];

    $sql = "SELECT id, nik, nama, alamat, no_telpon_1, no_telpon_2, email, tgl_lahir, tgl_mulai_kerja, gaji_pokok, status, keterangan 
            FROM master_pegawai WHERE id = $id";
    $qry = mysqli_query($connect, $sql);            

    $json = array();        
    while($row = mysqli_fetch_assoc($qry)){
        $json[] = $row;
    }
    
    echo json_encode(array('data' =>$json));

    mysqli_close($connect);	
?>