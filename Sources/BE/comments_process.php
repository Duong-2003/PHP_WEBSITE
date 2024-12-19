<?php
session_start();
include('../../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem product_id có được gửi không
    if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
        echo "ERROR: Không nhận được ID sản phẩm.";
        exit();
    }

    // Lấy dữ liệu từ biểu mẫu
    $product_id = intval($_POST['product_id']); // Mã sản phẩm
    $user_name = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : null; // Tên người dùng
    $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : null; // Nội dung bình luận
    $avatar = isset($_SESSION['avatar']) ? htmlspecialchars($_SESSION['avatar']) : null; // Đường dẫn đến ảnh đại diện

    // Kiểm tra dữ liệu
    if (empty($user_name) || empty($comment)) {
        echo "Tên người dùng hoặc bình luận không được để trống.";
        exit();
    }

    // Thêm bình luận vào cơ sở dữ liệu
    $sql = "INSERT INTO comments (product_id, user_name, comment, avatar) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);

    if ($stmt === false) {
        echo "Có lỗi xảy ra khi chuẩn bị câu lệnh: " . $connect->error;
        exit();
    }

    $stmt->bind_param("isss", $product_id, $user_name, $comment, $avatar);

    if ($stmt->execute()) {
        // Chuyển hướng về trang sản phẩm
        header("Location: ../../Website/product.php?product_id=" . $product_id); // Sửa lại để sử dụng product_id
        exit();
    } else {
        echo "Có lỗi xảy ra khi thêm bình luận: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ERROR: Yêu cầu không hợp lệ.";
    exit();
}
?>