/**
 * Team：方圆双睿
 * Coding by 滕一睿 2313109，20251216
 * 前端抗日战争时间轴模块逻辑实现（完善版）
 */
<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Query;

class EventController extends Controller
{
    /**
     * 地点映射表（数据库 location_id => 地图展示信息）
     */
    private function locationMap(): array
    {
        return [


            1  => ['name' => '卢沟桥',   'province' => '北京', 'lng' => 116.058, 'lat' => 39.856, 'isChina' => true],
            2  => ['name' => '淞沪地区', 'province' => '上海', 'lng' => 121.474, 'lat' => 31.230, 'isChina' => true],
            3  => ['name' => '南京',     'province' => '江苏', 'lng' => 118.797, 'lat' => 32.060, 'isChina' => true],
            4  => ['name' => '太原',     'province' => '山西', 'lng' => 112.549, 'lat' => 37.857, 'isChina' => true],
            5  => ['name' => '武汉',     'province' => '湖北', 'lng' => 114.305, 'lat' => 30.593, 'isChina' => true],
            6  => ['name' => '长沙',     'province' => '湖南', 'lng' => 112.939, 'lat' => 28.229, 'isChina' => true],
            7  => ['name' => '太行山区', 'province' => '山西', 'lng' => 113.000, 'lat' => 36.500, 'isChina' => true],
            8  => ['name' => '延安',     'province' => '陕西', 'lng' => 109.490, 'lat' => 36.586, 'isChina' => true],
            9  => ['name' => '重庆',     'province' => '重庆', 'lng' => 106.551, 'lat' => 29.563, 'isChina' => true],
            10 => ['name' => '滇缅公路', 'province' => '云南', 'lng' => 100.230, 'lat' => 25.600, 'isChina' => true],
            11 => ['name' => '衡阳',     'province' => '湖南', 'lng' => 112.572, 'lat' => 26.893, 'isChina' => true],
            12 => ['name' => '东北林区', 'province' => '黑龙江', 'lng' => 126.534, 'lat' => 45.803, 'isChina' => true],
            13 => ['name' => '平型关',   'province' => '山西', 'lng' => 113.670, 'lat' => 39.350, 'isChina' => true],
            14 => ['name' => '台儿庄',   'province' => '山东', 'lng' => 117.734, 'lat' => 34.562, 'isChina' => true],
            15 => ['name' => '昆仑关',   'province' => '广西', 'lng' => 108.382, 'lat' => 22.704, 'isChina' => true],
            24 => ['name' => '保定', 'province' => '河北', 'lng' => 115.482, 'lat' => 38.873, 'isChina' => true],
            25 => ['name' => '徐州', 'province' => '江苏', 'lng' => 117.285, 'lat' => 34.205, 'isChina' => true],
            26 => ['name' => '兰封地区', 'province' => '河南', 'lng' => 114.821, 'lat' => 34.823, 'isChina' => true],
            27 => ['name' => '南昌', 'province' => '江西', 'lng' => 115.858, 'lat' => 28.683, 'isChina' => true],
            28 => ['name' => '枣宜地区', 'province' => '湖北', 'lng' => 112.770, 'lat' => 32.130, 'isChina' => true],
            30 => ['name' => '常德', 'province' => '湖南', 'lng' => 111.698, 'lat' => 29.031, 'isChina' => true],
            31 => ['name' => '豫湘桂地区', 'province' => '广西', 'lng' => 110.290, 'lat' => 25.273, 'isChina' => true],
            32 => ['name' => '滇西', 'province' => '云南', 'lng' => 99.161, 'lat' => 25.112, 'isChina' => true],

            16 => ['name' => '开罗',   'province' => null, 'lng' => 31.236,  'lat' => 30.044, 'isChina' => false],
            17 => ['name' => '波茨坦', 'province' => null, 'lng' => 13.064,  'lat' => 52.390, 'isChina' => false],
            18 => ['name' => '莫斯科', 'province' => null, 'lng' => 37.618,  'lat' => 55.755, 'isChina' => false],
            19 => ['name' => '华盛顿', 'province' => null, 'lng' => -77.037, 'lat' => 38.907, 'isChina' => false],
            20 => ['name' => '东京',   'province' => null, 'lng' => 139.692, 'lat' => 35.689, 'isChina' => false],
            21 => ['name' => '马尼拉', 'province' => null, 'lng' => 120.985, 'lat' => 14.599, 'isChina' => false],
            22 => ['name' => '新德里', 'province' => null, 'lng' => 77.209,  'lat' => 28.614, 'isChina' => false],
            23 => ['name' => '旧金山', 'province' => null, 'lng' => -122.419,'lat' => 37.775, 'isChina' => false],
            33 => ['name' => '密支那', 'province' => null, 'lng' => 97.395,  'lat' => 25.386, 'isChina' => false],
        ];
    }

    private function normalizeProvinceName(string $p): string
    {
        return trim($p);
    }

    public function actionIndex()
    {
        $years = range(1931, 1945);
        return $this->render('index', [
            'years' => $years,
            'defaultYear' => 1937,
        ]);
    }

    public function actionYearData($year)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $year = (int)$year;
        $yearStart = sprintf('%04d-01-01', $year);
        $yearEnd   = sprintf('%04d-12-31', $year);

        $rows = (new Query())
            ->from(['e' => 'events'])
            ->leftJoin(['l' => 'locations'], 'l.id = e.location_id')
            ->select([
                'e.id',
                'e.name',
                'e.start_date',
                'e.end_date',
                'e.location_id',
                'e.description',
                'e.significance',
                'e.event_type',
                'l.name AS location_name',
            ])
            ->where(['<=', 'e.start_date', $yearEnd])
            ->andWhere(['>=', 'e.end_date', $yearStart])
            ->orderBy(['e.start_date' => SORT_ASC, 'e.id' => SORT_ASC])
            ->all();

        $locMap = $this->locationMap();
        $provinceSet = [];
        $points = [];

        foreach ($rows as $r) {
            $locId = (int)($r['location_id'] ?? 0);
            if (!isset($locMap[$locId])) continue;

            $m = $locMap[$locId];
            if (empty($m['isChina'])) continue;

            $province = $this->normalizeProvinceName((string)$m['province']);
            if ($province !== '') $provinceSet[$province] = true;

            $points[] = [
                'lng' => (float)$m['lng'],
                'lat' => (float)$m['lat'],
                'province' => $province,
                'location_id' => $locId,
                'location_name' => $r['location_name'] ?? $m['name'],
                'event' => [
                    'id' => $r['id'],
                    'name' => $r['name'],
                    'start_date' => $r['start_date'],
                    'end_date' => $r['end_date'],
                    'description' => $r['description'],
                    'significance' => $r['significance'],
                    'event_type' => $r['event_type'],
                ],
            ];
        }

        return [
            'year' => $year,
            'provinces' => array_keys($provinceSet),
            'points' => $points,
        ];
    }


    public function actionYearList($year)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $year = (int)$year;
        $yearStart = sprintf('%04d-01-01', $year);
        $yearEnd   = sprintf('%04d-12-31', $year);

        $rows = (new Query())
            ->from(['e' => 'events'])
            ->leftJoin(['l' => 'locations'], 'l.id = e.location_id')
            ->select([
                'e.id',
                'e.name',
                'e.start_date',
                'e.end_date',
                'e.location_id',
                'e.description',
                'e.significance',
                'e.event_type',
                'l.name AS location_name',
            ])
            ->where(['<=', 'e.start_date', $yearEnd])
            ->andWhere(['>=', 'e.end_date', $yearStart])
            ->orderBy(['e.start_date' => SORT_ASC, 'e.id' => SORT_ASC])
            ->all();

        return [
            'year' => $year,
            'items' => $rows,
        ];
    }


    public function actionImportantBattle($id)
    {
        $model = \common\models\Events::findOne($id);
        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('找不到这条战役数据。');
        }

        return $this->render('important_battle', [
            'model' => $model,
        ]);
    }
}
