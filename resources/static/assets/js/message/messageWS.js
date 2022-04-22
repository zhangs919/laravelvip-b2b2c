// 注册用户 user_id, shop_id, website_id
function WS_AddUser(obj) {
    var ws;
    try {
        ws = new WebSocket(obj.url);// 连接服务器
        ws.onopen = function(event) {
            var str = JSON.stringify(obj);
            ws.send(str);// 向服务器发送消息
            // console.log("已经与服务器建立了连接\r\n当前连接状态：" + this.readyState);
            // console.info(str);
            if (this.readyState == 1) {
                obj.type = 'ping';
                setInterval(function heart() {
                    ws.send(JSON.stringify(obj));
                }, 5000);
            }
        };
        ws.onmessage = function(event) {
            // console.info(event.data);
            // var ob = eval(event.data);
            // $(ob).each(function(index) {
            // var val = ob[index];

            var val = JSON.parse(event.data);

            if (val.type == 'snatch_order') {
                playSound(6);
                open_message_box(val, '/order/order/list?type=rob');
            } else if (val.type == 'freebuy_pending') {
                playSound(7);
            } else if (val.type == 'freebuy_success') {
                playSound(8);
            } else if (val.type == 'assign_order') {
                playSound(9);
                open_message_box(val, '/order/order/list?type=send');
            } else if (val.type == 'pong') {
                console.info('heartbeat');
            } else if (val.type == 'gift_card_order') {
                playSound(10);
                open_message_box(val, '/dashboard/gift-card/order-list.html');
            } else if (val.type == 'courier_unanswered') {
                playSound(11);
            } else if (val.type == 'store_refuse_order') {
                playSound(12);
            } else {
                playSound(4);
                open_message_box(val);
            }
            if (val.is_auto_print == 1) {
                if (val.type == 'new_order' || val.type == 'new_pay_order') {
                    auto_print(val.order_id);
                }
            }
            // });
            // console.log("接收到服务器发送的数据：\r\n" + event.data);
        };
        ws.onclose = function(event) {
            // console.log("已经与服务器断开连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onerror = function(event) {
            ws.close();
            // console.log("WebSocket异常！");
        };
    } catch (ex) {
        // console.log(ex.message);
    }
}
function WS_AddSys(obj) {
    var ws;
    try {
        ws = new WebSocket(obj.url);// 连接服务器
        ws.onopen = function(event) {
            var str = JSON.stringify(obj);
            ws.send(str);// 向服务器发送消息
            // console.log("已经与服务器建立了连接\r\n当前连接状态：" + this.readyState);
            // console.info(str);
            if (this.readyState == 1) {
                obj.type = 'ping';
                setInterval(function heart() {
                    ws.send(JSON.stringify(obj));
                }, 5000);
            }
        };
        ws.onmessage = function(event) {
            // console.info(event.data);
            // var ob = eval(event.data);
            // $(ob).each(function(index) {
            // var val = ob[index];

            var val = JSON.parse(event.data);

            if (val.type == 'snatch_order') {
                playSound(6);
                open_message_box(val, '/order/order/list?type=rob');
            } else if (val.type == 'freebuy_pending') {
                // playSound(7);
            } else if (val.type == 'freebuy_success') {
                // playSound(8);
            } else if (val.type == 'assign_order') {
                // playSound(9);
                // open_message_box(val, '/order/order/list?type=send');
            } else if (val.type == 'pong') {
                // console.info('heartbeat');
            } else if (val.type == 'gift_card_order') {
                // playSound(10);
                // open_message_box(val,
                // '/dashboard/gift-card/order-list.html');
            } else if (val.type == 'courier_unanswered') {
                // playSound(11);
            } else if (val.type == 'store_refuse_order') {
                // playSound(12);
            } else if (val.type == 'register_user') {
                playSound(5);
            } else {
                playSound(4);
                open_message_box(val);
            }
            // if (val.is_auto_print == 1) {
            // if (val.type == 'new_order' || val.type == 'new_pay_order') {
            // auto_print(val.order_id);
            // }
            // }
            // });
            // console.log("接收到服务器发送的数据：\r\n" + event.data);
        };
        ws.onclose = function(event) {
            // console.log("已经与服务器断开连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onerror = function(event) {
            ws.close();
            // console.log("WebSocket异常！");
        };
    } catch (ex) {
        // console.log(ex.message);
    }
}
// 注册backend用户 user_id, website_id
function WS_AddSys_old(obj) {
    var ws;
    try {
        ws = new WebSocket(obj.url);// 连接服务器
        ws.onopen = function(event) {
            var str = JSON.stringify(obj);
            ws.send(str);// 向服务器发送消息
            // console.log("已经与服务器建立了连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onmessage = function(event) {
            var message = JSON.parse(event.data);
            for (var i = 0; i < message.length; i++) {
                if (message[i].type == "sys_message") {
                    $this_counts = parseInt($("#message_logo").html());
                    $this_counts++;
                    if (parseInt($this_counts) > 99) {
                        $this_counts = "99+";
                    }
                    $("#message_logo").html($this_counts);
                    $("#message_logo").show();
                } else {
                    open_message_box(message[i]);
                    if (message[i].type == "register_user") {
                        playSound(5);
                    } else if (message[i].type == "freebuy_pending") {
                        playSound(7);
                    } else if (message[i].type == "freebuy_success") {
                        playSound(8);
                    } else {
                        playSound(4);
                    }
                }
            }
            // console.log("接收到服务器发送的数据：\r\n" + event.data);
        };
        ws.onclose = function(event) {
            // console.log("已经与服务器断开连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onerror = function(event) {
            ws.close();
            // console.log("WebSocket异常！");
        };
    } catch (ex) {
        // console.log(ex.message);
    }

}

// 新订单提醒
function WS_AddOrder(obj) {
    var ws;
    try {
        ws = new WebSocket(obj.url);// 连接服务器
        ws.onopen = function(event) {
            var str = JSON.stringify(obj);
            ws.send(str);// 向服务器发送消息
            console.log("已经与服务器建立了连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onmessage = function(event) {
            var message = JSON.parse(event.data);
            // console.info(message);
            newOrderRemind(message.message);
            // console.log("接收到服务器发送的数据：\r\n" + event.data);
        };
        ws.onclose = function(event) {
            // console.log("已经与服务器断开连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onerror = function(event) {
            ws.close();
            // console.log("WebSocket异常！");
        };
    } catch (ex) {
        // console.log(ex.message);
    }
}

// 扫码登录
function WS_QRCodeLogin(obj) {
    var ws;
    try {
        ws = new WebSocket(obj.url);// 连接服务器
        ws.onopen = function(event) {
            var str = JSON.stringify(obj);
            ws.send(str);// 向服务器发送消息
            // console.log("已经与服务器建立了连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onmessage = function(event) {
            var data = JSON.parse(event.data);
            qrcode_login(data.message);
            // console.log("接收到服务器发送的数据：\r\n" + event.data);
        };
        ws.onclose = function(event) {
            // console.log("已经与服务器断开连接\r\n当前连接状态：" + this.readyState);
        };
        ws.onerror = function(event) {
            ws.close();
            // console.log("WebSocket异常！");
        };
    } catch (ex) {
        // console.log(ex.message);
    }
}