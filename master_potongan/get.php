<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
	$id = $_GET['id'];

	$sql = "SELECT id, kode, nama, keterangan, status FROM master_potongan WHERE id = $id";
	$qry = mysqli_query($connect, $sql);

	$json = array();
	
	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	
	mysqli_close($connect);	
?>