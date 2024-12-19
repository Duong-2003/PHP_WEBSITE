<?php
 include('../../connect_SQL/connect.php');
session_start();
ob_start();

if (isset($_POST['submit']) && !empty($_POST['order_id'])) {
    $newStatus = $_POST['order_status'];
    $newPrice = $_POST['order_price'];
    $statusOther = $_POST['status_input'];
    $id = $_POST['order_id'];

    // Xử lý giá trị tiền
    if (is_string($newPrice)) {
        $newPrice = (float) str_replace(',', '', $newPrice);
    }

    // Tạo truy vấn
    if ($newStatus !== 'Khác' && !empty($newStatus)) {
        $query = "UPDATE order 
                  SET order_status = '$newStatus', order_price = '$newPrice'
                  WHERE order_id = '$id'";
    } else {
        $query = "UPDATE order 
                  SET order_status = '$statusOther', order_price = '$newPrice'
                  WHERE order_id = '$id'";
    }

    // Thực thi truy vấn
    if ($connect->query($query) === TRUE) {
        $connect->close();
        header("Location: ../Pages/list_order.php?notifi=Sửa thành công");
    } else {
        $connect->close();
        $error = "&&error=Lỗi không sửa được đơn hàng: " . $connect->error;
        header("Location: ../Pages/list_order.php?datakey=" . $id . $error);
    }
} else {
    $connect->close();
    $error = "&&error=Chưa nhập toàn bộ thông tin.";
    header("Location: ../Includes/BE/edit_order.php?datakey=" . $id . $error);
}
?>