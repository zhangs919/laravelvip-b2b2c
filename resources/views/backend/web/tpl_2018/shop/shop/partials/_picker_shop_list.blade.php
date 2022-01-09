<table id="table_ShopPickerPage_{{ $page_id }}" class="table table-hover">
    <thead>
    <tr>
        <th data-sortname="shop_id">编号</th>
        <th data-sortname="shop_name">店铺名称</th>
        <th data-sortname="credit">店铺信誉</th>
        <th>店铺LOGO</th>
        <th class="handle">操作</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $v)
    <tr>
        <td>{{ $v->shop_id }}</td>
        <td>{{ $v->shop_name }}</td>
        <td>
            @if(!empty($v->credit_img))
            <img src="{{ get_image_url($v->credit_img, 'credit_img') }}" alt="一星">
            @endif
        </td>
        <td>
            <a href="javascript:void(0);" ref="{{ get_image_url($v->shop_logo, 'shop_logo') }}" class="preview m-l-5" data-toggle="tooltip" data-placement="auto bottom">
                <i class="fa fa-picture-o"></i>
            </a>
        </td>
        <td class="handle" id="handle_{{ $v->shop_id }}">

            @if(in_array($v->shop_id, $selected_ids))
                <a href="javascript:void(0);" data-shop_id='{{ $v->shop_id }}' data-shop_name='{{ $v->shop_name }}'
                   data-credit_img="{{ get_image_url($v->credit_img) }}" data-credit_name='一星' data-shop_logo='{{ get_image_url($v->shop_logo, 'shop_logo') }}'
                   class="select-shop active">已选</a>
            @else
                <a href="javascript:void(0);" data-shop_id="{{ $v->shop_id }}" data-shop_name="{{ $v->shop_name }}"
                   data-credit_img="{{ get_image_url($v->credit_img, 'credit_img') }}" data-credit_name='一星' data-shop_logo='{{ get_image_url($v->shop_logo, 'shop_logo') }}'
                   class="select-shop">选择</a>
            @endif



        </td>
    </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <div class="pull-right page-box">

                {{--分页--}}
                {!! $pageHtml !!}

            </div>
        </td>
    </tr>
    </tfoot>
</table>