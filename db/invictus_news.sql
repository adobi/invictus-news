/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : invictus_news

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-01-16 10:24:26
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
) ENGINE=InnoDB AUTO_INCREMENT=475 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_bridge
-- ----------------------------
INSERT INTO `in_bridge` VALUES ('473', '17', '3', '45', '1326704087_santa_oldalso.png', 'Bootstrap, from Twitter', 'http://bit.ly/q2G9Mm');
INSERT INTO `in_bridge` VALUES ('474', '17', '2', '45', '1326704102_santa_oldalso.png', 'Bootstrap, from Twitter', 'http://bit.ly/q2G9Mm');

-- ----------------------------
-- Table structure for `in_game`
-- ----------------------------
DROP TABLE IF EXISTS `in_game`;
CREATE TABLE `in_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_game
-- ----------------------------
INSERT INTO `in_game` VALUES ('1', 'PinFrog', 'pinfrog');
INSERT INTO `in_game` VALUES ('2', 'Fly Fu Pro', 'fly-fu-pro');
INSERT INTO `in_game` VALUES ('3', 'Froggy Launcher', 'froggy-launcher');
INSERT INTO `in_game` VALUES ('5', 'Picosaic HD', 'picosaic-hd');
INSERT INTO `in_game` VALUES ('8', 'Brim!', 'brim');
INSERT INTO `in_game` VALUES ('9', 'Fly Control HD', 'fly-control-hd');
INSERT INTO `in_game` VALUES ('10', 'Froggy Jump', 'froggy-jump');
INSERT INTO `in_game` VALUES ('11', 'Blastwave ', 'blastwave');
INSERT INTO `in_game` VALUES ('12', 'Rollit - Smartly', 'rollit-smartly');
INSERT INTO `in_game` VALUES ('13', 'Grim Filler', 'grim-filler');
INSERT INTO `in_game` VALUES ('14', 'Picosaic', 'picosaic');
INSERT INTO `in_game` VALUES ('15', '4x4 Jam', '4x4-jam');
INSERT INTO `in_game` VALUES ('16', 'The Escapee', 'the-escapee');
INSERT INTO `in_game` VALUES ('28', 'Fly Control', 'fly-control');
INSERT INTO `in_game` VALUES ('32', 'Truck Jam', 'truck-jam');
INSERT INTO `in_game` VALUES ('33', 'Wild Slide', 'wild-slide');
INSERT INTO `in_game` VALUES ('37', 'Truck Jam HD', 'truck-jam-hd');
INSERT INTO `in_game` VALUES ('38', 'Fly Fu Pro HD', 'fly-fu-pro-hd');
INSERT INTO `in_game` VALUES ('39', 'RoC', 'roc');
INSERT INTO `in_game` VALUES ('42', 'Greed Corp HD', 'greed-corp-hd');
INSERT INTO `in_game` VALUES ('45', 'Santa Ride!', 'santa-ride');
INSERT INTO `in_game` VALUES ('46', 'Santa Ride! HD', 'santa-ride-hd');
INSERT INTO `in_game` VALUES ('51', 'Greed Corp', 'greed-corp');
INSERT INTO `in_game` VALUES ('53', 'Mist Bouncer', 'mist-bouncer');

-- ----------------------------
-- Table structure for `in_platform`
-- ----------------------------
DROP TABLE IF EXISTS `in_platform`;
CREATE TABLE `in_platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_platform
-- ----------------------------
INSERT INTO `in_platform` VALUES ('1', 'Andorid Tablet', 'andorid-tablet');
INSERT INTO `in_platform` VALUES ('2', 'Android Phone', 'android-phone');
INSERT INTO `in_platform` VALUES ('3', 'iPhone', 'iphone');
INSERT INTO `in_platform` VALUES ('4', 'iPad', 'ipad');

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
  `active` int(11) DEFAULT NULL,
  `available_from` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_rumor
-- ----------------------------
INSERT INTO `in_rumor` VALUES ('17', 'Lorem Ipsum is simply text', 'Use MySQL when it works, something else when not - fortunately MySQL often does work', '1326442079_mistbouncer_90.png', '2012-01-13 09:07:59', '1', null);

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
INSERT INTO `in_user` VALUES ('4', 'bela', '0cc175b9c0f1b6a831c399e269772661', '2');

-- ----------------------------
-- Table structure for `in_user_game`
-- ----------------------------
DROP TABLE IF EXISTS `in_user_game`;
CREATE TABLE `in_user_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_user_game
-- ----------------------------
INSERT INTO `in_user_game` VALUES ('19', '4', '15');
INSERT INTO `in_user_game` VALUES ('20', '4', '11');
INSERT INTO `in_user_game` VALUES ('21', '4', '28');
