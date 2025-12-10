<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property string $name
 * @property string|null $type 地点类型（如战场/纪念馆）
 * @property string|null $description 地点描述
 *
 * @property Events[] $events
 * @property MemActivities[] $memActivities
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['location_id' => 'id']);
    }

    /**
     * Gets query for [[MemActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemActivities()
    {
        return $this->hasMany(MemActivities::className(), ['location_id' => 'id']);
    }
}
