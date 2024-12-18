<div class="modal fade" id="AddProduct">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Thêm sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="error-message" class="text-danger text-center" style="font-size: 18px;"></div>
            <div class="container modal-body">
                <form action='../Includes/BE/add_product.php' method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="sp_ten" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input name="sp_ten" type="text" class="form-control" id="sp_ten" required placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="mb-3">
                        <label for="productType" class="form-label">Mã loại sản phẩm <span class="text-danger">*</span></label>
                        <select name="productType" class="form-select" id="productType" required>
                            <?php foreach ($danhsachLSP as $Lsp) : ?>
                                <option value="<?= htmlspecialchars($Lsp['product_type_id']) ?>"><?= htmlspecialchars($Lsp['product_type_id']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productTypeName" class="form-label">Loại sản phẩm <span class="text-danger">*</span></label>
                        <select name="productTypeName" class="form-select" id="productTypeName" required>
                            <?php foreach ($danhsachLSP as $Lsp) : ?>
                                <option value="<?= htmlspecialchars($Lsp['product_type_name']) ?>"><?= htmlspecialchars($Lsp['product_type_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Giá sản phẩm <span class="text-danger">*</span></label>
                        <input name="product_price" type="text" class="form-control" id="product_price" required placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Mô tả sản phẩm</label>
                        <textarea name="product_description" class="form-control" id="product_description" rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_details" class="form-label">Mô tả chi tiết <span class="text-danger">*</span></label>
                        <textarea name="product_details" class="form-control" id="product_details" rows="3" required placeholder="Nhập mô tả chi tiết"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sp_img" class="form-label">Hình ảnh <span class="text-danger">*</span></label>
                        <input name="sp_img" type="file" class="form-control" id="sp_img" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="	product_quantity" class="form-label">Số lượng <span class="text-danger">*</span></label>
                        <input name="	product_quantity" type="number" min="0" value="1" class="form-control" id="	product_quantity" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-dark">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        const errorMessage = document.getElementById("error-message");
        const fields = {
            productName: document.querySelector('input[name="sp_ten"]').value.trim(),
            productType: document.querySelector('select[name="productType"]').value.trim(),
            productPrice: document.querySelector('input[name="sp_gia"]').value.trim(),
            productDetail: document.querySelector('textarea[name="sp_motachitiet"]').value.trim(),
            productImage: document.querySelector('input[name="sp_img"]').value.trim(),
            productQuantity: document.querySelector('input[name="sp_soluong"]').value.trim(),
        };

        const emptyFields = Object.entries(fields).filter(([key, value]) => !value);
        if (emptyFields.length > 0) {
            errorMessage.textContent = "Vui lòng nhập đầy đủ thông tin.";
            event.preventDefault();
        } 
         
        
    });

    document.querySelector("form").addEventListener("input", function() {
        document.getElementById("error-message").textContent = "";
    });
</script>

<style>
    /* Tùy chỉnh CSS cho modal */
    .modal-header {
        background-color: #343a40; /* Màu nền header */
        color: white; /* Màu chữ */
    }

    
    .modal-content {
        border-radius: 8px; /* Bo góc cho modal */
    }

    .form-label {
        font-weight: bold; /* Làm đậm nhãn */
    }

    .btn-dark {
        background-color: #343a40; /* Màu nút */
        border: none; /* Không có viền */
    }

    .btn-dark:hover {
        background-color: #495057; /* Màu nền khi hover */
    }
</style>