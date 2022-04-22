@if(!$list->isEmpty())

    @foreach($list as $v)
        <li>
            <a href="javascript:void(0)" class="category-name" data-id="{{ $v->cat_id }}" data-name="{{ $v->cat_name }}" data-search="{{ $v->cat_name }} " data-level="2">
                <i class="fa fa-angle-right"></i>
                {{ $v->cat_name }}
            </a>
        </li>
    @endforeach

@else
    <li>
        <a href="javascript:void(0)">没有找到相关数据</a>
    </li>
@endif