<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Sản Phẩm</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css">
  <style>
    .content {
      padding: 50px 30px;
      background-color: #f9f9f9;
    }
    .error-message {
      text-align: center;
      font-size: 20px;
    }
    .form-label {
      font-weight: bold;
    }
    #image-preview {
      max-width: 150px;
      margin-top: 10px;
      border: 2px solid #007bff;
      border-radius: 5px;
      display: none;
    }
    .card {
      border: none;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .card-header {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .btn-primary {
      background-color: #28a745;
      border: none;
    }
    .btn-primary:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>

  <div class="content">
    <?php
    include('./admin_website.php');    
    include('../../connect_SQL/connect.php');

    $sqlLSP = "SELECT * FROM product_type";
    $resultLSP = $connect->query($sqlLSP);
   
    if ($resultLSP === false) {
        echo ('<div class="alert alert-danger">ERROR: Không thể truy cập dữ liệu loại sản phẩm.</div>');
        exit();
    }

    $danhsachLSP = [];
    while ($row = mysqli_fetch_array($resultLSP, MYSQLI_ASSOC)) {
      $danhsachLSP[] = array(
        'product_type_id' => $row['product_type_id'],
        'product_type_name' => $row['product_type_name']
      );
    }
    
    $dataKey = isset($_GET['datakey']) ? $_GET['datakey'] : null;

    if ($dataKey === null) {
        echo ('<div class="alert alert-danger">ERROR: Không tìm thấy mã sản phẩm.</div>');
        exit();
    }

    $sqlSP = "SELECT * FROM product WHERE product_id = '$dataKey'";
    $result = $connect->query($sqlSP);
    
    if ($result === false || $result->num_rows != 1) {
      echo ('<div class="alert alert-danger">ERROR: Không tìm thấy sản phẩm.</div>');
      exit();
    }
    
    $sp = $result->fetch_assoc();
    ?>

    <h2 class="text-center mb-4">Chi Tiết Sản Phẩm</h2>
    
    <div class="card mb-4">
      <div class="card-header">Thông Tin Sản Phẩm</div>
      <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Mã sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Loại sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th>Mô tả</th>
              <th>Mô tả chi tiết</th>
              <th>Hình ảnh</th>
              <th>Số lượng</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= htmlspecialchars($sp['product_id']) ?></td>
              <td><?= htmlspecialchars($sp['product_name']) ?></td>
              <td><?= htmlspecialchars($sp['product_type_name']) ?></td>
              <td><?= htmlspecialchars($sp['product_type_id']) ?></td>
              <td><?= number_format($sp['product_price'], 0, ',', '.') ?> VNĐ</td>
              <td><?= htmlspecialchars($sp['product_description']) ?></td>
              <td><?= htmlspecialchars($sp['product_details']) ?></td>
              <td><img src="<?= htmlspecialchars($sp['product_images']) ?>" alt="Image" style="max-width: 100px;"></td>
              <td><?= htmlspecialchars($sp['product_quantity']) ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Sửa sản phẩm</div>
      <div class="card-body">
        <div id="error-message" class="text-danger error-message"></div>
        <form action="../Includes/BE/edit_product.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" value="<?= htmlspecialchars($sp['product_id']) ?>">

          <div class="mb-3">
            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
            <input value="<?= htmlspecialchars($sp['product_name']) ?>" name="product_name" type="text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tên loại sản phẩm <span class="text-danger">*</span></label>
            <select name="product_type_name" class="form-select" required>
              <?php foreach ($danhsachLSP as $Lsp) : ?>
                <option value="<?= htmlspecialchars($Lsp['product_type_name']) ?>" <?= ($sp['product_type_name'] == $Lsp['product_type_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($Lsp['product_type_name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Loại sản phẩm <span class="text-danger">*</span></label>
            <select name="product_type_id" class="form-select" required>
              <?php foreach ($danhsachLSP as $Lsp) : ?>
                <option value="<?= htmlspecialchars($Lsp['product_type_id']) ?>" <?= ($sp['product_type_id'] == $Lsp['product_type_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($Lsp['product_type_id']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
         
          <div class="mb-3">
            <label class="form-label">Giá sản phẩm <span class="text-danger">*</span></label>
            <input value="<?= htmlspecialchars($sp['product_price']) ?>" name="product_price" type="text" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Mô tả sản phẩm</label>
            <textarea name="product_description" class="form-control" rows="6"><?= htmlspecialchars($sp['product_description']) ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Mô tả sản phẩm chi tiết <span class="text-danger">*</span></label>
            <textarea name="product_details" class="form-control" rows="6" required><?= htmlspecialchars($sp['product_details']) ?></textarea>
          </div>

          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="checkbox_Img" onchange="toggleSection()">
            <label class="form-check-label" for="checkbox_Img">Sửa ảnh sản phẩm</label>
          </div>

          <div class="mb-3" id="image-section" style="display:none;">
            <input name="product_images" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
            <img id="image-preview" src="" alt="Image Preview">
          </div>

          <div class="mb-3">
            <label class="form-label">Số lượng <span class="text-danger">*</span></label>
            <input value="<?= htmlspecialchars($sp['product_quantity']) ?>" name="product_quantity" type="number" min='0' class="form-control" required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Sửa</button>
          <a href="../Pages/list_user.php" class="btn btn-secondary">Quay Về</a>
        </form>
      </div>
    </div>
  </div>

  <script>
    function toggleSection() {
      const checkBoxImg = document.getElementById("checkbox_Img");
      const imageSection = document.getElementById("image-section");
      imageSection.style.display = checkBoxImg.checked ? "block" : "none";
      document.getElementById("image-preview").style.display = "none"; // Ẩn hình ảnh khi chuyển đổi
    }

    function previewImage(event) {
      const imagePreview = document.getElementById("image-preview");
      imagePreview.src = URL.createObjectURL(event.target.files[0]);
      imagePreview.style.display = "block"; // Hiển thị hình ảnh
    }

    const form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
      const requiredInputs = form.querySelectorAll('input[required], textarea[required]');
      let allFilled = true;

      requiredInputs.forEach(input => {
        if (!input.value.trim()) {
          allFilled = false;
        }
      });

      if (!allFilled) {
        document.getElementById("error-message").textContent = "Vui lòng nhập đầy đủ thông tin.";
        event.preventDefault();
      }
    });

    form.addEventListener("input", function() {
      document.getElementById("error-message").textContent = "";
    });
  </script>

</body>
</html>