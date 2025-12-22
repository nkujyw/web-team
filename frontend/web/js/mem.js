/**
 * 纪念馆页面交互功能
 * 作者：丛方昊 2310682
 * 功能：处理纪念馆页面的模态框、数据加载和交互
 */

// 全局变量存储URL - 将在页面中由PHP定义
let MemUrls = {};

document.addEventListener('DOMContentLoaded', function() {
    // 从全局获取URL配置
    if (typeof window.MemUrlsConfig !== 'undefined') {
        MemUrls = window.MemUrlsConfig;
    }
    
    initInterface();
    bindEvents();
});

function initInterface() {
    console.log('纪念馆界面初始化完成');
}

function bindEvents() {
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
    
    document.querySelectorAll('.mem-work-item').forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            loadWorkDetail(id);
        });
    });
    
    document.querySelectorAll('.mem-activity-item').forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            loadActivityDetail(id);
        });
    });
    
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
    
    fetch(MemUrls.getAllWorks)
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
                document.querySelectorAll('.work-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        loadWorkDetail(id);
                    });
                });
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
    
    fetch(MemUrls.getAllActivities)
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
                document.querySelectorAll('.activity-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        loadActivityDetail(id);
                    });
                });
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

function loadWorkDetail(id) {
    const modalBody = document.getElementById('detailModalBody');
    const detailTitle = document.getElementById('detailTitle');
    
    modalBody.innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 3rem; color: #8E1616; margin-bottom: 20px;">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
            <p style="font-size: 1.3rem; color: #666;">正在加载作品详情...</p>
        </div>
    `;
    
    detailTitle.textContent = '纪念作品详情';
    
    fetch(MemUrls.getWorkDetail + '&id=' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('网络响应错误: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('作品详情数据:', data);
            if (data.status === 'success') {
                modalBody.innerHTML = renderWorkDetail(data.data);
                openModal('detailModal');
            } else {
                modalBody.innerHTML = `
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <p style="font-size: 1.4rem; color: #666;">${data.message || '加载失败'}</p>
                    </div>`;
                openModal('detailModal');
            }
        })
        .catch(error => {
            console.error('加载错误:', error);
            modalBody.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #666;">
                    <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <p style="font-size: 1.4rem;">加载失败，请稍后重试</p>
                </div>`;
            openModal('detailModal');
        });
}

