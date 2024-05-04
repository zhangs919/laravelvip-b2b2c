{{--
text:单行文本
short_text:短单行文本
textarea:多行文本
short_text:短单行文本
html:自定义html
static:静态文本
password:密码
hidden:隐藏
switch:开关
radio:单选按钮
imagegroup:图片组
select:下拉框
checkbox:复选框
kindeditor:KindEditor
region:地区联动
colorpicker:取色器
time:时间

array:数组





date:日期
datetime:日期+时间
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
jcrop:图片裁剪
masked:格式文本
range:范围
time:时间
--}}
@switch($form->type)

    @case("text")
    {{--单行文本 start--}}
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    {{--单行文本 end--}}
    @break

    @case("textarea")
    {{--多行文本 start--}}
    <textarea id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" rows="5">{!! $form->value ?? '' !!}</textarea>
    {{--多行文本 end--}}
    @break

    @case("short_text")
    {{--短单行文本 start--}}
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control ipt" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    {{--短单行文本 end--}}
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

    @case("password")
    {{--密码 start--}}
    <input type="password" id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    {{--密码 end--}}
    @break

    @case("hidden")
    {{--隐藏 start--}}
    <input type="hidden" id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    {{--隐藏 end--}}
    @break

    @case("switch")
    <label class="control-label control-label-switch">
        <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
            <input type="hidden" name="SystemConfigModel[{{ $form->code }}]" value="0">
            <label>
                <input type="checkbox"
                       id="systemconfigmodel-{{ $form->code }}"
                       class="form-control b-n"
                       name="SystemConfigModel[{{ $form->code }}]"
                       value="1" @if($form->value == 1)checked="" @endif
                       data-on-text="是" data-off-text="否"></label>
        </div>
    </label>
    @break

    @case("radio")
    {{--单选按钮 start--}}
    <input type="hidden" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    <div id="systemconfigmodel-{{ $form->code }}" class="" name="SystemConfigModel[{{ $form->code }}]">
        @foreach($form->options as $option_id=>$option)
        <label class="control-label cur-p m-r-10">
            <input type="radio" name="SystemConfigModel[{{ $form->code }}]" value="{{ $option_id }}" @if($form->value == $option_id) checked="" @endif> {{ $option }}</label>
        @endforeach
    </div>
    {{--单选按钮 end--}}
    @break

    @case("imagegroup")
    {{--图片组 start--}}
    {{--data-size 图片数量 data-mode（0：模式一：默认 | 1：模式二：直接显示图片列表）--}}
    {{--data-mode 显示模式：0-一个一个上传 1-上传多个并且允许中间有空的图片--}}
    <div id="{{ $form->code }}_imagegroup_container" class="szy-imagegroup"
         data-id="systemconfigmodel-{{ $form->code }}" data-size="{{ $form->size }}" data-mode="{{ $form->mode }}">
    </div>
    <script type="text/javascript">
        $().ready(function(){
            $("#{{ $form->code }}_imagegroup_container").data("labels", {!! $form->labels !!});

            //
        });
    </script>

    <input type="hidden" id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value}}">
    {{--图片组 end--}}
    @break

    @case("select")
    <select id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]">
    @foreach($form->options as $option_id=>$option)
        <option value="{{ $option_id }}" @if($form->value == $option_id) selected @endif>{{ $option }}</option>
    @endforeach
    </select>
    @break

    @case("checkbox")
    <input type="hidden" name="SystemConfigModel[{{ $form->code }}]" value="0">
    <div id="systemconfigmodel-{{ $form->code }}" class="" name="SystemConfigModel[{{ $form->code }}]">
        @foreach($form->options as $option_id=>$option)
            <label class="control-label cur-p m-r-10">
                <input type="checkbox" name="SystemConfigModel[{{ $form->code }}][]"
                       value="{{ $option_id }}" @if(in_array($option_id, $form->value)) checked="" @endif> {{ $option }}</label>
        @endforeach
    </div>
    @break

    @case("kindeditor")
    <textarea id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" rows="5" >{!! $form->value !!}</textarea>
    @break

    @case("region")
    <!-- 地区选择器 start -->
    <div class="region-container" data-id="systemconfigmodel-{{ $form->code }}" 　data-sale-scope="0" data-min-level=""></div>
    <!-- 地区选择器 end -->
    <input type="hidden" id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    @break

    @case("colorpicker")
    {{--colorpicker:取色器 start--}}
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control colorpicker ipt w250" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    {{--colorpicker:取色器 end--}}
    @break

    @case("time")
    {{--time:时间 start--}}
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control form_datetime ipt" name="SystemConfigModel[{{ $form->code }}]"
{{--           value="{{ $form->value }}"--}}{{--todo 此处有值时 js报错 暂时注释掉值--}}
           data-datetime="true"
           unselect="0" data-language="zh-CN" data-today-btn="1" data-autoclose="1" data-week-start="0"
           data-start-view="1" data-min-view="0" data-max-view="1" data-minute-step="5"
           data-format="hh:ii:ss" data-value="{{ $form->value }}" />
    {{--time:时间 end--}}
    @break

    @case("array") {{--todo 特殊元素 不需要此处的模板--}}
    {{--数组 start--}}
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    {{--数组 end--}}
    @break



@endswitch

{{--显示单位--}}
@if(!empty($form->unit))
    <span data-type="text" data-unique="unit" class="m-l-10">{{ $form['unit'] }}</span>
@endif