<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property int $id
 * @property string $name
 * @property string|null $founded_date 成立时间
 * @property string|null $description 队伍描述
 * @property int|null $force_id 所属势力id
 * @property int|null $leader_id 领导人id
 *
 * @property Forces $force
 * @property Characters $leader
 */
class Teams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['founded_date'], 'safe'],
            [['description'], 'string'],
            [['force_id', 'leader_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['force_id'], 'exist', 'skipOnError' => true, 'targetClass' => Forces::className(), 'targetAttribute' => ['force_id' => 'id']],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characters::className(), 'targetAttribute' => ['leader_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '军队名称',
            'founded_date' => '建立时间',
            'description' => '简介',
            'force_id' => '所属队伍',
            'leader_id' => '领导人',
        ];
    }

    /**
     * Gets query for [[Force]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForce()
    {
        return $this->hasOne(Forces::className(), ['id' => 'force_id']);
    }

    /**
     * Gets query for [[Leader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Characters::className(), ['id' => 'leader_id']);
    }
}
