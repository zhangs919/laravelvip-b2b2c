<table id="cat_spec_table" class="table table-hover">
    <thead>
    <tr>
        <th data-sortname='attr_name'>规格名称</th>
        <th>规格值</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>{{ $v->attr_name }}</td>
        <td>{{ $v->attr_values }}</td>
        <td class="handle">
            <a href="javascript:void(0);" data-id="{{ $v->attr_id }}" data-name="{{ $v->attr_name }}" data-value="{{ $v->attr_values }}" class="select_spec">选择</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>