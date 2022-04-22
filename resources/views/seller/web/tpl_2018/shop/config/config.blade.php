{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
@stop

{{--content--}}
@section('content')

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/shop/config/index?group={{ $group }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="{{ $group }}">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">

            @if(!empty($group_info['anchor']))
                @foreach($group_info['list'] as $key=>$config_list)
                    {{--设置助手 - 页面导航--}}
                    <h5 class="m-b-30 @if($key == 0) m-t-0 @else m-t-30 @endif" data-anchor="{{ $config_list['anchor'] }}">{{ $config_list['anchor'] }}</h5>

                    {{--配置列表--}}
                    @foreach($config_list['config_list'] as $form)
                        <div class="simple-form-field">
                            <div class="form-group">
                                <label for="shopconfigmodel-{{ $form->code }}" class="col-sm-4 control-label">
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
                                <label for="shopconfigmodel-{{ $form->code }}" class="col-sm-4 control-label">
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

            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">--}}
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
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
    @include('layouts.partials.helper_tool')
@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    {!! $script_render !!}
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop