<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forces".
 *
 * @property int $id
 * @property string $name
 * @property int|null $type 势力类型
 * @property string|null $description 势力简介
 *
 * @property BattleEvents[] $battleEvents
 * @property BattleEvents[] $battleEvents0
 * @property Characters[] $characters
 * @property Teams[] $teams
 */
class Forces extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forces';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '势力名称',
            'type' => '势力类型',
            'description' => '势力简介',
        ];
    }

    /**
     * 势力类型文字映射
     */
    public function getTypeText()
{
    switch ($this->type) {
        case 1:
            return 'National army（国民政府正规军）';
        case 2:
            return 'Communist army（共产党武装）';
        case 3:
            return 'Invading army（侵略军）';
        case 4:
            return 'Puppet regime（傀儡政权）';
        default:
            return '未知';
    }
}


    /**
     * Gets query for [[BattleEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBattleEvents()
    {
        return $this->hasMany(BattleEvents::className(), ['force1_id' => 'id']);
    }

    /**
     * Gets query for [[BattleEvents0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBattleEvents0()
    {
        return $this->hasMany(BattleEvents::className(), ['force2_id' => 'id']);
    }

    /**
     * Gets query for [[Characters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Characters::className(), ['force_id' => 'id']);
    }

    /**
     * Gets query for [[Teams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Teams::className(), ['force_id' => 'id']);
    }
}
