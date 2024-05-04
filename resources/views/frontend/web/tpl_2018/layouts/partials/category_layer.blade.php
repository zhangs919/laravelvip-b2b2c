@if(!empty($nav_category))
@foreach($nav_category as $item)
    <div class="list">
        <dl class="cat">
            <dt class="cat-name">
                <i class="iconfont">{!! $item->nav_icon !!}</i>

                @foreach($item->nav_json as $k=>$v)
                    @if($k > 0)、@endif<a href='@if($v->type == 0){{ $v->link }}@elseif($v->type ==1){{ route('pc_goods_list',['filter_str'=>$v->link]) }}@elseif($v->type == 2){{ '/search.html?keyword='.$v->link }}@endif' target='_blank' title='{{ $v->name }}'>{{ $v->name }}</a>
                @endforeach
            </dt>
            <i class="right-arrow">&gt;</i>

            @if(count($item->nav_relate_cat_left) > 0)
                <dd>
                    @foreach($item->nav_relate_cat_left as $nav_relate_left)
                        <a href="{{ route('pc_goods_list',['filter_str'=>$nav_relate_left->cat_id]) }}" title="{{ $nav_relate_left->cat_name }}">{{ $nav_relate_left->cat_name }}</a>
                    @endforeach

                </dd>
            @endif

        </dl>
        <div class="categorys">
            <div class="item-left fl">
                <!-- 推荐分类 -->

                @foreach($item->nav_words as $nav_word)
                    <div class="item-channels">
                        <div class="channels">
                            <a href="@if($nav_word->words_type == 0){{ $nav_word->words_link }}@elseif($nav_word->words_type ==1){{ route('pc_goods_list',['filter_str'=>$nav_word->words_link]) }}@elseif($nav_word->words_type == 2){{ '/search.html?keyword='.$v->link }}@endif" target="@if($nav_word->new_open) _blank @else _self @endif"  title="{{ $nav_word->words_name }}"> {{ $nav_word->words_name }} </a>
                        </div>
                    </div>
                @endforeach

                <div class="subitems">

                    @foreach($item->nav_relate_cat_right as $v)
                        <dl class="fore1">
                            <dt>
                                <a  href="{{ route('pc_goods_list', ['filter_str' => $v->cat_id]) }}" target="_blank"  title="{{ $v->cat_name }}">
                                    <em>{{ $v->cat_name }}</em>
                                    <i>&gt;</i>
                                </a>
                            </dt>
                            <dd>

                                @if(!empty($v->child))
                                    @foreach($v->child as $child)
                                        <a href="{{ route('pc_goods_list', ['filter_str' => $child->cat_id]) }}" target="_blank"  title="{{ $child->cat_name }}">{{ $child->cat_name }}</a>
                                    @endforeach
                                @endif

                            </dd>
                        </dl>
                    @endforeach

                </div>
            </div>
            <div class="item-right fr">
                <!-- 品牌logo -->
                <div class="item-brands">
                    <div class="brands-inner">

                        @foreach($item->nav_brand as $nav_brand)
                            <a href="/list-0-0-0-0-0-0-0-0-0-0-0-{{ $nav_brand->brand_id }}.html" target="_blank" title="{{ $nav_brand->brand_name }}">
                                <img src="{{ $nav_brand->brand_logo }}" width="87.5" height="35" />
                            </a>
                        @endforeach

                    </div>
                </div>
                <!-- 分类广告图片 -->


                <div class="item-promotions">
                    @foreach($item->nav_ad as $nav_ad)
                        <a href="{{ $nav_ad->ad_link }}" target="_blank"  class="img-link">
                            <img src="{{ $nav_ad->ad_image }}" width="180" />
                        </a>
                    @endforeach
                </div>




            </div>
        </div>
    </div>
@endforeach
@endif