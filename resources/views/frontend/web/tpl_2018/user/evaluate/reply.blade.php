<div class="">
    <form class="form-horizontal" method="post" action="" style="width: 470px;">
        <div class="form-group form-group-spe">
            <label class="input-left" style="width: auto;">
                <span>回复卖家：</span>
            </label>
            <div class="form-control-box">
                <textarea placeholder="请输入回复内容..." name="content" class="comment-content"></textarea>
            </div>
        </div>

        <input type="hidden" name="comment_id" value="{{ $comment_id }}">
    </form>
</div>
