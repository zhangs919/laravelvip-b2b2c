<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css"/>
    <title>地图显示</title>
    <style>
        html,
        body,
        #container {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div id="container"></div>
{{--<div class="input-card" style="width:16rem">
    <h4>创建、销毁地图</h4>
    <div id="btns">
        <div class="input-item">
            <button id="create-btn" class="btn" style="margin-right:1rem;">创建地图</button>
            <button id="destroy-btn" class="btn">销毁地图</button>
        </div>
    </div>
</div>--}}

<!-- 加载地图JSAPI脚本 -->
{{--<script src="https://webapi.amap.com/maps?v=1.4.15&key=895b322343baec17c8289ae02c113e6f"></script>--}}
<script src="https://webapi.amap.com/maps?v=1.4.15&key=895b322343baec17c8289ae02c113e6f&plugin=AMap.PlaceSearch,AMap.AdvancedInfoWindow"></script>
<script src="https://a.amap.com/jsapi_demos/static/demo-center/js/demoutils.js"></script>
<script>
    var map = new AMap.Map('container', {
        resizeEnable: true, //是否监控地图容器尺寸变化
        zoom:10, //初始化地图层级
        center: [102.827951,24.88405], //初始化地图中心点

        layers: [
            // 卫星
            // new AMap.TileLayer.Satellite(),
            // 路网
            // new AMap.TileLayer.RoadNet()
        ],
        isHotspot: true,
        // 自定义地图样式
        // mapStyle:'amap://styles/0e3702a929657377984ddbf136a4f03e'
        //前往创建自定义地图样式：https://lbs.amap.com/dev/mapstyle/index

        pitch:50,
        viewMode:'3D',
    });

    //地图加载完成
    map.on("complete", function(){
        log.success("地图加载完成！");
    });

    //获取并展示当前城市信息
    function logMapinfo(){
        map.getCity( function(info){
            log.info(info.district )
            // var node = new PrettyJSON.view.Node({
            //     el: document.querySelector("#map-city"),
            //     data: info
            // });
        });
    }

    logMapinfo();

    //绑定地图移动事件
    map.on('moveend', logMapinfo);

    map.on('click', function(e) {
        // var lnglat = e.lnglat.getLng() + ',' + e.lnglat.getLat()
        log.info(e.lnglat.getLng())
        map.setCenter([e.lnglat.getLng(), e.lnglat.getLat()])
    });

    /*var placeSearch = new AMap.PlaceSearch(); // 构造地点查询类
    var infoWindow = new AMap.AdvancedInfoWindow({});
    map.on('hotspotover',function (result) {
        placeSearch.getDetails(result.id,function (status,result) {
            if (status === 'complete'&& result.info==='OK'){
                placeSearch_CallBack(result)
            }
        })
    })
    //回调函数
    function placeSearch_CallBack(data) { //infoWindow.open(map, result.lnglat);
        var poiArr = data.poiList.pois;
        var location = poiArr[0].location;
        infoWindow.setContent(createContent(poiArr[0]));
        infoWindow.open(map,location);
    }
    function createContent(poi) {  //信息窗体内容
        var s = [];
        s.push('<div class="info-title">'+poi.name+'</div><div class="info-content">'+"地址：" + poi.address);
        s.push("电话：" + poi.tel);
        s.push("类型：" + poi.type);
        s.push('<div>');
        return s.join("<br>");
    }*/

    // 创建、销毁地图
    /*var map = null;
    function createMap() {
        map = new AMap.Map('container', {
            resizeEnable: true
        });
        log.success('创建地图成功');
    }
    function destroyMap() {
        map && map.destroy();
        log.info("地图已销毁");
    }
    // 初始化地图
    createMap();
    // 绑定创建、销毁事件
    document.querySelector("#create-btn").onclick = createMap;
    document.querySelector("#destroy-btn").onclick = destroyMap;*/


</script>


<script>
    // function onApiLoaded(){
    //     var map = new AMap.Map('container', {
    //         center: [117.000923, 36.675807],
    //         zoom: 6
    //     });
    //     map.plugin(["AMap.ToolBar"], function() {
    //         map.addControl(new AMap.ToolBar());
    //     });
    // }
    // var url = 'https://webapi.amap.com/maps?v=1.4.15&key=895b322343baec17c8289ae02c113e6f&callback=onApiLoaded';
    // var jsapi = document.createElement('script');
    // jsapi.charset = 'utf-8';
    // jsapi.src = url;
    // document.head.appendChild(jsapi);
</script>
</body>
</html>