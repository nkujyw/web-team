<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MeetingEvents;

/**
 * MeetingEventsSearch represents the model behind the search form of `common\models\MeetingEvents`.
 */
class MeetingEventsSearch extends MeetingEvents
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['meeting_date', 'attendees', 'agenda'], 'safe'],
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
        $query = MeetingEvents::find();

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
            'meeting_date' => $this->meeting_date,
        ]);

        $query->andFilterWhere(['like', 'attendees', $this->attendees])
            ->andFilterWhere(['like', 'agenda', $this->agenda]);

        return $dataProvider;
    }
}
