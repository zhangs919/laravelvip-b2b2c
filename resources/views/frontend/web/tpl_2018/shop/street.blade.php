@extends('layouts.base')

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/frontend/js/index.js?v=20180528"></script>
    <script src="/frontend/js/tabs.js?v=20180528"></script>
    <script src="/frontend/js/bubbleup.js?v=20180528"></script>
    <script src="/frontend/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/frontend/js/index_tab.js?v=20180528"></script>
    <script src="/frontend/js/jump.js?v=20180528"></script>
    <script src="/frontend/js/nav.js?v=20180528"></script>
@stop



@section('content')

    <!-- 内容 -->

    <link rel="stylesheet" href="/frontend/css/shop_street.css?v=20180428"/>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>
    <div class="w1210">
        <div class="classify-screen">

            <div class="classify-box clearfix">
                <h5 class="classify-name">区域站点：</h5>
                <div class="classify-screen-con">
                    <div class="classify-choose">

                        <a target="_self" href="/shop/street/index.html?cls_id=&amp;site_id=1" class="selected">
                            <span>开州区</span>
                        </a>

                        <a target="_self" href="/shop/street/index.html?cls_id=&amp;site_id=2">
                            <span>北京站</span>
                        </a>


                    </div>
                </div>
            </div>

            <div class="classify-box clearfix">
                <h5 class="classify-name">店铺分类：</h5>
                <div class="classify-screen-con">
                    <div class="classify-choose">
                        <a target="_self" href="/shop/street/index.html" @if($cls_id == 0) class="selected" @endif>
                            <span>全部</span>
                        </a>

                        @foreach($cat_list as $v)
                        <a target="_self" href="?cls_id=1_{{ $v->cls_id }}_0" title="{{ $v->cls_name }}" @if($query_parent_cls_id == $v->cls_id) class="selected" @endif>
                            <span>{{ $v->cls_name }}</span>
                        </a>
                        @endforeach

                    </div>

                    @if(!empty($child_class_list))
                    <div class="classify-screen-con1">
                        <a target="_self" href="?cls_id=1_{{ $query_parent_cls_id }}_0" @if($cls_id_arr[2] == 0 && $cls_id_arr[0] == 1) class="selected" @endif>
                            <span>全部</span>
                        </a>

                        @foreach($child_class_list as $v)
                        <a target="_self" href="?cls_id=2_{{ $v->cls_id }}_{{ $v->parent_id }}" title="{{ $v->cls_name }}" @if($cls_id_arr[1] == $v->cls_id) class="selected" @endif>
                            <span>{{ $v->cls_name }}</span>
                        </a>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="w1210">
        <div id="filter">
            <form method="get" name="listform" id="listform" action="">
                <div class="fore1">
                    <dl class="order">
                        <dd class="first  curr ">
                            <a href="?cls_id=&name=&sort=default"> 默认 </a>
                        </dd>
                        <dd class="">
                            <a href="?cls_id=&name=&sort=sale-desc">
                                销量

                                <i class="iconfont icon-DESC"></i>

                            </a>
                        </dd>
                        <dd class="">
                            <a href="?cls_id=&name=&sort=credit-desc">
                                信誉

                                <i class="iconfont icon-DESC"></i>

                            </a>
                        </dd>
                    </dl>
                    <dl class="shop-name">
                        <dt>店铺名称：</dt>
                        <dd>
                            <input type="text" placeholder="" name="name" value="" />
                            <input type="submit" class="btn" value="搜索" />
                        </dd>
                    </dl>
                </div>
            </form>
        </div>

        {{--引入列表--}}
        @include('shop.partials.street_shop_list')

    </div>
    <a class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            $("#checkbox").click(function() {
                $("#listform").submit();
            });
        });
    </script>

@stop