<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox table-list-checkbox-all" title="全选/全不选">
        </th>
        <th class="text-c w60" data-sortname="article_id" data-sortorder="asc" style="cursor: pointer;">ID<span class="sort"></span></th>
        <th class="w200" style="cursor: default;">文章标题</th>
        <th class="w100" data-sortname="cat_id" data-sortorder="asc" style="cursor: pointer;">文章分类<span class="sort"></span></th>
        <th class="w120" data-sortname="add_time" data-sortorder="asc" style="cursor: pointer;">发布时间<span class="sort"></span></th>
        <!-- <th class="text-c" data-sortname="is_comment">是否允许评论</th> -->
        <th class="text-c w90" data-sortname="click_number" data-sortorder="asc" style="cursor: pointer;">点击量<span class="sort"></span></th>
        <th class="text-c w100">是否显示</th>
        <th class="text-c w100">是否推荐</th>
        <th class="w90" data-sortname="shop_id" data-sortorder="asc" style="cursor: pointer;">店铺<span class="sort"></span></th>
        <th class="w70 text-c" data-sortname="sort" data-sortorder="asc" style="cursor: pointer;">排序<span class="sort"></span></th>
        <th class="text-c w100" data-sortname="status" data-sortorder="asc" style="cursor: pointer;">审核状态<span class="sort"></span></th>
        <th class="handle w150" style="cursor: default;">操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox table-list-checkbox" value="{{ $v->article_id }}">
        </td>
        <td class="text-c">{{ $v->article_id }}</td>
        <td>

            <a href="{{ route('pc_show_help', ['article_id'=>$v->article_id]) }}" target="_blank" title="" data-toggle="tooltip" data-placement="auto bottom" data-original-title="{{ $v->title }}">{{ $v->title }}</a>

        </td>
        <td>{{ $v->cat_name }}</td>
        <td>{{ $v->add_time }}</td>
        {{--<td class="text-c"><span data-action="set-is-comment?id={{ $v->article_id }}" class="ico-switch open" data-value='[0,1]' data-label='["\u7981\u6b62","\u5141\u8bb8"]' data-class='["fa fa-ban","fa fa-check-circle"]'><i class="fa fa-check-circle"></i>允许</span></td>--}}
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="article-number editable editable-click" data-article_id="{{ $v->article_id }}">{{ $v->click_number }}</a>
            </font>
        </td>
        <td class="text-c">
            @if($v->is_show == 1)
                <span data-action="set-is-show?id={{ $v->article_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-show?id={{ $v->article_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td class="text-c">
            @if($v->is_recommend == 1)
                <span data-action="set-is-recommend?id={{ $v->article_id }}" class="ico-switch open" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-on"></i>是</span>
            @else
                <span data-action="set-is-recommend?id={{ $v->article_id }}" class="ico-switch" data-value="[0,1]" data-label="[&quot;\u5426&quot;,&quot;\u662f&quot;]" data-class="[&quot;fa fa-toggle-off&quot;,&quot;fa fa-toggle-on&quot;]"><i class="fa fa-toggle-off"></i>否</span>
            @endif
        </td>
        <td>@if($v->shop_id == 0)平台自营@else {{ $v->shop_name ?? '' }} @endif</td>
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="article-sort editable editable-click" data-article_id="{{ $v->article_id }}">{{ $v->sort }}</a>
            </font>
        </td>
        <td class="text-c">
            @if($v->status == 0)
            <!---->
            <font class="c-red">未审核</font>
            <!---->
            @elseif($v->status == 1)
            <!---->
            <font class="c-green">已通过</font>
            <!---->
            @elseif($v->status == 2)
            <!---->
            <font class="c-red">未通过</font>
            <!---->
            @endif
        </td>
        <td class="handle">
            <a href="edit?id={{ $v->article_id }}&amp;show_cat_type=1,2,3,4,5,6,7,8,9,11,12,14">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->article_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox table-list-checkbox-all" value="" title="全选/全不选">
        </td>
        <td colspan="11">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除">
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">


                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
