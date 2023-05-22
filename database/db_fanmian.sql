

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fanmian`
--

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `D_ID` int(222) NOT NULL AUTO_INCREMENT,
  `FName` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  PRIMARY KEY (`D_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;


INSERT INTO `food` (`D_ID`, `FName`, `price`, `img`) VALUES 
(1, 'Dim Sum', 0.50, 'raviolis-aux-crevettes.jpg'), 
(2, 'Nem', 1.00, 'nem.jpg'), 
(3, 'Sushi', 1.00, 'sushi.jpg'),
(4, 'Chirashi', 0.25, 'chirashi.jpg'), 
(5, 'Soupe Miso', 2.50, 'soupe_miso.jpg'), 
(6, 'Nouilles (1 personne)', 3.00, 'nouilles.jpg'),
(7, 'Riz cantonais (1 personne)', 3.00, 'riz-cantonais.jpg'), 
(8, 'Brochette de saumon', 4.00, 'brochette3.jpg'), 
(9, 'Brochette de poulet', 4.00, 'brochette.png'),
(10, 'Aile de poulet', 0.75, 'ailes.jpg'), 
(11, 'Brochette de boeuf au fromage', 4.00, 'brochette2.jpg'), 
(12, 'Perle de coco', 1.00, 'coco.jpg'),
(13, 'Nougat chinois', 0.50, 'nougat.jpg'), 
(14, 'Ice tea', 1.50, 'icetea.jpg'), 
(15, 'Coca Cola', 1.50, 'coca.jpg'),
(16, 'Minute Maid orange', 1.50, 'minute.jpg'), 
(17, 'Bierre', 2.00, 'bierre.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Firstname` varchar(255) NOT NULL,
  `username` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Firstname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

DROP TABLE IF EXISTS `users_orders`;
CREATE TABLE IF NOT EXISTS `users_orders` (
  `OID` int(222) NOT NULL AUTO_INCREMENT,
`Firstname` varchar(222) NOT NULL,
  `FName` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
