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
    // 获取各项统计数据
    $charCount = \common\models\Characters::find()->count();
    $battleCount = \common\models\Events::find()->where(['event_type' => 'battle'])->count();
    // 假设留言表中所有数据暂视为“未处理”
    $msgCount = \common\models\Messages::find()->count();
    $workCount = \common\models\MemWorks::find()->count();

    // 准备折线图数据：按年份统计事件数量
    $eventData = (new \yii\db\Query())
        ->select(["DATE_FORMAT(start_date, '%Y') as year", "COUNT(*) as count"])
        ->from('events')
        ->groupBy('year')
        ->orderBy('year ASC')
        ->all();

    return $this->render('index', [
        'charCount' => $charCount,
        'battleCount' => $battleCount,
        'msgCount' => $msgCount,
        'workCount' => $workCount,
        'eventData' => $eventData,
    ]);
}
}
