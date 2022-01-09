<div id="{{ $page_id }}">
    <!-- 温馨提示 -->

    <form class="form-horizontal" id="tpl_style_form">
        <div class="table-content m-t-10 clearfix">
            <!-- 设置宽度 -->

            @if(!empty($data['style_height']))
            <!-- 设置高度 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置高度：</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control ipt w250" name="height" value="{{ $selector_data[0]['height'] ?? '' }}">
                            px
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($data['style_colorpicker']))
                <!-- 颜色选择器 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置背景颜色：</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control colorpicker ipt w250" name="bgcolor" value="{{ $selector_data[0]['bgcolor'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @endif


            <!-- 图片 -->
            @if(!empty($data['style_image']))
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置背景图片：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="szy-imagegroup">
                                <ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul>
                            </div>
                            <input type="hidden" class="bg-image" name="bgimage" value="{{ $selector_data[0]['bgimage'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @endif

            {{--边框--}}
            @if(!empty($data['style_border']))
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置边框：</span>
                        </label>
                        <div class="col-sm-9">
                            <label class="control-label cur-p m-r-10">
                                <input type="radio" name="border" @if(@$selector_data[0]['border'] == -1) checked @endif value="-1">
                                无边框
                            </label>
                            <label class="control-label cur-p m-r-10">
                                <input type="radio" name="border" @if(@$selector_data[0]['border'] == 0) checked @endif value="0">
                                有边框
                            </label>
                        </div>
                    </div>
                </div>
                @endif


            @if(!empty($data['style_structure_layout']))
                <!--模板布局设置-->
                <div class="style-structure-layout">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="text4" class="col-sm-3 control-label">
                                <span class="ng-binding">前台菜单展示样式：</span>
                            </label>
                            <div class="col-sm-9">
                                <label class="control-label cur-p m-r-10">

                                    <input type="radio" name="tab_nav" checked value="0" />
                                    横向滚动
                                </label>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="tab_nav" value="1" />
                                    折行显示
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="structure-layout-nav">
                        <ul>

                            <li class="current" data-index="0">
                                <a href="javascript:void(0)">菜单1</a>
                            </li>

                        </ul>
                        <a href="javascript:void(0);" class="add-tab-btn">添加菜单</a>
                    </div>
                    <div class="structure-layout-con">
                        <div class="structure-layout-preview">
                            <!--中间内容-->

                            <div class="structure-layout-box">
                                <div class="structure-layout-list edit">
                                    页面楼层
                                    <input type="hidden" name="layout[0][]" value="0-0">
                                    <div class="handle-btn-con">
                                        <a href="javascript:void(0)" class="del">
                                            <i class="fa fa-trash-o"></i>
                                            删除
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="add-floor-btn">
                                <h4>
                                    <a href="javascript:void(0);" class="add-template" data-index="0">+ 新增</a>
                                </h4>
                            </div>
                        </div>
                        <!--右侧设置楼层布局-->
                        <div class="layout-container">
                            <div class="design-sidebar">
                                <div class="sidebar-arrow"></div>
                                <div class="sidebar-inner">
                                    <div class="table-content m-t-10 clearfix">
                                        <div class="simple-form-field">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <span class="ng-binding">显示内容：</span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-box">
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="layout_type" class="layout-radio" value="0" type="radio" checked="checked">
                                                            广告
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="layout_type" class="layout-radio" value="1" type="radio">
                                                            商品
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="layout_type" class="layout-radio" value="2" type="radio">
                                                            品牌
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="layout_type" class="layout-radio" value="3" type="radio">
                                                            商家
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="layout_type" class="layout-radio" value="4" type="radio">
                                                            自定义
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="layout_type" class="layout-radio" value="5" type="radio">
                                                            商品分类
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--广告-->
                                        <div class="simple-form-field style-type">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <span class="ng-binding">显示样式：</span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-box">
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-0" class="layout-radio" value="0" type="radio" checked="checked">
                                                            一行显示1个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-0" class="layout-radio" value="1" type="radio">
                                                            一行显示2个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-0" class="layout-radio" value="2" type="radio">
                                                            一行显示3个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-0" class="layout-radio" value="3" type="radio">
                                                            一行显示4个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-0" class="layout-radio" value="4" type="radio">
                                                            一行显示5个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-0" class="layout-radio" value="5" type="radio">
                                                            左一右二
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simple-form-field style-type hide">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <span class="ng-binding">显示样式：</span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-box">
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-1" class="layout-radio" value="0" type="radio" checked="checked">
                                                            一行显示2个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-1" class="layout-radio" value="1" type="radio">
                                                            一行显示3个
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-1" class="layout-radio" value="2" type="radio">
                                                            自动关联分类(需要分类楼层支持)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simple-form-field style-type hide">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <span class="ng-binding">显示样式：</span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-box">
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-2" class="layout-radio" value="0" type="radio" checked="checked">
                                                            品牌logo和名称
                                                        </label>
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-2" class="layout-radio" value="1" type="radio">
                                                            品牌logo
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simple-form-field style-type hide">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <span class="ng-binding">显示样式：</span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-box">
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-3" class="layout-radio" value="1" type="radio" checked="checked">
                                                            店铺logo
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 自定义 -->
                                        <div class="simple-form-field style-type hide"></div>
                                        <div class="simple-form-field style-type hide">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <span class="ng-binding">显示样式：</span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <div class="form-control-box">
                                                        <label class="control-label cur-p m-r-10">
                                                            <input name="style-type-5" class="layout-radio" value="0" type="radio" checked="checked">
                                                            一行显示5个
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!--手机端设置楼层版式三滚动样式-->

            @if(!empty($data['style_banner_roll']))
            <!--手机端设置banner滚动样式-->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">轮播样式：</span>
                        </label>
                        <div class="col-sm-9">
                            <label class="control-label cur-p m-r-10">
                                <input type="radio" name="banner_roll" @if(@$selector_data[0]['banner_roll'] == 0) checked @endif value="0" />
                                普通样式
                            </label>
                            <label class="control-label cur-p m-r-10">
                                <input type="radio" name="banner_roll" @if(@$selector_data[0]['banner_roll'] == 1) checked @endif value="1" />
                                3D样式
                            </label>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field banner-set hide">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置背景颜色：</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control colorpicker ipt w250" name="banner_bgcolor" value="{{ $selector_data[0]['banner_bgcolor'] ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="simple-form-field banner-set hide">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置背景图片：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="szy-imagegroup"></div>
                            <input type="hidden" class="bg-image" name="banner_bgimage" value="{{ $selector_data[0]['banner_bgimage'] ?? '' }}">
                            <input type="hidden" class="bg-image-height" name="banner_bgimage_height" value="{{ $selector_data[0]['banner_bgimage_height'] ?? '' }}">
                            <input type="hidden" class="bg-image-width" name="banner_bgimage_width" value="{{ $selector_data[0]['banner_bgimage_width'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($data['style_layout_s1']))
                <!-- 布局样式1 , 微商城资讯频道设置左右布局 0代表左 1代表右 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">设置布局：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="m-news-layout SZY-LAYOUT-S1">
                                <div class="news-left-layout " data-val="left">
                                    <em></em>
                                </div>
                                <div class="news-right-layout news-layout-current" data-val="right">
                                    <em></em>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input class="m-news-input" name="layout_s1" value="{{ $selector_data[0]['layout_s1'] ?? 'right' }}" />
                <script type="text/javascript">
                    $('.SZY-LAYOUT-S1 div').click(function() {
                        $(this).addClass('news-layout-current').siblings().removeClass('news-layout-current');
                        $('input[name="layout_s1"]').val($(this).data('val'));
                    });
                </script>
            @endif

            @if(!empty($data['timer']))
                <!-- 定时器 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">倒计时：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <input type="text" class="form-control ipt m-r-10" name="timer" value="{{ $selector_data[0]['timer'] ?? 0 }}">
                                秒
                            </div>
                            <div class="help-block help-block-t">设置悬浮广告停留多久自动关闭。设置为0则一直悬浮直到手动关闭。</div>
                        </div>
                    </div>
                </div>
            @endif



            @if(!empty($data['suspend_ad_show_model']))
                <!-- 悬浮广告显示模式设置 0=>只显示一次 1=>每次都显示 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-3 control-label">
                            <span class="ng-binding">显示模式：</span>
                        </label>
                        <div class="col-sm-9">
                            <label class="control-label cur-p m-r-10">
                                <input type="radio" name="suspend_ad_show_model" @if(@$selector_data[0]['suspend_ad_show_model'] == 0) checked @endif value="0" />
                                关闭后不再显示
                            </label>
                            <label class="control-label cur-p m-r-10">
                                <input type="radio" name="suspend_ad_show_model" @if(@$selector_data[0]['suspend_ad_show_model'] == 1) checked @endif value="1" />
                                每次访问都显示
                            </label>
                        </div>
                    </div>
                </div>
            @endif



        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal">确定</button>
        </div>
    </form>
</div>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180528"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180528"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
<script type="text/javascript">
    $().ready(function() {
        var type = '{{ $data['type'] }}';
        var cat_id = '{{ $data['cat_id'] ?? 1 }}';
        var uid = '{{ $data['uid'] }}';
        var select_count = '0';
        var max_number = '{{ $data['number'] }}';
        var dataform = $("#{{ $page_id }}").find('#tpl_style_form');
        $("#{{ $page_id }}").find("#ok").click(function() {
            if(! validator(dataform)){
                return false;
            }
            //var bgcolor = $("#{{ $page_id }}").find("input[name='bgcolor']").val();
            var obj_data = dataform.serializeJson();

            chk_value = [];
            chk_value.push(obj_data);

            //上传数据
            $.designadddata({
                data: {
                    uid: uid,
                    chk_value: chk_value,
                    type: type,
                    cat_id: cat_id,
                },
            });
        });

        function validator(dataform){
            if(dataform.find("input[name='width']").length > 0){
                var number = /^\+?[1-9][0-9]*$/;
                if(dataform.find("input[name='width']").val() != '' && !number.test(dataform.find("input[name='width']").val())){
                    $.msg('输入不合法，请输入大于0的整数');
                    dataform.find("input[name='width']").addClass('error');
                    return false;
                }
            }
            if(dataform.find("input[name='height']").length > 0){
                var number = /^\+?[1-9][0-9]*$/;
                if(dataform.find("input[name='height']").val() != '' && !number.test(dataform.find("input[name='height']").val())){
                    $.msg('输入不合法，请输入大于0的整数');
                    dataform.find("input[name='height']").addClass('error');
                    return false;
                }
            }
            if(dataform.find("input[name='timer']").length > 0){
                var number = /^\+?[0-9][0-9]*$/;
                if(dataform.find("input[name='timer']").val() != '' && !number.test(dataform.find("input[name='timer']").val())){
                    $.msg('输入不合法，请输入大于等于0的整数');
                    dataform.find("input[name='timer']").addClass('error');
                    return false;
                }
            }
            return true;
        }

        $("input").focus(function(){
            if($(this).hasClass('error')){
                $(this).removeClass('error');
            }
        });

        @if(!empty($data['style_image']))
        // 上传图片
        var image_container = $("#{{ $page_id }}").find(".szy-imagegroup");
        image_container.imagegroup({
            // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
            host: "{{ get_oss_host() }}",
            values: image_container.parent().find('.bg-image').val().split("|"),
            callback: function(data) {
                image_container.parent().find('.bg-image').val(data.path);

            },
            remove: function(value, values) {
                image_container.parent().find('.bg-image').val("");
            }
        });
        @elseif(!empty($data['style_banner_roll']))
        // 上传图片
        var image_container = $("#{{ $page_id }}").find(".szy-imagegroup");
        image_container.imagegroup({
            // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
            host: "{{ get_oss_host() }}",
            values: image_container.parent().find('.bg-image').val().split("|"),
            callback: function(data) {
                image_container.parent().find('.bg-image').val(data.path);
                image_container.parent().find('.bg-image-height').val(data.height);
                image_container.parent().find('.bg-image-width').val(data.width);

            },
            remove: function(value, values) {
                image_container.parent().find('.bg-image').val("");
                image_container.parent().find('.bg-image-height').val('');
                image_container.parent().find('.bg-image-width').val('');
            }
        });
        @endif

        @if(!empty($data['style_banner_roll']))
        $("#{{ $page_id }}").find("input[name='banner_roll']").click(function () {
            var inputVal=$("#{{ $page_id }}").find("input[name='banner_roll']:checked").val();
            if(inputVal==1)
            {
                $('.banner-set').removeClass('hide');
            }
            else
            {
                $('.banner-set').addClass('hide');
            }
        });
        @endif


    });


    @if(isset($data['style_colorpicker']))
        $('#{{ $page_id }}').find('.colorpicker').colorpicker({
            color: '{{ $selector_data[0]['bgcolor'] ?? '' }}'
        }).on('change.color', function(evt, color) {
            $("#{{ $page_id }}").find("input[name='bgcolor']").val(color);
        });
    @elseif(isset($data['style_banner_roll']))
        $('#{{ $page_id }}').find('.colorpicker').colorpicker({
            color: '{{ $selector_data[0]['banner_bgcolor'] ?? '' }}'
        }).on('change.color', function(evt, color) {
            $("#{{ $page_id }}").find("input[name='banner_bgcolor']").val(color);
        });
    @endif

    @if(isset($data['style_structure_layout']))
        var index = $('#{{ $page_id }} .structure-layout-nav li').length;
        // 添加
        $('#{{ $page_id }} .style-structure-layout').on('click','.add-tab-btn',function(){

            var tab_num = index+1;
            $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-nav ul').append('<li data-index="'+index+'"><a href="javascript:void(0)">菜单'+tab_num+'</a></li>');
            $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-preview .add-floor-btn').before('<div class="structure-layout-box hide"><div class="structure-layout-list edit">页面楼层<input type="hidden" name="layout['+index+'][]" value="0-0"><div class="handle-btn-con"><a href="javascript:void(0)" class="del"><i class="fa fa-trash-o"></i>删除</a></div></div></div>')
            index++;
        });

        $('#{{ $page_id }} .style-structure-layout').on('click','.structure-layout-nav ul li',function(){
            $(this).addClass('current').siblings().removeClass('current');
            $('.style-structure-layout').find('.structure-layout-preview .structure-layout-box').addClass('hide');
            $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-preview .structure-layout-box').eq($(this).attr('data-index')).removeClass('hide');
            $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-preview .add-floor-btn a').attr('data-index', $(this).attr('data-index'));
            $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-box').eq($(this).data('index')).find('.structure-layout-list').eq(0).click();
        });


        $('#{{ $page_id }} .style-structure-layout').on('click','.structure-layout-preview .add-floor-btn a',function(){
            $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-preview .structure-layout-box').eq($(this).attr('data-index')).append('<div class="structure-layout-list">页面楼层<input type="hidden" name="layout['+$(this).attr('data-index')+'][]" value="0-0"><div class="handle-btn-con"><a href="javascript:void(0)" class="del"><i class="fa fa-trash-o"></i>删除</a></div></div>');

        });


        $('#{{ $page_id }} .style-structure-layout').find('[name="layout_type"]').change(function(){
            $('#{{ $page_id }} .style-structure-layout').find('.style-type').addClass('hide');
            $('#{{ $page_id }} .style-structure-layout').find('.style-type').eq($(this).val()).removeClass('hide');
        });

        $('#{{ $page_id }} .style-structure-layout').on('change','.layout-radio',function(){
            var layout_type_1 = $('#{{ $page_id }}').find('[name="layout_type"]:checked').val();
            var layout_type_2 = $('#{{ $page_id }}').find('[name="style-type-'+layout_type_1+'"]:checked').val();
            $.each($('#{{ $page_id }} .style-structure-layout').find('.structure-layout-box'),function(){
                if(! $(this).hasClass('hide')){
                    $.each($(this).find('.structure-layout-list'),function(){
                        if($(this).hasClass('edit')){
                            $(this).find('input').val(layout_type_1+'-'+layout_type_2);
                        }
                    });
                }
            });
        });

        $('#{{ $page_id }} .style-structure-layout').on("click",".structure-layout-list",function(){
            var tips = $('#{{ $page_id }} .style-structure-layout').find('.design-sidebar');//需定位区域
            var value = $(this).find('input').val();
            value = value.split("-");
            tips.find('[name="layout_type"]').eq(value[0]).checked=true;
            $('#{{ $page_id }} .style-structure-layout').find('.style-type').addClass('hide');
            $('#{{ $page_id }} .style-structure-layout').find('.style-type').eq(value[0]).removeClass('hide');
            tips.find('[name="style-type-'+value[0]+'"]').eq(value[1]).checked=true;
            $(this).addClass('edit').siblings().removeClass('edit');
            var space = $(this).position().top;//与上间距
            var height =space; //需定位内容的位置调整
            tips.css("marginTop",(height)+'px');

        });


        //删除
        $('#{{ $page_id }} .style-structure-layout').find('.structure-layout-preview').on('click','.del',function(){
            if($(this).parents('.structure-layout-list').siblings().length == 0){
                $('#{{ $page_id }} .style-structure-layout .structure-layout-nav ul li').eq($(this).parents('.structure-layout-box').index()).siblings().eq(0).click();
                $('#{{ $page_id }} .style-structure-layout .structure-layout-nav ul li').eq($(this).parents('.structure-layout-box').index()).remove();
            }
            if($(this).parents('.structure-layout-list').hasClass('edit')){
                $(this).parents('.structure-layout-box .structure-layout-list').siblings().eq(0).click();
            }
            $(this).parents('.structure-layout-list').remove();

        });

        setTimeout(function(){
            $('#{{ $page_id }} .style-structure-layout .structure-layout-list').eq(0).click();
        }, 1000);
    @endif
</script>