<div id="user_address_list" class="main-content">
    <h2 class="title">地址选择</h2>
    <div class="address">
        <div class="address-list clearfix" data-check-address="">
            <!-- 收货地址为当前选中的地址时给div标签一个class，class值为"active" -->




            @foreach($address_list as $v) {{--todo 选中地址 class值为"active"--}}
            <div data-address-id={{ $v->address_id }} data-address-position="{{ $v->address_lng }},{{ $v->address_lat }}" class="address-box active">
                <div class="address-box-info" data-address-id={{ $v->address_id }}>
                    <div class="name">

                        {{ $v->consignee }}
                    </div>
                    <div class="detaile">{{ $v->region_name }}</div>
                    <div class="detaile">{{ $v->address_detail }} {{ $v->address_house }}</div>
                    <div class="number-phone">{{ hide_tel($v->mobile) }}</div>
                </div>
                <div class="addr-operate">
                    <a href="javascript:void(0)" class="address-edit color" data-address-id={{ $v->address_id }} title="修改地址">修改</a>
                    <a href="javascript:void(0)" class="address-delete color" data-address-id={{ $v->address_id }} title="删除地址">删除</a>
                    <!-- 默认地址一直显示用span标签 -->
                    @if($v->is_default)
                    <span class="deftip">默认地址</span>
                    @else
                    <a href="javascript:void(0)" class="address-default" data-address-id={{ $v->address_id }}>设为默认</a>
                    @endif
                </div>
            </div>
            @endforeach


        </div>
        <div class="addr-control">


            <a href="javascript:void(0)" class="addr-add" title="增加新地址">
                <i>+</i>
                <span>使用新地址</span>
            </a>

        </div>
    </div>
</div>