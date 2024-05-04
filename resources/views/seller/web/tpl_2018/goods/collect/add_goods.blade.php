{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="data-import-box">
        <h5 class="text-c">开始导入<strong>{{ $total }}</strong>条数据</h5>
        <div class="data-list">
            <ul>
                @foreach($list as $item)
                    <li>
                        <span class="m-r-5">【ID】{{ $item['third_goods_id'] }}</span>
                        <span class="name m-r-5">{{ $item['goods_name'] }}</span>
                        <span class="m-r-5" id="{{ $item['third_goods_id'] }}">等待抓取</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <p class="text-c c-green m-b-5">数据导入成功！（用时：<span id="dotime">0</span>秒）</p>
        <p class="text-c c-red hide m-b-5">数据导入失败！（用时：10秒）</p>
        <p class="text-c">进入<a class="btn-link" href="/goods/list/index">商品列表</a></p>


    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        var ids = {!! $ids !!};
        var cat_id = {{ $post_collect_goods['goods_category'] }};
        var type_id = {{ $post_collect_goods['goods_type'] }};
        var is_comment = {{ $post_collect_goods['is_comment'] }};
        var do_time = 0;
        //console.info(goods_ids);
        ajaxAdd();

        function ajaxAdd(){
            $.ajax({
                type: 'POST',
                url: '/goods/collect/ajax-add',
                data: 'id=' + ids + '&cat_id='+cat_id+'&type_id='+type_id+'&is_comment='+is_comment+'&do_time='+do_time,
                dataType: 'json',
                success: function(result) {
                    if(result.code == 1){
                        ids = result.ids;
                        do_time = result.dotime;
                        $("#"+result.current_id).html(result.message);
                        $("#dotime").html(result.dotime);
                        ajaxAdd();
                    }else if(result.code == 2){
                        $.msg(result.message, {
                            time: 1500
                        });
                    }else{
                        $.msg(result.message, {
                            time: 500
                        });
                        $("#"+result.current_id).html('导入失败！');
                    }
                }
            });
        }

    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop