-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2020 at 08:34 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_may`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

-- CREATE TABLE `products` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
--   `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `number_product` int(11) NOT NULL,
--   `price` int(11) NOT NULL,
--   `category_id` int(11) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `number_product`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'ชาใบเมี่ยง (Baimiang Tea) 100% Natural Local Product ชาพร้อมชง ตรา ม่อนนางเกตุ', 'สรรพคุณ :\r\nรสชาติเข้มข้น กลิ่นหอมละมุน จากใบชาแท้\r\nยอดใบชา จากต้นชาบนยอดดอยสูง โดยเกตรกรพื้นบ้านที่ดูแลรักษาป่าเขาอันเป็นพื้นที่ต้นน้ำสายสำคัญมาหลายชั่วอายุคนคัดสรรผ่านกระบวนการการผลิตที่ได้คุณภาพ จนมาเป็นชาใบเมี่ยงที่หอมกรุ่นเป็นเอกลักษณ์\r\nส่วนประกอบ : \r\nใบชาแท้ 100%\r\nน้ำหนักสุทธิ 20 กรัม (10ซอง)\r\nราคา 80 บาท/กล่อง\r\nผลิตโดย กลุ่มแม่บ้านปางมะกล้วย  หมู่ที่ 2  ต.ป่าแป๋  อ.แม่แตง  จ.เชียงใหม่ 50150 \r\nTel.096-3543694 , 099-8631442 ,085-7058914', 'XzE1ODcyMDMyMjI=.jpg', 110, 80, 1, '2020-04-18 09:47:02', '2020-04-18 17:01:43'),
(2, 'น้ำยาล้างจานชาเมี่ยงมะนาว', 'สรรพคุณ : ช่วยขจัดคราบไขมันและเศษอาหารได้สะอาดหมดจด อย่างสุขอนามัย น้ำยาล้างจานชาเมี่ยงมะนาว กลิ่นชามะนาว ขจัดคราบมันได้ดียิ่งขึ้น ไร้กลิ่นติดจาน ใส่ใจสิ่งแวดล้อม\r\nส่วนประกอบ : ชาเมี่ยงและมะนาว\r\nราคา 10 บาท/ชวด\r\nผลิตโดย กลุ่มแม่บ้านปางมะกล้วย  หมู่ที่ 2  ต.ป่าแป๋  อ.แม่แตง  จ.เชียงใหม่ 50150 \r\nTel.096-3543694 , 099-8631442 ,085-7058914', 'XzE1ODcyMDM1MTE=.jpg', 20, 10, 2, '2020-04-18 09:51:51', '2020-04-18 09:51:51'),
(3, 'สบู่ชาเมี่ยง (Cha-Miang Soap) 100% Natural Local Product Natural Detox Soap | Protect skin form rash.', 'สรรพคุณ : ลดสิว หน้าใส ไร้ผดผื่น\r\nต้านอนุมูลอิสระ คือความสดชื่นสู่ผิว\r\nลดปัญหาของผิวและสิวอักเสบ ควบคุมความมันบนใบหน้า\r\nส่วนประกอบ : ใบชาเมี่ยงสด 100%\r\nราคา 30 บาท/ก้อน\r\nผลิตโดย กลุ่มแม่บ้านปางมะกล้วย  หมู่ที่ 2  ต.ป่าแป๋  อ.แม่แตง  จ.เชียงใหม่ 50150 \r\nTel.096-3543694 , 099-8631442 ,085-7058914', 'XzE1ODcyMDM3ODc=.jpg', 20, 30, 1, '2020-04-18 09:56:27', '2020-04-18 09:56:27'),
(4, 'ชาเมี่ยงรสมะนาว  (Lemon flavored  Baimiang tea)', 'สรรพคุณ : เป็นเครื่องดื่มที่ดับกระหายคลายร้อนและยังเพิ่มความสดชื่นให้กับร่างกาย รสชาติเข้มข้น กลิ่นหอมละมุน จากใบชาแท้ \r\nส่วนประกอบ : ใบชาเมี่ยงสด ,น้ำมะนาว\r\nราคา 10 บาท/ขวด\r\nผลิตโดย กลุ่มแม่บ้านปางมะกล้วย  หมู่ที่ 2  ต.ป่าแป๋  อ.แม่แตง  จ.เชียงใหม่ 50150 \r\nTel.096-3543694 , 099-8631442 ,085-7058914', 'XzE1ODcyMDM4ODU=.jpg', 50, 10, 1, '2020-04-18 09:58:05', '2020-04-18 17:01:36'),
(5, 'หมอนใบชาเมี่ยง  (Cha-Miang pillow)', 'รายละเอียด : มีหลายแบบ หลายขนาดให้เลือก\r\nหมอนใบใหญ่: ใช้หนุนนอนเพื่อความผ่อนคลาย และแก้อากาศอับชื้น\r\nหมอนในเล็ก : ใช้ดูดกลิ่นอับในหลายๆที่เช่นในรถ ในตู้เสื้อผ้า\r\nราคา  แล้วแต่ขนาด\r\nผลิตโดย กลุ่มแม่บ้านปางมะกล้วย  หมู่ที่ 2  ต.ป่าแป๋  อ.แม่แตง  จ.เชียงใหม่ 50150 \r\nTel.096-3543694 , 099-8631442 ,085-7058914', 'XzE1ODcyMDQwMDQ=.jpg', 50, 5090, 1, '2020-04-18 10:00:04', '2020-04-18 10:00:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
