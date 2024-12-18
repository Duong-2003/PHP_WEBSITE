<?php
session_start();
include('../../connect_SQL/connect.php'); // Kết nối đến cơ sở dữ liệu

$username = $_SESSION['username'] ?? null;

if (!$username) {
    echo "<p class='text-danger'>Vui lòng đăng nhập để xem hồ sơ.</p>";
    exit();
}

$message = "";

// Lấy thông tin từ form
$name = $_POST['username'] ?? ''; 
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$bio = $_POST['bio'] ?? '';
$website = $_POST['website'] ?? '';
$address = $_POST['address'] ?? '';

// Xử lý upload ảnh đại diện
$avatar = $_FILES['avatar'] ?? null;
$avatarPath = '';

if ($avatar && $avatar['error'] == UPLOAD_ERR_OK) {
    // Kiểm tra loại tệp ảnh
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($avatar['type'], $allowedTypes)) {
        $avatarDir = '../Assets/img/index/';
        // Kiểm tra thư mục có tồn tại không
        if (!is_dir($avatarDir)) {
            mkdir($avatarDir, 0755, true); // Tạo thư mục nếu không tồn tại
        }
        $avatarName = uniqid('avatar_') . '_' . basename($avatar['name']);
        $avatarPath = $avatarDir . $avatarName;

        // Di chuyển tệp đến thư mục mong muốn
        if (move_uploaded_file($avatar['tmp_name'], $avatarPath)) {
            $message .= "Ảnh đại diện đã được cập nhật. ";
        } else {
            $message .= "Lỗi khi tải lên ảnh đại diện. ";
        }
    } else {
        $message .= "Chỉ cho phép tải lên tệp hình ảnh (jpg, png, gif). ";
    }
}

// Cập nhật thông tin người dùng trong cơ sở dữ liệu
$sqlUser = "UPDATE `user` SET name = ?, email = ? WHERE user_id = ?";
$stmtUser = $connect->prepare($sqlUser);
$stmtUser->bind_param("ssi", $name, $email, $user_id);
$stmtUser->execute();

// Kiểm tra nếu cập nhật thông tin người dùng thành công
if ($stmtUser->affected_rows > 0) {
    $message .= "Cập nhật thông tin người dùng thành công. ";
} else {
    $message .= "Không có thay đổi nào cho thông tin người dùng. ";
}

// Cập nhật ảnh đại diện nếu đã tải lên
if ($avatarPath) {
    $sqlUpdateAvatar = "UPDATE `user` SET avatar = ? WHERE user_id = ?";
    $stmtUpdateAvatar = $connect->prepare($sqlUpdateAvatar);
    $stmtUpdateAvatar->bind_param("si", $avatarPath, $user_id);
    $stmtUpdateAvatar->execute();

    // Kiểm tra nếu cập nhật ảnh đại diện thành công
    if ($stmtUpdateAvatar->affected_rows > 0) {
        $message .= "Ảnh đại diện đã được cập nhật thành công. ";
    } else {
        $message .= "Không có thay đổi nào cho ảnh đại diện. ";
    }
}

// Cập nhật thông tin hồ sơ
$sqlProfile = "UPDATE `profile_user` SET phone = ?, date_of_birth = ?, gender = ?, bio = ?, website = ?, address = ? WHERE user_id = ?";
$stmtProfile = $connect->prepare($sqlProfile);
$stmtProfile->bind_param("ssssssi", $phone, $dob, $gender, $bio, $website, $address, $user_id);
$stmtProfile->execute();

// Kiểm tra nếu cập nhật thông tin hồ sơ thành công
if ($stmtProfile->affected_rows > 0) {
    $message .= "Cập nhật hồ sơ thành công. ";
} else {
    $message .= "Không có thay đổi nào cho hồ sơ. ";
}

// Đóng kết nối
$stmtUser->close();
if (isset($stmtUpdateAvatar)) {
    $stmtUpdateAvatar->close();
}
$stmtProfile->close();
$connect->close();

// Chuyển hướng về trang hồ sơ và hiển thị thông báo
$_SESSION['message'] = $message;
header("Location: ../../Website/profile_user.php"); // Chuyển hướng về trang hồ sơ
exit();
?>