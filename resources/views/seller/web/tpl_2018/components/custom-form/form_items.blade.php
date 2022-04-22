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
        @if(@$form['v_required'])<span class="required" >*</span>@endif
        <span class="q-title">{{ $form['title'] }}</span>
    </div>

@switch($form['type'])



    @case("input")
        <div class="question-conent">
            <input type="text" name="input_{{ $k }}" style="width: 300px;" value="{{ $form['title_default_value'] }}">
        </div>
    @break


    @case("textarea")
        <div class="question-conent">
            <textarea rows="5" cols="60" name="textarea_{{ $k }}">{!! $form['title_default_value'] !!}</textarea>
        </div>
    @break

    @case("radio")
        <div class="question-conent">
            <ul class="clearfix {{ $form['layout'] }}">

                @foreach($form['items'] as $item)
                <li>
                    <label>
                        <input type="radio" name="radio_{{ $k }}" value="{{ $item['val'] }}" @if($item['checked']){{ 'checked' }}@endif>
                        {{ $item['val'] }}
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
    @break

    @case("checkbox")
        <div class="question-conent">
            <ul class="clearfix {{ $form['layout'] }}">

                @foreach($form['items'] as $item)
                    <li>
                        <label>
                            <input type="checkbox" value="{{ $item['val'] }}" name="checkbox_{{ $k }}[]" @if($item['checked'])checked=""@endif>
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
                <input type="text" class="item-input" name="number_{{ $k }}" style="width: 300px;" value="{{ $form['title_default_value'] }}">
                <span class="m-l-15">{{ $form['unit'] }}</span>
            </div>
        </div>
    @break

    @case("time")
        <div class="question-conent">
            <div class="item-input-box" style="width: auto !important;">
                <i class="item-icon time"></i>
                <input class="item-input datetimepicker" name="time_{{ $k }}" style="width: 300px;" type="text" value="{{ $form['default_time'] }}">
            </div>
        </div>
    @break

    @case("select")
        <div class="question-conent">
            <select style="width: 300px;" name="select_{{ $k }}">
                @foreach($form['items'] as $item)
                    <option @if($item['checked'])selected=""@endif value="{{ $item['val'] }}">{{ $item['val'] }}</option>
                @endforeach
            </select>
        </div>
    @break

    @case("describe")
        <div class="question-conent">
            <div class="T_edit">{!! $form['description'] !!}</div>
        </div>
    @break

    @case("url")
        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon url"></i>
                <input class="item-input" name="url_{{ $k }}" style="width: 300px;" type="text" placeholder="http://" value="{{ $form['title_default_value'] }}">
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
            <div>

                @if(!empty($form['image_url']))
                    <img style="max-width: 100%" src="{{ $form['image_url'] }}">
                @endif

            </div>
        </div>
    @break

    @case("video")

        <div class="question-conent">
            <div>

                @if(!empty($form['video_url']))
                    <video controls="controls" style="width: 100%;" src="{{ get_image_url($form['video_url']) }}"></video>
                @endif

            </div>
        </div>
    @break

    @case("username")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon name"></i>
                <input class="item-input" name="username_{{ $k }}" style="width: 300px;" type="text" value="{{ $form['title_default_value'] }}">
            </div>
        </div>
    @break

    @case("phone")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon handset"></i>
                <input type="text" name="phone_{{ $k }}" class="item-input" style="width: 300px;">
            </div>
        </div>
    @break

    @case("email")

        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon mall"></i>
                <input type="text" name="email_{{ $k }}" class="item-input" style="width: 300px;">
            </div>
        </div>
    @break

    @case("address")
        <div class="question-conent">
            <div class="form-group region_container"></div>
            <div class="form-group m-t-15">
                <textarea class="address_detail" placeholder="详细地址" rows="5" cols="60">{!! $form['address']['address_detail'] !!}</textarea>
            </div>
            <input type="hidden" class="full_address" name="address_{{ $k }}" value="">
        </div>
    @break

    @case("weixin")
        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon weixin"></i>
                <input type="text" class="item-input" name="weixin_{{ $k }}" style="width: 300px;">
            </div>
        </div>
    @break

    @case("qq")
        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon qq"></i>
                <input type="text" name="qq_{{ $k }}" class="item-input" style="width: 300px;">
            </div>
        </div>
    @break

    @case("weibo")
        <div class="question-conent">
            <div class="item-input-box">
                <i class="item-icon weibo"></i>
                <input type="text" class="item-input" name="weibo_{{ $k }}" style="width: 300px;">
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
            <div class="map_container" id="map_container_{{ $k }}"></div>
        </div>
    @break

@endswitch

    <div class="help-block help-block-t" data-unique="description" data-type="text" @if(empty($form['description']) || $form['type'] == 'describe')style="display: none;"@endif>{!! $form['description'] !!}</div>
</div>