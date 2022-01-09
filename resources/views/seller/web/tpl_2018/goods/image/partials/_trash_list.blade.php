<table id="table_list" class="table table-hover" style="margin-top: -1px;">
    <thead>
    <tr>
        <!--复选框列样式tcheck，一般复选框样式checkBox,全选复选框样式在一般复选框样式后再新加allCheckBox样式-->
        <th class="tcheck">
            <input type="checkbox" class="checkbox" />
        </th>
        <!--排序样式sort默认，asc升序，desc降序-->
        <th class="w200" data-sortname="name">名称</th>
        <th class="w100" data-sortname="extension">类型</th>
        <th class="w100">尺寸</th>
        <th class="w100" data-sortname="size">大小</th>
        <th class="w100" data-sortname="dir_name">相册</th>
        <!--
            <th class="text-c w80">是否引用</th>
             -->
        <!--操作列样式handle-->
        <th class="handle w200">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td class="tcheck">
            <input type="checkbox" class="checkbox" value="{{ $v->img_id }}" />
        </td>
        <td>
            <div class="userPicBox pull-left m-r-10">
                <a href="javascript:void(0);" class="preview" ref="{{ get_image_url($v->path) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450">
                    <img src="{{ get_image_url($v->path) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" data-url="{{ get_image_url($v->path) }}" class="user-avatar IMG-1069"></img>
                </a>
            </div>
            <div class="ng-binding user-message ">
                <span class="name w150">{{ $v->name }}</span>
            </div>
        </td>
        <td>{{ $v->extension }}</td>
        <td>{{ $v->width }}&nbsp;*&nbsp;{{ $v->height }}</td>
        <td>{{ format_bytes($v->size) }}</td>
        <td>{{ $v->dir_name }}</td>
        <!--
            <td class="text-c">否</td>
             -->
        <td class="handle">
            <a href="javascript:void(0);" class="recover-image" data-id="{{ $v->img_id }}">还原</a>
            <span>|</span>
            <a href="javascript:void(0);" class="del border-none destroy-image" data-id="{{ $v->img_id }}">彻底删除</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td class="text-c w10">
            <input type="checkbox" class="checkBox" />
        </td>
        <td colspan="7">
            <div class="pull-left">
                <input type="button" class="btn btn-default m-r-2 recover-image" value="还原" />
                <input type="button" class="btn btn-danger m-r-2 destroy-image" value="彻底删除" />
            </div>
            <div class="pull-right page-box">

                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>