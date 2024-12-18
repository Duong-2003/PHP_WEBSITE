<?php
// Kết nối cơ sở dữ liệu
include('../../../connect_SQL/connect.php');

// Kiểm tra kết nối
if ($connect->connect_error) {
    die("Kết nối không thành công: " . $connect->connect_error);
}

// Xử lý thêm sản phẩm giảm giá
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $product_id = $_POST['product_id'];
    $discount_percent = $_POST['discount_percent'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $sale_description = $_POST['sale_description'];
    $is_expired = isset($_POST['is_expired']) ? 1 : 0; // Kiểm tra checkbox

    // Kiểm tra dữ liệu
    if (empty($product_id) || empty($discount_percent) || empty($start_date) || empty($end_date)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!'); window.history.back();</script>";
        exit;
    }

    // Thêm sản phẩm giảm giá vào cơ sở dữ liệu
    $sql = "INSERT INTO sale (product_id, discount_percent, start_date, end_date, sale_description, is_expired) 
VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);

    // Kiểm tra nếu statement được chuẩn bị thành công
    if (!$stmt) {
        echo "<script>alert('Lỗi chuẩn bị câu lệnh: " . htmlspecialchars($connect->error) . "');</script>";
        exit;
    }

    // Sửa lại bind_param theo kiểu dữ liệu đúng
    $stmt->bind_param("sdssis", $product_id, $discount_percent, $start_date, $end_date, $sale_description, $is_expired);

   

    if ($stmt->execute()) {
        echo "<script>alert('Thêm giảm giá thành công!'); window.location.href='../../Pages/list_sale.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    // Đóng statement
    $stmt->close();
}

// Đóng kết nối
$connect->close();
?>