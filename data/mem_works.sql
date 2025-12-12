-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-12 11:45:56
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

--
-- 转存表中的数据 `mem_works`
--

INSERT INTO `mem_works` (`id`, `name`, `type`, `author`, `create_date`, `description`, `url`, `related_event_id`, `related_character_id`) VALUES
(2, '《黄河大合唱》', '音乐作品', '冼星海', '1939-03-31', '人民音乐家冼星海创作的《黄河大合唱》原始手稿，包含《黄河船夫曲》《黄河颂》《黄河怨》等八个乐章。作品以黄河为背景，热情歌颂中华民族源远流长的光荣历史和中国人民坚强不屈的斗争精神。', '/image/mem_works/2.png', NULL, NULL),
(3, '《义勇军进行曲》', '音频', '聂耳', '1935-05-01', '由田汉作词、聂耳作曲的《义勇军进行曲》最早录音版本。这首歌曲在抗战期间传唱大江南北，极大鼓舞了全国军民的抗战士气，后被定为中华人民共和国国歌。', '/image/mem_works/3.png', NULL, NULL),
(4, '平型关大捷油画', '绘画', '孙浩', '2009-07-23', '孙浩创作的《平型关大捷》大型油画，生动描绘了八路军115师在平型关伏击日军板垣师团的壮观场面。画面气势恢宏，人物刻画生动，充分展现了中国军队的英勇顽强。', '/image/mem_works/4.png', NULL, NULL),
(5, '《八佰》', '影视', '管虎', '2020-08-21', '以淞沪会战四行仓库保卫战为背景的电影，讲述“八百壮士”坚守四行仓库、阻击日军的故事。影片真实再现了中国军人视死如归的英勇精神，获得巨大社会反响。', '/image/mem_works/5.png', NULL, NULL),
(6, '南京大屠杀纪念馆雕塑', '雕塑', '吴为山', '2007-12-13', '设立在侵华日军南京大屠杀遇难同胞纪念馆前的主题雕塑《家破人亡》。雕塑高12.13米，寓意南京大屠杀开始日期，表现一位悲痛欲绝的母亲抱着死去的孩子仰天呼号，具有强烈的艺术感染力。', '/image/mem_works/6.png', NULL, NULL),
(7, '《铁道游击队》', '绘画', '丁斌曾', '1954-01-01', '描绘鲁南铁道游击队抗战斗争的经典连环画，共200余幅。生动再现了铁道游击队在铁路线上机智勇敢打击日军的传奇故事，是几代中国人的集体记忆。', '/image/mem_works/7.png', NULL, NULL),
(8, '抗战木刻版画集', '版画', '古元', '1942-08-01', '延安木刻艺术家古元创作的抗战主题木刻版画系列，包括《人民的刘志丹》《减租会》等作品。这些版画在物资匮乏的延安创作，用艺术形式记录和宣传抗战，极具历史价值。', '/image/mem_works/8.png', NULL, NULL),
(9, '滇缅公路修建纪录片', '影视', '中央电影摄影厂', '1942-05-01', '记录20万云南各族民众修建滇缅公路的珍贵纪录片。在缺乏机械设备的条件下，人们用双手在崇山峻岭中开辟出这条“抗战生命线”，影片展现了中国人民的坚韧和智慧。', '/image/mem_works/9.png', NULL, NULL),
(10, '《论持久战》', '文章', '毛泽东', '1938-05-01', '毛泽东在延安抗日战争研究会上的演讲稿首版本，系统阐述了持久战战略思想，科学预见了抗战将经历战略防御、战略相持、战略反攻三个阶段，对指导全国抗战产生了深远影响。', '/image/mem_works/10.png', NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `mem_works`
--
ALTER TABLE `mem_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_work_event` (`related_event_id`),
  ADD KEY `fk_work_character` (`related_character_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `mem_works`
--
ALTER TABLE `mem_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 限制导出的表
--

--
-- 限制表 `mem_works`
--
ALTER TABLE `mem_works`
  ADD CONSTRAINT `fk_work_character` FOREIGN KEY (`related_character_id`) REFERENCES `characters` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_work_event` FOREIGN KEY (`related_event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
