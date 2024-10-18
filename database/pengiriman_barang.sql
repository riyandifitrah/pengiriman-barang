/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : pengiriman_barang

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 17/10/2024 01:52:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for form_pengiriman
-- ----------------------------
DROP TABLE IF EXISTS `form_pengiriman`;
CREATE TABLE `form_pengiriman`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NOT NULL,
  `bill` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl` date NULL DEFAULT NULL,
  `waktu` time NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of form_pengiriman
-- ----------------------------
INSERT INTO `form_pengiriman` VALUES (1, 1, '20241003-001', 'tes', '2', '1', NULL, NULL, '2024-10-17 01:34:05', '2024-10-16 18:34:05');
INSERT INTO `form_pengiriman` VALUES (12, 56797856, '20241006-001', 'asdas', '2', 'asdawd', '2023-11-30', '22:59:00', '2024-10-17 01:31:56', '2024-10-17 01:35:30');
INSERT INTO `form_pengiriman` VALUES (13, 81289455, '20241006-002', 'addsasd', '1', 'asdawd', '2024-10-29', '22:58:00', '2024-10-17 01:31:56', NULL);
INSERT INTO `form_pengiriman` VALUES (14, 16091230, '20241006-003', 'asad', '2', 'asd', '2024-10-30', '22:55:00', '2024-10-17 01:34:57', '2024-10-17 01:34:57');
INSERT INTO `form_pengiriman` VALUES (15, 68403454, '20241006-004', 'asdad', '1', 'asdasd', '2023-10-30', '22:59:00', '2024-10-17 01:31:56', NULL);
INSERT INTO `form_pengiriman` VALUES (16, 38778028, '20241016-001', 'asdads', '1', 'asdasd', '2024-11-30', '23:59:00', '2024-10-17 01:31:58', NULL);
INSERT INTO `form_pengiriman` VALUES (17, 79099475, '20241016-002', 'asdawd', '1', 'asdawd', '2024-10-16', '00:00:00', '2024-10-17 01:31:58', NULL);
INSERT INTO `form_pengiriman` VALUES (18, 6683989, '20241017-001', 'asd', '1', 'asd', '2020-10-26', '20:58:00', '2024-10-17 01:38:32', NULL);

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `role_level` int NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'User', 1, NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (2, 'Admin', 2, NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (3, 'Sender', 3, NULL, NULL, NULL);
INSERT INTO `m_role` VALUES (4, 'Reciepent', 4, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `role_id` int NULL DEFAULT NULL,
  `access_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `login_notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `login_last` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deleted_at` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'admin', '$2y$10$Iby8ZEje1CHbRlRTf.n2aeuVz6C1AK3/b0I82wZPgexDxBFdpP656', 2, 'Admin', 'pending', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `menu_id` int NOT NULL,
  `menu_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Beranda', NULL);
INSERT INTO `menus` VALUES (2, 'Dashboard', 'dashboard');
INSERT INTO `menus` VALUES (3, 'User Management', 'users/index');
INSERT INTO `menus` VALUES (4, 'Product List', 'products/list');
INSERT INTO `menus` VALUES (5, 'Monthly Reports', 'reports/monthly');
INSERT INTO `menus` VALUES (6, 'Logout', 'auth/logout');

SET FOREIGN_KEY_CHECKS = 1;
