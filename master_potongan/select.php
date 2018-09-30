<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
	$status   = $_GET['status'];
	$order_by = $_GET['order_by'];


	$filter = "";
	if($status <> "" ){
		$filter .= " AND status = '$status' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
	}

	$sql = "SELECT id, kode, nama, keterangan, status FROM master_potongan WHERE id <> 0 $filter $order ";
	$qry = mysqli_query($connect, $sql);

	$json = array();
	
	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	
	mysqli_close($connect);	
?>