-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 11, 2023 lúc 05:40 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project_k71`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cau_hoi`
--

CREATE TABLE `cau_hoi` (
  `id_ch` int(50) NOT NULL,
  `ten_ch` varchar(255) NOT NULL,
  `anh_ch` varchar(255) DEFAULT NULL,
  `dapan_ch` varchar(255) NOT NULL,
  `id_khoa` int(50) NOT NULL,
  `nguoi_them` varchar(255) NOT NULL,
  `trang_thai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cau_hoi`
--

INSERT INTO `cau_hoi` (`id_ch`, `ten_ch`, `anh_ch`, `dapan_ch`, `id_khoa`, `nguoi_them`, `trang_thai`) VALUES
(21, '25 * 3 = ?', '', '75', 24, 'tk1', 'Chưa duyệt'),
(22, 'Tôi tên là?', 'Take this.jpg', 'Na', 25, 'tk1', 'Chưa duyệt'),
(23, '3 + 3 = ? ', '', '6', 23, 'tk2', 'Đã duyệt'),
(27, 'Xin chào', '', 'Hello', 25, 'admin', 'Chưa Duyệt'),
(29, 'hi', '', 'hi', 24, 'tk1', 'Chưa Duyệt'),
(30, 'Sau khi màn hình chính của game hiện ra, giáo viên bảo học sinh lấy mã Pin trên màn hình để đăng nhập Kahoot', '', 'ok', 25, 'admin', 'Chưa Duyệt'),
(32, '34', '', '34', 23, 'admin', 'Đã Duyệt');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD PRIMARY KEY (`id_ch`),
  ADD KEY `rang_buoc_khoa` (`id_khoa`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  MODIFY `id_ch` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD CONSTRAINT `rang_buoc_khoa` FOREIGN KEY (`id_khoa`) REFERENCES `khoa` (`id_khoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
