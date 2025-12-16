
/* ================= 初始化 ================= */
const chart = echarts.init(document.getElementById('chinaMap'));

/* ================= 加载中国地图 ================= */
fetch('js/china_v2.json')
  .then(res => res.json())
  .then(chinaJson => {

    echarts.registerMap('china', chinaJson);

    /* ================= 抗战时期区域数据 ================= */
    const mapData = [
      // 伪满洲国
      {name:'黑龙江', value:4},
      {name:'吉林', value:4},
      {name:'辽宁', value:4},

      // 已被占领
      {name:'河北', value:3},
      {name:'山东', value:3},
      {name:'江苏', value:3},
      {name:'浙江', value:3},
      {name:'广东', value:3},
      {name:'河南', value:3},
      {name:'湖北', value:3},
      {name:'湖南', value:3},
      {name:'广西', value:3},
      {name:'福建', value:3},
      {name:'安徽', value:3},
      {name:'江西', value:3},

      // 遭侵略但未完全占领
      {name:'四川', value:2},
      {name:'贵州', value:2},
      {name:'云南', value:2},
      {name:'陕西', value:2},
      {name:'山西', value:2},
      {name:'甘肃', value:2},

      // 未波及
      {name:'新疆', value:1},
      {name:'青海', value:1},
      {name:'西藏', value:1},
      {name:'宁夏', value:1}
    ];

    /* ================= 地图配置 ================= */
    chart.setOption({
      backgroundColor:'transparent',

      tooltip:{
        trigger:'item',
        formatter: params => {
          if(!params.value) return params.name;
          const statusMap = {
            1:'未被侵略波及',
            2:'曾遭受侵略但未完全占领',
            3:'已被日本占领',
            4:'伪满洲国 / 满洲国占领区'
          };
          return `${params.name}<br/>${statusMap[params.value]}`;
        }
      },

      visualMap:{
        show:false,
        min:1,
        max:4,
        inRange:{
          color:[
            '#F8EFEA',
            '#F5A9A9',
            '#C0392B',
            '#8B1A1A'
          ]
        }
      },

      series:[{
        type:'map',
        map:'china',
        data:mapData,
        roam:true,            // ⭐ 拖动 & 缩放
        zoom:1.15,
        label:{
          show:true,
          color:'#333',
          fontSize:12
        },
        itemStyle:{
          borderColor:'#c9a44c',
          borderWidth:1
        },
        emphasis:{
          label:{
            color:'#000',
            fontWeight:'bold'
          },
          itemStyle:{
            areaColor:'#a33'
          }
        }
      }]
    });

    /* ================= 点击事件（可扩展） ================= */
    chart.on('click', params => {
      console.log('点击省份：', params.name);
      // 👉 这里以后可以：
      // window.location = `province.php?name=${params.name}`;
      // 或 Ajax 拉取该省战役 / 人物 / 部队
    });
  });
