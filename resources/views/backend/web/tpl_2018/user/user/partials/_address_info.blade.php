<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w100" data-sortname="consignee">收货人</th>
        <th class="w400">收货地址</th>
        <th class="w150" data-sortname="mobile">手机</th>
        <th class="w150" data-sortname="tel">固定电话</th>
        <th class="w200" data-sortname="email">邮箱</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td>{{ $v->consignee }}</td>
        <td>{{ get_region_names_by_region_code($v->region_code) }} &nbsp; {{ $v->address_detail }}</td>
        <td>{{ $v->mobile }}</td>
        <td>{{ $v->tel }}</td>
        <td>{{ $v->email }}</td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div id="pagination" class="pull-right page-box">


                {{--分页--}}
                {!! $pageHtml !!}


            </div>
        </td>
    </tr>
    </tfoot>
</table>
