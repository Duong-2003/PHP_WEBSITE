<div class="modal fade" id="AddUser" tabindex="-1" aria-labelledby="AddUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Thêm quản trị viên</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="error-message" class="text-danger text-center" style="font-size: 18px;"></div>
            <div class="container modal-body">
                <form action="../Includes/BE/add_user.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên <span class="text-danger">*</span></label>
                        <input name="name" type="text" class="form-control" id="name" required placeholder="Nhập tên">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Đăng Nhập <span class="text-danger">*</span></label>
                        <input name="username" type="text" class="form-control" id="username" required placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input name="email" type="email" class="form-control" id="email" required placeholder="Nhập email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu <span class="text-danger">*</span></label>
                        <input name="password" type="password" class="form-control" id="password" required placeholder="Nhập mật khẩu">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa Chỉ <span class="text-danger">*</span></label>
                        <input name="address" type="text" class="form-control" id="address" required placeholder="Nhập địa chỉ">
                    </div>
                  
                    <!-- <div class="mb-3">
                        <label for="avatar" class="form-label">Ảnh <span class="text-danger">*</span></label>
                        <input name="avatar" type="file" class="form-control" id="avatar" accept="image/*" required>
                    </div> -->
                    <input type="hidden" name="role" value="1"> <!-- 1 tương ứng với ADMIN -->
                    <button type="submit" name="submit" class="btn btn-dark">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector("#AddUser form").addEventListener("submit", function(event) {
        const errorMessage = document.getElementById("error-message");
        const fields = {
            name: document.querySelector('input[name="name"]').value.trim(),
            username: document.querySelector('input[name="username"]').value.trim(),
            email: document.querySelector('input[name="email"]').value.trim(),
            password: document.querySelector('input[name="password"]').value.trim(),
            address: document.querySelector('input[name="address"]').value.trim(),
         
            avatar: document.querySelector('input[name="avatar"]').value.trim(),
        };

        const emptyFields = Object.entries(fields).filter(([key, value]) => !value);
        if (emptyFields.length > 0) {
            errorMessage.textContent = "Vui lòng nhập đầy đủ thông tin.";
            event.preventDefault();
        } 
    });

    document.querySelector("#AddUser form").addEventListener("input", function() {
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