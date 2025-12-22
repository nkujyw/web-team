<?php
/**
 * frontend/views/site/speech.php
 * 重要讲话视图文件
 * 包含：习近平在纪念中国人民抗日战争暨世界反法西斯战争胜利80周年大会上的讲话全文
 * @author 2311786 吉圆伟
 * @date 2025-12-16
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '重要讲话 - 中国抗战胜利纪念网';
?>

<div class="site-speech" style="background-color: #f9f9f9; min-height: 100vh; padding-bottom: 50px;">
    <div class="container">
        
        <nav aria-label="breadcrumb" style="padding-top: 20px;">
            <ol class="breadcrumb" style="background: none; padding-left: 0;">
                <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>" class="text-danger">首页</a></li>
                <li class="breadcrumb-item active" aria-current="page">重要讲话</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-5">
                
                <div class="text-center mb-5" style="border-bottom: 1px solid #eee; padding-bottom: 30px;">
                    <div style="width: 60px; height: 4px; background: #B71C1C; margin: 0 auto 20px;"></div>
                    
                    <h1 style="font-family: 'SimHei', 'STHeiti', serif; color: #333; font-weight: bold; font-size: 2.2rem; margin-bottom: 20px; line-height: 1.4;">
                        在纪念中国人民抗日战争暨<br>世界反法西斯战争胜利80周年大会上的讲话
                    </h1>
                    
                    <div class="text-danger font-weight-bold" style="font-size: 1.1rem; margin-bottom: 15px;">
                        习近平
                    </div>
                    
                    <div class="text-muted small">
                        <span class="mr-3">（2025年9月3日，上午）</span>
                        <span>来源：新华社</span>
                    </div>
                </div>

                <div class="speech-content" style="
                    font-size: 18px; 
                    line-height: 2; 
                    color: #2c3e50; 
                    font-family: 'Microsoft YaHei', sans-serif;
                    text-align: justify; /* 两端对齐 */
                ">
                    
                    <p class="font-weight-bold text-center" style="color: #666; margin-bottom: 30px;">
                        新华社北京9月3日电
                    </p>

                    <p style="margin-bottom: 10px;">
                        全国同胞们，<br>
                        尊敬的各位国家元首、政府首脑和国际组织代表，<br>
                        尊敬的各位来宾，<br>
                        全体受阅将士们，<br>
                        同志们、朋友们：
                    </p>

                    <p class="indent-text">
                        今天，我们隆重集会，纪念中国人民抗日战争暨世界反法西斯战争胜利80周年，共同铭记历史、缅怀先烈、珍爱和平、开创未来。
                    </p>

                    <p class="indent-text">
                        我代表中共中央、全国人大、国务院、全国政协、中央军委，向全国参加过抗日战争的老战士、老同志、爱国人士和抗日将领，向为中国人民抗日战争胜利作出重大贡献的海内外中华儿女，致以崇高敬意！向支援和帮助过中国人民抵抗侵略的外国政府和国际友人，表示衷心感谢！向参加今天大会的各国来宾，表示热烈欢迎！
                    </p>

                    <p class="indent-text">
                        同志们、朋友们！
                    </p>

                    <p class="indent-text">
                        中国人民抗日战争是艰苦卓绝的伟大战争。在中国共产党倡导建立的抗日民族统一战线旗帜下，中国人民以铮铮铁骨战强敌、以血肉之躯筑长城，取得近代以来反抗外敌入侵的第一次完全胜利。
                    </p>

                    <p class="indent-text">
                        中国人民抗日战争是世界反法西斯战争的重要组成部分，中国人民以巨大的民族牺牲，为拯救人类文明、保卫世界和平作出了重大贡献。
                    </p>

                    <p class="indent-text">
                        历史警示我们，人类命运休戚与共，各个国家、各个民族只有平等相待、和睦相处、守望相助，才能维护共同安全，消弭战争根源，不让历史悲剧重演！
                    </p>

                    <p class="indent-text">
                        同志们、朋友们！
                    </p>

                    <p class="indent-text">
                        中华民族是不畏强暴、自立自强的伟大民族。当年，面对正义与邪恶、光明与黑暗、进步与反动的生死较量，中国人民同仇敌忾、奋起反抗，为国家生存而战，为民族复兴而战，为人类正义而战。今天，人类又面临和平还是战争、对话还是对抗、共赢还是零和的抉择。中国人民坚定站在历史正确一边、站在人类文明进步一边，坚持走和平发展道路，与各国人民携手构建人类命运共同体。
                    </p>

                    <p class="indent-text">
                        中国人民解放军始终是党和人民完全可以信赖的英雄部队。全军将士要忠实履行神圣职责，加快建设世界一流军队，坚决维护国家主权、统一、领土完整，为实现中华民族伟大复兴提供战略支撑，为世界和平与发展作出更大贡献！
                    </p>

                    <p class="indent-text">
                        历史承载过去，也启迪未来。新时代新征程，全国各族人民要在中国共产党坚强领导下，坚持马克思列宁主义、毛泽东思想、邓小平理论、“三个代表”重要思想、科学发展观，全面贯彻新时代中国特色社会主义思想，坚定不移走中国特色社会主义道路，传承和弘扬伟大抗战精神，踔厉奋发、勇毅前行，为以中国式现代化全面推进强国建设、民族复兴伟业而团结奋斗！
                    </p>

                    <p class="indent-text font-weight-bold" style="font-size: 20px; color: #B71C1C; margin-top: 30px;">
                        中华民族伟大复兴势不可挡！人类和平与发展的崇高事业必将胜利！
                    </p>

                </div>
            </div>
            
            <div class="text-center pb-5">
                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-danger px-5 py-2" style="border-radius: 50px;">
                    <i class="fa fa-reply"></i> 返回首页
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* 专门控制首行缩进的类 */
.indent-text {
    text-indent: 2em;
    margin-bottom: 25px;
}
</style>