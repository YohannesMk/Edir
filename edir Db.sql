-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 10:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edir`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(40) NOT NULL,
  `user_id` int(40) NOT NULL,
  `item_id` int(40) NOT NULL,
  `quantity` varchar(30) NOT NULL,
  `date_start` date NOT NULL,
  `date_return` date NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`, `date_start`, `date_return`, `date_updated`) VALUES
(21, 19, 1, '1', '0000-00-00', '0000-00-00', '2022-06-08 22:45:03'),
(22, 19, 14, '1', '0000-00-00', '0000-00-00', '2022-06-08 22:48:38'),
(23, 19, 17, '200', '0000-00-00', '0000-00-00', '2022-06-08 22:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` varchar(200) NOT NULL,
  `date_submited` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`, `date_submited`) VALUES
(1000, 'Yohannes', 'yohannesmengistu1@gmail.com', 'Acknowledging Edir Admins', 'juhygtfrd', 2147483647),
(1002, 'Yohannes', 'yohannesmengistu1@gmail.com', 'Acknowledging Edir Admins', 'Thank YOU for your good management!', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `eventpost`
--

CREATE TABLE `eventpost` (
  `user_id` int(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `eventType` varchar(20) NOT NULL,
  `eventDescription` varchar(150) NOT NULL,
  `filename` varchar(40) DEFAULT NULL,
  `doe` date NOT NULL,
  `date_updated` date NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventpost`
--

INSERT INTO `eventpost` (`user_id`, `title`, `eventType`, `eventDescription`, `filename`, `doe`, `date_updated`, `slug`) VALUES
(19, 'Baptism of my newbor', 'Other', 'Baptism of my new born baby, Rodas, will be celebrated on June 11, 2022 GC at my house. Everyone is invited!', 'baptism2.jpg', '2022-07-30', '2022-06-08', 'Other-Baptism-of-my-newborn-ch'),
(16, 'House Warming Party', 'Other', 'Every Edir member is invited to my house warming party on July 22, 2022 at 7:00pm at my new house.. Address: Bole Michael in front of Leza Bakery.', 'house.jpg', '2022-06-22', '2022-06-08', 'Other-House-Warming-Party-2022'),
(19, 'Mels Yoseph and Bete', 'Wedding', 'The whole Edir members are invited to the Mels ceremony of my sister Betelhem and Yoseph. Please download the invitation image attached on the image s', 'mels invitation.avif', '2022-06-12', '2022-06-08', 'Wedding-Mels-ceremony-of-Hiwot');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `rental_id` int(30) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `payCode` varchar(40) NOT NULL,
  `date_purchase` date NOT NULL DEFAULT current_timestamp(),
  `bankAcc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`rental_id`, `cart_id`, `fName`, `lName`, `payCode`, `date_purchase`, `bankAcc`) VALUES
(4, 21, 'Yohannes', 'Mengistu', '202020', '2022-06-08', '1000682325546'),
(5, 22, 'Yohannes', 'Mengistu', '202020', '2022-06-08', '1000682325546'),
(6, 23, 'Yohannes', 'Mengistu', '202020', '2022-06-08', '1000682325546');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `item_id` int(11) NOT NULL,
  `itemName` varchar(20) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `filename` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`item_id`, `itemName`, `description`, `filename`, `quantity`, `price`, `date_updated`) VALUES
(1, 'Traditional Denkuan', 'rentable edir denkuan regarding any ceremony such as funeral, wedding and graduation.\r\n!!you can only rent 1 at a time.', 'tent traditional.jpg', 1, '1400', '2022-04-15'),
(13, 'Modern Denkuan', 'Modern Cottage (Dinkuan) for rent for any ceremony such as funeral, wedding and graduation.', 'tent.jpg', 3, '1400', '0000-00-00'),
(14, 'Modern Denkuan', 'Modern Cottage (Dinkuan) for rent for any ceremony such as funeral, wedding and graduation.', 'tent.jpg', 2, '1400', '0000-00-00'),
(15, 'Modern Denkuan', 'Can hold up to 350 people', 'dinkuan.jpg', 1, '5000', '0000-00-00'),
(16, 'Modern Denkuan 10*10', 'Can hold up to 150 People.', 'tent 10x10.jpg', 1, '1500', '0000-00-00'),
(17, 'Ceramic Dish', 'Ceramic Plates for rent. Should be returned cleaned and un-cracked.', 'plate ceramic.webp', 300, '10', '0000-00-00'),
(18, 'Plastic Dish', 'Plastic Dishes for rent. Dishes should be returned cleaned and without any damage.', 'dishes plastic.jpg', 1000, '5', '0000-00-00'),
(19, 'Traditional Tent', 'Rentable edir denkuan regarding any ceremony such as funeral, wedding and graduation.\r\n! For one ceremony only.', 'tent traditional.jpg', 2, '800', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `title` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `filename` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`title`, `category`, `content`, `date_updated`, `filename`, `slug`) VALUES
('another title', 'funeral', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham..', '2022-05-29 00:00:00', 'search1.png', ''),
('another title', 'wedding', 'some title description and added this text', '2022-05-29 00:00:00', 'ukraine.png', 'another-title-2022-05-29'),
('Funeral of Capitain Yared Mulugeta', 'funeral', 'The sky was the limit, literally, for Yared Mulegeta when the Ethiopian Airlines flight ET 302 he was captaining crashed, killing all the 157 people on board.\r\n\r\nYareds family, reeling from the excruciating pain of his untimely demise, described him as ferociously ambitious, stellar and brilliant.\r\n\r\nHe became senior captain of the Ethiopian airlines at a young age of 29. True to his love for the job, Yared met his end in the line of duty.', '2022-06-06 02:52:14', 'funeral6.jpeg', 'Funeral-of-Capitain-Yared-Mulugeta-2022-06-06'),
('Graduation Ceremony of Dr. Tewodros Adhanom', 'Graduation', 'Doctor Tewodros Adhanom graduated from Addis Ababa University with the field of Medicine. The graduation ceremony was held on Jun 5, 2022 G.C. at his own house. We wish to do more to serve our country though his career.', '2022-06-06 10:46:51', 'graduation3.jpg', 'Graduation-Ceremony-of-Dr-Tewodros-Adhanom-2022-06-06'),
('Home Warming Ceremony', 'Home Warming', 'Ato Kebedes House Warming celebration was held on June 1, 2022 G. C. Their new house is found 2 blocks away from their previous house, in front of Leza Bakery. የዓለም ቤት ይሁን!\r\n', '2022-06-06 11:20:03', 'house.jpg', 'Home-Warming-Ceremony-2022-06-06'),
('Mels Ceremony of Dagim Efrem and Tinbit Abrham', 'Wedding', 'Mels Ceremony of Dagim Efrem and Tinbit Abrham was held at Dima Traditional Restaurant on June 05, 2022 G.C. We wish you a happy and joyful life!', '2022-06-06 11:32:09', 'serg.jpg', 'Mels-Ceremony-of-Dagim-Efrem-and-Tinbit-Abrham-2022-06-06'),
('Monthy Edir Buna Ceremony', 'Buna Ceremony', 'The Edir Monthly Coffee ceremony was held on Sunday May 6, 2022 starting from 3:00 pm. During the ceremony, new Edir members were welcomed and introduced. We hope that everyone have enjoyed the ceremony!', '2022-06-06 11:29:01', 'buna.jpg', 'Monthy-Edir-Buna-Ceremony-2022-06-06'),
('Selam Meredaja Edir Annual Meeting', 'Meeting', 'The Edir Annual Meeting was held on June 23, 2022 where the members discussed on different agendas to promote and develop the edir system and specially on the ways in which more members can join the edir. In addition to this the members have also chosen Ato Fraol Alemu as the Edir General Manager.', '2022-06-06 03:04:30', 'meeting.jpg.opdownload', 'Selam-Meredaja-Edir-Annual-Meeting-2022-06-06'),
('Zekaryas and Selams Wedding', 'wedding', '\r\nMemorable wedding occasion of Engineer Zekaryas Tesfaye and Engineer Selam Yosef at Totot Traditional Restaurant, Addis Ababa.\r\nDate: April 24, 2022 G. C.\r\nEvent Organizers: Ato Yosef Belachew and Woyzero Meaza Tadesse', '2022-06-06 02:39:36', 'serg2.jpg', 'Zekaryas-and-Selams-Wedding-2022-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(7) NOT NULL,
  `address` varchar(10) NOT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `phoneNo` int(14) NOT NULL,
  `houseNum` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_joined` date NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fName`, `lName`, `dob`, `gender`, `address`, `profile`, `phoneNo`, `houseNum`, `email`, `password`, `date_joined`, `is_active`, `is_admin`) VALUES
(1, 'Robera', 'Endale', '2001-06-06', 'Male', 'Bishoftu', 'arts.jpg', 900545497, 741, 'robenend@gmail.com', 'd7571ec69ed9edd3dce14755f92cb381', '2022-06-06', 1, 0),
(2, 'Selam', 'Yosef', '2002-05-06', 'Female', 'Asko', 'Selam.jpg', 939459214, 963, 'selamyoseph@gmail.com', 'd960d7816d2ba5eb70a4f68d4ac6e028', '2022-06-06', 1, 0),
(16, 'Zekaryas', 'Tesfaye', '2000-06-16', 'Male', 'Mebrathayl', 'zac.jpg', 966012486, 520, 'zac123@gmail.com', '2df9bea797d2ba599ea64ddeba0e36a8', '2022-06-06', 1, 1),
(19, 'Yohannes', 'Mengistu', '2000-09-11', 'Male', 'Alemgena', 'yohannes.jpg', 911428051, 956, 'yohannesmengistu1@gmail.com', '8b45b945061f7a398c7cb3705d4c5a7a', '2022-06-08', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'robera', 'robenend@gmail.com', '123456', ''),
(2, 'robera', 'robenend@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '2022-04-17.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `rented_user` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `eventpost`
--
ALTER TABLE `eventpost`
  ADD PRIMARY KEY (`slug`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `posted_by` (`user_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `rented_item` (`cart_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`slug`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `rental_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `item_id` FOREIGN KEY (`item_id`) REFERENCES `service` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rented_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eventpost`
--
ALTER TABLE `eventpost`
  ADD CONSTRAINT `posted_by` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchased_item` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rented_item` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
