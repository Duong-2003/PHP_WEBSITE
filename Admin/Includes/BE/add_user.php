<?php

include('../../../connect_SQL/connect.php');

session_start();
ob_start();

if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ biểu mẫu
    $user_name = trim($_POST['name']); // Đổi lại để lấy tên từ trường name
    $user_username = trim($_POST['username']); // Tên đăng nhập
    $user_pass = $_POST['password'];  
    $user_email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    
    // Gán quyền quản trị viên (1)
    $role = '1';  // Đặt quyền là ADMIN

    // Kiểm tra các trường bắt buộc
    if (empty($user_username) || empty($user_pass) || empty($user_email) || empty($address) || empty($phone)) {
        redirectWithError("Vui lòng nhập đầy đủ thông tin.");
    }

    // Đường dẫn ảnh đại diện mặc định
    $avatar_destination = '../../Assets/img/index/avatar-dep-119.jpg';

    // Kiểm tra xem tên người dùng đã tồn tại chưa
    $checkUserQuery = $connect->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
    $checkUserQuery->bind_param("s", $user_username);
    $checkUserQuery->execute();
    $checkUserQuery->bind_result($count_user);
    $checkUserQuery->fetch();
    $checkUserQuery->close();

    if ($count_user > 0) {
        redirectWithError("Tên người dùng đã tồn tại.");
    }

    // Kiểm tra xem email đã tồn tại chưa
    $checkEmailQuery = $connect->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $checkEmailQuery->bind_param("s", $user_email);
    $checkEmailQuery->execute();
    $checkEmailQuery->bind_result($count_email);
    $checkEmailQuery->fetch();
    $checkEmailQuery->close();

    if ($count_email > 0) {
        redirectWithError("Email đã tồn tại.");
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);

    // Tạo câu truy vấn SQL để thêm người dùng mới
    $query = $connect->prepare("INSERT INTO user (name, username, password, email, address, phone, role, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssssss", $user_name, $user_username, $hashed_password, $user_email, $address, $phone, $role, $avatar_destination);

    if ($query->execute()) {
        $query->close();
        $connect->close();
        header("location:../../Pages/list_user.php?notifi=" . urlencode("Thêm quản trị viên thành công"));
        exit();
    } else {
        redirectWithError("Lỗi không thêm được người dùng: " . $query->error);
    }
} else {
    redirectWithError("Yêu cầu không hợp lệ.");
}

// Hàm điều hướng với thông báo lỗi
function redirectWithError($errorMessage) {
    global $connect; // Đảm bảo rằng chúng ta có kết nối cơ sở dữ liệu
    $connect->close();
    header("location:../../Pages/list_user.php?error=" . urlencode($errorMessage));
    exit();
}
?>