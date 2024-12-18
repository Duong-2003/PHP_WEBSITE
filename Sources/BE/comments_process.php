<?php
session_start();
include('../../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ biểu mẫu
    $product_id = intval($_POST['product_id']); // Mã sản phẩm
    $user_name = htmlspecialchars($_SESSION['username']); // Tên người dùng
    $comment = htmlspecialchars($_POST['comment']); // Nội dung bình luận
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
        echo "Bình luận đã được thêm thành công!";
    } else {
        echo "Có lỗi xảy ra: " . $stmt->error;
    }

    $stmt->close();
}
?>