/*
Navicat MySQL Data Transfer

Source Server         : OsPanel
Source Server Version : 50638
Source Host           : localhost:3306
Source Database       : mynails

Target Server Type    : MYSQL
Target Server Version : 50638
File Encoding         : 65001

Date: 2019-04-30 23:14:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------

-- ----------------------------
-- Table structure for `masters`
-- ----------------------------
DROP TABLE IF EXISTS `masters`;
CREATE TABLE `masters` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of masters
-- ----------------------------
INSERT INTO `masters` VALUES ('1', 'Иван', '+79445246689', null, 'уцкцукjsidfj');
INSERT INTO `masters` VALUES ('2', 'Алина', '+7954878', null, 'ijiewrsdxcv');

-- ----------------------------
-- Table structure for `masters_services`
-- ----------------------------
DROP TABLE IF EXISTS `masters_services`;
CREATE TABLE `masters_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of masters_services
-- ----------------------------
INSERT INTO `masters_services` VALUES ('1', '1', '1');
INSERT INTO `masters_services` VALUES ('2', '1', '2');
INSERT INTO `masters_services` VALUES ('3', '2', '1');

-- ----------------------------
-- Table structure for `schedules`
-- ----------------------------
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) DEFAULT NULL,
  `service_id` int(12) NOT NULL,
  `master_id` int(12) NOT NULL,
  `time` int(12) NOT NULL,
  `day` varchar(64) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of schedules
-- ----------------------------
INSERT INTO `schedules` VALUES ('1', null, '1', '1', '1556650435', null, '1');

-- ----------------------------
-- Table structure for `services`
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `price` int(12) NOT NULL,
  `time` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of services
-- ----------------------------
INSERT INTO `services` VALUES ('1', 'Ноготки', '500', '60');
INSERT INTO `services` VALUES ('2', 'Красочно', '600', '70');
