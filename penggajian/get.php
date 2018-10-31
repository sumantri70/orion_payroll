<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
	$id = $_GET['id'];

    $sql = "SELECT id, nomor, tanggal, periode, id_pegawai, gaji_pokok, uang_ikatan, uang_kehadiran, premi_harian, premi_perjam,
            telat_satu, telat_dua, dokter, izin_stgh_hari, izin_non_cuti, izin_cuti, jam_lembur, total_tunjangan,
            total_potongan, total_lembur, total_kasbon, total, keterangan, user_id, tgl_input, user_edit, tgl_edit
            FROM penggajian_master WHERE id = $id";
    $qry = mysqli_query($connect, $sql);            

    $json = array();        
    while($row = mysqli_fetch_assoc($qry)){
        $json[] = $row;
    }
    
    echo json_encode(array('data' =>$json));

    mysqli_close($connect);	
?>