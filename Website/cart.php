<?php
session_start();
ob_start();
include('../Sources/FE/top_header.php');
include('../Sources/FE/header.php');

// Notification message
if (isset($_GET['notifi'])) {
    $notifi = urldecode($_GET['notifi']);
    echo '<div class="container notification alert alert-success" role="alert">' . $notifi . '</div>';
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    $error = "Vui lòng đăng nhập để vào giỏ hàng";
    echo "<script>window.location.href = './login.php?error=" . urlencode($error) . "';</script>";
    exit();
}

$name = $_SESSION['username'];

// Khởi tạo biến $list_order như một mảng rỗng
$list_order = [];

// Use prepared statements to get orders
$stmt = $connect->prepare("SELECT * FROM `order` WHERE user_id = (SELECT user_id FROM user WHERE username = ?)");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu có đơn hàng nào
if ($result->num_rows === 0) {
    echo '<div class="alert alert-warning">Không tìm thấy đơn hàng nào.</div>';
} else {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $list_order[] = $row;
    }
}

$stmt->close();
ob_end_flush();

// Pagination settings
$cartValueShow = 10; // Number of products displayed per page
$pagination = ceil(count($list_order) / $cartValueShow);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($pagination, $page)); // Limit valid page range

// Calculate indices for pagination
$firstPage = ($page - 1) * $cartValueShow;
$endPage = min($firstPage + $cartValueShow, count($list_order));
?>
<div class="container">
    <hr style="color:red">
    <h1 class="text-center" style="color:red;">Giỏ hàng</h1>
    <hr style="color:red">

    <div class="row">
        <?php if (!empty($list_order)) : ?>
            <?php for ($i = $firstPage; $i < $endPage; $i++) : ?>
                <?php
                $order = $list_order[$i];

                // Fetch product details based on product ID from order
                $stmt = $connect->prepare("SELECT * FROM product WHERE product_id = ?");
                $stmt->bind_param("i", $order['product_id']);
                $stmt->execute();
                $product_result = $stmt->get_result();
                $product = $product_result->fetch_assoc();
                $stmt->close();
                $duongdanimg = '../Assets/img/sanpham/';
                if ($product):
                ?>
                
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <img src="<?= $duongdanimg . htmlspecialchars($product['product_images']) ?>" width="100%" height="100%" class="img-fluid rounded product-image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="./product.php?product_id=<?= $product['product_id'] ?>" class="text-decoration-none"><?= htmlspecialchars($product['product_name']) ?></a>
                                        </h5>
                                        <p class="card-text">Mã đơn hàng: <strong><?= htmlspecialchars($order['order_id']) ?></strong></p>
                                        <p class="card-text">Số lượng: <strong><?= htmlspecialchars($order['order_quantity']) ?></strong></p>
                                        <p class="card-text">Giá: <strong><?= number_format($order['order_price'], 0, '.', ',') ?> <sub>đ</sub></strong></p>
                                        <p class="card-text <?= ($order['order_status'] == 'Đã hủy') ? 'text-danger' : ''; ?>">
                                            Trạng thái: <?= htmlspecialchars($order['order_status']) ?>
                                        </p>
                                        <p class="card-text"><small class="text-muted">Ngày đặt: <?= htmlspecialchars($order['timeorder']) ?></small></p>

                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <?php if ($order['order_status'] != "Đã hủy") : ?>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?= $order['order_id'] ?>">Hủy</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-12 text-center">Không tìm thấy sản phẩm cho đơn hàng này.</div>
                <?php endif; ?>
            <?php endfor; ?>
        <?php else : ?>
            <div class="col-12 text-center">Không có đơn hàng nào trong giỏ.</div>
        <?php endif; ?>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
            Thanh toán đơn hàng
        </button>
    </div>

    <!-- Modal Thanh Toán -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel">Xác nhận thanh toán</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn thanh toán cho các đơn hàng trong giỏ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form action="./pay.php" method="post">
                        <button type="submit" class="btn btn-success" name="submit">Xác nhận thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

     <div class="text-center mt-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?category=<?= $category ?>&page=<?= $page - 1 ?>&sort=<?= $sort ?>&discount=<?= isset($_GET['discount']) ? $_GET['discount'] : 'false' ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $pagination; $i++): ?>
                                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?category=<?= $category ?>&page=<?= $i ?>&sort=<?= $sort ?>&discount=<?= isset($_GET['discount']) ? $_GET['discount'] : 'false' ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($page < $pagination): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?category=<?= $category ?>&page=<?= $page + 1 ?>&sort=<?= $sort ?>&discount=<?= isset($_GET['discount']) ? $_GET['discount'] : 'false' ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
</div>
</body>
</html>