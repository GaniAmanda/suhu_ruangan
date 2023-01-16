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

 Date: 15/01/2023 18:14:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
-- Table structure for suhu
-- ----------------------------
DROP TABLE IF EXISTS `suhu`;
CREATE TABLE `suhu`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `suhu_pagi` decimal(10, 2) NULL DEFAULT NULL,
  `kelembapan_pagi` int NULL DEFAULT 0,
  `petugas_pagi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `suhu_sore` decimal(10, 2) NULL DEFAULT NULL,
  `kelembapan_sore` int NULL DEFAULT NULL,
  `petugas_sore` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suhu
-- ----------------------------
INSERT INTO `suhu` VALUES (36, '1', '2023-01-13', 28.00, 60, 'gani', 28.00, 60, 'reza');
INSERT INTO `suhu` VALUES (37, '1', '2023-01-12', 28.00, 60, 'gani', 27.00, 58, 'reza');
INSERT INTO `suhu` VALUES (38, '1', '2023-01-11', 28.00, 60, 'gani', 27.00, 58, 'reza');
INSERT INTO `suhu` VALUES (40, '1', '2023-01-15', 21.00, 60, 'gani', 27.00, 58, 'reza');
INSERT INTO `suhu` VALUES (56, '1', '2023-01-17', 23.00, 55, 'gani', 22.00, 55, 'reza');
INSERT INTO `suhu` VALUES (57, '1', '2023-01-18', 23.00, 67, 'gani', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
