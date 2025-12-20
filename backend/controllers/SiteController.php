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
}
