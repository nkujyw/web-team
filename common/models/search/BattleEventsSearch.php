<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BattleEvents;

/**
 * BattleEventsSearch represents the model behind the search form of `common\models\BattleEvents`.
 */
class BattleEventsSearch extends BattleEvents
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'force1_id', 'force2_id'], 'integer'],
            [['casualties'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BattleEvents::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'force1_id' => $this->force1_id,
            'force2_id' => $this->force2_id,
        ]);

        $query->andFilterWhere(['like', 'casualties', $this->casualties]);

        return $dataProvider;
    }
}
