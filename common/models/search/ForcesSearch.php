<?php
/**
*Team：方圆双睿
*Coding by 滕一睿 2313109，20251212
*势力表搜索优化
*/
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
            [['name', 'type', 'description'], 'safe'], 
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

       
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type, 
        ]);

     
        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
