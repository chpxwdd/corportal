SET NAMES 'utf8';

-- ====================================================================================================================
-- CORE MODULE
-- ====================================================================================================================
--
-- DEFAULT ROLES
-- 
DELETE FROM `corportal_sodis_db`.`core_user_role_linker` WHERE `role_id`  IS NOT NULL OR `user_id` IS NOT NULL;
DELETE FROM `corportal_sodis_db`.`core_user` WHERE id IS NOT NULL;
DELETE FROM `corportal_sodis_db`.`core_role` WHERE id IS NOT NULL;

INSERT INTO `corportal_sodis_db`.`core_role` (id, `parent_id`, `role`) VALUES (1, NULL, 'system');
INSERT INTO `corportal_sodis_db`.`core_role` (id, `parent_id`, `role`) VALUES (2, NULL, 'admin');
INSERT INTO `corportal_sodis_db`.`core_role` (id, `parent_id`, `role`) VALUES (3, 2, 'member');
INSERT INTO `corportal_sodis_db`.`core_role` (id, `parent_id`, `role`) VALUES (4, 3, 'guest');

--
-- DEFAULT ROLES
--
-- INSERT INTO `corportal_sodis_db`.`core_user`(id, username, do_created, do_lastauth) VALUES (1, 'system', '2014-01-01 00:00:01', NULL);
-- INSERT INTO `corportal_sodis_db`.`core_user`(id, username, do_created, do_lastauth) VALUES (2, 'cherepanov', '2014-12-17 04:30:00', NULL);
-- INSERT INTO `corportal_sodis_db`.`core_user`(id, username, do_created, do_lastauth) VALUES (3, 'sheptun', '2014-12-17 05:00:00', NULL);
INSERT INTO corportal_sodis_db.core_user (`username`, `do_created`, `do_lastauth`) 
    VALUES('root',FROM_UNIXTIME(0),FROM_UNIXTIME(0));
INSERT INTO corportal_sodis_db.core_user (`username`,`do_created`, `do_lastauth`) 
    SELECT u.`name`, FROM_UNIXTIME(u.created), NOW() FROM portal2.users u WHERE u.uid > 0;

INSERT INTO `corportal_sodis_db`.`core_user_role_linker` (user_id, role_id) VALUES (1, 3);
INSERT INTO `corportal_sodis_db`.`core_user_role_linker` (user_id, role_id) VALUES (2, 2);
INSERT INTO `corportal_sodis_db`.`core_user_role_linker` (user_id, role_id) VALUES (3, 2);

-- ====================================================================================================================
-- CURRENCY MODULE
-- ====================================================================================================================
--
-- CURRENCY LIBRARY
--
/*
INSERT INTO `corportal_sodis_db`.`sds_currency_lib` (`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (1, 'USD', 'US Dollar', 2, '239');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib` (`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (2, 'EUR', 'Euro', 2, '266');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (3, 'RUB', 'Russian Ruble', 1, '192');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (4, 'AED', 'United Arab Emirates Dirham', 1, '237');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (5, 'AUD', 'Australian Dollar', 1, '234');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (6, 'CAD', 'Canadian Dollar', 0, '43');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (7, 'CHF', 'Swiss Franc', 1, '135');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (8, 'CYP', 'Cyprus Pound', 0, '62');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (9, 'FJD', 'Fiji Dollar', 1, '80');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (10, 'GBP', 'British Pound Sterling', 1, '270');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (11, 'JPY', 'Japanese Yen', 1, '118');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (12, 'KRW', 'South Korean Won', 0, '124');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (13, 'MAD', 'Moroccan Dirham', 1, '252');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (14, 'MUR', 'Mauritian rupees', 0, '149');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (15, 'MYR', 'Malaysian Ringgit', 1, '142');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (16, 'NAD', 'Namibia Dollar', 0, '161');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (17, 'NZD', 'New Zealand Dollar', 1, '168');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (18, 'SEK', 'Swedish Krona', 1, '219');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (19, 'SGD', 'Singapore Dollar', 1, '207');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (20, 'ZAR', 'South African Rand', 1, '130');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (21, 'NOK', 'Norwegian Krone', 1, '175');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (22, 'THB', 'Thai Baht', 1, '225');
INSERT INTO `corportal_sodis_db`.`sds_currency_lib`(`id`, `abbr`, `title`, `state`, `exrt_id`) VALUES (23, 'DKK', 'Danish Krone', 1, '64');
*/