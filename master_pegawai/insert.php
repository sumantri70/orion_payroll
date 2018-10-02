<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $json   =  $_POST['data'];    
    
    class emp{}

    $ArData = array();
    $ArData = json_decode($json, true); //Convert dari json ke array
    $IsiMaster  = true;
    $id_pegawai = 0;
    $hasil      = false;
    
    foreach($ArData as $item) {       
        if ($IsiMaster == true) {
            $nik             = $item['nik'];
            $nama            = $item['nama'];
            $alamat          = $item['alamat'];
            $no_telpon_1     = $item['no_telpon_1'];
            $no_telpon_2     = $item['no_telpon_2'];
            $email           = $item['email'];
            $tgl_lahir       = $item['tgl_lahir'];
            $tgl_mulai_kerja = $item['tgl_mulai_kerja'];
            $gaji_pokok      = $item['gaji_pokok'];
            $keterangan      = $item['keterangan'];
            $status          = $item['status'];
            
            $sql = "INSERT INTO master_pegawai (nik, nama, alamat, no_telpon_1, no_telpon_2, email, tgl_lahir, tgl_mulai_kerja, gaji_pokok, keterangan, status)  
                    VALUES('$nik', '$nama', '$alamat', '$no_telpon_1', '$no_telpon_2', '$email', '$tgl_lahir', '$tgl_mulai_kerja', '$gaji_pokok', '$keterangan', '$status')";    
            $mysql->query($sql);
            $id_pegawai = $mysql->insert_id; //Ambil id yang di insert            
            $IsiMaster  = false;    
        }

        $id_tunjangan    = $item['id_tunjangan'];
        $jumlah          = $item['jumlah'];

        $sql = "INSERT INTO detail_tunjangan_pegawai (id_pegawai, id_tunjangan, jumlah)  
                VALUES('$id_pegawai', '$id_tunjangan', '$jumlah')";    
        $mysql->query($sql);
        $hasil = true;
    }

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
?>