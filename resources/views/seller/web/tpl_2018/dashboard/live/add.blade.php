{{--模板继承--}}
@extends('layouts.seller_layout')


{{--header 内 css文件--}}
@section('header_css')

@stop

{{--header 内 css文件--}}
@section('header_css_2')

@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="LiveModel" class="form-horizontal" name="LiveModel" action="/dashboard/live/add" method="post" enctype="multipart/form-data">
        @csrf
        <div class="table-content m-t-30 clearfix live-goods">
            <div class="form-horizontal">
                <!-- 隐藏域 -->
                <input type="hidden" id="livemodel-id" class="form-control" name="LiveModel[id]" value="{{ $model['id'] ?? '' }}">
                <!-- 活动名称 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-live_name" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">直播标题：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="livemodel-live_name" class="form-control"
                                       name="LiveModel[live_name]" value="{{ $model['live_name'] ?? '' }}">
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">直播标题必须在 1~20 个字内</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 活动图片 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-live_img" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">直播封面：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="act_img_container"></div>
                                <input type="hidden" id="livemodel-live_img" class="form-control"
                                       name="LiveModel[live_img]" value="{{ $model['live_img'] ?? '' }}">
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">
                                    直播封面图主要展示在直播活动列表页，建议上传最佳尺寸为：900*500像素<br>大小1M内的图片，支持jpg、jpeg、gif、png格式上传
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-region_code" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">直播所在地：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="region_container"></div>
                                <input type="hidden" id="region_code" class="form-control"
                                       name="LiveModel[region_code]" value="{{ $model['region_code'] }}">
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-cat_id" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">所属分类：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <select id="livemodel-cat_id" class="form-control chosen-select"
                                        name="LiveModel[cat_id]">
                                    <option value="">-- 请选择分类 --</option>
                                    @foreach($cat_list as $item)
                                        <option value="{{ $item['cat_id'] }}" @if($item['cat_id'] == @$model['cat_id']){{ 'selected' }}@endif>{!! $item['title_show'] !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group m-b-0">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="widget_goods" class="p-l-15 p-r-15 w800"></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <div id="goods_list" class="w800">
                                @if(!empty($goods_list))
                                    <table id="table_list" class="table table-hover live-list">
                                        <thead>
                                        <tr>
                                            <th class="w200">商品名称</th>
                                            <th class="w100 text-c">
                                                <span class="text-danger ng-binding">*</span>
                                                促销价
                                            </th>
                                            <th class="w80">商品售价</th>
                                            <th class="w70">库存</th>
                                            <th class="w80 text-c">
                                                <span class="text-danger ng-binding">*</span>
                                                活动库存
                                            </th>
                                            <th class="handle w90">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="goods_info">

                                        @foreach($goods_list as $v)
                                            <tr data-live-sku-id="{{ $v['sku_id'] }}" data-live-goods-id="{{ $v['goods_id'] }}">
                                                <td>
                                                    {{ $v['goods_name'] }}
                                                    <input type="hidden" name="goods_sku[]" value="{{ $v['sku_id'] }}">
                                                    <input type="hidden" name="goods_spu[]" value="{{ $v['goods_id'] }}" class="goods-id">
                                                </td>
                                                <td class="text-c">
                                                    <input class="form-control w60" type="text" name="activity_price[]" value="{{ $v['act_price'] }}" data-rule-required="true" data-msg-required="促销价不能为空！" data-rule-min="0.01" data-rule-max="9999999" onkeyup="clearNoNum(this)">
                                                </td>
                                                <td>￥{{ $v['goods_price'] }}</td>
                                                <td>{{ $v['goods_number'] }}</td>
                                                <td class="text-c">
                                                    <input class="form-control w60" type="text" name="activity_stock[]" value="{{ $v['act_stock'] }}" data-rule-required="true" data-msg-required="活动库存不能为空！" data-rule-min="1" data-rule-digits="true" data-rule-max="9999999">
                                                </td>
                                                <td class="handle">
                                                    <a href="javascript:void(0);" data-sku-id="{{ $v['sku_id'] }}" data-goods-id="{{ $v['goods_id'] }}" class="del border-none">删除</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    <script type="text/javascript">
                                        //
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 关键词 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-keywords" class="col-sm-3 control-label">
                            <span class="ng-binding">直播关键词：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                            <textarea id="livemodel-keywords" class="form-control"
                                                      name="LiveModel[keywords]" rows="5">{!! $model['keywords'] ?? '' !!}</textarea>
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">直播关键词会加入到直播SEO优化中，50个字以内</div>
                            </div>
                        </div>
                    </div>
                </div>            <!-- 说明 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-description" class="col-sm-3 control-label">
                            <span class="ng-binding">直播内容：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                            <textarea id="livemodel-description" class="form-control"
                                                      name="LiveModel[description]" rows="5">{!! $model['description'] ?? '' !!}</textarea>
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">直播内容会加入到直播SEO优化中，100个字以内</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 分享推广图 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-share_img" class="col-sm-3 control-label">
                            <span class="ng-binding">分享推广图：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="share_img_container"></div>
                                <input type="hidden" id="livemodel-share_img" class="form-control"
                                       name="LiveModel[share_img]" value="{{ $model['share_img'] ?? '' }}">
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">此推广图应用于分享功能处显示，建议上传正方形图片，最佳显示尺寸为80*80像素<br>大小1M内的图片，支持jpg、jpeg、gif、png格式上传
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 排序 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="livemodel-sort" class="col-sm-3 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">排序：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" id="livemodel-sort" class="form-control small"
                                       name="LiveModel[sort]" value="{{ $model['sort'] }}">
                            </div>
                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 确认提交 -->
                <div class="bottom-btn p-b-30">
                    <input type="button" id="btn_submit" name="btn_submit" class="btn btn-primary btn-lg"
                           value="确认提交"/>
                </div>
            </div>
        </div>
    </form>
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')
    <script id="goods" type="text">
<table id="table_list" class="table table-hover m-b-0 live-list">
    <thead>
        <tr>
            <th class="w200">商品名称</th>
            <th class="w100 text-c">
                <span class="text-danger ng-binding">*</span>
                促销价
            </th>
            <th class="w80">商品售价</th>
            <th class="w70">库存</th>
            <th class="w80 text-c">
                <span class="text-danger ng-binding">*</span>
                活动库存
            </th>
            <th class="handle w90">操作</th>
        </tr>
    </thead>
    <tbody id="goods_info">
            </tbody>
</table>
            </script>
    <script id="add_goods" type="text">
                <tr data-live-sku-id="" data-live-goods-id="">
                <td>
                <input type="hidden" name="goods_sku[]" value="">
                <input type="hidden" name="goods_spu[]" value="">
                </td>
                <td class="text-c">
                <input class="form-control w60" type="text" name="activity_price[]" data-rule-required="true" data-msg-required="促销价不能为空！" data-rule-min="0.01" data-rule-max="9999999" onkeyup="clearNoNum(this)">
                </td>
                <td></td>
                <td></td>
                <td class="text-c">
                <input class="form-control w60" type="text" name="activity_stock[]" data-rule-required="true" data-msg-required="活动库存不能为空！" data-rule-min="1" data-rule-digits="true" data-rule-max="9999999">
                </td>
                <td class="handle">
                <a href="javascript:void(0);" data-sku-id="" data-goods-id="" class="del border-none">删除</a>
                </td>
                </tr></script>
    <!-- 地区选择 -->
    <script id="client_rules" type="text">
[{"id": "livemodel-live_name", "name": "LiveModel[live_name]", "attribute": "live_name", "rules": {"required":true,"messages":{"required":"直播标题不能为空。"}}},{"id": "livemodel-cat_id", "name": "LiveModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"所属分类不能为空。"}}},{"id": "livemodel-sort", "name": "LiveModel[sort]", "attribute": "sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "livemodel-region_code", "name": "LiveModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"直播所在地不能为空。"}}},{"id": "livemodel-live_img", "name": "LiveModel[live_img]", "attribute": "live_img", "rules": {"required":true,"messages":{"required":"直播封面不能为空。"}}},{"id": "livemodel-shop_id", "name": "LiveModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "livemodel-is_recommend", "name": "LiveModel[is_recommend]", "attribute": "is_recommend", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Recommend必须是整数。"}}},{"id": "livemodel-status", "name": "LiveModel[status]", "attribute": "status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核状态必须是整数。"}}},{"id": "livemodel-is_delete", "name": "LiveModel[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Delete必须是整数。"}}},{"id": "livemodel-live_name", "name": "LiveModel[live_name]", "attribute": "live_name", "rules": {"string":true,"messages":{"string":"直播标题必须是一条字符串。","maxlength":"直播标题只能包含至多20个字符。"},"maxlength":20}},{"id": "livemodel-sort", "name": "LiveModel[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "livemodel-keywords", "name": "LiveModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"直播关键词必须是一条字符串。","maxlength":"直播关键词只能包含至多50个字符。"},"maxlength":50}},{"id": "livemodel-description", "name": "LiveModel[description]", "attribute": "description", "rules": {"string":true,"messages":{"string":"直播内容必须是一条字符串。","maxlength":"直播内容只能包含至多100个字符。"},"maxlength":100}},]
</script>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        // {jsBlock}
        function clearNoNum(obj){
            obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符
            obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的
            obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
            obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入两个小数
            if(obj.value.indexOf(".")< 0 && obj.value !=""){//以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额
                obj.value= parseFloat(obj.value);
            }
        }
        // {/jsBlock}
    </script>
@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        $().ready(function() {
            //删除直播商品
            $("body").on("click", ".del", function() {
                var target = $(this).parents("tr");
                var goods_id = $(this).data("goods-id");
                var sku_id = $(this).data("sku-id");
                var container = $(this).parents(".live-goods").find("#widget_goods");
                var goodspicker = $.goodspicker(container);
                if (goodspicker) {
                    // 获取控件
                    goodspicker.remove(goods_id, sku_id);
                    var selected_number = goodspicker.goods_ids.length;
                    if (selected_number == 0) {
                        $(this).parents("table").remove();
                    }
                }
                $(target).remove();
            });
        });
        //
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });
            };
            var validator = $("#LiveModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    var html = "";
                    error_list = validator.errorList;
                    for (var i = 0; i < validator.errorList.length; i++) {
                        var element = validator.errorList[i].element;
                        var message = validator.errorList[i].message;
                        var element = $(error_list[i].element);
                        $(element).focus();
                        $(window).scrollTop($(element).offset().top - $(window).height() + 120);
                    }
                    return false;
                }
                $.loading.start();
                if ("{{ $model['id'] ?? '' }}" == "") {
                    $.post('/dashboard/live/add', $("#LiveModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            setTimeout(function() {
                                $.go('/dashboard/live/list');
                            }, 3000);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                } else {
                    $.post('/dashboard/live/edit?id={{ $model['id'] ?? '' }}', $("#LiveModel").serializeJson(), function(result) {
                        // 停止加载
                        $.loading.stop();
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 3000
                            });
                            // 加载
                            setTimeout(function() {
                                $.go('/dashboard/live/list');
                            }, 3000);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, 'json');
                }
            });
            $("#region_container").regionselector({
                value: '{{ $model['region_code'] }}',
                select_class: 'form-control',
                change: function(value, names, is_last) {
                    $('#region_code').val(value);
                }
            });
            $("#act_img_container").imagegroup({
                host: '{{ get_oss_host() }}',
                size: 1,
                gallery: true,
                values: ['{{ $model['live_img'] ?? '' }}'],
                callback: function(data) {
                    $("#livemodel-live_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#livemodel-live_img").val('');
                }
            });
            $("#share_img_container").imagegroup({
                host: '{{ get_oss_host() }}',
                size: 1,
                gallery: true,
                values: ['{{ $model['share_img'] ?? '' }}'],
                callback: function(data) {
                    $("#livemodel-share_img").val(data.path);
                },
                remove: function(value, values) {
                    $("#livemodel-share_img").val('');
                }
            });
            var values = [];
            $("body").find(".live-list").find("#goods_info").find("tr").each(function() {
                var goods_id = $(this).find(".goods-id").val();
                var sku_id = 0;
                values[goods_id + "-" + sku_id] = {
                    goods_id: goods_id,
                    sku_id: sku_id,
                };
            });
            // 初始化组件，为容器绑定组件
            var goodspicker = $("#widget_goods").goodspicker({
                url: '/dashboard/live/picker?act_id={{ $model['id'] ?? '' }}',
                // 组件ajax提交的数据，主要设置分页的相关设置
                data: {
                    page: {
                        // 分页唯一标识
                        // page_id: page_id
                    },
                    is_sku: 0
                    // 不能将自己作为赠品
                    //except_sku_ids: sku_id
                },
                // 已加载的数据
                values: values,
                // 选择商品和未选择商品的按钮单击事件
                // @param selected 点击是否选中
                // @param sku 选中的SKU对象
                // @return 返回false代表
                click: function(selected, sku) {
                    var goods_count = this.goods_ids.length;
                    var html = $("#goods").html();
                    if (selected == true) {
                        $.loading.start();
                        $.ajax({
                            type: "POST",
                            url: "goods-info",
                            dataType: "json",
                            data: {
                                goods_id: sku.goods_id
                            },
                            success: function(result) {
                                if (result.code == 0) {
                                    if (goods_count == 1) {
                                        $("#goods_list").html(html);
                                        $('#goods_info').html('');
                                    }
                                    $('#goods_info').prepend(result.data);
                                    $.loading.stop();
                                } else {
                                    goodspicker.remove(sku.goods_id, sku.sku_id);
                                    $.msg(result.message);
                                }
                            }
                        });
                    } else {
                        $("body").find("[data-live-sku-id='" + sku.sku_id + "']").remove();
                        if (goods_count == 0) {
                            $(".live-list").remove();
                        }
                    }
                },
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop