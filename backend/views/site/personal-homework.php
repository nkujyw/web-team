<?php
use yii\helpers\Url;
$this->title = '个人作业下载';

$students = [
    ['name' => '吉圆伟个人作业', 'folder' => '2311786_吉圆伟'],
    ['name' => '滕一睿个人作业', 'folder' => '2313109_滕一睿'],
    ['name' => '刘成蕊个人作业', 'folder' => '2312478_刘成蕊'],
    ['name' => '丛方昊个人作业', 'folder' => '2310682_丛方昊'],
];
?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>个人作业</strong> 一键多传下载</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead><tr><th>学生姓名</th><th class="text-end">管理操作</th></tr></thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><strong><?= $student['name'] ?></strong></td>
                                    <td class="text-end">
                                        <button class="btn btn-primary btn-sm" onclick="multiDownload('<?= $student['folder'] ?>')">
                                            <i class="align-middle me-1" data-feather="download"></i> 三次作业下载
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$getListUrl = Url::to(['site/get-file-list']);
$downloadUrl = Url::to(['site/download', 'type' => 'personal']);

$script = <<< JS
function multiDownload(folderName) {
    // 1. 先去后台问一下这个文件夹里到底有哪几个文件
    fetch("$getListUrl" + "&folder=" + folderName)
        .then(response => response.json())
        .then(files => {
            if (files.length === 0) {
                alert("文件夹里没东西啊！");
                return;
            }
            
            // 2. 循环触发下载
            files.forEach((fileName, index) => {
                // 使用 setTimeout 错开请求，防止浏览器因为瞬时并发过高而拦截
                setTimeout(() => {
                    const url = "$downloadUrl" + "&folder=" + folderName + "&file=" + fileName;
                    
                    // 创建隐藏的下载链接并点击
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = fileName;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }, index * 500); // 每隔 0.5 秒触发一个下载
            });
        });
}
JS;
$this->registerJs($script, \yii\web\View::POS_END);
?>