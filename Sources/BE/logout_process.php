<?php

session_start();
session_destroy(); // Xóa phiên đăng nhập
header('Location:../../Website/website.php'); // Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
exit;
?>