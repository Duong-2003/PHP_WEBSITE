<?php
ob_start(); // Start output buffering
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username']; // Get the username from session

include('../Sources/FE/top_header.php');
include('../Sources/FE/header.php');
   include( '../Sources/FE/nav.php');
   include('../Sources/FE/cart_count.php');
include('../connect_SQL/connect.php'); // Connect to the database

// Check if product_id is set and valid
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $id = intval($_GET['product_id']);
    $sql = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $duongdanimg = '../Assets/img/sanpham/';
    $sp = $result->fetch_assoc();
    
    if (!$sp) {
        echo "ERROR: Không tìm thấy sản phẩm";
        exit();
    }
} else {
    echo "ERROR: Không nhận được ID";
    exit();
}

// Get user_id from the database
$sqlUser = "SELECT * FROM user WHERE username = ?";
$stmtUser = $connect->prepare($sqlUser);
$stmtUser->bind_param("s", $username);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

if (!$user) {
    echo "ERROR: Không tìm thấy người dùng.";
    exit();
}
$user_id = $user['user_id']; // Get the user_id for the order

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $soluong = intval($_POST['order_quantity']);
    $gia = $sp['product_price'] * $soluong;

    // Insert order into the database
    $sqlInsert = "INSERT INTO `order` (product_id, user_id, order_quantity, order_price, timeorder, order_status) 
                  VALUES (?, ?, ?, ?, NOW(), 'Đang chờ')";
    $stmtInsert = $connect->prepare($sqlInsert);
    $stmtInsert->bind_param("isii", $sp['product_id'], $user_id, $soluong, $gia);

    if ($stmtInsert->execute()) {
        $notifi = "Đặt hàng thành công!";
        header("Location: ./cart.php?product_id=$id&notifi=" . urlencode($notifi));
        exit();
    } else {
        $error = "Có lỗi xảy ra, vui lòng thử lại.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Chi tiết sản phẩm</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .notifi > p {
            font-size: 20px;
            text-align: center;
            font-weight: 600;
        }
        #item {
            display: inline-block;
            height: 40px;
            line-height: 40px;
            color: #000;
            background: #cdd5dd;
            padding: 0 20px;
            font-weight: bold;
            font-size: 16px;
            border-right: solid 1px #fff;
        }
        #item-head {
            font-family: 'Cursive';
            color: #cf5a51;
            font-size: 28px;
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
<?php 
    include('../Sources/FE/iconnofi.php');
?>
<body>
    <div class="notifi">
        <p class="text-primary"><?= isset($notifi) ? htmlspecialchars($notifi) : '' ?></p>
        <p class="text-danger"><?= isset($error) ? htmlspecialchars($error) : '' ?></p>
    </div>

    <form method="post" action="">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-6 col-md-6 rounded shadow-sm p-4" style="background: linear-gradient(135deg, #f8f9fa, #e2e6ea);">
                    <img src="<?= $duongdanimg . htmlspecialchars($sp['product_images']) ?>" class="img-fluid rounded product-image" alt="<?= htmlspecialchars($sp['product_name']) ?>">
                </div>
                <div class="col-lg-6 col-md-6 bg-light rounded shadow-sm p-4">
                    <h2 id="item-head"><?= htmlspecialchars($sp['product_name']) ?></h2>
                    <h4 class="text-secondary">Mã sản phẩm: <?= htmlspecialchars($sp['product_id']) ?></h4>
                    <strong class="text-danger" style="font-size: 25px;">
                        <?= number_format($sp['product_price'], 0, '.', ',') ?><sup>đ</sup>
                    </strong>
                    <hr>
                    <strong id="item">Tên loại sản phẩm: <?= htmlspecialchars($sp['product_type_name']) ?></strong>
                    <strong id="item">Số lượng còn lại: <?= $sp['product_quantity'] > 0 ? $sp['product_quantity'] : '<span class="text-danger">Hết hàng</span>' ?></strong>
                    <div class="input-group my-2">
                        <span class="input-group-text"><strong>Số lượng mua:</strong></span>
                        <input id='value_buy' name="order_quantity" type="number" max='<?= $sp['product_quantity'] ?>' min='1' value="1" class="form-control" required>
                    </div>
                    <strong id="item">Chi tiết: <?= htmlspecialchars($sp['product_details']) ?></strong>

                    <div class="text-center my-3" id='pay'>
                        <strong style="color:red">Giá: <?= number_format($sp['product_price'], 0, '.', ',') ?><sup>đ</sup></strong>
                    </div>

                    <script>
                        const inputElement = document.getElementById('value_buy');
                        const outputElement = document.getElementById('pay');
                        inputElement.addEventListener('input', function(event) {
                            const quantity = event.target.value;
                            const price = <?= $sp['product_price'] ?>;
                            const totalPrice = quantity * price;
                            outputElement.innerHTML = "<strong>Giá phải trả: </strong>" + totalPrice.toLocaleString('en-US') + "<sup>đ</sup>";
                        });
                    </script>

                    <div class="text-center">
                        <?php if ($sp['product_quantity'] > 0) : ?>
                            <button type="button" class="btn btn-lg  btn_buy btn btn-primary">Thêm vào giỏ hàng</button>

                            <button id="btnModal" type="button" class="btn btn-lg btn-gray btn_buy " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-cart-shopping"></i>Mua ngay
                            </button>
                            
                          
                        <?php endif; ?>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modal-content">Bạn có chắc chắn mua?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        const contentModal = document.getElementById('modal-content');
                        document.getElementById('btnModal').addEventListener("click", function() {
                            const productName = "<?= htmlspecialchars($sp['product_name']) ?>";
                            const totalPrice = document.getElementById('value_buy').value * <?= $sp['product_price'] ?>;
                            contentModal.innerHTML = `Bạn có chắc chắn mua ${productName}<br>Giá: ${totalPrice.toLocaleString('en-US')} <sup>đ</sup>`;
                        });
                    </script>
                    
                </div>
            </div>
        </div>
    </form>

    <?php
    
    include('../Website/comments.php');
    include('../Sources/FE/product_generation.php');
    include('../Sources/FE/footer_save.php'); 
    include('../Sources/FE/footer.php'); 
    ?>
</body>
</html>