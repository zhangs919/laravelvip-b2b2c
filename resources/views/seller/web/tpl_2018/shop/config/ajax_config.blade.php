<div id="{{ $uuid }}">

    @if(!empty($group_info['explain']))
        <div class="explanation m-b-10">
            <div class="title">
                <i class="arrow-icon explain-checkZoom cur-p" title=""></i>
                <i class="fa fa-bullhorn"></i>
                <h4>温馨提示</h4>
            </div>
            <ul class="explain-panel">
                @foreach($group_info['explain'] as $vo)
                    <li>
                        <span>{!! $vo !!}</span>
                    </li>
                @endforeach

            </ul>
        </div>
    @endif

    <form id="ShopConfigModel" class="form-horizontal" name="ShopConfigModel" action="/system/config/index?group={{ $group }}" method="post" enctype="multipart/form-data">
        @csrf
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




            <div class="simple-form-field p-t-10 p-b-30">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding"></span>
                    </label>
                    <div class="col-sm-8">
                        <button type="button" class="btn btn-primary" id="btn_submit" data-dismiss="modal">确定</button>
                    </div>
                </div>
            </div>
        </div>

    </form>


</div>

{!! $script_render !!}


