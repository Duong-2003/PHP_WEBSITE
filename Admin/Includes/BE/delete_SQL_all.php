<?php
 include('../../connect_SQL/connect.php');
session_start();

// Lấy dữ liệu từ GET và kiểm tra
$privateKey = isset($_GET['key']) ? $_GET['key'] : null;
$dataKey = isset($_GET['datakey']) ? $_GET['datakey'] : null;
$nameTable = isset($_GET['table']) ? $_GET['table'] : null;

// Kiểm tra tính hợp lệ của các tham số
if ($privateKey && $dataKey && $nameTable) {
    // Đảm bảo rằng tên bảng là hợp lệ
    $validTables = ['loaisp', 'sanpham']; // Thay đổi theo các bảng có sẵn trong cơ sở dữ liệu
    if (in_array($nameTable, $validTables)) {
        // Sử dụng prepared statements để ngăn chặn SQL injection
        $stmt = $connect->prepare("DELETE FROM $nameTable WHERE $privateKey = ?");
        
        if ($stmt) {
            $stmt->bind_param("s", $dataKey); // Giả sử rằng dataKey có kiểu chuỗi

            if ($stmt->execute()) {
                $_SESSION['notifi'] = "Xóa loại sản phẩm thành công!";
                $stmt->close();
                $connect->close();
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Lỗi xóa dữ liệu: " . $stmt->error;
            }
        } else {
            echo "Lỗi chuẩn bị câu lệnh: " . $connect->error;
        }
    } else {
        echo "Tên bảng không hợp lệ.";
    }
} else {
    echo "Tham số không hợp lệ.";
}

$connect->close();
?>