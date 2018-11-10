<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$status     = $_GET['status'];
	$id_pegawai = $_GET['id_pegawai'];
	
	$filter = "";

	//Filter sisa
	if($status <> 0){
		if ($status == 1) {
			$filter .= " AND sisa > 0  ";
		} else {
			$filter .= " AND sisa <= 0  ";
		}
	}

	if($id_pegawai <> 0){
		$filter .= " AND id_pegawai = '$id_pegawai' ";
	}
    
	$sql = "SELECT id, nomor, tanggal, id_pegawai, jumlah, cicilan, sisa, keterangan, user_id, tgl_input, user_edit, tgl_edit
			FROM kasbon_pegawai 
			WHERE id <> 0 $filter ORDER BY tanggal, tgl_input ";
	$qry = mysqli_query($connect, $sql);	

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>

