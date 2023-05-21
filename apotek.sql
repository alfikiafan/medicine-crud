CREATE DATABASE IF NOT EXISTS obat;

USE obat;

CREATE TABLE IF NOT EXISTS obat (
  id int(10) NOT NULL AUTO_INCREMENT,
  nama VARCHAR(50) NOT NULL,
  merek VARCHAR(30) NOT NULL,
  varian VARCHAR(30),
  kedaluwarsa DATETIME NOT NULL,
  stok int(5) NOT NULL,
  satuan VARCHAR(30) NOT NULL,
  harga int(9) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO obat (id, nama, merek, varian, kedaluwarsa, stok, satuan, harga) VALUES
(1, 'Woods Peppermint Expectorant', 'Woods', '100 ml', '2024-02-12', 20, 'botol', 40000),
(2, 'Siladex Mucolytic Expectorant', 'Siladex', '60 ml', '2023-09-16', 25, 'botol', 18500),
(3, 'Ultraflu', 'Ultraflu', '-', '2024-05-02', 34, 'strip', 2500);