/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `laravel`;

/*Table structure for table `krs` */

DROP TABLE IF EXISTS `krs`;

CREATE TABLE `krs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_krs` varchar(20) DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `krs` */

insert  into `krs`(`id`,`nama_krs`,`mahasiswa_id`) values 
(1,'2023/2024 Ganjil',1),
(2,'2023/2024 Genap',1),
(3,'2023/2024 Ganjil',2);

/*Table structure for table `krs_detail` */

DROP TABLE IF EXISTS `krs_detail`;

CREATE TABLE `krs_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `krs_id` int(11) DEFAULT NULL,
  `matakuliah_id` int(11) DEFAULT NULL,
  `nilai_akhir` float DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `krs_detail` */

insert  into `krs_detail`(`id`,`krs_id`,`matakuliah_id`,`nilai_akhir`,`updated_at`,`created_at`) values 
(1,2,1,90,'2024-04-29 23:59:02','2024-04-29 23:59:06'),
(2,1,2,80,'2024-04-29 23:59:00','2024-04-29 23:59:08'),
(3,1,3,70,'2024-04-29 23:58:59','2024-04-29 23:59:09'),
(4,1,1,1,'2024-04-29 23:58:57','2024-04-29 23:59:11'),
(5,1,1,1,'2024-04-29 23:58:54','2024-04-29 23:59:13'),
(6,1,1,12,'2024-04-29 14:16:16','2024-04-29 14:16:16'),
(7,1,3,33.3,'2024-04-29 14:18:49','2024-04-29 14:18:49'),
(8,1,1,100,'2024-04-29 14:40:21','2024-04-29 14:40:21'),
(9,3,2,100,'2024-04-29 23:58:51','2024-04-29 23:59:15'),
(10,3,1,100,'2024-04-29 23:59:28','2024-04-29 23:59:30'),
(11,3,3,100,'2024-04-29 23:59:41','2024-04-29 23:59:43');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`id`,`nim`,`nama`) values 
(1,'2105551001','Anto'),
(2,'2105551002','Budi');

/*Table structure for table `matakuliah` */

DROP TABLE IF EXISTS `matakuliah`;

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(10) DEFAULT NULL,
  `nama_mk` varchar(30) DEFAULT NULL,
  `sks` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `matakuliah` */

insert  into `matakuliah`(`id`,`kode_mk`,`nama_mk`,`sks`) values 
(1,'TIU10001','PPL',2),
(2,'TIU10002','Prognet',3),
(3,'TIU10003','Progmob',3);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`admin`) values 
(1,'admin','admin@gmail.com','$2y$10$B74x.si7q5xCJTdENNY67.dG/TQPQ4THYppKM0vLa9IkwbTRcQAg.','2023-01-07 04:44:24','2023-01-07 04:44:24',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
