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

    $id              = $JsonMaster->id;
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
    $user_edit       = '';
    $tgl_edit        = 'now()';    
    $nomor           = $JsonMaster->nomor;
    $periode         = $JsonMaster->tanggal;

    class emp{}      

    $sql = "UPDATE penggajian_master SET 
                tanggal         = '$tanggal',
                periode         = '$periode',
                id_pegawai      = '$id_pegawai',
                gaji_pokok      = '$gaji_pokok',
                uang_ikatan     = '$uang_ikatan',
                uang_kehadiran  = '$uang_kehadiran',
                premi_harian    = '$premi_harian',
                premi_perjam    = '$premi_perjam',
                telat_satu      = '$telat_satu',
                telat_dua       = '$telat_dua',
                dokter          = '$dokter',
                izin_stgh_hari  = '$izin_stgh_hari',
                izin_non_cuti   = '$izin_non_cuti',
                izin_cuti       = '$izin_cuti',
                jam_lembur      = '$jam_lembur',
                total_tunjangan = '$total_tunjangan',
                total_potongan  = '$total_potongan',
                total_lembur    = '$total_lembur',
                total_kasbon    = '$total_kasbon',
                total           = '$total',
                keterangan      = '$keterangan',
                user_edit       = '$user_edit',
                tgl_edit        = '$tgl_edit',
                nomor           = '$nomor',
                periode         = '$periode
            WHERE id = '$id' ";    
    $qry = mysqli_query($connect, $sql);
    
    $id_master = $id;

    //ambil data detail yang kasbon saja untuk balikin sisa di kasbon pegawai
    $sql = "SELECT id, id_master, tipe, id_tjg_pot_kas, jumlah 
            FROM penggajian_detail 
            WHERE id_master = $id_master AND tipe ='K' ";
    $qry = mysqli_query($connect, $sql);
    
    //Balikin sisa kasbon pegawai jika ada
    while($row = mysqli_fetch_assoc($qry)){        
        $id_tjg_pot_kas = $row["id_tjg_pot_kas"];
        $jumlah         = $row["jumlah"];

        $sql = "UPDATE Kasbon_pegawai SET sisa = sisa + $jumlah 
        WHERE id = $id_tjg_pot_kas"; 
        $mysql->query($sql);        
    }
    
    //Delete detail penggajian
    $sql = "DELETE FROM penggajian_detail WHERE id_master = '$id_master'";            
    $mysql->query($sql);   
    
    

    //save data detail
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
    

    $hasil = true;
   

    if($hasil == true){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data edit";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error edit";
        die(json_encode($response));    
    }
