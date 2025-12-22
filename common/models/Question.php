<?php
/**
 * Question.php
 * 问题模型类，加入汉化功能
 * @author 2311786 吉圆伟
 * @date 2025-12-12
 */
namespace common\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $content 题目内容
 * @property string $option_a A
 * @property string $option_b B
 * @property string $option_c C
 * @property string $option_d D
 * @property string $correct_answer 正确答案
 * @property int|null $related_event_id 关联事件
 * @property int|null $related_character_id 关联人物
 *
 * @property Characters $relatedCharacter
 * @property Events $relatedEvent
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'], 'required'],
            [['content'], 'string'],
            [['related_event_id', 'related_character_id'], 'integer'],
            [['option_a', 'option_b', 'option_c', 'option_d'], 'string', 'max' => 500],
            [['correct_answer'], 'string', 'max' => 1],
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
            'content' => '题目内容',  // 对应 SQL 中的注释
            'option_a' => '选项 A',
            'option_b' => '选项 B',
            'option_c' => '选项 C',
            'option_d' => '选项 D',
            'correct_answer' => '正确答案',
            'related_event_id' => '关联事件',
            'related_character_id' => '关联人物',
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
