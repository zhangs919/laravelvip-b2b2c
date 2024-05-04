{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20190116"/>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=20190121"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=20190116"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190116"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!-- 搜索条件 -->
    <div class="search-term  m-b-10">
        <form id="searchForm" action="/dashboard/integral-mall/integral-goods-list.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <input name="goods_name" class="form-control" type="text" placeholder="输入兑换商品名称">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>商品状态：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select class="form-control" name="goods_status">
                            <option value=''>-- 请选择 --</option>

                            <option value='0'>已下架</option>

                            <option value='1'>出售中</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索" />
            </div>
        </form>	</div>
    <!--列表上面（列表名称、列表显示项设置）-->

    <div class="common-title">
        <div class="ftitle">
            <h3>积分兑换商品列表</h3>

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
    <!-- 分类列表 -->

    {{--引入列表--}}
    @include('dashboard.integral-mall.partials._integral_goods_list')


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
    <!-- 时间插件 -->
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190121"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd',
        });
    </script>

    <script type="text/javascript">
        var tablelist;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                // 支持保存查询条件
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
            // 删除记录
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                tablelist.remove({
                    confirm: '您确定删除这条记录吗？',
                    url: 'del-integral-goods',
                    data: {
                        id: id
                    }
                });
            });

            // 上下架
            $('body').on('click', '.edit-goods-status', function() {
                var id = $(this).data('id');
                var goods_status = $(this).data('goods_status');
                var bnt = $(this);
                if(goods_status == 1){
                    $.confirm("您确定要下架此商品吗？", function() {
                        $.post('set-goods-status', {
                            id: id
                        }, function(result) {
                            if (result.code == 0) {
                                tablelist.load().always(function(){
                                    $.msg(result.message);
                                });
                            } else {
                                $.msg(result.message);
                            }
                        }, 'json');
                    });

                }else{
                    $.post('set-goods-status', {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            tablelist.load().always(function(){
                                $.msg(result.message);
                            });
                        } else {
                            $.msg(result.message);
                        }
                    }, 'json');
                }
            });

            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var id = tablelist.checkedValues();

                if (id.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                tablelist.remove({
                    confirm: '您确定批量删除吗？',
                    url: 'del-integral-goods',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $(".goods-integral").editable({
                type: "text",
                url: 'edit-integral-goods-info',
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_integral';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '积分不能为空。';
                    } else if (!ex.test(value)) {
                        return '积分必须是大于0的正整数。';
                    } else if (value == 0) {
                        return '积分必须是大于0的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
            $('.goods-number').editable({
                type: "text",
                url: 'edit-integral-goods-info',
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_number';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '商品库存不能为空。';
                    } else if (!ex.test(value)) {
                        return '商品库存不能小于0。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });

            $('.exchange-number').editable({
                type: "text",
                url: 'edit-integral-goods-info',
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'exchange_number';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '点击量不能为空。';
                    } else if (!ex.test(value)) {
                        return '点击量不能小于0。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });
            $(".goods-sort").editable({
                type: "text",
                url: 'edit-integral-goods-info',
                pk: 1,
                // title: "排序",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_sort';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    var ex = /^\d+$/;
                    if (!value) {
                        return '排序不能为空。';
                    } else if (!ex.test(value)) {
                        return '排序必须是0~255的正整数。';
                    } else if (value > 255) {
                        return '排序必须是0~255的正整数。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    if (response.code == -1) {
                        return response.message;
                    }
                }
            });

            $('.goods_name_controller').click(function(e) {
                e.stopPropagation();
                $(this).parent().children(":first").editable('toggle');
            });

            // 商品名称
            $(".goods_name").editable({
                type: "text",
                url: 'edit-integral-goods-info',
                pk: 1,
                // title: "商品名称",
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.goods_id = $(this).data("goods_id");
                    params.title = 'goods_name';
                    return params;
                },
                validate: function(value) {
                    value = $.trim(value);
                    if (value.length < 3 || value.length > 60) {
                        return '商品标题名称长度最多为60个字 。';
                    }
                },
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    if (value.length > 28) {
                        $(this).html(value.substring(0, 28) + '...');
                    } else {
                        $(this).html(value);
                    }
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop