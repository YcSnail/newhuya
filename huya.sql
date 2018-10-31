/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : huya

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-31 17:28:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hy_danmu
-- ----------------------------
DROP TABLE IF EXISTS `hy_danmu`;
CREATE TABLE `hy_danmu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `username` (`userid`) USING BTREE,
  KEY `time` (`create_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5672 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for hy_user
-- ----------------------------
DROP TABLE IF EXISTS `hy_user`;
CREATE TABLE `hy_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `sign` int(255) DEFAULT '0' COMMENT '标记次数',
  `create_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2896 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
