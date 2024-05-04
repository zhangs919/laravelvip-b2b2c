@if(!$list->isEmpty())

    <div id="table_list" class="table table-hover single-graphic-list clearfix">
        @foreach($list as $item)
            <div class="graphic-material-info">
                <div class="graphic-con single-graphic">
                    <h4 class="graphic-title">{{ $item->items[0]->title }}</h4>
                    <div class="graphic-time">{{ $item->items[0]->created_at->format('m月d日') }}</div>
                    <div class="graphic-wrap">
                        <img src="{{ get_image_url($item->items[0]->cover) }}">
                    </div>
                    <div class="graphic-digest">{!! $item->items[0]->abstract !!}</div>
                    <div class="graphic-view">
                        <span>阅读全文</span>
                    </div>
                    <div class="handle-btn-con">
                        <a href="edit?id={{ $item->id }}">
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                        <a href="javascript:void(0)" class="del" data-id="{{ $item->id }}">
                            <i class="fa fa-trash-o"></i>
                            删除
                        </a>
                    </div>
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