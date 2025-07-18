-- Create mstvarian table
CREATE TABLE IF NOT EXISTS `mstvarian` (
  `varian` int(11) NOT NULL AUTO_INCREMENT,
  `namavarian` varchar(100) NOT NULL,
  PRIMARY KEY (`varian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some initial variants
INSERT INTO `mstvarian` (`namavarian`) VALUES 
('Default'),
('Black'),
('White'),
('Red'),
('Blue'),
('Green'),
('Yellow'),
('Brown'),
('Silver'),
('Gold');

-- Create mstangel table if it doesn't exist (since we're using it in addgambar.php)
CREATE TABLE IF NOT EXISTS `mstangel` (
  `angel` int(11) NOT NULL AUTO_INCREMENT,
  `namaangel` varchar(100) NOT NULL,
  PRIMARY KEY (`angel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some initial angles if table is empty
INSERT INTO `mstangel` (`namaangel`) VALUES 
('Front View'),
('Side View'),
('Back View'),
('Top View'),
('Bottom View'),
('Detail View');
