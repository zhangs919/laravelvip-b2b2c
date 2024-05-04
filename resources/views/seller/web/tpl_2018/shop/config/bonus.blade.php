{{--模板继承--}}
@extends('layouts.seller_layout')

{{--header 内 css文件--}}
@section('header_css')
@stop

{{--header 内 css文件--}}
@section('header_css_2')
    <link href="/assets/d2eace91/css/styles.css" rel="stylesheet">
@stop

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index?group=bonus" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="group" value="bonus">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">
            <h5 class="m-b-30" data-anchor="PC端图片设置">PC端图片设置</h5>
            <!-- pc端图片start -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片1：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-bonus_img1_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-bonus_img1_image" class="preview"
   ref="@if(!empty($group_info['bonus_img1']->value)){{ get_image_url($group_info['bonus_img1']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-bonus_img1">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-bonus_img1_text" name="ShopConfigModel[bonus_img1]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-bonus_img1_button" name="ShopConfigModel[bonus_img1]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-bonus_img1" name="ShopConfigModel[bonus_img1]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-bonus_img1_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-bonus_link1" class="form-control" name="ShopConfigModel[bonus_link1]" value="{{ $group_info['bonus_link1']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='bonus_img1|bonus_link1' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*350像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址。</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片2：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-bonus_img2_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-bonus_img2_image" class="preview" ref="@if(!empty($group_info['bonus_img2']->value)){{ get_image_url($group_info['bonus_img2']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-bonus_img2">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-bonus_img2_text" name="ShopConfigModel[bonus_img2]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-bonus_img2_button" name="ShopConfigModel[bonus_img2]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-bonus_img2" name="ShopConfigModel[bonus_img2]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-bonus_img2_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-bonus_link2" class="form-control" name="ShopConfigModel[bonus_link2]" value="{{ $group_info['bonus_link2']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='bonus_img2|bonus_link2' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*350像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址。</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片3：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-bonus_img3_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-bonus_img3_image" class="preview" ref="@if(!empty($group_info['bonus_img3']->value)){{ get_image_url($group_info['bonus_img3']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-bonus_img3">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-bonus_img3_text" name="ShopConfigModel[bonus_img3]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-bonus_img3_button" name="ShopConfigModel[bonus_img3]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-bonus_img3" name="ShopConfigModel[bonus_img3]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-bonus_img3_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-bonus_link3" class="form-control" name="ShopConfigModel[bonus_link3]" value="{{ $group_info['bonus_link3']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='bonus_img3|bonus_link3' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*350像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址。</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片4：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-bonus_img4_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-bonus_img4_image" class="preview" ref="@if(!empty($group_info['bonus_img4']->value)){{ get_image_url($group_info['bonus_img4']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-bonus_img4">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-bonus_img4_text" name="ShopConfigModel[bonus_img4]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-bonus_img4_button" name="ShopConfigModel[bonus_img4]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-bonus_img4" name="ShopConfigModel[bonus_img4]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-bonus_img4_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-bonus_link4" class="form-control" name="ShopConfigModel[bonus_link4]" value="{{ $group_info['bonus_link4']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='bonus_img4|bonus_link4' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1920*350像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址。</div>
                    </div>
                </div>
            </div>
            <!-- pc端图片end -->
            <h5 class="m-b-30" data-anchor="PC端图片设置">手机端图片设置</h5>
            <!-- mobile端图片start -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片1：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-m_bonus_img1_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-m_bonus_img1_image" class="preview" ref="@if(!empty($group_info['m_bonus_img1']->value)){{ get_image_url($group_info['m_bonus_img1']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-m_bonus_img1">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-m_bonus_img1_text" name="ShopConfigModel[m_bonus_img1]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-m_bonus_img1_button" name="ShopConfigModel[m_bonus_img1]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-m_bonus_img1" name="ShopConfigModel[m_bonus_img1]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-m_bonus_img1_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-m_bonus_link1" class="form-control" name="ShopConfigModel[m_bonus_link1]" value="{{ $group_info['m_bonus_link1']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='m_bonus_img1|m_bonus_link1' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片2：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-m_bonus_img2_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-m_bonus_img2_image" class="preview" ref="@if(!empty($group_info['m_bonus_img2']->value)){{ get_image_url($group_info['m_bonus_img2']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-m_bonus_img2">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-m_bonus_img2_text" name="ShopConfigModel[m_bonus_img2]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-m_bonus_img2_button" name="ShopConfigModel[m_bonus_img2]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-m_bonus_img2" name="ShopConfigModel[m_bonus_img2]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-m_bonus_img2_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-m_bonus_link2" class="form-control" name="ShopConfigModel[m_bonus_link2]" value="{{ $group_info['m_bonus_link2']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='m_bonus_img2|m_bonus_link2' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片3：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-m_bonus_img3_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-m_bonus_img3_image" class="preview" ref="@if(!empty($group_info['m_bonus_img3']->value)){{ get_image_url($group_info['m_bonus_img3']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-m_bonus_img3">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-m_bonus_img3_text" name="ShopConfigModel[m_bonus_img3]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-m_bonus_img3_button" name="ShopConfigModel[m_bonus_img3]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-m_bonus_img3" name="ShopConfigModel[m_bonus_img3]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-m_bonus_img3_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-m_bonus_link3" class="form-control" name="ShopConfigModel[m_bonus_link3]" value="{{ $group_info['m_bonus_link3']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='m_bonus_img3|m_bonus_link3' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">滚动图片4：</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-control-box">
                            <div id="shopconfigmodel-m_bonus_img4_control" class="input-file-show">
<span class="show">
<a id="shopconfigmodel-m_bonus_img4_image" class="preview" ref="@if(!empty($group_info['m_bonus_img4']->value)){{ get_image_url($group_info['m_bonus_img4']->value) }}@else{{ '/assets/d2eace91/images/default/goods.gif' }}@endif" data-file="shopconfigmodel-m_bonus_img4">
<i class="fa fa-picture-o"></i>
</a>
</span>
                                <span class="type-file-box">
<input type="text" id="shopconfigmodel-m_bonus_img4_text" name="ShopConfigModel[m_bonus_img4]_text" class="type-file-text">
<input type="button" id="shopconfigmodel-m_bonus_img4_button" name="ShopConfigModel[m_bonus_img4]_button" value="选择上传..." class="type-file-button">
<input type="file" id="shopconfigmodel-m_bonus_img4" name="ShopConfigModel[m_bonus_img4]" class="type-file-file" size="30" onchange="document.getElementById('shopconfigmodel-m_bonus_img4_text').value=this.value" />
</span>
                            </div>
                            <label class="m-l-10 m-r-5 control-label">
                                <i class="fa fa fa-link"></i>
                            </label>
                            <input type="text" id="shopconfigmodel-m_bonus_link4" class="form-control" name="ShopConfigModel[m_bonus_link4]" value="{{ $group_info['m_bonus_link4']->value }}">
                            <a class="btn btn-primary btn-best m-l-10 clear" data-code='m_bonus_img4|m_bonus_link4' href="javascript:;">清空数据</a>
                        </div>
                        <div class="help-block help-block-t">请使用1000*400像素的jpg、gif、png格式图片作为幻灯片banner上传， 如需跳转请在后方添加以http://开头的链接地址</div>
                    </div>
                </div>
            </div>
            <!-- mobile端图片end -->
            <h5 class="m-b-30" data-anchor="引导广告图">引导广告图</h5>
            <!-- 广告引导图片start -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">pc端引导广告图</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="imagegroup_container pull-left" data-id='guide_ad'></div>
                        <input type="hidden" id="guide_ad" class="form-control" name="ShopConfigModel[guide_ad]" value="{{ $group_info['guide_ad']->value }}" placeholder="">
                        <span class="help-block help-block-t">请上传1210*70像素的jpg、gif、png格式图片，此图片展示在领红包页面的轮播图下方</span>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">手机端引导广告图</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="imagegroup_container pull-left" data-id='m_guide_ad'></div>
                        <input type="hidden" id="m_guide_ad" class="form-control" name="ShopConfigModel[m_guide_ad]" value="{{ $group_info['m_guide_ad']->value }}" placeholder="">
                        <span class="help-block help-block-t">请上传1000*110像素的jpg、gif、png格式图片，此图片展示在领红包页面的轮播图下方</span>
                    </div>
                </div>
            </div>
            <!-- 广告引导图片end -->
            <h5 class="m-b-30" data-anchor="分享">分享</h5>
            <!-- 红包集市页面名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-bonus_share_name" class="col-sm-4 control-label">
                        <span class="ng-binding">红包集市页面名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopconfigmodel-bonus_share_name" class="form-control" name="ShopConfigModel[bonus_share_name]" value="{{ $group_info['bonus_share_name']->value }}">
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">红包集市页面名称，最多15个字</div></div>
                    </div>
                </div>
            </div>        <!-- 红包集市分享标题 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-bonus_share_title" class="col-sm-4 control-label">
                        <span class="ng-binding">红包集市分享标题：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <input type="text" id="shopconfigmodel-bonus_share_title" class="form-control" name="ShopConfigModel[bonus_share_title]" value="{{ $group_info['bonus_share_title']->value }}">
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">红包集市信息分享给微信朋友后展示的分享标题，最多40个字</div></div>
                    </div>
                </div>
            </div>        <!-- 红包集市页面名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="shopconfigmodel-bonus_share_desc" class="col-sm-4 control-label">
                        <span class="ng-binding">红包集市分享内容：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <textarea id="shopconfigmodel-bonus_share_desc" class="form-control" name="ShopConfigModel[bonus_share_desc]" rows="5">{!! $group_info['bonus_share_desc']->value !!}</textarea>
                        </div>
                        <div class="help-block help-block-t"><div class="help-block help-block-t">红包集市信息分享给微信朋友后展示的分享内容，最多100个字</div></div>
                    </div>
                </div>
            </div>
            <!-- 分享图片 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">分享推广图</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="imagegroup_container pull-left" data-id='bonus_share_image'></div>
                        <input type="hidden" id="bonus_share_image" class="form-control" name="ShopConfigModel[bonus_share_image]" value="{{ $group_info['bonus_share_image']->value }}" placeholder="">
                        <span class="help-block help-block-t">此推广图应用于分享功能处显示，建议上传正方形图片，最佳显示尺寸为80*80像素</span>
                    </div>
                </div>
            </div>
            <div class="bottom-btn p-b-30">
                {{--<input type="hidden" name="back_url" value="/dashboard/bonus/config.html" />--}}
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}" />
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg" />
            </div>
        </div>
    </form>

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
    <script id="client_rules" type="text">
[{"id": "shopconfigmodel-bonus_img1", "name": "ShopConfigModel[bonus_img1]", "attribute": "bonus_img1", "rules": {"string":true,"messages":{"string":"滚动图片1必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_img2", "name": "ShopConfigModel[bonus_img2]", "attribute": "bonus_img2", "rules": {"string":true,"messages":{"string":"滚动图片2必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_img3", "name": "ShopConfigModel[bonus_img3]", "attribute": "bonus_img3", "rules": {"string":true,"messages":{"string":"滚动图片3必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_img4", "name": "ShopConfigModel[bonus_img4]", "attribute": "bonus_img4", "rules": {"string":true,"messages":{"string":"滚动图片4必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link1", "name": "ShopConfigModel[bonus_link1]", "attribute": "bonus_link1", "rules": {"string":true,"messages":{"string":"Bonus Link1必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link2", "name": "ShopConfigModel[bonus_link2]", "attribute": "bonus_link2", "rules": {"string":true,"messages":{"string":"Bonus Link2必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link3", "name": "ShopConfigModel[bonus_link3]", "attribute": "bonus_link3", "rules": {"string":true,"messages":{"string":"Bonus Link3必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_link4", "name": "ShopConfigModel[bonus_link4]", "attribute": "bonus_link4", "rules": {"string":true,"messages":{"string":"Bonus Link4必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img1", "name": "ShopConfigModel[m_bonus_img1]", "attribute": "m_bonus_img1", "rules": {"string":true,"messages":{"string":"滚动图片1必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img2", "name": "ShopConfigModel[m_bonus_img2]", "attribute": "m_bonus_img2", "rules": {"string":true,"messages":{"string":"滚动图片2必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img3", "name": "ShopConfigModel[m_bonus_img3]", "attribute": "m_bonus_img3", "rules": {"string":true,"messages":{"string":"滚动图片3必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_img4", "name": "ShopConfigModel[m_bonus_img4]", "attribute": "m_bonus_img4", "rules": {"string":true,"messages":{"string":"滚动图片4必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link1", "name": "ShopConfigModel[m_bonus_link1]", "attribute": "m_bonus_link1", "rules": {"string":true,"messages":{"string":"M Bonus Link1必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link2", "name": "ShopConfigModel[m_bonus_link2]", "attribute": "m_bonus_link2", "rules": {"string":true,"messages":{"string":"M Bonus Link2必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link3", "name": "ShopConfigModel[m_bonus_link3]", "attribute": "m_bonus_link3", "rules": {"string":true,"messages":{"string":"M Bonus Link3必须是一条字符串。"}}},{"id": "shopconfigmodel-m_bonus_link4", "name": "ShopConfigModel[m_bonus_link4]", "attribute": "m_bonus_link4", "rules": {"string":true,"messages":{"string":"M Bonus Link4必须是一条字符串。"}}},{"id": "shopconfigmodel-guide_ad", "name": "ShopConfigModel[guide_ad]", "attribute": "guide_ad", "rules": {"string":true,"messages":{"string":"pc端引导广告图必须是一条字符串。"}}},{"id": "shopconfigmodel-m_guide_ad", "name": "ShopConfigModel[m_guide_ad]", "attribute": "m_guide_ad", "rules": {"string":true,"messages":{"string":"手机端引导广告图必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_name", "name": "ShopConfigModel[bonus_share_name]", "attribute": "bonus_share_name", "rules": {"string":true,"messages":{"string":"红包集市页面名称必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_name", "name": "ShopConfigModel[bonus_share_name]", "attribute": "bonus_share_name", "rules": {"string":true,"messages":{"string":"红包集市页面名称必须是一条字符串。","maxlength":"红包集市页面名称只能包含至多15个字符。"},"maxlength":"15"}},{"id": "shopconfigmodel-bonus_share_title", "name": "ShopConfigModel[bonus_share_title]", "attribute": "bonus_share_title", "rules": {"string":true,"messages":{"string":"红包集市分享标题必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_title", "name": "ShopConfigModel[bonus_share_title]", "attribute": "bonus_share_title", "rules": {"string":true,"messages":{"string":"红包集市分享标题必须是一条字符串。","maxlength":"红包集市分享标题只能包含至多40个字符。"},"maxlength":"40"}},{"id": "shopconfigmodel-bonus_share_desc", "name": "ShopConfigModel[bonus_share_desc]", "attribute": "bonus_share_desc", "rules": {"string":true,"messages":{"string":"红包集市分享内容必须是一条字符串。"}}},{"id": "shopconfigmodel-bonus_share_desc", "name": "ShopConfigModel[bonus_share_desc]", "attribute": "bonus_share_desc", "rules": {"string":true,"messages":{"string":"红包集市分享内容必须是一条字符串。","maxlength":"红包集市分享内容只能包含至多100个字符。"},"maxlength":"100"}},{"id": "shopconfigmodel-bonus_share_image", "name": "ShopConfigModel[bonus_share_image]", "attribute": "bonus_share_image", "rules": {"string":true,"messages":{"string":"分享推广图必须是一条字符串。"}}},]
</script>
@stop

{{--footer_js page元素同级下面--}}
@section('footer_js')
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/upload.min.js"></script>
@stop

{{--footer script page元素同级下面--}}
@section('footer_script')


    {!! $script_render !!}

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop