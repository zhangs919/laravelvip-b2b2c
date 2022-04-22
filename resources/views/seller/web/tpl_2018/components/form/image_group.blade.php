<!-- 图片组 start -->

{{--data-size 图片数量 data-mode（0：模式一：默认 | 1：模式二：直接显示图片列表）--}}
{{--data-mode 显示模式：0-一个一个上传 1-上传多个并且允许中间有空的图片--}}

<div id="default_goods_image_imagegroup_container" class="szy-imagegroup"
     data-id="systemconfigmodel-default_goods_image" data-size="1" data-mode="0">
</div>
{{--labels 展示在图片下方数据格式为json数组--}}
<script type="text/javascript">
    $().ready(function () {
        $("#default_goods_image_imagegroup_container").data("labels", ["\u6b63\u9762\u7167", "\u80cc\u9762\u7167", "\u624b\u6301\u7167"]);

        //
    });
</script>

{{--todo 多张图片 以|分隔--}}
<input type="hidden" id="systemconfigmodel-default_goods_image" class="form-control"
       name="SystemConfigModel[default_goods_image]"
       value="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif">
       {{--value="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/system/config/default_image/idcard_demo_image_0.jpg|http://68dsw.oss-cn-beijing.aliyuncs.com/demo/system/config/default_image/idcard_demo_image_1.jpg|http://images.68mall.com/system/config/default_image/idcard_demo_image_2.jpg">--}}

<!-- 图片组 end -->