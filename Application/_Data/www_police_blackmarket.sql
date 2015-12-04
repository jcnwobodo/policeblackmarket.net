-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2015 at 07:40 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `www_police_blackmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `pbm_reports`
--

CREATE TABLE `pbm_reports` (
  `id` int(16) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_time` bigint(32) NOT NULL,
  `report_time` bigint(32) NOT NULL,
  `location_state` int(16) NOT NULL COMMENT 'site_locations.id',
  `location_lga` int(16) NOT NULL,
  `location_district` int(16) NOT NULL,
  `location_scene` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporter` int(16) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '2' COMMENT '0|1|2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pbm_reports`
--

INSERT INTO `pbm_reports` (`id`, `title`, `description`, `event_time`, `report_time`, `location_state`, `location_lga`, `location_district`, `location_scene`, `reporter`, `status`) VALUES
(28, 'The Menace Of Multiple Road Blocks In Nsukka Today', 'Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness butdemanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands anurgent answer from your office as we are nowmore determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1449097200, 1420239600, 1, 2, 3, 'Enugu Road', 6, 0),
(29, 'The Menace Of Multiple Road Blocks In Nsukka Today', 'Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness butdemanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands anurgent answer from your office as we are nowmore determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1449097200, 1420239600, 1, 2, 3, 'Enugu Road', 6, 0),
(30, 'The Menace Of Multiple Road Blocks In Nsukka Today', 'Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness butdemanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands anurgent answer from your office as we are nowmore determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1449097200, 1420239600, 1, 2, 3, 'Enugu Road', 6, 0),
(31, 'The Menace Of Multiple Road Blocks In Nsukka Today', 'Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness butdemanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands anurgent answer from your office as we are nowmore determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1449097200, 1420239600, 1, 2, 3, 'Enugu Road', 6, 0),
(32, 'The Menace Of Multiple Road Blocks In Nsukka Today', 'Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness butdemanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands anurgent answer from your office as we are nowmore determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1449097200, 1420239600, 1, 2, 3, 'Enugu Road', 6, 0),
(33, 'The Menace Of Multiple Road Blocks In Nsukka Today', 'Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness butdemanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands anurgent answer from your office as we are nowmore determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1449097200, 1420239600, 1, 2, 3, 'Enugu Road', 6, 0),
(34, 'The Menace Of Multiple Road Blocks In Nsukka Today', '<p>Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\n\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\n\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\n\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\n\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\n\r\nThese drivers however latter accepted his plea for forgiveness but demanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\n\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.</p>', 1449183600, 1420326000, 1, 2, 3, '', 6, 0),
(35, 'The Menace Of Multiple Road Blocks In Nsukka Today', '<p>Contrary to the pronouncement and public directive of the Inspector General of Police against the business of police road blocks and extortion of motorists by armed policemen, the racket has not only continued in the Nsukka area of Enugu State but has also become notoriously rampant and even graduated to a common traditional practice with policemen at liberty to even shoot motorists who dare to resist the extortion. The menace has recently become too unbearable for motorists following the multiplication of these road blocks by policemen and the habit of targeting major roads or routes leading to different daily local market days by those policemen who seem to have studied the calendar of daily local markets days each of these policemen have stationed themselves on such roads and split themselves into as many beats as possible waiting for these drivers.\r\nThe situation is as bad as this at Nsukka presently where the DPO Nsukka Urban have literally declared a bazaar on public roads by policemen using their gun and the victimization of anyone who dares to resist the gamble. These commercial drivers have severally threatened to embark on peaceful public demonstration against the status quo but the DPO on all such occasions frightened them to desist from it and when he sees that the situation is beyond his power he will resort to begging them to forgive him.\r\nOn 10th September, 2015 a taxi driver ran into one of such numerous road blocks mounted by policemen from the Nsukka Urban Division under the authority of the DPO and when he was stopped he obeyed the order but resisted the demand for N100.00 by the policeman and when he wanted to enter back his car to move after opening his boot for the policeman, the policeman a caporal attached to the DPO Nsukka Urban with a cover over his uniform to avoid the easy notice of hisname fired one gun shot on the leg of the driver which forced him to fall down immediately. (See picture of the driver on the ground at a nearby farm at the scene of the incident). His name is EzeUdoka from Ero Uno community in Nsukka Local Government of Enugu state and he is a taxi driver driving a Toyota bus with registration number SA914BBC.\r\nWhen this happened all the policemen on road block there quickly entered their Hilux and jetted away from the scene. When other drivers who saw their colleague on the ground picked him and brought him to the DPO to complain against the action of the erring policeman, the DPO turned to accuse the driver victim Mr. EzeUdoka of falling to cooperate with his men as the cause of the problem.\r\nHe ordered for his statement to be taken as a suspect while his policeman who shot him he made a complainant this was in a way to frighten the drivers but when he saw that his trick did not yield nay good result following the decision by the drivers to proceed on demonstration in the town the following day he quickly knelt down for them and begged for his forgiveness again.\r\nThese drivers however latter accepted his plea for forgiveness but demanded a stop to that menace thenceforth which the DPO agreed but recently the proverbial dog has gone back to its vomit as he has again directed his policemen to continue the racket. The situation is even worse these days as the policemen appear to be motivated tomake more loot from the jackpot every day than before. This development is at the expense of an incredible and unprecedented explosion in the wave of crime in the community.\r\nWhat we are asking now is whether the practice of this menace of multiple road blocks on our roads and the racket of N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.</p>', 1449183600, 1420326000, 1, 2, 3, '', 6, 0),
(36, 'The Menace Of Multiple Road Blocks In Nsukka Today', '<p>line 1\r</p><p>line 2\r</p><p>\r</p><p>line 4</p>', 1449183600, 1420326000, 1, 2, 3, '', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pbm_reports_meta`
--

CREATE TABLE `pbm_reports_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `meta_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pbm_reports_meta`
--

INSERT INTO `pbm_reports_meta` (`id`, `report_id`, `meta_type`, `meta_value`) VALUES
(41, 31, 'category', '2'),
(42, 31, 'category', '3'),
(43, 32, 'category', '2'),
(44, 32, 'category', '3'),
(45, 32, 'news_source', 'http://localhost/www/Leapscope/police-black-market/submit-report/'),
(46, 32, 'video_link', 'http://localhost/www/Leapscope/police-black-market/submit-report/'),
(47, 33, 'category', '2'),
(48, 33, 'category', '3'),
(49, 33, 'news_source', 'http://localhost/www/Leapscope/police-black-market/submit-report/'),
(50, 33, 'video_link', 'http://localhost/www/Leapscope/police-black-market/submit-report/'),
(61, 36, 'category', '2'),
(62, 36, 'category', '3'),
(63, 34, 'category', '2'),
(64, 34, 'category', '3'),
(65, 35, 'category', '2'),
(66, 35, 'category', '3');

-- --------------------------------------------------------

--
-- Table structure for table `site_categories`
--

CREATE TABLE `site_categories` (
  `id` int(16) NOT NULL,
  `guid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(16) DEFAULT NULL COMMENT 'site_posts_categories.id',
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_categories`
--

INSERT INTO `site_categories` (`id`, `guid`, `parent`, `caption`, `type`) VALUES
(1, 'news', NULL, 'News', 'post'),
(2, 'extortion', NULL, 'Extortion', 'report'),
(3, 'bribery', NULL, 'Bribery', 'report');

-- --------------------------------------------------------

--
-- Table structure for table `site_comments`
--

CREATE TABLE `site_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent` int(16) UNSIGNED DEFAULT '0',
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` int(16) NOT NULL,
  `comment_time` bigint(32) NOT NULL,
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_comments`
--

INSERT INTO `site_comments` (`id`, `parent`, `post_id`, `comment_author`, `comment_time`, `comment_type`, `content`, `status`) VALUES
(1, NULL, 34, 6, 1449187261, 'report', 'a lot of things', 1),
(2, NULL, 34, 6, 1449187261, 'report', 'a lot of things', 1),
(3, NULL, 34, 6, 1449187261, 'report', 'a lot of things', 1),
(4, NULL, 34, 6, 1449187261, 'report', 'a lot of things', 1),
(5, NULL, 34, 6, 1449187261, 'report', 'a lot of things', 1),
(6, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(7, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(8, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(9, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(10, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(11, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(12, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(13, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(14, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(15, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(16, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1),
(17, NULL, 34, 6, 1449187261, 'report', 'N100.00 extortion from motorists as a compulsory settlement ransom for the police is a policy directive from the office of the IGP or your own office exceptionally for the people of Nsukka and whether the lives of drivers are too cheap for this administration of the Nigeria Police Force that it can be sacrificed for N100.00 ransom. This question demands an urgent answer from your office as we are now more determined than ever to at least allow our voices to be heard against this onslaught before we are all consumed for it.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_locations`
--

CREATE TABLE `site_locations` (
  `id` bigint(16) NOT NULL,
  `parent` bigint(16) DEFAULT NULL,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(5,3) DEFAULT NULL,
  `longitude` decimal(5,3) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_locations`
--

INSERT INTO `site_locations` (`id`, `parent`, `location_name`, `slogan`, `location_type`, `latitude`, `longitude`, `status`) VALUES
(1, NULL, 'Enugu', 'Coal City State', 'state', '0.000', '0.000', 1),
(2, 1, 'Nsukka', '', 'lga', '0.000', '0.000', 1),
(3, 2, 'UNN', NULL, 'district', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_posts`
--

CREATE TABLE `site_posts` (
  `id` int(16) NOT NULL,
  `parent` int(16) DEFAULT NULL COMMENT 'site_posts.id',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` int(16) DEFAULT NULL COMMENT 'uploads.id',
  `category` int(16) DEFAULT NULL COMMENT 'site_posts_categories.id',
  `author` int(16) NOT NULL COMMENT 'users.id',
  `date_created` int(32) NOT NULL,
  `last_update` int(32) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_posts`
--

INSERT INTO `site_posts` (`id`, `parent`, `post_type`, `guid`, `title`, `content`, `excerpt`, `featured_image`, `category`, `author`, `date_created`, `last_update`, `status`) VALUES
(1, NULL, 'page', 'how-it-works', 'How It Works', 'some text', 'some exerpt', NULL, NULL, 1, 500000, 510000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_sessions`
--

CREATE TABLE `site_sessions` (
  `id` int(16) NOT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(16) NOT NULL COMMENT 'users.id',
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'users_access_levels.user_type',
  `start_time` int(32) NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity_time` int(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_sessions`
--

INSERT INTO `site_sessions` (`id`, `session_id`, `user_id`, `user_type`, `start_time`, `user_agent`, `ip_address`, `last_activity_time`, `status`) VALUES
(7, '565875b0bdbe06.70203316', 1, 'admin', 1448578800, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '::1', 1449187261, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_uploads`
--

CREATE TABLE `site_uploads` (
  `id` int(16) NOT NULL,
  `MIME_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_time` int(32) NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` int(16) NOT NULL COMMENT 'site_users.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `id` int(16) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` int(32) DEFAULT NULL,
  `date_joined` bigint(32) NOT NULL,
  `place_of_origin` int(16) DEFAULT NULL COMMENT 'site_locations.id',
  `place_of_residence` int(16) DEFAULT NULL COMMENT 'maps_countries.id',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` int(16) DEFAULT NULL COMMENT 'uploads.id',
  `biography` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`id`, `username`, `password`, `user_type`, `status`, `first_name`, `last_name`, `nickname`, `gender`, `date_of_birth`, `date_joined`, `place_of_origin`, `place_of_residence`, `email`, `phone`, `photo`, `biography`) VALUES
(1, 'admin', 'password', 'admin', 1, 'Chukwuemeka', 'Nwobodo', 'Joe', 'M', 500000000, 800000000, 2, 4, 'jc.nwobodo@gmail.com', '08133621591', NULL, 'some text here'),
(6, 'dejoetech@gmail.com', NULL, 'user', 0, 'Joseph', 'Chuks', NULL, NULL, 1449100861, 1449100861, 3, 3, 'dejoetech@gmail.com', '08133621591', NULL, NULL),
(7, '', NULL, 'user', 0, '', '', NULL, NULL, 1449187261, 1449187261, 3, 3, '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbm_reports`
--
ALTER TABLE `pbm_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbm_reports_meta`
--
ALTER TABLE `pbm_reports_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_categories`
--
ALTER TABLE `site_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guid` (`guid`);

--
-- Indexes for table `site_comments`
--
ALTER TABLE `site_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_locations`
--
ALTER TABLE `site_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_posts`
--
ALTER TABLE `site_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pamalink` (`guid`);

--
-- Indexes for table `site_sessions`
--
ALTER TABLE `site_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `site_uploads`
--
ALTER TABLE `site_uploads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pamanent link` (`guid`);

--
-- Indexes for table `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photo_id` (`photo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pbm_reports`
--
ALTER TABLE `pbm_reports`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `pbm_reports_meta`
--
ALTER TABLE `pbm_reports_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `site_categories`
--
ALTER TABLE `site_categories`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_comments`
--
ALTER TABLE `site_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `site_locations`
--
ALTER TABLE `site_locations`
  MODIFY `id` bigint(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_posts`
--
ALTER TABLE `site_posts`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_sessions`
--
ALTER TABLE `site_sessions`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `site_uploads`
--
ALTER TABLE `site_uploads`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
