<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $message 留言信息
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    return [
        [['message'], 'required'],
        [['message'], 'string'],
        // 【新增】允许 nickname 字段是字符串，最大50个字
        [['nickname'], 'string', 'max' => 50], 
    ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => '留言信息',
        ];
    }
}
