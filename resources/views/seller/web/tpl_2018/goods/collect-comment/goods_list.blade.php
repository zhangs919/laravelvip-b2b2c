{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="SearchModel" name="SearchModel" action="/goods/collect-comment/goods-list.html" method="POST">
            <input type="hidden" name="_csrf" value="Tz2CYKmQBof7YFCD-ySz4kFpvBmq29vE_sHASxzgQ6E7WsEK68A1v7o4I-zJc9rTEyTuVOiqkI3TlZUncpgyxA==">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-keyword" class="form-control" name="keyword" placeholder="商品ID/货号/名称">

                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>分类：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-cat_id" class="form-control chosen-select" name="cat_id" data-width="200">
                            <option value="0"></option>
                            <option value="271"><span>◢</span>&nbsp;生鲜食品</option>
                            <option value="306">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;新鲜水果</option>
                            <option value="328">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时令水果</option>
                            <option value="330">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;苹果</option>
                            <option value="332">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;奇异果</option>
                            <option value="333">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大樱桃</option>
                            <option value="334">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;芒果</option>
                            <option value="336">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;梨</option>
                            <option value="337">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;桔</option>
                            <option value="338">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;柠檬</option>
                            <option value="307">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;海鲜水产</option>
                            <option value="340">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;虾</option>
                            <option value="342">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蟹</option>
                            <option value="343">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;贝</option>
                            <option value="344">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;海参</option>
                            <option value="345">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;海产干货</option>
                            <option value="346">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;海产礼盒</option>
                            <option value="347">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;小龙虾</option>
                            <option value="348">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;三文鱼</option>
                            <option value="350">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鳕鱼</option>
                            <option value="351">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扇贝</option>
                            <option value="308">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;猪牛羊肉</option>
                            <option value="352">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛肉</option>
                            <option value="353">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;羊肉</option>
                            <option value="354">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;猪肉</option>
                            <option value="355">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛排</option>
                            <option value="356">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛腩</option>
                            <option value="357">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛腱</option>
                            <option value="358">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛肉卷</option>
                            <option value="359">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;羊肉卷</option>
                            <option value="360">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;猪肘</option>
                            <option value="309">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;新鲜蔬菜</option>
                            <option value="361">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;叶菜类</option>
                            <option value="362">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;茄果瓜类</option>
                            <option value="364">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鲜菌菇</option>
                            <option value="365">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;葱姜蒜椒</option>
                            <option value="366">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;半加工蔬菜</option>
                            <option value="310">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;速冻食品</option>
                            <option value="367">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;水饺</option>
                            <option value="368">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;汤圆</option>
                            <option value="369">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;面点</option>
                            <option value="370">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;火锅丸串</option>
                            <option value="371">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;方便菜</option>
                            <option value="372">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;奶酪</option>
                            <option value="373">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;黄油</option>
                            <option value="311">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;饮品甜品</option>
                            <option value="374">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;酸奶</option>
                            <option value="375">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鲜奶</option>
                            <option value="376">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冷冻蛋糕</option>
                            <option value="377">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冰激凌</option>
                            <option value="269"><span>◢</span>&nbsp;食品饮料</option>
                            <option value="278">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;进口食品</option>
                            <option value="283">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进口牛奶</option>
                            <option value="284">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;巧克力</option>
                            <option value="279">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;休闲食品</option>
                            <option value="287">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;肉干肉脯</option>
                            <option value="286">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;坚果炒货</option>
                            <option value="288">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;饼干蛋糕</option>
                            <option value="289">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;糖果/巧克力</option>
                            <option value="280">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;茗茶</option>
                            <option value="290">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;铁观音</option>
                            <option value="291">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;红茶</option>
                            <option value="292">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;绿茶</option>
                            <option value="293">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;乌龙茶</option>
                            <option value="281">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;饮料冲调</option>
                            <option value="294">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛奶乳品</option>
                            <option value="295">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;饮料</option>
                            <option value="296">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冲饮谷物</option>
                            <option value="282">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;粮油调味</option>
                            <option value="297">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;米面杂粮</option>
                            <option value="298">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;食用油</option>
                            <option value="299">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;调味品</option>
                            <option value="300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;方便食品</option>
                            <option value="1"><span>◢</span>&nbsp;家用电器</option>
                            <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;大家电</option>
                            <option value="17">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;平板电视</option>
                            <option value="18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;空调</option>
                            <option value="19">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冰箱</option>
                            <option value="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;洗衣机</option>
                            <option value="24">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家庭影院</option>
                            <option value="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DVD</option>
                            <option value="542">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;迷你音箱</option>
                            <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;厨卫大电</option>
                            <option value="28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;油烟机</option>
                            <option value="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;煤气灶</option>
                            <option value="31">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;烟灶套装</option>
                            <option value="32">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;消毒柜</option>
                            <option value="33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;洗碗机</option>
                            <option value="34">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电热水器</option>
                            <option value="36">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;燃气热水器</option>
                            <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;厨房小电</option>
                            <option value="37">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电饭煲</option>
                            <option value="38">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;微波炉</option>
                            <option value="39">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电烤箱</option>
                            <option value="42">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电磁炉</option>
                            <option value="43">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电压力锅</option>
                            <option value="44">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;豆浆机</option>
                            <option value="46">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;咖啡机</option>
                            <option value="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;生活电器</option>
                            <option value="47">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电风扇</option>
                            <option value="48">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冷风扇</option>
                            <option value="49">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;吸尘器</option>
                            <option value="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;净化器</option>
                            <option value="52">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扫地机器人</option>
                            <option value="54">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;加湿器</option>
                            <option value="56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;挂烫机/熨斗</option>
                            <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;个护健康</option>
                            <option value="60">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;剃须刀</option>
                            <option value="61">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;口腔护理</option>
                            <option value="64">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电吹风</option>
                            <option value="65">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;美容器</option>
                            <option value="67">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;直发器</option>
                            <option value="68">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;理发器</option>
                            <option value="69">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;脱毛器</option>
                            <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;五金家装</option>
                            <option value="72">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电动工具</option>
                            <option value="73">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手动工具</option>
                            <option value="75">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;仪器仪表</option>
                            <option value="76">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排气扇</option>
                            <option value="77">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;灯具</option>
                            <option value="78">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LED灯</option>
                            <option value="79">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;洁身器</option>
                            <option value="3"><span>◢</span>&nbsp;电脑办公</option>
                            <option value="154">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;电脑整机</option>
                            <option value="163">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;笔记本</option>
                            <option value="164">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏本</option>
                            <option value="165">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;平板电脑</option>
                            <option value="166">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;平板电脑配件</option>
                            <option value="167">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;台式机</option>
                            <option value="168">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一体机</option>
                            <option value="155">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;电脑配件</option>
                            <option value="170">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CPU</option>
                            <option value="171">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主板</option>
                            <option value="172">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;显卡</option>
                            <option value="173">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;硬盘</option>
                            <option value="175">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSD固态硬盘</option>
                            <option value="176">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;内存</option>
                            <option value="178">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机箱</option>
                            <option value="179">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电源</option>
                            <option value="180">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;显示器</option>
                            <option value="157">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;外设产品</option>
                            <option value="181">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鼠标</option>
                            <option value="183">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;键盘</option>
                            <option value="184">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;键鼠套装</option>
                            <option value="185">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网络仪器仪表</option>
                            <option value="186">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U盘</option>
                            <option value="187">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;移动硬盘</option>
                            <option value="189">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;鼠标垫</option>
                            <option value="191">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USB电源</option>
                            <option value="158">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;游戏设备</option>
                            <option value="192">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏机</option>
                            <option value="193">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏耳机</option>
                            <option value="194">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手柄/方向盘</option>
                            <option value="195">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏软件</option>
                            <option value="196">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;游戏周边</option>
                            <option value="159">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;网络产品</option>
                            <option value="198">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;路由器</option>
                            <option value="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网卡</option>
                            <option value="201">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;交换机</option>
                            <option value="202">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网络存储</option>
                            <option value="203">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4G/3G上网</option>
                            <option value="204">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网络盒子</option>
                            <option value="205">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网络配件</option>
                            <option value="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;办公设备</option>
                            <option value="207">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;摄影机</option>
                            <option value="209">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;摄影配件</option>
                            <option value="210">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;多功能一体机</option>
                            <option value="211">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;打印机</option>
                            <option value="212">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;传真设备</option>
                            <option value="214">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碎纸机</option>
                            <option value="216">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;考勤机</option>
                            <option value="161">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;文具耗材</option>
                            <option value="217">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;墨粉</option>
                            <option value="218">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;墨盒</option>
                            <option value="219">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;色带</option>
                            <option value="220">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;纸篓</option>
                            <option value="221">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;办公文具</option>
                            <option value="223">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学生文具</option>
                            <option value="224">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文件管理</option>
                            <option value="2"><span>◢</span>&nbsp;手机数码</option>
                            <option value="84">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;手机通讯</option>
                            <option value="92">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机</option>
                            <option value="93">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;对讲机</option>
                            <option value="94">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;以旧换新</option>
                            <option value="95">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机维修</option>
                            <option value="85">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;手机配件</option>
                            <option value="96">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机电池</option>
                            <option value="97">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;移动电源</option>
                            <option value="100">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蓝牙耳机</option>
                            <option value="101">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
                            <option value="102">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数据线</option>
                            <option value="103">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机耳机</option>
                            <option value="105">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机存储卡</option>
                            <option value="106">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保护套</option>
                            <option value="87">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;摄影摄像</option>
                            <option value="107">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数码相机</option>
                            <option value="108">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单电/微单相机</option>
                            <option value="110">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单反相机</option>
                            <option value="112">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;拍立得</option>
                            <option value="113">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动相机</option>
                            <option value="114">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冲印服务</option>
                            <option value="116">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数码相框</option>
                            <option value="89">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;数码配件</option>
                            <option value="118">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;存储卡</option>
                            <option value="119">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;读卡器</option>
                            <option value="121">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;支架</option>
                            <option value="122">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;滤镜</option>
                            <option value="125">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;闪光灯/手柄</option>
                            <option value="126">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相机包</option>
                            <option value="127">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;三脚架</option>
                            <option value="133">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电池/充电器</option>
                            <option value="90">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;影音娱乐</option>
                            <option value="134">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;耳机/耳麦</option>
                            <option value="136">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;音响/音箱</option>
                            <option value="137">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;无线音箱</option>
                            <option value="138">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收音机</option>
                            <option value="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;麦克风</option>
                            <option value="141">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MP3/MP4</option>
                            <option value="91">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;智能设备</option>
                            <option value="144">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;智能手环</option>
                            <option value="145">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;智能手表</option>
                            <option value="146">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;智能眼镜</option>
                            <option value="147">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;智能机器人</option>
                            <option value="149">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动跟踪器</option>
                            <option value="150">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;健康监测</option>
                            <option value="151">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;无人机</option>
                            <option value="153">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其他配件</option>
                            <option value="16"><span>◢</span>&nbsp;女装</option>
                            <option value="21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;当季流行</option>
                            <option value="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;女士新品</option>
                            <option value="58">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;短袖T恤</option>
                            <option value="71">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时尚套装</option>
                            <option value="80">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;女装商场同款</option>
                            <option value="22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;精选上装</option>
                            <option value="109">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T恤</option>
                            <option value="120">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;衬衫</option>
                            <option value="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;雪纺衫</option>
                            <option value="135">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;针织衫</option>
                            <option value="143">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;短外套</option>
                            <option value="23">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;浪漫裙装</option>
                            <option value="152">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;连衣裙</option>
                            <option value="156">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蕾丝连衣裙</option>
                            <option value="162">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;印花连衣裙</option>
                            <option value="213">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真丝连衣裙</option>
                            <option value="222">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;半身裙</option>
                            <option value="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;特色女装</option>
                            <option value="169">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时尚气质套装</option>
                            <option value="177">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;休闲运动套装</option>
                            <option value="188">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;妈妈装夏款</option>
                            <option value="199">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大码女装</option>
                            <option value="206">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;职业套装</option>
                            <option value="12"><span>◢</span>&nbsp;男装</option>
                            <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;当季流行</option>
                            <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;纯色衬衫</option>
                            <option value="51">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛仔裤</option>
                            <option value="63">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛仔夹克</option>
                            <option value="74">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格子衬衫</option>
                            <option value="208">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;迷彩服</option>
                            <option value="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;男士外套</option>
                            <option value="40">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;夹克</option>
                            <option value="81">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;风衣</option>
                            <option value="82">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;皮衣</option>
                            <option value="88">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;西服</option>
                            <option value="215">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大衣</option>
                            <option value="99">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;男士裤子</option>
                            <option value="104">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;休闲裤</option>
                            <option value="111">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牛仔裤</option>
                            <option value="117">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;西裤</option>
                            <option value="124">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;九分裤</option>
                            <option value="225">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;小脚裤</option>
                            <option value="131">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;特色男装</option>
                            <option value="132">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;民族服饰</option>
                            <option value="139">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;中山装</option>
                            <option value="142">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商务装</option>
                            <option value="148">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;老年服饰</option>
                            <option value="174">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;运动服</option>
                            <option value="182">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动外套</option>
                            <option value="190">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动裤</option>
                            <option value="197">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;卫衣</option>
                            <option value="4"><span>◢</span>&nbsp;个护化妆</option>
                            <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;面部护肤</option>
                            <option value="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T区护理</option>
                            <option value="41">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;面膜</option>
                            <option value="45">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;乳液面霜</option>
                            <option value="53">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;香水彩妆</option>
                            <option value="66">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;眼线液/笔</option>
                            <option value="70">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BB霜/CC霜</option>
                            <option value="86">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;眼影</option>
                            <option value="540">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;香水</option>
                            <option value="115">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;化妆工具</option>
                            <option value="55">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;男士护肤</option>
                            <option value="123">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;洁面</option>
                            <option value="128">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;乳液/面霜</option>
                            <option value="129">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;护理套装</option>
                            <option value="57">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;美发护发</option>
                            <option value="520">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;洗发</option>
                            <option value="521">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;护发</option>
                            <option value="522">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;染发</option>
                            <option value="523">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;造型</option>
                            <option value="524">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;假发</option>
                            <option value="59">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;口腔护理</option>
                            <option value="525">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牙膏/牙粉</option>
                            <option value="526">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牙刷/牙线</option>
                            <option value="527">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;漱口水</option>
                            <option value="528">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;套装</option>
                            <option value="62">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;身体护理</option>
                            <option value="529">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;沐浴</option>
                            <option value="530">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;润肤</option>
                            <option value="531">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;精油</option>
                            <option value="532">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;颈部</option>
                            <option value="533">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手足</option>
                            <option value="534">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;美胸</option>
                            <option value="226"><span>◢</span>&nbsp;箱包鞋帽</option>
                            <option value="227">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;女鞋</option>
                            <option value="228">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;凉鞋</option>
                            <option value="229">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;坡跟</option>
                            <option value="230">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;高跟鞋</option>
                            <option value="231">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;男鞋</option>
                            <option value="232">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;皮鞋</option>
                            <option value="251">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;潮流女包</option>
                            <option value="252">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单肩包</option>
                            <option value="253">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手提包</option>
                            <option value="254">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;双肩包</option>
                            <option value="255">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;钱包</option>
                            <option value="256">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;精品男包</option>
                            <option value="258">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商务公文包</option>
                            <option value="259">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单肩/斜挎包</option>
                            <option value="260">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;男士钱包</option>
                            <option value="261">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;双肩包</option>
                            <option value="262">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;男士手包</option>
                            <option value="257">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;功能箱包</option>
                            <option value="263">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;拉杆箱</option>
                            <option value="264">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;拉杆包</option>
                            <option value="265">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旅行包</option>
                            <option value="266">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电脑包</option>
                            <option value="267">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相机包</option>
                            <option value="268">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;书包</option>
                            <option value="233"><span>◢</span>&nbsp;童装童鞋</option>
                            <option value="234">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;儿童运动</option>
                            <option value="238">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动上衣</option>
                            <option value="239">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动裤</option>
                            <option value="240">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动T恤</option>
                            <option value="241">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;冲锋衣</option>
                            <option value="235">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;精选童装</option>
                            <option value="242">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;儿童套装</option>
                            <option value="243">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;公主裙</option>
                            <option value="244">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;儿童上衣</option>
                            <option value="245">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;裤子</option>
                            <option value="236">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;潮流童鞋</option>
                            <option value="246">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;凉鞋</option>
                            <option value="247">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;运动鞋</option>
                            <option value="248">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;帆布鞋</option>
                            <option value="249">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;皮鞋</option>
                            <option value="237">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;内衣配饰</option>
                            <option value="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;儿童内裤</option>
                            <option value="270"><span>◢</span>&nbsp;酒水</option>
                            <option value="301">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;白酒</option>
                            <option value="304">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;茅台</option>
                            <option value="305">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;五粮液</option>
                            <option value="538">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;二锅头</option>
                            <option value="539">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;劲酒</option>
                            <option value="302">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;啤酒</option>
                            <option value="535">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;青岛</option>
                            <option value="536">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;哈尔滨</option>
                            <option value="537">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;雪花</option>
                            <option value="303">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;葡萄酒</option>
                            <option value="274"><span>◢</span>&nbsp;家居家装</option>
                            <option value="314">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;家纺</option>
                            <option value="389">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;床品套件</option>
                            <option value="390">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;被子</option>
                            <option value="391">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;枕芯</option>
                            <option value="392">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;蚊帐</option>
                            <option value="393">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;凉席</option>
                            <option value="394">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;毛巾浴巾</option>
                            <option value="395">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;床单被罩</option>
                            <option value="396">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;床垫/床褥</option>
                            <option value="397">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;毯子</option>
                            <option value="398">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;抱枕靠垫</option>
                            <option value="399">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;窗纱/窗帘</option>
                            <option value="400">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电热毯</option>
                            <option value="401">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;布艺软饰</option>
                            <option value="315">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;家装装饰</option>
                            <option value="402">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;桌布/罩件</option>
                            <option value="403">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地毯地垫</option>
                            <option value="404">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;沙发垫套/椅垫</option>
                            <option value="405">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装饰字画</option>
                            <option value="406">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装饰摆件</option>
                            <option value="407">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手工/十字绣</option>
                            <option value="408">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;相框/照片墙</option>
                            <option value="409">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;墙贴/装饰贴</option>
                            <option value="410">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;花瓶花艺</option>
                            <option value="411">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;香薰蜡烛</option>
                            <option value="412">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;节庆饰品</option>
                            <option value="413">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;钟饰</option>
                            <option value="414">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;帘艺隔断</option>
                            <option value="415">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;创意家居</option>
                            <option value="416">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;保暖防护</option>
                            <option value="317">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>◢</span>&nbsp;生活日用</option>
                            <option value="417">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收纳用品</option>
                            <option value="418">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;雨伞雨具</option>
                            <option value="419">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;净化除味</option>
                            <option value="420">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浴室用品</option>
                            <option value="421">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;洗晒/熨烫</option>
                            <option value="422">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;缝纫/针织用品</option>
                            <option value="423">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;清洁工具</option>
                        </select>

                    </div>
                </div>
            </div>
            <!--当搜索条件过来时并需要默认隐藏的时候在simple-form-field后面新加toggle hide样式，并且在最后新加ID为searchMore的链接按钮（更多筛选条件按钮）-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-goods_status" class="form-control" name="goods_status" data-width="120">
                            <option value="">全部</option>
                            <option value="0">已下架</option>
                            <option value="1">出售中</option>
                            <option value="2">违规下架</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle1 hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-goods_audit" class="form-control" name="goods_audit" data-width="120">
                            <option value="">全部</option>
                            <option value="0">待审核</option>
                            <option value="1">审核通过</option>
                            <option value="2">审核未通过</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle1 hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>品牌：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-brand_id" class="form-control chosen-select" name="brand_id" data-width="200">
                            <option value=""></option>
                            <option value="1">乐视</option>
                            <option value="2">创维</option>
                            <option value="3">飞利浦</option>
                            <option value="4">海信</option>
                            <option value="5">美的</option>
                            <option value="6">奥克斯</option>
                            <option value="7">飞科</option>
                            <option value="8">华帝</option>
                            <option value="9">迪加伦</option>
                            <option value="10">苏泊尔</option>
                            <option value="11">二十一世纪出版社</option>
                            <option value="12">小米</option>
                            <option value="13">明天出版社</option>
                            <option value="14">华为</option>
                            <option value="15">iphone</option>
                            <option value="16">博集天卷</option>
                            <option value="17">HTC</option>
                            <option value="18">oppo</option>
                            <option value="19">磨铁图书</option>
                            <option value="20">三星</option>
                            <option value="21">清华大学出版社</option>
                            <option value="22">魅族</option>
                            <option value="23">机械工业出版社</option>
                            <option value="24">联想</option>
                            <option value="25">人民邮电出版社</option>
                            <option value="26">戴尔</option>
                            <option value="27">vivo</option>
                            <option value="28">汤臣倍健</option>
                            <option value="29">宏碁</option>
                            <option value="30">惠普</option>
                            <option value="31">清华同方</option>
                            <option value="32">华硕</option>
                            <option value="33">爱仕达</option>
                            <option value="34">好事达</option>
                            <option value="35">雷蛇</option>
                            <option value="36">博洋家纺</option>
                            <option value="37">富安娜</option>
                            <option value="38">罗莱</option>
                            <option value="39">世家洁具</option>
                            <option value="40">得力</option>
                            <option value="41">慧乐家</option>
                            <option value="42">金喇叭</option>
                            <option value="43">友臣</option>
                            <option value="44">美好家</option>
                            <option value="45">ONLY</option>
                            <option value="46">伊莲娜</option>
                            <option value="47">猫城</option>
                            <option value="48">韩都衣舍</option>
                            <option value="49">欧司朗</option>
                            <option value="50">稻香村</option>
                            <option value="51">妖精的口袋</option>
                            <option value="52">全友家居</option>
                            <option value="53">花花公子</option>
                            <option value="54">乐事</option>
                            <option value="55">澳优</option>
                            <option value="56">罗蒙</option>
                            <option value="57">茅台</option>
                            <option value="58">NUK</option>
                            <option value="59">强生</option>
                            <option value="60">七匹狼</option>
                            <option value="61">古井贡</option>
                            <option value="62">雀巢</option>
                            <option value="63">战地吉普</option>
                            <option value="64">大洋世家</option>
                            <option value="65">雅培</option>
                            <option value="66">多美</option>
                            <option value="67">安奈儿</option>
                            <option value="68">乐高</option>
                            <option value="69">湾仔码头</option>
                            <option value="70">十月妈咪</option>
                            <option value="71">铭佳童话</option>
                            <option value="72">帮宝适</option>
                            <option value="73">好奇</option>
                            <option value="74">Hipp</option>
                            <option value="75">亨氏</option>
                            <option value="76">雅诗兰黛</option>
                            <option value="77">布朗博士</option>
                            <option value="78">法国兰蔻</option>
                            <option value="79">美孚</option>
                            <option value="80">道达尔</option>
                            <option value="81">妈咪宝贝</option>
                            <option value="82">olay</option>
                            <option value="83">汉高</option>
                            <option value="84">相宜本草</option>
                            <option value="85">百立乐</option>
                            <option value="86">ZA</option>
                            <option value="87">壳牌</option>
                            <option value="88">捷安特</option>
                            <option value="89">韩束</option>
                            <option value="90">乔山</option>
                            <option value="91">法兰琳卡</option>
                            <option value="92">信乐</option>
                            <option value="93">嘉实多</option>
                            <option value="94">温碧泉</option>
                            <option value="95">福斯</option>
                            <option value="96">威尔胜</option>
                            <option value="97">诺可文</option>
                            <option value="98">沙宣</option>
                            <option value="99">斯伯丁</option>
                            <option value="100">潘婷</option>
                            <option value="101">欧亚马</option>
                            <option value="102">火枫</option>
                            <option value="103">飘柔</option>
                            <option value="104">中极星</option>
                            <option value="105">达芙妮</option>
                            <option value="106">361°</option>
                            <option value="107">卡饰社</option>
                            <option value="108">卓诗尼</option>
                            <option value="109">他她</option>
                            <option value="110">纳迪亚N+a</option>
                            <option value="111">UGG</option>
                            <option value="112">百丽</option>
                            <option value="113">双星</option>
                            <option value="114">耐克</option>
                            <option value="115">骆驼</option>
                            <option value="116">李宁</option>
                            <option value="117">鸿星尔克</option>
                            <option value="118">米其林</option>
                            <option value="119">特步</option>
                            <option value="120">安踏</option>
                            <option value="121">puma</option>
                            <option value="122">稻草人</option>
                            <option value="123">古奇</option>
                            <option value="124">欧米茄</option>
                            <option value="125">浪琴</option>
                            <option value="126">天梭</option>
                            <option value="127">格力</option>
                            <option value="128">海尔</option>
                            <option value="129">老板</option>
                            <option value="130">苹果</option>
                            <option value="131">罗技</option>
                            <option value="132">费列罗</option>
                            <option value="133">伊利</option>
                            <option value="134">十月稻田</option>
                            <option value="135">艺福堂</option>
                            <option value="136">拉菲</option>
                            <option value="137">洋河酒厂</option>
                            <option value="138">梦妆</option>
                            <option value="139">迪奥</option>
                            <option value="140">香奈儿</option>
                            <option value="141">卡文克莱</option>
                            <option value="142">乔曼帝</option>
                            <option value="143">安睡宝</option>
                            <option value="144">奔腾</option>
                            <option value="145">三菱电机</option>
                            <option value="146">三洋电池</option>
                            <option value="147">三只松鼠</option>
                            <option value="148">鲜农乐</option>
                            <option value="149">.</option>
                            <option value="150">ロケット石鹸</option>
                            <option value="151">M·S·U/真想您</option>
                            <option value="152">潤佳</option>
                            <option value="153">669</option>
                            <option value="154">内斯蒂·丹特</option>
                            <option value="155">德·亿龙</option>
                            <option value="156">M·LEAD/摩兰迪</option>
                            <option value="157">1000Billion</option>
                            <option value="158">365ROSE/365朵玫瑰</option>
                            <option value="159">MENOW/美·诺</option>
                            <option value="160">3097</option>
                            <option value="161">咔咪咔咪</option>
                            <option value="162">Schuhmann Beautiful/舒曼·佳</option>
                            <option value="163">yesland 雅熙·莱帝</option>
                            <option value="164">1320/一生爱你</option>
                            <option value="165">383</option>
                            <option value="166">900</option>
                            <option value="167">500Year</option>
                            <option value="168">1900</option>
                            <option value="169">咪啵</option>
                            <option value="170">198ZCORY</option>
                            <option value="171">1825</option>
                            <option value="172">柏梭</option>
                            <option value="173">浪漫之花</option>
                            <option value="174">Suamgy/圣芝</option>
                        </select>

                    </div>
                </div>
            </div>
            <!--
            <div class="simple-form-field toggle1 hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>标签：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control">
                            <option value="0">全部</option>
                            <option value="1">新品</option>
                            <option value="2">精品</option>
                            <option value="3">热销</option>
                        </select>
                    </div>
                </div>
            </div>
             -->
            <div class="simple-form-field toggle1 hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>条形码：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" id="searchmodel-goods_barcode" class="form-control" name="goods_barcode" placeholder="请输入正确的条形码">

                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle1 hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>隶属网点：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="searchmodel-store_id" class="form-control chosen-select" name="store_id" data-width="120">
                            <option value="">请选择</option>
                            <option value="1">鲜农乐一号门店</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="button" id="btn_search" value="搜索" class="btn btn-primary m-r-5" />
                <!--
                <input type="button" id="btn_export" value="导出" class="btn btn-default m-r-5" />
                 -->
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
        <script type="text/javascript">
            $().ready(function() {
                $("body").on("click", "#searchMore",function(){
                    $(".toggle1").toggleClass("hide");
                    $(this).text("收起筛选条件");
                    if($(".toggle1").hasClass("hide")){
                        $(this).text("更多筛选条件");
                    }
                })
            });
        </script>
    </div>
    <!-- 工具栏（列表名称、列表显示项设置） -->

    <div class="common-title">
        <div class="ftitle">
            <h3>商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('goods.collect-comment.partials._goods_list')

    </div>
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script type='text/javascript'>
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            $("#btn_search").click(function() {
                var data = $("#SearchModel").serializeJson();
                tablelist.load(data);
            });

            $("body").on("mouseover", ".QR-code", function() {
                if ($(this).data("loading")) {
                    return;
                }
                var target = $(this).find("img");
                var src = $(target).data("src");
                var img = new Image();
                img.src = src;
                img.onload = function() {
                    $(target).attr("src", src);
                };
                $(this).data("loading", true);
            });

            $("body").on("click", "#batch_collect",function(){

                var goodsids = getSelectCheckbox();
                if(goodsids == false){
                    $.msg("请选择要采集评论的商品!");
                    return false;
                }else{
                    goodsids = goodsids.join(",");
                }
                $.loading.start();

                $.post('/goods/collect-comment/ajax-setting', {
                    goods_ids: goodsids
                }, function(result) {
                    if (result.code == 0) {
                        $.open({
                            type: 1,
                            title: '采集评论设置', //样式类名
                            closeBtn: 1, //不显示关闭按钮
                            shadeClose: false, //开启遮罩关闭
                            area: ['640px', ''], //宽高
                            content: result.data
                        });

                    }else{
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");
            });


        });
        //中间接应评论设置项后的参数方法
        function ajaxImport(setting){
            closePop();
            $.open({
                type: 1,
                title: '完成进度', //样式类名
                closeBtn: 0, //不显示关闭按钮
                shadeClose: false, //开启遮罩关闭
                area: ['400px','300px'], //宽高
                content: "<div id='jdt' class='p-15 text-c f14'></div>"
            });
            collectComment(setting);
        }
        //递归商品评论采集
        function collectComment(setting){

            $.post('/goods/collect-comment/ajax-collect', {
                setting: setting
            }, function(result) {
                //console.info(result);
                $("#jdt").append('<p class="m-b-20 m-t-5">'+result.message+'</p>');
                if(result.code == 0){
                    $("#comment_num"+result.goods_id).html(result.comment_num);
                }
                if(result.data){
                    collectComment(result.data);
                }else{

                    $("#jdt").append("<font class='c-red'>评论采集完成！</font><p class='m-t-10'><a class='btn btn-primary' onclick='closePop()'>关闭</a></p>");
                    //setTimeout("closePop()",5000);
                }
            }, "JSON");
        }

        function closePop(){
            $.closeAll()
        }

        //获取当前选择要采集评论的商品ids
        function getSelectCheckbox()
        {
            var goods_ids = new Array();
            $(".table-list-checkbox").each(function(){
                if($(this).is(':checked')){
                    goods_ids.push($(this).val());
                }
            })
            return goods_ids.length > 0 ? goods_ids : false;
        }
        //单个商品采集评论
        function onecheck(id){
            $("input[type='checkbox']").removeAttr("checked");
            $("#checkbox"+id).prop("checked",true);
            $("#batch_collect").click();
        }

    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop