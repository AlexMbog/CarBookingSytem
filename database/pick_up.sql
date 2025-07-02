-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 03:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pick_up`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `Booking_id` int(11) NOT NULL,
  `booking_user_id` int(11) NOT NULL,
  `Booking_matatu_id` int(11) DEFAULT NULL,
  `booking_num_seats` int(11) DEFAULT NULL,
  `booking_passenger_name` varchar(255) DEFAULT NULL,
  `booking_contact_number` varchar(255) DEFAULT NULL,
  `booking_share_location` tinyint(1) DEFAULT NULL,
  `booking_location` varchar(1000) DEFAULT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_payment_status` tinyint(1) DEFAULT 0,
  `booking_destination` varchar(255) DEFAULT NULL,
  `booking_destination_lat` decimal(10,8) DEFAULT NULL,
  `booking_destination_lng` decimal(11,8) DEFAULT NULL,
  `booking_sacco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`Booking_id`, `booking_user_id`, `Booking_matatu_id`, `booking_num_seats`, `booking_passenger_name`, `booking_contact_number`, `booking_share_location`, `booking_location`, `booking_time`, `booking_payment_status`, `booking_destination`, `booking_destination_lat`, `booking_destination_lng`, `booking_sacco_id`) VALUES
(14, 2, 9, 2, 'martin', ' 0791938474', 1, 'VM28+5PH, Riara Ridge, Kenya', '2024-03-28 16:18:26', 0, 'nairobi', NULL, NULL, NULL),
(53, 2, 9, 2, ' Alex', ' 0791938474', 1, 'VM28+HF8, Riara Ridge, Kenya', '2024-04-22 12:35:42', 0, 'ruaka', NULL, NULL, NULL),
(54, 2, 9, 2, ' Alex Njiru', ' 0791938474', 1, '-1.1482319, 36.6633494', '2024-04-27 09:12:56', 0, 'Nairobi ', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `Driver_ID` int(11) NOT NULL,
  `Driver_Sacco_ID` int(11) NOT NULL,
  `Driver_Name` varchar(255) NOT NULL,
  `Driver_License_Number` varchar(20) DEFAULT NULL,
  `Driver_Contact_Number` varchar(20) DEFAULT NULL,
  `Driver_Email_Address` varchar(255) DEFAULT NULL,
  `Driver_Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`Driver_ID`, `Driver_Sacco_ID`, `Driver_Name`, `Driver_License_Number`, `Driver_Contact_Number`, `Driver_Email_Address`, `Driver_Address`) VALUES
