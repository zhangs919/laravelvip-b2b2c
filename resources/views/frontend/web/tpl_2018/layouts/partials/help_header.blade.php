<div class="header">
    <div class="w990">
        <div class="logo-info">
            <a href="/" class="logo">
                <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
            </a>
        </div>
        <div class="search">
            <form class="search-form" method="POST" name="" id="" action="/help/default/search" onSubmit="">
                <input type='hidden' name='type' id="searchtype" value="">
                @csrf
                <div class="search-info">
                    <div class="search-type-box">
                        <ul class="search-type">
                            <li class="search-li curr">文章</li>
                        </ul>
                    </div>
                    <div class="search-box">
                        <div class="search-box-con">
                            <input class="search-box-input" name="keyword" id="keyword" tabindex="9" autocomplete="off" value="{{ $keyword ?? '' }}" onFocus="if(this.value=='请输入关键词'){ this.value=''; }else{ this.value=this.value; }" onBlur="if(this.value=='')this.value='请输入关键词'" type="text">
                        </div>
                    </div>
                    <input type="submit" value="搜索" class="button bg-color">
                </div>
            </form>
        </div>
    </div>
</div>