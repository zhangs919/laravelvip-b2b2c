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
        <form id="NavWordsModel" class="form-horizontal" name="NavWordsModel" action="{{ $form_action }}" method="post">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="navwordsmodel-id" class="form-control" name="NavWordsModel[id]" value="{{ $info->id ?? ''}}">
            <!-- 推荐词名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navwordsmodel-words_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">推荐词名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navwordsmodel-words_name" class="form-control" name="NavWordsModel[words_name]" value="{{ $info->words_name ?? ''}}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            <!-- 推荐词类型 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navwordsmodel-words_type" class="col-sm-4 control-label">

                        <span class="ng-binding">推荐词类型：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select onchange="select_type(this.value)" class="form-control chosen-select" name="NavWordsModel[words_type]" >

                                @if(isset($info->id))
                                    <option value="0" @if($info->words_type == 0)selected="true"@endif>自定义链接</option>

                                    <option value="1" @if($info->words_type == 1)selected="true"@endif>关联商品分类</option>

                                    <option value="2" @if($info->words_type == 2)selected="true"@endif>搜索推荐词</option>
                                @else
                                    <option value="0" selected="true">自定义链接</option>

                                    <option value="1" >关联商品分类</option>

                                    <option value="2" >搜索推荐词</option>
                                @endif

                            </select>


                        </div>

                        <div class="help-block help-block-t">
                            <div class="help-block help-block-t">搜索推荐词类型：指点击新增的导航名称时，系统自动根据推荐词搜索相应的商品，进入搜索结果页<br/>
                                关联分类类型：指为新增加的分类导航绑定一个商场的分类，当用户点击此词时进入相应的分类商品列表页面<br/>
                                链接类型：可为新增的导航词添加链接，点击该词后会进入链接的页面
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 推荐词连接 -->
            <div id ="words_link"></div>
            <!-- 是否新窗口打开 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navwordsmodel-new_open" class="col-sm-4 control-label">

                        <span class="ng-binding">是否新窗口打开：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavWordsModel[new_open]" value="0">
                                    <label>
                                        @if(isset($info->new_open))
                                        <input type="checkbox" id="navwordsmodel-new_open" class="form-control b-n"
                                                name="NavWordsModel[new_open]" value="1" @if($info->new_open == 1)checked @endif data-on-text="是"
                                                data-off-text="否">
                                        @else
                                        <input type="checkbox" id="navwordsmodel-new_open" class="form-control b-n"
                                               name="NavWordsModel[new_open]" value="1" checked data-on-text="是"
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
            <!-- 是否显示 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="navwordsmodel-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavWordsModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="navwordsmodel-is_show" class="form-control b-n"
                                                   name="NavWordsModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navwordsmodel-is_show" class="form-control b-n"
                                                   name="NavWordsModel[is_show]" value="1" checked data-on-text="是"
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
                    <label for="navwordsmodel-words_sort" class="col-sm-4 control-label">

                        <span class="ng-binding">推荐词排序：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="navwordsmodel-words_sort" class="form-control small" name="NavWordsModel[words_sort]" value="255">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
                    </div>
                </div>
            </div>

            <!-- 确认提交 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
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
        [{"id": "navwordsmodel-words_name", "name": "NavWordsModel[words_name]", "attribute": "words_name", "rules": {"required":true,"messages":{"required":"推荐词名称不能为空。"}}},{"id": "navwordsmodel-category_id", "name": "NavWordsModel[category_id]", "attribute": "category_id", "rules": {"required":true,"messages":{"required":"首页分类ID不能为空。"}}},{"id": "navwordsmodel-new_open", "name": "NavWordsModel[new_open]", "attribute": "new_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否新窗口打开必须是整数。"}}},{"id": "navwordsmodel-is_show", "name": "NavWordsModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navwordsmodel-words_sort", "name": "NavWordsModel[words_sort]", "attribute": "words_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"推荐词排序必须是整数。"}}},{"id": "navwordsmodel-words_type", "name": "NavWordsModel[words_type]", "attribute": "words_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"推荐词类型必须是整数。"}}},{"id": "navwordsmodel-category_id", "name": "NavWordsModel[category_id]", "attribute": "category_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"首页分类ID必须是整数。"}}},{"id": "navwordsmodel-words_name", "name": "NavWordsModel[words_name]", "attribute": "words_name", "rules": {"string":true,"messages":{"string":"推荐词名称必须是一条字符串。","maxlength":"推荐词名称只能包含至多255个字符。"},"maxlength":255}},{"id": "navwordsmodel-words_link", "name": "NavWordsModel[words_link]", "attribute": "words_link", "rules": {"string":true,"messages":{"string":"推荐词连接必须是一条字符串。","maxlength":"推荐词连接只能包含至多255个字符。"},"maxlength":255}},]
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#NavWordsModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#NavWordsModel").submit();

            });
            select_type('{{ $info->words_type ?? 0 }}');
        });

        function select_type(option){
            switch(option){
                case '0':
                    $.ajax({
                        url:'open-words-link',
                        dataType:'json',
                        data:{
                            type:0,
                            link:'{{ $info->words_link ?? '' }}'
                        },
                        success:function(result){
                            $("#words_link").html(result.data);
                        }
                    });
                    break;
                case '1':
                    $.ajax({
                        url:'open-words-link',
                        dataType:'json',
                        data:{
                            type:1,
                            link:'{{ $info->words_link ?? '' }}'
                        },
                        success:function(result){
                            $("#words_link").html(result.data);
                        }
                    });

                    break;
                case '2':
                    $("#words_link").html('{{ $info->words_link ?? '' }}');
                    break;

            }
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop