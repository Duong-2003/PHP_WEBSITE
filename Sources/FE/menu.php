<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chia Cột</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif; /* Chọn font chữ cho toàn bộ trang */
            background-color: #f8f9fa; /* Màu nền cho trang */
        }

        .elementor-container {
            max-width: 1200px; /* Đặt chiều rộng tối đa cho container */
            margin: 0 auto; /* Căn giữa container */
            padding: 20px; /* Khoảng cách bên trong */
        }

        .elementor-row {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .elementor-column {
            flex: 0 0 12.5%; /* 8 cột = 100% / 8 */
            box-sizing: border-box;
            padding: 10px; /* Khoảng cách giữa các cột */
            display: flex;
            flex-direction: column; /* Căn giữa theo chiều dọc */
            align-items: center; /* Căn giữa các phần tử trong cột */
            border: 1px solid #E1E1E1; /* Viền cho cột */
           
            background-color: #fff; /* Màu nền cho cột */
           
        }

        .elementor-column:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Hiệu ứng đổ bóng khi hover */
        }

        .elementor-image-box-img img {
            width: 100%; /* Đặt chiều rộng ảnh 100% */
            height: auto; /* Chiều cao tự động */
            max-width: 90px; /* Chiều rộng tối đa cho ảnh */
        }

        .elementor-image-box-content {
            text-align: center;
            margin-top: 10px; /* Khoảng cách giữa ảnh và tiêu đề */
        }

        .elementor-image-box-title {
            margin: 0; /* Xóa khoảng cách mặc định của h3 */
            font-size: 0.90rem; /* Kích thước font cho tiêu đề */
            color: #333; /* Màu chữ cho tiêu đề */
        }

        .elementor-image-box-title a {
            text-decoration: none;
            color: inherit; /* Kế thừa màu chữ */
            transition: color 0.3s; /* Hiệu ứng chuyển màu khi hover */
        }

        .elementor-image-box-title a:hover {
            color: #007bff; /* Màu chữ khi hover */
        }
    </style>
</head>

<body>
    <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed">
        <div class="elementor-container">
            <div class="elementor-row">
                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=biahoso">
                                <img src="../Assets/img/index/folders.png" alt="Bìa hồ sơ">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=biahoso">Bìa hồ sơ</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=butki">
                                <img src="../Assets/img/index/stationery.png" alt="Bút kí">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=butki">Bút kí</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=sotay">
                                <img src="../Assets/img/index/notebook.png" alt="Sổ">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=sotay">Sổ</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=bangkeo">
                                <img src="../Assets/img/index/tape.png" alt="Băng keo">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=bangkeo">Băng keo</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=bangten">
                                <img src="../Assets/img/index/employee.png" alt="Bảng tên, dây đeo">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=bangten">Bảng tên, dây đeo</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=butchigo">
                                <img src="../Assets/img/index/color-pencil.png" alt="Bút chì gỗ">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=butchigo">Bút chì gỗ</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=butbi">
                                <img src="../Assets/img/index/but.png" alt="Bút bi">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=butbi">Bút bi</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=hoadon">
                                <img src="../Assets/img/index/invoice.png" alt="Hoá đơn">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=hoadon">Hoá đơn</a></h3>
                        </div>
                    </div>
                </div>


                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=giaycacloai">
                                <img src="../Assets/img/index/papers.png" alt="Giấy các loại">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=giaycacloai">Giấy các loại</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=bamkim">
                                <img src="../Assets/img/index/stapler.png" alt="Bấm kim">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=bamkim">Bấm kim</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=maytinh">
                                <img src="../Assets/img/index/calculations.png" alt="Máy tính">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=maytinh">Máy tính</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=thuocke">
                                <img src="../Assets/img/index/ruler.png" alt="Thước">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=thuocke">Thước</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=kepgiay">
                                <img src="../Assets/img/index/file.png" alt="Kẹp giấy">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=kepgiay">Kẹp giấy</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=butlong">
                                <img src="../Assets/img/index/stationery-2.png" alt="Bút lông">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=butlong">Bút lông</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=ketailieu">
                                <img src="../Assets/img/index/branding.png" alt="Kệ tài liệu">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=ketailieu">Kệ tài liệu</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=dochoitreem">
                                <img src="../Assets/img/index/toys.png" alt="Đồ chơi trẻ em">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=dochoitreem">Đồ chơi trẻ em</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=nhandan">
                                <img src="../Assets/img/index/happy.png" alt="Hình dãn (sticker)">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=nhandan">Nhãn dán (sticker)</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=balo">
                                <img src="../Assets/img/index/images.png" alt="Túi-Balo">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=balo">Túi-Balo</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=denban">
                                <img src="../Assets/img/index/desk-lamp.png" alt="Đèn bàn">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=denban">Đèn bàn</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=tapvo">
                                <img src="../Assets/img/index/notebook-1.png" alt="Tập vở">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=tapvo">Tập vở</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=daodocgiay">
                                <img src="../Assets/img/index/cutter.png" alt="Dao rọc giấy">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=daodocgiay">Dao rọc giấy</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=dungcuhocsinh">
                                <img src="../Assets/img/index/education.png" alt="Dụng cụ học sinh">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=dungcuhocsinh">Dụng cụ học sinh</a></h3>
                        </div>
                    </div>
                </div>

                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=giayghinho">
                                <img src="../Assets/img/index/post-it.png" alt="Giấy ghi nhớ">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=giayghinho">Giấy ghi nhớ</a></h3>
                        </div>
                    </div>
                </div>


                <div class="elementor-column">
                    <div class="elementor-image-box-wrapper">
                        <figure class="elementor-image-box-img">
                            <a href="../website/products_click.php?product_type_id=dungcukhac">
                                <img src="../Assets/img/index/office-desk.png" alt="Dụng cụ khác">
                            </a>
                        </figure>
                        <div class="elementor-image-box-content">
                            <h3 class="elementor-image-box-title"><a href="../website/products_click.php?product_type_id=dungcukhac">Dụng cụ khác</a></h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>