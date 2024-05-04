{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20181020"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20180027"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/service/evaluate-buyer-list.html" method="get">
            <input type="hidden" name="tab_status" value="0">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>评价：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="desc_mark" class="form-control">
                            <option value="0">全部评价</option>
                            <option value="1">好评</option>
                            <option value="2">中评</option>
                            <option value="3">差评</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>评论内容：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="comment_desc" class="form-control">
                            <option value="0">全部评论</option>
                            <option value="1">有评论内容</option>
                            <option value="2">无评论内容</option>
                            <option value="3">有追加评论内容</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>回复状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select name="reply_desc" class="form-control">
                            <option value="0">全部</option>
                            <option value="1">待回复</option>
                            <option value="2">已回复</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="shop_name" class="form-control" type="text" placeholder="店铺名称/卖家账号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="goods_name" class="form-control" type="text" placeholder="商品ID/货号/条形码/名称">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>评价内容：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="comment_desc1" class="form-control" type="text" placeholder="评价内容">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="order_sn" class="form-control" type="text" placeholder="订单编号">
                    </div>
                </div>
            </div>

            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>评价时间：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="comment_time" class="form-control form_datetime" name="comment_time"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
                <label class="control-label m-l-10"> <input type="hidden" name="check_img" value="0"><input type="checkbox" class="checkBox va-sub m-r-5" name="check_img" value="1"> 只看有图片的评价 </label>
                <a id="searchMore" class="btn-link m-l-10">更多筛选条件</a>
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>评价列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
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
    <div class="item-list-hd">
        <ul class="item-list-tabs">
            <a href="javascript:void(0);" data-url="/trade/service/evaluate-buyer-list?type=un" class="evaluate-list">
                <li name="un" class="tabs-t current">待审核的评价</li>
            </a>
            <a href="javascript:void(0);" data-url="/trade/service/evaluate-buyer-list?type=del" class="evaluate-list">
                <li name="del" class="tabs-t last" title="">已删除的评价</li>
            </a>
            <a href="javascript:void(0);" data-url="/trade/service/evaluate-buyer-list?type=all" class="evaluate-list">
                <li name="all" class="tabs-t">全部评价</li>
            </a>
            <!--当前选中样式current，并且现只有“等待买家确认”，“等待发货”，“退款中”需要有个数提醒，其它没有；默认为近三个月订单-->
        </ul>
    </div>
    <!--列表内容-->
    <div class="table-responsive">
        <colgroup>
            <col class="w10" />
            <!--评价-->
            <col class="w80" />
            <!--评价内容-->
            <col class="w300" />
            <!--评价人-->
            <col class="w100" />
            <!--宝贝信息-->
            <col class="w120" />
            <!--卖家-->
            <col class="w80" />
            <!--操作-->
            <col class="w80" />
        </colgroup>

        {{--引入列表--}}
        @include('trade.service.partials._evaluate_buyer_list')

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

    <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20181020"/>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180027"></script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            // 加载时加入即时查询搜索条件
            tablelist = $("#table_list").tablelist({
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
            $('input:checkbox').change(function() {
                $("#searchForm").submit();
            });

            // ajax加载列表
            $(".evaluate-list").click(function() {
                tablelist = $("#table_list").tablelist({
                    url: $(this).data("url")
                });

                var data = $("#searchForm").serializeJson()

                tablelist.load(data);

                $(".item-list-tabs").find("li").removeClass("current");
                $(this).find("li").addClass("current");
            });
        });
    </script>
    <script>
        //图片弹窗
        hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.outlineType = 'rounded-white';
        hs.fadeInOut = true;
        hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                opacity: .75,
                position: 'bottom center',
                hideOnMouseOut: true
            }
        });
    </script>
    <!---->
    <script type='text/javascript'>
        $('.order-tr').each(function() {
            $(this).find('td:not(.tcheck,.handle)').click(function() {
                $(this).parents().addClass("active").siblings('.order-tr').removeClass('active');
                $(".order-content").not($(this).parents().next(".order-content")).hide();
                $(this).parents().next(".order-content").slideToggle(300);
            })
        });
    </script>
    <!---->
    <script type='text/javascript'>
        //批量替换文字
        $("body").on("click", "#btn-primary", function() {

            var id = getSelectCheckbox();
            if (id == false) {
                $.msg("请选择要修改的评论!");
                return false;
            } else {
                id = id.join(",");
                $.post('/trade/service/ajax-replace', {
                    id: id
                }, function(result) {
                    if (result.code == 0) {
                        $.open({
                            type: 1,
                            title: '替换文字', //样式类名
                            closeBtn: 1, //不显示关闭按钮
                            shadeClose: false, //开启遮罩关闭
                            area: ['620px', '320px'], //宽高
                            content: result.data
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON");
            }

        })
        //替换文字开始
        $("body").on("click", ".replace", function() {
            var id = $(this).data("id");
            $.post('/trade/service/ajax-replace', {
                id: id
            }, function(result) {
                if (result.code == 0) {
                    $.open({
                        type: 1,
                        title: '替换文字', //样式类名
                        closeBtn: 1, //不显示关闭按钮
                        shadeClose: false, //开启遮罩关闭
                        area: ['620px', '320px'], //宽高
                        content: result.data
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON");
        })
        //获取当前选择要替换的ID
        function getSelectCheckbox() {
            var id = new Array;
            var int = 0;
            $("#table_list").children("tbody").children("tr").each(function() {
                if ($(this).hasClass("active")) {
                    id[int] = $(this).attr("name");
                    int++;
                }
            });
            return id.length > 0 ? id : false;
        }
        //文字替换请求
        function ajaxImport(setting) {
            closePop()
            $.post('/trade/service/replace', {
                setting: setting
            }, function(result) {
                tablelist.load();
                layer.closeAll("loading");
                $.go(window.location.href);
                $.msg(result.message);
            }, "JSON");
        }
        function closePop() {
            $.closeAll()
        }
    </script>
    <script type='text/javascript'>
        $("body").on("click", ".hiddens,.refuse,.is_pass,.is_show", function() {
            var tip = "";
            var btn = "";

            switch ($(this).attr("class")) {
                case "del hiddens":
                    tip = "删除";
                    btn = "hidden";
                    break;
                case "refuse del":
                    tip = "拒绝";
                    btn = "refuse";
                    break;
                case "is_pass":
                    tip = "通过";
                    btn = "pass";
                    break;
                case "is_show":
                    tip = "显示";
                    btn = "show";
                    break;
            }

            var id = $(this).data("id");

            $.confirm("是否" + tip + "选定内容？", function(s) {
                $.loading.start();

                $.ajax({
                    type: 'GET',
                    url: '/trade/service/operation?btn=' + btn + '&type=un&id=' + id,
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1500
                            }, function() {
                                tablelist.load();
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                }).always(function() {
                    $.loading.stop();
                });
            });
        })
    </script>

    <script type='text/javascript'>
        //批量
        $(function() {
            $("body").on("click", "#hiddens,#shows,#refuse", function() {
                var tip = "";
                var select = $(this).attr("id");
                switch (select) {
                    case "hiddens":
                        tip = "删除";
                        break;
                    case "shows":
                        tip = "显示";
                        break;
                    case "refuse":
                        tip = "拒绝";
                        break;

                }

                var ids = [];
                $("#table_list").children("tbody").children("tr").each(function() {
                    if ($(this).hasClass("active")) {
                        ids.push($(this).attr("name"));
                    }
                });

                if (ids.length == 0) {
                    $.msg("至少选择一个评价进行操作");
                    return;
                }

                $.confirm("是否批量" + tip + "选定内容？", function(s) {
                    if (s) {
                        var tab;
                        $(".item-list-tabs").children("a").each(function() {
                            if ($(this).children().hasClass("current")) {
                                tab = $(this).children().attr("name");
                            }
                        });

                        $.loading.start();

                        $.ajax({
                            type: 'GET',
                            url: '/trade/service/batch-operation?btn=' + select + '&type=un&id=' + ids.join(","),
                            dataType: 'json',
                            success: function(result) {
                                if (result.code == 0) {
                                    $.msg(result.message, {
                                        time: 1500
                                    }, function() {
                                        tablelist.load();
                                    });
                                } else {
                                    $.msg(result.message, {
                                        time: 5000
                                    });
                                }
                            }
                        }).always(function() {
                            $.loading.stop();
                        });
                    }
                })
            })
        })
    </script>
    <script type='text/javascript'>
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2, // 只选年月日
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd'
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop