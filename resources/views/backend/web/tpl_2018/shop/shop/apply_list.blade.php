{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键字：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input id="key_word" name="key_word" class="form-control w180" type="text" placeholder="店铺ID/店铺名称/店主账号">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>企业/个人：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_type" name="shop_type" class="form-control">
                            <option value="0">全部</option>
                            <option value="1">个人店铺</option>
                            <option value="2">企业店铺</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>审核状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="shop_audit" name="shop_audit" class="form-control">
                            <option value="-1">不限</option>
                            <option value="0">待审核</option>
                            <!--
                            <option value="1">已通过</option>
                            -->
                            <option value="2">已拒绝</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>
    </div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>开店申请列表</h3>

            <h5>
                (&nbsp;共
                <span data-total-record=true></span>
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
    <!--列表内容-->
    <div class="table-responsive">

        {{--引入列表--}}
        @include('shop.shop.partials._apply_list')

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
            var tablelist = $("#table_list").tablelist({
                url: 'apply-list'
            });

            // 删除
            $("body").on('click', '#del', function() {
                var id = $(this).attr("object_id");
                $.confirm("您确定删除这条开店申请吗？", function() {
                    $.loading.start();
                    $.ajax({
                        cache: false,
                        type: "POST",
                        data: {
                            id: id
                        },
                        url: "delete",
                        success: function(result) {
                            var result = eval('(' + result + ')');
                            if (result.code == 0) {
                                $.alert(result.message, {
                                    icon: 1
                                }, function() {
                                    $.go("apply-list?is_supply=0");
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

            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            // 批量通过
            $("body").on("click", "#batch-pass", function() {
                var ids = tablelist.checkedValues();

                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量通过吗？',
                    url: 'batch-pass?is_supply=0',
                    data: {
                        ids: ids
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop