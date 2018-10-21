<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$tgl_dari   = $_GET['tgl_dari'];
	$tgl_sampai = $_GET['tgl_sampai'];  
	$status     = $_GET['status'];
	$id_pegawai = $_GET['id_pegawai'];
	$order_by   = $_GET['order_by'];

	
	$filter = "";

	//Filter Periode
	$filter .= " AND m.tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai' ";

	//Filter sisa
	if($status <> 0){
		if ($status == 1) {
			$filter .= " AND m.sisa > 0  ";
		} else {
			$filter .= " AND m.sisa <= 0  ";
		}
	}

	if($id_pegawai <> 0){
		$filter .= " AND m.id_pegawai = '$id_pegawai' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
	}

    
	$sql = "SELECT m.id, m.nomor, m.tanggal, m.id_pegawai, m.jumlah, m.cicilan, m.sisa, m.keterangan, m.user_id, m.tgl_input, m.user_edit, m.tgl_edit, p.nama AS nama_pegawai 
			FROM kasbon_pegawai m, master_pegawai p 
			WHERE m.id_pegawai = p.id $filter $order ";
	$qry = mysqli_query($connect, $sql);	

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>

