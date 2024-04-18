-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 24, 2024 at 02:40 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u948617419_UTccQ`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `pm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `is_active`, `date_created`, `avatar`, `role`, `pm`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$d/LU6g2HI7gvZYc5tnQ5qeK6r56reDNwAGZlszbZh5UK0z9mcKajq', 1, 1708415888, 'default.jpg', 1, '123123123');

-- --------------------------------------------------------

--
-- Table structure for table `chat_materi`
--

CREATE TABLE `chat_materi` (
  `id_chat_materi` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_materi`
--

INSERT INTO `chat_materi` (`id_chat_materi`, `materi`, `nama`, `gambar`, `email`, `text`, `date_created`) VALUES
(1, 'PguKtBwn', 'Hives', 'default.jpg', 'hidayahamanah17@gmail.com', 'Silahkan apabila ada yang ingin ditanyakan dipersilahkan', 1709605089),
(2, 'PguKtBwn', 'Budi', 'default.jpg', 'budi@gmail.com', 'Belum ada kak', 1709605178),
(3, 'PguKtBwn', 'Hives', 'default.jpg', 'hidayahamanah17@gmail.com', 'Oke apabila ada silahkan saja ya ditanyakan jangan sungkan', 1709605213);

-- --------------------------------------------------------

--
-- Table structure for table `chat_tugas`
--

CREATE TABLE `chat_tugas` (
  `id_chat_tugas` int(11) NOT NULL,
  `tugas` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essay_detail`
--

CREATE TABLE `essay_detail` (
  `id_essay_detail` int(11) NOT NULL,
  `kode_ujian` varchar(100) NOT NULL,
  `soal` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essay_siswa`
--

CREATE TABLE `essay_siswa` (
  `id_essay_siswa` int(11) NOT NULL,
  `essay_id` int(11) NOT NULL,
  `ujian` varchar(100) NOT NULL,
  `siswa` int(11) NOT NULL,
  `jawaban` longtext DEFAULT NULL,
  `score` int(11) NOT NULL,
  `sudah_dikerjakan` int(11) DEFAULT NULL,
  `ragu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `kode_file` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_file`, `kode_file`, `nama_file`) VALUES
(1, 'PguKtBwn', '1654483210_ce8204b728183dec0675.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `guru_kelas` varchar(255) DEFAULT NULL,
  `guru_mapel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `email`, `password`, `role`, `is_active`, `date_created`, `avatar`, `guru_kelas`, `guru_mapel`) VALUES
(2, 'Hives', 'hidayahamanah17@gmail.com', '$2y$10$Jcpxobx.wsDIMnVYaNyThOtY1VLAPI4xFdWcHf/mfoKvZZJaFZn.G', 3, 1, 1708419959, 'default.jpg', NULL, NULL),
(8, 'arfod', 'arfod.user@gmail.com', '$2y$10$XrjrzLNy13lxFv0T4sYmo.8jlfcOEwDpdJY8bwOhgTr/SQV9nQQoi', 3, 1, 1710601230, 'default.jpg', NULL, NULL),
(9, 'Testing', 'xiyida3522@hdrlog.com', '$2y$10$75GenSAV154EJSvsWN0rUu0cpkSmP9aBL9HKLEOUzCMfwDJGP/iIS', 3, 1, 1710817117, 'default.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id_guru_kelas` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id_guru_kelas`, `guru`, `kelas`, `nama_kelas`) VALUES
(1, 1, 1, 'A'),
(2, 2, 1, 'A'),
(3, 2, 2, 'B'),
(4, 3, 1, 'A'),
(5, 3, 2, 'B'),
(6, 3, 3, 'C'),
(7, 4, 1, 'A'),
(8, 8, 1, 'A'),
(9, 8, 2, 'B'),
(10, 8, 3, 'C'),
(11, 8, 7, 'Gratis (Trial)'),
(12, 2, 7, 'Gratis (Trial)');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id_guru_mapel` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru_mapel`
--

INSERT INTO `guru_mapel` (`id_guru_mapel`, `guru`, `mapel`, `nama_mapel`) VALUES
(1, 1, 1, 'CBT'),
(2, 2, 1, 'CBT'),
(3, 4, 1, 'CBT'),
(4, 8, 1, 'CBT'),
(5, 8, 2, 'Tryout'),
(6, 8, 6, 'TPA (Test Potensi Akademik)'),
(7, 2, 2, 'Tryout');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(7, 'Gratis (Trial)');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id_mail` int(11) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(255) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_crypto` varchar(255) NOT NULL,
  `notif_akun` int(1) NOT NULL,
  `notif_materi` int(1) NOT NULL,
  `notif_tugas` int(1) NOT NULL,
  `notif_ujian` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id_mail`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_crypto`, `notif_akun`, `notif_materi`, `notif_tugas`, `notif_ujian`) VALUES
(1, 'smtp.googlemail.com', 'arfod.user@gmail.com', 'wkly udwa ftcq xucl', 465, 'ssl', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'CBT'),
(2, 'Tryout'),
(6, 'TPA (Test Potensi Akademik)');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `kode_materi` varchar(100) NOT NULL,
  `nama_materi` varchar(255) NOT NULL,
  `guru` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `text_materi` longtext NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `kode_materi`, `nama_materi`, `guru`, `mapel`, `kelas`, `text_materi`, `date_created`) VALUES