function loadActivityDetail(id) {
    const modalBody = document.getElementById('detailModalBody');
    const detailTitle = document.getElementById('detailTitle');
    
    modalBody.innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 3rem; color: #8E1616; margin-bottom: 20px;">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
            <p style="font-size: 1.3rem; color: #666;">正在加载活动详情...</p>
        </div>
    `;
    
    detailTitle.textContent = '纪念活动详情';
    
    fetch(MemUrls.getActivityDetail + '&id=' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('网络响应错误: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('活动详情数据:', data);
            if (data.status === 'success') {
                modalBody.innerHTML = renderActivityDetail(data.data);
                openModal('detailModal');
            } else {
                modalBody.innerHTML = `
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <p style="font-size: 1.4rem; color: #666;">${data.message || '加载失败'}</p>
                    </div>`;
                openModal('detailModal');
            }
        })
        .catch(error => {
            console.error('加载错误:', error);
            modalBody.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #666;">
                    <div style="font-size: 5rem; color: #ddd; margin-bottom: 20px;">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <p style="font-size: 1.4rem;">加载失败，请稍后重试</p>
                </div>`;
            openModal('detailModal');
        });
}

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
            <div class="work-item" data-id="${work.id}">
                <div style="display: flex; align-items: center;">
                    ${imageUrl ? `
                    <div style="flex-shrink: 0; width: 160px; height: 120px; margin-right: 25px; 
                                border: 3px solid #d4bc88; border-radius: 10px; 
                                overflow: hidden; display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9;">
                        <img src="${imageUrl}" 
                             style="width: 100%; height: 100%; object-fit: cover;" 
                             alt="${work.name}"
                             onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'display:flex; align-items:center; justify-content:center; width:100%; height:100%; background:#f9f9f9; color:#888;\'><i class=\'fa fa-picture-o\' style=\'font-size:2rem;\'></i></div>';">
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
        const locationName = activity.location_name || (activity.location_id ? '地点ID: ' + activity.location_id : '未指定地点');
        
        html += `
            <div class="activity-item" data-id="${activity.id}">
                <div style="display: flex; align-items: center;">
                    ${imageUrl ? `
                    <div style="flex-shrink: 0; width: 160px; height: 120px; margin-right: 25px; 
                                border: 3px solid #d4bc88; border-radius: 10px; 
                                overflow: hidden; display: flex; align-items: center; justify-content: center;
                                background: #f9f9f9;">
                        <img src="${imageUrl}" 
                             style="width: 100%; height: 100%; object-fit: cover;" 
                             alt="${activity.name}"
                             onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'display:flex; align-items:center; justify-content:center; width:100%; height:100%; background:#f9f9f9; color:#888;\'><i class=\'fa fa-calendar\' style=\'font-size:2rem;\'></i></div>';">
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
                            <strong>地点：</strong>${locationName}
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

function renderWorkDetail(work) {
    const imageUrl = work.full_url || work.url;
    
    return `
        <div class="detail-container">
            <div class="detail-header">
                <h1 class="detail-title">${work.name}</h1>
                <div class="detail-meta">
                    <div class="detail-meta-item">
                        <i class="fa fa-user"></i>
                        <span><strong>作者：</strong>${work.author || '未知'}</span>
                    </div>
                    <div class="detail-meta-item">
                        <i class="fa fa-tag"></i>
                        <span><strong>类型：</strong>${work.type || '未分类'}</span>
                    </div>
                    <div class="detail-meta-item">
                        <i class="fa fa-calendar"></i>
                        <span><strong>创作时间：</strong>${work.create_date || '未知'}</span>
                    </div>
                </div>
            </div>
            
            ${imageUrl ? `
            <div style="text-align: center; margin: 30px 0;">
                <img src="${imageUrl}" alt="${work.name}" class="detail-image" 
                     onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'padding:40px; text-align:center; color:#888; font-size:1.2rem;\'>暂无图片</div>';">
            </div>
            ` : ''}
            
            ${work.description ? `
            <div class="detail-section">
                <h3>作品简介</h3>
                <p>${work.description}</p>
            </div>
            ` : ''}
            
            ${work.content ? `
            <div class="detail-section">
                <h3>详细内容</h3>
                <p>${work.content}</p>
            </div>
            ` : ''}
            
            ${work.keywords ? `
            <div class="detail-section">
                <h3>关键词</h3>
                <p>${work.keywords}</p>
            </div>
            ` : ''}
            
            ${work.source ? `
            <div class="detail-section">
                <h3>来源</h3>
                <p>${work.source}</p>
            </div>
            ` : ''}
            
            <div class="detail-footer">
                <p>抗战胜利80周年纪念网 网上纪念馆</p>
            </div>
        </div>
    `;
}

function renderActivityDetail(activity) {
    const imageUrl = activity.full_photo_url || activity.photo_url;
    const locationName = activity.location_info ? activity.location_info.name : (activity.location_id ? '地点ID: ' + activity.location_id : '未指定地点');
    const locationType = activity.location_info ? activity.location_info.type : '';
    const locationDesc = activity.location_info ? activity.location_info.description : '';
    
    return `
        <div class="detail-container">
            <div class="detail-header">
                <h1 class="detail-title">${activity.name}</h1>
                <div class="detail-meta">
                    <div class="detail-meta-item">
                        <i class="fa fa-calendar"></i>
                        <span><strong>活动时间：</strong>${activity.activity_date || '未知'}</span>
                    </div>
                    <div class="detail-meta-item">
                        <i class="fa fa-map-marker"></i>
                        <span><strong>地点：</strong>${locationName}</span>
                    </div>
                    <div class="detail-meta-item">
                        <i class="fa fa-users"></i>
                        <span><strong>主办方：</strong>${activity.organizer || '未知'}</span>
                    </div>
                </div>
            </div>
            
            ${imageUrl ? `
            <div style="text-align: center; margin: 30px 0;">
                <img src="${imageUrl}" alt="${activity.name}" class="detail-image" 
                     onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'padding:40px; text-align:center; color:#888; font-size:1.2rem;\'>暂无图片</div>';">
            </div>
            ` : ''}
            
            ${activity.description ? `
            <div class="detail-section">
                <h3>活动简介</h3>
                <p>${activity.description}</p>
            </div>
            ` : ''}
            
            ${activity.content ? `
            <div class="detail-section">
                <h3>活动详情</h3>
                <p>${activity.content}</p>
            </div>
            ` : ''}
            
            ${activity.address ? `
            <div class="detail-section">
                <h3>详细地址</h3>
                <p>${activity.address}</p>
            </div>
            ` : ''}
            
            ${activity.participants ? `
            <div class="detail-section">
                <h3>参与人员</h3>
                <p>${activity.participants}</p>
            </div>
            ` : ''}
            
            ${activity.status ? `
            <div class="detail-section">
                <h3>活动状态</h3>
                <p>${activity.status}</p>
            </div>
            ` : ''}
            
            <div class="detail-footer">
                <p>抗战胜利80周年纪念网 网上纪念馆</p>
            </div>
        </div>
    `;
}