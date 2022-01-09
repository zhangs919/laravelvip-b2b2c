{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20180702"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=201807241613"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=201807241613"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js?v=201807241613"></script>
    <script src="/js/chart.js?v=201807241613"></script>
    <script src="/js/chart-data.js?v=201807241613"></script>
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=201807241613"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/finance/industry-analyse/index.html" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt pull-none" name="from">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt pull-none" name="to">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="inline-item date active" href="javascript:void(0);">今天</a>
                <em class="ft-bar">|</em>
                <span class="inline-text">最近：</span>
                <a class="inline-item date" href="javascript:void(0);">1个月</a>
                <a class="inline-item date" href="javascript:void(0);">3个月</a>
                <a class="inline-item date" href="javascript:void(0);">1年</a>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品分类：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control chosen-select" id="cat_id1" name="cat_id1">
                            <option value="0">所有分类</option>

                            <option value="604">文学</option>

                            <option value="271">生鲜食品</option>

                            <option value="16">2018</option>

                            <option value="269">食品饮料</option>

                            <option value="1">家用电器</option>

                            <option value="3">电脑办公</option>

                            <option value="2">手机数码</option>

                            <option value="12">男装</option>

                            <option value="4">个护化妆</option>

                            <option value="226">箱包鞋帽</option>

                            <option value="233">童装童鞋</option>

                            <option value="270">酒水</option>

                            <option value="274">家居家装</option>

                            <option value="595"> 饮料/酒水/冲饮</option>

                            <option value="596"> 酒类 </option>

                            <option value="597"> 白酒 </option>

                            <option value="598"> 啤酒 </option>

                            <option value="599"> 葡萄酒 </option>

                            <option value="600"> 黄酒 </option>

                            <option value="601"> 洋酒 </option>

                            <option value="602"> 其他酒类 </option>

                            <option value="603"> 保健酒 </option>

                            <option value="605">教辅</option>

                            <option value="606">畅销</option>

                            <option value="607"> 接口抓取</option>

                            <option value="608"> 进口商品</option>

                            <option value="614">化药生物</option>

                        </select>
                    </div>
                    <div class="form-control-wrap show_cat_id2" style="display: none;">
                        <select class="form-control chosen-select" id="cat_id2" name="cat_id2">
                            <option value="0">所有分类</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>

                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" />

            </div>
        </form>
    </div>
    <div class="table-content m-t-30 clearfix">
        <h5 class="m-b-10 m-t-0">行业分析概况</h5>
        <div class="item-list-hd">
            <ul class="item-list-tabs">
                <li class="tabs-t current">
                    <a class="sel-t" data-tab="1" href="javascript:void(0);">下单金额</a>
                </li>
                <li class="tabs-t">
                    <a class="sel-t" data-tab="2" href="javascript:void(0);">下单量</a>
                </li>
                <li class="tabs-t last">
                    <a class="sel-t" data-tab="3" href="javascript:void(0);">下单商品数</a>
                </li>
            </ul>
        </div>

        <div class="module-content m-t-10 ">
            <div class="chart" id="canvas-order-amount" style="width: 95%; height: 600px; margin: auto;"></div>
        </div>
        <div class="module-content m-t-10">
            <div class="chart" id="canvas-order-count" style="width: 95%; height: 600px; margin: auto; display: none;"></div>
        </div>
        <div class="module-content m-t-10">
            <div class="chart" id="canvas-goods-count" style="width: 95%; height: 600px; margin: auto; display: none;"></div>
        </div>

        <script type="text/javascript">
            $().ready(function() {

                $(".sel-t").click(function() {
                    $(".tabs-t").removeClass("current");
                    $(this).parent().addClass("current");

                    var tab = $(this).data("tab");
                    $(".chart").hide();
                    if (tab == 1) {
                        $("#canvas-order-amount").show();
                        init_order_amount();
                    } else if (tab == 2) {
                        $("#canvas-order-count").show();
                        init_order_count();
                    } else if (tab == 3) {
                        $("#canvas-goods-count").show();
                        init_goods_count();
                    }
                });
                function init_order_amount() {

                    var begin_date = $("#from").val();
                    var end_date = $("#to").val();
                    var url = "/finance/industry-analyse/industry-data";
                    url += '?type=order_amount';
                    url += '&from=' + $("#from").val();
                    url += '&to=' + $("#to").val();
                    url += '&cat_id1=' + $("#cat_id1").val();
                    url += '&cat_id2=' + $("#cat_id2").val();

                    var myChart = echarts.init(document.getElementById('canvas-order-amount'));

                    myChart.showLoading();

                    $.ajax({
                        type: "post",
                        async: true,
                        url: url,
                        data: {},
                        dataType: "json",
                        success: function(result) {
                            if (result.code == 0) {
                                myChart.hideLoading();
                                myChart.setOption({
                                    title: {
                                        text: '',
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'shadow'
                                        }
                                    },
                                    legend: {
                                        data: []
                                    },
                                    grid: {
                                        left: '3%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                    xAxis: {
                                        type: 'value',
                                        boundaryGap: [0, 0.01]
                                    },
                                    yAxis: {
                                        type: 'category',
                                        data: result.y
                                    },
                                    series: [{
                                        name: '销售总额',
                                        type: 'bar',
                                        data: result.x
                                    }]
                                });
                            }
                        },
                        error: function(errorMsg) {
                            $.msg("图表请求数据失败！");
                            myChart.hideLoading();
                        }
                    })
                }
                function init_order_count() {

                    var begin_date = $("#from").val();
                    var end_date = $("#to").val();
                    var url = "/finance/industry-analyse/industry-data";
                    url += '?type=order_count';
                    url += '&from=' + $("#from").val();
                    url += '&to=' + $("#to").val();
                    url += '&cat_id1=' + $("#cat_id1").val();
                    url += '&cat_id2=' + $("#cat_id2").val();

                    var myChart = echarts.init(document.getElementById('canvas-order-count'));

                    myChart.showLoading();

                    $.ajax({
                        type: "post",
                        async: true,
                        url: url,
                        data: {},
                        dataType: "json",
                        success: function(result) {
                            if (result.code == 0) {
                                myChart.hideLoading();
                                myChart.setOption({
                                    title: {
                                        text: '',
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'shadow'
                                        }
                                    },
                                    legend: {
                                        data: []
                                    },
                                    grid: {
                                        left: '3%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                    xAxis: {
                                        type: 'value',
                                        boundaryGap: [0, 0.01]
                                    },
                                    yAxis: {
                                        type: 'category',
                                        data: result.y
                                    },
                                    series: [{
                                        name: '总下单量',
                                        type: 'bar',
                                        data: result.x
                                    }]
                                });
                            }
                        },
                        error: function(errorMsg) {
                            $.msg("图表请求数据失败！");
                            myChart.hideLoading();
                        }
                    })
                }
                function init_goods_count() {

                    var begin_date = $("#from").val();
                    var end_date = $("#to").val();
                    var url = "/finance/industry-analyse/industry-data";
                    url += '?type=goods_count';
                    url += '&from=' + $("#from").val();
                    url += '&to=' + $("#to").val();
                    url += '&cat_id1=' + $("#cat_id1").val();
                    url += '&cat_id2=' + $("#cat_id2").val();

                    var myChart = echarts.init(document.getElementById('canvas-goods-count'));

                    myChart.showLoading();

                    $.ajax({
                        type: "post",
                        async: true,
                        url: url,
                        data: {},
                        dataType: "json",
                        success: function(result) {
                            if (result.code == 0) {
                                myChart.hideLoading();
                                myChart.setOption({
                                    title: {
                                        text: '',
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'shadow'
                                        }
                                    },
                                    legend: {
                                        data: []
                                    },
                                    grid: {
                                        left: '3%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                    xAxis: {
                                        type: 'value',
                                        boundaryGap: [0, 0.01]
                                    },
                                    yAxis: {
                                        type: 'category',
                                        data: result.y
                                    },
                                    series: [{
                                        name: '有销量商品数',
                                        type: 'bar',
                                        data: result.x
                                    }]
                                });
                            }
                        },
                        error: function(errorMsg) {
                            $.msg("图表请求数据失败！");
                            myChart.hideLoading();
                        }
                    })
                }

                init_order_amount();
                // init_order_count();
                // init_goods_count();

                $("#searchForm").submit(function() {
                    $.loading.start();
                    init_order_amount();
                    init_order_count();
                    init_goods_count();
                    return false;
                });
            });
        </script>
        <h5 class="m-b-10 m-t-0">行业分析明细</h5>
    </div>


    <div class="common-title">
        <div class="ftitle">
            <h3>行业分析明细统计</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true>18</span>
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
    <div class="table-responsive">

        <table id="table_list" class="table table-hover">
            <thead>
            <tr>
                <th class="w80">商品分类</th>
                <th class="text-c w100">销售额（元）</th>
                <th class="text-c w120">有效销售额（元）</th>
                <th class="text-c w100">总下单量</th>
                <th class="text-c w100">有效下单量</th>
                <th class="text-c w100">商品总数</th>
                <th class="text-c w120">有销量商品数</th>
                <th class="text-c w120">无销量商品数</th>
                <th class="text-c w100">下单会员数</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>2018</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">10</td>
                <td class="text-c">0</td>
                <td class="text-c">10</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td>食品饮料</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">17</td>
                <td class="text-c">0</td>
                <td class="text-c">17</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td>生鲜食品</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">64</td>
                <td class="text-c">0</td>
                <td class="text-c">64</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 饮料/酒水/冲饮</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 酒类 </td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 白酒 </td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 啤酒 </td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 葡萄酒 </td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 黄酒 </td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            <tr>
                <td> 洋酒 </td>
                <td class="text-c">0.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
                <td class="text-c">0</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="9">
                    <div class="pull-left"></div>
                    <div class="pull-right page-box">
                        <div id="pagination">
                            <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":18,"page_count":2,"offset":0,"url":null,"sql":null}
