<?php

use yii\helpers\Url;

$this->title = '英雄与部队';

$this->registerCssFile('@web/css/character.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js');
$this->registerJsFile('@web/js/chinaMap.js', ['position' => \yii\web\View::POS_END]);
?>

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
    <h2>反法西斯阵营</h2>

    <div class="force-intro">
    <h3>主要抗战力量</h3>
    <?php foreach ($antiForces as $force): ?>
        <div class="force-card">
        <strong><?= $force->name ?></strong>
        <p><?= $force->description ?></p>
        </div>
    <?php endforeach; ?>
    </div>


    <div class="flags">
    <img src="<?= Url::to('@web/image/flags/共产党.png') ?>" alt="中国共产党">
    <img src="<?= Url::to('@web/image/flags/国民党.png') ?>" alt="中国国民党">
    <img src="<?= Url::to('@web/image/flags/美国.png') ?>" alt="美国">
    <img src="<?= Url::to('@web/image/flags/英国.png') ?>" alt="英国">
    </div>

    <div class="axis-sections">
    <div class="axis-section-title">人物介绍</div>
    </div>


    <div class="heroes">
      <?php foreach ($antiHeroes as $hero): ?>
        <div class="hero">
          <img src="<?= Yii::getAlias('@web') . $hero->url ?>">
          <h4><?= $hero->name ?></h4>
          <span><?= $hero->rank ?></span>
          <p><?= $hero->achievements ?></p>
        </div>
      <?php endforeach; ?>
    </div>

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
    <h2>法西斯阵营</h2>

    <div class="force-intro">
    <h3>侵略与傀儡势力</h3>
    <?php foreach ($axisForces as $force): ?>
        <div class="force-card">
        <strong><?= $force->name ?></strong>
        <p><?= $force->description ?></p>
        </div>
    <?php endforeach; ?>
    </div>
    
    <div class="flags">
    <img src="<?= Url::to('@web/image/flags/日本.png') ?>" alt="日本">
    <img src="<?= Url::to('@web/image/flags/伪满洲.png') ?>" alt="伪满洲国">
    <img src="<?= Url::to('@web/image/flags/德国.png') ?>" alt="德国">
    </div>  

    <!-- 新增：法西斯阵营下一级分区标题 -->
    <div class="axis-sections">
    <div class="axis-section-title">人物介绍</div>
    </div>

    <div class="heroes">
      <?php foreach ($axisHeroes as $hero): ?>
        <div class="hero">
          <img src="<?= Yii::getAlias('@web') . $hero->url ?>">
          <h4><?= $hero->name ?></h4>
          <span><?= $hero->rank ?></span>
          <p><?= $hero->achievements ?></p>
        </div>
      <?php endforeach; ?>
    </div>

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

