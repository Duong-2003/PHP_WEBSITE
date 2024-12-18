<?php

session_start();

include('../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm mới nhất</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            /* Light background for contrast */
            margin: 0;
            padding: 0;
        }

        .content a {
            text-decoration: none;
        }

        .product-list {
            margin: 3rem auto;
            padding: 2rem;
            max-width: 1200px;
            /* Center the content */
            background-color: #ffffff;
            /* White background for product list */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 8px;
            /* Rounded corners */
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            /* Ensure content doesn't overflow */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            /* Fixed height for uniformity */
            object-fit: cover;
            /* Maintain aspect ratio */
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            /* Darker text for better contrast */
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #dc3545;
            /* Bootstrap danger color for price */
            margin: 0;
        }

        button.cart-button.btn-buy.add_to_cart {
            width: 100%;
            background: #DC2028;
            height: 40px;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            /* border-radius: 25px; */
            color: #fff;
            font-size: 16px;
            border: none;
            transition: background 0.3s;
        }

        button.cart-button.btn-buy.add_to_cart:hover {
            background: #c81d24;
            /* Darker red on hover */
        }

        h2 {
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            color: #494949;
            position: relative;
            margin-bottom: 20px;
        }

        h2:after {
            content: "";
            background: url(//bizweb.dktcdn.net/100/434/558/themes/894884/assets/icon_after_title.png?1651395726340) no-repeat;
            width: 257px;
            height: 57px;
            display: block;
            margin: auto;
        }

        ul.tabs {
            list-style: none;
            padding: 0;
            text-align: center;
            /* Center tabs */
            margin-bottom: 20px;
        }

        ul.tabs li {
            display: inline-block;
            cursor: pointer;
            margin: 0 10px;
        }

        ul.tabs li span {
            background: transparent;
            padding: 10px 15px;
            border-radius: 50px;
            color: #000;
            font-size: 14px;
            transition: background 0.3s, color 0.3s;
        }

        ul.tabs li:hover span {
            background: #9C8350;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

     
        a.btn.btn-custom {
    background-color: #e56571;
    color: #fff;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 8px;
    transition: background-color 0.3s, transform 0.3s;
}
a.btn.btn-custom:hover {
          background-color: #dc3545; /* Màu đỏ */
            transform: scale(1.05); /* Phóng to nút khi hover */
            color: #fff; /* Màu chữ trắng */
        }


      

        @media (max-width: 768px) {
            .product-list {
                padding: 1rem;
                /* Reduce padding on smaller screens */
            }

            .card {
                margin: 10px 0;
                /* Reduce margin on smaller screens */
            }
        }
    </style>
</head>

<body>
    <?php

include('../Sources/FE/iconnofi.php');

    include('../Sources/FE/iconnofi.php');
    include('../Sources/FE/top_header.php');
    include('../Sources/FE/header.php');
    include('../Sources/FE/slide.php');
    include('../Sources/FE/sale.php');
    include('../Sources/FE/cart_count.php');



    // Định nghĩa đường dẫn hình ảnh
    $duongdanimg = '../Assets/img/sanpham/';

    // Lấy loại sản phẩm từ tham số URL
    $productType = isset($_GET['product_type_id']) ? $_GET['product_type_id'] : '';
    $valueCart = 6; // Số sản phẩm tối đa hiển thị
    $sql = "SELECT * 
    FROM product 
    LEFT JOIN sale ON product.product_id = sale.product_id 
    WHERE product_type_id = '$productType' 
    AND (sale.is_expired IS NULL OR sale.is_expired = 0) 
    LIMIT $valueCart";
    $result = $connect->query($sql);
    ?>

    <div class="product-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="block-title clearfix">
                        <h2>Văn phòng phẩm cho bạn</h2>
                        <ul class="tabs tabs-title tab-desktop ajax clearfix">
                            <li class="tab-link has-content current">
                                <a href="../website/website.php"><span title="Tất cả sản phẩm">Tất cả sản
                                        phẩm</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-1">
                                <a href="../website/content_click.php?product_type_id=but"><span
                                        title="Bút">Bút</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-2">
                                <a href="../website/content_click.php?product_type_id=hop"><span
                                        title="Hộp">Hộp</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-3">
                                <a href="../website/content_click.php?product_type_id=biakep"><span title="Bìa kẹp">Bìa
                                        kẹp</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-4">
                                <a href="../website/content_click.php?product_type_id=maytinh"><span
                                        title="Máy tính">Máy tính</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-5">
                                <a href="../website/content_click.php?product_type_id=nhandan"><span
                                        title="Nhãn dán">Nhãn dán</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-6">
                                <a href="../website/content_click.php?product_type_id=sotay"><span title="Sổ tay">Sổ
                                        tay</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-7">
                                <a href="../website/content_click.php?product_type_id=vo"><span title="Vở">Vở</span></a>
                            </li>
                            <li class="tab-link" data-tab="tab-8">
                                <a href="../website/content_click.php?product_type_id=tui"><span
                                        title="Túi">Túi</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <div class="row">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($data = $result->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 py-2">
                            <a href="./product.php?product_id=<?= $data['product_id'] ?>">
                                <div class="card">
                                    <img src="<?= $duongdanimg . $data['product_images'] ?>" class="card-img-top"
                                        alt="<?= $data['product_name'] ?>">
                                    <div class="card-body">
                                        <p class="card-title"><?= $data['product_name'] ?></p>
                                        <?php if (!empty($data['discount_percent'])):
                                            $discountedPrice = $data['product_price'] * (1 - $data['discount_percent'] / 100); ?>
                                            <p class="card-text">
                                                <strong
                                                    style="color:#f30; font-size:25px"><?= number_format($discountedPrice, 0, '.', '.') ?>
                                                    <sup>đ</sup></strong>
                                                <span
                                                    style="text-decoration: line-through; color: #888;"><?= number_format($data['product_price'], 0, '.', '.') ?>
                                                    <sup>đ</sup></span>
                                            </p>
                                        <?php else: ?>
                                            <p class="card-text">
                                                <strong
                                                    style="color:#f30; font-size:25px"><?= number_format($data['product_price'], 0, '.', '.') ?>
                                                    <sup>đ</sup></strong>
                                            </p>
                                        <?php endif; ?>
                                        <div class="action-cart">
                                            <button class="cart-button btn-buy add_to_cart" title="Chi tiết sản phẩm">Chi tiết sản phẩm</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">Không có sản phẩm nào</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="text-center">
        <a class="btn btn-custom" href="./list.php?page=1">Xem thêm</a>
        </div>
    </div>

    <?php
    // Đóng kết nối sau khi hoàn tất tất cả các thao tác
    $connect->close();
    include('../Sources/FE/footer_save.php');
    include('../Sources/FE/footer.php');
    ?>
</body>

</html>