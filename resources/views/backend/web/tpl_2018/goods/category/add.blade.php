{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="CategoryModel" class="form-horizontal" name="CategoryModel" action="" method="POST" novalidate="novalidate">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="categorymodel-cat_id" class="form-control" name="CategoryModel[cat_id]" value="{{ $info->cat_id ?? ''}}">
            <!-- 分类名称 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="categorymodel-cat_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">分类名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="categorymodel-cat_name" class="form-control" name="CategoryModel[cat_name]" value="{{ $info->cat_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            @if(!isset($info->cat_id))
            <!-- 上级分类ID -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="categorymodel-parent_id" class="col-sm-4 control-label">

                        <span class="ng-binding">上级分类ID：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div class="cat_selector m-t-5"></div>
                            <input type="hidden" id="categorymodel-parent_id" class="parent-id" name="CategoryModel[parent_id]" value="{{ $parent_id ?? '0'}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">上级商品分类，商品分类最多支持三级</div></div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 分类图标 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="categorymodel-cat_image" class="col-sm-4 control-label">

                        <span class="ng-binding">分类图标：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <div id="cat_image_container"><ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul></div>
                            <input type="hidden" id="categorymodel-cat_image" class="form-control" name="CategoryModel[cat_image]" value="{{ $info->cat_image ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">此分类图标用于手机端分类页面顶部图片展示，最佳显示尺寸为640*200像素</div></div>
                    </div>
                </div>
            </div>
            <!-- 佣金比例 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="categorymodel-take_rate" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">佣金比例：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="categorymodel-take_rate" class="form-control ipt m-r-10" name="CategoryModel[take_rate]" value="{{ $info->take_rate ?? '0'}}">%


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">分佣比例必须为0~100之间的数字，设置佣金比例后，请勿随意修改</div></div>
                    </div>
                </div>
            </div>
            <div class="is-parent">
                <!-- 分佣比例是否关联到子分类 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="categorymodel-sync_take_rate" class="col-sm-4 control-label">

                            <span class="ng-binding">佣金比例是否关联到子分类：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="hidden" name="CategoryModel[sync_take_rate]" value="{{ $info->sync_take_rate ?? ''}}">
                                @if(isset($info->cat_id))
                                <div id="categorymodel-sync_take_rate" class="" name="CategoryModel[sync_take_rate]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[sync_take_rate]" value="0" @if($info->sync_take_rate == 0)checked=""@endif> 不同步更新到子分类</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[sync_take_rate]" value="1" @if($info->sync_take_rate == 1)checked=""@endif> 同步更新给子分类</label>
                                </div>
                                @else
                                <div id="categorymodel-sync_take_rate" class="" name="CategoryModel[sync_take_rate]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[sync_take_rate]" value="0" checked=""> 不同步更新到子分类</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[sync_take_rate]" value="1"> 同步更新给子分类</label>
                                </div>
                                @endif

                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">选择"是"，该分类下的子分类分佣比例将被更新并按当前比例设定，更新后您还可以到子分类下重新设置分佣比例~<font color="red">“此设置仅用于此次操作，下次操作请重新选择”</font></div></div>
                        </div>
                    </div>
                </div>

                <!-- 是否允许发布虚拟商品 -->
                <!--
            <div class="simple-form-field" >
    <div class="form-group">
    <label for="categorymodel-show_virtual" class="col-sm-4 control-label">

    <span class="ng-binding">是否允许发布虚拟商品：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">

            <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="CategoryModel[show_virtual]" value="0"><label><input type="checkbox" id="categorymodel-show_virtual" class="form-control b-n" name="CategoryModel[show_virtual]" value="1" data-on-text="是" data-off-text="否"> </label>
    </div>
    </label>

    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">选择"是"，该分类下发布的商品可以选择发布的商品是否为虚拟商品</div></div>
    </div>
    </div>
    </div>
            -->
                <!-- 发布虚拟商品是否关联到子分类 -->
                <!--
            <div class="simple-form-field" >
    <div class="form-group">
    <label for="categorymodel-sync_show_virtual" class="col-sm-4 control-label">

    <span class="ng-binding">发布虚拟商品是否关联到子分类：</span>
    </label>
    <div class="col-sm-8">
    <div class="form-control-box">

            <label class="control-label control-label-switch">
    <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
    <input type="hidden" name="CategoryModel[sync_show_virtual]" value="0"><label><input type="checkbox" id="categorymodel-sync_show_virtual" class="form-control b-n" name="CategoryModel[sync_show_virtual]" value="1" data-on-text="是" data-off-text="否"> </label>
    </div>
    </label>

    </div>

    <div class="help-block help-block-t"><div class="help-block help-block-t">选择"是"，该分类下的子分类都将更新为此分类的是否允许发布虚拟商品的设置</div></div>
    </div>
    </div>
    </div>

                <!-- 展示形式-->
                <div class="show-mode">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="categorymodel-show_mode" class="col-sm-4 control-label">

                                <span class="ng-binding">商品列表页商品展示方式：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">


                                    <input type="hidden" name="CategoryModel[show_mode]" value="{{ $info->show_mode ?? ''}}">
                                    @if(isset($info->cat_id))
                                        <div id="categorymodel-show_mode" class="" name="CategoryModel[show_mode]" uncheck="0">
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[show_mode]" value="0" @if($info->show_mode == 0)checked=""@endif> 默认主图</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[show_mode]" value="1" @if($info->show_mode == 1)checked=""@endif> 规格相册</label>
                                        </div>
                                    @else
                                        <div id="categorymodel-show_mode" class="" name="CategoryModel[show_mode]" uncheck="0">
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[show_mode]" value="0" checked=""> 默认主图</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="CategoryModel[show_mode]" value="1"> 规格相册</label>
                                        </div>
                                    @endif

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">设置商品列表页面商品的展示形式，默认仅展示商品主图，设置为规格相册后，会将每个商品的规格主图以小图展示出来，让用户能在列表页面即切换看到每个商品的规格主图</div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 是否允许新增下级分类 -->
                <div class="is-change">

                    @if($cat_level == 3)
                    <input type="hidden" id="categorymodel-is_parent" class="form-control" name="CategoryModel[is_parent]" value="0">
                    @else
                    <div class="simple-form-field">
                            <div class="form-group">
                                <label for="categorymodel-is_parent" class="col-sm-4 control-label">

                                    <span class="ng-binding">是否允许新增下级分类：</span>
                                </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box">

                                        <label class="control-label control-label-switch">
                                            <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                                <input type="hidden" name="CategoryModel[is_parent]" value="0">
                                                @if(!isset($info->is_parent))
                                                    <label>
                                                        <input type="checkbox"
                                                               id="categorymodel-is_parent"
                                                               class="form-control b-n"
                                                               name="CategoryModel[is_parent]"
                                                               value="1" checked=""
                                                               data-on-text="允许" data-off-text="禁止"></label>
                                                @else
                                                    <label>
                                                        <input type="checkbox"
                                                               id="categorymodel-is_parent"
                                                               class="form-control b-n"
                                                               name="CategoryModel[is_parent]"
                                                               value="1" @if($info->is_parent == 1)checked="" @endif
                                                               data-on-text="允许" data-off-text="禁止"></label>
                                                @endif
                                            </div>
                                        </label>


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">禁止后此分类将无法新增下级分类，只有末级分类才能关联商品属性、规格</div></div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <!-- 分类链接 -->

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="categorymodel-cat_link" class="col-sm-4 control-label">

                        <span class="ng-binding">分类链接：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            {{--<div class="chosen-container chosen-container-single" title="" id="select_link_type_chosen">
                                <a class="chosen-single" tabindex="-1"><span>自定义链接</span>
                                    <div><b></b></div>
                                </a>
                                <div class="chosen-drop">
                                    <div class="chosen-search"><input type="text" autocomplete="off" class="valid"
                                                                      aria-invalid="false"></div>
                                    <ul class="chosen-results">
                                        <li class="active-result result-selected" data-option-array-index="0" style="">
                                            自定义链接
                                        </li>
                                        <li class="active-result" data-option-array-index="1" style="">常用链接</li>
                                        <li class="active-result" data-option-array-index="2" style="">店铺主页</li>
                                        <li class="active-result" data-option-array-index="3" style="">文章分类</li>
                                        <li class="active-result" data-option-array-index="4" style="">文章详情</li>
                                        <li class="active-result" data-option-array-index="5" style="">分类商品</li>
                                        <li class="active-result" data-option-array-index="6" style="">团购活动</li>
                                        <li class="active-result" data-option-array-index="7" style="">品牌专题</li>
                                        <li class="active-result" data-option-array-index="8" style="">专题活动</li>
                                    </ul>
                                </div>
                            </div>--}}
                            <select name="link_type" class="form-control chosen-select" id="select_link_type"
                                    style="width: 150px; display: none;">

                            <option value="0" selected="true">自定义链接</option>

                                <option value="1">常用链接</option>

                                <option value="3">店铺主页</option>

                                <option value="8">文章分类</option>

                                <option value="4">文章详情</option>

                                <option value="5">分类商品</option>

                                <option value="6">团购活动</option>

                                <option value="7">品牌专题</option>

                                <option value="9">专题活动</option>

                            </select>
                            <span id="cat_link"></span>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">设置链接后在分类列表页点击分类直接跳转到链接页面</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="categorymodel-cat_sort" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="categorymodel-cat_sort" class="form-control small m-r-10" name="CategoryModel[cat_sort]" value="{{ $info->cat_sort ?? '255'}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </form>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"trim":true,"messages":{"trim":""}}},{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"required":true,"messages":{"required":"分类名称不能为空。"}}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "categorymodel-take_rate", "name": "CategoryModel[take_rate]", "attribute": "take_rate", "rules": {"required":true,"messages":{"required":"佣金比例不能为空。"}}},{"id": "categorymodel-parent_id", "name": "CategoryModel[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级分类ID必须是整数。"}}},{"id": "categorymodel-show_mode", "name": "CategoryModel[show_mode]", "attribute": "show_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品列表页商品展示方式必须是整数。"}}},{"id": "categorymodel-show_virtual", "name": "CategoryModel[show_virtual]", "attribute": "show_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许发布虚拟商品必须是整数。"}}},{"id": "categorymodel-is_show", "name": "CategoryModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "categorymodel-is_parent", "name": "CategoryModel[is_parent]", "attribute": "is_parent", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否允许新增下级分类必须是整数。"}}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "categorymodel-take_rate", "name": "CategoryModel[take_rate]", "attribute": "take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例必须是一个数字。","min":"佣金比例必须不小于0。","max":"佣金比例必须不大于100。"},"min":0,"max":100}},{"id": "categorymodel-sync_take_rate", "name": "CategoryModel[sync_take_rate]", "attribute": "sync_take_rate", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"佣金比例是否关联到子分类必须是一个数字。","min":"佣金比例是否关联到子分类必须不小于0。","max":"佣金比例是否关联到子分类必须不大于100。"},"min":0,"max":100}},{"id": "categorymodel-ext_info", "name": "CategoryModel[ext_info]", "attribute": "ext_info", "rules": {"string":true,"messages":{"string":"分类扩展字段必须是一条字符串。"}}},{"id": "categorymodel-cat_image", "name": "CategoryModel[cat_image]", "attribute": "cat_image", "rules": {"string":true,"messages":{"string":"分类图标必须是一条字符串。"}}},{"id": "categorymodel-cat_name", "name": "CategoryModel[cat_name]", "attribute": "cat_name", "rules": {"string":true,"messages":{"string":"分类名称必须是一条字符串。","maxlength":"分类名称只能包含至多30个字符。"},"maxlength":30}},{"id": "categorymodel-keywords", "name": "CategoryModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_desc", "name": "CategoryModel[cat_desc]", "attribute": "cat_desc", "rules": {"string":true,"messages":{"string":"分类描述必须是一条字符串。","maxlength":"分类描述只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_link", "name": "CategoryModel[cat_link]", "attribute": "cat_link", "rules": {"string":true,"messages":{"string":"分类链接必须是一条字符串。","maxlength":"分类链接只能包含至多255个字符。"},"maxlength":255}},{"id": "categorymodel-cat_sort", "name": "CategoryModel[cat_sort]", "attribute": "cat_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
    </script>

    @if(!isset($info->cat_id))
    <script type="text/javascript">
        $().ready(function() {
            var catselector = $(".cat_selector").catselector({
                size: 1,
                values: ["{{ $parent_id ?? '0'}}"],
                data: {
                    deep: 3
                },
                addCallback: function(id, name, node) {
                    if (node.cat_level == 1) {
                        $(".show-mode").show();
                    } else {
                        $(".show-mode").hide();
                    }

                    if (node.cat_level == 3) {
                        $(".is-parent").hide();
                    } else {
                        $(".is-parent").show();
                    }

                    $(".parent-id").val(id);
                }
            });

            catselector.load();
        });
    </script>
    @endif

    <script type="text/javascript">
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

            function change() {
            }
            function add() {
                $.go('/goods/category/add?parent_id=0');
            }

            function addChild(id) {
                $.go('/goods/category/add?parent_id=' + id);
            }

            function editFilter(id) {
                $.go('/goods/category/edit-filter?id=' + id);
            }

            function editOther(id) {
                $.go('/goods/category/edit-other?id=' + id);
            }

            function toList() {
                $.go('/goods/category/list');
            }

            function cancel() {

            }
            var validator = $("#CategoryModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }

                var data = $("#CategoryModel").serializeJson();

                var url = $("#CategoryModel").attr("action");

                //加载提示
                $.loading.start();

                $.post(url, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message);
                        //
                        @if(isset($info->cat_id))
                        $.go('/goods/category/edit?id=' + result.data.cat_id);
                        @else
                        $.confirm("是否继续添加商品分类？", function() {
                            $.go('/goods/category/add?parent_id=' + result.data.parent_id);
                        }, function() {
                            $.go('/goods/category/edit?id=' + result.data.cat_id);
                        });
                        @endif
                        //
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json").always(function() {
                    $.loading.stop();
                });
            });

            $("#cat_image_container").imagegroup({
                // host: 'http://68yun.oss-cn-beijing.aliyuncs.com/images/14719/',
                host: '{{ get_oss_host() }}',
                size: 1,
                values: ['{{ $info->cat_image ?? ""}}'],
                callback: function(data) {
                    $("#categorymodel-cat_image").val(data.path);
                },
                remove: function(value, values) {
                    $("#categorymodel-cat_image").val('');
                }
            });

            //改变类型
            $("#select_link_type").change(function() {
                var link_type = $(this).val();
                $.ajax({
                    url: 'get-type-list',
                    dataType: 'json',
                    data: {
                        link_type: link_type,
                        cat_link: ''
                    },
                    success: function(result) {
                        if (link_type == 0) {
                            $("#cat_link").html("<input type='text' class='form-control valid' value='{{ $info->cat_link ?? ''}}' name='CategoryModel[cat_link]' placeholder='http://xxx.xxx'>");
                        } else {
                            $("#cat_link").html(result.data);
                        }
                    }
                });
            });

            $("#select_link_type").change();
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop