<?php
$this->title = '英雄与部队';

$this->registerCssFile('@web/css/character.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js');
$this->registerJsFile('@web/js/chinaMap.js', ['position' => \yii\web\View::POS_END]);
?>

<div id="chinaMap"></div>

<div class="main">

  <!-- 反法西斯阵营 -->
  <section class="camp camp-anti">
    <h2>反法西斯阵营</h2>

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
