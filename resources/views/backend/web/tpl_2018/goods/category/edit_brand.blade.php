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
        <form id="CategoryModel" class="form-horizontal" name="CategoryModel" action="/goods/category/edit-brand?id={{ $id }}" method="POST">
            {{ csrf_field() }}
            <!-- 隐藏域 -->
            <input type="hidden" id="categorymodel-cat_id" class="form-control" name="cat_id" value="{{ $id }}">
            <!-- 品牌 -->
            <div id="values_brand" class="attr-values-area m-b-20">

                <select id="brand_list" class="form-control" name="brand_ids[]" multiple="multiple" size="4">
                    @foreach($list as $v)
                    <option value="{{ $v->brand_id }}" @if(in_array($v->brand_id, $brand_ids)) selected @endif>{{ $v->brand_name }}</option>
                    @endforeach
                </select>

            </div>
            <!-- 确认提交 -->
            <div class="text-c">

                <input type="button" id='btn_submit' value='确认提交' class="btn btn-primary" />

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
    <!-- 双向选择器:css -->
    <link rel="stylesheet" href="/assets/d2eace91/css/selector/jquery.multiselect2side.css?v=1.2"/>
    <!-- 双向选择器:js -->
    <script src="/assets/d2eace91/js/selector/jquery.multiselect2side.js?v=1.2"></script>
    <script type="text/javascript">
        $().ready(function() {
            $("#brand_list").multiselect2side({
                search: "搜索：",
                selectedPosition: "right",
                moveOptions: false,
                labelsx: " ",
                labeldx: "已选择的关联品牌"
            });
            $.stopEnterEvent($("#CategoryModel"));
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("#btn_submit").click(function() {
                var url = $("#CategoryModel").attr("action");
                var data = $("#CategoryModel").serializeJson();
                if (data.brand_ids) {
                    data.brand_ids = data.brand_ids.join(",");
                }
                //加载提示
                $.loading.start();
                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message);
                        $.go();
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop