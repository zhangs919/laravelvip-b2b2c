<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox"></input>
        </th>
        <th class="text-c w80">编号</th>
        <th>名称</th>
        <th class="text-c w100">排序</th>
        <th class="text-c w200">修改时间</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $item->id }}" />
        </td>
        <td class="text-c">{{ $item->id }}</td>
        <td class="f13">
            <a href="javascript:void(0);" ref="{{ get_image_url($item->image) }}" class="preview">
                <img src="{{ get_image_url($item->image) }}?x-oss-process=image/resize,m_pad,limit_0,h_15,w_15"/>
            </a>
            {{ $item->name }}
        </td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" data-id=1>{{ $item->sort }}</a>
            </font>
        </td>
        <td class="text-c">{{ $item->updated_at }}</td>
        <td class="handle">
            <a href="edit?id={{ $item->id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $item->id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="allCheckBox checkBox">
            </input>
        </td>
        <td colspan="5">
            <div class="pull-left">
                <input type="button" class="btn btn-danger m-r-2 batch-del" value="批量删除" />
            </div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
