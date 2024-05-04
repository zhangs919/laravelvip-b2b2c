<div id="table_list">
    @if($growth_value_list->isEmpty())
        <table class="table">
            <thead>
            <tr>
                <th style="width: 35%;">来源/用途</th>
                <th style="width: 15%;">订单号/退款编号</th>
                <th style="width: 15%;">实付款</th>
                <th style="width: 10%;">成长值</th>
                <th style="width: 25%;">获取时间</th>
            </tr>
            </thead>

        </table>
        <div class="tip-box">
            <img src="/images/noresult.png" class="tip-icon"/>
            <div class="tip-text">暂无成长值</div>
        </div>
    @else
        <table class="table">
            <thead>
            <tr>
                <th style="width: 35%;">来源/用途</th>
                <th style="width: 15%;">订单号/退款编号</th>
                <th style="width: 15%;">实付款</th>
                <th style="width: 10%;">成长值</th>
                <th style="width: 25%;">获取时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($growth_value_list as $item)
            <tr>
                <td class="growth-first">
                    @if(!empty($item->target_info))
                    <div class="growth-source ">
                        <a class="goods-img" target="_blank" href="{{ route('pc_show_goods', ['goods_id' => $item->target_info->goods_id]) }}">
                            <img src="{{ get_image_url($item->target_info->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                        </a>
                        <a href="{{ route('pc_show_goods', ['goods_id' => $item->target_info->goods_id]) }}" target="_blank" title="{{ $item->target_info->goods_name }}" class="goods-name"> {{ $item->target_info->goods_name }} </a>
                    </div>
                    @endif
                </td>
                <td align="center">{{ $item->target_sn ?? '' }}</td>

                <td align="center">{{ $item->pay_amount ?? 0.00 }}</td>

                <td align="center">
                    @if($item->growth_value > 0)
                        <span class="get">+{{ $item->growth_value }}</span>
                    @else
                        <span class="lose">{{ $item->growth_value }}</span>
                    @endif
                </td>
                <td align="center">{{ $item->created_at }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        @if(!$growth_value_list->isEmpty())
        <form name="selectPageForm" action="" method="get">
            <!--分页-->
            <div class="page">
                <div class="page-wrap fr">
                    <div id="pagination" class="page">
                        {!! $pageHtml !!}
                    </div>
                </div>
            </div>
        </form>
        @endif
    @endif

</div>