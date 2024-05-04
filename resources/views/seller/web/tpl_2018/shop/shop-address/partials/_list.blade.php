<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="w80" data-sortname="consignee">联系人</th>
        <th class="w200" data-sortname="region_code">发/退货地址</th>
        <th class="w200" data-sortname="address_detail">详细地址</th>
        <th class="w120" data-sortname="mobile">手机</th>
        <th class="w150" data-sortname="tel">固定电话</th>
        <th class="w150" data-sortname="email">邮箱</th>
        <th class="handle w250">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->address_id }}" />
        </td>
        <td>{{ $v->consignee }}</td>
        <td>{{ get_region_names_by_region_code($v->region_code,'') }}</td>
        <td>{{ $v->address_detail }}</td>
        <td>{{ $v->mobile }}</td>
        <td>{{ $v->tel }}</td>
        <td>{{ $v->email }}</td>
        <td class="handle">
            <a href="edit?id={{ $v->address_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->address_id }}" data-isdef="{{ $v->is_default }}" class="del border-none @if($v->is_default){{ 'disabled' }}@endif">删除</a>
            <div class="w100 pull-right m-t-3">
                @if($v->is_default){{--默认地址--}}
                    <font class="c-blue">已设为默认地址</font>
                @else{{--非默认地址--}}
                <a href="is-default?id={{ $v->address_id }}" class="btn-link">默认地址</a>
                @endif
            </div>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox" />
        </td>
        <td colspan="7">
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
