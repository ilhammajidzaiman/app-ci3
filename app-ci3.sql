-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2022 at 02:05 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-ci3`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `id_level` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `password`, `email`, `name`, `image`, `status`, `id_level`, `created_at`, `updated_at`) VALUES
(1, '$2y$10$0ka9ZgurEafCQD65R7Xdx.TOHEMm4ZewrDH.kZhfqrB/HsLxeA08K', 'ilhammajidzaiman07@gmail.com', 'Develooper', 'default.svg', 1, 1, '2021-08-15 15:21:38', '2021-08-15 15:21:38'),
(2, '$2y$10$ebt5Yhw0S6DU4F5IfzV5feEojrucLdPlMpNc6S59LN602UDTTrV72', 'admin@gmail.com', 'Admin', 'admin-611918718cd9e.png', 1, 1, '2021-08-15 20:36:49', '2021-08-15 20:36:49'),
(3, '$2y$10$r/FgxGQEk//R11Bqnvhk/eGmOBC9tqDRE9LKRxxG36jTyZvy9fb72', 'user@gmail.com', 'User', 'admin-6119189ccf2c4.png', 1, 2, '2021-08-15 20:37:32', '2021-08-15 20:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_access`
--

CREATE TABLE `tbl_admin_access` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_admin_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_access`
--

INSERT INTO `tbl_admin_access` (`id`, `id_admin`, `id_admin_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 1),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 6),
(14, 2, 7),
(15, 3, 1),
(16, 3, 2),
(17, 3, 6),
(18, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_level`
--

CREATE TABLE `tbl_admin_level` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_level`
--

INSERT INTO `tbl_admin_level` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_menu`
--

CREATE TABLE `tbl_admin_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_menu`
--

INSERT INTO `tbl_admin_menu` (`id`, `menu`, `controller`, `icon`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-desktop'),
(2, 'Profil', 'profil', 'fas fa-user'),
(3, 'Admin', 'admin', 'fas fa-user-tie'),
(4, 'Configs', 'configs', 'fas fa-tools'),
(5, 'Nav Menu', 'nav-menu', 'fas fa-bars'),
(6, 'Category', 'category', 'fas fa-bookmark'),
(7, 'Posting', 'posting', 'fas fa-file');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articles`
--

CREATE TABLE `tbl_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `article` longtext NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `counter` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_articles`
--

INSERT INTO `tbl_articles` (`id`, `title`, `slug`, `article`, `image`, `id_admin`, `status`, `counter`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias voluptatibus eos ipsam. Fugiat reiciendis nobis veritatis molestias, inventore et exercitationem!', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-molestias-voluptatibus-eos-ipsam-fugiat-reiciendis-nobis-veritatis-molestias-inventore-et-exercitationem', '<div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab magni eos accusamus esse quisquam quidem modi laudantium tenetur quae, doloremque animi numquam ad deleniti sunt quaerat soluta facere, aliquid ratione nostrum minus officiis? Ex aut rem dolores deserunt? Reiciendis, labore molestias? Amet nam aut dolore quod, consectetur quae, praesentium doloribus consequatur placeat voluptatibus fugit ab facilis possimus. Quae, natus tempora? Modi, nam blanditiis. Labore, id asperiores possimus quaerat obcaecati eveniet molestias, earum vel eaque unde, repellat fuga nihil impedit! Quaerat, sint? Similique voluptas facilis ad nulla rerum, veritatis id omnis, facere nesciunt illum maiores corrupti molestias eius ut porro recusandae ullam asperiores illo laboriosam quo quia alias, odit ab in? Eos pariatur ut, ea iure aperiam quis repellendus esse laborum in ipsa adipisci nisi minima neque rem amet atque quaerat. Qui error sapiente optio aliquam adipisci suscipit a illum voluptas! In, debitis tenetur, necessitatibus reprehenderit omnis suscipit assumenda eius possimus totam consectetur reiciendis magni nesciunt quod maiores veniam pariatur tempore rerum. Illum dolores tempore ullam vel, repellendus corrupti quis accusantium ad hic repellat omnis iusto deleniti aperiam, quod corporis excepturi. Nemo provident recusandae ipsa culpa cum error dicta blanditiis earum sit rem hic a cupiditate esse maiores, laboriosam eum magnam, tenetur dolore quis labore. Consectetur ducimus totam, pariatur laboriosam inventore numquam doloremque mollitia rem dolor, eveniet accusantium asperiores minus quasi animi! Id expedita amet temporibus voluptas deserunt omnis sint quam sapiente illo laudantium soluta porro sequi facilis quas beatae officia eligendi a, laboriosam, voluptatibus reiciendis ipsa. Facilis dolor tempore ipsa nobis vero temporibus expedita perspiciatis blanditiis incidunt ducimus! Et exercitationem iusto eum quis quibusdam, similique facilis corporis ipsam nihil dolore aspernatur ratione tempora est, nemo tempore minus provident porro odit a laborum vitae! Mollitia quae aliquid nihil quo totam cumque suscipit accusantium alias nobis earum quia, odit tenetur, itaque eaque? Nihil itaque dolor esse fuga laborum optio distinctio beatae ab nisi dolorem! Fuga nemo earum, asperiores voluptates beatae dolorem. Repellendus fuga nihil perferendis alias ipsum corrupti, provident atque cumque qui in quisquam dolores explicabo consectetur placeat optio deserunt maiores! Accusantium, expedita nemo quos qui rerum quasi veritatis sequi ipsum iure aspernatur corrupti, ratione ex corporis ut dolore natus tenetur doloribus maxime nulla possimus earum. Ducimus a cum quasi delectus fuga cupiditate tenetur hic et ipsum? Tempora, mollitia? A reiciendis ut earum libero reprehenderit, molestias ex! Excepturi explicabo ut iste fuga asperiores nihil quam, illum recusandae cumque libero totam ea. Dolores?</span></div><div><br></div><div><span xss=removed><br></span></div><div><div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus alias quaerat eius illo dolorem nihil ab deleniti aliquam cupiditate assumenda. Necessitatibus quas ipsa ab assumenda! Dolore nobis qui vitae a illo excepturi quis animi libero molestiae rem atque, labore commodi veritatis itaque aut facilis magnam? Ut, fugiat omnis? Reiciendis voluptate ratione commodi sed saepe minima accusantium accusamus tenetur incidunt doloremque dolores, aliquam distinctio quas? Quod ullam magni, assumenda magnam ad architecto in! Ex nam aliquid nisi qui tempore assumenda velit sapiente facere accusamus officia voluptas architecto blanditiis dolor, debitis inventore. Veniam odio ad ipsam aliquid eum. Molestiae ipsum, ab dignissimos maxime quas quasi. Accusantium, quod nisi eius alias aperiam repellendus! Sunt eaque culpa, quasi unde voluptatem rem repudiandae tenetur odio veniam reprehenderit voluptatibus saepe illum dignissimos incidunt similique adipisci corrupti aliquid nihil vero. Libero necessitatibus iusto, unde sed voluptatibus veritatis nostrum quo! Nam, incidunt officia. Soluta architecto at cupiditate provident distinctio doloremque adipisci ipsa ad ea impedit quidem, porro voluptatum reiciendis explicabo blanditiis repellendus expedita saepe omnis. Obcaecati suscipit sunt, officia incidunt dolorem reprehenderit rerum cumque, at rem quas quidem ducimus harum saepe perferendis mollitia est. Impedit ipsa quod voluptatibus odio doloribus aliquid accusantium sit nesciunt repudiandae amet. Minus, quidem dolore ea inventore iure dolorum quis ipsam fuga laudantium omnis maiores voluptates porro voluptatum eligendi sapiente doloribus in. Quas accusantium saepe repellendus, id culpa officia voluptatum fugit ipsam, explicabo consequuntur libero dicta, velit vel.</span></div></div><span xss=removed></span></div></div>', 'posting-611916daae69b.png', 1, 1, 5, '2021-08-15 20:30:02', '2021-08-15 20:30:02'),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur inventore aperiam nostrum veritatis, quo illum molestiae?', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-pariatur-inventore-aperiam-nostrum-veritatis-quo-illum-molestiae', '<div xss=removed><div><span xss=removed>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique delectus repellat, ex perferendis adipisci reprehenderit harum. Praesentium asperiores harum architecto quas ipsa, animi nemo dolore ab eius et, quo facilis maxime beatae suscipit error incidunt blanditiis labore vel expedita pariatur nobis aut ipsum! Voluptatibus impedit, nihil asperiores ab ratione accusantium quaerat beatae maxime dolore tempora, quia reiciendis? Culpa, ab. Sapiente possimus consequatur officia praesentium eaque numquam ipsum id quidem fugit laborum? Fugit doloremque libero aperiam ipsum, adipisci deserunt aliquam numquam quos dicta delectus quod, corporis amet? Omnis quam reiciendis fuga animi optio porro autem, recusandae deserunt quas esse in dolores!</span></div><div><span xss=removed><br></span></div><div><span xss=removed><br></span></div><div><div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas, iusto harum, exercitationem ut deserunt consequatur, suscipit reiciendis enim blanditiis ipsum fugit earum porro rem beatae perspiciatis velit natus repellat deleniti!</span></div></div><span xss=removed></span></div></div>', 'posting-6119172935b1d.png', 1, 1, 2, '2021-08-15 20:31:21', '2021-08-15 20:31:21'),
(3, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni, accusantium.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-magni-accusantium', '<div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quas placeat, nobis quidem, optio veniam quos aut, maiores ad delectus nemo ratione nulla tempore id aliquid repellat consequatur quia vel.</span></div><div><span xss=removed><br></span></div><div><div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, illum ad quis corporis a nisi laudantium sit vero non distinctio voluptatum iure inventore nihil! Quas perspiciatis aut tempora nihil recusandae modi, blanditiis laborum quidem minima, velit ut eveniet provident aperiam placeat voluptatum distinctio eligendi rerum sed ipsam aspernatur obcaecati voluptates dolor repudiandae! Eius voluptatibus amet perspiciatis quas atque deserunt doloremque vitae quidem sint ullam necessitatibus nostrum, fugiat enim eum praesentium iusto vero iure esse deleniti quisquam! Facilis quisquam placeat dolores maxime excepturi et modi minima, ut commodi sunt quia illum esse tempora? Odit, autem!</span></div></div><span xss=removed></span></div></div>', 'posting-61191769e74ba.jpg', 1, 1, 6, '2021-08-15 20:32:25', '2021-08-15 20:32:25'),
(4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, dolor laborum!', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-id-dolor-laborum', '<div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, illum ad quis corporis a nisi laudantium sit vero non distinctio voluptatum iure inventore nihil! Quas perspiciatis aut tempora nihil recusandae modi, blanditiis laborum quidem minima, velit ut eveniet provident aperiam placeat voluptatum distinctio eligendi rerum sed ipsam aspernatur obcaecati voluptates dolor repudiandae! Eius voluptatibus amet perspiciatis quas atque deserunt doloremque vitae quidem sint ullam necessitatibus nostrum, fugiat enim eum praesentium iusto vero iure esse deleniti quisquam! Facilis quisquam placeat dolores maxime excepturi et modi minima, ut commodi sunt quia illum esse tempora? Odit, autem!</span></div><div><div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, dolor laborum!</span></div></div></div><div><div xss=removed><div><span xss=removed>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, illum ad quis corporis a nisi laudantium sit vero non distinctio voluptatum iure inventore nihil! Quas perspiciatis aut tempora nihil recusandae modi, blanditiis laborum quidem minima, velit ut eveniet provident aperiam placeat voluptatum distinctio eligendi rerum sed ipsam aspernatur obcaecati voluptates dolor repudiandae! Eius voluptatibus amet perspiciatis quas atque deserunt doloremque vitae quidem sint ullam necessitatibus nostrum, fugiat enim eum praesentium iusto vero iure esse deleniti quisquam! Facilis quisquam placeat dolores maxime excepturi et modi minima, ut commodi sunt quia illum esse tempora? Odit, autem!</span></div></div><span xss=removed></span></div></div>', 'posting-6119198687b33.jpg', 1, 1, 8, '2021-08-15 20:33:03', '2021-08-15 20:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articles_categorys`
--

CREATE TABLE `tbl_articles_categorys` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_articles_categorys`
--

INSERT INTO `tbl_articles_categorys` (`id`, `category`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'News', 'news', '2021-08-15 20:27:32', '2021-08-15 20:27:32'),
(2, 'Information', 'information', '2021-08-15 20:27:45', '2021-08-15 20:27:45'),
(3, 'Technology', 'technology', '2021-08-15 20:27:54', '2021-08-15 20:27:54'),
(4, 'Tutorial', 'tutorial', '2021-08-15 20:28:06', '2021-08-15 20:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articles_postings`
--

CREATE TABLE `tbl_articles_postings` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_article_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_articles_postings`
--

INSERT INTO `tbl_articles_postings` (`id`, `id_article`, `id_article_category`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 2),
(5, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configs`
--

CREATE TABLE `tbl_configs` (
  `id` int(11) NOT NULL,
  `application` varchar(50) NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `powered` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `map` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_configs`
--

INSERT INTO `tbl_configs` (`id`, `application`, `copyright`, `powered`, `description`, `map`, `image`) VALUES
(1, 'App-CI3', 'codeigniter.com', 'imz', 'Application Codeigniter3', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13418.053505985636!2d102.73091284411659!3d0.9995695521376537!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x956d9160fe3b9754!2sAMIK+Selat+Panjang!5e0!3m2!1sid!2sid!4v1495599917161', 'logo-61123b147b616.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nav_menu`
--

CREATE TABLE `tbl_nav_menu` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `menu` varchar(25) NOT NULL,
  `slug` varchar(25) NOT NULL,
  `link` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nav_menu`
--

INSERT INTO `tbl_nav_menu` (`id`, `id_menu`, `menu`, `slug`, `link`, `created_at`, `updated_at`) VALUES
(1, 0, 'News', 'news', 'www.instagram.com', '2021-08-15 20:25:26', '2022-01-28 10:24:48'),
(2, 0, 'Download', 'download', '#download', '2021-08-15 20:25:49', '2021-08-15 20:25:49'),
(3, 0, 'About', 'about', '#about', '2021-08-15 20:26:10', '2021-08-15 20:26:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_level`
--
ALTER TABLE `tbl_admin_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_menu`
--
ALTER TABLE `tbl_admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_articles`
--
ALTER TABLE `tbl_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_articles_categorys`
--
ALTER TABLE `tbl_articles_categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_articles_postings`
--
ALTER TABLE `tbl_articles_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_configs`
--
ALTER TABLE `tbl_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nav_menu`
--
ALTER TABLE `tbl_nav_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_admin_level`
--
ALTER TABLE `tbl_admin_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_admin_menu`
--
ALTER TABLE `tbl_admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_articles`
--
ALTER TABLE `tbl_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_articles_categorys`
--
ALTER TABLE `tbl_articles_categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_articles_postings`
--
ALTER TABLE `tbl_articles_postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_configs`
--
ALTER TABLE `tbl_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_nav_menu`
--
ALTER TABLE `tbl_nav_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
