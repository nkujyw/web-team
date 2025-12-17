
/* ================= 初始化 ================= */
const chart = echarts.init(document.getElementById('chinaMap'));

/* ================= 加载中国地图 ================= */
fetch('js/china.json')
  .then(res => res.json())
  .then(chinaJson => {

    echarts.registerMap('china', chinaJson);

    /* ================= 抗战时期区域数据 ================= */
    const mapData = [
    // 伪满洲国
    {name:'黑龙江省', value:4},
    {name:'吉林省', value:4},
    {name:'辽宁省', value:4},

    // 已被占领
    {name:'河北省', value:3},
    {name:'山东省', value:3},
    {name:'江苏省', value:3},
    {name:'浙江省', value:3},
    {name:'广东省', value:3},
    {name:'河南省', value:3},
    {name:'湖北省', value:3},
    {name:'湖南省', value:3},
    {name:'广西壮族自治区', value:3},
    {name:'安徽省', value:3},
    {name:'江西省', value:3},
    {name:'内蒙古自治区', value:3},
    {name:'台湾省', value:3},
    {name:'海南省', value:3},
    {name:'上海市', value:3},
    {name:'北京市', value:3},
    {name:'天津市', value:3},

    // 遭侵略但未完全占领
    {name:'四川省', value:2},
    {name:'贵州省', value:2},
    {name:'云南省', value:2},
    {name:'陕西省', value:2},
    {name:'山西省', value:2},
    {name:'甘肃省', value:2},
    {name:'重庆市', value:2},
    {name:'宁夏回族自治区', value:2},
    {name:'福建省', value:2},
    // 未波及
    {name:'新疆维吾尔自治区', value:1},
    {name:'青海省', value:1},
    {name:'西藏自治区', value:1}
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
        roam:false,            // ⭐ 拖动 & 缩放
        zoom:1.1,

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
            areaColor:'rgba(249, 241, 23, 1)'
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
