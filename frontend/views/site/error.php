<?php
/**
 * error.php
 * 错误页面视图文件
 * 用于显示错误信息，如 404 未找到页面等。
 * @author 吉圆伟
 * @date 2025-12-15
 */


use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error container" style="padding: 50px 0;">

    <div class="alert alert-danger">
        <h1 class="text-danger"><i class="fa fa-exclamation-triangle"></i> <?= Html::encode($this->title) ?></h1>
        <hr>
        <p style="font-size: 18px;">
            <?= nl2br(Html::encode($message)) ?>
        </p>
    </div>

    <p>
        请联系管理员或尝试返回首页。
    </p>
    <a href="index.php" class="btn btn-primary">返回首页</a>

</div>