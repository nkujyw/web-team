-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-09 07:50:54
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `anti_war_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `battle_events`
--

CREATE TABLE `battle_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL COMMENT '开始时间',
  `end_date` date DEFAULT NULL COMMENT '结束时间',
  `location_id` int(11) DEFAULT NULL COMMENT '地点ID',
  `description` text DEFAULT NULL COMMENT '战役描述',
  `result` text DEFAULT NULL COMMENT '战役结果',
  `force1_id` int(11) DEFAULT NULL COMMENT '交战方1',
  `force2_id` int(11) DEFAULT NULL COMMENT '交战方2',
  `casualties` varchar(500) DEFAULT NULL COMMENT '伤亡情况'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `biography` text DEFAULT NULL COMMENT '人物简介',
  `force_id` int(11) DEFAULT NULL COMMENT '势力id',
  `achievements` text DEFAULT NULL COMMENT '主要事迹',
  `rank` varchar(100) DEFAULT NULL COMMENT '职务',
  `url` varchar(500) DEFAULT NULL COMMENT '照片链接'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `diplomatic_events`
--

CREATE TABLE `diplomatic_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL COMMENT '事件日期',
  `location_id` int(11) DEFAULT NULL COMMENT '	\r\n地点ID',
  `description` text DEFAULT NULL COMMENT '	\r\n事件描述',
  `related_force_ids` varchar(500) DEFAULT NULL COMMENT '	\r\n相关势力ID',
  `outcome` text DEFAULT NULL COMMENT '	\r\n事件结果'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL COMMENT '事件开始时间',
  `end_date` date DEFAULT NULL COMMENT '事件结束时间',
  `location_id` int(11) DEFAULT NULL COMMENT '发生地点ID',
  `description` text DEFAULT NULL COMMENT '事件描述',
  `outcome` text DEFAULT NULL COMMENT '事件影响'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `forces`
--

CREATE TABLE `forces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(50) DEFAULT NULL COMMENT '势力类型',
  `description` text DEFAULT NULL COMMENT '势力简介'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT '地点类型（如战场/纪念馆）',
  `description` text DEFAULT NULL COMMENT '地点描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `meeting_events`
--

CREATE TABLE `meeting_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meeting_date` date DEFAULT NULL COMMENT '	\r\n会议日期',
  `location_id` int(11) DEFAULT NULL COMMENT '地点ID',
  `description` text DEFAULT NULL COMMENT '	\r\n会议描述',
  `attendees` text DEFAULT NULL COMMENT '	\r\n参会人员',
  `agenda` text DEFAULT NULL COMMENT '	\r\n会议议程',
  `outcome` text DEFAULT NULL COMMENT '	\r\n会议结果'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `mem_activities`
--

CREATE TABLE `mem_activities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `activity_date` date DEFAULT NULL COMMENT '活动日期',
  `location_id` int(11) DEFAULT NULL COMMENT '地点ID',
  `organizer` varchar(50) DEFAULT NULL COMMENT '主办方',
  `description` text DEFAULT NULL COMMENT '活动描述',
  `photo_url` varchar(500) DEFAULT NULL COMMENT '照片链接等'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `mem_works`
--

CREATE TABLE `mem_works` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT '作品类型',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `create_date` date DEFAULT NULL COMMENT '创作时间',
  `description` text DEFAULT NULL COMMENT '作品描述',
  `url` varchar(500) DEFAULT NULL COMMENT '作品链接',
  `related_event_id` int(11) DEFAULT NULL COMMENT '关联事件',
  `related_character_id` int(11) DEFAULT NULL COMMENT '关联人物'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL COMMENT '留言信息'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1765089942),
('m130524_201442_init', 1765089947),
('m190124_110200_add_verification_token_column_to_user_table', 1765089947);

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '题目内容',
  `option_a` varchar(500) NOT NULL COMMENT 'A',
  `option_b` varchar(500) NOT NULL COMMENT 'B',
  `option_c` varchar(500) NOT NULL COMMENT 'C',
  `option_d` varchar(500) NOT NULL COMMENT 'D',
  `correct_answer` char(1) NOT NULL COMMENT '正确答案',
  `related_event_id` int(11) DEFAULT NULL COMMENT '关联事件',
  `related_character_id` int(11) DEFAULT NULL COMMENT '关联人物'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `founded_date` date DEFAULT NULL COMMENT '成立时间',
  `description` text DEFAULT NULL COMMENT '队伍描述',
  `force_id` int(11) DEFAULT NULL COMMENT '所属势力id',
  `leader_id` int(11) DEFAULT NULL COMMENT '领导人id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(3, 'admin', 'bn6DYakXSYpVFH9GV52it_OHzzKAG0Bi', '$2y$13$esqvwaMq5WZ4BuWBQjJry.hja9PSTRbjfxPS7rnVMWAjNpCzQzM0G', NULL, 'sgdu@qq.com', 10, 1765090350, 1765090350, 'N1dspu9CNeozTAne2GFdl_FDRRSoGLkn_1765090350');

--
-- 转储表的索引
--

--
-- 表的索引 `battle_events`
--
ALTER TABLE `battle_events`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `diplomatic_events`
--
ALTER TABLE `diplomatic_events`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `forces`
--
ALTER TABLE `forces`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `meeting_events`
--
ALTER TABLE `meeting_events`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mem_activities`
--
ALTER TABLE `mem_activities`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mem_works`
--
ALTER TABLE `mem_works`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- 表的索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `battle_events`
--
ALTER TABLE `battle_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `diplomatic_events`
--
ALTER TABLE `diplomatic_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `forces`
--
ALTER TABLE `forces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `meeting_events`
--
ALTER TABLE `meeting_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mem_activities`
--
ALTER TABLE `mem_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mem_works`
--
ALTER TABLE `mem_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
