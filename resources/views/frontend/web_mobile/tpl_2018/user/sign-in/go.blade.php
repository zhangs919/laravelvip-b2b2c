<div class="success-content">
    <div class="pic">
        <img src="/images/success-icon.png" alt="">
    </div>
    <p>恭喜您，签到成功</p>
    <p class="desc">您将获得以下奖励</p>
    <ul class="reward-list">
        <!-- 积分 -->
        <li class="reward">
            <div class="reward-pic"><img src="/images/points-icon.png" alt=""></div>
            1积分
            <a href="javascript:void(0)" onclick=$.go("/user/integral/shop-points")>查看</a>
        </li>
    </ul>
</div>
<a href="javascript:;" class="close-btn success-colse-btn">
    <i class="iconfont"></i>
</a>
<script type="text/javascript">
    //
</script><script>

    $("body").on("click", ".success-colse-btn", function () {
        window.location.href="/user/sign-in/info.html";
    })

    //
</script>