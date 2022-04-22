<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" />
        </th>
        <th class="text-c" data-sortname="goods_id">编号</th>
        <th data-sortname="goods_name">商品名称</th>
        <th class="text-c" data-sortname="goods_sn">货号</th>
        <th class="text-c" data-sortname="goods_price">本店价（元）</th>
        <th class="text-c" data-sortname="goods_number">库存</th>
        <th data-sortname="add_time">发布时间</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkbox" value="{{ $v->goods_id }}"></input>
        </td>
        <td class="text-c">{{ $v->goods_id }}</td>
        <td>
            <div class="goodsPicBox pull-left m-r-10">
                <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank">
                    <!-- 图片缩略图 -->
                    <img src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="goods-thumb"></img>
                    <!-- 虚拟商品 -->

                </a>
            </div>
            <div class="ng-binding goods-message w200">
                <div class="name">
                    <a href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}" target="_blank" data-toggle="tooltip" data-placement="auto bottom" title="{{ $v->goods_subname }}">{{ $v->goods_name }}</a>
                </div>
                <div class="active">

                    <label class="model-label blue">零售</label>

                </div>
            </div>
        </td>
        <td class="text-c">{{ $v->goods_sn }}</td>
        <td class="text-c">

            {{ $v->goods_price }}

        </td>
        <td class="text-c">{{ $v->goods_number }}</td>
        <td>
            {{ $v->created_at->format('Y-m-d') }}
            </br>
            {{ $v->created_at->format('H:i:s') }}
        </td>
        <td class="handle">
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="recover-goods">还原</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->goods_id }}" class="forever-delete border-none del">彻底删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="7">
            <div class="pull-left">
                <input type="button" class="btn btn-default m-r-2 recover-goods" value="还原" />
                <input type="button" class="btn btn-danger m-r-2 forever-delete" value="彻底删除" />
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
