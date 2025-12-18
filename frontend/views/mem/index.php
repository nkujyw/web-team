<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="mem-container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <!-- 页面标题 -->
    <div class="page-header" style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #B71C1C; font-family: 'KaiTi', serif; font-size: 2.5rem; margin-bottom: 10px;">
            网上纪念馆
        </h1>
        <p style="color: #666; font-size: 1.1rem;">铭记历史 · 缅怀先烈 · 珍爱和平</p>
    </div>

    <!-- 纪念馆简介 -->
    <div class="mem-intro" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h2 style="color: #8E1616; border-left: 4px solid #FFD700; padding-left: 15px; margin-bottom: 20px;">
            纪念馆简介
        </h2>
        <p style="line-height: 1.8; font-size: 1.1rem; color: #333;">
            这里是抗战胜利80周年网上纪念馆，我们通过数字化方式永久保存和展示抗战历史资料、英雄事迹和珍贵文物。
            让我们共同缅怀为民族独立和人民解放事业英勇献身的革命先烈。
        </p>
    </div>

    <!-- 功能区域 -->
    <div class="mem-features" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <!-- 纪念作品 -->
        <div class="feature-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
            <div style="background: #B71C1C; color: white; width: 60px; height: 60px; line-height: 60px; border-radius: 50%; margin: 0 auto 15px; font-size: 1.5rem;">
                <i class="fa fa-picture-o"></i>
            </div>
            <h3 style="color: #8E1616; margin-bottom: 10px;">纪念作品</h3>
            <p style="color: #666;">查看历史照片、艺术作品等纪念资料</p>
            <a href="#" style="display: inline-block; background: #8E1616; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-top: 10px;">
                进入查看
            </a>
        </div>

        <!-- 纪念活动 -->
        <div class="feature-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
            <div style="background: #B71C1C; color: white; width: 60px; height: 60px; line-height: 60px; border-radius: 50%; margin: 0 auto 15px; font-size: 1.5rem;">
                <i class="fa fa-calendar"></i>
            </div>
            <h3 style="color: #8E1616; margin-bottom: 10px;">纪念活动</h3>
            <p style="color: #666;">参与线上纪念活动，表达哀思</p>
            <a href="#" style="display: inline-block; background: #8E1616; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-top: 10px;">
                参与活动
            </a>
        </div>

        <!-- 留言献花 -->
        <div class="feature-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
            <div style="background: #B71C1C; color: white; width: 60px; height: 60px; line-height: 60px; border-radius: 50%; margin: 0 auto 15px; font-size: 1.5rem;">
                <i class="fa fa-commenting"></i>
            </div>
            <h3 style="color: #8E1616; margin-bottom: 10px;">留言献花</h3>
            <p style="color: #666;">向英雄先烈留言致敬，献上鲜花</p>
            <a href="#" style="display: inline-block; background: #8E1616; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; margin-top: 10px;">
                立即参与
            </a>
        </div>
    </div>

    <!-- 最新纪念内容 -->
    <div class="mem-content" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h2 style="color: #8E1616; border-left: 4px solid #FFD700; padding-left: 15px; margin-bottom: 20px;">
            最新纪念内容
        </h2>
        
        <div class="content-list" style="display: grid; gap: 15px;">
            <div class="content-item" style="display: flex; align-items: center; padding: 15px; background: #f9f9f9; border-radius: 4px;">
                <div style="background: #8E1616; color: white; width: 30px; height: 30px; line-height: 30px; text-align: center; border-radius: 50%; margin-right: 15px;">
                    1
                </div>
                <div>
                    <h4 style="margin: 0 0 5px 0; color: #333;">抗战英雄事迹展</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">展示抗战期间英雄人物的感人事迹</p>
                </div>
            </div>
            
            <div class="content-item" style="display: flex; align-items: center; padding: 15px; background: #f9f9f9; border-radius: 4px;">
                <div style="background: #8E1616; color: white; width: 30px; height: 30px; line-height: 30px; text-align: center; border-radius: 50%; margin-right: 15px;">
                    2
                </div>
                <div>
                    <h4 style="margin: 0 0 5px 0; color: #333;">历史文物数字化展示</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">珍贵抗战文物的高清图片和介绍</p>
                </div>
            </div>
            
            <div class="content-item" style="display: flex; align-items: center; padding: 15px; background: #f9f9f9; border-radius: 4px;">
                <div style="background: #8E1616; color: white; width: 30px; height: 30px; line-height: 30px; text-align: center; border-radius: 50%; margin-right: 15px;">
                    3
                </div>
                <div>
                    <h4 style="margin: 0 0 5px 0; color: #333;">纪念活动预告</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">即将举办的线上纪念活动信息</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 页面特定的CSS样式 -->
<style>
.mem-container {
    font-family: "Microsoft YaHei", sans-serif;
}

.feature-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.content-item:hover {
    background: #f0f0f0 !important;
    transition: background 0.3s ease;
}
</style>