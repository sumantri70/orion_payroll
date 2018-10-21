<?php

    $month_ini = new DateTime("first day of 2012-02-10");
    $month_end = new DateTime("last day of 2012-02-10");

    echo $month_ini->format('Y-m-d'); // 2012-02-01
    echo "<br>";
    echo $month_end->format('Y-m-d'); // 2012-02-29

    echo "<br>";
    echo "<br>";

    $str = "11";
    echo str_pad($str,4,"0",STR_PAD_LEFT);


    echo "<br>";
    echo "<br>";

    $test = "2010-10-02";
    $unixtime = strtotime($test);
    echo date('m', $unixtime); //month
    echo date('d', $unixtime); 
    echo date('y', $unixtime );

?>