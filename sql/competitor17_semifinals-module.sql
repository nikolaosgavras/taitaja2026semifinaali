-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: competitor_mysql:3306
-- Generation Time: Jan 29, 2026 at 07:17 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `competitor17_semifinals-module`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `name`, `email`, `address`, `phone_number`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, 'Testi', 'Testi@testi.com', 'fksfsdfkl 3', '13133123123', '$2y$10$oAIJ8nUjyULRjJIys1BMk.LILCyuo67Hk4KzT3Jct0OYYuWUY2X0e', '2026-01-29 12:58:30', '2026-01-29 12:58:30'),
(2, 'testi2', 'testi2@testi.com', 'fxghjklhfg 6', '3456789087654', '$2y$10$SJK89GJ.0vi/c3QPgCEVoeACSDkhTtn25e6y5P9QcknrwDHNhTb7O', '2026-01-29 13:37:11', '2026-01-29 13:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short_description` varchar(280) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `long_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_id` int NOT NULL,
  `thumbnail_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `picture_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `short_description`, `long_description`, `location`, `status_id`, `thumbnail_url`, `picture_url`, `created`, `updated`) VALUES
(1, 'Asemakaavan muutos Rantarinne', 'Asemakaavan muutos, joka mahdollistaa maltillisen täydennysrakentamisen alueella.', 'Asemakaavan muutoksella tarkistetaan Rantarinteen alueen rakennusoikeuksia ja tonttijakoa. Tavoitteena on mahdollistaa pientalorakentamisen kehittäminen alueen luonne ja ympäristöarvot huomioiden. Samalla parannetaan liikennejärjestelyjä ja kevyen liikenteen yhteyksiä.', 'Koivula, Rantarinne', 5, 'https://public.bc.fi/jarla/semifinal/thumbnail_1.jpg', 'https://public.bc.fi/jarla/semifinal/plan_1.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(2, 'Asemakaavan muutos Pihlajamäki', 'Kaavamuutos asuinalueen ja virkistysalueiden yhteensovittamiseksi.', 'Pihlajamäen asemakaavan muutoksessa tarkastellaan asuinrakentamisen laajentamista Metsäjärven läheisyydessä. Suunnittelussa huomioidaan järvimaisema, viheryhteydet sekä alueen virkistyskäyttö. Kaava tukee kestävää ja viihtyisää asumista.', 'Metsäjärvi, Pihlajamäki', 5, 'https://public.bc.fi/jarla/semifinal/thumbnail_2.jpg', 'https://public.bc.fi/jarla/semifinal/plan_2.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(3, 'Asemakaavan muutos Vanhamylly', 'Vanhan teollisuusalueen kaavallinen uudistaminen asumiskäyttöön.', 'Vanhamyllyn alueella asemakaavaa muutetaan siten, että entinen teollisuuskäyttö mahdollistaa jatkossa asumisen ja palveluiden sijoittumisen. Kaavatyössä huomioidaan alueen kulttuurihistorialliset arvot sekä ranta-alueen maisema.', 'Kallioranta, Vanhamylly', 2, 'https://public.bc.fi/jarla/semifinal/thumbnail_3.jpg', 'https://public.bc.fi/jarla/semifinal/plan_3.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(4, 'Asemakaavan muutos Harjukylä', 'Kaavamuutos, joka selkeyttää alueen katu- ja tonttirakennetta.', 'Harjukylän asemakaavan muutoksella päivitetään katualueiden linjauksia ja tonttien rajoja. Tavoitteena on parantaa liikenneturvallisuutta, erityisesti kevyen liikenteen osalta, sekä mahdollistaa nykyaikaisemmat rakennusratkaisut.', 'Tuulensuu, Harjukylä', 6, 'https://public.bc.fi/jarla/semifinal/thumbnail_4.jpg', 'https://public.bc.fi/jarla/semifinal/plan_4.png', '2026-01-10 08:00:00', '2026-01-27 19:52:56'),
(5, 'Asemakaavan muutos Siltapelto', 'Täydennysrakentamista olemassa olevalle pientaloalueelle.', 'Siltapellon kaavamuutos koskee nykyistä pientaloaluetta, jossa tutkitaan mahdollisuuksia lisärakentamiseen. Suunnittelussa huomioidaan alueen mittakaava, viherrakenne sekä olemassa oleva rakennuskanta.', 'Jokivaara, Siltapelto', 2, 'https://public.bc.fi/jarla/semifinal/thumbnail_5.jpg', 'https://public.bc.fi/jarla/semifinal/plan_5.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(6, 'Asemakaavan muutos Lehtolaakso', 'Ranta-alueen kaavamuutos asumisen ja virkistyksen kehittämiseksi.', 'Lehtolaakson asemakaavan muutoksessa tarkastellaan ranta-alueen maankäyttöä ja rakentamisen sijoittumista. Tavoitteena on säilyttää alueen luonnonläheinen ilme ja parantaa rannan saavutettavuutta asukkaille.', 'Hopeaniemi, Lehtolaakso', 5, 'https://public.bc.fi/jarla/semifinal/thumbnail_6.jpg', 'https://public.bc.fi/jarla/semifinal/plan_6.png', '2026-01-10 08:00:00', '2026-01-27 19:52:56'),
(7, 'Asemakaavan muutos Keskusta', 'Keskusta-alueen kaavamuutos palveluiden ja asumisen kehittämiseksi.', 'Pohjankallion keskustan asemakaavan muutos mahdollistaa asumisen, liike- ja palvelutilojen joustavamman sijoittumisen. Kaavalla pyritään vahvistamaan keskustan elinvoimaa ja kaupunkikuvallista laatua.', 'Pohjankallio, Keskusta', 1, 'https://public.bc.fi/jarla/semifinal/thumbnail_7.jpg', 'https://public.bc.fi/jarla/semifinal/plan_7.png', '2026-01-10 08:00:00', '2026-01-27 19:52:56'),
(8, 'Asemakaavan muutos Tervahauta', 'Kaavamuutos, jossa huomioidaan alueen historialliset kohteet.', 'Tervahaudan alueen asemakaavan muutoksessa yhdistetään uusi rakentaminen ja alueen historialliset arvot. Suunnittelussa huomioidaan muinaisjäännökset, maisema sekä alueen käyttö virkistykseen ja asumiseen.', 'Lintukoski, Tervahauta', 3, 'https://public.bc.fi/jarla/semifinal/thumbnail_8.jpg', 'https://public.bc.fi/jarla/semifinal/plan_8.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(9, 'Asemakaavan muutos Kaislaranta', 'Ranta-alueen kaavamuutos pientalorakentamista varten.', 'Kaislarannan asemakaavan muutos mahdollistaa uuden pientalorakentamisen Saarimäen alueelle. Kaavatyössä painotetaan ranta-alueen maisemallisia arvoja, tulvariskien hallintaa ja viihtyisää asuinympäristöä.', 'Saarimäki, Kaislaranta', 2, 'https://public.bc.fi/jarla/semifinal/thumbnail_9.jpg', 'https://public.bc.fi/jarla/semifinal/plan_9.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(10, 'Asemakaavan muutos Kuusiharju', 'Kaavamuutos, joka tukee alueen hallittua kasvua.', 'Kuusiharjun asemakaavan muutoksessa tarkistetaan rakennusoikeuksia ja katuverkkoa. Tavoitteena on mahdollistaa alueen hallittu kasvu ja parantaa asuinalueen toimivuutta pitkällä aikavälillä.', 'Valkeala, Kuusiharju', 4, 'https://public.bc.fi/jarla/semifinal/thumbnail_10.jpg', 'https://public.bc.fi/jarla/semifinal/plan_10.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(11, 'Asemakaavan muutos Aamurusko', 'Asuinalueen kaavamuutos aurinkoisen ranta-alueen kehittämiseksi.', 'Aamuruskon asemakaavan muutoksessa tutkitaan mahdollisuuksia monipuoliseen asumiseen Aurinkolahden ranta-alueella. Suunnittelussa huomioidaan energiatehokkuus, näkymät vesialueelle sekä alueen virkistyskäyttö.', 'AurinkoLahti, Aamurusko', 5, 'https://public.bc.fi/jarla/semifinal/thumbnail_11.jpg', 'https://public.bc.fi/jarla/semifinal/plan_11.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32'),
(12, 'Asemakaavan muutos Majakkaniitty', 'Kaavamuutos pientalo- ja viheralueiden tasapainottamiseksi.', 'Majakkaniityn asemakaavan muutoksessa sovitetaan yhteen pientalorakentaminen ja viheralueet. Tavoitteena on säilyttää alueen avoin ja merellinen luonne sekä luoda viihtyisä ja turvallinen asuinympäristö.', 'Hiekkalahti, Majakkaniitty', 1, 'https://public.bc.fi/jarla/semifinal/thumbnail_12.jpg', 'https://public.bc.fi/jarla/semifinal/plan_12.png', '2026-01-10 08:00:00', '2026-01-28 18:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sort_order` tinyint NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `sort_order`, `description`) VALUES
(1, 'Aloitus', 1, 'Aloite ja arviointi, OAS laadinta, aloituspäätös.'),
(2, 'Valmistelu', 2, 'Selvitykset ja luonnoksen laatiminen.'),
(3, 'Kuuleminen', 3, 'Luonnos epävirallisesti nähtäville, mielipiteet.'),
(4, 'Ehdotus', 4, 'Muokkaukset palautteen perusteella, virallinen ehdotus.'),
(5, 'Nähtävilläolo', 5, 'Ehdotus virallisesti nähtävillä, muistutukset ja lausunnot. (MRL 65 §, 30 vrk)'),
(6, 'Hyväksyminen', 6, 'Päätöksenteko, hyväksyminen, kuulutus, lainvoima.');

-- --------------------------------------------------------

--
-- Table structure for table `status_history`
--

CREATE TABLE `status_history` (
  `id` bigint NOT NULL,
  `kaavaehdotus_id` bigint NOT NULL,
  `status_id` int NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `change_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_history`
--

INSERT INTO `status_history` (`id`, `kaavaehdotus_id`, `status_id`, `modified_at`, `change_description`) VALUES
(1, 1, 2, '2026-01-20 09:15:00', 'Kaavatyön luonnos laadittu.'),
(2, 2, 3, '2026-01-22 14:30:00', 'Luonnos valmis ja nähtävilläolo.'),
(3, 1, 3, '2026-02-05 10:00:00', 'Luonnos ollut nähtävillä ja mielipiteet kerätty.'),
(4, 1, 4, '2026-02-18 13:45:00', 'Kaavaehdotus laadittu palautteen perusteella.'),
(5, 1, 5, '2026-03-01 08:30:00', 'Kaavaehdotus asetettu virallisesti nähtäville.'),
(6, 2, 4, '2026-02-10 11:20:00', 'Ehdotusvaihe aloitettu, kaavaehdotus muokattu.'),
(7, 2, 5, '2026-02-25 09:00:00', 'Kaavaehdotus nähtävillä MRL 65 § mukaisesti.'),
(8, 3, 1, '2026-01-15 09:00:00', 'Kaavatyö käynnistetty ja OAS laadittu.'),
(9, 3, 2, '2026-01-30 14:10:00', 'Kaavaluonnos valmistunut.'),
(10, 4, 6, '2026-03-15 16:00:00', 'Kaava hyväksytty kunnanvaltuustossa.'),
(11, 1, 2, '2026-01-10 09:15:00', 'Kaavaluonnos laadittu.'),
(12, 2, 3, '2026-01-18 14:30:00', 'Luonnos valmis ja nähtävilläolo.'),
(13, 3, 1, '2026-01-10 10:00:00', 'Kaavatyö käynnistetty ja OAS laadittu.'),
(14, 4, 4, '2026-02-02 11:45:00', 'Kaavaehdotus valmistelussa.'),
(15, 5, 2, '2026-01-25 09:30:00', 'Kaavaluonnos laadittu.'),
(16, 6, 5, '2026-02-15 08:00:00', 'Kaavaehdotus asetettu nähtäville.'),
(17, 7, 1, '2026-01-18 13:20:00', 'Kaavaprosessi aloitettu.'),
(18, 8, 3, '2026-01-30 15:10:00', 'Kuulemisvaihe käynnissä.'),
(19, 9, 2, '2026-01-27 10:40:00', 'Luonnosvaihe aloitettu.'),
(20, 10, 4, '2026-02-05 14:00:00', 'Kaavaehdotus laadittu.'),
(21, 11, 5, '2026-02-20 09:00:00', 'Kaavaehdotus virallisesti nähtävillä.'),
(22, 12, 1, '2026-01-22 12:00:00', 'Kaavatyö käynnistetty.'),
(23, 1, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(24, 2, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(25, 4, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(26, 5, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(27, 6, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(28, 8, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(29, 9, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(30, 10, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(31, 11, 1, '2026-01-28 18:54:09', 'Auto-generated history row'),
(32, 8, 2, '2026-01-28 18:54:09', 'Auto-generated history row'),
(33, 10, 2, '2026-01-28 18:54:09', 'Auto-generated history row'),
(34, 2, 2, '2026-01-28 18:54:09', 'Auto-generated history row'),
(35, 6, 2, '2026-01-28 18:54:09', 'Auto-generated history row'),
(36, 11, 2, '2026-01-28 18:54:09', 'Auto-generated history row'),
(37, 4, 2, '2026-01-28 18:54:09', 'Auto-generated history row'),
(38, 10, 3, '2026-01-28 18:54:09', 'Auto-generated history row'),
(39, 6, 3, '2026-01-28 18:54:09', 'Auto-generated history row'),
(40, 11, 3, '2026-01-28 18:54:09', 'Auto-generated history row'),
(41, 4, 3, '2026-01-28 18:54:09', 'Auto-generated history row'),
(42, 6, 4, '2026-01-28 18:54:09', 'Auto-generated history row'),
(43, 11, 4, '2026-01-28 18:54:09', 'Auto-generated history row'),
(44, 4, 5, '2026-01-28 18:54:09', 'Auto-generated history row');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_plans_name` (`name`),
  ADD KEY `idx_plans_tila` (`status_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_tilat_name` (`name`),
  ADD UNIQUE KEY `uniq_tilat_sort_order` (`sort_order`);

--
-- Indexes for table `status_history`
--
ALTER TABLE `status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_tilahistoria_kaava` (`kaavaehdotus_id`),
  ADD KEY `idx_tilahistoria_modified_at` (`modified_at`),
  ADD KEY `fk_tilahistoria_tila` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_history`
--
ALTER TABLE `status_history`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `fk_plans_tila` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `status_history`
--
ALTER TABLE `status_history`
  ADD CONSTRAINT `fk_tilahistoria_kaava` FOREIGN KEY (`kaavaehdotus_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tilahistoria_tila` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
