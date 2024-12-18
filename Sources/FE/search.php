<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm theo loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .content a {
            text-decoration: none;
        }

        .card {
            box-shadow: 0 0 5px 0px;
            color: #999;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: calc(133vh - 0px);
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 20px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                border: none;
                position: relative;
                height: auto;
            }
        }

        .cart-button.btn-buy {
            width: 150px;
            background: #DC2028;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            border: none; /* Sửa đổi border */
            border-radius: 5px; /* Bo góc cho nút */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu khi hover */
        }

        .cart-button.btn-buy:hover {
            background: #c52024; /* Màu nền khi hover */
        }

        .list-group-item {
            flex: 1; /* Đảm bảo các mục trong danh sách có chiều cao đồng đều */
        }
    </style>
</head>

<body>

    <div class="container">
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

                                // Xử lý tìm kiếm
                                $search = $_GET['search'] ?? '';
                                if (!empty($search)) {
                                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "(LOWER(sp.product_name) LIKE LOWER('%" . $connect->real_escape_string($search) . "%'))";
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
</body>

</html>