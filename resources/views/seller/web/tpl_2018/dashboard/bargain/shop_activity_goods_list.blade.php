{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=2.0" rel="stylesheet">
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20190319"/>

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')
    <!-- 搜索条件 -->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/dashboard/bargain/shop-activity-goods-list" method="GET">
            <input type="hidden" name="act_id" value="{{ $act_id }}">
            <div class="simple-form-field toggle">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品信息：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="keyword_type" class="form-control w120 m-r-2">
                            <option value="goods_name">商品名称</option>
                            <option value="goods_id">商品ID</option>
                            <option value="goods_sn">商品货号</option>
                            <option value="goods_barcode">商品条码</option>
                        </select>
                        <input type="text" name="keyword" class="form-control" value="" placeholder="商品关键词"/>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>状态：</span>
                    </label>
                    <div class="form-control-wrap"><select id="is_enable" class="form-control" name="is_enable">
                            <option value="">全部</option>
                            <option value="1">有效</option>
                            <option value="0">已取消</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索"/>
                <!--<a id="searchMore" class="btn-link">更多筛选条件</a> -->
            </div>
        </form>
    </div>
    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>
            <h5>
                (&nbsp;共
                <span data-total-record=true class="pagination-total-record">0</span>
                条记录&nbsp;)
            </h5>
        </div>
    </div>
    <div class="table-responsive" style="overflow: visible !important;">
        {{--引入列表--}}
        @include('dashboard.bargain.partials._shop_activity_goods_list')
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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=202003261806"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=202003261806"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=202003261806"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/activity.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=1.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $().ready(function() {
            var page_id = "pagination";
            $("#"+page_id+" > .pagination-goto > .goto-input").keyup(function(e) {
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $("#"+page_id+" > .pagination-goto > .goto-link").click();
                }
            });
            $("#"+page_id+" > .pagination-goto > .goto-button").click(function() {
                var page = $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $("#"+page_id+" > .pagination-goto > .goto-link").attr("data-go-page", page);
                $("#"+page_id+" > .pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        var activity_goods_table_list = null;
        function message(message){
            $.msg(message)
        }
        $().ready(function () {
            // popover弹框
            $("[data-toggle='popover']").popover();
            $(".goods-qrcode").each(function () {
                $(this).qrcode({
                    render: "canvas",
                    width: 120,
                    height: 120,
                    text: encodeURI($(this).data("url"))
                });
            });
            function lazyload() {
                // 图片懒加载
                $("img.lazy").lazyload({
                    skip_invisible: false,
                    effect: 'fadeIn',
                    failurelimit: $.imgloading.settings.failurelimit,
                    threshold: $.imgloading.settings.threshold,
                    data_attribute: $.imgloading.settings.data_attribute,
                    load: function () {
                        $(this).removeClass('lazy');
                        // 删除背景图片
                        $(this).parent('a').css("background", "");
                    }
                });
            }
            activity_goods_table_list = $("#table_list").tablelist({
                // 支持保存查询条件
                params: $("#searchForm").serializeJson(),
                callback: function () {
                    $(".goods-qrcode").each(function () {
                        $(this).qrcode({
                            render: "canvas",
                            width: 120,
                            height: 120,
                            text: encodeURI($(this).data("url"))
                        });
                    });
                    lazyload();
                    // 重载
                    activityGoodsList.reload();
                }
            });
            var activityGoodsList = $.activityGoodsList({
            });
            // 搜索
            $("#searchForm").submit(function () {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                activity_goods_table_list.reload(data);
                // 阻止表单提交
                return false;
            });
            // 批量删除
            $("body").on('click', '.set-disabled', function () {
                //
                // 如果禁止则禁止点击
                if($(this).hasClass("disabled")) {
                    return;
                }
                var ids = $(this).data("id");
                if (ids != undefined) {
                    ids = [ids];
                } else {
                    ids = activity_goods_table_list.checkedValues();
                    if (ids.length == 0) {
                        $.msg("您没有选择任何待处理的数据！");
                        return;
                    }
                }
                function setDisabled() {
                    $.loading.start();
                    $.post('disable-activity-goods', {
                        act_id: "{{ $act_id }}",
                        ids: ids.join(",")
                    }, function (result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1500
                            }, function () {
                                activity_goods_table_list.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON").always(function () {
                        $.loading.stop();
                    });
                };
                var messsage = "您确定要取消选中的活动商品吗？";
                $.confirm(messsage, function () {
                    setDisabled();
                });
            });
            // 批量设置自砍比例
            $("body").on('click','.batch-set-bargain',function(){
                var ids = activity_goods_table_list.checkedValues();
                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                $.open({
                    title: '批量设置自砍比例',
                    type: 1,
                    width: '580px',
                    height: '260px',
                    ajax: {
                        url: '/dashboard/bargain/batch-set-bargain',
                        data: {
                            ids:ids
                        }
                    },
                    btn: '确认',
                    yes: function(index, container) {
                        var self_cut_ratio = $("#self_cut_ratio").val();
                        var ids = $("#self_cut_ratio").data('ids');
                        if(self_cut_ratio == null || self_cut_ratio == '' || self_cut_ratio == undefined)
                        {
                            $.msg('自砍比例不能为空！',{
                                time:2000
                            });
                            return;
                        }
                        if(self_cut_ratio < 0 || self_cut_ratio > 100)
                        {
                            $.msg('自砍比例应在0~100之间！',{
                                time:2000
                            });
                            return;
                        }
                        if(Number.isInteger(Number(self_cut_ratio)) == false)
                        {
                            $.msg('自砍比例必须是整数！',{
                                time:2000
                            });
                            return;
                        }
                        $.post('/dashboard/bargain/batch-set-bargain',{
                            self_cut_ratio:self_cut_ratio,
                            ids:ids
                        },function(result){
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 1500
                                }, function() {
                                    activity_goods_table_list.load()
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                            layer.close(index);
                        },'json')
                    }
                });
            })
            //
            //
        });
        //
        var submitEventName = "szy.add.activity.goods.submit";
        var beforeSubmitEventName = "szy.add.activity.goods.before_submit";
        var submitSuccessEventName = "szy.add.activity.goods.submit_success";
        $(function () {
            // 添加活动商品
            $("#btn_add_activity_goods").click(function () {
                $.loading.start();
                $.open({
                    title: "添加活动商品",
                    type: 1,
                    width: Math.min($(window).width() - 50, 1200),
                    height: $(window).height() - 50,
                    success: function () {
                        $.loading.stop();
                    },
                    ajax: {
                        url: "add-activity-goods",
                        data: {
                            'act_id': "{{ $act_id }}"
                        }
                    },
                    btn: ["确认提交", "取消"],
                    yes: function (index, obj) {
                        $(window).on(submitSuccessEventName, function (event) {
                            $.closeDialog(index);
                        });
                        $(window).trigger(submitEventName);
                    }
                });
            });
        });
        //
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop