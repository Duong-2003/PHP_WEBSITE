<?php
include('./admin_website.php');
include('../../connect_SQL/connect.php');

$dataKey = isset($_GET['datakey']) ? $_GET['datakey'] : null;

if ($dataKey === null) {
    echo ('<div class="alert alert-danger">ERROR: Không tìm thấy mã người dùng.</div>');
    exit();
}

// Lấy thông tin người dùng
$sqlUser = "SELECT * FROM user WHERE user_id = ?";
$stmt = $connect->prepare($sqlUser);
$stmt->bind_param("i", $dataKey);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false || $result->num_rows != 1) {
    echo ('<div class="alert alert-danger">ERROR: Không tìm thấy người dùng.</div>');
    exit();
}

$user = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa Thông Tin Người Dùng</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css">
  <style>
    .content {
      padding: 50px 30px;
      background-color: #f9f9f9;
    }

    .form-label {
      font-weight: bold;
    }

    .text-danger {
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="content">
    <h2 class="text-center mb-4">Sửa Thông Tin Người Dùng</h2>

    <form action="../Includes/BE/edit_users.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
      <input type="hidden" name="current_password" value="<?= htmlspecialchars($user['password']) ?>">
      <div class="mb-3">
        <label class="form-label">Tên nguoi dùng <span class="text-danger">*</span></label>
        <input value="<?= htmlspecialchars($user['name']) ?>" name="name" type="text" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tên Đăng Nhập <span class="text-danger">*</span></label>
        <input value="<?= htmlspecialchars($user['username']) ?>" name="username" type="text" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input value="<?= htmlspecialchars($user['email']) ?>" name="email" type="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Mật khẩu (để trống nếu không thay đổi)</label>
        <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu mới">
      </div>

      <div class="mb-3">
        <label class="form-label">Địa Chỉ</label>
        <input value="<?= htmlspecialchars($user['address']) ?>" name="address" type="text" class="form-control">
      </div>

      <!-- <div class="mb-3">
        <label class="form-label">Số Điện Thoại</label>
        <input value="<?= htmlspecialchars($user['phone']) ?>" name="phone" type="text" class="form-control">
      </div> -->

      <div class="mb-3">
        <label class="form-label">Quyền <span class="text-danger">*</span></label>
        <select name="role" class="form-select" required>
          <option value="Admin" <?= ($user['role'] === 'Admin') ? 'selected' : ''; ?>>Admin</option>
          <option value="User" <?= ($user['role'] === 'User') ? 'selected' : ''; ?>>User</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Ảnh Đại Diện</label>
        <input type="file" name="avatar" class="form-control" accept="image/*">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Lưu Thay Đổi</button>
      <a href="../Pages/list_user.php" class="btn btn-secondary">Quay Về</a>
    </form>
  </div>
</body>

</html>