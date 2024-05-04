{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css"/>
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/datetime/dateformat.js"></script>
    <script src="/assets/d2eace91/js/echarts/echarts-all.js"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="search-term m-b-10">
        <form id="searchForm" action="/finance/users-statistics/areas-list" method="GET">
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
                        <span>区域：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="areas" name="areas" class="form-control">
                            <option value="0">按省统计</option>
                            <option value="1">按市统计</option>
                            <option value="2">按区/县统计</option>
                        </select>
                    </div>
                    <div class="form-control-wrap province" style="display: none;">
                        <select id="province" name="province" class="form-control chosen-select">

                            <option value="11">北京市</option>

                            <option value="64">宁夏回族自治区</option>

                            <option value="12">天津市</option>

                            <option value="45">广西壮族自治区</option>

                            <option value="65">新疆维吾尔自治区</option>

                            <option value="13">河北省</option>

                            <option value="32">江苏省</option>

                            <option value="22">吉林省</option>

                            <option value="37">山东省</option>

                            <option value="15">内蒙古自治区</option>

                            <option value="62">甘肃省</option>

                            <option value="35">福建省</option>

                            <option value="71">台湾省</option>

                            <option value="81">香港特别行政区</option>

                            <option value="82">澳门特别行政区</option>

                            <option value="83">测试</option>

                            <option value="21">辽宁省</option>

                            <option value="63">青海省</option>

                            <option value="14">山西省</option>

                            <option value="41">河南省</option>

                            <option value="61">陕西省</option>

                        </select>
                    </div>
                    <div class="form-control-wrap city" style="display: none;">
                        <select id="city" name="city" class="form-control chosen-select">
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

    <div class="common-title">
        <div class="ftitle">
            <h3>会员地区分布统计</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true>10</span>
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
                <!-- <th class="w100">编号</th> -->
                <th class="w150">省份</th>
                <th class="w150">市</th>
                <th class="w150">区/县</th>
                <th class="text-c w120">下单会员数</th>
                <th class="text-c w120">下单总金额（元）</th>
                <th class="text-c w120">下单量</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <!-- <td></td> -->
                <td>天津市</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">0.48</td>
                <td class="text-c">19</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>甘肃省</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">69.87</td>
                <td class="text-c">13</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>江苏省</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">5</td>
                <td class="text-c">751.60</td>
                <td class="text-c">10</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>浙江省哈哈哈</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">59.90</td>
                <td class="text-c">8</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>贵州省</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">43.51</td>
                <td class="text-c">8</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>山西省</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">1444.00</td>
                <td class="text-c">7</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>广西壮族自治区</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">100.00</td>
                <td class="text-c">1</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>北京市</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">18.60</td>
                <td class="text-c">1</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>湖南省</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">0.10</td>
                <td class="text-c">1</td>
            </tr>

            <tr>
                <!-- <td></td> -->
                <td>山东省</td>
                <td>-</td>
                <td>-</td>
                <td class="text-c">1</td>
                <td class="text-c">0.00</td>
                <td class="text-c">1</td>
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="9">
                    <div class="pull-left"></div>
                    <div class="pull-right page-box">
                        <div id="pagination">
                            <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":10,"page_count":1,"offset":0,"url":null,"sql":null}
</script>


                            <div class="pagination-info">
                                共10条记录

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

        $('body').on("change", "#areas", function() {
            var value = $(this).val();
            if (value == 0) {
                $(".province").hide();
                $(".city").hide();
            } else if (value == 1) {
                $(".province").show();
                $(".city").hide();
            } else if (value == 2) {
                $(".province").show();
                $(".city").show();

                var value = $("#province").val();
                $.ajax({
                    url: "/finance/shops-statistics/get-city-list",
                    type: "post",
                    data: {
                        province: value
                    },
                    traditional: true,
                    success: function(data) {
                        $("#city").html(data);
                        $("#city").trigger("chosen:updated");
                    },
                    error: function(msg) {
                        $.msg("出错了！");
                    }
                });
            }
        });

        $('body').on("change", "#province", function() {
            var areas = $("#areas").val();
            if (areas == 1) {
                return;
            }
            var value = $(this).val();
            $.ajax({
                url: "/finance/shops-statistics/get-city-list",
                type: "post",
                data: {
                    province: value
                },
                traditional: true,
                success: function(data) {
                    $("#city").html(data);
                    $("#city").trigger("chosen:updated");
                },
                error: function(msg) {
                    $.msg("出错了！");
                }
            });
        });
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
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop