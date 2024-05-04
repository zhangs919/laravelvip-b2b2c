<div class="select-appmsg-con">
    <div class="appmsg-list">

        <!--列表循环start 选中样式appmsg给加样式selected-->
        <div class="appmsg" data-id="5">
            <div class="appmsg-content">
                <div class="appmsg-info">
                    <h4 class="appmsg-title">
                        <a href="javascript:;" target="_blank">222</a>
                    </h4>
                </div>
                <div class="appmsg-item">
                    <span>06月13日</span>
                    <div class="appmsg-thumb-wrp">
                        <img src="http://xxx.oss-cn-beijing.aliyuncs.com/images/15164/backend/409/images/2018/06/06/15282767763306.jpg" alt="" />
                    </div>
                    <p class="appmsg-desc">222</p>
                </div>
            </div>
            <!--素材选中样式-->
            <div class="edit-mask appmsg-mask">
                <i class="icon-card-selected">已选择</i>
            </div>
        </div>


        <!--添加音频
        <div class="preview-card-wap m-t-20 appmsg">
              <div class="voice-icon pull-left m-r-10"><i class="fa fa-volume-up"></i></div>
              <div class="pull-left">
                    <h4 class="graphic-title f14 m-b-10 m-t-10">无标题</h4>
<div class="graphic-time f14 c-999">03:23</div>
              </div>
              <div class="clear"></div>
<div class="edit-mask appmsg-mask">
<i class="icon-card-selected">已选择</i>
</div>
        </div>
         -->
        <!--添加视频
       	<div class="preview-card-wap m-t-20 appmsg">
<div class="video-box pull-left m-r-10">
                    	<span class="video-text">0:42</span>
                        <img src="/images/default/admin.jpg" width="60">
                        <i class="fa fa-play-circle"></i>
                    </div>
                    <div class="pull-left">
                    	<h4 class="graphic-title f14 m-b-10 m-t-10">视频测试2</h4>
<div class="graphic-time">创建于：2017-11-20 14:07</div>
                    </div>
                     <div class="clear"></div>
<div class="edit-mask appmsg-mask">
<i class="icon-card-selected">已选择</i>
</div>
</div>
         -->
        <!---->

        <input type="hidden" name="material_id" id="material_id">
    </div>
</div>
<script type="text/javascript">
    $('.select-appmsg-con .appmsg-list .appmsg').click(function() {
        var material_id = $(this).data("id");
        $("#material_id").val(material_id);
        $(this).addClass('selected').siblings().removeClass('selected');
    });
</script>