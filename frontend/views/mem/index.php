<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $memWorks common\models\MemWorks[] */
/* @var $memActivities common\models\MemActivities[] */

$this->title = '网上纪念馆 - 中国抗战胜利80周年纪念网';
?>

<style>
/* 纪念馆模块样式 */
.mem-classic-body {
    margin: 0;
    padding: 0;
    line-height: 1.5em;
    font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif;
    font-size: 16px; /* 可以保留16px，这样文字稍大更清晰 */
    color: #333;
    background: #faf1dd url('https://www.toptal.com/designers/subtlepatterns/uploads/old_map.png') repeat;
    min-height: 100vh; /* 这个可以保留，保证页面占满全屏 */
}

.mem-classic-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.mem-classic-header {
    padding: 0 0 15px 0;
    margin: 0 0 25px 0;
    font-size: 28px;
    color: #ab1010;
    font-weight: bold;
    border-bottom: 3px solid #e3bb67;
    font-family: 'KaiTi', serif;
    text-align: center;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

.mem-classic-section {
    margin-bottom: 40px;
    padding: 30px;
    background: #fef9ec;
    border: 2px solid #e3bb67;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* 纪念馆简介 */
.intro-section {
    background: #fef9ec;
    border: 2px solid #e3bb67;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* 纪念功能区网格 */
.mem-grid-2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.mem-feature-card {
    background: white;
    padding: 30px;
    border: 2px solid #d4bc88;
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}

.mem-feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
}

.mem-icon-circle {
    background: #ab1010;
    color: white;
    width: 90px;
    height: 90px;
    line-height: 90px;
    border-radius: 50%;
    margin: 0 auto 20px;
    font-size: 2.5rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.mem-feature-card h3 {
    color: #8E1616;
    margin-bottom: 15px;
    font-size: 1.4rem;
    font-family: 'KaiTi', serif;
}

.mem-feature-card p {
    color: #666;
    margin-bottom: 20px;
    font-size: 1.05rem;
    line-height: 1.6;
}

.mem-btn-classic {
    display: inline-block;
    background: #8E1616;
    color: white;
    padding: 12px 30px;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    font-weight: bold;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

.mem-btn-classic:hover {
    background: #ab1010;
    color: white;
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* 内容列表样式 */
.mem-content-list {
    display: grid;
    gap: 20px;
}

.mem-content-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f9f9f9;
    border: 2px solid #e3bb67;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
}

.mem-content-item:hover {
    background: #fff5e0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.mem-number-circle {
    background: #8E1616;
    color: white;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    margin-right: 20px;
    flex-shrink: 0;
    font-weight: bold;
    font-size: 1.2rem;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
}

.mem-content-item h4 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 1.2rem;
    font-weight: bold;
}

.mem-content-item p {
    margin: 0;
    color: #666;
    font-size: 1rem;
}

/* 弹窗样式 */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.85);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 10000;
    backdrop-filter: blur(5px);
}

.modal-content {
    background: linear-gradient(135deg, #fef9ec 0%, #fff5e0 100%);
    border: 4px solid #e3bb67;
    border-radius: 20px;
    width: 90%;
    max-width: 1000px;
    max-height: 90vh;
    padding: 40px;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    animation: modalFadeIn 0.4s ease;
    overflow: hidden;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 3px solid #e3bb67;
    position: relative;
}

.modal-header h2 {
    color: #ab1010;
    font-size: 2.5rem;
    margin: 0;
    font-family: 'KaiTi', serif;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    letter-spacing: 1px;
    font-weight: bold;
}

.modal-close {
    background: #8E1616;
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.modal-close:hover {
    background: #ab1010;
    transform: rotate(90deg) scale(1.1);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
}

.modal-body {
    color: #333;
    line-height: 1.8;
    max-height: 70vh;
    overflow-y: auto;
    padding: 10px 5px;
    font-size: 1.1rem;
}

/* 列表项样式 */
.work-item, .activity-item {
    padding: 25px;
    border-bottom: 2px solid #e3bb67;
    background: linear-gradient(135deg, #fffdf6 0%, #fff9ec 100%);
    border-radius: 10px;
    margin-bottom: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.work-item img, .activity-item img {
    width: 140px;
    height: 100px;
    object-fit: cover;
    border: 3px solid #d4bc88;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* 响应式调整 */
@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        padding: 25px;
        max-height: 95vh;
    }
    
    .modal-header h2 {
        font-size: 1.8rem;
    }
    
    .modal-close {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
    }
    
    .work-item img, .activity-item img {
        width: 100px;
        height: 80px;
    }
    
    .mem-grid-2 {
        grid-template-columns: 1fr;
    }
    
    .mem-classic-header {
        font-size: 24px;
    }
}
</style>

<div class="mem-classic-body">
    <div class="mem-classic-container">
        <!-- 页面标题区域 -->
        <div style="text-align: center; padding: 40px 0;">
            <h1 style="color: #B71C1C; font-family: 'KaiTi', serif; font-size: 2.8rem; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); letter-spacing: 2px;">网上纪念馆</h1>
            <p style="color: #666; margin: 10px 0 0 0; font-style: italic; font-size: 1.2rem; letter-spacing: 1px;">铭记历史 · 缅怀先烈 · 珍爱和平</p>
        </div>

        <!-- 纪念馆简介 -->
        <div class="intro-section">
            <h2 class="mem-classic-header">纪念馆简介</h2>
            <p style="line-height: 1.9; font-size: 1.2rem; color: #333; text-align: justify; text-indent: 2em;">
                这里是抗战胜利80周年网上纪念馆，我们通过数字化方式永久保存和展示抗战历史资料、英雄事迹和珍贵文物。
                让我们共同缅怀为民族独立和人民解放事业英勇献身的革命先烈，传承伟大的抗战精神，珍视来之不易的和平。
            </p>
        </div>

        <!-- 纪念功能区 -->
        <div class="mem-classic-section">
            <h2 class="mem-classic-header">纪念功能区</h2>
            
            <div class="mem-grid-2">
                <!-- 纪念作品 -->
                <div class="mem-feature-card" id="worksCard">
                    <div class="mem-icon-circle">
                        <i class="fa fa-picture-o"></i>
                    </div>
                    <h3>纪念作品</h3>
                    <p>查看历史照片、艺术作品等纪念资料</p>
                    <button class="mem-btn-classic view-works-btn">进入查看</button>
                </div>

                <!-- 纪念活动 -->
                <div class="mem-feature-card" id="eventsCard">
                    <div class="mem-icon-circle">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <h3>纪念活动</h3>
                    <p>参与线上纪念活动，表达哀思</p>
                    <button class="mem-btn-classic view-events-btn">参与活动</button>
                </div>
            </div>
        </div>

        <!-- 最新纪念内容 -->
        <div class="mem-classic-section">
            <h2 class="mem-classic-header">最新纪念内容</h2>
            
            <div class="mem-content-list">
                <?php if (!empty($memWorks)): ?>
                    <?php foreach ($memWorks as $index => $work): ?>
                        <div class="mem-content-item">
                            <div class="mem-number-circle"><?= $index + 1 ?></div>
                            <div>
                                <h4><?= Html::encode($work->name) ?></h4>
                                <p>
                                    <?= Html::encode($work->author) ?> · <?= Html::encode($work->type) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #666; padding: 30px; font-size: 1.2rem;">暂无纪念作品</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- 页脚 -->
        <div style="text-align: center; padding: 40px 0; color: #666; border-top: 2px solid #e3bb67; margin-top: 40px;">
            <p style="margin: 0; font-size: 1.1rem;">
                &copy; 2025 抗战80周年纪念项目组 | 铭记历史 吾辈自强
            </p>
        </div>
    </div>
</div>

<!-- 纪念作品弹窗 -->
<div id="worksModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>纪念作品</h2>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body" id="worksModalBody">
            <!-- 内容由JavaScript动态加载 -->
        </div>
    </div>
</div>

<!-- 纪念活动弹窗 -->
<div id="eventsModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>纪念活动</h2>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body" id="eventsModalBody">
            <!-- 内容由JavaScript动态加载 -->
        </div>
    </div>
</div>

<script>
// 纪念馆模块交互功能
document.addEventListener('DOMContentLoaded', function() {
    initInterface();
    bindEvents();
});

function initInterface() {
    console.log('纪念馆界面初始化完成');
}

function bindEvents() {
    // 纪念作品相关交互
    const worksCard = document.getElementById('worksCard');
    const viewWorksBtn = document.querySelector('.view-works-btn');
    
    worksCard.addEventListener('click', function(e) {
        if (!e.target.classList.contains('view-works-btn')) {
            openModal('worksModal');
            loadAllWorks();
        }
    });
    
    viewWorksBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        openModal('worksModal');
        loadAllWorks();
    });
    
    // 纪念活动相关交互
    const eventsCard = document.getElementById('eventsCard');
    const viewEventsBtn = document.querySelector('.view-events-btn');
    
    eventsCard.addEventListener('click', function(e) {
        if (!e.target.classList.contains('view-events-btn')) {
            openModal('eventsModal');
            loadAllActivities();
        }
    });
    
    viewEventsBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        openModal('eventsModal');
        loadAllActivities();
    });
    
    // 移除作品列表项的点击事件
    // 不再绑定点击事件
    
    // 弹窗控制
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', closeModal);
    });
    
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            closeModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
}

// 弹窗控制函数
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeModal() {
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.style.display = 'none';
    });
    document.body.style.overflow = 'auto';
}

// 加载所有纪念作品
function loadAllWorks() {
    const modalBody = document.getElementById('worksModalBody');
    modalBody.innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 3rem; color: #8E1616; margin-bottom: 20px;">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
            <p style="font-size: 1.3rem; color: #666;">正在加载纪念作品...</p>
        </div>
    `;
    
    fetch('<?= Url::to(['mem/get-all-works']) ?>')
        .then(response => {
            if (!response.ok) {
                throw new Error('网络响应错误: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('作品数据:', data);
            if (data.status === 'success') {
                modalBody.innerHTML = renderWorksList(data.data);
            } else {
                modalBody.innerHTML = `
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                            <i class="fa fa-picture-o"></i>
                        </div>
                        <p style="font-size: 1.4rem; color: #666;">暂无纪念作品</p>
                    </div>`;
            }
        })
        .catch(error => {
            console.error('加载错误:', error);
            modalBody.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #666;">
                    <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                        <i class="fa fa-picture-o"></i>
                    </div>
                    <p style="font-size: 1.4rem;">暂无纪念作品</p>
                </div>`;
        });
}

// 加载所有纪念活动
function loadAllActivities() {
    const modalBody = document.getElementById('eventsModalBody');
    modalBody.innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 3rem; color: #8E1616; margin-bottom: 20px;">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
            <p style="font-size: 1.3rem; color: #666;">正在加载纪念活动...</p>
        </div>
    `;
    
    fetch('<?= Url::to(['mem/get-all-activities']) ?>')
        .then(response => {
            if (!response.ok) {
                throw new Error('网络响应错误: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('活动数据:', data);
            if (data.status === 'success') {
                modalBody.innerHTML = renderActivitiesList(data.data);
            } else {
                modalBody.innerHTML = `
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <p style="font-size: 1.4rem; color: #666;">暂无纪念活动</p>
                    </div>`;
            }
        })
        .catch(error => {
            console.error('加载错误:', error);
            modalBody.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #666;">
                    <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <p style="font-size: 1.4rem;">暂无纪念活动</p>
                </div>`;
        });
}

