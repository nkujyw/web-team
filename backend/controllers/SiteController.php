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
                        'actions' => ['logout', 'index','team'],
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
    $jsonPath = \Yii::getAlias('@backend/views/teams/team_data.json');
    $data = json_decode(file_get_contents($jsonPath), true);

    if (\Yii::$app->request->isPost) {
        $postData = \Yii::$app->request->post();
        
        // 1. 更新团队全局信息 (带安全检查)
        if (isset($postData['TeamInfo'])) {
            $data['team_info']['team_name'] = $postData['TeamInfo']['team_name'];
            $data['team_info']['intro'] = $postData['TeamInfo']['intro'];
            $data['team_info']['philosophy_title'] = $postData['TeamInfo']['philosophy_title'];
        }
        
        // 2. 更新理念条目 (带安全检查，修复报错核心)
        if (isset($postData['Philosophy'])) {
            foreach ($data['team_info']['philosophy_items'] as $i => $item) {
                if (isset($postData['Philosophy'][$i])) {
                    $data['team_info']['philosophy_items'][$i]['title'] = $postData['Philosophy'][$i]['title'];
                    $data['team_info']['philosophy_items'][$i]['desc'] = $postData['Philosophy'][$i]['desc'];
                }
            }
        }

        // 3. 更新成员信息
        if (isset($postData['Members'])) {
            foreach ($data['members'] as $i => $member) {
                if (isset($postData['Members'][$i])) {
                    $data['members'][$i]['name'] = $postData['Members'][$i]['name'];
                    $data['members'][$i]['major'] = $postData['Members'][$i]['major'];
                    $data['members'][$i]['role'] = $postData['Members'][$i]['role'];
                    $data['members'][$i]['intro'] = $postData['Members'][$i]['intro'];
                }
            }
        }
        
        file_put_contents($jsonPath, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        \Yii::$app->session->setFlash('success', '所有团队数据已成功更新！');
        return $this->refresh();
    }

    return $this->render('team', ['data' => $data]);
}
}
