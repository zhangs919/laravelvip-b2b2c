{{--由于专题的详情页 店铺专题和平台专题 一样 因此 用同一个模板页面--}}
@extends('layouts.shop_layout')

@section('header_css')
    <link rel="stylesheet" href="/css/topic_activity.css"/>
    <link href="/css/template.css" rel="stylesheet">
@stop

@section('style_js')

@stop



@section('content')

    <div class="topic-box" {!! $bgStyle !!}>
        <!-- #tpl_region_start -->

        {!! $tplHtml !!}

        <!-- #tpl_region_end -->
    </div>

    <script src="/js/topic.js"></script>
@stop
