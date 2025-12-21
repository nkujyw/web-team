<?php
use yii\helpers\Url;

$this->title = '事件时间轴地图';

/* 引入 ECharts */
$this->registerJsFile('https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js');

/* 接口地址（基础URL，不要自己拼 &year= ） */
$yearDataBase = Url::to(['event/year-data']);   // 返回 { points:[], provinces:[] }
$yearListBase = Url::to(['event/year-list']);   // 返回 { items:[] }
$chinaJsonUrl  = Url::to('@web/js/china_v2.json');

$this->registerJs(<<<JS
window.MAP_CFG = {
  yearDataBase: "{$yearDataBase}",
  yearListBase: "{$yearListBase}",
  chinaJsonUrl: "{$chinaJsonUrl}",
  currentYear: 1937
};
JS
, \yii\web\View::POS_HEAD);
?>

<style>
  body{
    background:
      radial-gradient(1200px 700px at 15% 10%, rgba(180,0,0,0.18), transparent 55%),
      radial-gradient(900px 520px at 85% 15%, rgba(255,210,120,0.10), transparent 55%),
      radial-gradient(900px 650px at 55% 90%, rgba(120,170,255,0.10), transparent 55%),
      linear-gradient(180deg, #070A12 0%, #0B1020 50%, #060812 100%);
    color:#eaeef7;
  }

  .map-page{
    max-width: 1600px;
    margin: 20px auto 60px;
    padding: 0 18px;
  }

  .hero{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:16px;
    margin-bottom: 14px;
  }
  .hero h2{
    margin:0;
    font-size: 34px;
    font-weight: 900;
    letter-spacing: 1px;
    line-height: 1.15;
  }
  .hero .subtitle{
    margin-top:10px;
    color: rgba(234,238,247,0.72);
    font-size: 14px;
  }

  .badge{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:10px 14px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.16);
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.35);
    font-size: 13px;
    color: rgba(234,238,247,0.85);
    white-space: nowrap;
  }
  .badge-dot{
    width:10px;height:10px;border-radius:50%;
    background: #b40000;
    box-shadow: 0 0 18px rgba(180,0,0,0.7);
  }

  .timeline-wrap{
    position: relative;
    margin: 14px 0 14px;
    padding: 14px 14px 8px;
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);
    box-shadow: 0 22px 55px rgba(0,0,0,0.35);
  }
  .timeline-title{
    display:flex;
    align-items:center;
    gap:10px;
    margin: 0 0 10px;
    color: rgba(255,210,120,0.95);
    font-weight: 800;
    letter-spacing: 1px;
    font-size: 14px;
  }
  .timeline-title:before{
    content:"";
    width:10px;height:10px;border-radius:50%;
    background: rgba(255,210,120,0.95);
    box-shadow: 0 0 16px rgba(255,210,120,0.6);
  }

  #yearTimeline{
    display:flex;
    gap:14px;
    flex-wrap:wrap;
    align-items:center;
    padding: 6px 4px 6px;
  }
  .year-node{
    min-width: 112px;
    height: 58px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.16);
    background: rgba(255,255,255,0.06);
    color: rgba(234,238,247,0.86);
    font-size: 20px;
    font-weight: 900;
    cursor:pointer;
    user-select:none;
    transition: transform .18s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease, color .18s ease;
  }
  .year-node:hover{
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.42);
    border-color: rgba(255,210,120,0.55);
  }
  .year-node.is-active{
    background: linear-gradient(135deg, rgba(180,0,0,0.92) 0%, rgba(80,0,0,0.92) 100%);
    border-color: rgba(255,210,120,0.65);
    color: #fff;
    box-shadow: 0 22px 55px rgba(180,0,0,0.22), 0 22px 55px rgba(0,0,0,0.35);
  }

  .map-card{
    position: relative;
    border-radius: 22px;
    border: 1px solid rgba(255,255,255,0.12);
    overflow:hidden;
    box-shadow: 0 28px 70px rgba(0,0,0,0.45);

    --fire1: 0.12;
    --fire2: 0.14;
    --fire3: 0.08;
    --baseA: 0.92;
    --baseB: 0.94;
    --smoke: 0.55;
    --flicker: 0.55;

    background:
      radial-gradient(900px 520px at 25% 20%, rgba(255,120,0,var(--fire1)), transparent 60%),
      radial-gradient(700px 420px at 75% 30%, rgba(180,0,0,var(--fire2)), transparent 60%),
      radial-gradient(900px 620px at 50% 80%, rgba(255,210,120,var(--fire3)), transparent 60%),
      linear-gradient(180deg, rgba(10,14,28,var(--baseA)), rgba(8,10,20,var(--baseB)));
  }

  .map-card:before{
    content:"";
    position:absolute;
    inset:-80px;
    background:
      radial-gradient(520px 320px at 20% 10%, rgba(255,120,0,0.22), transparent 60%),
      radial-gradient(620px 360px at 85% 25%, rgba(255,60,0,0.18), transparent 62%),
      radial-gradient(720px 420px at 55% 85%, rgba(255,210,120,0.10), transparent 65%);
    opacity: var(--flicker);
    filter: blur(6px);
    animation: fireFlicker 3.8s ease-in-out infinite;
    pointer-events:none;
  }

  .map-card:after{
    content:"";
    position:absolute;
    inset:0;
    background:
      radial-gradient(900px 700px at 50% 40%, rgba(255,255,255,0.06), transparent 60%),
      radial-gradient(1200px 900px at 50% 110%, rgba(0,0,0,var(--smoke)), transparent 60%),
      linear-gradient(180deg, rgba(0,0,0,0.22), rgba(0,0,0,var(--smoke)));
    mix-blend-mode: multiply;
    pointer-events:none;
  }

  @keyframes fireFlicker{
    0%   { transform: translate3d(0,0,0) scale(1); }
    35%  { transform: translate3d(-8px,6px,0) scale(1.02); }
    70%  { transform: translate3d(10px,-6px,0) scale(0.99); }
    100% { transform: translate3d(0,0,0) scale(1); }
  }

  .map-card-head{
    position: relative;
    z-index: 2;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding: 14px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.10);
    background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
    backdrop-filter: blur(6px);
  }
  .map-card-head .left{ display:flex; flex-direction:column; gap:4px; }
  .map-card-head .title{ font-weight: 950; letter-spacing: 0.6px; color: rgba(234,238,247,0.92); }
  .map-card-head .hint{ font-size: 12px; color: rgba(234,238,247,0.62); }

