<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mem_activities".
 *
 * @property int $id
 * @property string $name
 * @property string|null $activity_date 活动日期
 * @property int|null $location_id 地点ID
 * @property string|null $organizer 主办方
 * @property string|null $description 活动描述
 * @property string|null $photo_url 照片链接等
 *
 * @property Locations $location
 */
class MemActivities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mem_activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['activity_date'], 'safe'],
            [['location_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['organizer'], 'string', 'max' => 50],
            [['photo_url'], 'string', 'max' => 500],
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
            'name' => 'Name',
            'activity_date' => 'Activity Date',
            'location_id' => 'Location ID',
            'organizer' => 'Organizer',
            'description' => 'Description',
            'photo_url' => 'Photo Url',
        ];
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
}
