<?php

use yii\helpers\Url;

$this->title = '英雄与部队';

$this->registerCssFile('@web/css/character.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js');
$this->registerJsFile('@web/js/chinaMap.js', ['position' => \yii\web\View::POS_END]);
?>

<link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/character.css">


<!-- ===================== 阵营对比（左右双栏） ===================== -->
<section class="main">

  <!-- ========== 左：反法西斯阵营 ========== -->
  <div class="camp camp-anti">

    <h2>反法西斯阵营</h2>

    <!-- 国旗 -->
    <div class="flags">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/共产党.png">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/国民党.png">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/united.png">
    </div>

    <!-- 国家分组 -->
    <div class="teams">

      <!-- 中国共产党 -->
      <div class="team">
        <h3>中国共产党</h3>
        <div style="display:flex; gap:44px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/毛泽东.png" width="120">
          <p>中国共产党率先倡导并推动抗日民族统一战线，领导八路军、新四军深入敌后，广泛发动群众，开展游击战争，建立抗日根据地，长期牵制和消耗日军力量。</p>
        </div>
      </div>

      <!-- 国民党 -->
      <div class="team">
        <h3>中国国民党</h3>
        <div style="display:flex; gap:20px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/蒋介石.png" width="120">
          <p>中国国民党政府在全国抗战中承担了正面战场的主要作战任务。国民革命军在淞沪、台儿庄、武汉、长沙等重大战役中与日军正面作战，付出了巨大人员和物资牺牲,也在争取国际承认和外援方面发挥了关键作用。</p>
        </div>
      </div>

      <!-- 苏联 -->
      <div class="team">
        <h3>苏联</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/斯大林.png" width="120">
          <p>苏联是世界反法西斯战争的重要支柱，在欧洲战场正面打击纳粹德国，同时在中国抗战初期向中国提供飞机、武器和军事顾问，并派志愿航空队参战，对遏制法西斯扩张发挥了关键作用。战能力，对稳定战局具有重要意义。</p>
        </div>
      </div>

      <!-- 美国 -->
      <div class="team">
        <h3>美国</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/罗斯福.png" width="120">
          <p>美国在珍珠港事件后对日宣战，成为反法西斯同盟的重要成员。美国通过租借法案向中国提供大量军事和经济援助，并派遣飞虎队协助中国空军作战。美国的工业生产能力和资源支持对抗击日本侵略起到了关键作用。</p>
        </div>
      </div>

    </div>
  </div>

  <!-- ========== 右：法西斯阵营 ========== -->
  <div class="camp camp-axis">

    <h2>法西斯阵营</h2>

    <!-- 国旗 -->
    <div class="flags">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/日本.png">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/伪满洲.png">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/德国.png">
    </div>

    <!-- 国家分组 -->
    <div class="teams">

      <!-- 日本 -->
      <div class="team">
        <h3>日本</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/昭和天皇.png" width="120">
          <p>1931年发动九一八事变侵占中国东北，1937年全面侵华，并在亚洲发动大规模战争。随着太平洋战争失利、国内外压力加剧，1945年在盟军打击和苏联出兵后宣布无条件投降。</p>
        </div>
      </div>

      <!-- 伪满洲国 -->
      <div class="team">
        <h3>伪满洲国</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/溥仪.png" width="120">
          <p>1932年在日本扶植下于中国东北成立，作为侵略中国的殖民政权存在，完全受日本控制。1945年苏联红军进军东北，日本战败，伪满洲国随即覆灭。</p>
        </div>
      </div>

      <!-- 德国 -->
      <div class="team">
        <h3>德国</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/希特勒.png" width="120">
          <p>1939年入侵波兰，引发第二次世界大战，在欧洲迅速扩张。后期在苏德战场和西线遭到重大失败，1945年柏林被攻占，纳粹政权崩溃并宣布投降。</p>
        </div>
      </div>

      <!-- 意大利 -->
      <div class="team">
        <h3>意大利</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/墨索里尼.png" width="120">
          <p>在墨索里尼统治下发动对外侵略，参与法西斯同盟并加入二战。战争中连遭失败，1943年政权倒台并转而对德作战，1945年法西斯政权彻底瓦解。</p>
        </div>
      </div>

    </div>
  </div>

</section>



<!-- 地图标题 -->
<div class="map-title">
  抗日战争形势图
  <span>（1931.9.18 – 1945.9.3）</span>
</div>

<!-- 中国地图 -->
<div id="chinaMap"></div>

    <!-- 地图图例（就在这里） -->
    <div class="legend">
        <div class="legend-item">
            <span class="legend-dot" style="background:#8B1A1A;"></span>
            东北三省（伪满洲国 / 满洲国占领区）
        </div>
        <div class="legend-item">
            <span class="legend-dot" style="background:#C0392B;"></span>
            已被日本占领的地区
        </div>
        <div class="legend-item">
            <span class="legend-dot" style="background:#F5A9A9;"></span>
            曾遭受侵略但未完全占领的地区
        </div>
        <div class="legend-item">
            <span class="legend-dot" style="background:#F8EFEA;"></span>
            未被侵略波及的地区
        </div>
    </div>

<div class="main">


  <!-- 反法西斯阵营 -->
  <section class="camp camp-anti">

    <div class="axis-sections">
    <div class="axis-section-title">军队介绍</div>
    </div>

    <div class="teams">
      <?php foreach ($antiTeams as $team): ?>
        <div class="team">
          <strong><?= $team->name ?></strong>
          <em><?= $team->founded_date ?></em>
          <p><?= $team->description ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 法西斯阵营 -->
  <section class="camp camp-axis">

    <div class="axis-sections">
    <div class="axis-section-title">军队介绍</div>
    </div>

    <div class="teams">
      <?php foreach ($axisTeams as $team): ?>
        <div class="team">
          <strong><?= $team->name ?></strong>
          <em><?= $team->founded_date ?></em>
          <p><?= $team->description ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

</div>



<?php
$heroSubtitles = [
    '江竹筠' => '十指钉竹签，信仰比钢坚',
    '赵一曼' => '红枪白马女政委',
    '杨靖宇' => '白山黑水间的民族脊梁',
    '杨学诚' => '鄂中大地上的青年先锋',
];
?>

<section class="hero-martyrs">
  <h2 class="martyr-title">英雄集锦</h2>
  <p class="martyr-subtitle">天地英雄气，千秋尚凛然</p>

  <div class="martyr-grid">
    <?php foreach ($heroMartyrs as $hero): ?>
      <div class="martyr-card">
        <span class="red-star">★</span>

        <img src="<?= Yii::getAlias('@web') . $hero->url ?>" alt="<?= $hero->name ?>">

        <h4><?= $hero->name ?></h4>

        <?php if (isset($heroSubtitles[$hero->name])): ?>
          <div class="hero-subtitle">
            <?= $heroSubtitles[$hero->name] ?>
          </div>
        <?php endif; ?>

        <p><?= $hero->biography ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

