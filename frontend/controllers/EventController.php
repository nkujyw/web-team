<?php

namespace frontend\controllers; 

use Yii;
use common\models\Events;     
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class EventController extends Controller
{

    /**
     * 【首页的】重大战役详情页
     * 对应路由：index.php?r=event/important-battle&id=1
     */
    public function actionImportantBattle($id)
    {
        // 1. 找数据
        $model = Events::findOne($id);
        
        // 2. 如果找不到，抛出404
        if ($model === null) {
            throw new NotFoundHttpException('找不到这条战役数据。');
        }

        // 3. 渲染视图 'important_battle.php'
        return $this->render('important_battle', [
            'model' => $model,
        ]);
    }

}