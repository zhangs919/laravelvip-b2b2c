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

    <div class="introduce-box">
        <div class="introduce-img">
            <img src="/assets/d2eace91/images/common/collect.jpg" alt="数据采集">
        </div>
        <div class="introduce-text">
            <h5>数据采集</h5>
            <p>
                数据采集是官方推出的一款付费营销应用，系统支持批量采集、按店铺采集、按分类采集淘宝商品数据，最大程度为店铺维护数据节约人力、财力成本。
                <br>
                数据采集数量有效期为一年，过期后系统可能会将采集数量置空，请及时使用！
            </p>
            <p class="m-t-5">
				<span class="m-r-20">
					购买采集商品数量：
					<b>0 条</b>
				</span>
                <span class="m-r-20">
					已使用：
					<b>0 条</b>
				</span>
                <span class="m-r-20">
					购买采集评论次数：
					<b>10 条</b>
				</span>
                <span class="m-r-20">
					已使用：
					<b>0 条</b>
				</span>
                <!-- -->
                {{--去购买
                <a class="btn btn-warning btn-sm" href="javascript:;">去购买</a>--}}
            </p>
        </div>
    </div>
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="key_word" name="key_word" class="form-control" type="text" placeholder="店铺ID/店铺名称/店主账号">
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
                            <option value="-1">全部</option>
                            <option value="0,0">自营零售商</option>
                            <option value="1-2,0">入驻零售商</option>

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
                <span data-total-record="true"></span>
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
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.collect.partials._list')

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
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });

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