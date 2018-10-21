<?php
    
    function Get_Next_Number($Tanggal, $NoTrans){
        include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');   

        $StartOfTheMonth = new DateTime("first day of $Tanggal");
        $EndOfTheMonth   = new DateTime("last day of $Tanggal");

        $Tgl_Awal  = $StartOfTheMonth->format('Y-m-d'); 
        $Tgl_Akhir = $EndOfTheMonth->format('Y-m-d'); 

        $TglTmp = strtotime($Tanggal);
        $Bulan  = date('m', $TglTmp);
        $Tahun  = date('Y', $TglTmp);

        $Tabel = "KS";
        switch ($NoTrans) {
            case "KS" :
                $Tabel = "kasbon_pegawai"; 
                break;
            case "GS" :
                $Tabel = "gaji_pegawai_master"; 
                break;            
            default:
                $Tabel ="";
        }

        $sql = "SELECT MAX(cast(SUBSTR(nomor,4,4) AS UNSIGNED)) AS nomor FROM $Tabel ".
               "WHERE tanggal BETWEEN '$Tgl_Awal' AND '$Tgl_Akhir' ";                 
        $qry = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($qry);        
        $LastNomor = $row['nomor'];
        
        if ($LastNomor == ""){
            $LastNomor = "0001";
        }else{
            $LastNomor += 1;
        }

        $LastNomor = str_pad($LastNomor,4,"0",STR_PAD_LEFT);

        $NewNomor = $NoTrans."/".$LastNomor."/".NumberToRomawi($Bulan)."/".$Tahun;

        return $NewNomor; 
    }

    function NumberToRomawi ($Number){
        switch ($Number) {
            case 1 :
                $No = "I";
                break;
            case 2 :
                $No = "II";
                break;
            case 3 :
                $No = "III";
                break;    
            case 4 :
                $No = "VI";
                break;        
            case 5 :
                $No = "V";
                break;
            case 6 :
                $No = "VI";
                break;
            case 7 :
                $No = "VII";
                break;    
            case 8 :
                $No = "VIII";
                break;   
            case 9 :
                $No = "IX";
                break;
            case 10 :
                $No = "X";
                break;    
            case 11 :
                $No = "XI";
                break; 
            case 12 :
                $No = "XII";
                break;
            case 13 :
                $No = "XIII";
                break;    
            case 14 :
                $No = "XIV";
                break; 
            case 15 :
                $No = "XV";
                break;
            case 16 :
                $No = "XVI";
                break;    
            case 17 :
                $No = "XVII";
                break;    
            case 18 :
                $No = "XVIII";
                break; 
            case 19 :
                $No = "XIV";
                break; 
            case 20 :
                $No = "XX";
                break;                          
            default:
                $No ="";
        }
        return $No;
    }   
?>