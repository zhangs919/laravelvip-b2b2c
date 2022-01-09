<div class="choose-category-search-title">
    <strong>
        匹配到
        <em class="num">{{ $total }}</em>
        个类目
    </strong>
    <span class="f12 c-999 m-l-10">（双击直接发布，括号中为该类目下相关宝贝的数量）</span>
    <a class="btn btn-warning btn-sm pull-right choose-category-search-close">关闭，返回类目</a>
</div>
<div class="choose-category-search-center">

    @if($total > 0)
        <!--有匹配类目-->
        <ul>

            @foreach($cat_list as $k=>$v)
            <li>

                <a title="{{ implode('>>', array_column($v, 'cat_name')) }}" href="javascript:void(0);" class="category-name category-search-item" data-cat-ids="{{ implode(',', array_column($v, 'cat_id')) }}" data-type="0"
                   data-id="{{ array_last($v)['cat_id'] }}" data-is-parent="{{ array_last($v)['parent_id'] }}"
                   data-search="{{ array_last($v)['cat_name'] }} {{ array_last($v)['cat_name_pinyin'] }}" data-level="{{ array_last($v)['cat_level'] }}">
                    <i>{{ $k+1 }}.</i>

                    {!! implode("<em>>></em>", array_column($v, 'cat_name')) !!}
                </a>
            </li>
            @endforeach

        </ul>
    @else
        <!--无匹配类目-->
        <div class="no-data-page">
            <h5>暂无匹配类目</h5>
            <p>暂时没有搜索到匹配的类目，搜索其它类目试试吧！</p>
        </div>
    @endif

</div>