<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>
            <th class="text-c" data-sortname="id">编号</th>
            <th data-sortname="brand_id">品牌名称</th>
            <th class="text-c">品牌LOGO</th>
            <th class="text-c" data-sortname="is_show">是否显示</th>
            <th class="text-c" data-sortname="brand_sort">排序</th>
            <th class="handle">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td class="tcheck">
                <input type="checkbox" class="checkBox" value="{{ $v->id }}" />
            </td>
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->brand_name }}</td>
            <td class="text-c"><a href="javascript:void(0);" ref="{{ get_image_url($v->brand_logo) }}" class="preview m-l-5" data-toggle="tooltip" data-placement="auto bottom">
                    <i class="fa fa-picture-o"></i>
                </a></td>
            <td class="text-c">
                @if($v->is_show == 1)
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">{{ $v->brand_sort }}</td>
            <td class="handle">
                <a href="edit?id={{ $v->id }}">编辑</a>
                <span>|</span>
                <a href="javascript:void(0);" data-id="{{ $v->id }}" class="del border-none">删除</a>
            </td>
        </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td class="w10 text-c">
                <!-- <input type="checkbox" class="allCheckBox checkBox"> -->
            </td>
            <td colspan="6">
                <div class="pull-left">
                    <!-- <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="删除" />  -->
                    <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
                </div>
                <div class="pull-right page-box">


                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

</div>