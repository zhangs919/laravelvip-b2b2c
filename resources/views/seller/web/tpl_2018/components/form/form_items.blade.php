{{--
short_text:短单行文本
text:单行文本
textarea:多行文本
password:密码
html:自定义html
static:静态文本
radio:单选按钮
switch:开关
imagegroup:图片组
select:下拉框
checkbox:复选框
kindeditor:KindEditor
region:地区联动
colorpicker:取色器

date:日期
datetime:日期+时间
hidden:隐藏
array:数组
linkage:普通联动下拉框
linkages:快速联动下拉框
image:单张图片
file:单个文件
files:多个文件
ueditor:UEditor
wangeditor:wangEditor
editormd:markdown
icon:字体图标
tags:标签
number:数字
bmap:百度地图
colorpicker:取色器
jcrop:图片裁剪
masked:格式文本
range:范围
time:时间
--}}
@switch($form->type)

    @case("short_text")
    {{--短单行文本 start--}}
    <input type="text" id="shopconfigmodel-{{ $form->code }}" class="form-control ipt" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value ?? '' }}">
    {{--短单行文本 end--}}
    @break

    @case("text")
    {{--单行文本 start--}}
    <input type="text" id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value ?? '' }}">
    {{--单行文本 end--}}
    @break

    @case("textarea")
    {{--多行文本 start--}}
    <textarea id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]" rows="5">{!! $form->value ?? '' !!}</textarea>
    {{--多行文本 end--}}
    @break

    @case("password")
    {{--密码 start--}}
    <input type="password" id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value ?? '' }}">
    {{--密码 end--}}
    @break

    @case("html")
    {{--自定义html start--}}
    {!! $form->value ?? '' !!}
    {{--自定义html end--}}
    @break

    @case("static")
    {{--静态文本 start--}}
    <label id="{{ $form->code }}" class="control-label">{!! $form->value ?? '' !!}</label>
    {{--静态文本 start--}}
    @break

    @case("radio")
    {{--单选按钮 start--}}
    <input type="hidden" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    <div id="shopconfigmodel-{{ $form->code }}" class="" name="ShopConfigModel[{{ $form->code }}]">
        @foreach($form->options as $option_id=>$option)
        <label class="control-label cur-p m-r-10">
            <input type="radio" name="ShopConfigModel[{{ $form->code }}]" value="{{ $option_id }}" @if($form->value == $option_id) checked="" @endif> {{ $option }}</label>
        @endforeach
    </div>

    {{--单选按钮 end--}}
    @break

    @case("imagegroup")
    {{--图片组 start--}}
    {{--data-size 图片数量 data-mode（0：模式一：默认 | 1：模式二：直接显示图片列表）--}}
    {{--data-mode 显示模式：0-一个一个上传 1-上传多个并且允许中间有空的图片--}}
    <div id="{{ $form->code }}_imagegroup_container" class="szy-imagegroup"
         data-id="shopconfigmodel-{{ $form->code }}" data-size="{{ $form->size }}" data-mode="{{ $form->mode }}">
    </div>
    <script type="text/javascript">
        $().ready(function(){
            $("#{{ $form->code }}_imagegroup_container").data("labels", {!! $form->labels !!});

            //
        });
    </script>

    <input type="hidden" id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value}}">
    {{--图片组 end--}}
    @break



    @case("switch")
    <label class="control-label control-label-switch">
        <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
            <input type="hidden" name="ShopConfigModel[{{ $form->code }}]" value="0">
            <label>
                <input type="checkbox"
                       id="shopconfigmodel-{{ $form->code }}"
                       class="form-control b-n"
                       name="ShopConfigModel[{{ $form->code }}]"
                       value="1" @if($form->value == 1)checked="" @endif
                       data-on-text="是" data-off-text="否"></label>
        </div>
    </label>
    @break

    @case("select")
    <select id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]">
    @foreach($form->options as $option_id=>$option)
        <option value="{{ $option_id }}" @if($form->value == $option_id) selected @endif>{{ $option }}</option>
    @endforeach
    </select>
    @break

    @case("checkbox")
    <input type="hidden" name="ShopConfigModel[{{ $form->code }}]" value="0">
    <div id="shopconfigmodel-{{ $form->code }}" class="" name="ShopConfigModel[{{ $form->code }}]">
        @foreach($form->options as $option_id=>$option)
            <label class="control-label cur-p m-r-10">
                <input type="checkbox" name="ShopConfigModel[{{ $form->code }}][]"
                       value="{{ $option_id }}" @if(in_array($option_id, $form->value)) checked="" @endif> {{ $option }}</label>
        @endforeach
    </div>

    @break

    @case("kindeditor")
    <textarea id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]" rows="5" >{!! $form->value !!}</textarea>
    @break

    @case("region")
    <!-- 地区选择器 start -->
    <div class="region-container" data-id="shopconfigmodel-{{ $form->code }}" 　data-sale-scope="0" data-min-level=""></div>
    <!-- 地区选择器 end -->
    <input type="hidden" id="shopconfigmodel-{{ $form->code }}" class="form-control" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    @break

    @case("colorpicker")
    {{--colorpicker:取色器 start--}}
    <input type="text" class="form-control colorpicker ipt w250" name="ShopConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    {{--colorpicker:取色器 end--}}
    @break

@endswitch