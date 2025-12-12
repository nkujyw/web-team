<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "characters".
 *
 * @property int $id
 * @property string $name
 * @property string|null $biography 人物简介
 * @property int|null $force_id 势力id
 * @property string|null $achievements 主要事迹
 * @property string|null $rank 职务
 * @property string|null $url 照片链接
 *
 * @property Forces $force
 * @property MemWorks[] $memWorks
 * @property Question[] $questions
 * @property Teams[] $teams
 */
class Characters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['biography', 'achievements'], 'string'],
            [['force_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['rank'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 500],
            [
                ['force_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Forces::className(),
                'targetAttribute' => ['force_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'biography' => '人物简介',
            'force_id' => '所属势力',
            'achievements' => '主要事迹',
            'rank' => '职务',
            'url' => '照片链接',
        ];
    }

    /**
     * 关联势力
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForce()
    {
        return $this->hasOne(Forces::className(), ['id' => 'force_id']);
    }

    /**
     * 势力名称（用于展示，替代 force_id）
     */
    public function getForceName()
    {
        return $this->force ? $this->force->name : '';
    }

    /**
     * Gets query for [[MemWorks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemWorks()
    {
        return $this->hasMany(MemWorks::className(), ['related_character_id' => 'id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['related_character_id' => 'id']);
    }

    /**
     * Gets query for [[Teams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Teams::className(), ['leader_id' => 'id']);
    }
}
