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
                    <li class="active">收货地址</li>
                </ul>
            </div>
            <div class="content-info">
                <div class="address-info">
                    <h2>

                        <a href="javascript:add()">新增收货地址</a>

                        <span>（已保存了{{ $address_total }}条地址，还能保存{{ 20 - $address_total }}条地址）</span>
                    </h2>
                    <div id='edit-address-div'></div>




                    <div id="table_list">
                        <h2>已保存的地址</h2>
                        <div class="shipping-address">

                            <table class="shipping-list" cellpadding="0" cellspacing="0">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 10%;">
                                    <col style="width: 25%;">
                                    <col style="width: 10%;">
                                    <col style="width: 14%;">
                                    <col style="width: 9%;">
                                    <col style="width: 9%;">
                                </colgroup>
                                <tr>
                                    <th>收货人</th>
                                    <th class="region-code-format">收货地址</th>
                                    <th class="address-detail">详细地址</th>
                                    <th>手机/固定电话</th>
                                    <th class="email">邮箱</th>
                                    <th>操作</th>
                                    <th class="address-default">&nbsp;</th>
                                </tr>


                                @foreach($address_list as $address)
                                <tr @if($address->is_default)class="address-default"@endif>


                                    <td align="center">{{ $address->consignee }}</td>
                                    <td align="left">{{ $address->region_name }}</td>
                                    <td align="left">{{ $address->address_detail }}</td>
                                    <td align="center">
                                        <p>{{ $address->mobile }}</p>
                                        <p>{{ $address->tel }}</p>
                                    </td>
                                    <td align="center">{{ $address->email ?? '-- --' }}</td>
                                    <td align="center">
                                        <a class="address-oprate address-edit" href="javascript:void(0)" data-id="{{ $address->address_id }}">修改</a>
                                        <span class="line">|</span>
                                        <a class="address-oprate address-del" href="javascript:void(0)" data-id="{{ $address->address_id }}">删除</a>
                                    </td>
                                    <td align="center">
                                        @if($address->is_default)
                                        <span class="note">默认地址</span>
                                        @else
                                        <a class="note" href="javascript:set_default({{ $address->address_id }})" style="display: none;">设为默认</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>



                    <h2>

                    </h2>
                </div>
            </div>
        </div>
        <!-- 引入地区三级联动js -->
        <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
        <!-- 表单验证 -->
        <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180528"></script>
        <!-- 鼠标滚轮 -->
        <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180528"></script>
        <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
        <script src="/js/user_address.js?v=20180528"></script>
        
        <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                tablelist = $("#table_list").tablelist({
                    page: {
                        page_size: 20
                    }
                });

                $(".go-top").click(function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 100);
                })

                $('body').on('click', '.address-edit', function() {
                    var address_id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/user/address/edit',
                        data: {
                            address_id: address_id
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 0) {
                                $('#edit-address-div').html(data.data);
                            }
                        }
                    });
                })

                $('body').on('click', '.address-del', function() {
                    var address_id = $(this).data('id');
                    $.confirm("您确定要删除此收货地址吗？", function() {
                        $.ajax({
                            type: 'GET',
                            url: '/user/address/del',
                            data: {
                                address_id: address_id
                            },
                            dataType: 'json',
                            success: function(result) {
                                if (result.code == 0) {
                                    $.msg(result.message, {
                                        time: 1000
                                    }, function() {
                                        $.go(window.location.href);
                                    });
                                } else {
                                    $.msg(result.message);
                                }
                            }
                        });
                    });
                })

            });
        </script></div>

@endsection