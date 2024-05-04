{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')

    <form id="MemberModel" class="form-horizontal" name="MemberModel" action="/member/member/add" method="post">
        @csrf
        <div class="table-content m-t-30 clearfix">
            <!-- 会员账号 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="membermodel-username" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">会员账号：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="membermodel-username" class="form-control" name="MemberModel[username]" value="{{ old('username') }}">


                        </div>
                        @if(!empty(session('err')))
                        <span class="form-control-error">
                        <i class="fa fa-warning"></i>
                        {{ session('err') }}
                        </span>
                        @endif
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 会员等级 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="membermodel-rank" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">会员等级：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <select id="membermodel-rank" class="form-control" name="MemberModel[rank]">
                                <option value="">-- 请选择 --</option>
                                @foreach($shop_rank_list as $v)
                                <option value="{{ $v->rank_id }}" @if(old('rank') == $v->rank_id) selected @endif>{{ $v->rank_name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <!-- 提交按钮 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary" id="btn_submit" name="btn_submit" value="确认提交">

                        </div>

                        <div class="help-block help-block-t"></div>
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
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
[{"id": "membermodel-username", "name": "MemberModel[username]", "attribute": "username", "rules": {"required":true,"messages":{"required":"会员账号不能为空。"}}},{"id": "membermodel-rank", "name": "MemberModel[rank]", "attribute": "rank", "rules": {"required":true,"messages":{"required":"会员等级不能为空。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#MemberModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                // 加载提示
                $.loading.start();
                $("#MemberModel").submit();
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop