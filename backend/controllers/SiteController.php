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
                        'actions' => ['logout', 'index', 'team', 'charts', 'team-homework', 'personal-homework','download','get-file-list'],
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
            return $this->render('login', ['model' => $model]);
        }
    }

    /**
     * Logout action.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('../../frontend/web/index.php');
    }

    /**
     * 仪表盘首页：获取统计数据与图表数据
     */
    public function actionIndex()
    {
        // 1. 统计数据
        $stats = [
            'charCount'   => \common\models\Characters::find()->count(),
            'battleCount' => \common\models\Events::find()->where(['event_type' => 'battle'])->count(),
            'msgCount'    => \common\models\Messages::find()->count(),
            'workCount'   => \common\models\MemWorks::find()->count(),
        ];

        // 2. 柱状图数据：按年统计 (MySQL/MariaDB)
        $eventData = (new \yii\db\Query())
            ->select(["DATE_FORMAT(start_date, '%Y') as year", "COUNT(*) as count"])
            ->from('events')
            ->where(['not', ['start_date' => null]])
            ->groupBy('year')
            ->orderBy('year ASC')
            ->all();

        // 3. 饼图数据：按类型占比
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

    // “图表展示”页面
    public function actionCharts() {
        return $this->render('charts');
    }


    /**
     * 团队管理逻辑：支持从 JSON 文件读取并修改内容
     * 这样你在后台修改后，前端会自动更新
     */
    public function actionTeam()
    {
        $jsonPath = \Yii::getAlias('@backend/views/teams/team_data.json');
        // 如果文件不存在，建议先检查一下路径
        if (!file_exists($jsonPath)) {
            $data = []; 
        } else {
            $data = json_decode(file_get_contents($jsonPath), true);
        }

        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            
            if (isset($postData['TeamInfo'])) {
                $data['team_info']['team_name'] = $postData['TeamInfo']['team_name'];
                $data['team_info']['intro'] = $postData['TeamInfo']['intro'];
                $data['team_info']['philosophy_title'] = $postData['TeamInfo']['philosophy_title'];
            }
            
            if (isset($postData['Philosophy'])) {
                foreach ($data['team_info']['philosophy_items'] as $i => $item) {
                    if (isset($postData['Philosophy'][$i])) {
                        $data['team_info']['philosophy_items'][$i]['title'] = $postData['Philosophy'][$i]['title'];
                        $data['team_info']['philosophy_items'][$i]['desc'] = $postData['Philosophy'][$i]['desc'];
                    }
                }
            }

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

    public function actionTeamHomework()
    {
        return $this->render('team-homework');
    }

    public function actionPersonalHomework()
    {
        return $this->render('personal-homework');
    }

    /**
     * 通用下载方法
     */
    public function actionDownload($type, $file, $folder = '')
    {
        $basePath = \Yii::getAlias('@backend/../data/');

        if ($type === 'db') {
            $path = $basePath . $file;
        } elseif ($type === 'team') {
            $path = $basePath . 'team/' . $file;
        } elseif ($type === 'personal') {
            $path = $basePath . 'personal/' . $folder . '/' . $file;
        } else {
            throw new \yii\web\NotFoundHttpException("非法请求");
        }

        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        } else {
            \Yii::$app->session->setFlash('error', "文件不存在：$path");
            return $this->redirect(\Yii::$app->request->referrer);
        }
    }

    /**
     * 获取指定学生目录下的所有文件列表 (返回 JSON)
     */
    public function actionGetFileList($folder)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $folderPath = \Yii::getAlias('@backend/../data/personal/') . $folder;
        
        $fileList = [];
        if (is_dir($folderPath)) {
            $files = new \DirectoryIterator($folderPath);
            foreach ($files as $fileInfo) {
                if (!$fileInfo->isDot() && !$fileInfo->isDir()) {
                    $fileList[] = $fileInfo->getFilename();
                }
            }
        }
        return $fileList;
    }
}