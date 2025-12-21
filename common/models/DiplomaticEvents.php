<?php
/*
 * 作者：刘成蕊（2312478）
 * 功能：实现网页后台外交事件表字段汉化显示，并隐藏不必要的 ID 字段
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "diplomatic_events".
 *
 * @property int $id 与events表共享主键
 * @property string|null $related_force_ids 	
 相关势力ID
 *
 * @property Events $id0
 */
class DiplomaticEvents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diplomatic_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['related_force_ids'], 'string', 'max' => 500],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'related_force_ids' => '相关国家',
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
}
