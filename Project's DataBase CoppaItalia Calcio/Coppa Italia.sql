-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 13, 2019 alle 10:56
-- Versione del server: 10.1.36-MariaDB
-- Versione PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coppa_italia`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `giocatore`
--

CREATE TABLE `giocatore` (
  `Tessera` int(10) NOT NULL,
  `Nome_squadra` varchar(50) NOT NULL,
  `Numero_maglia` int(2) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Ruolo` varchar(3) NOT NULL,
  `Nazionalita` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `giocatore`
--

INSERT INTO `giocatore` (`Tessera`, `Nome_squadra`, `Numero_maglia`, `Nome`, `Cognome`, `Ruolo`, `Nazionalita`) VALUES
(9009, 'Inter', 9, 'Mauro', 'Icardi', 'A', 'Argentina'),
(11004, 'Juventus', 11, 'Douglas', 'Costa', 'A', 'Brasiliana'),
(17012, 'Lazio', 17, 'Ciro', 'Immobile', 'A', 'Italiana'),
(19013, 'Milan', 19, 'Piatek', 'Krzysztof', 'A', 'Polacca'),
(24014, 'Napoli', 24, 'Lorenzo', 'Insigne', 'A', 'Italiana'),
(33010, 'Juventus', 33, 'Federico', 'Bernardeschi', 'A', 'Italiana'),
(37009, 'Inter', 37, 'Milan', 'Skriniar', 'D', 'Slovacca'),
(91001, 'Atalanta', 91, 'Duvan', 'Zapata', 'A', 'Colombiana');


-- --------------------------------------------------------

--
-- Struttura della tabella `partita`
--

