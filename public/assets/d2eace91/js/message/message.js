function listen_message() {
    $.ajax({
        type: 'GET',
        url: '/site/listen-message.html',
        data: {},
        dataType: 'json',
        success: function(result) {
            // $.msg(result.message);
            if (result.code == 1) {
                playSound(2);
                listen_message();
            } else if (result.code == 2) {
                listen_message();
            }
        }
    });
}

/**
 * 播放声音
 *
 * @param type
 *            类型 2-客服消息 3-系统消息 4-新消息语音
 */
function playSound(type) {

    if ($("#sound").size() == 0) {
        $("body").append("<div id='sound'></div>");
    }
    //console.info(type);
    var sound_file = '/sound/msg';
    if (type == 2) {
        sound_file = '/sound/msg';
    } else if (type == 3) {
        sound_file = '/sound/notice';
    } else if (type == 4) {
        sound_file = '/sound/order-notice';
    } else if (type == 5) {
        sound_file = '/sound/register-notice';
    } else if (type == 6) {
        sound_file = '/sound/snatch-order';
    } else if (type == 7) {
        sound_file = '/sound/freebuy-pending';
    } else if (type == 8) {
        sound_file = '/sound/freebuy-success';
    } else if (type == 9) {
        sound_file = '/sound/assign-order';
    } else if (type == 10) {
        sound_file = '/sound/gift-card-order';
    } else if (type == 11) {
        sound_file = '/sound/courier-unanswered';
    } else if (type == 12) {
        sound_file = '/sound/store-refuse-order';
    }
    if ($.support.msie && $.support.version == '8.0') {
        // 本来这里用的是<bgsound src="system.wav"/>,结果IE8不播放声音,于是换成了embed
        $("#sound").html('<embed src="' + sound_file + '.wav"/>');
    } else {
        // IE9+,Firefox,Chrome均支持<audio/>
        $("#sound").html('<audio autoplay="autoplay"><source src="' + sound_file + '.wav" type="audio/wav"/></audio>');
    }
}