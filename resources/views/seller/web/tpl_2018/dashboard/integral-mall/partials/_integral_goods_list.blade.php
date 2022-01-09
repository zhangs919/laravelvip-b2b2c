<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w60" data-sortname="goods_id">编号</th>
        <th class="w200">兑换商品</th>
        <th class="w100">兑换有效期</th>
        <th class="text-c w80" data-sortname="goods_integral">积分</th>
        <th class="text-c w100" data-sortname="goods_number">库存</th>
        <th class="text-c w80" data-sortname="exchange_number">已兑换量</th>
        <th class="text-c w80" data-sortname="goods_status">状态</th>
        <th class="w70 text-c" data-sortname="goods_sort">排序</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->goods_id }}" />
        </td>
        <td class="text-c">{{ $v->goods_id }}</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ route('show_integral_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v->goods_image, 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb" />
                </a>
            </div>
            <div class="ng-binding goods-message w100">
                <div class="name">
                    <a href="{{ route('show_integral_goods', ['goods_id'=>$v->goods_id]) }}" class="goods_name"
                       data-goods_id="{{ $v->goods_id }}" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="{{ $v->goods_name }}">{{ $v->goods_name }}</a>
                    <a href="javascript:void(0);" class="goods_name_controller c-blue m-l-5">修改</a>
                </div>
            </div>
        </td>
        <td>

            @if($v->is_limit == 0)
                无限制
            @else
                {{ $v->start_time }}

                &nbsp;~&nbsp;

                {{ $v->end_time }}
            @endif

        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="goods-integral" data-goods_id="{{ $v->goods_id }}">{{ $v->goods_integral }}</a>
            </font>
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="goods-number" data-goods_id="{{ $v->goods_id }}">{{ $v->goods_number }}</a>
            </font>
        </td>

        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="exchange-number" data-goods_id="{{ $v->goods_id }}">{{ $v->exchange_number }}</a>
            </font>
        </td>
        @if($v->goods_status == 1)
            <td class="text-c  c-green ">出售中</td>
        @else
            <td class="text-c  c-999 ">已下架</td>
        @endif
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="goods-sort" data-goods_id="{{ $v->goods_id }}">{{ $v->goods_sort }}</a>
            </font>
        </td>
        <td class="handle">
            <a href="{{ route('show_integral_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">查看</a>
            <span>|</span>
            <a href="javascript:void(0)" class="edit-goods-status" data-id="{{ $v->goods_id }}">@if($v->goods_status == 1)下架@else上架@endif</a>
            <span>|</span>
            <a href="edit-integral-goods?id={{ $v->goods_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" value="14" />
        </td>
        <td colspan="9">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
