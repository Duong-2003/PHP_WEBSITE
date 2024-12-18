<?php
session_start();
include('../../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn để kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM user WHERE username = ? AND status = 1"; // Kiểm tra trạng thái người dùng
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            // Cập nhật thời gian đăng nhập cuối
            $updateLoginTimeSQL = "UPDATE user SET last_login = NOW() WHERE user_id = ?";
            $updateStmt = $connect->prepare($updateLoginTimeSQL);
            $updateStmt->bind_param("i", $user['user_id']);
            $updateStmt->execute();

            // Chuyển hướng đến trang chính hoặc trang mong muốn
            header("Location: ../../Website/website.php");
            exit();
        } else {
            header("Location: ../../Website/login.php?error=Thông tin đăng nhập không chính xác");
            exit();
        }
    } else {
        header("Location: ../../Website/login.php?error=Thông tin đăng nhập không chính xác");
        exit();
    }
}
?>