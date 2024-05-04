@if(request()->routeIs('pc_goods_list') || request()->routeIs('pc_show_goods') || request()->routeIs('pc_show_lib_goods'))
{{--商品列表 分类面包屑--}}
<div class="breadcrumb clearfix">
    <a href="/" class="index">首页</a>
    <span class="crumbs-arrow">&gt;</span>


    @if(empty($navigate_cat))
        <span class="last">{{ $goods['goods_name'] ?? '' }}</span>
    @else
        @foreach($navigate_cat as $k=>$cat_val)
            @if($cat_val['has_child'] == 1)
            <div class="crumbs-nav crumbs-nav0">
                <a class="crumbs-title" href="{{ route('pc_goods_list',['filter_str'=>$cat_val['cat_id']]) }}" title="{{ $cat_val['cat_name'] }}">
                    {{ $cat_val['cat_name'] }}
                    <i class="icon"></i>
                </a>

				@if(!empty($goods_category))
                <div class="crumbs-drop">
                    <ul class="crumbs-drop-list">

                        @foreach($goods_category as $v)
                            @if($v['parent_id'] == $cat_val['parent_id'] && $v['cat_id'] != $cat_val['cat_id'])
                            <li>
                                <a href="{{ route('pc_goods_list',['filter_str'=>$v['cat_id']]) }}" title="{{ $v['cat_name'] }}">{{ $v['cat_name'] }}</a>
                            </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
				@endif

            </div>
            @else
				@if(isset($cat_val['type']))
					@if($cat_val['type'] == 0)
						<a class="last" href="{{ route('pc_goods_list',['filter_str'=>$cat_val['cat_id']]) }}" title="{{ $cat_val['cat_name'] }}"> {{ $cat_val['cat_name'] }} </a>
					@elseif($cat_val['type'] == 1)
						<span class="last">{{ $cat_val['cat_name'] }}</span>
					@endif
				@endif
            @endif
        @endforeach
    @endif
    {{--<div class="crumbs-nav">
        <span class="crumbs-search">
            <form id="15304479456NJQ5k" class="current-search-form" method="get" action="/list">
                <input type="text" value="在当前分类下搜索" name="keyword" class="search-term"/>
                <input type="button" class="search-button"/>
            </form>
        </span>
    </div>--}}
    <script type="text/javascript">
        /*$().ready(function() {
            $("#15304479456NJQ5k").find(".search-button").click(function() {
                var keyword = $("#15304479456NJQ5k").find("[name='keyword']").val();

                var url = "/list.html?cat_id=271&amp;sort=1&amp;order=DESC&amp;region=13_03_02&amp;keyword={0}";
                url = url.replace(/&amp;/g, "&");

                if ($.trim(keyword) == '在当前分类下搜索') {
                    url = url.replace("{0}", "");
                } else {
                    url = url.replace("{0}", $.trim(keyword));
                }

                $.go(url);
            });
            $("#15304479456NJQ5k").find("[name='keyword']").click(function() {
                if ($(this).val() == '在当前分类下搜索') {
                    $(this).val("");
                }
            });
        });*/
    </script>
</div>

@elseif(request()->routeIs('pc_global_search'))
{{--商品关键词搜索--}}
<div class="breadcrumb clearfix">
    <a href="javascript:;" class="index">全部结果</a>
    <span class="crumbs-arrow">&gt;</span>
    <span class="last">{{ $params['keyword'] ?? '' }}</span>
</div>
@endif
