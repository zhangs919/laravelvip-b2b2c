{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
    <link href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

    <div class="rating m-b-10">
        <h4 class="">
            <i class="ico-shop"></i>
            店铺近{{ $month }}个月内动态评分
        </h4>
        <div class="table-responsive">
            <table class="table rate-info m-b-10 ">
                <colgroup>
                    <!--评分名称-->
                    <col class="w120" />
                    <!--评分-->
                    <col class="w180" />
                    <!--几人参与打分-->
                    <col class="w90" />
                    <!--评分图-->
                    <col class="w300" />
                    <!--分数-->
                    <col class="w80" />
                    <!--态度-->
                    <col class="w80" />
                    <!--结果-->
                    <col class="w100" />
                </colgroup>
                <tr>
                    <td class="text-l p-t-0 b-n" colspan="7"></td>
                </tr>
                <tr>
                    <td>店铺综合评分</td>
                    <td>
                        <span class="star-icon">
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                        </span>
                        <strong class="m-l-5 m-r-5">{{ $sum['sum'] }}</strong>
                        分
                    </td>
                    <td></td>
                    <!--var的值，需要百分比来算，1分代表20%，2分代表40%，3分代表60%，4分代表80%，5分代表100%；-->
                    <td class="graph">
                        <div class="scroller">
                            <p>
                                <span class="var-1" style='margin-left: {{ $sum['sum_left'] }}%;'>
                                    <em>{{ $sum['sum'] }}</em>
                                </span>
                            </p>
                        </div>
                    </td>

                    <td>1 分</td>
                    <td>非常不满</td>
                    <td>
                        <a class="score-icon icon-2 m-r-5"></a>
                        差评
                    </td>
                </tr>
                <tr>
                    <td>宝贝与描述相符</td>
                    <td>
                        <span class="star-icon">
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                        </span>
                        <strong class="m-l-5 m-r-5">{{ $sum['desc'] }}</strong>
                        分
                    </td>
                    <td>1 人打分</td>
                    <!--var的值，需要百分比来算，1分代表20%，2分代表40%，3分代表60%，4分代表80%，5分代表100%；-->
                    <td class="graph">
                        <div class="scroller">
                            <p>
                                <span class="var-2" style='margin-left: {{ $sum['desc_left'] }}%;'>
                                    <em>{{ $sum['desc'] }}</em>
                                </span>
                            </p>
                        </div>
                    </td>
                    <td>2 分</td>
                    <td>不满意</td>
                    <td>
                        <a class="score-icon icon-2 m-r-5"></a>
                        差评
                    </td>
                </tr>
                <tr>
                    <td>卖家的服务态度</td>
                    <td>
                        <span class="star-icon">
                            <i class="icon-0"></i>
                            <!-- -->
                            <i class="icon-0"></i>
                            <!-- -->
                            <i class="icon-0"></i>
                            <!-- -->
                            <i class="icon-0"></i>
                            <!-- -->
                            <i class="icon-0"></i>
                            <!-- -->
                        </span>
                        <strong class="m-l-5 m-r-5">{{ $sum['shop_service'] }}</strong>
                        分
                    </td>
                    <td>1 人打分</td>
                    <!--var的值，需要百分比来算，1分代表20%，2分代表40%，3分代表60%，4分代表80%，5分代表100%；-->
                    <td class="graph">
                        <div class="scroller">
                            <p>
                                <span class="var-3" style='margin-left: {{ $sum['service_left'] }}%;'>
                                    <em>{{ $sum['shop_service'] }}</em>
                                </span>
                            </p>
                        </div>
                    </td>
                    <td>3 分</td>
                    <td>一般</td>
                    <td>
                        <a class="score-icon icon-1 m-r-5"></a>
                        中评
                    </td>
                </tr>
                <tr>
                    <td>卖家的发货速度</td>
                    <td>
                        <span class="star-icon">
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                        </span>
                        <strong class="m-l-5 m-r-5">{{ $sum['shop_speed'] }}</strong>
                        分
                    </td>
                    <td>1 人打分</td>
                    <!--var的值，需要百分比来算，1分代表20%，2分代表40%，3分代表60%，4分代表80%，5分代表100%；-->
                    <td class="graph">
                        <div class="scroller">
                            <p>
                                <span class="var-4" style='margin-left: {{ $sum['speed_left'] }}%;'>
                                    <em>{{ $sum['shop_speed'] }}</em>
                                </span>
                            </p>
                        </div>
                    </td>
                    <td>4 分</td>
                    <td>满意</td>
                    <td>
                        <a class="score-icon icon-0 m-r-5"></a>
                        好评
                    </td>
                </tr>
                <tr>
                    <td>物流公司的服务</td>
                    <td>
                        <span class="star-icon">
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                            <i class="icon-0"></i>
                        </span>
                        <strong class="m-l-5 m-r-5">{{ $sum['logistics_speed'] }}</strong>
                        分
                    </td>
                    <td>1 人打分</td>
                    <!--var的值，需要百分比来算，1分代表20%，2分代表40%，3分代表60%，4分代表80%，5分代表100%；-->
                    <td class="graph">
                        <div class="scroller">
                            <p>
                                <span class="var-5" style='margin-left: {{ $sum['logistics_left'] }}%;'>
                                    <em>{{ $sum['logistics_speed'] }}</em>
                                </span>
                            </p>
                        </div>
                    </td>
                    <td>5 分</td>
                    <td>非常满意</td>
                    <td>
                        <a class="score-icon icon-0 m-r-5"></a>
                        好评
                    </td>
                </tr>
                <tr>
                    <td class="text-l p-t-0 b-n" colspan="3">（物流公司的服务不会计入店铺综合评分）</td>
                    <td class="pull-right">
                        <div style="width: 340px;">
                            <span class="score">
                                <em>1</em>
                                分
                            </span>
                            <span class="score">
                                <em>2</em>
                                分
                            </span>
                            <span class="score">
                                <em>3</em>
                                分
                            </span>
                            <span class="score">
                                <em>4</em>
                                分
                            </span>
                            <span class="score">
                                <em>5</em>
                                分
                            </span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </table>
        </div>
    </div>


    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/trade/service/evaluate-shop-list.html" method="get">
            <input type="hidden" name="status" value="1">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>订单编号：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="order_sn" class="form-control" type="text"/>
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle">
                <div class="form-group">
                    <label class="control-label">
                        <span>评价时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="comment_time" class="form-control form_datetime " name="comment_time">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary" value="搜索">
            </div>
        </form>
    </div>
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
            <li name="review" class="tabs-t current">
                <a href="javascript:void(0);" data-url="/trade/service/evaluate-shop-list?type=un&status=1"
                   class="evaluate-list">
                    待审核的评价</a>
            </li>
            <li name="deleted" class="tabs-t">
                <a href="javascript:void(0);" data-url="/trade/service/evaluate-shop-list?type=del&status=1"
                   class="evaluate-list">已删除的评价</a>
            </li>
            <li name="evaluation" class="tabs-t last">
                <a href="javascript:void(0);" data-url="/trade/service/evaluate-shop-list?type=all&status=1"
                   class="evaluate-list">已显示的评价</a>
            </li>
        </ul>
    </div>
    <!--列表内容-->
    <div class="table-responsive" style="overflow: visible;">
        {{--引入列表--}}
        @include('trade.service.partials._evaluate_shop_list')
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

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script>
        $().ready(function () {
            $(".pagination-goto > .goto-input").keyup(function (e) {
                $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                if (e.keyCode == 13) {
                    $(".pagination-goto > .goto-link").click();
                }
            });
            $(".pagination-goto > .goto-button").click(function () {
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
        var tablelist = null;
        $().ready(function () {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function () {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                console.info(data);
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
            // ajax加载列表
            $(".evaluate-list").click(function () {
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
        $(function () {
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
        });
    </script>
@stop
