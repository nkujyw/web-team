<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meeting_events".
 *
 * @property int $id 与events表共享主键
 * @property string|null $meeting_date 	
 会议日期
 * @property string|null $attendees 	
 参会人员
 * @property string|null $agenda 	
 会议议程
 *
 * @property Events $id0
 */
class MeetingEvents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meeting_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['meeting_date'], 'safe'],
            [['attendees', 'agenda'], 'string'],
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
            'meeting_date' => '会议日期',
            'attendees' => '参会人员',
            'agenda' => '会议议程',
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
