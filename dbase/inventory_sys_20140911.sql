/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : inventory_sys

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-09-11 11:39:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `batches`
-- ----------------------------
DROP TABLE IF EXISTS `batches`;
CREATE TABLE `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_name` varchar(255) DEFAULT NULL,
  `batch_event_id` int(11) DEFAULT NULL,
  `batch_allow_download` enum('0','1') DEFAULT '0',
  `batch_create_date` timestamp NULL DEFAULT NULL,
  `ticket_cost` float DEFAULT NULL,
  `rrn` int(11) DEFAULT NULL,
  `batch_ticket_number` int(11) DEFAULT NULL,
  `batch_last_update_dt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `site_id` int(11) DEFAULT NULL,
  `batch_verification_start` timestamp NULL DEFAULT NULL,
  `batch_verification_end` timestamp NULL DEFAULT NULL,
  `batch_status_tickets` enum('1','0','2','-1') DEFAULT '-1' COMMENT '0--inprogress,1--done,-1--disabled,2--enabled',
  `batch_status_email` enum('-1','1','2','0') DEFAULT '-1' COMMENT '0--inprogress,1--done,-1--disabled,2--enabled',
  `batch_category` int(11) DEFAULT NULL,
  `medium_del` enum('both','text','email') DEFAULT 'email',
  `ticketype` int(11) DEFAULT NULL,
  `apy_ticket` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `batch_event` (`batch_event_id`),
  KEY `batch_category_fk` (`batch_category`),
  KEY `ticket_type` (`ticketype`),
  CONSTRAINT `batch_category_fk` FOREIGN KEY (`batch_category`) REFERENCES `categories` (`id`),
  CONSTRAINT `batch_event` FOREIGN KEY (`batch_event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_type` FOREIGN KEY (`ticketype`) REFERENCES `ticket_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of batches
-- ----------------------------

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(255) DEFAULT NULL,
  `long_name` varchar(255) DEFAULT NULL,
  `inst_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'OTHER', 'OTHER DRINKS', '1');
INSERT INTO `categories` VALUES ('2', 'LQ', 'HARD LIQUOR', '1');
INSERT INTO `categories` VALUES ('3', 'SOFT', 'SOFT DRINKS', '1');
INSERT INTO `categories` VALUES ('4', 'EPR', 'Eprocess', null);
INSERT INTO `categories` VALUES ('5', 'BVG', 'BEVERAGE', '1');

-- ----------------------------
-- Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) DEFAULT NULL,
  `event_start` timestamp NULL DEFAULT NULL,
  `event_end` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `event_location` varchar(255) DEFAULT NULL,
  `retrieval_reference_number` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `event_banner` mediumblob,
  `event_description` varchar(255) DEFAULT NULL,
  `event_archive_status` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES ('10', 'Buster', '0000-00-00 00:00:00', '2013-11-18 22:49:51', 'Free', null, null, null, 'test descip', 'false');
INSERT INTO `events` VALUES ('11', 'Ghost Buster Movie', '0000-00-00 00:00:00', '2013-11-18 22:49:47', 'Accra Mall', null, null, null, null, 'false');
INSERT INTO `events` VALUES ('12', 'mp movie', '2013-02-06 00:41:49', '2013-11-18 22:49:44', 'moving pick', null, null, null, null, 'false');
INSERT INTO `events` VALUES ('13', 'FrBooty Call', '2013-02-07 00:42:08', '2013-11-18 22:49:42', 'Comm 4', null, null, null, null, 'false');
INSERT INTO `events` VALUES ('16', 'load', null, '2013-11-18 22:49:40', 'test', null, null, null, null, 'false');
INSERT INTO `events` VALUES ('17', 'further ', null, '2013-11-18 22:49:38', 'testing', null, null, null, null, 'false');
INSERT INTO `events` VALUES ('20', 'Fresh', '0000-00-00 00:00:00', '2013-11-18 22:49:31', 'asdf', null, '1', null, null, 'false');
INSERT INTO `events` VALUES ('21', 'smoothies', '2013-11-13 23:40:56', '2013-11-19 00:08:55', null, null, '1', null, null, 'false');
INSERT INTO `events` VALUES ('22', 'fuckoff', '0000-00-00 00:00:00', '2013-11-18 22:49:26', 'addd', null, '1', null, 'was a nice event fill', 'false');
INSERT INTO `events` VALUES ('23', 'LaunchFest', '2013-11-19 13:50:00', '2013-11-18 22:49:24', 'Tema', null, '1', null, 'best stuff', 'false');
INSERT INTO `events` VALUES ('24', 't', '2013-11-18 07:00:00', '2013-11-19 00:12:21', 't', null, '1', null, 'a', 'true');
INSERT INTO `events` VALUES ('25', 'Last Killer', '2013-11-20 00:00:00', '2013-11-28 16:00:00', 'Achimota', null, '1', null, 'This event is about dafd', 'false');

-- ----------------------------
-- Table structure for `families`
-- ----------------------------
DROP TABLE IF EXISTS `families`;
CREATE TABLE `families` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Should Be Last Name of Head of Family, typically father',
  `member_id` int(11) unsigned DEFAULT NULL COMMENT 'ID of the member who heads family, and will be used for family transactions',
  `modified_dt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the family was last created or modified',
  PRIMARY KEY (`id`),
  KEY `family_head_member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of families
-- ----------------------------

-- ----------------------------
-- Table structure for `institutions`
-- ----------------------------
DROP TABLE IF EXISTS `institutions`;
CREATE TABLE `institutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inst_short_name` varchar(255) DEFAULT NULL,
  `inst_long_name` varchar(255) DEFAULT NULL,
  `inst_lock` enum('1','0') DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image_cus_site` mediumblob,
  `rec_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of institutions
-- ----------------------------
INSERT INTO `institutions` VALUES ('1', 'Local-First', 'Localhost -First ', '1', 'fasdf@hay.com', '98707', '0245707630', 'fracni', 'fuck this shit', 'jjj', null, '2014-09-11 10:24:12');
INSERT INTO `institutions` VALUES ('2', 'SilverBird', 'Silverbird Worldwide Inc', '0', null, null, null, null, null, null, null, null);
INSERT INTO `institutions` VALUES ('3', 'EP', 'Eprcoess', '0', 'naywer@as.com', '9898', '990967', 'asdf', 'asdfsadf', null, null, null);
INSERT INTO `institutions` VALUES ('4', 'Defalut', 'adsf', '0', 'nay@a.com', 'asdf', '908098', 'asdf', 'adfasfasfd', 'adsfdsa', null, null);
INSERT INTO `institutions` VALUES ('5', 'Defalut2', 'adsf', '0', 'nay@a.com', 'asdf', '908098', 'asdf', 'adfasfasfd', 'adsfdsa', null, null);
INSERT INTO `institutions` VALUES ('6', 'TESTS', 'TESTOLD', '0', '1380', 'TEST', '32332', 'TESTE', 'ASDFSDD', 'ASDFDS', null, null);
INSERT INTO `institutions` VALUES ('7', 'TESTS7777', 'TESTNEW', '1', '1380', 'TEST', '32332', 'TESTE', 'ASDFSDD', 'ASDFDS', null, null);
INSERT INTO `institutions` VALUES ('8', 'EP', 'EPROCESS SA', '1', 'epa@ecobank.com', '0245707630', '8989-', 'KOKOMLELE', 'this is a self test', 'asdfas', null, null);
INSERT INTO `institutions` VALUES ('9', 'BAMSOFT', 'BAMSOFT LLC', '0', 'commanderjukes@gmail.com', '9898934', '890778902435', 'TEMA', 'write crazy software which does crazy stuff in a reliable,scaleable and secure manner', 'adkdkdkdk', null, null);

-- ----------------------------
-- Table structure for `links`
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_controller` varchar(255) NOT NULL,
  `link_action` varchar(255) NOT NULL,
  `link_allow` enum('true','false') NOT NULL,
  `link_category` varchar(255) NOT NULL,
  `link_name` varchar(255) NOT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES ('11', 'User', 'view_users', 'true', 'Staff', 'View Staff', null);
INSERT INTO `links` VALUES ('17', 'Admin', 'view_roles', 'true', 'Admin', 'View Roles', null);
INSERT INTO `links` VALUES ('20', 'Site', 'view_sites', 'true', 'Staff', 'View Sites', null);
INSERT INTO `links` VALUES ('22', 'Admin', 'view_inst', 'true', 'Admin', 'View Institutions', null);
INSERT INTO `links` VALUES ('24', 'Customer', 'view_cust', 'true', 'Reception', 'View Suppliers', null);
INSERT INTO `links` VALUES ('25', 'Customer', 'view_cat', 'true', 'Reception', 'View  Category', null);
INSERT INTO `links` VALUES ('26', 'Admin', 'view_reports', 'true', 'Staff', 'View Reports', null);
INSERT INTO `links` VALUES ('27', 'Admin', 'view_audit_trails', 'true', 'Staff', 'View Audit Trail', null);
INSERT INTO `links` VALUES ('28', 'Admin', 'configure_reports', 'true', 'Staff', 'Configure Reports', null);
INSERT INTO `links` VALUES ('29', 'Customer', 'view_products', 'true', 'Reception', 'View Products', null);
INSERT INTO `links` VALUES ('30', 'Customer', 'view_transaction', 'true', 'Reception', 'View Transactions', null);

-- ----------------------------
-- Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` enum('ticket_return','ticket_delete','ticket_redeem','ticket_create','ticket_batch_create') DEFAULT NULL,
  `log_text_reason` varchar(255) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `user_action` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of logs
-- ----------------------------

-- ----------------------------
-- Table structure for `member_ticket`
-- ----------------------------
DROP TABLE IF EXISTS `member_ticket`;
CREATE TABLE `member_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_member` varchar(255) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `event_id` varchar(255) DEFAULT NULL,
  `del_medium` enum('both','email','text') DEFAULT NULL,
  `cell_number_member` enum('') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='logs for tickets sent to customer are kept here ';

-- ----------------------------
-- Records of member_ticket
-- ----------------------------

-- ----------------------------
-- Table structure for `order_products`
-- ----------------------------
DROP TABLE IF EXISTS `order_products`;
CREATE TABLE `order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_products
-- ----------------------------

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `stock_available` int(11) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `inst_id` int(11) DEFAULT NULL,
  `category_product` int(11) DEFAULT NULL,
  `cost_price` double DEFAULT '0',
  `selling_price` double DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `comments` varchar(255) DEFAULT NULL,
  `crates_available` int(11) DEFAULT NULL,
  `quantity_crate` int(11) DEFAULT NULL,
  `modulu_crate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('15', 'guinness', '120', '9', '1', '1', '2.35', '3.5', '2014-09-11 11:17:40', null, null, '24', null);
INSERT INTO `products` VALUES ('18', 'l star', '39', '9', '1', '1', '2', '3', '2014-09-11 11:16:12', null, null, '12', null);
INSERT INTO `products` VALUES ('19', 'malt', '66', '9', '1', '3', '1.47', '2.8', '2014-09-11 11:33:52', null, null, '24', null);

-- ----------------------------
-- Table structure for `product_transactions`
-- ----------------------------
DROP TABLE IF EXISTS `product_transactions`;
CREATE TABLE `product_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `transaction_type` varchar(11) DEFAULT NULL,
  `transaction_timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `inst_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_product_fk` (`product_id`),
  KEY `trans_user_fk` (`user_id`),
  CONSTRAINT `trans_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `trans_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_transactions
-- ----------------------------
INSERT INTO `product_transactions` VALUES ('57', '15', '5', '3.5', 'restock', '2014-09-11 10:24:51', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('58', '15', '20', '3.5', 'restock', '2014-09-11 10:24:53', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('60', '18', '36', '3', 'restock', '2014-09-11 11:11:55', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('61', '18', '5', '3', 'sale', '2014-09-11 11:13:03', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('62', '18', '4', '5', 'sale', '2014-09-11 11:13:34', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('63', '18', '27', '3', 'removal', '2014-09-11 11:15:41', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('64', '18', '39', '3', 'restock', '2014-09-11 11:16:12', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('65', '15', '25', '3.5', 'removal', '2014-09-11 11:17:13', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('66', '15', '120', '3.5', 'restock', '2014-09-11 11:17:40', '89', '1', null);
INSERT INTO `product_transactions` VALUES ('67', '19', '66', '2.8', 'restock', '2014-09-11 11:33:52', '89', '1', null);

-- ----------------------------
-- Table structure for `reports`
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `position` tinyint(2) DEFAULT NULL,
  `level` tinyint(2) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `params` longtext,
  `controller` varchar(255) NOT NULL DEFAULT '',
  `report_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reports
-- ----------------------------
INSERT INTO `reports` VALUES ('15', 'SITE REPORT', null, null, null, 'select *  from chcms.sites', '', '4');
INSERT INTO `reports` VALUES ('16', 'INSTITUTION REPORT', null, null, null, 'select * from chcms.institutions', '', '4');
INSERT INTO `reports` VALUES ('17', 'fresh', null, null, null, 'select * from fresh', '', '4');

-- ----------------------------
-- Table structure for `report_categories`
-- ----------------------------
DROP TABLE IF EXISTS `report_categories`;
CREATE TABLE `report_categories` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `parent_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of report_categories
-- ----------------------------
INSERT INTO `report_categories` VALUES ('3', 'Site Reports', null);
INSERT INTO `report_categories` VALUES ('4', 'Institution Reports', null);

-- ----------------------------
-- Table structure for `report_parameters`
-- ----------------------------
DROP TABLE IF EXISTS `report_parameters`;
CREATE TABLE `report_parameters` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('text','number','date','datetime','month','timestamp','year') DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `initial_value` varchar(100) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `report_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_link` (`report_id`),
  CONSTRAINT `report_parameters_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of report_parameters
-- ----------------------------
INSERT INTO `report_parameters` VALUES ('60', 'timestamp', 'timestamp', 'timpstamp', null, '0', '16');
INSERT INTO `report_parameters` VALUES ('62', 'text', 'Site Name', 'site_name', null, '0', '15');
INSERT INTO `report_parameters` VALUES ('63', 'number', 'Site Address', 'site_address', null, '0', '15');
INSERT INTO `report_parameters` VALUES ('64', 'number', 'Site Phone', 'site_phone', null, '0', '15');
INSERT INTO `report_parameters` VALUES ('65', 'timestamp', 'Site Email', 'email', null, '0', '15');
INSERT INTO `report_parameters` VALUES ('69', 'number', 'fresh', 'fresh', null, '0', '17');

-- ----------------------------
-- Table structure for `report_roles`
-- ----------------------------
DROP TABLE IF EXISTS `report_roles`;
CREATE TABLE `report_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_fk` (`report_id`),
  KEY `role_fk` (`role_id`),
  CONSTRAINT `report_fk` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`),
  CONSTRAINT `role_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of report_roles
-- ----------------------------
INSERT INTO `report_roles` VALUES ('23', '15', '1');
INSERT INTO `report_roles` VALUES ('25', '15', '3');
INSERT INTO `report_roles` VALUES ('39', '16', '4');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_short_name` varchar(255) DEFAULT NULL,
  `role_long_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'TRA', 'Staff');
INSERT INTO `roles` VALUES ('3', 'ADM', 'Administrator');
INSERT INTO `roles` VALUES ('4', 'SADM', 'Super Admin');

-- ----------------------------
-- Table structure for `role_links`
-- ----------------------------
DROP TABLE IF EXISTS `role_links`;
CREATE TABLE `role_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles-fk` (`role_id`),
  KEY `links-fk` (`link_id`),
  CONSTRAINT `links-fk` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`),
  CONSTRAINT `roles-fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role_links
-- ----------------------------
INSERT INTO `role_links` VALUES ('6', '11', '3');
INSERT INTO `role_links` VALUES ('8', '20', '3');
INSERT INTO `role_links` VALUES ('9', '17', '4');
INSERT INTO `role_links` VALUES ('10', '22', '4');
INSERT INTO `role_links` VALUES ('25', '24', '1');
INSERT INTO `role_links` VALUES ('26', '25', '1');
INSERT INTO `role_links` VALUES ('27', '29', '1');
INSERT INTO `role_links` VALUES ('28', '30', '1');

