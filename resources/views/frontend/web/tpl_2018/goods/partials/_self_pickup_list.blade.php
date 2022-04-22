@if(!empty($pickup))
    @foreach($pickup as $v)
    <li class="logistics-item">
        <a href="/goods/pickup-info.html?id={{ $v['pickup_id'] }}" title="点击查看自提点详情" target="_blank" class="logistics-inner">
            <img src="{{ get_image_url($v['pickup_images']) }}" alt="{{ $v['pickup_name'] }}" class="logistics-img" />
            <div class="logistics-info">
                <p class="logistics-name">{{ $v['pickup_name'] }}</p>
                <p class="logistics-address" title="{{ $v['pickup_address'] }}"><i class="iconfont color"></i>{{ $v['pickup_address'] }}</p>
            </div>
        </a>
    </li>
    @endforeach
@else
    <li class="no-logistics">
        <div class="tip-box">

            <img src="/images/noresult.png" class="tip-icon" />

            <div class="tip-text">没有符合条件的记录</div>
        </div>
    </li>
@endif