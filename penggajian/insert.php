<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/fungsi_general/fungsi_general.php');    
    
    $json   =  $_POST['data'];     

    class emp{}
    $hasil = false;

    $JsonMaster = json_decode($json)->master;     
    $ObjDetail  = json_decode($json)->detail; //Convert data detail ke object
    $JsonDetail = array();   
    $JsonDetail = json_decode(json_encode($ObjDetail) ,true); //Convert dari object  ke array        

    $tanggal         = $JsonMaster->tanggal;    
    $periode         = $JsonMaster->periode;    
    $id_pegawai      = $JsonMaster->id_pegawai;
    $gaji_pokok      = $JsonMaster->gaji_pokok;
    $uang_ikatan     = $JsonMaster->uang_ikatan;
    $uang_kehadiran  = $JsonMaster->uang_kehadiran;
    $premi_harian    = $JsonMaster->premi_harian;
    $premi_perjam    = $JsonMaster->premi_perjam;
    $telat_satu      = $JsonMaster->telat_satu;
    $telat_dua       = $JsonMaster->telat_dua;
    $dokter          = $JsonMaster->dokter;
    $izin_stgh_hari  = $JsonMaster->izin_stgh_hari;
    $izin_non_cuti   = $JsonMaster->izin_non_cuti;
    $izin_cuti       = $JsonMaster->izin_cuti;
    $jam_lembur      = $JsonMaster->jam_lembur;
    $total_tunjangan = $JsonMaster->total_tunjangan;
    $total_potongan  = $JsonMaster->total_potongan;
    $total_lembur    = $JsonMaster->total_lembur;
    $total_kasbon    = $JsonMaster->total_kasbon;
    $total           = $JsonMaster->total;
    $keterangan      = $JsonMaster->keterangan;
    $user_id         = $JsonMaster->user_id;
    $tgl_input       = 'now()';
    $user_edit       = '';
    $tgl_edit        = 0;    
    $nomor           = Get_Next_Number($tanggal, 'GS');            

    $StartOfTheMonth = new DateTime("first day of $periode");    
    $periode         = $StartOfTheMonth->format('Y-m-d'); 
    

    $sql = "INSERT INTO penggajian_master (nomor, tanggal, periode, id_pegawai, gaji_pokok, uang_ikatan, uang_kehadiran, premi_harian, premi_perjam,
                                           telat_satu, telat_dua, dokter, izin_stgh_hari, izin_non_cuti, izin_cuti, jam_lembur, total_tunjangan,
                                           total_potongan, total_lembur, total_kasbon, total, keterangan, user_id, tgl_input, user_edit, tgl_edit)  
            VALUES( '$nomor', '$tanggal', '$periode', '$id_pegawai', '$gaji_pokok', '$uang_ikatan', '$uang_kehadiran', '$premi_harian', '$premi_perjam',
                    '$telat_satu', '$telat_dua', '$dokter', '$izin_stgh_hari', '$izin_non_cuti', '$izin_cuti', '$jam_lembur', '$total_tunjangan',
                    '$total_potongan', '$total_lembur', '$total_kasbon', '$total', '$keterangan', '$user_id', '$tgl_input', '$user_edit', $tgl_edit)";            
    $mysql->query($sql);    
    $id_master = $mysql->insert_id; 

    foreach($JsonDetail as $item) {          
        $tipe           = $item['tipe'];
        $id_tjg_pot_kas = $item['id_tjg_pot_kas'];
        $jumlah         = $item['jumlah'];

        $sql = "INSERT INTO penggajian_detail (id_master, tipe, id_tjg_pot_kas, jumlah)  
                VALUES('$id_master', '$tipe', '$id_tjg_pot_kas', '$jumlah')";    
        $mysql->query($sql);    
        
        if ($tipe == "K"){
            $sql = "UPDATE Kasbon_pegawai SET sisa = sisa - $jumlah 
                    WHERE id = $id_tjg_pot_kas"; 
            $mysql->query($sql);
        }
    }            

    // Update ke kasbon jika ada

    $hasil = true;
   

    if($hasil == true){
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
