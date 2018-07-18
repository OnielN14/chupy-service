-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 06:07 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_chuppy_rpl`
--

--
-- Dumping data for table `fotokonten`
--

INSERT INTO `fotokonten` (`id`, `gambar`, `idKonten`) VALUES
(1, 'http://127.0.0.1:8000/storage/img/img_konten/konten1.jpg', 1),
(2, 'http://127.0.0.1:8000/storage/img/img_konten/konten2.jpg', 4);

--
-- Dumping data for table `fotoproduk`
--

INSERT INTO `fotoproduk` (`id`, `gambar`, `idProduk`) VALUES
(1, 'http://127.0.0.1:8000/storage/img/img_produk/produk1.jpg', 3),
(2, 'http://127.0.0.1:8000/storage/img/img_produk/produk2.jpg', 4);

--
-- Dumping data for table `hakakses`
--

INSERT INTO `hakakses` (`id`, `levelAkses`) VALUES
(1, 'admin'),
(2, 'mucikari'),
(3, 'pengguna');

--
-- Dumping data for table `jenisproduk`
--

INSERT INTO `jenisproduk` (`id`, `nama`) VALUES
(1, 'Hewan'),
(2, 'Kebutuhan');

--
-- Dumping data for table `kategorikonten`
--

INSERT INTO `kategorikonten` (`id`, `nama`) VALUES
(1, 'Berita'),
(2, 'Artikel'),
(3, 'Tips n Trik');

--
-- Dumping data for table `kategoriproduk`
--

INSERT INTO `kategoriproduk` (`id`, `nama`) VALUES
(1, 'Makanan Hewan'),
(2, 'Reptil'),
(3, 'Burung'),
(4, 'Mamalia'),
(5, 'Aksesoris');

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id`, `judul`, `deskripsi`, `idKategori`, `created_at`, `updated_at`) VALUES
(1, '9 Hewan Unik dengan Tubuh Transparan dan Hampir Tak Terlihat', 'Makhluk yang hidup di sekitar kita memiliki kemampuan bertahan hidup yang beragam. Sebagian besar dari mereka bahkan memiliki kemampuan unik yang sepertinya tampak tak masuk akal. Kemampuan unik ini tak hanya dimiliki oleh hewan dengan pergerakan aktif. Bahkan sebagian tumbuhan tertentu memiliki kemampuan bertahan dan menyerang yang unik dan malah mengerikan. Tentang hewan unik ini, mereka yang hidup di lautan memiliki kemampuan khusus seperti tubuh yang transparan dan sebagian spesies bahkan mengeluarkan cahaya.', 2, NULL, NULL),
(2, 'Gajah Sirkus Jatuh Menimpa Penonton Picu Kecaman Luas di Jerman', 'Pro dan kontra tentang penggunaan hewan liar pada pertunjukan sirkus kembali mengemuka, setelah kasus seekor gajah jatuh menimpa penonton di Jerman.\r\n\r\nRekaman video dari sebuah pertunjukan di Osnabrück menunjukkan dua ekor gajah di dekat pagar pembatas, tiba-tiba berjalan sempoyongan, hingga membuatnya jatuh ke arah penonton yang duduk di barisan kursi terdepan.\r\n\r\nDikutip dari Independent.co.uk pada Minggu (8/7/2018), penonton segera meninggalkan tempat duduk mereka untuk menghindari bahaya lebih lanjut. Tidak ada yang terluka parah, tetapi pimpinan sirkus kemudian mengatakan satu orang di antara penonton mengalami luka di kakinya.', 1, NULL, NULL),
(3, 'Cara Merawat Hewan Peliharaan di Rumah dengan Baik dan Benar\r\n\r\nSource: https://jempolkaki.com/cara-merawat-hewan-peliharaan/\r\nDisalin dari http://jempolkaki.com/', 'Cara Merawat Hewan Peliharaan. Sangat umum disekitar kita untuk mempunyai hewan peliharaan atau biasa disebut pets di rumah, biasanya adalah hewan yang jinak sehingga bisa dipelihara, disayang dan tidak berbahaya. Hewan paling umum yang biasa dipelihara adalah kucing, anjing dan burung.\r\n\r\n', 3, NULL, NULL),
(4, 'Cara Merawat Hewan Peliharaan', 'entukan apakah Anda mampu merawat hewan peliharaan. Meskipun memelihara hewan peliharaan sangat menyenangkan, mereka tidak mudah dirawat. Semua hewan peliharaan memerlukan waktu, uang, dan kasih sayang. Selain itu, hewan dan peranakan tertentu memiliki berbagai kebutuhan khusus. Pastikan Anda memang menginginkan hewan peliharaan dalam jangka panjang.\r\nSebagian hewan peliharaan memerlukan perhatian khusus dan perawatan di siang hari. Jadi, pastikan Anda sudah berada di rumah untuk merawat hewan peliharaan.\r\nJika Anda memilki anak, cari hewan peliharaan yang aman untuk anak-anak. Sebagai contoh, hamster atau ikan cocok sebagai hewan peliharaan pertama Anda.\r\nJika Anda berencana pindah atau mengubah gaya hidup secara drastis, jangan pelihara hewan sampai hidup Anda stabil.[1]', 3, NULL, NULL),
(5, 'Fakta Kejam di Balik Pelatihan Hewan Sirkus', 'Untuk menjadi hewan sirkus yang lihai memainkan berbagai trik, para hewan ini telah menjalani berbagai metode pelatihan. Seperti halnya manusia, hewan juga bisa mempelajari banyak hal, namun tentu saja diperlukan cara khusus agar mereka menurut dan mampu melakukan hal-hal yang sudah diajarkan.', 1, NULL, NULL);

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`id`, `longitude`, `latitude`, `nama`, `deskripsi`, `foto`, `url_foto`, `created_at`, `updated_at`) VALUES
(1, '100', '100', 'Buggy petshop', 'buggy petshop menyediakan makanan anjing dan kucinh', 'a1.jpg', 'http://127.0.0.1:8000/storage/img/img_map/a1.jpg', NULL, NULL),
(2, '200', '200', 'Tantan Petshop', 'menyediakan berbagai macam makanan reptil', 'a1.jpg', 'http://127.0.0.1:8000/storage/img/img_map/a1.jpg', NULL, NULL),
(3, '300', '300', 'Ponpon petshop', 'disini tersedia obat untuk hewan peliharaan', 'a1.jpg', 'http://127.0.0.1:8000/storage/img/img_map/a1.jpg', '2018-07-13 08:39:34', '2018-07-13 08:39:34'),
(4, '400', '400', 'mancy', 'jual hewan peliharaan reptil dan sebagainya', 'a1.jpg', 'http://127.0.0.1:8000/storage/img/img_map/a1.jpg', '2018-07-13 08:39:34', '2018-07-13 08:39:34');

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `name`, `email`, `password`, `remember_token`, `idHakakses`, `created_at`, `updated_at`) VALUES
(1, 'Admin Chupy', 'admin@chupy.com', '$2y$10$acqXvPyJWx4tLJ5EBdyDBOsHGDexGhJgZcj1NJD.l32g8iJyUkKDm', NULL, 1, '2018-07-15 03:00:32', '2018-07-15 03:00:32');

--
-- Dumping data for table `petshop`
--

INSERT INTO `petshop` (`id`, `nama`, `deskripsi`, `alamat`, `idPengguna`, `idMap`, `created_at`, `updated_at`) VALUES
(1, 'Tickle the Pickle', 'menyediakan berbagai jeis kebutuhan hewan dari makanan,obat-obatan dan aksesoris', 'jalan dago no 90', 2, 1, NULL, NULL),
(2, 'Buggy\'s petshop', 'Penuhi kebutuhan hewanmu dengan membelinya di Buggy\'s petshop\r\n\r\nAda diskon loh...', 'jalan genesha no 76', 2, 2, NULL, NULL),
(3, 'Neko Petshop', 'menyediakan berbagai kebutuhan untuk kucing anda ', 'jalan dipati ukur no 1', 2, 3, NULL, NULL),
(4, 'Nyanyan Petshop', 'Menjual hewan peliharaan dari mamalia sampai reptil', 'jalan tubagus ismail no 76', 2, 4, NULL, NULL);

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `stok`, `harga`, `idKategori`, `created_at`, `updated_at`) VALUES
(1, 'Whiskas', 'Makanan bernutrisi bagi kucing anda ', 5, 9000, 1, NULL, NULL),
(2, 'Nyanyan bando', 'Percantik kucing anda dengan bando yang lucu ini', 7, 5000, 5, NULL, NULL),
(3, 'Shironeko', 'kucing putih asli siberia dengan bulu yang lembut dan menggemaskan', 3, 300000, 4, NULL, NULL),
(4, 'waninoko', 'Buaya asli sungai amazon untuk menemani hari-harimu yang galau', 2, 700000, 2, NULL, NULL),
(5, 'Lamia', 'Anak ular lucu untuk melepas stresmu ', 4, 1000000, 2, NULL, NULL);

--
-- Dumping data for table `tagkonten`
--

INSERT INTO `tagkonten` (`id`, `nama`) VALUES
(1, 'Mamalia'),
(2, 'Kucing'),
(3, 'Burung'),
(4, 'Ikan'),
(5, 'Anjing'),
(6, 'Aksesoris'),
(7, 'Bagaimana cara'),
(8, 'Kesehatan Hewan'),
(9, 'Reptil'),
(10, 'Makanan ');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
