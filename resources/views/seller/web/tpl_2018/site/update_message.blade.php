<style>
    .update-message {
        font-family: "思源黑体";
    }
    .message-pop-box.up {
        z-index: 80;
    }
    .message-pop-box.down {
        z-index: -1;
    }
    .update-message .message-pop-box {
        background: url("/assets/d2eace91/images/common/msg_bg.png") no-repeat;
        background-size: cover;

        /*原始尺寸*/
        /*width: 846px;*/
        /*height: 474px;*/

        /* 0.5倍 */
        /*width: 423px;*/
        /*height: 237px;*/

        width: 507.6px;
        height: 284.4px;
        bottom: 40px;

        /* 0.7倍 */
        /*width: 592px;*/
        /*height: 332px;*/

        box-shadow: none;
        border-radius: 0;
    }
    .update-message .message-pop-box .close {
        background: url(/assets/d2eace91/images/common/msg_close_btn.png) no-repeat;
        background-size: cover;
        width: 12px;
        height: 12px;
        position: relative;
        top: 33px;
        right: 67px;
        opacity: 0.6;
    }
    .update-message .message-pop-box .close:hover {
        opacity: 1;
    }

    .update-message .message-pop-box .message-data {
        top: 22%;
        position: relative;
        width: 100%;
        margin: 0 auto;
        text-align: center;
        color: #fff;
    }

    .update-message span.tit {
        color: #f1d935;
    }
    .update-message span.tit:hover {
        /*color: #b4a437;*/
    }
    .update-message span.desc:hover {
        color: #ddd;
    }
    .update-message span.desc {
        color: #fff;
        margin-left: 5px;
    }
    .update-message .message-data ul {
        position: relative;
        float: left;
    }
    .update-message .message-data ul li {
        float: left;
        width: 300px;
        position: relative;
        margin: 5px auto;
        font-size: 16px;
        left: 100px;
    }
    .update-message .message-data ul li {
        list-style-type: none;
    }
    .update-message .message-data ul li:before {
        content: "\2022";
        color: #f1d935;
        font-size: 30px;
        height: 10px;
        position: absolute;
        top: -10px;
        left: -20px;
    }
</style>

<div class="update-message">
    <div class="message-pop-box small-message up">

        <a class="close" href="javascript:;"></a>

        <div class="message-data">
            @if($messageCount > 0)
                <ul>
                    @foreach($messageList as $key=>$item)
                        <li>
                            <a onclick="message_click('{{ $key }}')">
                                <div class="pull-left">
                                    <span class="tit">{{ $item['title'] }}</span>
                                    <span class="desc">{{ $item['content'] }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="no-data-page">
                    <div class="icon">
                        <i class="fa fa-bell-o"></i>
                    </div>
                    <h5>暂无消息内容</h5>
                    <p>暂时没有消息提醒，稍后再来看看吧！</p>
                </div>
            @endif
        </div>

    </div>
</div>

<script>
    function message_click(object_type) {
        $.ajax({
            type: 'POST',
            url: '/site/message-update',
            data: {
                'object_type': object_type
            },
            dataType: 'json',
            success: function(result) {
                if (result.code == 0) {
                    if (result.data.message_logo_counts <= 0) {
                        $("#message_logo").hide();
                    }
                    $("#message_logo").html(result.data.message_logo_counts);
                    window.location.href = result.data.url
                } else {
                    $.msg(result.message);
                }
            }
        });
    }
</script>

<script>
    $('.small-message .close').click(function() {
        $('.small-message').removeClass('up').addClass('down');
    });
    // $('#message-pop-url').on("click", function() {
    //     $('.small-message').removeClass('up').addClass('down');
    // });
</script>