</script>


                            <div class="pagination-info">
                                共18条记录

                                ，每页显示：
                                <select class="select m-r-5" data-page-size="10">


                                    <option value="10" selected="selected">10</option>



                                    <option value="50">50</option>



                                    <option value="500">500</option>



                                    <option value="1000">1000</option>


                                </select>
                                条

                            </div>

                            <ul class="pagination">
                                <li class="disabled" style="display: none;">
                                    <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                                </li>

                                <li class="disabled">
                                    <a class="fa fa-angle-left" title="上一页"></a>
                                </li>








                                <!--   -->

                                <li class="active">
                                    <a data-cur-page="1">1</a>
                                </li>


                                <!--   -->

                                <li>
                                    <a href="javascript:void(0);" data-go-page="2">2</a>
                                </li>







                                <li>
                                    <a class="fa fa-angle-right" data-go-page="2" title="下一页"></a>
                                </li>

                                <li class="" style="display: none;">
                                    <a class="fa fa-angle-double-right" data-go-page="2" title="最后一页"></a>
                                </li>
                            </ul>

                            <div class="pagination-goto">
                                <input class="ipt form-control goto-input" type="text">
                                <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                                <a class="goto-link" data-go-page="" style="display: none;"></a>
                            </div>
                            <script type="text/javascript">
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
                            </script>

                        </div></div>
                </td>
            </tr>
            </tfoot>
        </table>

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
            var tablelist = $("#table_list").tablelist();
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            $("#btn_export").click(function() {
                var url = "/finance/industry-analyse/industry-export.html";
                url += "?from=" + $("#from").val();
                url += "&to=" + $("#to").val();
                url += "&cat_id1=" + $("#cat_id1").val();
                url += "&cat_id2=" + $("#cat_id2").val();

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }

                $.go(url, "_blank", false);
            });

            $('body').on("change", "#cat_id1", function() {
                var cat_id1 = $(this).val();
                if (cat_id1 != 0) {
                    $(".show_cat_id2").show();
                } else {
                    $(".show_cat_id2").hide();
                }

                $.ajax({
                    url: "/finance/industry-analyse/cat-list?cat_id1=" + cat_id1,
                    type: "post",
                    traditional: true,
                    success: function(data) {
                        $("#cat_id2").html(data);
                        $("#cat_id2").trigger("chosen:updated");
                    },
                    error: function(msg) {
                        $.msg("出错了！");
                    }
                });
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
            minView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd'
        });

        $('#from').datetimepicker().on('changeDate', function(ev) {
            $('#to').datetimepicker('setStartDate', ev.date);
        });
        $('#to').datetimepicker().on('changeDate', function(ev) {
            $('#from').datetimepicker('setEndDate', ev.date);
        });

        $(".date").click(function() {
            $(".date").removeClass("active");
            $(this).addClass("active");
            if ($(this).text() == "今天") {
                var myDate = new Date();
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            } else if ($(this).text() == "1个月") {
                var myDate = new Date();
                myDate.setMonth(myDate.getMonth() - 1);
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            } else if ($(this).text() == "3个月") {
                var myDate = new Date();
                myDate.setMonth(myDate.getMonth() - 3);
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            } else if ($(this).text() == "1年") {
                var myDate = new Date();
                myDate.setYear(myDate.getFullYear() - 1);
                $('#from').val(myDate.Format("yyyy-MM-dd"));
                $('#to').val('');
            }
        });

        var myDate = new Date();
        $('#from').val(myDate.Format("yyyy-MM-dd"));
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop