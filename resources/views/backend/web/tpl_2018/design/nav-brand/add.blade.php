{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="NavBrandModel" class="form-horizontal" name="NavBrandModel" action="{{ $form_action }}" method="post">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="navbrandmodel-id" class="form-control" name="NavBrandModel[id]" value="{{ $info->id ?? ''}}">

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-2 control-label"><span class="ng-binding">搜索品牌：</span> </label>
                    <div class="col-sm-8">
                        <input class="form-control m-r-10" placeholder="" type="text" value="" id="text_search">
                        <a class="btn btn-primary" id="btn_search" href="javascript:void(0);">搜索</a>
                    </div>
                </div>
            </div>

            @if(!isset($info->id))
            <div class="simple-form-field" id="select_brand" style="display:none">
                <div class="form-group">
                    <label for="text4" class="col-sm-2 control-label"><span class="ng-binding"><div id="brand_name">推荐品牌 </div></span> </label>
                    <div class="col-sm-8">
                        <!--<img src="http://xxx.oss-cn-beijing.aliyuncs.com/images/14719/" id="brand_logo" height="30px">-->
                        <img src="/images/default/goods.gif" id="brand_logo" height="30px" />
                    </div>
                    <input type="hidden" id="brand_id" name="NavBrandModel[brand_id]" value="{{ $info->brand_id ?? ''}}">
                </div>
            </div>
            @else
            <div class="simple-form-field" id="select_brand" >
                <div class="form-group">
                    <label for="text4" class="col-sm-2 control-label"><span class="ng-binding"><div id="brand_name">{{ $info->brand_name }} </div></span> </label>
                    <div class="col-sm-8">
                        <img src="{{ get_image_url($info->brand_logo) }}" id="brand_logo" height="30px" />
                    </div>
                    <input type="hidden" id="brand_id" name="NavBrandModel[brand_id]" value="{{ $info->brand_id }}">
                </div>
            </div>
            @endif

            <!-- 品牌列表 -->
            <div id="brand_list"></div>
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbrandmodel-is_show" class="col-sm-2 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavBrandModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="navbrandmodel-is_show" class="form-control b-n"
                                                   name="NavBrandModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navbrandmodel-is_show" class="form-control b-n"
                                                   name="NavBrandModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>


                                </div>
                            </label>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 推荐词排序 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navbrandmodel-brand_sort" class="col-sm-2 control-label">

                        <span class="ng-binding">排序：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">


                            <input type="text" id="navbrandmodel-brand_sort" class="form-control small" name="NavBrandModel[brand_sort]" value="{{ $info->brand_sort ?? 255}}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">


                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">

                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" />

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
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

{{--helper_tool--}}
@section('helper_tool')

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
    <!-- 图片预览 -->
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "navbrandmodel-id", "name": "NavBrandModel[id]", "attribute": "id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"推荐品牌ID必须是整数。"}}},{"id": "navbrandmodel-brand_id", "name": "NavBrandModel[brand_id]", "attribute": "brand_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"推荐品牌必须是整数。"}}},{"id": "navbrandmodel-category_id", "name": "NavBrandModel[category_id]", "attribute": "category_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"分类ID必须是整数。"}}},{"id": "navbrandmodel-is_show", "name": "NavBrandModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navbrandmodel-brand_sort", "name": "NavBrandModel[brand_sort]", "attribute": "brand_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#NavBrandModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                if($("#brand_id").val()==''){
                    $.msg("请先选择一个品牌");
                    return false;
                }
                //加载提示
                $.loading.start();
                $("#NavBrandModel").submit();

            });

            $("#btn_search").click(function(){
                var keywords = $("#text_search").val();
                $.ajax({
                    url:'brand-search',
                    dataType:'json',
                    data:{
                        brand_name:keywords
                    },
                    beforeSend:function(){
                        $.loading.start();
                    },
                    success:function(result){
                        $("#brand_list").html(result.data);
                        $.loading.stop();
                    },
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop