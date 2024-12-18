<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech of World Shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        #header {
            position: relative;
            transition: 0.5s;
            box-shadow: 0 4px 3px rgba(0, 0, 0, 0.3);
            background: linear-gradient(to right, #7FACD6, #BFB8DA);
        }

        #logo img {
            max-height: 50px;
        }

        .header-input {
            padding: 5px;
        }

        .dropdown-menu {
            min-width: 160px;
        }

        .indicator__button {
            display: flex;
            align-items: center;
            background: transparent;
            padding: .375rem .75rem;
            cursor: pointer;
        }

        .indicator__icon--cart {
            width: 40px;
            height: 37px;
        }

        .indicator__area {
            position: relative;
            display: block;
        }

        .fa-shopping-cart {
            color: #0dcaf0;
            /* Màu icon giỏ hàng */
            transition: color 0.3s;
            /* Hiệu ứng chuyển màu */
            font-size: 1.5rem;
            /* Tăng kích thước icon */
        }

        .indicator_badge {
            position: absolute;
            height: 20px;
            width: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
            padding: 0;
            border-radius: 50%;
            top: -5px;
            right: -10px;
            background: red;
            color: white;
            font-weight: bold;
            margin-left: -5px;
        }
    </style>
</head>


<body>
    <header id="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div id="logo">
                    <a href="./website.php">
                        <img src="<?= '../Assets/img/index/logo1.webp' ?>" alt="Logo" class="">
                    </a>
                </div>

                <form action="./list_search.php" method="GET" class="d-flex flex-grow-1 mx-5">
                    <input id="searchInput" type="text" class="form-control me-1"
                        placeholder="Vui lòng nhập từ khóa để tìm kiếm!" name="search" required>
                    <button style="background-color:#8095b3" type="button" id="searchClick" class="btn">
                        <i style="color: #fff;" class="fa fa-search"></i>
                    </button>
                </form>

                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <a class="indicator__button SendEvent" data-category="action" data-action="click"
                            data-label="action_cart_desktop" href="../website/cart.php">
                            <span class="indicator__area">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 23.077"
                                    class="indicator__icon indicator__icon--cart">
                                    <g transform="translate(-111.5 -32.5)">
                                        <circle cx="1.582" cy="1.582" r="1.582" transform="translate(121.46 52.413)"
                                            fill="#fff"></circle>
                                        <circle cx="1.582" cy="1.582" r="1.582" transform="translate(134.72 52.413)"
                                            fill="#fff"></circle>
                                        <path
                                            d="M141.241,36.379a1.082,1.082,0,0,0-.822-.378h-21.4l-.51-2.629a1.081,1.081,0,0,0-1.062-.873h-4.865a1.077,1.077,0,1,0,0,2.155h3.973l1.272,6.558,1.525,9.5a1.081,1.081,0,0,0,1.068.907h17.838a1.081,1.081,0,0,0,1.068-.907l2.162-13.466A1.076,1.076,0,0,0,141.241,36.379Zm-3.906,13.088H121.341l-1.816-11.312h19.626Z"
                                            transform="translate(0)" fill="#fff"></path>
                                    </g>
                                </svg>
                               
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <script>
        document.getElementById("searchInput").addEventListener("keydown", function (event) {
            if (event.key === "Enter" && this.value.trim() === "") {
                event.preventDefault();
                alert("Vui lòng nhập dữ liệu để tìm kiếm!");
            }
        });

        document.getElementById("searchClick").addEventListener("click", function () {
            var searchValue = document.getElementById('searchInput').value;
            if (searchValue) {
                window.location.href = "./listSearch.php?search=" + encodeURIComponent(searchValue);
            }
        });

        // Xử lý lỗi hình ảnh
        function handleImageError() {
            var images = document.querySelectorAll('img');
            images.forEach(function (img) {
                img.addEventListener('error', function () {
                    this.src = '<?php echo $linkImgIndex; ?>nope-not-here.webp';
                });
            });
        }
        document.addEventListener('DOMContentLoaded', handleImageError);


    </script>
</body>

</html>