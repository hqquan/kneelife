-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 13, 2024 lúc 09:19 AM
-- Phiên bản máy phục vụ: 8.0.21
-- Phiên bản PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kneelife`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `categoryImage` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `orderTime` datetime NOT NULL,
  `orderStatus` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `orderPayment` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `orderCode` int NOT NULL,
  `orderTotal` float NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `FK_ToUser` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_detail`
--

DROP TABLE IF EXISTS `tbl_order_detail`;
CREATE TABLE IF NOT EXISTS `tbl_order_detail` (
  `orderDetailId` int NOT NULL AUTO_INCREMENT,
  `orderId` int NOT NULL,
  `productId` int NOT NULL,
  `orderCode` int NOT NULL,
  `productNote` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `productQuantity` int NOT NULL,
  PRIMARY KEY (`orderDetailId`),
  KEY `FK_ToOrder` (`orderId`),
  KEY `FK_ToProduct` (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `productPrice` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `productGroup` int NOT NULL,
  `productDescribe` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `productImage` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `FK_ToCategory` (`productGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `userPhone` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `userEmail` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `userPassword` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `userRegisterDate` date NOT NULL,
  `userGroup` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `userName`, `userPhone`, `userEmail`, `userPassword`, `userRegisterDate`, `userGroup`) VALUES
(1, 'admin', '0123456789', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2024-04-13', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user_info`
--

DROP TABLE IF EXISTS `tbl_user_info`;
CREATE TABLE IF NOT EXISTS `tbl_user_info` (
  `userInfoId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `userStreetAddress` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `userOptional` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `userCity` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`userInfoId`),
  KEY `FK_ToUser` (`userId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `FK_ToUser` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `FK_ToOrder` FOREIGN KEY (`orderId`) REFERENCES `tbl_order` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ToProduct` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `FK_ToCategory` FOREIGN KEY (`productGroup`) REFERENCES `tbl_category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD CONSTRAINT `FK_UserId` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
