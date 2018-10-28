<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/fungsi_general/fungsi_general.php');    
    
    $json   =  $_POST['data']; 
    
    class emp{}

    $ArData = array();
    $ArData = json_decode($json, true); //Convert dari json ke array
    $IsiMaster  = true;
    $id_master  = 0;
    $hasil      = false;


    foreach($ArData as $item) {       
        if ($IsiMaster == true) {
            $tanggal         = $_item['tanggal'];
            $periode         = $_item['periode'];
            $id_pegawai      = $_item['id_pegawai'];
            $gaji_pokok      = $_item['gaji_pokok'];
            $uang_ikatan     = $_item['uang_ikatan'];
            $uang_kehadiran  = $_item['uang_kehadiran'];
            $premi_harian    = $_item['premi_harian'];
            $premi_perjam    = $_item['premi_perjam'];
            $telat_satu      = $_item['telat_satu'];
            $telat_dua       = $_item['telat_dua'];
            $dokter          = $_item['dokter'];
            $izin_stgh_hari  = $_item['izin_stgh_hari'];
            $izin_non_cuti   = $_item['izin_non_cuti'];
            $izin_cuti       = $_item['izin_cuti'];
            $jam_lembur      = $_item['jam_lembur'];
            $total_tunjangan = $_item['total_tunjangan'];
            $total_potongan  = $_item['total_potongan'];
            $total_lembur    = $_item['total_lembur'];
            $total_kasbon    = $_item['total_kasbon'];
            $total           = $_item['total'];
            $keterangan      = $_item['keterangan'];
            $user_id         = $_item['user_id'];
            $tgl_input       = 'now()';
            $user_edit       = '';
            $tgl_edit        = 0;    
            $nomor           = Get_Next_Number($tanggal, 'GS');
            
            $sql = "INSERT INTO penggajian_master (nomor, tanggal, periode, id_pegawai, gaji_pokok, uang_ikatan, uang_kehadiran, premi_harian, premi_perjam,
                                           telat_satu, telat_dua, dokter, izin_stgh_hari, izin_non_cuti, izin_cuti, jam_lembur, total_tunjangan,
                                           total_potongan, total_lembur, total_kasbon, total, keterangan, user_id, tgl_input, user_edit, tgl_edit)  
            VALUES( '$nomor', '$tanggal', '$periode', '$id_pegawai', '$gaji_pokok', '$uang_ikatan', '$uang_kehadiran', '$premi_harian', '$premi_perjam',
                    '$telat_satu', '$telat_dua', '$dokter', '$izin_stgh_hari', '$izin_non_cuti', '$izin_cuti', '$jam_lembur', '$total_tunjangan',
                    '$total_potongan', '$total_lembur', '$total_kasbon', '$total', '$keterangan', '$user_id', '$tgl_input', '$user_edit', $tgl_edit)";            $mysql->query($sql);
            $id_master = $mysql->insert_id; //Ambil id yang di insert            

            // $sql = "INSERT INTO histori_gaji_pegawai (id_pegawai, tanggal, gaji_pokok, uang_ikatan, uang_kehadiran, premi_harian, premi_perjam)  
            //         VALUES('$id_pegawai', '$tanggal', '$gaji_pokok', '$uang_ikatan', '$uang_kehadiran', '$premi_harian', '$premi_perjam')";    
            // $mysql->query($sql);

            // $IsiMaster  = false;    
        }

        // $id_tunjangan    = $item['id_tunjangan'];
        // $jumlah          = $item['jumlah'];

        // $sql = "INSERT INTO detail_tunjangan_pegawai (id_pegawai, id_tunjangan, jumlah)  
        //         VALUES('$id_pegawai', '$id_tunjangan', '$jumlah')";    
        // $mysql->query($sql);
        $hasil = true;        
    }

    class emp{}

   
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