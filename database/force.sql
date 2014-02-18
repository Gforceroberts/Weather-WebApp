-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2014 at 07:15 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `force`
--

-- --------------------------------------------------------

--
-- Table structure for table `mydata`
--

CREATE TABLE IF NOT EXISTS `mydata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `data` longtext NOT NULL,
  `temp` float NOT NULL,
  `pressure` int(11) NOT NULL,
  `humidity` float NOT NULL,
  `rain` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=594 ;

--
-- Dumping data for table `mydata`
--

INSERT INTO `mydata` (`id`, `date`, `data`, `temp`, `pressure`, `humidity`, `rain`) VALUES
(333, '2014-02-12 19:33:41', '29.71', 0, 0, 0, 12),
(343, '2014-02-12 20:00:16', '0', 29.24, 0, 0, 0),
(335, '2014-02-12 19:52:49', '0', 34, 0, 0, 0),
(336, '2014-02-12 19:55:12', '0', 40, 0, 0, 0),
(337, '2014-02-12 19:55:53', '0', 40, 0, 0, 0),
(338, '2014-02-12 19:55:59', '0', 41, 0, 0, 0),
(339, '2014-02-12 19:58:06', '0', 30, 0, 0, 0),
(340, '2014-02-12 19:58:16', '0', 30, 0, 0, 0),
(341, '2014-02-12 19:58:28', '0', 99, 0, 0, 0),
(342, '2014-02-12 19:58:42', '0', 99, 900, 0, 0),
(344, '2014-02-12 20:00:38', '0', 29.24, 0, 0, 0),
(345, '2014-02-12 20:00:47', '0', 29.13, 0, 0, 0),
(346, '2014-02-12 20:00:56', '0', 29.19, 0, 0, 0),
(347, '2014-02-12 20:01:06', '0', 29.21, 0, 0, 0),
(348, '2014-02-12 20:01:15', '0', 29.24, 0, 0, 0),
(349, '2014-02-12 20:01:39', '0', 29.17, 849, 0, 0),
(350, '2014-02-12 20:01:48', '0', 29.22, 849, 0, 0),
(351, '2014-02-12 20:01:58', '0', 29.19, 849, 0, 0),
(352, '2014-02-12 20:02:07', '0', 29.15, 849, 0, 0),
(353, '2014-02-12 20:02:17', '0', 29.09, 849, 0, 0),
(354, '2014-02-12 20:02:28', '0', 29.06, 849, 0, 0),
(355, '2014-02-12 20:02:37', '0', 29.05, 849, 0, 0),
(356, '2014-02-12 20:02:48', '0', 29.14, 849, 0, 0),
(357, '2014-02-12 20:02:58', '0', 29.16, 0, 0, 0),
(358, '2014-02-12 20:09:35', '0', 29.1, 849, 0, 0),
(359, '2014-02-12 20:09:46', '0', 29.07, 849, 0, 0),
(360, '2014-02-12 20:09:56', '0', 29.08, 849, 0, 0),
(361, '2014-02-12 20:10:07', '0', 29.07, 849, 0, 0),
(362, '2014-02-12 20:10:20', '0', 29.06, 849, 0, 0),
(363, '2014-02-12 20:10:38', '0', 29.15, 849, 29.6, 0),
(364, '2014-02-12 20:10:50', '0', 29.19, 849, 28.63, 0),
(365, '2014-02-12 20:10:58', '0', 29.16, 849, 28.63, 0),
(366, '2014-02-12 20:11:09', '0', 29.15, 849, 28.47, 0),
(367, '2014-02-12 20:11:19', '0', 29.09, 849, 28.63, 0),
(368, '2014-02-12 20:11:29', '0', 29.09, 849, 29.11, 0),
(369, '2014-02-12 20:11:39', '0', 29.14, 849, 28.63, 0),
(370, '2014-02-12 20:13:07', '0', 29.15, 849, 29.11, 0),
(371, '2014-02-12 20:13:18', '0', 29.12, 849, 29.11, 0),
(372, '2014-02-12 20:13:27', '0', 29.17, 849, 29.28, 0),
(373, '2014-02-12 20:13:37', '0', 29.16, 849, 28.79, 0),
(374, '2014-02-12 20:13:48', '0', 29.11, 849, 28.47, 0),
(375, '2014-02-12 20:13:58', '0', 29.08, 849, 28.95, 0),
(376, '2014-02-12 20:14:08', '0', 29.08, 849, 28.95, 0),
(377, '2014-02-12 20:14:19', '0', 29.06, 849, 28.95, 0),
(378, '2014-02-12 20:14:29', '0', 29.02, 850, 29.1, 0),
(379, '2014-02-12 20:14:39', '0', 29.01, 849, 29.26, 0),
(380, '2014-02-12 20:14:50', '0', 29.01, 849, 29.26, 0),
(381, '2014-02-12 20:15:00', '0', 29.02, 849, 29.1, 0),
(382, '2014-02-12 20:15:11', '0', 29.01, 849, 29.1, 0),
(383, '2014-02-12 20:15:20', '0', 29.03, 849, 28.94, 0),
(384, '2014-02-12 20:15:31', '0', 29.05, 849, 29.43, 0),
(385, '2014-02-12 20:15:41', '0', 29.05, 849, 29.11, 0),
(386, '2014-02-12 20:15:51', '0', 29.04, 850, 28.94, 0),
(387, '2014-02-12 20:16:02', '0', 29.02, 849, 29.1, 0),
(388, '2014-02-12 20:16:12', '0', 29.01, 849, 29.42, 0),
(389, '2014-02-12 20:16:22', '0', 28.99, 849, 29.26, 0),
(390, '2014-02-12 20:16:33', '0', 29.03, 849, 29.26, 0),
(391, '2014-02-12 20:16:42', '0', 29.05, 849, 29.27, 0),
(392, '2014-02-12 20:16:53', '0', 29.01, 849, 29.42, 0),
(393, '2014-02-12 20:17:03', '0', 29.02, 849, 29.42, 0),
(394, '2014-02-12 20:17:14', '0', 29.02, 850, 29.59, 0),
(395, '2014-02-12 20:17:23', '0', 29.06, 850, 29.59, 0),
(396, '2014-02-12 20:17:34', '0', 29.05, 850, 28.78, 0),
(397, '2014-02-12 20:17:44', '0', 29.03, 849, 29.1, 0),
(398, '2014-02-12 20:17:54', '0', 29.01, 850, 29.26, 0),
(399, '2014-02-12 20:18:05', '0', 29.05, 850, 29.59, 0),
(400, '2014-02-12 20:18:25', '0', 29.08, 850, 29.11, 0),
(401, '2014-02-12 20:18:37', '0', 29.06, 849, 29.11, 0),
(402, '2014-02-12 20:18:45', '0', 29.06, 849, 28.95, 0),
(403, '2014-02-12 20:18:54', '0', 29.08, 849, 29.43, 0),
(404, '2014-02-12 20:19:19', '0', 29.22, 850, 30.57, 0),
(405, '2014-02-12 20:19:29', '0', 29.17, 850, 28.95, 0),
(406, '2014-02-12 20:19:39', '0', 29.16, 850, 29.11, 0),
(407, '2014-02-12 20:19:49', '0', 29.15, 850, 29.11, 0),
(408, '2014-02-12 20:19:59', '0', 29.13, 850, 29.11, 0),
(409, '2014-02-12 20:20:09', '0', 29.12, 850, 28.47, 0),
(410, '2014-02-12 20:20:19', '0', 29.16, 850, 29.6, 0),
(411, '2014-02-12 20:20:28', '0', 29.22, 850, 28.96, 0),
(412, '2014-02-12 20:20:39', '0', 29.25, 850, 29.44, 0),
(413, '2014-02-12 20:20:49', '0', 29.22, 850, 28.8, 0),
(414, '2014-02-12 20:20:59', '0', 29.19, 850, 28.79, 0),
(415, '2014-02-12 20:21:09', '0', 29.16, 850, 29.27, 0),
(416, '2014-02-12 20:21:19', '0', 29.12, 850, 28.95, 0),
(417, '2014-02-12 20:21:29', '0', 29.13, 850, 29.43, 0),
(418, '2014-02-12 20:21:39', '0', 29.21, 850, 29.12, 0),
(419, '2014-02-12 20:21:49', '0', 29.24, 850, 29.28, 0),
(420, '2014-02-12 20:22:01', '0', 29.22, 850, 30.08, 0),
(421, '2014-02-12 20:22:09', '0', 29.21, 850, 28.96, 0),
(422, '2014-02-12 20:22:19', '0', 29.19, 850, 28.96, 0),
(423, '2014-02-12 20:22:29', '0', 29.24, 850, 29.44, 0),
(424, '2014-02-12 20:22:39', '0', 29.22, 850, 28.8, 0),
(425, '2014-02-12 20:22:49', '0', 29.24, 850, 29.44, 0),
(426, '2014-02-12 20:22:59', '0', 29.24, 850, 28.96, 0),
(427, '2014-02-12 20:23:09', '0', 29.21, 850, 28.8, 0),
(428, '2014-02-12 20:23:19', '0', 29.24, 850, 32.82, 0),
(429, '2014-02-12 20:23:42', '0', 29.52, 850, 29.3, 17),
(430, '2014-02-12 20:23:51', '0', 29.54, 850, 28.82, 26),
(431, '2014-02-12 20:24:01', '0', 29.52, 850, 28.34, 32),
(432, '2014-02-12 20:24:14', '0', 29.47, 850, 28.82, 32),
(433, '2014-02-12 20:24:21', '0', 29.47, 850, 28.65, 32),
(434, '2014-02-12 20:24:31', '0', 29.43, 850, 28.97, 32),
(435, '2014-02-12 20:24:41', '0', 29.37, 850, 28.97, 32),
(436, '2014-02-12 20:24:52', '0', 29.42, 850, 29.62, 32),
(437, '2014-02-12 20:25:01', '0', 29.52, 850, 29.14, 32),
(438, '2014-02-12 20:25:11', '0', 29.54, 850, 29.14, 32),
(439, '2014-02-12 20:25:21', '0', 29.49, 850, 28.5, 32),
(440, '2014-02-12 20:25:43', '0', 29.47, 850, 29.14, 7),
(441, '2014-02-12 20:25:53', '0', 29.42, 850, 28.97, 2),
(442, '2014-02-12 20:26:03', '0', 29.43, 850, 28.65, 1),
(443, '2014-02-12 20:26:13', '0', 29.47, 850, 28.49, 4),
(444, '2014-02-12 20:26:23', '0', 29.49, 850, 28.98, 3),
(445, '2014-02-12 20:26:33', '0', 29.42, 850, 28.65, 0),
(446, '2014-02-12 20:26:43', '0', 29.42, 850, 28.65, 0),
(447, '2014-02-12 20:26:53', '0', 29.44, 850, 28.49, 0),
(448, '2014-02-12 20:27:03', '0', 29.47, 850, 28.98, 3),
(449, '2014-02-12 20:27:13', '0', 29.44, 850, 28.97, 3),
(450, '2014-02-12 20:27:23', '0', 29.44, 850, 28.65, 2),
(451, '2014-02-12 20:27:33', '0', 29.53, 850, 29.3, 6),
(452, '2014-02-12 20:27:44', '0', 29.57, 850, 29.31, 3),
(453, '2014-02-12 20:27:53', '0', 29.65, 850, 28.35, 5),
(454, '2014-02-12 20:28:03', '0', 29.67, 850, 28.51, 7),
(455, '2014-02-12 20:28:13', '0', 29.66, 850, 28.03, 0),
(456, '2014-02-12 20:28:23', '0', 29.67, 850, 28.19, 0),
(457, '2014-02-12 20:28:33', '0', 29.63, 850, 27.7, 0),
(458, '2014-02-12 20:28:43', '0', 29.6, 850, 28.5, 0),
(459, '2014-02-12 20:28:53', '0', 29.62, 850, 27.86, 0),
(460, '2014-02-12 20:29:03', '0', 29.61, 850, 28.34, 0),
(461, '2014-02-12 20:29:13', '0', 29.6, 850, 28.34, 0),
(462, '2014-02-12 20:29:23', '0', 29.58, 850, 28.5, 0),
(463, '2014-02-12 20:29:33', '0', 29.56, 850, 28.5, 0),
(464, '2014-02-12 20:29:43', '0', 29.49, 850, 28.17, 0),
(465, '2014-02-12 20:29:53', '0', 29.51, 850, 28.66, 0),
(466, '2014-02-12 20:30:03', '0', 29.54, 850, 28.82, 5),
(467, '2014-02-12 20:30:13', '0', 29.52, 850, 28.34, 6),
(468, '2014-02-12 20:30:23', '0', 29.54, 850, 28.5, 4),
(469, '2014-02-12 20:30:33', '0', 29.52, 850, 28.98, 0),
(470, '2014-02-12 20:30:43', '0', 29.56, 850, 28.98, 2),
(471, '2014-02-12 20:30:53', '0', 29.6, 850, 29.15, 3),
(472, '2014-02-12 20:31:03', '0', 29.62, 850, 28.51, 1),
(473, '2014-02-12 20:31:13', '0', 29.62, 850, 28.67, 0),
(474, '2014-02-12 20:31:23', '0', 29.62, 850, 28.51, 0),
(475, '2014-02-12 20:31:33', '0', 29.6, 850, 28.5, 0),
(476, '2014-02-12 20:31:43', '0', 29.58, 850, 28.18, 0),
(477, '2014-02-12 20:31:53', '0', 29.55, 850, 28.34, 0),
(478, '2014-02-12 20:32:03', '0', 29.51, 850, 28.5, 0),
(479, '2014-02-12 20:32:13', '0', 29.47, 850, 28.98, 0),
(480, '2014-02-12 20:32:23', '0', 29.47, 850, 28.98, 0),
(481, '2014-02-12 20:33:09', '0', 29.67, 850, 28.83, 11),
(482, '2014-02-12 20:33:29', '0', 29.74, 850, 28.68, 7),
(483, '2014-02-12 20:33:49', '0', 29.72, 850, 28.51, 3),
(484, '2014-02-12 20:34:09', '0', 29.74, 850, 28.68, 0),
(485, '2014-02-12 20:34:29', '0', 29.72, 850, 31.09, 0),
(486, '2014-02-12 20:34:49', '0', 29.66, 850, 28.51, 0),
(487, '2014-02-12 20:35:09', '0', 29.66, 850, 28.19, 0),
(488, '2014-02-12 20:35:28', '0', 29.65, 850, 28.83, 0),
(489, '2014-02-12 20:35:49', '0', 29.62, 850, 28.83, 0),
(490, '2014-02-12 20:36:09', '0', 29.6, 850, 28.18, 0),
(491, '2014-02-12 20:36:29', '0', 29.58, 850, 28.66, 0),
(492, '2014-02-12 20:36:49', '0', 29.52, 850, 28.5, 0),
(493, '2014-02-12 20:37:09', '0', 29.5, 850, 29.14, 0),
(494, '2014-02-12 20:37:29', '0', 29.56, 850, 28.5, 0),
(495, '2014-02-12 20:37:49', '0', 29.56, 850, 28.98, 0),
(496, '2014-02-12 20:38:09', '0', 29.55, 850, 28.66, 0),
(497, '2014-02-12 20:38:29', '0', 29.52, 850, 28.98, 0),
(498, '2014-02-12 20:38:49', '0', 29.57, 850, 29.15, 0),
(499, '2014-02-12 20:39:29', '0', 29.59, 850, 28.99, 0),
(500, '2014-02-12 20:39:49', '0', 29.6, 850, 28.83, 0),
(501, '2014-02-12 20:40:09', '0', 29.59, 850, 28.83, 0),
(502, '2014-02-12 20:40:29', '0', 29.57, 850, 29.47, 2),
(503, '2014-02-12 20:41:09', '0', 29.67, 850, 28.99, 0),
(504, '2014-02-12 20:41:29', '0', 29.69, 850, 29.48, 6),
(505, '2014-02-12 20:41:49', '0', 29.69, 850, 28.67, 22),
(506, '2014-02-12 20:42:09', '0', 29.67, 850, 29.48, 6),
(507, '2014-02-12 20:42:29', '0', 29.62, 850, 28.99, 0),
(508, '2014-02-12 20:42:50', '0', 29.57, 850, 28.82, 0),
(509, '2014-02-12 20:43:09', '0', 29.56, 850, 29.14, 0),
(510, '2014-02-12 20:43:29', '0', 29.58, 850, 28.99, 0),
(511, '2014-02-12 20:43:49', '0', 29.52, 850, 28.66, 0),
(512, '2014-02-12 20:44:09', '0', 29.46, 850, 29.3, 0),
(513, '2014-02-12 20:44:29', '0', 29.49, 850, 28.98, 0),
(514, '2014-02-12 20:44:49', '0', 29.49, 850, 29.3, 0),
(515, '2014-02-12 20:45:11', '0', 29.46, 850, 28.98, 0),
(516, '2014-02-12 20:45:29', '0', 29.43, 850, 28.97, 0),
(517, '2014-02-12 20:45:49', '0', 29.4, 850, 29.45, 0),
(518, '2014-02-12 20:46:09', '0', 29.35, 850, 29.29, 0),
(519, '2014-02-12 20:46:29', '0', 29.26, 850, 28.96, 0),
(520, '2014-02-12 20:47:09', '0', 29.27, 850, 28.96, 0),
(521, '2014-02-12 20:47:29', '0', 29.24, 850, 29.12, 0),
(522, '2014-02-12 20:47:49', '0', 29.21, 850, 29.44, 0),
(523, '2014-02-12 20:48:09', '0', 29.29, 850, 28.96, 0),
(524, '2014-02-12 20:48:29', '0', 29.33, 850, 29.13, 0),
(525, '2014-02-12 20:48:49', '0', 29.37, 850, 28.97, 0),
(526, '2014-02-12 20:49:29', '0', 29.31, 850, 29.29, 0),
(527, '2014-02-12 20:50:12', '0', 29.38, 850, 29.13, 0),
(528, '2014-02-12 20:50:29', '0', 29.44, 850, 28.81, 0),
(529, '2014-02-12 20:50:49', '0', 29.5, 850, 29.14, 0),
(530, '2014-02-12 20:51:09', '0', 29.49, 850, 28.82, 0),
(531, '2014-02-12 20:51:29', '0', 29.41, 850, 29.29, 0),
(532, '2014-02-12 20:51:49', '0', 29.31, 850, 29.29, 0),
(533, '2014-02-12 20:52:09', '0', 29.3, 850, 29.61, 0),
(534, '2014-02-12 20:52:50', '0', 29.34, 850, 28.97, 0),
(535, '2014-02-12 20:53:09', '0', 29.41, 850, 29.45, 0),
(536, '2014-02-12 20:53:29', '0', 29.43, 850, 29.13, 0),
(537, '2014-02-12 20:53:49', '0', 29.37, 850, 29.45, 0),
(538, '2014-02-12 20:54:30', '0', 29.27, 850, 29.12, 0),
(539, '2014-02-12 20:54:50', '0', 29.24, 850, 29.44, 0),
(540, '2014-02-12 20:55:09', '0', 29.17, 850, 29.6, 0),
(541, '2014-02-12 20:55:31', '0', 29.13, 850, 29.92, 0),
(542, '2014-02-12 20:55:49', '0', 29.16, 850, 29.76, 0),
(543, '2014-02-12 20:56:10', '0', 29.26, 850, 29.76, 0),
(544, '2014-02-12 20:56:30', '0', 29.28, 850, 29.12, 0),
(545, '2014-02-12 20:56:50', '0', 29.37, 850, 29.45, 0),
(546, '2014-02-12 20:57:30', '0', 29.31, 850, 29.13, 0),
(547, '2014-02-12 20:57:50', '0', 29.26, 850, 29.6, 0),
(548, '2014-02-12 20:58:10', '0', 29.29, 850, 29.61, 0),
(549, '2014-02-12 20:58:30', '0', 29.26, 850, 29.6, 0),
(550, '2014-02-12 20:58:50', '0', 29.24, 850, 29.44, 0),
(551, '2014-02-12 20:59:10', '0', 29.19, 850, 29.28, 0),
(552, '2014-02-12 20:59:29', '0', 29.15, 850, 29.6, 0),
(553, '2014-02-12 20:59:50', '0', 29.1, 850, 29.75, 0),
(554, '2014-02-12 21:00:11', '0', 29.09, 850, 29.75, 0),
(555, '2014-02-12 21:00:30', '0', 29.06, 850, 29.43, 0),
(556, '2014-02-12 21:00:50', '0', 29.06, 850, 29.59, 0),
(557, '2014-02-12 21:01:10', '0', 29.01, 850, 29.74, 0),
(558, '2014-02-12 21:01:30', '0', 29.06, 850, 30.07, 18),
(559, '2014-02-12 21:01:50', '0', 29.16, 850, 29.76, 21),
(560, '2014-02-12 21:02:09', '0', 29.14, 850, 29.27, 7),
(561, '2014-02-12 21:02:30', '0', 29.22, 850, 29.12, 0),
(562, '2014-02-12 21:02:50', '0', 29.16, 850, 29.11, 0),
(563, '2014-02-12 21:03:10', '0', 29.1, 850, 29.43, 0),
(564, '2014-02-12 21:03:30', '0', 29.17, 850, 29.12, 0),
(565, '2014-02-12 21:03:50', '0', 29.22, 850, 29.28, 0),
(566, '2014-02-12 21:04:10', '0', 29.21, 850, 28.96, 0),
(567, '2014-02-12 21:04:30', '0', 29.15, 850, 29.92, 0),
(568, '2014-02-12 21:04:50', '0', 29.1, 850, 29.75, 0),
(569, '2014-02-12 21:05:10', '0', 29.12, 850, 29.75, 0),
(570, '2014-02-12 21:05:30', '0', 29.33, 850, 28.97, 0),
(571, '2014-02-12 21:05:50', '0', 29.43, 850, 28.49, 0),
(572, '2014-02-12 21:06:10', '0', 29.34, 850, 28.48, 0),
(573, '2014-02-12 21:06:30', '0', 29.37, 850, 28.65, 0),
(574, '2014-02-12 21:06:50', '0', 29.49, 850, 28.66, 0),
(575, '2014-02-12 21:07:10', '0', 29.35, 850, 29.29, 0),
(576, '2014-02-12 21:07:30', '0', 29.31, 850, 28.96, 0),
(577, '2014-02-12 21:07:50', '0', 29.42, 850, 28.97, 0),
(578, '2014-02-12 21:08:10', '0', 29.27, 850, 28.64, 0),
(579, '2014-02-12 21:08:30', '0', 29.22, 850, 28.8, 0),
(580, '2014-02-12 21:08:50', '0', 29.18, 850, 29.12, 0),
(581, '2014-02-12 21:09:10', '0', 29.25, 850, 28.64, 0),
(582, '2014-02-12 21:09:30', '0', 29.19, 850, 28.96, 0),
(583, '2014-02-12 21:09:50', '0', 29.03, 850, 28.94, 0),
(584, '2014-02-12 21:10:11', '0', 28.94, 850, 29.1, 0),
(585, '2014-02-12 21:10:50', '0', 29.15, 850, 28.79, 0),
(586, '2014-02-12 21:11:10', '0', 29.07, 850, 28.79, 0),
(587, '2014-02-12 21:11:30', '0', 29.16, 850, 28.79, 0),
(588, '2014-02-12 21:11:50', '0', 29.17, 850, 28.15, 0),
(589, '2014-02-12 21:12:11', '0', 29.24, 850, 29.28, 0),
(590, '2014-02-12 21:12:30', '0', 29.35, 850, 28.32, 0),
(591, '2014-02-12 21:12:50', '0', 29.38, 850, 28.17, 0),
(592, '2014-02-12 21:13:10', '0', 29.33, 850, 28.48, 0),
(593, '2014-02-12 21:13:30', '0', 29.24, 850, 28.48, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
