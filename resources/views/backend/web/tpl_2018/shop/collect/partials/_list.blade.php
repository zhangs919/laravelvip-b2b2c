<table id="table_list" class="table table-hover">
    <thead>
    <tr>
        <th class="w300" data-sortname="" style="cursor: default;">店铺信息</th>
        <th class="w100 text-c" data-sortname="" style="cursor: default;">允许采集商品数量</th>
        <th class="w100 text-c" data-sortname="" style="cursor: default;">已采集商品数量</th>
        <th class="w100 text-c" data-sortname="" style="cursor: default;">允许采集评论次数</th>
        <th class="w100 text-c" data-sortname="" style="cursor: default;">已采集评论次数</th>
        <th class="handle w150">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>
            <div class="userPicBox pull-left m-r-10">
                <img src="{{ get_image_url($v->shop_image, 'shop_image') }}" class="user-avatar">
            </div>
            <div class="ng-binding user-message">
                <span class="name" title="{{ $v->shop_name }}"> 店铺名称：{{ $v->shop_name }}</span>
                <span class="id">
								店铺ID：{{ $v->shop_id }}
								<font class="c-green m-l-10"></font>
							</span>
            </div>
        </td>
        <td class="text-c">{{ $v->collect_allow_number }}</td>
        <td class="text-c">{{ $v->collected_number }}</td>
        <td class="text-c">{{ $v->comment_allow_number }}</td>
        <td class="text-c">{{ $v->comment_number }}</td>
        <td class="handle">
            <a href="edit?id={{ $v->shop_id }}">编辑</a>
        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <div class="pull-left"></div>
            <div class="pull-right page-box">
                {!! $pageHtml !!}
            </div>
        </td>
    </tr>
    </tfoot>
</table>
