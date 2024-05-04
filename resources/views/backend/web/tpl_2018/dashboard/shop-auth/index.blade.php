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

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/shop-auth/index.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keywords" class="form-control w180" type="text" value="" placeholder="店铺名称/店铺ID/店主帐号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_type" name="shop_type" class="form-control">
                            <option value="0">全部</option>
                            <option value="1">自营零售商</option>
                            <option value="2">入驻零售商</option>
                            <option value="3">自营供货商</option>
                            <option value="4">入驻供货商</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_status" name="shop_status" class="form-control">
                            <option value="-1">全部</option>
                            <option value="1">开启</option>
                            <option value="0">关闭</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>店铺列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:reload();" data-toggle="tooltip" data-placement="auto bottom" title="" data-original-title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>
            <script type="text/javascript">
                function reload() {

                }
            </script>



        </div>
    </div>

    {{--引入列表--}}
    @include('dashboard.shop-auth.partials._list')


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
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop