-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 03:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dkut_scheduling_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `tel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `fname`, `lname`, `tel`) VALUES
(1, 'admin1', 'admin1@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usernames` varchar(60) NOT NULL,
  `catname` varchar(30) NOT NULL,
  `bookdate` date NOT NULL,
  `booktime` time NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `allocateddate` date NOT NULL,
  `allocatedtime` time NOT NULL,
  `notes` varchar(255) NOT NULL,
  `reasonforrejection` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `userid`, `usernames`, `catname`, `bookdate`, `booktime`, `title`, `description`, `status`, `allocateddate`, `allocatedtime`, `notes`, `reasonforrejection`) VALUES
(1, 1, 'ravenous Mwamba', 'Counselling', '2019-11-03', '07:15:06', 'Personal Guidance', 'I\'m a campus student and i seek guidance on a psychological breakdown that i\'m going through. did not have anyone to turn to for the advice and i would appreciate a lot if i got some help. Thanks . Regards Raven', 'REJECTED', '0000-00-00', '00:00:00', '', 'we are not dealing with psychological  issues at the moment. Try some other time '),
(2, 1, 'ravenous Mwamba', 'Therapy', '2019-11-03', '08:42:15', 'Leukemia Therapy', 'i need to start a leukemia therapy and would like to be advised on how to go about it', 'PENDING', '0000-00-00', '00:00:00', '', ''),
(3, 1, 'ravenous Mwamba', 'Medical Checkup', '2019-11-05', '11:47:00', 'In need of a medical checkup', 'i have been experiencing severe headaches and stomach upsets and i would appreciate if a i got a session to review the situation', 'REJECTED', '0000-00-00', '00:00:00', '', 'i think your situation can be easily solved by taking some pain killers. if the situation persists kindly make another appointment and provide theses details ');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `catname` varchar(30) NOT NULL,
  `catdescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catname`, `catdescription`) VALUES
(1, 'therapy', 'will entail all sorts of therapy sessions. '),
(2, 'Counselling', 'Counselling entails having sessions with patients and entails the attributes of diverse domains including physical and mental');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `telno` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `fname`, `lname`, `telno`, `email`, `categoryid`, `categoryname`, `password`) VALUES
(1, 'doctor1', '', '', '', 'doctor1@gmail.com', 2, 'Counselling', '45f678b147fdf275c35b60bac2360984'),
(2, 'doctor2', '', '', '', 'doc2@gmail.com', 1, 'therapy', '3b02a6fdd669efe9083cc84d15e5699b'),
(3, 'doctor3', '', '', '', 'doc3@gmail.com', 2, 'Counselling', 'c5771df124ed6073ae4e2d09b2b20ac0');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(60) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `doc_names` varchar(60) NOT NULL,
  `date_scheduled` date NOT NULL,
  `time_scheduled` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `patid` int(11) NOT NULL,
  `docid` int(11) NOT NULL,
  `docremarks` varchar(255) NOT NULL,
  `patremarks` varchar(255) NOT NULL,
  `status` varchar(60) NOT NULL,
  `docadvice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(14) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `county` varchar(20) NOT NULL,
  `town` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateregistered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `idnumber`, `tel`, `county`, `town`, `dob`, `email`, `password`, `dateregistered`) VALUES
(1, 'raven', 'ravenous', 'Mwamba', 34406741, '0714562789', 'Nyeri', 'Nyeri Town', '1998-12-12', 'raven@gmail.com', '907e131eb3bf6f21292fa1ed16e8b60c', '0000-00-00'),
(3, 'sonnie', 'Elizabeth ', 'muthoni ', 13360544, '', '', '', '0000-00-00', 'sonniemugo@gmail.com', 'cfc4c7db8a465ae7f3d593d21bbf293a', '0000-00-00'),
(4, 'client2', 'james', 'mwangi ', 7889124, '', '', '', '0000-00-00', 'james@gmail.com', '2c66045d4e4a90814ce9280272e510ec', '0000-00-00'),
(5, 'bobo', 'Sherlyn', 'wambui', 1233654, '', '', '', '0000-00-00', 'bobo@gmail.com', 'ca2cd2bcc63c4d7c8725577442073dde', '2019-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
