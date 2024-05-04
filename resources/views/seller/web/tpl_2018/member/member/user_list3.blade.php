{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <!---->
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <!-- -->
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <!-- -->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>
@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/member/member/user-list.html" method="GET">
            <input type="hidden" name="type" value="3">
            <input type="hidden" name="order" value="3">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="user_name" class="form-control" name="user_name" placeholder="会员名称/手机号/邮箱"></div>
                </div>
            </div>
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>收录客户时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="collect_begin" class="form-control form_datetime ipt" name="collect_begin" placeholder="不限">

                        <span class="ctime">至</span>
                        <input type="text" id="collect_end" class="form-control form_datetime ipt" name="collect_end" placeholder="不限">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn  btn-primary m-r-5" type="submit">搜索</button>
                <input type="button" id="btn_export" class="btn btn-default m-r-5" data-type="3" data-order="3" value="导出" />
            </div>
        </form>
    </div>
    <!-- -->

    <div class="common-title">
        <div class="ftitle">
            <h3>其他客户列表</h3>

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
    <!---->

    <!--列表内容-->
    <div class="table-responsive">
        <!---->
        {{--引入列表--}}
        @include('member.member.partials._user_list3')
        <!---->
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
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180027"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180027"></script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {

            tablelist = $("#table_list").tablelist({
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
            $("#btn_export").click(function() {
                var type = $(this).data("type");
                var order = $(this).data("order");
                var user_name = typeof ($("#user_name").val()) == "undefined" ? '' : $("#user_name").val();
                var shop_rank_id = typeof ($("#shop_rank_id").val()) == "undefined" ? '' : $("#shop_rank_id").val();
                var tradin_min = typeof ($("#tradin_min").val()) == "undefined" ? '' : $("#tradin_min").val();
                var tradin_max = typeof ($("#tradin_max").val()) == "undefined" ? '' : $("#tradin_max").val();
                var tradin_count_min = typeof ($("#tradin_count_min").val()) == "undefined" ? '' : $("#tradin_count_min").val();
                var tradin_count_max = typeof ($("#tradin_count_max").val()) == "undefined" ? '' : $("#tradin_count_max").val();
                var begin = typeof ($("#begin").val()) == "undefined" ? '' : $("#begin").val();
                var end = typeof ($("#end").val()) == "undefined" ? '' : $("#end").val();
                var birthday = typeof ($("#birthday").val()) == "undefined" ? '' : $("#birthday").val();
                var sex = typeof ($("#sex").val()) == "undefined" ? '' : $("#sex").val();
                var receive_address = typeof ($("#receive_address").val()) == "undefined" ? '' : $("#receive_address").val();
                var close_begin = typeof ($("#close_begin").val()) == "undefined" ? '' : $("#close_begin").val();
                var close_end = typeof ($("#close_end").val()) == "undefined" ? '' : $("#close_end").val();
                var collect_begin = typeof ($("#collect_begin").val()) == "undefined" ? '' : $("#collect_begin").val();
                var collect_end = typeof ($("#collect_end").val()) == "undefined" ? '' : $("#collect_end").val();

                var url = "/member/member/export.html";
                url += "?type=" + type;
                url += "&order=" + order;
                url += "&user_name=" + user_name;
                url += "&shop_rank_id=" + shop_rank_id;
                url += "&tradin_min=" + tradin_min;
                url += "&tradin_max=" + tradin_max;
                url += "&tradin_count_min=" + tradin_count_min;
                url += "&tradin_count_max=" + tradin_count_max;
                url += "&begin=" + begin;
                url += "&end=" + end;
                url += "&birthday=" + birthday;
                url += "&sex=" + sex;
                url += "&receive_address=" + receive_address;
                url += "&close_begin=" + close_begin;
                url += "&close_end=" + close_end;
                url += "&collect_begin=" + collect_begin;
                url += "&collect_end=" + collect_end;

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }

                $.go(url, null, false);
            });
        });
    </script>
    <script type='text/javascript'>
        $("#region_container").regionselector({
            select_class: "form-control",
            change: function(value, names, is_last) {
                $("#receive_address").val(value);
            }
        });
    </script>
    <script type='text/javascript'>
        $().ready(function() {
            // 备注
            $("body").on("click", ".edit-desc", function() {
                var id = $(this).data("id");
                var tablelist = $("#table_list").tablelist();
                $.open({
                    title: "备注",
                    ajax: {
                        url: '/member/member/edit-desc.html',
                        data: {
                            id: id
                        }
                    },
                    width: "600px",
                    btn: ['确定', '取消'],
                    yes: function(index, container) {

                        var data = $(container).serializeJson();
                        var value = $("#user_remark").val().trim();
                        if (value == "") {
                            $("#error").show();
                            return;
                        }
                        $.loading.start();
                        $.post('/member/member/edit-desc.html', data, function(result) {
                            $.loading.stop();
                            if (result.code == 0) {
                                $.msg(result.message);
                                tablelist.load();
                                layer.close(index);
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                })
                            }
                        }, "json");
                    }
                });
            });
            $("body").on("click", ".add-to-erp", function() {
                var id = $(this).data("id");
                var tablelist = $("#table_list").tablelist();

                $.loading.start();
                $.post('/member/member/add-to-erp.html', {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        tablelist.load();
                        $.msg(result.message);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        })
                    }
                }, "json");
            });
        });
    </script>
    <script type='text/javascript'>
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
    </script>
    <!-- -->
    <script type='text/javascript'>
        $().ready(function() {
            // 图片懒加载
            $("img.lazy").lazyload({
                skip_invisible: false,
                effect: 'fadeIn',
                failurelimit: $.imgloading.settings.failurelimit,
                threshold: $.imgloading.settings.threshold,
                data_attribute: $.imgloading.settings.data_attribute,
                load: function() {
                    $(this).removeClass('lazy');
                    // 删除背景图片
                    $(this).parent('a').css("background", "");
                    if ($(this).hasClass('square')) {
                        if ($(this).height() != $(this).width()) {
                            $(this).height($(this).width());
                        } else {
                            $(this).removeClass('square');
                        }
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop