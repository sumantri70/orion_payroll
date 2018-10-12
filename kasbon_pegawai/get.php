<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
	$id = $_GET['id'];

    $sql = "SELECT id, nomor, tanggal, id_pegawai, jumlah, cicilan, sisa, keterangan, user_id, tgl_input, user_edit, tgl_edit
            FROM kasbon_pegawai WHERE id = $id";
    $qry = mysqli_query($connect, $sql);            

    $json = array();
        
    while($row = mysqli_fetch_assoc($qry)){
        $json[] = $row;
    }

    echo json_encode(array('data' =>$json));

    mysqli_close($connect);	
?>;