CREATE TABLE `partita` (
  `Num_partita` int(2) NOT NULL,
  `Nome_turno` varchar(50) NOT NULL,
  `Luogo` varchar(50) NOT NULL,
  `Data` date NOT NULL,
  `Sq_casa` varchar(50) NOT NULL,
  `Sq_trasferta` varchar(50) NOT NULL,
  `Nome_a` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `partita`
--

INSERT INTO `partita` (`Num_partita`, `Nome_turno`, `Luogo`, `Data`, `Sq_casa`, `Sq_trasferta`, `Nome_a`) VALUES
(1, 'Finale', 'Roma', '2019-05-15', 'Atalanta', 'Lazio', 'Banti'),
(1, 'Quarti di finale', 'Milano', '2019-01-29', 'Milan', 'Napoli', 'Giacomelli'),
(2, 'Semifinale-Andata', 'Firenze', '2019-02-27', 'Fiorentina', 'Atalanta', 'Giacomelli'),
(7, 'Ottavi di finale', 'Bologna', '2019-01-12', 'Bologna', 'Juventus', 'La Penna'),
(8, 'Ottavi di finale', 'Cagliari', '2019-01-14', 'Cagliari', 'Atalanta', 'Piccinini');


-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `Id_squadra` int(50) NOT NULL,
  `Nome_sq` varchar(50) NOT NULL,
  `Citta` varchar(50) NOT NULL,
  `Allenatore` varchar(50) NOT NULL,
  `Sponsor` varchar(50) NOT NULL,
  `Colori_sociali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `squadra`
--

INSERT INTO `squadra` (`Id_squadra`, `Nome_sq`, `Citta`, `Allenatore`, `Sponsor`, `Colori_sociali`) VALUES
(3356, 'Atalanta', 'Bergamo', 'Gasperini', 'RadiciGroup', 'Neroblu'),
(7452, 'Inter', 'Milano', 'Spalletti', 'Pirelli', 'Neroazzurro'),
(2080, 'Juventus', 'Torino', 'Allegri', 'Jeep', 'Bianconero'),
(8044, 'Lazio', 'Roma', 'Inzaghi', 'Marathonbet', 'Biancoceleste'),
(1852, 'Milan', 'Milano', 'Gattuso', 'Fly Emirates', 'Rossonero'),
(2911, 'Napoli', 'Napoli', 'Ancellotti', 'Lete', 'Azzurro'),
(4926, 'Roma', 'Roma', 'Ranieri', 'Qatar Airways', 'Giallorosso');


-- --------------------------------------------------------

--
-- Struttura della tabella `arbitro`
--

CREATE TABLE `arbitro` (
  `Id_arbitro` int(10) NOT NULL,
  `Nome_ar` varchar(50) NOT NULL,
  `Num_presenze` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `arbitro`
--

INSERT INTO `arbitro` (`Id_arbitro`, `Nome_ar`, `Num_presenze`) VALUES
(44, 'Doveri', 2),
(122, 'Banti', 1),
(167, 'Giacomelli', 2),
(612, 'La Penna', 1),
(1316, 'Piccinini', 1);


-- --------------------------------------------------------

--
-- Struttura della tabella `edizione_vinta`
--

CREATE TABLE `edizione_vinta` (
  `Anno_edizione` int(10) NOT NULL,
  `Sq_vincitrice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `edizione_vinta`
--

INSERT INTO `edizione_vinta` (`Anno_edizione`, `Sq_vincitrice`) VALUES
(2005, 'Inter'),
(2011, 'Inter'),
(2017, 'Juventus'),
(2018, 'Juventus'),
(2003, 'Milan'),
(2012, 'Napoli');


-- --------------------------------------------------------

--
-- Struttura della tabella `goal`
--

CREATE TABLE `goal` (
  `Num_Partita` int(2) NOT NULL,
  `Nome_Turno` varchar(50) NOT NULL,
  `Minuto` int(3) NOT NULL,
  `Cognome_G` varchar(50) NOT NULL,
  `Nome_G` varchar(50) NOT NULL,
  `Supplementari` varchar(2) NOT NULL,
  `Rigore` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `goal`
--

INSERT INTO `goal` (`Num_Partita`, `Nome_Turno`, `Minuto`, `Cognome_G`, `Nome_G`, `Supplementari`, `Rigore`) VALUES
(1, 'Quarti  di finale', 27, 'Krzysztof', 'Piatek', 'NO', 'NO'),
(7, 'Ottavi di finale', 9, 'Bernardeschi', 'Federico', 'NO', 'NO');


-- --------------------------------------------------------


--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `giocatore`
--
ALTER TABLE `giocatore`
  ADD PRIMARY KEY (`Tessera`),
  ADD KEY `fk_giocatore` (`Nome_squadra`);

--
-- Indici per le tabelle `partita`
--
ALTER TABLE `partita`
  ADD PRIMARY KEY (`Num_partita`,`Nome_turno`),
  ADD KEY `fk_arbitro` (`Nome_a`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`Nome_sq`,`Id_squadra`) USING BTREE;
COMMIT;

--
-- Indici per le tabelle `arbitro`
--
ALTER TABLE `arbitro`
  ADD PRIMARY KEY (`Nome_ar`,`Id_arbitro`) USING BTREE;
COMMIT;

--
-- Indici per le tabelle `edizione_vinta`
--
ALTER TABLE `edizione_vinta`
  ADD PRIMARY KEY (`Anno_edizione`),
  ADD KEY `fk_edizioni_vinte` (`Sq_vincitrice`);

--
-- Indici per le tabelle `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`Num_Partita`,`Nome_Turno`,`Minuto`) USING BTREE;
COMMIT;

-- -----------------------------------------------------------------


--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `giocatore`
--
ALTER TABLE `giocatore`
  ADD CONSTRAINT `fk_giocatore` FOREIGN KEY (`Nome_squadra`) REFERENCES `squadra` (`Nome_sq`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Limiti per la tabella `edizione_vinta`
--
ALTER TABLE `edizione_vinta`
  ADD CONSTRAINT `fk_edizioni_vinte` FOREIGN KEY (`Sq_vincitrice`) REFERENCES `squadra` (`Nome_sq`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Limiti per la tabella `partita`
--
ALTER TABLE `partita`
  ADD CONSTRAINT `fk_arbitro` FOREIGN KEY (`Nome_a`) REFERENCES `arbitro` (`Nome_ar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
