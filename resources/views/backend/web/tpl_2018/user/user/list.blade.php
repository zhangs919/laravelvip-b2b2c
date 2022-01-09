{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <!-- 日历控件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=1.2">
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=1.2"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/user/user/list" method="GET">
            <div class="simple-form-field simple-form-search">
                <div class="form-group">
                    <label class="control-label">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="user_name" class="form-control w180" name="user_name" placeholder="会员名称/昵称/手机号/邮箱"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>会员等级：</span>
                    </label>
                    <div class="form-control-wrap"><select id="rank_id" class="form-control" name="rank_id">
                            <option value="">全部</option>
                            <option value="1">注册会员</option>
                            <option value="2">铜牌会员</option>
                            <option value="3">银牌会员</option>
                            <option value="4">金牌会员</option>
                            <option value="5">钻石会员</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>个人/店主：</span>
                    </label>
                    <div class="form-control-wrap"><select id="is_seller" class="form-control" name="is_seller">
                            <option value="">全部</option>
                            <option value="0">个人</option>
                            <option value="1">店主</option>
                            <option value="2">网点管理员</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>实名认证：</span>
                    </label>
                    <div class="form-control-wrap"><select id="is_real" class="form-control" name="is_real">
                            <option value="">全部</option>
                            <option value="0">未认证</option>
                            <option value="1">已认证</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>注册来源：</span>
                    </label>
                    <div class="form-control-wrap"><select id="reg_from" class="form-control" name="reg_from">
                            <option value="">全部</option>
                            <option value="1">PC端</option>
                            <option value="2">WAP端</option>
                            <option value="3">微信端</option>
                            <option value="4">APP端</option>
                            <option value="5">后台添加</option>
                            <option value="0">其他</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>允许登录：</span>
                    </label>
                    <div class="form-control-wrap"><select id="status" class="form-control" name="status">
                            <option value="">不限</option>
                            <option value="0">禁止</option>
                            <option value="1">允许</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>允许购物：</span>
                    </label>
                    <div class="form-control-wrap"><select id="shopping_status" class="form-control" name="shopping_status">
                            <option value="">不限</option>
                            <option value="0">禁止</option>
                            <option value="1">允许</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>允许评价：</span>
                    </label>
                    <div class="form-control-wrap"><select id="comment_status" class="form-control" name="comment_status">
                            <option value="">不限</option>
                            <option value="0">禁止</option>
                            <option value="1">允许</option>
                        </select></div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>注册时间：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input type="text" id="reg_time_begin" class="form-control form_datetime ipt pull-none" name="reg_time_begin" placeholder="开始时间">
                        <span class="ctime">至</span>
                        <input type="text" id="reg_time_end" class="form-control form_datetime ipt pull-none" name="reg_time_end" placeholder="结束时间">
                    </div>
                </div>
            </div>
            <div class="simple-form-field toggle hide">
                <div class="form-group">
                    <label class="control-label">
                        <span>上次登录时间：</span>
                    </label>
                    <div class="form-control-wrap"><input type="text" id="last_time" class="form-control form_datetime ipt pull-none" name="last_time" placeholder="上次登录时间"></div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">

                <input type="button" id="btn_export" class="btn btn-default m-r-5" value="导出">

                <a id="searchMore" class="btn-link">更多筛选条件</a>
            </div>
        </form>
    </div>


    <div class="common-title">
        <div class="ftitle">
            <h3>会员列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true">3</span>
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

    {{--引入列表--}}
    @include('user.user.partials._list')

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

            $("#btn_update_user_rank").click(function() {
                $.confirm("您确定要重建会员等级关联关系吗？", function() {
                    $.loading.start();
                    $.ajax({
                        cache: false,
                        type: "POST",
                        data: {},
                        url: "/user/user/update-user-rank",
                        success: function(result) {
                            var result = eval('(' + result + ')');
                            if (result.code == 0) {
                                $.go("/user/user/list");
                                $.msg(result.message, {
                                    time: 3000
                                });
                            } else {
                                $.alert(result.message, {
                                    icon: 2
                                });
                            }
                        },
                        error: function(result) {
                            $.alert("异常", {
                                icon: 2
                            });
                        }
                    });
                });
            });

            // 导出
            $("#btn_export").click(function() {
                var url = "/user/user/export";
                url += "?user_name=" + $("#user_name").val();
                url += "&rank_id=" + $("#rank_id").val();
                url += "&is_seller=" + $("#is_seller").val();
                url += "&is_real=" + $("#is_real").val();
                url += "&reg_from=" + $("#reg_from").val();
                url += "&status=" + $("#status").val();
                url += "&shopping_status=" + $("#shopping_status").val();
                url += "&comment_status=" + $("#comment_status").val();
                url += "&reg_time_begin=" + $("#reg_time_begin").val();
                url += "&reg_time_end=" + $("#reg_time_end").val();
                url += "&last_time=" + $("#last_time").val();

                if (tablelist.sortname != null && tablelist.sortorder != null) {
                    url += "&sortname=" + tablelist.sortname;
                    url += "&sortorder=" + tablelist.sortorder;
                }
                $.go(url, null, false);
            });


            // 备注
            $("body").on("click", ".edit-desc", function() {
                var id = $(this).data("id");
                $.modal({
                    title: '备注',
                    width: 600,
                    ajax: {
                        url: '/user/user/edit-desc',
                        data: {
                            id: id
                        }
                    },
                });
            });
        });
    </script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=1.2"></script>
    <script type="text/javascript">
        (function($) {
            $(window).load(function() {
                $(".edit-table ul").mCustomScrollbar();
            });
        })(jQuery);

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

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop