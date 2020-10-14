-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 07 Sep 2020 pada 18.05
-- Versi server: 8.0.21-0ubuntu0.20.04.4
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_berita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `berita_created` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `berita_final` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tanggal` datetime NOT NULL,
  `konten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(255) NOT NULL
);

--
-- Dumping data untuk tabel `tb_berita`
--

INSERT INTO `tb_berita` (`id`, `user_id`, `judul`, `kategori`, `berita_created`, `berita_final`, `tanggal`, `konten`, `status`) VALUES
(1, 2, 'Pada Suatu Kesempatan Jack Ma Pernah Minum', 'Politik', '<p>Kejadian itu terjadi di sanghai saata Jack Ma debat dengan Elon Musk, di duga Jack Ma merasa haus dan lalu minum air yang telah disediakan</p>', '<p>Kejadian itu terjadi di sanghai saata Jack Ma debat dengan Elon Musk, di duga Jack Ma merasa haus dan lalu minum air yang telah disediakan. Pada saat itu juga saya ndak mengerti lagi, harus mengerti</p>', '2020-08-31 00:00:00', 'konten_file_2_1598883363.mp3', 'refuse'),
(2, 2, 'Merasa Tidak Cocok Lagi Akhirnya Perempuan Ini Putus Dengan Pacarnya', 'Sosial', '<p>Merasa tidak bebas dan sudah tidak cocok lagi, dan berdasarkan saran dari teman-temannya akhirnya perempuan ini memilih mengakhiri hubungan dengan pacarnya</p>', '<p>Merasa tidak bebas dan sudah tidak cocok lagi, dan berdasarkan saran dari teman-temannya akhirnya perempuan ini memilih mengakhiri hubungan dengan pacarnya. (Pacar itu apa bangsad). tessss, tesss</p>', '2020-08-31 00:00:00', 'konten_file_2_1598883670.mp3', 'verify'),
(3, 3, 'Berita Sampel Ini di Buat Untuk Keperluan Testing', 'Pendidikan', '<p>Testing di lakukan pada hari senin 31 Agustus 2020 jam 22:57, di patalassang, ini adalah sebuah teks yang sangat tidak berfaedah kamu tau itu kan, intinya amanji bos ku, daisuki yo anatawa daisuki kimi no my <strong>kanajo</strong> adalah sebuah mimpi yang indah</p>', '<p>Testing di lakukan pada hari senin 31 Agustus 2020 jam 22:57, di patalassang, ini adalah sebuah teks yang sangat tidak berfaedah kamu tau itu kan, intinya amanji bos ku, daisuki yo anatawa daisuki kimi no my <strong>kanajo</strong> adalah sebuah mimpi yang indah. (ini tambahan)</p>', '2020-08-31 00:00:00', '', 'verify_'),
(4, 3, 'Berita Sampel Kedua Telah Diterbitkan', 'Pendidikan', '<p>Sembarang mo saja dulu nah</p>', '<p>Sembarang mo saja dulu nah</p>', '2020-09-01 00:00:00', 'konten_file_3_1598895248.mp3', 'refuse_'),
(5, 6, 'Testing Untuk Yang Ketiga Kalinya Dilakukan di Awal Bulan', 'Pendidikan', '<p>Tes Lagi Yah</p>', NULL, '2020-09-01 00:00:00', '', 'waiting'),
(6, 5, 'Testing Lagi, Katanya Masih Butuh', 'Budaya', '<p>Apa bagus dii</p>', '<p>Apa bagus dii? Kamu kyknya deh :v</p><p>Ok Fix, dirimi yg terbaik. OK</p>', '2020-09-01 00:00:00', '', 'done'),
(7, 3, 'Dorem ipsum dolor sit amet, consectetur adipisicing elit edit', 'Sosial', '<p>Dorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique? Tempore, quos delectus asperiores libero voluptas quod perferendis! Voluptate, quod illo rerum? Lorem ipsum dolor sit amet. Dorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique? Tempore, quos delectus asperiores libero voluptas quod perferendis! Voluptate, quod illo rerum? Lorem ipsum dolor sit amet.</p>', '<p>Dorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique? Tempore, quos delectus asperiores libero voluptas quod perferendis! Voluptate, quod illo rerum? Lorem ipsum dolor sit amet. Dorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique? Tempore, quos delectus asperiores libero voluptas quod perferendis! Voluptate, quod illo rerum? Lorem ipsum dolor sit amet.</p><p>Ini Adalah Koreksi Ok</p>', '2020-09-07 00:00:00', '', 'verify_');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
);

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `nama_kategori`, `keterangan`) VALUES
(1, 'Pendidikan', ''),
(2, 'Ekonomi', ''),
(3, 'Politik', ''),
(4, 'Sosial', ''),
(5, 'Budaya', ''),
(6, 'Agama', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keterangan`
--

CREATE TABLE `tb_keterangan` (
  `id` int NOT NULL,
  `berita_id` int NOT NULL,
  `keterangan` text NOT NULL
);

--
-- Dumping data untuk tabel `tb_keterangan`
--

INSERT INTO `tb_keterangan` (`id`, `berita_id`, `keterangan`) VALUES
(1, 4, 'Tidak Sesuai Dengan Judul'),
(3, 1, 'Kurang menarik, ngak guna sama sekali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_revisi`
--

CREATE TABLE `tb_revisi` (
  `id` int NOT NULL,
  `berita_id` int NOT NULL,
  `editor_id` int NOT NULL,
  `berita_revisi` text NOT NULL,
  `catatan_editor` text NOT NULL
);

--
-- Dumping data untuk tabel `tb_revisi`
--

INSERT INTO `tb_revisi` (`id`, `berita_id`, `editor_id`, `berita_revisi`, `catatan_editor`) VALUES
(1, 3, 9, '<p>Testing di lakukan pada hari senin 31 Agustus 2020 jam 22:57, di patalassang, ini adalah sebuah teks yang sangat tidak berfaedah kamu tau itu kan, intinya amanji bos ku, daisuki yo anatawa daisuki kimi no my <strong>kanajo</strong> adalah sebuah mimpi yang indah. (ini tambahan)</p>', '<ol><li>Buat judul yang masuk akal</li><li>Isinya kurang sekali</li><li>Tambah apa saja</li><li>Banyak Typonya<br></li></ol>'),
(2, 4, 9, '<p>Sembarang mo saja dulu nah</p>', ''),
(3, 2, 9, '<p>Merasa tidak bebas dan sudah tidak cocok lagi, dan berdasarkan saran dari teman-temannya akhirnya perempuan ini memilih mengakhiri hubungan dengan pacarnya. (Pacar itu apa bangsad). tessss, tesss</p>', '<ol><li>Ubah judul yang lebih bagus</li><li>Cari kata yang tept</li><li>Periksa Semua Typo<br></li></ol>'),
(4, 6, 9, '<p>Apa bagus dii? Kamu kyknya deh :v</p><p>Ok Fix, dirimi yg terbaik. OK</p>', '<ol><li>Tambahkan Sumber yang jelas</li><li>Jangan Terlalu pendek</li></ol>'),
(5, 5, 10, '<p>Tes Lagi Yah</p>', ''),
(6, 1, 10, '<p>Kejadian itu terjadi di sanghai saata Jack Ma debat dengan Elon Musk, di duga Jack Ma merasa haus dan lalu minum air yang telah disediakan. Pada saat itu juga saya ndak mengerti lagi, harus mengerti</p>', '<p>Berita terlalu singkat, tambah lebih banyak.</p><p>Kasi mengerti</p>'),
(7, 7, 10, '<p>Dorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique? Tempore, quos delectus asperiores libero voluptas quod perferendis! Voluptate, quod illo rerum? Lorem ipsum dolor sit amet. Dorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique? Tempore, quos delectus asperiores libero voluptas quod perferendis! Voluptate, quod illo rerum? Lorem ipsum dolor sit amet.</p><p>Ini Adalah Koreksi Ok</p>', '<ol><li>Kasi Jelas</li><li>Judul sesuaikan</li></ol>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'default.png',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'waiting'
);

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `alamat`, `no_hp`, `jabatan`, `foto`, `username`, `password`, `status`) VALUES
(1, 'Kepala Bidang', '', '', 'kabid', 'default.png', 'admin', '$2y$10$QgpXDnoMd9.HjTZs5xZEQeD/EIrKJzf9GX.0DRUwbVInmWcNPbuKe', 'active'),
(2, 'Putri Diana Risdayanti', 'Tanete, Bulukumba', '085333341195', 'reporter', 'image_1599463701.png', 'putridiana', '$2y$10$HO9JBqw9QpKwTFrc5/8uo.uiwvxdJmUFFTP.5/gDvuEEGtaJ9QYZy', 'active'),
(3, 'Rahmat Ilyas', 'Karangpuang', '085242657206', 'reporter', 'image_1598857296.png', 'rahmat142', '$2y$10$jdjtTwKpGZDkduI0HOtkY.yUVELdnQezhgSn.QrJojbyA4cMwhJrC', 'active'),
(5, 'Alyatul Maid', 'Bone, Bontocani', '085299868548', 'reporter', 'image_1598861004.png', 'taliya', '$2y$10$jwO9aKoxioozIBjdRLwkR.GpIIFooEPhByurLNpehgbwe4R8.y5MC', 'active'),
(6, 'Wirna Sentia Rahayu', 'Bulukumba', '082345643778', 'reporter', 'image_1598861253.jpg', 'wirna_str', '$2y$10$OTXUQPM/lhaWfUKHXfnsQ.KoXRTQTcfzIksoLVyIXw4e10rVKM7My', 'waiting'),
(7, 'Ayu Anita Putri', 'Jl. Kemakmuran, Tanete', '085432876998', 'reporter', 'image_1598876007.jpg', 'ayumi', '$2y$10$DbmEPu5IeI/Ftr2grUpxAuJ3CBJ1mEfZzq3y.O2kXEPFI7GM6nmx2', 'active'),
(8, 'Muhammad Ilham', 'Patalassang', '085345678889', 'reporter', 'image_1598885583.png', 'ilhamile', '$2y$10$yskVvToYEqEdIR3PQdrwS.kaQS1U0uR8iwVjpKWIjcbZGEFyDpl2K', 'nonactive'),
(9, 'Nisrawati', 'Bulukumba', '085678345234', 'editor', 'image_1599464365.jpg', 'cai123', '$2y$10$b4pno/R.Ks/wl1eAlaplu.mLLERIULyCXXFgmfC0HJcrQJ9fScovy', 'active'),
(10, 'Malika Maemunah', 'Barugae', '085342997263', 'editor', 'default.png', 'malika', '$2y$10$yskVvToYEqEdIR3PQdrwS.kaQS1U0uR8iwVjpKWIjcbZGEFyDpl2K', 'active'),
(11, 'Karmila Sari', 'Jl. Pembangunan, Tanete', '085299775346', 'editor', 'default.png', 'karmila', '$2y$10$g7QLfulQDavmL6S4yAZexOChWtxgagpN7TwdW2fs8R5YSDYo.FO8e', 'active');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_revisi`
--
ALTER TABLE `tb_revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_revisi`
--
ALTER TABLE `tb_revisi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
