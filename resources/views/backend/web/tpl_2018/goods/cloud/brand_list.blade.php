{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <!--搜索-->
    <div class="search-term m-b-10">
        <form id="searchForm" action="/goods/cloud/brand-import.html" method="GET">
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="control-label"> <span>商品品牌：</span></label>
                    <div class="form-control-wrap">
                        <input name="keywords" class="form-control" type="text" placeholder="">
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <a class="btn btn-primary" href="javascript:;" id="btn_search">搜索</a></div>
        </form>
    </div>

    {{--引入列表--}}
    @include('goods.cloud.partials._brand_list')

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <script src="/assets/d2eace91/js/jquery.json-2.4.js?v=1.2"></script>
    <script type="text/javascript">
        $().ready(function() {
            //悬浮显示上下步骤按钮
            window.onscroll = function() {
                $(window).scroll(function() {
                    var scrollTop = $(document).scrollTop();
                    var height = $(".page").height();
                    var wHeight = $(window).height();
                    if (scrollTop > (height - wHeight)) {
                        $(".bottom-btn").removeClass("bottom-btn-fixed");
                    } else {
                        $(".bottom-btn").addClass("bottom-btn-fixed");
                    }
                });

            };
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();

            $("#btn_search").click(function() {
                var data = $("#searchForm").serializeJson();
                tablelist.load(data);
            });

            /*父控制子*/
            $("body").on("click",".batch",function() {
                var val = $(this).val();
                if($(this).is(":checked")){
                    $(".child"+val+" .checkbox").prop("checked",true);
                }else{
                    $(".child"+val+" .checkbox").prop("checked",false);
                }
            });
            /*子影响父*/
            $("body").on("click",".checkbox",function(){
                var letter = $(this).attr("data-letter");
                if($(this).is(":checked")){
                    var all_checkbox = $(".child"+letter+" .checkbox").length;
                    var checked_checkbox = $('.child'+letter+' input[type=checkbox]:checked').length;
                    if(all_checkbox == checked_checkbox){
                        $("#batch"+letter).prop("checked",true);
                    }
                }else{
                    $("#batch"+letter).prop("checked",false);
                }
            })

            /*提交品牌*/
            $("body").on("click","#submit",function(){

                var data = new Array();
                $("input[type=checkbox][class=checkbox]:checked").each(function(i,obj){
                    var index = parseInt(i/50);
                    if(typeof(data[index]) == "undefined"){
                        data[index] = new Array();
                    }
                    var data_obj = new Object();
                    data_obj.yId = $(obj).val();
                    data_obj.name = $(obj).attr('data-name');
                    data_obj.letter = $(obj).attr('data-letter');
                    data[index].push(data_obj);
                })

                if(data.length > 0){
                    $("#btn_submit").attr("disabled",true);
                    saveBrand(data,0);
                }else{
                    $.msg("请选择需要导入的品牌！");
                }
            })

        })

        function saveBrand(data,index){
            $.loading.start();
            $.post('/goods/cloud/brand-import-ajax', {
                data: $.toJSON(data[index]),
                num: index
            }, function(result) {
                //console.log(result);
                if (result.code == 0) {
                    if(typeof(data[result.num]) == "undefined"){
                        $.msg(result.message, {
                            time: 3000
                        });
                        $.go(result.go);
                    }
                    else{
                        saveBrand(data,result.num);
                    }
                } else {
                    $("#btn_submit").removeAttr("disabled");
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON");
        }

        /*鼠标点击切换tab*/
        function change_tabs(a,b,c){
            $("body").on("click",a,function(){
                $(this).addClass(c).siblings().removeClass(c);
                $(b).eq($(this).index()).show().siblings().hide();
            })
        }
        change_tabs(".tools-list a",".authset-list",'selected');



    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop