<div class="article-list" id="table_list">

    @if(!empty($list))
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th align="center">文章标题</th>
                <th align="center">发布时间</th>
            </tr>
            </thead>
            <tbody>

            @foreach($list as $v)
                <tr>
                    <td align="left">
                        <a href="javascript:void(0)" class="article-link" data-link="" data-url="{{ route('pc_show_article',['article_id'=>$v['article_id']]) }}" title="{{ $v['title'] }}">{{ $v['title'] }}</a>
                    </td>
                    <td align="center">{{ $v['add_time'] }}</td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td colspan="2">
                    <div class="pull-right page-box">


                        {!! $pageHtml !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    @else
        <div class="tip-box">
            <img src="/frontend/images/noresult.png" class="tip-icon" />
            <div class="tip-text">没有符合条件的记录</div>
        </div>
    @endif
</div>
