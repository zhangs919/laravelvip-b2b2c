@extends('layouts.shop_layout')


@section('style_js')

@stop



@section('content')

    <!-- 内容 -->
    {{--店铺装修内容--}}
    <div class="layout"  style="min-height:400px;">
        <!-- 内容 -->
        <!--模块内容-->
        <!-- #tpl_region_start -->

        {!! $tplHtml !!}

        <!-- #tpl_region_end -->







    </div>


@stop