/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : huya

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 31/10/2018 03:27:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hy_danmu
-- ----------------------------
DROP TABLE IF EXISTS `hy_danmu`;
CREATE TABLE `hy_danmu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(255) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`userid`) USING BTREE,
  INDEX `time`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hy_user
-- ----------------------------
DROP TABLE IF EXISTS `hy_user`;
CREATE TABLE `hy_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sign` int(255) DEFAULT 0 COMMENT '标记次数',
  `create_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
