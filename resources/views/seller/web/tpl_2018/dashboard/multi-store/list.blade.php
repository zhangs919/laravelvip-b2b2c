{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link href="/assets/d2eace91/js/bootstrap3-editable/css/bootstrap-editable.css?v=2.1" rel="stylesheet">
@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="query" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>关键词：</span>
                    </label>
                    <div class="form-control-wrap">
                        <select id="keyword_type" class="form-control w120 m-r-2" name="keyword_type">
                            <option value="0">门店名称</option>
                            <option value="1">门店ID</option>
                            <option value="2">门店管理员</option>
                        </select>
                        <input id="key_word" name="key_word" class="form-control w180" type="text" value=""
                               placeholder="请输入关键字">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label">
                        <span>门店状态：</span>
                    </label>
                    <div class="form-control-wrap">

                        <select id="store_status" name="store_status" class="form-control chosen-select"
                                style="display: none;">
                            <option value="-1">-- 全部 --</option>
                            <option value="1">开启</option>
                            <option value="0">关闭</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <input type="submit" id="btn_submit" class="btn btn-primary m-r-5" value="搜索">
                <input type="submit" id="btn_export" class="btn btn-default m-r-5" value="导出">
            </div>
        </form>
    </div>

    <div class="common-title">
        <div class="ftitle">
            <h3>{{ $title }}</h3>

            <h5>
                (&nbsp;共
                <span data-total-record="true" class="pagination-total-record"></span>
                条记录&nbsp;)
            </h5>

        </div>
        <div class="operate m-l-20">

            <a class="reload" href="javascript:tablelist.load();" data-toggle="tooltip" data-placement="auto bottom"
               title="刷新数据">
                <i class="fa fa-refresh"></i>
            </a>


        </div>
    </div>
    <div class="table-responsive" style="overflow: visible;">
        @include('dashboard.multi-store.partials._list')
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

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js?v=2.1"></script>
    <script src="/assets/d2eace91/js/bootstrap3-editable/js/bootstrap-editable.js?v=2.1"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

    <script type="text/javascript">
        //
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
            // 导出
            $("#btn_export").click(function() {
                var url = "/dashboard/multi-store/store-export.html";
                url += "?key_word=" + $("#key_word").val();
                url += "&store_status=" + $("#store_status").val();
                $.go('/site/export?url=' + encodeURIComponent($.base64.encode(url)) + '&title=导出门店列表', '_blank', false);
            });
            //首页设置层展示
            $("body").on("click", ".diy", function() {
                var diy_value = $(this).data('diy');
                var store_id = $(this).data('storeid');
                $("#zx_txt").find("input:radio[name=zhuangxiu]").removeAttr("checked");
                $("#zx_txt").find("input:radio[name=zhuangxiu][value=" + diy_value + "]").prop("checked", true);
                $("#zx_txt").find("#store_id").val(store_id);
                $.open({
                    title: '首页设置',
                    type: 1,
                    content: $("#zx_txt"),
                    width: "520px"
                })
            })
            //首页设置操作
            $("body").on("click", "#ok", function() {
                $.closeAll();
                $.loading.start();
                $.post("diy", {
                    store_id: $("#zx_txt").find("#store_id").val(),
                    is_diy: $("#zx_txt").find("input:radio[name=zhuangxiu]:checked").val()
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            tablelist.load();
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });
            // 多门店模式下，设置跟 [宏业erp] 对应的门店的code
            $("body").on("click", ".set_hongye_store_map", function() {
                var $self = $(this);
                // 门店id
                var storeId = $self.data('storeid');
                // 门店名称
                var storeName = $self.data('storename');
                // 设置门店名称
                $('#current_store_name').text(storeName);
                $('#hidden_store_id').val(storeId);
                // 先查询当前内容是否有绑定
                $.loading.start();
                $.getJSON('/dashboard/multi-store/find-hongye-code-by-id', {
                    'store_id': storeId
                }, function(res) {
                    // 设置code内容
                    $('#multi_store_map_code').val(res.data);
                    $.open({
                        title: '门店映射设置：与宏业Erp部门对应编码',
                        type: 1,
                        content: $("#hongye_multi_settup"),
                        width: "520px"
                    })
                }).always(function() {
                    $.loading.stop();
                });
            });
            // 同步门店库存价格
            $('body').on('click','#sync_kg_stock_price',function(){
                // 数据提交
                $.loading.start();
                $.post('/dashboard/multi-store/sync-kg-stock-price',{}, function(res) {
                    if (res.code == 0) {
                        $.closeAll();
                    }
                    $.alert(res.message);
                }, 'JSON');
                return false;
            })
            // 点击提交映射内容
            $("body").on("click", "#hongye_multi_settup_commit", function() {
                var $self = $(this);
                // code
                var code = $.trim($('#multi_store_map_code').val());
                // 是否开发货门店
                var allocation_code = '';
                // code可以不填写，为取消
                // store_id
                var storeId = $('#hidden_store_id').val();
                if (!storeId) {
                    $.msg('未能获取门店id,请刷新重试~');
                    return false;
                }
                // 数据提交
                $.loading.start();
                $.post('/dashboard/multi-store/bind-hongye-code', {
                    'code': code,
                    'store_id': storeId,
                    'allocation_code': allocation_code,
                    'app_type': 'hongye'
                }, function(res) {
                    if (res.code == 0) {
                        $.closeAll();
                    }
                    $.alert(res.message);
                }, 'JSON');
            });
            //设置总店操作
            $("body").on("click", ".master", function() {
                $.loading.start();
                $.post("master", {
                    store_id: $(this).data('storeid'),
                    is_master: $(this).data('master')
                }, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            tablelist.load();
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });
            // 删除门店
            $("body").on('click', '.del', function() {
                var id = $(this).data("id");
                $.confirm('您确定删除这个门店吗？', function() {
                    $.loading.start();
                    $.post("/dashboard/multi-store/delete.html", {
                        id: id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON").always(function() {
                        $.loading.stop();
                    });
                });
            });
            // 搜索
            $("#searchForm").submit(function() {
                tablelist.load({
                    // 关键字
                    'key_word': $("#key_word").val(),
                    'keyword_type': $("#keyword_type").val(),
                    'store_status': $("#store_status").val()
                });
                return false;
            });
            //同步店铺商品到门店
            $("body").on("click", ".synchro", function() {
                var store_id = $(this).data('storeid');
                $.confirm('同步商品等待时间会稍长,您确定同步吗？', function() {
                    $.loading.start();
                    $.post("/dashboard/multi-store/synchro.html", {
                        store_id: store_id
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON")
                })
            })
            // 批量删除
            $("body").on("click", "#batch-delete", function() {
                var ids = tablelist.checkedValues();
                //$(this).removeClass('btn-default').addClass('btn-danger').siblings().removeClass('btn-danger')
                if (ids.length == 0) {
                    $.msg("您没有选择任何待处理的数据！");
                    return;
                }
                $.confirm('您确定删除选择的门店吗？', function() {
                    $.loading.start();
                    $.post("/dashboard/multi-store/batch-delete.html", {
                        ids: ids
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            tablelist.load();
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }, "JSON").always(function() {
                        $.loading.stop();
                    });
                });
            });
            // 批量设置分组
            $("body").on("click", "#batch_set_group", function() {
                var ids = tablelist.checkedValues();
                //$(this).removeClass('btn-default').addClass('btn-danger').siblings().removeClass('btn-danger')
                var url = '/dashboard/multi-store/group-list.html';
                if (ids.length == 0) {
                    $.msg("您没有选择待设置分组的门店！");
                    return;
                }
                $.open({
                    type: 1,
                    title: '批量设置门店分组',
                    width: '450px',
                    height: '200px',
                    btn: ['确定', '取消'],
                    ajax: {
                        url: url
                    },
                    yes: function(index, obj) {
                        var ids = tablelist.checkedValues();
                        var data = $(obj).find("#group_id").val();
                        if (data == 0) {
                            $.msg('请选择分组');
                        }
                        $.confirm("您确定要更新门店关联的分组吗？当前操作可能会花费很长时间而且请勿中断！", function() {
                            $.loading.start();
                            $.post(url, {
                                data: data,
                                store_ids: ids
                            }, function(result) {
                                if (result.code == 0 && result.data.cache_key) {
                                    $.progress({
                                        type: 'POST',
                                        url: 'store-related-group.html',
                                        key: result.data.cache_key,
                                        data: {
                                            group_id: result.data.group_id,
                                            store_ids: result.data.store_ids,
                                        },
                                        end: function(result){
                                            $.msg("关联分组成功！", {
                                                time: 1500
                                            }, function(){
                                                if(typeof tablelist != 'undefined'){
                                                    tablelist.load();
                                                }
                                                $.closeAll();
                                            });
                                            if(result.code != 0){
                                                $(target).removeClass("disabled");
                                            }
                                        }
                                    });
                                } else if(result.code == 0) {
                                    $.msg(result.message, {
                                        time: 3000
                                    }, function() {
                                        tablelist.load();
                                        $.closeAll();
                                    });
                                } else {
                                    $.msg(result.message, {
                                        time: 5000
                                    });
                                }
                            }, "JSON").always(function() {
                                $.loading.stop();
                            });
                        }, function(){
                            $(target).removeClass("disabled");
                        });
                    }
                });
            });
            // 批量设置活动
            $("body").on("click", "#batch_set_activity", function() {
                var ids = tablelist.checkedValues();
                //$(this).removeClass('btn-default').addClass('btn-danger').siblings().removeClass('btn-danger')
                if (ids.length == 0) {
                    $.msg("您没有选择待设置活动的门店！");
                    return;
                }
                var visit_url = "/dashboard/multi-store/set-activity.html"
                activity_setting(ids, visit_url, '批量设置门店活动')
            });
            //批量调整营业时间
            $("body").on('click','#batch_opening_hour',function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整门店营业时间',
                    width: '850px',
                    height:'220px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-opening-hour",
                        data:{
                            ids:ids
                        }
                    },
                    success: function(layero, index) {
                        if ($(layero).find(":radio:checked").val() == 2) {
                            layer.style(index, {
                                height: $(window).height() - 100,
                                top: '50px'
                            });
                        }else if ($(layero).find(":radio:checked").val() == 1) {
                            layer.style(index, {
                                height: '450px',
                                top: '50px'
                            });
                        } else {
                            layer.style(index, {
                                height: '220px',
                                top: '180px'
                            });
                        }
                        $(layero).find(":radio").click(function() {
                            var val = $(this).val();
                            if (val == 2) {
                                layer.style(index, {
                                    height: $(window).height() - 100,
                                    top: '50px'
                                });
                            }else if (val == 1) {
                                layer.style(index, {
                                    height: '450px',
                                    top: '50px'
                                });
                            } else {
                                layer.style(index, {
                                    height: '220px',
                                    top: '180px'
                                });
                            }
                        });
                    }
                })
            })
            //批量调整门店结算周期
            $("body").on('click',"#batch_clearing_cycle",function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整门店结算周期',
                    width: '500px',
                    height: '300px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-clearing-cycle",
                        data:{
                            ids:ids
                        }
                    }
                })
            })
            //批量调整门店状态
            $("body").on('click','#batch_store_status',function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整门店状态',
                    width: '500px',
                    height: '250px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-store-status",
                        data:{
                            ids:ids
                        }
                    }
                })
            })
            //批量调整额外配送费
            $("body").on("click",'.batch_other_shpping_fee',function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整门店额外配送费',
                    width: '700px',
                    height: '350px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-other-shpping-fee",
                        data:{
                            ids:ids
                        }
                    }
                })
            })
            //批量设置配送方式
            $("body").on("click",'.batch_support_shipping_type',function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整门店配送方式',
                    width: '1000px',
                    height: '350px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-support-shipping-type",
                        data:{
                            ids:ids
                        }
                    }
                })
            })
            //批量调整门店同城配送时段
            $("body").on("click",'.batch_city_shipping',function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整门店配送时间',
                    width: '850px',
                    height: '520px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-city-shipping",
                        data:{
                            ids:ids
                        }
                    }
                })
            })
            //批量调整包装费
            $("body").on("click",'.batch_packing_fee',function(){
                var ids=tablelist.checkedValues();
                if(ids.length==0){
                    $.msg('您没有选择待操作的门店！');
                    return;
                }
                $.open({
                    type:1,
                    title:'批量调整包装费',
                    width: '500px',
                    height: '340px',
                    ajax:{
                        type:"GET",
                        url:"/dashboard/multi-store/batch-packing-fee",
                        data:{
                            ids:ids
                        }
                    }
                })
            })
            //单个门店设置活动
            $("body").on("click", ".set_store_act", function() {
                var id = $(this).data('storeid');
                var name = $(this).data('storename');
                if (!id) {
                    $.msg("您没有选择待设置活动的门店！");
                    return;
                }
                var visit_url = "/dashboard/multi-store/set-activity.html?store_id=" + id;
                activity_setting(id, visit_url, '门店【' + name + '】活动参与设置')
            });
            function activity_setting(ids, url, title) {
                $.loading.start();
                $.open({
                    type: 1,
                    title: title,
                    width: '390px',
                    ajax: {
                        url: url
                    },
                    btn: ['确定', '取消'],
                    yes: function(index, obj) {
                        var data = $(obj).find("#act_form").serializeJson();
                        $.loading.start();
                        $.post("/dashboard/multi-store/set-activity.html", {
                            data: data,
                            store_ids: ids
                        }, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 3000
                                }, function() {
                                    tablelist.load();
                                    $.closeAll();
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "JSON").always(function() {
                            $.loading.stop();
                        });
                    }
                });
            }
            // 批量关联商品
            $("body").on("click", "#batch_related_goods", function() {
                var ids = tablelist.checkedValues();
                if (ids.length == 0) {
                    $.msg("您没有选择待关联商品的门店！");
                    return;
                }
                var func = function(type){
                    var url = "/dashboard/multi-store/store-related-goods.html";
                    var type_name = type == 0 ? "增量式" : "覆盖式";
                    $.open({
                        type: 1,
                        title: "批量为【" + ids.length + "】个门店 <b>" + type_name + "</b> 关联商品",
                        width: Math.min($(window).width() - 50, 900),
                        height: $(window).height() - 100,
                        ajax: {
                            url: url,
                            data: {
                                store_id: ids.join(","),
                                // 关联模式：0-增量 1-覆盖
                                type: type
                            }
                        },
                        success: function(layero, index) {
                            if ($(layero).find(":radio:checked").val() == 4) {
                                layer.style(index, {
                                    height: $(window).height() - 100,
                                    top: '50px'
                                });
                            } else {
                                layer.style(index, {
                                    height: '250px',
                                    top: '180px'
                                });
                            }
                            $(layero).find(":radio").click(function() {
                                var val = $(this).val();
                                if (val == 4) {
                                    layer.style(index, {
                                        height: $(window).height() - 100,
                                        top: '50px'
                                    });
                                } else {
                                    layer.style(index, {
                                        height: '250px',
                                        top: '180px'
                                    });
                                }
                            });
                        }
                    });
                }
                if(ids.length == 1){
                    // 覆盖
                    func(1);
                }else{
                    $.alert("<b>增量式</b> - 保留已关联的商品关联关系，然后新增本次选择的商品；<br/><b>覆盖式</b> - 最终将仅保留本次选择的商品关联关系，未选择的商品将删除关联关系；", {
                        title: "请选择关联商品的模式",
                        area: ["550px", "200px"],
                        btn: ['增量式【保留已关联的商品】', '覆盖式【以本次选择商品为准】', '取消'],
                        yes: function(){
                            // 增量
                            func(0);
                        },
                        btn2: function(){
                            // 覆盖
                            func(1);
                        }
                    });
                }
                return;
            });
            //店铺 社区团推广码
            $("body").on("click", ".btn-promote", function() {
                $.loading.start();
                var store_id = $(this).data("store_id");
                var store_name = $(this).data("store_name");
                var shop_id = $(this).data("shop_id");
                $.open({
                    title: "门店推广码",
                    ajax: {
                        url: '/dashboard/promote/view?url=select-comstore-' + shop_id + '.html',
                        data: {}
                    },
                    width: "300px",
                    end: function(index, object) {
                    }
                });
            });
            // 推广码
            $("body").off("click", ".popularize");
            $("body").on("click", ".popularize", function() {
                var id = $(this).data("id");
                var name = $(this).data("name");
                var url = $(this).data("url");
                $.loading.start();
                $.open({
                    title: "门店推广码",
                    width: "800px",
                    height: "500px",
                    ajax: {
                        url: '/dashboard/promote/view-big',
                        data: {
                            url: url,
                            title: "【" + name + "】推广码",
                            sub_title: "手机扫码访问门店",
                        }
                    },
                    end: function(index, object) {
                        $.loading.stop();
                    }
                });
            });
        });
        // 一键登录连锁门店后台
        $("body").on('click', '.oneclick', function() {
            var id = $(this).data("multi-store-id");
            var store_url = $(this).data("url");
            $.ajax({
                cache: false,
                type: "POST",
                data: {
                    id: id
                },
                url: "oneclick",
                success: function(result) {
                    var result = eval('(' + result + ')');
                    if (result.code == 0) {
                        store_url += '?token=' + result.rand_code;
                        $.go(store_url, "_blank", false);
                    } else {
                        $.alert(result.message, {
                            icon: 2
                        });
                    }
                },
                error: function(result) {
                    $.msg("对不起，您现在还没有获得此操作的权限");
                }
            });
        });
        //
        $(document).ready(function() {
            // 编辑分成比例
            $(".take_rate").editable({
                type: "text",
                url: "/dashboard/multi-store/edit-store-info",
                pk: 1,
                ajaxOptions: {
                    type: "post"
                },
                params: function(params) {
                    params.store_id = $(this).data("store_id");
                    params.title = 'take_rate';
                    return params;
                },
                /* validate: function(value) {
                    value = $.trim(value);
                    if (!value) {
                        return '商品价格不能为空。';
                    } else if (isNaN(value)) {
                        return '商品价格必须是有效的数字。';
                    } else if (value < 0.01) {
                        return '价格必须是0.01~9999999之间的数字。';
                    } else if (value > 9999999) {
                        return '价格必须是0.01~9999999之间的数字。';
                    }
                }, */
                success: function(response, newValue) {
                    var response = eval('(' + response + ')');
                    // 错误处理
                    if (response.code == -1) {
                        return response.message;
                    }
                },
                display: function(value, sourceData) {
                    // 保留两位小数
                    $(this).html((Number(value)).toFixed(2));
                },
                error: function(response, newValue) {
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop