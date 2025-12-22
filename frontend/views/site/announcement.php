<?php
/**
 * announcement.php
 * 公告详情视图文件
 * 根据传入的 ID 显示对应的公告内容。
 * @author 吉圆伟
 * @date 2025-12-15
 */
use yii\helpers\Html;
use yii\helpers\Url;

$data = [
    // 1. 免费开放
    1 => [
        'title' => '关于“九一八”事变纪念日免费开放的通知',
        'date'  => '2025-09-10',
        'source'=> '纪念馆办公室',
        'content' => '
            <p>各位游客、市民朋友：</p>
            <p>为铭记历史、缅怀先烈，在“九一八”事变爆发94周年之际，中国抗战胜利纪念网线下体验馆将于9月18日（周四）全天免费向公众开放。</p>
            <p><strong>一、开放时间：</strong><br>上午 09:00 - 下午 17:00（16:30 停止入馆）</p>
            <p><strong>二、参观须知：</strong><br>1. 请携带本人有效身份证件入馆。<br>2. 团体参观请提前3天致电预约。<br>3. 馆内严禁吸烟，请保持安静。</p>
            <p>特此通知。</p>
        '
    ],
    // 2. 口述历史
    2 => [
        'title' => '“寻找抗战记忆”老兵口述历史征集活动启动',
        'date'  => '2025-08-15',
        'source'=> '文物保护部',
        'content' => '
            <p>为了抢救珍贵的抗战历史记忆，传承红色基因，我馆即日起正式启动“寻找抗战记忆”口述历史征集活动。</p>
            <p>我们将组建专门的采访团队，深入社区、乡村，寻访健在的抗战老兵、支前模范及大屠杀幸存者，通过录音、录像的方式记录那段峥嵘岁月。</p>
            <p>如果您身边有相关线索，欢迎联系我们。让我们共同努力，让历史不再尘封。</p>
            <p><strong>联系电话：</strong>010-12345678</p>
        '
    ],
    // 3. 巡回展
    3 => [
        'title' => '我馆举办抗战文物巡回展',
        'date'  => '2025-07-01',
        'source'=> '宣教部',
        'content' => '
            <p>为庆祝建党104周年，我馆精心挑选了100件珍贵抗战文物，开展“流动博物馆”进校园、进社区巡回展览活动。</p>
            <p>本次展览分为“中流砥柱”、“日军暴行”、“伟大胜利”三个部分，旨在让更多青少年了解历史，增强爱国主义情感。</p>
            <p>首站将于7月5日在南开大学举办，欢迎广大师生前往参观。</p>
        '
    ],
    // 4. 诵读活动
    4 => [
        'title' => '关于举办“穿越时空的对话——红色家书”诵读活动的通知',
        'date'  => '2025-06-20',
        'source'=> '宣传部',
        'content' => '
            <p>一封家书，一段历史，一份深情。为弘扬抗战精神，感悟革命先辈的家国情怀，我馆将于7月7日举办“红色家书”诵读活动。</p>
            <p><strong>活动时间：</strong>2025年7月7日 上午9:30</p>
            <p><strong>活动地点：</strong>纪念馆一楼报告厅</p>
            <p>欢迎广大市民及朗诵爱好者报名参加，让我们在诵读中重温那段烽火岁月。</p>
        '
    ],
    // 5. 志愿者招募
    5 => [
        'title' => '2025年度暑期大学生志愿讲解员招募公告',
        'date'  => '2025-06-01',
        'source'=> '志愿者服务队',
        'content' => '
            <p>为了更好地服务观众，发挥博物馆的社会教育功能，现面向高校招募暑期志愿讲解员30名。</p>
            <p><strong>招募要求：</strong><br>1. 热爱文博事业，具有奉献精神；<br>2. 普通话标准，表达能力强；<br>3. 能够保证暑期至少服务15天。</p>
            <p><strong>报名方式：</strong>请发送简历至 volunteer@1937china.com。</p>
        '
    ],
    // 6. 文物征集
    6 => [
        'title' => '关于面向社会公开征集抗战时期民间文物的公告',
        'date'  => '2025-05-15',
        'source'=> '文物保管部',
        'content' => '
            <p>为丰富馆藏，全面反映抗战历史，现面向社会公开征集抗战时期各类实物。</p>
            <p><strong>征集范围：</strong><br>1. 抗战时期的武器装备、军服、证章；<br>2. 反映日军侵华罪行的照片、刊物、信件；<br>3. 抗战英烈的遗物、手稿等。</p>
            <p>我馆将对捐赠者颁发收藏证书，并给予适当奖励。</p>
        '
    ]
];
// 获取当前 ID 对应的数据，如果找不到，就默认显示第1条
$current = isset($data[$id]) ? $data[$id] : $data[1];
$this->title = $current['title'] . ' - 公告详情';
?>

<div class="site-announcement" style="background-color: #f9f9f9; min-height: 80vh; padding-bottom: 50px;">
    <div class="container">
        
        <nav aria-label="breadcrumb" style="padding-top: 20px;">
            <ol class="breadcrumb" style="background: none; padding-left: 0;">
                <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>" class="text-danger">首页</a></li>
                <li class="breadcrumb-item active">通知公告</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <div class="text-center mb-4" style="border-bottom: 1px solid #eee; padding-bottom: 20px;">
                    <h2 style="color: #B71C1C; font-weight: bold; margin-bottom: 15px;">
                        <?= Html::encode($current['title']) ?>
                    </h2>
                    <div class="text-muted small">
                        <span class="mr-3">发布日期：<?= $current['date'] ?></span>
                        <span>来源：<?= $current['source'] ?></span>
                    </div>
                </div>

                <div class="content" style="font-size: 16px; line-height: 2; color: #333;">
                    <?= $current['content'] ?>
                </div>

                <div class="text-right mt-5" style="font-weight: bold;">
                    <p>中国抗战胜利纪念网<br><?= $current['date'] ?></p>
                </div>

            </div>
            
            <div class="card-footer bg-white text-center border-0 pb-4">
                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-outline-secondary btn-sm">返回上一页</a>
            </div>
        </div>
    </div>
</div>