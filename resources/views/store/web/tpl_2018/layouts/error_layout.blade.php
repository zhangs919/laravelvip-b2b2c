{{--模板继承--}}
@extends('layouts.store_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')


    <div class="backend-error-box">
        <div class="error-img-box"></div>
        <div class="error-tit-box">
            <h5>@if($exception->getMessage() != ''){{ $exception->getMessage()}}@else页面未找到。@endif</h5>
            <p>抱歉，你访问的页面地址有误，或者该页面已经不存在了，请重新加载或访问其他网页。</p>
        </div>

        <a href="@if(null !== $exception->getPrevious()){{ $exception->getPrevious() }}@else/@endif" class="back-btn">返回上一页</a>

    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop