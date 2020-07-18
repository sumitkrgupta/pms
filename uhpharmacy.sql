-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2020 at 01:57 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uhpharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` varchar(30) NOT NULL,
  `doctor_name` varchar(30) NOT NULL,
  `Join_date` date NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_name`, `Join_date`, `address`, `gender`) VALUES
('11', 'Dr. kohli', '2020-04-13', 'UOH', 'Male'),
('14', 'Dr.Dev', '2020-04-17', 'UH', 'male'),
('20', 'Dr.Dev', '2020-05-13', 'Delhi', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `drug_name_id` int(11) NOT NULL,
  `drug_name` varchar(50) NOT NULL,
  `drug_categories` varchar(20) DEFAULT NULL,
  `drug_description` text DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `batch_no` varchar(30) NOT NULL,
  `drug_type` varchar(20) DEFAULT NULL,
  `mfd_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `power_ml` varchar(20) NOT NULL,
  `drug_location` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drug_name_id`, `drug_name`, `drug_categories`, `drug_description`, `company_id`, `batch_no`, `drug_type`, `mfd_date`, `exp_date`, `power_ml`, `drug_location`, `quantity`) VALUES
(11, 'Amox ', 'Genric', 'Good', 1, 'B1', 'tab', '2019-04-20', '2021-06-05', '100MG', 'L1', 0),
(12, 'Paracitamol ', 'Branded ', 'Smile', 4, 'B2', 'Capsul', '2019-05-05', '2021-05-04', '150MG', 'L2', 50),
(13, 'Amox  ', 'Genric ', 'Yes', 2, 'B3', 'Tablet', '2019-06-20', '2022-04-02', '200MG', 'L2', 28),
(14, 'Amox  ', 'Genric ', 'e', 4, 'AF', 'Tablet', '2018-01-01', '2023-06-05', '200MG', 'L2', 38),
(15, 'Cefpodoxime ', 'Genric ', 'Drug', 2, 'B10', 'Tablet', '2020-04-14', '2020-05-05', '100MG', 'L3', 100),
(16, 'Dextrose ', 'Branded ', 'Msg', 3, 'B14', 'Capsul', '2020-04-12', '2020-05-08', '50MG', 'L2', 50),
(17, 'Cetrogen ', 'Genric ', 'Ok', 3, 'B21', 'Capsul', '2020-01-29', '2020-05-14', '150MG', 'L1', 100),
(18, 'Paracitamol  ', 'Genric ', 'K', 2, 'B50', 'Capsul', '2020-05-12', '2020-07-13', '100Mg', 'L4', 39);

-- --------------------------------------------------------

--
-- Table structure for table `drug_company`
--

CREATE TABLE `drug_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `record_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drug_company`
--

INSERT INTO `drug_company` (`company_id`, `company_name`, `record_date`) VALUES
(1, 'fin land', '2020-02-10'),
(2, 'US', '2020-04-04'),
(3, 'Usmani', '2020-02-05'),
(4, 'Sine', '2020-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `reg_id` varchar(30) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `join_date` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`reg_id`, `fullname`, `phone`, `gender`, `password`, `role`, `join_date`, `address`) VALUES
('17MCMC28', 'Alok', '1414141414', 'male', '12345', 'Student', '2020-02-04', 'UOH'),
('17MCMC50', 'Sumit', '1212121212', 'male', '12345', 'admin', '2020-02-10', 'Gachibwoli'),
('17MCMC64', 'Rana', '1111111111', 'Male', '12345', 'Student', '2020-04-17', 'UH');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier_id` int(11) NOT NULL,
  `reg_id` varchar(30) NOT NULL,
  `supplier_contact_person` varchar(20) NOT NULL,
  `orders_invoice_no` varchar(30) NOT NULL,
  `orders_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_date`, `supplier_id`, `reg_id`, `supplier_contact_person`, `orders_invoice_no`, `orders_status`) VALUES
(85, '2020-04-23 18:30:00', 2, '17MCMC50', 'sumit', 'HCU-24023634', 0),
(86, '2020-04-24 18:30:00', 4, '17MCMC50', 'Amit', 'HCU-24031801', 0),
(87, '2020-04-25 18:30:00', 3, '17MCMC50', 'UOH', 'HCU-26025033', 0),
(88, '2020-04-25 18:30:00', 3, '17MCMC50', 'UOH', 'HCU-26025103', 0),
(89, '2020-04-26 18:30:00', 2, '17MCMC50', 'Sachin', 'HCU-26031508', 0),
(90, '2020-04-26 18:30:00', 4, '17MCMC50', 'Virat', 'HCU-26031812', 0),
(91, '2020-04-11 18:30:00', 4, '17MCMC50', 'sk', 'HCU-26044700', 0),
(92, '2020-04-11 18:30:00', 4, '17MCMC50', 'sk', 'HCU-26044700', 0),
(93, '2020-05-14 11:42:43', 5, '17MCMC50', 'ss', 'HCU-26045457', 1),
(94, '2019-05-11 18:30:00', 3, '17MCMC50', 'ssee', 'HCU-26045624', 0),
(95, '2020-04-22 18:30:00', 3, '17MCMC50', 'ss', 'HCU-26045715', 0),
(96, '2011-01-31 18:30:00', 4, '17MCMC50', 'hh', 'HCU-26045827', 0),
(97, '2020-04-11 18:30:00', 4, '17MCMC50', 'kk', 'HCU-26050156', 0),
(98, '2020-01-30 18:30:00', 4, '17MCMC50', 'gfg', 'HCU-26050515', 0),
(99, '2020-04-22 18:30:00', 4, '17MCMC50', 'jj', '', 0),
(101, '2020-04-11 18:30:00', 2, '17MCMC50', 'ddd', '', 0),
(102, '2000-12-31 18:30:00', 3, '17MCMC50', 'sd', 'HCU-26051606', 0),
(103, '2020-05-04 18:30:00', 4, '17MCMC50', '2', 'HCU-26051854', 0),
(104, '2020-05-11 18:30:00', 4, '17MCMC50', 'mm', 'HCU-26052701', 0),
(105, '2020-05-08 18:30:00', 3, '17MCMC50', 'Sandeep', 'HCU-09042238', 0),
(106, '2020-05-07 18:30:00', 5, '17MCMC50', 'Uh', 'HCU-09100200', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `orders_item_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `drug_type` varchar(20) NOT NULL,
  `drug_power` varchar(30) NOT NULL,
  `orders_quantity` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `drug_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`orders_item_id`, `orders_id`, `drug_type`, `drug_power`, `orders_quantity`, `company_id`, `drug_name`) VALUES
(44, 85, 'tab', '150MG', 20, 4, 'Amox'),
(45, 85, 'cap', '100MG', 50, 3, 'Paracitamol'),
(46, 86, 'Tablet', '200MG', 100, 2, 'Amox'),
(47, 87, 'Capsul', '200MG', 30, 4, 'Hydroxy'),
(48, 88, 'Capsul', '200MG', 30, 4, 'Hydroxy'),
(49, 89, 'Capsul', '100MG', 30, 3, 'Cloroquine'),
(50, 90, 'Capsul', '50MG', 10, 2, 'HydroxyChloro'),
(51, 91, 'Drop', '10MG', 100, 2, 'Para'),
(52, 92, 'Drop', '10MG', 100, 2, 'Para'),
(53, 93, 'Syrup', '1', 10, 2, 'ss'),
(54, 94, 'Capsul', '4', 10, 3, 'eeee'),
(55, 95, 'Capsul', '1', 1, 1, 'fff'),
(56, 96, 'Drop', '1', 10, 1, 'fff'),
(57, 97, 'Syrup', '1', 1, 1, 'kkk'),
(58, 98, 'Drop', '11', 11, 2, 'fzxd'),
(59, 102, 'Syrup', '2', 2, 2, 'ddd'),
(60, 103, 'Capsul', '44', 44, 1, 'jjj'),
(61, 104, 'Syrup', '1', 1, 2, 'mm'),
(62, 105, 'Tablet', '100MG', 100, 2, 'Cefpodoxime'),
(63, 105, 'Capsul', '50', 50, 3, 'Dextrose'),
(64, 106, 'Capsul', '150MG', 100, 3, 'Cetrogen');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `p_reg_id` varchar(30) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `category` varchar(10) DEFAULT NULL,
  `hostel_name` varchar(10) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `record_date` date NOT NULL,
  `reg_id` varchar(20) NOT NULL,
  `gender` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_reg_id`, `p_name`, `category`, `hostel_name`, `mobile`, `record_date`, `reg_id`, `gender`) VALUES
('17MCMC40', 'Gain', 'Student', 'I', '8888888888', '2020-04-24', '17MCMC28', 'Male'),
('17MCMC41', 'Tapaj', 'Student', 'B', '8888888888', '2020-05-13', '17MCMC28', 'Male'),
('17MCMC64', 'Shubham Rana', 'Student', 'B', '8888888888', '2020-05-13', '17MCMC28', 'Male'),
('17MCMT47', 'Shubham Goal', 'Student', 'H', '8888888888', '2020-04-24', '17MCMC28', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `prescribe`
--

CREATE TABLE `prescribe` (
  `prescribe_id` int(11) NOT NULL,
  `p_reg_id` varchar(30) NOT NULL,
  `doctor_id` varchar(30) NOT NULL,
  `prescribe_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reg_id` varchar(30) DEFAULT NULL,
  `patient_invoice_no` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescribe`
--

INSERT INTO `prescribe` (`prescribe_id`, `p_reg_id`, `doctor_id`, `prescribe_date`, `reg_id`, `patient_invoice_no`) VALUES
(20, '17mcmc40', '11', '2020-05-12 18:30:00', '17MCMC28', ''),
(21, '17mcmc40', '11', '2020-05-12 18:30:00', '17MCMC28', ''),
(22, '17mcmc40', '14', '2020-05-12 18:30:00', '17MCMC28', 'HCUP-13115631'),
(29, '17mcmc40', '14', '2020-05-12 18:30:00', '17MCMC28', 'HCUP-13123721'),
(30, '17mcmc64', '11', '2020-05-13 18:30:00', '17MCMC28', 'HCUP-14014353'),
(31, '17mcmc64', '11', '2020-05-13 18:30:00', '17MCMC28', 'HCUP-14094431'),
(32, '17mcmc64', '11', '2020-05-13 18:30:00', '17MCMC28', 'HCUP-14094508');

-- --------------------------------------------------------

--
-- Table structure for table `prescribe_item`
--

CREATE TABLE `prescribe_item` (
  `prescribe_item_id` int(11) NOT NULL,
  `drug_name_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `prescribe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescribe_item`
--

INSERT INTO `prescribe_item` (`prescribe_item_id`, `drug_name_id`, `quantity`, `prescribe_id`) VALUES
(19, 13, 1, 20),
(20, 14, 1, 20),
(21, 13, 1, 21),
(22, 14, 1, 21),
(23, 11, 1, 22),
(24, 13, 20, 29),
(25, 18, 1, 30),
(26, 18, 10, 31),
(27, 18, 10, 32);

-- --------------------------------------------------------

--
-- Table structure for table `recive_order_details`
--

CREATE TABLE `recive_order_details` (
  `recive_id` int(11) NOT NULL,
  `recive_invoice_no` varchar(30) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `recive_date` date NOT NULL,
  `item_total_amount` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `due_amount` int(11) NOT NULL,
  `reg_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recive_order_details`
--

INSERT INTO `recive_order_details` (`recive_id`, `recive_invoice_no`, `supplier_id`, `order_id`, `recive_date`, `item_total_amount`, `payment_amount`, `payment_type`, `due_amount`, `reg_id`) VALUES
(4, 'Re12', 2, 85, '2020-04-24', 800, 700, 'Cash', 100, '17MCMC50'),
(5, 'RE14', 4, 86, '2020-04-25', 500, 300, 'Cash', 0, '17MCMC50'),
(6, 'RE18', 3, 105, '2020-05-10', 1000, 700, 'Cash', 300, '17MCMC50'),
(7, 'RE20', 5, 106, '2020-05-09', 200, 100, 'Cash', 0, '17MCMC50');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `contact_person_name` varchar(30) DEFAULT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `record_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `contact_person_name`, `supplier_name`, `mobile_no`, `email`, `address`, `record_date`) VALUES
(2, 'saigal', 'Fin Land', '5555555555', 'ss@gmail.com', 'Hyderabad', '2020-04-09'),
(3, 'Kumar', 'Diamond', '7777777777', 'a@gmail.com', 'Ranchi', '2020-04-13'),
(4, 'Gupta', 'juno', '1111111111', 'sg@gmail.com', 'UH', '2020-04-17'),
(5, 'Amit', 'Chipla', '1414151217', 'amit@gmail.com', 'Goa', '2020-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `supply_id` int(11) NOT NULL,
  `supply_quantity` int(11) NOT NULL,
  `drug_name_id` int(11) NOT NULL,
  `recive_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `unit_total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`supply_id`, `supply_quantity`, `drug_name_id`, `recive_id`, `unit_price`, `unit_total_price`) VALUES
