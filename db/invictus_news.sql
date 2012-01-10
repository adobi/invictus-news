/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : invictus_news

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-01-10 16:51:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `in_bridge`
-- ----------------------------
DROP TABLE IF EXISTS `in_bridge`;
CREATE TABLE `in_bridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rumor_id` int(11) DEFAULT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_bridge
-- ----------------------------
INSERT INTO `in_bridge` VALUES ('71', '8', '4', '32', '1326210649_mistbouncer_150.png', 'Bootstrap, from Twitter', 'http://twitter.github.com/bootstrap/');
INSERT INTO `in_bridge` VALUES ('72', '8', '2', '32', '1326210344_santa_oldalso.png', 'Bootstrap, from Twitter', 'http://twitter.github.com/bootstrap/');

-- ----------------------------
-- Table structure for `in_game`
-- ----------------------------
DROP TABLE IF EXISTS `in_game`;
CREATE TABLE `in_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_game
-- ----------------------------
INSERT INTO `in_game` VALUES ('1', 'PinFrog');
INSERT INTO `in_game` VALUES ('2', 'Fly Fu Pro');
INSERT INTO `in_game` VALUES ('3', 'Truck Jam');
INSERT INTO `in_game` VALUES ('4', 'Froggy Launcher');
INSERT INTO `in_game` VALUES ('5', 'Fly Fu PSP');
INSERT INTO `in_game` VALUES ('6', 'Fly Control HD');
INSERT INTO `in_game` VALUES ('7', 'Picosaic HD');
INSERT INTO `in_game` VALUES ('8', 'Froggy Jump');
INSERT INTO `in_game` VALUES ('9', 'Blastwave ');
INSERT INTO `in_game` VALUES ('10', '4x4 Jam PSP');
INSERT INTO `in_game` VALUES ('11', 'Brim!');
INSERT INTO `in_game` VALUES ('12', 'Rollit - Smartly');
INSERT INTO `in_game` VALUES ('13', 'Grim Filler');
INSERT INTO `in_game` VALUES ('14', 'Picosaic');
INSERT INTO `in_game` VALUES ('15', '4x4 Jam');
INSERT INTO `in_game` VALUES ('16', 'The Escapee');
INSERT INTO `in_game` VALUES ('17', 'Level-R / Heat Online');
INSERT INTO `in_game` VALUES ('18', 'Cross Racing Championship');
INSERT INTO `in_game` VALUES ('19', 'LA. Street Racing');
INSERT INTO `in_game` VALUES ('20', 'Monster Garage');
INSERT INTO `in_game` VALUES ('21', 'Street Legal');
INSERT INTO `in_game` VALUES ('22', 'Street Legal Racing Redline');
INSERT INTO `in_game` VALUES ('23', '1NSANE');
INSERT INTO `in_game` VALUES ('24', 'Overspeed');
INSERT INTO `in_game` VALUES ('25', 'Invictus Live!');
INSERT INTO `in_game` VALUES ('26', 'Santa Ride! 1 & 2');
INSERT INTO `in_game` VALUES ('27', 'Fly Control');
INSERT INTO `in_game` VALUES ('28', 'Wild Slide');
INSERT INTO `in_game` VALUES ('29', 'Truck Jam HD');
INSERT INTO `in_game` VALUES ('30', 'RoC');
INSERT INTO `in_game` VALUES ('31', 'Fly Fu Pro HD');
INSERT INTO `in_game` VALUES ('32', 'Greed Corp');

-- ----------------------------
-- Table structure for `in_platform`
-- ----------------------------
DROP TABLE IF EXISTS `in_platform`;
CREATE TABLE `in_platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_platform
-- ----------------------------
INSERT INTO `in_platform` VALUES ('1', 'Andorid Tablet');
INSERT INTO `in_platform` VALUES ('2', 'Android Phone');
INSERT INTO `in_platform` VALUES ('3', 'iPhone');
INSERT INTO `in_platform` VALUES ('4', 'iPad');

-- ----------------------------
-- Table structure for `in_rumor`
-- ----------------------------
DROP TABLE IF EXISTS `in_rumor`;
CREATE TABLE `in_rumor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_rumor
-- ----------------------------
INSERT INTO `in_rumor` VALUES ('8', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22');

-- ----------------------------
-- Table structure for `in_user`
-- ----------------------------
DROP TABLE IF EXISTS `in_user`;
CREATE TABLE `in_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_user
-- ----------------------------
INSERT INTO `in_user` VALUES ('3', 'admin', '0cc175b9c0f1b6a831c399e269772661', '1');

-- ----------------------------
-- Table structure for `in_user_game`
-- ----------------------------
DROP TABLE IF EXISTS `in_user_game`;
CREATE TABLE `in_user_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_user_game
-- ----------------------------
INSERT INTO `in_user_game` VALUES ('8', '4', '32');
INSERT INTO `in_user_game` VALUES ('9', '4', '30');
