<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Question;

/**
 * QuestionSearch represents the model behind the search form of `common\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'related_event_id', 'related_character_id'], 'integer'],
            [['content', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'], 'safe'],
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
        $query = Question::find();

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
            'related_event_id' => $this->related_event_id,
            'related_character_id' => $this->related_character_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'option_a', $this->option_a])
            ->andFilterWhere(['like', 'option_b', $this->option_b])
            ->andFilterWhere(['like', 'option_c', $this->option_c])
            ->andFilterWhere(['like', 'option_d', $this->option_d])
            ->andFilterWhere(['like', 'correct_answer', $this->correct_answer]);

        return $dataProvider;
    }
}
