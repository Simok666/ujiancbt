/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31)
 Source Host           : localhost:3306
 Source Schema         : db_tryoutujian

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31)
 File Encoding         : 65001

 Date: 30/03/2024 20:26:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` int NOT NULL,
  `date_created` int NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  `pm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'Admin', 'admin@gmail.com', '$2y$10$d/LU6g2HI7gvZYc5tnQ5qeK6r56reDNwAGZlszbZh5UK0z9mcKajq', 1, 1708415888, 'default.jpg', 1, '123123123');

-- ----------------------------
-- Table structure for chat_materi
-- ----------------------------
DROP TABLE IF EXISTS `chat_materi`;
CREATE TABLE `chat_materi`  (
  `id_chat_materi` int NOT NULL AUTO_INCREMENT,
  `materi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  PRIMARY KEY (`id_chat_materi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chat_materi
-- ----------------------------
INSERT INTO `chat_materi` VALUES (1, 'PguKtBwn', 'Hives', 'default.jpg', 'hidayahamanah17@gmail.com', 'Silahkan apabila ada yang ingin ditanyakan dipersilahkan', 1709605089);
INSERT INTO `chat_materi` VALUES (2, 'PguKtBwn', 'Budi', 'default.jpg', 'budi@gmail.com', 'Belum ada kak', 1709605178);
INSERT INTO `chat_materi` VALUES (3, 'PguKtBwn', 'Hives', 'default.jpg', 'hidayahamanah17@gmail.com', 'Oke apabila ada silahkan saja ya ditanyakan jangan sungkan', 1709605213);

-- ----------------------------
-- Table structure for chat_tugas
-- ----------------------------
DROP TABLE IF EXISTS `chat_tugas`;
CREATE TABLE `chat_tugas`  (
  `id_chat_tugas` int NOT NULL AUTO_INCREMENT,
  `tugas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  PRIMARY KEY (`id_chat_tugas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chat_tugas
-- ----------------------------

-- ----------------------------
-- Table structure for essay_detail
-- ----------------------------
DROP TABLE IF EXISTS `essay_detail`;
CREATE TABLE `essay_detail`  (
  `id_essay_detail` int NOT NULL AUTO_INCREMENT,
  `kode_ujian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_essay_detail`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of essay_detail
-- ----------------------------
INSERT INTO `essay_detail` VALUES (6, 'naZkBzlMJy', '<p><img src=\"http://localhost:8080/assets/app-assets/file/1711252447_95aee771355e6bb9e3f0.png\" style=\"width: 347px;\"></p><p>where the hell is this</p>');
INSERT INTO `essay_detail` VALUES (9, 'FxGedhp7RQ', '<p><img src=\"http://localhost:8080/assets/app-assets/file/1711283353_3d174bfdd59c4723e2d7.png\" style=\"width: 793px;\"></p><p>what the hell is this</p>');
INSERT INTO `essay_detail` VALUES (32, 'OEftRBZ193', '<p><img src=\"http://localhost:8080/assets/app-assets/file/1711543431_6f35a7417c12ea6f4068.png\" style=\"width: 275px;\"><br>tell me why</p>');
INSERT INTO `essay_detail` VALUES (35, 'ShEtWeIrLK', '<p>tell me why</p>');

-- ----------------------------
-- Table structure for essay_siswa
-- ----------------------------
DROP TABLE IF EXISTS `essay_siswa`;
CREATE TABLE `essay_siswa`  (
  `id_essay_siswa` int NOT NULL AUTO_INCREMENT,
  `essay_id` int NOT NULL,
  `ujian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `siswa` int NOT NULL,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `score` int NOT NULL,
  `sudah_dikerjakan` int NULL DEFAULT NULL,
  `ragu` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_essay_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of essay_siswa
-- ----------------------------
INSERT INTO `essay_siswa` VALUES (6, 6, 'naZkBzlMJy', 1, NULL, 0, NULL, NULL);
INSERT INTO `essay_siswa` VALUES (9, 9, 'FxGedhp7RQ', 1, NULL, 0, NULL, NULL);
INSERT INTO `essay_siswa` VALUES (33, 32, 'OEftRBZ193', 1, 'ain\'t nothin but a heartache', 0, 1, NULL);
INSERT INTO `essay_siswa` VALUES (36, 35, 'ShEtWeIrLK', 1, '<p>ain\'t nothin but a heartache<br><img style=\"width: 179px;\" src=\"http://localhost:8080/assets/app-assets/file/1711545590_26403ea973f88e394c72.png\"><br></p>', 0, 1, NULL);

-- ----------------------------
-- Table structure for file
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file`  (
  `id_file` int NOT NULL AUTO_INCREMENT,
  `kode_file` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_file`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of file
-- ----------------------------
INSERT INTO `file` VALUES (1, 'PguKtBwn', '1654483210_ce8204b728183dec0675.pdf');

-- ----------------------------
-- Table structure for guru
-- ----------------------------
DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru`  (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  `is_active` int NOT NULL,
  `date_created` int NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guru_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `guru_mapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_guru`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of guru
-- ----------------------------
INSERT INTO `guru` VALUES (2, 'Hives', 'hidayahamanah17@gmail.com', '$2y$10$Jcpxobx.wsDIMnVYaNyThOtY1VLAPI4xFdWcHf/mfoKvZZJaFZn.G', 3, 1, 1708419959, 'default.jpg', NULL, NULL);
INSERT INTO `guru` VALUES (8, 'arfod', 'arfod.user@gmail.com', '$2y$10$XrjrzLNy13lxFv0T4sYmo.8jlfcOEwDpdJY8bwOhgTr/SQV9nQQoi', 3, 1, 1710601230, 'default.jpg', NULL, NULL);
INSERT INTO `guru` VALUES (9, 'Testing', 'xiyida3522@hdrlog.com', '$2y$10$75GenSAV154EJSvsWN0rUu0cpkSmP9aBL9HKLEOUzCMfwDJGP/iIS', 3, 1, 1710817117, 'default.jpg', NULL, NULL);

-- ----------------------------
-- Table structure for guru_kelas
-- ----------------------------
DROP TABLE IF EXISTS `guru_kelas`;
CREATE TABLE `guru_kelas`  (
  `id_guru_kelas` int NOT NULL AUTO_INCREMENT,
  `guru` int NOT NULL,
  `kelas` int NOT NULL,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_guru_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of guru_kelas
-- ----------------------------
INSERT INTO `guru_kelas` VALUES (1, 1, 1, 'A');
INSERT INTO `guru_kelas` VALUES (2, 2, 1, 'A');
INSERT INTO `guru_kelas` VALUES (3, 2, 2, 'B');
INSERT INTO `guru_kelas` VALUES (4, 3, 1, 'A');
INSERT INTO `guru_kelas` VALUES (5, 3, 2, 'B');
INSERT INTO `guru_kelas` VALUES (6, 3, 3, 'C');
INSERT INTO `guru_kelas` VALUES (7, 4, 1, 'A');
INSERT INTO `guru_kelas` VALUES (8, 8, 1, 'A');
INSERT INTO `guru_kelas` VALUES (9, 8, 2, 'B');
INSERT INTO `guru_kelas` VALUES (10, 8, 3, 'C');
INSERT INTO `guru_kelas` VALUES (11, 8, 7, 'Gratis (Trial)');
INSERT INTO `guru_kelas` VALUES (12, 2, 7, 'Gratis (Trial)');

-- ----------------------------
-- Table structure for guru_mapel
-- ----------------------------
DROP TABLE IF EXISTS `guru_mapel`;
CREATE TABLE `guru_mapel`  (
  `id_guru_mapel` int NOT NULL AUTO_INCREMENT,
  `guru` int NOT NULL,
  `mapel` int NOT NULL,
  `nama_mapel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_guru_mapel`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of guru_mapel
-- ----------------------------
INSERT INTO `guru_mapel` VALUES (1, 1, 1, 'CBT');
INSERT INTO `guru_mapel` VALUES (2, 2, 1, 'CBT');
INSERT INTO `guru_mapel` VALUES (3, 4, 1, 'CBT');
INSERT INTO `guru_mapel` VALUES (4, 8, 1, 'CBT');
INSERT INTO `guru_mapel` VALUES (5, 8, 2, 'Tryout');
INSERT INTO `guru_mapel` VALUES (6, 8, 6, 'TPA (Test Potensi Akademik)');
INSERT INTO `guru_mapel` VALUES (7, 2, 2, 'Tryout');

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (7, 'Gratis (Trial)');

-- ----------------------------
-- Table structure for mail
-- ----------------------------
DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail`  (
  `id_mail` int NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `smtp_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `smtp_pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `smtp_port` int NOT NULL,
  `smtp_crypto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notif_akun` int NOT NULL,
  `notif_materi` int NOT NULL,
  `notif_tugas` int NOT NULL,
  `notif_ujian` int NOT NULL,
  PRIMARY KEY (`id_mail`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mail
-- ----------------------------
INSERT INTO `mail` VALUES (1, 'smtp.googlemail.com', 'arfod.user@gmail.com', 'wkly udwa ftcq xucl', 465, 'ssl', 0, 0, 0, 0);

-- ----------------------------
-- Table structure for mapel
-- ----------------------------
DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel`  (
  `id_mapel` int NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_mapel`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mapel
-- ----------------------------
INSERT INTO `mapel` VALUES (1, 'CBT');
INSERT INTO `mapel` VALUES (2, 'Tryout');
INSERT INTO `mapel` VALUES (6, 'TPA (Test Potensi Akademik)');

-- ----------------------------
-- Table structure for materi
-- ----------------------------
DROP TABLE IF EXISTS `materi`;
CREATE TABLE `materi`  (
  `id_materi` int NOT NULL AUTO_INCREMENT,
  `kode_materi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_materi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guru` int NOT NULL,
  `mapel` int NOT NULL,
  `kelas` int NOT NULL,
  `text_materi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  PRIMARY KEY (`id_materi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of materi
-- ----------------------------
INSERT INTO `materi` VALUES (1, 'PguKtBwn', 'Tryout 1', 2, 1, 1, '<p>Materi belajar menghadapi Ujian Tryout 1</p>', 1709603628);

-- ----------------------------
-- Table structure for materi_siswa
-- ----------------------------
DROP TABLE IF EXISTS `materi_siswa`;
CREATE TABLE `materi_siswa`  (
  `id_materi_siswa` int NOT NULL AUTO_INCREMENT,
  `materi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` int NOT NULL,
  `mapel` int NOT NULL,
  `siswa` int NOT NULL,
  `dilihat` int NOT NULL,
  PRIMARY KEY (`id_materi_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of materi_siswa
-- ----------------------------

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa`  (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `no_induk_siswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` int NOT NULL,
  `role` int NOT NULL,
  `is_active` int NOT NULL,
  `status_member` int NULL DEFAULT NULL,
  `date_created` int NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES (1, '12345', 'Budi', 'budi@gmail.com', '$2y$10$RP9jSeWYlRBDnWRFqgHOEubvWxjQX2KaNAnBN6Ofznx4.x385C.rO', 'Laki - Laki', 7, 2, 1, 0, 1708417921, 'default.jpg');
INSERT INTO `siswa` VALUES (4, '123', 'pemberian', 'pemberianakun@gmail.com', '$2y$10$VKPTWHAbG7PZcz10/1BpMOomGRRj1N6RNJHd5MKhPq5LH94KX4kP.', 'Laki - Laki', 7, 2, 0, NULL, 1710646645, 'default.jpg');
INSERT INTO `siswa` VALUES (5, 'wijecin999@cmheia.com', 'testing', 'wijecin999@cmheia.com', '$2y$10$PolN/PT/Jm1xhRhksFye9OkkunIHn/UbUCCnrDF4wjQ4BCEWI5c4K', 'Laki - Laki', 7, 2, 1, NULL, 1710817313, 'default.jpg');
INSERT INTO `siswa` VALUES (6, 'pass', 'sh', 'shawnheike13@gmail.com', '$2y$10$Q9IfCQTqNeJwUJngqLmfZ.PDe2yvzEGhI/EN04B.Titp/HeRB6tCS', 'Laki - Laki', 7, 2, 0, NULL, 1711254259, 'default.jpg');

-- ----------------------------
-- Table structure for tugas
-- ----------------------------
DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas`  (
  `id_tugas` int NOT NULL AUTO_INCREMENT,
  `kode_tugas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` int NOT NULL,
  `mapel` int NOT NULL,
  `guru` int NOT NULL,
  `nama_tugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  `due_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_updated` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_tugas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tugas
-- ----------------------------

-- ----------------------------
-- Table structure for tugas_siswa
-- ----------------------------
DROP TABLE IF EXISTS `tugas_siswa`;
CREATE TABLE `tugas_siswa`  (
  `id_tugas_siswa` int NOT NULL AUTO_INCREMENT,
  `tugas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `siswa` int NOT NULL,
  `text_siswa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `file_siswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_send` int NULL DEFAULT NULL,
  `is_telat` int NULL DEFAULT NULL,
  `nilai` int NULL DEFAULT NULL,
  `catatan_guru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_tugas_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tugas_siswa
-- ----------------------------

-- ----------------------------
-- Table structure for ujian
-- ----------------------------
DROP TABLE IF EXISTS `ujian`;
CREATE TABLE `ujian`  (
  `id_ujian` int NOT NULL AUTO_INCREMENT,
  `kode_ujian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_ujian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guru` int NOT NULL,
  `kelas` int NOT NULL,
  `mapel` int NOT NULL,
  `date_created` int NOT NULL,
  `waktu_ujian` int NOT NULL,
  `jenis_ujian` int NULL DEFAULT NULL,
  `publish` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_ujian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ujian
-- ----------------------------
INSERT INTO `ujian` VALUES (4, 'Y3BxfqUNzX', 'Tryout 1', 2, 1, 1, 1709603000, 3, NULL, NULL);
INSERT INTO `ujian` VALUES (15, '5dOtC8sHWp', 'TPA', 8, 7, 6, 1710659687, 5, NULL, NULL);
INSERT INTO `ujian` VALUES (16, 'RcfM6ASHDa', 'a', 8, 7, 6, 1710758831, 2, NULL, NULL);
INSERT INTO `ujian` VALUES (17, '1DBvE5IafV', 'quiz img', 8, 7, 1, 1711251918, 1, NULL, NULL);
INSERT INTO `ujian` VALUES (18, 'naZkBzlMJy', 'quiz essay', 8, 7, 1, 1711252456, 1, 1, NULL);
INSERT INTO `ujian` VALUES (20, 'kZmslznr07', 'q', 8, 7, 6, 1711264765, 1, NULL, NULL);
INSERT INTO `ujian` VALUES (24, 'Uzi8ID3Jqw', 'qq', 8, 7, 2, 1711276863, 2, NULL, NULL);
INSERT INTO `ujian` VALUES (28, 'FxGedhp7RQ', 'quiz essay', 8, 7, 1, 1711283377, -5, 1, NULL);
INSERT INTO `ujian` VALUES (51, 'OEftRBZ193', 'testing essay quiz', 8, 7, 6, 1711543432, 2, 1, NULL);
INSERT INTO `ujian` VALUES (54, 'ShEtWeIrLK', 'testing essay quiz 2', 8, 7, 6, 1711545539, 10, 1, NULL);
INSERT INTO `ujian` VALUES (55, 'okeU8rRMOS', 'testing quiz', 8, 7, 6, 1711712894, 180, NULL, 1);
INSERT INTO `ujian` VALUES (57, '6ZAToUl90K', 'testing quiz 2', 8, 7, 6, 1711715997, 9, NULL, NULL);
INSERT INTO `ujian` VALUES (58, 'WDTCy7XtV6', 'testing quiz 2', 8, 7, 6, 1711716045, 9, NULL, NULL);
INSERT INTO `ujian` VALUES (59, 'JDToR5VciO', 'qq', 8, 7, 6, 1711799347, 8, NULL, 1);

-- ----------------------------
-- Table structure for ujian_detail
-- ----------------------------
DROP TABLE IF EXISTS `ujian_detail`;
CREATE TABLE `ujian_detail`  (
  `id_detail_ujian` int NOT NULL AUTO_INCREMENT,
  `kode_ujian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_soal` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pg_1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pg_2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pg_3` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pg_4` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pg_5` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jawaban` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pembahasan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_detail_ujian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ujian_detail
-- ----------------------------
INSERT INTO `ujian_detail` VALUES (16, 'Y3BxfqUNzX', '<p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;border:none;\r\nmso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes\"><span lang=\"IN\" style=\"font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;color:black\">Dalam konteks\r\npembangunan ekonomi di Indonesia, pemerintah telah mengimplementasikan beberapa\r\nkebijakan untuk mendukung pencapaian keadilan sosial sebagaimana diamanatkan\r\noleh Pancasila. Namun, salah satu kebijakan berikut tidak sepenuhnya sesuai dengan\r\nprinsip tersebut. Pilihlah kebijakan yang tidak sesuai!<o:p></o:p></span></p>', 'A. Pemerintah memberikan subsidi kepada masyarakat miskin untuk memenuhi kebutuhan pokoknya.', 'B. Pemerintah memberikan beasiswa kepada siswa berprestasi dari keluarga kurang mampu.', 'C. Pemerintah memberikan insentif kepada pengusaha yang berinvestasi di daerah terpencil.', 'D. Pemerintah membangun infrastruktur di daerah terpencil untuk meningkatkan kesejahteraan masyaraka', 'E. Pemerintah memberikan fasilitas kesehatan dan pendidikan gratis kepada seluruh masyarakat.', 'C', NULL);
INSERT INTO `ujian_detail` VALUES (17, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Perkembangan teknologi dan internet telah membawa\r\ndampak yang signifikan terhadap dinamika nasionalisme. Meskipun membawa\r\nberbagai peluang, namun juga menimbulkan tantangan. Pilihlah salah satu\r\ntantangan nasionalisme dalam era digital berikut!</span><br></p>', 'A. Kurangnya pemahaman masyarakat tentang nilai-nilai kebangsaan.', 'B. Semakin kuatnya pengaruh budaya asing.', 'C. Penyebaran informasi yang tidak akurat dan menyesatkan.', 'D. Kemudahan akses terhadap informasi dari luar negeri.', 'E. Kurangnya pengawasan pemerintah terhadap penggunaan media sosial.', 'C', NULL);
INSERT INTO `ujian_detail` VALUES (18, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Dalam konteks pembentukan identitas nasional yang\r\nseimbang dan inklusif, pemerintah memiliki peran penting dalam mendukung\r\npendidikan sebagai salah satu saluran untuk mencapai tujuan tersebut. Pilihlah\r\ntindakan yang dapat dilakukan oleh pemerintah melalui saluran pendidikan!</span><br></p>', 'A. Mendorong pengakuan dan penghargaan terhadap identitas lokal atau regional.', 'B. Memfasilitasi pembangunan budaya lokal dan mendorong pengenalan terhadap warisan budaya lokal di ', 'C. Mengajarkan sejarah nasional secara objektif dan inklusif.', 'D. Membangun lingkungan yang inklusif dan menggalakkan dialog antar kelompok.', 'E. Mendorong partisipasi masyarakat dalam pembangunan nasional.', 'A', NULL);
INSERT INTO `ujian_detail` VALUES (19, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Jepang pada masa penjajahan melakukan berbagai\r\nkebijakan yang berdampak pada depopulasi dan penyusutan jumlah penduduk di\r\nwilayah yang dikuasainya. Dampak yang kemungkinan akan terjadi dari fenomena\r\ndepopulasi tersebut adalah</span><br></p>', 'A. Akan terjadi perubahan signifikan dalam struktur sosial dan ekonomi negara.', 'B. Negara akan mengalami kebangkitan ekonomi yang pesat karena jumlah penduduk lebih sedikit.', 'C. Pemerintah akan memperketat kebijakan imigrasi untuk mengatasi penurunan populasi.', 'D. Akan terjadi pemekaran wilayah untuk menyeimbangkan distribusi penduduk.', 'E. Akan terjadi peningkatan akses penduduk terhadap sumber daya alam dan infrastruktur.', 'A', NULL);
INSERT INTO `ujian_detail` VALUES (20, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Suatu paham yang bertentangan dengan nasionalisme, di\r\nmana seseorang atau kelompok orang menganggap budaya, nilai, atau kelompok\r\netnis mereka sendiri sebagai standar atau yang paling baik, dan kemudian\r\nmenilai budaya, nilai, atau kelompok etnis lain dari perspektif yang sangat\r\nsubjektif dan seringkali negative disebut</span><br></p>', 'A. Eksklusivisme', 'B. Individualisme', 'C. Etnosentrisme', 'D. Chauvinisme', 'E. Liberalisme', 'C', NULL);
INSERT INTO `ujian_detail` VALUES (41, '5dOtC8sHWp', 'Jika x = berat total p kotak yang masingmasing beratnya q kg. Jika y = berat total q kotak yang masing-masing beratnya p kg, maka ', 'A.  x > y', 'B.  x < y', 'C.  x = y', 'D.  2x > 2y', 'E. x dan y tidak dapat ditentukan.', 'C', NULL);
INSERT INTO `ujian_detail` VALUES (42, 'RcfM6ASHDa', '<p>aaa<br></p>', 'A. aaa', 'B. aaa', 'C. aa', 'D. aa', 'E. aaa', 'aaa', NULL);
INSERT INTO `ujian_detail` VALUES (43, '1DBvE5IafV', '<p><img src=\"http://localhost:8080/assets/app-assets/file/1711251677_9ed7b7be85ec24398e24.png\" style=\"width: 334px;\"></p><p>where the hell is this?</p>', 'A. Austria', 'B. Russia', 'C. Thailand', 'D. Australia', 'E. England', 'a', NULL);
INSERT INTO `ujian_detail` VALUES (45, 'kZmslznr07', '<p>s<img src=\"http://localhost:8080/assets/app-assets/file/1711264735_f0af50420e57b0b5fe5a.png\" style=\"width: 552px;\"></p>', 'A. ', 'B. ', 'C. ', 'D. ', 'E. ', 'e', NULL);
INSERT INTO `ujian_detail` VALUES (49, 'Uzi8ID3Jqw', '<p>s<img src=\"http://localhost:8080/assets/app-assets/file/1711276705_dd13b77c2f17478c5dc4.png\" style=\"width: 600px;\"></p>', 'A. <p>a<img src=\"http://localhost:8080/assets/app-assets/file/1711276734_96657f9a24348206f9f5.png\" style=\"width: 318.4px;\"></p>', 'B. <p>b<img src=\"http://localhost:8080/assets/app-assets/file/1711276738_a81f29158a6cb1fcff19.png\" style=\"width: 318.4px;\"></p>', 'C. <p>c<img src=\"http://localhost:8080/assets/app-assets/file/1711276747_e1f901c558b138826446.png\" style=\"width: 275px;\"></p>', 'D. <p>d<img src=\"http://localhost:8080/assets/app-assets/file/1711276752_ee13f4d49f2b582641f4.png\" style=\"width: 318.4px;\"></p>', 'E. <p>e<img src=\"http://localhost:8080/assets/app-assets/file/1711276756_965a16f0698c69dd7393.png\" style=\"width: 318.4px;\"></p>', 'e', NULL);
INSERT INTO `ujian_detail` VALUES (51, 'okeU8rRMOS', '<p>tes</p><p><img src=\"http://localhost:8080/assets/app-assets/file/1711712838_39f4f9ab0aed0267f580.png\" style=\"width: 275px;\"><br></p>', 'A. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711712846_638bb1fb3bd35e4f50c5.png\" style=\"width: 264px;\">a</p>', 'B. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711712850_c109ff5a225606ae8c49.png\" style=\"width: 264px;\">b</p>', 'C. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711712861_ab3ac2248d878a756a09.png\" style=\"width: 264px;\">c</p>', 'D. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711712869_eed4b06f8cecdea7025a.png\" style=\"width: 264px;\">d</p>', 'E. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711712875_8f14619c85521e43076c.png\" style=\"width: 264px;\">e</p>', 'E', NULL);
INSERT INTO `ujian_detail` VALUES (53, 'WDTCy7XtV6', '<p>pembahasan</p>', 'A. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711715955_937dcc76bb6233dcd6eb.png\" style=\"width: 275px;\">a</p>', 'B. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711715960_3d222bdba26eddddb623.png\" style=\"width: 275px;\">b</p>', 'C. <p><img src=\"http://localhost:8080/assets/app-assets/file/1711715964_8e0870e7ff86f68b1156.png\" style=\"width: 275px;\">c</p>', 'D. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711715977_13206b9a5ad1798d4441.png\" style=\"width: 275px;\">d</p>', 'E. <p><br><img src=\"http://localhost:8080/assets/app-assets/file/1711715982_915e378193747e1fe77a.png\" style=\"width: 275px;\">e</p>', 'E', '<p>bahas</p><p><img src=\"http://localhost:8080/assets/app-assets/file/1711715993_35d9c42928676563a154.png\" style=\"width: 264px;\"><br></p>');
INSERT INTO `ujian_detail` VALUES (54, 'JDToR5VciO', '<p>awok</p>', 'A. <p>a</p>', 'B. <p>b</p>', 'C. <p>c</p>', 'D. <p>d</p>', 'E. <p>e</p>', 'a', '<p>bahas</p>');

-- ----------------------------
-- Table structure for ujian_siswa
-- ----------------------------
DROP TABLE IF EXISTS `ujian_siswa`;
CREATE TABLE `ujian_siswa`  (
  `id_ujian_siswa` int NOT NULL AUTO_INCREMENT,
  `ujian_id` int NOT NULL,
  `ujian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `siswa` int NOT NULL,
  `jawaban` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `benar` int NULL DEFAULT NULL,
  `ragu` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_ujian_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ujian_siswa
-- ----------------------------
INSERT INTO `ujian_siswa` VALUES (26, 16, 'Y3BxfqUNzX', 1, 'A', 0, NULL);
INSERT INTO `ujian_siswa` VALUES (27, 17, 'Y3BxfqUNzX', 1, 'C', 1, NULL);
INSERT INTO `ujian_siswa` VALUES (28, 18, 'Y3BxfqUNzX', 1, NULL, NULL, 1);
INSERT INTO `ujian_siswa` VALUES (29, 19, 'Y3BxfqUNzX', 1, 'E', 0, NULL);
INSERT INTO `ujian_siswa` VALUES (30, 20, 'Y3BxfqUNzX', 1, NULL, NULL, NULL);
INSERT INTO `ujian_siswa` VALUES (31, 41, '5dOtC8sHWp', 1, NULL, NULL, NULL);
INSERT INTO `ujian_siswa` VALUES (32, 42, 'RcfM6ASHDa', 1, NULL, NULL, NULL);
INSERT INTO `ujian_siswa` VALUES (33, 43, '1DBvE5IafV', 1, 'B', 0, NULL);
INSERT INTO `ujian_siswa` VALUES (34, 49, 'Uzi8ID3Jqw', 1, 'E', 0, NULL);
INSERT INTO `ujian_siswa` VALUES (35, 45, 'kZmslznr07', 1, 'E', 0, NULL);
INSERT INTO `ujian_siswa` VALUES (38, 53, 'WDTCy7XtV6', 1, 'E', 1, NULL);

-- ----------------------------
-- Table structure for user_token
-- ----------------------------
DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token`  (
  `id_user_token` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  PRIMARY KEY (`id_user_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_token
-- ----------------------------
INSERT INTO `user_token` VALUES (6, 'Arfod@gmail.com', 'Uz34JAdty2xhnCB9rQ5a1NmgwjFbqvoE', 1710601117);
INSERT INTO `user_token` VALUES (8, 'PEMBERIANAKUN@GMAIL.COm', 'JBu0zqytbIxKnreNYTMh4LPkpA8vsgwS', 1710603757);
INSERT INTO `user_token` VALUES (10, 'pemberianakun@gmail.com', '7B8awXFUL2jd4fSivRcKnCJgQbEW3qT0', 1710646645);
INSERT INTO `user_token` VALUES (13, 'shawnheike13@gmail.com', 's7zRKChamnJVcGwDWdbtTYoQqXxyHBji', 1711254259);

-- ----------------------------
-- Table structure for waktu_ujian
-- ----------------------------
DROP TABLE IF EXISTS `waktu_ujian`;
CREATE TABLE `waktu_ujian`  (
  `id_waktu_ujian` int NOT NULL AUTO_INCREMENT,
  `kode_ujian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_ujian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `siswa_id` int NOT NULL,
  `waktu_berakhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `selesai` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_waktu_ujian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 192 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of waktu_ujian
-- ----------------------------
INSERT INTO `waktu_ujian` VALUES (1, 'Y3BxfqUNzX', 'Tryout 1', 1, '2024-03-05 09:07', 1);
INSERT INTO `waktu_ujian` VALUES (22, '5dOtC8sHWp', 'TPA', 1, '2024-03-17 14:43', 1);
INSERT INTO `waktu_ujian` VALUES (23, '5dOtC8sHWp', 'TPA', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (24, 'RcfM6ASHDa', 'a', 1, '2024-03-18 17:50', 1);
INSERT INTO `waktu_ujian` VALUES (25, 'RcfM6ASHDa', 'a', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (26, '1DBvE5IafV', 'quiz img', 1, '2024-03-24 10:49', 1);
INSERT INTO `waktu_ujian` VALUES (27, '1DBvE5IafV', 'quiz img', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (28, '1DBvE5IafV', 'quiz img', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (29, 'naZkBzlMJy', 'quiz essay', 1, '2024-03-24 11:15', 1);
INSERT INTO `waktu_ujian` VALUES (30, 'naZkBzlMJy', 'quiz essay', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (31, 'naZkBzlMJy', 'quiz essay', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (36, 'kZmslznr07', 'q', 1, '2024-03-24 18:51', 1);
INSERT INTO `waktu_ujian` VALUES (37, 'kZmslznr07', 'q', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (38, 'kZmslznr07', 'q', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (39, 'kZmslznr07', 'q', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (52, 'Uzi8ID3Jqw', 'qq', 1, '2024-03-24 17:59', 1);
INSERT INTO `waktu_ujian` VALUES (53, 'Uzi8ID3Jqw', 'qq', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (54, 'Uzi8ID3Jqw', 'qq', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (55, 'Uzi8ID3Jqw', 'qq', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (68, 'FxGedhp7RQ', 'quiz essay', 1, '2024-03-24 19:25', 1);
INSERT INTO `waktu_ujian` VALUES (69, 'FxGedhp7RQ', 'quiz essay', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (70, 'FxGedhp7RQ', 'quiz essay', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (71, 'FxGedhp7RQ', 'quiz essay', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (160, 'OEftRBZ193', 'testing essay quiz', 1, '2024-03-27 19:46', 1);
INSERT INTO `waktu_ujian` VALUES (161, 'OEftRBZ193', 'testing essay quiz', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (162, 'OEftRBZ193', 'testing essay quiz', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (163, 'OEftRBZ193', 'testing essay quiz', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (172, 'ShEtWeIrLK', 'testing essay quiz 2', 1, '2024-03-27 20:29', 1);
INSERT INTO `waktu_ujian` VALUES (173, 'ShEtWeIrLK', 'testing essay quiz 2', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (174, 'ShEtWeIrLK', 'testing essay quiz 2', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (175, 'ShEtWeIrLK', 'testing essay quiz 2', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (176, 'okeU8rRMOS', 'testing quiz', 1, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (177, 'okeU8rRMOS', 'testing quiz', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (178, 'okeU8rRMOS', 'testing quiz', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (179, 'okeU8rRMOS', 'testing quiz', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (184, 'WDTCy7XtV6', 'testing quiz 2', 1, '2024-03-29 22:33', 1);
INSERT INTO `waktu_ujian` VALUES (185, 'WDTCy7XtV6', 'testing quiz 2', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (186, 'WDTCy7XtV6', 'testing quiz 2', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (187, 'WDTCy7XtV6', 'testing quiz 2', 6, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (188, 'JDToR5VciO', 'qq', 1, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (189, 'JDToR5VciO', 'qq', 4, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (190, 'JDToR5VciO', 'qq', 5, NULL, NULL);
INSERT INTO `waktu_ujian` VALUES (191, 'JDToR5VciO', 'qq', 6, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
