<?php
/**
 * Messages.php
 * 消息模型类，加入汉化功能
 * @author 2311786 吉圆伟
 * @date 2025-12-12
 */
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
            'nickname' => '昵称',
        ];
    }
}
