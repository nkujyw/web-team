<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\models\Characters;
use common\models\Teams;
use common\models\Forces;

class CharacterController extends Controller
{
    public function actionIndex()
    {
        // 反法西斯阵营人物
        $antiHeroes = Characters::find()
            ->joinWith('force')
            ->where(['forces.type' => '反法西斯阵营'])
            ->andWhere(['<=', 'characters.id', 24])
            ->all();

        // 法西斯阵营人物
        $axisHeroes = Characters::find()
            ->joinWith('force')
            ->where(['forces.type' => '法西斯阵营'])
            ->andWhere(['<=', 'characters.id', 24])
            ->all();

        // 反法西斯阵营部队
        $antiTeams = Teams::find()
            ->joinWith('force')
            ->where(['forces.type' => '反法西斯阵营'])
            ->andWhere(['teams.id' => [1, 2, 4, 7]])
            ->all();

        // 法西斯阵营部队
        $axisTeams = Teams::find()
            ->joinWith('force')
            ->where(['forces.type' => '法西斯阵营'])
            ->all();

        $antiForces = Forces::find()
            ->where(['type' => '反法西斯阵营'])
            ->all();

        $axisForces = Forces::find()
            ->where(['type' => '法西斯阵营'])
            ->all();

        $heroMartyrs = Characters::find()
        ->where(['rank' => '抗日烈士'])
        ->orderBy(['id' => SORT_ASC])
        ->all();

        return $this->render('index', [
            'antiForces' => $antiForces,
            'axisForces' => $axisForces,
            'antiHeroes' => $antiHeroes,
            'axisHeroes' => $axisHeroes,
            'antiTeams'  => $antiTeams,
            'axisTeams'  => $axisTeams,
            'heroMartyrs'  => $heroMartyrs,
        ]);
    }
}

