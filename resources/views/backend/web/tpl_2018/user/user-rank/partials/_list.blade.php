<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="text-c w100" data-sortname="rank_id" data-sortorder="asc" style="cursor: pointer;">编号<span class="sort"></span></th>
        <th class="w200" data-sortname="rank_name" data-sortorder="asc" style="cursor: pointer;">等级名称<span class="sort"></span></th>
        <th class="text-c w200" style="cursor: default;">等级图标</th>
        <th class="w200" data-sortname="min_points" data-sortorder="asc" style="cursor: pointer;">成长值范围<span class="sort"></span></th>
        <th class="text-c w100" data-sortname="is_special" data-sortorder="asc" style="cursor: pointer;">特殊会员等级<span class="sort"></span></th>
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="text-c">{{ $v->rank_id }}</td>
        <td>{{ $v->rank_name }}</td>
        <td class="text-c">

            <img src="{{ get_image_url($v->rank_img) }}" class="user-level m-r-5" style="max-width: 100px; max-height: 20px;">

            <span class="btn btn-success btn-xs pos-r upload-img" data-url="upload-rank-image" data-id="{{ $v->rank_id }}"> 更换 </span>

        </td>
        <td>@if($v->is_special == 1) -- @elseif($v->type == 0) {{ $v->min_points }} ~ {{ $v->max_points }} @else >= {{ $v->min_points }} @endif</td>
        <td class="text-c w100">@if($v->is_special == 1) √ @else × @endif</td>
        <td class="handle">
            <a href="edit?id={{ $v->rank_id }}">编辑</a>
            <span>|</span>
            <a href="delete?id={{ $v->rank_id }}" data-confirm="您确定要删除【{{ $v->rank_name }}】此会员等级吗？" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <!-- <div class="pull-left">
                <button class="btn btn-danger mr5" type="button">删除</button>
                <button class="btn btn-default disabled mr5" type="button">禁用</button>
                <button class="btn btn-default" type="button">按钮1</button>
            </div> -->
            <div id="pagination" class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
