<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đơn Hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>

<body>

<?php
include('./admin_website.php');    
include('../../connect_SQL/connect.php');

$dataKey = $_GET['datakey'];
$sqlorder = "SELECT * FROM `order` WHERE order_id = ?";
$stmt = $connect->prepare($sqlorder);
$stmt->bind_param("s", $dataKey);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    echo ('<div class="alert alert-danger text-center">ERROR: Đơn hàng không tồn tại.</div>');
    exit();
}

$order = $result->fetch_assoc();
$stmt->close();
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Sửa Đơn Hàng</h2>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Mã sản phẩm</th>
                <th>Người đặt</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <th>Số lượng sản phẩm</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['product_id']) ?></td>
                <td><?= htmlspecialchars($order['user_id']) ?></td>
                <td><?= htmlspecialchars($order['timeorder']) ?></td>
                <td><?= htmlspecialchars($order['order_status']) ?></td>
                <td><?= number_format($order['order_price'], 0, '.', ',') ?> đ</td>
                <td><?= htmlspecialchars($order['order_quantity']) ?></td>
            </tr>
        </tbody>
    </table>

    <div>
        <div id="error-message" class="text-danger text-center mb-3" style="font-size: 20px;"></div>
        <div class="text-danger text-center" style="font-size: 20px;">
            <?= isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '' ?>
        </div>
        <form action="../Includes/BE/edit_order.php" method="post">
            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">

            <div class="mb-3">
                <label for="select_status" class="form-label">Trạng thái<span class="text-danger">*</span></label>
                <select name="order_status" id="select_status" class="form-select" onchange="showOtherInput(this.value)">
                    <?php
                    $optionorder = ['Chưa xác nhận', 'Đã xác nhận', 'Đang giao', 'Hoàn thành'];
                    foreach ($optionorder as $option) : ?>
                        <option value="<?= htmlspecialchars($option); ?>" <?= ($order['order_status'] == $option) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($option); ?>
                        </option>
                    <?php endforeach; ?>
                    <option value="Khác" <?= (!in_array($order['order_status'], $optionorder)) ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="order_price" class="form-label">Giá<span class="text-danger">*</span></label>
                <input value="<?= htmlspecialchars($order['order_price']) ?>" name="order_price" type="text" class="form-control" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="mb-3" id="Other_status" style="visibility: hidden;">
                <label for="status_input" class="form-label">Trạng thái Khác <span class="text-danger">*</span></label>
                <input value="<?= htmlspecialchars($order['order_status']) ?>" name="status_input" type="text" class="form-control" aria-describedby="inputGroup-sizing-default">
            </div>

            <button type="submit" name="submit" class="btn btn-dark">Sửa</button>
            <a href="../Pages/list_order.php" class="btn btn-secondary">Quay Về</a>
        </form>
    </div>
</div>

<script>
    function showOtherInput(selectedValue) {
        var additionalInput = document.getElementById('Other_status');
        additionalInput.style.visibility = (selectedValue === 'Khác') ? 'visible' : 'hidden';
    }

    window.onload = function() {
        var selectElement = document.getElementById('select_status');
        showOtherInput(selectElement.value);
    };

    const form = document.querySelector("form");
    const errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", function(event) {
        const productNewPrice = document.querySelector('input[name="order_price"]').value;
        const productNewOtherStatus = document.querySelector('input[name="status_input"]').value;

        if (productNewPrice.trim() === "" || (document.getElementById('Other_status').style.visibility === 'visible' && productNewOtherStatus.trim() === "")) {
            errorMessage.textContent = "Vui lòng nhập đầy đủ thông tin.";
            event.preventDefault();
        }
    });

    form.addEventListener("input", function() {
        errorMessage.textContent = "";
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>