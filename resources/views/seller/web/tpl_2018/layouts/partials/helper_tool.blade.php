<!-- 右侧浮动内容 Begin -->
<div class="helper-fixed">
    <div class="helper-icon">
		<span>
			<i class="fa fa-send-o"></i>
			设置助手
		</span>
    </div>
    <div id="helper_tool" class="helper-wrap">
        <div class="help-header">
            设置助手
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="panel-group" id="accordion">
            <div id="helper_tool_nav" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            页面导航（
                            <em class="count">0</em>
                            ）
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="list">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $().ready(function() {

        /*商品添加页面右侧发布助手js*/
        $('.helper-icon').click(function() {
            $('.helper-icon').animate({
                'right': '-40px'
            }, 200, function() {
                $('.helper-wrap').animate({
                    'right': '0'
                }, 200);
            });
        });
        $('.help-header .fa-times-circle').click(function() {
            $('.helper-wrap').animate({
                'right': '-140px'
            }, 200, function() {
                $('.helper-icon').animate({
                    'right': '0'
                }, 200);
            });
        });

        //生成页面导航助手
        $("#helper_tool_nav").find("ul").html("");
        var count = 0;
        $("[data-anchor]").each(function() {
            var title = $(this).data("anchor");
            var element = $($.parseHTML("<li><a href='javascript:void(0);'>" + title + "</a></li>"));
            $("#helper_tool_nav").find("ul").append(element);
            var target = this;
            $(element).click(function() {
                $('html, body').animate({
                    scrollTop: $(target).offset().top - 100
                }, 500);
                if ($(target).is(":input")) {
                    $(target).focus();
                } else {
                    $(target).find(":input").first().focus();
                }
            });
            count++;
        });

        $("#helper_tool_nav").find(".count").html(count);

        $('.helper-icon').click();
    });
</script>