<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sửa Giảm Giá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.cloudflare.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php
      
      include('../../connect_SQL/connect.php');
      

    // Kiểm tra xem sale_id có được truyền vào không
    if (isset($_GET['datakey'])) {
        $sale_id = $_GET['datakey'];

        // Lấy thông tin giảm giá từ cơ sở dữ liệu
        $sql = "SELECT * FROM sale WHERE sale_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $sale = $result->fetch_assoc();

        if (!$sale) {
            echo "<div class='alert alert-danger'>Không tìm thấy giảm giá.</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>Không có mã giảm giá nào được cung cấp.</div>";
        exit;
    }
    ?>

    <div class="container">
        <h1 class="text-center mb-4">Sửa Giảm Giá</h1>
        <form action="../Includes/BE/edit_sale.php" method="POST">
            <input type="hidden" name="sale_id" value="<?php echo htmlspecialchars($sale['sale_id']); ?>">

            <div class="mb-3">
                <label for="product_id" class="form-label">Mã Sản Phẩm <span class="text-danger">*</span></label>
                <input type="text" name="product_id" class="form-control" value="<?php echo htmlspecialchars($sale['product_id']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="discount_percent" class="form-label">Phần Trăm Giảm Giá (%) <span class="text-danger">*</span></label>
                <input type="number" name="discount_percent" class="form-control" value="<?php echo htmlspecialchars($sale['discount_percent']); ?>" required min="0" max="100">
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Ngày Bắt Đầu <span class="text-danger">*</span></label>
                <input type="date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($sale['start_date']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Ngày Kết Thúc <span class="text-danger">*</span></label>
                <input type="date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($sale['end_date']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="sale_description" class="form-label">Mô Tả</label>
                <textarea name="sale_description" class="form-control"><?php echo htmlspecialchars($sale['sale_description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="is_expired" class="form-label">Hết Hạn</label>
                <select name="is_expired" class="form-select">
                    <option value="0" <?php echo $sale['is_expired'] ? '' : 'selected'; ?>>Không</option>
                    <option value="1" <?php echo $sale['is_expired'] ? 'selected' : ''; ?>>Có</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật Giảm Giá</button>
            <a href="your_redirect_page.php" class="btn btn-secondary">Hủy</a>
            <a href="../Pages/list_user.php" class="btn btn-secondary">Quay Về</a>
        </form>
    </div>

</body>

</html>