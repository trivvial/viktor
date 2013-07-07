-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Vygenerované: Št 27.Jún 2013, 06:08
-- Verzia serveru: 5.5.27
-- Verzia PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `kristian`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `bundle`
--

CREATE TABLE IF NOT EXISTS `bundle` (
  `idbundle` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`idbundle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=4 ;

--
-- Sťahujem dáta pre tabuľku `bundle`
--

INSERT INTO `bundle` (`idbundle`, `name`) VALUES
(1, 'lprs-student'),
(2, 'lprs-ucitel'),
(3, 'tar-vsetky');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `combo`
--

CREATE TABLE IF NOT EXISTS `combo` (
  `idcombo` int(5) NOT NULL AUTO_INCREMENT,
  `cidbundle` int(3) NOT NULL,
  `cidprogram` int(3) NOT NULL,
  PRIMARY KEY (`idcombo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=70 ;

--
-- Sťahujem dáta pre tabuľku `combo`
--

INSERT INTO `combo` (`idcombo`, `cidbundle`, `cidprogram`) VALUES
(57, 1, 6),
(58, 1, 7),
(59, 1, 8),
(60, 3, 1),
(61, 3, 2),
(62, 3, 3),
(63, 3, 4),
(64, 3, 5),
(65, 3, 6),
(66, 3, 7),
(67, 3, 8),
(68, 3, 9),
(69, 3, 10);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `confs`
--

CREATE TABLE IF NOT EXISTS `confs` (
  `idconf` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `content` mediumtext COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`idconf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=14 ;

--
-- Sťahujem dáta pre tabuľku `confs`
--

INSERT INTO `confs` (`idconf`, `name`, `content`) VALUES
(6, 'tftpd-hpa', 'TFTP_USERNAME="tftp"\r\nTFTP_DIRECTORY="/srv/unattended/tftp"\r\nTFTP_ADDRESS="0.0.0.0:69"\r\nTFTP_OPTIONS="--secure"'),
(7, 'isc-dhcpd3', 'option domain-name "tuke.sk";\r\n\r\ndefault-lease-time 6048;\r\nmax-lease-time 604800;\r\n\r\nallow booting;\r\nallow bootp;\r\n\r\nsubnet 192.168.254.0 netmask 255.255.255.0 {\r\n  range 192.168.254.10 192.168.254.253;\r\n  option subnet-mask 255.255.255.0;\r\n  option broadcast-address 192.168.254.255;\r\n  option routers 192.168.254.1;\r\n  option domain-name-servers 192.168.254.3;\r\n  next-server 192.168.254.4;\r\n  filename "/pxelinux.0";\r\n}\r\n'),
(8, 'samba', '[global]\r\n  workgroup = URIVP\r\n  server string = %h install server (Samba, Ubuntu)\r\n  dns proxy = no\r\n  log file = /var/log/samba/log.%m\r\n  max log size = 1000\r\n  syslog = 0\r\n  panic action = /usr/share/samba/panic-action %d\r\n  security = user\r\n  encrypt passwords = true\r\n  passdb backend = tdbsam\r\n  obey pam restrictions = no\r\n  unix password sync = no\r\n  map to guest = nobody\r\n  socket options = TCP_NODELAY SO_RCVBUF=8192 SO_SNDBUF=8192\r\n  guest account = guest\r\n\r\n[install]\r\n  comment  = Unattended install root directory\r\n  writable = no\r\n  locking  = no\r\n  path     = /srv/unattended/install\r\n  guest ok = yes'),
(9, 'pxelinux', 'default vesamenu.c32\r\nprompt 0\r\n\r\nmenu title PXE Boot menu\r\nmenu include pxelinux.cfg/graphics.conf\r\nmenu autoboot Starting Local System in # seconds\r\n\r\nlabel bootlocal\r\n  menu label ^Boot from local resources\r\n  menu default\r\n  localboot 0\r\n  timeout 80\r\n  totaltimeout 9000\r\n\r\nlabel tools\r\n  menu label ^Tools >\r\n  kernel vesamenu.c32\r\n  append pxelinux.cfg/graphics.conf pxelinux.cfg/tools.menu\r\n\r\nlabel setup\r\n  menu label ^Setup >\r\n  kernel vesamenu.c32\r\n  append pxelinux.cfg/graphics.conf pxelinux.cfg/setup.menu'),
(10, 'graphics.conf', 'menu color tabmsg 37;40\r\nmenu color hotsel 30;47\r\nmenu color sel 30;47\r\nmenu color scrollbar 30;47\r\n\r\nMENU MASTER PASSWD pass\r\nMENU WIDTH 80\r\nMENU MARGIN 22\r\nMENU PASSWORDMARGIN 26\r\nMENU ROWS 6\r\nMENU TABMSGROW 15\r\nMENU CMDLINEROW 15\r\nMENU ENDROW 24\r\nMENU PASSWORDROW 12\r\nMENU TIMEOUTROW 13\r\nMENU VSHIFT 6\r\nMENU PASSPROMPT Enter Password:\r\n\r\n#TEST \r\nNOESCAPE 0\r\nALLOWOPTIONS 1'),
(11, 'setup.menu', 'menu title Setup\r\n\r\nlabel main\r\n  menu label < ^Return to Main Menu\r\n  kernel vesamenu.c32\r\n  append pxelinux.cfg/default\r\n\r\n label windows\r\n  menu label ^Start Windows installation\r\n  kernel startrom.0'),
(12, 'tools.menu', 'menu title Tools\r\n \r\nlabel main\r\n  menu label < ^Return to Main Menu\r\n  kernel vesamenu.c32\r\n  append pxelinux.cfg/default\r\n\r\nlabel memtest\r\n  menu label ^Memory Test: Memtest86+ v4.20\r\n  kernel memtest/memtest.x86\r\n\r\nlabel hirens\r\n  menu label Hiren''s Boot CD\r\n  kernel memdisk\r\n  append iso initrd=iso/MyHirensBootCD.iso raw'),
(13, 'winnt.sif', '[SetupData]\r\nBootDevice = "ramdisk(0)"\r\nBootPath = "i386System32"\r\nOsLoadOptions = "/noguiboot /fastdetect /minint /rdexportascd /rdpath=bartpe.iso"');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `idimage` int(3) NOT NULL AUTO_INCREMENT,
  `imagename` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `imagetype` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`idimage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=11 ;

--
-- Sťahujem dáta pre tabuľku `images`
--

INSERT INTO `images` (`idimage`, `imagename`, `imagetype`, `path`) VALUES
(1, 'Windows pak 6', 'windows(x86)', 'C:\\xampp\\htdocs\\viktor'),
(2, 'Linux pak 3', 'linux(x64)', 'C:\\xampp\\htdocs\\peter'),
(3, 'Solaris pak 2', 'solaris(x86)', 'C:\\xampp\\htdocs\\milan'),
(4, 'Solaris pak 1', 'solaris(x64)', 'C:\\xampp\\htdocs\\viktor'),
(5, 'Linux pak 2', 'linux(x86)', 'C:\\xampp\\htdocs\\viktor'),
(6, 'Windows pak 7', 'windows(x64)', 'C:\\xampp\\htdocs\\fero'),
(8, 'Linux pak 4', 'linux(x86)', 'C:\\xampp\\htdocs\\viktor'),
(9, 'Linux pak 1', 'linux(x86)', 'C:\\\\xampp\\\\htdocs\\\\viktor'),
(10, 'Windows pak 8', 'windows(x86)', 'C:\\\\xampp\\\\htdocs\\\\viktor');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `idlang` int(3) NOT NULL AUTO_INCREMENT,
  `language` varchar(3) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`idlang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=3 ;

--
-- Sťahujem dáta pre tabuľku `lang`
--

INSERT INTO `lang` (`idlang`, `language`) VALUES
(1, 'enu'),
(2, 'csy');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `machines`
--

CREATE TABLE IF NOT EXISTS `machines` (
  `idmachine` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_slovak_ci NOT NULL,
  `mac` varchar(12) COLLATE utf8_slovak_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `os` int(3) NOT NULL,
  `bundle` int(3) NOT NULL,
  PRIMARY KEY (`idmachine`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=10 ;

--
-- Sťahujem dáta pre tabuľku `machines`
--

INSERT INTO `machines` (`idmachine`, `name`, `mac`, `ip`, `os`, `bundle`) VALUES
(1, 'lprs-pc4', '000158462581', '192.168.1.0', 2, 1),
(3, 'lprs-pc3', '001200120013', '192.168.35.0', 2, 1),
(4, 'lprs-pc1', '080027187ec3', '192.168.254.10', 1, 1),
(5, 'lprs-pc5', '004825716845', '192.168.4.6', 1, 1),
(6, 'lprs-pc6', '001200120015', '192.168.3.0', 2, 1),
(7, 'lprs-pc2', '080027187ec8', '192.168.254.11', 2, 2),
(8, 'lprs-pc7', '001200120015', '192.168.35.3', 2, 2),
(9, 'lprs-pcAdmin', '001200120022', '192.168.35.110', 1, 3);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `os`
--

CREATE TABLE IF NOT EXISTS `os` (
  `idos` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `inspallpath` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  `lang` int(3) NOT NULL,
  PRIMARY KEY (`idos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=3 ;

--
-- Sťahujem dáta pre tabuľku `os`
--

INSERT INTO `os` (`idos`, `name`, `inspallpath`, `lang`) VALUES
(1, 'winxp_sp3', 'os/winxp_sp3_enu', 1),
(2, 'winxp_sp2', 'os/winxp_sp2_csy', 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `idprogram` int(3) NOT NULL AUTO_INCREMENT,
  `program` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `installpath` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`idprogram`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=11 ;

--
-- Sťahujem dáta pre tabuľku `programs`
--

INSERT INTO `programs` (`idprogram`, `program`, `installpath`) VALUES
(1, 'dotnet11', 'app/dotnet11'),
(2, 'dotnet35', 'app/dotnet35'),
(3, 'dotnet40', 'app/dotnet40'),
(4, 'ie8', 'app/ie8'),
(5, '7zip_9.20', 'app/7zip_9.20'),
(6, 'jre_7u17', 'app/jre_7u17'),
(7, 'libreoffice_4.0.1.2', 'app/libreoffice_4.0.1.2'),
(8, 'vlc_2.0.5', 'app/vlc_2.0.5'),
(9, 'promotic8', 'app/promotic8'),
(10, 'eagle3.0', 'app/eagle3.0');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_slovak_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`iduser`, `username`, `password`) VALUES
(1, 'vkristi', '81dc9bdb52d04dc20036dbd8313ed055');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
