{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
	<script src="/assets/d2eace91/js/individual.js?v=1.2"></script>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

	<form id="NavigationModel" class="form-horizontal" name="NavigationModel" action="{{ $form_action }}" method="post" novalidate="novalidate">
		{{ csrf_field() }}
        <!-- 隐藏域 -->
        <input type="hidden" id="navigationmodel-id" class="form-control" name="NavigationModel[id]" value="{{ $info->id ?? ''}}">
        <div class="table-content m-t-30 clearfix">
        <!-- 样式 -->

            @if($nav_page == 'm_site')
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="navigationmodel-nav_class" class="col-sm-4 control-label">

                            <span class="ng-binding">功能选择：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <select id="navigationmodel-nav_class" class="form-control chosen-select"
                                        name="NavigationModel[nav_class]">
                                    <option value="">自定义链接</option>
                                    <option value="index-icon">仿淘宝“首页”菜单特效</option>
                                </select>


                            </div>

                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">可以选择系统设置的一些功能</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

			<!-- 导航名称  -->
			<div id="nav_name_container">
				<div class="simple-form-field">
					<div class="form-group">
						<label for="navigationmodel-nav_name" class="col-sm-4 control-label">
							<span class="text-danger ng-binding">*</span>
							<span class="ng-binding">导航名称：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">


								<input type="text" id="navigationmodel-nav_name" class="form-control" name="NavigationModel[nav_name]" value="{{ $info->nav_name ?? ''}}">


							</div>

							<div class="help-block help-block-t"><div class="help-block help-block-t">建议添加2~3个字显示效果最佳</div></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 导航类型 -->
			<div id="nav_type_container">
				<div class="simple-form-field">
					<div class="form-group">
						<label for="navigationmodel-nav_type" class="col-sm-4 control-label">

							<span class="ng-binding">导航类型：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">


                                <select name="NavigationModel[nav_type]" class="form-control chosen-select" id="select_nav_type" style="display: none;">

                                    @foreach(link_type() as $k=>$v)
                                        @if(isset($info->id))
                                            <option value="{{ $k }}" @if($k == $info->nav_type) selected="true" @endif>{{ $v }}</option>
                                        @else
                                            <option value="{{ $k }}" @if($k == 0) selected="true" @endif>{{ $v }}</option>
                                        @endif
                                    @endforeach

								</select>


							</div>

							<div class="help-block help-block-t"><div class="help-block help-block-t">选择自定义链接，导航链接需手动添加；选择商品分类和文章分类，导航链接可选择对应的分类信息</div></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 链接地址  -->
			<div id="nav_link_container">
				<div class="simple-form-field">
					<div class="form-group">
						<label for="navigationmodel-nav_link" class="col-sm-4 control-label">

							<span class="ng-binding">导航链接：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">


								<div id="nav_link"></div>


							</div>

							<div class="help-block help-block-t"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 显示位置 -->
            @if(!$nav_position && $nav_page == 'site')
			<div class="simple-form-field">
				<div class="form-group">
					<label for="navigationmodel-nav_position" class="col-sm-4 control-label">

						<span class="ng-binding">显示位置：</span>
					</label>
					<div class="col-sm-8">
						<div class="form-control-box">


							<input type="hidden" name="NavigationModel[nav_position]" value="">
                            <div id="navigationmodel-nav_position" class="" name="NavigationModel[nav_position]" selection="1">
                                @foreach(nav_position() as $k=>$v)
                                    @if(isset($info->id))
                                        <label class="control-label cur-p m-r-10">
                                            <input type="radio" name="NavigationModel[nav_position]" value="{{ $k }}" @if($k == $info->nav_position) checked="" @endif> {{ $v }}</label>
                                    @else
                                        <label class="control-label cur-p m-r-10">
                                            <input type="radio" name="NavigationModel[nav_position]" value="{{ $k }}" @if($k == 1) checked="" @endif> {{ $v }}</label>
                                    @endif
                                @endforeach
                            </div>


						</div>

						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>
            @elseif($nav_page == 'm_site')
                <input type="hidden" id="navigationmodel-nav_position" class="form-control" name="NavigationModel[nav_position]" value="3">
            @endif


            @if(!isset($info->id) && $nav_page == 'site')
                <!-- 导航布局 -->
                <div class="nav_layout hide">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="navigationmodel-nav_layout" class="col-sm-4 control-label">

                                <span class="ng-binding">布局：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">


                                    <!--   -->
                                    <input type="hidden" name="NavigationModel[nav_layout]" value="">
                                    <div id="navigationmodel-nav_layout" class="" name="NavigationModel[nav_layout]" selection="1">
                                        @foreach(nav_layout() as $k=>$v)
                                            @if(isset($info->id))
                                                <label class="control-label cur-p m-r-10">
                                                    <input type="radio" name="NavigationModel[nav_layout]" value="{{ $k }}" @if($k == $info->nav_layout) checked="" @endif> {{ $v }}</label>
                                            @else
                                                <label class="control-label cur-p m-r-10">
                                                    <input type="radio" name="NavigationModel[nav_layout]" value="{{ $k }}" @if($k == 1) checked="" @endif> {{ $v }}</label>
                                            @endif
                                        @endforeach
                                    </div>



                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">显示位置为中间的导航，设置的导航显示布局，左侧对齐展示，或右侧对齐展示</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($nav_page == 'm_site')
                <input type="hidden" id="navigationmodel-nav_position" class="form-control" name="NavigationModel[nav_position]" value="3">
            @endif

            <!-- 导航布局 -->
            {{--@if(!isset($info->id)) hide @else @if($info->nav_position != 2) hide @endif @endif--}}
			<div class="nav_layout  @if(isset($info->id) && !in_array($nav_page, ['m_site', 'm_news'])) @else hide @endif" id="nav_icon_container">
				<!-- 导航图标 -->
				<div class="simple-form-field">
					<div class="form-group">
						<label for="navigationmodel-nav_icon" class="col-sm-4 control-label">

							<span class="ng-binding">导航图标：</span>
						</label>
						<div class="col-sm-8">
							<div class="form-control-box">

								<!-- 图片组 start -->
								<div id="nav_icon_imagegroup_container" class="szy-imagegroup" data-size="1">
                                    <ul class="image-group">
                                        <li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li>
                                    </ul>
                                </div>
								<input type="hidden" id="navigationmodel-nav_icon" class="form-control" name="NavigationModel[nav_icon]" value="{{ $info->nav_icon ?? ''}}">
								<!-- 图片组 end -->

							</div>

							<div class="help-block help-block-t">
                                @if($nav_page == 'm_site')
                                    <div class="help-block help-block-t">最佳显示尺寸为90*90像素，未选中图标样式</div>
                                @else
                                    <div class="help-block help-block-t">最佳显示尺寸为21*16像素，显示位置为商城中间导航的导航图标</div>
                                @endif
                            </div>
						</div>
					</div>
				</div>
			</div>


            @if($nav_page == 'm_site')
                <!-- 选中图标 -->
                <div id="nav_icon_active_container">
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="navigationmodel-nav_icon_active" class="col-sm-4 control-label">

                                <span class="ng-binding">选中图标：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">

                                    <!-- 图片组 start -->
                                    <div id="nav_icon_active_imagegroup_container" class="szy-imagegroup" data-size="1"></div>
                                    <input type="hidden" id="navigationmodel-nav_icon_active" class="form-control" name="NavigationModel[nav_icon_active]" value="{{ $info->nav_icon_active ?? ''}}">
                                    <!-- 图片组 end -->

                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">最佳显示尺寸为90*90像素，选中图标样式</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

			<!-- 是否显示 -->
			<div class="simple-form-field">
				<div class="form-group">
					<label for="navigationmodel-is_show" class="col-sm-4 control-label">

						<span class="ng-binding">是否显示：</span>
					</label>
					<div class="col-sm-8">
						<div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavigationModel[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="navigationmodel-is_show" class="form-control b-n"
                                                   name="NavigationModel[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navigationmodel-is_show" class="form-control b-n"
                                                   name="NavigationModel[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>


						</div>

						<div class="help-block help-block-t"><div class="help-block help-block-t">控制导航是否在前台显示</div></div>
					</div>
				</div>
			</div>

            @if(!in_array($nav_page, ['m_site', 'm_news']))
			<!-- 新窗口打开 -->
			<div class="simple-form-field">
				<div class="form-group">
					<label for="navigationmodel-new_open" class="col-sm-4 control-label">

						<span class="ng-binding">新窗口打开：</span>
					</label>
					<div class="col-sm-8">
						<div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="NavigationModel[new_open]" value="0">
                                    <label>
                                        @if(isset($info->new_open))
                                            <input type="checkbox" id="navigationmodel-new_open" class="form-control b-n"
                                                   name="NavigationModel[new_open]" value="1" @if($info->new_open == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="navigationmodel-new_open" class="form-control b-n"
                                                   name="NavigationModel[new_open]" value="1" checked data-on-text="是"
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
            @endif

			<!-- 排序 -->
			<div class="simple-form-field">
				<div class="form-group">
					<label for="navigationmodel-nav_sort" class="col-sm-4 control-label">
						<span class="text-danger ng-binding">*</span>
						<span class="ng-binding">排序：</span>
					</label>
					<div class="col-sm-8">
						<div class="form-control-box">


							<input type="text" id="navigationmodel-nav_sort" class="form-control small" name="NavigationModel[nav_sort]" value="{{ $info->nav_sort ?? 255}}">


						</div>

						<div class="help-block help-block-t"><div class="help-block help-block-t">数字范围为0~255，数字越小越靠前</div></div>
					</div>
				</div>
			</div>
			<!-- 提交按钮 -->
			<div class="simple-form-field">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">


					</label>
					<div class="col-sm-8">
						<div class="form-control-box">

							<input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

						</div>

						<div class="help-block help-block-t"></div>
					</div>
				</div>
			</div>
		</div>
	</form>

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
	<style>
		.platform-footer {
			display: none
		}
	</style>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
	<!-- 表单验证 -->
	<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
	<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
	<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
	<!-- AJAX上传+图片预览 -->
	<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
	<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
	<script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
	<!-- 验证规则 -->
	<script id="client_rules" type="text">
	    @if(!isset($info->id))
        [{"id": "navigationmodel-nav_name", "name": "NavigationModel[nav_name]", "attribute": "nav_name", "rules": {"required":true,"messages":{"required":"导航名称不能为空。"}}},{"id": "navigationmodel-nav_sort", "name": "NavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "navigationmodel-site_id", "name": "NavigationModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Site Id必须是整数。"}}},{"id": "navigationmodel-nav_type", "name": "NavigationModel[nav_type]", "attribute": "nav_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"导航类型必须是整数。"}}},{"id": "navigationmodel-nav_position", "name": "NavigationModel[nav_position]", "attribute": "nav_position", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"显示位置必须是整数。"}}},{"id": "navigationmodel-is_show", "name": "NavigationModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navigationmodel-new_open", "name": "NavigationModel[new_open]", "attribute": "new_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"新窗口打开必须是整数。"}}},{"id": "navigationmodel-nav_layout", "name": "NavigationModel[nav_layout]", "attribute": "nav_layout", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"布局必须是整数。"}}},{"id": "navigationmodel-nav_sort", "name": "NavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "navigationmodel-nav_name", "name": "NavigationModel[nav_name]", "attribute": "nav_name", "rules": {"string":true,"messages":{"string":"导航名称必须是一条字符串。","maxlength":"导航名称只能包含至多10个字符。"},"maxlength":10}},{"id": "navigationmodel-nav_link", "name": "NavigationModel[nav_link]", "attribute": "nav_link", "rules": {"string":true,"messages":{"string":"导航链接必须是一条字符串。","maxlength":"导航链接只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_icon", "name": "NavigationModel[nav_icon]", "attribute": "nav_icon", "rules": {"string":true,"messages":{"string":"导航图标必须是一条字符串。","maxlength":"导航图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_icon_active", "name": "NavigationModel[nav_icon_active]", "attribute": "nav_icon_active", "rules": {"string":true,"messages":{"string":"选中图标必须是一条字符串。","maxlength":"选中图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_page", "name": "NavigationModel[nav_page]", "attribute": "nav_page", "rules": {"string":true,"messages":{"string":"Nav Page必须是一条字符串。","maxlength":"Nav Page只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_class", "name": "NavigationModel[nav_class]", "attribute": "nav_class", "rules": {"string":true,"messages":{"string":"功能选择必须是一条字符串。","maxlength":"功能选择只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-class_images", "name": "NavigationModel[class_images]", "attribute": "class_images", "rules": {"string":true,"messages":{"string":"样式图标必须是一条字符串。","maxlength":"样式图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-is_show", "name": "NavigationModel[is_show]", "attribute": "is_show", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否显示是无效的。"}}},{"id": "navigationmodel-new_open", "name": "NavigationModel[new_open]", "attribute": "new_open", "rules": {"in":{"range":["0","1"]},"messages":{"in":"新窗口打开是无效的。"}}},]
        @else
        [{"id": "navigationmodel-nav_id", "name": "NavigationModel[nav_id]", "attribute": "nav_id", "rules": {"required":true,"messages":{"required":"Nav Id不能为空。"}}},{"id": "navigationmodel-nav_name", "name": "NavigationModel[nav_name]", "attribute": "nav_name", "rules": {"required":true,"messages":{"required":"导航名称不能为空。"}}},{"id": "navigationmodel-nav_sort", "name": "NavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "navigationmodel-site_id", "name": "NavigationModel[site_id]", "attribute": "site_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Site Id必须是整数。"}}},{"id": "navigationmodel-nav_type", "name": "NavigationModel[nav_type]", "attribute": "nav_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"导航类型必须是整数。"}}},{"id": "navigationmodel-nav_position", "name": "NavigationModel[nav_position]", "attribute": "nav_position", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"显示位置必须是整数。"}}},{"id": "navigationmodel-is_show", "name": "NavigationModel[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "navigationmodel-new_open", "name": "NavigationModel[new_open]", "attribute": "new_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"新窗口打开必须是整数。"}}},{"id": "navigationmodel-nav_layout", "name": "NavigationModel[nav_layout]", "attribute": "nav_layout", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"布局必须是整数。"}}},{"id": "navigationmodel-nav_sort", "name": "NavigationModel[nav_sort]", "attribute": "nav_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "navigationmodel-nav_name", "name": "NavigationModel[nav_name]", "attribute": "nav_name", "rules": {"string":true,"messages":{"string":"导航名称必须是一条字符串。","maxlength":"导航名称只能包含至多10个字符。"},"maxlength":10}},{"id": "navigationmodel-nav_link", "name": "NavigationModel[nav_link]", "attribute": "nav_link", "rules": {"string":true,"messages":{"string":"导航链接必须是一条字符串。","maxlength":"导航链接只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_icon", "name": "NavigationModel[nav_icon]", "attribute": "nav_icon", "rules": {"string":true,"messages":{"string":"导航图标必须是一条字符串。","maxlength":"导航图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_icon_active", "name": "NavigationModel[nav_icon_active]", "attribute": "nav_icon_active", "rules": {"string":true,"messages":{"string":"选中图标必须是一条字符串。","maxlength":"选中图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_page", "name": "NavigationModel[nav_page]", "attribute": "nav_page", "rules": {"string":true,"messages":{"string":"Nav Page必须是一条字符串。","maxlength":"Nav Page只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-nav_class", "name": "NavigationModel[nav_class]", "attribute": "nav_class", "rules": {"string":true,"messages":{"string":"功能选择必须是一条字符串。","maxlength":"功能选择只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-class_images", "name": "NavigationModel[class_images]", "attribute": "class_images", "rules": {"string":true,"messages":{"string":"样式图标必须是一条字符串。","maxlength":"样式图标只能包含至多255个字符。"},"maxlength":255}},{"id": "navigationmodel-is_show", "name": "NavigationModel[is_show]", "attribute": "is_show", "rules": {"in":{"range":["0","1"]},"messages":{"in":"是否显示是无效的。"}}},{"id": "navigationmodel-new_open", "name": "NavigationModel[new_open]", "attribute": "new_open", "rules": {"in":{"range":["0","1"]},"messages":{"in":"新窗口打开是无效的。"}}},]
        @endif
</script>
	<script type="text/javascript">
	</script>
	<script type="text/javascript">
        $().ready(function() {
            var validator = $("#NavigationModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();
                $("#NavigationModel").submit();
            });

            //改变类型
            $("#select_nav_type").change(function() {
                var nav_type = $(this).val();
                $.ajax({
                    url: 'get-type-list',
                    dataType: 'json',
                    data: {
                        nav_type: nav_type,
                        nav_link: '{{ $info->nav_link ?? '' }}',
                        page: 'site'
                    },
                    success: function(result) {
                        if (nav_type == 0) {
                            $("#nav_link").html("<input type='text' class='form-control valid' value='' name='NavigationModel[nav_link]' placeholder='添加链接地址'>");
                        } else {
                            $("#nav_link").html(result.data);
                        }
                    }
                });
            });

            $("#select_nav_type").change();
            if ($(".nav_layout").size() > 0) {
                $("input:radio[name='NavigationModel[nav_position]']").change(function() {
                    if ($(this).val() == 2) {
                        $('.nav_layout').removeClass('hide');
                    } else {
                        $('.nav_layout').addClass('hide');
                    }
                });
            }

            $("#navigationmodel-nav_class").change(function(){
                if($(this).val() == 'collect' || $(this).val() == 'customer' ){
                    $('#nav_name_container').hide();
                    $('#nav_type_container').hide();
                    $('#nav_link_container').hide();
                    $('#nav_icon_container').hide();
                    $('#nav_icon_active_container').hide();
                    $('#navigationmodel-nav_name').val($(this).find("option:selected").text());
                }else{
                    $('#nav_name_container').show();
                    $('#nav_type_container').show();
                    $('#nav_link_container').show();
                    $('#nav_icon_container').show();
                    $('#nav_icon_active_container').show();
                    $('#navigationmodel-nav_name').val("");
                }
            });

            if ($("#nav_icon_imagegroup_container").length > 0) {
                $("#nav_icon_imagegroup_container").imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: $(this).data("size"),
                    values: $('#navigationmodel-nav_icon').val().split("|"),
                    gallery: true,
                    // 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        $('#navigationmodel-nav_icon').val(values);
                    },
                    // 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        $('#navigationmodel-nav_icon').val(values);
                    }
                });
            }
            if ($("#nav_icon_active_imagegroup_container").length > 0) {
                $("#nav_icon_active_imagegroup_container").imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: $(this).data("size"),
                    values: $('#navigationmodel-nav_icon_active').val().split("|"),
                    gallery: true,
                    // 回调函数
                    callback: function(data) {
                        console.info(data);
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        $('#navigationmodel-nav_icon_active').val(values);
                    },
                    // 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        $('#navigationmodel-nav_icon_active').val(values);
                    }
                });
            }

            if ($("#class_images_imagegroup_container").length > 0) {
                $("#class_images_imagegroup_container").imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 5,
                    values: $('#navigationmodel-class_images').val().split("|"),
                    gallery: true,
                    mode: 1,
                    // 回调函数
                    callback: function(data) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        $('#navigationmodel-class_images').val(values);
                    },
                    // 移除的回调函数
                    remove: function(value, values) {
                        var values = this.values;
                        if (!values) {
                            values = [];
                        }
                        values = values.join("|");
                        $('#navigationmodel-class_images').val(values);
                    }
                });
            }

            /*	$('#navigationmodel-nav_class').change(function() {
                    if ($(this).val() != '') {
                        $('#class_images').removeClass('hide');
                    } else {
                        $('#class_images').addClass('hide');
                    }
                });
             */

        });
	</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop