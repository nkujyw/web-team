<?php
/**
 * InteractiveController.php
 * 实现“互动问答与留言”页面的数据控制，
 * 包括获取随机题目、处理用户留言提交、
 * 以及通过AJAX接口加载更多留言等功能。
 * @author 吉圆伟
 * @date 2025-12-15
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Question; 
use common\models\Messages;

class InteractiveController extends Controller
{
    public function actionIndex()
    {
        // 1. 获取留言数据 (按ID倒序，显示最新的)
        // 初始只显示最新的 10 条
        $messages = Messages::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(10) 
            ->all();
        $newMessage = new Messages();

        // 2. 获取随机题目 (随机取5道)
        $questions = Question::find()->orderBy(new \yii\db\Expression('RAND()'))->limit(5)->all();

        // 3. 处理留言提交
        if ($newMessage->load(Yii::$app->request->post()) && $newMessage->save()) {
            Yii::$app->session->setFlash('success', '留言发布成功！');
            return $this->refresh();
        }

        return $this->render('index', [
            'messages' => $messages,
            'newMessage' => $newMessage,
            'questions' => $questions,
        ]);
    }
    
    
    public function actionCheckAnswer()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $questionId = Yii::$app->request->post('id');
        $userAnswer = Yii::$app->request->post('answer');
        
        $question = Question::findOne($questionId);
        if ($question && $question->correct_answer === $userAnswer) {
            return ['status' => 'success', 'msg' => '回答正确！'];
        }
        return ['status' => 'error', 'msg' => '回答错误，正确答案是：' . $question->correct_answer];
    }

    /**
     * AJAX 接口：获取更多留言
     * @param int $offset 从第几条开始取
     * @return array JSON数据
     */
    public function actionGetMoreMessages($offset)
    {
        // 设置响应格式为 JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // 查询数据库，跳过 $offset 条，再取 10 条
        $messages = Messages::find()
            ->orderBy(['id' => SORT_DESC])
            ->offset($offset)
            ->limit(10)
            ->asArray() // 转为数组，方便前端处理
            ->all();

        return $messages;
    }
}