<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mem_works".
 *
 * @property int $id
 * @property string $name
 * @property string|null $type 作品类型
 * @property string|null $author 作者
 * @property string|null $create_date 创作时间
 * @property string|null $description 作品描述
 * @property string|null $url 作品链接
 * @property int|null $related_event_id 关联事件
 * @property int|null $related_character_id 关联人物
 *
 * @property Characters $relatedCharacter
 * @property Events $relatedEvent
 */
class MemWorks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mem_works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_date'], 'safe'],
            [['description'], 'string'],
            [['related_event_id', 'related_character_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type', 'author'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 500],
            [['related_character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characters::className(), 'targetAttribute' => ['related_character_id' => 'id']],
            [['related_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['related_event_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '作品名称',
            'type' => '作品类型',
            'author' => '作者',
            'create_date' => '创建日期',
            'description' => 'Description',
            'url' => 'Url',
            'related_event_id' => 'Related Event ID',
            'related_character_id' => 'Related Character ID',
        ];
    }

    /**
     * Gets query for [[RelatedCharacter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelatedCharacter()
    {
        return $this->hasOne(Characters::className(), ['id' => 'related_character_id']);
    }

    /**
     * Gets query for [[RelatedEvent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelatedEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'related_event_id']);
    }
}
