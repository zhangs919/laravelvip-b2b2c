@foreach($cat_list as $v)
    <li class="">
        <a href="javascript:void(0);" class="category-name" data-is-parent="{{ $v->is_parent }}" data-search="生鲜食品 sxsp shengxianshipin" data-id="{{ $v->cat_id }}" data-level="{{ $v->cat_level }}">
            <i class="fa fa-angle-right"></i>
            {{ $v->cat_name }}
        </a>
    </li>
@endforeach