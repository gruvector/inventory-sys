/*
Navicat MySQL Data Transfer

Source Server         : inventory
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : inventory_sys

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-05-21 04:18:50
*/

SET FOREIGN_KEY_CHECKS=0;

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
INSERT INTO `categories` VALUES ('3', 'SOFT', 'SOFT DRINKSAZ', '1');
INSERT INTO `categories` VALUES ('4', 'EPR', 'Eprocess', null);
INSERT INTO `categories` VALUES ('5', 'BVG', 'BEVERAGE', '1');

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
-- Table structure for `invoices`
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `sale_comments` varchar(255) DEFAULT NULL,
  `total_transaction` double NOT NULL,
  `total_amount_paid` double DEFAULT NULL,
  `total_balance_due` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `vat_used` float DEFAULT NULL,
  `transaction_type` enum('') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invoices
-- ----------------------------

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
INSERT INTO `links` VALUES ('30', 'Customer', 'view_transaction', 'true', 'Reception', 'View Details Transactions', null);
INSERT INTO `links` VALUES ('31', 'Customer', 'view_real_trans', 'true', 'Reception', 'View Summary Transactions', null);

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
  `date_created` timestamp NULL DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `crates_available` int(11) DEFAULT NULL,
  `quantity_crate` int(11) NOT NULL DEFAULT '0',
  `modulu_crate` int(11) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(20) NOT NULL,
  `product_batch` int(11) DEFAULT NULL,
  `product_expiry` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `archive_status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_name_index` (`product_name`),
  KEY `category_product` (`category_product`),
  CONSTRAINT `category_product` FOREIGN KEY (`category_product`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('15', 'dfad', '0', '9', '1', '1', '2.35', '3.5', '2015-04-15 02:36:39', null, null, '24', null, '2015-05-20 18:55:46', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('18', 'l star', '0', '9', '1', '1', '2', '3', '2014-09-11 11:16:12', null, null, '12', null, '2015-05-20 19:04:03', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('19', 'malt', '0', '9', '1', '3', '1.47', '2.8', '2015-04-08 10:48:55', null, null, '24', null, '2015-05-20 18:24:26', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('20', 'troll', '0', '1', '1', '1', '7', '10', '2015-04-15 02:37:43', null, null, '10', null, '2015-05-20 18:24:26', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('21', 'sardine', '0', '1', '1', '1', '4', '5', null, null, null, '4', null, '2015-05-20 18:43:11', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('22', 'mik', '0', '1', '1', '1', '10', '20', '2015-04-15 02:56:00', null, null, '4', null, '2015-05-17 22:07:17', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('23', 'rice', '0', '1', '1', '1', '5', '2', '2015-04-22 15:26:05', null, null, '5', null, '2015-05-17 22:07:17', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('24', 'troll', '0', '9', '1', '2', '3', '23', '2015-04-22 15:26:05', null, null, '45', null, '2015-05-16 00:46:23', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('25', 'tampico', '0', '9', '1', '3', '12', '45', '2015-04-22 15:26:05', null, null, '12', null, '2015-05-16 00:46:21', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('26', 'sprite', '0', '9', '1', '1', '45', '600', '2015-04-22 15:26:05', null, null, '45', null, '2015-05-16 00:46:19', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('27', 'fanice', '0', '9', '1', '2', '43', '50', '2015-04-22 15:26:05', null, null, '4', null, '2015-05-16 00:46:18', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('28', 'big star', '0', '9', '1', '3', '45', '90', '2015-04-22 15:26:05', null, null, '90', null, '2015-05-16 00:46:16', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('29', 'medium star', '0', '1', '1', '3', '10', '0', '2015-04-22 15:26:05', null, null, '24', null, '2015-05-16 00:46:15', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('30', 'small_cup', '0', '1', '1', '5', '1', '5', '2015-04-22 15:26:05', null, null, '5', null, '2015-05-17 22:11:21', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('31', 'bigcup', '0', '1', '1', '4', '5', '10', '2015-04-22 15:26:05', null, null, '10', null, '2015-05-20 19:39:29', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('32', 'adfsa', '0', '1', '1', '1', '0', '0', null, null, null, '1', null, '2015-05-16 04:31:49', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('33', 'newstuff', '0', '1', '1', '1', '12.45', '15', null, null, null, '3', null, '2015-05-19 04:27:17', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('34', 'checke_forsure', '0', '1', '1', '1', '12.09', '90', null, null, null, '5', null, '2015-05-17 22:11:21', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('36', 'frea', '1', '1', '1', '1', '6', '8', null, null, null, '1', null, '2015-05-20 19:57:22', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('37', 'newtest', '0', '1', '1', '1', '0', '0', null, null, null, '1', null, '2015-05-20 20:07:36', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('38', 'newtest2', '42', '1', '1', '2', '4', '23', null, null, null, '1', null, '2015-05-20 20:22:37', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('39', 'newtest3', '32', '1', '1', '1', '4', '12', null, null, null, '1', null, '2015-05-20 20:22:37', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('40', 'freshtest', '0', '1', '1', '1', '5', '45', null, null, null, '4', null, '2015-05-20 19:53:00', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('41', 'bstuff', '13', '1', '1', '1', '12', '50', '2015-05-19 16:36:24', null, null, '50', null, '2015-05-20 20:22:37', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('42', 'qtest', '0', '1', '1', '1', '0', '0', '0000-00-00 00:00:00', null, null, '1', null, '2015-05-20 17:29:55', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products` VALUES ('44', 'fgr', '0', '1', '1', '1', '50.5', '80.5', '2015-05-19 16:53:22', null, null, '6', null, '2015-05-20 17:46:44', '0', null, '0000-00-00 00:00:00', null);

-- ----------------------------
-- Table structure for `products_jn`
-- ----------------------------
DROP TABLE IF EXISTS `products_jn`;
CREATE TABLE `products_jn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `stock_available` int(11) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `inst_id` int(11) DEFAULT NULL,
  `category_product` int(11) DEFAULT NULL,
  `cost_price` double DEFAULT '0',
  `selling_price` double DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `crates_available` int(11) DEFAULT NULL,
  `quantity_crate` int(11) NOT NULL DEFAULT '0',
  `modulu_crate` int(11) DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(20) NOT NULL,
  `product_batch` int(11) DEFAULT NULL,
  `product_expiry` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `archive_status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_name_index` (`product_name`),
  KEY `category_product` (`category_product`),
  CONSTRAINT `products_jn_ibfk_1` FOREIGN KEY (`category_product`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products_jn
-- ----------------------------
INSERT INTO `products_jn` VALUES ('15', 'guinneasadsfs11', '11', '9', '1', '1', '2.35', '3.5', '2015-04-15 02:36:39', null, null, '24', null, '2015-05-16 01:43:07', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('18', 'l star', '4', '9', '1', '1', '2', '3', '2014-09-11 11:16:12', null, null, '12', null, '2015-05-16 00:47:34', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('19', 'malt', '0', '9', '1', '3', '1.47', '2.8', '2015-04-08 10:48:55', null, null, '24', null, '2015-05-15 04:23:50', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('20', 'troll', '13', '1', '1', '1', '7', '10', '2015-04-15 02:37:43', null, null, '10', null, '2015-05-16 00:47:34', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('21', 'sardine', '0', '1', '1', '1', '4', '5', null, null, null, '4', null, '2015-04-28 01:32:08', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('22', 'mik', '7', '1', '1', '1', '10', '20', '2015-04-15 02:56:00', null, null, '4', null, '2015-05-15 23:29:10', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('23', 'rice', '2', '1', '1', '1', '5', '2', '2015-04-22 15:26:05', null, null, '5', null, null, '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('24', 'troll', '0', '9', '1', '2', '3', '23', '2015-04-22 15:26:05', null, null, '45', null, '2015-05-16 00:46:23', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('25', 'tampico', '0', '9', '1', '3', '12', '45', '2015-04-22 15:26:05', null, null, '12', null, '2015-05-16 00:46:21', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('26', 'sprite', '0', '9', '1', '1', '45', '600', '2015-04-22 15:26:05', null, null, '45', null, '2015-05-16 00:46:19', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('27', 'fanice', '0', '9', '1', '2', '43', '50', '2015-04-22 15:26:05', null, null, '4', null, '2015-05-16 00:46:18', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('28', 'big star', '0', '9', '1', '3', '45', '90', '2015-04-22 15:26:05', null, null, '90', null, '2015-05-16 00:46:16', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('29', 'medium star', '0', '1', '1', '3', '10', '0', '2015-04-22 15:26:05', null, null, '24', null, '2015-05-16 00:46:15', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('30', 'small_cup', '7', '1', '1', '5', '1', '5', '2015-04-22 15:26:05', null, null, '5', null, '2015-05-16 00:46:13', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('31', 'bigcup', '124', '1', '1', '4', '5', '10', '2015-04-22 15:26:05', null, null, '10', null, '2015-05-16 01:25:34', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('32', 'adfsa', '0', '1', '1', '1', '0', '0', null, null, null, '1', null, '2015-05-16 04:31:49', '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('33', 'newstuff', '0', '1', '1', '1', '12.45', '15', null, null, null, '1', null, null, '0', null, '0000-00-00 00:00:00', null);
INSERT INTO `products_jn` VALUES ('34', 'checke_forsure', '0', '1', '1', '1', '12.09', '90', null, null, null, '5', null, '2015-05-16 08:09:59', '0', null, '0000-00-00 00:00:00', null);

-- ----------------------------
-- Table structure for `product_barc_info`
-- ----------------------------
DROP TABLE IF EXISTS `product_barc_info`;
CREATE TABLE `product_barc_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_barcode` varchar(255) NOT NULL,
  `product_id_fok` int(11) DEFAULT NULL,
  `comment_product` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_barc_info
-- ----------------------------

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
  `receipt_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `new_stock_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_product_fk` (`product_id`),
  KEY `trans_user_fk` (`user_id`),
  KEY `receipt_sales` (`receipt_id`),
  KEY `sale_fk` (`sale_id`),
  CONSTRAINT `receipt_sales` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`),
  CONSTRAINT `sale_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  CONSTRAINT `trans_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `trans_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_transactions
-- ----------------------------
INSERT INTO `product_transactions` VALUES ('57', '15', '5', '3.5', 'restock', '2014-09-11 10:24:51', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('58', '15', '20', '3.5', 'restock', '2014-09-11 10:24:53', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('60', '18', '36', '3', 'restock', '2014-09-11 11:11:55', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('61', '18', '5', '3', 'sale', '2014-09-11 11:13:03', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('62', '18', '4', '5', 'sale', '2014-09-11 11:13:34', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('63', '18', '27', '3', 'removal', '2014-09-11 11:15:41', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('64', '18', '39', '3', 'restock', '2014-09-11 11:16:12', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('65', '15', '25', '3.5', 'removal', '2014-09-11 11:17:13', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('66', '15', '120', '3.5', 'restock', '2014-09-11 11:17:40', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('67', '19', '66', '2.8', 'restock', '2014-09-11 11:33:52', '89', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('68', '19', '5', '2.8', 'sale', '2014-09-25 12:01:44', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('69', '19', '2', '2.8', 'sale', '2014-09-25 12:02:15', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('70', '19', '2', '2.8', 'removal', '2015-04-08 10:48:55', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('71', '15', '12', '3.5', 'sale', '2015-04-08 11:07:38', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('72', '15', '4', '3.5', 'removal', '2015-04-08 11:10:58', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('73', '20', '67', '10', 'restock', '2015-04-14 22:47:21', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('74', '20', '5', '10', 'sale', '2015-04-14 22:50:47', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('75', '20', '7', '10', 'sale', '2015-04-14 22:56:15', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('76', '15', '3', '3.5', 'sale', '2015-04-15 02:36:39', '90', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('77', '20', '3', '10', 'sale', '2015-04-15 02:37:43', '90', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('78', '22', '2', '20', 'restock', '2015-04-15 02:55:25', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('79', '22', '10', '20', 'restock', '2015-04-15 02:56:00', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('80', '23', '10', '2', 'restock', '2015-04-22 15:22:19', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('81', '23', '3', '2', 'sale', '2015-04-22 15:23:57', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('82', '23', '5', '2', 'removal', '2015-04-22 15:26:05', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('83', '31', '89', '10', 'restock', '2015-05-05 03:39:01', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('84', '31', '76', '10', 'restock', '2015-05-05 03:39:13', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('85', '31', '8', '10', 'sale', '2015-05-05 04:03:42', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('86', '31', '9', '10', 'restock', '2015-05-05 04:03:53', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('87', '31', '12', '10', 'restock', '2015-05-06 02:35:13', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('88', '30', '34', '5', 'restock', '2015-05-06 02:35:29', '1', '1', null, null, null, null);
INSERT INTO `product_transactions` VALUES ('89', '15', '2', '3.5', 'sale', '2015-05-14 02:21:53', '1', '1', null, null, '32', null);
INSERT INTO `product_transactions` VALUES ('90', '15', '2', '3.5', 'sale', '2015-05-14 02:22:45', '1', '1', null, null, '33', null);
INSERT INTO `product_transactions` VALUES ('91', '18', '1', '3', 'sale', '2015-05-14 02:24:47', '1', '1', null, null, '34', null);
INSERT INTO `product_transactions` VALUES ('128', '15', '23', '3.5', 'sale', '2015-05-15 03:54:25', '1', '1', null, null, '32', null);
INSERT INTO `product_transactions` VALUES ('129', '18', '4', '3', 'sale', '2015-05-15 03:54:25', '1', '1', null, null, '32', null);
INSERT INTO `product_transactions` VALUES ('130', '19', '3', '2.8', 'sale', '2015-05-15 03:54:25', '1', '1', null, null, '32', null);
INSERT INTO `product_transactions` VALUES ('131', '20', '12', '10', 'sale', '2015-05-15 03:54:25', '1', '1', null, null, '32', null);
INSERT INTO `product_transactions` VALUES ('132', '15', '23', '3.5', 'sale', '2015-05-15 04:02:43', '1', '1', null, null, '43', null);
INSERT INTO `product_transactions` VALUES ('133', '18', '56', '3', 'sale', '2015-05-15 04:02:43', '1', '1', null, null, '43', null);
INSERT INTO `product_transactions` VALUES ('134', '19', '54', '2.8', 'sale', '2015-05-15 04:02:43', '1', '1', null, null, '43', null);
INSERT INTO `product_transactions` VALUES ('135', '20', '34', '10', 'sale', '2015-05-15 04:02:43', '1', '1', null, null, '43', null);
INSERT INTO `product_transactions` VALUES ('139', '15', '34', '3.5', 'sale', '2015-05-15 04:11:53', '1', '1', null, null, '45', null);
INSERT INTO `product_transactions` VALUES ('140', '18', '50', '3', 'sale', '2015-05-15 04:11:53', '1', '1', null, null, '45', null);
INSERT INTO `product_transactions` VALUES ('141', '15', '8', '3.5', 'sale', '2015-05-15 04:21:07', '1', '1', null, null, '46', null);
INSERT INTO `product_transactions` VALUES ('142', '18', '400', '3', 'sale', '2015-05-15 04:21:07', '1', '1', null, null, '46', null);
INSERT INTO `product_transactions` VALUES ('143', '18', '3', '3', 'sale', '2015-05-15 04:23:50', '1', '1', null, null, '47', null);
INSERT INTO `product_transactions` VALUES ('144', '19', '3', '2.8', 'sale', '2015-05-15 04:23:50', '1', '1', null, null, '47', null);
INSERT INTO `product_transactions` VALUES ('145', '18', '2', '3', 'sale', '2015-05-15 04:28:19', '1', '1', null, null, '48', null);
INSERT INTO `product_transactions` VALUES ('146', '20', '1', '10', 'sale', '2015-05-15 04:28:19', '1', '1', null, null, '48', null);
INSERT INTO `product_transactions` VALUES ('147', '30', '2', '5', 'sale', '2015-05-15 04:32:57', '1', '1', null, null, '49', null);
INSERT INTO `product_transactions` VALUES ('148', '31', '2', '10', 'sale', '2015-05-15 04:32:57', '1', '1', null, null, '49', null);
INSERT INTO `product_transactions` VALUES ('149', '18', '5', '3', 'sale', '2015-05-15 04:47:29', '1', '1', null, null, '50', null);
INSERT INTO `product_transactions` VALUES ('150', '31', '1', '10', 'sale', '2015-05-15 04:55:15', '1', '1', null, null, '51', null);
INSERT INTO `product_transactions` VALUES ('151', '30', '1', '5', 'sale', '2015-05-15 04:55:15', '1', '1', null, null, '51', null);
INSERT INTO `product_transactions` VALUES ('152', '31', '1', '10', 'sale', '2015-05-15 04:56:51', '1', '1', null, null, '52', null);
INSERT INTO `product_transactions` VALUES ('153', '30', '1', '5', 'sale', '2015-05-15 04:56:51', '1', '1', null, null, '52', null);
INSERT INTO `product_transactions` VALUES ('154', '31', '54', '10', 'sale', '2015-05-15 04:57:27', '1', '1', null, null, '53', null);
INSERT INTO `product_transactions` VALUES ('155', '30', '23', '5', 'sale', '2015-05-15 04:57:27', '1', '1', null, null, '53', null);
INSERT INTO `product_transactions` VALUES ('156', '18', '25', '3', 'sale', '2015-05-15 21:59:59', '1', '1', null, null, '54', null);
INSERT INTO `product_transactions` VALUES ('157', '18', '1', '3', 'add_sales', '2015-05-15 22:43:24', '1', '1', null, null, '55', null);
INSERT INTO `product_transactions` VALUES ('158', '18', '1', '3', 'add_sales', '2015-05-15 22:43:50', '1', '1', null, null, '56', null);
INSERT INTO `product_transactions` VALUES ('159', '18', '1', '3', 'add_sales', '2015-05-15 22:44:11', '1', '1', null, null, '57', null);
INSERT INTO `product_transactions` VALUES ('160', '20', '1', '10', 'add_sales', '2015-05-15 23:21:56', '1', '1', null, null, '58', null);
INSERT INTO `product_transactions` VALUES ('161', '20', '1', '10', 'add_sales', '2015-05-15 23:27:23', '1', '1', null, null, '59', null);
INSERT INTO `product_transactions` VALUES ('162', '22', '5', '20', 'add_sales', '2015-05-15 23:29:10', '1', '1', null, null, '60', null);
INSERT INTO `product_transactions` VALUES ('163', '20', '4', '10', 'add_sales', '2015-05-15 23:32:38', '1', '1', null, null, '61', null);
INSERT INTO `product_transactions` VALUES ('164', '31', '1', '10', 'add_sales', '2015-05-16 00:44:09', '1', '1', null, null, '62', null);
INSERT INTO `product_transactions` VALUES ('165', '15', '6', '3.5', 'add_recv', '2015-05-16 00:47:34', '1', '1', null, null, '63', null);
INSERT INTO `product_transactions` VALUES ('166', '18', '4', '3', 'add_recv', '2015-05-16 00:47:34', '1', '1', null, null, '63', null);
INSERT INTO `product_transactions` VALUES ('167', '20', '3', '10', 'add_recv', '2015-05-16 00:47:34', '1', '1', null, null, '63', null);
INSERT INTO `product_transactions` VALUES ('168', '31', '5', '10', 'add_recv', '2015-05-16 00:47:34', '1', '1', null, null, '63', null);
INSERT INTO `product_transactions` VALUES ('169', '15', '3', '3.5', 'add_inv', '2015-05-16 00:50:34', '1', '1', null, null, '64', null);
INSERT INTO `product_transactions` VALUES ('170', '18', '3', '3', 'add_inv', '2015-05-16 00:50:34', '1', '1', null, null, '64', null);
INSERT INTO `product_transactions` VALUES ('171', '19', '3', '2.8', 'add_inv', '2015-05-16 00:50:34', '1', '1', null, null, '64', null);
INSERT INTO `product_transactions` VALUES ('172', '31', '1', '10', 'add_sales', '2015-05-16 01:12:16', '1', '1', null, null, '65', null);
INSERT INTO `product_transactions` VALUES ('173', '31', '1', '10', 'add_sales', '2015-05-16 01:25:10', '1', '1', null, null, '66', null);
INSERT INTO `product_transactions` VALUES ('174', '31', '2', '10', 'add_recv', '2015-05-16 01:25:34', '1', '1', null, null, '67', null);
INSERT INTO `product_transactions` VALUES ('175', '31', '5', '10', 'add_inv', '2015-05-16 01:26:50', '1', '1', null, null, '68', null);
INSERT INTO `product_transactions` VALUES ('176', '15', '5', '3.5', 'add_recv', '2015-05-16 01:43:07', '1', '1', null, null, '69', null);
INSERT INTO `product_transactions` VALUES ('177', '34', '100', '90', 'add_recv', '2015-05-17 03:18:47', '1', '1', null, null, '70', null);
INSERT INTO `product_transactions` VALUES ('178', '34', '10', '90', 'add_revr', '2015-05-17 03:19:20', '1', '1', null, null, '71', null);
INSERT INTO `product_transactions` VALUES ('179', '15', '1', '3.5', 'add_sales', '2015-05-17 05:08:06', '1', '1', null, null, '72', null);
INSERT INTO `product_transactions` VALUES ('180', '15', '1', '3.5', 'add_revr', '2015-05-17 05:09:42', '1', '1', null, null, '73', null);
INSERT INTO `product_transactions` VALUES ('181', '33', '18', '15', 'add_recv', '2015-05-17 05:20:58', '1', '1', null, null, '74', null);
INSERT INTO `product_transactions` VALUES ('182', '33', '3', '15', 'add_sales', '2015-05-17 05:21:55', '1', '1', null, null, '75', null);
INSERT INTO `product_transactions` VALUES ('183', '33', '4', '15', 'add_sales', '2015-05-17 05:22:31', '1', '1', null, null, '76', null);
INSERT INTO `product_transactions` VALUES ('184', '15', '2', '3.5', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('185', '18', '4', '3', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('186', '20', '12', '10', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('187', '22', '7', '20', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('188', '23', '2', '2', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('189', '30', '4', '5', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('190', '31', '1', '10', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('191', '33', '7', '15', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('192', '34', '89', '90', 'add_sales', '2015-05-17 22:07:17', '1', '1', null, null, '77', null);
INSERT INTO `product_transactions` VALUES ('193', '34', '1', '90', 'add_sales', '2015-05-17 22:11:21', '1', '1', null, null, '78', null);
INSERT INTO `product_transactions` VALUES ('194', '33', '3', '15', 'add_sales', '2015-05-17 22:11:21', '1', '1', null, null, '78', null);
INSERT INTO `product_transactions` VALUES ('195', '31', '10', '10', 'add_sales', '2015-05-17 22:11:21', '1', '1', null, null, '78', null);
INSERT INTO `product_transactions` VALUES ('196', '30', '3', '5', 'add_sales', '2015-05-17 22:11:21', '1', '1', null, null, '78', null);
INSERT INTO `product_transactions` VALUES ('197', '15', '4', '3.5', 'add_recv', '2015-05-18 00:31:02', '1', '1', null, null, '79', null);
INSERT INTO `product_transactions` VALUES ('198', '36', '100', '8', 'add_recv', '2015-05-18 00:31:18', '1', '1', null, null, '80', null);
INSERT INTO `product_transactions` VALUES ('199', '15', '3', '3.5', 'add_revr', '2015-05-18 00:32:28', '1', '1', null, null, '81', null);
INSERT INTO `product_transactions` VALUES ('200', '36', '5', '8', 'add_revr', '2015-05-18 00:32:49', '1', '1', null, null, '82', null);
INSERT INTO `product_transactions` VALUES ('201', '36', '5', '8', 'add_recv', '2015-05-18 00:40:39', '1', '1', null, null, '83', null);
INSERT INTO `product_transactions` VALUES ('202', '15', '5', '3.5', 'add_sales', '2015-05-18 01:00:38', '1', '1', null, null, '84', null);
INSERT INTO `product_transactions` VALUES ('203', '36', '6', '8', 'add_sales', '2015-05-18 01:00:38', '1', '1', null, null, '84', null);
INSERT INTO `product_transactions` VALUES ('204', '39', '56', '12', 'add_recv', '2015-05-18 01:28:51', '1', '1', null, null, '85', null);
INSERT INTO `product_transactions` VALUES ('205', '38', '2', '23', 'add_recv', '2015-05-18 01:28:51', '1', '1', null, null, '85', null);
INSERT INTO `product_transactions` VALUES ('206', '38', '1', '23', 'add_sales', '2015-05-19 04:27:17', '1', '1', null, null, '86', null);
INSERT INTO `product_transactions` VALUES ('207', '31', '50', '10', 'add_sales', '2015-05-19 04:27:17', '1', '1', null, null, '86', null);
INSERT INTO `product_transactions` VALUES ('208', '33', '1', '15', 'add_sales', '2015-05-19 04:27:17', '1', '1', null, null, '86', null);
INSERT INTO `product_transactions` VALUES ('209', '15', '2', '3.5', 'add_sales', '2015-05-19 04:27:17', '1', '1', null, null, '86', null);
INSERT INTO `product_transactions` VALUES ('210', '15', '60', '3.5', 'add_recv', '2015-05-19 04:31:10', '1', '1', null, null, '87', null);
INSERT INTO `product_transactions` VALUES ('211', '18', '344', '3', 'add_recv', '2015-05-19 04:31:10', '1', '1', null, null, '87', null);
INSERT INTO `product_transactions` VALUES ('212', '19', '5', '2.8', 'add_recv', '2015-05-19 04:31:10', '1', '1', null, null, '87', null);
INSERT INTO `product_transactions` VALUES ('213', '21', '5', '5', 'add_recv', '2015-05-19 04:31:10', '1', '1', null, null, '87', null);
INSERT INTO `product_transactions` VALUES ('214', '40', '100', '45', 'add_recv', '2015-05-19 04:31:36', '1', '1', null, null, '88', null);
INSERT INTO `product_transactions` VALUES ('215', '37', '34', '0', 'add_recv', '2015-05-19 04:31:36', '1', '1', null, null, '88', null);
INSERT INTO `product_transactions` VALUES ('216', '38', '50', '23', 'add_recv', '2015-05-19 04:31:55', '1', '1', null, null, '89', null);
INSERT INTO `product_transactions` VALUES ('217', '40', '90', '45', 'add_sales', '2015-05-19 15:46:02', '1', '1', null, null, '90', null);
INSERT INTO `product_transactions` VALUES ('218', '39', '10', '12', 'add_sales', '2015-05-19 15:46:02', '1', '1', null, null, '90', null);
INSERT INTO `product_transactions` VALUES ('219', '40', '12', '45', 'add_recv', '2015-05-19 15:50:15', '1', '1', null, null, '91', null);
INSERT INTO `product_transactions` VALUES ('220', '39', '10', '12', 'add_recv', '2015-05-19 15:50:15', '1', '1', null, null, '91', null);
INSERT INTO `product_transactions` VALUES ('221', '38', '10', '23', 'add_recv', '2015-05-19 15:50:15', '1', '1', null, null, '91', null);
INSERT INTO `product_transactions` VALUES ('222', '40', '10', '45', 'add_recv', '2015-05-19 15:53:14', '1', '1', null, null, '92', null);
INSERT INTO `product_transactions` VALUES ('223', '39', '10', '12', 'add_recv', '2015-05-19 15:53:14', '1', '1', null, null, '92', null);
INSERT INTO `product_transactions` VALUES ('224', '40', '1', '45', 'add_recv', '2015-05-19 15:53:34', '1', '1', null, null, '93', null);
INSERT INTO `product_transactions` VALUES ('225', '39', '1', '12', 'add_recv', '2015-05-19 15:53:34', '1', '1', null, null, '93', null);
INSERT INTO `product_transactions` VALUES ('226', '40', '1', '45', 'add_recv', '2015-05-19 16:08:35', '1', '1', null, null, '94', null);
INSERT INTO `product_transactions` VALUES ('227', '39', '1', '12', 'add_recv', '2015-05-19 16:08:35', '1', '1', null, null, '94', null);
INSERT INTO `product_transactions` VALUES ('228', '40', '1', '45', 'add_recv', '2015-05-19 16:08:48', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('229', '39', '1', '12', 'add_recv', '2015-05-19 16:08:48', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('239', '44', '20', '80.5', 'add_recv', '2015-05-19 18:39:14', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('240', '42', '20', '0', 'add_recv', '2015-05-19 18:39:14', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('241', '41', '20', '50', 'add_recv', '2015-05-19 18:39:14', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('245', '44', '20', '80.5', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('246', '42', '20', '0', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('247', '41', '20', '50', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('248', '44', '20', '80.5', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('249', '42', '20', '0', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('250', '41', '20', '50', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('254', '44', '20', '80.5', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('255', '42', '20', '0', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('256', '41', '20', '50', 'add_recv', '2015-05-19 18:48:58', '1', '1', null, null, '95', null);
INSERT INTO `product_transactions` VALUES ('257', '44', '20', '80.5', 'add_recv', '2015-05-19 19:20:19', '1', '1', null, null, '118', null);
INSERT INTO `product_transactions` VALUES ('258', '42', '20', '0', 'add_recv', '2015-05-19 19:20:19', '1', '1', null, null, '118', null);
INSERT INTO `product_transactions` VALUES ('259', '41', '20', '50', 'add_recv', '2015-05-19 19:20:19', '1', '1', null, null, '118', null);
INSERT INTO `product_transactions` VALUES ('260', '44', '1', '80.5', 'add_recv', '2015-05-19 19:20:40', '1', '1', null, null, '119', null);
INSERT INTO `product_transactions` VALUES ('261', '42', '1', '0', 'add_recv', '2015-05-19 19:20:40', '1', '1', null, null, '119', null);
INSERT INTO `product_transactions` VALUES ('262', '44', '1', '80.5', 'add_sales', '2015-05-19 19:20:57', '1', '1', null, '1', '120', null);
INSERT INTO `product_transactions` VALUES ('263', '42', '1', '0', 'add_sales', '2015-05-19 19:20:57', '1', '1', null, '1', '120', null);
INSERT INTO `product_transactions` VALUES ('264', '44', '1', '80.5', 'add_sales', '2015-05-19 19:21:19', '1', '1', null, '2', '121', null);
INSERT INTO `product_transactions` VALUES ('265', '42', '1', '0', 'add_sales', '2015-05-19 19:21:19', '1', '1', null, '2', '121', null);
INSERT INTO `product_transactions` VALUES ('266', '44', '1', '80.5', 'add_sales', '2015-05-19 19:31:50', '1', '1', null, '3', '122', null);
INSERT INTO `product_transactions` VALUES ('267', '42', '1', '0', 'add_sales', '2015-05-19 19:31:50', '1', '1', null, '3', '122', null);
INSERT INTO `product_transactions` VALUES ('268', '44', '2', '80.5', 'add_sales', '2015-05-19 19:35:56', '1', '1', null, '4', '123', null);
INSERT INTO `product_transactions` VALUES ('269', '42', '2', '0', 'add_sales', '2015-05-19 19:35:56', '1', '1', null, '4', '123', null);
INSERT INTO `product_transactions` VALUES ('270', '44', '3', '80.5', 'add_recv', '2015-05-19 19:38:36', '1', '1', null, null, '124', null);
INSERT INTO `product_transactions` VALUES ('271', '42', '3', '0', 'add_recv', '2015-05-19 19:38:36', '1', '1', null, null, '124', null);
INSERT INTO `product_transactions` VALUES ('272', '44', '21', '80.5', 'add_inv', '2015-05-19 19:38:58', '1', '1', null, null, '125', null);
INSERT INTO `product_transactions` VALUES ('273', '42', '12', '0', 'add_inv', '2015-05-19 19:38:58', '1', '1', null, null, '125', null);
INSERT INTO `product_transactions` VALUES ('274', '44', '1', '80.5', 'add_revr', '2015-05-19 19:39:21', '1', '1', null, null, '126', null);
INSERT INTO `product_transactions` VALUES ('275', '42', '4', '0', 'add_revr', '2015-05-19 19:39:21', '1', '1', null, null, '126', null);
INSERT INTO `product_transactions` VALUES ('276', '44', '15', '80.5', 'add_revr', '2015-05-19 19:39:54', '1', '1', null, null, '127', null);
INSERT INTO `product_transactions` VALUES ('277', '42', '12', '0', 'add_revr', '2015-05-19 19:39:54', '1', '1', null, null, '127', null);
INSERT INTO `product_transactions` VALUES ('278', '44', '1', '80.5', 'add_sales', '2015-05-19 19:55:07', '1', '1', null, '6', '129', '2');
INSERT INTO `product_transactions` VALUES ('279', '42', '1', '0', 'add_sales', '2015-05-19 19:55:07', '1', '1', null, '6', '129', '2');
INSERT INTO `product_transactions` VALUES ('280', '44', '1', '80.5', 'add_sales', '2015-05-19 19:55:42', '1', '1', null, '7', '130', '1');
INSERT INTO `product_transactions` VALUES ('281', '42', '1', '0', 'add_sales', '2015-05-19 19:55:42', '1', '1', null, '7', '130', '1');
INSERT INTO `product_transactions` VALUES ('282', '44', '9', '80.5', 'add_recv', '2015-05-19 19:56:06', '1', '1', null, null, '131', '10');
INSERT INTO `product_transactions` VALUES ('283', '42', '9', '0', 'add_recv', '2015-05-19 19:56:06', '1', '1', null, null, '131', '10');
INSERT INTO `product_transactions` VALUES ('284', '44', '1', '80.5', 'add_inv', '2015-05-19 19:56:29', '1', '1', null, null, '132', '10');
INSERT INTO `product_transactions` VALUES ('285', '42', '1', '0', 'add_inv', '2015-05-19 19:56:29', '1', '1', null, null, '132', '10');
INSERT INTO `product_transactions` VALUES ('286', '44', '5', '80.5', 'add_revr', '2015-05-19 19:56:51', '1', '1', null, null, '133', '5');
INSERT INTO `product_transactions` VALUES ('287', '42', '5', '0', 'add_revr', '2015-05-19 19:56:51', '1', '1', null, null, '133', '5');
INSERT INTO `product_transactions` VALUES ('288', '44', '1', '80.5', 'add_sales', '2015-05-19 20:32:54', '1', '1', null, '8', '134', '4');
INSERT INTO `product_transactions` VALUES ('289', '42', '1', '0', 'add_sales', '2015-05-19 20:32:54', '1', '1', null, '8', '134', '4');
INSERT INTO `product_transactions` VALUES ('290', '44', '1', '80.5', 'add_sales', '2015-05-19 20:33:10', '1', '1', null, '9', '135', '3');
INSERT INTO `product_transactions` VALUES ('291', '42', '1', '0', 'add_sales', '2015-05-19 20:33:10', '1', '1', null, '9', '135', '3');
INSERT INTO `product_transactions` VALUES ('292', '15', '2', '3.5', 'add_sales', '2015-05-20 16:41:44', '1', '1', null, '10', '136', '59');
INSERT INTO `product_transactions` VALUES ('293', '18', '1', '3', 'add_sales', '2015-05-20 16:41:44', '1', '1', null, '10', '136', '343');
INSERT INTO `product_transactions` VALUES ('294', '15', '1', '3.5', 'add_sales', '2015-05-20 16:46:21', '1', '1', null, '11', '137', '58');
INSERT INTO `product_transactions` VALUES ('295', '18', '1', '3', 'add_sales', '2015-05-20 16:46:21', '1', '1', null, '11', '137', '342');
INSERT INTO `product_transactions` VALUES ('296', '44', '1', '80.5', 'add_sales', '2015-05-20 17:29:29', '1', '1', null, '12', '138', '2');
INSERT INTO `product_transactions` VALUES ('297', '42', '1', '0', 'add_sales', '2015-05-20 17:29:29', '1', '1', null, '12', '138', '2');
INSERT INTO `product_transactions` VALUES ('298', '44', '1', '80.5', 'add_sales', '2015-05-20 17:29:56', '1', '1', null, '13', '139', '1');
INSERT INTO `product_transactions` VALUES ('299', '42', '2', '0', 'add_sales', '2015-05-20 17:29:56', '1', '1', null, '13', '139', '0');
INSERT INTO `product_transactions` VALUES ('300', '44', '1', '80.5', 'add_sales', '2015-05-20 17:46:44', '1', '1', null, '14', '140', '0');
INSERT INTO `product_transactions` VALUES ('301', '41', '1', '50', 'add_sales', '2015-05-20 17:46:44', '1', '1', null, '14', '140', '19');
INSERT INTO `product_transactions` VALUES ('302', '15', '1', '3.5', 'add_sales', '2015-05-20 17:50:50', '1', '1', null, '15', '141', '57');
INSERT INTO `product_transactions` VALUES ('303', '18', '1', '3', 'add_sales', '2015-05-20 17:50:50', '1', '1', null, '15', '141', '341');
INSERT INTO `product_transactions` VALUES ('304', '18', '1', '3', 'add_sales', '2015-05-20 17:55:28', '1', '1', null, '16', '142', '340');
INSERT INTO `product_transactions` VALUES ('305', '15', '1', '3.5', 'add_sales', '2015-05-20 17:55:28', '1', '1', null, '16', '142', '56');
INSERT INTO `product_transactions` VALUES ('306', '18', '1', '3', 'add_sales', '2015-05-20 17:59:32', '1', '1', null, '17', '143', '339');
INSERT INTO `product_transactions` VALUES ('307', '15', '1', '3.5', 'add_sales', '2015-05-20 17:59:32', '1', '1', null, '17', '143', '55');
INSERT INTO `product_transactions` VALUES ('308', '19', '4', '2.8', 'add_sales', '2015-05-20 18:08:45', '1', '1', null, '18', '144', '1');
INSERT INTO `product_transactions` VALUES ('309', '15', '1', '3.5', 'add_sales', '2015-05-20 18:10:49', '1', '1', null, '19', '145', '54');
INSERT INTO `product_transactions` VALUES ('310', '15', '10', '3.5', 'add_sales', '2015-05-20 18:18:56', '1', '1', null, '20', '146', '44');
INSERT INTO `product_transactions` VALUES ('311', '15', '40', '3.5', 'add_sales', '2015-05-20 18:24:26', '1', '1', null, '21', '147', '4');
INSERT INTO `product_transactions` VALUES ('312', '18', '2', '3', 'add_sales', '2015-05-20 18:24:26', '1', '1', null, '21', '147', '337');
INSERT INTO `product_transactions` VALUES ('313', '19', '1', '2.8', 'add_sales', '2015-05-20 18:24:26', '1', '1', null, '21', '147', '0');
INSERT INTO `product_transactions` VALUES ('314', '20', '1', '10', 'add_sales', '2015-05-20 18:24:26', '1', '1', null, '21', '147', '0');
INSERT INTO `product_transactions` VALUES ('315', '15', '3', '3.5', 'add_sales', '2015-05-20 18:34:14', '1', '1', null, '22', '148', '1');
INSERT INTO `product_transactions` VALUES ('316', '18', '10', '3', 'add_sales', '2015-05-20 18:36:55', '1', '1', null, '23', '149', '327');
INSERT INTO `product_transactions` VALUES ('317', '18', '1', '3', 'add_sales', '2015-05-20 18:39:31', '1', '1', null, '24', '150', '326');
INSERT INTO `product_transactions` VALUES ('318', '18', '1', '3', 'add_sales', '2015-05-20 18:43:11', '1', '1', null, '25', '151', '325');
INSERT INTO `product_transactions` VALUES ('319', '21', '5', '5', 'add_sales', '2015-05-20 18:43:11', '1', '1', null, '25', '151', '0');
INSERT INTO `product_transactions` VALUES ('320', '18', '3', '3', 'add_sales', '2015-05-20 18:47:22', '1', '1', null, '26', '152', '322');
INSERT INTO `product_transactions` VALUES ('321', '18', '300', '3', 'add_sales', '2015-05-20 18:55:46', '1', '1', null, '27', '153', '22');
INSERT INTO `product_transactions` VALUES ('322', '15', '1', '3.5', 'add_sales', '2015-05-20 18:55:46', '1', '1', null, '27', '153', '0');
INSERT INTO `product_transactions` VALUES ('323', '18', '20', '3', 'add_sales', '2015-05-20 18:57:33', '1', '1', null, '28', '154', '2');
INSERT INTO `product_transactions` VALUES ('324', '31', '1', '10', 'add_sales', '2015-05-20 18:57:33', '1', '1', null, '28', '154', '62');
INSERT INTO `product_transactions` VALUES ('325', '18', '2', '3', 'add_sales', '2015-05-20 19:04:03', '1', '1', null, '29', '155', '0');
INSERT INTO `product_transactions` VALUES ('326', '31', '50', '10', 'add_sales', '2015-05-20 19:04:03', '1', '1', null, '29', '155', '12');
INSERT INTO `product_transactions` VALUES ('327', '31', '5', '10', 'add_sales', '2015-05-20 19:37:54', '1', '1', null, '30', '156', '7');
INSERT INTO `product_transactions` VALUES ('328', '37', '5', '0', 'add_sales', '2015-05-20 19:37:54', '1', '1', null, '30', '156', '29');
INSERT INTO `product_transactions` VALUES ('329', '31', '7', '10', 'add_sales', '2015-05-20 19:39:29', '1', '1', null, '31', '157', '0');
INSERT INTO `product_transactions` VALUES ('330', '36', '45', '8', 'add_sales', '2015-05-20 19:39:29', '1', '1', null, '31', '157', '49');
INSERT INTO `product_transactions` VALUES ('331', '36', '40', '8', 'add_sales', '2015-05-20 19:41:56', '1', '1', null, '32', '158', '9');
INSERT INTO `product_transactions` VALUES ('332', '37', '20', '0', 'add_sales', '2015-05-20 19:41:56', '1', '1', null, '32', '158', '9');
INSERT INTO `product_transactions` VALUES ('333', '36', '2', '8', 'add_sales', '2015-05-20 19:46:10', '1', '1', null, '33', '159', '7');
INSERT INTO `product_transactions` VALUES ('334', '37', '1', '0', 'add_sales', '2015-05-20 19:46:10', '1', '1', null, '33', '159', '8');
INSERT INTO `product_transactions` VALUES ('335', '40', '34', '45', 'add_sales', '2015-05-20 19:48:51', '1', '1', null, '34', '160', '1');
INSERT INTO `product_transactions` VALUES ('336', '39', '12', '12', 'add_sales', '2015-05-20 19:48:51', '1', '1', null, '34', '160', '57');
INSERT INTO `product_transactions` VALUES ('337', '41', '1', '50', 'add_sales', '2015-05-20 19:53:00', '1', '1', null, '35', '161', '18');
INSERT INTO `product_transactions` VALUES ('338', '40', '1', '45', 'add_sales', '2015-05-20 19:53:00', '1', '1', null, '35', '161', '0');
INSERT INTO `product_transactions` VALUES ('339', '36', '6', '8', 'add_sales', '2015-05-20 19:57:22', '1', '1', null, '36', '162', '1');
INSERT INTO `product_transactions` VALUES ('340', '37', '5', '0', 'add_sales', '2015-05-20 19:57:22', '1', '1', null, '36', '162', '3');
INSERT INTO `product_transactions` VALUES ('341', '39', '5', '12', 'add_sales', '2015-05-20 19:57:22', '1', '1', null, '36', '162', '52');
INSERT INTO `product_transactions` VALUES ('342', '38', '5', '23', 'add_sales', '2015-05-20 19:57:22', '1', '1', null, '36', '162', '56');
INSERT INTO `product_transactions` VALUES ('343', '39', '8', '12', 'add_sales', '2015-05-20 20:07:36', '1', '1', null, '37', '163', '44');
INSERT INTO `product_transactions` VALUES ('344', '38', '8', '23', 'add_sales', '2015-05-20 20:07:36', '1', '1', null, '37', '163', '48');
INSERT INTO `product_transactions` VALUES ('345', '37', '3', '0', 'add_sales', '2015-05-20 20:07:36', '1', '1', null, '37', '163', '0');
INSERT INTO `product_transactions` VALUES ('346', '39', '2', '12', 'add_sales', '2015-05-20 20:19:58', '1', '1', null, '38', '164', '42');
INSERT INTO `product_transactions` VALUES ('347', '38', '1', '23', 'add_sales', '2015-05-20 20:19:58', '1', '1', null, '38', '164', '47');
INSERT INTO `product_transactions` VALUES ('348', '39', '10', '12', 'add_sales', '2015-05-20 20:22:38', '1', '1', null, '39', '165', '32');
INSERT INTO `product_transactions` VALUES ('349', '38', '5', '23', 'add_sales', '2015-05-20 20:22:38', '1', '1', null, '39', '165', '42');
INSERT INTO `product_transactions` VALUES ('350', '41', '5', '50', 'add_sales', '2015-05-20 20:22:38', '1', '1', null, '39', '165', '13');

-- ----------------------------
-- Table structure for `receipts`
-- ----------------------------
DROP TABLE IF EXISTS `receipts`;
CREATE TABLE `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `paid_status` enum('other','part_pay','refund','full_pay','pending') NOT NULL COMMENT '0 = Pending, 1 = full_payement, -1 = Cancelled,2=Refunded,3=Part',
  `currency` int(11) DEFAULT NULL,
  `amount_paid` double DEFAULT '0',
  `comment_cancelled` varchar(255) DEFAULT NULL,
  `balance_due` double DEFAULT '0',
  `total_amount_paid_prev` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sales_fk` (`sale_id`),
  KEY `staff_fk` (`staff_id`),
  CONSTRAINT `sales_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  CONSTRAINT `staff_fk` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of receipts
-- ----------------------------
INSERT INTO `receipts` VALUES ('1', '120', '1', '2015-05-19 19:20:57', 'other', null, '56', null, '26.51', null);
INSERT INTO `receipts` VALUES ('2', '121', '1', '2015-05-19 19:21:18', 'other', null, '56', null, '26.51', null);
INSERT INTO `receipts` VALUES ('3', '122', '1', '2015-05-19 19:31:50', 'other', null, '1', null, '81.51', '1');
INSERT INTO `receipts` VALUES ('4', '123', '1', '2015-05-19 19:35:56', 'other', null, '160', null, '5.03', '160');
INSERT INTO `receipts` VALUES ('6', '129', '1', '2015-05-19 19:55:07', 'other', null, '50', null, '32.51', '50');
INSERT INTO `receipts` VALUES ('7', '130', '1', '2015-05-19 19:55:42', 'other', null, '56', null, '26.51', '56');
INSERT INTO `receipts` VALUES ('8', '134', '1', '2015-05-19 20:32:54', 'other', null, '50', null, '32.51', '50');
INSERT INTO `receipts` VALUES ('9', '135', '1', '2015-05-19 20:33:10', 'other', null, '45', null, '37.51', '45');
INSERT INTO `receipts` VALUES ('10', '136', '1', '2015-05-20 16:41:44', 'other', null, '5', null, '5.25', '5');
INSERT INTO `receipts` VALUES ('11', '137', '1', '2015-05-20 16:46:21', 'other', null, '1', null, '5.66', '1');
INSERT INTO `receipts` VALUES ('12', '138', '1', '2015-05-20 17:29:29', 'other', null, '1', null, '81.51', '1');
INSERT INTO `receipts` VALUES ('13', '139', '1', '2015-05-20 17:29:55', 'other', null, '1', null, '81.51', '1');
INSERT INTO `receipts` VALUES ('14', '140', '1', '2015-05-20 17:46:44', 'other', null, '1', null, '132.76', '1');
INSERT INTO `receipts` VALUES ('15', '141', '1', '2015-05-20 17:50:50', 'other', null, '1', null, '5.66', '1');
INSERT INTO `receipts` VALUES ('16', '142', '1', '2015-05-20 17:55:28', 'other', null, '5', null, '1.66', '5');
INSERT INTO `receipts` VALUES ('17', '143', '1', '2015-05-20 17:59:32', 'other', null, '5', null, '1.66', '5');
INSERT INTO `receipts` VALUES ('18', '144', '1', '2015-05-20 18:08:45', 'other', null, '2', null, '9.48', '2');
INSERT INTO `receipts` VALUES ('19', '145', '1', '2015-05-20 18:10:49', 'other', null, '1', null, '2.59', '1');
INSERT INTO `receipts` VALUES ('20', '146', '1', '2015-05-20 18:18:56', 'other', null, '30', null, '5.88', '30');
INSERT INTO `receipts` VALUES ('21', '147', '1', '2015-05-20 18:24:26', 'other', null, '0', null, '162.77', '0');
INSERT INTO `receipts` VALUES ('22', '148', '1', '2015-05-20 18:34:14', 'other', null, '5', null, '5.76', '5');
INSERT INTO `receipts` VALUES ('23', '149', '1', '2015-05-20 18:36:55', 'other', null, '50', null, '-19.25', '50');
INSERT INTO `receipts` VALUES ('24', '150', '1', '2015-05-20 18:39:31', 'other', null, '2', null, '1.08', '2');
INSERT INTO `receipts` VALUES ('25', '151', '1', '2015-05-20 18:43:11', 'other', null, '2', null, '26.7', '2');
INSERT INTO `receipts` VALUES ('26', '152', '1', '2015-05-20 18:47:22', 'other', null, '4', null, '5.23', '4');
INSERT INTO `receipts` VALUES ('27', '153', '1', '2015-05-20 18:55:46', 'other', null, '500', null, '426.09', '500');
INSERT INTO `receipts` VALUES ('28', '154', '1', '2015-05-20 18:57:33', 'other', null, '50', null, '21.75', '50');
INSERT INTO `receipts` VALUES ('29', '155', '1', '2015-05-20 19:04:03', 'other', null, '500', null, '18.65', '500');
INSERT INTO `receipts` VALUES ('30', '156', '1', '2015-05-20 19:37:54', 'other', null, '50', null, '1.25', '50');
INSERT INTO `receipts` VALUES ('31', '157', '1', '2015-05-20 19:39:29', 'other', null, '400', null, '40.75', '400');
INSERT INTO `receipts` VALUES ('32', '158', '1', '2015-05-20 19:41:56', 'other', null, '300', null, '28', '300');
INSERT INTO `receipts` VALUES ('33', '159', '1', '2015-05-20 19:46:10', 'other', null, '15', null, '1.4', '15');
INSERT INTO `receipts` VALUES ('34', '160', '1', '2015-05-20 19:48:51', 'other', null, '1700', null, '15.85', '1700');
INSERT INTO `receipts` VALUES ('35', '161', '1', '2015-05-20 19:53:00', 'other', null, '50', null, '47.38', '50');
INSERT INTO `receipts` VALUES ('36', '162', '1', '2015-05-20 19:57:22', 'other', null, '200', null, '28.58', '200');
INSERT INTO `receipts` VALUES ('37', '163', '1', '2015-05-20 20:07:36', 'other', null, '200', null, '87', '200');
INSERT INTO `receipts` VALUES ('38', '164', '1', '2015-05-20 20:19:58', 'other', null, '34', null, '14.18', '34');
INSERT INTO `receipts` VALUES ('39', '165', '1', '2015-05-20 20:22:38', 'other', null, '400', null, '97.13', '400');

-- ----------------------------
-- Table structure for `receives`
-- ----------------------------
DROP TABLE IF EXISTS `receives`;
CREATE TABLE `receives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `sale_comments` varchar(255) DEFAULT NULL,
  `total_transaction` double NOT NULL,
  `total_amount_paid` double DEFAULT NULL,
  `total_balance_due` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `vat_used` float DEFAULT NULL,
  `transaction_type` enum('') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of receives
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of report_roles
-- ----------------------------
INSERT INTO `report_roles` VALUES ('23', '15', '1');
INSERT INTO `report_roles` VALUES ('25', '15', '3');
INSERT INTO `report_roles` VALUES ('39', '16', '4');

-- ----------------------------
-- Table structure for `reversals`
-- ----------------------------
DROP TABLE IF EXISTS `reversals`;
CREATE TABLE `reversals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `sale_comments` varchar(255) DEFAULT NULL,
  `total_transaction` double NOT NULL,
  `total_amount_paid` double DEFAULT NULL,
  `total_balance_due` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `vat_used` float DEFAULT NULL,
  `transaction_type` enum('') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reversals
-- ----------------------------

-- ----------------------------
-- Table structure for `reverse_reasons`
-- ----------------------------
DROP TABLE IF EXISTS `reverse_reasons`;
CREATE TABLE `reverse_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reverse_reasons
-- ----------------------------
INSERT INTO `reverse_reasons` VALUES ('1', 'Returned');
INSERT INTO `reverse_reasons` VALUES ('2', 'Broken');
INSERT INTO `reverse_reasons` VALUES ('3', 'Lost');
INSERT INTO `reverse_reasons` VALUES ('4', 'Stolen');
INSERT INTO `reverse_reasons` VALUES ('5', 'Expired');
INSERT INTO `reverse_reasons` VALUES ('6', 'Other');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_short_name` varchar(255) DEFAULT NULL,
  `role_long_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role_links
-- ----------------------------
INSERT INTO `role_links` VALUES ('6', '11', '3');
INSERT INTO `role_links` VALUES ('8', '20', '3');
INSERT INTO `role_links` VALUES ('25', '24', '1');
INSERT INTO `role_links` VALUES ('26', '25', '1');
INSERT INTO `role_links` VALUES ('27', '29', '1');
INSERT INTO `role_links` VALUES ('28', '30', '1');
INSERT INTO `role_links` VALUES ('29', '31', '1');

-- ----------------------------
-- Table structure for `sales`
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `total_transaction` double NOT NULL,
  `total_amount_paid` double DEFAULT NULL,
  `total_balance_due` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `vat_per` float DEFAULT NULL,
  `transaction_type` varchar(255) NOT NULL DEFAULT '',
  `total_items` int(11) DEFAULT NULL,
  `total_bvat` double DEFAULT NULL,
  `vat_transaction` float DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `reverse_reason` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `inst_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `reverse_reason` (`reverse_reason`),
  KEY `site_ibfk_2` (`site_id`),
  KEY `inst_fk` (`inst_id`),
  KEY `user_ibfk` (`user_id`),
  CONSTRAINT `inst_fk` FOREIGN KEY (`inst_id`) REFERENCES `institutions` (`id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`reverse_reason`) REFERENCES `reverse_reasons` (`id`),
  CONSTRAINT `site_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`),
  CONSTRAINT `user_ibfk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales
-- ----------------------------
INSERT INTO `sales` VALUES ('32', '2015-05-20 02:27:00', '10.25', '3', '7.25', '1', '2.5', 'add_sales', '3', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('33', '2015-05-20 02:27:01', '10.25', '3', '7.25', '1', '2.5', 'add_sales', '3', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('34', '2015-05-21 02:27:03', '10.25', '3', '7.25', '1', '2.5', 'add_sales', '3', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('43', '2015-05-21 02:27:18', '758.19', '180', '578.19', '1', '2.5', 'add_sales', '167', '739.7', '18.49', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('45', '2015-05-21 02:27:24', '275.73', '6', '269.73', '1', '2.5', 'add_sales', '84', '269', '6.73', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('46', '2015-05-21 02:27:25', '1258.7', '90', '1168.7', '1', '2.5', 'add_sales', '408', '1228', '30.7', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('47', '2015-05-21 02:27:26', '17.84', '5', '12.84', '1', '2.5', 'add_sales', '6', '17.4', '0.44', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('48', '2015-05-21 02:27:27', '16.4', '15', '1.4', '1', '2.5', 'add_sales', '3', '16', '0.4', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('49', '2015-05-21 02:27:28', '30.75', '2', '28.75', '1', '2.5', 'add_sales', '4', '30', '0.75', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('50', '2015-05-21 02:27:28', '15.38', '10', '5.38', '1', '2.5', 'add_sales', '5', '15', '0.38', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('51', '2015-05-21 02:27:29', '15.38', '1', '14.38', '1', '2.5', 'add_sales', '2', '15', '0.38', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('52', '2015-05-21 02:27:30', '15.38', '12', '3.38', '1', '2.5', 'add_sales', '2', '15', '0.38', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('53', '2015-05-21 02:27:30', '671.38', '600', '71.38', '1', '2.5', 'add_sales', '77', '655', '16.38', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('54', '2015-05-21 02:27:31', '76.88', '0', '76.88', '1', '2.5', 'add_sales', '25', '75', '1.88', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('55', '2015-05-21 02:27:33', '3.08', '2', '1.08', '1', '2.5', 'add_sales', '1', '3', '0.08', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('56', '2015-05-21 02:27:37', '3.08', '2', '1.08', '1', '2.5', 'add_sales', '1', '3', '0.08', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('57', '2015-05-21 02:27:39', '3.08', '2', '1.08', '1', '2.5', 'add_sales', '1', '3', '0.08', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('58', '2015-05-21 02:27:40', '10.25', '5', '5.25', '1', '2.5', 'add_sales', '1', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('59', '2015-05-21 02:27:41', '10.25', '10', '0.25', '1', '2.5', 'add_sales', '1', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('60', '2015-05-21 02:27:47', '102.5', '100', '2.5', '1', '2.5', 'add_sales', '5', '100', '2.5', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('61', '2015-05-21 02:08:52', '41', '40', '1', '1', '2.5', 'add_sales', '4', '40', '1', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('62', '2015-05-21 02:08:52', '10.25', '10', '0.25', '1', '2.5', 'add_sales', '1', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('63', '2015-05-21 02:08:52', '115.83', '0', '115.83', '1', '2.5', 'add_recv', '18', '113', '2.83', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('64', '2015-05-21 02:08:52', '28.6', '0', '28.6', '1', '2.5', 'add_inv', '9', '27.9', '0.7', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('65', '2015-05-21 02:08:52', '10.25', '50', '-39.75', '1', '2.5', 'add_sales', '1', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('66', '2015-05-21 02:08:52', '10.25', '1', '9.25', '1', '2.5', 'add_sales', '1', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('67', '2015-05-21 02:08:52', '20', '0', '20', '1', '0', 'add_recv', '2', '20', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('68', '2015-05-21 02:08:52', '51.25', '0', '51.25', '1', '2.5', 'add_inv', '5', '50', '1.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('69', '2015-05-21 02:08:52', '17.5', '0', '0', '1', '0', 'add_recv', '5', '17.5', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('70', '2015-05-21 02:08:52', '9000', '0', '0', '1', '0', 'add_recv', '100', '9000', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('71', '2015-05-21 02:08:52', '900', '0', '0', '1', '0', 'add_revr', '10', '900', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('72', '2015-05-21 02:08:52', '3.59', '6', '-2.41', '1', '2.5', 'add_sales', '1', '3.5', '0.09', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('73', '2015-05-21 02:08:52', '3.5', '0', '0', '1', '0', 'add_revr', '1', '3.5', '0', null, '1', '0', null, '1');
INSERT INTO `sales` VALUES ('74', '2015-05-21 02:08:52', '270', '0', '0', '1', '0', 'add_recv', '18', '270', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('75', '2015-05-21 02:08:52', '46.13', '5', '41.13', '1', '2.5', 'add_sales', '3', '45', '1.13', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('76', '2015-05-21 02:08:52', '61.5', '23', '38.5', '1', '2.5', 'add_sales', '4', '60', '1.5', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('77', '2015-05-21 02:08:52', '8638.7', '8000.7', '638', '1', '2.5', 'add_sales', '128', '8428', '210.7', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('78', '2015-05-21 02:08:52', '256.25', '450', '-193.75', '1', '2.5', 'add_sales', '17', '250', '6.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('79', '2015-05-21 02:08:52', '14', '0', '0', '1', '0', 'add_recv', '4', '14', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('80', '2015-05-21 02:08:52', '800', '0', '0', '1', '0', 'add_recv', '100', '800', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('81', '2015-05-21 02:08:52', '10.5', '0', '0', '1', '0', 'add_revr', '3', '10.5', '0', null, '1', '0', null, '1');
INSERT INTO `sales` VALUES ('82', '2015-05-21 02:08:52', '40', '0', '0', '1', '0', 'add_revr', '5', '40', '0', null, '2', '0', null, '1');
INSERT INTO `sales` VALUES ('83', '2015-05-21 02:08:52', '40', '0', '0', '1', '0', 'add_recv', '5', '40', '0', null, null, '502', null, '1');
INSERT INTO `sales` VALUES ('84', '2015-05-21 02:08:52', '67.14', '61.87', '5.27', '1', '2.5', 'add_sales', '11', '65.5', '1.64', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('85', '2015-05-21 02:08:52', '718', '0', '0', '1', '0', 'add_recv', '58', '718', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('86', '2015-05-21 02:08:52', '558.63', '500', '58.63', '1', '2.5', 'add_sales', '54', '545', '13.63', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('87', '2015-05-21 02:08:52', '1281', '0', '0', '1', '0', 'add_recv', '414', '1281', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('88', '2015-05-21 02:08:52', '4500', '0', '0', '1', '0', 'add_recv', '134', '4500', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('89', '2015-05-21 02:08:52', '1150', '0', '0', '1', '0', 'add_recv', '50', '1150', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('90', '2015-05-21 02:08:52', '4274.25', '400', '3874.25', '1', '2.5', 'add_sales', '100', '4170', '104.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('91', '2015-05-21 02:08:52', '890', '0', '0', '1', '0', 'add_recv', '32', '890', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('92', '2015-05-21 02:08:52', '570', '0', '0', '1', '0', 'add_recv', '20', '570', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('93', '2015-05-21 02:08:52', '57', '0', '0', '1', '0', 'add_recv', '2', '57', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('94', '2015-05-21 02:08:52', '57', '0', '0', '1', '0', 'add_recv', '2', '57', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('95', '2015-05-21 02:08:52', '57', '0', '0', '1', '0', 'add_recv', '2', '57', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('118', '2015-05-21 02:08:52', '2610', '0', '0', '1', '0', 'add_recv', '60', '2610', '0', null, null, '502', null, '1');
INSERT INTO `sales` VALUES ('119', '2015-05-21 02:08:52', '80.5', '0', '0', '1', '0', 'add_recv', '2', '80.5', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('120', '2015-05-21 02:08:52', '82.51', '56', '26.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('121', '2015-05-21 02:08:52', '82.51', '56', '26.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('122', '2015-05-21 02:08:52', '82.51', '1', '81.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('123', '2015-05-21 02:08:52', '165.03', '160', '5.03', '1', '2.5', 'add_sales', '4', '161', '4.03', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('124', '2015-05-21 02:08:52', '241.5', '0', '0', '1', '0', 'add_recv', '6', '241.5', '0', null, null, '503', null, '1');
INSERT INTO `sales` VALUES ('125', '2015-05-21 02:08:52', '1732.76', '0', '0', '1', '2.5', 'add_inv', '33', '1690.5', '42.26', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('126', '2015-05-21 02:08:52', '80.5', '0', '0', '1', '0', 'add_revr', '5', '80.5', '0', null, '1', '0', null, '1');
INSERT INTO `sales` VALUES ('127', '2015-05-21 02:08:52', '1207.5', '0', '0', '1', '0', 'add_revr', '27', '1207.5', '0', null, '1', '0', null, '1');
INSERT INTO `sales` VALUES ('129', '2015-05-21 02:08:52', '82.51', '50', '32.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('130', '2015-05-21 02:08:52', '82.51', '56', '26.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('131', '2015-05-21 02:08:52', '724.5', '0', '0', '1', '0', 'add_recv', '18', '724.5', '0', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('132', '2015-05-21 02:08:52', '82.51', '0', '0', '1', '2.5', 'add_inv', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('133', '2015-05-21 02:08:52', '402.5', '0', '0', '1', '0', 'add_revr', '10', '402.5', '0', null, '1', '0', null, '1');
INSERT INTO `sales` VALUES ('134', '2015-05-21 02:08:52', '82.51', '50', '32.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('135', '2015-05-21 02:08:52', '82.51', '45', '37.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('136', '2015-05-21 02:08:52', '10.25', '5', '5.25', '1', '2.5', 'add_sales', '3', '10', '0.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('137', '2015-05-21 02:08:52', '6.66', '1', '5.66', '1', '2.5', 'add_sales', '2', '6.5', '0.16', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('138', '2015-05-21 02:08:52', '82.51', '1', '81.51', '1', '2.5', 'add_sales', '2', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('139', '2015-05-21 02:08:52', '82.51', '1', '81.51', '1', '2.5', 'add_sales', '3', '80.5', '2.01', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('140', '2015-05-21 02:08:52', '133.76', '1', '132.76', '1', '2.5', 'add_sales', '2', '130.5', '3.26', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('141', '2015-05-21 02:08:52', '6.66', '1', '5.66', '1', '2.5', 'add_sales', '2', '6.5', '0.16', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('142', '2015-05-21 02:08:52', '6.66', '5', '1.66', '1', '2.5', 'add_sales', '2', '6.5', '0.16', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('143', '2015-05-21 02:08:52', '6.66', '5', '1.66', '1', '2.5', 'add_sales', '2', '6.5', '0.16', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('144', '2015-05-21 02:08:52', '11.48', '2', '9.48', '1', '2.5', 'add_sales', '4', '11.2', '0.28', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('145', '2015-05-21 02:08:52', '3.59', '1', '2.59', '1', '2.5', 'add_sales', '1', '3.5', '0.09', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('146', '2015-05-21 02:08:52', '35.88', '30', '5.88', '1', '2.5', 'add_sales', '10', '35', '0.88', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('147', '2015-05-21 02:08:52', '162.77', '0', '162.77', '1', '2.5', 'add_sales', '44', '158.8', '3.97', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('148', '2015-05-21 02:08:52', '10.76', '5', '5.76', '1', '2.5', 'add_sales', '3', '10.5', '0.26', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('149', '2015-05-21 02:08:52', '30.75', '50', '-19.25', '1', '2.5', 'add_sales', '10', '30', '0.75', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('150', '2015-05-21 02:08:52', '3.08', '2', '1.08', '1', '2.5', 'add_sales', '1', '3', '0.08', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('151', '2015-05-21 02:08:52', '28.7', '2', '26.7', '1', '2.5', 'add_sales', '6', '28', '0.7', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('152', '2015-05-21 02:08:52', '9.23', '4', '5.23', '1', '2.5', 'add_sales', '3', '9', '0.23', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('153', '2015-05-21 02:08:52', '926.09', '500', '426.09', '1', '2.5', 'add_sales', '301', '903.5', '22.59', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('154', '2015-05-21 02:08:52', '71.75', '50', '21.75', '1', '2.5', 'add_sales', '21', '70', '1.75', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('155', '2015-05-21 02:08:52', '518.65', '500', '18.65', '1', '2.5', 'add_sales', '52', '506', '12.65', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('156', '2015-05-21 02:08:52', '51.25', '50', '1.25', '1', '2.5', 'add_sales', '10', '50', '1.25', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('157', '2015-05-21 02:08:52', '440.75', '400', '40.75', '1', '2.5', 'add_sales', '52', '430', '10.75', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('158', '2015-05-21 02:08:52', '328', '300', '28', '1', '2.5', 'add_sales', '60', '320', '8', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('159', '2015-05-21 02:08:52', '16.4', '15', '1.4', '1', '2.5', 'add_sales', '3', '16', '0.4', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('160', '2015-05-21 02:08:52', '1715.85', '1700', '15.85', '1', '2.5', 'add_sales', '46', '1674', '41.85', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('161', '2015-05-21 02:08:52', '97.38', '50', '47.38', '1', '2.5', 'add_sales', '2', '95', '2.38', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('162', '2015-05-21 02:08:52', '228.58', '200', '28.58', '1', '2.5', 'add_sales', '21', '223', '5.58', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('163', '2015-05-21 02:08:52', '287', '200', '87', '1', '2.5', 'add_sales', '19', '280', '7', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('164', '2015-05-21 02:08:52', '48.18', '34', '14.18', '1', '2.5', 'add_sales', '3', '47', '1.18', null, null, '0', null, '1');
INSERT INTO `sales` VALUES ('165', '2015-05-21 02:08:52', '497.13', '400', '97.13', '1', '2.5', 'add_sales', '20', '485', '12.13', null, null, '0', null, '1');

-- ----------------------------
-- Table structure for `sales_jn`
-- ----------------------------
DROP TABLE IF EXISTS `sales_jn`;
CREATE TABLE `sales_jn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `sale_comments` varchar(255) DEFAULT NULL,
  `total_transaction` double NOT NULL,
  `total_amount_paid` double DEFAULT NULL,
  `total_balance_due` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `vat_per` float DEFAULT NULL,
  `transaction_type` varchar(255) NOT NULL DEFAULT '',
  `total_items` int(11) DEFAULT NULL,
  `total_bvat` double DEFAULT NULL,
  `vat_transaction` float DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_jn
-- ----------------------------
INSERT INTO `sales_jn` VALUES ('32', '2015-05-14 02:21:53', null, '10.25', '3', '7.25', '1', '2.5', '', '3', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('33', '2015-05-14 02:22:45', null, '10.25', '3', '7.25', '1', '2.5', '', '3', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('34', '2015-05-14 02:24:47', null, '10.25', '3', '7.25', '1', '2.5', '', '3', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('43', '2015-05-15 04:02:43', null, '758.19', '180', '578.19', '1', '2.5', '', '167', '739.7', '18.49', null);
INSERT INTO `sales_jn` VALUES ('45', '2015-05-15 04:11:53', null, '275.73', '6', '269.73', '1', '2.5', '', '84', '269', '6.73', null);
INSERT INTO `sales_jn` VALUES ('46', '2015-05-15 04:21:07', null, '1258.7', '90', '1168.7', '1', '2.5', '', '408', '1228', '30.7', null);
INSERT INTO `sales_jn` VALUES ('47', '2015-05-15 04:23:50', null, '17.84', '5', '12.84', '1', '2.5', '', '6', '17.4', '0.44', null);
INSERT INTO `sales_jn` VALUES ('48', '2015-05-15 04:28:19', null, '16.4', '15', '1.4', '1', '2.5', '', '3', '16', '0.4', null);
INSERT INTO `sales_jn` VALUES ('49', '2015-05-15 04:32:57', null, '30.75', '2', '28.75', '1', '2.5', '', '4', '30', '0.75', null);
INSERT INTO `sales_jn` VALUES ('50', '2015-05-15 04:47:29', null, '15.38', '10', '5.38', '1', '2.5', '', '5', '15', '0.38', null);
INSERT INTO `sales_jn` VALUES ('51', '2015-05-15 04:55:15', null, '15.38', '1', '14.38', '1', '2.5', '', '2', '15', '0.38', null);
INSERT INTO `sales_jn` VALUES ('52', '2015-05-15 04:56:51', null, '15.38', '12', '3.38', '1', '2.5', '', '2', '15', '0.38', null);
INSERT INTO `sales_jn` VALUES ('53', '2015-05-15 04:57:27', null, '671.38', '600', '71.38', '1', '2.5', '', '77', '655', '16.38', null);
INSERT INTO `sales_jn` VALUES ('54', '2015-05-15 21:59:59', null, '76.88', '0', '76.88', '1', '2.5', '', '25', '75', '1.88', null);
INSERT INTO `sales_jn` VALUES ('55', '2015-05-15 22:43:24', null, '3.08', '2', '1.08', '1', '2.5', '', '1', '3', '0.08', null);
INSERT INTO `sales_jn` VALUES ('56', '2015-05-15 22:43:50', null, '3.08', '2', '1.08', '1', '2.5', '', '1', '3', '0.08', null);
INSERT INTO `sales_jn` VALUES ('57', '2015-05-15 22:44:11', null, '3.08', '2', '1.08', '1', '2.5', '', '1', '3', '0.08', null);
INSERT INTO `sales_jn` VALUES ('58', '2015-05-15 23:21:56', null, '10.25', '5', '5.25', '1', '2.5', '', '1', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('59', '2015-05-15 23:27:23', null, '10.25', '10', '0.25', '1', '2.5', '', '1', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('60', '2015-05-15 23:29:10', null, '102.5', '100', '2.5', '1', '2.5', '', '5', '100', '2.5', null);
INSERT INTO `sales_jn` VALUES ('61', '2015-05-15 23:32:38', null, '41', '40', '1', '1', '2.5', 'add_sales', '4', '40', '1', null);
INSERT INTO `sales_jn` VALUES ('62', '2015-05-16 00:44:09', null, '10.25', '10', '0.25', '1', '2.5', 'add_sales', '1', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('63', '2015-05-16 00:47:34', null, '115.83', '0', '115.83', '1', '2.5', 'add_recv', '18', '113', '2.83', null);
INSERT INTO `sales_jn` VALUES ('64', '2015-05-16 00:50:34', null, '28.6', '0', '28.6', '1', '2.5', 'add_inv', '9', '27.9', '0.7', null);
INSERT INTO `sales_jn` VALUES ('65', '2015-05-16 01:12:16', null, '10.25', '50', '-39.75', '1', '2.5', 'add_sales', '1', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('66', '2015-05-16 01:25:10', null, '10.25', '1', '9.25', '1', '2.5', 'add_sales', '1', '10', '0.25', null);
INSERT INTO `sales_jn` VALUES ('67', '2015-05-16 01:25:34', null, '20', '0', '20', '1', '0', 'add_recv', '2', '20', '0', null);
INSERT INTO `sales_jn` VALUES ('68', '2015-05-16 01:26:50', null, '51.25', '0', '51.25', '1', '2.5', 'add_inv', '5', '50', '1.25', null);
INSERT INTO `sales_jn` VALUES ('69', '2015-05-16 01:43:07', null, '17.5', '0', '0', '1', '0', 'add_recv', '5', '17.5', '0', null);

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
  `email` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `cell_number` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `alternate_phone` varchar(50) DEFAULT NULL,
  `membership_start_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `site_id` int(10) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `archive_status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_fk` (`site_id`),
  KEY `cat_fk` (`cat_id`),
  CONSTRAINT `cat_fk` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `site_fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('502', 'nayibor@gmail.com', 'Nuku Ameyibor', 'kINTE', null, null, null, null, null, '', '87070800987', null, null, '2014-01-25 10:01:02', '1', '5', null);
INSERT INTO `suppliers` VALUES ('503', 'ky@gmail.com', 'Kwame Gyan', '', null, null, null, null, null, '', '70708770', null, null, '2015-05-17 22:58:08', '4', '2', null);

-- ----------------------------
-- Table structure for `taxes`
-- ----------------------------
DROP TABLE IF EXISTS `taxes`;
CREATE TABLE `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vat_short_name` varchar(255) NOT NULL,
  `vat_value` double NOT NULL,
  `vat_long_name` varchar(255) NOT NULL,
  `vat_category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of taxes
-- ----------------------------
INSERT INTO `taxes` VALUES ('1', 'VAT', '2.5', 'Value Added Tax', 'sales');

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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'a3ca38ef0e8554b39ce6fd34b011f9aa197cda1f17e2b08b1816142c4bc67199', 'Ya0', 'Ameyibor', '1', 'nayibor@gmail.com', '0', '2014-09-25 12:01:05', null);
INSERT INTO `users` VALUES ('82', 'a1d980c77067c1ebc2010a63beb0d550f5313a20149f52caaa5899c4b3452f42', 'n4newnew', 'Fresh', '1', 'n4@gmail.com', '0', '2014-09-11 09:59:02', null);
INSERT INTO `users` VALUES ('83', 'da781a0732aa99c9a232666454ef368514fe457129661f058cfe26590fd7e0f0', 'Freshman', 'freshfresh', '1', 'fresh@fr.com', '0', '2014-08-22 21:23:50', null);
INSERT INTO `users` VALUES ('85', '1c6334dd23bddc483d7dbc8e1ad6c13713294e1b322739a2286f1ea404ef804f', 'Pearl', 'Tester', '1', 'freshndice@fr.com', '0', '2014-09-11 09:52:20', null);
INSERT INTO `users` VALUES ('87', '0f1c7e12d749445b41d98c451eb368c3b8b47c1465ca1fdec5df75107c5d6eee', 'alima', 'shardow', '9', 'a.shardow', '0', '2014-09-11 10:00:39', null);
INSERT INTO `users` VALUES ('88', 'b698ddb15c4cef76191858f5006ea7c62ba51444209769f6f6a1f36818788282', 'happy', 'darlington', '9', 'h.dall', '0', '2015-04-07 22:21:06', null);
INSERT INTO `users` VALUES ('89', 'cb3db663d427542c3fb2d15f230ae7fa4985be115ba87690f26e727543a9f054', 'marie', 'offeh', '9', 'marieoffeh@gmail.com', '0', '2014-09-11 09:59:59', null);
INSERT INTO `users` VALUES ('90', '80c016f51ea65fa535484990a4474e081cc73fe9eadd756efd3858cd3c134a4a', 'aziz', 'abdul', '9', 'a.aziz', '0', '2015-04-14 14:57:29', null);
INSERT INTO `users` VALUES ('91', '961bc1f1bc2ff2df7cf5a33834896384060d35190ba35dce841fefafa3bcdf62', 'testne', 'asfd', '4', 'asdf', '0', '2015-05-12 03:19:17', null);
INSERT INTO `users` VALUES ('92', '', null, null, null, null, '1', null, null);
INSERT INTO `users` VALUES ('93', '', null, null, null, null, '1', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

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
INSERT INTO `user_roles` VALUES ('177', '1', '90');
