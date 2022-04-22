<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>
            <th class="w100 text-c">编号</th>
            <th class="w150">快捷服务名称</th>
            <th class="w150">快捷服务图标</th>
            <th class="w200">快捷服务链接</th>
            <th class="w100 text-c">是否显示</th>
            <th class="w100 text-c">排序</th>
            <th class="handle w150">操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($list as $v)
        <tr>
            <td  class="tcheck">
                <input type="checkbox" class="checkBox" value="{{ $v->id }}" />
            </td>
            <td class="text-c">{{ $v->id }}</td>
            <td>{{ $v->qs_name }}</td>
            <td>
                <div class="pull-left m-r-10">
                    <img src="{{ get_image_url($v->qs_icon) }}" class="w30 h30"></img>
                </div>
            </td>
            <td>{{ $v->qs_link }}</td>
            <td class="text-c">
                @if($v->is_show == 1)
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">{{ $v->sort }}</td>
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
            <td class="text-c w10">
                <input type="checkbox" class="allCheckBox checkBox" value="9" />
            </td>
            <td colspan="7">
                <div class="pull-left">
                    <input type="button" id="batch_delete" class="btn btn-danger m-r-2" value="删除" />
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