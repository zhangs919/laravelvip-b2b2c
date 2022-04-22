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
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=201807241613"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/sales-analyse/order.html" method="GET">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label class="control-label">
                        <span>时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="from" class="form-control form_datetime ipt" name="from" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="to" class="form-control form_datetime ipt" name="to" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="inline-item date" href="javascript:void(0);">今天</a>
                <em class="ft-bar">|</em>
                <span class="inline-text">最近：</span>
                <a class="inline-item date" href="javascript:void(0);">1个月</a>
                <a class="inline-item date" href="javascript:void(0);">3个月</a>
                <a class="inline-item date" href="javascript:void(0);">1年</a>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="keyword" class="form-control" type="text" placeholder="店铺ID/店铺名称">
                    </div>
                </div>
            </div>
            <!-- <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺分类：</span>
                    </label>
                    <div class="form-control-wrap"><select id="cat_id" class="form-control chosen-select" name="cat_id">

    </select></div>
                </div>
            </div> -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>店铺类型：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_type" name="shop_type" class="form-control">
                            <option value="">-- 请选择 --</option>
                            <option value="1">自营店铺</option>
                            <option value="2">入驻店铺</option>
                            <option value="3">自营供货商</option>
                            <option value="4">入驻供货商</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <button class="btn btn-primary m-r-5">搜索</button>

                <!-- <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出" /> -->

            </div>
        </form>
    </div>
    <div class="balance-bill column3">
        <dl>
            <dt>订单总金额</dt>
            <dd>
                <span class="money" id="order_amount">0.00</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>有效订单总金额</dt>
            <dd>
                <span class="money" id="order_amount_valid">0.00</span>
                <span class="unit">元</span>
            </dd>
        </dl>
        <dl>
            <dt>总订单量</dt>
            <dd>
                <span class="money" id="order_count">0</span>
                <span class="unit"></span>
            </dd>
        </dl>

        <dl  class="top-line">
            <dt>有效订单量</dt>
            <dd>
                <span class="money" id="order_count_valid">0</span>
                <span class="unit"></span>
            </dd>
        </dl>
        <dl  class="top-line">
            <dt>下单会员数</dt>
            <dd>
                <span class="money" id="users_count">0</span>
                <span class="unit"></span>
            </dd>
        </dl>
        <dl  class="top-line">
            <dt>退款总金额</dt>
            <dd>
                <span class="money" id="back_amount">0.00</span>
                <span class="unit">元</span>
            </dd>
        </dl>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>店铺订单统计</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true>8</span>
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
                <th class="text-c w80" data-sortname="shop_id">店铺ID</th>
                <th class="w150" data-sortname="shop_name">店铺名称</th>
                <th class="text-c w100" data-sortname="order_count">总订单量</th>
                <th class="text-c w100" data-sortname="order_count_valid">有效订单量</th>
                <th class="text-c w120" data-sortname="close_count">已关闭订单量</th>
                <th class="text-c w150" data-sortname="order_amount">订单总金额（元）</th>
                <th class="text-c w150" data-sortname="order_amount_valid">有效订单金额（元）</th>
                <th class="text-c w80" data-sortname="back_count">退款量</th>
                <th class="text-c w150" data-sortname="back_amount">退款总金额（元）</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td class="text-c">1</td>
                <td>九尘教</td>
                <td class="text-c">102</td>
                <td class="text-c">53</td>
                <td class="text-c">49</td>
                <td class="text-c">11481.06</td>
                <td class="text-c">275.06</td>
                <td class="text-c">1</td>
                <td class="text-c">1.00</td>
            </tr>

            <tr>
                <td class="text-c">24</td>
                <td>蓝月故事河口仓</td>
                <td class="text-c">11</td>
                <td class="text-c">5</td>
                <td class="text-c">6</td>
                <td class="text-c">1088.00</td>
                <td class="text-c">500.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            <tr>
                <td class="text-c">15</td>
                <td>阿迪达斯旗舰店</td>
                <td class="text-c">12</td>
                <td class="text-c">4</td>
                <td class="text-c">8</td>
                <td class="text-c">5033.00</td>
                <td class="text-c">1546.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            <tr>
                <td class="text-c">36</td>
                <td>LeiDaGou</td>
                <td class="text-c">10</td>
                <td class="text-c">4</td>
                <td class="text-c">6</td>
                <td class="text-c">112.00</td>
                <td class="text-c">31.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            <tr>
                <td class="text-c">23</td>
                <td>zlys</td>
                <td class="text-c">5</td>
                <td class="text-c">2</td>
                <td class="text-c">3</td>
                <td class="text-c">149.00</td>
                <td class="text-c">25.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            <tr>
                <td class="text-c">38</td>
                <td>小不点</td>
                <td class="text-c">1</td>
                <td class="text-c">1</td>
                <td class="text-c">0</td>
                <td class="text-c">111.00</td>
                <td class="text-c">111.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            <tr>
                <td class="text-c">41</td>
                <td>洱海</td>
                <td class="text-c">1</td>
                <td class="text-c">0</td>
                <td class="text-c">1</td>
                <td class="text-c">108000.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            <tr>
                <td class="text-c">12</td>
                <td>b2b经销商订货系统</td>
                <td class="text-c">3</td>
                <td class="text-c">0</td>
                <td class="text-c">3</td>
                <td class="text-c">204.00</td>
                <td class="text-c">0.00</td>
                <td class="text-c">0</td>
                <td class="text-c">0.00</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="9">
                    <div class="pull-left"></div>
                    <div class="pull-right page-box">
                        <div id="pagination">
                            <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":8,"page_count":1,"offset":0,"url":null,"sql":null}
</script>


                            <div class="pagination-info">
                                共8条记录

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







                                <li class="disabled">
                                    <a class="fa fa-angle-right" title="下一页"></a>
                                </li>

                                <li class="disabled" style="display: none;">
                                    <a class="fa fa-angle-double-right" data-go-page="1" title="最后一页"></a>
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

        // var myDate = new Date();
        // $('#from').val(myDate.Format("yyyy-MM-dd"));
    </script>

    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
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

    <script type="text/javascript">
        (function($) {
            $(window).load(function() {
                $("[data-toggle='popover']").popover();
            });
        })(jQuery);
    </script>

    <script type="text/javascript">
        $().ready(function() {
            var data = $(this).serializeJson();
            $.ajax({
                url: '/finance/sales-analyse/get-order-data',
                data: data,
                dataType: 'json',
                success: function(data) {
                    $("#order_amount").html(data.order_amount);
                    $("#order_amount_valid").html(data.order_amount_valid);
                    $("#order_count").html(data.order_count);
                    $("#order_count_valid").html(data.order_count_valid);
                    $("#users_count").html(data.users_count);
                    $("#back_amount").html(data.back_amount);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop