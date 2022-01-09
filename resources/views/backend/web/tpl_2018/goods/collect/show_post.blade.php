{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')
    <!--进度条start-->
    <!--该样式为黑色背景带透明度，蓝色动态进度条-->
    <!--关于进度条变色，progress-bar-primary为蓝色，progress-bar-success绿色，progress-bar-warning黄色，progress-bar-danger红色  -->
    <!--遮罩-->
    <div class="pop-bg"></div>
    <!--进度条-->
    <div class="progress-box" style="margin-top:-135px;">
        <div class="loading-img" id="loading"><img src="/assets/d2eace91/images/common/loading_32_32.gif">数据正在采集中</div>
        <p class="f12 m-b-10"></p>
        <p>正在从淘宝店铺中下载商品详情，请稍后 ...</p>
        <div class="progress progress-striped active m-t-10 m-b-10">
            <div class="progress-bar progress-bar-success" style="width: 0%;" id="speed">0%</div>
        </div>
        <p class="f12">共<strong id="total_num">1</strong>条商品，已下载<strong id="finish_num">0</strong>条，剩余<strong id="surplus_num">0</strong>条待下载</p>
    </div>

    <!--将body去掉了右侧的滚动条，如果js写了或不需要去掉可将此样式删除-->

    <style>body{ overflow:hidden}</style>


    <!--进度条end-->
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
        var goods_ids = ["577454871963"];
        //console.info(goods_ids);
        ajaxCollect();

        function ajaxCollect(){
            $('#loading').show();
            $.ajax({
                type: 'POST',
                url: '/goods/collect/ajax-collect',
                data: 'id=' + goods_ids + '&num='+$("#total_num").html(),
                dataType: 'json',
                success: function(result) {
                    $('#loading').hide();
                    $('#total_num').html(result.num);
                    $('#speed').width(result.speed).html(result.speed);
                    $('#finish_num').html(result.finish_num);
                    $('#surplus_num').html(result.surplus_num);
                    if(result.code == 1){
                        goods_ids = result.data;
                        ajaxCollect();
                    }else if(result.code == 2){
                        goods_ids = result.data;
                        $.msg(result.message, {
                            time: 3000
                        }, function() {
                            ajaxCollect();
                        });
                    }else{
                        $.msg(result.message, {
                            time: 1500
                        }, function() {
                            $.go(result.go);
                        });
                    }
                }
            });
        }

    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop