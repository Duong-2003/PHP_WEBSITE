<?php
session_start();
include('../../connect_SQL/connect.php'); // Ensure you include your database connection

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ./login.php?error=" . urlencode("Vui lòng đăng nhập để thực hiện hành động này."));
    exit();
}

// Check if order_id is set in the POST request
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $username = $_SESSION['username'];

    // Prepare a statement to update the order status to "Đã hủy"
    $stmt = $connect->prepare("UPDATE `order` SET order_status = 'Đã hủy' WHERE order_id = ? AND user_id = (SELECT user_id FROM user WHERE username = ?)");
    $stmt->bind_param("is", $order_id, $username);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: ../../Website/cart.php?notifi=" . urlencode("Đơn hàng đã được hủy thành công."));
    } else {
        // Redirect with an error message
        header("Location: ../../Website/cart.php?notifi=" . urlencode("Có lỗi xảy ra, không thể hủy đơn hàng."));
    }

    $stmt->close();
} else {
    // Redirect with an error message if no order_id is provided
    header("Location: ../../Website/cart.php?notifi=" . urlencode("Không tìm thấy đơn hàng để hủy."));
}

$connect->close();
?>