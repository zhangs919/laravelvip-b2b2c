<!---->
<div class="collect-list" id="con_status_1">
    <div class="floatbar">
        <div class="bar-float">
            <div class="select">
                <ul>
                    <!-- 选择的当前的状态 给a标签追加class值为"sel-select" _start -->
                    <li id="goods_list" class="sel-item">
                        <!-- <a class="sel-link sel-select" href="/user/collect">全部宝贝<em></em></a>-->
                        <a class="sel-link sel-select">
                            全部宝贝
                            <em>{{ $goods_collect_count }} </em>
                        </a>
                    </li>
                    <!-- 选择的当前的状态 给a标签追加class值为"sel-select" _end -->
                    <li id="invalid_list" class="sel-item">
                        <a class="sel-link">
                            失效
                            <em>2</em>
                        </a>
                    </li>
                    <li id="shop_same" class="sel-item" style="display: none">
                        <a class="sel-link">
                            同店宝贝
                            <em>1</em>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="fav-search fav-goods-search cleatfix">
                <form class="search-panel-focused" id="searchForm" action="">
                    <div class="search-panel-fields">
                        <input type="text" name="search_goods" placeholder="宝贝搜索" name="search_goods" class="search-combobox-input">
                    </div>
                    <div class="search-button">
                        <input name="goods_list" name="search_goods" type="submit" class="btn-search" value="搜索" />
                    </div>
                    <input name="tab" type="hidden" value="goods_list" />
                    <input name="type" type="hidden" value="1" />
                </form>
            </div>
            <!-- 如果是'同店商品'，将此模块隐藏 _start -->
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
            <!-- 如果是'同店商品'，将此模块隐藏 _end -->
            <div class="compare">
                <div class="compare-txt">
                    已选择宝贝
                    <span class="">0</span>
                    /3
                </div>
                <div class="compare-open">宝贝对比</div>
                <!-- 如果是允许商品对比，将"disable"类名删除 _start -->
                <div class="compare-start disable">开始对比</div>
                <!-- 如果是允许商品对比，将"disable"类名删除 _end -->
                <div class="compare-close">取消对比</div>
            </div>
        </div>
    </div>
    <!---->
    <div id="table_list">
        <div id="fav-list">
            @if(!empty($list))
                <!-- -->
                <ul class="img-item-list clearfix">


                    @foreach($list as $v)
                    <li class="fav-item" id="collect{{ $v['collect_id'] }}">
                        <div class="controller-box">
                            <div class="controller-img-box">
                                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" class="controller-img-link" target="_blank" title="">
                                    <img class="controller-img" src="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="">
                                </a>
                            </div>
                            <a class="add-cat-btn" data-tip="{{ $v['goods_id'] }}" title="加入购物车">加入购物车</a>
                            <a name="{{ $v['collect_id'] }}" data-fig="goods_list" class="del-btn" title="删除宝贝">删除</a>
                        </div>
                        <div class="item-title">
                            <a title="{{ $v['goods_name'] }}" target="_blank" href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}"> {{ $v['goods_name'] }} </a>
                        </div>
                        <div class="price-container">
                            <div class="price-box">
                                <!---->
                                <div class="price">
                                    <strong class="color">￥{{ $v['collect_price'] }}</strong>
                                </div>
                                <!---->
                            </div>
                        </div>
                        <div class="edit-pop">
                            <input type="hidden" class="form-control" value="{{ $v['collect_id'] }}">
                            <div class="edit-pop-bg"><input type="hidden" class="form-control" value="{{ $v['goods_id'] }}"></div>
                            <div class="edit-pop-btn">
                                <i class="edit-icon"></i>
                            </div>
                        </div>
                    </li>
                    <!---->
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
                <!---->
            @else
                <div class="tip-box">
                    <img src="/frontend/images/noresult.png" class="tip-icon">
                    <div class="tip-text">暂无收藏的宝贝</div>
                </div>
            @endif
        </div>
    </div>
    <!-- 全部商品列表 _end -->
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: {
                    is_page: 1
                }
            });
            $("#searchForm").submit(function() {
// 序列化表单为JSON对象
                var data = $(this).serializeJson();
// Ajax加载数据
                tablelist.load(data);
// 阻止表单提交
                return false;
            });
        });
    </script>
    <!---->
</div>
<script type='text/javascript'>
    $(function() {
        $(".select>ul>li").click(function() {
            $.loading.start();
            var page = $(this).attr('id');
            if (typeof (page) == "undefined") {
                page = "";
            }
            $.ajax({
                type: 'GET',
                url: '/user/collect/goods?tab=' + page + '',
                dataType: 'json',
                success: function(result) {
                    $(".content-info").html(result.data);
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
                    var li_len = $("ul[class='img-item-list clearfix']>li").length;
                    var select_len = 0;
                    var invalid = 0;
                    if (s) {
                        $.ajax({
                            type: 'GET',
                            url: '/user/collect/delete-collect?id=' + arr,
                            dataType: 'json',
                            success: function(result) {
                                $("#goods_list em").html(result.collect_count);
                                $("#invalid_list em").html(result.invalid_count);
                                $("#shop_same em").html(result.shop_count_list);
                                tablelist.load();
                                $.msg("删除成功");
                            }
                        })
                    }
                });
            } else {
                $.msg("亲,请先选择要删除的的宝贝");
            }
        });
    });
</script>