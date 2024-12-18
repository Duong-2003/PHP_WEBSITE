<?php

include('../conn/connect.php');
session_start();
ob_start();
try {
    // Mã đơn hàng cần hủy
    $order_id = $_GET["datakey"]; // Thay bằng mã đơn hàng thực tế cần hủy

    // Cập nhật trạng thái của đơn hàng
    $updateOrderQuery = "UPDATE order SET order_status = 'Đã hủy' WHERE order_id = $order_id";
    $connect->query($updateDonHangQuery);

    // Lấy thông tin số lượng sản phẩm từ đơn hàng
    $getOrderInfoQuery = "SELECT product_id, order_quantity FROM order WHERE order_id = $order_id";
    $OrderInfoResult = $connect->query($getOrderInfoQuery);

    if ($OrderInfoResult->num_rows > 0) {
        while ($row = $OrderInfoResult->fetch_assoc()) {
            $sanpham_id = $row['product_id'];
            $soluongsp = $row['order_quantity'];

            // Cập nhật số lượng sản phẩm trong bảng sanpham
            $updateProductQuery = "UPDATE product SET product_quantity = product_quantity + $product_quantity WHERE product_id = $product_id";
            $connect->query($updateProductQuery);
        }
    }

    // Hoàn tất giao dịch nếu mọi thứ thành công
    $connect->commit();
    $connect->close();
    header("location:../Pages/list_order.php?notifi=Sửa thành công");
} catch (Exception $e) {
    // Nếu có lỗi, rollback giao dịch
    $connect->rollback();
    $connect->close();
    header("location:../Pages/list_order.php?error=".$e->getMessage()); 
}
