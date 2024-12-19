<?php
include('./admin_website.php');
include('../../connect_SQL/connect.php');

// Khởi tạo biến cho thông báo
$notification = '';
$profileData = [];

// Kiểm tra xem user_id có tồn tại trong bảng user không
if (isset($_POST['user_id'])) {
    $userId = (int)$_POST['user_id'];

    // Kiểm tra sự tồn tại của user_id
    $sqlCheckUser = "SELECT * FROM user WHERE user_id = ?";
    $stmtCheckUser = $connect->prepare($sqlCheckUser);
    $stmtCheckUser->bind_param("i", $userId);
    $stmtCheckUser->execute();
    $resultCheckUser = $stmtCheckUser->get_result();

    if ($resultCheckUser->num_rows > 0) {
        // Nếu user_id tồn tại, kiểm tra sự tồn tại của hồ sơ trong bảng profile_user
        $sqlCheckProfile = "SELECT p.*, u.name AS user_name FROM profile_user p LEFT JOIN user u ON p.user_id = ? WHERE p.user_id = ?";
        $stmtCheckProfile = $connect->prepare($sqlCheckProfile);
        $stmtCheckProfile->bind_param("ii", $userId, $userId);
        $stmtCheckProfile->execute();
        $resultCheckProfile = $stmtCheckProfile->get_result();

        if ($resultCheckProfile->num_rows > 0) {
            // Nếu hồ sơ đã tồn tại, hiển thị thông tin hồ sơ
            $profileData = $resultCheckProfile->fetch_assoc();
            $notification = "<div class='alert alert-info'>Hồ sơ đã tồn tại cho user_id: $userId</div>";
        } else {
            // Nếu hồ sơ chưa tồn tại, thông báo không tìm thấy
            $notification = "<div class='alert alert-warning'>Không tìm thấy hồ sơ cho user_id: $userId.</div>";
        }

        // Giải phóng biến không cần thiết
        $stmtCheckProfile->close();
    } else {
        // Thông báo nếu user_id không tồn tại
        $notification = "<div class='alert alert-warning'>user_id không tồn tại trong bảng user.</div>";
    }

    // Giải phóng biến không cần thiết
    $stmtCheckUser->close();
}
?>

<div class="container">
    <h1 class="text-center mb-4">Danh Sách Hồ Sơ Người Dùng</h1>
    
    <div class="text-end mb-3">
        <form method="POST" class="d-inline-block">
            <input type="number" name="user_id" placeholder="Nhập ID Người Dùng" class="form-control d-inline-block" style="width: auto;" required>
            <button type="submit" class="btn btn-primary">Tìm Hồ Sơ</button>
        </form>
    </div>

    <div>
        <?= $notification ?>
    </div>

    <table id="danhsach" class="table table-striped table-bordered table-hover">
        <thead>
            <tr style="font-size: larger;">
                <th>ID Hồ Sơ</th>
                <th>ID Người Dùng</th>
                <th>Tên Người Dùng</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Tiểu Sử</th>
                <th>Website</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Ngày Tạo</th>
                <th>Cập Nhật</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Nếu không có tìm kiếm, hiển thị tất cả hồ sơ
            if (empty($_POST['user_id'])) {
                // Lấy danh sách hồ sơ người dùng với phân trang
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy số trang từ URL
                $limit = 10; // Số bản ghi trên mỗi trang
                $offset = ($page - 1) * $limit; // Tính toán offset

                // Lấy danh sách hồ sơ
                $sqlProfiles = "
                    SELECT p.*, u.name AS user_name FROM profile_user p
                    LEFT JOIN user u ON p.user_id = u.user_id
                    LIMIT ? OFFSET ?
                ";
                $stmt = $connect->prepare($sqlProfiles);
                $stmt->bind_param("ii", $limit, $offset);
                $stmt->execute();
                $resultProfiles = $stmt->get_result();

                while ($row = $resultProfiles->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['profile_id']) . "</td>
                        <td>" . htmlspecialchars($row['user_id']) . "</td>
                        <td>" . htmlspecialchars($row['user_name']) . "</td>
                        <td>" . htmlspecialchars($row['date_of_birth']) . "</td>
                        <td>" . htmlspecialchars($row['gender']) . "</td>
                        <td>" . htmlspecialchars($row['bio']) . "</td>
                        <td>" . htmlspecialchars($row['website']) . "</td>
                        <td>" . htmlspecialchars($row['phone']) . "</td>
                        <td>" . htmlspecialchars($row['address']) . "</td>
                        <td>" . htmlspecialchars($row['created_at']) . "</td>
                        <td>" . htmlspecialchars($row['updated_at']) . "</td>
                        <td>
                            <div class='d-flex justify-content-center'>
                                <a href='../Includes/BE/delete_SQL.php?key=profile_id&table=profile_user&datakey=" . urlencode($row['profile_id']) . "' class='btn btn-danger mx-1'>Xóa</a>
                                <a href='form_profiles.php?datakey=" . urlencode($row['profile_id']) . "' class='btn btn-warning mx-1'>Sửa</a>
                            </div>
                        </td>
                    </tr>";
                }
                $stmt->close();
            } else {
                // Hiển thị thông tin hồ sơ nếu tìm thấy
                if (!empty($profileData)) {
                    echo "<tr>
                        <td>" . htmlspecialchars($profileData['profile_id']) . "</td>
                        <td>" . htmlspecialchars($profileData['user_id']) . "</td>
                        <td>" . htmlspecialchars($profileData['user_name']) . "</td>
                        <td>" . htmlspecialchars($profileData['date_of_birth']) . "</td>
                        <td>" . htmlspecialchars($profileData['gender']) . "</td>
                        <td>" . htmlspecialchars($profileData['bio']) . "</td>
                        <td>" . htmlspecialchars($profileData['website']) . "</td>
                        <td>" . htmlspecialchars($profileData['phone']) . "</td>
                        <td>" . htmlspecialchars($profileData['address']) . "</td>
                        <td>" . htmlspecialchars($profileData['created_at']) . "</td>
                        <td>" . htmlspecialchars($profileData['updated_at']) . "</td>
                        <td>
                            <div class='d-flex justify-content-center'>
                                <a href='../Includes/BE/delete_SQL.php?key=profile_id&table=profile_user&datakey=" . urlencode($profileData['profile_id']) . "' class='btn btn-danger mx-1'>Xóa</a>
                                <a href='form_profiles.php?datakey=" . urlencode($profileData['profile_id']) . "' class='btn btn-warning mx-1'>Sửa</a>
                            </div>
                        </td>
                    </tr>";
                } else {
                    // Nếu không tìm thấy hồ sơ
                    echo "<tr><td colspan='12' class='text-center'>Không có hồ sơ nào được tìm thấy.</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#danhsach').DataTable({
            "language": {
                "lengthMenu": "Hiện _MENU_ hồ sơ trên mỗi trang",
                "zeroRecords": "Không tìm thấy hồ sơ nào",
                "info": "Hiển thị trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có hồ sơ",
                "infoFiltered": "(lọc từ _MAX_ tổng số hồ sơ)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            },
            "paging": true,
            "searching": true
        });
    });

    // Đánh dấu menu hiện tại
    document.getElementById("profile").classList.add("active");
    document.getElementById("profile-collapse").classList.add("show");
</script>