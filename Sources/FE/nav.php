<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breadcrumb và Danh mục sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bread-crumb {
            padding: 20px 0;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
        .breadcrumb {
            margin-bottom: 0;
        }
        .list-group-item {
            cursor: pointer; /* Thay đổi con trỏ thành pointer */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu nền */
        }
        .list-group-item:hover {
            background-color: #e9ecef; /* Màu nền khi hover */
        }
    </style>
</head>
<body>

<div class="container">
    <section class="bread-crumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Danh mục sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" id="productToggle">Tên sản phẩm</a>
                </li>
            </ol>
        </nav>
    </section>

    <div id="categoryList" class="category-list" style="display:none;">
        <h5>Danh mục sản phẩm</h5>
        <ul class="list-group">
            <li class="list-group-item" onclick="updateBreadcrumb('Bút', '../website/products_click.php?product_type_id=but')">Bút</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Hộp', '../website/products_click.php?product_type_id=hop')">Hộp</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Bìa kẹp', '../website/products_click.php?product_type_id=biakep')">Bìa kẹp</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Máy tính', '../website/products_click.php?product_type_id=maytinh')">Máy tính</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Nhãn dán', '../website/products_click.php?product_type_id=nhandan')">Nhãn dán</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Sổ tay', '../website/products_click.php?product_type_id=sotay')">Sổ tay</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Vở', '../website/products_click.php?product_type_id=vo')">Vở</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Túi', '../website/products_click.php?product_type_id=tui')">Túi</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Dao rọc giấy', '../website/products_click.php?product_type_id=daorocgiay')">Dao rọc giấy</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Hoá đơn', '../website/products_click.php?product_type_id=hoadon')">Hoá đơn</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Bấm kim', '../website/products_click.php?product_type_id=bamkim')">Bấm kim</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Bìa hồ sơ', '../website/products_click.php?product_type_id=biahoso')">Bìa hồ sơ</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Bút kí', '../website/products_click.php?product_type_id=butki')">Bút kí</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Băng keo', '../website/products_click.php?product_type_id=bangkeo')">Băng keo</li>
            <li class="list-group-item" onclick="updateBreadcrumb('Sản phẩm giảm giá', '../website/products_click.php?product_type_id=discount')">Sản phẩm giảm giá</li>
        </ul>
    </div>
</div>

<script>
    // Hàm để hiển thị/ẩn danh mục sản phẩm
    document.getElementById('productToggle').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        var categoryList = document.getElementById('categoryList');
        categoryList.style.display = (categoryList.style.display === 'none') ? 'block' : 'none'; // Hiển thị/ẩn danh mục sản phẩm
    });

    // Hàm để cập nhật breadcrumb và điều hướng
    function updateBreadcrumb(productName, link) {
        document.getElementById('productToggle').innerText = productName; // Cập nhật tên sản phẩm trong breadcrumb
        document.getElementById('productToggle').setAttribute('href', link); // Cập nhật liên kết
        window.location.href = link; // Điều hướng đến liên kết
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>