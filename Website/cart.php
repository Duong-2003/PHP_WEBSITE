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

// Initialize $list_order as an empty array
$list_order = [];

// Use prepared statements to get orders
$stmt = $connect->prepare("SELECT * FROM `order` WHERE user_id = (SELECT user_id FROM user WHERE username = ?)");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any orders
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
<style>
    .header-section {
        text-align: center;
        margin: 20px 0;
    }

    .header-section h1 {
        color: #ff4d4d; /* Bright red color */
        font-size: 2.5rem; /* Larger font size */
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
    }

    .header-section hr {
        border: 0;
        height: 3px; /* Thicker line */
        background-color: #ff4d4d; /* Matching color */
        width: 50%; /* Centered line width */
        margin: 10px auto; /* Centering the line */
    }
</style>

<div class="header-section">
    <hr>
    <h1>Giỏ hàng</h1>
    <hr>
</div>

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
                    <div class="col-md-4 mb-4"> <!-- Adjusted to 4 for three columns -->
                        <div class="card shadow-sm h-100">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <img src="<?= $duongdanimg . htmlspecialchars($product['product_images']) ?>" class="img-fluid rounded-top" alt="<?= htmlspecialchars($product['product_name']) ?>">
                                </div>
                                <div class="col-md-12">
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
                                                
                                                <!-- Modal for Cancel Confirmation -->
                                                <div class="modal fade" id="modal<?= $order['order_id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $order['order_id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel<?= $order['order_id'] ?>">Xác nhận hủy đơn hàng</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn hủy đơn hàng <strong><?= htmlspecialchars($order['order_id']) ?></strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                <form action="../Sources/BE/cancel_order.php" method="post">
                                                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                                                    <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $pagination): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
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