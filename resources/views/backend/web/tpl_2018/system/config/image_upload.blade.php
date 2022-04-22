@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

@section('content')

    <form id="SystemConfigModel" class="form-horizontal" name="SystemConfigModel" action="/system/config/index?group=image_upload" method="post" enctype="multipart/form-data" novalidate="novalidate">
        {{ csrf_field() }}
        <input type="hidden" name="group" value="image_upload">
        <input type="hidden" name="tabs" value="">
        <div class="table-content m-t-30">




            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-image_dir_type" class="col-sm-4 control-label">

                        <span class="ng-binding">图片存放方式：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">





                            <input type="hidden" name="SystemConfigModel[image_dir_type]" value="{{ $group_info['image_dir_type']->value }}">
                            <div id="systemconfigmodel-image_dir_type" class="" name="SystemConfigModel[image_dir_type]">
                                <label class="control-label cur-p m-r-10"><input type="radio" name="SystemConfigModel[image_dir_type]" value="{{ $group_info['image_dir_type']->value }}" @if($group_info['image_dir_type']->value == 3) checked="" @endif> 按照年月日存放（例：/ 店铺id / 年 / 月 / 日 / 图片） </label>
                            </div>




                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-image_max_filesize" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">图片/附件大小：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            最大


                            <input type="text" id="systemconfigmodel-image_max_filesize" class="form-control ipt m-l-10 m-r-10" name="SystemConfigModel[image_max_filesize]" value="{{ $group_info['image_max_filesize']->value }}">



                            KB (1024 KB = 1MB)


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">当前服务器环境，最大允许上传 4MB的文件，您的设置请勿超过该值，默认最大可上传2MB</div></div>
                    </div>
                </div>
            </div>








            <div class="simple-form-field">
                <div class="form-group">
                    <label for="systemconfigmodel-video_max_filesize" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">视频大小：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">



                            最大


                            <input type="text" id="systemconfigmodel-video_max_filesize" class="form-control ipt m-l-10 m-r-10" name="SystemConfigModel[video_max_filesize]" value="{{ $group_info['video_max_filesize']->value }}">



                            KB (1024 KB = 1MB)


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">当前服务器环境，最大允许上传4MB的文件，您的设置请勿超过该值，默认最大可上传2MB</div></div>
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