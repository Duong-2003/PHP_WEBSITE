<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Chỉnh Sửa Hồ Sơ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .profile-header {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            border: 3px solid #ff4d4d;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ff4d4d;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e03e3e;
        }

        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include('../Sources/FE/top_header.php');
    include('../Sources/FE/header.php');
    include('../connect_SQL/connect.php'); 

    // Check if user is logged in
    $username = $_SESSION['username'] ?? null;
    if (!$username) {
        echo "<p class='text-danger text-center'>Vui lòng đăng nhập để xem hồ sơ.</p>";
        exit();
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        // Kiểm tra xem địa chỉ có được nhập không
        if (empty($address)) {
            echo "<p class='text-danger text-center'>Địa chỉ không được để trống.</p>";
        } else {
            // Tiến hành cập nhật
        }
    }
    // Fetch user data
    $sqlUser = "SELECT * FROM `user` WHERE username = ?";
    $stmtUser = $connect->prepare($sqlUser);
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser->num_rows > 0) {
        $userData = $resultUser->fetch_assoc();
        $user_id = $userData['user_id'];

        // Fetch profile data
        $sqlProfile = "SELECT * FROM `profile_user` WHERE user_id = ?";
        $stmtProfile = $connect->prepare($sqlProfile);
        $stmtProfile->bind_param("i", $user_id);
        $stmtProfile->execute();
        $resultProfile = $stmtProfile->get_result();

        $profileData = $resultProfile->num_rows > 0 ? $resultProfile->fetch_assoc() : [];
    } else {
        echo "<p class='text-danger text-center'>Không tìm thấy thông tin người dùng.</p>";
        exit();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['username'];
        $email = $userData['email']; // Email is not editable
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $bio = $_POST['bio'];
        $website = $_POST['website'];
        $address = $_POST['address'];
        
        // Handle avatar upload
        $avatarPath = $userData['avatar']; // Default path
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "../Assets/img/index/";
            $targetFile = $targetDir . basename($_FILES["avatar"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);

            // Validate image file
            if ($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                    $avatarPath = $targetFile; // Update path if uploaded successfully
                } else {
                    echo "<p class='text-danger text-center'>Có lỗi xảy ra khi tải lên ảnh đại diện.</p>";
                }
            } else {
                echo "<p class='text-danger text-center'>File không phải là hình ảnh hợp lệ.</p>";
            }
        }

        // Update user profile in the database
      $sqlUpdate = "UPDATE `profile_user` SET phone=?, date_of_birth=?, gender=?, bio=?, website=?, address=?, avatar=? WHERE user_id=?";
$stmtUpdate = $connect->prepare($sqlUpdate);
$stmtUpdate->bind_param("sssssisi", $phone, $dob, $gender, $bio, $website, $address, $avatarPath, $user_id);
        
        if ($stmtUpdate->execute()) {
            echo "<p class='text-success text-center'>Cập nhật hồ sơ thành công!</p>";
        } else {
            echo "<p class='text-danger text-center'>Có lỗi xảy ra trong quá trình cập nhật hồ sơ.</p>";
        }
    }
    ?>

    <div class="container mt-5">
        <div class="profile-header">
            <?php
            $avatarPath = htmlspecialchars($userData['avatar']);
            if (file_exists($avatarPath) && !empty($avatarPath)) {
                echo '<img src="' . $avatarPath . '" alt="Avatar">';
            } else {
                echo '<img src="../Assets/img/index/avatar-dep-119.jpg" alt="Avatar">';
            }
            ?>
            <h2><?php echo htmlspecialchars($userData['name']); ?></h2>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">ID người dùng</label>
                        <input type="text" class="form-control" id="user_id" value="<?php echo htmlspecialchars($userData['user_id']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người dùng <span class="text-muted">(Bắt buộc)</span></label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-muted">(Không thể thay đổi)</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại <span class="text-muted">(Tùy chọn)</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($profileData['phone']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Ngày sinh <span class="text-muted">(Tùy chọn)</span></label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($profileData['date_of_birth']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Giới tính <span class="text-muted">(Tùy chọn)</span></label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="" <?php echo empty($profileData['gender']) ? 'selected' : ''; ?>>Chọn giới tính</option>
                            <option value="male" <?php echo (isset($profileData['gender']) && $profileData['gender'] == 'male') ? 'selected' : ''; ?>>Nam</option>
                            <option value="female" <?php echo (isset($profileData['gender']) && $profileData['gender'] == 'female') ? 'selected' : ''; ?>>Nữ</option>
                            <option value="other" <?php echo (isset($profileData['gender']) && $profileData['gender'] == 'other') ? 'selected' : ''; ?>>Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Giới thiệu bản thân <span class="text-muted">(Tùy chọn)</span></label>
                        <textarea class="form-control" id="bio" name="bio" rows="2"><?php echo htmlspecialchars($profileData['bio']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website <span class="text-muted">(Tùy chọn)</span></label>
                        <input type="url" class="form-control" id="website" name="website" value="<?php echo htmlspecialchars($profileData['website']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ <span class="text-muted">(Tùy chọn)</span></label>
                        <textarea class="form-control" id="address" name="address" rows="1"><?php echo htmlspecialchars($profileData['address']); ?></textarea>
                       
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="./profile_user.php" class="btn btn-secondary">Quay Về</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
include('../Sources/FE/footer_save.php');
include('../Sources/FE/footer.php');
?>

</html>