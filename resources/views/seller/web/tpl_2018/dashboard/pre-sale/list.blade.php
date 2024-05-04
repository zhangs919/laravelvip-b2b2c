{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <!--在这里调用内容-->
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=2.0"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=2.0"/>
    <!-- 日历控件-->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180919"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180919"></script>
    <!-- -->
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20180919"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=2.0"/>
@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/pre-sale/list" method="GET">

            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">

                        <input type="text" name="keyword" class="form-control w180" value="" placeholder="商品名称/商品编号" />
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>预售类型：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="chosen-select" name="pre_sale_mode">
                            <option value="0">全部</option>
                            <option value="1">定金预售</option>
                            <option value="2">全款预售</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>预售时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="start_time" class="form-control form_datetime ipt pull-none" name="start_time" value="" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="end_time" class="form-control form_datetime ipt pull-none" name="end_time" placeholder="结束时间">
                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>活动状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="chosen-select" name="is_finish">
                            <option value="-1">全部</option>
                            <option value="0">未开始</option>
                            <option value="1">进行中</option>
                            <option value="2">已结束</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="chosen-select" name="status">
                            <option value="-1">全部</option>
                            <option value="0">待审核</option>
                            <option value="1">审核通过</option>
                            <option value="2">审核未通过</option>
                        </select></div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>预售活动商品列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom" title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>



        </div>
    </div>
    <!-- 分类列表 -->
    <div class="table-responsive" style="overflow: visible;">

        {{--引入列表--}}
        @include('dashboard.pre-sale.partials._list')

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

    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180919"></script>
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

            $("body").on("mouseover", ".QR-code", function() {
                if ($(this).data("loading")) {
                    return;
                }
                var target = $(this).find("img");
                var src = $(target).data("src");
                var img = new Image();
                img.src = src;
                img.onload = function() {
                    $(target).attr("src", src);
                };
                $(this).data("loading", true);
            });

            $("body").on('click', '.end', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定结束这个活动吗？',
                    url: 'end',
                    data: {
                        id: id
                    }
                });
            });

            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });

            // 批量删除
            $("body").on("click", ".batch-del", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'batch-delete',
                    data: {
                        ids: ids
                    }
                });
            });

            // 查看SKU信息
            $("body").on("click", ".sku-list", function() {
                var goods_id = $(this).data("goods_id");
                var pre_sale_mode = $(this).data('pre_sale_mode');
                var act_id = $(this).data('act_id');
                $.loading.start();

                $.open({
                    title: "预售商品 #" + goods_id + " 的SKU列表",
                    ajax: {
                        url: '/dashboard/pre-sale/sku-list-edit',
                        data: {
                            goods_id: goods_id,
                            pre_sale_mode: pre_sale_mode,
                            act_id: act_id
                        }
                    },
                    width: "980px",
                    end: function(index, object) {
                        // 判断SKU信息是否发生变化
                        if ($(document).data("sku-change")) {
                            tablelist.load();
                        }
                        $(document).data("sku-change", false);
                    }
                });
            });

            $("body").on("mouseover", ".reason", function() {
                $.tips($(this).data("reason"), $(this));
            });

            $("body").on("mouseout", ".reason", function() {
                $.closeAll("tips");
            });
        });
    </script>

    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2, // 精确度：默认为时分秒，2：年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd',
        });
        $('#start_time').datetimepicker().on('changeDate', function(ev) {
            $('#end_time').datetimepicker('setStartDate', ev.date);
        });
        $('#end_time').datetimepicker().on('changeDate', function(ev) {
            $('#start_time').datetimepicker('setEndDate', ev.date);
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop