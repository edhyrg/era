# Host: localhost  (Version 5.5.5-10.4.11-MariaDB)
# Date: 2020-07-15 10:02:37
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "alternatif"
#

DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `periode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=583 DEFAULT CHARSET=latin1;

#
# Data for table "alternatif"
#

INSERT INTO `alternatif` VALUES (576,'edhy','sdad','123','2020'),(577,'wewe','qw','122','2020'),(578,'qewsd','qwq','123','2020'),(579,'prank','gaim','489','2020'),(581,'1qwew','weqwe','1234','2020'),(582,'wqseqw','wqedqw','5565','2019');

#
# Structure for table "atribut"
#

DROP TABLE IF EXISTS `atribut`;
CREATE TABLE `atribut` (
  `id_atribut` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_atribut`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "atribut"
#

INSERT INTO `atribut` VALUES (1,'Benefit'),(2,'Cost');

#
# Structure for table "hasil"
#

DROP TABLE IF EXISTS `hasil`;
CREATE TABLE `hasil` (
  `Id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `hasil` varchar(20) DEFAULT NULL,
  `periode` varchar(20) DEFAULT NULL,
  `pilih` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Data for table "hasil"
#

INSERT INTO `hasil` VALUES (1,581,'0.4931','2020',1),(2,579,'0.382','2020',2),(3,577,'0.2291','2020',2),(4,578,'0.2047','2020',2),(5,576,'0.0644','2020',2),(6,582,'NAN','2020',2);

#
# Structure for table "kriteria"
#

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `atribut` int(11) DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`),
  KEY `kriteria_ibfk_1` (`atribut`),
  CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`atribut`) REFERENCES `atribut` (`id_atribut`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

#
# Data for table "kriteria"
#

INSERT INTO `kriteria` VALUES (36,'Harga',2,0.1639),(37,'Kualutas',1,0.2708),(38,'jarak',2,0.0721),(39,'waktu',2,0.2708),(42,'pelayanan',1,0.2223);

#
# Structure for table "bobot_kriteria"
#

DROP TABLE IF EXISTS `bobot_kriteria`;
CREATE TABLE `bobot_kriteria` (
  `kriteria_1` int(11) NOT NULL,
  `kriteria_2` int(11) NOT NULL,
  `bobot` char(5) NOT NULL,
  KEY `kriteria_1` (`kriteria_1`),
  KEY `kriteria_2` (`kriteria_2`),
  CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`kriteria_1`) REFERENCES `kriteria` (`id_kriteria`) ON UPDATE CASCADE,
  CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`kriteria_2`) REFERENCES `kriteria` (`id_kriteria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "bobot_kriteria"
#

INSERT INTO `bobot_kriteria` VALUES (36,37,'1/3'),(36,38,'4/1'),(36,39,'1/3'),(36,42,'1/1'),(37,38,'3/1'),(37,39,'1/1'),(37,42,'1/1'),(38,39,'1/3'),(38,42,'1/3'),(39,42,'1/1');

#
# Structure for table "level"
#

DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` char(30) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "level"
#

INSERT INTO `level` VALUES (0,'Admin'),(1,'Petugas'),(2,'Pakar/Ahli');

#
# Structure for table "nilai_alternatif"
#

DROP TABLE IF EXISTS `nilai_alternatif`;
CREATE TABLE `nilai_alternatif` (
  `alternatif` int(11) DEFAULT NULL,
  `kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  KEY `alternatif` (`alternatif`),
  KEY `kriteria` (`kriteria`),
  CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON UPDATE CASCADE,
  CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "nilai_alternatif"
#

INSERT INTO `nilai_alternatif` VALUES (577,36,90),(577,37,80),(577,38,75),(577,39,60),(578,36,90),(578,36,90),(578,37,70),(578,38,60),(578,39,70),(576,36,20),(576,37,20),(576,36,30),(576,39,30),(576,38,75),(579,36,3000),(579,37,100),(579,38,7),(579,39,3),(579,42,50),(576,42,4.6),(577,42,5.6),(578,42,6.8),(581,36,1000),(581,37,100),(581,38,100),(581,39,100),(581,42,100);

#
# Structure for table "pengguna"
#

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `username` char(50) NOT NULL,
  `password` char(64) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `nama` char(50) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `level` (`level`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level` (`id_level`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "pengguna"
#

INSERT INTO `pengguna` VALUES ('Era','49eaab7e75d92ddfe7e7f7fb09f854116055d11f1d946b9e7fdfad8b8e56c8a0',1,'Era');

#
# Structure for table "masuk"
#

DROP TABLE IF EXISTS `masuk`;
CREATE TABLE `masuk` (
  `id_pengguna` char(36) NOT NULL,
  `pengguna` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`),
  KEY `masuk_ibfk_1` (`pengguna`),
  CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`pengguna`) REFERENCES `pengguna` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "masuk"
#

INSERT INTO `masuk` VALUES ('087f291c-b91c-11ea-9a85-f0761cc0f78b','era'),('29bbef2f-c5c2-11ea-b3a9-f0761cc0f78b','era'),('4cc65a27-0cd6-11ea-8941-87bc1a4d341c','Era'),('7c814dad-bc59-11ea-9c60-f0761cc0f78b','era'),('d0899db6-c504-11ea-b3a9-f0761cc0f78b','era'),('e261e0a1-b227-11ea-9987-f0761cc0f78b','Era');

#
# Structure for table "tanggapan"
#

DROP TABLE IF EXISTS `tanggapan`;
CREATE TABLE `tanggapan` (
  `id_tanggapan` char(36) NOT NULL,
  `tanggapan` text DEFAULT NULL,
  `akurasi` double NOT NULL,
  PRIMARY KEY (`id_tanggapan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tanggapan"
#

INSERT INTO `tanggapan` VALUES ('472ff6b3-ad48-11ea-97f0-f0761cc0f78b','\n    <script>__nilai = 100;</script>\n        <table class=\"table table-bordered table-sm table-striped small\">\n            <tbody><tr class=\"text-center\">\n                <th>Rangking</th>\n                <th>Alternatif</th>\n                <th>Nilai</th>\n                <th>Kesesuaian Pengguna</th>\n            </tr>\n            <tr id=\"baris-579\"><td>1</td><td>prank</td><td>0.7259</td><td><div class=\"custom-control custom-checkbox text-center\">\n            <input type=\"checkbox\" class=\"custom-control-input sesuai\" id=\"sesuai-579\" unchecked=\"\">\n            <label class=\"custom-control-label\" id=\"label-579\" for=\"sesuai-579\"></label>\n            </div></td></tr><tr id=\"baris-581\"><td>2</td><td>1qwew</td><td>0.5095</td><td><div class=\"custom-control custom-checkbox text-center\">\n            <input type=\"checkbox\" class=\"custom-control-input sesuai\" id=\"sesuai-581\" unchecked=\"\">\n            <label class=\"custom-control-label\" id=\"label-581\" for=\"sesuai-581\"></label>\n            </div></td></tr><tr id=\"baris-577\"><td>3</td><td>wewe</td><td>0.2858</td><td><div class=\"custom-control custom-checkbox text-center\">\n            <input type=\"checkbox\" class=\"custom-control-input sesuai\" id=\"sesuai-577\" unchecked=\"\">\n            <label class=\"custom-control-label\" id=\"label-577\" for=\"sesuai-577\"></label>\n            </div></td></tr><tr id=\"baris-576\"><td>4</td><td>edhy</td><td>0.2621</td><td><div class=\"custom-control custom-checkbox text-center\">\n            <input type=\"checkbox\" class=\"custom-control-input sesuai\" id=\"sesuai-576\" unchecked=\"\">\n            <label class=\"custom-control-label\" id=\"label-576\" for=\"sesuai-576\"></label>\n            </div></td></tr><tr id=\"baris-578\"><td>5</td><td>qewsd</td><td>0.2611</td><td><div class=\"custom-control custom-checkbox text-center\">\n            <input type=\"checkbox\" class=\"custom-control-input sesuai\" id=\"sesuai-578\" unchecked=\"\">\n            <label class=\"custom-control-label\" id=\"label-578\" for=\"sesuai-578\"></label>\n            </div></td></tr>        </tbody></table>\n    ',0);
