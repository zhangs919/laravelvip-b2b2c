{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/base.css?v=20181020"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/jquery-ui.css?v=20181020"/>
    <link rel="stylesheet" href="/seller/css/waybill.css?v=20181020"/>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180919"></script>
    <script src="/seller/js/jquery-ui.js?v=20180919"></script>
@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30">
        <form id="ShopShipping" class="form-horizontal" name="ShopShipping" action="/shop/shipping/edit?id={{ $info->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" id="shopshipping-id" class="form-control" name="ShopShipping[id]" value="{{ $info->id }}">
            <div class="simple-form-field ">
                <div class="form-group">
                    <label for="text4" class="col-sm-2 control-label">
                        <span class="ng-binding">运单模板名称：</span>
                    </label>
                    <div class="col-sm-10">
                        <label class="control-label" style="font-size: 16px;">
                            <b>{{ $info->shipping->shipping_name }}</b>
                        </label>
                    </div>
                </div>
            </div>
            <!-- 运单尺寸 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">运单尺寸：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">


                            <input type="text" id="shopshipping-img_width" class="form-control ipt m-r-5" name="ShopShipping[img_width]" value="{{ $info->img_width }}">

                            x

                            <input type="text" id="shopshipping-img_height" class="form-control ipt m-l-5 m-r-5" name="ShopShipping[img_height]" value="{{ $info->img_height }}">mm


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">标准尺寸为869*480mm，不建议修改</div></div>
                    </div>
                </div>
            </div>
            <!-- 上偏移量 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopshipping-offset_top" class="col-sm-2 control-label">

                        <span class="ng-binding">上偏移量：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">


                            <input type="text" id="shopshipping-offset_top" class="form-control w200" name="ShopShipping[offset_top]" value="{{ $info->offset_top }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">运单模板上偏移量，单位为像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 左偏移量 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopshipping-offset_left" class="col-sm-2 control-label">

                        <span class="ng-binding">左偏移量：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">


                            <input type="text" id="shopshipping-offset_left" class="form-control w200" name="ShopShipping[offset_left]" value="{{ $info->offset_left }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">运单模板左偏移量，单位为像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 模板图片 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopshipping-img_path" class="col-sm-2 control-label">

                        <span class="ng-binding">模板图片：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="form-control-box">


                            <div id="imagegroup_container"></div>
                            <input type="hidden" id="shopshipping-img_path" class="form-control" name="ShopShipping[img_path]" value="{{ $info->img_path }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">请上传扫描好的运单图片，图片尺寸必须与快递单实际尺寸相符</div></div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field ">
                <div class="form-group">
                    <label for="text4" class="col-sm-2 control-label">
                        <span class="ng-binding">添加打印项：</span>
                    </label>
                    <div class="col-sm-10">
                        <div class="authset-list b-n bg-none">
                            <ul id="waybill_item_list" class="authset-section b-n">

                                @foreach(get_shipping_config_lable() as $lable_code=>$lable_name)
                                    @if(key_exists($lable_code, $info->config_lable))
                                        <li class="p-l-0 p-r-20">
                                            <label>
                                                <input type="checkbox" id="{{ $lable_code }}" name="xzbox" class="checkBox" data-waybill-name="{{ $lable_code }}" data-waybill-text="{{ $lable_name }}" checked="checked">
                                                {{ $lable_name }}
                                            </label>
                                        </li>
                                        <input id="width_{{ $lable_code }}" type="hidden" value="{{ $info->config_lable[$lable_code][2] }}">
                                        <input id="height_{{ $lable_code }}" type="hidden" value="{{ $info->config_lable[$lable_code][3] }}">
                                        <input id="left_{{ $lable_code }}" type="hidden" value="{{ $info->config_lable[$lable_code][4] }}">
                                        <input id="top_{{ $lable_code }}" type="hidden" value="{{ $info->config_lable[$lable_code][5] }}">
                                    @else
                                        <li class="p-l-0 p-r-20">
                                            <label>
                                                <input type="checkbox" id="{{ $lable_code }}" name="xzbox" class="checkBox" data-waybill-name="{{ $lable_code }}" data-waybill-text="{{ $lable_name }}" >
                                                {{ $lable_name }}
                                            </label>
                                        </li>
                                        <input id="width_{{ $lable_code }}" type="hidden" value="">
                                        <input id="height_{{ $lable_code }}" type="hidden" value="">
                                        <input id="left_{{ $lable_code }}" type="hidden" value="">
                                        <input id="top_{{ $lable_code }}" type="hidden" value="">
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-2 control-label">
                        <span class="ng-binding">打印项偏移校正：</span>
                    </label>
                    <div class="col-xs-10">
                        <div class="express-box">

                            <img id="img_bg" src="{{ get_image_url($info->img_path) }}" style="width:{{ $info->img_width }}px; height:{{ $info->img_height }}px;" />

                            <div class="express-center">


                                @foreach($info->config_lable as $item)
                                    <div id="div_{{ $item[0] }}" data-item-name="{{ $item[0] }}"
                                         class="message-box ui-draggable ui-draggable-handle ui-resizable"
                                         style="left: {{ $item[4] }}px; top:{{ $item[5] }}px; width:{{ $item[2] }}px; height:{{ $item[3] }}px;">
                                        <span>{{ $item[1] }}</span>
                                        <a id="cancel_{{ $item[0] }}" class="close-btn" href="javascript:;" title="删除">×</a>
                                    </div>
                                @endforeach





                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="simple-form-field p-b-30  text-c">
            <div class="form-group">
                <!-- col-sm-2 control-label后加hide为隐藏； col-xs-12后改为12，原为10 -->
                <label for="text4" class="col-sm-2 control-label hide"></label>
                <div class="col-xs-12">
                    <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
                </div>
            </div>
        </div>
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

{{--footer script page元素同级下面--}}
@section('footer_script')

    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "shopshipping-shop_id", "name": "ShopShipping[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺编号必须是整数。"}}},{"id": "shopshipping-shipping_id", "name": "ShopShipping[shipping_id]", "attribute": "shipping_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"快递公司编号必须是整数。"}}},{"id": "shopshipping-is_default", "name": "ShopShipping[is_default]", "attribute": "is_default", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否为默认快递公司必须是整数。"}}},{"id": "shopshipping-is_open", "name": "ShopShipping[is_open]", "attribute": "is_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺是否开启此快递必须是整数。"}}},{"id": "shopshipping-img_width", "name": "ShopShipping[img_width]", "attribute": "img_width", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"背景图片宽度必须是整数。"}}},{"id": "shopshipping-img_height", "name": "ShopShipping[img_height]", "attribute": "img_height", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"背景图片高度必须是整数。"}}},{"id": "shopshipping-offset_top", "name": "ShopShipping[offset_top]", "attribute": "offset_top", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上偏移量必须是整数。"}}},{"id": "shopshipping-offset_left", "name": "ShopShipping[offset_left]", "attribute": "offset_left", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"左偏移量必须是整数。"}}},{"id": "shopshipping-config_lable", "name": "ShopShipping[config_lable]", "attribute": "config_lable", "rules": {"string":true,"messages":{"string":"配置标签必须是一条字符串。"}}},{"id": "shopshipping-img_path", "name": "ShopShipping[img_path]", "attribute": "img_path", "rules": {"string":true,"messages":{"string":"模板图片必须是一条字符串。","maxlength":"模板图片只能包含至多255个字符。"},"maxlength":255}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ShopShipping").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $('#btn_submit').click(function() {

                if (!validator.form()) {
                    return;
                }

                var data = $("#ShopShipping").serializeJson();

                var config_lable = "";
                $("input[type=checkbox][name='xzbox'][checked]").each(function() {
                    var item_text = $(this).attr('data-waybill-text');
                    var item_name = $(this).attr('data-waybill-name');
                    var left = $('#left_' + item_name).val();
                    var top = $('#top_' + item_name).val();
                    var width = $('#width_' + item_name).val();
                    var height = $('#height_' + item_name).val();
                    config_lable += item_name + "," + item_text + "," + width + "," + height + "," + left + "," + top + "||,||";
                });

                data.ShopShipping.config_lable = config_lable;

                // 开始加载
                $.loading.start();

                $.post('/shop/shipping/edit', {
                    id: '{{ $info->id }}',
                    data: data,
                }, function(result) {
                    if (result.code == 0) {
                        $.msg('操作成功！', {}, function() {
                            $.go('/shop/shipping/list');
                        });
                    } else {
                        $.msg('操作失败！');
                    }
                }, 'json').always(function() {
                    $.loading.stop();
                });

            });

            var draggable_event = {
                stop: function(event, ui) {
                    var item_name = ui.helper.attr('data-item-name');
                    var position = ui.helper.position();
                    $('#left_' + item_name).val(position.left);
                    $('#top_' + item_name).val(position.top);
                }
            };
            var resizeable_event = {
                stop: function(event, ui) {
                    var item_name = ui.helper.attr('data-item-name');
                    $('#width_' + item_name).val(ui.size.width);
                    $('#height_' + item_name).val(ui.size.height);
                }
            };
            $('#waybill_item_list input:checkbox').on('click', function() {
                var item_name = $(this).attr('data-waybill-name');
                var div_name = 'div_' + item_name;
                var cancel_name = 'cancel_' + item_name;
                if ($(this).prop('checked')) {
                    var item_text = $(this).attr('data-waybill-text');
                    var waybill_item = '<div id="' + div_name + '" data-item-name="' + item_name + '" class="message-box">' + item_text + '<a class="close-btn" id='+ cancel_name +' href="javascript:;" title="删除">×</a></div>';
                    $('.express-center').append(waybill_item);
                    $('#' + div_name).draggable(draggable_event);
                    $('#' + div_name).resizable(resizeable_event);
                    $('#left_' + item_name).val('0');
                    $('#top_' + item_name).val('0');
                    $('#width_' + item_name).val('120');
                    $('#height_' + item_name).val('22');
                    $('#' + item_name).attr("checked", true);
                    $('#' + cancel_name).click(function() {
                        $('#' + div_name).remove();
                        $('#' + item_name).attr("checked", false);
                    })
                } else {
                    $('#' + div_name).remove();
                    $('#' + item_name).attr("checked", false);
                }
            });

            // 初始化拖动事件
            $(".express-center > div").each(function() {
                $(this).draggable(draggable_event);
                $(this).resizable(resizeable_event);
            });

            // 关闭按钮时间
            $('.close-btn').on('click', function() {
                var cancel_name = $(this).attr('id');
                var div_id = cancel_name.substring(7);
                $('#div_' + div_id).remove();
                $('#' + div_id).attr("checked", false);
            });

            $("#imagegroup_container").imagegroup({
                host: "{{ get_oss_host() }}",
                size: 1,
                values: ["{{ get_image_url($info->img_path, 'no_default') }}"],
                // 回调函数
                callback: function(data) {
                    // 保存路径
                    $("#shopshipping-img_path").val(data.path);
                    $("#shopshipping-img_path_image").attr("ref", data.url);
                    $("#img_bg").attr("src", data.url);
                    $("#img_bg").css({
                        width: 869,
                        height: 480
                    });
                },
                // 移除的回调函数
                remove: function(value, values) {
                    $("#shopshipping-img_path").val(value);
                }
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop