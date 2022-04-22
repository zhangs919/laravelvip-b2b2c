<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c" data-sortname="brand_id">编号</th>
        <th data-sortname="brand_name">品牌名称</th>
        <th class="text-c">品牌LOGO</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($brand_list as $v)
    <tr>
        <td class="text-c">{{ $v->brand_id }}</td>
        <td>{{ $v->brand_name }}</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($v->brand_logo) }}" class="preview m-l-5" data-toggle="tooltip" data-placement="auto bottom">
                <i class="fa fa-picture-o"></i>
            </a>
        </td>
        <td class="handle">
            <a href="javascript:selectBrand('{{ $v->brand_id }}','{{ $v->brand_name }}','{{ get_image_url($v->brand_logo) }}');" class="add">选择</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>