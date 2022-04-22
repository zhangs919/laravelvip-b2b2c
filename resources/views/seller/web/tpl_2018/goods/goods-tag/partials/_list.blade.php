<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w50">编号</th>
        <th class="text-c w150">标签名称</th>
        <th class="text-c w80">标签图片</th>
        <th class="text-c w100">标签显示位置</th>
        <th class="text-c w150">标签绑定商品数</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox activitycheckbox" value="{{ $v->tag_id }}" />
        </td>
        <td class="text-c">{{ $v->tag_id }}</td>
        <td class="text-c">{{ $v->tag_name }}</td>
        <td class="text-c">

            <a href="javascript:void(0);" ref="{{ $v->tag_image }}" class="preview">

                <i class="fa fa-picture-o"></i>
            </a>
        </td>
        <td class="text-c">{{ @$tagPosition[$v->tag_position] }}</td>
        <td class="text-c">
            <a href="/goods/list?tag_id={{ $v->tag_id }}">{{ $v->tag_goods_count ?? 0 }}</a>
        </td>
        <td class="handle">
            <a href="/goods/goods-tag/edit?id={{ $v->tag_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" object_id="{{ $v->tag_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" value="" />
        </td>
        <td colspan="6">
            <div class="pull-left">
                <div class="pull-left">
                    <input type="button" class="btn btn-danger m-r-2 batch-del" value="批量删除" />
                </div>
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>