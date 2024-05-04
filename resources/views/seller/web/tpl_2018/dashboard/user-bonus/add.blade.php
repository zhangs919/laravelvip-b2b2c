{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link href="/assets/d2eace91/css/selector/jquery.multiselect2side.css?v=1.4" rel="stylesheet">

@stop

{{--content--}}
@section('content')

    <!--按会员等级发放-->
    <h3 class="main-div-title m-t-10">
        <span>按指定会员等级发放红包</span>
    </h3>
    <div class="main-div m-b-20">
        <div class="table-content p-t-30 bg-fff">
            <form id="rankForm" class="form-horizontal">
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            <span class="ng-binding">会员等级：</span>
                        </label>
                        <div class="col-sm-7">
                            <div class="form-control-box">
                                <select class="form-control" name="shop_rank_id">
                                    @foreach($shop_rank_list as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                <label class="cur-p m-l-20"> <input type="hidden" name="is_repeat" value="1">
                                    <label><input type="checkbox" class="cur-p" name="is_repeat" value="0"> 排除已领取此红包的会员</label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field p-b-30">
                    <div class="form-group">
                        <label class="col-sm-5"> </label>
                        <div class="col-sm-7">
                            <div class="form-control-box">
                                <input type="button" id="btn_send_by_rank" class="btn btn-primary" value="确认发放红包">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--按搜索会员发放--->
    <h3 class="main-div-title">
        <span>按指定会员发放红包</span>
    </h3>
    <div class="main-div">
        <div class="bg-fff p-b-30">
            <div class="search-term m-b-10">
                <form id="searchForm" action="/dashboard/user-bonus/add" method="GET" onKeydown="if(event.keyCode==13)return false;">
                    <input type="hidden" name="bonus_id" value="{{ $bonus_id }}">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label class="control-label">
                                <span>关键词：</span>
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" name="keywords" class="form-control w250" placeholder="请输入会员名称/昵称/手机号/邮箱" />
                            </div>
                        </div>
                    </div>
                    <div class="simple-form-field">
                        <div class="form-group">
                            <div class="form-control-wrap"><input type="hidden" name="is_repeat" value="1"><label><input type="checkbox" class="cur-p" name="is_repeat" value="0"> 排除已领取此红包的会员</label></div>
                        </div>
                    </div>
                    <div class="simple-form-field">
                        <input type="button" class="btn btn-primary" id="btn_search" value="搜索">
                    </div>
                </form>            </div>
            <!--显示内容-->
            <div class="table-content text-c m-t-30">
                <div class="m-b-20"><select id="user_ids" class="form-control" name="user_ids">
                    </select></div>
                <div class="simple-form-field p-b-30">
                    <div class="form-group">
                        <div class="col-sm-12 text-c">
                            <input type="button" class="btn btn-primary" id="btn_send" value="确认发放红包">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

{{--script page元素内--}}
@section('script')
    <script src="/assets/d2eace91/js/selector/jquery.multiselect2side.js?v=1.1"></script>
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

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script type='text/javascript'>
        $().ready(function() {
            $("#user_ids").multiselect2side({
                search: "搜索：",
                selectedPosition: "right",
                moveOptions: false,
                labelsx: " ",
                labeldx: "已选择的会员"
            });
            $("#btn_search").click(function() {
                var data = $("#searchForm").serializeJson();
                if ($.trim(data.keywords) == "") {
                    $.msg("搜索关键词不能为空!");
                    $("input[name='keywords']").focus();
                    return;
                }
                data.bonus_id = "{{ $bonus_id }}";
                $.loading.start();
                $.get("/dashboard/user-bonus/search-user", data, function(result) {
                    if (result.code == 0) {
                        $("#user_ids").multiselect2side('removeUnSelected');
                        var user_ids = $("#user_ids").multiselect2side('values');
                        var options = [];
                        for (var i = 0; i < result.data.length; i++) {
                            options.push({
                                name: result.data[i].user_name,
                                value: result.data[i].user_id,
                                selected: $.inArray(result.data[i].user_id, user_ids) != -1 ? true : false
                            });
                        }
                        $("#user_ids").multiselect2side('addOptions', options);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "JSON").always(function() {
                    $.loading.stop();
                });
            });
            $("#user_idsms2side__sx").change(function() {
                $("#user_idsms2side__dx").siblings(".ms2side__header").html("已选择的会员（" + $("#user_idsms2side__dx").find("option").size() + "）");
            });
            $("#user_idsms2side__dx").change(function() {
                $("#user_idsms2side__dx").siblings(".ms2side__header").html("已选择的会员（" + $("#user_idsms2side__dx").find("option").size() + "）");
            });
            $("#btn_send").click(function() {
                var user_ids = $("#user_ids").multiselect2side('values');
                if (user_ids == undefined || user_ids == null || user_ids.length == 0) {
                    $.msg("您没有选择任何会员");
                    return;
                }
                $.progress({
                    url: '/dashboard/user-bonus/add',
                    key: 'seller-send-user-bonus-by-user',
                    type: 'POST',
                    data: {
                        bonus_id: "{{ $bonus_id }}",
                        user_ids: user_ids.join(",")
                    },
                    end: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            },function(){
                                $.go(window.location.href);
                            });
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }
                });
            });
            $("#btn_send_by_rank").click(function() {
                var data = $("#rankForm").serializeJson();
                data.bonus_id = "{{ $bonus_id }}";
                var send = function() {
                    $.progress({
                        url: '/dashboard/user-bonus/add',
                        key: 'seller-send-user-bonus-by-rank',
                        type: 'POST',
                        data: data,
                        end: function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 3000
                                },function(){
                                    $.go(window.location.href);
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }
                    });
                }
                if ($.trim(data.shop_rank_id) == "") {
                    $.confirm("您确定要给所有会员发放此红包吗？", function() {
                        send();
                    });
                } else {
                    send();
                }
            });
        });
    </script>

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop