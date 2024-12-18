<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: tomato;
        }
        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }
        p#notifi_log {
            font-weight: 900;
            font-size: 20px;
            text-align: center;
        }
        img {
            max-height: 100px;
            width: auto;
        }
        .table {
            margin-top: 20px;
        }
        .btn-success {
            margin-bottom: 10px;
        }
        .modal-header {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body>

    <?php
include('./admin_website.php');    
include('../../connect_SQL/connect.php');


    // Lấy danh sách loại sản phẩm
    $sqlLSP = "SELECT * FROM product";
    $resultLSP = $connect->query($sqlLSP);
    $danhsachLSP = [];
    while ($row = mysqli_fetch_array($resultLSP, MYSQLI_ASSOC)) {
        $danhsachLSP[] = array(
            'product_type_name' => $row['product_type_name'],
            'product_type_id' => $row['product_type_id'],
        );
    }

    // Lấy danh sách sản phẩm
    $sqlSP = "SELECT * FROM product";
    $resultSP = $connect->query($sqlSP);
    $danhsachSP = [];
    while ($row = mysqli_fetch_array($resultSP, MYSQLI_ASSOC)) {
        $danhsachSP[] = array(
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'product_type_name' => $row['product_type_name'],
            'product_type_id' => $row['product_type_id'],
           
            'product_price' => $row['product_price'],
            'product_description' => $row['product_description'],
            'product_details' => $row['product_details'],
            'product_images' => $row['product_images'],
            'product_quantity' => $row['product_quantity']
        );
    }
    ?>

    <div class="container">
        <h1 class="text-center mb-4">Danh sách sản phẩm</h1>
        <div class="text-end mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddProduct">
                Thêm 
            </button>
        </div>
        <table id="danhsach" class="table table-striped table-bordered table-hover">
            <thead>
                <tr style="font-size: larger;">
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Loại sản phẩm</th>
                    <th>Mã loại sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Mô tả chi tiết</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
    <?php
    foreach ($danhsachSP as $row) {
        $imgPath = '../../Assets/img/sanpham/' . htmlspecialchars($row['product_images']);
        
        // Chuyển đổi giá về dạng số (bỏ dấu phẩy nếu có)
        $price = floatval(str_replace(',', '', $row['product_price']));
        
        echo "<tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['product_type_name']}</td>
            <td>{$row['product_type_id']}</td>
            <td>" . number_format($price, 0, ',', '.') . " VNĐ</td>
            <td>{$row['product_description']}</td>
            <td>{$row['product_details']}</td>
            <td><img src='{$imgPath}' alt='Hình ảnh sản phẩm'></td>
            <td>{$row['product_quantity']}</td>
            <td>
                <div class='d-flex justify-content-center'>
                    <a href='../Includes/BE/delete_SQL.php?key=product_id&table=sanpham&datakey={$row['product_id']}' class='btn btn-danger mx-1'>Xóa</a>
                    <a href='../Pages/form_product.php?datakey={$row['product_id']}' class='btn btn-warning mx-1'>Sửa</a>
                </div>
            </td>
        </tr>";
    }
    ?>
</tbody>
        </table>
    </div>

  
    <?php include('../Includes/FE/modal_add_product.php');?>

    <script>
        $(document).ready(function () {
            $('#danhsach').DataTable({
                "language": {
                    "lengthMenu": "Hiện _MENU_ sản phẩm trên mỗi trang",
                    "zeroRecords": "Không tìm thấy sản phẩm nào",
                    "info": "Hiển thị trang _PAGE_ của _PAGES_",
                    "infoEmpty": "Không có sản phẩm",
                    "infoFiltered": "(lọc từ _MAX_ tổng số sản phẩm)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "next": "Tiếp",
                        "previous": "Trước"
                    }
                },
                "paging": true, // Bật phân trang
                "searching": true // Bật tìm kiếm
            });
        });

        var myDiv = document.getElementById("product");
        myDiv.classList.add("active");
        var myDiv = document.getElementById("product-collapse");
        myDiv.classList.add("show");
    </script>
</body>

</html>