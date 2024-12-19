<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Chỉ gọi nếu phiên chưa được khởi động
}
include('../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu

// Lấy mã sản phẩm từ URL
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Lấy mã sản phẩm từ URL
} else {
    echo "ERROR: Không nhận được mã sản phẩm.";
    exit();
}

// Lấy các bình luận
$sql = "SELECT * FROM comments WHERE product_id = ? ORDER BY created_at DESC";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bình luận sản phẩm</title>
    <style>
        .comment {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        .comment-author {
            font-weight: bold;
            margin-right: 10px;
        }
        .comment-text {
            margin-left: 50px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <section class="section_flash_sale">
        <div class="container">
        <div class="home-title">

<a href="#" title="Bình luận đánh giá sản phẩm">Bình luận đánh giá sản phẩm</a>

</div>

            <form action="../Sources/BE/comments_process.php" method="POST" class="mt-3">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"> <!-- Mã sản phẩm -->
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="comment" rows="3" placeholder="Bình luận của bạn" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>

            <div class="comment-section mt-4">
                <h3>Các Bình Luận:</h3>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="comment">
                            <div class="comment-author">
                                <img src="<?php echo htmlspecialchars($row['avatar']); ?>" alt="Avatar" class="avatar">
                                <?php echo htmlspecialchars($row['user_name']); ?>
                            </div>
                            <div class="comment-text"><?php echo nl2br(htmlspecialchars($row['comment'])); ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Chưa có bình luận nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>