#chinaMap{
  position: relative;
  z-index: 1;

  width: 100%;              /* 吃满卡片宽度 */
  aspect-ratio: 3 / 2;      /* ✅ 宽 : 高 = 3 : 2（等价于高=2/3宽） */

  margin: 0;
}





  .action-row{ text-align:center; margin: 18px 0 6px; }
  #showYearEvents{
    padding: 14px 34px;
    font-size: 16px;
    font-weight: 900;
    letter-spacing: 1px;
    border:none;
    border-radius: 12px;
    cursor:pointer;
    color:#fff;
    background: linear-gradient(135deg, rgba(180,0,0,0.95), rgba(85,0,0,0.95));
    box-shadow: 0 26px 60px rgba(180,0,0,0.20), 0 24px 60px rgba(0,0,0,0.35);
    transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
  }
  #showYearEvents:hover{
    transform: translateY(-2px);
    filter: brightness(1.05);
    box-shadow: 0 30px 70px rgba(180,0,0,0.24), 0 28px 70px rgba(0,0,0,0.40);
  }

  #yearEventList{ display:none; margin-top: 14px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,0.10); }
  .event-list-title{
    margin: 0 0 12px;
    font-size: 22px;
    font-weight: 950;
    letter-spacing: 1px;
    color: rgba(255,210,120,0.92);
  }
  .event-card{
    padding: 14px 14px;
    margin: 12px 0;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05);
    box-shadow: 0 16px 40px rgba(0,0,0,0.35);
  }
  .event-card .name{ font-weight: 950; font-size: 16px; color: rgba(234,238,247,0.92); margin-bottom: 6px; }
  .event-card .meta{ font-size: 12px; color: rgba(234,238,247,0.62); margin-bottom: 8px; }
  .event-card .desc{ color: rgba(234,238,247,0.78); line-height: 1.8; font-size: 14px; }
  .event-card .sig{
    margin-top:10px;
    padding:10px 12px;
    border-radius: 12px;
    border: 1px solid rgba(255,210,120,0.22);
    background: rgba(255,210,120,0.08);
    color: rgba(234,238,247,0.86);
    line-height: 1.75;
    font-size: 13px;
  }

  #eventModalMask{
    backdrop-filter: blur(10px);
  }
  .modal-shell{
    width: 88%;
    max-width: 980px;
    max-height: 84%;
    border-radius: 18px;
    overflow:hidden;
    border: 1px solid rgba(255,255,255,0.16);
    background: rgba(12,16,32,0.74);
    backdrop-filter: blur(14px);
    box-shadow: 0 50px 130px rgba(0,0,0,0.78);
    display:flex;
    flex-direction:column;
  }
  .modal-head{
    padding: 14px 18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom: 1px solid rgba(255,255,255,0.10);
    background: linear-gradient(135deg, rgba(180,0,0,0.42), rgba(255,210,120,0.10));
  }
  .modal-title{
    font-size: 20px;
    font-weight: 980;
    letter-spacing: 0.8px;
    color:#fff;
    text-shadow: 0 6px 18px rgba(0,0,0,0.35);
  }
  #closeEventModal{
    width: 42px; height: 42px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(255,255,255,0.06);
    color:#fff;
    font-size: 22px;
    cursor:pointer;
    transition: transform .15s ease, background .15s ease;
  }
  #closeEventModal:hover{ transform: translateY(-1px); background: rgba(255,255,255,0.10); }
  .modal-body{ padding: 18px; overflow:auto; color: rgba(234,238,247,0.88); line-height: 1.9; font-size: 14px; }
  .modal-body hr{ border: none; border-top: 1px solid rgba(255,255,255,0.12); margin: 14px 0; }

  /* ✅ 弹窗 Meta（朴素两行：无图标、无框） */
  .modal-meta{
    margin-bottom: 10px;
  }
  .modal-meta .meta-row{
    display:flex;
    gap:10px;
    padding: 2px 0;
    line-height: 1.65;
  }
  .modal-meta .k{
    min-width: 52px;
    color: rgba(234,238,247,0.70);
    font-weight: 800;
    letter-spacing: .4px;
  }
  .modal-meta .v{
    color: rgba(234,238,247,0.95);
    font-weight: 800;
  }

  .sig-box{
    margin-top: 12px;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,210,120,0.22);
    background:
      radial-gradient(420px 220px at 20% 20%, rgba(255,210,120,0.10), transparent 60%),
      linear-gradient(135deg, rgba(255,210,120,0.08), rgba(180,0,0,0.06));
    box-shadow: 0 18px 50px rgba(0,0,0,0.30);
  }
  .sig-title{
    display:flex; align-items:center; gap:10px;
    font-weight: 950;
    color: rgba(255,210,120,0.95);
    letter-spacing: .8px;
    margin-bottom: 6px;
  }
  .sig-title:before{
    content:"";
    width:10px;height:10px;border-radius:50%;
    background: rgba(255,210,120,0.95);
    box-shadow: 0 0 16px rgba(255,210,120,0.55);
  }
  .sig-text{ color: rgba(234,238,247,0.88); line-height: 1.85; }

  @media (max-width: 768px){
    .hero h2{ font-size: 26px; }
    .year-node{ min-width: 92px; height: 52px; font-size: 18px; }
    #chinaMap{ min-height: 680px; height: calc(100vh - 220px); }
    .modal-meta .meta-row{ flex-direction:column; gap:2px; }
    .modal-meta .k{ min-width: auto; }
  }
</style>

<div class="map-page">
  <div class="hero">
    <div>
      <h2>抗战时期重大事件时间轴</h2>
      
    </div>
    <div class="badge">
      <span class="badge-dot"></span>
      <span>交互：滚轮缩放 / 拖拽平移；点击红点看事件详情</span>
    </div>
  </div>

  <div class="timeline-wrap">
    <div class="timeline-title">时间轴 · 年份节点</div>
    <div id="yearTimeline">
      <?php for ($y = 1937; $y <= 1945; $y++): ?>
        <div class="year-node" data-year="<?= $y ?>"><?= $y ?></div>
      <?php endfor; ?>
    </div>
  </div>

  <div class="map-card" id="battleCard">
    <div class="map-card-head">
      <div class="left">
        <div class="title">事件地图</div>
        <div class="hint">热点省份默认亮起浮起；非热点省份保持暗色</div>
      </div>
      <div class="badge" style="box-shadow:none;">
        <span class="badge-dot" style="background:rgba(255,210,120,0.95); box-shadow:0 0 18px rgba(255,210,120,0.45)"></span>
        <span id="yearNow">当前年份：1937</span>
      </div>
    </div>
    <div id="chinaMap"></div>
  </div>

  <div class="action-row">
    <button id="showYearEvents">展示全年事件</button>
  </div>

  <div id="yearEventList"></div>
</div>

<div id="eventModalMask" style="
  display:none;
  position:fixed;
  left:0;top:0;right:0;bottom:0;
  background:rgba(0,0,0,0.42);
  z-index:9999;
  align-items:center;
  justify-content:center;
