{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
<!-- 日历控件-->
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
<script src="/assets/d2eace91/js/datetime/dateformat.js?v=1.2"></script>

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')


    <div class="search-term m-b-10 pos-r">
        <form id="searchForm" action="/finance/user-account/list" method="GET">
            <div class="form-item">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>关键词：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input name="key_word" class="form-control w300" type="text" placeholder="会员名称/真实姓名/昵称/手机号/邮箱">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>资金变动时间：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" id="from" class="form-control form_datetime ipt" name="from" value="2018-02-15">
                            <span class="ctime">至</span>
                            <input type="text" id="to" class="form-control form_datetime ipt" name="to">
                        </div>
                    </div>
                </div><div class="simple-form-field">
                    <a class="inline-item date" href="javascript:void(0);">今天</a>
                    <em class="ft-bar">|</em>
                    <span class="inline-text">最近：</span>
                    <a class="inline-item date" href="javascript:void(0);">1个月</a>
                    <a class="inline-item date" href="javascript:void(0);">3个月</a>
                    <a class="inline-item date" href="javascript:void(0);">1年</a>
                </div>
            </div>


            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>会员等级：</span>
                        </label>
                        <div class="form-control-wrap">
                            <select class="form-control" name="rank">

                                <option value="">全部</option>

                                <option value="1">注册会员</option>

                                <option value="2">铜牌会员</option>

                                <option value="3">银牌会员</option>

                                <option value="4">金牌会员</option>

                                <option value="5">钻石会员</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>变动金额：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input name="amount" class="form-control" type="text" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item toggle hide">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="control-label">
                            <span>注册日期：</span>
                        </label>
                        <div class="form-control-wrap">
                            <input type="text" id="reg_from" class="form-control form_datetime ipt pull-none" name="reg_from">
                            <span class="ctime">至</span>
                            <input type="text" id="reg_to" class="form-control form_datetime ipt pull-none" name="reg_to">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-item">
                <div class="simple-form-field">
                    <label class="control-label"></label>
                    <div class="form-control-wrap">
                        <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
                        <!-- <button class="btn btn-default m-r-5">导出</button> -->
                    </div>
                </div>
            </div>
            <a id="searchMore" class="btn-link more">更多筛选条件</a>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>会员账户列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true">{{ $total }}</span>
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
    <!--列表内容-->
    <div class="table-responsive">

    @include('finance.user-account.partials._list')

    </div>


@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop


{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
                url: 'list'
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
    </script>
    
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop