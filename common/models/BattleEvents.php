<?php
/*
 * 作者：刘成蕊（2312478）
 * 功能：实现网页后台战役表字段汉化显示，并隐藏不必要的 ID 字段
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "battle_events".
 *
 * @property int $id 与events表共享主键
 * @property int|null $force1_id 交战方1
 * @property int|null $force2_id 交战方2
 * @property string|null $casualties 伤亡情况
 *
 * @property Events $id0
 * @property Forces $force1
 * @property Forces $force2
 */
class BattleEvents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'battle_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'force1_id', 'force2_id'], 'integer'],
            [['casualties'], 'string', 'max' => 500],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['id' => 'id']],
            [['force1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Forces::className(), 'targetAttribute' => ['force1_id' => 'id']],
            [['force2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Forces::className(), 'targetAttribute' => ['force2_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'force1_id' => '势力1',
            'force2_id' => '势力2',
            'casualties' => '伤亡情况',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Events::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Force1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForce1()
    {
        return $this->hasOne(Forces::className(), ['id' => 'force1_id']);
    }

    /**
     * Gets query for [[Force2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForce2()
    {
        return $this->hasOne(Forces::className(), ['id' => 'force2_id']);
    }
}
