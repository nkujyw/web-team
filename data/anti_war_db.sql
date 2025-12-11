-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-11 12:18:44
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

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

--
-- 转存表中的数据 `battle_events`
--

INSERT INTO `battle_events` (`id`, `force1_id`, `force2_id`, `casualties`) VALUES
(1, 5, 8, '具体数据不详'),
(2, 5, 8, '中国军队伤亡约25万，日本军队伤亡约4万'),
(3, 5, 8, '防守部队大量伤亡'),
(4, 6, 8, '日军1000余人被歼灭，100余辆汽车被击毁，一批辎重和武器被缴。'),
(5, 5, 8, '中国军队约29万人参战，日军参战人数约5万人。中方伤亡约5万余人，毙伤日军约1万余人'),
(6, 6, 8, '日伪军被歼灭5万余人，八路军伤亡1.7万人，中毒2万余人'),
(7, 5, 8, '中方伤亡约10万人，日军伤亡约3万人'),
(8, 5, 8, '中国军队以伤亡约13.9万人的代价，共歼灭日军11万余人'),
(9, 5, 8, '歼敌2.8万余人'),
(10, 5, 8, '日军死亡约2万人，伤近6万人\r\n我方守军牺牲1万6千余众，最后仅存1200余人'),
(11, 5, 8, '中方牺牲14000余人，日方伤亡5000余人');

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
  `related_force_ids` varchar(500) DEFAULT NULL COMMENT '	\r\n相关国家'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `diplomatic_events`
--

INSERT INTO `diplomatic_events` (`id`, `related_force_ids`) VALUES
(19, '中国、苏联'),
(20, '中国、美国'),
(21, '中国、日本等多国'),
(22, '中国、多国记者'),
(23, '中国、国际红十字会'),
(24, '中国、美国'),
(25, '中国、菲律宾'),
(26, '中国、印度'),
(27, '中国、美国'),
(28, '中国');

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

--
-- 转存表中的数据 `events`
--

INSERT INTO `events` (`id`, `name`, `start_date`, `end_date`, `location_id`, `description`, `outcome`, `event_type`) VALUES
(1, '卢沟桥事变', '1937-07-07', '1937-07-28', 1, '日军借口士兵失踪挑衅并多次进攻宛平城与卢沟桥，标志着日本帝国主义发动全面侵华战争，也标志着中国全民族抗战的开端，由此开辟了世界反法西斯战争的东方主战场。', '北平沦陷。', 'battle'),
(2, '淞沪会战', '1937-08-13', '1937-11-12', 2, '淞沪会战是全面抗战中规模最大、战斗最惨烈的战役。此役粉碎了日军“三月亡华”计划，迫使其侵华主力由华北转向华东，为中国赢得了战略主动与工矿内迁时间。', '中国军队顽强抵抗三个月后撤退。', 'battle'),
(3, '南京保卫战', '1937-12-01', '1937-12-13', 3, '南京为首都防御要地，淞沪会战后日军大举西进，中国军队在唐生智指挥下以11万兵力苦守南京，但在日军三路合围和猛烈攻势下城防相继失守，\r\n         12月13日南京沦陷，随后日军制造了惨绝人寰的南京大屠杀。', '南京失陷', 'battle'),
(4, '平型关大捷', '1937-09-25', '1937-09-25', 13, '八路军伏击日军运输队，是华北战场上中国军队主动歼敌的第一个重大胜利，打破了“日军不可战胜”的神话。', '八路军取得战役胜利。', 'battle'),
(5, '台儿庄战役', '1938-03-16', '1938-04-15', 14, '是抗日战争以来取得的最大胜利，它打击了日本侵略者的嚣张气焰，坚定了全国军民坚持抗战的信心。', '中国军队大捷。', 'battle'),
(6, '百团大战', '1940-08-20', '1941-01-24', 7, '八路军对华北日军交通线发动大规模破袭战，参战兵力达105个团，是抗日战争相持阶段八路军在华北地区发动的一次规模最大、持续时间最长的战役。', '沉重打击日军交通补给线。', 'battle'),
(7, '太原会战', '1937-09-13', '1937-11-08', 4, '山西有“华北之锁钥”之称，省会太原更为战略重镇。中国军队在山西太原地区与日军展开大规模防御作战，历时近两个月。', '太原失守', 'battle'),
(8, '长沙会战', '0000-00-00', '0000-00-00', 6, '中国军队与侵华日军在以长沙为中心的第九战区进行的三次大规模的激烈攻防战。会战重创日军有生力量，有效保卫了湖南和华南国土', '中国军队胜利。', 'battle'),
(9, '湘西会战', '1945-04-09', '1945-06-07', 6, '又称雪峰山会战，是中国抗日战争时期正面战场的最后一次会战。湘西会战的反攻，拉开了中国军队战略总反攻的序幕，抗日正面战场由防御转入反攻阶段', '中国军队胜利。', 'battle'),
(10, '衡阳保卫战', '1944-06-23', '1944-08-08', 11, '是中国抗战史上敌我双方伤亡最多、中国军队正面交战时间最长的城市攻防战，被誉为“东方的莫斯科保卫战”。衡阳保卫战历时长达48昼夜，以守军弹尽援绝、伤亡殆尽而惨烈告终。中国军队以少战多重创日本军。 ', '衡阳失守', 'battle'),
(11, '昆仑关战役', '0000-00-00', '0000-00-00', 15, '1939年12月，中国军队为阻止日军继续南进，在广西昆仑关地区与日军展开激烈攻坚战。国军经过多日鏖战，成功攻克昆仑关，是国民党正面战场自武汉失守以来取得的一次重大胜利。', '中国军队成功夺取昆仑关。', 'battle'),
(12, '第一次国共重庆会谈', '1937-09-20', '1937-09-21', 9, '国共双方在重庆进行合作谈判，确认共同抗日大政方针。', '正式形成第二次国共合作。', 'meeting'),
(13, '中共七大', '1945-04-23', '1945-06-11', 8, '中国共产党第七次全国代表大会，总结抗战经验。', '为抗战胜利和建国奠定政治基础。', 'meeting'),
(14, '洛川会议', '1937-08-22', '1937-08-25', 8, '中共中央召开洛川会议，制定全面抗战路线。', '确立抗日民族统一战线策略。', 'meeting'),
(15, '庐山谈话会', '1937-07-09', '1937-07-11', 5, '蒋介石号召全国准备全面抗战。', '全民抗战意识加强。', 'meeting'),
(16, '西安事变善后会议', '1936-12-25', '1936-12-31', 9, '国共双方就和平解决西安事变进行谈判。', '推动抗日民族统一战线正式形成。', 'meeting'),
(17, '开罗会议', '1943-11-22', '1943-11-26', 16, '中美英三国讨论对日战争目标，提出日本归还侵占领土。', '发布《开罗宣言》。', 'meeting'),
(18, '波茨坦公告制定会议', '1945-07-17', '1945-07-26', 17, '美英中三国发布波茨坦公告，要求日本无条件投降。', '日本投降条件明确化。', 'meeting'),
(19, '中苏互不侵犯条约', '1937-08-21', '1937-08-21', 18, '中国与苏联签署互不侵犯条约，奠定军事援助基础。', '苏联开始向中国提供军事援助。', 'diplomatic'),
(20, '中美合作修建滇缅公路', '1938-11-01', '1938-11-01', 19, '中国与美国合作建设滇缅公路保障国际援华物资运输。', '加强战略运输能力。', 'diplomatic'),
(21, '中国参与远东国际军事法庭筹备', '1945-11-01', '1945-11-30', 20, '中国参与制定东京审判国际司法框架。', '为追究日本战犯奠定法律基础。', 'diplomatic'),
(22, '外国记者揭露南京大屠杀', '1937-12-15', '1938-02-01', 3, '多国记者记录日军暴行并向外传播。', '国际社会对日本侵略的谴责增强。', 'diplomatic'),
(23, '国际红十字援华行动', '1938-03-01', '1945-08-01', 2, '国际红十字会提供大量医疗设备与物资援助中国抗战。', '改善战区医疗条件。', 'diplomatic'),
(24, '宋美龄赴美演讲', '1943-02-04', '1943-02-28', 19, '宋美龄赴美国国会发表著名演讲，极大推动美国援华。', '美国民意转向全面支持中国。', 'diplomatic'),
(25, '中菲抗日合作会谈', '1940-05-01', '1940-05-01', 21, '中国与菲律宾民族力量建立合作，协调情报与物资。', '东南亚地区反日合作增强。', 'diplomatic'),
(26, '中印反殖民与反日合作', '1942-02-01', '1942-02-01', 22, '中国与印度民族运动组织合作反对帝国主义扩张。', '促进亚洲反侵略统一阵线。', 'diplomatic'),
(27, '中美平等新约签订', '1943-01-11', '1943-01-11', 19, '中美废除不平等条约，建立平等外交关系。', '提升中国国际地位。', 'diplomatic'),
(28, '中国签署联合国宪章', '1945-06-26', '1945-06-26', 23, '中国作为战胜国之一正式签署联合国宪章。', '确立中国世界大国地位。', 'diplomatic');

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
(15, '昆仑关', 'battle_site', '桂南会战核心区域，中国军队成功阻击日军。'),
(16, '开罗', 'diplomacy_site', '中美英三国在此召开开罗会议，讨论对日作战与战后安排。'),
(17, '波茨坦', 'diplomacy_site', '美英中三国发布波茨坦公告的会议所在地。'),
(18, '莫斯科', 'diplomacy_site', '中苏互不侵犯条约签署地点'),
(19, '华盛顿', 'diplomacy_site', '中美签署援华协定的重要地点'),
(20, '东京', 'diplomacy_site', '远东国际军事法庭所在地'),
(21, '马尼拉', 'diplomacy_site', '中菲抗日合作会谈所在地'),
(22, '新德里', 'diplomacy_site', '中国与印度民族运动组织进行反殖民与抗日合作的主要外交地点'),
(23, '旧金山', 'diplomacy_site', '联合国宪章签署大会的举办城市，中国在此签署宪章');

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

--
-- 转存表中的数据 `meeting_events`
--

INSERT INTO `meeting_events` (`id`, `meeting_date`, `attendees`, `agenda`) VALUES
(12, '1937-09-20', '周恩来、张治中等', '确认抗日合作内容'),
(13, '1945-04-23', '中共代表大会', '抗战经验总结与未来方针'),
(14, '1937-08-22', '中共中央领导', '制定全面抗战路线'),
(15, '1937-07-09', '国民政府高层', '全国抗战动员'),
(16, '1936-12-25', '国共代表', '和平解决西安事变'),
(17, '1943-11-22', '蒋介石、罗斯福、丘吉尔', '对日作战与战后安排'),
(18, '1945-07-17', '美英中三国代表', '对日无条件投降要求');

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

--
-- 转存表中的数据 `messages`
--

INSERT INTO `messages` (`id`, `message`) VALUES
(1, '铭记历史，吾辈自强！向抗战英雄致敬！'),
(2, '珍爱和平，远离战争。今天的幸福生活来之不易。'),
(3, '历史是最好的教科书，也是最好的清醒剂。'),
(4, '一寸山河一寸血，十万青年十万军。致敬先烈！'),
(5, '勿忘国耻，振兴中华！'),
(6, '看着这些历史资料，眼眶湿润了，伟大的中国人民万岁！');

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

--
-- 转存表中的数据 `question`
--

INSERT INTO `question` (`id`, `content`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `related_event_id`, `related_character_id`) VALUES
(1, '标志着中国全民族抗战开始的历史事件是？', '九一八事变', '七七事变（卢沟桥事变）', '西安事变', '八一三事变', 'B', 1, NULL),
(2, '打破了日军“不可战胜”神话，是抗战以来中国军队取得的第一个重大胜利的战役是？', '台儿庄大捷', '昆仑关大捷', '平型关大捷', '百团大战', 'C', 4, 4),
(3, '粉碎了日军“三个月灭亡中国”的企图，为中国民族工业内迁赢得时间的战役是？', '淞沪会战', '太原会战', '徐州会战', '武汉会战', 'A', 2, 1),
(4, '百团大战是抗日战争相持阶段八路军在华北地区发动的一次规模最大、持续时间最长的战役，其主要指挥官是？', '朱德', '毛泽东', '刘伯承', '彭德怀', 'D', 6, 9),
(5, '1943年11月，中美英三国首脑在埃及举行会议，发表了什么文件要求日本归还窃取的中国领土？', '《波茨坦公告》', '《大西洋宪章》', '《开罗宣言》', '《联合国家宣言》', 'C', 17, 1),
(6, '在枣宜会战中壮烈殉国，被周恩来称为“全国军人楷模”的国民党高级将领是？', '佟麟阁', '赵登禹', '张自忠', '戴安澜', 'C', NULL, 4),
(7, '抗战期间，毛泽东撰写的哪篇著作系统阐述了持久战的战略思想？', '《论持久战》', '《论联合政府》', '《中国革命和中国共产党》', '《新民主主义论》', 'A', NULL, 7),
(8, '被称为“东方的莫斯科保卫战”，中国军队坚守48天，重创日军的城市攻防战是？', '长沙保卫战', '常德会战', '衡阳保卫战', '武汉会战', 'C', 10, 3),
(9, '指挥三次长沙会战，创造“天炉战法”歼灭大量日军的中国将领是？', '孙立人', '薛岳', '白崇禧', '卫立煌', 'B', 8, 6),
(10, '日本天皇宣布无条件投降的日期是？', '1945年8月15日', '1945年9月2日', '1945年9月3日', '1945年9月9日', 'A', NULL, 13);

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
(5, '八路军120师', '1937-08-25', '师长贺龙，政委关向应。该师主要在晋西北地区开展游击战争，创建晋绥抗日根据地。1938年先后进行同蒲铁路破袭战、雁门关伏击战等，切断日军交通线。1939年4月，在齐会战斗中歼灭日军700余人，创下平原歼灭战范例。该师还派出主力一部挺进冀中，帮助当地抗日武装发展壮大。', 6, NULL),
(6, '八路军129师', '1937-08-25', '师长刘伯承，政委邓小平。该师以太行山为依托，创建晋冀鲁豫抗日根据地，是华北敌后抗战的重要力量。神头岭伏击战歼灭日军1500余人，响堂铺伏击战毁伤日军汽车180辆。百团大战中该师担任主攻，破袭正太铁路，沉重打击了日军\"囚笼政策\"。抗战期间该师发展壮大为30万人的武装力量。', 6, 10),
(7, '新四军第1支队', '1938-04-01', '司令员陈毅，副司令员傅秋涛。主要在苏南地区开展游击战争，创建茅山抗日根据地。该支队积极打击日伪军，先后取得韦岗战斗、新丰车站战斗等胜利。1940年7月，在黄桥决战中歼灭国民党顽固派军队1.1万余人，打开了华中抗战的新局面。皖南事变后，该支队改编为新四军第1师，继续坚持华中抗战。', 7, NULL),
(8, '新四军第2支队', '1938-04-01', '司令员张鼎丞，副司令员粟裕。主要在皖南地区活动，后进入苏南，与第1支队共同创建抗日根据地。该支队在粟裕指挥下，灵活运用游击战术，先后取得官陡门战斗、狸头桥战斗等胜利。1939年11月，在水阳镇战斗中歼灭日军300余人。该支队培养了大批优秀指挥员，为华中抗战做出了重要贡献。', 7, NULL),
(9, '日本华北方面军', '1937-08-31', '日军在华北地区的最高指挥机关，首任司令官寺内寿一大将。该方面军下辖多个师团，是侵华日军的主力部队。先后发动太原会战、徐州会战、武汉会战等重大战役，占领华北广大地区。在八路军等抗日武装的不断打击下，该方面军深陷游击战争的泥潭，始终无法完全控制华北地区。', 8, 13),
(10, '日本关东军', '1919-04-12', '长期驻扎中国东北的日军主力部队，号称\"皇军之花\"。司令官梅津美治郎大将。该军装备精良，训练有素，是日本陆军中最具战斗力的部队。虽然主要任务是防御苏联，但也抽调部分兵力参加关内作战。太平洋战争爆发后，关东军精锐陆续调往南洋战场，实力不断削弱。1945年8月被苏联红军彻底消灭。', 8, 14),
(11, '伪满洲国军', '1932-09-15', '日本扶植的伪满洲国武装力量，总司令张景惠。该军主要由原东北军改编而成，在日军控制下担任辅助作战和维持治安任务。虽然装备较差、战斗力弱，但在镇压东北抗日联军、维持殖民统治方面发挥了恶劣作用。1945年随着日本的战败而瓦解。', 9, NULL),
(12, '汪伪和平建国军', '1940-03-30', '汪精卫伪政权的武装力量，总司令汪精卫。该军主要由投日的国民党部队改编而成，在华中、华东地区协助日军作战，清乡剿共。虽然规模庞大，但士气低落、战斗力差，主要担任辅助任务。在抗日军民的打击下不断瓦解，1945年日本投降后彻底崩溃。', 9, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
