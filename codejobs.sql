-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-06-2012 a las 03:09:54
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `codejobs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_ads`
--

CREATE TABLE IF NOT EXISTS `muu_ads` (
  `ID_Ad` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Position` varchar(15) NOT NULL DEFAULT 'Right',
  `Banner` varchar(250) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Code` text NOT NULL,
  `Clicks` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `End_Date` int(11) NOT NULL DEFAULT '0',
  `Time` mediumint(8) NOT NULL DEFAULT '5000',
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Ad`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_ads`
--

INSERT INTO `muu_ads` (`ID_Ad`, `ID_User`, `Title`, `Position`, `Banner`, `URL`, `Code`, `Clicks`, `Start_Date`, `End_Date`, `Time`, `Principal`, `Situation`) VALUES
(1, 1, 'Anuncio 2', 'Top', 'www/lib/files/images/ads/1084b_45a3e-banner2.png', 'http://www.google.com', '', 0, 1339030862, 1341450062, 5000, 1, 'Deleted');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_applications`
--

CREATE TABLE IF NOT EXISTS `muu_applications` (
  `ID_Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) NOT NULL,
  `Slug` varchar(45) NOT NULL,
  `CPanel` tinyint(1) NOT NULL DEFAULT '1',
  `Adding` tinyint(1) NOT NULL,
  `BeDefault` tinyint(1) NOT NULL DEFAULT '1',
  `Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Application`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `muu_applications`
--

INSERT INTO `muu_applications` (`ID_Application`, `Title`, `Slug`, `CPanel`, `Adding`, `BeDefault`, `Comments`, `Situation`) VALUES
(1, 'Ads', 'ads', 1, 1, 0, 0, 'Active'),
(2, 'Applications', 'applications', 1, 1, 0, 0, 'Inactive'),
(3, 'Blog', 'blog', 1, 1, 1, 1, 'Active'),
(4, 'Comments', 'comments', 1, 0, 0, 1, 'Active'),
(5, 'Configuration', 'configuration', 1, 0, 0, 0, 'Active'),
(6, 'Feedback', 'feedback', 1, 0, 0, 0, 'Active'),
(7, 'Forums', 'forums', 1, 1, 1, 0, 'Active'),
(8, 'Gallery', 'gallery', 1, 1, 1, 1, 'Active'),
(9, 'Bookmarks', 'bookmarks', 1, 1, 1, 0, 'Active'),
(10, 'Messages', 'messages', 1, 1, 0, 0, 'Inactive'),
(11, 'Pages', 'pages', 1, 1, 1, 0, 'Active'),
(12, 'Polls', 'polls', 1, 1, 0, 0, 'Active'),
(13, 'Support', 'support', 1, 1, 0, 0, 'Inactive'),
(14, 'Users', 'users', 1, 1, 0, 0, 'Active'),
(15, 'Videos', 'videos', 1, 1, 1, 0, 'Active'),
(16, 'Works', 'works', 1, 1, 1, 0, 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_blog`
--

CREATE TABLE IF NOT EXISTS `muu_blog` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_URL` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Tags` varchar(250) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `Month` varchar(2) NOT NULL,
  `Day` varchar(2) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Image_Small` varchar(250) DEFAULT NULL,
  `Image_Medium` varchar(250) NOT NULL,
  `Comments` mediumint(8) NOT NULL DEFAULT '0',
  `Enable_Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Pwd` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_URL` (`ID_URL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `muu_blog`
--

INSERT INTO `muu_blog` (`ID_Post`, `ID_User`, `ID_URL`, `Title`, `Slug`, `Content`, `Tags`, `Author`, `Start_Date`, `Text_Date`, `Year`, `Month`, `Day`, `Views`, `Image_Small`, `Image_Medium`, `Comments`, `Enable_Comments`, `Language`, `Pwd`, `Situation`) VALUES
(1, 1, 1, 'Post 1', 'post-1', '<p>Post 1</p>', '', 'codejobs', 1337738072, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 27, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(2, 1, 1, 'Post 2', 'post-2', '<p>asdasdasd</p>', '', 'codejobs', 1337738210, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 25, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(3, 1, 1, 'Post 3', 'post-3', '<p>asdasdasdsad</p>', '', 'codejobs', 1337738232, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 26, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(4, 1, 1, 'Ajax', 'ajax', '<p>Ajax</p>\r\n<p>[Video: http://www.youtube.com/watch?v=dDuClRKEx5A]</p>', '', 'codejobs', 1337738320, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 25, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(5, 1, 1, 'Android', 'android', '<p>sdasdasdad</p>', '', 'codejobs', 1337739153, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 25, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(7, 1, 1, 'CodeIgniter', 'codeigniter', '<p>aasdsdasdsd</p>', '', 'codejobs', 1337740342, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 25, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(8, 1, 1, 'CSS3', 'css3', '<p>ASDSADASD</p>', '', 'codejobs', 1337740383, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 25, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(9, 1, 1, 'Databases', 'databases', '<p>asdsadasdasdsadsadsad</p>\r\n<p>sadsadsadsadsadasd</p>\r\n<p><!-- pagebreak -->sadsadsadsad</p>\r\n<p>sadasdasdasdsa</p>', '', 'codejobs', 1337740432, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 27, '', '', 0, 1, 'Spanish', '', 'Deleted'),
(10, 1, 1, 'eMarketing', 'emarketing', '<p>asdasdasdasdsad</p>\r\n<p><img src="https://si0.twimg.com/profile_images/2213925750/Candi_Mini.png" alt="" width="300" height="234" /></p>', '', 'codejobs', 1337740491, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 44, '', '', 3, 1, 'Spanish', '', 'Deleted'),
(11, 1, 1, 'Git & Github', 'git-github', '<p>sdasdsad</p>', 'git, github, php', 'codejobs', 1337741954, 'Wednesday, 23 de Mayo de 2012', '2012', '05', '23', 140, '', '', 20, 1, 'Spanish', '', 'Deleted');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_bookmarks`
--

CREATE TABLE IF NOT EXISTS `muu_bookmarks` (
  `ID_Bookmark` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `Slug` varchar(200) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Tags` varchar(200) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Views` mediumint(8) NOT NULL DEFAULT '0',
  `Likes` mediumint(8) NOT NULL DEFAULT '0',
  `Dislikes` mediumint(8) NOT NULL DEFAULT '0',
  `Reported` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Bookmark`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `muu_bookmarks`
--

INSERT INTO `muu_bookmarks` (`ID_Bookmark`, `ID_User`, `Title`, `Slug`, `URL`, `Description`, `Tags`, `Author`, `Views`, `Likes`, `Dislikes`, `Reported`, `Language`, `Start_Date`, `Situation`) VALUES
(1, 1, 'How to create a Debian .deb package', 'how-to-create-a-debian-deb-package', 'http://blog.serverdensity.com/2010/02/05/how-to-create-a-debian-deb-package/', 'A few weeks ago we announced that the agent for our server monitoring application, Server Density, was available as a Debian or Red Hat package, with associated repositories. Over my next few posts I will be outlining how we created our Linux-based packages and repositories, and what our steps are going to be to improve these processes in the future.', 'linux, debian, ubuntu, ror', 'codejobs', 6, 0, 0, 0, 'English', 1332738072, 'Active'),
(2, 1, 'Guardar en disco con HTML5 y Javascript: SessionStorage y LocalStorage', 'guardar-en-disco-con-html5-y-javascript-sessionstorage-y-localstorage', 'http://www.cristalab.com/tutoriales/guardar-en-disco-con-html5-y-javascript-sessionstorage-y-localst', 'Si hay algo que siempre se extrañó de HTML es en alguna forma de almacenar datos, que ayude al usuario a una mejor movilidad mientras navega nuestras páginas.', 'ror, html5, javascript, sessionstorage, localstorage', 'codejobs', 21, 0, 1, 0, 'Spanish', 1332738072, 'Active'),
(3, 1, 'Migrating Rails&RJS From Prototype To JQuery', 'migrating-rails-rjs-from-prototype-to-jquery', 'http://dzone.com/snippets/migrating-railsrjs-prototype', 'I was changing prototype to jsquery in my Rails app. To make my AJAX+RJS stuff work I tried jrails gem. For some reason AJAX responses were rendedered to whole page, instead of evaluating the returned JS. So i did the hack. I took this piece of jrails and put it in my /lib folder.', 'rails, ror, rjs, jquery', 'codejobs', 17, 0, 0, 0, 'English', 1337738320, 'Active'),
(4, 1, 'Capistrano: Deploy Rails Twice To The Same Machine', 'capistrano-deploy-rails-twice-to-the-same-machine', 'http://dzone.com/snippets/capistrano-deploy-rails-twice', 'Capistrano is oriented so it deploys to the same directory on several machines. This means you can''t deploy to two different locations on the same machine. The following recipe in Capfile will allow you to duplicate your main rails app in a second directory. You can schedule it to run automatically with every deploy or just do it manually. I included database migrations by default. Remove the shared config line if you don''t have it.', 'capistrano, ror, rails', 'codejobs', 36, 1, 0, 0, 'English', 1337738320, 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_codes`
--

CREATE TABLE IF NOT EXISTS `muu_codes` (
  `ID_Code` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Code` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Likes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_codes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_comments`
--

CREATE TABLE IF NOT EXISTS `muu_comments` (
  `ID_Comment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comment` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Avatar` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Comment`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `muu_comments`
--

INSERT INTO `muu_comments` (`ID_Comment`, `ID_User`, `Comment`, `Start_Date`, `Text_Date`, `Username`, `Avatar`, `Situation`) VALUES
(1, 1, 'Hola soy Carlos', 1337907194, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(2, 1, 'ASDASDASD', 1337647712, 'Wednesday, 23 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(3, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1337910841, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(4, 1, 'sdfdsfdsf', 1337910951, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(5, 1, 'sdfdsfdsf', 1337910955, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(6, 1, 'sdfdsfdsf', 1337911049, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(7, 1, 'sdfdsfdsf', 1337911053, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(8, 1, 'asdasd', 1337911099, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(9, 1, 'asdasd', 1337911103, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(10, 1, 'asdasdasd', 1337911170, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(11, 1, 'sdfdsfsdf', 1337911193, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(12, 1, 'sdfsdfdf', 1337911196, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(13, 1, 'asdasd', 1337911269, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(14, 1, 'asdasd', 1337911288, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(15, 1, 'asdasd', 1337911302, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(16, 1, 'asdasd', 1337911335, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(17, 1, 'asdasd', 1337911433, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(18, 1, 'asdasd', 1337911452, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(19, 1, 'asdasd', 1337911472, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(20, 1, 'ADAD', 1337911931, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(21, 1, 'sdfsdfsf', 1337913946, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(22, 1, 'asdadad', 1337914091, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(23, 1, 'scriptalert("Hola");/script', 1337914207, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active'),
(24, 1, 'iframe', 1337914568, 'Viernes, 25 de Mayo de 2012', 'codejobs', 'default.png', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_companies`
--

CREATE TABLE IF NOT EXISTS `muu_companies` (
  `ID_Company` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `RFC` varchar(20) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Legal_Name` varchar(100) NOT NULL,
  `Legal_Last_Name` varchar(100) NOT NULL,
  `Legal_Maiden_Name` varchar(100) NOT NULL,
  `Legal_Title` varchar(100) NOT NULL,
  `Legal_Email` varchar(100) NOT NULL,
  `Legal_Phone` varchar(15) NOT NULL,
  `Legal_Mobile` varchar(15) NOT NULL,
  `Vacancies` smallint(5) NOT NULL,
  `Type_Vacancy` varchar(50) NOT NULL,
  `Employees` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Sector` varchar(100) NOT NULL,
  `Turn` varchar(100) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Zip_Code` varchar(10) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Logo` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_companies`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_configuration`
--

CREATE TABLE IF NOT EXISTS `muu_configuration` (
  `ID_Configuration` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Slogan_English` varchar(100) NOT NULL,
  `Slogan_Spanish` varchar(100) NOT NULL,
  `Slogan_French` varchar(100) NOT NULL,
  `Slogan_Portuguese` varchar(100) NOT NULL,
  `URL` varchar(60) NOT NULL,
  `Lang` varchar(2) NOT NULL DEFAULT 'en',
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Theme` varchar(25) NOT NULL DEFAULT 'ZanPHP',
  `Validation` varchar(15) NOT NULL DEFAULT 'Super Admin',
  `Application` varchar(30) NOT NULL DEFAULT 'Blog',
  `Message` text NOT NULL,
  `Activation` varchar(10) NOT NULL DEFAULT 'Nobody',
  `Email_Recieve` varchar(50) NOT NULL,
  `Email_Send` varchar(50) NOT NULL DEFAULT '@domain.com',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Configuration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_configuration`
--

INSERT INTO `muu_configuration` (`ID_Configuration`, `Name`, `Slogan_English`, `Slogan_Spanish`, `Slogan_French`, `Slogan_Portuguese`, `URL`, `Lang`, `Language`, `Theme`, `Validation`, `Application`, `Message`, `Activation`, `Email_Recieve`, `Email_Send`, `Situation`) VALUES
(1, 'Codejobs', 'Knowledge makes us free!', 'El conocimiento nos hace libres!', 'Connaissance nous rend libres!', 'Conhecimento nos torna livres!', 'http://127.0.0.1/codejobs', 'es', 'Spanish', 'newcodejobs', 'Active', 'blog', 'El Sitio Web esta en mantenimiento', 'User', 'azapedia@gmail.com', 'carlos@codejobs.biz', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_categories`
--

CREATE TABLE IF NOT EXISTS `muu_courses_categories` (
  `ID_Category` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Courses` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(10) NOT NULL DEFAULT 'English',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_categories`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_enrollments`
--

CREATE TABLE IF NOT EXISTS `muu_courses_enrollments` (
  `ID_Enrollment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Enrollment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_enrollments`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_help`
--

CREATE TABLE IF NOT EXISTS `muu_courses_help` (
  `ID_Help` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Topic` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Help`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_help`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_lessons`
--

CREATE TABLE IF NOT EXISTS `muu_courses_lessons` (
  `ID_Lesson` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Lesson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_lessons`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_material`
--

CREATE TABLE IF NOT EXISTS `muu_courses_material` (
  `ID_Material` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Content` text NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_material`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_resources`
--

CREATE TABLE IF NOT EXISTS `muu_courses_resources` (
  `ID_Resource` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `URL` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Resource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_resources`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_roles`
--

CREATE TABLE IF NOT EXISTS `muu_courses_roles` (
  `ID_Role` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Role` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_roles`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_students`
--

CREATE TABLE IF NOT EXISTS `muu_courses_students` (
  `ID_Student` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Enrollment` varchar(9) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(80) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `RFC` varchar(13) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Presentation` varchar(255) NOT NULL,
  `Courses` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Code` varchar(10) NOT NULL,
  `Privileges` varchar(15) NOT NULL DEFAULT 'Student',
  PRIMARY KEY (`ID_Student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_students`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_students_archive`
--

CREATE TABLE IF NOT EXISTS `muu_courses_students_archive` (
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_courses_students_archive`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_tests`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tests` (
  `ID_Test` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Score` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Attempts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_tests`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_tests_answers`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tests_answers` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_courses_tests_answers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_tests_questions`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tests_questions` (
  `ID_Question` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Test` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Question` varchar(255) NOT NULL,
  `Value` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Audio` varchar(150) NOT NULL,
  `Image` varchar(150) NOT NULL,
  `Video` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_tests_questions`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_tutors`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tutors` (
  `ID_Tutor` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Schooling` varchar(100) NOT NULL,
  `Curriculum` text NOT NULL,
  `Photo` varchar(250) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  PRIMARY KEY (`ID_Tutor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_tutors`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_tutors_alerts`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tutors_alerts` (
  `ID_Alert` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subject` varchar(250) NOT NULL,
  `Alert` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Alert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_tutors_alerts`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_courses_tutors_messages`
--

CREATE TABLE IF NOT EXISTS `muu_courses_tutors_messages` (
  `ID_Message` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Student` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subject` varchar(250) NOT NULL,
  `Message` text NOT NULL,
  `File` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_courses_tutors_messages`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_dislikes`
--

CREATE TABLE IF NOT EXISTS `muu_dislikes` (
  `ID_Dislike` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Dislike`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_dislikes`
--

INSERT INTO `muu_dislikes` (`ID_Dislike`, `ID_User`, `ID_Application`, `ID_Record`, `Start_Date`) VALUES
(1, 1, 10, 2, 1338350663);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_events`
--

CREATE TABLE IF NOT EXISTS `muu_events` (
  `ID_Event` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(250) NOT NULL,
  `Place` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Time_Zone` varchar(50) NOT NULL,
  `Repeat_Event` varchar(50) NOT NULL,
  `Alert` varchar(50) NOT NULL,
  `Calendar` varchar(100) NOT NULL,
  `URL` varchar(150) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID_Event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_events`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_feedback`
--

CREATE TABLE IF NOT EXISTS `muu_feedback` (
  `ID_Feedback` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Phone` varchar(16) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Subject` varchar(200) NOT NULL,
  `Message` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(60) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`ID_Feedback`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_feedback`
--

INSERT INTO `muu_feedback` (`ID_Feedback`, `Name`, `Email`, `Company`, `Phone`, `City`, `Subject`, `Message`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 'Carlos Santana Roldán', 'carlos@milkzoft.com', 'MilkZoft', '1223423', 'Colima', 'Hola como estas', 'adasdasd', 1337647712, 'Miércoles, 13 de Junio de 2012', 'Deleted');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_forums`
--

CREATE TABLE IF NOT EXISTS `muu_forums` (
  `ID_Forum` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(120) NOT NULL,
  `Slug` varchar(120) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Last_Reply` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Date` varchar(50) NOT NULL,
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Forum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_forums`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_forums_posts`
--

CREATE TABLE IF NOT EXISTS `muu_forums_posts` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Forum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Hour` varchar(15) NOT NULL DEFAULT '00:00:00',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Topic` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_Forum` (`ID_Forum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_forums_posts`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_gallery`
--

CREATE TABLE IF NOT EXISTS `muu_gallery` (
  `ID_Image` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Small` varchar(255) NOT NULL,
  `Medium` varchar(255) NOT NULL,
  `Original` varchar(255) NOT NULL,
  `Album` varchar(50) NOT NULL DEFAULT 'None',
  `Album_Slug` varchar(150) NOT NULL DEFAULT 'None',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(50) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Image`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_gallery`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_gallery_themes`
--

CREATE TABLE IF NOT EXISTS `muu_gallery_themes` (
  `ID_Gallery_Theme` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Slug` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Gallery_Theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_gallery_themes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_inbox`
--

CREATE TABLE IF NOT EXISTS `muu_inbox` (
  `ID_Inbox` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Receiver` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Sender` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Message` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Unread',
  PRIMARY KEY (`ID_Inbox`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_inbox`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_jobs`
--

CREATE TABLE IF NOT EXISTS `muu_jobs` (
  `ID_Job` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Company_Information` text NOT NULL,
  `Location` varchar(250) NOT NULL,
  `Salary` varchar(25) NOT NULL,
  `Allocation_Time` varchar(50) NOT NULL,
  `Requirements` text NOT NULL,
  `Experience` text NOT NULL,
  `Activities` text NOT NULL,
  `Profile` text NOT NULL,
  `Technologies` varchar(250) NOT NULL,
  `Additional_Information` text NOT NULL,
  `Company_Contact` text NOT NULL,
  PRIMARY KEY (`ID_Job`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_jobs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_learning`
--

CREATE TABLE IF NOT EXISTS `muu_learning` (
  `ID_Course` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Tutor` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Information` text NOT NULL,
  `Objetive` text NOT NULL,
  `To_People` text NOT NULL,
  `Requeriments` text NOT NULL,
  `Duration` smallint(5) NOT NULL,
  `Price1` varchar(20) NOT NULL,
  `Price2` varchar(20) NOT NULL,
  `Language` varchar(15) NOT NULL DEFAULT 'English',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_learning`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_likes`
--

CREATE TABLE IF NOT EXISTS `muu_likes` (
  `ID_Like` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Like`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `muu_likes`
--

INSERT INTO `muu_likes` (`ID_Like`, `ID_User`, `ID_Application`, `ID_Record`, `Start_Date`) VALUES
(1, 1, 10, 3, 1338350239),
(2, 1, 10, 4, 1338350263);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_logs`
--

CREATE TABLE IF NOT EXISTS `muu_logs` (
  `ID_Log` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Table_Name` varchar(50) NOT NULL,
  `Activity` varchar(100) NOT NULL,
  `Query` text NOT NULL,
  `Start_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Log`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_logs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_mural`
--

CREATE TABLE IF NOT EXISTS `muu_mural` (
  `ID_Mural` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Post` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Mural`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_mural`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_pages`
--

CREATE TABLE IF NOT EXISTS `muu_pages` (
  `ID_Page` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Translation` mediumint(8) NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL,
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Page`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `muu_pages`
--

INSERT INTO `muu_pages` (`ID_Page`, `ID_User`, `ID_Translation`, `Title`, `Slug`, `Content`, `Views`, `Language`, `Principal`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, 0, 'Publicidad', 'publicidad', '<p>Publicidad</p>', 0, 'Spanish', 0, 1337745419, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(2, 1, 0, 'Aviso Legal', 'aviso-legal', '<p>Aviso Legal</p>', 0, 'Spanish', 0, 1337746393, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(3, 1, 0, 'Condiciones de uso', 'condiciones-de-uso', '<p>Condiciones de uso</p>', 0, 'Spanish', 0, 1337746409, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active'),
(4, 1, 0, 'Acerca de Codejobs', 'acerca-de-codejobs', '<p>Acerca de Codejobs</p>', 0, 'Spanish', 0, 1337746606, 'MiÃ©rcoles, 23 de Mayo de 2012', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_points`
--

CREATE TABLE IF NOT EXISTS `muu_points` (
  `ID_Point` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Action` varchar(30) NOT NULL DEFAULT 'Like',
  `Points` int(11) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Point`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_points`
--

INSERT INTO `muu_points` (`ID_Point`, `ID_User`, `ID_Application`, `ID_Record`, `Action`, `Points`, `Start_Date`, `Situation`) VALUES
(1, 1, 10, 1, 'Like', 1, 1338348567, 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_polls`
--

CREATE TABLE IF NOT EXISTS `muu_polls` (
  `ID_Poll` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(255) NOT NULL,
  `Type` varchar(10) DEFAULT 'Simple',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Poll`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_polls`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_polls_answers`
--

CREATE TABLE IF NOT EXISTS `muu_polls_answers` (
  `ID_Answer` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Answer` varchar(100) NOT NULL,
  `Votes` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Answer`),
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_polls_answers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_polls_ips`
--

CREATE TABLE IF NOT EXISTS `muu_polls_ips` (
  `ID_Poll` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IP` varchar(15) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Poll` (`ID_Poll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_polls_ips`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_privileges`
--

CREATE TABLE IF NOT EXISTS `muu_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(25) NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`ID_Privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `muu_privileges`
--

INSERT INTO `muu_privileges` (`ID_Privilege`, `Privilege`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Moderator'),
(4, 'Member');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_resumes`
--

CREATE TABLE IF NOT EXISTS `muu_resumes` (
  `ID_Resume` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Elementary_School` varchar(250) NOT NULL,
  `Middle_School` varchar(250) NOT NULL,
  `High_School` varchar(250) NOT NULL,
  `Collegue_University` varchar(250) NOT NULL,
  `Master` varchar(250) NOT NULL,
  `Doctorate` varchar(250) NOT NULL,
  `Languages` varchar(250) NOT NULL,
  `Employment` text NOT NULL,
  `Skills` text NOT NULL,
  `Courses` text NOT NULL,
  `Conferences` text NOT NULL,
  `Articles` text NOT NULL,
  `Photo` varchar(250) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Last_Update` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Resume`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_resumes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_comments_applications`
--

CREATE TABLE IF NOT EXISTS `muu_re_comments_applications` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Comment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Comment2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Comment` (`ID_Comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `muu_re_comments_applications`
--

INSERT INTO `muu_re_comments_applications` (`ID_Comment2Application`, `ID_Application`, `ID_Comment`, `ID_Record`) VALUES
(1, 3, 1, 11),
(2, 3, 2, 11),
(3, 3, 3, 11),
(4, 3, 4, 11),
(5, 3, 5, 11),
(6, 3, 6, 11),
(7, 3, 7, 11),
(8, 3, 8, 11),
(9, 3, 9, 11),
(10, 3, 10, 11),
(11, 3, 11, 11),
(12, 3, 12, 11),
(13, 3, 13, 11),
(14, 3, 14, 11),
(15, 3, 15, 11),
(16, 3, 16, 11),
(17, 3, 17, 11),
(18, 3, 18, 11),
(19, 3, 19, 11),
(20, 3, 20, 11),
(21, 3, 21, 11),
(22, 3, 22, 10),
(23, 3, 23, 10),
(24, 3, 24, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_companies_jobs`
--

CREATE TABLE IF NOT EXISTS `muu_re_companies_jobs` (
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Job` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `muu_re_companies_jobs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_courses_course_categories`
--

CREATE TABLE IF NOT EXISTS `muu_re_courses_course_categories` (
  `ID_Category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_courses_course_categories`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_courses_lesson_course`
--

CREATE TABLE IF NOT EXISTS `muu_re_courses_lesson_course` (
  `ID_Course` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Lesson` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_courses_lesson_course`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_courses_tests_question_answer`
--

CREATE TABLE IF NOT EXISTS `muu_re_courses_tests_question_answer` (
  `ID_Question` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Answer` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_courses_tests_question_answer`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_permissions_privileges`
--

CREATE TABLE IF NOT EXISTS `muu_re_permissions_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Adding` tinyint(1) NOT NULL DEFAULT '0',
  `Deleting` tinyint(1) NOT NULL DEFAULT '0',
  `Editing` tinyint(1) NOT NULL DEFAULT '0',
  `Viewing` tinyint(1) NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_Application` (`ID_Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_permissions_privileges`
--

INSERT INTO `muu_re_permissions_privileges` (`ID_Privilege`, `ID_Application`, `Adding`, `Deleting`, `Editing`, `Viewing`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(1, 9, 1, 1, 1, 1),
(1, 10, 1, 1, 1, 1),
(1, 11, 1, 1, 1, 1),
(1, 12, 1, 1, 1, 1),
(1, 13, 1, 1, 1, 1),
(1, 14, 1, 1, 1, 1),
(1, 15, 1, 1, 1, 1),
(1, 16, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0),
(2, 3, 1, 1, 1, 1),
(2, 5, 0, 0, 0, 0),
(2, 6, 0, 0, 0, 0),
(2, 7, 0, 0, 0, 1),
(2, 8, 1, 1, 1, 1),
(2, 9, 1, 1, 1, 1),
(2, 10, 1, 1, 1, 1),
(2, 11, 1, 0, 1, 1),
(2, 12, 1, 1, 1, 1),
(2, 13, 1, 0, 0, 0),
(2, 14, 1, 1, 1, 1),
(2, 15, 1, 1, 1, 1),
(2, 16, 1, 1, 1, 1),
(3, 1, 0, 0, 0, 0),
(3, 2, 0, 0, 0, 0),
(3, 3, 1, 0, 0, 1),
(3, 5, 0, 0, 0, 0),
(3, 6, 0, 0, 0, 0),
(3, 7, 0, 0, 0, 0),
(3, 8, 1, 0, 0, 1),
(3, 9, 0, 0, 0, 0),
(3, 10, 0, 0, 0, 0),
(3, 11, 1, 0, 0, 1),
(3, 12, 0, 0, 0, 0),
(3, 13, 0, 0, 0, 0),
(3, 14, 0, 0, 0, 0),
(3, 15, 0, 0, 0, 0),
(3, 16, 1, 0, 0, 1),
(4, 1, 0, 0, 0, 0),
(4, 2, 0, 0, 0, 0),
(4, 3, 0, 0, 0, 0),
(4, 5, 0, 0, 0, 0),
(4, 6, 0, 0, 0, 0),
(4, 7, 0, 0, 0, 0),
(4, 8, 0, 0, 0, 0),
(4, 9, 0, 0, 0, 0),
(4, 10, 0, 0, 0, 0),
(4, 11, 0, 0, 0, 0),
(4, 12, 0, 0, 0, 0),
(4, 13, 0, 0, 0, 0),
(4, 14, 0, 0, 0, 0),
(4, 15, 0, 0, 0, 0),
(4, 16, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_privileges_users`
--

CREATE TABLE IF NOT EXISTS `muu_re_privileges_users` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_privileges_users`
--

INSERT INTO `muu_re_privileges_users` (`ID_Privilege`, `ID_User`) VALUES
(4, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_users_companies`
--

CREATE TABLE IF NOT EXISTS `muu_re_users_companies` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Company` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `muu_re_users_companies`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_users_events`
--

CREATE TABLE IF NOT EXISTS `muu_re_users_events` (
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Event` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `muu_re_users_events`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_support`
--

CREATE TABLE IF NOT EXISTS `muu_support` (
  `ID_Ticket` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Ticket`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_support`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_tokens`
--

CREATE TABLE IF NOT EXISTS `muu_tokens` (
  `ID_Token` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Token` varchar(40) NOT NULL,
  `Action` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Token`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_tokens`
--

INSERT INTO `muu_tokens` (`ID_Token`, `ID_User`, `Token`, `Action`, `Start_Date`, `End_Date`, `Situation`) VALUES
(1, 1, '756d9920d7eca6a6794c2c1e703ec7c84739e986', 'Recover', 1337732698, 1337819098, 'Inactive');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_tutorials`
--

CREATE TABLE IF NOT EXISTS `muu_tutorials` (
  `ID_Tutorial` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Text_Date` varchar(50) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Likes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Tutorial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_tutorials`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users`
--

CREATE TABLE IF NOT EXISTS `muu_users` (
  `ID_User` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Privilege` mediumint(8) NOT NULL DEFAULT '4',
  `Username` varchar(30) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Avatar` varchar(200) NOT NULL DEFAULT 'default.png',
  `Points` mediumint(8) NOT NULL DEFAULT '50',
  `Sign` text NOT NULL,
  `Messages` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Recieve_Messages` tinyint(1) NOT NULL DEFAULT '1',
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Codes` mediumint(8) NOT NULL DEFAULT '0',
  `Tutorials` mediumint(8) NOT NULL DEFAULT '0',
  `Jobs` mediumint(8) NOT NULL DEFAULT '0',
  `Subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `RFC` varchar(13) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Age` smallint(2) NOT NULL DEFAULT '18',
  `Title` varchar(200) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Mobile` varchar(15) NOT NULL,
  `Gender` varchar(1) NOT NULL DEFAULT 'M',
  `Relationship` varchar(30) NOT NULL DEFAULT 'Single',
  `Birthday` varchar(10) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Technologies` varchar(255) NOT NULL,
  `Twitter` varchar(150) NOT NULL,
  `Facebook` varchar(150) NOT NULL,
  `Linkedin` varchar(150) NOT NULL,
  `Viadeo` varchar(150) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `muu_users`
--

INSERT INTO `muu_users` (`ID_User`, `ID_Privilege`, `Username`, `Pwd`, `Email`, `Website`, `Avatar`, `Points`, `Sign`, `Messages`, `Recieve_Messages`, `Topics`, `Replies`, `Comments`, `Codes`, `Tutorials`, `Jobs`, `Subscribed`, `Start_Date`, `Code`, `CURP`, `RFC`, `Name`, `Age`, `Title`, `Address`, `Zip`, `Phone`, `Mobile`, `Gender`, `Relationship`, `Birthday`, `Country`, `District`, `City`, `Technologies`, `Twitter`, `Facebook`, `Linkedin`, `Viadeo`, `Situation`) VALUES
(1, 1, 'admin', 'b9223847e1566884893656e84798ff39cea2b8c4', 'carlos@milkzoft.com', '', 'default.png', 50, '', 0, 1, 0, 0, 0, 0, 0, 0, 1, 1337647712, 'BC958D3C97', '', '', 'Carlos Santana Roldán', 18, '', '', '', '', '0', 'M', 'Single', '', '', '', '', '', '', '', '', '', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_online`
--

CREATE TABLE IF NOT EXISTS `muu_users_online` (
  `User` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`User`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_online_anonymous`
--

CREATE TABLE IF NOT EXISTS `muu_users_online_anonymous` (
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`IP`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_videos`
--

CREATE TABLE IF NOT EXISTS `muu_videos` (
  `ID_Video` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_YouTube` varchar(20) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Slug` varchar(150) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Server` varchar(25) NOT NULL DEFAULT 'YouTube',
  `Duration` varchar(10) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Video`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `muu_videos`
--

INSERT INTO `muu_videos` (`ID_Video`, `ID_User`, `ID_YouTube`, `Title`, `Slug`, `Description`, `URL`, `Server`, `Duration`, `Views`, `Start_Date`, `Text_Date`, `Situation`) VALUES
(1, 1, 'jhP6vVc7Yts', 'Taller de CodeIgniter por www.codejobs.biz', 'taller-de-codeigniter-por-www-codejobs-biz', 'Taller de CodeIgniter por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(2, 1, 'JtUCr-m8BSo', 'Introducción al Responsive Design por www.codejobs.biz', 'introduccion-al-responsive-design-por-www-codejobs-biz', 'Introducción al Responsive Design por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(3, 1, 'SXHsN5GhdA0', 'Proyecto CANDI 3: Cómo crear un correo electro?nico en GMail', 'proyecto-candi-3-como-crear-un-correo-electro-nico-en-gmail', 'Explicación breve de cómo crear una cuenta de correo electrónico en GMail', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(4, 1, 't1BrjyAf3XE', 'Proyecto CANDI 2: Cómo crear una cuenta de correo electro?nico en Hotmail', 'proyecto-candi-2-como-crear-una-cuenta-de-correo-electro-nico-en-hotmail', 'Explicación breve de cómo crear una cuenta de correo electrónico en Hotmail', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(5, 1, 'djg8B0TPh60', 'Proyecto CANDI 1: Instalacioón de Ubuntu 12.04 [www.codejobs.biz]', 'proyecto-candi-1-instalacion-de-ubuntu-12-04-www-codejobs-biz', 'Explicación sencilla de cómo instalar Ubuntu 12.04 en tu computadora.', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(6, 1, 'JhHz0vyngN4', 'Presentación del Proyecto CANDI', 'presentacion-del-proyecto-candi', 'Presentación del Proyecto CANDI', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(7, 1, 'XBYw9eWNd7c', 'Taller de Introducción a ZanPHP por www.codejobs.biz', 'taller-de-introduccion-a-zanphp-por-www-codejobs-biz', 'Taller de Introduccio?n a ZanPHP por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(8, 1, '-Wb0XcYjIxU', 'Introducción a las Bases de Datos NoSQL', 'introducci-n-a-las-bases-de-datos-nosql', '', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active'),
(9, 1, 'nN9NQRSG7iU', 'Taller de Github por www.codejobs.biz', 'taller-de-github-por-www-codejobs-biz', 'Taller de Github por www.codejobs.biz', '', 'YouTube', '', 0, 1337743070, 'Wednesday, 23 de Mayo de 2012', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_works`
--

CREATE TABLE IF NOT EXISTS `muu_works` (
  `ID_Work` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Preview1` varchar(200) NOT NULL,
  `Preview2` varchar(200) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Work`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_works`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_world`
--

CREATE TABLE IF NOT EXISTS `muu_world` (
  `Continent` varchar(20) NOT NULL,
  `Code` varchar(5) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Town` varchar(100) NOT NULL,
  KEY `District` (`District`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_world`
--

INSERT INTO `muu_world` (`Continent`, `Code`, `Country`, `District`, `Town`) VALUES
('America', 'ARG', 'Argentina', 'Buenos Aires', ''),
('America', 'ARG', 'Argentina', 'Catamarca', ''),
('America', 'ARG', 'Argentina', 'Chaco', ''),
('America', 'ARG', 'Argentina', 'Chubut', ''),
('America', 'ARG', 'Argentina', 'C', ''),
('America', 'ARG', 'Argentina', 'Corrientes', ''),
('America', 'ARG', 'Argentina', 'Distrito Federal', ''),
('America', 'ARG', 'Argentina', 'Entre Rios', ''),
('America', 'ARG', 'Argentina', 'Formosa', ''),
('America', 'ARG', 'Argentina', 'Jujuy', ''),
('America', 'ARG', 'Argentina', 'La Rioja', ''),
('America', 'ARG', 'Argentina', 'Mendoza', ''),
('America', 'ARG', 'Argentina', 'Misiones', ''),
('America', 'ARG', 'Argentina', 'Neuqu', ''),
('America', 'ARG', 'Argentina', 'Salta', ''),
('America', 'ARG', 'Argentina', 'San Juan', ''),
('America', 'ARG', 'Argentina', 'San Luis', ''),
('America', 'ARG', 'Argentina', 'Santa F', ''),
('America', 'ARG', 'Argentina', 'Santiago del Estero', ''),
('America', 'ARG', 'Argentina', 'Tucum', ''),
('America', 'BLZ', 'Belize', 'Belize City', ''),
('America', 'BLZ', 'Belize', 'Cayo', ''),
('America', 'BOL', 'Bolivia', 'Chuquisaca', ''),
('America', 'BOL', 'Bolivia', 'Cochabamba', ''),
('America', 'BOL', 'Bolivia', 'La Paz', ''),
('America', 'BOL', 'Bolivia', 'Oruro', ''),
('America', 'BOL', 'Bolivia', 'Potos', ''),
('America', 'BOL', 'Bolivia', 'Santa Cruz', ''),
('America', 'BOL', 'Bolivia', 'Tarija', ''),
('America', 'BRA', 'Brazil', 'Acre', ''),
('America', 'BRA', 'Brazil', 'Alagoas', ''),
('America', 'BRA', 'Brazil', 'Amap', ''),
('America', 'BRA', 'Brazil', 'Amazonas', ''),
('America', 'BRA', 'Brazil', 'Bahia', ''),
('America', 'BRA', 'Brazil', 'Cear', ''),
('America', 'BRA', 'Brazil', 'Distrito Federal', ''),
('America', 'BRA', 'Brazil', 'Esp', ''),
('America', 'BRA', 'Brazil', 'Goi', ''),
('America', 'BRA', 'Brazil', 'Maranh', ''),
('America', 'BRA', 'Brazil', 'Mato Grosso', ''),
('America', 'BRA', 'Brazil', 'Mato Grosso do Sul', ''),
('America', 'BRA', 'Brazil', 'Minas Gerais', ''),
('America', 'BRA', 'Brazil', 'Par', ''),
('America', 'BRA', 'Brazil', 'Para', ''),
('America', 'BRA', 'Brazil', 'Paran', ''),
('America', 'BRA', 'Brazil', 'Pernambuco', ''),
('America', 'BRA', 'Brazil', 'Piau', ''),
('America', 'BRA', 'Brazil', 'Rio de Janeiro', ''),
('America', 'BRA', 'Brazil', 'Rio Grande do Norte', ''),
('America', 'BRA', 'Brazil', 'Rio Grande do Sul', ''),
('America', 'BRA', 'Brazil', 'Rond', ''),
('America', 'BRA', 'Brazil', 'Roraima', ''),
('America', 'BRA', 'Brazil', 'Santa Catarina', ''),
('America', 'BRA', 'Brazil', 'S', ''),
('America', 'BRA', 'Brazil', 'Sergipe', ''),
('America', 'BRA', 'Brazil', 'Tocantins', ''),
('America', 'CAN', 'Canada', 'Alberta', ''),
('America', 'CAN', 'Canada', 'British Colombia', ''),
('America', 'CAN', 'Canada', 'Manitoba', ''),
('America', 'CAN', 'Canada', 'Newfoundland', ''),
('America', 'CAN', 'Canada', 'Nova Scotia', ''),
('America', 'CAN', 'Canada', 'Ontario', ''),
('America', 'CAN', 'Canada', 'Qu', ''),
('America', 'CAN', 'Canada', 'Saskatchewan', ''),
('America', 'CHL', 'Chile', 'Antofagasta', ''),
('America', 'CHL', 'Chile', 'Atacama', ''),
('America', 'CHL', 'Chile', 'B', ''),
('America', 'CHL', 'Chile', 'Coquimbo', ''),
('America', 'CHL', 'Chile', 'La Araucan', ''),
('America', 'CHL', 'Chile', 'Los Lagos', ''),
('America', 'CHL', 'Chile', 'Magallanes', ''),
('America', 'CHL', 'Chile', 'Maule', ''),
('America', 'CHL', 'Chile', 'Santiago', ''),
('America', 'CHL', 'Chile', 'Tarapac', ''),
('America', 'CHL', 'Chile', 'Valpara', ''),
('America', 'COL', 'Colombia', 'Antioquia', ''),
('America', 'COL', 'Colombia', 'Atl', ''),
('America', 'COL', 'Colombia', 'Bol', ''),
('America', 'COL', 'Colombia', 'Boyac', ''),
('America', 'COL', 'Colombia', 'Caldas', ''),
('America', 'COL', 'Colombia', 'Caquet', ''),
('America', 'COL', 'Colombia', 'Cauca', ''),
('America', 'COL', 'Colombia', 'Cesar', ''),
('America', 'COL', 'Colombia', 'C', ''),
('America', 'COL', 'Colombia', 'Cundinamarca', ''),
('America', 'COL', 'Colombia', 'Huila', ''),
('America', 'COL', 'Colombia', 'La Guajira', ''),
('America', 'COL', 'Colombia', 'Magdalena', ''),
('America', 'COL', 'Colombia', 'Meta', ''),
('America', 'COL', 'Colombia', 'Norte de Santander', ''),
('America', 'COL', 'Colombia', 'Quind', ''),
('America', 'COL', 'Colombia', 'Risaralda', ''),
('America', 'COL', 'Colombia', 'Santaf', ''),
('America', 'COL', 'Colombia', 'Santander', ''),
('America', 'COL', 'Colombia', 'Sucre', ''),
('America', 'COL', 'Colombia', 'Tolima', ''),
('America', 'COL', 'Colombia', 'Valle', ''),
('America', 'CRI', 'Costa Rica', 'San Jos', ''),
('America', 'CUB', 'Cuba', 'Ciego de ', ''),
('America', 'CUB', 'Cuba', 'Cienfuegos', ''),
('America', 'CUB', 'Cuba', 'Granma', ''),
('America', 'CUB', 'Cuba', 'Guant', ''),
('America', 'CUB', 'Cuba', 'Holgu', ''),
('America', 'CUB', 'Cuba', 'La Habana', ''),
('America', 'CUB', 'Cuba', 'Las Tunas', ''),
('America', 'CUB', 'Cuba', 'Matanzas', ''),
('America', 'CUB', 'Cuba', 'Pinar del R', ''),
('America', 'CUB', 'Cuba', 'Santiago de Cuba', ''),
('America', 'CUB', 'Cuba', 'Villa Clara', ''),
('America', 'CYM', 'Cayman Islands', 'Grand Cayman', ''),
('America', 'DMA', 'Dominica', 'St George', ''),
('America', 'DOM', 'Dominican Republic', 'Distrito Nacional', ''),
('America', 'DOM', 'Dominican Republic', 'Duarte', ''),
('America', 'DOM', 'Dominican Republic', 'La Romana', ''),
('America', 'DOM', 'Dominican Republic', 'Puerto Plata', ''),
('America', 'DOM', 'Dominican Republic', 'San Pedro de Macor', ''),
('America', 'DOM', 'Dominican Republic', 'Santiago', ''),
('America', 'ECU', 'Ecuador', 'Azuay', ''),
('America', 'ECU', 'Ecuador', 'Chimborazo', ''),
('America', 'ECU', 'Ecuador', 'El Oro', ''),
('America', 'ECU', 'Ecuador', 'Esmeraldas', ''),
('America', 'ECU', 'Ecuador', 'Guayas', ''),
('America', 'ECU', 'Ecuador', 'Imbabura', ''),
('America', 'ECU', 'Ecuador', 'Loja', ''),
('America', 'ECU', 'Ecuador', 'Los R', ''),
('America', 'ECU', 'Ecuador', 'Manab', ''),
('America', 'ECU', 'Ecuador', 'Pichincha', ''),
('America', 'ECU', 'Ecuador', 'Tungurahua', ''),
('America', 'SLV', 'El Salvador', 'La Libertad', ''),
('America', 'SLV', 'El Salvador', 'San Miguel', ''),
('America', 'SLV', 'El Salvador', 'San Salvador', ''),
('America', 'SLV', 'El Salvador', 'Santa Ana', ''),
('America', 'GTM', 'Guatemala', 'Guatemala', ''),
('America', 'GTM', 'Guatemala', 'Quetzaltenango', ''),
('America', 'HND', 'Honduras', 'Atl', ''),
('America', 'HND', 'Honduras', 'Cort', ''),
('America', 'HND', 'Honduras', 'Distrito Central', ''),
('America', 'MEX', 'Mexico', 'Aguascalientes', ''),
('America', 'MEX', 'Mexico', 'Baja California', ''),
('America', 'MEX', 'Mexico', 'Baja California Sur', ''),
('America', 'MEX', 'Mexico', 'Campeche', ''),
('America', 'MEX', 'Mexico', 'Chiapas', ''),
('America', 'MEX', 'Mexico', 'Chihuahua', ''),
('America', 'MEX', 'Mexico', 'Coahuila de Zaragoza', ''),
('America', 'MEX', 'Mexico', 'Colima', ''),
('America', 'MEX', 'Mexico', 'Colima', 'Armer'),
('America', 'MEX', 'Mexico', 'Colima', 'Colima'),
('America', 'MEX', 'Mexico', 'Colima', 'Comala'),
('America', 'MEX', 'Mexico', 'Colima', 'Coquimatl'),
('America', 'MEX', 'Mexico', 'Colima', 'Cuauht'),
('America', 'MEX', 'Mexico', 'Colima', 'Ixtlahuac'),
('America', 'MEX', 'Mexico', 'Colima', 'Manzanillo'),
('America', 'MEX', 'Mexico', 'Colima', 'Minatitl'),
('America', 'MEX', 'Mexico', 'Colima', 'Tecom'),
('America', 'MEX', 'Mexico', 'Colima', 'Villa de '),
('America', 'MEX', 'Mexico', 'Distrito Federal', ''),
('America', 'MEX', 'Mexico', 'Durango', ''),
('America', 'MEX', 'Mexico', 'Guanajuato', ''),
('America', 'MEX', 'Mexico', 'Guerrero', ''),
('America', 'MEX', 'Mexico', 'Hidalgo', ''),
('America', 'MEX', 'Mexico', 'Jalisco', ''),
('America', 'MEX', 'Mexico', 'M', ''),
('America', 'MEX', 'Mexico', 'Michoac', ''),
('America', 'MEX', 'Mexico', 'Morelos', ''),
('America', 'MEX', 'Mexico', 'Nayarit', ''),
('America', 'MEX', 'Mexico', 'Nuevo Le', ''),
('America', 'MEX', 'Mexico', 'Oaxaca', ''),
('America', 'MEX', 'Mexico', 'Puebla', ''),
('America', 'MEX', 'Mexico', 'Quer', ''),
('America', 'MEX', 'Mexico', 'Quer', ''),
('America', 'MEX', 'Mexico', 'Quintana Roo', ''),
('America', 'MEX', 'Mexico', 'San Luis Potos', ''),
('America', 'MEX', 'Mexico', 'Sinaloa', ''),
('America', 'MEX', 'Mexico', 'Sonora', ''),
('America', 'MEX', 'Mexico', 'Tabasco', ''),
('America', 'MEX', 'Mexico', 'Tamaulipas', ''),
('America', 'MEX', 'Mexico', 'Veracruz', ''),
('America', 'MEX', 'Mexico', 'Yucat', ''),
('America', 'MEX', 'Mexico', 'Zacatecas', ''),
('America', 'NIC', 'Nicaragua', 'Chinandega', ''),
('America', 'NIC', 'Nicaragua', 'Le', ''),
('America', 'NIC', 'Nicaragua', 'Managua', ''),
('America', 'NIC', 'Nicaragua', 'Masaya', ''),
('America', 'PAN', 'Panama', 'Panam', ''),
('America', 'PAN', 'Panama', 'San Miguelito', ''),
('America', 'PER', 'Peru', 'Ancash', ''),
('America', 'PER', 'Peru', 'Arequipa', ''),
('America', 'PER', 'Peru', 'Ayacucho', ''),
('America', 'PER', 'Peru', 'Cajamarca', ''),
('America', 'PER', 'Peru', 'Callao', ''),
('America', 'PER', 'Peru', 'Cusco', ''),
('America', 'PER', 'Peru', 'Huanuco', ''),
('America', 'PER', 'Peru', 'Ica', ''),
('America', 'PER', 'Peru', 'Jun', ''),
('America', 'PER', 'Peru', 'La Libertad', ''),
('America', 'PER', 'Peru', 'Lambayeque', ''),
('America', 'PER', 'Peru', 'Lima', ''),
('America', 'PER', 'Peru', 'Loreto', ''),
('America', 'PER', 'Peru', 'Piura', ''),
('America', 'PER', 'Peru', 'Puno', ''),
('America', 'PER', 'Peru', 'Tacna', ''),
('America', 'PER', 'Peru', 'Ucayali', ''),
('America', 'PRI', 'Puerto Rico', 'Arecibo', ''),
('America', 'PRI', 'Puerto Rico', 'Bayam', ''),
('America', 'PRI', 'Puerto Rico', 'Caguas', ''),
('America', 'PRI', 'Puerto Rico', 'Carolina', ''),
('America', 'PRI', 'Puerto Rico', 'Guaynabo', ''),
('America', 'PRI', 'Puerto Rico', 'Ponce', ''),
('America', 'PRI', 'Puerto Rico', 'San Juan', ''),
('America', 'PRI', 'Puerto Rico', 'Toa Baja', ''),
('America', 'PRY', 'Paraguay', 'Alto Paran', ''),
('America', 'PRY', 'Paraguay', 'Asunci', ''),
('America', 'PRY', 'Paraguay', 'Central', ''),
('America', 'URY', 'Uruguay', 'Montevideo', ''),
('America', 'USA', 'United Situations', 'Alabama', ''),
('America', 'USA', 'United Situations', 'Alaska', ''),
('America', 'USA', 'United Situations', 'Arizona', ''),
('America', 'USA', 'United Situations', 'Arkansas', ''),
('America', 'USA', 'United Situations', 'California', ''),
('America', 'USA', 'United Situations', 'Colorado', ''),
('America', 'USA', 'United Situations', 'Connecticut', ''),
('America', 'USA', 'United Situations', 'District of Columbia', ''),
('America', 'USA', 'United Situations', 'Florida', ''),
('America', 'USA', 'United Situations', 'Georgia', ''),
('America', 'USA', 'United Situations', 'Hawaii', ''),
('America', 'USA', 'United Situations', 'Idaho', ''),
('America', 'USA', 'United Situations', 'Illinois', ''),
('America', 'USA', 'United Situations', 'Indiana', ''),
('America', 'USA', 'United Situations', 'Iowa', ''),
('America', 'USA', 'United Situations', 'Kansas', ''),
('America', 'USA', 'United Situations', 'Kentucky', ''),
('America', 'USA', 'United Situations', 'Louisiana', ''),
('America', 'USA', 'United Situations', 'Maryland', ''),
('America', 'USA', 'United Situations', 'Massachusetts', ''),
('America', 'USA', 'United Situations', 'Michigan', ''),
('America', 'USA', 'United Situations', 'Minnesota', ''),
('America', 'USA', 'United Situations', 'Mississippi', ''),
('America', 'USA', 'United Situations', 'Missouri', ''),
('America', 'USA', 'United Situations', 'Montana', ''),
('America', 'USA', 'United Situations', 'Nebraska', ''),
('America', 'USA', 'United Situations', 'Nevada', ''),
('America', 'USA', 'United Situations', 'New Hampshire', ''),
('America', 'USA', 'United Situations', 'New Jersey', ''),
('America', 'USA', 'United Situations', 'New Mexico', ''),
('America', 'USA', 'United Situations', 'New York', ''),
('America', 'USA', 'United Situations', 'North Carolina', ''),
('America', 'USA', 'United Situations', 'Ohio', ''),
('America', 'USA', 'United Situations', 'Oklahoma', ''),
('America', 'USA', 'United Situations', 'Oregon', ''),
('America', 'USA', 'United Situations', 'Pennsylvania', ''),
('America', 'USA', 'United Situations', 'Rhode Island', ''),
('America', 'USA', 'United Situations', 'South Carolina', ''),
('America', 'USA', 'United Situations', 'South Dakota', ''),
('America', 'USA', 'United Situations', 'Tennessee', ''),
('America', 'USA', 'United Situations', 'Texas', ''),
('America', 'USA', 'United Situations', 'Utah', ''),
('America', 'USA', 'United Situations', 'Virginia', ''),
('America', 'USA', 'United Situations', 'Washington', ''),
('America', 'USA', 'United Situations', 'Wisconsin', ''),
('America', 'VEN', 'Venezuela', 'Anzo', ''),
('America', 'VEN', 'Venezuela', 'Apure', ''),
('America', 'VEN', 'Venezuela', 'Aragua', ''),
('America', 'VEN', 'Venezuela', 'Barinas', ''),
('America', 'VEN', 'Venezuela', 'Bol', ''),
('America', 'VEN', 'Venezuela', 'Carabobo', ''),
('America', 'VEN', 'Venezuela', 'Distrito Federal', ''),
('America', 'VEN', 'Venezuela', 'Falc', ''),
('America', 'VEN', 'Venezuela', 'Gu', ''),
('America', 'VEN', 'Venezuela', 'Lara', ''),
('America', 'VEN', 'Venezuela', 'M', ''),
('America', 'VEN', 'Venezuela', 'Miranda', ''),
('America', 'VEN', 'Venezuela', 'Monagas', ''),
('America', 'VEN', 'Venezuela', 'Portuguesa', ''),
('America', 'VEN', 'Venezuela', 'Sucre', ''),
('America', 'VEN', 'Venezuela', 'T', ''),
('America', 'VEN', 'Venezuela', 'Trujillo', ''),
('America', 'VEN', 'Venezuela', 'Yaracuy', ''),
('America', 'VEN', 'Venezuela', 'Zulia', ''),
('Europe', 'BEL', 'Belgium', 'Antwerpen', ''),
('Europe', 'BEL', 'Belgium', 'Bryssel', ''),
('Europe', 'BEL', 'Belgium', 'East Flanderi', ''),
('Europe', 'BEL', 'Belgium', 'Hainaut', ''),
('Europe', 'BEL', 'Belgium', 'Namur', ''),
('Europe', 'BEL', 'Belgium', 'West Flanderi', ''),
('Europe', 'FRA', 'France', 'Alsace', ''),
('Europe', 'FRA', 'France', 'Aquitaine', ''),
('Europe', 'FRA', 'France', 'Auvergne', ''),
('Europe', 'FRA', 'France', 'Basse-Normandie', ''),
('Europe', 'FRA', 'France', 'Bourgogne', ''),
('Europe', 'FRA', 'France', 'Bretagne', ''),
('Europe', 'FRA', 'France', 'Centre', ''),
('Europe', 'FRA', 'France', 'Limousin', ''),
('Europe', 'FRA', 'France', 'Lorraine', ''),
('Europe', 'FRA', 'France', 'Pays de la Loire', ''),
('Europe', 'FRA', 'France', 'Picardie', ''),
('Europe', 'FRA', 'France', 'Rh', ''),
('Europe', 'DEU', 'Germany', 'Anhalt Sachsen', ''),
('Europe', 'DEU', 'Germany', 'Baijeri', ''),
('Europe', 'DEU', 'Germany', 'Berliini', ''),
('Europe', 'DEU', 'Germany', 'Brandenburg', ''),
('Europe', 'DEU', 'Germany', 'Bremen', ''),
('Europe', 'DEU', 'Germany', 'Hamburg', ''),
('Europe', 'DEU', 'Germany', 'Hessen', ''),
('Europe', 'DEU', 'Germany', 'Mecklenburg-Vorpomme', ''),
('Europe', 'DEU', 'Germany', 'Niedersachsen', ''),
('Europe', 'DEU', 'Germany', 'Nordrhein-Westfalen', ''),
('Europe', 'DEU', 'Germany', 'Rheinland-Pfalz', ''),
('Europe', 'DEU', 'Germany', 'Saarland', ''),
('Europe', 'DEU', 'Germany', 'Saksi', ''),
('Europe', 'DEU', 'Germany', 'Schleswig-Holstein', ''),
('Europe', 'ITA', 'Italy', 'Abruzzit', ''),
('Europe', 'ITA', 'Italy', 'Apulia', ''),
('Europe', 'ITA', 'Italy', 'Calabria', ''),
('Europe', 'ITA', 'Italy', 'Campania', ''),
('Europe', 'ITA', 'Italy', 'Emilia-Romagna', ''),
('Europe', 'ITA', 'Italy', 'Friuli-Venezia Giuli', ''),
('Europe', 'ITA', 'Italy', 'Latium', ''),
('Europe', 'ITA', 'Italy', 'Liguria', ''),
('Europe', 'ITA', 'Italy', 'Lombardia', ''),
('Europe', 'ITA', 'Italy', 'Marche', ''),
('Europe', 'ITA', 'Italy', 'Piemonte', ''),
('Europe', 'ITA', 'Italy', 'Sardinia', ''),
('Europe', 'ITA', 'Italy', 'Sisilia', ''),
('Europe', 'ITA', 'Italy', 'Toscana', ''),
('Europe', 'ITA', 'Italy', 'Umbria', ''),
('Europe', 'ITA', 'Italy', 'Veneto', ''),
('Europe', 'PRT', 'Portugal', 'Braga', ''),
('Europe', 'PRT', 'Portugal', 'Co', ''),
('Europe', 'PRT', 'Portugal', 'Lisboa', ''),
('Europe', 'PRT', 'Portugal', 'Porto', ''),
('Europe', 'ESP', 'Spain', 'Andalusia', ''),
('Europe', 'ESP', 'Spain', 'Aragonia', ''),
('Europe', 'ESP', 'Spain', 'Asturia', ''),
('Europe', 'ESP', 'Spain', 'Balears', ''),
('Europe', 'ESP', 'Spain', 'Baskimaa', ''),
('Europe', 'ESP', 'Spain', 'Canary Islands', ''),
('Europe', 'ESP', 'Spain', 'Cantabria', ''),
('Europe', 'ESP', 'Spain', 'Castilla and Le', ''),
('Europe', 'ESP', 'Spain', 'Extremadura', ''),
('Europe', 'ESP', 'Spain', 'Galicia', ''),
('Europe', 'ESP', 'Spain', 'Katalonia', ''),
('Europe', 'ESP', 'Spain', 'La Rioja', ''),
('Europe', 'ESP', 'Spain', 'Madrid', ''),
('Europe', 'ESP', 'Spain', 'Murcia', ''),
('Europe', 'ESP', 'Spain', 'Navarra', ''),
('Europe', 'ESP', 'Spain', 'Valencia', ''),
('Europe', 'CHE', 'Switzerland', 'Bern', ''),
('Europe', 'CHE', 'Switzerland', 'Geneve', ''),
('Europe', 'CHE', 'Switzerland', 'Vaud', ''),
('Europe', 'GBR', 'United Kingdom', 'England', ''),
('Europe', 'GBR', 'United Kingdom', 'Jersey', ''),
('Europe', 'GBR', 'United Kingdom', 'North Ireland', ''),
('Europe', 'GBR', 'United Kingdom', 'Scotland', ''),
('Europe', 'GBR', 'United Kingdom', 'Wales', ''),
('Oceania', 'AUS', 'Australia', 'Capital Region', ''),
('Oceania', 'AUS', 'Australia', 'New South Wales', ''),
('Oceania', 'AUS', 'Australia', 'Queensland', ''),
('Oceania', 'AUS', 'Australia', 'South Australia', ''),
('Oceania', 'AUS', 'Australia', 'Tasmania', ''),
('Oceania', 'AUS', 'Australia', 'Victoria', ''),
('Oceania', 'AUS', 'Australia', 'West Australia', ''),
('Oceania', 'NZL', 'New Zealand', 'Auckland', ''),
('Oceania', 'NZL', 'New Zealand', 'Canterbury', ''),
('Oceania', 'NZL', 'New Zealand', 'Dunedin', ''),
('Oceania', 'NZL', 'New Zealand', 'Hamilton', ''),
('Oceania', 'NZL', 'New Zealand', 'Wellington', '');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `muu_ads`
--
ALTER TABLE `muu_ads`
  ADD CONSTRAINT `muu_ads_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_blog`
--
ALTER TABLE `muu_blog`
  ADD CONSTRAINT `muu_blog_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_forums_posts`
--
ALTER TABLE `muu_forums_posts`
  ADD CONSTRAINT `muu_forums_posts_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_gallery`
--
ALTER TABLE `muu_gallery`
  ADD CONSTRAINT `muu_gallery_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_logs`
--
ALTER TABLE `muu_logs`
  ADD CONSTRAINT `muu_logs_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_pages`
--
ALTER TABLE `muu_pages`
  ADD CONSTRAINT `muu_pages_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_polls`
--
ALTER TABLE `muu_polls`
  ADD CONSTRAINT `muu_polls_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_polls_answers`
--
ALTER TABLE `muu_polls_answers`
  ADD CONSTRAINT `muu_polls_answers_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_polls_ips`
--
ALTER TABLE `muu_polls_ips`
  ADD CONSTRAINT `muu_polls_ips_ibfk_1` FOREIGN KEY (`ID_Poll`) REFERENCES `muu_polls` (`ID_Poll`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_permissions_privileges`
--
ALTER TABLE `muu_re_permissions_privileges`
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_2` FOREIGN KEY (`ID_Application`) REFERENCES `muu_applications` (`ID_Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_privileges_users`
--
ALTER TABLE `muu_re_privileges_users`
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_support`
--
ALTER TABLE `muu_support`
  ADD CONSTRAINT `muu_support_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_tokens`
--
ALTER TABLE `muu_tokens`
  ADD CONSTRAINT `muu_tokens_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_videos`
--
ALTER TABLE `muu_videos`
  ADD CONSTRAINT `muu_videos_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;
