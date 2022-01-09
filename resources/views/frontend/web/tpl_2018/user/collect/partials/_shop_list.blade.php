<!---->
<script src="/assets/d2eace91/js/jquery.js?v=20180027"></script>
<script src="/assets/d2eace91/js/placeholder.js?v=20180027"></script>
<script src="/frontend/js/login.js?v=20180027"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=20180027"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=20180027"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=20180027"></script>
<script src="/assets/d2eace91/js/common.js?v=20180027"></script>

<div class="floatbar">
    <div class="bar-float">
        <div class="select">
            <ul>
                <!-- 选择的当前的状态 给a标签追加class值为"sel-select" _start -->
                <li id="all_shop" class="sel-item">
                    <a class="sel-link sel-select">
                        全部店铺
                        <em> {{ $shop_collect_count }} </em>
                    </a>
                </li>
                <!-- 选择的当前的状态 给a标签追加class值为"sel-select" _end -->
                <li id="buy_shop_list" class="sel-item">
                    <a class="sel-link ">
                        已购
                        <em>1</em>
                    </a>
                </li>
            </ul>
        </div>
        <div class="fav-search fav-shop-search cleatfix">
            <form class="search-panel-focused" id="searchForm" action="">
                <div class="search-panel-fields">
                    <input name="search_shop" type="text" placeholder="请输入店铺名称" value="" class="search-combobox-input">
                </div>
                <div class="search-button-shop">
                    <input type="submit" name="all_shop" class="btn-search" value="搜店铺">
                </div>
                <input name="tab" type="hidden" value="all_shop" />
                <input name="type" type="hidden" value="1" />
            </form>
        </div>
        <div class="tools">
            <div class="tool-showbtn">批量管理</div>
            <ul class="tool-list">
                <!-- 如果是全选状态，给li标签追加class值"tool-item-selall" _start-->
                <li class="tool-item">
                    <i class="iconfont"></i>
                    全选
                </li>
                <!-- 如果是全选状态，给li标签追加class值"tool-item-selall" _end-->
                <li id="tools" class="tool-item">
                    <i class="iconfont"></i>
                    删除
                </li>
                <li class="tool-item tool-hidebtn">取消管理</li>
            </ul>
        </div>
    </div>
