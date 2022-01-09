<!-- 商家入驻版式 -->
@if($is_design)
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>
    @endif

    <div class="nav-shop-apply">

        @if($tpl_name != '' && $is_design)
            <a href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" title="编辑" data-uid="{{ $uid }}" data-cat_id="1" data-type="3" data-number="1">
                <i class="fa fa-edit"></i>
                编辑
            </a>
        @endif

        <h3>招商入驻</h3>
        <div class="tabs-panel">

            @if(!empty($data['3-1']))
                @foreach($data['3-1'] as $v)
                    <a href="javascript:void(0)" title="申请商家入驻；已提交申请，可查看当前审核状态。" class="store-join-btn">
                        <img src="{{ get_image_url($v['path']) }}">
                    </a>
                    <a href="javascript:void(0)" class="store-join-help">
                        <i class="icon-cog"></i>
                        登录商家管理中心
                    </a>
                @endforeach
            @else
                <a href="/shop/apply.html" target="_blank" title="申请商家入驻；已提交申请，可查看当前审核状态。" class="store-join-btn">
                    <img src="/frontend/images/enter.jpg" />
                </a>

                <a href="http://seller.laravelvip.com" target="_blank" class="store-join-help">
                    <i class="icon-cog"></i>
                    登录商家管理中心
                </a>
            @endif

        </div>
    </div>

@if($is_design)
</div>
@endif
