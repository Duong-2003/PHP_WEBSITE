<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .content {
            padding: 20px;
        }

        h1 {
            color: tomato;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <?php
    include('./admin_website.php');
    include('../../connect_SQL/connect.php');
    ?>

    <script>
        var myDiv = document.getElementById("order");
        myDiv.classList.add("active");
    </script>

    <div class="container-fluid">
        <h1 class="text-center">Danh sách đơn hàng</h1>

        <div class="container">
            <div>
                <?= isset($_GET["notifi"]) ? htmlspecialchars($_GET["notifi"]) : '' ?>
            </div>
            <div>
                <?= isset($_GET["error"]) ? htmlspecialchars($_GET["error"]) : '' ?>
            </div>

            <table id="danhsach" class="table table-striped table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Mã sản phẩm</th>
                        <th>Người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Tiền thu</th>
                        <th>Số lượng sản phẩm</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "SELECT * FROM `order`"; // Kiểm tra lại tên bảng
                    $result = $connect->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $order_price_formatted = number_format($row['order_price'], 0, '.', ','); ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['order_id']) ?></td>
                                    <td><?= htmlspecialchars($row['product_id']) ?></td>
                                    <td><?= htmlspecialchars($row['user_id']) ?></td>
                                    <td><?= htmlspecialchars($row['timeorder']) ?></td>
                                    <td class="text-center <?= ($row['order_status'] == "Đã hủy") ? 'text-danger' : ''; ?>">
                                        <?= htmlspecialchars($row['order_status']) ?>
                                    </td>
                                    <td><?= $order_price_formatted ?> đ</td>
                                    <td><?= htmlspecialchars(string: $row['order_quantity']) ?></td>
                                 
                                    <td>
                                        <div class="d-flex justify-content-center">
                                          
                                            
                                            <?php if ($row['order_status'] != "Đã hủy"): ?>
                                                <a class="btn btn-danger btn-sm mx-1">Huỷ đơn</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>


                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo '<tr><td colspan="8" class="text-center">Không có đơn hàng nào.</td></tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">Lỗi: ' . htmlspecialchars($connect->error) . '</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#danhsach').DataTable();
        });
    </script>

    

</body>

</html>