CREATE TABLE IF NOT EXISTS `company` (
  `compid` int(3) NOT NULL AUTO_INCREMENT,
  `compname` varchar(55) NOT NULL,
  `compadd` varchar(255) NOT NULL,
  `comptel` varchar(12) NOT NULL,
  `compfax` varchar(12) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `item` (
  `itemid` int(3) NOT NULL AUTO_INCREMENT,
  `quantity` int(5) NOT NULL,
  `serialnum` varchar(125) NOT NULL,
  `itemname` varchar(125) NOT NULL,
  `palletid` int(3) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `pallet` (
  `palletid` int(3) NOT NULL AUTO_INCREMENT,
  `compid` int(3) NOT NULL,
  `typeid` int(3) NOT NULL,
  `shelfnum` int(3) NOT NULL,
  `rownum` int(3) NOT NULL,
  `columnnum` int(3) NOT NULL,
  `location` varchar(15) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `supervisor` (
  `superid` int(3) NOT NULL AUTO_INCREMENT,
  `superemail` varchar(55) NOT NULL,
  `superpass` varchar(8) NOT NULL,
  `supername` varchar(55) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `type` (
  `typeid` int(3) NOT NULL AUTO_INCREMENT,
  `typename` varchar(55) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(3) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(55) NOT NULL,
  `userpass` varchar(8) NOT NULL,
  `userfname` varchar(55) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
