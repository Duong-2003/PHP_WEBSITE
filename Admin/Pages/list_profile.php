<?php
include('./admin_website.php');
include('../../connect_SQL/connect.php');

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
        // Kiểm tra sự tồn tại của hồ sơ trong bảng profile_user
        $sqlCheckProfile = "SELECT * FROM profile_user WHERE user_id = ?";
        $stmtCheckProfile = $connect->prepare($sqlCheckProfile);
        $stmtCheckProfile->bind_param("i", $userId);
        $stmtCheckProfile->execute();
        $resultCheckProfile = $stmtCheckProfile->get_result();

        if ($resultCheckProfile->num_rows > 0) {
            // Nếu hồ sơ đã tồn tại, hiển thị thông tin hồ sơ
            $profileData = $resultCheckProfile->fetch_assoc();
            echo "<div class='alert alert-info'>Hồ sơ đã tồn tại cho user_id: $userId</div>";
        } else {
            // Nếu hồ sơ chưa tồn tại, thêm hồ sơ vào bảng profile_user
            $sqlInsertProfile = "INSERT INTO profile_user (user_id, date_of_birth, gender, bio, website, phone, address) VALUES (?, NULL, NULL, NULL, NULL, NULL, NULL)";
            $stmtInsertProfile = $connect->prepare($sqlInsertProfile);
            $stmtInsertProfile->bind_param("i", $userId);

            if ($stmtInsertProfile->execute()) {
                echo "<div class='alert alert-success'>Thêm hồ sơ thành công cho user_id: $userId</div>";
            } else {
                echo "<div class='alert alert-danger'>Lỗi khi thêm hồ sơ: " . htmlspecialchars($stmtInsertProfile->error) . "</div>";
            }

            // Giải phóng biến không cần thiết
            $stmtInsertProfile->close();
        }

        // Giải phóng biến không cần thiết
        $stmtCheckProfile->close();
    } else {
        // Thông báo nếu user_id không tồn tại
        echo "<div class='alert alert-warning'>user_id không tồn tại trong bảng user.</div>";
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
            <button type="submit" class="btn btn-primary">Thêm Hồ Sơ</button>
        </form>
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

            $danhsachProfiles = [];

            // Chuyển dữ liệu thành mảng
            while ($row = $resultProfiles->fetch_assoc()) {
                $danhsachProfiles[] = array(
                    'profile_id' => (int) $row['profile_id'],
                    'user_id' => (int) $row['user_id'],
                    'user_name' => htmlspecialchars($row['user_name']),
                    'date_of_birth' => htmlspecialchars($row['date_of_birth']),
                    'gender' => htmlspecialchars($row['gender']),
                    'bio' => htmlspecialchars($row['bio']),
                    'website' => htmlspecialchars($row['website']),
                    'created_at' => htmlspecialchars($row['created_at']),
                    'updated_at' => htmlspecialchars($row['updated_at']),
                    'phone' => htmlspecialchars($row['phone']),
                    'address' => htmlspecialchars($row['address']),
                );
            }

            // Giải phóng biến không cần thiết
            $stmt->close();

            foreach ($danhsachProfiles as $profile) {
                echo "<tr>
                    <td>{$profile['profile_id']}</td>
                    <td>{$profile['user_id']}</td>
                    <td>{$profile['user_name']}</td>
                    <td>{$profile['date_of_birth']}</td>
                    <td>{$profile['gender']}</td>
                    <td>{$profile['bio']}</td>
                    <td>{$profile['website']}</td>
                    <td>{$profile['phone']}</td>
                    <td>{$profile['address']}</td>
                    <td>{$profile['created_at']}</td>
                    <td>{$profile['updated_at']}</td>
                    <td>
                        <div class='d-flex justify-content-center'>
                            <a href='../Includes/BE/delete_SQL.php?key=profile_id&table=profile_user&datakey=" . urlencode($profile['profile_id']) . "' class='btn btn-danger mx-1'>Xóa</a>
                            <a href='form_profiles.php?datakey=" . urlencode($profile['profile_id']) . "' class='btn btn-warning mx-1'>Sửa</a>
                        </div>
                    </td>
                </tr>";
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