(9, 1, 'James Mwangi', '2345', '0756535474', 'martinN@gmail.com', 'null'),
(10, 1, 'kevin musila', '2321', '0756535474', 'kevn@gmail.com', 'null'),
(11, 2, 'walter kang&#039;ethe', '2321', '0756535474', 'walterN@gmail.com', 'null'),
(12, 2, 'James Mwangi', '2345', '0756535474', 'martinNn@gmail.com', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `hires`
--

CREATE TABLE `hires` (
  `hire_id` int(11) NOT NULL,
  `hire_user_id` int(11) DEFAULT NULL,
  `hire_start_date` date NOT NULL,
  `hire_end_date` date NOT NULL,
  `hire_location` varchar(255) NOT NULL,
  `hire_num_matatus` int(11) NOT NULL,
  `hire_occasion` varchar(255) NOT NULL,
  `hire_approval_status` enum('pending','verified','rejected') DEFAULT 'pending',
  `hire_cost` decimal(10,2) NOT NULL,
  `sacco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hires`
--

INSERT INTO `hires` (`hire_id`, `hire_user_id`, `hire_start_date`, `hire_end_date`, `hire_location`, `hire_num_matatus`, `hire_occasion`, `hire_approval_status`, `hire_cost`, `sacco_id`) VALUES
(1, 2, '2024-04-04', '2024-04-06', 'limuru, thandi road', 2, 'wedding', 'rejected', 0.00, NULL),
(2, 2, '2024-04-21', '2024-04-17', 'limuru, thandi road', 4, 'wedding', 'pending', 0.00, 1),
(3, 2, '2024-04-18', '2024-04-24', 'limuru, thandi road', 3, 'wedding', 'pending', 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matatu`
--

CREATE TABLE `matatu` (
  `Matatu_ID` int(11) NOT NULL,
  `matatu_sacco_id` int(11) NOT NULL,
  `Matatu_Driver_ID` int(11) NOT NULL,
  `Matatu_Number` varchar(255) NOT NULL,
  `Matatu_Number_Plates` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matatu`
--

INSERT INTO `matatu` (`Matatu_ID`, `matatu_sacco_id`, `Matatu_Driver_ID`, `Matatu_Number`, `Matatu_Number_Plates`) VALUES
(9, 1, 9, '4', 'kbc 1123t'),
(10, 1, 10, '5', 'kbl 344B'),
(11, 2, 11, '1', 'kbx 1123k'),
(12, 2, 12, '6', 'kbx 1123u');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_type` enum('Booking','Hiring','Renting') NOT NULL,
  `payment_reference_id` int(11) NOT NULL,
  `payment_user_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `payment_method` enum('Credit Card','Debit Card','PayPal','Cash','Other') NOT NULL,
  `payment_transaction_id` varchar(50) DEFAULT NULL,
  `payment_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `rental_user_id` int(11) DEFAULT NULL,
  `rental_start_date` date NOT NULL,
  `rental_end_date` date NOT NULL,
  `rental_location` varchar(255) NOT NULL,
  `rental_num_matatus` int(11) NOT NULL,
  `rental_fee` decimal(10,2) NOT NULL,
  `rental_approval_status` enum('pending','verified','rejected') DEFAULT 'pending',
  `rental_sacco_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `rental_user_id`, `rental_start_date`, `rental_end_date`, `rental_location`, `rental_num_matatus`, `rental_fee`, `rental_approval_status`, `rental_sacco_id`) VALUES
(5, 2, '2024-04-04', '2024-04-11', 'limuru, thandi road', 3, 0.00, 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_Start_Location` varchar(255) DEFAULT NULL,
  `route_End_Location` varchar(255) DEFAULT NULL,
  `route_Estimated_Time_In_MINUTES` time DEFAULT NULL,
  `route_waypoints` varchar(255) DEFAULT NULL,
  `route_matatu_id` int(11) NOT NULL,
  `route_sacco_id` int(11) NOT NULL,
  `route_Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_Start_Location`, `route_End_Location`, `route_Estimated_Time_In_MINUTES`, `route_waypoints`, `route_matatu_id`, `route_sacco_id`, `route_Price`) VALUES
(7, 'limuru', 'Nairobi', '00:45:00', 'bypass 114', 9, 1, 150.00),
(10, 'limuru', 'Ruaka', '00:30:00', 'bypass 114', 12, 2, 70.00);

-- --------------------------------------------------------

--
-- Table structure for table `saccos`
--

CREATE TABLE `saccos` (
  `Sacco_ID` int(11) NOT NULL,
  `Sacco_Name` varchar(255) NOT NULL,
  `sacco_Registration_Number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saccos`
--

INSERT INTO `saccos` (`Sacco_ID`, `Sacco_Name`, `sacco_Registration_Number`) VALUES
(1, 'Likana', 'Ad_4333'),
(2, 'lingana', 'Ad_50332'),
(3, 'wengine', 'Ad_501222'),
(4, '2nk', 'AD_50144');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_Name` varchar(255) NOT NULL,
  `User_Email` varchar(255) DEFAULT NULL,
  `User_Password_Hash` varchar(255) DEFAULT NULL,
  `User_Phone_Number` varchar(20) DEFAULT NULL,
  `User_Gender` varchar(10) DEFAULT NULL,
  `User_Role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_Name`, `User_Email`, `User_Password_Hash`, `User_Phone_Number`, `User_Gender`, `User_Role`) VALUES
(2, 'Alex', 'BSCLMR110122@spu.ac.ke', '$2y$10$ywX2SXhVnRgk6NKH/ID0Ee.NgkZLY3SeFdqkcZLd8Dw/eJ3ro/5T6', '0791938474', 'female', 'user'),
(8, 'Admin', 'admin@gmail.com', '$2y$10$QO8T0CYljn99ssT6aRJV0uCOyse6clGCLZZNqdDQbr78otVhGbr/W', '0791938474', 'male', 'admin'),
(9, 'mary', 'mary@gmail.com', '$2y$10$hMt0WMBd/71lYlTmF7xaYeGqZszpZPQNJe2ucy.ML9LTSHnQ/dH1u', '0791938474', 'female', 'user'),
(10, 'mwas', 'mwas5@gmail.com', '$2y$10$2imU20UMgroFz10mY7tquuNst1wngoO0tNW7LfKrbVqUSPsba91tq', '0791938474', 'male', 'user'),
(11, 'martin', 'martin@gmail.com', '$2y$10$TW.jj5S8NS4jfieybbDKEuGf6eoHdKfbGVfkUHHvYnZL/Obh46TTi', '0791938474', 'male', 'user'),
(12, 'Ashley Otieno', 'Otis@gmail.com', '$2y$10$jHAYEsc7Qr36lCw2vUkp.OiBQKdRPLeQAzd3iCBfeRZNt/BWBctxe', '0791938657', 'female', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`Booking_id`),
  ADD KEY `User_ID` (`booking_user_id`),
  ADD KEY `matatu_id` (`Booking_matatu_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`Driver_ID`),
  ADD KEY `Sacco_ID` (`Driver_Sacco_ID`);

--
-- Indexes for table `hires`
--
ALTER TABLE `hires`
  ADD PRIMARY KEY (`hire_id`),
  ADD KEY `hire_user_id` (`hire_user_id`),
  ADD KEY `fk_sacco_id` (`sacco_id`);

--
-- Indexes for table `matatu`
--
ALTER TABLE `matatu`
  ADD PRIMARY KEY (`Matatu_ID`),
  ADD KEY `Sacco_ID` (`matatu_sacco_id`),
  ADD KEY `Driver_ID` (`Matatu_Driver_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_user_id` (`payment_user_id`),
  ADD KEY `payment_reference_id` (`payment_reference_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `rental_user_id` (`rental_user_id`),
  ADD KEY `fk_rental_sacco_id` (`rental_sacco_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `fk_routes_matatu` (`route_matatu_id`),
  ADD KEY `fk_routes_sacco` (`route_sacco_id`);

--
-- Indexes for table `saccos`
--
ALTER TABLE `saccos`
  ADD PRIMARY KEY (`Sacco_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `Booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `Driver_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hires`
--
ALTER TABLE `hires`
  MODIFY `hire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `matatu`
--
ALTER TABLE `matatu`
  MODIFY `Matatu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `saccos`
--
ALTER TABLE `saccos`
  MODIFY `Sacco_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`booking_user_id`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`Booking_matatu_id`) REFERENCES `matatu` (`Matatu_ID`);

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`Driver_Sacco_ID`) REFERENCES `saccos` (`Sacco_ID`);

--
-- Constraints for table `hires`
--
ALTER TABLE `hires`
  ADD CONSTRAINT `fk_sacco_id` FOREIGN KEY (`sacco_id`) REFERENCES `saccos` (`Sacco_ID`),
  ADD CONSTRAINT `hires_ibfk_1` FOREIGN KEY (`hire_user_id`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `matatu`
--
ALTER TABLE `matatu`
  ADD CONSTRAINT `matatu_ibfk_1` FOREIGN KEY (`matatu_sacco_id`) REFERENCES `saccos` (`Sacco_ID`),
  ADD CONSTRAINT `matatu_ibfk_2` FOREIGN KEY (`Matatu_Driver_ID`) REFERENCES `drivers` (`Driver_ID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`payment_user_id`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`payment_reference_id`) REFERENCES `bookings` (`Booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`payment_reference_id`) REFERENCES `hires` (`hire_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`payment_reference_id`) REFERENCES `rentals` (`rental_id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `fk_rental_sacco_id` FOREIGN KEY (`rental_sacco_id`) REFERENCES `saccos` (`Sacco_ID`),
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`rental_user_id`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `fk_routes_matatu` FOREIGN KEY (`route_matatu_id`) REFERENCES `matatu` (`Matatu_ID`),
  ADD CONSTRAINT `fk_routes_sacco` FOREIGN KEY (`route_sacco_id`) REFERENCES `saccos` (`Sacco_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
