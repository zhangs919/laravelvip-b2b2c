@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <div class="user-status">
                    @foreach($express as $key=>$item)
                    <span class="@if($key == 0){{ 'active' }}@endif" id="status{{ $key+1 }}" onclick="setTab('status','{{ $key+1 }}','{{ count($express) }}')">
                        <a href="javascript:;" target="_self">
                            <span>包裹{{ $key+1 }}</span>
                            <span class="vertical-line">|</span>
                        </a>
                    </span>
                    @endforeach
                </div>
            </div>
            <div class="content-info">
                @foreach($express as $key=>$item)
                    <div class="package clearfix" id="con_status_{{ $key+1 }}">
                        <div class="logistics-text">
                            <ul class="text-info">
                                <li>
                                    运单号：
                                    <span class="color">{{ $item['info']['express_sn'] }}</span>
                                </li>
                                <li>
                                    @if($item['shipping_type'] == 3){{--第三方物流--}}
                                        官方快递查询：
                                        <a href="{{ $item['info']['site_url'] ?? 'javascript:;' }}" target="_blank"
                                           title="点击进入{{ $item['info']['shipping_name'] }}官方网站" class="color">{{ $item['info']['shipping_name'] }}官网</a>
                                    @else{{--0 无需物流 1 指派 2 众包--}}

                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="package-goods clearfix">
                            <dl>
                                <dt>订单商品：</dt>
                                <dd class="package-goods-list">
                                    <ul>
                                        @foreach($item['info']['goods_list'] as $goods)
                                        <li>
                                            <a href="{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}" target="_blank"
                                               title="{{ $goods['sku_name'] }}">
                                                <img src="{{ $goods['sku_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" alt=""/>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="content-list logistics">
                            <dl>
                                <dt>物流方式：</dt>
                                <dd>
                                    {{ $item['shipping_type_format'] }}
                                </dd>
                            </dl>
                            @if($item['shipping_type'] == 3){{--第三方物流--}}
                                <dl>
                                    <dt>物流公司：</dt>
                                    <dd>
                                        {{ $item['info']['shipping_name'] }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>运单号码：</dt>
                                    <dd>{{ $item['info']['express_sn'] }}</dd>
                                </dl>
                                <dl>
                                    <dt>物流跟踪：</dt>
                                    <dd>
                                        <table class="table" width="100%">
                                            <thead>
                                            <tr>
                                                <th width="20%">操作时间</th>
                                                <th>操作记录</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item['content']['list'] as $content)
                                                <tr>
                                                    @if($item['error'] > 0)
                                                        <td align="center" colspan="2">{!! $content['msg'] !!}</td>
                                                    @else
                                                        <td align="center">{{ $content['time'] }}</td>
                                                        <td>{!! $content['msg'] !!}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </dd>
                                </dl>
                            @else{{--0 无需物流 1 指派 2 众包--}}

                            @endif

                        </div>
                    </div>
                @endforeach
                <div class="operat-tips">
                    <h4>本页面物流查询信息由快递公司提供</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>物流快递信息有可能存在延迟，可能会导致您的物流信息长时间没有更新，敬请耐心等待。（延迟时间可能从1天到3天不等，EMS快递的物流配送信息可能最多有1周的延迟）。</span>
                        </li>
                        <li>
                            <span>如果最先配送的物流没法配送到配送地址，将对商品进行二次转运，转运后的商品可能暂时没有物流信息，请耐心等待，我们会尽快更新。</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@stop


{{--底部js--}}
@section('footer_js')
    <script src="/js/common.js"></script>
    <script src="/js/user.js"></script>
    <script src="/assets/d2eace91/js/yii.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function () {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function () {
        })
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }

        //
    </script>
@stop