(1, 'PguKtBwn', 'Tryout 1', 2, 1, 1, '<p>Materi belajar menghadapi Ujian Tryout 1</p>', 1709603628);

-- --------------------------------------------------------

--
-- Table structure for table `materi_siswa`
--

CREATE TABLE `materi_siswa` (
  `id_materi_siswa` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `dilihat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `no_induk_siswa` varchar(100) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `is_active` int(11) NOT NULL,
  `status_member` int(1) DEFAULT NULL,
  `date_created` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `no_induk_siswa`, `nama_siswa`, `email`, `password`, `jenis_kelamin`, `kelas`, `role`, `is_active`, `status_member`, `date_created`, `avatar`) VALUES
(1, '12345', 'Budi', 'budi@gmail.com', '$2y$10$RP9jSeWYlRBDnWRFqgHOEubvWxjQX2KaNAnBN6Ofznx4.x385C.rO', 'Laki - Laki', 7, 2, 1, 0, 1708417921, 'default.jpg'),
(4, '123', 'pemberian', 'pemberianakun@gmail.com', '$2y$10$VKPTWHAbG7PZcz10/1BpMOomGRRj1N6RNJHd5MKhPq5LH94KX4kP.', 'Laki - Laki', 7, 2, 0, NULL, 1710646645, 'default.jpg'),
(5, 'wijecin999@cmheia.com', 'testing', 'wijecin999@cmheia.com', '$2y$10$PolN/PT/Jm1xhRhksFye9OkkunIHn/UbUCCnrDF4wjQ4BCEWI5c4K', 'Laki - Laki', 7, 2, 1, NULL, 1710817313, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `kode_tugas` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `date_created` int(11) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `date_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `id_tugas_siswa` int(11) NOT NULL,
  `tugas` varchar(100) NOT NULL,
  `siswa` int(11) NOT NULL,
  `text_siswa` longtext DEFAULT NULL,
  `file_siswa` varchar(100) DEFAULT NULL,
  `date_send` int(11) DEFAULT NULL,
  `is_telat` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `catatan_guru` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `kode_ujian` varchar(100) NOT NULL,
  `nama_ujian` varchar(255) NOT NULL,
  `guru` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `waktu_ujian` int(11) NOT NULL,
  `jenis_ujian` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `kode_ujian`, `nama_ujian`, `guru`, `kelas`, `mapel`, `date_created`, `waktu_ujian`, `jenis_ujian`) VALUES