-- ----------------------------
-- Table structure for `room`
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` varchar(255) DEFAULT NULL,
  `refnumber` int(11) DEFAULT NULL,
  `beds` int(11) DEFAULT NULL,
  `checkin` timestamp NULL DEFAULT NULL,
  `checkout` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of room
-- ----------------------------

-- ----------------------------
-- Table structure for `sites`
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) DEFAULT NULL,
  `site_key` varchar(255) DEFAULT NULL,
  `site_inst_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `site_lock` enum('0','1') NOT NULL DEFAULT '0',
  `site_desc` text,
  `rec_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `inst-fk` (`site_inst_id`),
  CONSTRAINT `inst-fk` FOREIGN KEY (`site_inst_id`) REFERENCES `institutions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES ('1', 'Testtt', 'ASDFASFASFSDFSFSF2345345QWASASDF', '1', null, 'Temat', '02457073434', '1234123', 'nayibor@gmail.com', '1', '0', null);
INSERT INTO `sites` VALUES ('2', 'SilverBird', 'ASDFDSAFSA', '2', null, null, null, null, null, '0', '0', null);
INSERT INTO `sites` VALUES ('3', 'SilverBird Nigeria', 'ADSFSAUP787564', '2', null, null, null, null, null, '0', '0', null);
INSERT INTO `sites` VALUES ('4', 'Silver Bird Ghana', 'ADSFASDFKLJPIU34123415647', '1', null, 'Accra', '900908098', '090009', 'dollar@yahoo.com', '1', '0', null);
INSERT INTO `sites` VALUES ('5', 'Dredded', null, '1', null, 'Dreed City', '877880', '0878097870', 'dede@as.com', '1', 'adsf', '2014-08-22 21:22:14');
INSERT INTO `sites` VALUES ('6', ' Default Site', null, '4', null, null, null, null, null, '0', null, null);
INSERT INTO `sites` VALUES ('7', 'Defalut2 Default Site', null, '5', 'adsfdsa', 'asdf', 'asdf', '908098', 'nay@a.com', '0', null, null);
INSERT INTO `sites` VALUES ('8', 'TESTS7777 Default Site', null, '7', 'ASDFDS', 'TESTE', 'TEST', '32332', '1380', '0', null, null);
INSERT INTO `sites` VALUES ('9', 'Local-First Default Site', null, '1', 'jjj', 'fracni', '98707', '0245707630', 'fasdf@hay.com', '1', 'j', '2014-08-22 21:21:44');
INSERT INTO `sites` VALUES ('10', 'EP Default Site', null, '8', 'asdfas', 'KOKOMLELE', '0245707630', '8989-', 'epa@ecobank.com', '0', null, null);
INSERT INTO `sites` VALUES ('11', 'BAMSOFT Default Site', null, '9', 'adkdkdkdk', 'TEMA', '9898934', '890778902435', 'commanderjukes@gmail.com', '0', null, null);

