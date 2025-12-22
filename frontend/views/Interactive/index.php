<?php
/**
 * interactive/index.php
 * 互动中心主视图文件
 * 包含抗战知识挑战和留言寄语墙两个主要功能模块。
 * @author 吉圆伟
 * @date 2025-12-16
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = '互动中心';

$activeTab = Yii::$app->request->get('tab', 'quiz'); 

// 答题数据
$answersData = [];
foreach ($questions as $q) {
    $answersData[$q->id] = $q->correct_answer;
}
$jsonAnswers = json_encode($answersData);

// 随机昵称库
$randomNicknames = ['热血青年', '铭记历史', '爱国志士', '和平使者', '中华儿女', '不忘初心'];
$jsonNicknames = json_encode($randomNicknames);
?>

<div class="interactive-index container mt-4">

    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?= $activeTab == 'quiz' ? 'active' : '' ?>" id="quiz-tab" data-toggle="tab" href="#quiz" role="tab">
                <i class="fa fa-trophy"></i> 抗战知识挑战
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $activeTab == 'message' ? 'active' : '' ?>" id="message-tab" data-toggle="tab" href="#message" role="tab">
                <i class="fa fa-pencil"></i> 留言寄语墙
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        
        <div class="tab-pane fade <?= $activeTab == 'quiz' ? 'show active' : '' ?>" id="quiz" role="tabpanel">
            <div class="card border-top-0 rounded-0 shadow-sm">
                <div class="card-body p-4">
                    <form id="quiz-form">
                        <?php foreach ($questions as $index => $q): ?>
                            <div class="question-item mb-4 p-3 border-bottom">
                                <h5 class="text-dark"><span class="badge badge-danger mr-2">第<?= $index + 1 ?>题</span> <?= Html::encode($q->content) ?></h5>
                                <div class="options mt-3 ml-4">
                                    <?php foreach(['A','B','C','D'] as $opt): ?>
                                        <div class="custom-control custom-radio mb-2">
                                            <input type="radio" id="q<?= $q->id ?>_<?= $opt ?>" name="question_<?= $q->id ?>" value="<?= $opt ?>" class="custom-control-input">
                                            <label class="custom-control-label" for="q<?= $q->id ?>_<?= $opt ?>">
                                                <?= $opt ?>. <?= Html::encode($q->{'option_'.strtolower($opt)}) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="alert mt-2 d-none result-msg" id="result-<?= $q->id ?>"></div>
                            </div>
                        <?php endforeach; ?>
                    </form>
                    <div class="text-center mt-5 mb-3">
                        <button type="button" class="btn btn-danger btn-lg px-5" onclick="submitPaper()">提交试卷</button>
                        <a href="<?= \yii\helpers\Url::to(['interactive/index']) ?>" class="btn btn-outline-secondary btn-lg ml-3">换一批题目</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade <?= $activeTab == 'message' ? 'show active' : '' ?>" id="message" role="tabpanel">
            <div class="card border-top-0 rounded-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-8">
                            <div class="bg-light p-4 rounded border" style="background-color: #fdfdfd !important; border: 1px solid #e9ecef;">
                                <h5 class="text-center mb-4 text-danger font-weight-bold">
                                    <i class="fa fa-commenting"></i> 铭记历史，寄语未来
                                </h5>
                                <?php Pjax::begin(['id' => 'message-form-pjax']); ?>
                                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                                        <div class="alert alert-success text-center"><?= Yii::$app->session->getFlash('success') ?></div>
                                    <?php endif; ?>

                                    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                                    
                                    <div class="form-group">
                                        <label class="font-weight-bold text-secondary">您的身份 <small class="text-muted font-weight-normal">(限15字)</small></label>
                                        
                                        <div class="d-flex mb-3 shadow-sm" style="border: 1px solid #ced4da; border-radius: 5px; overflow: hidden; background-color: #fff;">
                                            <div class="d-flex align-items-center justify-content-center bg-white text-danger" style="width: 50px; height: 50px; border-right: 0;">
                                                <i class="fa fa-user-circle" style="font-size: 24px;"></i>
                                                </span>
                                            </div>
                                            <?= $form->field($newMessage, 'nickname', [
                                                'options' => ['class' => 'form-group mb-0 flex-grow-1']
                                            ])->textInput([
                                                'id' => 'nickname-input',
                                                'placeholder' => '请输入身份，或点击下方标签快速选择...',
                                                'class' => 'form-control border-left-0', 
                                                'style' => 'height: 50px; box-shadow: none;',
                                                'maxlength' => 15, // 【限制长度】前端限制只能输入15个字
                                                'autocomplete' => 'off' // 关闭浏览器自动填充，避免挡住标签
                                            ])->label(false) ?>
                                        </div>

                                        <div class="quick-tags mt-2">
                                            <small class="text-muted mr-2 d-block d-md-inline mb-2">快速选择：</small>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('一名大学生')">一名大学生</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('抗战老兵后代')">抗战老兵后代</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('共青团员')">共青团员</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('人民教师')">人民教师</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('历史爱好者')">历史爱好者</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('退伍军人')">退伍军人</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('医务工作者')">医务工作者</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('社区志愿者')">社区志愿者</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('大国工匠')">大国工匠</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('科技工作者')">科技工作者</span>
                                            <span class="badge badge-pill badge-light border tag-btn" onclick="fillNickname('爱国华侨')">爱国华侨</span>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="font-weight-bold text-secondary">留言内容</label>
                                        <?= $form->field($newMessage, 'message')->textarea([
                                            'rows' => 4, 
                                            'placeholder' => '写下您的感悟，向先烈致敬...',
                                            'style' => 'resize: none;',
                                            'class' => 'form-control shadow-sm'
                                        ])->label(false) ?>
                                    </div>
                                    
                                    <div class="form-group text-center mt-4">
                                        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> 发布留言', ['class' => 'btn btn-danger btn-block btn-lg shadow']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>

                    <h5 class="border-left border-danger pl-3 mb-4">最新寄语</h5>
                    <div class="row" id="message-container">
                        <?php foreach ($messages as $msg): ?>
                             <div class="col-md-12 mb-3">
                                <div class="media p-3 border rounded bg-white h-100 shadow-sm">
                                    <div class="mr-3 text-danger" style="font-size: 2rem;">
                                        <i class="fa fa-quote-left"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="mb-0 text-dark" style="font-size: 16px; line-height: 1.8;">
                                            <?= Html::encode($msg->message) ?>
                                        </p>
                                        <small class="text-muted mt-2 d-block text-right">
                                            —— 
                                            <?php 
                                            if (!empty($msg->nickname)) {
                                                echo Html::encode($msg->nickname);
                                            } else {
                                                echo $randomNicknames[array_rand($randomNicknames)];
                                            }
                                            ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-center mt-3 pb-5">
                        <button id="load-more-btn" class="btn btn-outline-danger px-5" onclick="loadMoreMessages()">
                            查看更多留言 <i class="fa fa-angle-down"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="scoreModal" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">考试成绩单</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-center py-4">
                    <h1 class="display-4 text-danger font-weight-bold" id="final-score">0分</h1>
                    <p class="lead mt-3" id="final-comment"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// --- 原有的变量和逻辑 ---
var correctAnswers = <?= $jsonAnswers ?>;
var currentOffset = 10; 
var isLoading = false;
var randomNicknames = <?= $jsonNicknames ?>; 

// --- 点击标签填充输入框的函数 ---
function fillNickname(name) {
    // 找到输入框并赋值
    document.getElementById('nickname-input').value = name;
}

// --- 提交试卷逻辑 ---
function submitPaper() {
    var total = Object.keys(correctAnswers).length;
    var correct = 0;
    for (var qId in correctAnswers) {
        var userVal = $('input[name="question_' + qId + '"]:checked').val();
        var correctAns = correctAnswers[qId];
        var $fb = $('#result-' + qId).removeClass('d-none alert-success alert-danger alert-warning');
        
        if (userVal === correctAns) {
            correct++;
            $fb.addClass('alert-success').html('<i class="fa fa-check"></i> 回答正确');
        } else if (!userVal) {
            $fb.addClass('alert-warning').html('未作答，正确答案：' + correctAns);
        } else {
            $fb.addClass('alert-danger').html('回答错误，正确答案：' + correctAns);
        }
    }
    
    var score = Math.round((correct / total) * 100);
    var comment = score === 100 ? "太棒了！您是抗战历史专家！" : (score >= 60 ? "成绩不错，继续加油！" : "建议多参观纪念馆学习哦！");
    
    $('#final-score').text(score + '分');
    $('#final-comment').text(comment);
    $('#scoreModal').modal('show');
}

// 加载更多留言逻辑
function loadMoreMessages() {
    if (isLoading) return;
    isLoading = true;
    var $btn = $('#load-more-btn');
    var originalText = $btn.html();
    $btn.html('<i class="fa fa-spinner fa-spin"></i> 加载中...');

    $.ajax({
        url: '<?= \yii\helpers\Url::to(['interactive/get-more-messages']) ?>',
        type: 'GET',
        data: { offset: currentOffset },
        success: function(data) {
            if (data.length > 0) {
                $.each(data, function(index, msg) {
                    var displayName = "";
                    if (msg.nickname && msg.nickname !== "") {
                        displayName = escapeHtml(msg.nickname); 
                    } else {
                        displayName = randomNicknames[Math.floor(Math.random() * randomNicknames.length)];
                    }

                    var html = `
                        <div class="col-md-12 mb-3">
                            <div class="media p-3 border rounded bg-white h-100 shadow-sm">
                                <div class="mr-3 text-danger" style="font-size: 2rem;">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="media-body">
                                    <p class="mb-0 text-dark" style="font-size: 16px; line-height: 1.8;">` + escapeHtml(msg.message) + `</p>
                                    <small class="text-muted mt-2 d-block text-right">—— ` + displayName + `</small>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#message-container').append(html);
                });
                currentOffset += data.length;
                if (data.length < 10) endLoading($btn);
                else $btn.html(originalText);
            } else {
                endLoading($btn);
            }
            isLoading = false;
        },
        error: function() {
            alert('加载失败');
            $btn.html(originalText);
            isLoading = false;
        }
    });
}

function endLoading($btn) {
    $btn.html('已显示全部留言').attr('disabled', true).addClass('btn-secondary').removeClass('btn-outline-danger');
}

function escapeHtml(text) {
    if (!text) return "";
    return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}
</script>

<style>
/* 样式补充 */
.nav-tabs .nav-link { font-size: 18px; padding: 15px 0; color: #555; background-color: #f8f9fa; border: 1px solid #dee2e6; margin-right: 2px; }
.nav-tabs .nav-link.active { color: #fff; background-color: #d9534f; border-color: #d9534f; font-weight: bold; }

/* 快捷标签的样式 */
.tag-btn {
    cursor: pointer;
    font-size: 14px;
    padding: 8px 15px;
    margin-right: 5px;
    margin-bottom: 5px;
    transition: all 0.2s;
    color: #666;
}
.tag-btn:hover {
    background-color: #d9534f !important;
    color: white !important;
    border-color: #d9534f !important;
}
</style>