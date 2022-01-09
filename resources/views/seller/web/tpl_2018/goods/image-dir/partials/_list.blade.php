<div id="table_list">
    <div class="common-title page-handle">
        <div class="ftitle">
            <h3>图片空间相册列表</h3>
            <h5>(&nbsp;共{{ $total }}个相册&nbsp;)</h5>
        </div>
    </div>
    <div class="picture-list">
        <div class="list-style-list box">
            <ul>

                @foreach($list as $v)
                <li class="item">
                    <dl>
                        <dt>
                            <div class="picture">
                                <a href="/goods/image/list?dir_id={{ $v->dir_id }}">

                                    <img src="{{ get_image_url($v->dir_cover,1) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">

                                </a>
                            </div>
                            <h3 class="title">
                                <a  href="/goods/image/list?dir_id={{ $v->dir_id }}">{{ $v->dir_name }}</a>
                            </h3>
                        </dt>
                        <dd class="date">共{{ $v->image_count }}张</dd>
                        <dd class="buttons">
                            @if($v->is_default == 0)
                                <a href="javascript:void(0);" data-id="{{ $v->dir_id }}" class="btn btn-xs edit" title="编辑图片相册">
                                    <i class="fa fa-edit"></i>
                                    编辑相册
                                </a>
                                <a href="javascript:void(0);" data-id="{{ $v->dir_id }}" class="btn btn-xs delete" title="删除图片相册">
                                    <i class="fa fa-times-circle-o"></i>
                                    删除相册
                                </a>
                            @endif
                        </dd>
                    </dl>
                </li>
                @endforeach

                <!--当点击复选框勾选后，同时也要为li标签添加active样式-->
            </ul>
        </div>
    </div>
    <table id="page_table" class="table b-n">
        <tfoot>
        <tr>
            <td colspan="9">
                <div class="pull-right page-box">
                    {!! $pageHtml !!}
                </div>
            </td>
        </tr>
        </tfoot>
    </table>
</div>