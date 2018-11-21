<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$periode   = $_GET['periode'];
	$id_pegawai = $_GET['id_pegawai'];
	$order_by   = $_GET['order_by'];
    
    $StartOfTheMonth = new DateTime("first day of $periode");
    $EndOfTheMonth   = new DateTime("last day of $periode");

    $Tgl_Awal  = $StartOfTheMonth->format('Y-m-d'); 
    $Tgl_Akhir = $EndOfTheMonth->format('Y-m-d');

    $filter = "";

	//Filter Periode
    $filter .= " AND m.periode BETWEEN '$Tgl_Awal' AND '$Tgl_Akhir' ";
    
	if($id_pegawai <> 0){
		$filter .= " AND m.id_pegawai = '$id_pegawai' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
	}

    
	$sql = "SELECT m.id, m.nomor, m.tanggal, m.periode, m.id_pegawai, m.gaji_pokok, m.uang_ikatan, m.uang_kehadiran, m.premi_harian, m.premi_perjam,
            m.telat_satu, m.telat_dua, m.dokter, m.izin_stgh_hari, m.izin_non_cuti, m.izin_cuti, m.jam_lembur, m.total_tunjangan,
            m.total_potongan, m.total_lembur, m.total_kasbon, m.total, m.keterangan, m.user_id, m.tgl_input, m.user_edit, m.tgl_edit, p.nama AS nama_pegawai 
			FROM penggajian_master m, master_pegawai p 
			WHERE m.id_pegawai = p.id $filter $order ";
	$qry = mysqli_query($connect, $sql);	

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>

