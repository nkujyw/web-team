<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name
 * @property string|null $start_date 事件开始时间
 * @property string|null $end_date 事件结束时间
 * @property int|null $location_id 发生地点ID
 * @property string|null $description 事件描述
 * @property string|null $outcome 事件影响
 * @property string $event_type 事件类型
 *
 * @property BattleEvents $battleEvents
 * @property DiplomaticEvents $diplomaticEvents
 * @property Locations $location
 * @property MeetingEvents $meetingEvents
 * @property MemWorks[] $memWorks
 * @property Question[] $questions
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'event_type'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['location_id'], 'integer'],
            [['description', 'outcome', 'event_type'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'start_date' => '开始时间',
            'end_date' => '结束时间',
            'location_id' => '地点',
            'description' => '介绍',
            'outcome' => '结果',
            'event_type' => '事件类型',
        ];
    }

    /**
     * Gets query for [[BattleEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBattleEvents()
    {
        return $this->hasOne(BattleEvents::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[DiplomaticEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiplomaticEvents()
    {
        return $this->hasOne(DiplomaticEvents::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    /**
     * Gets query for [[MeetingEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingEvents()
    {
        return $this->hasOne(MeetingEvents::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[MemWorks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemWorks()
    {
        return $this->hasMany(MemWorks::className(), ['related_event_id' => 'id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['related_event_id' => 'id']);
    }
}
