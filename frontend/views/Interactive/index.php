<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = '互动中心';

// 准备题目答案数据给JS使用
$answersData = [];
foreach ($questions as $q) {
    $answersData[$q->id] = $q->correct_answer;
}
$jsonAnswers = json_encode($answersData);
?>

<div class="interactive-index container mt-4">

    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="quiz-tab" data-toggle="tab" href="#quiz" role="tab" aria-controls="quiz" aria-selected="true">
                <i class="fa fa-trophy"></i> 抗战知识挑战
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="message-tab" data-toggle="tab" href="#message" role="tab" aria-controls="message" aria-selected="false">
                <i class="fa fa-pencil"></i> 留言寄语墙
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        
        <div class="tab-pane fade show active" id="quiz" role="tabpanel" aria-labelledby="quiz-tab">
            <div class="card border-top-0 rounded-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <form id="quiz-form">
                        <?php foreach ($questions as $index => $q): ?>
                            <div class="question-item mb-4 p-3" id="q-item-<?= $q->id ?>" style="border-bottom: 1px dashed #eee;">
                                <h5 class="text-dark">
                                    <span class="badge badge-danger mr-2">第<?= $index + 1 ?>题</span> 
                                    <?= Html::encode($q->content) ?>
                                </h5>
                                
                                <div class="options mt-3 ml-4">
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="q<?= $q->id ?>_A" name="question_<?= $q->id ?>" value="A" class="custom-control-input">
                                        <label class="custom-control-label" for="q<?= $q->id ?>_A">A. <?= Html::encode($q->option_a) ?></label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="q<?= $q->id ?>_B" name="question_<?= $q->id ?>" value="B" class="custom-control-input">
                                        <label class="custom-control-label" for="q<?= $q->id ?>_B">B. <?= Html::encode($q->option_b) ?></label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="q<?= $q->id ?>_C" name="question_<?= $q->id ?>" value="C" class="custom-control-input">
                                        <label class="custom-control-label" for="q<?= $q->id ?>_C">C. <?= Html::encode($q->option_c) ?></label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="q<?= $q->id ?>_D" name="question_<?= $q->id ?>" value="D" class="custom-control-input">
                                        <label class="custom-control-label" for="q<?= $q->id ?>_D">D. <?= Html::encode($q->option_d) ?></label>
                                    </div>
                                </div>
                                
                                <div class="alert mt-2 d-none result-msg" id="result-<?= $q->id ?>"></div>
                            </div>
                        <?php endforeach; ?>
                    </form>

                    <div class="text-center mt-5 mb-3">
                        <button type="button" class="btn btn-danger btn-lg px-5" onclick="submitPaper()">
                            <i class="fa fa-check-circle"></i> 提交试卷
                        </button>
                        <a href="<?= \yii\helpers\Url::to(['interactive/index']) ?>" class="btn btn-outline-secondary btn-lg ml-3">
                            <i class="fa fa-refresh"></i> 换一批题目
                        </a>
                    </div>

                    <div class="modal fade" id="scoreModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">考试成绩单</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center py-4">
                                    <h1 class="display-4 text-danger font-weight-bold" id="final-score">0分</h1>
                                    <p class="lead mt-3" id="final-comment">评语加载中...</p>
                                    <hr>
                                    <p class="text-muted small">正确答案已在试卷中标注</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">查看错题</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
            <div class="card border-top-0 rounded-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-8">
                            <div class="bg-light p-4 rounded border">
                                <h5 class="text-center mb-3">铭记历史，寄语未来</h5>
                                <?php Pjax::begin(['id' => 'message-form-pjax']); ?>
                                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                                        <div class="alert alert-success text-center">
                                            <?= Yii::$app->session->getFlash('success') ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                                    <?= $form->field($newMessage, 'message')->textarea([
                                        'rows' => 4, 
                                        'class' => 'form-control',
                                        'placeholder' => '请写下您的感言（限200字）...'
                                    ])->label(false) ?>
                                    
                                    <div class="form-group text-center mt-3">
                                        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> 发布留言', ['class' => 'btn btn-danger px-5']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>

                    <h5 class="border-left border-danger pl-3 mb-4">最新寄语</h5>

<div class="row" id="message-container">
    <?php foreach ($messages as $msg): ?>
        <div class="col-md-6 mb-3">
            <div class="media p-3 border rounded bg-white h-100 shadow-sm">
                <div class="mr-3 text-danger" style="font-size: 2rem;">
                    <i class="fa fa-quote-left"></i>
                </div>
                <div class="media-body">
                    <p class="mb-0 text-dark"><?= Html::encode($msg->message) ?></p>
                    <small class="text-muted mt-2 d-block text-right">—— 中华儿女</small>
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

<script>
// 记录当前已经显示了多少条（初始是 PHP 渲染的 10 条）
var currentOffset = 10; 
// 是否正在加载中（防止狂点按钮）
var isLoading = false;

function loadMoreMessages() {
    if (isLoading) return;
    isLoading = true;

    var btn = $('#load-more-btn');
    var originalText = btn.html();
    btn.html('<i class="fa fa-spinner fa-spin"></i> 加载中...');

    // 发起 AJAX 请求
    $.ajax({
        url: '<?= \yii\helpers\Url::to(['interactive/get-more-messages']) ?>',
        type: 'GET',
        data: { offset: currentOffset },
        success: function(data) {
            if (data.length > 0) {
                // 如果有数据，遍历并添加到页面
                $.each(data, function(index, msg) {
                    // 这里要用 JS 拼接出和 PHP 一模一样的 HTML 结构
                    // 注意：为了安全，message 内容需要转义（这里简化处理，实际建议用 text() 方法）
                    var html = `
                        <div class="col-md-6 mb-3">
                            <div class="media p-3 border rounded bg-white h-100 shadow-sm">
                                <div class="mr-3 text-danger" style="font-size: 2rem;">
                                    <i class="fa fa-quote-left"></i>
                                </div>
                                <div class="media-body">
                                    <p class="mb-0 text-dark">` + escapeHtml(msg.message) + `</p>
                                    <small class="text-muted mt-2 d-block text-right">—— 中华儿女</small>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#message-container').append(html);
                });

                // 更新偏移量
                currentOffset += data.length;
                
                // 如果这次取回来的不满 10 条，说明已经到底了
                if (data.length < 10) {
                    btn.html('已显示全部留言').attr('disabled', true).addClass('btn-secondary').removeClass('btn-outline-danger');
                } else {
                    btn.html(originalText);
                }
            } else {
                // 如果直接返回空数组，说明彻底没数据了
                btn.html('已显示全部留言').attr('disabled', true).addClass('btn-secondary').removeClass('btn-outline-danger');
            }
            isLoading = false;
        },
        error: function() {
            alert('加载失败，请稍后重试');
            btn.html(originalText);
            isLoading = false;
        }
    });
}

// 一个简单的防 XSS 转义函数
function escapeHtml(text) {
    if (!text) return "";
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
</script>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
// 获取后端传来的正确答案 JSON 对象
var correctAnswers = <?= $jsonAnswers ?>;

function submitPaper() {
    var totalQuestions = Object.keys(correctAnswers).length;
    var correctCount = 0;
    
    // 遍历每一道题
    for (var qId in correctAnswers) {
        var correctAns = correctAnswers[qId];
        // 获取用户选中的选项
        var userSelected = document.querySelector('input[name="question_' + qId + '"]:checked');
        var userVal = userSelected ? userSelected.value : null;
        var feedbackDiv = document.getElementById('result-' + qId);
        
        // 显示反馈区域
        feedbackDiv.classList.remove('d-none');
        feedbackDiv.classList.remove('alert-success', 'alert-danger', 'alert-warning');
        
        if (userVal === correctAns) {
            correctCount++;
            feedbackDiv.classList.add('alert-success');
            feedbackDiv.innerHTML = '<i class="fa fa-check"></i> 回答正确';
        } else if (userVal === null) {
            feedbackDiv.classList.add('alert-warning');
            feedbackDiv.innerHTML = '<i class="fa fa-exclamation-circle"></i> 未作答，正确答案是：<strong>' + correctAns + '</strong>';
        } else {
            feedbackDiv.classList.add('alert-danger');
            feedbackDiv.innerHTML = '<i class="fa fa-times"></i> 回答错误，正确答案是：<strong>' + correctAns + '</strong>';
        }
    }

    // 计算得分 (百分制)
    var score = Math.round((correctCount / totalQuestions) * 100);
    
    // 生成评语
    var comment = "";
    if (score === 100) {
        comment = "太棒了！您是抗战历史专家！致敬！";
    } else if (score >= 80) {
        comment = "成绩优异！看来您对这段历史非常了解。";
    } else if (score >= 60) {
        comment = "及格了，由于历史久远，有些细节可能淡忘了，再接再厉！";
    } else {
        comment = "历史不应被遗忘，建议您多浏览我们的纪念馆，重温那段岁月。";
    }

    // 填充并显示模态框
    document.getElementById('final-score').innerText = score + '分';
    document.getElementById('final-comment').innerText = comment;
    
    // 使用 jQuery 显示 Bootstrap Modal
    $('#scoreModal').modal('show');
}
</script>

<style>
/* 简单的样式美化 */
.nav-tabs .nav-link {
    font-size: 18px;
    padding: 15px 0;
    color: #555;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    margin-right: 2px;
}
.nav-tabs .nav-link.active {
    color: #fff;
    background-color: #d9534f; /* 红色主题 */
    border-color: #d9534f;
    font-weight: bold;
}
.nav-tabs .nav-link:hover {
    background-color: #e2e6ea;
}
.nav-tabs .nav-link.active:hover {
    background-color: #c9302c;
}
.custom-radio .custom-control-label {
    cursor: pointer;
    font-size: 16px;
}
.badge-danger {
    background-color: #d9534f;
}
</style>