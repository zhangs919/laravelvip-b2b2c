<!DOCTYPE html>
<!--[if IE 8]>
<html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}">
    <script src="/assets/d2eace91/js/jquery-1.9.1.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20190121"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=20190121"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20190215"/>
    <!-- -->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/jquery-ui.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/design.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/tplsetting.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.min.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/loading/loaders.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/edit.css?v=20190215"/>
</head>
<!--接收所修改的背景颜色及背景图片-->
<body class="bg-fixed" style="@if($tpl_info['global_form_datas']['page_header']['bodybg_type'] == 1) background: {{ $tpl_info['global_form_datas']['page_header']['bodybg'] }}@else background-image: url('{{ $tpl_info['global_form_datas']['page_header']['bodybg'] }}');@endif">
<!--页面头部-->
<div class="module-topBar">
    <div class="module-topBar-inner">
        <a class="topBar-logo">

            <img src="{{ get_image_url(sysconf('mall_logo')) }}">

        </a>
        <div class="topBar-navbar-r">
            <!--
            <div class="f-box">
                <a class="link publish">发布表单</a>
                <input type="text" value="" readonly>
                <a class="link copy">复制网址</a>
            </div>
            -->
            <div class="page-operation-btns">
                <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);">发布 </a>
            </div>
        </div>
    </div>
</div>

<div class="module-warpper">
    <div class="module-content">
        <!--左侧-->
        <div class="left-sidebar">
            <div class="accordion-group">
                <div class="accordion-box">
                    <h4 class="tc selected">
                        <a>
                            通用类组件
                            <i class=""></i>
                        </a>
                    </h4>
                    <ul class="ul-tool">
                        <li class="moduleL ui-draggable" data-type="input">
                            <a>
                                <i class="basic-tool-icon1"></i>
                                单行文字
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="textarea">
                            <a>
                                <i class="basic-tool-icon2"></i>
                                多行文字
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="radio">
                            <a>
                                <i class="basic-tool-icon3"></i>
                                单项选择
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="checkbox">
                            <a>
                                <i class="basic-tool-icon4"></i>
                                多项选择
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="number">
                            <a>
                                <i class="basic-tool-icon8"></i>
                                数字
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="time">
                            <a>
                                <i class="basic-tool-icon9"></i>
                                时间
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="select">
                            <a>
                                <i class="basic-tool-icon11"></i>
                                下拉框
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="describe">
                            <a>
                                <i class="basic-tool-icon12"></i>
                                描述
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="url">
                            <a>
                                <i class="basic-tool-icon13"></i>
                                网址
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="upload_file">
                            <a>
                                <i class="basic-tool-icon13"></i>
                                上传附件
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="accordion-box">
                    <h4 class="tc">
                        <a>
                            图视类组件
                            <i class=""></i>
                        </a>
                    </h4>
                    <ul class="ul-tool">
                        <li class="moduleL ui-draggable" data-type="image">
                            <a>
                                <i class="movies-tool-icon1"></i>
                                图片展示
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="video">
                            <a>
                                <i class="movies-tool-icon3"></i>
                                视频播放
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="accordion-box">
                    <h4 class="tc">
                        <a>
                            联系人组件
                            <i class=""></i>
                        </a>
                    </h4>
                    <ul class="ul-tool">
                        <li class="moduleL ui-draggable" data-type="username">
                            <a>
                                <i class="contacts-tool-icon1"></i>
                                姓名
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="phone">
                            <a>
                                <i class="contacts-tool-icon2"></i>
                                手机
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="email">
                            <a>
                                <i class="contacts-tool-icon3"></i>
                                邮箱
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="address">
                            <a>
                                <i class="contacts-tool-icon4"></i>
                                地址
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="accordion-box">
                    <h4 class="tc">
                        <a>
                            通讯组件
                            <i class=""></i>
                        </a>
                    </h4>
                    <ul class="ul-tool">
                        <li class="moduleL ui-draggable" data-type="weixin">
                            <a>
                                <i class="message-tool-icon1"></i>
                                微信
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="qq">
                            <a>
                                <i class="message-tool-icon2"></i>
                                QQ
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="weibo">
                            <a>
                                <i class="message-tool-icon3"></i>
                                微博
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="accordion-box">
                    <h4 class="tc">
                        <a>
                            其它组件
                            <i class=""></i>
                        </a>
                    </h4>
                    <ul class="ul-tool">
                        <li class="moduleL ui-draggable" data-type="dividing_line">
                            <a>
                                <i class="other-tool-icon1"></i>
                                分割线
                            </a>
                        </li>
                        <li class="moduleL ui-draggable" data-type="static_map">
                            <a>
                                <i class="other-tool-icon2"></i>
                                静态地图
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--中间-->
        <!--此处为表单设置背景颜色-->
        <div class="center-form">
            <div class="top-images drop-field" id="fpage_header" data-unique="header" data-type="page_header">

                <!--   -->
                <img src="{{ $tpl_info['global_form_datas']['page_header']['header'] ?: '/assets/d2eace91/images/customform/design/top-default.jpg' }}" style="width: 100%;">

            </div>
            <div class="center-content">
                <!--不可删不可移可编辑-->




                <div class="form-title drop-field" id="fpage_title" data-unique="title" data-type="{{ $tpl_info['global_form_datas']['page_title']['type'] ?? 'page_title' }}">

                    {{ $tpl_info['global_form_datas']['page_title']['title'] ?? '模板标题' }}

                </div>




                <div class="form-desc drop-field" id="fpage_desc" data-unique="description" data-type="{{ $tpl_info['global_form_datas']['page_desc']['type'] ?? 'page_desc' }}">

                    {!! $tpl_info['global_form_datas']['page_desc']['description'] ?? '模板描述' !!}

                </div>




                <!--可删可移可编辑-->
                @if(empty($tpl_info['form_datas']))
                <ul id="dropzone" class="ui-sortable empty-field">
                </ul>
                @else
                    <ul id="dropzone" class="ui-sortable ">
                        @foreach($tpl_info['form_datas'] as $k=>$form)
                            <li class="drop-field ui-draggable ui-draggable-handle" data-type="{{ $form['type'] }}" id="f{{ $k }}">
                                <div class="type-content">

                                    {{--根据type switch 判断展示不同的元素--}}
                                    {{--引入万能表单元素--}}
                                    @include('backend::components.custom-form.form_items')

                                    <div class="operateEdit">






                                        <a class="decor-btn upMove-btn hide">
                                            <div class="selector-box">
                                                <div class="arrow"></div>
                                                <i class="fa fa-arrow-circle-o-up"></i>
                                                上移
                                            </div>
                                        </a>





                                        <a class="decor-btn downMove-btn ">
                                            <div class="selector-box">
                                                <div class="arrow"></div>
                                                <i class="fa fa-arrow-circle-o-down"></i>
                                                下移
                                            </div>
                                        </a>
                                        <!--
                                        <a class="decor-btn hide-btn">
                                            <div class="selector-box">
                                                <div class="arrow"></div>
                                                <i class="fa fa-check-circle-o"></i>
                                                显示
                                            </div>
                                        </a>
                                         -->

                                        <a class="decor-btn deletes-btn">
                                            <div class="selector-box">
                                                <div class="arrow"></div>
                                                <i class="fa fa-trash-o"></i>
                                                删除
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!--提交按钮不可删不可移可编辑-->
                <div class="form-submit">
                    <a href="javascript:;" id="btn_preview">预览</a>
                    <a href="javascript:;" id="btn_submit">提交</a>
                </div>
            </div>
        </div>
        <!--右侧-->
        <div class="jt"></div>
        <div class="right-operate">
            <div class="top-title-box">
                <a href="javascript:;" class="close"></a>
                <h4 class="bt"></h4>
                <span class="promptSet">修改保存后即可看效果</span>
            </div>
            <div class="operate-nr">
                <form class="form-horizontal">
                    <div class="form-wrapper">
                        <!-- 基础内容 -->
                        <div class="table-content basic_content">
                            <div class="operate-tit-sm">页面背景设置</div>
                            <!-- 全局背景设置 -->
                            <div class="simple-form-field" data-key="bodybg">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">背景设置：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <select class="form-control" id="bodybg_type" name="bodybg_type" data-type="input">
                                                <option value="1" selected>底色</option>
                                                <option value="0" >背景图片</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group over-visible clearfix">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box p-t-10">
                                            <!-- 背景图 container -->
                                            <div id="bg_img_container" class="szy-imagegroup" data-id="bg_img" data-size="1" style="display: none;"></div>
                                            <input class="form-control" id="bg_img" name="bg_img" type="hidden" value="">
                                            <div class="help-block help-block-t" id="bg_img_helper">建议上传尺寸 1920*1080像素</div>
                                            <!-- 背景色 container -->
                                            <div id="bg_color_container">
                                                <!-- 线色 -->
                                                <div class="color-picker">
                                                    <input class="form-control m-r-20" id="bg_color_picker" type="text" value="#ffffff" name="bg_color">
                                                    <script>
                                                        $(function () {
                                                            $('#bg_color_picker').colorpicker({
                                                                color: "#ffffff"
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 表单背景 -->
                            <!-- <div class="operate-tit-sm">表单背景设置</div>
                            <div class="simple-form-field" data-key="formbg">
                                <div class="form-group over-visible clearfix">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">表单背景：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box p-t-10">
                                            背景颜色
                                            <div class="color-picker">
                                                <input class="form-control m-r-20" id="form_color_picker" type="text" value="#ffffff" name="formbg" data-type="input">
                                                <script>
                                                    $(function () {
                                                        $('#form_color_picker').colorpicker({
                                                            color: "#ffffff"
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- 顶部图片 -->
                            <div class="operate-tit-sm">顶部图片设置</div>
                            <div class="simple-form-field" data-key="header">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">顶部图片：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <div id="imagegroup_container" data-id="header_img" class="szy-imagegroup" data-size="1"></div>
                                            <input class="form-control" data-type="input" id="header_img" name="header" type="hidden" value="{{ $tpl_info['global_form_datas']['page_header']['header'] }}">
                                            <div class="help-block help-block-t">建议上传尺寸 800*300像素</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 标题 -->
                            <div class="simple-form-field" data-key="title">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">标题：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <input class="form-control" data-type="input" name="title" type="text">
                                        </div>
                                        <div class="help-block help-block-t header-title-block">请设置表单主题</div>
                                        <div class="help-block help-block-t component-title-block" style="display: none;">此属性用于告诉填写者应该在该字段中输入什么样的内容。通常是一两个简短的词语，也可以是一个问题</div>
                                    </div>
                                </div>
                            </div>
                            <!-- 最大文件数量 -->
                            <div class="simple-form-field" data-key="max_file">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        <span class="ng-binding">最大文件数量：</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <select class="form-control" name="max_file" data-type="input">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 文件上传类型 -->
                            <div class="simple-form-field" data-key="upload_type">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        <span class="ng-binding">文件上传类型：</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <select class="form-control" name="upload_type" data-type="input">
                                                <option value="0">不限制</option>
                                                <option value="1">文档类</option>
                                                <option value="2">图片类</option>
                                                <option value="3">视频类</option>
                                                <option value="4">音频类</option>
                                                <option value="5">压缩包</option>
                                                <option value="6">自定义</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 标题默认值 -->
                            <div class="simple-form-field" data-key="title_default_value">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">默认值：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <input class="form-control" name="title_default_value" data-type="input" type="text">
                                        </div>
                                        <div class="help-block help-block-t">设置后，此值将作为默认值显示在该字段的输入框中。如果不需要设置默认值，请将此处留空。</div>
                                    </div>
                                </div>
                            </div>
                            <!-- 日期默认值-->
                            <div class="simple-form-field" data-key="default_time">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">默认值：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <input class="form-control datetimepicker" id="default_time" name="default_time" data-type="input" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 显示日期的级别，年月日，年月日时分秒。。。-->
                            <div class="simple-form-field" data-key="time_level">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">显示内容：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <select class="form-control" id="time_level" name="time_level" data-type="input">
                                                <option value="0">年月日（默认）</option>
                                                <option value="1">年月日 时分秒</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 地区联动默认值 -->
                            <div class="simple-form-field description" data-key="address">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">默认值：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <div id="region_container"></div>
                                            <input type="hidden" name="address_code" id="address_code" data-type="input">
                                        </div>
                                        <div class="form-control-box m-t-15">
                                            <textarea class="form-control w200" name="address_detail" placeholder="详细地址"></textarea>
                                            <input type="hidden" name="address_text" data-type="input" id="address_text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 上传图片 -->
                            <div class="simple-form-field" data-key="image_url">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">图片：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box" id="image_url_box">
                                            <div id="image_url_container" data-id="image_url" class="szy-imagegroup" data-size="1"></div>
                                            <input class="form-control" data-type="input" id="image_url" name="image_url" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 上传视频 -->
                            <div class="simple-form-field" data-key="video_url">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">视频：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box" id="video_url_box">
                                            <div id="video_container"></div>
                                            <input class="form-control" data-type="input" id="video_url" name="video_url" type="hidden">
                                        </div>
                                        <div class="help-block help-block-t">视频格式仅支持ogg、mpeg4、webm</div>
                                    </div>
                                </div>
                            </div>
                            <!-- 图片链接 -->
                            <div class="simple-form-field description" data-key="image_href">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">图片链接：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control w200" data-type="input" name="image_href" placeholder="图片跳转地址 http://">
                                    </div>
                                </div>
                            </div>
                            <!-- 描述 -->
                            <div class="simple-form-field description" data-key="description">
                                <div class="form-group clearfix over-visible">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">描述：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <!--
                                            <div id="editor-header" class="form-control editor-header"></div>
                                            <div id="editor-body" class="form-control editor-body"></div>
                                            <input type="hidden" id="editor-description" name="description">
                                            -->
                                            <div id="ueditor"></div>
                                        </div>
                                        <div class="help-block help-block-t header-desc-block">请填写介绍表单内容信息</div>
                                        <div class="help-block help-block-t component-desc-block" style="display: none;">此属性用于指定对该字段进行一些附加说明，一般用来指导填写者输入</div>
                                    </div>
                                </div>
                            </div>
                            <!-- 单位 -->
                            <div class="simple-form-field description" data-key="unit">
                                <div class="form-group">
                                    <div class="form-control-box m-l-20 m-t-15">输入框右侧文字（单位）：</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <input class="form-control" name="unit" data-type="input" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 单选列表 -->
                            <div class="simple-form-field description" data-type="radio" data-key="items">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">选项：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <div class="image-choice radio_item_list">
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="radio" class="radio_checked" name="radio_list">
                                                        <input class="form-control form-control-sm w120 radio_content" name="radio_list_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="radio" class="radio_checked" name="radio_list">
                                                        <input class="form-control form-control-sm w120 radio_content" name="radio_list_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="radio" class="radio_checked" name="radio_list">
                                                        <input class="form-control form-control-sm w120 radio_content" name="radio_list_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upFile small">
                                                <div class="upFile-con radio-add">
                                                    <span>点击添加选项</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 多选列表 -->
                            <div class="simple-form-field description" data-type="checkbox" data-key="items">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">选项：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <div class="image-choice checkbox_item_list">
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="checkbox" class="checkbox_checked" name="checkbox_list[]">
                                                        <input class="form-control form-control-sm w120 checkbox_content" name="checkbox_list_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="checkbox" class="checkbox_checked" name="checkbox_list[]">
                                                        <input class="form-control form-control-sm w120 checkbox_content" name="checkbox_list_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="checkbox" class="checkbox_checked" name="checkbox_list[]">
                                                        <input class="form-control form-control-sm w120 checkbox_content" name="checkbox_list_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upFile small">
                                                <div class="upFile-con checkbox-add">
                                                    <span>点击添加选项</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 图片单选 -->
                            <div class="simple-form-field" data-key="single_img">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">选项：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <div class="image-choice">
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="radio" name="single_img">
                                                        <div class="choice-image">
                                                            <img src="/assets/d2eace91/images/customform/design/thumb1.png">
                                                        </div>
                                                        <input type="hidden" name="single_img_imgs[]" value="/assets/d2eace91/images/customform/design/thumb1.png">
                                                        <input class="form-control form-control-sm w120" name="single_img_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="radio" name="single_img">
                                                        <div class="choice-image">
                                                            <img src="/assets/d2eace91/images/customform/design/thumb2.png">
                                                        </div>
                                                        <input type="hidden" name="single_img_imgs[]" value="/assets/d2eace91/images/customform/design/thumb2.png">
                                                        <input class="form-control form-control-sm w120" name="single_img_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="radio" name="single_img">
                                                        <div class="choice-image">
                                                            <img src="/assets/d2eace91/images/customform/design/thumb3.png">
                                                        </div>
                                                        <input type="hidden" name="single_img_imgs[]" value="/assets/d2eace91/images/customform/design/thumb3.png">
                                                        <input class="form-control form-control-sm w120" name="single_img_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upFile small">
                                                <div class="upFile-con">
                                                    <i class="icon-upload"></i>
                                                    <span>点击添加图片</span>
                                                </div>
                                                <input type="file">
                                            </div>
                                        </div>
                                        <div class="help-block help-block-t">此属性用于指定对该字段进行一些附加说明，一般用来指导填写者输入</div>
                                    </div>
                                </div>
                            </div>
                            <!-- 图片多选 -->
                            <div class="simple-form-field" data-key="muti_img[]">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">选项：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <div class="image-choice">
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="checkbox" name="muti_img[]">
                                                        <div class="choice-image">
                                                            <img src="/assets/d2eace91/images/customform/design/thumb1.png">
                                                        </div>
                                                        <input type="hidden" name="muti_img_imgs[]" value="/assets/d2eace91/images/customform/design/thumb1.png">
                                                        <input class="form-control form-control-sm w120" name="muti_img_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="checkbox" name="muti_img[]">
                                                        <div class="choice-image">
                                                            <img src="/assets/d2eace91/images/customform/design/thumb2.png">
                                                        </div>
                                                        <input type="hidden" name="muti_img_imgs[]" value="/assets/d2eace91/images/customform/design/thumb2.png">
                                                        <input class="form-control form-control-sm w120" name="muti_img_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-choice-box">
                                                    <div class="image-choice-panel">
                                                        <input type="checkbox" name="muti_img[]">
                                                        <div class="choice-image">
                                                            <img src="/assets/d2eace91/images/customform/design/thumb3.png">
                                                        </div>
                                                        <input type="hidden" name="muti_img_imgs[]" value="/assets/d2eace91/images/customform/design/thumb3.png">
                                                        <input class="form-control form-control-sm w120" name="muti_img_con[]" type="text">
                                                        <div class="actions">
                                                            <a class="del" title="移除"></a>
                                                            <a class="move" title="移动"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upFile small">
                                                <div class="upFile-con">
                                                    <i class="icon-upload"></i>
                                                    <span>点击添加图片</span>
                                                </div>
                                                <input type="file">
                                            </div>
                                        </div>
                                        <div class="help-block help-block-t">此属性用于指定对该字段进行一些附加说明，一般用来指导填写者输入</div>
                                    </div>
                                </div>
                            </div>
                            <!-- 线条颜色 -->
                            <div class="simple-form-field" data-key="line_color">
                                <div class="form-group clearfix" style="overflow: visible">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">线条颜色：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <!-- 线色 -->
                                            <div class="color-picker">
                                                <input class="form-control m-r-20" id="color-picker" type="text" value="#5367ce" name="line_color" data-type="input">
                                                <script>
                                                    $(function () {
                                                        $('#color-picker').colorpicker({
                                                            color: "#ccc"
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 线条宽度 -->
                            <div class="simple-form-field" data-key="line_width">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">线条宽度：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <select name="line_width" class="form-control" autocomplete="off" data-type="input">
                                                <option value="0">无</option>
                                                <option value="1px" selected>1</option>
                                                <option value="2px">2</option>
                                                <option value="3px">3</option>
                                                <option value="4px">4</option>
                                                <option value="5px">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 线条形状 -->
                            <div class="simple-form-field" data-key="line_shape">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">线条形状：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <select name="line_shape" class="form-control" data-type="input" autocomplete="off">
                                                <option value="solid" selected>———</option>
                                                <option value="dashed">-------</option>
                                                <option value="dotted">........</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 显示地点 -->
                            <div class="simple-form-field" data-key="location">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">显示地点：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <input class="form-control" data-type="input" name="place" id="place" type="text">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            经度:
                                            <input class="form-control" data-type="input" name="lat" type="text">
                                        </div>
                                        <div class="form-control-box">
                                            纬度:
                                            <input class="form-control" data-type="input" name="lng" type="text">
                                        </div>
                                    </div>
                                    -->
                                </div>
                            </div>
                            <!-- 比例尺 -->
                            <div class="simple-form-field" data-key="zoom">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="col-sm-4 control-label"> </label>
                                    <div class="col-sm-8">
                                        <div class="w200">
                                            <span class="pull-left">小</span>
                                            <span class="pull-right">大</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">比例尺：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <div id="map_scale" class="w200"></div>
                                        <input type="hidden" id="map_scale_ipt" name="zoom" value="12">
                                    </div>
                                </div>
                            </div>
                            <!-- 标记上显示信息 -->
                            <div class="simple-form-field" data-key="markers">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        <span class="ng-binding">标记上显示信息：</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <div class="form-control-box">
                                            <input class="form-control" data-type="input" name="markers" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 格式校验 -->
                        <div class="table-content validate_content">
                            <div class="operate-tit-sm">校验</div>
                            <div class="simple-form-field">
                                <div class="form-group">
                                    <div class="col-sm-8 p-l-15">
                                        <div class="form-control-box">
                                            <label class="control-label cur-p" data-key="v_required">
                                                <input type="checkbox" name="v_required" value="1" data-type="checkbox">
                                                必填项
                                            </label>
                                            <!--
                                            <label class="control-label cur-p" data-key="v_unique">
                                                <input type="checkbox" name="v_unique" value="1" data-type="checkbox">
                                                不能和已有数据重复
                                            </label>
                                            -->
                                            <label class="control-label cur-p" data-key="v_resident_cardnum">
                                                <input type="checkbox" name="v_resident_cardnum" value="1" data-type="checkbox">
                                                身份证号验证
                                            </label>
                                            <label class="control-label cur-p" data-key="v_minlength">
                                                <input type="checkbox" name="v_minlength" value="1" data-type="checkbox">
                                                最少填
                                                <input class="form-control ipt m-l-5 m-r-5" data-valid="int" data-type="input" name="v_minlength_con" type="text">
                                                个字
                                            </label>
                                            <label class="control-label cur-p" data-key="v_maxlength">
                                                <input type="checkbox" name="v_maxlength" value="1" data-type="checkbox">
                                                最多填
                                                <input class="form-control ipt m-l-5 m-r-5" data-valid="int" data-type="input" name="v_maxlength_con" type="text">
                                                个字
                                            </label>
                                            <label class="control-label cur-p" data-key="v_error_customer">
                                                <input type="checkbox" name="v_error_customer" data-type="checkbox">
                                                自定义出错文案
                                                <input class="form-control" name="v_error_customer_con" data-valid="string" data-type="input" type="text">
                                                <div class="help-block help-block-t">勾选后，填表者在提交不符合校验规则的数据时，会显示此处自定义的文案</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-content style_content">
                            <div class="operate-tit-sm">布局设置</div>
                            <div class="simple-form-field" data-key="layout">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <span class="ng-binding">排列方式：</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <ul class="fGroupItem">
                                            <li data-layout="" class="selected">纵向</li>
                                            <li data-layout="inline">横向</li>
                                        </ul>
                                        <input type="hidden" id="layout" data-type="input" name="layout" value="">
                                        <div class="help-block help-block-t">横向排序可以更节省表单空间，使排版更为紧凑；纵向排序更适合选项字数较多的场景。</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="current_select_index">
                    <div class="Fsubmit">
                        <a class="btn btn-primary">保存</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 去预览表单 -->
<form id="to_preview" method="post" target="_blank" action="/dashboard/custom-form/preview.html?form_id={{ $form_id }}" style="display: none">
    <input name="form_datas" id="form_datas">
    <input name="global_datas" id="global_datas">
</form>
<!-- 提交表单 -->
<form id="to_submit" method="post" action="/dashboard/custom-form/design.html?form_id={{ $form_id }}" style="display: none"></form>
<!--发布表单成功弹框-->
<div class="form-success-wrap" style="display: none;">
    <h2 class="success-title p-b-35">发布成功</h2>
    <div class="form-link over-hidden">
        <input type="text" class="url" readonly="readonly" value="">
        <a href="javascript:void(0);" class="btn copy">复制网址</a>
        <a href="#" target="_blank" class="btn btn-open">直接打开</a>
    </div>
    <div class="qrcode">
        <div class="over-hidden">
            <div class="qrcode-img">
                <img src="">
            </div>
            <div class="qrcode-info">
                <h2 class="p-b-10">二维码</h2>
                <p class="p-b-25">用户可以通过扫码进行提交表单</p>
                <a href="#" class="btn download" target="_blank">下载二维码</a>
            </div>
        </div>
    </div>
</div>
<!-- 单选列表的条目 -->
<script type="text/template" id="tpl_radio_item">
    <div class="image-choice-box ui-sortable-handle">
        <div class="image-choice-panel">
            <input type="radio" class="radio_checked" name="radio_list">
            <input class="form-control form-control-sm w120 radio_content" name="radio_list_con[]" type="text">
            <div class="actions">
                <a class="del" title="移除"></a>
                <a class="move" title="移动"></a>
            </div>
        </div>
    </div>
</script>
<!-- 多选列表的条目 -->
<script type="text/template" id="tpl_checkbox_item">
    <div class="image-choice-box ui-sortable-handle">
        <div class="image-choice-panel">
            <input type="checkbox" class="checkbox_checked" name="checkbox_list">
            <input class="form-control form-control-sm w120 checkbox_content" name="checkbox_list_con[]" type="text">
            <div class="actions">
                <a class="del" title="移除"></a>
                <a class="move" title="移动"></a>
            </div>
        </div>
    </div>
</script>
<script src="//webapi.amap.com/maps?v=1.4.9&key={{ sysconf('amap_js_key') }}"></script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>

<script src="/assets/d2eace91/js/layer/layer.js?v=20190121"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=20190121"></script>

<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20190121"></script>

<script src="/assets/d2eace91/js/jquery-ui.js?v=20190121"></script>
<script src="/assets/d2eace91/js/wangEditor.min.js?v=20190121"></script>
<script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20190121"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190121"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20190121"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20190121"></script>
<!-- 日期选择器 -->
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190121"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
<!-- 地址 -->
<script src="/assets/d2eace91/js/jquery.region.js?v=20190121"></script>



<script>
    var home_url = '{{ route('pc_home') }}';
    <!-- 图片地址 -->
    var image_url_host = '{{ get_oss_host() }}';
    <!-- 视频地址 -->
    var video_url_host = "{{ get_oss_host() }}";
    // 视频最大最小时长
    var video_min_duration = '0';
    var video_max_duration = '90';
    var default_img = '/assets/d2eace91/images/customform/design/top-default.jpg';
</script>
<!-- 编辑器 -->
<script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=20190121"></script>
<script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=20190121"></script>
<!-- 创建KindEditor的脚本 必须设置editor_id属性-->


<script type="text/javascript">
    KindEditor.ready(function(K) {

        var extraFileUploadParams = [];
        extraFileUploadParams['ISHUOCHA_CN_USER_PHPSESSID'] = 'q5egbkgb65eb4kiok48gahks4q';

        window.editor = K.create('#ueditor', {
            width: '100%',
            minWidth: '250',
            height: '350',
            items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', '|', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
            themesPath: "/assets/d2eace91/js/editor/themes/",
            cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
            uploadJson: "/site/upload-image.html",
            extraFileUploadParams: extraFileUploadParams,
            allowImageUpload: true,
            allowFlashUpload: false,
            allowMediaUpload: false,
            allowFileManager: true,
            syncType: "form",
            // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
            pasteType: 2,
            afterCreate: function() {
                var self = this;
                self.sync();
            },
            afterChange: function() {
                var self = this;
                self.sync();
            },
            afterBlur: function() {
                var self = this;
                self.sync();
            }
        });
    });
</script>	<!-- /编辑器 -->
<!-- 表单功能 顺序必须不能变 -->
<script src="/assets/d2eace91/js/customform/index.js?v=20190121"></script>
<script>
    <!-- -->
    var form_datas = {!! json_encode($tpl_info['form_datas']) !!};

    <!-- -->
    var global_form_datas = {!! json_encode($tpl_info['global_form_datas']) !!};

    $(function() {
        // ----- 地图数据回显与管理 ----- //
        initComponents('static_map');
        // ----- /地图数据回显与管理 ----- //
    });
</script>
<script src="/assets/d2eace91/js/customform/edit.js?v=20190121"></script>
</body>
</html>
