<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
    $id_pegawai = $_GET['id_pegawai'];
    
    $sql = "SELECT dt.id, dt.id_pegawai, dt.id_tunjangan, dt.jumlah, tj.kode, tj.nama
            FROM detail_tunjangan_pegawai dt, master_tunjangan tj
            WHERE dt.id_tunjangan = tj.id AND id_pegawai = $id_pegawai";
    $qry = mysqli_query($connect, $sql);     

    $json = array();        
    while($row = mysqli_fetch_assoc($qry)){
        $json[] = $row;
    }

    echo json_encode(array('data' =>$json));

    mysqli_close($connect);	
?>