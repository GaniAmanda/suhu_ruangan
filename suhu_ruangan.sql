/*
 Navicat Premium Data Transfer

 Source Server         : ROHIS
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : suhu_ruangan

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 21/01/2023 12:53:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pic` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'Gani Amanda', 'itsupport.arcamanik@herminahospitals.com', '$2y$10$2FvbUQGbCoB7Q2.JNEtw.Ofjn1U4MX09GL5Z1Y7PeGonMAp5vM/l.', 'admin');
INSERT INTO `admin` VALUES (26, 'Reza Julpahril', 'julpahrilreza98@gmail.com', '$2y$10$OuxRukxdVd5GWaL2IIm4B.70duUnHR/puU313pLdDu7HzbfPiMBoi', NULL);

-- ----------------------------
-- Table structure for ruangan
-- ----------------------------
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE `ruangan`  (
  `id_ruangan` int NOT NULL AUTO_INCREMENT,
  `ruangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_ruangan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ruangan
-- ----------------------------
INSERT INTO `ruangan` VALUES (1, 'RUANG SERVER');

-- ----------------------------
-- Table structure for sensor
-- ----------------------------
DROP TABLE IF EXISTS `sensor`;
CREATE TABLE `sensor`  (
  `id_sensor` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `api_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_sensor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sensor
-- ----------------------------
INSERT INTO `sensor` VALUES (1, 'ESP32_R.Server', 'ARC0IajmFIZSX3xJSK6SUDQv4LW7FLkTq9hg5Dp4ZWEiQtkUNKBEohRvRuieWWFH4Z3CdnHvNgNCC1k8kPAXG4ve0DMSX94vSuUl9HptXCHnMItGzqFKoY0RJnoQBBmw');

-- ----------------------------
-- Table structure for shift
-- ----------------------------
DROP TABLE IF EXISTS `shift`;
CREATE TABLE `shift`  (
  `id_shift` int NOT NULL AUTO_INCREMENT,
  `shift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_shift`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shift
-- ----------------------------
INSERT INTO `shift` VALUES (0, '-');
INSERT INTO `shift` VALUES (1, 'Pagi');
INSERT INTO `shift` VALUES (2, 'Siang');
INSERT INTO `shift` VALUES (3, 'Malam');

-- ----------------------------
-- Table structure for suhu
-- ----------------------------
DROP TABLE IF EXISTS `suhu`;
CREATE TABLE `suhu`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `suhu` decimal(10, 2) NULL DEFAULT NULL,
  `kelembapan` decimal(10, 2) NULL DEFAULT 0.00,
  `sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `shift` int NULL DEFAULT NULL,
  `created_date` datetime NULL DEFAULT current_timestamp,
  `modified_date` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3118 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suhu
-- ----------------------------
INSERT INTO `suhu` VALUES (3101, '1', '2023-01-20', 25.70, 85.30, '1', 0, '2023-01-20 14:32:35', '2023-01-21 00:00:24');
INSERT INTO `suhu` VALUES (3102, '1', '2023-01-20', 25.00, 80.00, '1', 1, '2023-01-20 14:32:35', '2023-01-20 20:46:59');
INSERT INTO `suhu` VALUES (3103, '1', '2023-01-20', 26.50, 87.00, '1', 2, '2023-01-20 14:32:35', '2023-01-20 20:47:00');
INSERT INTO `suhu` VALUES (3113, '1', '2023-01-20', 25.80, 85.50, '1', 3, '2023-01-20 21:05:06', '2023-01-20 23:00:17');
INSERT INTO `suhu` VALUES (3114, '1', '2023-01-21', 25.70, 84.40, '1', 0, '2023-01-21 00:00:29', '2023-01-21 05:33:08');
INSERT INTO `suhu` VALUES (3115, '1', '2023-01-21', NULL, NULL, NULL, 1, '2023-01-21 11:29:32', NULL);
INSERT INTO `suhu` VALUES (3116, '1', '2023-01-21', NULL, NULL, NULL, 2, '2023-01-21 11:29:32', NULL);
INSERT INTO `suhu` VALUES (3117, '1', '2023-01-21', NULL, NULL, NULL, 3, '2023-01-21 11:29:32', NULL);

SET FOREIGN_KEY_CHECKS = 1;