// 渲染纪念作品列表
function renderWorksList(works) {
    if (!works || works.length === 0) {
        return `
            <div style="text-align: center; padding: 50px; color: #666;">
                <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                    <i class="fa fa-picture-o"></i>
                </div>
                <p style="font-size: 1.4rem;">暂无纪念作品</p>
            </div>
        `;
    }
    
    let html = `
        <div style="margin-bottom: 25px; padding-bottom: 20px; border-bottom: 3px solid #e3bb67;">
            <h3 style="color: #8E1616; margin: 0; font-size: 1.8rem; font-family: 'KaiTi', serif;">
                共发现 <span style="color: #ab1010; font-size: 2.2rem;">${works.length}</span> 个纪念作品
            </h3>
        </div>
    `;
    
    works.forEach(work => {
        const imageUrl = work.full_url || work.url;
        html += `
            <div class="work-item">
                <div style="display: flex; align-items: center;">
                    ${imageUrl ? `
                    <div style="flex-shrink: 0; width: 160px; height: 120px; margin-right: 25px; 
                                border: 3px solid #d4bc88; border-radius: 10px; 
                                overflow: hidden; display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9;">
                        <img src="${imageUrl}" 
                             style="width: 100%; height: 100%; object-fit: cover;" 
                             alt="${work.name}"
                             onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'color:#888; font-size:1rem; padding:20px;\'>暂无图片</div>';">
                    </div>
                    ` : `
                    <div style="flex-shrink: 0; width: 160px; height: 120px; margin-right: 25px; 
                                border: 3px solid #ddd; border-radius: 10px; 
                                display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9; color: #888;">
                        <i class="fa fa-picture-o" style="font-size: 3rem;"></i>
                    </div>
                    `}
                    <div style="flex-grow: 1;">
                        <h4 style="margin: 0 0 12px 0; color: #333; font-size: 1.4rem; font-weight: bold;">${work.name}</h4>
                        <p style="margin: 0 0 8px 0; color: #666; font-size: 1.1rem;">
                            <strong>作者：</strong>${work.author || '未知'} 
                            <span style="margin: 0 15px; color: #ddd;">|</span>
                            <strong>类型：</strong>${work.type || '未分类'}
                        </p>
                        <p style="margin: 0; color: #888; font-size: 1rem;">
                            <strong>创作时间：</strong>${work.create_date || '未知'}
                        </p>
                    </div>
                </div>
                ${work.description ? `
                <div style="margin-top: 15px; padding: 15px; background: #f9f9f9; border-radius: 8px; border-left: 4px solid #8E1616;">
                    <p style="margin: 0; color: #555; font-size: 1.05rem; line-height: 1.6;">
                        ${work.description.substring(0, 200)}${work.description.length > 200 ? '...' : ''}
                    </p>
                </div>
                ` : ''}
            </div>
        `;
    });
    
    return html;
}

