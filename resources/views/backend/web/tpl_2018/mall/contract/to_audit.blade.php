{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-10 clearfix">
        <form id="searchForm" class="form-horizontal" action="to-audit" method="POST">
            {{ csrf_field() }}
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">

                        <span class="ng-binding">保障服务：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->contract_name }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">

                        <span class="ng-binding">店铺名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->shop_name }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">

                        <span class="ng-binding">申请时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->created_at }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">审核状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label cur-p m-r-20">
                                <input name="audit" type="radio" value="1" @if($info->status == 1) checked="checked" @endif />
                                等待审核</label>
                            <label class="control-label cur-p m-r-20">
                                <input name="audit" type="radio" value="2" @if($info->status == 2) checked="checked" @endif />
                                审核通过</label>
                            <label class="control-label cur-p m-r-20">
                                <input name="audit" type="radio" value="3" @if($info->status == 3) checked="checked" @endif />
                                审核未通过</label>

                        </div>
                    </div>
                </div>
            </div>

            <!-- 文本域 -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">审核意见：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <textarea maxlength="200" onkeyup="checkLen(this)" aria-required="true" id="remark" class="form-control" name="remark" rows="5">{!! $info->remark !!}</textarea>
                            <p class="m-t-5">您可以输入
                                <span id="count">200</span>
                                个字符</p>
                        </div>
                    </div>
                </div>
            </div>
            <input name="id" type="hidden" value="{{ $info->id }}" />
            <input name="toaudit" type="hidden" value="toaudit" />
            <!-- 提交按钮 -->
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <div class="form-control-box">
                            <input id="btn_submit" name="btn_submit" class="btn btn-primary" value="确认提交" type="submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
    <script type="text/javascript">
        //审核意见最多可输入200个字符
        function checkLen(obj){
            var maxChars = 200;//最多字符数
            var curr = maxChars - obj.value.length;
            document.getElementById("count").innerHTML = curr.toString();
        }
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop