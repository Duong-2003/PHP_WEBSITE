<?php
include('../../../connect_SQL/connect.php');
include('./check_images.php');
session_start();
ob_start();

if (isset($_POST['submit']) && !empty($_POST['product_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $name = isset($_POST['product_name']) ? $_POST['product_name'] : null;
    $price = isset($_POST['product_price']) ? $_POST['product_price'] : null;
    $describe = (isset($_POST['product_description']) && trim($_POST['product_description']) !== '') ? $_POST['product_description'] : null;
    $describeDetail = isset($_POST['product_details']) ? $_POST['product_details'] : null;
    $quantity = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : null;
    $typename = isset($_POST['product_type_name']) ? $_POST['product_type_name'] : null;
    $type = isset($_POST['product_type_id']) ? $_POST['product_type_id'] : null;
    $img = basename($_FILES['product_images']['name']);
    $ma = $_POST['product_id'];

    $target_img = '../../../Assets/img/sanpham/' . $img; // Đảm bảo đường dẫn chính xác
    $error = '';

    // Kiểm tra và di chuyển tệp ảnh nếu có
    if (!empty($img)) {
        if (IsExceedingFileNameSize($img)) {
            $error = "Tên ảnh quá dài không thể lưu trữ";
            header("location:../Includes/BE/edit_product.php?datakey=$ma&error=" . urlencode($error));
            exit();
        }

        if (!move_uploaded_file($_FILES['product_images']['tmp_name'], $target_img)) {
            $error = "Lỗi không di chuyển ảnh đến Assets";
            header("location:../Includes/BE/edit_product.php?datakey=$ma&error=" . urlencode($error));
            exit();
        }
    }

    // Chuyển đổi giá tiền từ định dạng có dấu phẩy sang số thực
    if (is_string($price)) {
        $price = (float) str_replace(',', '', $price);
    }

    // Kiểm tra nếu loại sản phẩm tồn tại
    $typeCheckQuery = "SELECT * FROM product WHERE product_type_id = '$type'";
    $typeCheckResult = $connect->query($typeCheckQuery);

    if ($typeCheckResult->num_rows == 0) {
        $error = "Loại sản phẩm không tồn tại";
        header("location:../Includes/BE/edit_product.php?datakey=$ma&error=" . urlencode($error));
        exit();
    }

    // Tạo câu truy vấn SQL
    $query = "UPDATE product SET 
                product_name = '$name', 
                product_price = '$price', 
                product_description = '$describe', 
                product_details = '$describeDetail', 
                product_quantity = '$quantity', 
                product_type_id = '$type', 
                product_type_name = '$typename'";

    // Chỉ cập nhật hình ảnh nếu có
    if (!empty($img)) {
        $query .= ", product_images = '$img'";
    }

    $query .= " WHERE product_id = '$ma'"; // Sử dụng dấu nháy đơn để tránh lỗi SQL Injection

    // Thực hiện truy vấn và kiểm tra kết quả
    if ($connect->query($query) === TRUE) {
        $connect->close();
        header("location:../../Pages/list_product.php?notifi=Sửa thành công");
        exit();
    } else {
        $error = "Lỗi không sửa được sản phẩm: " . $connect->error;
        header("location:../Includes/BE/edit_product.php?datakey=$ma&error=" . urlencode($error));
        exit();
    }
} else {
    $error = "Chưa nhập toàn bộ thông tin";
    header("location:../Includes/BE/edit_product.php?datakey=" . $_POST['product_id'] . "&error=" . urlencode($error));
    exit();
}
?>