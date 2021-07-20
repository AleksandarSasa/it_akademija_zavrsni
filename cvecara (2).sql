-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 02:40 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvecara`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazivKategorije` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `nazivKategorije`) VALUES
(1, 'Hrizanteme'),
(2, 'Orhideje'),
(3, 'Ruže'),
(4, 'Sobne biljke'),
(5, 'Tulipani');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(5) UNSIGNED NOT NULL,
  `proizvodID` int(10) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `komentar` text NOT NULL,
  `vremeDodavanja` timestamp NOT NULL DEFAULT current_timestamp(),
  `odobren` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `proizvodID`, `ime`, `komentar`, `vremeDodavanja`, `odobren`) VALUES
(7, 16, 'Aleksandar', 'asdsadasda', '2021-07-17 11:24:17', 1),
(13, 29, 'Aleksandar', 'Bas je kul ova sobna biljka imam je u sobi', '2021-07-19 20:43:25', 1),
(14, 28, 'Aleksandar', 'Ovaj proizvod je strava!', '2021-07-19 23:14:42', 0),
(15, 27, 'Pera', 'Preskupo!!', '2021-07-19 23:15:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(10) UNSIGNED NOT NULL,
  `korisnikID` int(5) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `poruka` text NOT NULL,
  `vremePoruke` timestamp NOT NULL DEFAULT current_timestamp(),
  `odgovor` text DEFAULT NULL,
  `vremeOdgovora` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`id`, `korisnikID`, `email`, `poruka`, `vremePoruke`, `odgovor`, `vremeOdgovora`) VALUES
