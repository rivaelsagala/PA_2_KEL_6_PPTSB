-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 03:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pptsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `gelar_depan` varchar(25) DEFAULT NULL,
  `gelar_belakang` varchar(25) DEFAULT NULL,
  `tempat_lahir` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_hubungan_keluarga` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_depan`, `nama_belakang`, `gelar_depan`, `gelar_belakang`, `tempat_lahir`, `alamat`, `no_telepon`, `id_status`, `id_hubungan_keluarga`, `id_pekerjaan`, `id_pendidikan`, `foto`, `keterangan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(3, 'Anggiat', 'Sinaga', 'Drs', 'SE', 'Banten', 'Jakarta Barat', '082364648089', 0, 0, 0, 0, '1717611997_BP4.jpg', 'Beliau menjabat menjadi Pengurus Wilayah PPTSB Jakarta Raya dan Sekitarnya Periode Tahun 2021-2025 yang dilantik pada Minggu (13/6/2021)', '2024-06-05 03:21:52', '2024-06-05 18:26:37', NULL),
(4, 'Boengaran', 'Sinaga', 'Drs', 'SE', 'Banten', 'Jakarta Barat', '082364648089', 0, 0, 0, 0, '1717612700_BP.jpg', 'Beliau menjabat menjadi Pengurus Wilayah PPTSB Jakarta Raya dan Sekitarnya Periode Tahun 2021-2025 yang dilantik pada Minggu (13/6/2021)', '2024-06-05 03:24:45', '2024-06-05 18:38:20', NULL),
(5, 'Manaek', 'Sinaga', 'Pdt. St. Drs.', 'SE', 'Banten', 'Jakarta Barat', '082364648089', 0, 0, 0, 0, '1717612713_BP2.jpg', 'Beliau menjabat menjadi Pengurus Wilayah PPTSB Jakarta Raya dan Sekitarnya Periode Tahun 2021-2025 yang dilantik pada Minggu (13/6/2021)', '2024-06-05 03:44:56', '2024-06-06 01:45:19', NULL),
(6, 'Tembak', 'Sinaga', 'Pdt. St. Drs.', 'SE', 'Banten', 'Jakarta Barat', '082364648089', 0, 0, 0, 0, '1717612014_BP3.jpg', 'Beliau merupakan Sekjen PPTSB Periode Tahun 2019-2021 yang dilantik pada Minggu (13/6/2021)', '2024-06-05 03:48:20', '2024-06-05 18:26:54', NULL),
(7, 'Saibun', 'Sinaga', 'Pdt.', 'SE', 'Bandung', 'Sitarak', '082211739374', 0, 0, 0, 0, '1717612730_BP3.jpg', 'Beliau menjabat menjadi Pengurus Wilayah PPTSB Jakarta Raya dan Sekitarnya Periode Tahun 2021-2025.', '2024-06-05 04:05:26', '2024-06-05 18:38:50', NULL),
(8, 'Sahat Maruli', 'Sinaga', 'IR.', 'SH', 'Medan', 'Jalan Seri Terompet No.139, Medan Selayang,Sumatera Utara', '08221173098', 0, 0, 0, 0, '1717563438_fotosaya.jpeg', 'Beliau menjabat menjadi Pengurus Wilayah PPTSB Jakarta Raya dan Sekitarnya', '2024-06-05 04:57:18', '2024-06-05 04:57:18', NULL),
(9, 'Hosdiaman P.', 'Sinaga', 'EV', 'SH', 'Parsoburan', 'Bandung', '082211776655', 0, 0, 0, 0, '1717563640_11422005_RivaelSagala.jpeg', 'Belum Kawin', '2024-06-05 05:00:40', '2024-06-05 05:00:40', NULL),
(10, 'Mulani Horas', 'Sinaga', 'Letkol.Pol. Drs.', 'SH', 'Parsoburan', 'Surabaya', '08221177699', 0, 0, 0, 0, '1717612942_CW3.jpg', 'Belum Kawin', '2024-06-05 10:33:34', '2024-06-05 18:42:22', NULL),
(11, 'Ary', 'Sinaga', '-', '-', 'Parsoburan', 'Surabaya', '08221177699', 0, 0, 0, 0, '1717612802_putra3.jfif', 'Belum Kawin', '2024-06-05 12:12:47', '2024-06-05 18:40:02', NULL),
(12, 'Mega', 'Sinaga', 'ir', 'dr', 'Parapat', 'Parapat', '08218984231', 0, 0, 0, 0, '1717612166_CW2.jpg', '-', '2024-06-05 12:26:09', '2024-06-05 18:29:26', NULL),
(13, 'Filemon', 'Sinaga', '-', '-', 'Pematangsiantar', 'Lorong 20', '08293148231', 0, 0, 0, 0, '1717612982_ANAK.jpg', 'Mahasiswa Teladan', '2024-06-05 12:31:48', '2024-06-05 18:43:02', NULL),
(14, '-', '-', NULL, NULL, '', '', '', 0, 0, 0, 0, '', '', NULL, NULL, NULL),
(15, 'Aminar', 'Sinaga', 'Ir', 'SE', 'Balige', 'Tarutung', '085280184140', 0, 0, 0, 0, '1717612668_BP.jpg', '-', '2024-06-05 18:34:57', '2024-06-05 18:37:48', NULL),
(16, 'Gideon', 'Purba', 'ir', 'SE', 'Pematangsiantar', 'Tambunan Baruara', '081260951232', 0, 0, 0, 0, '1717612887_CO.jpg', 'Mahasiswa Teladan', '2024-06-05 18:41:27', '2024-06-05 18:41:27', NULL),
(17, 'Sori', 'Sinaga', '-', '-', 'Medan', 'Tambunan Baruara', '081260951232', 0, 0, 0, 0, '1717620235_putri_2.jfif', 'Aktif', '2024-06-05 20:43:55', '2024-06-05 20:43:55', NULL),
(18, 'Gideonw', 'Purbaw', 'Drs', 'SE', 'Pematangsiantar', 'Lorong 20', '08293148231', 1, 1, 1, 2, '1718009191_sertifikat1.png', 'Msahasiswa Teladan', '2024-06-10 08:46:31', '2024-06-11 14:20:07', NULL),
(19, 'Arye', 'Sinaga e', 'Drs', 'SE', 'Parsoburan', 'Surabaya', '08221177699', 1, 3, 2, 3, '1718009216_sertifikat1.png', 'Belum Kawin', '2024-06-10 08:46:56', '2024-06-10 08:46:56', NULL),
(20, 'Sambal', 'Purba', 'Drs', 'SE', 'Pematangsiantar', 'Lorong 20', '08293148231', 1, 1, 1, 5, '1718117604_lanjut.jpg', 'Msahasiswa Teladan', '2024-06-11 14:53:24', '2024-06-11 14:53:24', NULL),
(21, 'Ronaldo', 'Sagala', 'ir', 'SE', 'Pematangsiantar', 'Tambunan Baruara', '081260951232', 1, 3, 1, 1, '1718124420_logonew.jpg', 'Mahasiswa Teladan', '2024-06-11 16:47:00', '2024-06-11 17:27:47', NULL),
(22, 'calvin', 'Silaen', 'Drs', 'SE', 'Parsoburan', 'Surabaya', '08221177699', 1, 3, 2, 3, '1718160040_Tambahkan judul.png', 'Belum Kawin', '2024-06-12 02:40:40', '2024-06-12 02:40:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nama_bidang`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Keanggotaan', '2024-05-18 16:09:23', '2024-06-10 15:20:07', 1),
(2, 'Organisasi', '2024-06-05 04:22:26', '2024-06-10 15:19:50', 1),
(3, 'Humas dan Advokasi', '2024-06-05 04:22:41', '2024-06-10 15:19:52', 1),
(4, 'Usaha dan Ekonomi', '2024-06-05 04:22:52', '2024-06-10 15:19:53', 1),
(5, 'Sosial dan Kesejahteraan', '2024-06-05 04:23:03', '2024-06-10 15:19:54', 1),
(6, 'Kesehatan', '2024-06-05 04:23:17', '2024-06-10 15:19:56', 1),
(7, 'Pemuda', '2024-06-05 04:23:43', '2024-06-10 15:19:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `kode_cabang` varchar(255) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_kepala_cabang` varchar(255) NOT NULL,
  `tgl_berdiri` varchar(255) DEFAULT NULL,
  `id_regional` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `kode_cabang`, `nama_cabang`, `alamat`, `nama_kepala_cabang`, `tgl_berdiri`, `id_regional`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2, '123456', 'Tapanuli Utara', 'Tarutung', 'Mangihut Sinaga', '12 January, 2020', 1, NULL, '2024-06-05 04:36:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pindah`
--

CREATE TABLE `detail_pindah` (
  `id_detail_reg_pindah` int(11) NOT NULL,
  `id_reg_pindah` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pindah`
--

INSERT INTO `detail_pindah` (`id_detail_reg_pindah`, `id_reg_pindah`, `id_anggota`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 2, 12, '2024-06-05 12:42:31', '2024-06-05 12:42:31', NULL),
(2, 3, 12, '2024-06-05 12:48:21', '2024-06-05 12:48:21', NULL),
(3, 4, 20, '2024-06-11 17:21:16', '2024-06-11 17:21:16', NULL),
(4, 5, 20, '2024-06-11 17:27:22', '2024-06-11 17:27:22', NULL),
(5, 6, 20, '2024-06-11 17:50:35', '2024-06-11 17:50:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `det_aksi_sosial`
--

CREATE TABLE `det_aksi_sosial` (
  `id_det_aksi` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_head_aksi` int(11) NOT NULL,
  `jumlah_bantuan` varchar(255) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `det_aksi_sosial`
--

INSERT INTO `det_aksi_sosial` (`id_det_aksi`, `id_anggota`, `id_head_aksi`, `jumlah_bantuan`, `keterangan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(7, 13, 8, '2', 'Penerima Bantuan Bedah Rumah', '2024-06-05 08:45:04', '2024-06-05 13:28:55', NULL),
(9, 14, 10, 'Rp.23.000.000', 'Petugas medis memeriksa kesehatan seorang pedagang di Pasar Kliwon Temanggung, Jawa Tengah, Senin (20/2/2023). Dinas Kesehatan Kabupaten Temanggung menyelenggarakan pemeriksaan kesehatan gratis bagi pedagang dan pengunjung pasar tradisional yang bertujuan untuk melayani kesehatan masyarakat secara langsung guna menanggulangi penyakit tidak menular (PTM). ANTARA FOTO/Anis Efizudin/tom.', '2024-06-05 18:03:23', '2024-06-05 18:03:23', NULL),
(10, 11, 11, 'Rp.9.000.000', 'Sesuai namanya ‘Bona Taon’ atau pangkal/awal tahun, pesta ini biasanya digelar pada tiga bulan pertama setiap tahun yang baru. Pesta Bona Taon ini biasa digelar berdasarkan keturunan (pomparan), marga atau sekadar komunitas Batak yang berada di perantauan, entah dalam negeri maupun luar negeri. Dalam kegiatan ini, akan diumumkan penerima bantuan Beasiswa Prestasi.', '2024-06-05 18:06:28', '2024-06-05 18:06:28', NULL),
(12, 4, 13, 'Rp.10.000.000', 'Natal adalah salah satu hari raya yang paling dirayakan di seluruh dunia. Hari raya ini memperingati kelahiran Yesus Kristus, Juru Selamat umat manusia. Natal dirayakan setiap tanggal 25 Desember. Natal memiliki makna yang penting bagi umat Kristen. Hari raya ini merupakan hari untuk mengenang kasih dan pengorbanan Yesus Kristus untuk umat manusia. Natal juga merupakan hari untuk berkumpul bersama keluarga dan teman-teman untuk merayakan kasih dan sukacita. Pada perayaan ini, akan dilakukan pemberian bantuan BEDAH RUMAH.', '2024-06-05 18:14:20', '2024-06-05 18:14:20', NULL),
(13, 14, 14, 'Rp.0', 'Musyawarah Besar (Mubes) adalah musyawarah yang dilakukan untuk mengevaluasi kegiatan organisasi PPTSB dan juga merupakan sebuah momentum bagi terbentuknya kepengurusan yang selanjutnya akan menjalankan organisasi di periode yang baru.  Mubes biasanya tidak hanya dihadiri oleh satu organisasi internal saja, namun juga dihadiri oleh organisasi yang lain untuk menyaksikan dan ikut berpartisipasi dalam Mubes tersebut. Misalkan kamu berasal dari Himpunan Mahasiswa Informatika dan akan mengadakan Mubes, tentunya kamu harus mengundang Himpunan lainnya untuk ikut berpartisipasi. Oleh karena itu kamu juga harus tahu bagaimana membuat surat undangan Mubes yang baik dan benar.', '2024-06-05 18:22:57', '2024-06-05 18:22:57', NULL),
(14, 14, 15, 'Rp.0', 'Musyawarah Besar (Mubes) adalah musyawarah yang dilakukan untuk mengevaluasi kegiatan organisasi PPTSB dan juga merupakan sebuah momentum bagi terbentuknya kepengurusan yang selanjutnya akan menjalankan organisasi di periode yang baru.  Mubes biasanya tidak hanya dihadiri oleh satu organisasi internal saja, namun juga dihadiri oleh organisasi yang lain untuk menyaksikan dan ikut berpartisipasi dalam Mubes tersebut. Misalkan kamu berasal dari Himpunan Mahasiswa Informatika dan akan mengadakan Mubes, tentunya kamu harus mengundang Himpunan lainnya untuk ikut berpartisipasi. Oleh karena itu kamu juga harus tahu bagaimana membuat surat undangan Mubes yang baik dan benar.', '2024-06-05 18:25:02', '2024-06-05 18:25:02', NULL),
(15, 11, 16, 'Rp.10.000.000', 'Bantuan Beasiswa Prestasi', '2024-06-06 01:37:06', '2024-06-06 01:37:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `det_registrasi_anggota`
--

CREATE TABLE `det_registrasi_anggota` (
  `id_det_registrasi` int(11) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `det_registrasi_anggota`
--

INSERT INTO `det_registrasi_anggota` (`id_det_registrasi`, `id_registrasi`, `id_anggota`, `id_status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 2, 3, 4, '2024-06-05 03:21:52', '2024-06-05 03:21:52', NULL),
(2, 2, 4, 4, '2024-06-05 03:24:45', '2024-06-05 03:24:45', NULL),
(3, 2, 5, 4, '2024-06-05 03:44:56', '2024-06-05 03:44:56', NULL),
(4, 3, 6, 4, '2024-06-05 03:48:20', '2024-06-05 03:48:20', NULL),
(5, 3, 7, 4, '2024-06-05 04:05:26', '2024-06-05 04:05:26', NULL),
(6, 4, 8, 4, '2024-06-05 04:57:18', '2024-06-05 04:57:18', NULL),
(7, 4, 9, 4, '2024-06-05 05:00:40', '2024-06-05 05:00:40', NULL),
(8, 4, 10, 4, '2024-06-05 10:33:34', '2024-06-05 10:33:34', NULL),
(9, 3, 11, 4, '2024-06-05 12:12:47', '2024-06-05 12:12:47', NULL),
(10, 5, 12, 4, '2024-06-05 12:26:09', '2024-06-05 12:26:09', NULL),
(11, 5, 13, 4, '2024-06-05 12:31:48', '2024-06-05 12:31:48', NULL),
(12, 6, 15, 4, '2024-06-05 18:34:57', '2024-06-05 18:34:57', NULL),
(13, 6, 16, 4, '2024-06-05 18:41:27', '2024-06-05 18:41:27', NULL),
(14, 5, 17, 4, '2024-06-05 20:43:55', '2024-06-05 20:43:55', NULL),
(15, 7, 18, 4, '2024-06-10 08:46:31', '2024-06-10 08:46:31', NULL),
(16, 7, 19, 4, '2024-06-10 08:46:56', '2024-06-10 08:46:56', NULL),
(17, 8, 20, 4, '2024-06-11 14:53:24', '2024-06-11 14:53:24', NULL),
(18, 8, 21, 4, '2024-06-11 16:47:00', '2024-06-11 16:47:00', NULL),
(19, 8, 22, 4, '2024-06-12 02:40:40', '2024-06-12 02:40:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `head_aksi_sosial`
--

CREATE TABLE `head_aksi_sosial` (
  `id_head_aksi` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `nama_aksi_sosial` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `head_aksi_sosial`
--

INSERT INTO `head_aksi_sosial` (`id_head_aksi`, `id_kegiatan`, `nama_aksi_sosial`, `created_at`, `updated_at`, `is_deleted`) VALUES
(8, 9, 'Perayaan Natal 25 Desember 2021 dan Tahun Baru 1 Januari 2022 Punguan PPTSB Cabang Taput', '2024-06-05 08:45:04', '2024-06-05 13:28:55', NULL),
(9, 10, 'Bona Taon Punguan PPTSB Cabang Taput 2022', '2024-06-05 13:47:17', '2024-06-05 13:47:17', NULL),
(10, 11, 'Pemeriksaan Kesehatan Gratis di Pasar Tradisional Pajak Balige (Balerong)', '2024-06-05 18:03:23', '2024-06-05 18:03:23', NULL),
(11, 12, 'Bona Taon Punguan PPTSB Cabang Taput 2022', '2024-06-05 18:06:28', '2024-06-05 18:06:28', NULL),
(13, 14, 'Perayaan Natal 25 Desember 2023 dan Tahun Baru 1 Januari 2024 Punguan PPTSB Cabang Taput', '2024-06-05 18:14:20', '2024-06-05 18:14:20', NULL),
(14, 15, 'Musyawarah Besar Kepengurusan Tahun 2023-2024', '2024-06-05 18:22:57', '2024-06-05 18:22:57', NULL),
(15, 16, 'Musyawarah Besar Kepengurusan Tahun 2022-2023', '2024-06-05 18:25:02', '2024-06-05 18:25:02', NULL),
(16, 17, 'Perayaan Natal 25 Desember 2023 dan Tahun Baru 1 Januari 2024 Punguan PPTSB Cabang Taput', '2024-06-06 01:37:06', '2024-06-06 01:37:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `head_reg_pindah`
--

CREATE TABLE `head_reg_pindah` (
  `id_reg_pindah` int(11) NOT NULL,
  `no_reg_pindah` varchar(50) NOT NULL,
  `tgl_pindah` varchar(255) DEFAULT NULL,
  `file_surat_pindah` varchar(50) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_sektor_tujuan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `head_reg_pindah`
--

INSERT INTO `head_reg_pindah` (`id_reg_pindah`, `no_reg_pindah`, `tgl_pindah`, `file_surat_pindah`, `id_registrasi`, `id_status`, `id_sektor_tujuan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2, '1231312', '5 June, 2024', '1717591351_Screenshot (7).png', 5, 6, 17, '2024-06-05 12:42:31', '2024-06-05 12:42:52', NULL),
(3, '1231312', '5 June, 2024', '1717591701_Screenshot (7).png', 5, 4, 17, '2024-06-05 12:48:21', '2024-06-05 12:48:36', NULL),
(4, '1231312', '5 June, 2024', '1718126476_lanjut.jpg', 8, 6, 9, '2024-06-11 17:21:16', '2024-06-11 17:23:38', NULL),
(5, '1231312', '5 June, 2024', '1718126842_lanjut.jpg', 8, 6, 9, '2024-06-11 17:27:22', '2024-06-11 17:49:53', NULL),
(6, '1231312', '5 June, 2024', '1718128235_lanjut.jpg', 8, 5, 9, '2024-06-11 17:50:35', '2024-06-11 17:50:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hubungan_keluarga`
--

CREATE TABLE `hubungan_keluarga` (
  `id_hubungan_keluarga` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hubungan_keluarga`
--

INSERT INTO `hubungan_keluarga` (`id_hubungan_keluarga`, `keterangan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Kepala Keluarga', NULL, NULL, NULL),
(3, 'Anggota', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Kepala Sektor', NULL, '2024-06-10 15:14:13', 1),
(2, 'Kepala Keluarga', NULL, '2024-06-10 15:14:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_status`
--

CREATE TABLE `jenis_status` (
  `id_jenis_status` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_status`
--

INSERT INTO `jenis_status` (`id_jenis_status`, `keterangan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Keaktifan', NULL, '2024-06-11 17:51:32', 1),
(2, 'Perkawinan', NULL, '2024-06-11 17:51:35', 1),
(5, 'Persetujuan', '2024-05-21 08:53:40', '2024-06-10 09:05:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` enum('Kegiatan','Pengumuman') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `gambar`, `tanggal`, `waktu`, `tempat`, `created_at`, `updated_at`, `is_deleted`) VALUES
(9, 'Kegiatan', '1717594135_NATAL.jpeg', '25 Dec, 2021', '11:00', 'Jl. Gereja desa No.87 20371 Kota Medan Sumatera Utara · 82 km', '2024-06-05 08:45:04', '2024-06-05 13:28:55', NULL),
(10, 'Kegiatan', '2-BONA-TAON.jpeg', '08 Jan, 2022', '12:00', 'Jl. Mesjid desa No.87 20371 Kota Medan Sumatera Utara · 82 km', '2024-06-05 13:47:17', '2024-06-05 13:47:17', NULL),
(11, 'Kegiatan', 'KESEHATAN-GRATIS.jpg', '01 Jun, 2021', '08:00', 'Pasar Tradisional Balige, Jl. Sisingamangaraja, Napitupulu Bagasan, Balige, Kabupaten Toba Samosir, Sumatera Utara 22312', '2024-06-05 18:03:23', '2024-06-05 18:03:23', NULL),
(12, 'Pengumuman', '2-BONA-TAON.jpeg', '03 Jan, 2022', '12:10', 'Jl. Sharon desa Melayu Kota Medan Sumatera Utara · 82 km', '2024-06-05 18:06:28', '2024-06-05 18:06:28', NULL),
(14, 'Kegiatan', 'FLYER-NATAL.jpg', '25 Dec, 2023', '18:00', 'Jl. Gereja desa No.87 20371 Kota Medan Sumatera Utara · 82 km', '2024-06-05 18:14:20', '2024-06-05 18:14:20', NULL),
(15, 'Pengumuman', 'MUBES.jpg', '23 Feb, 2023', '12:00', 'Gedung Serbaguna Tarutung', '2024-06-05 18:22:57', '2024-06-05 18:22:57', NULL),
(16, 'Pengumuman', 'PERTEMUAN.jpg', '01 Dec, 2023', '08:00', 'Gedung Serbaguna Tarutung', '2024-06-05 18:25:02', '2024-06-05 18:25:02', NULL),
(17, 'Kegiatan', 'MUBES.jpg', '02 Jan, 2024', '14:00', 'Jl. Gereja desa No.87 20371 Kota Medan Sumatera Utara · 82 km', '2024-06-06 01:37:06', '2024-06-06 01:37:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pejabat_struktural`
--

CREATE TABLE `pejabat_struktural` (
  `id_pejabat_struktural` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tgl_SK_pengangkatan` varchar(255) NOT NULL,
  `awal_tahun_jabatan` varchar(255) NOT NULL,
  `akhir_tahun_jabatan` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `no_SK_pengangkatan` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pejabat_struktural`
--

INSERT INTO `pejabat_struktural` (`id_pejabat_struktural`, `id_jabatan`, `id_anggota`, `tgl_SK_pengangkatan`, `awal_tahun_jabatan`, `akhir_tahun_jabatan`, `file`, `no_SK_pengangkatan`, `id_status`, `id_bidang`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 4, '05 Jun, 2024', '2024', '2026', 'sertifikat1.pdf', 98765234, 1, 1, '2024-06-05 03:27:13', '2024-06-05 03:27:13', NULL),
(2, 1, 7, '04 Jun, 2024', '2024', '2026', 'sertifikat1.pdf', 564654, 1, 4, '2024-06-05 10:40:09', '2024-06-05 10:40:09', NULL),
(3, 1, 9, '05 Jun, 2024', '2024', '2026', 'sertifikat1.pdf', 65743, 1, 6, '2024-06-05 10:43:03', '2024-06-05 10:43:03', NULL),
(6, 1, 21, '12 Jun, 2024', '13 Jun, 2024', '14 Jun, 2024', '1718128069_sertifikat1.pdf', 123456432, 1, 1, '2024-06-11 17:47:49', '2024-06-11 17:47:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama_pekerjaan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Wiraswasta', NULL, '2024-06-10 15:16:40', 1),
(2, 'Pekerja Lepas', '2024-06-05 04:07:18', '2024-06-10 15:16:41', 1),
(3, 'Buruh Harian Lepas', '2024-06-05 04:07:59', '2024-06-10 15:16:43', 1),
(4, 'Aparatur Sipil Negara (ASN)', '2024-06-05 04:10:56', '2024-06-10 15:16:46', 1),
(5, 'Karyawan Swasta', '2024-06-05 04:11:14', '2024-06-10 15:16:48', 1),
(6, 'Pelajar', '2024-06-05 10:51:00', '2024-06-12 04:16:42', 1),
(7, 'Tidak Ada', '2024-06-05 10:51:18', '2024-06-10 15:16:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `tingkat_pendidikan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id_pendidikan`, `tingkat_pendidikan`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Pendidikan Dasar (SD)', '2024-06-05 03:48:53', '2024-06-10 15:05:17', 1),
(2, 'Pendidikan Menengah Pertama (SMP)', '2024-06-05 03:50:25', '2024-06-10 15:05:20', 1),
(3, 'Pendidikan Menengah Atas (SMA/SMK)', '2024-06-05 03:50:59', '2024-06-10 15:05:21', 1),
(5, 'Magister (S2)', '2024-06-05 03:51:34', '2024-06-10 15:05:53', 1),
(6, 'Doktor (S3)', '2024-06-05 03:51:53', '2024-06-10 15:05:24', 1),
(14, 'Tidak Ada', '2024-06-05 10:51:28', '2024-06-10 15:05:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pusat`
--

CREATE TABLE `pusat` (
  `id_pusat` int(11) NOT NULL,
  `kode_pusat` varchar(255) NOT NULL,
  `nama_pusat` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_kepala_pusat` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pusat`
--

INSERT INTO `pusat` (`id_pusat`, `kode_pusat`, `nama_pusat`, `alamat`, `nama_kepala_pusat`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '1234', 'Indonesia', 'Jl. Sentosa Baru No. 20 Jakarta', 'Ir. Edison Sinaga', NULL, '2024-06-05 10:28:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regional`
--

CREATE TABLE `regional` (
  `id_regional` int(11) NOT NULL,
  `kode_regional` varchar(255) NOT NULL,
  `nama_regional` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_kepala_regional` varchar(255) NOT NULL,
  `id_pusat` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regional`
--

INSERT INTO `regional` (`id_regional`, `kode_regional`, `nama_regional`, `alamat`, `nama_kepala_regional`, `id_pusat`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, '12345', 'Sumatera Utara I', 'Jalan Bunga Terompet No.139, Medan Selayang,Sumatera Utara', 'M. Kasan Sinaga', 1, NULL, '2024-06-05 04:50:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrasi_anggota`
--

CREATE TABLE `registrasi_anggota` (
  `id_registrasi` int(11) NOT NULL,
  `no_registrasi` int(11) NOT NULL,
  `tgl_registrasi` datetime DEFAULT NULL,
  `id_sektor` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrasi_anggota`
--

INSERT INTO `registrasi_anggota` (`id_registrasi`, `no_registrasi`, `tgl_registrasi`, `id_sektor`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2, 231, '2024-06-05 03:21:52', 9, '2024-06-05 03:21:52', '2024-06-05 03:21:52', NULL),
(3, 232, '2024-06-05 03:48:20', 17, '2024-06-05 03:48:20', '2024-06-05 03:48:20', NULL),
(4, 233, '2024-06-05 04:57:18', 18, '2024-06-05 04:57:18', '2024-06-05 04:57:18', NULL),
(5, 234, '2024-06-05 12:26:09', 17, '2024-06-05 12:26:09', '2024-06-05 12:48:36', NULL),
(6, 235, '2024-06-05 18:34:57', 21, '2024-06-05 18:34:57', '2024-06-05 18:34:57', NULL),
(7, 112244, '2024-06-10 08:46:31', 17, '2024-06-10 08:46:31', '2024-06-10 08:46:31', NULL),
(8, 3211234, '2024-06-11 14:53:24', 23, '2024-06-11 14:53:24', '2024-06-11 14:53:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sektor`
--

CREATE TABLE `sektor` (
  `id_sektor` int(11) NOT NULL,
  `kode_sektor` varchar(255) NOT NULL,
  `nama_sektor` varchar(255) NOT NULL,
  `alamat_sektor` varchar(255) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `tgl_berdiri` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sektor`
--

INSERT INTO `sektor` (`id_sektor`, `kode_sektor`, `nama_sektor`, `alamat_sektor`, `id_cabang`, `tgl_berdiri`, `created_at`, `updated_at`, `is_deleted`) VALUES
(9, '22351', 'Banuaji', 'Balige', 2, '07 Jan, 2022', '2024-06-05 03:14:24', '2024-06-05 03:14:24', NULL),
(17, '01MDN', 'Pearaja Sitakka', 'Jalan Bunga Terompet No.139, Medan Selayang,Sumatera Utara', 2, '01 Jun, 2022', '2024-06-05 09:45:55', '2024-06-05 09:45:55', NULL),
(18, '22353', 'Aek Siansimun', 'Jalan Bunga Sia No.13, Tarutung', 2, '08 Mar, 2021', '2024-06-05 09:49:15', '2024-06-05 09:49:15', NULL),
(19, '22354', 'Komplek Stadion', 'Sigalagala', 2, '21 Mar, 2021', '2024-06-05 09:50:12', '2024-06-05 09:50:12', NULL),
(20, '22355', 'Jalan Balige Pardangguran', 'Antur Mangan, Kec. Sipirok, Kabupaten Tapanuli', 2, '11 Aug, 2022', '2024-06-05 09:51:01', '2024-06-05 09:51:01', NULL),
(21, '22356', 'Sipoholon', 'Jalan Raja Opat Tupou No. 1, Sipoholon, Tapanuli Utara', 2, '08 Jun, 2023', '2024-06-05 09:51:42', '2024-06-05 09:51:42', NULL),
(22, '22357', 'Tarutung Kota', 'Jalan Sisingamangaraja No. 9, Tarutung, Tapanuli Utara', 2, '02 Jun, 2024', '2024-06-05 09:52:30', '2024-06-05 09:52:30', NULL),
(23, '213w4erfdsa', 'toba', 'Bunga Terompet Ujung No 139 Medanm', 2, '10 Jun, 2024', '2024-06-11 14:06:55', '2024-06-11 14:06:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_jenis_status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `keterangan`, `id_jenis_status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Aktif', 1, '2024-05-18 15:45:36', '2024-06-11 07:38:00', 1),
(2, 'Nonaktif', 1, '2024-05-18 16:19:17', '2024-06-10 15:00:25', 1),
(4, 'Diterima', 5, '2024-05-21 08:53:54', '2024-06-10 15:00:26', 1),
(5, 'Menunggu', 5, '2024-05-21 08:54:15', '2024-06-10 15:00:28', 1),
(6, 'Ditolak', 5, '2024-05-21 08:54:23', '2024-06-10 15:00:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `kode`, `created_at`, `updated_at`) VALUES
(4, 'Pak Antara', '$2y$10$9uZi9TlLtE8JI1gZ37968uLJdlI8bsrczsjuvqAj2YT6nG7.DMtMa', 'Kepala Cabang', '123456', NULL, NULL),
(6, 'pptsb', '$2y$10$DLQTWsdauAfQRHa/SHt6B.oUVzaAs7NH9TScAZ0ot6ru/35ldjPii', 'Admin', '0', NULL, NULL),
(10, 'Banuaji', '$2y$10$.Z//QWqGHyiTDCRnvUkyPuaxpJ0Iz2L6jTPQdY2A.zgpUijPuPQCi', 'Kepala Sektor', '21151', '2024-06-05 03:14:24', '2024-06-05 03:14:24'),
(11, 'Anggiat', '$2y$10$epvVWbf6LsglWtitSWyUkuQiF2Nc5Tdk4LIwpbaVvC4XPdSqUwQzi', 'Kepala Keluarga', '231', '2024-06-05 03:21:52', '2024-06-05 03:21:52'),
(12, 'Pearaja Sitakka', '$2y$10$W5Pv7cQUDDoynAd1PI1fMuFHz5L9X6HXCLfp/DRKBc5lVGKsgO2ZK', 'Kepala Sektor', '981MDN', '2024-06-05 03:34:47', '2024-06-05 03:34:47'),
(13, 'Manaek', '$2y$10$T7CKeOaoUBzRnMXdOpKg1eTF./nybByzp7DT2p9J.w4sQ219eKjyK', 'Kepala Keluarga', '232', '2024-06-05 03:48:20', '2024-06-05 03:48:20'),
(14, 'Aek Siansimun', '$2y$10$zyCp1ha2Pgh9Up8X1rwkFetxvkwh0.WiMqdVY0uW2FE845I1ov1YW', 'Kepala Sektor', '22353', '2024-06-05 04:43:26', '2024-06-05 04:43:26'),
(15, 'Komplek Stadion', '$2y$10$GnYVp2At9ZFakJ84OaMI6u5eM//EwKT3DV.1q8PLbPSxKndNljype', 'Kepala Sektor', '22354', '2024-06-05 04:44:34', '2024-06-05 04:44:34'),
(16, 'Jalan Balige Pardangguran', '$2y$10$PL2Guwtg7f6IuIIezbYdlO5d2eH7vbcqwbLA.3A6g6UAqLUMDWvDG', 'Kepala Sektor', '22355', '2024-06-05 04:45:38', '2024-06-05 04:45:38'),
(17, 'Sipoholon', '$2y$10$indviyNMS80WCDXZhsoxm.JT7CwDqA8kmrHlYGgB.ALJS0sIkp8cK', 'Kepala Sektor', '22356', '2024-06-05 04:47:34', '2024-06-05 04:47:34'),
(18, 'Tarutung Kota', '$2y$10$XbPSHtVHCgpyjfr5yhfZYuviGZLRhRBYTyNeKpTiCoKLBuCuL7b1G', 'Kepala Sektor', '22357', '2024-06-05 04:48:28', '2024-06-05 04:48:28'),
(19, 'Sahat Maruli', '$2y$10$G8/.ZL0tsjqsQDcH4vCI2eG2p5gGnoT1gqm1bBZ8qkarsqYck32qO', 'Kepala Keluarga', '233', '2024-06-05 04:57:18', '2024-06-05 04:57:18'),
(20, 'Pearaja Sitakka', '$2y$10$kXae5BR81r4oZxdm/3kDIOmEVQXOca/Alsd3j6hEsWEdSb1ZlmtY.', 'Kepala Sektor', '01MDN', '2024-06-05 09:45:55', '2024-06-05 09:45:55'),
(21, 'Aek Siansimun', '$2y$10$VDQAT1PXBjpZRqlX0p8UXukpMVX005XfcCc6GJ2HZR2sgYaI3SLa.', 'Kepala Sektor', '22353', '2024-06-05 09:49:15', '2024-06-05 09:49:15'),
(22, 'Komplek Stadion', '$2y$10$CAu90/Ud0cIqTJ1ges8Ghu0K71WaxpOzRothLK62F49lEJ7va5bmm', 'Kepala Sektor', '22354', '2024-06-05 09:50:12', '2024-06-05 09:50:12'),
(23, 'Jalan Balige Pardangguran', '$2y$10$D6u/8olgNEuTuhUetgyP4.3kqHvBxEzJYXEtELL4DsGd8Ma6eLUCW', 'Kepala Sektor', '22355', '2024-06-05 09:51:01', '2024-06-05 09:51:01'),
(24, 'Sipoholon', '$2y$10$.1XL/dz7b68oiZeas.ttMe5/671kUb7F3tjqtW/6wHObmfcFDADwm', 'Kepala Sektor', '22356', '2024-06-05 09:51:42', '2024-06-05 09:51:42'),
(25, 'Tarutung Kota', '$2y$10$aFNydWV652qtVXuWAMDIqevTM.owZO0MBmAb5rFaEC33.hQO5P7V2', 'Kepala Sektor', '22357', '2024-06-05 09:52:30', '2024-06-05 09:52:30'),
(26, 'Mega', '$2y$10$LqG5fpEQR7I/hMkgOsFlPegBfZ7gLPEyU3Ed6C.hI.UfFcbtjl7Iq', 'Kepala Keluarga', '234', '2024-06-05 12:26:09', '2024-06-05 12:26:09'),
(27, 'Amina', '$2y$10$CosbbFo7kYmxY2Tj/ZKhpuRJ9KwSaV2CzPRuaz1imN5qnPsi0kjNK', 'Kepala Keluarga', '235', '2024-06-05 18:34:57', '2024-06-05 18:34:57'),
(28, 'Gideonw', '$2y$10$8c4N/oc2HZoN9PhqXDStq.kV96LZZVFhzS1NTabs1Of.Qmtsdad2K', 'Kepala Keluarga', '112244', '2024-06-10 08:46:31', '2024-06-10 08:46:31'),
(29, 'toba', '$2y$10$nhdoM1kU.HMYLT5W4p1x8OLBp2POA.za0WqY4Xtc8ERfQ1gQOwbAm', 'Kepala Sektor', '213w4erfdsa', '2024-06-11 14:06:55', '2024-06-11 14:06:55'),
(30, 'Sambal', '$2y$10$SmmEhLHxJrr9pKRaV9dAjOPBEi2A9HvCV/eM0iU9W5lbwaYo4.9sq', 'Kepala Keluarga', '3211234', '2024-06-11 14:53:24', '2024-06-11 14:53:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`),
  ADD KEY `id_regional` (`id_regional`);

--
-- Indexes for table `detail_pindah`
--
ALTER TABLE `detail_pindah`
  ADD PRIMARY KEY (`id_detail_reg_pindah`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `detail_pindah_ibfk_1` (`id_reg_pindah`);

--
-- Indexes for table `det_aksi_sosial`
--
ALTER TABLE `det_aksi_sosial`
  ADD PRIMARY KEY (`id_det_aksi`),
  ADD KEY `id_head_aksi` (`id_head_aksi`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `det_registrasi_anggota`
--
ALTER TABLE `det_registrasi_anggota`
  ADD PRIMARY KEY (`id_det_registrasi`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_registrasi` (`id_registrasi`);

--
-- Indexes for table `head_aksi_sosial`
--
ALTER TABLE `head_aksi_sosial`
  ADD PRIMARY KEY (`id_head_aksi`),
  ADD KEY `id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `head_reg_pindah`
--
ALTER TABLE `head_reg_pindah`
  ADD PRIMARY KEY (`id_reg_pindah`),
  ADD KEY `id_registrasi` (`id_registrasi`),
  ADD KEY `id_sektor_tujuan` (`id_sektor_tujuan`);

--
-- Indexes for table `hubungan_keluarga`
--
ALTER TABLE `hubungan_keluarga`
  ADD PRIMARY KEY (`id_hubungan_keluarga`);

--
-- Indexes for table `jenis_status`
--
ALTER TABLE `jenis_status`
  ADD PRIMARY KEY (`id_jenis_status`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `pejabat_struktural`
--
ALTER TABLE `pejabat_struktural`
  ADD PRIMARY KEY (`id_pejabat_struktural`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `pusat`
--
ALTER TABLE `pusat`
  ADD PRIMARY KEY (`id_pusat`);

--
-- Indexes for table `regional`
--
ALTER TABLE `regional`
  ADD PRIMARY KEY (`id_regional`),
  ADD KEY `id_pusat` (`id_pusat`);

--
-- Indexes for table `registrasi_anggota`
--
ALTER TABLE `registrasi_anggota`
  ADD PRIMARY KEY (`id_registrasi`),
  ADD KEY `id_sektor` (`id_sektor`);

--
-- Indexes for table `sektor`
--
ALTER TABLE `sektor`
  ADD PRIMARY KEY (`id_sektor`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `id_jenis_status` (`id_jenis_status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_pindah`
--
ALTER TABLE `detail_pindah`
  MODIFY `id_detail_reg_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `det_aksi_sosial`
--
ALTER TABLE `det_aksi_sosial`
  MODIFY `id_det_aksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `det_registrasi_anggota`
--
ALTER TABLE `det_registrasi_anggota`
  MODIFY `id_det_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `head_aksi_sosial`
--
ALTER TABLE `head_aksi_sosial`
  MODIFY `id_head_aksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `head_reg_pindah`
--
ALTER TABLE `head_reg_pindah`
  MODIFY `id_reg_pindah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hubungan_keluarga`
--
ALTER TABLE `hubungan_keluarga`
  MODIFY `id_hubungan_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_status`
--
ALTER TABLE `jenis_status`
  MODIFY `id_jenis_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pejabat_struktural`
--
ALTER TABLE `pejabat_struktural`
  MODIFY `id_pejabat_struktural` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pusat`
--
ALTER TABLE `pusat`
  MODIFY `id_pusat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `regional`
--
ALTER TABLE `regional`
  MODIFY `id_regional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrasi_anggota`
--
ALTER TABLE `registrasi_anggota`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sektor`
--
ALTER TABLE `sektor`
  MODIFY `id_sektor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `det_aksi_sosial`
--
ALTER TABLE `det_aksi_sosial`
  ADD CONSTRAINT `det_aksi_sosial_ibfk_2` FOREIGN KEY (`id_head_aksi`) REFERENCES `head_aksi_sosial` (`id_head_aksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `det_aksi_sosial_ibfk_3` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `det_registrasi_anggota`
--
ALTER TABLE `det_registrasi_anggota`
  ADD CONSTRAINT `det_registrasi_anggota_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `det_registrasi_anggota_ibfk_2` FOREIGN KEY (`id_registrasi`) REFERENCES `registrasi_anggota` (`id_registrasi`);

--
-- Constraints for table `head_aksi_sosial`
--
ALTER TABLE `head_aksi_sosial`
  ADD CONSTRAINT `head_aksi_sosial_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `head_reg_pindah`
--
ALTER TABLE `head_reg_pindah`
  ADD CONSTRAINT `head_reg_pindah_ibfk_1` FOREIGN KEY (`id_registrasi`) REFERENCES `registrasi_anggota` (`id_registrasi`),
  ADD CONSTRAINT `head_reg_pindah_ibfk_2` FOREIGN KEY (`id_sektor_tujuan`) REFERENCES `sektor` (`id_sektor`);

--
-- Constraints for table `pejabat_struktural`
--
ALTER TABLE `pejabat_struktural`
  ADD CONSTRAINT `pejabat_struktural_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `pejabat_struktural_ibfk_2` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`),
  ADD CONSTRAINT `pejabat_struktural_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);

--
-- Constraints for table `regional`
--
ALTER TABLE `regional`
  ADD CONSTRAINT `regional_ibfk_1` FOREIGN KEY (`id_pusat`) REFERENCES `pusat` (`id_pusat`);

--
-- Constraints for table `registrasi_anggota`
--
ALTER TABLE `registrasi_anggota`
  ADD CONSTRAINT `registrasi_anggota_ibfk_1` FOREIGN KEY (`id_sektor`) REFERENCES `sektor` (`id_sektor`);

--
-- Constraints for table `sektor`
--
ALTER TABLE `sektor`
  ADD CONSTRAINT `sektor_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`id_jenis_status`) REFERENCES `jenis_status` (`id_jenis_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
