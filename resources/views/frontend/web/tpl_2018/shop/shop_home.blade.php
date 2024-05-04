@extends('layouts.shop_layout')

@section('header_css')
{{--    <link href="/css/shop_index.css" rel="stylesheet">--}}
{{--    <link href="/css/template.css?v=3" rel="stylesheet">--}}
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



{{--        @if(!$webStatic)--}}{{--静态页面关闭时 显示--}}
{{--            <script type="text/javascript">--}}
{{--                $.templateloading();--}}
{{--            </script>--}}
{{--        @endif--}}



    </div>


@stop