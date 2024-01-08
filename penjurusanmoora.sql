# Host: localhost  (Version 5.5.5-10.4.27-MariaDB)
# Date: 2023-05-24 12:24:00
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Data for table "kriteria"
#

INSERT INTO `kriteria` (`id`,`nama`,`kode`,`bobot`,`type`) VALUES (1,'Nilai rata-rata IPA','C1',30,'Benefits'),(2,'Nilai rata-rata IPS','C2',30,'Benefits'),(3,'Nilai test bakat IPA','C3',20,'Benefits'),(4,'Nilai test bakat IPS','C4',20,'Benefits');

#
# Data for table "periode"
#

INSERT INTO `periode` (`id`,`periode`,`status`) VALUES (1,'2023','0'),(2,'2024','0');

#
# Data for table "alternatif"
#

INSERT INTO `alternatif` (`id`,`nama`,`kode`,`periode_id`) VALUES (1,'BAGUS','A1',1),(2,'SYAHRIL','A2',1),(3,'AKBAR','A3',1),(4,'FARHAN ','A4',1),(5,'DENI','A5',1),(6,'AJI ','A6',1),(7,'GITA','A7',1),(8,'CHANDRA ','A8',1),(9,'UJANG ','A9',1),(10,'JOKO','A10',1);

#
# Data for table "preferensi"
#

INSERT INTO `preferensi` (`id`,`kriteria_id`,`alternatif_id`,`value`,`bobot`,`periode_id`) VALUES (1,1,1,90,4,1),(2,2,1,90,4,1),(3,3,1,80,3,1),(4,4,1,90,4,1),(5,1,2,92.5,5,1),(6,2,2,85,4,1),(7,3,2,100,5,1),(8,4,2,90,4,1),(9,1,3,93.75,5,1),(10,2,3,85,4,1),(11,3,3,90,4,1),(12,4,3,70,2,1),(13,1,4,92.5,5,1),(14,2,4,93,5,1),(15,3,4,80,3,1),(16,4,4,60,1,1),(17,1,5,95,5,1),(18,2,5,100,5,1),(19,3,5,75,3,1),(20,4,5,90,4,1),(21,1,6,100,5,1),(22,2,6,89,4,1),(23,3,6,65,2,1),(24,4,6,65,2,1),(25,1,7,75,3,1),(26,2,7,80,3,1),(27,3,7,89,4,1),(28,4,7,89,4,1),(29,1,8,74.75,3,1),(30,2,8,70,2,1),(31,3,8,96,5,1),(32,4,8,69,2,1),(33,1,9,62.5,2,1),(34,2,9,65,2,1),(35,3,9,78,3,1),(36,4,9,56,1,1),(37,1,10,64.75,2,1),(38,2,10,66,2,1),(39,3,10,60,1,1),(40,4,10,100,5,1);

#
# Data for table "sub"
#

INSERT INTO `sub` (`id`,`kriteria_id`,`range`,`bobot`) VALUES (1,1,'51-60',1),(2,1,'61-70',2),(3,1,'71-80',3),(4,1,'81-90',4),(5,1,'91-100',5),(6,2,'51-60',1),(7,2,'61-70',2),(8,2,'71-80',3),(9,2,'81-90',4),(10,2,'91-100',5),(11,3,'51-60',1),(12,3,'61-70',2),(13,3,'71-80',3),(14,3,'81-90',4),(15,3,'91-100',5),(16,4,'51-60',1),(17,4,'61-70',2),(18,4,'71-80',3),(19,4,'81-90',4),(20,4,'91-100',5);

#
# Data for table "user"
#

INSERT INTO `user` (`id`,`username`,`password`) VALUES (1,'Administrator','$2y$10$fWVUEgyjF64W3h3ZcqS1WO90hz7fRo.f9DFgRutv7XMHWBrHLK/AG');
