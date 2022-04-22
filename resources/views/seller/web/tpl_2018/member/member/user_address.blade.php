{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <!--列表上面（列表名称、列表显示项设置）-->
    <div class="common-title">
        <div class="ftitle">
            <h3>收货地址</h3>
            <h5>共{{ $total }}条记录</h5>
        </div>
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        <!-- -->
        {{--引入列表--}}
        @include('member.member.partials._user_address')
        <!-- -->
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


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: {
                    type: ''
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop