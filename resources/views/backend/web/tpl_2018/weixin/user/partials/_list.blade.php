<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w70" data-sortname="id">ID</th>
        <th class="w300" data-sortname="nickname">昵称</th>
        <th class="text-c w80" data-sortname="sex">性别</th>
        <th class="w150">地区</th>
        <th class="text-c w100" data-sortname="subscribe">是否关注</th>
        <th class="text-c w100" data-sortname="subscribe_time">关注时间</th>
        <th class="w100" data-sortname="shop_id">店铺</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
        <tr>
            <td class="text-c">{{ $item->id }}</td>
            <td class="f13">{{ $item->nickname }}</td>
            <td>{{ format_sex($item->sex) }}</td>
            <td>{{ $item->country }} {{ $item->province }} {{ $item->city }} </td>
            <td>{{ $item->subscribe }}</td>
            <td>{{ format_time($item->subscribe_time) }}</td>
            <td>{{ $item->shop->shop_name ?? '' }}</td>
            <td class="handle">
{{--                <a href="javascript:void(0);" data-id="{{ $item->id }}" class="del border-none">删除</a>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="8">
            <div class="pull-left">
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>

