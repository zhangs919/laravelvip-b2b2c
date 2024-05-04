@if($total > 0)
<div id="table_list" class="tab-content">
    <div class="picture-list">
        <div class="list-style-list field">
            <ul>

                @foreach($list as $v)
                <li class="item">
                    <dl>
                        <dt>
                            <div class="picture">
                                <a href="javascript:void(0);" class="preview" ref="{{ get_image_url($v->path) }}" title="点击查看大图">
                                    <img src="{{ get_image_url(sysconf('default_goods_image')) }}" class="IMG-{{ $v->img_id }} lazy" data-original="{{ get_image_url($v->path) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                                </a>
                            </div>
                            <input type="checkbox" class="checkbox" value="{{ $v->img_id }}">
                            <label title="{{ $v->name }}">{{ $v->name }}</label>
                            <span class="edit-name" data-id="{{ $v->img_id }}" title="点击可以进行编辑">
									<i class="fa fa-pencil"></i>
								</span>
                        </dt>
                        <dd class="date">
                            <p>
                                <span>上传时间：</span>
                                <span>{{ $v->created_at }}</span>
                            </p>
                            <p>
                                <span>图片尺寸：</span>
                                <span>{{ $v->width }}&nbsp;*&nbsp;{{ $v->height }}</span>
                            </p>
                        </dd>
                        <dd class="buttons">
                            <a class="btn btn-xs upload-btn replace-image" data-id="{{ $v->img_id }}" title="替换上传">
                                <i class="fa fa-upload"></i>
                                替换上传
                            </a>
                            <a class="btn btn-xs move-image" data-id="{{ $v->img_id }}" title="转移相册">
                                <i class="fa fa-arrows"></i>
                                转移相册
                            </a>
                            <a class="btn btn-xs cover-image" data-id="{{ $v->img_id }}" data-shop-id="0" title="设为封面">
                                <i class="fa fa-image"></i>
                                设为封面
                            </a>
                            <a class="btn btn-xs delete-image" data-id="{{ $v->img_id }}" title="删除图片">
                                <i class="fa fa-trash-o"></i>
                                删除图片
                            </a>
                        </dd>
                    </dl>
                </li>
                @endforeach

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
    <script type="text/javascript">
        $().ready(function() {
            $("img").one("error", function() {
                $(this).attr("src", "{{ get_image_url(sysconf('default_goods_image')) }}")
            });
        });
    </script>
</div>
@else
<div id="table_list" class="no-data-page">
    <div class="icon">
        <i class="fa fa-file-photo-o"></i>
    </div>
    <h5>暂无图片文件</h5>
    <p>暂时没有已上传的图片文件，稍后再来看看吧！</p>
</div>
@endif

