@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">

@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=desc_conform" method="post">
        @csrf
        <input type="hidden" name="group" value="desc_conform">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-desc_1" class="col-sm-4 control-label">

                        <span class="ng-binding">1分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-desc_1" class="form-control" name="SystemConfigModel[desc_1]" value="{{ $group_info['desc_1']->value }}">

                            <select class="form-control m-l-5" name="SystemConfigModel[desc_1_eval]">
                                @foreach($group_info['desc_1_eval']->options as $key=>$item)
                                    <option value="{{ $key }}" @if($group_info['desc_1_eval']->value == $key)selected=""@endif>{{ $item }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">1分是最低分值，请务必设为差评</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-desc_2" class="col-sm-4 control-label">

                        <span class="ng-binding">2分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-desc_2" class="form-control" name="SystemConfigModel[desc_2]" value="{{ $group_info['desc_2']->value }}">

                            <select class="form-control m-l-5" name="SystemConfigModel[desc_2_eval]">
                                @foreach($group_info['desc_2_eval']->options as $key=>$item)
                                    <option value="{{ $key }}" @if($group_info['desc_2_eval']->value == $key)selected=""@endif>{{ $item }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">2分建议设为中评或者差评</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-desc_3" class="col-sm-4 control-label">

                        <span class="ng-binding">3分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-desc_3" class="form-control" name="SystemConfigModel[desc_3]" value="{{ $group_info['desc_3']->value }}">

                            <select class="form-control m-l-5" name="SystemConfigModel[desc_3_eval]">
                                @foreach($group_info['desc_3_eval']->options as $key=>$item)
                                    <option value="{{ $key }}" @if($group_info['desc_3_eval']->value == $key)selected=""@endif>{{ $item }}</option>
                                @endforeach
                            </select>



                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">3分是中间分值，建议设为中评</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-desc_4" class="col-sm-4 control-label">

                        <span class="ng-binding">4分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-desc_4" class="form-control" name="SystemConfigModel[desc_4]" value="{{ $group_info['desc_4']->value }}">

                            <select class="form-control m-l-5" name="SystemConfigModel[desc_4_eval]">
                                @foreach($group_info['desc_4_eval']->options as $key=>$item)
                                    <option value="{{ $key }}" @if($group_info['desc_4_eval']->value == $key)selected=""@endif>{{ $item }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">4分建议设为好评或者中评</div></div>
                    </div>
                </div>
            </div>


            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-desc_5" class="col-sm-4 control-label">

                        <span class="ng-binding">5分：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="systemconfigmodel-desc_5" class="form-control" name="SystemConfigModel[desc_5]" value="{{ $group_info['desc_5']->value }}">

                            <select class="form-control m-l-5" name="SystemConfigModel[desc_5_eval]">
                                @foreach($group_info['desc_5_eval']->options as $key=>$item)
                                    <option value="{{ $key }}" @if($group_info['desc_5_eval']->value == $key)selected=""@endif>{{ $item }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">5分是最高分值，请务必设为好评</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary">
                    </div>
                </div>
            </div>

        </div>
    </form>



@stop

@section('helper_tool')
    @include('layouts.partials.helper_tool')
@stop

@section('footer_script')

    {!! $script_render !!}

@stop