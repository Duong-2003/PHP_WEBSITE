<?php
include("../linkFile.php");
include($linkconnSources);
session_start();
ob_start();
if (isset($_POST['submit'])) {
    try {


        // Mã đơn hàng cần hủy
        $donhang_id = $_POST["donhang_ma"];

        // Cập nhật trạng thái của đơn hàng
        $updateDonHangQuery = "UPDATE donhang SET donhang_trangthai = 'Đã hủy' WHERE donhang_ma = $donhang_id";
        $connect->query($updateDonHangQuery);

        // Lấy thông tin số lượng sản phẩm từ đơn hàng
        $getDonHangInfoQuery = "SELECT sp_ma, donhang_soluongsp FROM donhang WHERE donhang_ma = $donhang_id";
        $donHangInfoResult = $connect->query($getDonHangInfoQuery);

        if ($donHangInfoResult->num_rows > 0) {
            while ($row = $donHangInfoResult->fetch_assoc()) {
                $sanpham_id = $row['sp_ma'];
                $soluongsp = $row['donhang_soluongsp'];

                // Cập nhật số lượng sản phẩm trong bảng sanpham
                $updateSanPhamQuery = "UPDATE sanpham SET sp_soluong = sp_soluong + $soluongsp WHERE sp_ma = $sanpham_id";
                $connect->query($updateSanPhamQuery);
            }
        }

        // Hoàn tất giao dịch nếu mọi thứ thành công
        $connect->commit();
        header("location:" . $linkWebsite . "cart.php?notifi=Sửa thành công");
    } catch (Exception $e) {
        // Nếu có lỗi, rollback giao dịch
        $connect->rollback();
        header("location:" . $linkWebsite . "cart.php?error=" . $e->getMessage());
    }
}
else{
    header("location:" . $linkWebsite . "cart.php?error=Không phải từ trang chính thức");
}
