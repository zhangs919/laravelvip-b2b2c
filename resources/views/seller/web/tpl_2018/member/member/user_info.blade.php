{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <form class="form-horizontal" action="/member/member/user-info?id={{ $info->user_id }}" method="post">
        {{ csrf_field() }}
        <div class="table-content m-t-10 clearfix">
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <!--此处必填为样式，并不是此项必填-->
                        <span class="text-danger ng-binding"></span>
                        <span class="ng-binding">会员名称：</span>
                        <input type="hidden" name="user_id" value="{{ $info->user_id }}">
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->username }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding"></span>
                        <span class="ng-binding">会员昵称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->user->nickname }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">会员等级（平台）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->platform_rank_name }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">会员等级（店铺）：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select id="rank_id" class="form-control" name="rank_id">
                                <option value="">-- 请选择 --</option>

                                @foreach($shop_rank_list as $v)
                                    <option value="{{ $v->rank_id }}" @if($info->rank_id == $v->rank_id) selected @endif>{{ $v->rank_name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">会员状态：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <select name="is_enable" class="form-control">
                                <option @if($info->is_enable == 1) selected = 'selected' @endif value='1'>享受会员折扣</option>
                                <option @if($info->is_enable == 0) selected = 'selected' @endif value='0' >不享受会员折扣</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">会员性别：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ format_sex($info->user->sex) }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="ng-binding">会员生日：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->user->birthday->format('Y-m-d') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">手机号码：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->user->mobile ?? '无' }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">邮箱地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">{{ $info->user->email ?? '无' }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group ng-scope">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">交易次数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">0</label>
                        </div>
                        <div class="help-block help-block-t">交易次数不统计交易关闭订单</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group ng-scope">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">交易总额：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">0.00</label>
                        </div>
                        <div class="help-block help-block-t">交易总额不统计交易关闭订单</div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">平均订单金额：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">0</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group ng-scope">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">上次交易时间：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">无</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="ng-binding">交易关闭数：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">
                            <label class="control-label">0</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field p-b-30">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label"></label>
                    <div class="col-xs-8">
                        <button class="btn btn-primary" type="submit">确认提交</button>
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
    <script type='text/javascript'>
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format: 'yyyy-mm-dd',
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop