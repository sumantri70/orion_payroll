<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$tgl_dari   = $_GET['tgl_dari'];
	$tgl_sampai = $_GET['tgl_sampai'];  
	$id_pegawai = $_GET['id_pegawai'];
    $order_by   = $_GET['order_by'];
    
    $StartOfTheMonth = new DateTime("first day of $tgl_dari");
    $EndOfTheMonth   = new DateTime("last day of $tgl_sampai");
    
    $tgl_dari  = $StartOfTheMonth->format('Y-m-d'); 
    $tgl_sampai = $EndOfTheMonth->format('Y-m-d'); 
    
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

    $TP_MASUK          = "M";
    $TP_KURANG_15      = "K";
    $TP_LEBIH_15       = "L";
    $TP_IZIN_DOKTER    = "D";
    $TP_IZIN_STGH_HARI = "S";
    $TP_IZIN_NON_CUTI  = "N";
    $TP_IZIN_CUTI      = "C";

    $sql = "SELECT tanggal, id_pegawai, SUM(telat_satu) AS telat_satu, SUM(telat_dua) AS telat_dua, SUM(dokter) AS dokter, 
            SUM(izin_stgh_hari) AS izin_stgh_hari, SUM(izin_cuti) AS izin_cuti, SUM(izin_non_cuti) AS izin_non_cuti, SUM(masuk) AS masuk FROM ( 
                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(1) AS telat_satu, SUM(0) AS telat_dua, SUM(0) AS dokter , SUM(0) AS izin_stgh_hari, SUM(0) AS izin_cuti, SUM(0) AS izin_non_cuti, SUM(0) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_KURANG_15' $filter 
                GROUP BY tanggal, id_pegawai
                UNION ALL            

                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(0) AS telat_satu, SUM(1) AS telat_dua, SUM(0) AS dokter , SUM(0) AS izin_stgh_hari, SUM(0) AS izin_cuti, SUM(0) AS izin_non_cuti, SUM(0) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_LEBIH_15' $filter 
                GROUP BY tanggal, id_pegawai
                UNION ALL

                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(0) AS telat_satu, SUM(0) AS telat_dua, SUM(1) AS dokter , SUM(0) AS izin_stgh_hari, SUM(0) AS izin_cuti, SUM(0) AS izin_non_cuti, SUM(0) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_IZIN_DOKTER' $filter 
                GROUP BY tanggal, id_pegawai
                UNION ALL

                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(0) AS telat_satu, SUM(0) AS telat_dua, SUM(0) AS dokter , SUM(1) AS izin_stgh_hari, SUM(0) AS izin_cuti, SUM(0) AS izin_non_cuti, SUM(0) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_IZIN_STGH_HARI' $filter 
                GROUP BY tanggal, id_pegawai
                UNION ALL

                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(0) AS telat_satu, SUM(0) AS telat_dua, SUM(0) AS dokter , SUM(0) AS izin_stgh_hari, SUM(1) AS izin_cuti, SUM(0) AS izin_non_cuti, SUM(0) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_IZIN_CUTI' $filter 
                GROUP BY tanggal, id_pegawai
                UNION ALL

                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(0) AS telat_satu, SUM(0) AS telat_dua, SUM(0) AS dokter , SUM(0) AS izin_stgh_hari, SUM(0) AS izin_cuti, SUM(1) AS izin_non_cuti, SUM(0) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_IZIN_NON_CUTI' $filter 
                GROUP BY tanggal, id_pegawai
                UNION ALL

                SELECT DATE_FORMAT(tanggal ,'%Y-%m-01') AS tanggal, id_pegawai, SUM(0) AS telat_satu, SUM(0) AS telat_dua, SUM(0) AS dokter , SUM(0) AS izin_stgh_hari, SUM(0) AS izin_cuti, SUM(0) AS izin_non_cuti, SUM(1) AS masuk 
                FROM absen_pegawai 
                WHERE jenis_absen = '$TP_MASUK' $filter 
                GROUP BY tanggal, id_pegawai
            ) AS Data GROUP BY tanggal, id_pegawai $order ";            
            
	$qry = mysqli_query($connect, $sql);	

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}
	
	echo json_encode(array('data' =>$json));
	

	mysqli_close($connect);	
?>