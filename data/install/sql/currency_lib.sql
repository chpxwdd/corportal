SET NAMES 'utf8';

USE corportal;
CREATE TABLE IF NOT EXISTS `currency_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `_usd` float DEFAULT NULL,
  `_eur` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


CREATE TABLE IF NOT EXISTS `currency_lib` (
  `id` INT NOT NULL COMMENT '',
  `abbr` VARCHAR(45) NULL COMMENT '',
  `title` VARCHAR(45) NULL COMMENT '',
  `state` INT NULL COMMENT '',
  `exrt_id` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (1, 'USD', 'US Dollar', 2, '239');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (2, 'EUR', 'Euro', 2, '266');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (3, 'RUB', 'Russian Ruble', 1, '192');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (4, 'AED', 'United Arab Emirates Dirham', 1, '237');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (5, 'AUD', 'Australian Dollar', 1, '234');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (6, 'CAD', 'Canadian Dollar', 0, '43');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (7, 'CHF', 'Swiss Franc', 1, '135');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (8, 'CYP', 'Cyprus Pound', 0, '62');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (9, 'FJD', 'Fiji Dollar', 1, '80');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (10, 'GBP', 'British Pound Sterling', 1, '270');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (11, 'JPY', 'Japanese Yen', 1, '118');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (12, 'KRW', 'South Korean Won', 0, '124');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (13, 'MAD', 'Moroccan Dirham', 1, '252');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (14, 'MUR', 'Mauritian rupees', 0, '149');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (15, 'MYR', 'Malaysian Ringgit', 1, '142');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (16, 'NAD', 'Namibia Dollar', 0, '161');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (17, 'NZD', 'New Zealand Dollar', 1, '168');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (18, 'SEK', 'Swedish Krona', 1, '219');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (19, 'SGD', 'Singapore Dollar', 1, '207');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (20, 'ZAR', 'South African Rand', 1, '130');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (21, 'NOK', 'Norwegian Krone', 1, '175');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (22, 'THB', 'Thai Baht', 1, '225');
INSERT INTO currency_lib(id, abbr, title, state, exrt_id) VALUES (23, 'DKK', 'Danish Krone', 1, '64');