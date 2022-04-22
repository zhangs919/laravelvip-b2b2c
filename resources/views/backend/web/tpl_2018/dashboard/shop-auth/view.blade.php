{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/revision-styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form method="" action="" class="form-horizontal">
        <div class="table-content m-t-30 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺ID：</span>
                    </label>
                    <div class="col-sm-4">
                        <label class="control-label text-l">{{ $shop_info->shop_id }}</label>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-4">
                        <label class="control-label text-l">{{ $shop_info->shop_name }}</label>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-3 control-label">
                        <span class="ng-binding">营销权限：</span>
                    </label>
                    <div class="col-sm-9">
                        <!-- - -->
                        <div class="authset-all" style="width: 780px;">
                            <!--一级循环-->
                            @foreach($shop_application_list as $shop_app)
                                <dl class="simple-form-field">
                                    <dt class="tit">
									<span>
										<label> {{ $shop_app['name'] }} </label>
									</span>
                                    </dt>
                                    <dd class="form-group-t">
                                        <div class="authset-list">
                                            <div class="col-sm-12 control-label control-label-t">
                                                <ul class="authset-section b-n">
                                                    <!--二级循环-->

                                                    @if(!empty($shop_app['child']))
                                                        @foreach($shop_app['child'] as $child)
                                                            <li class="w180 p-l-0 m-b-10">
                                                                <label class="control-label">{{ $child['name'] }}：@if(in_array($child['field'], $shop_auth))启用@else禁用@endif</label>
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>


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

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop