@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group={{ $group }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <input type="hidden" name="group" value="{{ $group }}">
        <input type="hidden" name="tabs" value="">

        {{--部分配置才有 配置介绍说明--}}
        @if(!empty($introduce_box))
        {!! $introduce_box !!}
        @endif


        <div class="table-content m-t-30">

            @if(!empty($group_info['anchor']))
            @foreach($group_info['list'] as $key=>$config_list)
            {{--设置助手 - 页面导航--}}
            <h5 class="m-b-30 @if($key == 0) m-t-0 @else m-t-30 @endif" data-anchor="{{ $config_list['anchor'] }}">{{ $config_list['anchor'] }}</h5>

            {{--配置列表--}}
            @foreach($config_list['config_list'] as $form)
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="systemconfigmodel-{{ $form->code }}" class="col-sm-4 control-label">
                            @if($form->required == 1)
                                <span class="text-danger ng-binding">*</span>
                            @endif
                            <span class="ng-binding">{{ $form->title }}：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                @include('components.form.form_items')

                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">{!! $form->tips !!}</div></div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endforeach

            @else
                {{--配置列表--}}
                @if(!empty($group_info['list']))
                    @foreach($group_info['list'] as $form)
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label for="systemconfigmodel-{{ $form->code }}" class="col-sm-4 control-label">
                                    @if($form->required == 1)
                                        <span class="text-danger ng-binding">*</span>
                                    @endif
                                    <span class="ng-binding">{{ $form->title }}：</span>
                                </label>
                                <div class="col-sm-8">
                                    <div class="form-control-box">

                                        @include('components.form.form_items')

                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">{!! $form->tips !!}</div></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endif

            {{--特殊情况 最后面的配置项--}}
            @if($group == 'smtp')
                <!-- 发送测试邮件 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">

                            <span class="ng-binding">发送测试邮件：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="text" id="test_mail_address" {{--name="test_mail_address"--}} class="form-control" data-rule-email="true" data-msg="请输入一个有效的邮件地址">
                                <input type="button" id="btn_test" value="发送测试邮件" class="btn btn-primary btn-best m-l-10">

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

            @elseif($group == 'sms')
                <!-- 发送测试手机号码 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">

                            <span class="ng-binding">发送测试号码：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">

                                <input type="text" id="test_mobile" {{--name="test_mobile"--}} class="form-control" data-rule-mobile="true" data-msg="请输入一个有效的手机号码">
                                <input type="button" id="btn_test" value="发送测试号码" class="btn btn-primary btn-best m-l-10">

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

            @endif

            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">--}}
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
                {{--特殊情况 微信设置--}}
                @if($group == 'weixin')
                    <input type="button" value="清空" class="btn btn-default m-l-10 clear">
                @endif
            </div>

        </div></form>

@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop