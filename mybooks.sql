-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 02:25 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `role` varchar(30) NOT NULL,
  `userLoginID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `firstName`, `lastName`, `role`, `userLoginID`) VALUES
(2, 'John', 'Doe', 'Manager', 1),
(3, 'Lisa', 'Clark', 'Bookkeeper', 2);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `AuthorID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `Nationality` varchar(30) NOT NULL,
  `BirthYear` int(4) UNSIGNED NOT NULL,
  `DeathYear` int(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`AuthorID`, `Name`, `Surname`, `Nationality`, `BirthYear`, `DeathYear`) VALUES
(1, 'Miguel', 'de Cervantes', 'Spanish', 1547, 1616),
(2, 'Charles', 'Dickens', 'British', 1812, 1870),
(3, 'J.R.R.', 'Tolkien', 'British', 1892, 1973),
(4, 'Antoine', 'de Saint-Exupery', 'French', 1900, 1944),
(5, 'J.K.', 'Rowling', 'British', 1965, NULL),
(6, 'Agatha', 'Christie', 'British', 1890, 1976),
(7, 'Cao', 'Xueqin', 'Chinese', 1715, 1763),
(8, 'Henry', ' Rider Haggard', 'British', 1856, 1925),
(9, 'C.S.', 'Lewis', 'British', 1898, 1963);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` int(10) UNSIGNED NOT NULL,
  `BookTitle` varchar(255) NOT NULL,
  `OriginalTitle` varchar(255) DEFAULT NULL,
  `YearofPublication` int(4) NOT NULL DEFAULT '0',
  `Genre` varchar(30) NOT NULL,
  `MillionsSold` int(10) UNSIGNED NOT NULL,
  `LanguageWritten` varchar(30) NOT NULL,
  `AuthorID` int(10) UNSIGNED NOT NULL,
  `imageID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `BookTitle`, `OriginalTitle`, `YearofPublication`, `Genre`, `MillionsSold`, `LanguageWritten`, `AuthorID`, `imageID`) VALUES
(1, 'Don Quixote', 'El Ingenioso Hidalgo Don Quixote de la Mancha', 1605, 'Novel', 500, 'Spanish', 1, 4),
(2, 'A Tale of Two Cities', 'A Tale of Two Cities', 1859, 'Historical Fiction', 200, 'English', 2, 2),
(3, 'The Lord of the Rings', 'The Lord of the Rings', 1954, 'Fantasy/Adventure', 150, 'English', 3, 3),
(4, 'The Litle Prince', 'Le Petit Prince', 1943, 'Fable', 142, 'French', 4, 8),
(5, 'Harry Potter and the Sorcerer\'s Stone', 'Harry Potter and the Sorcerer\'s Stone', 1997, 'Fantasy Fiction', 107, 'English', 5, 3),
(6, 'And Then There Were None', 'Ten Little Niggers', 1939, 'Mystery', 100, 'English', 6, 1),
(7, 'The Dream of the Red Chamber', 'The Story of the Stone', 1792, 'Novel', 100, 'Chinese', 7, 5),
(8, 'The Hobbit ', 'There and Back Again', 1937, 'High Fantasy', 100, 'English', 3, 7),
(9, 'She: A History of Adventure', 'She', 1886, 'FIction', 100, 'English', 8, 6),
(10, 'The Lion, the Witch and the Wardrobe', 'The Lion, the Witch and the Wardrobe', 1950, 'Fantasy', 85, 'English ', 9, 3),
(18, 'test', NULL, 0, '', 400, '', 6, 3),
(19, 'testing', NULL, 1958, '', 208, '', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bookplot`
--

CREATE TABLE `bookplot` (
  `BookPlotID` int(10) UNSIGNED NOT NULL,
  `Plot` blob NOT NULL,
  `PlotSource` varchar(255) NOT NULL,
  `BookID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookplot`
--

INSERT INTO `bookplot` (`BookPlotID`, `Plot`, `PlotSource`, `BookID`) VALUES
(1, 0x5468652073746f727920666f6c6c6f77732074686520616476656e7475726573206f66206120686964616c676f206e616d6564204d722e20416c6f6e736f2051756978616e6f2077686f20726561647320736f206d616e792063686976616c72696320726f6d616e636573200d0a74686174206865206c6f736573206869732073616e69747920616e64206465636964657320746f20736574206f757420746f207265766976652063686976616c72792c20756e646f2077726f6e67732c20616e64206272696e67206a75737469636520746f2074686520776f726c642c20756e64657220746865206e616d65200d0a446f6e20517569786f7465206465206c61204d616e6368612e20486520726563727569747320612073696d706c65206661726d65722c2053616e63686f2050616e7a612c20617320686973207371756972652c2077686f206f6674656e20656d706c6f7973206120756e697175652c206561727468792077697420696e206465616c696e67207769746820446f6e20517569786f7465277320726865746f726963616c206f726174696f6e73206f6e20616e7469717561746564206b6e69676874686f6f642e, 'https://en.wikipedia.org/wiki/Don_Quixote ', 1),
(2, 0x496e20412054616c65206f662054776f204369746965732c20436861726c6573204461726e617920747269657320746f20657363617065206869732068657269746167652061732061204672656e63682061726973746f6372617420696e20746865207965617273206c656164696e6720757020746f20746865204672656e6368205265766f6c7574696f6e2e200d0a4f6e2074686520657665206f6620746865205265766f6c7574696f6e2c20686527732063617074757265642c20627574205379646e657920436172746f6e2c2061206d616e2077686f206c6f6f6b73206c696b65204461726e61792c2074616b65732068697320706c61636520616e642064696573206f6e20746865206775696c6c6f74696e652e, 'https://www.enotes.com/topics/tale-of-two-cities', 2),
(3, 0x546865207469746c65206f6620746865206e6f76656c2072656665727320746f207468652073746f72792773206d61696e20616e7461676f6e6973742c20746865204461726b204c6f726420536175726f6e2c2077686f2068616420696e20616e206561726c69657220616765206372656174656420746865200d0a4f6e652052696e6720746f2072756c6520746865206f746865722052696e6773206f6620506f7765722061732074686520756c74696d61746520776561706f6e20696e206869732063616d706169676e20746f20636f6e7175657220616e642072756c6520616c6c206f66204d6964646c652d65617274682e20, 'https://en.wikipedia.org/wiki/The_Lord_of_the_Rings', 3),
(4, 0x4966205361696e742d4578757065727920697320746f2062652062656c696576656420546865204c6974746c65205072696e6365206973206120626f6f6b20666f72206368696c6472656e207772697474656e20666f722067726f776e2d7570732e2049742063616e2062652072656164206f6e206d616e7920646966666572656e74206c6576656c7320746f2070726f7669646520706c65617375726520616e6420666f6f6420666f722074686f7567687420666f722072656164657273206f6620616c6c20616765732e0d0a54686520617574686f722c20616e2061766961746f722c2063726173686573207769746820686973206165726f706c616e6520696e20746865206d6964646c65206f662074686520536168617261206465736572742e20, 'http://www.thelittleprince.com/work/the-story/', 4),
(5, 0x486172727920506f74746572206973206e6f742061206e6f726d616c20626f792e205261697365642062792068697320637275656c2041756e7420616e6420556e636c652c20616e6420746f726d656e746564206279206869732062756c6c79206f66206120636f7573696e2c204475646c65792c206865206861732072657369676e656420746f2061206c696665206f66206e65676c6563742e200d0a4f6e2068697320656c6576656e74682062697274686461792c20686f77657665722c20612068616c662d6769616e742063616c6c65642048616772696420636f6d6573206372617368696e672d967175697465206c69746572616c6c792d96696e746f20686973206c6966652c20616e6420616e6e6f756e636573207468617420486172727920697320612077697a6172642e200d0a546f6765746865722074686579206a6f75726e657920746f204c6f6e646f6e20746f20676574207363686f6f6c20737570706c69657320666f722048617272799273206669727374207965617220617420486f677761727473205363686f6f6c206f66205769746368637261667420616e642057697a61726472792e20, 'http://www.hypable.com/harry-potter/sorcerers-stone-book-plot/', 5),
(6, 0x416e64205468656e2054686572652057657265204e6f6e652069732061206465746563746976652066696374696f6e206e6f76656c206279204167617468612043687269737469652c206669727374207075626c697368656420696e2074686520556e69746564204b696e67646f6d2062792074686520436f6c6c696e73204372696d6520436c7562206f6e2036204e6f76656d626572203139333920756e64657220746865207469746c652054656e204c6974746c65204e69676765727320616e6420696e2074686520556e697465642053746174657320627920446f64642c204d65616420616e6420436f6d70616e7920696e204a616e75617279203139343020756e64657220746865207469746c6520416e64205468656e2054686572652057657265204e6f6e652e20496e20746865206e6f76656c2c2074656e2070656f706c652c2077686f20686176652070726576696f75736c79206265656e20636f6d706c6963697420696e2074686520646561746873206f66206f74686572732062757420686176652065736361706564206e6f7469636520616e642f6f722070756e6973686d656e742c2061726520747269636b656420696e746f20636f6d696e67206f6e746f20616e2069736c616e642e204576656e2074686f75676820746865206775657374732061726520746865206f6e6c792070656f706c65206f6e207468652069736c616e642c20746865792061726520616c6c206d7973746572696f75736c79206d75726465726564206f6e65206279206f6e652c20696e2061206d616e6e657220706172616c6c656c696e672c20696e65786f7261626c7920616e6420736f6d6574696d65732067726f7465737175656c792c20746865206f6c64206e757273657279207268796d652c202254656e204c6974746c6520496e6469616e73222e2054686520554b2065646974696f6e2072657461696c656420617420736576656e207368696c6c696e677320616e642073697870656e63652028372f362920616e64207468652055532065646974696f6e2061742024322e30302e20546865206e6f76656c2068617320616c736f206265656e207075626c697368656420616e642066696c6d656420756e64657220746865207469746c652054656e204c6974746c6520496e6469616e732e, 'http://agathachristie.wikia.com/wiki/And_Then_There_Were_None', 6),
(7, 0x546865206e6f76656c2070726f766964657320612064657461696c65642c20657069736f646963207265636f7264206f66207468652074776f206272616e63686573206f6620746865204a696120436c616e2c20746865204e696e672d67756f20616e6420526f6e672d67756f20486f757365732c2077686f2072657369646520696e2074776f206c617267652061646a6163656e742066616d696c7920636f6d706f756e647320696e20746865206361706974616c2e200d0a546865697220616e636573746f72732077657265206d6164652044756b65732c20616e6420617320746865206e6f76656c20626567696e73207468652074776f20686f757365732072656d61696e20616d6f6e6720746865206d6f737420696c6c75737472696f75732066616d696c69657320696e20746865206361706974616c2e200d0a5468652073746f727927732070726566616365206861732073757065726e61747572616c2054616f69737420616e64204275646468697374206f766572746f6e65732e20, 'http://www.foreignercn.com/index.php?option=com_content&id=698:dream-of-the-red-chamber-&catid=34:chinese-literature&Itemid=117', 7),
(8, 0x54686520486f62626974206973207468652073746f7279206f662042696c626f2042616767696e732c206120686f626269742077686f206c6976657320696e20486f626269746f6e2e20486520656e6a6f7973206120706561636566756c20616e6420706173746f72616c206c6966652062757420686973206c69666520697320696e7465727275707465642062792061207375727072697365207669736974206279207468652077697a6172642047616e64616c662e200d0a4265666f72652042696c626f206973207265616c6c792061626c6520746f20696d70726f76652075706f6e2074686520736974756174696f6e2c2047616e64616c662068617320696e76697465642068696d73656c6620746f2074656120616e64207768656e20686520617272697665732c20686520636f6d65732077697468206120636f6d70616e79206f662064776172766573206c65642062792054686f72696e2e200d0a546865792061726520656d6261726b696e67206f6e2061206a6f75726e657920746f207265636f766572206c6f7374207472656173757265207468617420697320677561726465642062792074686520647261676f6e20536d6175672c20617420746865204c6f6e656c79204d6f756e7461696e2e20, 'http://www.gradesaver.com/the-hobbit/study-guide/summary', 8),
(9, 0x536865206973207468652073746f7279206f662043616d6272696467652070726f666573736f7220486f7261636520486f6c6c7920616e64206869732077617264204c656f2056696e6365792c20616e64207468656972206a6f75726e657920746f2061206c6f7374206b696e67646f6d20696e20746865204166726963616e20696e746572696f722e200d0a546865206a6f75726e6579206973207472696767657265642062792061206d7973746572696f7573207061636b616765206c65667420746f204c656f20627920686973206661746865722c20746f206265206f70656e6564206f6e2068697320323574682062697274686461792e0d0a5468652073746f727920657870726573736573206e756d65726f75732072616369616c20616e642065766f6c7574696f6e61727920636f6e63657074696f6e73206f6620746865206c61746520566963746f7269616e732c20657370656369616c6c79206e6f74696f6e73206f6620646567656e65726174696f6e20616e642072616369616c206465636c696e652070726f6d696e656e7420647572696e67207468652066696e206465207369e8636c652e, 'http://www.goodreads.com/book/show/682681.She', 9),
(10, 0x5768656e2074686520506576656e736965206368696c6472656e2c2050657465722c20537573616e2c2045646d756e642c20616e64204c756379206172652073656e74206f7574206f66204c6f6e646f6e20647572696e6720576f726c64205761722049492c20746865792068617665206e6f2069646561206f6620746865206d61676963616c206a6f75726e657920746865792061726520626567696e6e696e672e200d0a496e20746865206461726b6e657373206f6620746865206f6c6420636f756e74727920686f7573652077686572652074686579206172652073656e742c20746865206368696c6472656e207374756d626c65207468726f75676820616e206f6c642077617264726f626520746f20746865206c616e64206f66204e61726e69612c20776865726520616e696d616c732074616c6b20616e64206d61676963206578697374732e200d0a54686973206973207468652066697273742073746f7279206f66204e61726e6961207772697474656e20627920432e532e204c6577697320616e642069742074656c6c73207468652073746f7279206f6620686f7720746865736520666f7572206368696c6472656e2077697468207468652068656c70206f662041736c616e2c20746865204772656174204c696f6e2c2068656c7020646566656174207468652057686974652057697463682077686f20686f6c6473204e61726e69612e20, 'http://www.wikisummaries.org/wiki/The_Lion,_The_Witch_and_The_Wardrobe', 10);

-- --------------------------------------------------------

--
-- Table structure for table `bookranking`
--

CREATE TABLE `bookranking` (
  `RankingID` int(10) UNSIGNED NOT NULL,
  `RankingScore` int(10) UNSIGNED NOT NULL,
  `BookID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookranking`
--

INSERT INTO `bookranking` (`RankingID`, `RankingScore`, `BookID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `imageID` int(10) UNSIGNED NOT NULL,
  `imageURL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageID`, `imageURL`) VALUES