// 渲染纪念活动列表
function renderActivitiesList(activities) {
    if (!activities || activities.length === 0) {
        return `
            <div style="text-align: center; padding: 50px; color: #666;">
                <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                    <i class="fa fa-calendar"></i>
                </div>
                <p style="font-size: 1.4rem;">暂无纪念活动</p>
            </div>
        `;
    }
    
    let html = `
        <div style="margin-bottom: 25px; padding-bottom: 20px; border-bottom: 3px solid #e3bb67;">
            <h3 style="color: #8E1616; margin: 0; font-size: 1.8rem; font-family: 'KaiTi', serif;">
                共发现 <span style="color: #ab1010; font-size: 2.2rem;">${activities.length}</span> 个纪念活动
            </h3>
        </div>
    `;
    
    activities.forEach(activity => {
        const imageUrl = activity.full_photo_url || activity.photo_url;
        html += `
            <div class="activity-item">
                <div style="display: flex; align-items: center;">
                    ${imageUrl ? `
                    <div style="flex-shrink: 0; width: 160px; height: 120px; margin-right: 25px; 
                                border: 3px solid #d4bc88; border-radius: 10px; 
                                overflow: hidden; display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9;">
                        <img src="${imageUrl}" 
                             style="width: 100%; height: 100%; object-fit: cover;" 
                             alt="${activity.name}"
                             onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'color:#888; font-size:1rem; padding:20px;\'>暂无图片</div>';">
                    </div>
                    ` : `
                    <div style="flex-shrink: 0; width: 160px; height: 120px; margin-right: 25px; 
                                border: 3px solid #ddd; border-radius: 10px; 
                                display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9; color: #888;">
                        <i class="fa fa-calendar" style="font-size: 3rem;"></i>
                    </div>
                    `}
                    <div style="flex-grow: 1;">
                        <h4 style="margin: 0 0 12px 0; color: #333; font-size: 1.4rem; font-weight: bold;">${activity.name}</h4>
                        <p style="margin: 0 0 8px 0; color: #666; font-size: 1.1rem;">
                            <strong>主办方：</strong>${activity.organizer || '未知'} 
                            <span style="margin: 0 15px; color: #ddd;">|</span>
                            <strong>时间：</strong>${activity.activity_date}
                        </p>
                        <p style="margin: 0; color: #888; font-size: 1rem;">
                            <strong>地点：</strong>${activity.location_id || '未指定'}
                        </p>
                    </div>
                </div>
                ${activity.description ? `
                <div style="margin-top: 15px; padding: 15px; background: #f9f9f9; border-radius: 8px; border-left: 4px solid #8E1616;">
                    <p style="margin: 0; color: #555; font-size: 1.05rem; line-height: 1.6;">
                        ${activity.description.substring(0, 200)}${activity.description.length > 200 ? '...' : ''}
                    </p>
                </div>
                ` : ''}
            </div>
        `;
    });
    
    return html;
}
</script>