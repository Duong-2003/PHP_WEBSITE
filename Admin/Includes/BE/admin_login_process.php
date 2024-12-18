<?php

include('../../../connect_SQL/connect.php');
session_start();
ob_start();

$error = null;

// Kiểm tra xem có dữ liệu từ form gửi lên không
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']); // Tên trường từ form
    $password = trim($_POST['password']); // Tên trường từ form

    // Kiểm tra xem các trường có được điền đầy đủ không
    if (!empty($username) && !empty($password)) {
        // Sử dụng prepared statements để tránh SQL injection
        $stmt = $connect->prepare("SELECT * FROM user WHERE username = ?");
        
        if ($stmt === false) {
            $error = 'Lỗi chuẩn bị truy vấn: ' . htmlspecialchars($connect->error);
        } else {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            // Kiểm tra xem người dùng có tồn tại không
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                $stored_hashed_password = $user['password'];

                // Kiểm tra mật khẩu
                if (password_verify($password, $stored_hashed_password)) {
                    // Kiểm tra vai trò người dùng
                    if ($user['role'] === 1) { 
                        $_SESSION['username'] = $username; // Thiết lập phiên cho admin
                        header('location:../../Pages/admin_website.php');
                        exit();
                    } else {
                        $error = 'Bạn không có quyền truy cập vào trang này.';
                    }
                } else {
                    $error = 'Sai mật khẩu';
                }
            } else {
                $error = 'Tên đăng nhập không tồn tại';
            }
        }
    } else {
        $error = 'Chưa nhập toàn bộ thông tin cần thiết';
    }
} else {
    $error = 'Yêu cầu không hợp lệ';
}

// Đóng kết nối và chuyển hướng nếu có lỗi
if ($error) {
    $connect->close();
    header("location:../../Pages/admin_login.php?error=".urlencode($error));
    exit();
}

// Đóng kết nối
$connect->close();
?>