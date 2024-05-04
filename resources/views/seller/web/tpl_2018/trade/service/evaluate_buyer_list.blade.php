{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/highslide.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <div class="rating m-b-10">
        <h4 class="">
            <i class="ico-seller"></i>
            卖家积累信用：
            <strong>{{ $count['rank_num'] }}分</strong>
            <img src="{{ $count['rank'] }}" class="rank m-l-10" title="{{ $count['rank_name'] }}" />
        </h4>
        <span class="rate-summary pull-right">
            好评率：
            <strong>{{ $count['per_best_one'] }}%</strong>
        </span>
        <div class="table-responsive">
            <table class="table table-bordered m-b-10">
                <thead>
                <tr>
                    <th></th>
                    <th>最近一周</th>
                    <th>最近1个月</th>
                    <th>最近3个月</th>
                    <th>最近6个月</th>
                    <th>6个月前</th>
                    <th>总计</th>
                </tr>
                </thead>
                <tr>
                    <td>
                        <a class="score-icon icon-0 m-r-5"></a>
                        好评
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">1</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">1</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="score-icon icon-1 m-r-5"></a>
                        中评
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="score-icon icon-2 m-r-5"></a>
                        差评
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                </tr>
                <tr>
                    <td>总计</td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">1</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">0</font>
                    </td>
                    <td>
                        <font class="c-blue">1</font>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/service/evaluate-buyer-list.html" method="GET">
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
                    <div class="form-control-wrap"><input type="text" id="comment_time" class="form-control form_datetime " name="comment_time"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
                <label class="control-label m-l-10"> <input type="hidden" name="check_img" value="0"><input type="checkbox" class="checkBox va-sub m-r-5" name="check_img" value="1"> 只看有图片的评价 </label>
                <a id="searchMore" class="btn-link m-l-10">更多筛选条件</a>
            </div>
        </form>    </div>
    <div id="ajax_con">
        <div class="common-title">
            <div class="ftitle">
                <h3>评价列表</h3>
                <h5>
                    (&nbsp;共
                    <span data-total-record="true" class="pagination-total-record">0</span>
                    条记录&nbsp;)
                </h5>
            </div>
        </div>
        <div class="item-list-hd">
            <ul class="item-list-tabs">
                <li name="review" class=" current">
                    <a href="javascript:void(0);" data-url="/trade/service/evaluate-buyer-list?type=un" class="evaluate-list">待审核的评价</a>
                </li>
                <li name="deleted" class="">
                    <a href="javascript:void(0);" data-url='/trade/service/evaluate-buyer-list?type=del' class="evaluate-list">已删除的评价</a>
                </li>
                <li name="evaluation" class=" last">
                    <a href="javascript:void(0);" data-url='/trade/service/evaluate-buyer-list?type=all' class="evaluate-list">已显示的评价</a>
                </li>
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
                <!--操作-->
                <col class="w100" />
            </colgroup>
            <div id="table_comment">
                {{--引入列表--}}
                @include('trade.service.partials._evaluate_buyer_list')
            </div>
        </div>
    </div>

    


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

    <!--回复-->
    <div style="display: none">
        <div id="replay_content" class="table-content clearfix">
            <form class="form-horizontal">
                <textarea id="res" class="form-control comment-content" placeholder="" rows="6"></textarea>
            </form>
            <div class="modal-footer m-t-10">
                <input id="confirm" class="btn btn-primary" type="button" value="确定">
                <input id="cancel" class="btn btn-default" type="button" value="取消">
            </div>
        </div>
    </div>
    <!-- 图片弹窗  star-->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 图片弹窗  end-->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $().ready(function() {
            $(".pagination-goto > .goto-input").keyup(function(e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function() {
                var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                if ($.trim(page) == '') {
                    return false;
                }
                $(".pagination-goto > .goto-link").attr("data-go-page", page);
                $(".pagination-goto > .goto-link").click();
                return false;
            });
        });
        //
        /*$('.order-tr').each(function() {
            $(this).find('td:not(.tcheck,.handle)').click(function() {
                $(this).parents().addClass("active").siblings('.order-tr').removeClass('active');
                $(".order-content").not($(this).parents().next(".order-content")).hide();
                $(this).parents().next(".order-content").slideToggle(300);
            })
        });*/
        //
        var tablelist = null;
        $().ready(function() {
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
            // ajax加载列表
            $(".evaluate-list").click(function() {
                tablelist = $("#table_list").tablelist({
                    url: $(this).data("url")
                });
                var data = $("#searchForm").serializeJson()
                tablelist.load(data);
                $(".item-list-tabs").find("li").removeClass("current");
                $(this).parents("li").addClass("current");
            });
        });
        //
        $("body").on("click", ".review_content", function() {
            $(this).parents().parents().next(".order-content").slideToggle(300);
        })
        //
        $(function(){
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
        })
        //
        $().ready(function() {
            $("body").on("click", ".comment", function() {
                var reply = $(this);
                var id = $(this).data("id");
                var modal = $.modal({
                    title: "回复内容",
                    width: 480,
                    content: $("#replay_content").prop("outerHTML")
                });
                $("body").on("click", "#confirm", function() {
                    var text = $(modal.container).find(".comment-content").val();
                    if (text.trim() == "") {
                        $.msg("请输入回复内容");
                        return;
                    }
                    if (text.length > 400) {
                        $.msg("允许最多输入400个字符，您已经超出");
                        return;
                    } else {
                        $.loading.start();
                        $(this).attr("btn", true);
                        $.get('/trade/service/reply?id=' + id + '&content=' + text, function(result) {
                            modal.hide();
                            $.msg(result.message, function(){
                                tablelist.load();
                            })
                        }, 'json').always(function() {
                            $.loading.stop();
                        });
                    }
                })
                $("body").on("click", "#cancel", function() {
                    modal.hide();
                })
            })
            $("body").on("click", "button[class='btn btn-danger mr5']", function() {
                var arr = new Array();
                var int_num = 0;
                $("#table_list").children("tbody").children("tr").each(function() {
                    if ($(this).hasClass("active")) {
                        arr[int_num] = $(this).attr("name");
                        int_num++;
                    }
                })
                if (int_num > 0) {
                    $("#replay_content").css('display', 'block');
                    var modal = $.modal({
                        title: "回复内容",
                        width: 500,
                        content: $("#replay_content").prop("outerHTML")
                    });
                    $("body").on("click", "#confirm", function() {
                        var text = $(modal.container).find(".comment-content").val();
                        if (text == "") {
                            $.msg("请输入回复内容");
                            return;
                        }
                        if (text.length > 400) {
                            $.msg("允许最多输入400个字符，您已经超出");
                            return;
                        } else {
                            $.loading.start();
                            $(this).attr("btn", true);
                            $.get('/trade/service/reply?id=' + arr + '&content=' + text, function(result) {
                                modal.hide();
                                $.msg(result.message, function(){
                                    tablelist.load();
                                })
                            }, 'json').always(function() {
                                $.loading.stop();
                            });
                        }
                    })
                    $("body").on("click", "#cancel", function() {
                        modal.hide();
                    })
                } else {
                    $.msg("至少选择一个评价进行操作")
                }
            })
        });
        //
        $(function(){
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
        })
    </script>
@stop