(4, 'Y3BxfqUNzX', 'Tryout 1', 2, 1, 1, 1709603000, 3, NULL),
(15, '5dOtC8sHWp', 'TPA', 8, 7, 6, 1710659687, 5, NULL),
(16, 'RcfM6ASHDa', 'a', 8, 7, 6, 1710758831, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_detail`
--

CREATE TABLE `ujian_detail` (
  `id_detail_ujian` int(11) NOT NULL,
  `kode_ujian` varchar(100) NOT NULL,
  `nama_soal` longtext NOT NULL,
  `pg_1` varchar(100) NOT NULL,
  `pg_2` varchar(100) NOT NULL,
  `pg_3` varchar(100) NOT NULL,
  `pg_4` varchar(100) NOT NULL,
  `pg_5` longtext NOT NULL,
  `jawaban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian_detail`
--

INSERT INTO `ujian_detail` (`id_detail_ujian`, `kode_ujian`, `nama_soal`, `pg_1`, `pg_2`, `pg_3`, `pg_4`, `pg_5`, `jawaban`) VALUES
(16, 'Y3BxfqUNzX', '<p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;border:none;\r\nmso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes\"><span lang=\"IN\" style=\"font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;\r\nmso-fareast-font-family:&quot;Times New Roman&quot;;color:black\">Dalam konteks\r\npembangunan ekonomi di Indonesia, pemerintah telah mengimplementasikan beberapa\r\nkebijakan untuk mendukung pencapaian keadilan sosial sebagaimana diamanatkan\r\noleh Pancasila. Namun, salah satu kebijakan berikut tidak sepenuhnya sesuai dengan\r\nprinsip tersebut. Pilihlah kebijakan yang tidak sesuai!<o:p></o:p></span></p>', 'A. Pemerintah memberikan subsidi kepada masyarakat miskin untuk memenuhi kebutuhan pokoknya.', 'B. Pemerintah memberikan beasiswa kepada siswa berprestasi dari keluarga kurang mampu.', 'C. Pemerintah memberikan insentif kepada pengusaha yang berinvestasi di daerah terpencil.', 'D. Pemerintah membangun infrastruktur di daerah terpencil untuk meningkatkan kesejahteraan masyaraka', 'E. Pemerintah memberikan fasilitas kesehatan dan pendidikan gratis kepada seluruh masyarakat.', 'C'),
(17, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Perkembangan teknologi dan internet telah membawa\r\ndampak yang signifikan terhadap dinamika nasionalisme. Meskipun membawa\r\nberbagai peluang, namun juga menimbulkan tantangan. Pilihlah salah satu\r\ntantangan nasionalisme dalam era digital berikut!</span><br></p>', 'A. Kurangnya pemahaman masyarakat tentang nilai-nilai kebangsaan.', 'B. Semakin kuatnya pengaruh budaya asing.', 'C. Penyebaran informasi yang tidak akurat dan menyesatkan.', 'D. Kemudahan akses terhadap informasi dari luar negeri.', 'E. Kurangnya pengawasan pemerintah terhadap penggunaan media sosial.', 'C'),
(18, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Dalam konteks pembentukan identitas nasional yang\r\nseimbang dan inklusif, pemerintah memiliki peran penting dalam mendukung\r\npendidikan sebagai salah satu saluran untuk mencapai tujuan tersebut. Pilihlah\r\ntindakan yang dapat dilakukan oleh pemerintah melalui saluran pendidikan!</span><br></p>', 'A. Mendorong pengakuan dan penghargaan terhadap identitas lokal atau regional.', 'B. Memfasilitasi pembangunan budaya lokal dan mendorong pengenalan terhadap warisan budaya lokal di ', 'C. Mengajarkan sejarah nasional secara objektif dan inklusif.', 'D. Membangun lingkungan yang inklusif dan menggalakkan dialog antar kelompok.', 'E. Mendorong partisipasi masyarakat dalam pembangunan nasional.', 'A'),
(19, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Jepang pada masa penjajahan melakukan berbagai\r\nkebijakan yang berdampak pada depopulasi dan penyusutan jumlah penduduk di\r\nwilayah yang dikuasainya. Dampak yang kemungkinan akan terjadi dari fenomena\r\ndepopulasi tersebut adalah</span><br></p>', 'A. Akan terjadi perubahan signifikan dalam struktur sosial dan ekonomi negara.', 'B. Negara akan mengalami kebangkitan ekonomi yang pesat karena jumlah penduduk lebih sedikit.', 'C. Pemerintah akan memperketat kebijakan imigrasi untuk mengatasi penurunan populasi.', 'D. Akan terjadi pemekaran wilayah untuk menyeimbangkan distribusi penduduk.', 'E. Akan terjadi peningkatan akses penduduk terhadap sumber daya alam dan infrastruktur.', 'A'),
(20, 'Y3BxfqUNzX', '<p><span lang=\"IN\" style=\"font-size:12.0pt;line-height:\r\n107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\ncolor:black;mso-ansi-language:IN;mso-fareast-language:EN-US;mso-bidi-language:\r\nAR-SA;mso-no-proof:yes\">Suatu paham yang bertentangan dengan nasionalisme, di\r\nmana seseorang atau kelompok orang menganggap budaya, nilai, atau kelompok\r\netnis mereka sendiri sebagai standar atau yang paling baik, dan kemudian\r\nmenilai budaya, nilai, atau kelompok etnis lain dari perspektif yang sangat\r\nsubjektif dan seringkali negative disebut</span><br></p>', 'A. Eksklusivisme', 'B. Individualisme', 'C. Etnosentrisme', 'D. Chauvinisme', 'E. Liberalisme', 'C'),
(41, '5dOtC8sHWp', 'Jika x = berat total p kotak yang masingmasing beratnya q kg. Jika y = berat total q kotak yang masing-masing beratnya p kg, maka ', 'A.  x > y', 'B.  x < y', 'C.  x = y', 'D.  2x > 2y', 'E. x dan y tidak dapat ditentukan.', 'C'),
(42, 'RcfM6ASHDa', '<p>aaa<br></p>', 'A. aaa', 'B. aaa', 'C. aa', 'D. aa', 'E. aaa', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_siswa`
--

CREATE TABLE `ujian_siswa` (
  `id_ujian_siswa` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `ujian` varchar(100) NOT NULL,
  `siswa` int(11) NOT NULL,
  `jawaban` varchar(100) DEFAULT NULL,
  `benar` int(1) DEFAULT NULL,
  `ragu` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian_siswa`
--

INSERT INTO `ujian_siswa` (`id_ujian_siswa`, `ujian_id`, `ujian`, `siswa`, `jawaban`, `benar`, `ragu`) VALUES
(26, 16, 'Y3BxfqUNzX', 1, 'A', 0, NULL),
(27, 17, 'Y3BxfqUNzX', 1, 'C', 1, NULL),
(28, 18, 'Y3BxfqUNzX', 1, NULL, NULL, 1),
(29, 19, 'Y3BxfqUNzX', 1, 'E', 0, NULL),
(30, 20, 'Y3BxfqUNzX', 1, NULL, NULL, NULL),
(31, 41, '5dOtC8sHWp', 1, NULL, NULL, NULL),
(32, 42, 'RcfM6ASHDa', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_user_token` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id_user_token`, `email`, `token`, `date_created`) VALUES
(6, 'Arfod@gmail.com', 'Uz34JAdty2xhnCB9rQ5a1NmgwjFbqvoE', 1710601117),
(8, 'PEMBERIANAKUN@GMAIL.COm', 'JBu0zqytbIxKnreNYTMh4LPkpA8vsgwS', 1710603757),
(10, 'pemberianakun@gmail.com', '7B8awXFUL2jd4fSivRcKnCJgQbEW3qT0', 1710646645);

-- --------------------------------------------------------

--
-- Table structure for table `waktu_ujian`
--

CREATE TABLE `waktu_ujian` (
  `id_waktu_ujian` int(11) NOT NULL,
  `kode_ujian` varchar(255) NOT NULL,
  `nama_ujian` varchar(255) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `waktu_berakhir` varchar(255) DEFAULT NULL,
  `selesai` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waktu_ujian`
--

INSERT INTO `waktu_ujian` (`id_waktu_ujian`, `kode_ujian`, `nama_ujian`, `siswa_id`, `waktu_berakhir`, `selesai`) VALUES
(1, 'Y3BxfqUNzX', 'Tryout 1', 1, '2024-03-05 09:07', 1),
(22, '5dOtC8sHWp', 'TPA', 1, '2024-03-17 14:43', 1),
(23, '5dOtC8sHWp', 'TPA', 4, NULL, NULL),
(24, 'RcfM6ASHDa', 'a', 1, '2024-03-18 17:50', 1),
(25, 'RcfM6ASHDa', 'a', 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `chat_materi`
--
ALTER TABLE `chat_materi`
  ADD PRIMARY KEY (`id_chat_materi`);

--
-- Indexes for table `chat_tugas`
--
ALTER TABLE `chat_tugas`
  ADD PRIMARY KEY (`id_chat_tugas`);

--
-- Indexes for table `essay_detail`
--
ALTER TABLE `essay_detail`
  ADD PRIMARY KEY (`id_essay_detail`);

--
-- Indexes for table `essay_siswa`
--
ALTER TABLE `essay_siswa`
  ADD PRIMARY KEY (`id_essay_siswa`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id_guru_kelas`);

--
-- Indexes for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD PRIMARY KEY (`id_guru_mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id_mail`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `materi_siswa`
--
ALTER TABLE `materi_siswa`
  ADD PRIMARY KEY (`id_materi_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`id_tugas_siswa`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `ujian_detail`
--
ALTER TABLE `ujian_detail`
  ADD PRIMARY KEY (`id_detail_ujian`);

--
-- Indexes for table `ujian_siswa`
--
ALTER TABLE `ujian_siswa`
  ADD PRIMARY KEY (`id_ujian_siswa`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_user_token`);

--
-- Indexes for table `waktu_ujian`
--
ALTER TABLE `waktu_ujian`
  ADD PRIMARY KEY (`id_waktu_ujian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_materi`
--
ALTER TABLE `chat_materi`
  MODIFY `id_chat_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_tugas`
--
ALTER TABLE `chat_tugas`
  MODIFY `id_chat_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essay_detail`
--
ALTER TABLE `essay_detail`
  MODIFY `id_essay_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `essay_siswa`
--
ALTER TABLE `essay_siswa`
  MODIFY `id_essay_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id_guru_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  MODIFY `id_guru_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id_mail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materi_siswa`
--
ALTER TABLE `materi_siswa`
  MODIFY `id_materi_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `id_tugas_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ujian_detail`
--
ALTER TABLE `ujian_detail`
  MODIFY `id_detail_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ujian_siswa`
--
ALTER TABLE `ujian_siswa`
  MODIFY `id_ujian_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_user_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `waktu_ujian`
--
ALTER TABLE `waktu_ujian`
  MODIFY `id_waktu_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
