<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $id = $_POST['id'];    
    
    class emp{}
    $sql = "DELETE FROM kasbon_pegawai WHERE id = $id ";    
    $qry = mysqli_query($connect, $sql);

    if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Data berhasil di dihapus";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error dihapus Data";
		die(json_encode($response)); 
    }
?>