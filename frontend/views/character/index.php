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
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/美国.png">
      <img src="<?= Yii::getAlias('@web') ?>/image/flags/英国.png">
    </div>

    <!-- 国家分组 -->
    <div class="teams">

      <!-- 中国共产党 -->
      <div class="team">
        <h3>中国共产党</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/毛泽东.png" width="120">
          <p>领导敌后抗战，建立广泛抗日根据地，发动群众战争，牵制大量日军主力。</p>
        </div>
      </div>

      <!-- 国民党 -->
      <div class="team">
        <h3>中国国民党</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/蒋介石.png" width="120">
          <p>正面战场主力承担者，组织淞沪、武汉、长沙等大会战，抵抗日军正面进攻。</p>
        </div>
      </div>

      <!-- 苏联 -->
      <div class="team">
        <h3>苏联</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/斯大林.png" width="120">
          <p>向中国提供军事顾问、飞行员与装备援助，对日保持战略牵制。</p>
        </div>
      </div>

      <!-- 美国 -->
      <div class="team">
        <h3>美国</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/罗斯福.png" width="120">
          <p>通过租借法案提供物资支援，派遣飞虎队援华，对日宣战后形成太平洋战场。</p>
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
          <p>发动全面侵华战争，实施南京大屠杀、细菌战、三光政策等严重战争罪行。</p>
        </div>
      </div>

      <!-- 伪满洲国 -->
      <div class="team">
        <h3>伪满洲国</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/溥仪.png" width="120">
          <p>日本扶植的傀儡政权，为侵略提供资源、劳工与政治掩护。</p>
        </div>
      </div>

      <!-- 德国 -->
      <div class="team">
        <h3>德国</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/希特勒.png" width="120">
          <p>欧洲法西斯核心国家，与日本结盟，对世界反法西斯战争构成重大威胁。</p>
        </div>
      </div>

      <!-- 意大利 -->
      <div class="team">
        <h3>意大利</h3>
        <div style="display:flex; gap:24px;">
          <img src="<?= Yii::getAlias('@web') ?>/image/characters/墨索里尼.png" width="120">
          <p>法西斯同盟国之一，在欧洲与北非战场参与侵略行动。</p>
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

