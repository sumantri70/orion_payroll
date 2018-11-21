<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$tgl_dari   = $_GET['tgl_dari'];
	$tgl_sampai = $_GET['tgl_sampai'];  
	$id_pegawai = $_GET['id_pegawai'];
	$order_by   = $_GET['order_by'];
	
	$filter = "";

	//Filter Periode
    $filter .= " AND tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai' ";
    
	if($id_pegawai <> 0){
		$filter .= " AND id_pegawai = '$id_pegawai' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
    }

    $sql ="SELECT id, tanggal, nomor, jumlah, cicilan, jumlah - sisa AS terbayar, sisa, id_pegawai 
           FROM kasbon_pegawai 
           WHERE id <> 0 $filter $order ";	
    $qry = mysqli_query($connect, $sql);

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>