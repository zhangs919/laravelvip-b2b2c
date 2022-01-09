{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2"/>
@stop

{{--content--}}
@section('content')

    <!--初级服务-->
    <div class="titleBox">
        <span class="title">初级服务</span>
    </div>

    <div class="row p-l-5 p-r-5">
        @foreach($contract_list[0] as $v)
        <div class="col-sm-6 m-b-20">
            <div class="serve-item">
                <div class="serve-img">
                    <img src="{{ get_image_url($v->contract_image) }}" style="width: 60px; height: 60px;" />
                </div>
                <div class="serve-info">
                    <div class="serve-name">
                        <span class="name">{{ $v->contract_name }}</span>
                        <span class="m-l-30">保证金额度：{{ $v->contract_fee }}元</span>
                    </div>
                    <div class="serve-handle">

                        @if($v->is_joined)
                            <div id="quit">
                                <span class="c-green">成功加入</span>
                                <span class='name m-l-40'>
								<a onclick="exit('{{ $v->contract_id }}');">退出</a>
							</span>
                            </div>
                        @else
                            @if($v->status == 1)
                                <span class="c-green">申请进行中</span>
                                <span class="name m-l-40">等待审核</span>
                            @elseif($v->status == 3)
                                <a class="btn btn-success btn-sm" onclick="audit('{{ $v->contract_id }}');">加入</a>
                                <span class="m-l-40">
                                    <a onclick="audit_info('{{ $v->contract_id }}');">审核未通过，点击查看详情</a>
                                </span>
                            @else
                                <a class="btn btn-success btn-sm" onclick="audit('{{ $v->contract_id }}');" id="join">加入</a>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
            <div class="serve-details">
                <div>{!! $v->contract_desc !!}</div>
            </div>
        </div>
        @endforeach

    </div>





    <!--高级服务-->
    <div class="titleBox">
        <span class="title">高级服务</span>
    </div>
    <div class="row p-l-5 p-r-5">
        @foreach($contract_list[1] as $v)
        <div class="col-sm-6 m-b-20">
            <div class="serve-item">
                <div class="serve-img">
                    <img src="{{ get_image_url($v->contract_image) }}" style="width: 60px; height: 60px;" />
                </div>
                <div class="serve-info">
                    <div class="serve-name">
                        <span class="name">{{ $v->contract_name }}</span>
                        <span class="m-l-30">保证金额度：{{ $v->contract_fee }}元</span>
                    </div>
                    <div class="serve-handle">
                        @if($v->is_joined)
                            <div id="quit">
                                <span class="c-green">成功加入</span>
                                <span class='name m-l-40'>
								<a onclick="exit('{{ $v->contract_id }}');">退出</a>
							</span>
                            </div>
                        @else
                            @if($v->status == 1)
                                <span class="c-green">申请进行中</span>
                                <span class="name m-l-40">等待审核</span>
                            @elseif($v->status == 3)
                                <a class="btn btn-success btn-sm" onclick="audit('{{ $v->contract_id }}');">加入</a>
                                <span class="m-l-40">
                                    <a onclick="audit_info('{{ $v->contract_id }}');">审核未通过，点击查看详情</a>
                                </span>
                            @else
                                <a class="btn btn-success btn-sm" onclick="audit('{{ $v->contract_id }}');" id="join">加入</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="serve-details">
                <div>{!! $v->contract_desc !!}</div>
            </div>
        </div>
        @endforeach

    </div>







    <script type="text/javascript">
        //加入，进入审核
        function audit(id) {
            var url = '/shop/contract/audit';
            $.post(url, {
                contract_id: id
            }, function(result) {
                if (result.code == 0) {
                    //$.alert(result.message);
                    //$('#join').replaceWith("<span class='c-green'>申请进行中</span><span class='name m-l-40'>等待审核</span>");
                    //$.loading.start();
                    //window.location.reload();
                    $.msg('加入申请成功，请耐心等待审核结果！！', {}, function() {
                        $.loading.start();
                        $.go('/shop/contract/list');
                    });
                } else {
                    $.msg(result.message);
                }
            }, 'json');
        }
        //审核失败详情
        function audit_info(id) {
            var url = '/shop/contract/audit-info';
            $.post(url, {
                contract_id: id
            }, function(result) {
                if (result.code == 0) {
                    $.alert(result.message);
                } else {
                    $.alert(result.message);
                }
            }, 'json');
        }
        //退出
        function exit(id) {
            $.confirm("您确定要退出此保障服务吗？", {}, function() {
                var url = '/shop/contract/exit';
                $.post(url, {
                    contract_id: id
                }, function(result) {
                    if (result.code == 0) {
                        //$.alert(result.message);
                        //$('#quit').replaceWith("<a class='btn btn-success btn-sm' onclick='audit("+id+")' id='join'>加入</a>")
                        $.msg('退出成功！', {}, function() {
                            $.loading.start();
                            $.go('/shop/contract/list');
                        });
                    } else {
                        $.msg(result.message);
                    }
                }, 'json');
            });
        }
        //禁止使用
        function forbid(name) {
            $.alert('由于您的信誉问题，您已经被禁止加入' + name + '消费者保障服务！');
        }
        //平台方未开启
        function unopened(name) {
            $.alert('平台方管理员未开启' + name + '消费者保障服务！');
        }
    </script>

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