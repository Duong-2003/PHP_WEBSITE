<?php
 include('../../connect_SQL/connect.php');
session_start();
session_destroy(); // Xóa phiên đăng nhập
header('Location:../../Pages/Admin_Login.php'); // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
exit;
?>