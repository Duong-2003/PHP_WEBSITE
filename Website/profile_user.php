<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Hồ Sơ Người Dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .profile-header {
            background-color: #f7f7f7;
            padding: 20px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .profile-header img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }

        .profile-info {
            margin-top: 20px;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include('../Sources/FE/top_header.php');
    include('../Sources/FE/header.php');
    include('../connect_SQL/connect.php'); // Kết nối đến cơ sở dữ liệu
    
    $username = $_SESSION['username'] ?? null;

    if (!$username) {
        echo "<p class='text-danger'>Vui lòng đăng nhập để xem hồ sơ.</p>";
        exit();
    }

    // Lấy thông tin người dùng dựa trên username
    $sqlUser = "SELECT * FROM `user` WHERE username = ?";
    $stmtUser = $connect->prepare($sqlUser);
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser->num_rows > 0) {
        $userData = $resultUser->fetch_assoc();
        $user_id = $userData['user_id'];

        // Lấy thông tin hồ sơ dựa trên user_id
        $sqlProfile = "SELECT * FROM `profile_user` WHERE user_id = ?";
        $stmtProfile = $connect->prepare($sqlProfile);
        $stmtProfile->bind_param("i", $user_id);
        $stmtProfile->execute();
        $resultProfile = $stmtProfile->get_result();

        // Đảm bảo biến $profileData tồn tại
        if ($resultProfile->num_rows > 0) {
            $profileData = $resultProfile->fetch_assoc();
        } else {
            $profileData = [];
        }
    } else {
        echo "<p class='text-danger'>Không tìm thấy thông tin người dùng.</p>";
        exit();
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
        <div class="card profile-info">
            <div class="card-body">
                <div class="mb-3">
                    <label for="user_id" class="form-label">ID người dùng</label>
                    <input type="text" class="form-control" id="user_id"
                        value="<?php echo htmlspecialchars($userData['user_id'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên người dùng</label>
                    <input type="text" class="form-control" id="name"
                        value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email"
                        value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone"
                        value="<?php echo htmlspecialchars($profileData['phone'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="dob"
                        value="<?php echo htmlspecialchars($profileData['date_of_birth'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Giới tính</label>
                    <input type="text" class="form-control" id="gender"
                        value="<?php echo htmlspecialchars($profileData['gender'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Giới thiệu bản thân</label>
                    <textarea class="form-control" id="bio" rows="3"
                        readonly><?php echo htmlspecialchars($profileData['bio'] ?? ''); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website"
                        value="<?php echo htmlspecialchars($profileData['website'] ?? ''); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address"
                        value="<?php echo htmlspecialchars($profileData['address'] ?? ''); ?>" readonly>
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