(1, '../img/BookCovers/andThenThereWereNone.jpg'),
(2, '../img/BookCovers/aTaleofTwoCities.jpg'),
(3, '../img/BookCovers/default.png'),
(4, '../img/BookCovers/DonQuixote.jpg'),
(5, '../img/BookCovers/redChamber.jpg'),
(6, '../img/BookCovers/She.jpg'),
(7, '../img/BookCovers/theHobbit.jpg'),
(8, '../img/BookCovers/theLittlePrince.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `update_book`
--

CREATE TABLE `update_book` (
  `updateID` int(10) UNSIGNED NOT NULL,
  `adminID` int(10) UNSIGNED NOT NULL,
  `bookID` int(10) UNSIGNED NOT NULL,
  `lastUpdated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `update_book`
--

INSERT INTO `update_book` (`updateID`, `adminID`, `bookID`, `lastUpdated`) VALUES
(1, 2, 8, '2018-02-06'),
(2, 2, 6, '2018-02-05'),
(3, 2, 1, '2018-02-06');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `userLoginID` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`userLoginID`, `username`, `password`) VALUES
(1, 'jdoe', 'password1'),
(2, 'lclark', 'password1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `userLoginID_2` (`userLoginID`),
  ADD UNIQUE KEY `adminID` (`adminID`),
  ADD KEY `userLoginID` (`userLoginID`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`AuthorID`),
  ADD KEY `az` (`Name`),
  ADD KEY `az1` (`Name`),
  ADD KEY `az2` (`Name`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `fk_authorID` (`AuthorID`),
  ADD KEY `indenxx` (`BookTitle`),
  ADD KEY `fk_image` (`imageID`);

--
-- Indexes for table `bookplot`
--
ALTER TABLE `bookplot`
  ADD PRIMARY KEY (`BookPlotID`),
  ADD KEY `fk_bookID2` (`BookID`);

--
-- Indexes for table `bookranking`
--
ALTER TABLE `bookranking`
  ADD PRIMARY KEY (`RankingID`),
  ADD KEY `fk_bookID` (`BookID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `update_book`
--
ALTER TABLE `update_book`
  ADD PRIMARY KEY (`updateID`),
  ADD UNIQUE KEY `user_bookID` (`updateID`),
  ADD KEY `userLoginID` (`adminID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`userLoginID`),
  ADD UNIQUE KEY `userLoginID` (`userLoginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `AuthorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `bookplot`
--
ALTER TABLE `bookplot`
  MODIFY `BookPlotID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bookranking`
--
ALTER TABLE `bookranking`
  MODIFY `RankingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `imageID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `update_book`
--
ALTER TABLE `update_book`
  MODIFY `updateID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `userLoginID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_userLogin` FOREIGN KEY (`userLoginID`) REFERENCES `userlogin` (`userLoginID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_authorID` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`imageID`) REFERENCES `image` (`imageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookplot`
--
ALTER TABLE `bookplot`
  ADD CONSTRAINT `fk_bookID2` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookranking`
--
ALTER TABLE `bookranking`
  ADD CONSTRAINT `fk_bookID` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `update_book`
--
ALTER TABLE `update_book`
  ADD CONSTRAINT `update_book_Admin` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `update_book_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `book` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
