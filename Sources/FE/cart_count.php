<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <title>Trang Sản Phẩm Khuyến Mãi</title>
    <style>


        /* // */
        .icon-cart {
            position: fixed;
            bottom: 745px;
            /* Điều chỉnh vị trí như bạn muốn */
            right: 40px;
            /* Điều chỉnh vị trí như bạn muốn */
            z-index: 9999;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border-radius: 50%;
            /* Để biểu tượng thành hình tròn */
            box-shadow: rgba(0, 0, 0, 0.15) 0px 4px 12px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .icon-cart:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .icon-cart .woofc-count-number {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .cart-modal {
            display: none;
            /* Ẩn modal mặc định */
            position: fixed;

            top: 50%;
            right: 0;
            transform: translateY(-50%);
            height: 100%;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 10000000000;
            width: 30%;
            overflow: scroll;
            transition: right 0.3s ease;
            /* Hiệu ứng chuyển động */
        }

        .cart-modal.show {
            display: block;
            /* Hiển thị modal */
            right: 0;
            /* Đẩy modal vào trong màn hình */
        }

        .modal-content {
            padding: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .list-group {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .list-group-item {
            padding: 8px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }

        button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .cart-modal {
                width: 100%;
                /* Modal chiếm toàn bộ chiều rộng trên màn hình nhỏ */
                max-width: none;
                /* Bỏ giới hạn chiều rộng tối đa */
            }

            .icon-cart {
                width: 50px;
                /* Kích thước nhỏ hơn cho biểu tượng giỏ hàng */
                height: 50px;
                /* Kích thước nhỏ hơn cho biểu tượng giỏ hàng */
            }

            .icon-cart .woofc-count-number {
                font-size: 10px;
                /* Kích thước chữ nhỏ hơn cho số lượng */
            }
        }

        @media (max-width: 480px) {
            .close {
                font-size: 24px;
                /* Kích thước chữ nhỏ hơn cho biểu tượng đóng */
            }

            button {
                padding: 8px 10px;
                /* Kích thước nút nhỏ hơn */
            }
        }
        .pagination .page-item.active .page-link {
    /* background-color: #007bff;
    border-color: #007bff; */
    color: #fff;
    margin:20px
}
    </style>
</head>
<?php
// Khởi tạo biến $list_order như một mảng rỗng
$list_order = [];

// Use prepared statements to get orders
$stmt = $connect->prepare("SELECT * FROM `order` WHERE user_id = (SELECT user_id FROM user WHERE username = ?)");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra nếu có đơn hàng nào
if ($result->num_rows === 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $list_order[] = $row;
    }
}


?>



<body>


    <!-- Biểu tượng giỏ hàng -->
    <div class="icon-cart" onclick="toggleModal()">
        <a href="#" aria-label="Giỏ hàng" title="Giỏ hàng" class="SendEvent" data-category="action" data-action="click"
            data-label="cart_action">
            <i class="fa fa-shopping-cart fa-lg" style="color: black;"></i>
        </a>
        <span id="woofc-count-number" class="woofc-count-number">0</span>
    </div>

    <!-- Modal Nội Dung -->
    <div id="cart-modal" class="cart-modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="toggleModal()">&times;</span>
            <h3>Sản phẩm đã thêm</h3>
            <ul id="product-list" class="list-group">
                <!-- Sản phẩm sẽ được thêm vào đây -->
                <?php


                $name = isset($_SESSION['username']) ? $_SESSION['username'] : null;

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



                // Pagination settings
                $cartValueShow = 5; // Number of products displayed per page
                $pagination = ceil(count($list_order) / $cartValueShow);
                $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                $page = max(1, min($pagination, $page)); // Limit valid page range
                
                // Calculate indices for pagination
                $firstPage = ($page - 1) * $cartValueShow;
                $endPage = min($firstPage + $cartValueShow, count($list_order));
                ?>
                <div class="container">


                    <div class="row">
                        <?php if (!empty($list_order)): ?>
                            <?php for ($i = $firstPage; $i < $endPage; $i++): ?>
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

                                    <div class="col-md-12 ">
                                        <div class="card shadow-sm">
                                            <div class="row g-0">
                                                <div class="col-md-3">
                                                    <img src="<?= $duongdanimg . htmlspecialchars($product['product_images']) ?>"
                                                        width="100%" height="100%" class="img-fluid rounded product-image">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <a href="./product.php?product_id=<?= $product['product_id'] ?>"
                                                                class="text-decoration-none"><?= htmlspecialchars($product['product_name']) ?></a>
                                                        </h5>
                                                        <p class="card-text">Mã đơn hàng:
                                                            <strong><?= htmlspecialchars($order['order_id']) ?></strong></p>
                                                        <p class="card-text">Số lượng:
                                                            <strong><?= htmlspecialchars($order['order_quantity']) ?></strong></p>
                                                        <p class="card-text">Giá:
                                                            <strong><?= number_format($order['order_price'], 0, '.', ',') ?>
                                                                <sub>đ</sub></strong></p>
                                                        <p
                                                            class="card-text <?= ($order['order_status'] == 'Đã hủy') ? 'text-danger' : ''; ?>">
                                                            Trạng thái: <?= htmlspecialchars($order['order_status']) ?>
                                                        </p>
                                                        <p class="card-text"><small class="text-muted">Ngày đặt:
                                                                <?= htmlspecialchars($order['timeorder']) ?></small></p>

                                                        <div class="d-grid gap-2 col-6 mx-auto">
                                                            <?php if ($order['order_status'] != "Đã hủy"): ?>
                                                                
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#modal<?= $order['order_id'] ?>">Hủy</button>
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
                        <?php else: ?>
                            <div class="col-12 text-center">Không có đơn hàng nào trong giỏ.</div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="text-center ">
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

                            
                    <div class="text-center">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#paymentModal">
                            Thanh toán đơn hàng
                        </button>
                        <a href="../Website/cart.php"> <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                        Giỏ hàng
                    </button></a>
                    </div>



                    <!-- Modal Thanh Toán -->
                    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="paymentModalLabel">Xác nhận thanh toán</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn thanh toán cho các đơn hàng trong giỏ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <form action="./pay.php" method="post">
                                        <button type="submit" class="btn btn-success" name="submit">Xác nhận thanh
                                            toán</button>

                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                   



                </div>
</body>

</html>

</div>
</div>
<script>
    // Hàm để cập nhật số lượng trong giỏ hàng
    function updateCartCount(count) {
        document.getElementById('woofc-count-number').textContent = count;
    }

    function toggleModal() {
        const modal = document.getElementById('cart-modal');
        if (modal.classList.contains('show')) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none'; // Ẩn sau khi hiệu ứng hoàn tất
            }, 300); // Thời gian khớp với thời gian transition trong CSS
        } else {
            modal.style.display = 'block'; // Hiển thị modal
            setTimeout(() => {
                modal.classList.add('show'); // Thêm lớp show để kích hoạt hiệu ứng
            }, 10); // Thời gian delay nhỏ để đảm bảo hiệu ứng hoạt động
        }
    }

    function checkout() {
        alert("Đi đến trang thanh toán!");
    }

    // Gọi hàm này để cập nhật số lượng ban đầu
    $(document).ready(function() {
        let itemCount = <?= count($list_order) ?>; // Lấy số lượng sản phẩm từ đơn hàng
        updateCartCount(itemCount); // Cập nhật số lượng khi trang được tải
    });
</script>
<?php
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
?>