(1, NULL, 'moj@email.com', 'y', '2021-07-17 11:59:59', 'yyyyyyyyyy', '2021-07-17 13:09:18'),
(2, NULL, 'jajaj@live.com', 'sasasa', '2021-07-17 12:09:35', ';;;;;;;', '2021-07-17 13:09:00'),
(3, 3, 'peric@cvecara.com', 'tttttttttt', '2021-07-17 12:09:50', 'Odgovor na pitanje', '2021-07-19 20:07:18'),
(19, 2, 'stolic@cvecara.com', 'Moze li odgovor na ovo pitanje', '2021-07-17 13:41:40', 'Evo moze odgovorio sam', '2021-07-19 20:44:01'),
(20, 2, 'stolic@cvecara.com', 'Kontaktiranje administracije', '2021-07-17 13:49:36', 'Odgovor na stoletovo kontaktiranje', '2021-07-17 13:52:54'),
(21, 3, 'peric@cvecara.com', 'Pozdrav, zanima me da li se moze poruciti online?', '2021-07-19 20:29:22', NULL, NULL),
(22, NULL, 'struja@mail.com', 'alert(&#39;aaa&#39;)', '2021-07-20 00:33:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(10) UNSIGNED NOT NULL,
  `ime` varchar(40) NOT NULL,
  `prezime` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lozinka` varchar(256) NOT NULL,
  `status` enum('Admin','urednik','korisnik') NOT NULL,
  `aktivan` int(1) NOT NULL DEFAULT 1,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `email`, `lozinka`, `status`, `aktivan`, `vreme`) VALUES
(1, 'Aleksandar', 'Marinkovic', 'marinkovic@cvecara.com', 'amarinkovic', 'Admin', 1, '2021-06-14 14:27:38'),
(2, 'Stole', 'Stolic', 'stolic@cvecara.com', 'sstolic', 'urednik', 1, '2021-06-14 14:28:53'),
(3, 'Pera', 'Peric', 'peric@cvecara.com', 'pperic', 'korisnik', 1, '2021-06-14 14:29:29'),
(4, 'Milan', 'Psiho', 'psiho@cvecara.com', 'mpsiho', 'korisnik', 1, '2021-06-15 13:10:58'),
(5, 'Slobodan', 'Petronijevic', 'petronijevic@cvecara.com', 'spetronijevic', 'korisnik', 1, '2021-07-14 15:14:01'),
(33, 'Milica', 'Dabovic', 'dabovic@cvecara.com', 'jasammilica', 'korisnik', 1, '2021-07-19 20:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id` int(5) UNSIGNED NOT NULL,
  `korisnikID` int(5) NOT NULL,
  `proizvodID` int(5) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `vremeKupovine` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `kupljen` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id`, `korisnikID`, `proizvodID`, `vreme`, `vremeKupovine`, `kupljen`) VALUES
(1, 1, 16, '2021-07-19 17:21:34', '2021-07-19 18:21:06', 1),
(4, 1, 1, '2021-07-19 18:20:48', '2021-07-19 18:21:58', 1),
(6, 1, 19, '2021-07-19 18:31:08', '2021-07-19 18:31:30', 1),
(8, 1, 9, '2021-07-19 18:35:08', '2021-07-19 18:37:53', 1),
(9, 1, 2, '2021-07-19 18:37:49', '2021-07-19 18:37:53', 1),
(17, 3, 21, '2021-07-19 20:28:32', '2021-07-19 20:28:39', 1),
(18, 3, 5, '2021-07-19 20:28:44', '2021-07-19 20:28:50', 1),
(19, 3, 9, '2021-07-19 20:28:47', '2021-07-19 20:28:50', 1),
(20, 2, 29, '2021-07-19 20:49:12', '2021-07-19 20:49:23', 1),
(21, 2, 24, '2021-07-19 20:49:16', '2021-07-19 20:49:25', 1),
(22, 2, 28, '2021-07-19 20:49:20', '2021-07-19 20:49:25', 1),
(23, 1, 29, '2021-07-19 23:50:29', NULL, 0),
(24, 1, 25, '2021-07-19 23:50:35', NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `korpaview`
-- (See below for the actual view)
--
CREATE TABLE `korpaview` (
`id` int(5) unsigned
,`korisnikID` int(5)
,`proizvodID` int(5)
,`vreme` timestamp
,`vremeKupovine` timestamp
,`kupljen` int(1)
,`naslov` varchar(50)
,`cena` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(10) UNSIGNED NOT NULL,
  `naslov` varchar(50) NOT NULL,
  `tekst` text NOT NULL,
  `kategorijaID` int(10) UNSIGNED NOT NULL,
  `autorID` int(10) UNSIGNED NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `obrisan` int(1) NOT NULL DEFAULT 0,
  `vremeDodavanja` timestamp NOT NULL DEFAULT current_timestamp(),
  `vremeIzmene` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naslov`, `tekst`, `kategorijaID`, `autorID`, `cena`, `obrisan`, `vremeDodavanja`, `vremeIzmene`) VALUES
