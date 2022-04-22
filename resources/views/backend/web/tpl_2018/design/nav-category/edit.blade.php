{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
	<link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2"/>
	<!-- 加载图标库 -->
	<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.2"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

	<div class="table-content m-t-30 form-horizontal">
		<!-- 分类导航图标 -->
		<div class="simple-form-field">
			<div class="form-group">
				<label for="text4" class="col-sm-3 control-label p-r-0">
					<span class="ng-binding">分类导航图标：</span>
				</label>
				<div class="col-sm-9">
					<div class="form-control-box">
						<span>
							<input type="hidden" id="navcategorymodel-nav_icon" class="form-control w200 m-r-10" name="NavCategoryModel[nav_icon]" value="{{ $info->nav_icon }}">
							<i class="iconfont iconfont-box @if($info->nav_icon == '')iconfont-bg @endif" id="show_icon">

								{!! $info->nav_icon !!}

							</i>
							<span class="btn btn-warning btn-sm m-l-10" id="select_icon">选择图标</span>
							<span class="btn btn-warning btn-sm m-l-5 " id="del_icon">删除图标</span>
						</span>
					</div>
				</div>
			</div>
		</div>

		@foreach(json_decode($info->nav_json) as $k=>$v)
		<div class="simple-form-field">
			<div class="form-group">
				<label for="text4" class="col-sm-3 control-label p-r-0">
					<span class="ng-binding">
						<a class="btn-link c-blue m-r-5">
                            @if($k == 0)
							<i class="fa fa-plus-circle"></i>
                            @else
                            <i class="fa fa-minus-circle"></i>
                            @endif
						</a>
						分类导航名称：
					</span>
				</label>
				<div class="col-sm-9 data-row">
					<div class="form-control-box">
						<input type="hidden" value="{{ $v->link }}" name="cid">
						<input class="form-control ipt m-r-10" type="text" name="name" value="{{ $v->name }}">
						<label class="control-label">分类导航类型：</label>
						<select class="form-control m-r-10 category-type" name="type">

							<option value="0" @if($v->type == 0)selected="true"@endif>自定义链接</option>

							<option value="1" @if($v->type == 1)selected="true"@endif>关联分类</option>

							<option value="2" @if($v->type == 2)selected="true"@endif>搜索推荐词</option>

						</select>
						<span class="category-link">

                            @if($v->type == 0)
                                {{--自定义链接--}}
                                <label class="control-label">自定义链接：</label>
                                <input class="form-control" type="text" name="link" value="{{ $v->link }}" placeholder="示例：http://www.xxx.com">
                            @elseif($v->type == 1)
                                {{--关联分类--}}
                                <label class="control-label">关联到分类：</label>
                                <select name="link" class="form-control chosen-select">
                                    @foreach($cat_list as $cat)

                                        <option value="{{ $cat['cat_id'] }}" @if($v->link == $cat['cat_id'])selected="true"@endif>@if($cat['_child'])<span>◢</span>@endif {!! $cat['title_show'] !!}</option>

                                    @endforeach
                                </select>
                            @elseif($v->type == 2)
                                {{--搜索关键词--}}
                                <label class="control-label">输入推荐词：</label>
                                <input class="form-control" type="text" value="{{ $v->link }}" name="link">
                            @endif

                        </span>

					</div>
					<span class="form-control-error"></span>

				</div>
			</div>
		</div>
		@endforeach

		<div id="nav_category"></div>
		<div class="simple-form-field p-t-40 p-b-40">
			<div class="form-group">
				<label for="text4" class="col-sm-3 control-label"></label>
				<div class="col-xs-9">
					<button class="btn btn-primary" id="btn_submit">确认提交</button>
				</div>
			</div>
		</div>
	</div>
	<div class="catchr" style="display: none">
		<div class="simple-form-field">
			<div class="form-group">
				<label for="text4" class="col-sm-3 control-label p-r-0">
					<span class="ng-binding">
						<a class="btn-link c-blue m-r-5">
							<i class="fa fa-minus-circle"></i>
						</a>
						分类导航名称：
					</span>
				</label>
				</label>
				<div class="col-sm-9 data-row">
					<div class="form-control-box">
						<input class="form-control ipt m-r-10" type="text" name="name" value="">
						<label class="control-label">分类导航类型：</label>
						<select class="form-control m-r-10 category-type" name="type">
							<option value="0">自定义链接</option>
							<option value="1">关联分类</option>
							<option value="2">搜索推荐词</option>
						</select>
						<span class="category-link">
							<label class="control-label">自定义链接：</label>
							<input class="form-control" type="text" name="link" value="" placeholder='示例：http://www.xxx.com'>
						</span>
					</div>
				</div>
			</div>
		</div>
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
	<style>
		.platform-footer {
			display: none
		}
	</style>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
	<script type="text/javascript">
        $().ready(function() {
            var nav_page = 'site';

            $('body').on('focus', 'input[name="name"]', function() {
                $(this).removeClass("error");
            });

            var pid = '{{ $info->id }}';
            $("#btn_submit").click(function() {
                var data = [];
                var row = $(".table-content .data-row");
                var judge = true;
                var icon = $("#navcategorymodel-nav_icon").val();
                if (pid > 0) {
                    $.each(row, function(i, val) {
                        var name = $(val).find("input[name='name']").val();
                        if ($.trim(name) == '') {
                            $(this).find("input[name='name']").addClass('error');
                            judge = false;
                        }
                        var type = $(val).find("select[name='type']").val();
                        var link = $(val).find("input[name='link']").val();
                        var cid = $(val).find("input[name='cid']").val();
                        if (type == '1') {
                            link = $(val).find("select[name='link']").val();
                        }
                        data.push({
                            cid: cid,
                            name: name,
                            icon: icon,
                            type: type,
                            link: link
                        });
                    });
                    if (judge) {
                        $.ajax({
                            url: 'edit',
                            data: {
                                data: data,
                                pid: pid
                            },
                            beforeSend: function() {
                                $.loading.start();
                            },
                            success: function(result) {
                                location.href = "list?nav_page=" + nav_page;
                                $.loading.stop();
                                $.msg('修改成功');
                            }
                        });
                    } else {
                        $.msg("分类导航名称不能为空");
                    }

                } else {
                    $.each(row, function(i, val) {
                        var name = $(val).find("input[name='name']").val();
                        if (name == '') {
                            $(this).find("input[name='name']").addClass('error');
                            judge = false;
                        }
                        var type = $(val).find("select[name='type']").val();
                        var link = $(val).find("input[name='link']").val();
                        if (type == '1') {
                            link = $(val).find("select[name='link']").val();
                        }
                        data.push({
                            name: name,
                            icon: icon,
                            type: type,
                            link: link
                        });
                    });
                    if (judge) {
                        $.ajax({
                            url: 'add',
                            data: {
                                nav_page: nav_page,
                                data: data
                            },
                            beforeSend: function() {
                                $.loading.start();
                            },
                            success: function(result) {
                                location.href = "list?nav_page=" + nav_page;
                                $.loading.stop();
                                $.msg('添加成功');
                            }
                        });
                    } else {
                        $.msg("分类导航名称不能为空");
                    }
                }
            });

        });
	</script>


	<script type="text/javascript">
        var $chr = $(".catchr");
        $("body").on("click", ".fa-plus-circle", function() {
            var $new_chr = $($.parseHTML($chr.html()));
            $("#nav_category").append($new_chr);
        });

        $("body").on("click", ".fa-minus-circle", function() {
            $(this).parent().parent().parent().parent().parent().remove();
        });

        $("body").on("change", ".category-type", function() {
            var opint = $(this).val();
            var $link = $(this).next();
            switch (opint) {
                case '0':
                    $link.html("<label class='control-label'>自定义链接：</label><input class='form-control' type='text'name='link' value='' placeholder='示例：http://www.xxx.com'>");
                    break;
                case '1':
                    $.ajax({
                        url: 'get-cat-list',
                        dataType: 'json',
                        success: function(result) {
                            $link.html(result.data);
                        },
                    });
                    break;
                case '2':
                    $link.html("<label class='control-label'>输入推荐词：</label><input class='form-control' type='text' name='link' value=''>");
                    break;
                default:
                    $link.html("<label class='control-label'>自定义链接：</label><input class='form-control' type='text' name='link' value='' placeholder='示例：http://www.xxx.com'>");
                    break;
            }
        });
	</script>
	<script type="text/javascript">
        var modal;
        $("#select_icon").click(function() {
            modal = $.modal($(this));
            if (modal) {
                modal.show();
            } else {
                modal = $.modal({
                    title: '选择图标',
                    trigger: $(this),
                    ajax: {
                        url: 'select-icon',
                        data: {
                            output: true
                        },
                    },

                });
            }
        });

        $('#del_icon').click(function() {
            $("#navcategorymodel-nav_icon").val('');
            $("#show_icon").html('');
            $("#show_icon").addClass('iconfont-bg');
            $(this).addClass('hide');
        });
	</script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop