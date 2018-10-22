<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/fungsi_general/fungsi_general.php');    

    $id              = $_POST['id'];
    $nomor           = $_POST['nomor'];
    $tanggal         = $_POST['tanggal'];
    $id_pegawai      = $_POST['id_pegawai'];
    $gaji_pokok      = $_POST['gaji_pokok'];
    $uang_ikatan     = $_POST['uang_ikatan'];
    $uang_kehadiran  = $_POST['uang_kehadiran'];
    $premi_harian    = $_POST['premi_harian'];
    $premi_perjam    = $_POST['premi_perjam'];
    $telat_satu      = $_POST['telat_satu'];
    $telat_dua       = $_POST['telat_dua'];
    $dokter          = $_POST['dokter'];
    $izin_stgh_hari  = $_POST['izin_stgh_hari'];
    $izin_non_cuti   = $_POST['izin_non_cuti'];
    $izin_cuti       = $_POST['izin_cuti'];
    $jam_lembur      = $_POST['jam_lembur'];
    $total_tunjangan = $_POST['total_tunjangan'];
    $total_potongan  = $_POST['total_potongan'];
    $total_lembur    = $_POST['total_lembur'];
    $total           = $_POST['total'];
    $keterangan      = $_POST['keterangan'];
    $user_id         = $_POST['user_id'];
    $tgl_input       = 'now()';
    $user_edit       = '';
    $tgl_edit        = 0;    
    $nomor           = Get_Next_Number($tanggal, 'GS');    

    class emp{}

    $sql = "INSERT INTO penggajian_master (nomor, tanggal, id_pegawai, gaji_pokok, uang_ikatan, uang_kehadiran, premi_harian, premi_perjam,
                                           telat_satu, telat_dua, dokter, izin_stgh_hari, izin_non_cuti, izin_cuti, jam_lembur, total_tunjangan,
                                           total_potongan, total_lembur, total, keterangan, user_id, tgl_input, user_edit, tgl_edit)  
            VALUES( '$nomor', '$tanggal', '$id_pegawai', '$gaji_pokok', '$uang_ikatan', '$uang_kehadiran', '$premi_harian', '$premi_perjam',
                    '$telat_satu', '$telat_dua', '$dokter', '$izin_stgh_hari', '$izin_non_cuti', '$izin_cuti', '$jam_lembur', '$total_tunjangan',
                    '$total_potongan', '$total_lembur', '$total', '$keterangan', '$user_id', '$tgl_input', '$user_edit', $tgl_edit)";
    $qry = mysqli_query($connect,$sql); 

    if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data berhasil di simpan";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error simpan Data";
        die(json_encode($response));    
    }
?>



id
nomor
tanggal
id_pegawai
gaji_pokok
uang_ikatan
uang_kehadiran
premi_harian
premi_perjam
telat_satu
telat_dua
dokter
izin_stgh_hari
izin_non_cuti
izin_cuti
jam_lembur
total_tunjangan
total_potongan
total_lembur
total
keterangan
user_id
tgl_input
user_edit
tgl_edit