(4, 'Zuta tratincica', 'Bela rada ili tratincica je zuti cvijet sa belim imenom', 1, 2, '25.00', 1, '2021-06-15 12:42:29', '2021-07-19 20:52:16'),
(5, 'Trajna Biljka Sobna', 'Биљке рода адама су зељасте вишегодишње геофите, са подземним стаблом у виду ризома или кртоле. Листови су са широком и великом лисном плочом, која достиже дужину и до 90 cm. Облик лисне плоче је срцаст или копљаст. Цваст је грађена типично за фамилију козлаца — клип (спадикс) са спатом. Спата је беле до беж боје. У доњем делу цвасти налазе се женски цветови, изнад којих се налазе стерилни мушки цветови (са стаминодијама уместо прашника), а изнад њих се налазе фертилни мушки цветови', 2, 2, '55.00', 0, '2021-06-15 12:42:29', '2021-07-19 20:52:22'),
(9, 'Ljubicasta Visibaba', 'Obična visibaba (lat. Galanthus nivalis), trajnica u rodu visibaba, porodica zvanikovki. Jedna je od dviju vrsta visibaba koja raste u Hrvatskoj. Raširena je po cijeloj Europi, osim što je naturalizirana po Skandinaviji, Belgiji, otoku Velika Britanija i Nizozemskoj.', 2, 2, '22.00', 1, '2021-06-15 13:04:52', '2021-07-19 20:32:00'),
(21, 'Orhideja Pink', 'Orhideje (Kaćunovke, lat. Orchidaceae) naziv se sve biljke iz porodice Orchidaceae. Cijela porodica je dobila ime po dva gomoljasta korijena koja oblikom podsjećaju na mošnje (grčki όρχις „mošnje“). Nakon porodice Asteraceae, orhideje su druga po veličini porodica Anthophyta. Smatra ih se posebno lijepim, i za mnoge je orhideja kraljica cvijeća. Botaničari priznaju oko 1.000 rodova s 15.000 do 30.000 vrsta. Nema ih jedino na arktičkom ledu i pustinjama.', 2, 1, '16.00', 0, '2021-07-19 20:06:51', '2021-07-19 20:17:58'),
(22, 'Hrizantema Crvena', 'Baštenske hrizanteme (jesenje ruže) zahtevaju dosta prostora, pa ih treba saditi na rastojanju oko 40 cm. Lepe su pojedinačno i u grupi. Efektne su i u kombinaciji sa drugim biljkama, naročito onim zimzelenim, što vrtu daje efektan zimski izgled.\r\nVole položaj na sunčanom mestu. Prilikom izbora mesta, moramo uzeti u obzir da će prilikom njihovog cvetanja (u jesen), već biti veće senke. Mesto treba da je osunčano i u septembru i oktobru.', 1, 2, '9.99', 0, '2021-07-19 20:31:33', NULL),
(23, 'Orhideja  leptir', 'Noćni leptir (moljac orhideje; lat. Phalaenopsis), rod orhideja iz Azije, dio je podtribusa Aeridinae. Latinsko ime roda dolazi iz grčke riječi phalaina, noćni leptir i opsis, liči, prema obliku cvjetova sličnih krilima velikog leptira.\r\nPostoje 74 vrste raširene od Himalaja i Indije na istok do Kine, Koreje i Japana i na jug do Queenslanda, uključujući i velike otoke Borneo, Sumatra i Nova Gvineja.[1]', 2, 2, '50.00', 0, '2021-07-19 20:33:45', NULL),
(24, 'Crvene ruze buket', 'Ruža (lat. Rosa) je rod zeljastih biljaka iz porodice ruža (Rosaceae). Uzgaja se zbog lepih mirisnih cvetova i do danas postoje mnogi hibridi i kultivari ruža koji se međusobno razlikuju po boji i izgledu cveta, mirisu i postojanju trnova. Postoji veliki broj divljih ruža, čiji se plod (šipak, šipurak) bogat vitaminom C koristi u ishrani i za pripremu čajeva. Od oko 100 vrsta roda ruža u Srbiji raste dvadesetak.', 3, 2, '17.00', 0, '2021-07-19 20:34:49', NULL),
(25, 'Crvene ruze buket XL', 'Kod nas najviše raznih samoniklih ruža raste na Dinarskom kršu, gdje je poznato blizu stotinu raznih vrsta, podvrsta i divljih križanaca iz roda Rosa [1]. Desetak njih su isključivi endemi koji rastu samo na našem kršu, a te su uglavnom iznimno dekorativne i otporne biljke koje uspjevaju na suhim kamenjarama: na Dinarskim planinama su to Rosa dinarica (cvijet ružičast), R. dalmatica (mliječnobijela), R. malyi (tamna krvavo-grimizna), R. portenschlagiana (svjetlocrvena), te uz Jadran još R. liburnica (bijela), R. istriaca (ružičasta), itd.', 3, 1, '22.00', 0, '2021-07-19 20:37:11', NULL),
(26, 'Anthurium sobna', 'iljka je poznata pod nazivima anturijum, flamingov cvet jer svojim izgledom podseća na ovu pticu, plamenac zbog česte vatrene boje cveta i dr. Pripada porodici Araceae. Rod obuhvata oko 1000 vrsta biljaka čiji su areal vlažna tropska područja, prašume Srednje i Južne Amerike, tačnije severni delovi Meksika, Argentine i neki delovi Kariba. Raste kao epifit ili poluepifit, u pukotinama stena ili na plitkom, skeletnom, krečnjačkom zemljištu.', 4, 1, '9.99', 0, '2021-07-19 20:38:30', NULL),
(27, 'Tulipani crveni', 'Tulipan (giljika, kološ, lipuškin, lat. Tulipa), je rod od oko 150 biljaka u porodici ljiljana (lat. Liliaceae)[1]. Područje odakle potječu vrste uključuje jug Europe, sjever Afrike, te Aziju, tj. područja Anatolije i Irana, a najveći broj vrsta potječe iz stepa Kazahstana i okolice planina Pamira i Hindukuša. Danas je većina vrsta uzgojena križanjem, a većina dolazi od vrste Tulipa gesneriana.', 5, 1, '15.00', 0, '2021-07-19 20:39:40', NULL),
(28, 'Tulipani visebojni', 'Tulipan je biljka koja ima lukovicu (geofita) koja je kruškolikog oblika, zaobljena s jedne strane, a s druge spljoštena. Dobio je ime posredstvom turskog naziva tülbent koji se temelji na perzijskoj riječi turban. Iz lukovice raste niska biljka, visine između 10 i 70 cm. Najčešće ima 2-6 listova (pojedine vrste imaju do 12 listova), zelene ili blijedozelene boje, dosta širokih, prema vrhu zašiljenih, donekle mesnatih. ', 5, 1, '18.00', 0, '2021-07-19 20:40:36', '2021-07-19 20:40:56'),
(29, 'Rosella sobna', 'Sobna biljka je biljka koja se uzgaja u zatvorenom na mjestima kao što su prebivališta i uredi , naime u dekorativne svrhe, ali studije su također pokazale da imaju pozitivne psihološke učinke, kao i pomažu u pročišćavanju zraka u zatvorenom, jer neke vrste i mikrobi koji žive u tlu povezani s njima, smanjuju onečišćenje zraka upijanjem hlapljivih organskih spojeva , uključujući benzen , formaldehid i trikloroetilen .', 4, 1, '25.00', 0, '2021-07-19 20:43:01', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `proizvodiview`
-- (See below for the actual view)
--
CREATE TABLE `proizvodiview` (
`id` int(10) unsigned
,`naslov` varchar(50)
,`tekst` text
,`kategorijaID` int(10) unsigned
,`autorID` int(10) unsigned
,`cena` decimal(10,2)
,`obrisan` int(1)
,`vremeDodavanja` timestamp
,`ime` varchar(40)
,`prezime` varchar(40)
,`nazivKategorije` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `slikeproizvoda`
--

CREATE TABLE `slikeproizvoda` (
  `id` int(10) UNSIGNED NOT NULL,
  `proizvodID` int(10) NOT NULL,
  `imeSlike` varchar(100) NOT NULL,
  `vremeDodavanja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slikeproizvoda`
--

INSERT INTO `slikeproizvoda` (`id`, `proizvodID`, `imeSlike`, `vremeDodavanja`) VALUES
(1, 16, '1626470943.6061.jpg', '2021-07-16 21:29:03'),
(2, 16, '1626470943.6175.jpg', '2021-07-16 21:29:03'),
(3, 16, '1626470943.628.jpg', '2021-07-16 21:29:03'),
(4, 16, '1626470943.6403.jpg', '2021-07-16 21:29:03'),
(5, 19, '1626471991.7322.jpg', '2021-07-16 21:46:31'),
(6, 19, '1626471991.7368.jpg', '2021-07-16 21:46:31'),
(7, 19, '1626471991.7498.jpg', '2021-07-16 21:46:31'),
(8, 21, '1626725211.3083.jpg', '2021-07-19 20:06:51'),
(9, 21, '1626725211.3132.jpg', '2021-07-19 20:06:51'),
(10, 21, '1626725211.3234.jpg', '2021-07-19 20:06:51'),
(11, 22, '1626726693.476.jpg', '2021-07-19 20:31:33'),
(12, 22, '1626726693.4812.jpg', '2021-07-19 20:31:33'),
(13, 22, '1626726693.4857.jpg', '2021-07-19 20:31:33'),
(14, 23, '1626726825.0316.jpg', '2021-07-19 20:33:45'),
(15, 23, '1626726825.0365.jpg', '2021-07-19 20:33:45'),
(16, 23, '1626726825.0413.jpg', '2021-07-19 20:33:45'),
(17, 23, '1626726825.0471.jpg', '2021-07-19 20:33:45'),
(18, 23, '1626726825.0527.jpg', '2021-07-19 20:33:45'),
(19, 24, '1626726889.4221.jpg', '2021-07-19 20:34:49'),
(20, 24, '1626726889.4317.jpg', '2021-07-19 20:34:49'),
(21, 25, '1626727031.4749.jpg', '2021-07-19 20:37:11'),
(22, 25, '1626727031.4798.jpg', '2021-07-19 20:37:11'),
(23, 25, '1626727031.4844.jpg', '2021-07-19 20:37:11'),
(24, 25, '1626727031.4901.jpg', '2021-07-19 20:37:11'),
(25, 26, '1626727110.9396.jpg', '2021-07-19 20:38:30'),
(26, 26, '1626727110.9439.jpg', '2021-07-19 20:38:30'),
(27, 26, '1626727110.9496.jpg', '2021-07-19 20:38:30'),
(28, 26, '1626727110.9553.jpg', '2021-07-19 20:38:30'),
(29, 27, '1626727180.0805.jpg', '2021-07-19 20:39:40'),
(30, 27, '1626727180.0896.jpg', '2021-07-19 20:39:40'),
(31, 27, '1626727180.1012.jpg', '2021-07-19 20:39:40'),
(32, 29, '1626727381.8828.jpg', '2021-07-19 20:43:01'),
(33, 29, '1626727381.8953.jpg', '2021-07-19 20:43:01'),
(34, 29, '1626727381.8993.jpg', '2021-07-19 20:43:01');

-- --------------------------------------------------------

--
-- Structure for view `korpaview`
--
DROP TABLE IF EXISTS `korpaview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `korpaview`  AS SELECT `korpa`.`id` AS `id`, `korpa`.`korisnikID` AS `korisnikID`, `korpa`.`proizvodID` AS `proizvodID`, `korpa`.`vreme` AS `vreme`, `korpa`.`vremeKupovine` AS `vremeKupovine`, `korpa`.`kupljen` AS `kupljen`, `proizvodi`.`naslov` AS `naslov`, `proizvodi`.`cena` AS `cena` FROM (`korpa` join `proizvodi` on(`korpa`.`proizvodID` = `proizvodi`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `proizvodiview`
--
DROP TABLE IF EXISTS `proizvodiview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proizvodiview`  AS SELECT `proizvodi`.`id` AS `id`, `proizvodi`.`naslov` AS `naslov`, `proizvodi`.`tekst` AS `tekst`, `proizvodi`.`kategorijaID` AS `kategorijaID`, `proizvodi`.`autorID` AS `autorID`, `proizvodi`.`cena` AS `cena`, `proizvodi`.`obrisan` AS `obrisan`, `proizvodi`.`vremeDodavanja` AS `vremeDodavanja`, `korisnici`.`ime` AS `ime`, `korisnici`.`prezime` AS `prezime`, `kategorije`.`nazivKategorije` AS `nazivKategorije` FROM ((`proizvodi` join `korisnici` on(`proizvodi`.`autorID` = `korisnici`.`id`)) join `kategorije` on(`proizvodi`.`kategorijaID` = `kategorije`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnikID` (`korisnikID`),
  ADD KEY `proizvodID` (`proizvodID`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorijaID` (`kategorijaID`),
  ADD KEY `autorID` (`autorID`);

--
-- Indexes for table `slikeproizvoda`
--
ALTER TABLE `slikeproizvoda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `slikeproizvoda`
--
ALTER TABLE `slikeproizvoda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_3` FOREIGN KEY (`autorID`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proizvodi_ibfk_4` FOREIGN KEY (`kategorijaID`) REFERENCES `kategorije` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
