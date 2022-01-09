@extends('layouts.base')

@section('header_css')
    <link rel="stylesheet" href="/frontend/css/topic_activity.css?v=20180428"/>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')
    @include('layouts.partials.follow_box')
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

    <div class="topic-box" {!! $bgStyle !!}>
        <!-- #tpl_region_start -->

        {!! $tplHtml !!}

        <!-- #tpl_region_end -->
    </div>
@stop