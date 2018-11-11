<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$tgl_dari   = $_GET['tgl_dari'];
	$tgl_sampai = $_GET['tgl_sampai'];  
	$id_pegawai = $_GET['id_pegawai'];
	$order_by   = $_GET['order_by'];
	
	$filter = "";

	//Filter Periode
    $filter .= " AND periode BETWEEN '$tgl_dari' AND '$tgl_sampai' ";
    
	if($id_pegawai <> 0){
		$filter .= " AND id_pegawai = '$id_pegawai' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
	}

	$sql = "SELECT periode, SUM(gaji_pokok) AS gaji_pokok, SUM(total_tunjangan) AS total_tunjangan, SUM(total_potongan) AS total_potongan, 
			SUM(total_kasbon) AS total_kasbon, SUM(total_lembur) AS total_lembur, SUM(total) AS total
			FROM penggajian_master 
			WHERE id <> 0 $filter 
			GROUP BY periode $order ";
	$qry = mysqli_query($connect, $sql);	

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>