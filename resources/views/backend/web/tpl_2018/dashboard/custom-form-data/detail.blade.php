{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=201900316"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <form class="form-horizontal">
        <div class="table-content m-t-30">
            <h5 class="m-b-30 m-t-0" data-anchor="表单明细">表单明细</h5>
            <div class="content">
                <!-- 表单标题 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">表单标题：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <label class="control-label">{{ $form_info->form_title }} 信息反馈</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 提交时间 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">提交时间：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <label class="control-label"> {{ $form_data_info->created_at }}</label>
                            </div>
                        </div>
                    </div>
                </div>


                @foreach($form_data_info->form_data as $v)
                <div class="simple-form-field">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <span class="ng-binding">{{ $v['title'] }}：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <label class="control-label">

                                    @if(is_array($v['value'])){{ implode('、', $v['value']) }}@else{{ $v['value'] }}@endif


                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


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