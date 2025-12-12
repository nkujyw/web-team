<?php
$frontendImagePath = Yii::getAlias('@frontend/web/image');
$backendImagePath = Yii::getAlias('@backend/web/image');

if (!is_link($backendImagePath) && !is_dir($backendImagePath)) {
    if (PHP_OS_FAMILY === 'Windows') {
        exec('mklink /D "' . $backendImagePath . '" "' . $frontendImagePath . '"');
    } else {
        symlink($frontendImagePath, $backendImagePath);
    }
}