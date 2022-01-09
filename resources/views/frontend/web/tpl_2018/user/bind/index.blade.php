@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">账号绑定</li>
                    <li class="li-spe">（绑定第三方账户，绑定成功后即可使用第三方账户快速登录）</li>
                </ul>
            </div>
            <div class="content-info">
                <div id="safe" class="binding">
                    <div class="safe-list">
                        <div class="fore1">
                            <s class="fore1-bg1"></s>
                            <strong>QQ账户</strong>
                        </div>
                        <div class="fore2">
                            <span>您还没有绑定qq账户，绑定后您可以使用qq快速登录。</span>
                        </div>
                        <div class="fore3">
                            <a href="javascript:;" data-id="qq" class="btn bind">快速绑定</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <script type="text/javascript">
            $().ready(function() {
                // 解除绑定
                $("body").on('click', '.remove-bind', function() {
                    var key = $(this).data("id");
                    $.confirm("您确定要解除绑定吗？", function() {
                        $.ajax({
                            type: "GET",
                            url: "/user/bind/remove",
                            dataType: "json",
                            data: {
                                key: key
                            },
                            success: function(result) {
                                $.msg(result.message);
                                $.go('/user/bind');
                            }
                        })
                    });
                })

                $("body").on('click', '.bind', function() {
                    var type = $(this).data("id");
                    $.go("http://www.b2b2c.yunmall.68mall.com" + "/website/login?type=" + type);
                })
            });
        </script>
    </div>

@endsection