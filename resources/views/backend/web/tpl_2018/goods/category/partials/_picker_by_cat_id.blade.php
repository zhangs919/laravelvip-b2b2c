@if(!$list->isEmpty())
    <li>
        <span>{{ $total }}</span>
        <ul class="">
            @foreach($list as $v)
                <li class="">
                    <a href="javascript:void(0)" class="category-name" data-is-parent="1" data-search="{{--文学 wx wenxue--}}" data-id="{{ $v->cat_id }}" data-name="{{ $v->cat_name }}" data-level="{{ $v->cat_level }}">
                        <i class="fa fa-angle-right"></i>
                        {{ $v->cat_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>

@else
    <li>
        <a href="javascript:void(0)">没有找到相关数据</a>
    </li>
@endif