-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Lip 2024, 20:57
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `checktask`
--
CREATE DATABASE IF NOT EXISTS `checktask` DEFAULT CHARACTER SET utf32 COLLATE utf32_polish_ci;
USE `checktask`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `employees`
--

CREATE TABLE `employees` (
  `id_employee` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `job_position` varchar(30) DEFAULT NULL,
  `pesel` varchar(11) NOT NULL,
  `phone` varchar(9) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `previous_login` datetime DEFAULT NULL,
  `employee_right` varchar(20) NOT NULL,
  `id_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `employees`
--

INSERT INTO `employees` (`id_employee`, `name`, `last_name`, `job_position`, `pesel`, `phone`, `email`, `pass`, `previous_login`, `employee_right`, `id_group`) VALUES
(2, 'Jakub', 'Karnas', 'programista', '12345678901', '123456789', 'j.karnas@gmail.com', '$2y$10$oygJ4V5fHzJvZuOKundEQOb7JPPkzrro9q2yXKDEWkjbdBs1bQR2a', '2024-07-27 18:57:15', 'user', 1),
(3, 'Jan', 'Kowalski', 'menedżer', '12345678912', '123456789', 'j.kowalski@wp.pl', '$2y$10$MuxAj8W56MGKELm7pi/QyeD96oEnA/LUkp.FIqeJbqL0BS3Hn/.gO', '2024-07-30 20:53:30', 'manager', 2),
(6, 'Marek', 'Nowak', 'Programista', '12345678765', '123456787', 'm.nowak@wp.pl', '$2y$10$PXGJdBiReUynCHe.ZgBN3OyFfeVZsI02yv4cfcgVet0jyIKKFMiLe', '2024-07-29 22:28:40', 'user', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `priority` varchar(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `stop_date` datetime NOT NULL,
  `last_edit` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `file_path` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`id_task`, `title`, `description`, `priority`, `start_date`, `stop_date`, `last_edit`, `status`, `file_path`) VALUES
(1, 'Task 1', 'Description 1', 'V', '2024-08-01 08:00:00', '2024-08-01 17:00:00', '2024-07-30 20:54:06', 'during', 'task1.pdf'),
(2, 'Task 2', 'Description 2', 'III', '2024-08-02 09:00:00', '2024-08-02 18:00:00', '2024-07-30 20:54:14', 'during', 'task2.pdf'),
(3, 'Task 3', 'Description 3', 'I', '2024-08-03 10:00:00', '2024-08-03 19:00:00', '2024-07-30 20:54:22', 'during', NULL),
(4, 'Task 4', 'Description 4', 'IV', '2024-08-04 11:00:00', '2024-08-04 20:00:00', '2024-07-30 20:53:45', 'not_started', 'task4.docx'),
(5, 'Task 5', 'Description 5', 'III', '2024-08-05 12:00:00', '2024-08-05 21:00:00', '2024-07-30 20:54:45', 'ended', 'task5.txt'),
(8, 'Task 8', 'Description 8', 'III', '2024-08-08 15:00:00', '2024-08-08 23:59:00', '2024-07-30 20:54:37', 'ended', NULL),
(9, 'Task 9', 'Description 9', 'I', '2024-08-09 16:00:00', '2024-08-09 23:59:00', '2024-07-30 20:53:59', 'not_started', 'task9.ppt'),
(11, 'zadani', 'loremipsum', 'I', '2024-07-29 01:30:00', '2024-07-31 01:30:00', '2024-07-30 20:19:59', 'during', 'test.pdf');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task_use`
--

CREATE TABLE `task_use` (
  `id_task_use` int(11) NOT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `id_task` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `task_use`
--

INSERT INTO `task_use` (`id_task_use`, `id_employee`, `id_task`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 2, 2),
(4, 2, 3),
(5, 2, 4),
(6, 2, 3),
(7, 2, 4),
(8, 2, 3),
(9, 3, 4),
(11, NULL, 8),
(13, NULL, 8),
(15, NULL, 9),
(16, NULL, 5),
(17, NULL, 9),
(18, NULL, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `working_group`
--

CREATE TABLE `working_group` (
  `id_group` int(11) NOT NULL,
  `name_group` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `file_path` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `working_group`
--

INSERT INTO `working_group` (`id_group`, `name_group`, `description`, `file_path`) VALUES
(1, 'Grupa 1', 'Lorem', ''),
(2, 'Grupa 2', 'Druga Grupa', NULL),
(5, 'Grupa 3', 'Lorem', ''),
(9, 'Grupa 4', 'Lorem', 'jakiś plik');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `employees_ibfk_1` (`id_group`);

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);

--
-- Indeksy dla tabeli `task_use`
--
ALTER TABLE `task_use`
  ADD PRIMARY KEY (`id_task_use`),
  ADD KEY `task_use_ibfk_1` (`id_employee`),
  ADD KEY `task_use_ibfk_2` (`id_task`);

--
-- Indeksy dla tabeli `working_group`
--
ALTER TABLE `working_group`
  ADD PRIMARY KEY (`id_group`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `employees`
--
ALTER TABLE `employees`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `task_use`
--
ALTER TABLE `task_use`
  MODIFY `id_task_use` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `working_group`
--
ALTER TABLE `working_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `working_group` (`id_group`) ON DELETE SET NULL;

--
-- Ograniczenia dla tabeli `task_use`
--
ALTER TABLE `task_use`
  ADD CONSTRAINT `task_use_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id_employee`) ON DELETE SET NULL,
  ADD CONSTRAINT `task_use_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `task` (`id_task`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
