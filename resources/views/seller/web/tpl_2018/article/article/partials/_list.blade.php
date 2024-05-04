<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="tcheck">
            <input type="checkbox" class="checkBox allCheckBox" />
        </th>
        <th class="text-c w80" data-sortname="article_id">文章ID</th>
        <th class="w200" data-sortname="title">文章标题</th>
        <th class="w100" data-sortname="cat_id">文章分类</th>
        <th class="w150" data-sortname="add_time">发布时间</th>
        <!-- <th class="text-c" data-sortname="is_comment">是否允许评论</th> -->
        <th class="text-c w70" data-sortname="click_number">点击量</th>
        <th class="text-c w80" data-sortname="is_show">是否显示</th>
        <th class="text-c w80" data-sortname="is_recommend">是否推荐</th>
        <th class="text-c w80" data-sortname="sort">排序</th>
        <th class="text-c w100" data-sortname="status">审核状态</th>
        <th class="handle w120">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)

    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="{{ $v->article_id }}" />
        </td>
        <td class="text-c">{{ $v->article_id }}</td>
        <td>
            <a href="{{ route('pc_show_help', ['article_id'=>$v->article_id]) }}" target="_blank" title="{{ $v->title }}" data-toggle="tooltip" data-placement="auto bottom">{{ $v->title }}</a>
        </td>
        <td>{{ $v->cat_name }}</td>
        <td>{{ $v->add_time }}</td>
        <!-- <td class="text-c"><span data-action="set-is-comment?id={{ $v->article_id }}" class="ico-switch open" data-value='[0,1]' data-label='["\u7981\u6b62","\u5141\u8bb8"]' data-class='["fa fa-ban","fa fa-check-circle"]'><i class="fa fa-check-circle"></i>允许</span></td> -->
        <td class="text-c">{{ $v->click_number }}</td>
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
        <td class="text-c">
            <font class="f14">
                <a href="javascript:void(0);" class="article_sort" data-article_id={{ $v->article_id }}>{{ $v->sort }}</a>
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
            <a href="edit?id={{ $v->article_id }}">编辑</a>
            <span>|</span>
            <a href="javascript:void(0);" data-id="{{ $v->article_id }}" class="del border-none">删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkBox" value="" />
        </td>
        <td colspan="10">
            <div class="pull-left">
                <input type="button" id="batch-delete" class="btn btn-danger m-r-2" value="批量删除" />
                <!--当没有选中任何所操作的项，按钮为禁用状态，将按钮样式btn-danger替换为disabled-->
            </div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>