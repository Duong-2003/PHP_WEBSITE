<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Hồ Sơ Người Dùng</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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

        .form-control-plaintext {
            background-color: #e9ecef;
            border: none;
            font-size: 1rem; /* Kích thước font chữ */
        }

        .btn-primary {
            background-color: #ff4d4d;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e03e3e;
        }

        label {
            font-weight: 500; /* Độ dày font chữ cho label */
        }

        h2 {
            font-weight: 700; /* Độ dày font chữ cho tiêu đề */
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include('../Sources/FE/top_header.php');
    include('../Sources/FE/header.php');
    include('../connect_SQL/connect.php');

    $username = $_SESSION['username'] ?? null;

    if (!$username) {
        echo "<p class='text-danger text-center'>Vui lòng đăng nhập để xem hồ sơ.</p>";
        exit();
    }

    // Fetch user data
    $sqlUser = "SELECT * FROM `user` WHERE username = ?";
    $stmtUser = $connect->prepare($sqlUser);
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser->num_rows === 0) {
        echo "<p class='text-danger text-center'>Không tìm thấy thông tin người dùng.</p>";
        exit();
    }

    $userData = $resultUser->fetch_assoc();
    $user_id = $userData['user_id'];

    // Fetch profile data
    $sqlProfile = "SELECT * FROM `profile_user` WHERE user_id = ?";
    $stmtProfile = $connect->prepare($sqlProfile);
    $stmtProfile->bind_param("i", $user_id);
    $stmtProfile->execute();
    $resultProfile = $stmtProfile->get_result();

    $profileData = $resultProfile->num_rows > 0 ? $resultProfile->fetch_assoc() : [];
    ?>

    <div class="container mt-5">
        <div class="profile-header">
            <?php
            $avatarPath = htmlspecialchars($userData['avatar']);
            echo '<img src="' . (file_exists($avatarPath) && !empty($avatarPath) ? $avatarPath : "../Assets/img/index/avatar-dep-119.jpg") . '" alt="Avatar">';
            ?>
            <h2><?php echo htmlspecialchars($userData['name']); ?></h2>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="user_id" class="form-label">ID người dùng</label>
                    <p class="form-control-plaintext" id="user_id"><?php echo htmlspecialchars($userData['user_id']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên người dùng</label>
                    <p class="form-control-plaintext" id="username"><?php echo htmlspecialchars($userData['name']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <p class="form-control-plaintext" id="email"><?php echo htmlspecialchars($userData['email']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <p class="form-control-plaintext" id="phone"><?php echo htmlspecialchars($profileData['phone']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Ngày sinh</label>
                    <p class="form-control-plaintext" id="dob"><?php echo htmlspecialchars($profileData['date_of_birth']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Giới tính</label>
                    <p class="form-control-plaintext" id="gender"><?php echo htmlspecialchars($profileData['gender']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Giới thiệu bản thân</label>
                    <p class="form-control-plaintext" id="bio"><?php echo htmlspecialchars($profileData['bio']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <p class="form-control-plaintext" id="website"><?php echo htmlspecialchars($profileData['website']); ?></p>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <p class="form-control-plaintext" id="address"><?php echo htmlspecialchars($profileData['address']); ?></p>
                </div>
                <div class="text-center">
                    <a href="./edit_profile.php" class="btn btn-primary">Chỉnh sửa hồ sơ</a>
                </div>
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