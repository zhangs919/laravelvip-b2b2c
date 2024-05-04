<!-- 默认缓载图片 -->
<!-- 前台首页店铺街模板 -->
<div class="drop-item {{ $is_valid != '1' ? 'invalid' : ''}}" id='{{ $uid }}' data-tpl_name='{{ $tpl_name }}' data-is_valid='{{ $is_valid }}'>

    <!-- 店铺街 _star -->
    <div class="w1210 store-wall1">
        <h2>

            @if($tpl_name != '' && $is_design)
                <a title="编辑" href="javascript:void(0)" class="selector title-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="4" data-width="650" data-title_open_colorpicker="1" data-title_open_link="1">
                    <i class="fa fa-edit"></i>
                    编辑
                </a>
            @endif

            @if(!empty($data['4-1']))
                @foreach($data['4-1'] as $v)
                    <a class="store-wall-title" href="javascript:void(0)" title="{{ $v['name'] }}" style="color: {{ $v['color'] }}">{{ $v['name'] }}</a>
                @endforeach
            @else
                <a class="store-wall-title" href="javascript:void(0);">添加标题</a>
            @endif


        </h2>
        <div class="store-wall-content">
            <div class="store-wall-ad">
                <!-- banner下广告组 _star -->

                @if($tpl_name != '' && $is_design)
                    <a title="编辑" href="javascript:void(0)" class="selector pic-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="3">
                        <i class="fa fa-edit"></i>
                        编辑
                    </a>
                @endif
                @if(!empty($data['3-1']))
                    @foreach($data['3-1'] as $v)
                        <a href="{{ $v['link'] ?? 'javascript:void(0)' }}" class="store-wall1-img" style="">
                            <img class="" src="{{ get_image_url($v['path']) }}" data-original="{{ get_image_url($v['path']) }}" data-original-webp="{{ get_image_url($v['path']) }}" width="270" height="333" style="display: inline;">
                        </a>
                    @endforeach
                @else
                    <a href="javascript:void(0);" class="example-text full-size">
                        <span>此处添加【270*333】图片</span>
                    </a>
                @endif



                <!-- banner下广告组 _end -->
            </div>
            <div id="index-store" class="store-wall-con">
                <div class="store-rec-slide">
                    <ul class="store-rec-content">
                        <li class="store-rec-pannel">

                            @if($tpl_name != '' && $is_design)
                                <a title="编辑" href="javascript:void(0)" class="selector shop-selector SZY-TPL-SELECTOR" data-uid="{{ $uid }}" data-cat_id="1" data-type="9" data-number="24" data-show_extend="1">
                                    <i class="fa fa-edit"></i>
                                    编辑
                                </a>
                            @endif
                            <div class="store-con">
                                <p style="position: absolute; z-index: 0; opacity: 1; display: block;" class="store-wall-pannel">


                                    @for($i=0; $i <= 24; $i++)
                                        @if(!empty($data['9-1'][$i]))
                                            <a class="store-item item-row-0 item-col-0 " href="{{ route('pc_shop_home', ['shop_id'=>$data['9-1'][$i]['shop_id']]) }}" target="_blank">
                                                <img class="store-logo" src="{{ $data['9-1'][$i]['shop_logo'] }}" title="{{ $data['9-1'][$i]['shop_name'] }}" alt="{{ $data['9-1'][$i]['shop_name'] }}" height="45" width="90" style="position: relative; top: 0px;">
                                            </a>
                                        @else
                                            <a class="store-item item-row item-col" href="javascript:void(0)">
                                                <img class="store-logo" src="/assets/d2eace91/images/design/example/shop_img_90_45.jpg" height="45" width="90" style="position: relative; top: 0px;">
                                            </a>
                                        @endif
                                    @endfor



                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- 店铺街 _end -->

</div>



<script type="text/javascript">
    {{--//店铺街logo鼠标经过抖动效果 注意：依赖于 js/jump.js--}}
    {{--$("#{{ $uid }}").find(".store-wall1 .store-con img").each(function(k, img) {--}}
        {{--new JumpObj(img, 10);--}}
    {{--});--}}
</script>
