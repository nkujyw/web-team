-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-11 10:04:48
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

--
-- 转存表中的数据 `mem_activities`
--

INSERT INTO `mem_activities` (`id`, `name`, `activity_date`, `location_id`, `organizer`, `description`, `photo_url`) VALUES
(1, '南京大屠杀死难者国家公祭日仪式', '2023-12-13', 3, '中共中央、国务院', '在侵华日军南京大屠杀遇难同胞纪念馆举行的国家公祭仪式，中共中央、全国人大常委会、国务院、全国政协、中央军委负责同志出席，南京全城鸣笛致哀，社会各界代表3000余人参加，缅怀30万死难同胞。', '\\image\\mem_activities\\1.png'),
(2, '中国人民抗日战争胜利78周年纪念大会', '2023-09-03', 1, '中国人民抗日战争纪念馆', '在卢沟桥畔中国人民抗日战争纪念馆举行的胜利日纪念活动，抗战老战士、英烈亲属、青少年学生等各界代表参加。活动包括向英烈敬献花篮、参观主题展览、抗战历史讲座等内容。', '\\image\\mem_activities\\2.png'),
(3, '“永不磨灭的记忆”抗战文物巡回展', '2023-07-07', 1, '国家博物馆', '纪念七七事变86周年特别展览，展出抗战文物500余件，包括武器装备、历史文献、照片、书信等珍贵实物。展览在北京首展后，将赴上海、重庆、西安等十余个城市巡回展出。', '\\image\\mem_activities\\3.png'),
(4, '滇西抗战纪念馆开馆仪式', '2023-08-15', 10, '云南省政府', '在云南腾冲滇西抗战纪念馆新馆举行的开馆仪式，原中国远征军老兵及亲属、专家学者、当地群众等千余人参加。新馆展出文物1200余件，全景展现滇西抗战历史。', '\\image\\mem_activities\\4.png'),
(5, '抗战老兵口述历史采集活动', '2023-10-25', 9, '重庆抗战遗址博物馆', '组织志愿者团队采访在渝抗战老兵，以视频、音频、文字形式记录老兵抗战经历。已采访老兵37位，累计录制口述历史视频500余小时，整理文字资料30万字。', '\\image\\mem_activities\\5.png'),
(6, '“重走抗战路”青少年夏令营', '2023-07-20', 8, '共青团中央', '组织全国100名优秀中学生参加的重走抗战路主题夏令营，行程涵盖延安、太行山、沂蒙山等抗战根据地。同学们通过实地参观、体验教学、与老区群众交流等形式学习抗战历史。', '\\image\\mem_activities\\6.png'),
(7, '抗战经典电影公益展映月', '2023-08-01', 2, '上海市电影局', '在全市30家影院举行为期一个月的抗战电影公益展映，放映《地道战》《地雷战》《血战台儿庄》《南京！南京！》等经典影片50余场，观众可免费领取观影票。', '\\image\\mem_activities\\7.png'),
(8, '日本细菌战受害诉讼声援集会', '2023-09-18', 12, '侵华日军第七三一部队罪证陈列馆', '在九一八事变纪念日举行的声援集会，支持细菌战受害者对日诉讼。集会上公布了新发现的731部队档案资料，专家学者、受害者家属、市民代表等发表讲话。', '\\image\\mem_activities\\8.png');

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
(2, '《黄河大合唱》', '音乐作品', '冼星海', '1939-03-31', '人民音乐家冼星海创作的《黄河大合唱》原始手稿，包含《黄河船夫曲》《黄河颂》《黄河怨》等八个乐章。作品以黄河为背景，热情歌颂中华民族源远流长的光荣历史和中国人民坚强不屈的斗争精神。', '\\image\\mem_works\\2.png', NULL, NULL),
(3, '《义勇军进行曲》', '音频', '聂耳', '1935-05-01', '由田汉作词、聂耳作曲的《义勇军进行曲》最早录音版本。这首歌曲在抗战期间传唱大江南北，极大鼓舞了全国军民的抗战士气，后被定为中华人民共和国国歌。', '\\image\\mem_works\\3.png', NULL, NULL),
(4, '平型关大捷油画', '绘画', '孙浩', '2009-07-23', '孙浩创作的《平型关大捷》大型油画，生动描绘了八路军115师在平型关伏击日军板垣师团的壮观场面。画面气势恢宏，人物刻画生动，充分展现了中国军队的英勇顽强。', '\\image\\mem_works\\4.png', NULL, NULL),
(5, '《八佰》', '影视', '管虎', '2020-08-21', '以淞沪会战四行仓库保卫战为背景的电影，讲述“八百壮士”坚守四行仓库、阻击日军的故事。影片真实再现了中国军人视死如归的英勇精神，获得巨大社会反响。', '\\image\\mem_works\\5.png', NULL, NULL),
(6, '南京大屠杀纪念馆雕塑', '雕塑', '吴为山', '2007-12-13', '设立在侵华日军南京大屠杀遇难同胞纪念馆前的主题雕塑《家破人亡》。雕塑高12.13米，寓意南京大屠杀开始日期，表现一位悲痛欲绝的母亲抱着死去的孩子仰天呼号，具有强烈的艺术感染力。', '\\image\\mem_works\\6.png', NULL, NULL),
(7, '《铁道游击队》', '绘画', '丁斌曾', '1954-01-01', '描绘鲁南铁道游击队抗战斗争的经典连环画，共200余幅。生动再现了铁道游击队在铁路线上机智勇敢打击日军的传奇故事，是几代中国人的集体记忆。', '\\image\\mem_works\\7.png', NULL, NULL),
(8, '抗战木刻版画集', '版画', '古元', '1942-08-01', '延安木刻艺术家古元创作的抗战主题木刻版画系列，包括《人民的刘志丹》《减租会》等作品。这些版画在物资匮乏的延安创作，用艺术形式记录和宣传抗战，极具历史价值。', '\\image\\mem_works\\8.png', NULL, NULL),
(9, '滇缅公路修建纪录片', '影视', '中央电影摄影厂', '1942-05-01', '记录20万云南各族民众修建滇缅公路的珍贵纪录片。在缺乏机械设备的条件下，人们用双手在崇山峻岭中开辟出这条“抗战生命线”，影片展现了中国人民的坚韧和智慧。', '\\image\\mem_works\\9.png', NULL, NULL),
(10, '《论持久战》', '文章', '毛泽东', '1938-05-01', '毛泽东在延安抗日战争研究会上的演讲稿首版本，系统阐述了持久战战略思想，科学预见了抗战将经历战略防御、战略相持、战略反攻三个阶段，对指导全国抗战产生了深远影响。', '\\image\\mem_works\\10.png', NULL, NULL);

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

--
-- 转存表中的数据 `teams`
--

INSERT INTO `teams` (`id`, `name`, `founded_date`, `description`, `force_id`, `leader_id`) VALUES
(1, '国民革命军第1军', '1937-08-20', '抗战初期中央军精锐部队，被誉为\"天下第一军\"。军长胡宗南，该军装备精良，兵员素质高，是蒋介石的嫡系主力。先后参加淞沪会战、武汉会战、豫湘桂战役等重大战役，在正面战场发挥了重要作用。抗战期间该军转战大半个中国，伤亡惨重但始终坚守阵地。', 5, 2),
(2, '国民革命军第5军', '1938-01-15', '中国历史上第一支机械化部队，被誉为\"铁马雄师\"。军长杜聿明，装备有坦克、装甲车等先进武器。1939年参加昆仑关战役，与日军精锐第5师团激战，最终收复昆仑关，击毙日军旅团长中村正雄。1942年作为中国远征军主力入缅作战，虽然在同古战役中表现出色，但因盟军配合不力最终失利。', 5, NULL),
(3, '国民革命军第74军', '1937-09-01', '抗战期间战绩最辉煌、战斗力最强的部分，被誉为“抗日铁军”。参加过上高会战、第二次长沙会战、常德会战等重大战役，几乎无败绩。上高会战中重创日军第34师团，毙伤日军1.5万余人；常德会战中死守常德城16昼夜，虽最终城破但极大消耗日军有生力量。该军作风顽强，善于打硬仗、恶仗。', 5, 3),
(4, '八路军115师', '1937-08-25', '八路军三大主力师之首，师长林彪，副师长聂荣臻。1937年9月25日，该师在平型关伏击日军板垣师团后勤部队，歼敌1000余人，缴获大量军用物资，取得全国抗战以来第一个重大胜利，打破了\"日军不可战胜\"的神话。后该师分兵发展，聂荣臻率部创建晋察冀抗日根据地，成为华北抗战的重要堡垒', 6, NULL),
(5, '八路军120师', '1937-08-25', '师长贺龙，政委关向应。该师主要在晋西北地区开展游击战争，创建晋绥抗日根据地。1938年先后进行同蒲铁路破袭战、雁门关伏击战等，切断日军交通线。1939年4月，在齐会战斗中歼灭日军700余人，创下平原歼灭战范例。该师还派出主力一部挺进冀中，帮助当地抗日武装发展壮大。', 6, 0),
(6, '八路军129师', '1937-08-25', '师长刘伯承，政委邓小平。该师以太行山为依托，创建晋冀鲁豫抗日根据地，是华北敌后抗战的重要力量。神头岭伏击战歼灭日军1500余人，响堂铺伏击战毁伤日军汽车180辆。百团大战中该师担任主攻，破袭正太铁路，沉重打击了日军\"囚笼政策\"。抗战期间该师发展壮大为30万人的武装力量。', 6, 10),
(7, '新四军第1支队', '1938-04-01', '司令员陈毅，副司令员傅秋涛。主要在苏南地区开展游击战争，创建茅山抗日根据地。该支队积极打击日伪军，先后取得韦岗战斗、新丰车站战斗等胜利。1940年7月，在黄桥决战中歼灭国民党顽固派军队1.1万余人，打开了华中抗战的新局面。皖南事变后，该支队改编为新四军第1师，继续坚持华中抗战。', 7, 0),
(8, '新四军第2支队', '1938-04-01', '司令员张鼎丞，副司令员粟裕。主要在皖南地区活动，后进入苏南，与第1支队共同创建抗日根据地。该支队在粟裕指挥下，灵活运用游击战术，先后取得官陡门战斗、狸头桥战斗等胜利。1939年11月，在水阳镇战斗中歼灭日军300余人。该支队培养了大批优秀指挥员，为华中抗战做出了重要贡献。', 7, 0),
(9, '日本华北方面军', '1937-08-31', '日军在华北地区的最高指挥机关，首任司令官寺内寿一大将。该方面军下辖多个师团，是侵华日军的主力部队。先后发动太原会战、徐州会战、武汉会战等重大战役，占领华北广大地区。在八路军等抗日武装的不断打击下，该方面军深陷游击战争的泥潭，始终无法完全控制华北地区。', 8, 13),
(10, '日本关东军', '1919-04-12', '长期驻扎中国东北的日军主力部队，号称\"皇军之花\"。司令官梅津美治郎大将。该军装备精良，训练有素，是日本陆军中最具战斗力的部队。虽然主要任务是防御苏联，但也抽调部分兵力参加关内作战。太平洋战争爆发后，关东军精锐陆续调往南洋战场，实力不断削弱。1945年8月被苏联红军彻底消灭。', 8, 14),
(11, '伪满洲国军', '1932-09-15', '日本扶植的伪满洲国武装力量，总司令张景惠。该军主要由原东北军改编而成，在日军控制下担任辅助作战和维持治安任务。虽然装备较差、战斗力弱，但在镇压东北抗日联军、维持殖民统治方面发挥了恶劣作用。1945年随着日本的战败而瓦解。', 9, 0),
(12, '汪伪和平建国军', '1940-03-30', '汪精卫伪政权的武装力量，总司令汪精卫。该军主要由投日的国民党部队改编而成，在华中、华东地区协助日军作战，清乡剿共。虽然规模庞大，但士气低落、战斗力差，主要担任辅助任务。在抗日军民的打击下不断瓦解，1945年日本投降后彻底崩溃。', 9, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `meeting_events`
--
ALTER TABLE `meeting_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mem_activities`
--
ALTER TABLE `mem_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mem_works`
--
ALTER TABLE `mem_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
