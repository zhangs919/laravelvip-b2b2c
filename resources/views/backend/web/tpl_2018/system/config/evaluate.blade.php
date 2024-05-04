@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=evaluate" method="post" enctype="multipart/form-data" novalidate="novalidate">
        @csrf
        <input type="hidden" name="group" value="evaluate">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-mark_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">评价期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-mark_term" class="form-control ipt pull-none m-r-5" name="SystemConfigModel[mark_term]" value="{{ $group_info['mark_term']->value }}">



                            天


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如设置30，自“确认收货”起30天内可评价</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-chase_term" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">追评期限：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">




                            <input type="text" id="systemconfigmodel-chase_term" class="form-control ipt pull-none m-r-5" name="SystemConfigModel[chase_term]" value="{{ $group_info['mark_term']->value }}">



                            天


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">如设置30，自“确认收货”提交起30天内可追评</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-auto_mark" class="col-sm-4 control-label">

                        <span class="ng-binding">是否开启到期系统自动好评：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[auto_mark]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-auto_mark"
                                               class="form-control b-n"
                                               name="SystemConfigModel[auto_mark]"
                                               value="1" @if($group_info['auto_mark']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启后，“评价期限”到期后买家不评价，系统会自动好评；关闭后，“评价期限”到期后买家不评价，将自动过期不再允许评价和追评</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-mark_audit" class="col-sm-4 control-label">

                        <span class="ng-binding">评价是否需要审核：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SystemConfigModel[mark_audit]" value="0">
                                    <label>
                                        <input type="checkbox"
                                               id="systemconfigmodel-mark_audit"
                                               class="form-control b-n"
                                               name="SystemConfigModel[mark_audit]"
                                               value="1" @if($group_info['mark_audit']->value == 1)checked="" @endif
                                               data-on-text="是" data-off-text="否"></label>
                                </div>
                            </label>




                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">开启后，买家发布评价后不会立即生效显示，需平台方审核通过后才能生效</div></div>
                    </div>
                </div>
            </div>






            <div class="bottom-btn p-b-30">
                <input type="hidden" name="back_url" value="{{ request()->fullUrl() }}">
                {{--<input type="hidden" name="back_url" value="{{ $_SERVER['HTTP_REFERER'] ?? '' }}">--}}
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </div></form>

@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop