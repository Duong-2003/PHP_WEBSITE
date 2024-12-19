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
        .icon-cart {
            position: fixed;
            bottom: 745px;
            right: 40px;
            z-index: 9999;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border-radius: 50%;
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
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            height: 100%;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 100000000;
            width: 30%;
            overflow: scroll;
            transition: right 0.3s ease;
        }

        .cart-modal.show {
            display: block;
            right: 0;
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
            }

            .icon-cart {
                width: 50px;
                height: 50px;
            }

            .icon-cart .woofc-count-number {
                font-size: 10px;
            }
        }

        @media (max-width: 480px) {
            .close { font-size: 24px; }
            button { padding: 8px 10px; }
        }

        .pagination .page-item.active .page-link {
            color: #fff;
        }
        button#btnModal {
            margin-left: 10px;
            background-color: #9c8350;
            color: #fff;
            border-color: #9c8350;
        }
        .modal-header {
            background-color: #9c8350;
            color: white;
        }
    </style>
</head>

<body>
    <div class="icon-cart" onclick="toggleModal()">
        <a href="#" aria-label="Giỏ hàng" title="Giỏ hàng" class="SendEvent">
            <i class="fa fa-shopping-cart fa-lg" style="color: black;"></i>
        </a>
        <span id="woofc-count-number" class="woofc-count-number">0</span>
    </div>

    <div id="cart-modal" class="cart-modal">
        <div class="modal-content">
            <span class="close" onclick="toggleModal()">&times;</span>
            <h3>Sản phẩm đã thêm</h3>
            <ul id="product-list" class="list-group">
                <?php
                $name = $_SESSION['username'] ?? null;
                $list_order = [];
                $stmt = $connect->prepare("SELECT * FROM `order` WHERE user_id = (SELECT user_id FROM user WHERE username = ?)");
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $list_order[] = $row;
                }

                $cartValueShow = 5; 
                $pagination = ceil(count($list_order) / $cartValueShow);
                $page = max(1, min($pagination, (int) ($_GET['page'] ?? 1)));
                $firstPage = ($page - 1) * $cartValueShow;
                $endPage = min($firstPage + $cartValueShow, count($list_order));
                $duongdanimg = '../Assets/img/sanpham/';

                if (!empty($list_order)):
                    for ($i = $firstPage; $i < $endPage; $i++):
                        $order = $list_order[$i];
                        $stmt = $connect->prepare("SELECT * FROM product WHERE product_id = ?");
                        $stmt->bind_param("i", $order['product_id']);
                        $stmt->execute();
                        $product = $stmt->get_result()->fetch_assoc();
                        ?>
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="<?= $duongdanimg . htmlspecialchars($product['product_images']) ?>" class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="./product.php?product_id=<?= $product['product_id'] ?>" class="text-decoration-none"><?= htmlspecialchars($product['product_name']) ?></a>
                                            </h5>
                                            <p class="card-text">Mã đơn hàng: <strong><?= htmlspecialchars($order['order_id']) ?></strong></p>
                                            <p class="card-text">Số lượng: <strong><?= htmlspecialchars($order['order_quantity']) ?></strong></p>
                                            <p class="card-text">Giá: <strong><?= number_format($order['order_price'], 0, '.', ',') ?><sub>đ</sub></strong></p>
                                            <p class="card-text <?= ($order['order_status'] == 'Đã hủy') ? 'text-danger' : ''; ?>">
                                                Trạng thái: <?= htmlspecialchars($order['order_status']) ?>
                                            </p>
                                            <p class="card-text"><small class="text-muted">Ngày đặt: <?= htmlspecialchars($order['timeorder']) ?></small></p>
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <?php if ($order['order_status'] != "Đã hủy"): ?>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?= $order['order_id'] ?>">Hủy</button>
                                                <?php endif; ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                <?php else: ?>
                    <div class="col-12 text-center">Không có đơn hàng nào trong giỏ.</div>
                <?php endif; ?>
            </ul>

            <div class="text-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">&laquo;</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $pagination; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $pagination): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

            <div class="text-center">
                       
                            <button type="button" class="btn btn-lg   btn btn-primary">Thêm vào giỏ hàng</button>

                            <button id="btnModal" type="button" class="btn btn-lg btn-gray  " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-cart-shopping"></i>Mua ngay
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
                        <div class="modal-body">Bạn có chắc chắn muốn thanh toán cho các đơn hàng trong giỏ?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <form action="./pay.php" method="post">
                                <button type="submit" class="btn btn-success" name="submit">Xác nhận thanh toán</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateCartCount(count) {
            document.getElementById('woofc-count-number').textContent = count;
        }

        function toggleModal() {
            const modal = document.getElementById('cart-modal');
            modal.classList.toggle('show');
            modal.style.display = modal.classList.contains('show') ? 'block' : 'none';
        }

        $(document).ready(function() {
            let itemCount = <?= count($list_order) ?>;
            updateCartCount(itemCount);
        });
    </script>
    
</body>
</html>