-- ----------------------------
-- Table structure for `suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topgolf_card_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `post_code` varchar(50) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `cell_number` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `alternate_phone` varchar(50) DEFAULT NULL,
  `membership_start_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `membership_end_dt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `photo_filename` varchar(255) DEFAULT NULL,
  `member_password` varchar(50) DEFAULT NULL,
  `member_pin` smallint(6) DEFAULT NULL,
  `family_id` int(11) unsigned DEFAULT NULL,
  `member_status_id` int(10) unsigned NOT NULL COMMENT 'What are the statûs of the a member?',
  `member_category_id` tinyint(3) unsigned DEFAULT NULL,
  `member_category_pricing_id` int(11) NOT NULL,
  `who_sold_id` int(10) unsigned DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `credit_balance` double(10,2) NOT NULL,
  `cash_balance` double(10,2) unsigned DEFAULT NULL,
  `bonus_balance` double(10,2) unsigned DEFAULT NULL,
  `screen_name` varchar(15) DEFAULT NULL,
  `use_screen_name` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) unsigned DEFAULT '1',
  `offers_by_email` tinyint(1) DEFAULT '1',
  `offers_by_post` tinyint(1) DEFAULT '1',
  `site_id` int(10) DEFAULT NULL,
  `home_site_id` int(10) DEFAULT NULL,
  `home_member_id` int(10) DEFAULT NULL,
  `one_id` int(10) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `screen_name` (`screen_name`),
  KEY `members_who_sold_id_idxfk` (`who_sold_id`),
  KEY `member_status_id` (`member_status_id`) USING BTREE,
  KEY `members_ibfk_3` (`member_category_id`),
  KEY `members_ibfk_4` (`family_id`),
  KEY `members_topgolf_card_id_idx` (`topgolf_card_id`),
  KEY `site_fk` (`site_id`),
  KEY `cat_fk` (`cat_id`),
  CONSTRAINT `cat_fk` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `site_fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=503 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('502', null, 'nayibor@gmail.com', null, 'Nukus', 'kINTE', null, '', null, null, null, null, null, null, '', '87070800987', null, null, '2014-01-25 10:01:02', '0000-00-00 00:00:00', null, null, null, null, '0', null, '0', null, null, null, '0.00', null, null, null, null, '1', '1', '1', '1', null, null, null, '5');

-- ----------------------------
-- Table structure for `tickets`
-- ----------------------------
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_value` varchar(255) DEFAULT NULL,
  `ticket_encrypted_value` varchar(255) DEFAULT NULL,
  `ticket_redeem_status` enum('0','2','4','3','1') DEFAULT '0',
  `ticket_event_id` int(11) DEFAULT NULL,
  `ticket_batch_id` int(11) DEFAULT NULL,
  `ritrieval_reference_number` int(11) DEFAULT NULL,
  `ticket_down_status` enum('1','0') DEFAULT '0',
  `ticket_img` mediumblob COMMENT 'this is for the actual barcode ticket',
  `site_id` int(11) DEFAULT NULL,
  `ticket_md5` varchar(50) DEFAULT NULL,
  `unique_id_ticket` varchar(30) DEFAULT NULL,
  `ticket_cdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ticket_type` int(11) DEFAULT NULL,
  `ticket_email_receiver` varchar(255) DEFAULT NULL,
  `ticket_text_receiver` varchar(255) DEFAULT NULL,
  `ticket_text_message_status` enum('1','0') DEFAULT '0' COMMENT 'check whether text message has been sent or not',
  `ticket_session_token` varchar(255) DEFAULT '',
  `ticket_session_start` timestamp NULL DEFAULT NULL,
  `ticket_session_end` timestamp NULL DEFAULT NULL,
  `ticket_email_message_status` enum('0','1') DEFAULT '0',
  `ticket_upload_status` enum('1','0') DEFAULT NULL,
  `ticket_verified_event_status` enum('1','0') DEFAULT NULL COMMENT 'to enable to see whether tickets have been verifed at event',
  `inst_id` int(11) DEFAULT NULL,
  `redeem_time` timestamp NULL DEFAULT NULL,
  `verified_event_time` timestamp NULL DEFAULT NULL,
  `downloaded_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_fk` (`ticket_event_id`),
  KEY `batch_fk` (`ticket_batch_id`),
  KEY `ticket-type-fk` (`ticket_type`),
  CONSTRAINT `batch-fk` FOREIGN KEY (`ticket_batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event-fk` FOREIGN KEY (`ticket_event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket-type-fk` FOREIGN KEY (`ticket_type`) REFERENCES `ticket_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tickets
-- ----------------------------

