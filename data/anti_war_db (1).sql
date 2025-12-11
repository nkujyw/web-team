-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-10 14:48:18
-- 服务器版本： 10.4.27-MariaDB
-- PHP 版本： 7.4.33

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
  `id` int(11) NOT NULL COMMENT '与events表共享主键',
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

--
-- 转存表中的数据 `characters`
--

INSERT INTO `characters` (`id`, `name`, `biography`, `force_id`, `achievements`, `rank`, `url`) VALUES
(1, '蒋介石', '抗战时期中国国民政府的最高领导人与军事统帅。', 5, '统筹全国抗战，组织多次大规模会战。', '总司令', '/image/Characters/1.png'),
(2, '何应钦', '国民政府高级将领，参与国家军事战略与抗战部署。', 5, '负责组织与指挥正面战场作战行动，对抗战战略有重要影响。', '陆军一级上将', '/image/Characters/2.png'),
(3, '白崇禧', '国军著名战术家，被称为“小诸葛”，善于调度兵力与灵活作战。', 5, '在武汉会战、衡阳保卫战等多场关键战役中发挥重要作用。', '陆军上将', '/image/Characters/3.png'),
(4, '张自忠', '国民政府著名抗日将领，在前线英勇作战并殉国。', 5, '在枣宜会战中英勇抵抗日军，被视为抗战烈士典型。', '军长', '/image/Characters/4.png'),
(5, '孙立人', '留美将领，具有现代化军事训练背景，在滇缅作战中表现突出。', 5, '指挥新编军参与援缅作战，成功救援英军部队。', '中将', '/image/Characters/5.png'),
(6, '薛岳', '国军名将，擅长防御战术，是长沙会战的重要指挥者。', 5, '成功策划并指挥三次长沙会战，重创日军。', '上将', '/image/Characters/6.png'),
(7, '毛泽东', '中国共产党主要领导人，在抗战中提出战略指导思想。', 6, '提出《论持久战》，为中国抗战提供理论支持。', '主席', '/image/Characters/7.png'),
(8, '朱德', '八路军总司令，是共产党军事力量的核心人物之一。', 6, '组织与指挥八路军开展敌后游击战，推动军队扩展。', '总司令', '/image/Characters/8.png'),
(9, '彭德怀', '八路军副总司令，坦荡刚直的军事统帅。', 6, '主导百团大战，破坏敌军交通要道，振奋全国士气。', '副总司令', '/image/Characters/9.png'),
(10, '刘伯承', '著名军事指挥员，以严谨治军与善用地形闻名。', 6, '带领八路军 129 师在敌后坚持长期作战。', '师长', '/image/Characters/10.png'),
(11, '邓小平', '129 师政委，兼具军事与政治才能。', 6, '与刘伯承共同指挥敌后作战，巩固根据地。', '政委', '/image/Characters/11.png'),
(12, '叶挺', '新四军军长，坚定的抗日力量象征。', 7, '领导新四军坚持华中敌后斗争，扩大抗日力量。', '军长', '/image/Characters/12.png'),
(13, '东条英机', '日本陆军将领与政治人物，在侵华政策中扮演核心角色', 8, '推动侵华战略，使战争进一步扩大。', '陆军大将', '/image/Characters/13.png'),
(14, '冈村宁次', '侵华日军高级将领，负责多地军事行动。', 8, '组织“清乡”“扫荡”等行动，对抗战造成严重影响。', '大将', '/image/Characters/14.png'),
(15, '松井石根', '日本华中方面军司令官，指挥南京战役。', 8, '直接指挥对南京的军事行动。', '大将', '/image/Characters/15.png'),
(16, '板垣征四郎', '日本军国主义政治与军事核心人物之一。', 8, '参与策划九一八事变，推动日本扩张。', '大将', '/image/Characters/16.png'),
(17, '溥仪', '伪满洲国名义皇帝，被日本利用作为傀儡。', 9, '担任伪满洲国象征性统治者。', '皇帝', '/image/Characters/17.png'),
(18, '史迪威', '美国援华将领，协调盟军对华支援。', 5, '负责中国战区的军事训练与物资支援。', '将军', '/image/Characters/18.png'),
(19, '梅津美治郎', '日本高级将领之一，战争结束时负责签署投降文书。', 8, '代表日本在盟军面前签署降书。', '大将', '/image/Characters/19.png');

-- --------------------------------------------------------

--
-- 表的结构 `diplomatic_events`
--

CREATE TABLE `diplomatic_events` (
  `id` int(11) NOT NULL COMMENT '与events表共享主键',
  `related_force_ids` varchar(500) DEFAULT NULL COMMENT '	\r\n相关势力ID'
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
  `outcome` text DEFAULT NULL COMMENT '事件影响',
  `event_type` enum('battle','diplomatic','meeting') NOT NULL COMMENT '事件类型'
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

--
-- 转存表中的数据 `forces`
--

INSERT INTO `forces` (`id`, `name`, `type`, `description`) VALUES
(5, '中华民国国民革命军', 1, '抗战时期国民政府正规军，是正面战场的主要力量。'),
(6, '中国共产党八路军', 2, '共产党领导的华北敌后武装，执行游击战与破袭作战。'),
(7, '中国共产党新四军', 2, '共产党在华中建立的敌后抗日武装力量。'),
(8, '日本陆军', 3, '侵华战争的主要军事力量，多次发动大规模进攻。'),
(9, '伪满洲国军及政权体系', 4, '日本在东北建立的傀儡政权体系，用于辅助军事统治。');

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

--
-- 转存表中的数据 `locations`
--

INSERT INTO `locations` (`id`, `name`, `type`, `description`) VALUES
(1, '卢沟桥', 'battle_site', '七七事变发生地，是抗战全面爆发的起点。'),
(2, '上海淞沪地区', 'battle_site', '淞沪会战主要爆发区域，中日双方投入大量兵力。'),
(3, '南京', 'city', '抗战初期的首都，1937 年陷落后遭受重大浩劫。'),
(4, '太原', 'city', '晋北会战重要城市，是华北战略防线关键点。'),
(5, '武汉', 'city', '战略大撤退关键城市，抗战重要政治与军事中心。'),
(6, '长沙', 'city', '长沙会战爆发地，中国军队多次击退日军。'),
(7, '太行山区', 'guerrilla_base', '八路军根据地之一，也是百团大战重要战区。'),
(8, '延安', 'base_city', '中国共产党在抗战时期的政治中心。'),
(9, '重庆', 'city', '抗战陪都，是政治与军事后方中心。'),
(10, '滇缅公路沿线', 'logistics_route', '中国抗战时期最重要的国际物资运输通道。'),
(11, '衡阳', 'city', '衡阳保卫战发生地，中国军队顽强抵抗。'),
(12, '东北林区', 'guerrilla_area', '东北抗联活动区域，自然条件恶劣。'),
(13, '平型关', 'battle_site', '八路军取得平型关大捷的地点。'),
(14, '台儿庄', 'battle_site', '台儿庄大捷发生地，中国取得阶段性胜利。'),
(15, '昆仑关', 'battle_site', '桂南会战核心区域，中国军队成功阻击日军。');

-- --------------------------------------------------------

--
-- 表的结构 `meeting_events`
--

CREATE TABLE `meeting_events` (
  `id` int(11) NOT NULL COMMENT '与events表共享主键',
  `meeting_date` date DEFAULT NULL COMMENT '	\r\n会议日期',
  `attendees` text DEFAULT NULL COMMENT '	\r\n参会人员',
  `agenda` text DEFAULT NULL COMMENT '	\r\n会议议程'
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_battle_force1` (`force1_id`),
  ADD KEY `fk_battle_force2` (`force2_id`);

--
-- 表的索引 `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_character_force` (`force_id`);

--
-- 表的索引 `diplomatic_events`
--
ALTER TABLE `diplomatic_events`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event_location` (`location_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_activity_location` (`location_id`);

--
-- 表的索引 `mem_works`
--
ALTER TABLE `mem_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_work_event` (`related_event_id`),
  ADD KEY `fk_work_character` (`related_character_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_event` (`related_event_id`),
  ADD KEY `fk_question_character` (`related_character_id`);

--
-- 表的索引 `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_team_force` (`force_id`),
  ADD KEY `fk_team_leader` (`leader_id`);

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
-- 使用表AUTO_INCREMENT `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `forces`
--
ALTER TABLE `forces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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

--
-- 限制导出的表
--

--
-- 限制表 `battle_events`
--
ALTER TABLE `battle_events`
  ADD CONSTRAINT `fk_battle_event` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_battle_force1` FOREIGN KEY (`force1_id`) REFERENCES `forces` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_battle_force2` FOREIGN KEY (`force2_id`) REFERENCES `forces` (`id`) ON DELETE SET NULL;

--
-- 限制表 `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `fk_character_force` FOREIGN KEY (`force_id`) REFERENCES `forces` (`id`) ON DELETE SET NULL;

--
-- 限制表 `diplomatic_events`
--
ALTER TABLE `diplomatic_events`
  ADD CONSTRAINT `fk_diplomatic_event` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- 限制表 `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL;

--
-- 限制表 `meeting_events`
--
ALTER TABLE `meeting_events`
  ADD CONSTRAINT `fk_meeting_event` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- 限制表 `mem_activities`
--
ALTER TABLE `mem_activities`
  ADD CONSTRAINT `fk_activity_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL;

--
-- 限制表 `mem_works`
--
ALTER TABLE `mem_works`
  ADD CONSTRAINT `fk_work_character` FOREIGN KEY (`related_character_id`) REFERENCES `characters` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_work_event` FOREIGN KEY (`related_event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;

--
-- 限制表 `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_character` FOREIGN KEY (`related_character_id`) REFERENCES `characters` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_question_event` FOREIGN KEY (`related_event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;

--
-- 限制表 `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_team_force` FOREIGN KEY (`force_id`) REFERENCES `forces` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_team_leader` FOREIGN KEY (`leader_id`) REFERENCES `characters` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
