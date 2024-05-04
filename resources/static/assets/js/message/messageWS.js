// 是否打印日志
var szy_websocket_log_enable = true;
// 断重连的时间间隔，单位：毫秒，小于0则不自动重连
var szy_websocket_connection_interval = 5000;

function szy_websocket(options) {
	var defaults = {
		// 初始化对象
		object: {},
		// 是否开启日志
		log_enable: false,
		// 定时器编号
		interval_id: null,
		// 输出日志
		log: function(message) {
			if (this.log_enable || szy_websocket_log_enable) {
				console.info(message);
			}
		},
		// 心跳间隔时间
		heartbeat_interval: 55000,
		// 打开连接事件
		onopen: function(event) {
			var str = JSON.stringify(this.object);
			// 向服务器发送消息
			this.send(str);
			// 打印日志
			this.log("已经与服务器建立了连接，当前连接状态：" + this.readyState);
			this.log(this.object);
			// 初始化心跳
			if (this.readyState == 1) {
				
				var ws = this;
				
				var heart = function() {
					
					if (ws.object.type == 'live_login_set') {
						var obj = $.extend({}, ws.object, {
							type: "live_ping"
						});
					} else {
						var obj = $.extend({}, ws.object, {
							type: "ping"
						});
					}
					ws.send(JSON.stringify(obj));
					
					console.info("发送ping给服务器...");
				};
				
				this.interval_id = setInterval(heart, this.heartbeat_interval);
				
				heart();
			}
		},
		// 消息处理
		onmessage: function(event) {
			this.log("接收到服务器发送的数据：");
			this.log(event);
		},
		// 关闭连接
		onclose: function(event) {
			// 关闭定时器
			if (this.interval_id != null) {
				clearInterval(this.interval_id);
				this.interval_id = null;
			}
			// 记录日志
			this.log("已经与服务器断开连接，当前连接状态：" + this.readyState);
			
			// 断重连
			if (szy_websocket_connection_interval > 0) {
				this.log((szy_websocket_connection_interval / 1000) + "秒后尝试重新连接...");
				setTimeout(function() {
					szy_websocket(options);
				}, szy_websocket_connection_interval);
			}
		},
		// 发生错误
		onerror: function(event) {
			// 记录日志
			this.log("WebSocket异常：");
			this.log(event);
			// 关闭连接
			this.close();
		}
	};
	
	options = $.extend(true, defaults, options);
	
	var ws;
	try {
		// 连接服务器
		ws = new WebSocket(options.object.url);
		// 对象
		ws.object = options.object;
		// 打印日志
		ws.log = options.log;
		// 定时器编号
		ws.interval_id = options.interval_id;
		// 心跳间隔
		ws.heartbeat_interval = options.heartbeat_interval;
		// 打开连接事件
		ws.onopen = options.onopen;
		// 消息处理
		ws.onmessage = options.onmessage;
		// 关闭连接
		ws.onclose = options.onclose;
		// 发生错误
		ws.onerror = options.onerror;
		// 返回
		return ws;
	} catch (ex) {
		console.error(ex);
	}
}

// 注册用户 user_id, shop_id, website_id
function WS_AddUser(obj) {
	
	return szy_websocket({
		object: obj,
		onmessage: function(event) {
			
			var data = JSON.parse(event.data);
			
			this.log("接收到服务器发送的数据：");
			this.log(data);
			
			if (data.type != "pong") {
				
				// 提取消息
				var message = data

				if (data.message) {
					message = data.message;
				}
				
				// 播放声音
				playSound(message);
				
				try {
					
				} catch (e) {
					console.error(e);
				}
				
				// 弹出提示框
				if (typeof open_message_box == "function") {
					open_message_box(message);
				}
				
				// 自动打印
				if (typeof auto_print == "function" && message.is_auto_print == 1 && message.order_id > 0) {
					auto_print(message.order_id);
				}
				
			}
			
			// 处理消费者端的逻辑
			if (!obj.user_id || obj.user_id.indexOf("user_") !== 0) {
				return;
			}
			
			// 新订单提醒
			if (data.type == "new_order_remind" && typeof newOrderRemind == "function") {
				newOrderRemind(message);
			}
			
			// 积分提醒
			if (data.type == "add_point" && typeof addPoint == "function") {
				addPoint(message);
			}
			
			// 扫码登录
			if (data.type == "qrcode_login" && typeof qrcode_login == "function") {
				qrcode_login(message);
			}
		}
	});
	
}

function WS_AddSys(obj) {
	
	return szy_websocket({
		object: obj,
		onmessage: function(event) {
			
			var data = JSON.parse(event.data);
			
			this.log("接收到服务器发送的数据：");
			this.log(data);
			
			if (data.type != "pong") {
				
				// 提取消息
				var message = data

				if (data.message) {
					message = data.message;
				}
				
				// 播放声音
				playSound(message);
				
				// 弹出提示框
				if ($.isFunction(open_message_box)) {
					open_message_box(message);
				}
			}
		}
	});
	
}

// 新订单提醒
function WS_AddOrder(obj) {
	
	return szy_websocket({
		object: obj,
		onmessage: function(event) {
			
			var data = JSON.parse(event.data);
			
			this.log("接收到服务器发送的数据：");
			this.log(data);
			
			newOrderRemind(data.message);
		}
	});
	
}

// 扫码登录
function WS_QRCodeLogin(obj) {
	
	return szy_websocket({
		object: obj,
		onmessage: function(event) {
			
			var data = JSON.parse(event.data);
			
			this.log("接收到服务器发送的数据：");
			this.log(data);
			
			qrcode_login(data.message);
		}
	});
	
}

// 获取积分提醒
function WS_AddPoint(obj) {
	
	return szy_websocket({
		object: obj,
		onmessage: function(event) {
			
			var data = JSON.parse(event.data);
			
			this.log("接收到服务器发送的数据：");
			this.log(data);
			
			addPoint(data.message);
		}
	});
	
}