<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w100" data-sortname="brand_id">编号</th>
        <th data-sortname="brand_name" class="w400">品牌名称</th>
        <th class="text-c w200">品牌LOGO</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="text-c">{{ $v->brand_id }}</td>
        <td>{{ $v->brand_name }}</td>
        <td class="text-c">
            <a href="javascript:void(0);" ref="{{ get_image_url($v->brand_logo) }}" class="preview m-l-5" data-toggle="tooltip" data-placement="auto bottom">
                <img src="{{ get_image_url($v->brand_logo) }}" class="h20">
            </a>
        </td>
        <td class="handle" id="handle_{{ $v->brand_id }}">

            @if(in_array($v->brand_id, $selected_ids))
                <a href="javascript:void(0);" brand_id='{{ $v->brand_id }}' brand_name='{{ $v->brand_name }}' brand_logo='{{ get_image_url($v->brand_logo) }}' class="select-brand active">已选</a>
            @else
                <a href="javascript:void(0);" brand_id='{{ $v->brand_id }}' brand_name='{{ $v->brand_name }}' brand_logo='{{ get_image_url($v->brand_logo) }}' class="select-brand">选择</a>
            @endif

        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="4">
            <div class="pull-right page-box">


                {{--分页--}}
                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>