">
  <div class="modal-shell">
    <div class="modal-head">
      <div id="eventModalTitle" class="modal-title"></div>
      <button id="closeEventModal">×</button>
    </div>
    <div id="eventModalBody" class="modal-body"></div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function () {
  const el = document.getElementById('chinaMap');
  if (!el) return;

  const chart = echarts.init(el);
  const battleCard = document.getElementById('battleCard');

  const PROV_ALIAS = {
    '北京':'北京市','天津':'天津市','上海':'上海市','重庆':'重庆市',
    '河北':'河北省','山西':'山西省','辽宁':'辽宁省','吉林':'吉林省','黑龙江':'黑龙江省',
    '江苏':'江苏省','浙江':'浙江省','安徽':'安徽省','福建':'福建省','江西':'江西省','山东':'山东省',
    '河南':'河南省','湖北':'湖北省','湖南':'湖南省','广东':'广东省','海南':'海南省',
    '四川':'四川省','贵州':'贵州省','云南':'云南省','陕西':'陕西省','甘肃':'甘肃省','青海':'青海省',
    '台湾':'台湾省',
    '内蒙古':'内蒙古自治区','广西':'广西壮族自治区','西藏':'西藏自治区',
    '宁夏':'宁夏回族自治区','新疆':'新疆维吾尔自治区',
    '香港':'香港特别行政区','澳门':'澳门特别行政区'
  };
  const PROV_FULL = new Set(Object.values(PROV_ALIAS));
  function normalizeProvinceName(raw){
    if (!raw) return null;
    const s = String(raw).trim();
    if (PROV_FULL.has(s)) return s;
    if (PROV_ALIAS[s]) return PROV_ALIAS[s];
    for (const full of PROV_FULL) if (s.includes(full)) return full;
    for (const k in PROV_ALIAS) if (s.includes(k)) return PROV_ALIAS[k];
    return null;
  }
  function unique(arr){ return Array.from(new Set((arr||[]).filter(Boolean))); }

  function deriveProvincesFromPoints(points){
    const out = [];
    (points || []).forEach(p => {
      const ev = p.event || {};
      out.push(normalizeProvinceName(ev.province));
      out.push(normalizeProvinceName(ev.location));
      out.push(normalizeProvinceName(ev.city));
    });
    return unique(out);
  }

  function buildUrl(base, params){
    const u = new URL(base, window.location.origin);
    Object.entries(params || {}).forEach(([k,v]) => u.searchParams.set(k, v));
    return u.pathname + (u.search ? u.search : '');
  }

  async function fetchJson(url){
    const r = await fetch(url, { credentials: 'same-origin' });
    if (!r.ok) throw new Error(`HTTP ${r.status} ${r.statusText} (${url})`);
    return await r.json();
  }

  function applyYearMood(year){
    const t = Math.min(1, Math.max(0, (Number(year) - 1937) / 8));
    battleCard.style.setProperty('--fire1', (0.10 + 0.22 * t).toFixed(3));
    battleCard.style.setProperty('--fire2', (0.12 + 0.28 * t).toFixed(3));
    battleCard.style.setProperty('--fire3', (0.07 + 0.18 * t).toFixed(3));
    battleCard.style.setProperty('--baseA', (0.92 - 0.12 * t).toFixed(3));
    battleCard.style.setProperty('--baseB', (0.94 - 0.14 * t).toFixed(3));
    battleCard.style.setProperty('--smoke', (0.58 - 0.28 * t).toFixed(3));
    battleCard.style.setProperty('--flicker', (0.50 + 0.25 * t).toFixed(3));
  }

  const fillDark = new echarts.graphic.LinearGradient(0, 0, 0, 1, [
    { offset: 0, color: 'rgba(120,140,180,0.07)' },
    { offset: 1, color: 'rgba(20,30,55,0.16)' }
  ]);

  const fillHot = new echarts.graphic.LinearGradient(0, 0, 1, 1, [
    { offset: 0, color: 'rgba(255,200,100,0.30)' },
    { offset: 0.55, color: 'rgba(180,0,0,0.40)' },
    { offset: 1, color: 'rgba(255,240,180,0.12)' }
  ]);

  const fillSelected = new echarts.graphic.LinearGradient(0, 0, 1, 1, [
    { offset: 0, color: 'rgba(255,235,160,0.40)' },
    { offset: 0.55, color: 'rgba(255,70,70,0.46)' },
    { offset: 1, color: 'rgba(255,255,255,0.10)' }
  ]);

  const fillHover = new echarts.graphic.LinearGradient(0, 0, 1, 1, [
    { offset: 0, color: 'rgba(255,210,120,0.10)' },
    { offset: 1, color: 'rgba(255,60,0,0.08)' }
  ]);

  try{
    const chinaJson = await fetchJson(window.MAP_CFG.chinaJsonUrl);
    echarts.registerMap('china', chinaJson);
  }catch(e){
    console.error('地图JSON加载失败：', e);
    el.innerHTML = `
      <div style="padding:24px;color:rgba(234,238,247,0.85);font-weight:800;">
        地图数据加载失败（china_v2.json）
        <div style="margin-top:10px;opacity:.75;font-weight:600;">
          请确认：<br>
          1) ${window.MAP_CFG.chinaJsonUrl} 能在浏览器直接打开并返回 JSON<br>
          2) 服务器没有把它当成 404/HTML
        </div>
      </div>`;
    return;
  }

  let hotProvinces = [];
  let selectedProvince = null;

  function setActiveYearNode(year){
    document.querySelectorAll('.year-node').forEach(n => {
      n.classList.toggle('is-active', n.dataset.year == year);
    });
    document.getElementById('yearNow').innerText = `当前年份：${year}`;
  }

  function buildRegions(){
    const regions = [];

    (hotProvinces || []).forEach(name => {
      regions.push({
        name,
        itemStyle: {
          areaColor: fillHot,
          borderColor: 'rgba(255,210,120,0.92)',
          borderWidth: 2,
          shadowColor: 'rgba(0,0,0,0.82)',
          shadowBlur: 40,
          shadowOffsetY: -14
        },
        label: { color:'#fff', fontWeight:'bold' }
      });
    });

    if (selectedProvince) {
      regions.push({
        name: selectedProvince,
        itemStyle: {
          areaColor: fillSelected,
          borderColor: 'rgba(255,255,255,0.96)',
          borderWidth: 2.5,
          shadowColor: 'rgba(0,0,0,0.88)',
          shadowBlur: 55,
          shadowOffsetY: -20
        },
        label: { color:'#fff', fontWeight:'bold' }
      });
    }

    return regions;
  }

  chart.setOption({
    backgroundColor: 'transparent',
    tooltip: {
      trigger: 'item',
      formatter: (p) => {
        if (p.componentType === 'geo') return `<strong>${p.name}</strong>`;

        if (p.seriesType === 'effectScatter' && p.data?.event) {
          const ev = p.data.event;
          const sig = ev.significance ? `<div style="opacity:.88;margin-top:6px;line-height:1.6;"><strong>意义：</strong>${ev.significance}</div>` : '';
          return `<div style="font-weight:900;font-size:13px;margin-bottom:4px;">${ev.name || ''}</div>
                  <div style="opacity:.85">${ev.start_date || ''} ~ ${ev.end_date || ''}</div>
                  <div style="opacity:.75;margin-top:4px;">${ev.location || ''}</div>
                  ${sig}`;
        }
        return '';
      }
    },
    geo: {
      map: 'china',
      show: true,
      roam: true,
      zoom: 1.42,
      layoutCenter: ['50%','54%'],
      layoutSize: '175%',
      scaleLimit: { min: 1.0, max: 6.0 },

      label: { show: true, color: 'rgba(234,238,247,0.42)', fontSize: 11 },
      itemStyle: {
        areaColor: fillDark,
        borderColor: 'rgba(255,255,255,0.14)',
        borderWidth: 1,
        shadowColor: 'rgba(0,0,0,0.70)',
        shadowBlur: 18,
        shadowOffsetY: 12
      },
      emphasis: {
        label: { color: 'rgba(234,238,247,0.78)', fontWeight: 'bold' },
        itemStyle: {
          areaColor: fillHover,
          borderColor: 'rgba(255,210,120,0.60)',
          borderWidth: 2,
          shadowColor: 'rgba(0,0,0,0.80)',
          shadowBlur: 28,
          shadowOffsetY: -8
        }
      },
      regions: []
    },
    series: [
      {
        name: '事件点',
        type: 'effectScatter',
        coordinateSystem: 'geo',
        data: [],
        symbolSize: 14,
        rippleEffect: { scale: 3.6, brushType: 'stroke' },
        itemStyle: {
          color: '#ff2d2d',
          shadowBlur: 18,
          shadowColor: 'rgba(255,45,45,0.55)'
        },
        zlevel: 3
      }
    ]
  });

  async function loadYear(year){
    window.MAP_CFG.currentYear = year;
    setActiveYearNode(year);
    applyYearMood(year);

    selectedProvince = null;

    const list = document.getElementById('yearEventList');
    list.style.display = 'none';
    list.innerHTML = '';

    try{
      const url = buildUrl(window.MAP_CFG.yearDataBase, { year });
      const data = await fetchJson(url);

      const points = data.points || [];
      const provincesFromApi = unique((data.provinces || []).map(normalizeProvinceName));
      const provincesFromPoints = deriveProvincesFromPoints(points);
      hotProvinces = provincesFromApi.length ? provincesFromApi : provincesFromPoints;

      chart.setOption({
        geo: { regions: buildRegions() },
        series: [
          { data: points.map(p => ({ value:[p.lng, p.lat], event:p.event })) }
        ]
      });

    }catch(e){
      console.error('年份数据加载失败：', e);
      hotProvinces = [];
      chart.setOption({
        geo: { regions: buildRegions() },
        series: [{ data: [] }]
      });
    }
  }

  loadYear(1937);

  document.getElementById('yearTimeline').onclick = (e) => {
    const node = e.target.closest('.year-node');
    if (node) loadYear(node.dataset.year);
  };

  chart.on('click', (params) => {
    if (params.seriesType === 'effectScatter') return;

    if (params.componentType === 'geo' && params.name) {
      const name = normalizeProvinceName(params.name) || params.name;

      if (selectedProvince === name) selectedProvince = null;
      else selectedProvince = name;

      chart.setOption({ geo: { regions: buildRegions() } });
    }
  });

  document.getElementById('showYearEvents').onclick = async () => {
    const box = document.getElementById('yearEventList');
    const year = window.MAP_CFG.currentYear;

    try{
      const url = buildUrl(window.MAP_CFG.yearListBase, { year });
      const res = await fetchJson(url);

      box.innerHTML =
        `<div class="event-list-title">${year} 年事件一览</div>` +
        (res.items || []).map(ev => `
          <div class="event-card">
            <div class="name">${ev.name || ''}</div>
            <div class="meta">${(ev.start_date||'')} ~ ${(ev.end_date||'')} ｜ ${(ev.location||'')}</div>
            <div class="desc">${ev.description || ''}</div>
            ${ev.significance ? `<div class="sig"><strong>意义：</strong>${ev.significance}</div>` : ``}
          </div>
        `).join('');

      box.style.display = 'block';
      box.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }catch(e){
      console.error('全年事件列表加载失败：', e);
      box.innerHTML = `<div class="event-list-title">${year} 年事件一览</div><div style="opacity:.75;">加载失败，请检查接口返回是否为 JSON。</div>`;
      box.style.display = 'block';
    }
  };

  const mask = document.getElementById('eventModalMask');
  document.getElementById('closeEventModal').onclick = () => mask.style.display = 'none';
  mask.onclick = e => { if (e.target === mask) mask.style.display = 'none'; };

  function escapeHtml(str){
    if (str === null || str === undefined) return '';
    return String(str)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // ✅ 红点弹窗（朴素两行时间/地点）
  chart.on('click', (params) => {
    if (params.seriesType === 'effectScatter' && params.data?.event) {
      const ev = params.data.event || {};
      const title = ev.name || '';
      const timeText = `${ev.start_date || ''} ~ ${ev.end_date || ''}`.trim();
      const locText  = (ev.location || ev.city || ev.province || '').trim();
      const desc     = ev.description || '';
      const sig      = ev.significance || '';

      document.getElementById('eventModalTitle').innerText = title;

      document.getElementById('eventModalBody').innerHTML = `
        <div class="modal-meta">
          <div class="meta-row">
            <div class="k">时间：</div>
            <div class="v">${escapeHtml(timeText || '—')}</div>
          </div>
          <div class="meta-row">
            <div class="k">地点：</div>
            <div class="v">${escapeHtml(locText || '—')}</div>
          </div>
        </div>

        <hr>

        <div style="opacity:.92;">${escapeHtml(desc).replace(/\n/g,'<br>')}</div>

        ${sig ? `
          <div class="sig-box">
            <div class="sig-title">事件意义</div>
            <div class="sig-text">${escapeHtml(sig).replace(/\n/g,'<br>')}</div>
          </div>
        ` : ``}
      `;

      mask.style.display = 'flex';
    }
  });

  window.addEventListener('resize', () => chart.resize());
});
</script>
