<?php
 include('../../connect_SQL/connect.php');
session_start();
ob_start();

if (isset($_POST['submit']) && $_FILES['avatar'] != null && $_POST['name'] != '' && $_POST['pass'] != '' && $_POST['email'] != '' && $_POST['address'] != '' && $_POST['phone'] != '') {
    $user_name = $_POST['name'];
    $user_pass = $_POST['pass'];
    $user_email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = '1'; // Gán quyền quản trị viên mặc định
    $avatar = basename($_FILES['avatar']['name']);

    $target_avatar = '../../../Assets/img/Users/' . $avatar;
    $error = '';

    // Kiểm tra xem tên người dùng đã tồn tại chưa
    $checkQuery = $connect->prepare("SELECT COUNT(*) FROM users WHERE name = ?");
    $checkQuery->bind_param("s", $user_name);
    $checkQuery->execute();
    $checkQuery->bind_result($count);
    $checkQuery->fetch();
    $checkQuery->close();

    if ($count > 0) {
        $error = "?error=Tên người dùng đã tồn tại.";
        header("location:../../Pages/ListUsers.php" . $error);
        exit();
    }

    // Kiểm tra xem ảnh đã tồn tại chưa
    if (!IsAlreadyExists($target_avatar)) {
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_avatar)) {
            $error = "?error=Lỗi không di chuyển ảnh đến Assets.";
            header("location:../../Pages/ListUsers.php" . $error);
            exit();
        }
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);

    // Tạo câu truy vấn SQL để thêm người dùng
    $query = "INSERT INTO users (name, pass, email, address, phone, role, avatar) 
              VALUES ('$user_name', '$hashed_password', '$user_email', '$address', '$phone', '$role', '$avatar')";

    // Thực hiện truy vấn và kiểm tra kết quả
    if ($connect->query($query) === TRUE) {
        $connect->close();
        header("location:../../Pages/ListUsers.php?notifi=Thêm thành công");
        exit();
    } else {
        $connect->close();
        $error = "?error=Lỗi không thêm được người dùng: " . $connect->error;
        header("location:../../Pages/ListUsers.php" . $error);
        exit();
    }
} else {
    // Xử lý trường hợp không đủ thông tin
    $error = "?error=Vui lòng điền đầy đủ thông tin.";
    header("location:../../Pages/ListUsers.php" . $error);
    exit();
}

// Hàm kiểm tra xem ảnh đã tồn tại hay chưa
function IsAlreadyExists($target) {
    return file_exists($target);
}
?>