<?php
include('../connect_SQL/connect.php'); // Kết nối cơ sở dữ liệu

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bình luận sản phẩm</title>
    <style>
        .comment { margin-bottom: 15px; }
        .comment-author { font-weight: bold; }
        .comment-text { margin-left: 50px; }
    </style>
</head>

<body>
    <section class="section_flash_sale">
        <div class="container">
            <div class="home-title">
                <a href="#" title="Bình luận đánh giá sản phẩm">Bình luận đánh giá sản phẩm</a>
            </div>

            <form action="../Sources/BE/comments_process.php" method="POST" class="mt-3">
                <input type="hidden" name="product_id" value="1"> <!-- Mã sản phẩm -->
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
                <?php
                // Lấy các bình luận
                $product_id = 1; // Thay đổi giá trị này theo mã sản phẩm
                $sql = "SELECT * FROM comments WHERE product_id = ? ORDER BY created_at DESC";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="comment">';
                    echo '<div class="comment-author">';
                    echo '<img src="' . htmlspecialchars($row['avatar']) . '" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%;">';
                    echo htmlspecialchars($row['name']) . '</div>';
                    echo '<div class="comment-text">' . nl2br(htmlspecialchars($row['comment'])) . '</div>'; // Dùng nl2br để chuyển đổi dòng mới
                    echo '</div>';
                }

                
                ?>
            </div>
        </div>
    </section>
</body>

</html>