(1, 10, 11, 4, 10, 100),
(2, 50, 12, 4, 20, 1000),
(3, 100, 13, 5, 1, 100),
(4, 40, 14, 0, 20, 400),
(5, 100, 15, 6, 2, 200),
(6, 50, 16, 6, 5, 250),
(7, 100, 17, 7, 3, 200),
(8, 60, 18, 0, 10, 600);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`drug_name_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `drug_company`
--
ALTER TABLE `drug_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`orders_item_id`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_reg_id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `prescribe`
--
ALTER TABLE `prescribe`
  ADD PRIMARY KEY (`prescribe_id`),
  ADD KEY `p_reg_id` (`p_reg_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `prescribe_item`
--
ALTER TABLE `prescribe_item`
  ADD PRIMARY KEY (`prescribe_item_id`),
  ADD KEY `drug_name_id` (`drug_name_id`),
  ADD KEY `prescribe_id` (`prescribe_id`);

--
-- Indexes for table `recive_order_details`
--
ALTER TABLE `recive_order_details`
  ADD PRIMARY KEY (`recive_id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`supply_id`),
  ADD KEY `drug_name_id` (`drug_name_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `drug_name_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `drug_company`
--
ALTER TABLE `drug_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `orders_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `prescribe`
--
ALTER TABLE `prescribe`
  MODIFY `prescribe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `prescribe_item`
--
ALTER TABLE `prescribe_item`
  MODIFY `prescribe_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `recive_order_details`
--
ALTER TABLE `recive_order_details`
  MODIFY `recive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `drug_company` (`company_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`reg_id`) REFERENCES `employee` (`reg_id`);

--
-- Constraints for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD CONSTRAINT `orders_item_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`orders_id`),
  ADD CONSTRAINT `orders_item_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `drug_company` (`company_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `employee` (`reg_id`);

--
-- Constraints for table `prescribe`
--
ALTER TABLE `prescribe`
  ADD CONSTRAINT `prescribe_ibfk_1` FOREIGN KEY (`p_reg_id`) REFERENCES `patients` (`p_reg_id`),
  ADD CONSTRAINT `prescribe_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `prescribe_ibfk_3` FOREIGN KEY (`reg_id`) REFERENCES `employee` (`reg_id`);

--
-- Constraints for table `prescribe_item`
--
ALTER TABLE `prescribe_item`
  ADD CONSTRAINT `prescribe_item_ibfk_1` FOREIGN KEY (`drug_name_id`) REFERENCES `drugs` (`drug_name_id`),
  ADD CONSTRAINT `prescribe_item_ibfk_2` FOREIGN KEY (`prescribe_id`) REFERENCES `prescribe` (`prescribe_id`);

--
-- Constraints for table `recive_order_details`
--
ALTER TABLE `recive_order_details`
  ADD CONSTRAINT `recive_order_details_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `employee` (`reg_id`);

--
-- Constraints for table `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `supply_ibfk_2` FOREIGN KEY (`drug_name_id`) REFERENCES `drugs` (`drug_name_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
