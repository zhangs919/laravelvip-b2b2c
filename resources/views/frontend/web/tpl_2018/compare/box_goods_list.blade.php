@if(!empty($compare_goods))

<div class="sidebar-panel-content compare-panel-content">

    <!-- 有对比商品的展示形式 _start -->
    <div class="compare-panel">
        <ul>
            @foreach($compare_goods as $v)
                <li>
                    <div class="p-img">
                        <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank" title="{{ $v['goods_id'] }}" >
                            <img src="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v['goods_id'] }}" />
                        </a>
                    </div>
                    <div class="delete" name="{{ $v['goods_id'] }}">
                        <i class="del-icon" title="移出对比" onClick="$.compare.remove('{{ $v['goods_id'] }}')"></i>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- 有对比商品的展示形式 _end-->

</div>

<!-- 有对比商品的展示形式 _start -->
<div class="compare-panel-footer">
    <div class="compare-footer-checkout">
        <!-- 只有一个对比商品不能进行对比 a标签追加class值"no-compare-btn" 即 class="compare-btn no-compare-btn" _start -->

        @if(count($compare_goods) > 1)
        <a href="/user/compare.html?ids={{ implode(',',array_column($compare_goods, 'goods_id')) }}" target="_blank" class="compare-btn bg-color">开始对比</a>
        @else
        <a href="javascript:void(0);" class="compare-btn no-compare-btn" title="请至少选择两个商品">开始对比</a>
        @endif

        <!-- 只有一个对比商品不能进行对比 a标签追加class值"no-compare-btn" 即 class="compare-btn no-compare-btn" _end -->
        <a href="javascript:void(0);" class="compare-clear btn-link" onClick="$.compare.clear()">清空</a>
    </div>
</div>
<!-- 有对比商品的展示形式 _end-->

@else
    <div class="sidebar-panel-content compare-panel-content">

        <!-- 没有对比商品的展示形式 _start -->
        <div class="tip-box">
            <img src="/images/noresult.png" class="tip-icon" />
            <div class="tip-text">
                您还没有选择任何的对比商品哦
                <br />
                <a class="color" href="./">再去看看吧</a>
            </div>
        </div>
        <!-- 没有对比商品的展示形式 _end-->

    </div>
    </div>

@endif
<!--对比列表 end-->