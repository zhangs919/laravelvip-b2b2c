@extends('layouts.shop_layout')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
@stop

@section('style_js')

@stop



@section('content')

    <!-- 内容 -->
    {{--店铺装修内容--}}
    <div class="layout"  style="min-height:400px;">
        <!-- 内容 -->
        <!--模块内容-->
        <!-- #tpl_region_start -->
        {{--商城悬浮广告模板 特殊处理 无论静态页面开启与否 都加载出来--}}

        {!! $tplHtml !!}

        <!-- #tpl_region_end -->



        @if(!$webStatic){{--静态页面关闭时 显示--}}
            <script type="text/javascript">
                $.templateloading();
            </script>
        @endif



    </div>


@stop