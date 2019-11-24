-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 09:30 PM
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
(2, 'Counselling', 'Counselling entails having sessions with patients and entails the attributes of diverse domains including physical and mental'),
(3, 'eyecheckup', 'entails diagnosis and visual treatment '),
(4, 'blood screening ', 'this entails analysis of blood content\r\n'),
(5, 'cancer checkup', 'involves cancer diagnosis and treatment');

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
  `password` varchar(255) NOT NULL,
  `aboutdoc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `fname`, `lname`, `telno`, `email`, `categoryid`, `categoryname`, `password`, `aboutdoc`) VALUES
(1, 'macharia254', 'Peter', 'Mwangi', '0711452864', 'drmacharia@yahoo.com', 2, 'Counselling', '45f678b147fdf275c35b60bac2360984', 'i\'m a professional counselor in diverse domains. have worked a counselor for about 20 years now. i always look forward to making  a positive impact to my clients '),
(2, 'doctor2', 'Mary', 'Wairimu', '072500773', 'doc.mary@hmail.com', 1, 'therapy', '3b02a6fdd669efe9083cc84d15e5699b', 'im a professional therapy doctor.\r\n'),
(3, 'doctor3', '', '', '', 'doc3@gmail.com', 2, 'Counselling', 'c5771df124ed6073ae4e2d09b2b20ac0', ''),
(4, 'eye1', 'Dennis ', 'Abuja', '0714789456', 'abuja@gmail.com', 3, 'eyecheckup', '4cc6cfee681b9a552d34d11a90374c5e', 'i\'m a professional  eye cheker '),
(5, 'doctor5', 'sky', 'moon', '07114562013', 'gakuyo@gmai.com', 3, 'eyecheckup', '83b8e9d7a4fa853010993f6dd6ff55a9', 'am an eye expertee');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(60) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `date_scheduled` date NOT NULL,
  `time_scheduled` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(20) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `pat_id`, `pat_name`, `doc_id`, `date_scheduled`, `time_scheduled`, `status`, `description`, `category`, `remarks`) VALUES
(1, 1, 'ravenous Mwamba', 1, '2019-11-26', '10:00:00', 'SCHEDULED TIME', 'patient displays signs of severe depression and anxiety. the patient who\'s a campus student seems to struggle with these conditions', 'Counselling', 'kindly carry a book and also keep time'),
(2, 3, 'Elizabeth  muthoni ', 1, '2019-11-26', '11:30:00', 'SCHEDULED TIME', 'patient is in need of marital counselling. ', 'Counselling', 'we will have the session at the allocated date and time. be punctual'),
(3, 5, 'Sherlyn wambui', 1, '2019-11-26', '00:00:00', 'PENDING', 'patient is in need of a counselling session oriented with handling anxiety', 'Counselling', ''),
(4, 6, 'harriet wanjiku', 1, '2019-11-24', '13:30:00', 'COMPLETED', 'want to test when the day is here if it will show up', 'Counselling', 'allow me to advice you on what to do when you come '),
(5, 7, 'kenneth murangiri', 1, '2019-11-24', '15:30:00', 'SCHEDULED TIME', 'Kenneth has some family issues with marriage and requires counseling on this are ', 'Counselling', 'come with spouse if possible\r\n'),
(6, 4, 'james mwangi ', 4, '2019-11-29', '00:00:00', 'PENDING', 'james has an eye problem', 'eyecheckup', ''),
(7, 4, 'james mwangi ', 4, '2019-11-24', '08:30:00', 'SCHEDULED TIME', 'james has an eye problem', 'eyecheckup', 'come with a notebook'),
(8, 8, 'jacob kagiri', 5, '2019-11-28', '08:30:00', 'SCHEDULED TIME', 'he has an eye problem', 'eyecheckup', 'carry a notebook'),
(9, 9, 'jane wambui', 1, '2019-11-24', '10:30:00', 'COMPLETED', 'the patient is facing a mental breakdown crisis', 'Counselling', 'kindly come with your medical records incase you have them'),
(10, 6, 'harriet wanjiku', 1, '2019-11-24', '12:20:00', 'COMPLETED', 'she has some trust issues in her relationship', 'Counselling', 'attend the session on time');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `schedule_id`, `date`, `patid`, `docid`, `docremarks`, `patremarks`, `status`, `docadvice`) VALUES
(4, 4, '2019-11-24', 6, 1, 'patient was just okay after that', 'the session was great', 'COMPLETED', 'you were great. just continue working on yourself'),
(6, 9, '2019-11-24', 9, 1, 'the patient did great, bu will have to follow up with the admin', 'thank you  the session was great ', 'COMPLETED', 'keep on eating healthy and exercising '),
(7, 10, '2019-11-24', 6, 1, 'the patient should watch her siet', '', 'COMPLETED', 'you did okay. juat watch yuor diet');

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
  `dateregistered` date NOT NULL,
  `schstatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `idnumber`, `tel`, `county`, `town`, `dob`, `email`, `password`, `dateregistered`, `schstatus`) VALUES
(1, 'raven', 'ravenous', 'Mwamba', 34406741, '0714562789', 'Nyeri', 'Nyeri Town', '1998-12-12', 'raven@gmail.com', '907e131eb3bf6f21292fa1ed16e8b60c', '2019-11-06', 'YES'),
(3, 'sonnie', 'Elizabeth ', 'muthoni ', 13360544, '', '', '', '0000-00-00', 'sonniemugo@gmail.com', 'cfc4c7db8a465ae7f3d593d21bbf293a', '2019-11-10', 'YES'),
(4, 'client2', 'james', 'mwangi ', 7889124, '', '', '', '0000-00-00', 'james@gmail.com', '2c66045d4e4a90814ce9280272e510ec', '2019-11-11', 'YES'),
(5, 'bobo', 'Sherlyn', 'wambui', 1233654, '', '', '', '0000-00-00', 'bobo@gmail.com', 'ca2cd2bcc63c4d7c8725577442073dde', '2019-11-12', 'YES'),
(6, 'harriet', 'harriet', 'wanjiku', 31145632, '0718610444', 'Nyeri', 'Town', '2004-11-24', 'harriet@hotmail.com', '7f0fd5728c8be1f202cc3753e7b593ef', '2019-11-24', 'NO'),
(7, 'kenneth', 'kenneth', 'murangiri', 1224578, '0711458790', 'uasin gishu', 'Eldoret', '2000-11-27', 'keth@yahoo.com', '7ca955bd92ca8b00548ddf36d2e79217', '2019-11-24', 'YES'),
(8, 'warutumo', 'jacob', 'kagiri', 28797562, '0711394455', 'muranga', 'kangema', '1992-12-12', 'warutumo@gmail.com', 'f88906a3b23bef9555771ac2257dd849', '2019-11-24', 'YES'),
(9, 'jane', 'jane', 'wambui', 909090, '0789654321', 'Kiambu', 'Thika ', '1997-12-12', 'jane@gmail.com', '5844a15e76563fedd11840fd6f40ea7b', '2019-11-24', 'NO');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
