/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : invictus_news

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-01-12 13:46:49
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
) ENGINE=InnoDB AUTO_INCREMENT=472 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_bridge
-- ----------------------------
INSERT INTO `in_bridge` VALUES ('466', '8', '3', '53', '1326359132_santa_oldalso.png', 'Bootstrap, from Twitter', 'http://twitter.github.com/bootstrap/');
INSERT INTO `in_bridge` VALUES ('467', '9', '3', '53', '1326360032_santa_oldalso.png', 'Bootstrap, from Twitter 2', 'http://twitter.github.com/bootstrap/');
INSERT INTO `in_bridge` VALUES ('468', '10', '3', '53', '1326364380_mistbouncer_santa_banner.png', 'googl com', 'http://google.com');
INSERT INTO `in_bridge` VALUES ('469', '11', '4', '53', '1326364438_uj_template.png', 'mist bouncer ipad', 'http://google.com');
INSERT INTO `in_bridge` VALUES ('470', '11', '4', '51', '1326364480_mistbouncer_90.png', 'greed corp ipad', 'http://google.com');
INSERT INTO `in_bridge` VALUES ('471', '12', '4', '42', null, null, null);

-- ----------------------------
-- Table structure for `in_game`
-- ----------------------------
DROP TABLE IF EXISTS `in_game`;
CREATE TABLE `in_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_game
-- ----------------------------
INSERT INTO `in_game` VALUES ('1', 'PinFrog', null);
INSERT INTO `in_game` VALUES ('2', 'Fly Fu Pro', null);
INSERT INTO `in_game` VALUES ('3', 'Froggy Launcher', null);
INSERT INTO `in_game` VALUES ('5', 'Picosaic HD', null);
INSERT INTO `in_game` VALUES ('8', 'Brim!', null);
INSERT INTO `in_game` VALUES ('9', 'Fly Control HD', null);
INSERT INTO `in_game` VALUES ('10', 'Froggy Jump', null);
INSERT INTO `in_game` VALUES ('11', 'Blastwave ', '1326200888_mistbouncer_150.png');
INSERT INTO `in_game` VALUES ('12', 'Rollit - Smartly', null);
INSERT INTO `in_game` VALUES ('13', 'Grim Filler', null);
INSERT INTO `in_game` VALUES ('14', 'Picosaic', null);
INSERT INTO `in_game` VALUES ('15', '4x4 Jam', '1326200888_mistbouncer_150.png');
INSERT INTO `in_game` VALUES ('16', 'The Escapee', null);
INSERT INTO `in_game` VALUES ('28', 'Fly Control', null);
INSERT INTO `in_game` VALUES ('32', 'Truck Jam', null);
INSERT INTO `in_game` VALUES ('33', 'Wild Slide', null);
INSERT INTO `in_game` VALUES ('37', 'Truck Jam HD', null);
INSERT INTO `in_game` VALUES ('38', 'Fly Fu Pro HD', null);
INSERT INTO `in_game` VALUES ('39', 'RoC', null);
INSERT INTO `in_game` VALUES ('42', 'Greed Corp HD', null);
INSERT INTO `in_game` VALUES ('45', 'Santa Ride!', null);
INSERT INTO `in_game` VALUES ('46', 'Santa Ride! HD', null);
INSERT INTO `in_game` VALUES ('51', 'Greed Corp', null);
INSERT INTO `in_game` VALUES ('53', 'Mist Bouncer', null);

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
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_rumor
-- ----------------------------
INSERT INTO `in_rumor` VALUES ('8', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', '0');
INSERT INTO `in_rumor` VALUES ('9', 'Race Of Champions Review', 'A PHP munkamenet-kezelésének egyik fő problémája, hogy az implementáció nagyon sok helyen feltételezi, hogy a munkamenet egy globális, egypéldányos erőforrás.', '1326277252_mistbouncer_150.png', '2012-01-11 11:20:52', '0');
INSERT INTO `in_rumor` VALUES ('10', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', '1');
INSERT INTO `in_rumor` VALUES ('11', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', null);
INSERT INTO `in_rumor` VALUES ('12', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', null);
INSERT INTO `in_rumor` VALUES ('13', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', null);
INSERT INTO `in_rumor` VALUES ('14', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', null);
INSERT INTO `in_rumor` VALUES ('15', 'Lorem Ipsum is simply dummy text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu fermentum leo. Ut tempor aliquam purus et rhoncus. Donec a felis eget justo aliquet mollis. Proin adipiscing erat sit amet libero pretium condimentum. Vestibulum cursus orci vitae dui elementum tempus malesuada sem tempor. Aliquam fringilla vehicula faucibus. Donec eu metus tellus, vel eleifend massa. Proin ac imperdiet odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec posuere libero vitae urna semper eget venenatis arcu consequat. Integer adipiscing enim vel turpis suscipit mollis.', '1326200888_mistbouncer_150.png', '2012-01-10 10:54:22', null);

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
