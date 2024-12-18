<?php
session_start();
ob_start();

include('../../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu
if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['resetpass'])) {

    $username = htmlspecialchars($_POST['username']);
    
    $password = $_POST['password'];
    
    $email = htmlspecialchars($_POST['email']);
    
    $name = htmlspecialchars($_POST['name']);
    
    $resetpass = $_POST['resetpass'];
    
    // $address = htmlspecialchars($_POST['address']);
    
    $role = 0; // Default role for all new users
    
    $error = null;
    
    $notifi = null;


    // Kiểm tra xem tất cả thông tin bắt buộc có được nhập không
    if (empty($username) || empty($password) || empty($resetpass) || empty($email) || empty($name) ) {
        $error = 'Chưa nhập toàn bộ thông tin bắt buộc';
        redirectWithError($error);
    }

    // Kiểm tra xem mật khẩu có trùng nhau không
    if ($password !== $resetpass) {
        $error = 'Mật khẩu nhập lại không giống';
        redirectWithError($error);
    }

    // Kiểm tra xem tên tài khoản đã tồn tại chưa
    $checkQuery = "SELECT * FROM user WHERE username = ?";
    $stmt = $connect->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = 'Tài khoản đã tồn tại';
        redirectWithError($error);
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Chuẩn bị truy vấn chèn
    $query = "INSERT INTO user (username, password, name,role, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssisss", $username,  $hashed_password, $name ,$role, $email, ); // Sử dụng 's' cho tất cả các tham số là chuỗi

    // Thực thi truy vấn
    if ($stmt->execute()) {
        $notifi = 'Đăng ký thành công';
        header("Location: ../../Website/login.php?notifi=" . urlencode($notifi));
        exit();
    } else {
        $error = 'Lỗi đăng ký: ' . $stmt->error;
        redirectWithError($error);
    }

    $stmt->close();
    $connect->close();
} else {
    $error = 'Yêu cầu không hợp lệ';
    redirectWithError($error);
}

function redirectWithError($error) {
    header("Location: ../../Website/register.php?error=" . urlencode($error));
    exit();
}
?>