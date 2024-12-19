<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm theo loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>   body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif; /* Thay đổi phông chữ mặc định */
            color: #333; /* Màu chữ mặc định */
        }

        .content a {
            text-decoration: none;
        }

        .card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            border-radius: 15px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: calc(133vh -0px);
            padding: 20px;
            border-radius: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h5 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.25rem; /* Kích thước phông chữ */
        }

        .sidebar a {
            color: #333;
            font-size: 1rem; /* Kích thước phông chữ cho danh mục */
        }

      button.cart-button.btn-buy  {
            width: 100%;
            background: #DC2028;
            height: 35px;
            /* border-radius: 30px; */
            color: #fff;
            font-size: 14px;
            border: none;
           
            margin-top: 10px;
        }

      button.cart-button.btn-buy :hover {
            background: #c81d24;
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

        .list-group-item {
            flex: 1;
        }

        .card-title {
            font-size: 1.1rem; /* Kích thước phông chữ cho tên sản phẩm */
        }

        .card-text {
            font-size: 1rem; /* Kích thước phông chữ cho giá sản phẩm */
        }
        a#buy {
    color: #fff;
}
    </style>
</head>

<?php 
session_start();



include('../sources/FE/top_header.php');
include('../sources/FE/header.php');

include('../Sources/FE/iconnofi.php');
include('../sources/FE/nav.php');
include('../Sources/FE/cart_count.php');
?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 sidebar">
                <h5 class="text-center">Danh mục sản phẩm</h5>
                <ul class="list-group">
                    
                <a href="../website/list.php">
                        <li class="list-group-item">Tất cả sản phẩm</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=but">
                        <li class="list-group-item">Bút</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=hop">
                        <li class="list-group-item">Hộp</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=biakep">
                        <li class="list-group-item">Bìa kẹp</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=maytinh">
                        <li class="list-group-item">Máy tính</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=nhandan">
                        <li class="list-group-item">Nhãn dán</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=sotay">
                        <li class="list-group-item">Sổ tay</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=vo">
                        <li class="list-group-item">Vở</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Túi</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Dao rọc giấy</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Hoá đơn</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Bấm kim</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Bìa hồ sơ</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Bút kí</li>
                    </a>
                    <a href="../website/products_click.php?product_type_id=tui">
                        <li class="list-group-item">Băng keo</li>
                    </a>
                    <li class="list-group-item"><a href="?discount=true">Sản phẩm giảm giá</a></li>
                    
                  
                   
                </ul>
                <hr>
                <h5 class="text-center">Sắp xếp theo giá</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="?sort=price-asc&$product_type_id=<?= $_GET['$product_type_id'] ?? '' ?>">Giá thấp đến cao</a></li>
                    <li class="list-group-item"><a href="?sort=price-desc&$product_type_id=<?= $_GET['$product_type_id'] ?? '' ?>">Giá cao xuống thấp</a></li>
                </ul>
                <hr>
                <img src="../Assets/img/index/img_aside_banner.webp" alt="" class="img-fluid">
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="product-list mb-3 p-2">
                    <div class="container">
                        <div class="row">
                            <hr style="color: #ad850c">
                            <div class="text-center py-2">
                                <div class="row">
                                <?php
                                    include('../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu

                                    $valueCart = 9; // Số sản phẩm trên mỗi trang
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
                                    $offset = ($page - 1) * $valueCart; // Tính toán offset

                                    // Lấy loại sản phẩm từ URL
                                    $product_type_id = $_GET['product_type_id'] ?? ''; // Sử dụng đúng tên biến
                                    $whereClause = !empty($product_type_id) ? "WHERE sp.product_type_id = '$product_type_id'" : "";

                                    // Kiểm tra nếu lọc theo sản phẩm giảm giá
                                    if (isset($_GET['discount']) && $_GET['discount'] == 'true') {
                                        $whereClause .= ($whereClause ? " AND " : "WHERE ") . "s.discount_percent > 0";
                                    }

                                    // Sắp xếp
                                    $sort = $_GET['sort'] ?? 'normal';
                                    $orderBy = '';
                                    if ($sort == 'price-asc') {
                                        $orderBy = 'ORDER BY sp.product_price ASC';
                                    } elseif ($sort == 'price-desc') {
                                        $orderBy = 'ORDER BY sp.product_price DESC';
                                    }

                                    // Truy vấn sản phẩm theo loại
                                    $sql = "SELECT sp.*, s.discount_percent 
                                            FROM product sp 
                                            LEFT JOIN sale s ON sp.product_id = s.product_id AND s.is_expired = 1 
                                            $whereClause 
                                            $orderBy 
                                            LIMIT $offset, $valueCart"; // Thêm LIMIT để phân trang
                                    
                                    $result = $connect->query($sql);

                                    $duongdanimg = '../Assets/img/sanpham/'; // Đảm bảo đường dẫn này là chính xác

                                    if ($result && $result->num_rows > 0) {
                                        while ($data = $result->fetch_assoc()) {
                                            ?>
                                            <div class="col-lg-4 col-md-6 col-sm-9 py-2">
                                                <a href="./product.php?product_id=<?= $data['product_id'] ?>">
                                                    <div class="card">
                                                        <img src="<?= $duongdanimg . $data['product_images'] ?>" class="card-img-top" alt="<?= $data['product_name'] ?>">
                                                        <div class="card-body">
                                                            <p class="card-title"><strong><?= $data['product_name'] ?></strong></p>
                                                            <?php if (!empty($data['discount_percent'])): 
                                                                $discountedPrice = $data['product_price'] * (1 - $data['discount_percent'] / 100); ?>
                                                                <p class="card-text">
                                                                    <strong style="color:#f30; font-size:25px"><?= number_format($discountedPrice, 0, '.', '.') ?> <sup>đ</sup></strong>
                                                                    <span style="text-decoration: line-through; color: #888;"><?= number_format($data['product_price'], 0, '.', '.') ?> <sup>đ</sup></span>
                                                                </p>
                                                            <?php else: ?>
                                                                <p class="card-text">
                                                                    <strong style="color:#f30; font-size:25px"><?= number_format($data['product_price'], 0, '.', '.') ?> <sup>đ</sup></strong>
                                                                </p>
                                                            <?php endif; ?>
                                                            <div class="action-cart d-flex align-items-center justify-content-center">
                                                                <a class="cart-button btn-buy" href="./product.php?product_id=<?= $data['product_id'] ?>">Chi tiết sản phẩm</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo '<p class="text-center">Không có sản phẩm nào</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    include('../sources/FE/product_generation.php');
    include('../sources/FE/footer_save.php');
    include('../sources/FE/footer.php');
    ?>
</body>

</html>