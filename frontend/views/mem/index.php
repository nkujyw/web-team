<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<style>
/* 古典历史模板样式 */
.mem-classic-body {
    margin: 0;
    padding: 0;
    line-height: 1.5em;
    font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif;
    font-size: 14px;
    color: #333;
    background: #faf1dd url('https://www.toptal.com/designers/subtlepatterns/uploads/old_map.png') repeat;
}

.mem-classic-container {
    width: 960px;
    margin: 0 auto;
    padding: 0 5px;
    position: relative; /* 为弹窗定位做准备 */
}

.mem-classic-header {
    padding: 0 0 10px 0;
    margin: 0 0 20px 0;
    font-size: 24px;
    color: #ab1010;
    font-weight: bold;
    border-bottom: 2px solid #e3bb67;
    font-family: 'KaiTi', serif;
}

.mem-classic-section {
    margin-bottom: 30px;
    padding: 20px;
    background: #fef9ec;
    border: 1px solid #e3bb67;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.mem-feature-card {
    background: white;
    padding: 20px;
    border: 1px solid #d4bc88;
    border-radius: 5px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.mem-feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.mem-content-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f9f9f9;
    border: 1px solid #e3bb67;
    border-radius: 4px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.mem-content-item:hover {
    background: #f0f0f0;
}

.mem-icon-circle {
    background: #ab1010;
    color: white;
    width: 60px;
    height: 60px;
    line-height: 60px;
    border-radius: 50%;
    margin: 0 auto 15px;
    font-size: 1.5rem;
}

/* 点击致敬图标样式 */
.mem-icon-circle-small {
    background: #ab1010;
    color: white;
    width: 50px;
    height: 50px;
    line-height: 50px;
    border-radius: 50%;
    margin: 0 auto 10px;
    font-size: 1.3rem;
}

.mem-number-circle {
    background: #8E1616;
    color: white;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    border-radius: 50%;
    margin-right: 15px;
    flex-shrink: 0;
}

.mem-btn-classic {
    display: inline-block;
    background: #8E1616;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    text-decoration: none;
    margin-top: 10px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
}

.mem-btn-classic:hover {
    background: #ab1010;
    color: white;
    text-decoration: none;
}

/* 点击致敬按钮样式 */
.mem-tribute-btn {
    display: inline-block;
    background: #8E1616;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    margin-top: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.mem-tribute-btn:hover {
    background: #ab1010;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

/* 致敬计数样式 */
.tribute-counter {
    margin-top: 10px;
    color: #8E1616;
    font-size: 0.85rem;
    font-weight: bold;
    padding: 5px 10px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 15px;
    border: 1px solid #e3bb67;
    display: inline-block;
}

.mem-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* 纪念功能区 - 两列网格 */
.mem-grid-2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.mem-content-list {
    display: grid;
    gap: 15px;
}

/* 新添加的布局样式 */

/* 纪念馆简介和点击致敬容器 */
.intro-tribute-container {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

/* 纪念馆简介部分 */
.intro-section {
    background: #fef9ec;
    border: 1px solid #e3bb67;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* 点击致敬侧边栏 */
.tribute-sidebar {
    background: #fef9ec;
    border: 1px solid #e3bb67;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.tribute-sidebar h3 {
    color: #8E1616;
    font-size: 1.2rem;
    margin-bottom: 10px;
    font-family: 'KaiTi', serif;
}

.tribute-sidebar p {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 15px;
    line-height: 1.4;
    text-align: center;
}

/* 弹窗样式 */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background: #fef9ec;
    border: 2px solid #e3bb67;
    border-radius: 8px;
    width: 80%;
    max-width: 600px;
    padding: 30px;
    position: relative;
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    animation: modalFadeIn 0.3s ease;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-50px); }
    to { opacity: 1; transform: translateY(0); }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e3bb67;
}

.modal-header h2 {
    color: #ab1010;
    font-size: 1.8rem;
    margin: 0;
    font-family: 'KaiTi', serif;
}

.modal-close {
    background: #8E1616;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: background 0.3s ease;
}

.modal-close:hover {
    background: #ab1010;
}

.modal-body {
    color: #333;
    line-height: 1.6;
    max-height: 60vh;
    overflow-y: auto;
    padding: 10px 5px;
}

.modal-body p {
    margin-bottom: 15px;
}

/* 响应式调整 */
@media (max-width: 768px) {
    .mem-grid-2 {
        grid-template-columns: 1fr;
    }
    
    .intro-tribute-container {
        grid-template-columns: 1fr;
    }
    
    .mem-classic-title h1 {
        font-size: 2rem;
    }
    
    .modal-content {
        width: 95%;
        padding: 20px;
    }
}
</style>

<div class="mem-classic-body">
    <div class="mem-classic-container">
        <!-- 页面标题区域 -->
        <div style="text-align: center; padding: 30px 0;">
            <h1 style="color: #B71C1C; font-family: 'KaiTi', serif; font-size: 2.2rem; margin: 0; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">网上纪念馆</h1>
            <p style="color: #666; margin: 5px 0 0 0; font-style: italic;">铭记历史 · 缅怀先烈 · 珍爱和平</p>
        </div>

        <!-- 纪念馆简介和点击致敬容器 -->
        <div class="intro-tribute-container">
            <!-- 左侧：纪念馆简介 -->
            <div class="intro-section">
                <h2 class="mem-classic-header">纪念馆简介</h2>
                <p style="line-height: 1.8; font-size: 1.1rem; color: #333; text-align: justify;">
                    这里是抗战胜利80周年网上纪念馆，我们通过数字化方式永久保存和展示抗战历史资料、英雄事迹和珍贵文物。
                    让我们共同缅怀为民族独立和人民解放事业英勇献身的革命先烈，传承伟大的抗战精神，珍视来之不易的和平。
                </p>
            </div>

            <!-- 右侧：点击致敬侧边栏 -->
            <div class="tribute-sidebar">
                <div class="mem-icon-circle-small">
                    <i class="fa fa-heart"></i>
                </div>
                <h3>点击致敬</h3>
                <p>向英雄先烈致以崇高敬意</p>
                <button id="tributeBtn" class="mem-tribute-btn">点击致敬</button>
                <div id="tributeCounter" class="tribute-counter">
                    已有 <span id="tributeCount">0</span> 人致敬
                </div>
            </div>
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
                    <h3 style="color: #8E1616; margin-bottom: 10px;">纪念作品</h3>
                    <p style="color: #666; margin-bottom: 15px;">查看历史照片、艺术作品等纪念资料</p>
                    <button class="mem-btn-classic view-works-btn">进入查看</button>
                </div>

                <!-- 纪念活动 -->
                <div class="mem-feature-card" id="eventsCard">
                    <div class="mem-icon-circle">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <h3 style="color: #8E1616; margin-bottom: 10px;">纪念活动</h3>
                    <p style="color: #666; margin-bottom: 15px;">参与线上纪念活动，表达哀思</p>
                    <button class="mem-btn-classic view-events-btn">参与活动</button>
                </div>
            </div>
        </div>

        <!-- 最新纪念内容 -->
        <div class="mem-classic-section">
            <h2 class="mem-classic-header">最新纪念内容</h2>
            
            <div class="mem-content-list">
                <div class="mem-content-item">
                    <div class="mem-number-circle">1</div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; color: #333;">抗战英雄事迹展</h4>
                        <p style="margin: 0; color: #666; font-size: 0.9rem;">展示抗战期间英雄人物的感人事迹</p>
                    </div>
                </div>
                
                <div class="mem-content-item">
                    <div class="mem-number-circle">2</div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; color: #333;">历史文物数字化展示</h4>
                        <p style="margin: 0; color: #666; font-size: 0.9rem;">珍贵抗战文物的高清图片和介绍</p>
                    </div>
                </div>
                
                <div class="mem-content-item">
                    <div class="mem-number-circle">3</div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; color: #333;">纪念活动预告</h4>
                        <p style="margin: 0; color: #666; font-size: 0.9rem;">即将举办的线上纪念活动信息</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 页脚 -->
        <div style="text-align: center; padding: 30px 0; color: #666; border-top: 1px solid #e3bb67; margin-top: 30px;">
            <p style="margin: 0; font-size: 0.9rem;">
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
            <button class="modal-close" onclick="closeModal('worksModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p>这里将展示纪念作品相关内容...</p>
            <p>功能正在开发中，敬请期待！</p>
            <p>您可以浏览以下内容：</p>
            <ul style="padding-left: 20px; margin: 10px 0;">
                <li>历史照片</li>
                <li>艺术作品</li>
                <li>文献资料</li>
                <li>数字化文物</li>
            </ul>
        </div>
    </div>
</div>

<!-- 纪念活动弹窗 -->
<div id="eventsModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>纪念活动</h2>
            <button class="modal-close" onclick="closeModal('eventsModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p>这里将展示纪念活动相关内容...</p>
            <p>功能正在开发中，敬请期待！</p>
            <p>您可以参与以下活动：</p>
            <ul style="padding-left: 20px; margin: 10px 0;">
                <li>线上祭扫</li>
                <li>留言致敬</li>
                <li>献花活动</li>
                <li>专题展览</li>
            </ul>
        </div>
    </div>
</div>

<script>
// 初始化点击致敬计数
let tributeCount = <?= $tributeCount ?>;

document.addEventListener('DOMContentLoaded', function() {
    // 点击致敬功能
    const tributeBtn = document.getElementById('tributeBtn');
    const tributeCounter = document.getElementById('tributeCounter');
    
    tributeBtn.addEventListener('click', function() {
        // 发起 AJAX 请求增加致敬计数
        fetch('<?= Url::to(['mem/tribute']) ?>', {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // 更新显示
                tributeCount = data.count;
                document.getElementById('tributeCount').textContent = tributeCount;
                
                // 添加点击效果
                this.innerHTML = '<i class="fa fa-check"></i> 已致敬';
                this.style.background = '#4CAF50';
                this.disabled = true;
                
                // 显示感谢消息
                alert('感谢您的致敬！您已向革命先烈表达崇高敬意。');
                
                // 3秒后恢复按钮状态
                setTimeout(() => {
                    this.innerHTML = '点击致敬';
                    this.style.background = '';
                    this.disabled = false;
                }, 3000);
            }
        });
    });
    
    // 纪念作品卡片点击效果
    const worksCard = document.getElementById('worksCard');
    const viewWorksBtn = document.querySelector('.view-works-btn');
    
    worksCard.addEventListener('click', function(e) {
        if (!e.target.classList.contains('view-works-btn')) {
            openModal('worksModal');
        }
    });
    
    viewWorksBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        openModal('worksModal');
    });
    
    // 纪念活动卡片点击效果
    const eventsCard = document.getElementById('eventsCard');
    const viewEventsBtn = document.querySelector('.view-events-btn');
    
    eventsCard.addEventListener('click', function(e) {
        if (!e.target.classList.contains('view-events-btn')) {
            openModal('eventsModal');
        }
    });
    
    viewEventsBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        openModal('eventsModal');
    });
    
    // 内容项点击效果
    const contentItems = document.querySelectorAll('.mem-content-item');
    contentItems.forEach(item => {
        item.addEventListener('click', function() {
            // 这里可以添加点击后的详细展示逻辑
            console.log('点击了内容项:', this.querySelector('h4').textContent);
        });
    });
});

// 弹窗控制函数
function openModal(modalId) {
    fetch('<?= Url::to(['mem/get-modal-content']) ?>', {
        method: 'POST',
        body: JSON.stringify({ modalId: modalId }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modalContent = data.content;
            const modal = document.getElementById(modalId);
            const modalHeader = modal.querySelector('.modal-header h2');
            const modalBody = modal.querySelector('.modal-body');
            
            modalHeader.textContent = modalContent.title;
            modalBody.innerHTML = modalContent.body;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // 防止背景滚动
        }
    });
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // 恢复滚动
    }
}

// 点击弹窗外部关闭弹窗
document.addEventListener('click', function(e) {
    const worksModal = document.getElementById('worksModal');
    const eventsModal = document.getElementById('eventsModal');
    
    if (worksModal && e.target === worksModal) {
        closeModal('worksModal');
    }
    
    if (eventsModal && e.target === eventsModal) {
        closeModal('eventsModal');
    }
});

// 按ESC键关闭弹窗
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('worksModal');
        closeModal('eventsModal');
    }
});
</script>