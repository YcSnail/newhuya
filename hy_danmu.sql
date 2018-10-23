/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : huya

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-23 17:31:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hy_danmu
-- ----------------------------
DROP TABLE IF EXISTS `hy_danmu`;
CREATE TABLE `hy_danmu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `createtime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `time` (`createtime`)
) ENGINE=MyISAM AUTO_INCREMENT=11069 DEFAULT CHARSET=utf8;
