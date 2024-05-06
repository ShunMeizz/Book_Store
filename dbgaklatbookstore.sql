-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 04:53 AM
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
-- Database: `dbgaklatbookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladdress`
--

CREATE TABLE `tbladdress` (
  `addressID` int(5) NOT NULL,
  `region` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `zipcode` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladdress`
--

INSERT INTO `tbladdress` (`addressID`, `region`, `city`, `street`, `zipcode`) VALUES
(1, 'Region VII', 'Cebu', 'Babag', 6015),
(2, 'Region VII', 'Cebu', 'Babag 1', 6015),
(3, 'Region VII', 'Cebu', 'Babag 1', 6015),
(4, 'Region VII', 'Cebu', 'Babag 1', 6015),
(5, 'Region VII', 'Cebu', 'Babag 1', 6015),
(8, 'Region VII', 'Bohol', 'N/A', 3453),
(9, 'Region I', 'La Union', 'N/A', 5409),
(10, 'Region IV-A', 'Laguna', 'N/A', 3556),
(11, 'CAR', 'Apayao', 'N/A', 3556),
(12, 'Region VII', 'Cebu', 'Bacalso', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tblbook`
--

CREATE TABLE `tblbook` (
  `bookID` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `publishing_date` date NOT NULL,
  `rating` int(5) NOT NULL,
  `price` double NOT NULL,
  `stock` int(5) NOT NULL,
  `book_details` text NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbook`
--

INSERT INTO `tblbook` (`bookID`, `title`, `genre`, `author`, `publisher`, `publishing_date`, `rating`, `price`, `stock`, `book_details`, `image`) VALUES
(1, 'The Half-Blood Prince', 'Fantasy', 'J.K Rowling', 'Bloomsbury', '2005-07-16', 5, 14, 78, ' It is the middle of the summer, but there is an unseasonal mist pressing against the windowpanes. Harry Potter is waiting nervously in his bedroom at the Dursleys\' house in Privet Drive for a visit from Professor Dumbledore himself. One of the last times he saw the Headmaster, he was in a fierce one-to-one duel with Lord Voldemort, and Harry can\'t quite believe that Professor Dumbledore will actually appear at the Dursleys\' of all places. Why is the Professor coming to visit him now? What is it that cannot wait until Harry returns to Hogwarts in a few weeks\' time? Harry\'s sixth year at Hogwarts has already got off to an unusual start, as the worlds of Muggle and magic start to intertwine...                                      ', 'halfblood_book.png'),
(7, 'A Storm of Swords', 'Fantasy', 'George R.R. Martin', 'Bantam Books', '2000-08-08', 4, 10, 76, 'Of the five contenders for power, one is dead, another in disfavor, and still the wars rage as alliances are made and broken. Joffrey sits on the Iron Throne, the uneasy ruler of the Seven Kingdoms. His most bitter rival, Lord Stannis, stands defeated and disgraced, victim of the sorceress who holds him in her thrall. Young Robb still rules the North from the fortress of Riverrun. Meanwhile, making her way across a blood-drenched continent is the exiled queen, Daenerys, mistress of the only three dragons still left in the world. And as opposing forces manoeuver for the final showdown, an army of barbaric wildlings arrives from the outermost limits of civilization, accompanied by a horde of mythical Others—a supernatural army of the living dead whose animated corpses are unstoppable. As the future of the land hangs in the balance, no one will rest until the Seven Kingdoms have exploded in a veritable storm of swords...                                                                ', 'stormofswords_book.png'),
(8, 'A Song of Ice and Fire', 'Fantasy, Epic', 'George R. R. Martin', 'Bantam Spectra', '1996-08-06', 5, 13, 142, '\"A Song of Ice and Fire\" is a gripping fantasy series set in the fictional continents of Westeros and Essos. It follows the power struggles among noble families as they vie for control of the Iron Throne and the Seven Kingdoms of Westeros.', 'asong_book.png'),
(9, 'Harry Potter and the Deathly Hallows', 'Fantasy, Adventure', 'J.K. Rowling', 'Bloomsbury', '2007-07-21', 5, 15, 92, 'The final installment in the Harry Potter series, \"Harry Potter and the Deathly Hallows\" sees Harry, Ron, and Hermione embarking on a dangerous quest to find and destroy Voldemort\'s Horcruxes. As they face formidable challenges, the fate of the wizarding world hangs in the balance.', 'deathlyhallows_book.png'),
(10, 'The Gift of Battle', 'Fantasy, Adventure, Action', 'Morgan Rice', 'Morgan Rice', '2013-09-01', 4, 11, 173, ' \"The Gift of Battle\" is a thrilling installment in the Sorcerer\'s Ring series, following Thorgrin and his companions as they navigate the treacherous world of kings, sorcerers, and dragons. As Thorgrin trains to become a warrior, he must confront his destiny and face enemies both old and new.', 'giftofbattle_book.png'),
(11, 'Harry Potter and the Goblet of Fire', 'Fantasy, Adventure, Mystery', 'J.K. Rowling', 'Bloomsbury', '2000-07-08', 4, 11, 107, 'In \"Harry Potter and the Goblet of Fire,\" Harry returns to Hogwarts for his fourth year, only to find himself unexpectedly entered into the dangerous Triwizard Tournament. As he navigates challenges both magical and personal, Harry uncovers dark secrets that will change the course of his destiny.', 'gobletoffire_book.png'),
(12, 'Little Red Riding Hood', 'Fairy Tale, Folklore, Adventur', 'Charles Perrault', 'Multiple Publishers', '1697-01-02', 5, 9, 109, '\"Little Red Riding Hood\" is a classic fairy tale about a young girl who sets out through the forest to visit her grandmother, only to encounter a cunning wolf along the way. The tale has been adapted and retold numerous times, captivating audiences with its timeless themes of innocence, deception, and bravery.', 'littlered.jpg'),
(13, 'Poseidon Wake', 'Science Fiction, Adventure', 'Alastair Reynolds', 'Gollancz', '2015-02-18', 3, 11, 116, '\"Poseidon\'s Wake\" is the third installment in the Poseidon\'s Children series, set in a future where humanity has colonized distant worlds and encountered enigmatic alien civilizations. As humanity\'s destiny hangs in the balance, a group of explorers embarks on a perilous journey to uncover the secrets of the universe.', 'poseidonwake_book.png'),
(14, 'A Dance with Dragons', 'Fantasy, Epic', 'George R. R. Martin', 'Bantam Books', '2011-07-12', 4, 13, 99, '\"A Dance with Dragons\" continues the epic saga of \"A Song of Ice and Fire,\" plunging readers back into the complex web of political intrigue, warfare, and magic that grips the Seven Kingdoms. As the battle for the Iron Throne intensifies, alliances are tested, and long-hidden truths come to light.', 'dancewdragons_book.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblbookorder`
--

CREATE TABLE `tblbookorder` (
  `bookorderID` int(50) NOT NULL,
  `orderID` int(50) NOT NULL,
  `bookID` int(50) NOT NULL,
  `quantity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbookorder`
--

INSERT INTO `tblbookorder` (`bookorderID`, `orderID`, `bookID`, `quantity`) VALUES
(1, 11, 9, 2),
(2, 11, 8, 2),
(3, 12, 14, 3),
(4, 13, 7, 4),
(5, 13, 13, 1),
(6, 14, 11, 1),
(7, 15, 10, 1),
(8, 15, 12, 3),
(9, 16, 12, 3),
(10, 16, 13, 2),
(11, 16, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `cartID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `cost` double NOT NULL,
  `quantity` int(9) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`cartID`, `userID`, `book_title`, `cost`, `quantity`, `image`) VALUES
(86, 3, 'The Gift of Battle', 11, 3, 'giftofbattle_book.png'),
(98, 2, 'A Song of Ice and Fire', 13, 2, 'asong_book.png'),
(100, 3, 'Little Red Riding Hood', 9, 3, 'littlered.jpg'),
(101, 4, 'A Song of Ice and Fire', 13, 4, 'asong_book.png'),
(103, 4, 'Harry Potter and the Goblet of Fire', 11, 2, 'gobletoffire_book.png'),
(104, 5, 'Poseidon Wake', 11, 3, 'poseidonwake_book.png'),
(105, 5, 'Little Red Riding Hood', 9, 3, 'littlered.jpg'),
(107, 1, 'Poseidon Wake', 11, 8, 'poseidonwake_book.png'),
(108, 1, 'The Gift of Battle', 11, 1, 'giftofbattle_book.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `orderID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `addressID` int(5) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_products` varchar(300) NOT NULL,
  `quantity` int(50) NOT NULL,
  `total_payment` double NOT NULL,
  `payment_method` varchar(20) NOT NULL DEFAULT 'cash on delivery',
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`orderID`, `userID`, `addressID`, `order_date`, `total_products`, `quantity`, `total_payment`, `payment_method`, `status`) VALUES
(1, 8, 4, '2024-05-05 16:55:29', '5', 5, 316, 'cash on delivery', 'pending'),
(2, 2, 5, '2024-05-05 16:55:38', '3', 3, 120, 'cash on delivery', 'pending'),
(4, 9, 9, '2024-05-05 16:55:44', ' Harry Potter and the Deathly Hallows (2)  A Song of Ice and Fire (3) ', 5, 69, 'cash on delivery', 'pending'),
(5, 9, 9, '2024-05-05 16:55:50', ' Harry Potter and the Goblet of Fire (2)  The Half-Blood Prince (2)  A Dance with Dragons (2) ', 6, 76, 'cash on delivery', 'pending'),
(6, 9, 9, '2024-05-05 16:55:56', ' A Song of Ice and Fire (1)  Poseidon Wake (1)  Little Red Riding Hood (5) ', 7, 69, 'cash on delivery', 'pending'),
(7, 9, 9, '2024-05-05 16:56:03', ' The Gift of Battle (6) ', 6, 66, 'cash on delivery', 'pending'),
(8, 9, 9, '2024-05-05 16:56:09', ' Harry Potter and the Deathly Hallows (3) ', 3, 125, 'cash on delivery', 'pending'),
(9, 9, 9, '2024-05-05 16:56:17', ' A Song of Ice and Fire (1)  Poseidon Wake (1)  Little Red Riding Hood (5) ', 7, 69, 'cash on delivery', 'pending'),
(10, 9, 9, '2024-05-05 16:56:23', ' A Dance with Dragons (3)  A Song of Ice and Fire (2) ', 5, 225, 'cash on delivery', 'pending'),
(11, 12, 12, '2024-05-05 18:32:42', 'Harry Potter and the Deathly Hallows (2)  A Song of Ice and Fire (2) ', 4, 216, 'cash on delivery', 'pending'),
(12, 12, 12, '2024-05-05 18:34:58', 'A Dance with Dragons (3) ', 3, 119, 'cash on delivery', 'pending'),
(13, 12, 12, '2024-05-05 19:48:36', 'A Storm of Swords (4)  Poseidon Wake (1) ', 5, 211, 'cash on delivery', 'pending'),
(14, 9, 9, '2024-05-05 20:18:54', 'Harry Potter and the Goblet of Fire (1) ', 1, 91, 'cash on delivery', 'pending'),
(15, 9, 9, '2024-05-05 20:19:16', 'The Gift of Battle (1)  Little Red Riding Hood (3) ', 4, 198, 'cash on delivery', 'pending'),
(16, 8, 8, '2024-05-05 20:21:15', 'Little Red Riding Hood (3)  Poseidon Wake (2)  A Dance with Dragons (2) ', 7, 315, 'cash on delivery', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `acctID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `emailadd` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `acct_type` varchar(20) NOT NULL DEFAULT 'user',
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`acctID`, `userID`, `emailadd`, `username`, `acct_type`, `password`) VALUES
(1, 1, 'admin@gmail.com', 'admin', 'admin', '12345'),
(2, 2, 'shanley@gmail.com', 'shanley', 'user', '12345'),
(3, 3, 'hikaru@gmail.com', 'hikaru', 'admin', 'tsgtest'),
(8, 8, 'jane@gmail.com', 'janeyy', 'user', 'tsg'),
(9, 9, 'karylle@gmail.com', 'karylle9009', 'admin', '12345'),
(10, 10, 'jay@cit.edu', 'jayyou_', 'user', 'paymaya'),
(11, 11, 'johnny@gmail.com', 'tsgtest', 'admin', 'tsgtest'),
(12, 12, 'cit.edu@cit.edu', 'citu_', 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserprofile`
--

CREATE TABLE `tbluserprofile` (
  `userID` int(5) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(2) NOT NULL,
  `phonenumber` varchar(11) NOT NULL,
  `addressID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluserprofile`
--

INSERT INTO `tbluserprofile` (`userID`, `firstname`, `lastname`, `birthdate`, `age`, `phonenumber`, `addressID`) VALUES
(1, 'admin', 'account', '2002-07-22', 21, '09185599819', 1),
(2, 'Shanley', 'Sebial', '2004-05-24', 19, '09185599819', 2),
(3, 'Hikaru', 'Soute', '2002-07-22', 21, '09185599819', 3),
(8, 'Jane', 'Doe', '2001-09-11', 22, '09123434234', 8),
(9, 'Karylle', 'Delos Reyes', '2003-11-11', 20, '09123456789', 9),
(10, 'Jay', 'Mia', '2007-08-12', 16, '09123456789', 10),
(11, 'John', 'Merry', '2001-08-12', 22, '09123456732', 11),
(12, 'CIT', 'University', '1996-11-12', 27, '09123456789', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladdress`
--
ALTER TABLE `tbladdress`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `tblbookorder`
--
ALTER TABLE `tblbookorder`
  ADD PRIMARY KEY (`bookorderID`),
  ADD KEY `tblorder-conn` (`orderID`),
  ADD KEY `tblbook` (`bookID`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `addressID` (`addressID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`acctID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `addressID` (`addressID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladdress`
--
ALTER TABLE `tbladdress`
  MODIFY `addressID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblbook`
--
ALTER TABLE `tblbook`
  MODIFY `bookID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblbookorder`
--
ALTER TABLE `tblbookorder`
  MODIFY `bookorderID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `cartID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `orderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `acctID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbookorder`
--
ALTER TABLE `tblbookorder`
  ADD CONSTRAINT `tblbook` FOREIGN KEY (`bookID`) REFERENCES `tblbook` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblorder-conn` FOREIGN KEY (`orderID`) REFERENCES `tblorder` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `tblorder_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluserprofile` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblorder_ibfk_2` FOREIGN KEY (`addressID`) REFERENCES `tbladdress` (`addressID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD CONSTRAINT `tbluseraccount_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbluserprofile` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  ADD CONSTRAINT `tbluserprofile_ibfk_1` FOREIGN KEY (`addressID`) REFERENCES `tbladdress` (`addressID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
