<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\MemWorks;
use common\models\MemActivities;

class MemController extends Controller
{
    /**
     * 纪念馆首页
     */
    public function actionIndex()
    {
        $this->view->title = '网上纪念馆 - 中国抗战胜利80周年纪念网';
        
        // 从数据库获取纪念作品数据
        $memWorks = MemWorks::find()
            ->orderBy(['create_date' => SORT_DESC])
            ->limit(6)
            ->all();
        
        // 从数据库获取纪念活动数据
        $memActivities = MemActivities::find()
            ->orderBy(['activity_date' => SORT_DESC])
            ->limit(4)
            ->all();
        
        return $this->render('index', [
            'memWorks' => $memWorks,
            'memActivities' => $memActivities,
        ]);
    }
    
    /**
     * 获取所有纪念作品列表 - AJAX接口
     */
    public function actionGetAllWorks()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        try {
            $works = MemWorks::find()
                ->orderBy(['create_date' => SORT_DESC])
                ->all();
            
            $result = [];
            foreach ($works as $work) {
                $result[] = [
                    'id' => $work->id,
                    'name' => $work->name,
                    'author' => $work->author,
                    'type' => $work->type,
                    'description' => $work->description,
                    'create_date' => Yii::$app->formatter->asDate($work->create_date, 'yyyy年MM月dd日'),
                    'url' => $work->url,
                    'full_url' => $this->getFullImageUrl($work->url),
                ];
            }
            
            return [
                'status' => 'success',
                'data' => $result
            ];
        } catch (\Exception $e) {
            Yii::error('获取纪念作品失败: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => '获取数据失败'
            ];
        }
    }
    
    /**
     * 获取所有纪念活动列表 - AJAX接口
     */
    public function actionGetAllActivities()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        try {
            $activities = MemActivities::find()
                ->orderBy(['activity_date' => SORT_DESC])
                ->all();
            
            $result = [];
            foreach ($activities as $activity) {
                $result[] = [
                    'id' => $activity->id,
                    'name' => $activity->name,
                    'description' => $activity->description,
                    'activity_date' => Yii::$app->formatter->asDate($activity->activity_date, 'yyyy年MM月dd日'),
                    'location_id' => $activity->location_id,
                    'organizer' => $activity->organizer,
                    'photo_url' => $activity->photo_url,
                    'full_photo_url' => $this->getFullImageUrl($activity->photo_url),
                ];
            }
            
            return [
                'status' => 'success',
                'data' => $result
            ];
        } catch (\Exception $e) {
            Yii::error('获取纪念活动失败: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => '获取数据失败'
            ];
        }
    }
    
    /**
     * 获取完整的图片URL
     */
    private function getFullImageUrl($path)
    {
        if (empty($path)) {
            return '';
        }
        
        // 如果已经是完整的URL，直接返回
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        
        // 添加网站基础URL
        $baseUrl = Yii::getAlias('@web');
        
        // 确保路径以斜杠开头
        if (strpos($path, '/') !== 0) {
            $path = '/' . $path;
        }
        
        return $baseUrl . $path;
    }
}