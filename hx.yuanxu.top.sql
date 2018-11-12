/*
 Navicat Premium Data Transfer

 Source Server         : 新站
 Source Server Type    : MySQL
 Source Server Version : 50640
 Source Host           : 47.97.111.165:3306
 Source Schema         : hx.yuanxu.top

 Target Server Type    : MySQL
 Target Server Version : 50640
 File Encoding         : 65001

 Date: 12/11/2018 13:55:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hy_danmu
-- ----------------------------
DROP TABLE IF EXISTS `hy_danmu`;
CREATE TABLE `hy_danmu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`userid`) USING BTREE,
  INDEX `time`(`create_time`) USING BTREE,
  INDEX `content`(`content`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 24788 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hy_gift
-- ----------------------------
DROP TABLE IF EXISTS `hy_gift`;
CREATE TABLE `hy_gift`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` decimal(11, 2) NULL DEFAULT NULL,
  `count` int(11) NULL DEFAULT NULL,
  `create_time` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gift_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1671 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hy_suggestion
-- ----------------------------
DROP TABLE IF EXISTS `hy_suggestion`;
CREATE TABLE `hy_suggestion`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `create_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0 COMMENT '-1 已删除, 0 未读 ,1 已读 2 已处理',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hy_user
-- ----------------------------
DROP TABLE IF EXISTS `hy_user`;
CREATE TABLE `hy_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sign` int(255) NULL DEFAULT 0 COMMENT '标记次数',
  `create_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sign`(`sign`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6331 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
