<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
    $json   =  $_POST['data'];  
    class emp{}                
    //echo json_encode($json);

    $ArData = array();
    $ArData = json_decode($json, true); //Convert dari json ke array
    $IsiMaster  = true;
    $id_pegawai = 0;
    $hasil      = false;

    foreach($ArData as $item) {       
        if ($IsiMaster == true) {  
            $id              = $item['id'];
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

            $sql = "UPDATE master_pegawai SET 
                    nik = '$nik',
                    nama = '$nama',
                    alamat = '$alamat',
                    no_telpon_1 = '$no_telpon_1',
                    no_telpon_2 = '$no_telpon_2',
                    email = '$email',
                    tgl_lahir = '$tgl_lahir',
                    tgl_mulai_kerja = '$tgl_mulai_kerja',
                    gaji_pokok = '$gaji_pokok',
                    keterangan = '$keterangan',
                    status = '$status'
            WHERE id = '$id' ";    

            $mysql->query($sql);
            $id_pegawai = $id; 
            $IsiMaster  = false;    
            
            //Delete detail pegawai
            $sql = "DELETE FROM detail_tunjangan_pegawai WHERE id_pegawai = '$id_pegawai'";            
            $mysql->query($sql);
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
		$response->message = "Data berhasil di diubah";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error ubah Data";
		die(json_encode($response)); 
    }
?>