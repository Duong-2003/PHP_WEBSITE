<?php
include('../../../connect_SQL/connect.php');
session_start();
ob_start();

if (isset($_POST['submit']) && !empty($_POST['product_type_name']) && !empty($_POST['product_type_id'])) {
    $product_type_name = trim($_POST['product_type_name']);
    $product_type_id = trim($_POST['product_type_id']);

    // Sử dụng Prepared Statement để kiểm tra loại sản phẩm đã tồn tại
    $stmt = $connect->prepare("SELECT * FROM product_type WHERE product_type_name = ? AND product_type_id = ?");
    $stmt->bind_param("ss", $product_type_name, $product_type_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt->close();
        $connect->close();
        echo "Lỗi: Giá trị đã tồn tại trong cơ sở dữ liệu.";
        exit();
    }

    // Thêm loại sản phẩm mới vào cơ sở dữ liệu
    $stmt = $connect->prepare("INSERT INTO product_type (product_type_name, product_type_id) VALUES (?, ?)");
    $stmt->bind_param("ss", $product_type_name, $product_type_id);
    
    if ($stmt->execute()) {
        $_SESSION['notifi'] = "Thêm loại sản phẩm thành công!";
        header("Location: ../../Pages/list_product_type.php");
        exit();
    } else {
        echo "Lỗi không thêm được loại sản phẩm: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Chưa nhập toàn bộ thông tin.";
    exit(); 
}

$connect->close();
?>