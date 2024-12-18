

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm mới nhất</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
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
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #dc3545;
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
        }

        h2 {
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            color: #494949;
            margin-bottom: 20px;
        }

        ul.tabs {
            list-style: none;
            padding: 0;
            text-align: center;
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
        .btn-custom {
          background-color: #e56571; /* Màu đỏ */
            color: #fff; /* Màu chữ trắng */
            border: none; /* Không có đường viền */
            padding: 12px 20px; /* Padding cho nút */
            font-size: 16px; /* Kích thước chữ */
            border-radius: 8px; /* Bo tròn góc */
            transition: background-color 0.3s, transform 0.3s; /* Hiệu ứng chuyển màu và phóng to */
        }
        .btn-custom:hover {
          background-color: #dc3545; /* Màu đỏ */
            transform: scale(1.05); /* Phóng to nút khi hover */
            color: #fff; /* Màu chữ trắng */
        }


        @media (max-width: 768px) {
            .product-list {
                padding: 1rem;
            }

            .card {
                margin: 10px 0;
            }
        }
    </style>
</head>


<body>
    <div class="product-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Văn phòng phẩm cho bạn</h2>
                    <ul class="tabs tabs-title tab-desktop ajax clearfix">
                        <li class="tab-link has-content current">
                            <a href="../website/website.php"><span title="Tất cả sản phẩm">Tất cả sản phẩm</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-1">
                            <a href="../website/content_click.php?product_type_id=but"><span title="Bút">Bút</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-2">
                            <a href="../website/content_click.php?product_type_id=hop"><span title="Hộp">Hộp</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-3">
                            <a href="../website/content_click.php?product_type_id=biakep"><span title="Bìa kẹp">Bìa kẹp</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-4">
                            <a href="../website/content_click.php?product_type_id=maytinh"><span title="Máy tính">Máy tính</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-5">
                            <a href="../website/content_click.php?product_type_id=nhandan"><span title="Nhãn dán">Nhãn dán</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-6">
                            <a href="../website/content_click.php?product_type_id=sotay"><span title="Sổ tay">Sổ tay</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-7">
                            <a href="../website/content_click.php?product_type_id=vo"><span title="Vở">Vở</span></a>
                        </li>
                        <li class="tab-link" data-tab="tab-8">
                            <a href="../website/content_click.php?product_type_id=tui"><span title="Túi">Túi</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        include("../connect_SQL/connect.php"); // Kết nối cơ sở dữ liệu
        $valueCart = 8;

        // Câu truy vấn để lấy sản phẩm không có giảm giá
        $sql = "
            SELECT * 
            FROM product 
            WHERE product_id NOT IN (SELECT product_id FROM sale WHERE is_expired = 1) 
            LIMIT $valueCart
        ";

        $result = $connect->query($sql);
        $duongdanimg = '../Assets/img/sanpham/';

        $dataArray = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dataArray[] = $row;
            }
        }

        // Đóng kết nối
        $connect->close();
        ?>

        <div class="container text-center">
            <div class="row">
                <?php foreach ($dataArray as $data): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 py-2" id="font-card">
                        <a href="./product.php?product_id=<?= $data['product_id'] ?>">
                            <div class="card">
                                <img src="<?= $duongdanimg . $data['product_images'] ?>" class="card-img-top" alt="<?= $data['product_name'] ?>">
                                <div class="card-body">
                                    <p class="card-title">
                                        <strong><?= $data['product_name'] ?></strong>
                                    </p>
                                    <p class="card-text">
                                        <strong style="color:#f30;font-size:25px">
                                            <?= number_format($data['product_price'], 0, '.', ',') ?> <sup>đ</sup>
                                        </strong>
                                    </p>
                                    <div class="action-cart">
                                       <button class="cart-button btn-buy add_to_cart" title="Chi tiết sản phẩm">
                                       <i class="fas fa-shopping-circle"></i>Chi tiết sản phẩm
                                       </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="text-center">
        <a class="btn btn-custom" href="./list.php?page=1">Xem thêm</a>
        </div>
    </div>
</body>

</html>
