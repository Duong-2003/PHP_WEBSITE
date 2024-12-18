<?php
include('./admin_website.php');
include('../../connect_SQL/connect.php');
// Lấy danh sách người dùng với phân trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy số trang từ URL
$limit = 10; // Số bản ghi trên mỗi trang
$offset = ($page - 1) * $limit; // Tính toán offset
// Lấy danh sách người dùng
$sqlUsers = "SELECT * FROM user LIMIT ? OFFSET ?";
$stmt = $connect->prepare($sqlUsers);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$resultUsers = $stmt->get_result();
$danhsachUsers = [];
// Chuyển dữ liệu thành mảng
while ($row = $resultUsers->fetch_assoc()) {
    $danhsachUsers[] = array(
        'user_id' => (int) $row['user_id'],
        'username' => htmlspecialchars($row['username']),
        'name' => htmlspecialchars($row['name']),
        'email' => htmlspecialchars($row['email']),
        
      
        'avatar' => htmlspecialchars($row['avatar']),
        'role' => (int) $row['role'],
        'created_at' => htmlspecialchars($row['created_at']),
        'updated_at' => htmlspecialchars($row['updated_at']),
        'status' => (int) $row['status'],
        'last_login' => htmlspecialchars($row['last_login']),
    );
}
// Giải phóng biến không cần thiết
$stmt->close();
?>
<div class="container">
    <h1 class="text-center mb-4">Danh Sách Người Dùng</h1>
    <div class="text-end mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddUser">
            Thêm quản trị viên
        </button>
    </div>
    <table id="danhsach" class="table table-striped table-bordered table-hover">
        <thead>
            <tr style="font-size: larger;">
                <th>ID</th>
                <th>Tên Đăng Nhập</th>
                <th>Họ Tên</th>
                <th>Email</th>
                <th>Ảnh</th>
                <th>Quyền</th>
                <th>Ngày Tạo</th>
                <th>Cập Nhật</th>
                <th>Trạng Thái</th>
                <th>Đăng Nhập Cuối</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($danhsachUsers as $user) {
                $imgPath = '../../Assets/img/Users/' . htmlspecialchars($user['avatar']);
                if (!file_exists($imgPath) || empty($user['avatar'])) {
                    $imgPath = '../../Assets/img/index/avatar-dep-119.jpg'; // Hình ảnh mặc định
                }
                echo "<tr>
                    <td>{$user['user_id']}</td>
                    <td>{$user['username']}</td>
                    <td>{$user['name']}</td>
                    <td>{$user['email']}</td>
                    
                  
                    <td><img src='{$imgPath}' alt='Avatar' style='max-height: 50px; width: auto;'></td>
                    <td>" . ($user['role'] === 1 ? 'ADMIN' : 'USER') . "</td>
                    <td>{$user['created_at']}</td>
                    <td>{$user['updated_at']}</td>
                    <td>" . ($user['status'] === 1 ? 'Active' : 'Inactive') . "</td>
                    <td>{$user['last_login']}</td>
                    <td>
                        <div class='d-flex justify-content-center'>
                            <a href='../Includes/BE/delete_SQL.php?key=user_id&table=user&datakey=" . urlencode($user['user_id']) . "' class='btn btn-danger mx-1'>Xóa</a>
                            <a href='form_users.php?datakey=" . urlencode($user['user_id']) . "' class='btn btn-warning mx-1'>Sửa</a>
                        </div>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Modal for Adding User -->
<?php include('../Includes/FE/modal_add_user.php'); ?>
<script>
    $(document).ready(function () {
        $('#danhsach').DataTable({
            "language": {
                "lengthMenu": "Hiện _MENU_ người dùng trên mỗi trang",
                "zeroRecords": "Không tìm thấy người dùng nào",
                "info": "Hiển thị trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có người dùng",
                "infoFiltered": "(lọc từ _MAX_ tổng số người dùng)",
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
    // Đánh dấu menu hiện tại
    document.getElementById("user").classList.add("active");
    document.getElementById("user-collapse").classList.add("show");
</script>