-- ----------------------------
-- Table structure for `ticket_transaction`
-- ----------------------------
DROP TABLE IF EXISTS `ticket_transaction`;
CREATE TABLE `ticket_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_type` varchar(255) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `transaction_status` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ticket_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for `ticket_types`
-- ----------------------------
DROP TABLE IF EXISTS `ticket_types`;
CREATE TABLE `ticket_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `type_html` varchar(5000) DEFAULT NULL,
  `site_id` int(255) DEFAULT NULL,
  `ticket_cost` double DEFAULT NULL,
  `allow_batch_create` enum('1','0') DEFAULT NULL,
  `inst_id` int(11) DEFAULT NULL,
  `ticket_code` varchar(255) DEFAULT NULL,
  `click_to_buy_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_fk` (`event_id`),
  KEY `sites_fk` (`site_id`),
  CONSTRAINT `event_fk` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `sites_fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ticket_types
-- ----------------------------
INSERT INTO `ticket_types` VALUES ('2', '13', 'Popular Stand', '<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\r\n  <head>\r\n   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>\r\n  </head>\r\n  <body leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\" bgcolor=\"#000000\">\r\nHello {email},start{event_start},end{event_end},event{event},cell{cell}\r\n\r\nYou alll.your Mothers!!!!\r\n</body>\r\n</html>', '1', '5', '0', '1', 'A2', null);
INSERT INTO `ticket_types` VALUES ('4', '23', 'Lauch TT TYPE', 'testing server', '1', '50', null, '1', 'A5', 'testing ticket type code stuff very well');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `lock_status` int(11) DEFAULT '0',
  `dob` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `salt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site-fk` (`site_id`),
  CONSTRAINT `site-fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'a3ca38ef0e8554b39ce6fd34b011f9aa197cda1f17e2b08b1816142c4bc67199', 'Ya0', 'Ameyibor', '1', 'nayibor@gmail.com', '0', '2014-08-25 21:49:57', null);
INSERT INTO `users` VALUES ('82', 'a1d980c77067c1ebc2010a63beb0d550f5313a20149f52caaa5899c4b3452f42', 'n4newnew', 'Fresh', '1', 'n4@gmail.com', '0', '2014-09-11 09:59:02', null);
INSERT INTO `users` VALUES ('83', 'da781a0732aa99c9a232666454ef368514fe457129661f058cfe26590fd7e0f0', 'Freshman', 'freshfresh', '1', 'fresh@fr.com', '0', '2014-08-22 21:23:50', null);
INSERT INTO `users` VALUES ('85', '1c6334dd23bddc483d7dbc8e1ad6c13713294e1b322739a2286f1ea404ef804f', 'Pearl', 'Tester', '1', 'freshndice@fr.com', '0', '2014-09-11 09:52:20', null);
INSERT INTO `users` VALUES ('87', '0f1c7e12d749445b41d98c451eb368c3b8b47c1465ca1fdec5df75107c5d6eee', 'alima', 'shardow', '9', 'a.shardow', '0', '2014-09-11 10:00:39', null);
INSERT INTO `users` VALUES ('88', 'e3ad1d3a23e8707451b7d8ecdafe56bf7a1cd8af5821511c566f1be7cd9ff5ad', 'happy', 'darlington', '9', 'h.dall', '0', '2014-09-11 10:00:20', null);
INSERT INTO `users` VALUES ('89', 'cb3db663d427542c3fb2d15f230ae7fa4985be115ba87690f26e727543a9f054', 'marie', 'offeh', '9', 'marieoffeh@gmail.com', '0', '2014-09-11 09:59:59', null);
INSERT INTO `users` VALUES ('90', '5d6671a7ce30bdb418595f86216b9d38978c007619ef4d574afd36faecdca1e2', 'aziz', 'abdul', '9', 'a.aziz', '0', '2014-09-11 09:59:17', null);

-- ----------------------------
-- Table structure for `user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role-fk` (`role_id`),
  CONSTRAINT `role-fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES ('169', '1', '87');
INSERT INTO `user_roles` VALUES ('170', '1', '88');
INSERT INTO `user_roles` VALUES ('171', '1', '89');
INSERT INTO `user_roles` VALUES ('172', '3', '89');
INSERT INTO `user_roles` VALUES ('173', '4', '89');
INSERT INTO `user_roles` VALUES ('174', '1', '1');
INSERT INTO `user_roles` VALUES ('175', '3', '1');
INSERT INTO `user_roles` VALUES ('176', '4', '1');
