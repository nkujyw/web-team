<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\models\Characters;
use common\models\Teams;

class CharacterController extends Controller
{
    public function actionIndex()
    {
        // 反法西斯阵营人物
        $antiHeroes = Characters::find()
            ->joinWith('force')
            ->where(['forces.type' => '反法西斯阵营'])
            ->all();

        // 法西斯阵营人物
        $axisHeroes = Characters::find()
            ->joinWith('force')
            ->where(['forces.type' => '法西斯阵营'])
            ->all();

        // 反法西斯阵营部队
        $antiTeams = Teams::find()
            ->joinWith('force')
            ->where(['forces.type' => '反法西斯阵营'])
            ->all();

        // 法西斯阵营部队
        $axisTeams = Teams::find()
            ->joinWith('force')
            ->where(['forces.type' => '法西斯阵营'])
            ->all();

        return $this->render('index', [
            'antiHeroes' => $antiHeroes,
            'axisHeroes' => $axisHeroes,
            'antiTeams'  => $antiTeams,
            'axisTeams'  => $axisTeams,
        ]);
    }
}

