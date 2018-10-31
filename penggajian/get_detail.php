<?php 	
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');	 
    $id_master = $_GET['id_master'];
    
    $sql = "SELECT id, id_master, tipe, id_tjg_pot_kas, jumlah  
            FROM penggajian_detail
            WHERE id_master = $id_master";
    $qry = mysqli_query($connect, $sql);     

    $json = array();        
    while($row = mysqli_fetch_assoc($qry)){
        $json[] = $row;
    }

    echo json_encode(array('data' =>$json));

    mysqli_close($connect);	
?>