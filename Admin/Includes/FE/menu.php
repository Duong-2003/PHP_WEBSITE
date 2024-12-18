<?php
session_start();
ob_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../Pages/admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            margin: 0;
            transition: margin-left 0.3s;
        }

        .sidebar {
            height: 100vh;
            width: 335px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            font-family: 'Verdana', sans-serif;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .sidebar .nav-link {
            color: #f8f9fa;
            font-size: 1.1rem;
            transition: background-color 0.3s;
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .sidebar .user-info {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #f8f9fa;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content {
            margin-left: 200px; /* Adjust based on sidebar width */
            
      
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 10px;
            }

            .sidebar .nav-link {
                font-size: 1rem;
            }

            
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="user-info">
            <img src="https://cdn-media.sforum.vn/storage/app/media/THANHAN/2/2a/avatar-dep-119.jpg" alt="Avatar"
                class="avatar me-2">
            <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
        </div>
        <div class="modal-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="../Pages/ecom.php" class="nav-link"><i class="fa-solid fa-chart-line"></i> Thống kê</a>
                </li>
                <li class="nav-item">
                    <a href="../Pages/list_product_type.php" class="nav-link"><i class="fa-solid fa-tags"></i> Danh mục loại sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="../Pages/list_product.php" class="nav-link"><i class="fa-solid fa-box"></i> Danh mục sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="../Pages/list_sale.php" class="nav-link"><i class="fa-solid fa-tag"></i> Danh mục sản phẩm giảm giá</a>
                </li>
                <li class="nav-item">
                    <a href="../Pages/list_user.php" class="nav-link"><i class="fa-solid fa-users"></i> Danh mục tài khoản</a>
                </li>
                <li class="nav-item">
                    <a href="../Pages/list_order.php" class="nav-link"><i class="fa-solid fa-shopping-cart"></i> Danh mục đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="../Pages/list_profile.php" class="nav-link"><i class="fa-solid fa-id-card"></i> Thông tin người dùng</a>
                </li>
                <li class="nav-item">
                    <a href="../Includes/BE/admin_logout_process.php" class="nav-link"><i class="fa-solid fa-sign-out-alt"></i> Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- <h1 class="text-center">Chào mừng đến Quản trị</h1> -->
        <!-- Thêm nội dung chính tại đây -->
    </div>

</body>

</html>