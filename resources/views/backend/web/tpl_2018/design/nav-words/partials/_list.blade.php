<div class="table-responsive">

    <table id="table_list" class="table table-hover">
        <thead>
        <tr>
            <th class="tcheck">
                <input type="checkbox" class="checkBox allCheckBox" />
            </th>
            <th class="text-c" data-sortname="id">编号</th>
            <th data-sortname="words_name">推荐词名称</th>
            <th data-sortname="words_link">推荐词链接</th>
            <th class="text-c" data-sortname="new_open">是否新窗口打开</th>
            <th class="text-c" data-sortname="is_show">是否显示</th>
            <th class="text-c" data-sortname="words_sort">推荐词排序</th>
            <th data-sortname="words_type">推荐词类型</th>
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
            <td>{{ $v->words_name }}</td>
            <td>@if($v->words_type == 0){{ $v->words_link }}@elseif($v->words_type == 1)/list?cat_id={{ $v->words_link }}@elseif($v->words_link == 2)/search?keyword={{ $v->words_link }}@endif</td>
            <td class="text-c">
                @if($v->new_open == 1)
                    <span data-action="set-new-open?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-new-open?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">
                @if($v->is_show == 1)
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch open" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-on"></i>是</span>
                @else
                    <span data-action="set-is-show?id={{ $v->id }}" class="ico-switch" data-value="[0,1]" data-label='["\u5426","\u662f"]' data-class='["fa fa-toggle-off","fa fa-toggle-on"]'><i class="fa fa-toggle-off"></i>否</span>
                @endif
            </td>
            <td class="text-c">{{ $v->words_sort }}</td>
            <td>{{ nav_words_type($v->words_type) }}</td>
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
            <td colspan="8">
                <div class="pull-left">
                    <!--  <input type="button" id="btn_delete" class="btn btn-danger m-r-2" value="删除" /> -->
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