<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$tgl_dari   = $_GET['tgl_dari'];
	$tgl_sampai = $_GET['tgl_sampai'];  
	$id_pegawai = $_GET['id_pegawai'];
	$order_by   = $_GET['order_by'];

	
	$filter = "";

	//Filter Periode
    $filter .= " AND m.tanggal BETWEEN '$tgl_dari' AND '$tgl_sampai' ";
    
	if($id_pegawai <> 0){
		$filter .= " AND m.id_pegawai = '$id_pegawai' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
	}

    
	$sql = "SELECT id, nomor, tanggal, periode, id_pegawai, gaji_pokok, uang_ikatan, uang_kehadiran, premi_harian, premi_perjam,
            telat_satu, telat_dua, dokter, izin_stgh_hari, izin_non_cuti, izin_cuti, jam_lembur, total_tunjangan,
            total_potongan, total_lembur, total_kasbon, total, keterangan, user_id, tgl_input, user_edit, tgl_edit 
			FROM penggajian_master
			WHERE id <> 0 $filter $order ";
	$qry = mysqli_query($connect, $sql);	

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>

