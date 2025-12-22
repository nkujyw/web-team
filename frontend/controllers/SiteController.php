<?php
/**
 * SiteController.php
 * 站点控制器，处理首页及其他通用页面请求，主要服务于首页功能。
 * @author 吉圆伟
 * @date 2025-12-16
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


use common\models\Events;      // 对应 events 表
use common\models\Characters;  // 对应 characters 表
use common\models\MemWorks;    // 对应 mem_works 表
use yii\db\Expression;         // 用于随机排序 RAND()

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     * 从数据库拉取数据
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // 1. 轮播图 (取3个)
        $carouselWorks = MemWorks::find()->where(['type' => '绘画'])->limit(3)->all();

        // 2. 重大战役 (取3个)
        $battles = Events::find()->where(['event_type' => 'battle'])->orderBy(['start_date' => SORT_ASC])->limit(3)->all();

        // 3. 每日英雄 (随机1个)
        $hero = Characters::find()
            ->where(['not in', 'force_id', [8, 9]]) // 排除日军
            ->orderBy(new Expression('RAND()'))->one();


        // 4. 抗战文艺 (取4个，排除轮播图用过的)
        $artWorks = MemWorks::find()->orderBy(['create_date' => SORT_DESC])->limit(4)->all();

        // 5. 抗战雄师 (取4支著名部队)
        $teams = \common\models\Teams::find()
            ->where(['not in', 'force_id', [8, 9]]) 
            ->orderBy(new Expression('RAND()'))      // 保持随机
            ->limit(4)
            ->all();

        // 6. 最新留言 (取5条)
        $recentMessages = \common\models\Messages::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();

        return $this->render('index', [
            'carouselWorks' => $carouselWorks,
            'battles' => $battles,
            'hero' => $hero,
            'artWorks' => $artWorks,      // 传给视图
            'teams' => $teams,            // 传给视图
            'recentMessages' => $recentMessages, // 传给视图
        ]);
    }


    // 习近平总书记讲话详情页
    public function actionSpeech()
    {
        return $this->render('speech');
    }
    // 公告详情页通用接口
    public function actionAnnouncement($id = 1)
    {
        // 把 id 传给视图，视图负责根据 id 显示不同内容
        return $this->render('announcement', [
            'id' => $id
        ]);
    }

    /**
     * 抗战雄师详情聚合页
     * 对应视图：frontend/views/site/index-teams.php
     * 访问路由：site/index-teams
     */
    public function actionIndexTeams($ids = '')
    {
        // 1. 处理 ID 字符串
        $idArray = explode(',', $ids);

        // 2. 查询数据
        if (empty($ids)) {
             $teams = \common\models\Teams::find()
                ->where(['in', 'force_id', [5, 6, 7]])
                ->orderBy(new \yii\db\Expression('rand()'))
                ->limit(4)
                ->all();
        } else {
            $teams = \common\models\Teams::find()
                ->where(['id' => $idArray])
                ->orderBy(new \yii\db\Expression('FIELD (id, ' . $ids . ')'))
                ->all();
        }

        
        return $this->render('index-teams', [
            'teams' => $teams,
        ]);
    }

public function actionTeamInfo()
{
    // 使用相对路径从项目根目录寻找
    $jsonPath = Yii::getAlias('@common') . '/../backend/views/teams/team_data.json';
    $jsonPath = \Yii::getAlias($jsonPath);

    if (file_exists($jsonPath)) {
        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);
        
        if (!$data) {
            die("JSON 文件内容格式不正确，请检查 backend/data/team_data.json");
        }
    } else {
        die("找不到 JSON 数据文件，请检查路径是否正确: " . $jsonPath);
    }

    return $this->render('team-info', [
        'data' => $data,
    ]);
}
}