<?php
    include('./admin_website.php');
    include('../../connect_SQL/connect.php');
    ?>
<style>
    .widget-flat {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .card-body {
        padding: 1.5rem;
        color: #fff;
    }

    .text-bg-info {
        background-color: #0dcaf0;
    }

    .text-bg-warning {
        background-color: #ffc107;
    }

    .text-bg-danger {
        background-color: #dc3545;
    }

    .text-bg-success {
        background-color: #198754;
    }

    .float-end {
        float: right !important;
    }

    .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-success {
        color: #198754 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-nowrap {
        white-space: nowrap !important;
    }

    h5 {
        font-weight: 400;
    }

    h3 {
        font-weight: 700;
    }

    .chart-container {
        position: relative;
        height: 40vh;
        width: 100%;
    }
</style>

<script>
   
    var myDiv = document.getElementById("ecom");
    myDiv.classList.add("active");
</script>

<div class="container mt-4">
    <h2 class="mb-4">Thống kê tổng quan</h2>

    <div class="row">
        <!-- Thống kê đơn hàng -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-info">
                    <div class="float-end">
                        <i class="fas fa-shopping-cart widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Số lượng đơn</h5>
                    <h3 class="mt-3 mb-3">36,254</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-success me-2"><i class="fas fa-arrow-up"></i> 5.27%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Thống kê chờ xác nhận -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-warning">
                    <div class="float-end">
                        <i class="fas fa-clock widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Chờ xác nhận</h5>
                    <h3 class="mt-3 mb-3">5,543</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-danger me-2"><i class="fas fa-arrow-down"></i> 1.08%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Thống kê đơn hủy -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-danger">
                    <div class="float-end">
                        <i class="fas fa-ban widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Đơn hủy</h5>
                    <h3 class="mt-3 mb-3">1,234</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-danger me-2"><i class="fas fa-arrow-down"></i> 2.00%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4">Sản phẩm</h3>
    <div class="row">
        <!-- Số sản phẩm -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-info">
                    <div class="float-end">
                        <i class="fas fa-box widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Số sản phẩm</h5>
                    <h3 class="mt-3 mb-3">1,256</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-danger me-2"><i class="fas fa-arrow-down"></i> 7.00%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Sản phẩm hết -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-danger">
                    <div class="float-end">
                        <i class="fas fa-exclamation-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Sản phẩm hết</h5>
                    <h3 class="mt-3 mb-3">150</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-success me-2"><i class="fas fa-arrow-up"></i> 4.87%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Sản phẩm còn -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-success">
                    <div class="float-end">
                        <i class="fas fa-check-circle widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Sản phẩm còn</h5>
                    <h3 class="mt-3 mb-3">1,106</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-success me-2"><i class="fas fa-arrow-up"></i> 4.87%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4">Người dùng</h3>
    <div class="row">
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card widget-flat">
                <div class="card-body text-bg-info">
                    <div class="float-end">
                        <i class="fas fa-user-friends widget-icon"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0">Số tài khoản</h5>
                    <h3 class="mt-3 mb-3">2,354</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-danger me-2"><i class="fas fa-arrow-down"></i> 3.00%</span>
                        <span class="text-nowrap">So với tháng trước</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4">Thống kê sản phẩm mua thực tế</h3>
    <div class="chart-container">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            datasets: [{
                label: 'Sản phẩm đã bán',
                data: [120, 190, 300, 250],
                backgroundColor: 'rgba(25, 135, 84, 0.5)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>