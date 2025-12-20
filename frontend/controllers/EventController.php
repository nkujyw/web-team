<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Query;

class EventController extends Controller
{
    /**
     * location_id -> 地图映射（不改数据库结构只能写在代码里）
     *
     * 说明：
     * - provinceName：给 ECharts 用来高亮（必须和你们 china_v2.json 的省份 name 匹配）
     * - lng/lat：给 effectScatter 红点用
     * - isChina：非中国地点直接过滤掉（比如开罗/东京/华盛顿等）
     *
     * 你可以后续继续补充/调整坐标。
     */
    private function locationMap(): array
    {
        return [
            // ===== 中国地点（你截图里的 1~15 基本都在中国）=====
            1  => ['name' => '卢沟桥',   'province' => '北京', 'lng' => 116.058, 'lat' => 39.856, 'isChina' => true],
            2  => ['name' => '淞沪地区', 'province' => '上海', 'lng' => 121.474, 'lat' => 31.230, 'isChina' => true],
            3  => ['name' => '南京',     'province' => '江苏', 'lng' => 118.797, 'lat' => 32.060, 'isChina' => true],
            4  => ['name' => '太原',     'province' => '山西', 'lng' => 112.549, 'lat' => 37.857, 'isChina' => true],
            5  => ['name' => '武汉',     'province' => '湖北', 'lng' => 114.305, 'lat' => 30.593, 'isChina' => true],
            6  => ['name' => '长沙',     'province' => '湖南', 'lng' => 112.939, 'lat' => 28.229, 'isChina' => true],
            7  => ['name' => '太行山区', 'province' => '山西', 'lng' => 113.000, 'lat' => 36.500, 'isChina' => true], // 粗略中心点
            8  => ['name' => '延安',     'province' => '陕西', 'lng' => 109.490, 'lat' => 36.586, 'isChina' => true],
            9  => ['name' => '重庆',     'province' => '重庆', 'lng' => 106.551, 'lat' => 29.563, 'isChina' => true],
            10 => ['name' => '滇缅公路', 'province' => '云南', 'lng' => 100.230, 'lat' => 25.600, 'isChina' => true],
            11 => ['name' => '衡阳',     'province' => '湖南', 'lng' => 112.572, 'lat' => 26.893, 'isChina' => true],
            12 => ['name' => '东北林区', 'province' => '黑龙江', 'lng' => 126.534, 'lat' => 45.803, 'isChina' => true], // 以哈尔滨附近作中心点
            13 => ['name' => '平型关',   'province' => '山西', 'lng' => 113.670, 'lat' => 39.350, 'isChina' => true],
            14 => ['name' => '台儿庄',   'province' => '山东', 'lng' => 117.734, 'lat' => 34.562, 'isChina' => true],
            15 => ['name' => '昆仑关',   'province' => '广西', 'lng' => 108.382, 'lat' => 22.704, 'isChina' => true],

            // ===== 国外地点（不在中国地图打点/高亮）=====
            16 => ['name' => '开罗',     'province' => null, 'lng' => 31.236,  'lat' => 30.044, 'isChina' => false],
            17 => ['name' => '波茨坦',   'province' => null, 'lng' => 13.064,  'lat' => 52.390, 'isChina' => false],
            18 => ['name' => '莫斯科',   'province' => null, 'lng' => 37.618,  'lat' => 55.755, 'isChina' => false],
            19 => ['name' => '华盛顿',   'province' => null, 'lng' => -77.037, 'lat' => 38.907, 'isChina' => false],
            20 => ['name' => '东京',     'province' => null, 'lng' => 139.692, 'lat' => 35.689, 'isChina' => false],
            21 => ['name' => '马尼拉',   'province' => null, 'lng' => 120.985, 'lat' => 14.599, 'isChina' => false],
            22 => ['name' => '新德里',   'province' => null, 'lng' => 77.209,  'lat' => 28.614, 'isChina' => false],
            23 => ['name' => '旧金山',   'province' => null, 'lng' => -122.419,'lat' => 37.775, 'isChina' => false],
        ];
    }

