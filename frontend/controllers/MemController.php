<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class MemController extends Controller
{
    /**
     * 纪念馆首页
     */
    public function actionIndex()
    {
        // 设置页面标题
        $this->view->title = '网上纪念馆 - 中国抗战胜利80周年纪念网';
        
        // 获取致敬计数
        $tributeCount = Yii::$app->request->cookies->getValue('tributeCount', 0);
        
        return $this->render('index', [
            'tributeCount' => $tributeCount,
        ]);
    }
    
    /**
     * 点击致敬
     */
    public function actionTribute()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        // 获取当前计数
        $tributeCount = Yii::$app->request->cookies->getValue('tributeCount', 0);
        $tributeCount++;
        
        // 保存新的计数到Cookie
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'tributeCount',
            'value' => $tributeCount,
            'expire' => time() + 3600 * 24 * 365, // 保存一年
        ]));
        
        return [
            'success' => true,
            'count' => $tributeCount,
        ];
    }
    
    /**
     * 获取弹窗内容
     */
    public function actionGetModalContent($modalId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $modalContent = '';
        switch ($modalId) {
            case 'worksModal':
                $modalContent = [
                    'title' => '纪念作品',
                    'body' => '
                        <p>这里将展示纪念作品相关内容...</p>
                        <p>功能正在开发中，敬请期待！</p>
                        <p>您可以浏览以下内容：</p>
                        <ul style="padding-left: 20px; margin: 10px 0;">
                            <li>历史照片</li>
                            <li>艺术作品</li>
                            <li>文献资料</li>
                            <li>数字化文物</li>
                        </ul>
                    ',
                ];
                break;
            case 'eventsModal':
                $modalContent = [
                    'title' => '纪念活动',
                    'body' => '
                        <p>这里将展示纪念活动相关内容...</p>
                        <p>功能正在开发中，敬请期待！</p>
                        <p>您可以参与以下活动：</p>
                        <ul style="padding-left: 20px; margin: 10px 0;">
                            <li>线上祭扫</li>
                            <li>留言致敬</li>
                            <li>献花活动</li>
                            <li>专题展览</li>
                        </ul>
                    ',
                ];
                break;
        }
        
        return [
            'success' => true,
            'content' => $modalContent,
        ];
    }
}