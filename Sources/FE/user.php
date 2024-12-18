<?php
include("../connect_SQL/connect.php"); // Kết nối cơ sở dữ liệu

$user = null; // Khởi tạo biến người dùng

if (isset($loggedInUsername)) {
    $name = $loggedInUsername;
    $sql = "SELECT * FROM users WHERE name = '$name'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
}
?>

<div style="z-index: 10000;" class="modal fade" id="User" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white bg-primary">
                <h1 class="modal-title" style="font-size: 24px;">Thông tin người dùng</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="error-message" class="text-danger text-center" style="font-size: 20px;"></div>
            <div class="modal-body">
                <div class="menu-content">
                    <form action="<?= $linkBE . 'Add_product.php' ?>" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <img src="https://avatars.githubusercontent.com/u/125018793?s=400&u=d66a7dc1d555eb23d223fe07b638e9701a5735be&v=4" alt="Avatar" width="64" height="64" class="rounded-circle me-3">
                            <div>
                                <p style="font-size: 20px;"><strong>Tên đăng nhập:</strong> <?= $user['name'] ?? 'Chưa có dữ liệu' ?></p>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="email">Email<span style="color: red;">*</span></span>
                            <input name="email" type="email" class="form-control" value="<?= $user['email'] ?? '' ?>" required>
                            <button type="button" class="btn btn-dark">Đổi Email</button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="address">Địa chỉ</span>
                            <input name="address" type="text" class="form-control" value="<?= $user['address'] ?? '' ?>">
                            <button type="button" class="btn btn-dark">Đổi địa chỉ</button>
                        </div>

                        <div class="input-group mb-3">
                            <button type="button" class="btn btn-dark">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>