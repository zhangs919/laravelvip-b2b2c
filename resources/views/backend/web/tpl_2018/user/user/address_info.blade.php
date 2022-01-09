{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="common-title">
        <div class="ftitle">
            <h3>收货地址列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>

    <!--列表内容-->
    <div class="table-responsive">



        {{--引入列表--}}
        @include('user.user.partials._address_info')


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
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop