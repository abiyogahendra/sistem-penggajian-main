-- Tabel 'users'
CREATE TABLE `sistem_penggajian`.`users` ( 
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
  `nama` VARCHAR(128), 
  `username` VARCHAR(64), 
  `password` VARCHAR(128), 
  `is_admin` TINYINT(3) DEFAULT 0, 
  `created_at` DATETIME, 
  `updated_at` DATETIME, 
  `deleted_at` DATETIME, 
  PRIMARY KEY (`id`) 
);

-- Tabel 'karyawan'
CREATE TABLE `sistem_penggajian`.`karyawan` (
  `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR (128),
  `alamat` VARCHAR (255),
  `telepon` VARCHAR (24),
  `username` VARCHAR (64),
  `salary` INT (11) UNSIGNED,
  `tanggal_masuk` DATE,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  `deleted_at` DATETIME,
  PRIMARY KEY (`id`)
);