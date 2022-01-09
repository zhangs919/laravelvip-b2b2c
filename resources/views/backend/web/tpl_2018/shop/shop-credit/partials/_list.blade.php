<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck" style="cursor: default;">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="w200" data-sortname="credit_name" data-sortorder="asc" style="cursor: pointer;">店铺信誉名称<span class="sort"></span></th>
        <th class="text-c w150">店铺信誉图标</th>
        <th class="w150" data-sortname="min_point" data-sortorder="asc" style="cursor: pointer;">信誉值范围<span class="sort"></span></th>
        <th class="w200" style="cursor: default;">备注</th>
        <th class="handle w150" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->credit_id }}">
        </td>
        <td>{{ $v->credit_name }}</td>
        <td class="text-c">
            <img src="{{ get_image_url($v->credit_img) }}" class="user-level m-r-5" style="height: 16px;">
            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-credit_img" data-id="{{ $v->credit_id }}"> 更换 </span>
        </td>
        <td>

            {{ $v->min_point }} ~ {{ $v->max_point }}

        </td>
        <td></td>
        <td class="handle">
            <a href="edit?id={{ $v->credit_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-credit-id="{{ $v->credit_id }}" data-credit-name="{{ $v->credit_name }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox table-list-checkbox-all" title="全选/全不选">
        </td>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除">
            </div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>