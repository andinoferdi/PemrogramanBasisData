/*
 Navicat Premium Dump SQL

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : uasbasdat

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 08/12/2024 23:32:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `barang_id` int NOT NULL AUTO_INCREMENT,
  `jenis` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_barang` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `satuan_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`barang_id`) USING BTREE,
  INDEX `satuan_id`(`satuan_id` ASC) USING BTREE,
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`satuan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for detail_penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `detail_penerimaan`;
CREATE TABLE `detail_penerimaan`  (
  `detail_penerimaan_id` bigint NOT NULL AUTO_INCREMENT,
  `penerimaan_id` bigint NOT NULL,
  `barang_id` int NOT NULL,
  `jumlah_terima` int NOT NULL,
  `harga_satuan_terima` int NOT NULL,
  `subtotal_terima` int NOT NULL,
  PRIMARY KEY (`detail_penerimaan_id`) USING BTREE,
  INDEX `penerimaan_id`(`penerimaan_id` ASC) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `detail_penerimaan_ibfk_1` FOREIGN KEY (`penerimaan_id`) REFERENCES `penerimaan` (`penerimaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_penerimaan_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for detail_pengadaan
-- ----------------------------
DROP TABLE IF EXISTS `detail_pengadaan`;
CREATE TABLE `detail_pengadaan`  (
  `detail_pengadaan_id` bigint NOT NULL AUTO_INCREMENT,
  `pengadaan_id` bigint NOT NULL,
  `barang_id` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`detail_pengadaan_id`) USING BTREE,
  INDEX `pengadaan_id`(`pengadaan_id` ASC) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `detail_pengadaan_ibfk_1` FOREIGN KEY (`pengadaan_id`) REFERENCES `pengadaan` (`pengadaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_pengadaan_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for detail_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan`  (
  `detail_penjualan_id` bigint NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint NOT NULL,
  `barang_id` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal` int NOT NULL,
  PRIMARY KEY (`detail_penjualan_id`) USING BTREE,
  INDEX `penjualan_id`(`penjualan_id` ASC) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`penjualan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for detail_retur
-- ----------------------------
DROP TABLE IF EXISTS `detail_retur`;
CREATE TABLE `detail_retur`  (
  `detail_retur_id` int NOT NULL AUTO_INCREMENT,
  `retur_id` bigint NOT NULL,
  `jumlah` int NOT NULL,
  `alasan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detail_penerimaan_id` bigint NOT NULL,
  PRIMARY KEY (`detail_retur_id`) USING BTREE,
  INDEX `retur_id`(`retur_id` ASC) USING BTREE,
  INDEX `detail_penerimaan_id`(`detail_penerimaan_id` ASC) USING BTREE,
  CONSTRAINT `detail_retur_ibfk_1` FOREIGN KEY (`retur_id`) REFERENCES `retur` (`retur_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detail_retur_ibfk_2` FOREIGN KEY (`detail_penerimaan_id`) REFERENCES `detail_penerimaan` (`detail_penerimaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for kartu_stok
-- ----------------------------
DROP TABLE IF EXISTS `kartu_stok`;
CREATE TABLE `kartu_stok`  (
  `kartu_stok_id` bigint NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `masuk` int NOT NULL,
  `keluar` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  PRIMARY KEY (`kartu_stok_id`) USING BTREE,
  INDEX `barang_id`(`barang_id` ASC) USING BTREE,
  CONSTRAINT `kartu_stok_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for margin_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `margin_penjualan`;
CREATE TABLE `margin_penjualan`  (
  `margin_penjualan_id` int NOT NULL AUTO_INCREMENT,
  `persen` double NOT NULL,
  `status` tinyint NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`margin_penjualan_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `margin_penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `penerimaan`;
CREATE TABLE `penerimaan`  (
  `penerimaan_id` bigint NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pengadaan_id` bigint NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`penerimaan_id`) USING BTREE,
  INDEX `pengadaan_id`(`pengadaan_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`pengadaan_id`) REFERENCES `pengadaan` (`pengadaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for pengadaan
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan`;
CREATE TABLE `pengadaan`  (
  `pengadaan_id` bigint NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `vendor_id` int NOT NULL,
  `subtotal_nilai` int NOT NULL,
  `ppn` int NOT NULL,
  `total_nilai` int NOT NULL,
  PRIMARY KEY (`pengadaan_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `vendor_id`(`vendor_id` ASC) USING BTREE,
  CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `penjualan_id` bigint NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal_nilai` int NOT NULL,
  `ppn` int NOT NULL,
  `total_nilai` int NOT NULL,
  `user_id` int NOT NULL,
  `margin_penjualan_id` int NOT NULL,
  PRIMARY KEY (`penjualan_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `margin_penjualan_id`(`margin_penjualan_id` ASC) USING BTREE,
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`margin_penjualan_id`) REFERENCES `margin_penjualan` (`margin_penjualan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for retur
-- ----------------------------
DROP TABLE IF EXISTS `retur`;
CREATE TABLE `retur`  (
  `retur_id` bigint NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `penerimaan_id` bigint NOT NULL,
  PRIMARY KEY (`retur_id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `penerimaan_id`(`penerimaan_id` ASC) USING BTREE,
  CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `retur_ibfk_2` FOREIGN KEY (`penerimaan_id`) REFERENCES `penerimaan` (`penerimaan_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `satuan_id` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT 1,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`satuan_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `role_id`(`role_id` ASC) USING BTREE,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for vendor
-- ----------------------------
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor`  (
  `vendor_id` int NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `badan_hukum` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`vendor_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- View structure for v_kartu_stok
-- ----------------------------
DROP VIEW IF EXISTS `v_kartu_stok`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_kartu_stok` AS select `ks`.`barang_id` AS `kartu_barang_id`,`b`.`nama_barang` AS `nama_barang`,`ks`.`jenis_transaksi` AS `jenis_transaksi`,`ks`.`masuk` AS `masuk`,`ks`.`keluar` AS `keluar`,`ks`.`stock` AS `stock`,`ks`.`created_at` AS `created_at`,`ks`.`transaksi_id` AS `transaksi_id`,ifnull((select sum((`kartu_stok`.`masuk` - `kartu_stok`.`keluar`)) from `kartu_stok` where ((`kartu_stok`.`barang_id` = `ks`.`barang_id`) and (`kartu_stok`.`created_at` <= `ks`.`created_at`) and (`kartu_stok`.`jenis_transaksi` <> 'P'))),0) AS `saldo` from (`kartu_stok` `ks` join `barang` `b` on((`ks`.`barang_id` = `b`.`barang_id`))) order by `ks`.`created_at` desc;

-- ----------------------------
-- Procedure structure for InsertBarang
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertBarang`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertBarang`(IN p_jenis CHAR(1),
    IN p_nama_barang VARCHAR(45),
    IN p_satuan_id INT,
    IN p_status TINYINT, -- Ubah menjadi TINYINT
    IN p_harga INT)
BEGIN
    INSERT INTO barang (jenis, nama_barang, satuan_id, status, harga)
    VALUES (p_jenis, p_nama_barang, p_satuan_id, p_status, p_harga);
    SELECT LAST_INSERT_ID() AS barang_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertDetailPenerimaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertDetailPenerimaan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertDetailPenerimaan`(
    IN barang_id INT,
    IN harga_satuan_terima INT,
    IN jumlah_terima INT,
    IN penerimaan_id BIGINT,
    IN subtotal_terima INT
)
BEGIN
    INSERT INTO detail_penerimaan (barang_id, harga_satuan_terima, jumlah_terima, penerimaan_id, subtotal_terima)
    VALUES (barang_id, harga_satuan_terima, jumlah_terima, penerimaan_id, subtotal_terima);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertDetailPengadaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertDetailPengadaan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertDetailPengadaan`(IN pengadaan_id BIGINT,
    IN barang_id INT,
    IN harga_satuan INT,
    IN jumlah INT,
    IN subtotal INT)
BEGIN
    INSERT INTO detail_pengadaan (pengadaan_id, barang_id, harga_satuan, jumlah, subtotal)
    VALUES (pengadaan_id, barang_id, harga_satuan, jumlah, subtotal);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertPenerimaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertPenerimaan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertPenerimaan`(IN pengadaan_id INT, IN user_id INT)
BEGIN
    -- Insert data penerimaan
    INSERT INTO penerimaan (pengadaan_id, user_id)
    VALUES (pengadaan_id, user_id);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertPengadaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertPengadaan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertPengadaan`(IN p_user_id INT,
    IN p_vendor_id INT,
    IN p_status TINYINT,
    IN p_subtotal_nilai INT,
    IN p_ppn INT,
    IN p_total_nilai INT)
BEGIN
    INSERT INTO pengadaan (user_id, vendor_id, status, subtotal_nilai, ppn, total_nilai)
    VALUES (p_user_id, p_vendor_id, p_status, p_subtotal_nilai, p_ppn, p_total_nilai);
    SELECT LAST_INSERT_ID() AS pengadaan_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertPenjualan
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertPenjualan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertPenjualan`(IN p_user_id INT,
    IN p_margin_penjualan_id INT,
    IN p_subtotal_nilai INT,
    IN p_ppn INT,
    IN p_total_nilai INT)
BEGIN
    INSERT INTO penjualan (user_id, margin_penjualan_id, subtotal_nilai, ppn, total_nilai, created_at)
    VALUES (p_user_id, p_margin_penjualan_id, p_subtotal_nilai, p_ppn, p_total_nilai, NOW());
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertRole
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertRole`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRole`(IN p_nama_role VARCHAR(100))
BEGIN
    INSERT INTO role (nama_role)
    VALUES (p_nama_role);
    SELECT LAST_INSERT_ID() AS role_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertSatuan
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertSatuan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSatuan`(IN p_nama_satuan VARCHAR(45),
    IN p_status TINYINT)
BEGIN
    INSERT INTO satuan (nama_satuan, status)
    VALUES (p_nama_satuan, p_status);
    SELECT LAST_INSERT_ID() AS satuan_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertUser`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUser`(IN p_username VARCHAR(45),
    IN p_password VARCHAR(100),
    IN p_role_id INT)
BEGIN
    INSERT INTO user (username, password, role_id)
    VALUES (p_username, p_password, p_role_id);
    SELECT LAST_INSERT_ID() AS user_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for InsertVendor
-- ----------------------------
DROP PROCEDURE IF EXISTS `InsertVendor`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertVendor`(IN p_nama_vendor VARCHAR(255),
    IN p_badan_hukum CHAR(1),
    IN p_status TINYINT)
BEGIN
    INSERT INTO vendor (nama_vendor, badan_hukum, status)
    VALUES (p_nama_vendor, p_badan_hukum, p_status);
    SELECT LAST_INSERT_ID() AS vendor_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_detail_penerimaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_detail_penerimaan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detail_penerimaan`(IN barang_id INT,
    IN harga_satuan_terima INT,
    IN jumlah_terima INT,
    IN penerimaan_id BIGINT,
    IN subtotal_terima INT)
BEGIN
    INSERT INTO detail_penerimaan (barang_id, harga_satuan_terima, jumlah_terima, penerimaan_id, subtotal_terima)
    VALUES (barang_id, harga_satuan_terima, jumlah_terima, penerimaan_id, subtotal_terima);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_detail_pengadaan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_detail_pengadaan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detail_pengadaan`(IN barang_id INT,
    IN harga_satuan INT,
    IN jumlah INT,
    IN pengadaan_id INT)
BEGIN
    DECLARE subtotal INT;
    SET subtotal = harga_satuan * jumlah;

    INSERT INTO detail_pengadaan (barang_id, harga_satuan, jumlah, subtotal, pengadaan_id)
    VALUES (barang_id, harga_satuan, jumlah, subtotal, pengadaan_id);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_detail_penjualan
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_detail_penjualan`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detail_penjualan`(IN p_barang_id INT,
    IN p_harga_satuan INT,
    IN p_jumlah INT,
    IN p_penjualan_id INT)
BEGIN
    DECLARE p_subtotal INT;

    SET p_subtotal = p_harga_satuan * p_jumlah;

    INSERT INTO detail_penjualan (penjualan_id, barang_id, harga_satuan, jumlah, subtotal)
    VALUES (p_penjualan_id, p_barang_id, p_harga_satuan, p_jumlah, p_subtotal);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_detail_retur
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_detail_retur`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detail_retur`(IN retur_id BIGINT,
    IN jumlah INT,
    IN alasan VARCHAR(200),
    IN detail_penerimaan_id BIGINT)
BEGIN
    INSERT INTO detail_retur (retur_id, jumlah, alasan, detail_penerimaan_id)
    VALUES (retur_id, jumlah, alasan, detail_penerimaan_id);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_retur
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_retur`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_retur`(
    IN user_id INT,
    IN penerimaan_id BIGINT
)
BEGIN
    INSERT INTO retur (user_id, penerimaan_id)
    VALUES (user_id, penerimaan_id);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `check_jumlah_terima_before_insert`;
delimiter ;;
CREATE TRIGGER `check_jumlah_terima_before_insert` BEFORE INSERT ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE max_jumlah INT;

    -- Ambil jumlah yang terdaftar di detail_pengadaan untuk barang yang sama
    SELECT jumlah INTO max_jumlah
    FROM detail_pengadaan
    WHERE barang_id = NEW.barang_id
    AND pengadaan_id = (SELECT pengadaan_id FROM penerimaan WHERE penerimaan_id = NEW.penerimaan_id LIMIT 1);

    -- Cek apakah jumlah yang diterima melebihi jumlah yang tersedia
    IF NEW.jumlah_terima > max_jumlah THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jumlah terima tidak boleh melebihi jumlah pengadaan';
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_insert_detail_penerimaan`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_penerimaan` AFTER INSERT ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    -- Ambil stok yang ada saat ini di kartu_stok
    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    -- Jika stok sebelumnya tidak ada (NULL), set ke 0
    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    -- Cek apakah stok sebelumnya sudah ada. Jika ada, hanya tambahkan jumlah yang diterima
    IF current_stock IS NOT NULL THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('O', NEW.jumlah_terima, 0, current_stock + NEW.jumlah_terima, NOW(), NEW.penerimaan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `check_jumlah_terima_before_update`;
delimiter ;;
CREATE TRIGGER `check_jumlah_terima_before_update` BEFORE UPDATE ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE max_jumlah INT;

    -- Ambil jumlah yang terdaftar di detail_pengadaan untuk barang yang sama
    SELECT jumlah INTO max_jumlah
    FROM detail_pengadaan
    WHERE barang_id = NEW.barang_id
    AND pengadaan_id = (SELECT pengadaan_id FROM penerimaan WHERE penerimaan_id = NEW.penerimaan_id LIMIT 1);

    -- Cek apakah jumlah yang diterima melebihi jumlah yang tersedia
    IF NEW.jumlah_terima > max_jumlah THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Jumlah terima tidak boleh melebihi jumlah pengadaan';
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_update_detail_penerimaan`;
delimiter ;;
CREATE TRIGGER `after_update_detail_penerimaan` AFTER UPDATE ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    -- Ambil stok yang ada saat ini di kartu_stok
    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    -- Jika stok sebelumnya tidak ada (NULL), set ke 0
    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    -- Cek apakah stok sebelumnya sudah ada. Jika ada, update stok berdasarkan perbedaan jumlah
    IF current_stock IS NOT NULL THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('O', NEW.jumlah_terima - OLD.jumlah_terima, 0, current_stock + (NEW.jumlah_terima - OLD.jumlah_terima), NOW(), NEW.penerimaan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_delete_detail_penerimaan`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_penerimaan` AFTER DELETE ON `detail_penerimaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    -- Ambil stok yang ada saat ini di kartu_stok
    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = OLD.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    -- Jika stok sebelumnya tidak ada (NULL), set ke 0
    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    -- Cek apakah stok sebelumnya sudah ada. Jika ada, kurangi stok berdasarkan jumlah yang dihapus
    IF current_stock IS NOT NULL THEN
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('O', OLD.jumlah_terima, 0, current_stock - OLD.jumlah_terima, NOW(), OLD.penerimaan_id, OLD.barang_id);
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_pengadaan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_insert_detail_pengadaan`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_pengadaan` AFTER INSERT ON `detail_pengadaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    -- Ambil stock terakhir dari kartu_stok
    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    -- Masukkan transaksi pengadaan ke kartu_stok, tanpa mengubah stock akhir
    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('P', NEW.jumlah, 0, current_stock, NOW(), NEW.pengadaan_id, NEW.barang_id);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_pengadaan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_update_detail_pengadaan`;
delimiter ;;
CREATE TRIGGER `after_update_detail_pengadaan` AFTER UPDATE ON `detail_pengadaan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    -- Ambil stock terakhir dari kartu_stok
    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    -- Masukkan transaksi pengadaan yang diperbarui
    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('P', NEW.jumlah - OLD.jumlah, 0, current_stock + (NEW.jumlah - OLD.jumlah), NOW(), NEW.pengadaan_id, NEW.barang_id);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_pengadaan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_delete_detail_pengadaan`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_pengadaan` AFTER DELETE ON `detail_pengadaan` FOR EACH ROW BEGIN
    -- Tidak perlu mengambil stok terakhir, cukup pastikan perubahan stok menjadi 0
    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('P', 0, 0, 0, NOW(), OLD.pengadaan_id, OLD.barang_id);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penjualan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_insert_detail_penjualan`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_penjualan` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL OR current_stock < NEW.jumlah THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak cukup untuk penjualan';
    ELSE
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('S', 0, NEW.jumlah, current_stock - NEW.jumlah, NOW(), NEW.penjualan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penjualan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_update_detail_penjualan`;
delimiter ;;
CREATE TRIGGER `after_update_detail_penjualan` AFTER UPDATE ON `detail_penjualan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;
    DECLARE stock_change INT;

    -- Ambil stok barang saat ini
    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = NEW.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    -- Jika stok barang tidak ada, set menjadi 0
    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    -- Menghitung perubahan stok berdasarkan perbedaan jumlah yang dijual
    SET stock_change = NEW.jumlah - OLD.jumlah;

    -- Jika jumlah penjualan bertambah, kurangi stok sesuai perubahan
    IF stock_change > 0 THEN
        -- Pastikan stok cukup sebelum menambahkan perubahan
        IF current_stock < stock_change THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak cukup untuk penjualan';
        ELSE
            -- Jika cukup, lakukan update kartu_stok untuk pengurangan stok
            INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
            VALUES ('S', 0, stock_change, current_stock - stock_change, NOW(), NEW.penjualan_id, NEW.barang_id);
        END IF;
    -- Jika jumlah penjualan berkurang, tambahkan stok sesuai perubahan
    ELSEIF stock_change < 0 THEN
        -- Mengembalikan stok yang tidak jadi terjual
        INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
        VALUES ('S', -stock_change, 0, current_stock - stock_change, NOW(), NEW.penjualan_id, NEW.barang_id);
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_penjualan
-- ----------------------------
DROP TRIGGER IF EXISTS `after_delete_detail_penjualan`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_penjualan` AFTER DELETE ON `detail_penjualan` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = OLD.barang_id
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('S', OLD.jumlah, 0, current_stock + OLD.jumlah, NOW(), OLD.penjualan_id, OLD.barang_id);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_retur
-- ----------------------------
DROP TRIGGER IF EXISTS `after_insert_detail_retur`;
delimiter ;;
CREATE TRIGGER `after_insert_detail_retur` AFTER INSERT ON `detail_retur` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id)
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('R', NEW.jumlah, 0, current_stock - NEW.jumlah, NOW(), NEW.retur_id, (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_retur
-- ----------------------------
DROP TRIGGER IF EXISTS `after_update_detail_retur`;
delimiter ;;
CREATE TRIGGER `after_update_detail_retur` AFTER UPDATE ON `detail_retur` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id)
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('R', NEW.jumlah - OLD.jumlah, 0, current_stock - (NEW.jumlah - OLD.jumlah), NOW(), NEW.retur_id, (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = NEW.detail_penerimaan_id));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table detail_retur
-- ----------------------------
DROP TRIGGER IF EXISTS `after_delete_detail_retur`;
delimiter ;;
CREATE TRIGGER `after_delete_detail_retur` AFTER DELETE ON `detail_retur` FOR EACH ROW BEGIN
    DECLARE current_stock INT;

    SELECT stock INTO current_stock
    FROM kartu_stok
    WHERE barang_id = (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = OLD.detail_penerimaan_id)
    ORDER BY kartu_stok_id DESC LIMIT 1;

    IF current_stock IS NULL THEN
        SET current_stock = 0;
    END IF;

    INSERT INTO kartu_stok (jenis_transaksi, masuk, keluar, stock, created_at, transaksi_id, barang_id)
    VALUES ('R', OLD.jumlah, 0, current_stock + OLD.jumlah, NOW(), OLD.retur_id, (SELECT barang_id FROM detail_penerimaan WHERE detail_penerimaan_id = OLD.detail_penerimaan_id));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `update_status_after_insert_penerimaan`;
delimiter ;;
CREATE TRIGGER `update_status_after_insert_penerimaan` AFTER INSERT ON `penerimaan` FOR EACH ROW BEGIN
    DECLARE total_penerimaan INT;
    
    SELECT COUNT(*) INTO total_penerimaan
    FROM penerimaan
    WHERE pengadaan_id = NEW.pengadaan_id;

    IF total_penerimaan > 0 THEN
        UPDATE pengadaan
        SET status = 1  -- status Sukses
        WHERE pengadaan_id = NEW.pengadaan_id;
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table penerimaan
-- ----------------------------
DROP TRIGGER IF EXISTS `update_status_after_delete_penerimaan`;
delimiter ;;
CREATE TRIGGER `update_status_after_delete_penerimaan` AFTER DELETE ON `penerimaan` FOR EACH ROW BEGIN
    DECLARE total_penerimaan INT;
    
    SELECT COUNT(*) INTO total_penerimaan
    FROM penerimaan
    WHERE pengadaan_id = OLD.pengadaan_id;

    IF total_penerimaan = 0 THEN
        UPDATE pengadaan
        SET status = 0 
        WHERE pengadaan_id = OLD.pengadaan_id;
    END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
