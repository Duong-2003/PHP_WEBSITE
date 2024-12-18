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
        body {
            background-color: #f8f9fa;
        }

        .section_flash_sale {
            margin-bottom: 60px;
        }

        .block-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .block-product {
            padding: 20px;
            background: #fff;
        }

        .flash-sale-swiper {
            overflow: hidden;
        }

        .swiper-slide {
            flex: 0 0 auto;
            width: 24%;
            margin-right: 1%;
            transition: transform 0.3s;
        }

        .swiper-slide:last-child {
            margin-right: 0;
        }

        .product-block-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .product-block-item:hover {
            transform: scale(1.03);
        }

        .product-info .item-product-name {
            color: #000;
            font-size: 1.1rem;
            margin: 5px 0;
        }

        .product__price .old-price {
            text-decoration: line-through;
            color: #888;
        }

        .cart-button {
            background: #DC2028;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .cart-button:hover {
            background: #c02028;
        }

        .product-block-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .pagination .page-link {
            color: #007bff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .swiper-slide {
                width: 45%;
            }
        }

        @media (max-width: 480px) {
            .swiper-slide {
                width: 90%;
                margin-right: 0;
            }
        }

        .home-title {
            position: relative;
            margin-top: 20px;
        }

        .home-title a {
            text-align: left;
            font-size: 24px;
            text-transform: uppercase;
            position: relative;
            font-weight: bold;
            color: #5B5B5E;
            padding: initial;
            background: #fff;
            z-index: 9;
            padding-right: 10px;
        }

        .home-title:after {
            display: block;
            width: 100%;
            height: 1px;
            margin: auto;
            background: #000;
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <section class="section_flash_sale">
        <div class="container">
            <div class="home-title">
                <a href="" title="Sản phẩm liên quan">
                    Sản phẩm liên quan
                </a>
            </div>

            <div class="block-product">
                <div class="flash-sale-swiper swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                      include("../connect_SQL/connect.php"); // Kết nối cơ sở dữ liệu

                        $valueCart = 4; // Số sản phẩm trên mỗi trang
                        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Trang hiện tại
                        $offset = ($page - 1) * $valueCart; // Tính toán offset
                        
                        // Lọc sản phẩm không hết hạn
                        $totalSql = "SELECT COUNT(*) as total FROM product sp JOIN sale s ON sp.product_id = s.product_id WHERE s.is_expired = 0";
                        $totalResult = $connect->query($totalSql);
                        $totalRow = $totalResult->fetch_assoc();
                        $totalProducts = $totalRow['total'];
                        $totalPages = ceil($totalProducts / $valueCart); // Tính tổng số trang
                        
                        // Truy vấn sản phẩm với offset
                        $sql = "SELECT sp.*, s.discount_percent FROM product sp JOIN sale s ON sp.product_id = s.product_id WHERE s.is_expired = 1 ORDER BY RAND() LIMIT $valueCart";
                        $result = $connect->query($sql);
                        $duongdanimg = '../Assets/img/sanpham/';
                        
                        if ($result->num_rows > 0) {
                            while ($data = $result->fetch_assoc()) {
                                ?>
                                <div class="swiper-slide product-block-item">
                                    <a href="./product.php?product_id=<?= $data['product_id']; ?>">
                                        <img src="<?= $duongdanimg . $data['product_images']; ?>" alt="<?= $data['product_name']; ?>">
                                        <div class="product-info">
                                            <p class="item-product-name"><strong><?= $data['product_name']; ?></strong></p>
                                            <p class="product_price"><strong style="color:#f30; font-size:20px"><?= number_format($data['product_price'], 0, '.', '.'); ?> <sup>đ</sup></strong></p>
                                        </div>
                                        <button class="cart-button btn-buy add_to_cart" title="Chi tiết sản phẩm">Chi tiết sản phẩm</button>
                                    </a>
                                </div>
                                <?php
                            }
                        }

                        // Phân trang
                        if ($totalPages > 1) {
                            ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        $active = $i === $page ? 'active' : '';
                                        ?>
                                        <li class="page-item <?= $active; ?>"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>