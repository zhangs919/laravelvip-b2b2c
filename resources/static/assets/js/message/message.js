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
 * @param data
 * @param count
 *            播放次数（不用设置）
 */
function playSound(data, count) {
	
	var type = data.type;
	
	var notice_count = data.notice_count != undefined ? data.notice_count : 1;
	var notice_interval = data.notice_interval ? data.notice_interval : 1000;
	
	if (count == undefined) {
		count = notice_count;
	}
	
	if (count == 0) {
		return;
	}
	
	if ($("#sound").size() == 0) {
		$("body").append("<div id='sound'></div>");
	}
	
	// 前奏
	if ($.support.msie && $.support.version == '8.0') {
		// 本来这里用的是<bgsound src="system.wav"/>,结果IE8不播放声音,于是换成了embed
		$("#sound").html('<embed src="/sound/notice.mp3"/>');
	} else {
		// IE9+,Firefox,Chrome均支持<audio/>
		$("#sound").html('<audio autoplay="autoplay"><source src="/sound/notice.mp3" type="audio/mp3"/></audio>');
	}
	
	// 语音合成
	if (data.is_tts == 1) {
		
		setTimeout(function() {
			var ssu = new window.SpeechSynthesisUtterance(data.content);
			window.speechSynthesis.speak(ssu);
		}, 3000);
		
		return;
	}
	
	var sound_file = '/sound/' + type + '.mp3';
	
	// 提醒
	setTimeout(function() {
		if ($.support.msie && $.support.version == '8.0') {
			// 本来这里用的是<bgsound src="system.wav"/>,结果IE8不播放声音,于是换成了embed
			$("#sound").html('<embed src="' + sound_file + '"/>');
		} else {
			// IE9+,Firefox,Chrome均支持<audio/>
			var notice_id = "__notice__" + (new Date().getTime());
			$("#sound").html('<audio id="' + notice_id + '" autoplay="autoplay"><source src="' + sound_file + '" type="audio/mp3"/></audio>');
			
			// 计算剩余播放次数
			count--;
			
			if (count > 0) {
				// 声音播放结束触发事件
				$("#" + notice_id).on("ended", function() {
					setTimeout(function() {
						playSound(data, count);
					}, notice_interval);
				});
			}
		}
	}, 3000);
}