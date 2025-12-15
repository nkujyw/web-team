<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Forces;

/**
 * ForcesSearch represents the model behind the search form of `common\models\Forces`.
 */
class ForcesSearch extends Forces
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'type', 'description'], 'safe'], // type 作为字符串接收
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Forces::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // 精确匹配（关键修改点）
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type, 
        ]);

        // 其他字段仍然模糊搜索
        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