    /**
     * 省份名称修正：
     * 你们的 china_v2.json 里省份 name 有可能是 “北京市/山东省/广西壮族自治区”
     * 也可能是 “北京/山东/广西”
     * 这里给一个“兼容策略”：优先用短名（北京），如果你发现高亮不生效，
     * 就把下面的映射改成你 geojson 的真实名字。
     */
    private function normalizeProvinceName(string $p): string
    {
        $p = trim($p);

        // 如果你们 geojson 里用全称，把这里改成全称即可：
        // return match($p) { '北京' => '北京市', '上海' => '上海市', ... default => $p . '省' };

        return $p;
    }

    public function actionIndex()
    {
        // 这里仅渲染页面（你们之后在 views/event/index.php 放时间轴 + 地图容器）
        $years = range(1931, 1945);
        return $this->render('index', [
            'years' => $years,
            'defaultYear' => 1937,
        ]);
    }

    /**
     * GET /event/year-data?year=1940
     * 返回：当年仍在进行事件对应的省份高亮列表 + 红点点位（点击点位弹窗展示事件）
     */
    public function actionYearData($year)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $year = (int)$year;
        $yearStart = sprintf('%04d-01-01', $year);
        $yearEnd   = sprintf('%04d-12-31', $year);

        // events 表字段：start_date/end_date/location_id（按你截图）
        // locations 表字段：id/name（按你截图）
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
            if (!isset($locMap[$locId])) {
                // 没配映射：不高亮、不打点（你后面补表即可）
                continue;
            }

            $m = $locMap[$locId];
            if (empty($m['isChina'])) {
                // 国外地点不画在中国地图上
                continue;
            }

            $province = $this->normalizeProvinceName((string)$m['province']);
            if ($province !== '') $provinceSet[$province] = true;

            // 一个事件一个红点（最直观，点红点弹出该事件）
            $points[] = [
                'lng' => (float)$m['lng'],
                'lat' => (float)$m['lat'],
                'province' => $province,
                'location_id' => $locId,
                'location_name' => (string)($r['location_name'] ?? $m['name']),
                'event' => [
                    'id' => $r['id'] ?? null,
                    'name' => (string)($r['name'] ?? ''),
                    'start_date' => (string)($r['start_date'] ?? ''),
                    'end_date' => (string)($r['end_date'] ?? ''),
                    'location' => (string)($r['location_name'] ?? $m['name']),
                    'description' => (string)($r['description'] ?? ''),
                    'significance' => (string)($r['significance'] ?? ''),
                    'event_type' => (string)($r['event_type'] ?? ''),
                ],
            ];
        }

        return [
            'year' => $year,
            'provinces' => array_keys($provinceSet),
            'points' => $points,
        ];
    }

    /**
     * GET /event/year-list?year=1940
     * 返回：当年仍在进行的所有事件（给“展示全年事件”按钮用）
     */
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

        // 整理一下字段名，前端更好用
        $items = [];
        foreach ($rows as $r) {
            $items[] = [
                'id' => $r['id'] ?? null,
                'name' => (string)($r['name'] ?? ''),
                'start_date' => (string)($r['start_date'] ?? ''),
                'end_date' => (string)($r['end_date'] ?? ''),
                'location_id' => (int)($r['location_id'] ?? 0),
                'location' => (string)($r['location_name'] ?? ''),
                'description' => (string)($r['description'] ?? ''),
                'significance' => (string)($r['significance'] ?? ''),
                'event_type' => (string)($r['event_type'] ?? ''),
            ];
        }

        return [
            'year' => $year,
            'items' => $items,
        ];
    }

    /**
     * 重大战役详情页
     * 对应路由：index.php?r=event/important-battle&id=1
     */
    public function actionImportantBattle($id)
    {
        // 1. 找数据
        $model = \common\models\Events::findOne($id);
        
        // 2. 如果找不到，抛出404
        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('找不到这条战役数据。');
        }

        // 3. 渲染视图 'important_battle.php'
        return $this->render('important_battle', [
            'model' => $model,
        ]);
    }
}
