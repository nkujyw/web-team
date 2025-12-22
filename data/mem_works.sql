-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-22 09:47:22
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
(1, '《论持久战》', '文章', '毛泽东', '1938-05-01', '毛泽东在延安抗日战争研究会上的演讲稿首版本，系统阐述了持久战战略思想，科学预见了抗战将经历战略防御、战略相持、战略反攻三个阶段，对指导全国抗战产生了深远影响。', '/image/mem_works/1.png', NULL, NULL),
(2, '《黄河大合唱》', '音乐作品', '冼星海', '1939-03-31', '人民音乐家冼星海创作的《黄河大合唱》原始手稿，包含《黄河船夫曲》《黄河颂》《黄河怨》等八个乐章。作品以黄河为背景，热情歌颂中华民族源远流长的光荣历史和中国人民坚强不屈的斗争精神。', '/image/mem_works/2.png', NULL, NULL),
(3, '《义勇军进行曲》', '音频', '聂耳', '1935-05-01', '由田汉作词、聂耳作曲的《义勇军进行曲》最早录音版本。这首歌曲在抗战期间传唱大江南北，极大鼓舞了全国军民的抗战士气，后被定为中华人民共和国国歌。', '/image/mem_works/3.png', NULL, NULL),
(4, '平型关大捷油画', '绘画', '孙浩', '2009-07-23', '孙浩创作的《平型关大捷》大型油画，生动描绘了八路军115师在平型关伏击日军板垣师团的壮观场面。画面气势恢宏，人物刻画生动，充分展现了中国军队的英勇顽强。', '/image/mem_works/4.png', NULL, NULL),
(5, '《八佰》', '影视', '管虎', '2020-08-21', '以淞沪会战四行仓库保卫战为背景的电影，讲述“八百壮士”坚守四行仓库、阻击日军的故事。影片真实再现了中国军人视死如归的英勇精神，获得巨大社会反响。', '/image/mem_works/5.png', NULL, NULL),
(6, '南京大屠杀纪念馆雕塑', '雕塑', '吴为山', '2007-12-13', '设立在侵华日军南京大屠杀遇难同胞纪念馆前的主题雕塑《家破人亡》。雕塑高12.13米，寓意南京大屠杀开始日期，表现一位悲痛欲绝的母亲抱着死去的孩子仰天呼号，具有强烈的艺术感染力。', '/image/mem_works/6.png', NULL, NULL),
(7, '《铁道游击队》', '绘画', '丁斌曾', '1954-01-01', '描绘鲁南铁道游击队抗战斗争的经典连环画，共200余幅。生动再现了铁道游击队在铁路线上机智勇敢打击日军的传奇故事，是几代中国人的集体记忆。', '/image/mem_works/7.png', NULL, NULL),
(8, '抗战木刻版画集', '版画', '古元', '1942-08-01', '延安木刻艺术家古元创作的抗战主题木刻版画系列，包括《人民的刘志丹》《减租会》等作品。这些版画在物资匮乏的延安创作，用艺术形式记录和宣传抗战，极具历史价值。', '/image/mem_works/8.png', NULL, NULL),
(9, '滇缅公路修建纪录片', '影视', '中央电影摄影厂', '1942-05-01', '记录20万云南各族民众修建滇缅公路的珍贵纪录片。在缺乏机械设备的条件下，人们用双手在崇山峻岭中开辟出这条“抗战生命线”，影片展现了中国人民的坚韧和智慧。', '/image/mem_works/9.png', NULL, NULL),
(10, '太行山上', '油画', '徐悲鸿', '1941-06-15', '描绘太行山抗日根据地八路军战士英勇作战的场景，展现了山区游击战的艰苦环境。', '/image/mem_works/10.png', NULL, NULL),
(11, '百团大战', '版画', '力群', '1942-08-20', '以黑白木刻表现百团大战的激烈战斗场面，突出八路军破袭铁路的英勇行为。', '/image/mem_works/11.png', NULL, NULL),
(12, '地道战', '连环画', '华三川', '1965-05-10', '描绘冀中平原军民利用地道与日军周旋作战的智慧战术，共150幅。', '/image/mem_works/12.png', NULL, NULL),
(13, '南京保卫战', '油画', '陈逸飞', '1987-12-13', '表现南京保卫战中中国守军浴血奋战的悲壮场面，色彩凝重肃穆。', '/image/mem_works/13.png', NULL, NULL),
(14, '飞虎队', '摄影集', '罗伯特·卡帕', '0000-00-00', '美国援华航空志愿队（飞虎队）在中国战场作战的珍贵战地摄影。', '/image/mem_works/14.png', NULL, NULL),
(15, '滇缅公路', '纪录片', '郑君里', '1944-03-18', '记录20万民工修建滇缅公路的艰苦过程，以及这条\"生命线\"对抗战的贡献。', '/image/mem_works/15.png', NULL, NULL),
(16, '台儿庄大捷', '油画', '靳尚谊', '1995-04-07', '描绘台儿庄战役胜利后中国军队欢庆的场景，表现抗战首次重大胜利。', '/image/mem_works/16.png', NULL, NULL),
(17, '八路军出征', '雕塑', '刘开渠', '1950-08-01', '表现八路军115师开赴抗日前线的青铜群雕，高3.5米。', '/image/mem_works/17.png', NULL, NULL),
(18, '抗战歌曲集', '音乐', '冼星海等', '1939-12-20', '收录《黄河大合唱》《在太行山上》等300余首抗战歌曲的手稿影印本。', '/image/mem_works/18.png', NULL, NULL),
(19, '长沙会战', '水墨画', '李可染', '1978-09-14', '以泼墨手法表现三次长沙会战的惨烈战斗，画面气势恢宏。', '/image/mem_works/19.png', NULL, NULL),
(21, '延安文艺座谈会', '油画', '罗工柳', '1972-05-23', '表现毛泽东在延安文艺座谈会上发表讲话的历史场景。', '/image/mem_works/21.png', NULL, NULL),
(23, '细菌战受害', '摄影', '王小亭', '1998-11-11', '记录侵华日军731部队细菌战受害者的纪实摄影作品。', '/image/mem_works/23.png', NULL, NULL),
(24, '抗战木刻选集', '版画', '古元、彦涵等', '1949-10-01', '收录延安鲁迅艺术学院木刻工作团创作的抗战主题木刻版画80幅。', '/image/mem_works/24.png', NULL, NULL),
(25, '驼峰航线', '油画', '詹建俊', '2005-08-15', '表现中美飞行员飞越\"驼峰航线\"向中国运送战略物资的艰险航程。', '/image/mem_works/25.png', NULL, NULL),
(26, '日本投降书', '书法', '何应钦', '1945-09-09', '何应钦代表中国接受日本投降的文书影印本，具有重要历史价值。', '/image/mem_works/26.png', NULL, NULL),
(27, '东北抗联', '雕塑', '钱绍武', '1991-09-18', '表现东北抗日联军在冰天雪地中坚持战斗的青铜群雕。', '/image/mem_works/27.png', NULL, NULL),
(28, '抗战漫画集', '漫画', '丰子恺、张乐平等', '1946-12-25', '收录抗战时期发表的讽刺漫画200余幅，揭露日军暴行，鼓舞民心。', '/image/mem_works/28.png', NULL, NULL),
(29, '滇西抗战', '油画', '全山石', '2010-09-03', '表现中国远征军反攻滇西、收复腾冲的激烈战斗场面。', '/image/mem_works/29.png', NULL, NULL),
(31, '飞虎队战机', '模型', '陈纳德', '1944-05-20', '陈纳德将军赠送的P-40战斗机精密模型，机头绘有鲨鱼嘴图案。', '/image/mem_works/31.png', NULL, NULL),
(32, '南京审判', '油画', '陈丹青', '2006-01-19', '表现东京审判和南京审判历史场景的系列油画作品。', '/image/mem_works/32.png', NULL, NULL),
(33, '八路军战歌', '乐谱', '郑律成', '1939-11-07', '郑律成创作《八路军进行曲》（后为解放军军歌）的手稿影印本。', '/image/mem_works/33.png', NULL, NULL),
(35, '延安宝塔山', '油画', '吴作人', '1972-10-01', '表现延安宝塔山及抗日军政大学学员学习训练的场景。', '/image/mem_works/35.png', NULL, NULL),
(36, '日本暴行录', '文献', '国际检察局', '1948-11-12', '东京审判中作为证据的日军暴行照片和文件汇编影印本。', '/image/mem_works/36.png', NULL, NULL),
(37, '抗战家书', '书法', '左权等', '2005-08-15', '收录左权、赵一曼等抗战将领写给家人的书信手迹影印本。', '/image/mem_works/37.png', NULL, NULL),
(38, '细菌战证据', '文献', '王选', '2002-08-27', '中国细菌战受害者对日诉讼提交的证人证言和证据材料汇编。', '/image/mem_works/38.png', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
