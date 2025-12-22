<?php

/**
*Team：方圆双睿
*Coding by 丛方昊 2310682
*对纪念馆界面进行数据管理，支持前端与数据库的交互
*支持随机推荐作品，与列举作品详细信息
*/

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\MemWorks;
use common\models\MemActivities;

class MemController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = '网上纪念馆 - 中国抗战胜利80周年纪念网';
        
        $memWorks = MemWorks::find()
            ->orderBy('RAND()')
            ->limit(5)
            ->all();
        
        $memActivities = MemActivities::find()
            ->orderBy('RAND()')
            ->limit(5)
            ->all();
        
        return $this->render('index', [
            'memWorks' => $memWorks,
            'memActivities' => $memActivities,
        ]);
    }
    
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
    
    public function actionGetAllActivities()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        try {
            $activities = MemActivities::find()
                ->orderBy(['activity_date' => SORT_DESC])
                ->all();
            
            $result = [];
            foreach ($activities as $activity) {
                $locationName = '未知地点';
                if ($activity->location_id) {
                    $location = Yii::$app->db->createCommand('
                        SELECT name FROM locations WHERE id = :id
                    ', [':id' => $activity->location_id])->queryOne();
                    
                    if ($location && isset($location['name'])) {
                        $locationName = $location['name'];
                    }
                }
                
                $result[] = [
                    'id' => $activity->id,
                    'name' => $activity->name,
                    'description' => $activity->description,
                    'activity_date' => Yii::$app->formatter->asDate($activity->activity_date, 'yyyy年MM月dd日'),
                    'location_id' => $activity->location_id,
                    'location_name' => $locationName,
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
    
    public function actionGetWorkDetail($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        try {
            $work = MemWorks::findOne($id);
            
            if (!$work) {
                return [
                    'status' => 'error',
                    'message' => '纪念作品不存在'
                ];
            }
            
            $data = [
                'id' => $work->id,
                'name' => $work->name,
                'author' => $work->author,
                'type' => $work->type,
                'description' => $work->description,
                'create_date' => Yii::$app->formatter->asDate($work->create_date, 'yyyy年MM月dd日'),
                'url' => $work->url,
                'full_url' => $this->getFullImageUrl($work->url),
                'content' => $work->content ?? '',
                'source' => $work->source ?? '',
                'keywords' => $work->keywords ?? '',
            ];
            
            return [
                'status' => 'success',
                'data' => $data
            ];
        } catch (\Exception $e) {
            Yii::error('获取纪念作品详情失败: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => '获取数据失败'
            ];
        }
    }
    
    public function actionGetActivityDetail($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        try {
            $activity = MemActivities::findOne($id);
            
            if (!$activity) {
                return [
                    'status' => 'error',
                    'message' => '纪念活动不存在'
                ];
            }
            
            $locationInfo = [];
            if ($activity->location_id) {
                $location = Yii::$app->db->createCommand('
                    SELECT id, name, type, description FROM locations WHERE id = :id
                ', [':id' => $activity->location_id])->queryOne();
                
                if ($location) {
                    $locationInfo = [
                        'id' => $location['id'],
                        'name' => $location['name'],
                        'type' => $location['type'],
                        'description' => $location['description'],
                    ];
                }
            }
            
            $data = [
                'id' => $activity->id,
                'name' => $activity->name,
                'description' => $activity->description,
                'activity_date' => Yii::$app->formatter->asDate($activity->activity_date, 'yyyy年MM月dd日'),
                'location_id' => $activity->location_id,
                'location_info' => $locationInfo,
                'organizer' => $activity->organizer,
                'photo_url' => $activity->photo_url,
                'full_photo_url' => $this->getFullImageUrl($activity->photo_url),
                'content' => $activity->content ?? '',
                'address' => $activity->address ?? '',
                'participants' => $activity->participants ?? '',
                'status' => $activity->status ?? '',
            ];
            
            return [
                'status' => 'success',
                'data' => $data
            ];
        } catch (\Exception $e) {
            Yii::error('获取纪念活动详情失败: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => '获取数据失败'
            ];
        }
    }
    
    private function getFullImageUrl($path)
    {
        if (empty($path)) {
            return '';
        }
        
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        
        $baseUrl = Yii::getAlias('@web');
        
        if (strpos($path, '/') !== 0) {
            $path = '/' . $path;
        }
        
        return $baseUrl . $path;
    }
}