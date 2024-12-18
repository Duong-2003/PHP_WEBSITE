<?php
    $dbHost = "localHost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "webbanhang";

    $connect = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);

    if($connect){
        $setLang = mysqli_query($connect, "SET NAMES 'utf8'");
    }
    else{
        die("Kết nối thất bại" . mysqli_connect_error());
    }
?>