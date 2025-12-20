<?php
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
     * 【重点修改区域】
     * 首页不再是静态的，而是从数据库拉取数据
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

        // --- 【新增数据】 ---
        
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


    // 新增：习近平总书记讲话详情页
    public function actionSpeech()
    {
        return $this->render('speech');
    }
    // 新增：公告详情页通用接口
    // 访问地址：index.php?r=site/announcement&id=1
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

        // 2. 查询数据 (复用之前的逻辑)
        if (empty($ids)) {
             $teams = \common\models\Teams::find()
                ->where(['in', 'force_id', [5, 6, 7]])
                ->orderBy(new \yii\db\Expression('rand()'))
                ->limit(4)
                ->all();
        } else {
            $teams = \common\models\Teams::find()
                ->where(['id' => $idArray])
                // 注意这里要引入 Expression，或者确保文件头部 use 了 yii\db\Expression
                ->orderBy(new \yii\db\Expression('FIELD (id, ' . $ids . ')'))
                ->all();
        }

        // 3. 渲染你新建的那个文件 'index-teams'
        return $this->render('index-teams', [
            'teams' => $teams,
        ]);
    }
}