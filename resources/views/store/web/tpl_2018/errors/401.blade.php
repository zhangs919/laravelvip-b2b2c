<link href="/css/error.css" rel="stylesheet" type="text/css" />
<div class="error-content">
    <div class="w990">
        <div class="error">
            <div style="text-align: center">
                <div class="error-title">
                    <p class="color" style="text-align: center; font-size: 24px;">系统提示</p>
                </div>
                <p class="error-line"></p>
                <div class="error-box">


                    <p class="color" style="text-align: center; font-size: 16px;color:red;">{{ $exception->getMessage()}}</p>

                    <p class="error-btn">
                        前往官网购买正版授权
                        <a href="http://www.laravelvip.com/" target="__blank" class="color">乐融沃官网</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>