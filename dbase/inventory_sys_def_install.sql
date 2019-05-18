/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50546
Source Host           : localhost:3306
Source Database       : inventory_sys_def

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2015-12-19 22:06:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(255) NOT NULL,
  `long_name` varchar(255) DEFAULT NULL,
  `inst_id` int(255) NOT NULL DEFAULT '0',
  `site_id` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'OTHER', 'OTHER DRINKS', '1', '1');
INSERT INTO `categories` VALUES ('2', 'LQ', 'HARD LIQUOR', '1', '1');
INSERT INTO `categories` VALUES ('3', 'SOFT', 'SOFT DRINKSAZ', '1', '1');
INSERT INTO `categories` VALUES ('4', 'EPR', 'Eprocess', '11', '1');
INSERT INTO `categories` VALUES ('5', 'BVG', 'BEVERAGE', '11', '1');
INSERT INTO `categories` VALUES ('6', 'ITSTUFF', 'general it stuffd', '11', '1');
INSERT INTO `categories` VALUES ('7', 'Shirts', 'short sleeve shirts', '11', '1');

-- ----------------------------
-- Table structure for `institutions`
-- ----------------------------
DROP TABLE IF EXISTS `institutions`;
CREATE TABLE `institutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inst_short_name` varchar(255) DEFAULT NULL,
  `inst_long_name` varchar(255) DEFAULT NULL,
  `inst_lock` int(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image_cus_site` mediumblob,
  `rec_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of institutions
-- ----------------------------
INSERT INTO `institutions` VALUES ('1', 'Local-First', 'Localhost -First ', '1', 'fasdf@hay.com', '98707', '0245707630', 'fracni', 'fuck this shit', 'jjj', null, '2015-07-24 16:22:36');

-- ----------------------------
-- Table structure for `invoices`
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp  ,
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

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
INSERT INTO `links` VALUES ('32', 'Customer', 'view_receipt_trans', 'true', 'Reception', 'View Summary Receipts', null);
INSERT INTO `links` VALUES ('33', 'Customer', 'get_sales_info_list', 'true', 'Print', 'Print Stuff', null);

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
-- Table structure for `product_barc_info`
-- ----------------------------
DROP TABLE IF EXISTS `product_barc_info`;
CREATE TABLE `product_barc_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_barcode` varchar(255) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
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
  `receipt_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `new_stock_product` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_product_fk` (`product_id`),
  KEY `trans_user_fk` (`user_id`),
  KEY `receipt_sales` (`receipt_id`),
  KEY `sale_fk` (`sale_id`),
  CONSTRAINT `receipt_sales` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`),
  CONSTRAINT `sale_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  CONSTRAINT `trans_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `trans_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=598 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_transactions
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
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  `user_id` int(20) NOT NULL,
  `product_batch` int(11) DEFAULT NULL,
  `product_expiry` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `archive_status` int(11) NOT NULL DEFAULT '0',
  `min_stock_notif` int(11) NOT NULL DEFAULT '1',
  `max_stock_notif` int(11) NOT NULL DEFAULT '10000000',
  PRIMARY KEY (`id`),
  KEY `product_name_index` (`product_name`),
  KEY `category_product` (`category_product`),
  KEY `stock` (`stock_available`) USING BTREE,
  CONSTRAINT `category_product` FOREIGN KEY (`category_product`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------

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
  `date_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  `user_id` int(20) NOT NULL,
  `product_batch` int(11) DEFAULT NULL,
  `product_expiry` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  `archive_status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_name_index` (`product_name`),
  KEY `category_product` (`category_product`),
  CONSTRAINT `products_jn_ibfk_1` FOREIGN KEY (`category_product`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products_jn
-- ----------------------------

-- ----------------------------
-- Table structure for `receipts`
-- ----------------------------
DROP TABLE IF EXISTS `receipts`;
CREATE TABLE `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `transaction_timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `paid_status` enum('other','part_pay','refund','full_pay','excess','pending') NOT NULL COMMENT '0 = Pending, 1 = full_payement, -1 = Cancelled,2=Refunded,3=Part',
  `currency` int(11) DEFAULT NULL,
  `amount_paid` double DEFAULT '0',
  `comment_cancelled` varchar(255) DEFAULT NULL,
  `balance_due` double DEFAULT '0',
  `total_amount_paid_prev` double DEFAULT '0',
  `inst_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_fk` (`sale_id`),
  KEY `staff_fk` (`staff_id`),
  CONSTRAINT `sales_fk` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  CONSTRAINT `staff_fk` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of receipts
-- ----------------------------

-- ----------------------------
-- Table structure for `receipts_jn`
-- ----------------------------
DROP TABLE IF EXISTS `receipts_jn`;
CREATE TABLE `receipts_jn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `transaction_timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `paid_status` enum('other','part_pay','refund','full_pay','pending') NOT NULL COMMENT '0 = Pending, 1 = full_payement, -1 = Cancelled,2=Refunded,3=Part',
  `currency` int(11) DEFAULT NULL,
  `amount_paid` double DEFAULT '0',
  `comment_cancelled` varchar(255) DEFAULT NULL,
  `balance_due` double DEFAULT '0',
  `total_amount_paid_prev` double DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sales_fk` (`sale_id`),
  KEY `staff_fk` (`staff_id`),
  CONSTRAINT `receipts_jn_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  CONSTRAINT `receipts_jn_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of receipts_jn
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role_links
-- ----------------------------
INSERT INTO `role_links` VALUES ('6', '11', '3');
INSERT INTO `role_links` VALUES ('8', '20', '3');
INSERT INTO `role_links` VALUES ('25', '24', '1');
INSERT INTO `role_links` VALUES ('26', '25', '1');
INSERT INTO `role_links` VALUES ('27', '29', '1');
INSERT INTO `role_links` VALUES ('29', '31', '1');
INSERT INTO `role_links` VALUES ('30', '30', '1');
INSERT INTO `role_links` VALUES ('31', '32', '1');
INSERT INTO `role_links` VALUES ('32', '22', '4');

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
-- Table structure for `sales`
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
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
  `transaction_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reverse_reason` (`reverse_reason`),
  KEY `site_ibfk_2` (`site_id`),
  KEY `inst_fk` (`inst_id`),
  KEY `user_ibfk` (`user_id`),
  CONSTRAINT `inst_fk` FOREIGN KEY (`inst_id`) REFERENCES `institutions` (`id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`reverse_reason`) REFERENCES `reverse_reasons` (`id`),
  CONSTRAINT `site_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`),
  CONSTRAINT `user_ibfk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales
-- ----------------------------

-- ----------------------------
-- Table structure for `sales_jn`
-- ----------------------------
DROP TABLE IF EXISTS `sales_jn`;
CREATE TABLE `sales_jn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
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
  `site_lock` varchar(10) NOT NULL DEFAULT '0',
  `site_desc` text,
  `rec_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `inst-fk` (`site_inst_id`),
  CONSTRAINT `inst-fk` FOREIGN KEY (`site_inst_id`) REFERENCES `institutions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES ('1', 'Default_Site', 'ASDFASFASFSDFSFSF2345345QWASASDF', '1', 'Piedras 623\r\nPiso 2, depto 4\r\nC1070AAM, Capital Federal', 'bora bora', '12456789', '1234123456789123', 'inv@inv.com', '1', 'this is the default site for use with all new installations', '2015-12-19 21:49:37');

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
  `inst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_fk` (`site_id`),
  KEY `cat_fk` (`cat_id`),
  CONSTRAINT `cat_fk` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `site_fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of suppliers
-- ----------------------------

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
  `site_id` int(11) DEFAULT NULL,
  `inst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of taxes
-- ----------------------------
INSERT INTO `taxes` VALUES ('1', 'VAT', '2.5', 'Value Added Tax', 'sales', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES ('174', '1', '1');
INSERT INTO `user_roles` VALUES ('175', '3', '1');
INSERT INTO `user_roles` VALUES ('176', '4', '1');

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
  `inst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`user_email`),
  KEY `site-fk` (`site_id`),
  CONSTRAINT `site-fk` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '$2a$07$27sJfClkLgS0jAziKzZ8iuZNhYJguQTeLEXLc8kD.JiyxTYPAEa2u', 'Admin', 'Default', '1', 'inv@inv.com', '0', '2015-12-19 21:48:15', '1');
