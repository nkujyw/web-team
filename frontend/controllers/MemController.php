<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class MemController extends Controller
{
    /**
     * 纪念馆首页
     */
    public function actionIndex()
    {
        // 设置页面标题
        $this->view->title = '网上纪念馆 - 中国抗战胜利80周年纪念网';
        
        return $this->render('index', [
            // 这里可以传递数据给视图，暂时留空
        ]);
    }
    
    /**
     * 纪念馆详情页（示例）
     */
    public function actionView($id)
    {
        // 可以后续添加详情页逻辑
        return $this->render('view', [
            'id' => $id,
        ]);
    }
}