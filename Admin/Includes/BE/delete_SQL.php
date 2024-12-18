<?php
   include('../../../connect_SQL/connect.php');
    
    $privateKey = $_GET['key'];
    $dataKey = $_GET['datakey'];
    $nameTable = $_GET['table'];
    $query = "DELETE FROM $nameTable WHERE $privateKey = '$dataKey'";
    if($connect->query($query)){
        $connect->close();
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    else{
        echo ('Lỗi xóa dữ liệu');
    }
    $connect->close();
    
?>