</div>
<!-- 全部店铺 _start -->
<!---->
<div id="table_list">
    <div id="fav-list">
        @if(!empty($list))
            <!---->
            <ul class="img-item-list clearfix">

                @foreach($list as $v)
                <!---->
                <li id="shop{{ $v['collect_id'] }}" class="fav-shop-list clearfix">
                    <div class="shop-card clearfix">
                        <div class="logo">
                            <a href="{{ route('pc_shop_home',['shop_id'=>$v['shop_id']]) }}" target="_blank">
                                <img class="logo-img" src="{{ get_image_url($v['shop_logo'], 'shop_logo') }}" />
                            </a>
                        </div>
                        <div class="seller">
                            <img src="/frontend/images/shop-type/shop-icon1.png" />
                            <a href="{{ route('pc_shop_home',['shop_id'=>$v['shop_id']]) }}" target="_blank" class="seller-link">{{ $v['shop_name'] }}</a>
                            <span class="ww-light">
    <!-- 旺旺不在线 i 标签的 class="ww-offline" -->
                                <!---->
                                <!-- s等于1时带文字，等于2时不带文字 -->
    <a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
    <img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
    <span></span>
    </a>
                                <!---->
    </span>


                            <!---->
                            <span class="buyed">已购</span>
                            <!---->
                        </div>
                        <div class="delete">
                            <!---->
                            <a data-fig="1" name="shop{{ $v['collect_id'] }}" title="删除店铺"><i class="iconfont"></i></a>
                            <!---->
                        </div>
                    </div>
                    <div class="item-list-box">
                        <div class="item-list">
                            <ul class="item-list-ul cleatfix">
                                <!---->
                                <li class="item-box first">
                                    <a href="http://www.b2b2c.yunmall.68mall.com/goods-21.html" title="西班牙进口红酒浪漫之花桃红甜起泡酒葡萄酒750ml/瓶" target="_blank">
                                        <img class="item-img" src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/42566859005/TB1wVs2MVXXXXcjaXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="西班牙进口红酒浪漫之花桃红甜起泡酒葡萄酒750ml/瓶">
                                    </a>
                                </li>
                                <!---->
                                <li class="item-box first">
                                    <a href="http://www.b2b2c.yunmall.68mall.com/goods-124.html" title="Zespri佳沛新西兰阳光金奇异果10个81-105g" target="_blank">
                                        <img class="item-img" src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/532614404434/TB1TWC6NXXXXXXlXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="Zespri佳沛新西兰阳光金奇异果10个81-105g">
                                    </a>
                                </li>
                                <!---->
                                <li class="item-box first">
                                    <a href="http://www.b2b2c.yunmall.68mall.com/goods-119.html" title="娥佩兰薏仁水500ml爽肤水化妆水保湿水补水控油修护" target="_blank">
                                        <img class="item-img" src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/45711635158/TB17I.rNpXXXXXuXpXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="娥佩兰薏仁水500ml爽肤水化妆水保湿水补水控油修护">
                                    </a>
                                </li>
                                <!---->
                                <li class="item-box first">
                                    <a href="http://www.b2b2c.yunmall.68mall.com/goods-18.html" title="汇源果汁 100%纯果汁 橙汁 1L*6盒 便携礼盒" target="_blank">
                                        <img class="item-img" src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/524132636806/TB1lOFhLFXXXXXJXXXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt="汇源果汁 100%纯果汁 橙汁 1L*6盒 便携礼盒">
                                    </a>
                                </li>
                                <!---->
                            </ul>
                        </div>
                    </div>
                    <div class="edit-pop">
                        <input type="hidden" class="form-control" value="{{ $v['collect_id'] }}">
                        <div class="edit-pop-bg"></div>
                        <div class="edit-pop-btn">
                            <i class="edit-icon"></i>
                            <div class="item-pk-txt"></div>
                        </div>
                    </div>
                </li>
                @endforeach
                <!---->

            </ul>
            <form name="selectPageForm" action="" method="get">
                <!--分页-->
                <div class="page">
                    <div class="page-wrap fr">
                        {!! $pageHtml !!}
                    </div>
                </div>
            </form>
        @else
            <div class="tip-box">
                <img src="/frontend/images/noresult.png" class="tip-icon">
                <div class="tip-text">暂无收藏的店铺</div>
            </div>
        @endif

    </div>
    <!-- 全部店铺 _end -->
</div>
<script type='text/javascript'>
    $(function() {
        $(".select li").on('click', function() {
            $.loading.start();
            var page = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '/user/collect/shop?tab=' + page + '',
                dataType: 'json',
                success: function(result) {
                    $('.collect-list').removeClass('collect-list-items');
                    $(".collect-list").html(result.data);
                }
            })
        })
    })
</script>
<script type='text/javascript'>
    $(function() {
        $("#tools").click(function() {
            var arr = new Array();
            var int = 0;
            $(".edit-pop-select input").each(function() {
                arr[int] = $(this).val();
                int++;
            });
            if (int > 0) {
                $.confirm("是否删除选定内容？", function(s) {
                    if (s) {
                        $.ajax({
                            type: 'GET',
                            url: '/user/collect/delete-collect?id=' + arr,
                            dataType: 'json',
                            success: function(result) {
                                $("#all_shop em").html(result.shop_count);
                                $("#buy_shop_list em").html(result.buy_count);
                                tablelist.load();
                                $.msg("删除成功");
                            }
                        })
                    }
                });
            } else {

                $.msg("亲,请先选择要删除的的店铺");
            }
        })
    })
</script>
<script type="text/javascript">
    var tablelist = null;
    $().ready(function() {
        tablelist = $("#table_list").tablelist({
            params: $("#searchForm").serializeJson()
        });
        $("#searchForm").submit(function() {
// 序列化表单为JSON对象
            var data = $(this).serializeJson();
            console.info(data);
// Ajax加载数据
            tablelist.load(data);
// 阻止表单提交
            return false;
        });

    });
    tablelist.load();
</script>