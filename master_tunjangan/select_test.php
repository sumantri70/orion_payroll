<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
	
	$sql = "SELECT id, kode, nama, keterangan, status FROM master_tunjangan WHERE id <> 0 ";
	$qry = mysqli_query($connect, $sql);

	$json = array();
	
	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
    }    
    
    foreach($json as $item) {         
        $kode       = $item['kode'];
        $nama       = $item['nama'];
        $keterangan = $item['keterangan'];    
        $status     = $item['status'];

        $sql = "INSERT INTO master_tunjangan (kode, nama, keterangan, status)  
                VALUES('$kode', '$nama', '$keterangan', '$status')";    
        $qry = mysqli_query($connect, $sql); 
    }
	
    //echo json_encode(array('data' =>$json));
    
    
	
	mysqli_close($connect);	
?>