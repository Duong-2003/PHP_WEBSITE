<?php
// Hiển thị modal cho từng đơn hàng
$result->data_seek(0); // Reset con trỏ về đầu
while ($row = $result->fetch_assoc()) {
    ?>
    <div class="modal fade" id="infoOrder<?= htmlspecialchars($row['order_id']) ?>" tabindex="-1" aria-labelledby="infoOrderLabel<?= htmlspecialchars($row['order_id']) ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="infoOrderLabel<?= htmlspecialchars($row['order_id']) ?>">Thông tin đơn hàng #<?= htmlspecialchars($row['order_id']) ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="menu-content">
                        <div class="mb-3">
                            <label class="form-label">Mã sản phẩm:</label>
                            <p><?= htmlspecialchars($row['product_id']) ?></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Người đặt:</label>
                            <p><?= htmlspecialchars($row['user_id']) ?></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày đặt:</label>
                            <p><?= htmlspecialchars($row['timeorder']) ?></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái:</label>
                            <p><?= htmlspecialchars($row['order_status']) ?></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thành tiền:</label>
                            <p><?= number_format($row['order_price'], 0, '.', ',') ?> đ</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số lượng:</label>
                            <p><?= htmlspecialchars($row['order_quantity']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>