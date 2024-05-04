@if(!$list->isEmpty())

    <div id="table_list" class="table table-hover more-graphic-list clearfix">
        @foreach($list as $item)
            <div class="graphic-material-info">
                @foreach($item->items as $k=>$article)
                    @if($k == 0)

                        <div class="graphic-con more-graphic">
                            <h4 class="graphic-title">{{ $item->items[0]->title }}</h4>
                            <div class="graphic-wrap">
                                <img src="{{ get_image_url($item->items[0]->cover) }}">
                            </div>
                        </div>
                    @else
                        <div class="article-list">
                            <h3>{!! $article->abstract !!}</h3>
                            <div class="article-list-pic">
                                <img src="{{ get_image_url($article->cover) }}">
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="handle-btn-con">
                    <a href="more-edit?id={{ $item->id }}">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                    <a href="javascript:void(0)" class="del" data-id="{{ $item->id }}">
                        <i class="fa fa-trash-o"></i>
                        删除
                    </a>
                </div>

            </div>
        @endforeach
        <table>
            <tfoot>
            <tr>
                <td>
                    {!! $pageHtml !!}
                </td>
            </tr>
            </tfoot>
        </table>

    </div>

@else
    <div id="table_list" class="no-data-page">
        <div class="icon">
            <i class="fa fa-file-photo-o"></i>
        </div>
        <h5>暂无微信素材</h5>
        <p>暂时没有微信素材文章，稍后再来看看吧！</p>
    </div>
@endif