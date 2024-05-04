<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w200" data-sortname="act_name" data-sortorder="asc" style="cursor: pointer;">活动名称<span class="sort"></span></th>
        <th class="text-c w80">活动图片</th>
        <th class="w150" data-sortname="act_title" data-sortorder="asc" style="cursor: pointer;">店铺名称<span class="sort"></span></th>
        <th class="w150" data-sortname="start_time" data-sortorder="asc" style="cursor: pointer;">活动有效时间<span class="sort"></span></th>
        <th class="text-c w80">商品个数</th>
        <th class="text-c w100" data-sortname="is_recommend" data-sortorder="asc" style="cursor: pointer;">是否推荐<span class="sort"></span></th>
        <th class="text-c w100" data-sortname="purchase_num" data-sortorder="asc" style="cursor: pointer;">活动状态<span class="sort"></span></th>
        <th class="text-c w100" data-sortname="status" data-sortorder="asc" style="cursor: pointer;">审核状态<span class="sort"></span></th>
        <th class="text-c w60" data-sortname="sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td>{{ $v['act_name'] }}</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($v['act_img']) }}" class="preview">
                <i class="fa fa-picture-o"></i>
            </a>
        </td>
        <td>
            <span title="{{ $v['shop_name'] }}">{{ $v['shop_name'] }}</span>
        </td>
        <td>
            {{ $v['start_time'] }}
            <br>
            ~
            <br>
            {{ $v['end_time'] }}
        </td>
        <td class="text-c">
            <font class="f14">{{ $v['goods_count'] }}</font>
        </td>
        <td class="text-c">
            @if($v['is_recommend'] == 1)
                <span data-action="set-is-recommend?id={{ $v['act_id'] }}" data-callback="switch_callback" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-recommend?id={{ $v['act_id'] }}" data-callback="switch_callback" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
{{--        <td class="text-c"><span data-action="set-is-recommend?id={{ $v['act_id'] }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span></td>--}}
        <td class="text-c">
            <font class="{{ str_replace([0,1,2],['c-red','c-warning','c-999'],$v['is_finish']) }}">{{ str_replace([0,1,2],['未开始','进行中','已结束'],$v['is_finish']) }}</font>
        </td>
        <td class="text-c">
            <font class="{{ str_replace([0,1,2],['c-red','c-green','c-999'],$v['status']) }}">{{ str_replace([0,1,2],['待审核','已审核','审核不通过'],$v['status']) }}</font>
        </td>
        <td class="text-c">
            <a href="javascript:void(0);" class="shop_sort f14 editable editable-click" data-act_id="{{ $v['act_id'] }}">{{ $v['sort'] }}</a>
        </td>
        <td class="handle">
            <a href="view?id={{ $v['act_id'] }}">查看</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v['act_id'] }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="10">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>


