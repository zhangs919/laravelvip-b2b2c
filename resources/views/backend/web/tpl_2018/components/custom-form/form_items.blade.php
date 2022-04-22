{{--
--- 通用类组件 ---
input:单行文字
textarea:多行文字
radio:单项选择
checkbox:多项选择
number:数字
time:时间
select:下拉框
describe:描述
url:网址
upload_file:上传附件
--}}
{{--
--- 图视类组件 ---
image:图片展示
video:视频播放
--}}
{{--
--- 联系人组件 ---
username:姓名
phone:手机
email:邮箱
address:地址
--}}
{{--
--- 通讯组件 ---
weixin:微信
qq:QQ
weibo:微博
--}}
{{--
--- 其它组件 ---
dividing_line:分割线
static_map:静态地图
--}}

<div class="type-content">
    <div class="question-title">
        <span class="required" data-unique="v_required" data-type="display" @if(@!$form['v_required'])style="display: none;"@endif>*</span>
        <span class="q-title" data-unique="title" data-type="text">{{ $form['title'] }}</span>
    </div>

@switch($form['type'])



    @case("input")
        <div class="question-conent">
            <input style="width: 300px;" value="{{ $form['title_default_value'] }}" class="disabled" type="text" data-unique="title_default_value" disabled="" data-type="input">
        </div>
    @break


    @case("textarea")
        <div class="question-conent">
            <textarea rows="5" cols="60" class="disabled" data-unique="title_default_value" disabled="" data-type="input">{!! $form['title_default_value'] !!}</textarea>
        </div>
    @break


    @case("radio")
        <div class="question-conent" data-unique="layout" data-type="class">
            <ul data-unique="items" data-type="radio" class="clearfix {{ $form['layout'] }}">
                @foreach($form['items'] as $item)
                <li><label class=""><input class="disabled" disabled="" type="radio" name="option" @if($item['checked']){{ 'checked' }}@endif>{{ $item['val'] }}</label></li>
                @endforeach
            </ul>
        </div>
    @break

    @case("checkbox")
        <div class="question-conent" data-unique="layout" data-type="class">
            <ul data-unique="items" data-type="checkbox" class="clearfix {{ $form['layout'] }}">

                @foreach($form['items'] as $item)
                    <li>
                        <label>
                            <input type="checkbox" disabled="" name="option[]" @if($item['checked'])checked=""@endif>
                            {{ $item['val'] }}
                        </label>
                    </li>
                @endforeach

            </ul>
        </div>
    @break

    @case("number")
        <div class="question-conent">
            <div class="item-input-box" style="width: auto !important;">
                <i class="item-icon number"></i>
                <input style="width: 300px; padding-left: 30px" class="disabled" type="text" data-unique="title_default_value" disabled="" data-type="input" value="{{ $form['title_default_value'] }}">
                <span data-type="text" data-unique="unit" class="m-l-15">{{ $form['unit'] }}</span>
            </div>
        </div>
    @break

    @case("time")
        <div class="question-conent">
            <div class="item-input-box" style="width: auto !important;">
                <i class="item-icon time"></i>
                <input style="width: 300px; padding-left: 30px" class="disabled" type="text" data-unique="default_time" disabled="" data-type="input" value="{{ $form['default_time'] }}">
            </div>
        </div>
    @break

    @case("select")
        <div class="question-conent">
            <select style="width: 300px;" class="disabled" data-unique="items" disabled="" data-type="select">
                @foreach($form['items'] as $item)
                    <option @if($item['checked'])selected=""@endif value="{{ $item['val'] }}">{{ $item['val'] }}</option>
                @endforeach
            </select>
        </div>
    @break

    @case("describe")
        <div class="question-conent">
            <div class="T_edit" data-unique="description" data-type="text">{!! $form['description'] !!}</div>
        </div>
    @break

    @case("url")
        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon url"></i>
                <input style="width: 300px; padding-left: 30px" class="disabled" type="text" placeholder="http://" data-unique="title_default_value" disabled="" data-type="input" value="{{ $form['title_default_value'] }}">
            </div>
        </div>
    @break

    @case("upload_file")
        <div class="question-conent">
            <div class="upload-box">
                <div class="container">
                    <a href="javascript:void(0);" class="btn btn-default">选择文件</a>
                    <a href="javascript:void(0);" class="btn btn-primary">开始上传</a>
                </div>
            </div>
            <div class="help-block help-block-t" data-unique="description" data-type="text" style="display: none;"></div>
        </div>
    @break

    @case("image")
        <div class="question-conent">
            <div data-unique="image_url" data-type="image">

                @if(!empty($form['image_url']))
                    <img style="max-width: 100%" src="{{ $form['image_url'] }}">
                @endif

            </div>
        </div>
    @break

    @case("video")

        <div class="question-conent">
            <div data-unique="video_url" data-type="video">

                @if(!empty($form['video_url']))
                    <video style="width: 100%;" src="{{ get_image_url($form['video_url']) }}"></video>
                @endif

            </div>
        </div>
    @break

    @case("username")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon name"></i>
                <input class="item-input disabled" style="width: 300px;" type="text" data-unique="title_default_value" disabled="" data-type="input" value="{{ $form['title_default_value'] }}">
            </div>
        </div>
    @break

    @case("phone")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon handset"></i>
                <input style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled="" data-type="input">
            </div>
        </div>
    @break

    @case("email")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon mall"></i>
                <input style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled="" data-type="input">
            </div>
        </div>
    @break

    @case("address")
        <div class="question-conent">
            <div class="form-group">

                <select class="m-r-15 w150 select province" disabled="" data-unique="province">

                    <option value="">{{ explode('-', $form['address']['address_text'])[0] ?? '- 省/自治区/直辖市 -' }}</option>

                </select>
                <select class="m-r-15 select city" disabled="" data-unique="city">

                    <option value="">{{ explode('-', $form['address']['address_text'])[1] ?? '- 市 -' }}</option>

                </select>
                <select class="m-r-15 select county" disabled="" data-unique="county">

                    <option value="">{{ explode('-', $form['address']['address_text'])[2] ?? '- 区/县 -' }}</option>

                </select>
            </div>
            <div class="form-group m-t-15">
                <textarea type="text" rows="5" cols="60" class="disabled" data-unique="address_detail" disabled="" data-type="input">{!! $form['address']['address_detail'] !!}</textarea>
            </div>
        </div>
    @break

    @case("weixin")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon weixin"></i>
                <input class="item-input disabled" style="width: 300px;" type="text" data-unique="title_default_value" disabled="" data-type="input">
            </div>
        </div>
    @break

    @case("qq")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon qq"></i>
                <input class="item-input disabled" style="width: 300px;" type="text" data-unique="title_default_value" disabled="" data-type="input">
            </div>
        </div>
    @break

    @case("weibo")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon weibo"></i>
                <input class="item-input disabled" style="width: 300px;" type="text" data-unique="title_default_value" disabled="" data-type="input">
            </div>
        </div>
    @break

    @case("dividing_line")

        <div class="question-conent">
            <div class="DividingLine" style="border-bottom-color: {{ $form['line_color'] ?? '#ccc' }};border-bottom-style: {{ $form['line_shape'] ?? 'dashed' }};border-bottom-width: {{ $form['line_width'] ?? '1px' }};" data-unique="dividing_line"></div>
        </div>
    @break

    @case("static_map")

        <div class="question-conent">
            <div class="map_container"></div>
        </div>
    @break


{{--

    @case("short_text")
    --}}{{--短单行文本 start--}}{{--
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control ipt"
           name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    --}}{{--短单行文本 end--}}{{--
    @break

    @case("text")
    --}}{{--单行文本 start--}}{{--
    <input type="text" id="systemconfigmodel-{{ $form->code }}" class="form-control"
           name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    --}}{{--单行文本 end--}}{{--
    @break

    @case("textarea")
    --}}{{--多行文本 start--}}{{--
    <textarea id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]"
              rows="5">{!! $form->value ?? '' !!}</textarea>
    --}}{{--多行文本 end--}}{{--
    @break

    @case("password")
    --}}{{--密码 start--}}{{--
    <input type="password" id="systemconfigmodel-{{ $form->code }}" class="form-control"
           name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value ?? ''}}">
    --}}{{--密码 end--}}{{--
    @break

    @case("html")
    --}}{{--自定义html start--}}{{--
    {!! $form->value ?? '' !!}
    --}}{{--自定义html end--}}{{--
    @break

    @case("static")
    --}}{{--静态文本 start--}}{{--
    <label id="{{ $form->code }}" class="control-label">{!! $form->value ?? '' !!}</label>
    --}}{{--静态文本 start--}}{{--
    @break

    @case("radio")
    --}}{{--单选按钮 start--}}{{--
    <input type="hidden" name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    <div id="systemconfigmodel-{{ $form->code }}" class="" name="SystemConfigModel[{{ $form->code }}]">
        @foreach($form->options as $option_id=>$option)
            <label class="control-label cur-p m-r-10">
                <input type="radio" name="SystemConfigModel[{{ $form->code }}]" value="{{ $option_id }}"
                       @if($form->value == $option_id) checked="" @endif> {{ $option }}</label>
        @endforeach
    </div>

    --}}{{--单选按钮 end--}}{{--
    @break

    @case("imagegroup")
    --}}{{--图片组 start--}}{{--
    --}}{{--data-size 图片数量 data-mode（0：模式一：默认 | 1：模式二：直接显示图片列表）--}}{{--
    --}}{{--data-mode 显示模式：0-一个一个上传 1-上传多个并且允许中间有空的图片--}}{{--
    <div id="{{ $form->code }}_imagegroup_container" class="szy-imagegroup"
         data-id="systemconfigmodel-{{ $form->code }}" data-size="{{ $form->size }}" data-mode="{{ $form->mode }}">
    </div>
    <script type="text/javascript">
        $().ready(function () {
            $("#{{ $form->code }}_imagegroup_container").data("labels", {!! $form->labels !!});

            //
        });
    </script>

    <input type="hidden" id="systemconfigmodel-{{ $form->code }}" class="form-control"
           name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value}}">
    --}}{{--图片组 end--}}{{--
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
                       value="{{ $option_id }}" @if(in_array($option_id, $form->value)) checked="" @endif> {{ $option }}
            </label>
        @endforeach
    </div>

    @break

    @case("kindeditor")
    <textarea id="systemconfigmodel-{{ $form->code }}" class="form-control" name="SystemConfigModel[{{ $form->code }}]"
              rows="5">{!! $form->value !!}</textarea>
    @break

    @case("region")
    <!-- 地区选择器 start -->
    <div class="region-container" data-id="systemconfigmodel-{{ $form->code }}" 　data-sale-scope="0"
         data-min-level=""></div>
    <!-- 地区选择器 end -->
    <input type="hidden" id="systemconfigmodel-{{ $form->code }}" class="form-control"
           name="SystemConfigModel[{{ $form->code }}]" value="{{ $form->value }}">
    @break

    @case("colorpicker")
    --}}{{--colorpicker:取色器 start--}}{{--
    <input type="text" class="form-control colorpicker ipt w250" name="SystemConfigModel[{{ $form->code }}]"
           value="{{ $form->value }}">
    --}}{{--colorpicker:取色器 end--}}{{--
    @break--}}

@endswitch

    <div class="help-block help-block-t" data-unique="description" data-type="text" @if(empty($form['description']) || $form['type'] == 'describe')style="display: none;"@endif>{!! $form['description'] !!}</div>
</div>