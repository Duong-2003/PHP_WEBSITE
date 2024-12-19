-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 19, 2024 lúc 04:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`comment_id`, `product_id`, `user_name`, `comment`, `avatar`, `created_at`) VALUES
(1, 1, 'admin', '312', NULL, '2024-12-19 22:17:11'),
(2, 1, 'admin', '312', NULL, '2024-12-19 22:17:16'),
(3, 1, 'admin', 'ewq', NULL, '2024-12-19 22:21:18'),
(4, 1, 'admin', 'ewq', NULL, '2024-12-19 22:22:48'),
(5, 1, 'admin', 'ewq', NULL, '2024-12-19 22:23:02'),
(6, 1, 'admin', 'ewq', NULL, '2024-12-19 22:23:31'),
(7, 1, 'admin', 'ewqe', NULL, '2024-12-19 22:24:56'),
(8, 1, 'admin', 'ewqe', NULL, '2024-12-19 22:25:13'),
(9, 1, 'admin', 'ewqedư', NULL, '2024-12-19 22:25:50'),
(10, 1, 'admin', 'ewqedưdư', NULL, '2024-12-19 22:25:55'),
(11, 1, 'admin', '321', NULL, '2024-12-19 22:29:21'),
(12, 101, 'admin', 'eq', NULL, '2024-12-19 22:29:59'),
(13, 101, 'admin', 'eqw', NULL, '2024-12-19 22:31:33'),
(14, 101, 'admin', 'eqwe', NULL, '2024-12-19 22:31:39'),
(15, 100, 'admin', 'ew', NULL, '2024-12-19 22:31:49'),
(16, 100, 'admin', 'xín\r\n', NULL, '2024-12-19 22:32:42'),
(17, 100, 'admin', 'xín\r\new', NULL, '2024-12-19 22:32:59'),
(18, 100, 'admin', 'ewq', NULL, '2024-12-19 22:33:03'),
(19, 100, 'admin', 'okeoke\r\n', NULL, '2024-12-19 22:33:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `timeorder` date NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `order_price` varchar(15) NOT NULL,
  `order_quantity` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `product_id`, `timeorder`, `order_status`, `order_price`, `order_quantity`, `created_at`, `updated_at`, `total_price`, `payment_status`) VALUES
(2, 14, 101, '2024-10-17', 'Đã hủy', '50000', 1, '2024-10-17 14:17:20', '2024-12-19 13:14:54', 0.00, 0),
(3, 14, 109, '2024-10-17', 'Đã hủy', '100000', 1, '2024-10-17 15:01:15', '2024-12-19 13:15:34', 0.00, 0),
(4, 14, 110, '2024-11-13', 'Đã hủy', '29000', 1, '2024-11-13 12:39:44', '2024-12-19 13:15:50', 0.00, 0),
(5, 14, 99, '2024-11-13', 'Đã hủy', '20000', 1, '2024-11-13 12:46:04', '2024-12-19 13:16:02', 0.00, 0),
(6, 14, 102, '2024-11-14', 'Đã hủy', '100000', 1, '2024-11-14 03:21:07', '2024-12-19 13:16:43', 0.00, 0),
(7, 14, 109, '2024-11-14', 'Đã hủy', '100000', 1, '2024-11-14 03:23:00', '2024-12-19 13:17:14', 0.00, 0),
(8, 14, 108, '2024-12-18', 'Đã hủy', '29000', 1, '2024-12-18 13:12:25', '2024-12-19 13:17:39', 0.00, 0),
(9, 14, 101, '2024-12-19', 'Đã hủy', '50000', 1, '2024-12-19 12:38:41', '2024-12-19 13:17:53', 0.00, 0),
(10, 14, 101, '2024-12-19', 'Đã hủy', '50000', 1, '2024-12-19 13:18:26', '2024-12-19 13:18:30', 0.00, 0),
(11, 14, 101, '2024-12-19', 'Đã hủy', '50000', 1, '2024-12-19 13:18:40', '2024-12-19 13:19:33', 0.00, 0),
(12, 14, 99, '2024-12-19', 'Đã hủy', '20000', 1, '2024-12-19 13:20:41', '2024-12-19 13:21:13', 0.00, 0),
(13, 14, 99, '2024-12-19', 'Đã hủy', '20000', 1, '2024-12-19 13:21:25', '2024-12-19 13:21:30', 0.00, 0),
(14, 14, 99, '2024-12-19', 'Đã hủy', '20000', 1, '2024-12-19 13:22:19', '2024-12-19 13:22:24', 0.00, 0),
(15, 14, 99, '2024-12-19', 'Đã hủy', '20000', 1, '2024-12-19 13:22:59', '2024-12-19 13:23:04', 0.00, 0),
(16, 14, 108, '2024-12-19', 'Đang chờ', '29000', 1, '2024-12-19 13:23:32', '2024-12-19 13:23:32', 0.00, 0),
(17, 14, 108, '2024-12-19', 'Đang chờ', '29000', 1, '2024-12-19 13:44:56', '2024-12-19 13:44:56', 0.00, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','paypal') NOT NULL,
  `payment_status` enum('Completed','Pending','Failed') NOT NULL,
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `username`, `amount`, `payment_method`, `payment_status`, `payment_time`) VALUES
(1, 'admin', 4.00, 'credit_card', 'Completed', '2024-12-18 12:29:46'),
(2, 'admin', 4.00, 'credit_card', 'Completed', '2024-12-18 12:31:25'),
(3, 'admin', 4.00, 'credit_card', 'Completed', '2024-12-18 12:31:27'),
(4, 'admin', 20000.00, 'paypal', 'Completed', '2024-12-18 12:31:32'),
(5, 'admin', 20000.00, 'paypal', 'Completed', '2024-12-18 12:31:36'),
(6, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:31:52'),
(7, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:32:53'),
(8, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:36:35'),
(9, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:36:37'),
(10, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:37:54'),
(11, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:37:55'),
(12, 'admin', 20000.00, 'credit_card', 'Completed', '2024-12-18 12:38:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_type_name` varchar(100) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` varchar(250) NOT NULL,
  `product_description` varchar(300) DEFAULT NULL,
  `product_details` varchar(300) NOT NULL,
  `product_images` varchar(50) NOT NULL,
  `product_quantity` int(250) NOT NULL DEFAULT 1,
  `product_type_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_type_name`, `product_name`, `product_price`, `product_description`, `product_details`, `product_images`, `product_quantity`, `product_type_id`) VALUES
(99, 'Sổ tay', 'Sổ tay mini hoạt hình dễ thương note 32 trang', '20000', 'Sổ Tay Cá Nhân Mini/ Sổ Noted 32 Trang \r\n\r\n-  Sổ noted có 16 tờ- 32 trang.\r\n-  Kích thước cả bìa : 8.1*10.3cm được làm từ giấy chất lượng, bề mặt mịn, viết êm.\r\n-  Giấy bắt mực tốt, không gây lem, cho chữ viết rõ ràng, đẹp mắt.\r\n-  Sản phẩm phù hợp với nhiều mục đích sử dụng trong lĩnh vực văn phòng', 'Sổ Tay Cá Nhân Mini/ Sổ Noted 32 Trang \r\n\r\n-  Sổ noted có 16 tờ- 32 trang.\r\n-  Kích thước cả bìa : 8.1*10.3cm được làm từ giấy chất lượng, bề mặt mịn, viết êm.\r\n-  Giấy bắt mực tốt, không gây lem, cho chữ viết rõ ràng, đẹp mắt.\r\n-  Sản phẩm phù hợp với nhiều mục đích sử dụng trong lĩnh vực văn phòng', 'sp7.webp', 998, 'sotay'),
(100, 'Bút', 'Màu Sắc Bút Đánh Dấu Hai Đầu Màu Graffiti ', '40000', 'Đặc điểm kỹ thuật:\r\nLoại: Bút màu nước hai đầu\r\nChiều dài: 15cm\r\nChất liệu: Nhựa\r\nMàu sắc: 1 Bộ có 6 màu', 'Đặc điểm kỹ thuật:\r\nLoại: Bút màu nước hai đầu\r\nChiều dài: 15cm\r\nChất liệu: Nhựa\r\nMàu sắc: 1 Bộ có 6 màu', 'sp14.webp', 999, 'but'),
(101, 'Bìa kẹp', 'Bìa kẹp tài liệu thương hiệu Helix từ Anh Quốc', '50000', '- Loại bìa: Bìa kẹp\r\n\r\n- Dùng để kẹp tài liệu, hồ sơ...\r\n\r\n- Sản phẩm của thương hiệu Helix đến từ Anh Quốc\r\n\r\n- Làm từ chất liệu PP chắc chắn, chịu va đập cao.\r\n\r\n- Có kẹp giấy cứng cáp, giúp giữ giấy tờ luôn gọn gàng, thẳng nếp.\r\n\r\n- Màu sắc tươi sáng, chống thấm nước, không bám bụi bẩn, dễ lau ch', '- Loại bìa: Bìa kẹp\r\n\r\n- Dùng để kẹp tài liệu, hồ sơ...\r\n\r\n- Sản phẩm của thương hiệu Helix đến từ Anh Quốc\r\n\r\n- Làm từ chất liệu PP chắc chắn, chịu va đập cao.\r\n\r\n- Có kẹp giấy cứng cáp, giúp giữ giấy tờ luôn gọn gàng, thẳng nếp.\r\n\r\n- Màu sắc tươi sáng, chống thấm nước, không bám bụi bẩn, dễ lau ch', 'sp9.webp', 1007, 'biakep'),
(102, 'Máy tính', 'Máy Tính Mini Gấu Bỏ Túi Dễ Thương', '100000', 'Thông tin sản phẩm: Máy tính\r\n-  Chất liệu: Nhựa\r\n-  Kích thước : 6.5 x 9.5cm\r\n-  Màu Sắc Nhiều Màu được lựa chọn\r\n-  Hoạ Tiết Hình Gấu Dễ Thương\r\nLƯU Ý : MÁY TÍNH ĐỂ IM TỰ TẮT SAU 5-10PHÚT NHA CÁC BẠN !!!\r\n\r\n-  Phụ kiện Văn phòng phẩm không thể thiếu với các bạn học sinh, sinh viên, công sở trong v', 'Thông tin sản phẩm: Máy tính\r\n-  Chất liệu: Nhựa\r\n-  Kích thước : 6.5 x 9.5cm\r\n-  Màu Sắc Nhiều Màu được lựa chọn\r\n-  Hoạ Tiết Hình Gấu Dễ Thương\r\nLƯU Ý : MÁY TÍNH ĐỂ IM TỰ TẮT SAU 5-10PHÚT NHA CÁC BẠN !!!\r\n\r\n-  Phụ kiện Văn phòng phẩm không thể thiếu với các bạn học sinh, sinh viên, công sở trong v', 'sp6.webp', 1000, 'maytinh'),
(103, 'Vở', 'Vở viết kẻ ngang nhiều hình siêu ngộ nghĩnh', '20000', '???????????? SỔ VỞ ĐÁNG YÊU - HỌC TẬP THÊM PHIÊUUUUU ????????????\r\n\r\n✔Size: Khổ A5( 20,7cm * 14cm) gồm 120 trang giấy dày dặn \r\n✔ Chất liệu: giấy chống lóa mắt cao cấp, không gây mỏi mắt khi nhìn lâu\r\n✔Bìa của quyển sổ/vở là bìa giấy cứng cáp, chắc chắn. Đặc biệt được in hình thù siêu dễ thương kết ', '???????????? SỔ VỞ ĐÁNG YÊU - HỌC TẬP THÊM PHIÊUUUUU ????????????\r\n\r\n✔Size: Khổ A5( 20,7cm * 14cm) gồm 120 trang giấy dày dặn \r\n✔ Chất liệu: giấy chống lóa mắt cao cấp, không gây mỏi mắt khi nhìn lâu\r\n✔Bìa của quyển sổ/vở là bìa giấy cứng cáp, chắc chắn. Đặc biệt được in hình thù siêu dễ thương kết ', 'sp10-4.webp', 999, 'Vo'),
(108, 'Vở', 'Sổ tay mini hoạt hình dễ thương Cá Nhân Mini ', '29000', 'Sổ Tay Cá Nhân Mini/ Sổ Noted 32 Trang \r\n\r\n-  Sổ noted có 16 tờ- 32 trang.\r\n-  Kích thước cả bìa : 8.1*10.3cm được làm từ giấy chất lượng, bề mặt mịn, viết êm.\r\n-  Giấy bắt mực tốt, không gây lem, cho chữ viết rõ ràng, đẹp mắt.\r\n-  Sản phẩm phù hợp với nhiều mục đích sử dụng trong lĩnh vực văn phòng', 'Sổ Tay Cá Nhân Mini/ Sổ Noted 32 Trang \r\n\r\n-  Sổ noted có 16 tờ- 32 trang.\r\n-  Kích thước cả bìa : 8.1*10.3cm được làm từ giấy chất lượng, bề mặt mịn, viết êm.\r\n-  Giấy bắt mực tốt, không gây lem, cho chữ viết rõ ràng, đẹp mắt.\r\n-  Sản phẩm phù hợp với nhiều mục đích sử dụng trong lĩnh vực văn phòng', 'sp2.webp', 999, 'Vo'),
(109, 'Hộp', 'Hộp đựng văn phòng phẩm bằng nhựa  tiện dụng', '100000', 'Xuất xứ: Trung Quốc (Xuất xứ)\r\nChất liệu: Nhựa\r\nSố model: 2020082512\r\nLoại sản phẩm: Hộp đựng \r\nKích thước: 14,7cm và 17,4cm\r\nChất liệu: Nhựa\r\nMàu sắc: Trong suốt\r\nGói hàng bao gồm: 1 x Hộp đựng \r\nHỗ trợ dropshipping: có\r\nLoại sản phẩm: Hộp đựng để bàn', 'Xuất xứ: Trung Quốc (Xuất xứ)\r\nChất liệu: Nhựa\r\nSố model: 2020082512\r\nLoại sản phẩm: Hộp đựng \r\nKích thước: 14,7cm và 17,4cm\r\nChất liệu: Nhựa\r\nMàu sắc: Trong suốt\r\nGói hàng bao gồm: 1 x Hộp đựng \r\nHỗ trợ dropshipping: có\r\nLoại sản phẩm: Hộp đựng để bàn', 'sp8-3.webp', 999, 'hop'),
(110, 'Túi', 'Túi đựng đồ dùng văn phòng phẩm bằng nhựa ', '29000', 'Chất liệu: PP\r\nKích thước: 15.8 * 11.5cm\r\nMẫu sản phẩm: HL011\r\n\r\nLưu ý:\r\nSản phẩm có hàng sẵn trong kho (Hỗ trợ thanh toán tiền mặt khi nhận hàng).\r\nSản phẩm được giao từ nước ngoài.\r\nNếu bạn có bất kì vấn đề nào, xin hãy liên hệ với chúng tôi. ', 'Số lượng: 1 Cái\r\nChất liệu: PP\r\nKích thước: 15.8 * 11.5cm\r\nMẫu sản phẩm: HL011\r\n\r\nLưu ý:\r\nSản phẩm có hàng sẵn trong kho (Hỗ trợ thanh toán tiền mặt khi nhận hàng).\r\nSản phẩm được giao từ nước ngoài.\r\nNếu bạn có bất kì vấn đề nào, xin hãy liên hệ với chúng tôi. ', 'sp11-2.webp', 50, 'tui');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_type`
--

CREATE TABLE `product_type` (
  `product_type_name` varchar(250) NOT NULL,
  `product_type_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_type`
--

INSERT INTO `product_type` (`product_type_name`, `product_type_id`) VALUES
('Bìa kẹp', 'biakep'),
('Bút', 'but'),
('Hộp', 'hop'),
('Khác', 'KHAC'),
('Máy tính', 'maytinh'),
('Nhãn dán', 'nhandan'),
('Sổ tay', 'sotay'),
('Túi', 'tui'),
('Vở', 'Vo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profile_user`
--

CREATE TABLE `profile_user` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `profile_user`
--

INSERT INTO `profile_user` (`profile_id`, `user_id`, `date_of_birth`, `gender`, `bio`, `website`, `location`, `created_at`, `updated_at`, `address`, `phone`) VALUES
(4, 14, NULL, NULL, NULL, NULL, NULL, '2024-10-17 14:11:32', '2024-10-17 14:11:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `sale_description` varchar(255) DEFAULT NULL,
  `is_expired` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`sale_id`, `product_id`, `discount_percent`, `start_date`, `end_date`, `sale_description`, `is_expired`) VALUES
(1, 100, 70.00, '2024-01-10', '2024-10-10', '12343', 1),
(4, 99, 50.00, '2024-02-10', '2024-10-10', '0', 1),
(5, 101, 20.00, '2024-02-10', '2024-10-10', '0', 1),
(6, 108, 20.00, '2024-01-10', '2024-10-10', '0', 1),
(7, 109, 20.00, '2024-02-10', '2024-10-10', '0', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `password`, `email`, `role`, `avatar`, `created_at`, `updated_at`, `status`, `last_login`) VALUES
(14, 'admin', 'Nguyễn Bình Dương', '$2y$10$u3C3h0HC9sYFDn8iEgjlO.e6IJi6v6g0yeio1BAy4jmnbVMs1RU02', 'anhtustyle2003@gmail.com', 1, '../Assets/img/index/avatar_671113139c969_admin.png', '2024-10-09 16:41:56', '2024-12-19 12:12:02', 1, '2024-12-19 12:12:02');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_loaisanpham` (`product_type_id`);

--
-- Chỉ mục cho bảng `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Chỉ mục cho bảng `profile_user`
--
ALTER TABLE `profile_user`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `profile_user`
--
ALTER TABLE `profile_user`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_loaisanpham` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`product_type_id`);

--
-- Các ràng buộc cho bảng `profile_user`
--
ALTER TABLE `profile_user`
  ADD CONSTRAINT `profile_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
