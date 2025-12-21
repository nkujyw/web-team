<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('../../frontend/web/index.php');
    }
public function actionIndex()
{
    // 1. 统计数据 - 确保键名和视图一致
    $stats = [
        'charCount'   => \common\models\Characters::find()->count(),
        'battleCount' => \common\models\Events::find()->where(['event_type' => 'battle'])->count(),
        'msgCount'    => \common\models\Messages::find()->count(),
        'workCount'   => \common\models\MemWorks::find()->count(),
    ];

    // 2. 准备折线图数据
    $eventData = (new \yii\db\Query())
        ->select(["DATE_FORMAT(start_date, '%Y') as year", "COUNT(*) as count"])
        ->from('events')
        ->where(['not', ['start_date' => null]])
        ->groupBy('year')
        ->orderBy('year ASC')
        ->all();

    // 3. 准备饼图数据
    $typeData = (new \yii\db\Query())
        ->select(['event_type', 'COUNT(*) as count'])
        ->from('events')
        ->groupBy('event_type')
        ->all();

    return $this->render('index', [
        'stats'     => $stats,
        'eventData' => $eventData,
        'typeData'  => $typeData,
    ]);
}
// 预留“图表展示”页面
    public function actionCharts() {
        return $this->render('charts');
    }

    public function actionTeam()
{
    $team = [
        [
            'name' => '吉圆伟', 
            'major' => '密码科学与技术',
            'role' => '前后台首页与互动模块',
            'intro' => '大家好，我是吉圆伟，专业是密码科学与技术。作为项目负责人，我主导了系统的整体架构设计与暗黑模式适配。我致力于通过技术手段构建一个安全、高效的数字化平台，让这段厚重的抗战历史在数字世界中焕发新生。',
            'img' => 'jyw.jpg' // 对应 web/img/team/leader.jpg
        ],
        [
            'name' => '刘成蕊',
            'major' => '信息安全',
            'role' => ' “英雄与部队”模块',
            'intro' => '大家好，我是刘成蕊，专业是信息安全，我主要负责网站的“英雄与部队”模块，希望通过本项目，让抗战历史以更易理解、更具感染力的形式呈现给公众。',
            'img' => 'lcr.jpg'
        ],
        [
            'name' => '滕一睿',
            'major' => '密码科学与技术',
            'role' => ' “抗战时间轴”模块',
            'intro' => '大家好，我是滕一睿，专业是密码科学与技术，我主要负责网站的“抗战时间轴”模块，我希望通过最直观的方式，带你走进弹孔密布的岁月，触摸文字背后未冷的记忆与热血。',
            'img' => 'tyr.jpg'
        ],
        [
            'name' => '丛方昊',
            'major' => '计算机科学与技术',
            'role' => ' “网上纪念馆”模块',
            'intro' => '大家好，我是丛方昊，专业是计算机科学与技术，我主要负责网站的"网上纪念馆"模块。我希望通过数字化的方式，让每一位英雄的事迹、每一件珍贵的文物、每一段历史记忆都能被永久珍藏与传承。',
            'img' => 'cfh.jpg'
        ],
    ];

    return $this->render('team', ['team' => $team]);
}
}
