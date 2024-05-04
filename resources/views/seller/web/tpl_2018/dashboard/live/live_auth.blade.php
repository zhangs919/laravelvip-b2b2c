{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css"/>
@stop

{{--content--}}
@section('content')

    <form id="LiveAuth" class="form-horizontal" name="LiveAuth" action="/dashboard/live/live-auth" method="post" enctype="multipart/form-data">
        @csrf
        <div class="table-content m-t-30 clearfix">
            <div class="form-horizontal">
                <!-- 直播有效期 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="liveauth-start_time" class="col-sm-3 control-label">
                            <span class="ng-binding">允许直播开始时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="control-label">{{ format_time($model['start_time']) }}</div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="liveauth-end_time" class="col-sm-3 control-label">
                            <span class="ng-binding">允许直播结束时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="control-label">{{ format_time($model['end_time']) }}</div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 允许创建直播活动数量 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="liveauth-all_number" class="col-sm-3 control-label">
                            <span class="ng-binding">允许创建直播活动数量：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="control-label">{{ $model['all_number'] }}</div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 已创建数量 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="liveauth-use_number" class="col-sm-3 control-label">
                            <span class="ng-binding">已创建直播活动数量：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="control-label">{{ $model['use_number'] }}</div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 允许直播时长 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="liveauth-all_hours" class="col-sm-3 control-label">
                            <span class="ng-binding">允许直播时长（小时）：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="control-label">{{ $model['all_hours'] }}</div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 已直播时长 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="liveauth-use_hours" class="col-sm-3 control-label">
                            <span class="ng-binding">已直播时长（小时）：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="control-label">{{ $model['time_limit'] }}</div>
                            </div>
                            <div class="help-block help-block-t"></div>
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

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop