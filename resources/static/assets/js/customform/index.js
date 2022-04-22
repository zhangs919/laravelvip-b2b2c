$.loading.start();
$(function () {
	// 环载结束
    $.loading.stop();
    
    // 回到顶部
    setTimeout(function() {
    	$('html, body').animate({
    		scrollTop:0
    	}, 'fast');
    }, 300);
});

/**
 * data-unique 是拖拽中心模板 与 右侧窗口表单name值想对应 data-type 节点类型, 比如input, page_title等
 * v_unique 代表校验规则
 */
// 表单节点
var forms = {
    wrapper: '<li class="drop-field" style="height:71px;width:97%"></li>',
    // 表单拖拽节点中的操作集合
    actions: '<div class="operateEdit">'+
    	'<a class="decor-btn upMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>' +
    	'<a class="decor-btn downMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>' + 
    	// '<a class="decor-btn hide-btn"><div class="selector-box"><div
		// class="arrow"></div><i class="fa
		// fa-check-circle-o"></i>显示</div></a>'+
    	'<a class="decor-btn deletes-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a></div>',
    // 单行文本
    input: {
        // 用于填充内容的dom节点
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">单行文本</span></div>' +
        '<div class="question-conent"><input style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        // 实际的表单数据
        json: '{"type":"input","title":"单行文本","title_default_value":"","description":"","v_required":0,"v_unique":0,"v_resident_cardnum":0,"v_minlength":0,"v_minlength_con":"","v_maxlength":0,"v_maxlength_con":"","v_error_customer":0,"v_error_customer_con":""}',
    },
    // 多行文本
    textarea: {
        // 用于填充内容的dom节点
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">多行文本</span>' +
        '</div>' +
        '<div class="question-conent">' +
        '<textarea type="text" rows="5" cols="60" class="disabled" data-unique="title_default_value" disabled data-type="input"></textarea>' +
        '</div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"textarea","title":"多行文本","title_default_value":"","description":"","v_required":0,"v_minlength":0,"v_minlength_con":"","v_maxlength":0,"v_maxlength_con":"","v_error_customer":0,"v_error_customer_con":""}',
    },
    // 单项选择
    radio: {
        dom:
        '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required"  data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">单项选择</span>' +
        '</div>' +
        '<div class="question-conent" data-unique="layout" data-type="class">' +
        '<ul data-unique="items" data-type="radio" class="clearfix">' +
        '<li><label><input type="radio" disabled name="option">选项 1</label></li>' +
        '<li><label><input type="radio" disabled name="option">选项 2</label></li>' +
        '<li><label><input type="radio" disabled name="option">选项 3</label></li>' +
        '</ul>' +
        '</div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"radio","title":"单项选择","description":"","v_required":0,"items":[{"val":"选项 1","checked":"0"},{"val":"选项 2","checked":"0"},{"val":"选项 3","checked":"0"}],"v_error_customer":0,"v_error_customer_con":"","layout":""}',
    },
    // 多项选择
    checkbox: {
        dom:
        '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required"  data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">多项选择</span>' +
        '</div>' +
        '<div class="question-conent" data-unique="layout" data-type="class">' +
        '<ul data-unique="items" data-type="checkbox" class="clearfix">' +
        '<li><label><input type="checkbox" disabled name="option[]">选项 1</label></li>' +
        '<li><label><input type="checkbox" disabled name="option[]">选项 2</label></li>' +
        '<li><label><input type="checkbox" disabled name="option[]">选项 3</label></li>' +
        '</ul>' +
        '</div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"checkbox","title":"多项选择","description":"","v_required":0,"items":[{"val":"选项 1","checked":"0"},{"val":"选项 2","checked":"0"},{"val":"选项 3","checked":"0"}],"v_error_customer":0,"v_error_customer_con":"","layout":""}',
    },
    // 数字
    number: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">数字</span></div>' +
        '<div class="question-conent"><div class="item-input-box" style="width: auto!important;"><i class="item-icon number"></i><input style="width: 300px;padding-left: 30px" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"><span data-type="text" data-unique="unit" class="m-l-15"></span></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"number","title":"数字","title_default_value":"","description":"","unit":"","v_required":0,"v_minlength":0,"v_minlength_con":"","v_maxlength":0,"v_maxlength_con":"","v_error_customer":0,"v_error_customer_con":""}'
    },
    // 日期、时间
    time: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">时间</span></div>' +
        '<div class="question-conent"><div class="item-input-box" style="width: auto!important;"><i class="item-icon time"></i><input style="width: 300px;padding-left: 30px" class="disabled" type="text" data-unique="default_time" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"time","title":"时间","default_time":"","time_level":"","description":"","v_required":0,"v_error_customer":0,"v_error_customer_con":""}'
    },
    // 地址
    address: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">地址</span></div>' +
        '<div class="question-conent">' +
        '<div class="form-group">' +
        '<select class="m-r-15 w150 select province" disabled data-unique="province"><option value="">- 省/自治区/直辖市 -</option></select>' +
        '<select class="m-r-15 select city" disabled data-unique="city"><option value="">- 市 -</option></select>' +
        '<select class="m-r-15 select county" disabled data-unique="county"><option value="">- 区/县 -</option></select>' +
        '</div>' +
        '<div class="form-group m-t-15">' +
        '<textarea type="text" rows="5" cols="60" class="disabled" data-unique="address_detail" disabled="" data-type="input"></textarea>' +
        '</div>' +
        '</div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"address","title":"地址","description":"","default":"","address":{"address_code":"","address_detail":"","address_text":""},"v_required":0,"v_error_customer":0,"v_error_customer_con":""}',
    },
    // 网址
    url: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">网址</span></div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon url"></i><input style="width: 300px;padding-left: 30px" class="disabled" type="text" placeholder="http://" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"url","title":"网址","title_default_value":"","description":"","v_required":0,"v_unique":0,"v_error_customer":0,"v_error_customer_con":""}'
    },
    // 上传附件 必须要用\的形式让a标签有空格间隙
    upload_file: {
    	 dom: '<div class="type-content">' +
         '<div class="question-title">' +
         '<span class="required" data-unique="v_required" data-type="display">*</span>' +
         '<span class="q-title" data-unique="title" data-type="text">上传附件</span></div>' +
         '<div class="question-conent">'+
         '<div class="upload-box">'+
         '<div class="container">\
         	<a href="javascript:void(0);" class="btn btn-default">选择文件</a>\
          	<a href="javascript:void(0);" class="btn btn-primary">开始上传</a>\
         </div>'+
         '</div>'+
     	 '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
     	 '</div>',
         json: '{"type":"upload_file","title":"上传附件","description":"","v_required":0,"v_error_customer":0,"v_error_customer_con":""}'
    },
    // 单个下拉框
    select: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">下拉框</span></div>' +
        '<div class="question-conent"><select style="width: 300px;" class="disabled" data-unique="items" disabled data-type="select"></select></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"select","title":"下拉框","description":"","v_required":0,"items":[{"val":"选项 1","checked":"0"},{"val":"选项 2","checked":"0"},{"val":"选项 3","checked":"0"}],"v_error_customer":0,"v_error_customer_con":""}'
    },
    // 描述
    describe: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">描述</span></div>' +
        '<div class="question-conent"><div class="T_edit" data-unique="description" data-type="text"></div></div>' +
        '</div>',
        json: '{"type":"describe","title":"描述","description":""}'
    },
    // 图片展示
    image: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">图片展示</span></div>' +
        '<div class="question-conent"><div data-unique="image_url" data-type="image"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"image","title":"图片展示","image_url":"","image_href":"","description":""}'
    },
    // 视频播放
    video: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">视频展示</span></div>' +
        '<div class="question-conent"><div data-unique="video_url" data-type="video"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"video","title":"视频展示","video_url":"","description":""}'
    },
    // 姓名
    username: {
        // 用于填充内容的dom节点
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">姓名</span></div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon name"></i><input class="item-input disabled"  style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        // 实际的表单数据
        json: '{"type":"username","title":"姓名","title_default_value":"","description":"","v_required":0,"v_unique":0,"v_minlength":0,"v_minlength_con":"","v_maxlength":0,"v_maxlength_con":"","v_error_customer":0,"v_error_customer_con":""}',
    },
    // 邮箱
    email: {
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">邮箱</span></div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon mall"></i><input style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        // 实际的表单数据
        json: '{"type":"email","title":"邮箱","description":"","v_required":0,"v_unique":0,"v_error_customer":0,"v_error_customer_con":""}',
    },
    // 手机
    phone: {
        dom:
        '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required"  data-unique="v_required" data-type="display">*</span>' +
        '<span class="question-id"></span>' +
        '<span class="q-title" data-unique="title" data-type="text">手机</span>' +
        '</div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon handset"></i><input style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"phone","title":"手机","description":"","v_required":0,"v_unique":0,"v_sms":0,"v_captcha":0,"v_error_customer":0,"v_error_customer_con":""}',
    },
    // 微信
    weixin: {
        // 用于填充内容的dom节点
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">微信</span></div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon weixin"></i><input class="item-input disabled"  style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        // 实际的表单数据
        json: '{"type":"weixin","title":"微信","description":"","v_required":0,"v_error_customer":0,"v_error_customer_con":""}',
    },
    // qq
    qq: {
        // 用于填充内容的dom节点
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">QQ</span></div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon qq"></i><input class="item-input disabled"  style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        // 实际的表单数据
        json: '{"type":"qq","title":"QQ","description":"","v_required":0,"v_error_customer":0,"v_error_customer_con":""}',
    },
    // 微博
    weibo: {
        // 用于填充内容的dom节点
        dom: '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">微博</span></div>' +
        '<div class="question-conent"><div class="item-input-box"><i class="item-icon weibo"></i><input class="item-input disabled"  style="width: 300px;" class="disabled" type="text" data-unique="title_default_value" disabled data-type="input"></div></div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        // 实际的表单数据
        json: '{"type":"weibo","title":"微博","description":"","v_required":0,"v_error_customer":0,"v_error_customer_con":""}',
    },
    // 分割线
    dividing_line: {
        dom:
        '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required"  data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text"></span>' +
        '</div>' +
        '<div class="question-conent">' +
        '<div class="DividingLine" data-unique="dividing_line"></div>' +
        '</div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"dividing_line","title":"","description":"","line_width":"1px","line_shape":"dashed","line_color":"#ccc"}',
    },
    // 静态地图
    static_map: {
        dom:
        '<div class="type-content">' +
        '<div class="question-title">' +
        '<span class="required" data-unique="v_required" data-type="display">*</span>' +
        '<span class="q-title" data-unique="title" data-type="text">微博</span></div>' +
        '<div class="question-conent">' +
        '<div class="map_container"></div>' +
        '</div>' +
        '<div class="help-block help-block-t" data-unique="description" data-type="text"></div>' +
        '</div>',
        json: '{"type":"static_map","title":"","description":"","label":"静态地图","place":"","location":{"lat":"39.900194","lng":"116.39797"},"zoom":12}',
    }
};

// ****************** 全局表单变量 ****************** //
// >>>>>>>> 为保证拖拽表单的顺序, 页面拆分两个数组存储, 一个是不动的全局 global_form_datas 一个是自定义的
// form_datas
// 拖拽式表单数据
var form_datas = [];
// 全局类型
var is_global = 1;
// 自定义类型
var is_custom = 2;
// 最大上传附件数
var MAX_UPLOAD_SIZE = 5;
// 全局唯一的data的type
var global_types = [
    'page_header',
    'page_title',
    'page_desc'
];
// 表单排序的时候，索引改变记录的标识
var DOM_INDEX = false;
// 表单标题的提示显示的长度
var TIPS_TITLE_LENGTH = 15;
// 静态地图容量对象
var static_maps = {};
// 全局式
var global_forms = {
    page_header: {
        // json:
		// '{"type":"page_header","header":"","bodybg":"#f3f3f3","bodybg_type":"1","formbg":"#ffffff"}'
    	json: '{"type":"page_header","header":"","bodybg":"#f3f3f3","bodybg_type":"1"}'
    },
    page_title: {
        json: '{"title":"模板标题","type":"page_title"}'
    },
    page_desc: {
        json: '{"type":"page_desc", "description":"模板描述"}'
    }
};

var global_form_datas = {
	// bodybg 页面body背景
	// bodybg_type 是背景类型 0-图片 1-颜色
	// formbg 表单背景颜色
// page_header: {"type": "page_header", "header":
// "","bodybg":"#f3f3f3","bodybg_type":"1","formbg":"#ffffff"},
    page_header: {"type": "page_header", "header": "","bodybg":"#f3f3f3","bodybg_type":"1","formbg":"#ffffff"},
    page_title: {"title": "模板标题", "type": "page_title"},
    page_desc: {"type": "page_desc", "description": "模板描述"}
};
// 需要初始化编辑器的key
var editor_keys = [
    'page_desc',
    'input',
    'textarea',
    'radio'
];

// 日期级别
var time_level = {
    // 年月日
    "0": {
        startView: 2,
        minView: 2,
        maxView: 4,
        format: "yyyy-mm-dd"
    },
    // 年月日时分秒
    "1": {
        startView: 2,
        minView: 0,
        maxView: 4,
        format: "yyyy-mm-dd hh:ii:ss"
    }
};
// 分割线样式
var line_styles = ['line_width', 'line_shape', 'line_color'];
// 全局编辑器
var editor;
// 隐藏校验标题
var hide_validates = ['video', 'image', 'dividing_line', 'describe', 'page_desc', 'page_header', 'page_title', 'static_map'];
// 隐藏布局标题
var hide_styles = ['textarea', 'video', 'image', 'input', 'time', 'dividing_line', 'url', 'select', 'describe', 'phone', 'username', 'email', 'page_desc', 'page_header', 'page_title', 'static_map', 'address', 'qq', 'weixin', 'weibo', 'number', 'upload_file'];
// 标题可以缺少,不在数组内的均需要填写标题
var noneed_title = ['dividing_line', 'static_map', 'image', 'video', 'describe', 'page_desc', 'page_header', 'page_title'];

// body
var o_body = $('body');

// 类型
var TYPE_CHECKBOX = 'checkbox';
var TYPE_RADIO = 'radio';

// ********* 左侧区域 *********//
// 左侧滚动菜单
var accordion_group_selector = '.accordion-group';
var o_accordion_group = $(accordion_group_selector);
// 拖拽单元的外层包裹
var ul_tool_selector = '.ul-tool';

// ********* 中间区域 *********//
// 中间区域 表单最外层
var center_form_selector = '.center-form';
var o_center_form = $(center_form_selector);
// 自定义表单区域 被拖拽区域
var dropzone_selector = '#dropzone';
var o_dropzone = $(dropzone_selector);

// 每个li选择器
var li_wrapper_selector = '.drop-field';
var o_doc = $(li_wrapper_selector);
// 每个li下 div的包裹class选择器
var type_content_selector = '.type-content';
// 每个li下 操作的class选择器
var action_selector = '.operateEdit';
// 上移
var up_field_selector = '.upMove-btn';
var o_up_field = $(up_field_selector);
// 下移
var down_field_selector = '.downMove-btn';
var o_down_field = $(down_field_selector);
// 隐藏
var hide_field_selector = '.hide-btn';
var o_hide_field = $(hide_field_selector);
// 删除
var del_field_selector = '.deletes-btn';
var o_del_field = $(del_field_selector);

// ********* 右侧区域 *********//
// tips
var tips_selector = '.right-operate';
var o_tips = $(tips_selector);
// tips的小三角
var jt_selector = '.jt';
var o_jt = $(jt_selector);
// tips标题
var tips_title_seletor = '.bt';
var o_tips_title = $(tips_title_seletor);
// 表单保存按钮
var form_btn_selector = '.Fsubmit';
var o_form_btn = $(form_btn_selector).find('.btn');
// 当前的选择的对象
var current_index_selector = '#current_select_index';
var o_current_slector = $(current_index_selector);
// tips的关闭
var tips_close_selector = '.close';
var o_tips_close = o_tips.find(tips_close_selector);
// 保存的表单
var o_save_form = o_tips.find('form');
var o_save_form_wrapper = o_save_form.find('.form-wrapper');
// 单选列表
var radio_list_selector = '.radio_item_list';
var o_radio_list = o_save_form.find(radio_list_selector);
// 多选列表
var checkbox_list_selector = '.checkbox_item_list';
var o_checkbox_list = o_save_form.find(checkbox_list_selector);
// 校验区域框
var validate_content_selector = '.validate_content';
var o_validate_content = $(validate_content_selector);
// 编辑器内容区域
var o_editor_description = $('#editor-description');
// 地图正向地理编码对象
var o_geocoder = null;

// -------- 地址初始化 --------- //
AMap.plugin('AMap.Geocoder', function() {
	o_geocoder = new AMap.Geocoder();
})
// -------- 显示地址正向解析成为经纬度--------- //
var place_delay = null;
$('#place').keyup(function() {
	clearTimeout(place_delay);
	var self = $(this);
	place_delay = setTimeout(function() {
		var val = $.trim(self.val());
		if (val != '') {
			// 
			mapDecodePlace(val);
		}
	}, 300);
});

// -------- 背景设置 --------- //
$('#bodybg_type').change(function() {
	var self = $(this);
	var val = self.val();
	var o_bg_img_container = $('#bg_img_container');
	var o_bg_color_container = $('#bg_color_container');
	var o_bg_img_helper = $('#bg_img_helper');
	
	// 背景图
	if (val == 0) {
		o_bg_img_container.show();
		o_bg_img_helper.show();
		o_bg_color_container.hide();
	// 背景色
	} else {
		o_bg_img_container.hide();
		o_bg_img_helper.hide();
		o_bg_color_container.show();
	}
});

// 地图根路径
var map_base_path = 'https://restapi.amap.com/v3/staticmap';
var o_map_scale = $('#map_scale');
// 初始化地图的拖拽条
o_map_scale.slider({
    range: "max",
    min: 3,
    max: 17,
    value: 12,
    tooltip: 'show',
    slide: function (event, ui) {
        var zoom = ui.value;
        // 改变缩放的数值
        $('#map_scale_ipt').val(zoom);
        // 改变对应地图[因为可能多个]的缩放度
        var index = getCurrentIndex();
        var o_tpl = getObjById(index);
        // 获取token
        var token = o_tpl.data('token');
        if (!token) {
            return false;
        }
        // 得到地图组件对象
        var o_map = getMapObj(token);
        // 设置缩放值
        o_map.setZoom(zoom);
    }
});
// 排列方式
$('.switch').bootstrapSwitch();

// // 初始化编辑器内容
// var E = window.wangEditor
// editor = new E('#editor-header', '#editor-body')
// editor.customConfig.menus = [
// 'head', // 标题
// 'bold', // 粗体
// 'fontSize', // 字号
// 'fontName', // 字体
// 'italic', // 斜体
// 'underline', // 下划线
// 'strikeThrough', // 删除线
// 'foreColor', // 文字颜色
// 'backColor', // 背景颜色
// ];
// // 动态改变编辑器的内容
// editor.customConfig.onchange = function (html) {
// o_editor_description.val(html);
// };
// editor.create();

// 预览
$('#btn_preview').click(function () {
	if (!validateHeader())
	{
		return false;
	}
	if (!validateForm())
	{
		return false;
	}
    var form = $('#to_preview');
    form.find('#form_datas').val(JSON.stringify(form_datas));
    form.find('#global_datas').val(JSON.stringify(global_form_datas));
    form.submit();
});

// 提交
$('#btn_submit').click(function () {
	if (!validateHeader())
	{
		return false;
	}
	if (!validateForm())
	{
		return false;
	}
    var form = $('#to_submit');
    var path = form.attr('action');
    $.loading.start();
    $.post(path, {
        form_datas: JSON.stringify(form_datas),
        global_datas: JSON.stringify(global_form_datas)
    }, function (res) {
        if (res.code == 0) {
            $.msg(res.message, {
                time: 1500
            }, function () {
                $.go('/dashboard/custom-form/list.html');
            });
        } else {
            $.msg(res.message);
        }
    }, 'JSON').always(function () {
        $.loading.stop();
    });
    ;
});

/**
 * 头部数据校验
 * 
 * @returns {Boolean}
 */
function validateHeader()
{
	// 请选择模板图片
	if (!global_form_datas['page_header']) 
	{
		$.msg('请设置顶部内容');
		return false;
	}
	// 顶部图片内容
	// if(global_form_datas['page_header']['header'] == "")
	// {
	// $.msg('请选择顶部图片');
	// return false;
	// }
	// 全局背景内容
	if (global_form_datas['page_header']['bodybg'] == "")
	{
		// 0 为背景图片
		if (global_form_datas['page_header']['bodybg_type'] == 0) {
			$.msg('请选择背景图片');
			return false;
		} else {
			// 1 为背景颜色
			$.msg('请选择背景颜色');
			return false;
		}
	}
	// 请输入模板描述
	// if (!global_form_datas['page_desc'] ||
	// global_form_datas['page_desc']['description'] == "")
	// {
	// $.msg('请输入模板描述');
	// return false;
	// }
	// 请输入模板标题
	// if (!global_form_datas['page_title'] ||
	// global_form_datas['page_title']['title'] == "")
	// {
	// $.msg('请输入模板标题');
	// return false;
	// }
	return true;
}

/**
 * 设计表单的内容验证
 * 
 * @returns {Boolean}
 */
function validateForm()
{
	if (form_datas.length == 0)
	{
		$.msg('请设计您的表单');
		return false;
	}
	return true;
}

// ************** 全局样式设定 ************** //
// 左侧导航滚动条
o_accordion_group.mCustomScrollbar();

// 悬浮显示上下步骤按钮
window.onscroll = function () {
    $(window).scroll(function () {
        var scrollTop = $(document).scrollTop();
        var height = $(".module-content").height();
        var wHeight = $(window).height();
        if (scrollTop > (height - wHeight)) {
            $(".left-sidebar").addClass("fixed");
        } else {
            $(".left-sidebar").removeClass("fixed");
        }
    });

};
// ************** 左边编辑设置框的定位js************** //
// 与上间距
var space = o_doc.offset().top;
// 点击自定义区域内容
o_center_form.on('click', li_wrapper_selector, function (e) {
	// 如果是按钮点击则不触发此效果
	var target = $(e.target);
	if (target.hasClass('decor-btn'))
	{
		return;
	}
    var self = $(this);
    // 添加高亮效果
    // 由于模板标题和顶部内容没有在一个区域内
    removeAllFocus();
    self.addClass('focus');
    
    // ************** 效果部分 ************** //
    var pageY = e.pageY; // 获取鼠标点击位置
    var height = pageY - space; // 需定位内容的位置调整
    var top = height - 150;
    if (top < 0) {
        o_tips.css("top", 0 + 'px');
    } else {
        o_tips.css("top", (height) - 150 + 'px');
    }
    o_jt.css("top", (height) + 'px').addClass("show");
    o_tips.addClass("show");

    // ************** tips内容部分 ************** //
    // 获取类型
    var type = self.data('type');
    // 根据id取得内容
    var id = self.attr('id');
    var index = self.index();
    // 如果两次点击的内容是一个，则不做其他操作
    var current_index = getCurrentIndex();
    // 唯一类型 page_header page_title page_desc 其索引也是其type
    if (inArray(type, global_types)) {
        index = type;
    }
    // current_index 有可能是 '' 而 index有可能是0 那么 0 == "" -> true
    if ('' !== current_index && index == current_index) { return; }
	
    // 设置当前选中标识
    setCurrentIndex(index);
    // 设置右侧的表单数据
    setFormEditor(type, id);
});
// 点击右侧tips的关闭按钮
o_tips_close.click(function () {
    o_jt.removeClass("show");
    o_tips.removeClass("show");
});

// ************** 左侧区域拖拽 ************** //
$('li', ul_tool_selector).draggable({
    // 如果设置为 "invalid"，还原仅在 draggable 未放置在 droppable 上时发生
	// 要将helper元素置为body下
	appendTo: "body",
    revert: "invalid",
    zIndex: 10000,
    // 如果设置为 "clone"，元素将被克隆，且克隆将被拖拽
    helper: "clone",
    // 允许 draggable 放置在指定的 sortable 上。如果使用了该选项，一个 draggable 可被放置在一个 sortable
    // 列表上，然后成为列表的一部分。注意：helper 选项必须设置为 "clone"，以便更好地工作。必须包含
    // 可排序小部件$(form_custom_class).sortable
    connectToSortable: dropzone_selector,
}).disableSelection().click(function () {
    // 直接将内容添加进去
    // 获取类型
    var self = $(this);
    var type = self.data('type');
    // 插入到最后一位
    var index = o_dropzone.find('.drop-field').size();
    // item不存在
    changeDomJson(null, type, index)
    // 批量更新内容
    batchMainSetting();
    // 初始化组件
    initComponents(type);
    // 移除空提示样式
    clickRemoveEmptyNotice();
});

// ************** 自定义表单区域 ************** //

// 自定义表单区域排序
o_dropzone.sortable({
    // 如果定义了该选项，项目只能在水平或垂直方向上被拖拽。可能的值："x", "y"。
    axis: 'y',
    cursor: "move",
    // 调试方式
// revert: 100000,
    // 鼠标按下后直到排序开始的时间，以毫秒计。该选项可以防止点击在某个元素上时不必要的拖拽。
    delay: 100
}).disableSelection();

// 自定义表单区域拖拽排序事件
o_dropzone.on({
    // 在排序期间触发该事件
    sortstart: function (event, ui) {
    	// 判断是否有节点，如果没有节点则去除empty样式
		// 移除空提示样式
		removeEmptyNotice();
       
		// item 表示当前被拖拽的元素
        if (!ui.item.hasClass('drop-field')) {
            return
        }
        // 显示黄色占位图
        ui.placeholder.css('visibility', 'visible')
        // 移除此样式，方式样式的干扰
        ui.helper.removeClass('ui-draggable-handle');
    },
    // 当一个 sortable 项目移动到一个 sortable 列表时触发该事件
    // 站位视图展现
    sortover: function (event, ui) {
        // 标记内容
        if (ui.helper.hasClass('drop-field')) {
            return
        }
        // ******** 设置拖拽后空白占位图 ******** //
        // 获取元素类型, 并获取其对应的包裹节点内容
        var type = getUiType(ui);
        var wrapper = forms.wrapper;
        var o_wrapper = $(wrapper);

        // placeholder 要应用的 class 名称，否则为白色空白
        var height = o_wrapper.css('height');
        ui.placeholder.addClass('drop-field').css({
            height: height,
            width: '100%',
            // 显示placeholder的黄色占位图
            visibility: 'visible'
        });
        // 去除/设置被拖拽中wrapper的样式
        o_wrapper.css({
            width: ui.placeholder.css('width'),
            height: height,
            border: 'none',
            'box-shadow': 'none'
        });
        // helper是正在被拖拽的元素
        var helper = ui.helper;
        // 高度限定60px
        helper.css('height', 60);
        // helper.append(o_wrapper);
    },
    // dom发生改变的时候记录原始索引位置， 更改form_datas的位置内容
    sortchange: function (event, ui) {
        var item = ui.item;
        // 混合ID
        var mixed_id = item.attr('id');
        if (typeof mixed_id !== "undefined")
    	{
        	 // 最纯净的ID 也是原索引
            var old_index = getPureID(mixed_id);
            // 记录
            DOM_INDEX = old_index;
    	} else {
    		DOM_INDEX = false;
    	}
    },
    sortout: function() {
    	// 加延迟是为了让占位的li影响节点长度的判断
    	setTimeout(function() {
    		// 添加空样式提示内容
    		addEmptyNotice();
    	}, 300);
    },
    // 当用户停止排序且 DOM 位置改变时触发该事件。
    sortupdate: function (event, ui) {
        // 清除自带的style样式
        var item = ui.item;
        item.removeClass('moduleL');
        item.removeAttr('style');
        // 更改json节点内容
        var index = item.index();
        var self = $(this);
        var type = getUiType(ui);
        if (DOM_INDEX !== false) {
            // 移除原来的节点
            delDomJson(DOM_INDEX);
        }
        // 在新的位置增加节点
        changeDomJson(item, type, index)
        // 批量更新内容
        batchMainSetting();
        // 初始化组件
        initComponents(type);
        DOM_INDEX = false;
        // 清除当前表单的选中样式，将当前标识清空
        removeFocus();
        // 当前拖拽组件进行高亮显示
        item.trigger('click');
    }
});

// 点击操作中的上移下移等按钮
o_dropzone
// 节点上移
    .on('click', up_field_selector, function () {
        var self = $(this);
        upField(self);
        // 聚焦节点自动点击
        removeFocus();
    }).on('click', down_field_selector, function () {
    // 节点下移
    var self = $(this);
    downField(self);
    // 聚焦节点自动点击
    removeFocus();
}).on('click', hide_field_selector, function () {
    // 隐藏元素
    alert('hidden')
}).on('click', del_field_selector, function () {
    // 移除元素
    var self = $(this);
    // 得到外层的li
    var o_li_wrapper = getClosestWrapper(self);
    // 得到索引值
    var index = o_li_wrapper.index();
    // 删除当前的li元素节点
    delField(self);
    // 批量设置id和action
    batchMainSetting();
    // 删除存储数据的数组内容
    delFormData(index);
    // 删除对应组件
    var type = o_li_wrapper.data('type');
    var token = o_li_wrapper.data('token');
    // 删除当前标识，防止移除组件后再添加的时候，组件的数据未更改问题
    setCurrentIndex("");
    // 移除组件内容
    removeComponents(type, token);
    // 当前组件是focus状态，则隐藏右侧的tips
    var is_focus = self.closest('.drop-field').hasClass('focus');
    if (is_focus)
    {
    	hideTips();
    }
    
    // 添加空样式提示内容
	addEmptyNotice();
});

// 表单区域按钮保存
o_form_btn.click(function () {
	// 开启环载
	$.loading.start();
    var select_index = getCurrentIndex();
    // 没有选中任何内容
    if (select_index === "") {
        return false;
    }
    // 标记是全局还是自定义
    saveFormSerialize(select_index);
    // 结束环载
    $.loading.stop();
    // 提示信息
    $.msg('保存成功');
});


// ----------- 多选/单选 选项管理 ----------- //
// 添加多选选项
o_save_form.on('click', '.checkbox-add', function () {
    var o_checkbox_item = getComponentItemObj(TYPE_CHECKBOX);
    o_checkbox_list.append(o_checkbox_item);
}).on('click', '.checkbox_item_list .del', function () {
	// 移除多列表条目
    var self = $(this);
    // 不能少于一个
    var childs = self.closest('.image-choice').children('.image-choice-box');
    if (childs.length == 1)
    {
    	return false;
    }
    self.closest('.image-choice-box').remove();
}).on('click', '[name="radio_list"]', function () {
    // 默认选中
    var self = $(this);
    var index = self.closest('.image-choice-box').index();
    self.attr('data-default', index);
}).on('click', '.radio-add', function () {
    // 添加单选选项
    var o_radio_item = getComponentItemObj(TYPE_RADIO);
    o_radio_list.append(o_radio_item);
}).on('click', '.radio_item_list .del', function () {
	// 移除单选列表条目
    var self = $(this);
    // 不能少于一个
    var childs = self.closest('.image-choice').children('.image-choice-box');
    if (childs.length == 1)
    {
    	return false;
    }
    self.closest('.image-choice-box').remove();
});
// 单选列表可以拖拽
o_radio_list.sortable({
    axis: 'y',
    cursor: "move",
    delay: 100
}).disableSelection();
// 多选列表可以拖拽
o_checkbox_list.sortable({
    axis: 'y',
    cursor: "move",
    delay: 100
}).disableSelection();

// ************** 方法区域 ************** //
/**
 * 判断当前拖拽区域是否有节点内容
 */
function isEmptyField() {
	return o_dropzone.find('.drop-field').length == 0;
}

/**
 * 移除empty提示样式
 */
function removeEmptyNotice()
{
	// 如果是空节点内容
	// 触发场景：当放置区域没有任何组件的时候，将组件拖拽上去的时候，将空提示移除
	if(isEmptyField())
	{
		o_dropzone.removeClass('empty-field');
	}
}
/**
 * 当点击的时候，移除空提示
 */
function clickRemoveEmptyNotice() 
{
	if(!isEmptyField())
	{
		o_dropzone.removeClass('empty-field');
	}
}

/**
 * 移除所有focus样式
 */
function removeAllFocus() 
{
	$('.focus').each(function() {
    	$(this).removeClass('focus');
    });
}

/**
 * 加入empty提示样式
 */
function addEmptyNotice()
{
	// 如果是空节点内容
	if(isEmptyField())
	{
		o_dropzone.addClass('empty-field');
	}
}
/**
 * @param ui
 *            Object 获取当前对象的type
 */
function getUiType(ui) {
    var type = ui.item.data('type');
    return type;
}

/**
 * 批量设置自定义表单内容
 */
function batchMainSetting() {
    o_dropzone.children('li').each(function (key, val) {
        var self = $(this);
        // 批量设置ID
        setFieldId(self, key);
        // 批量设置action
        setAtions(self);
    });
}

// ************* 更改对应位置的json数据 意味着替换顺序 ************* //
/**
 * 
 * @param item
 *            Object 当前对象
 * @param ui
 *            string 类型
 * @param index
 *            int 索引值
 */
function changeDomJson(item, type, index) {
    // 获取对应form_key下的json数据
    var new_json = JSON.parse(forms[type]['json']);
    // 插入json
    form_datas.splice(index, 0, new_json);
    convertJson2Field(item, new_json);
}

/**
 * 删除原节点的数据
 * 
 * @param int
 *            index 索引
 */
function delDomJson(index) {
    form_datas.splice(index, 1);
}

// ************* 根据json创建表单元素 ************* //
/**
 * @param item
 *            Object|null 当前对象 => item object 是拖拽式添加元素 => item null 是点击式添加元素
 * @param json
 *            string json数据
 */
function convertJson2Field(item, json) {
    if (!json) return;
    if (item) {
        item.addClass('drop-field');
        item.empty();
    }
    // 获取dom内容, 并转为jq对象
    var type = json.type;

    var o_dom = $(forms[type]['dom']);
    // 标题
    var o_qs_title = o_dom.find('.question-title');
    // 内容
    var o_qs_content = o_dom.find('.question-conent');
    // 是否必须
    var o_require = o_qs_title.find('.required');
    o_require.hide();
    // 标题内容区域
    var o_qs_id = o_qs_title.find('.q-title');
    o_qs_id.text(json.label);
    // 底部描述
    o_qs_desc = o_dom.find('.help-block');
    o_qs_desc.hide();
    // 动作
    var field_actions = $(forms['actions']);
    o_dom.append(field_actions);

    if (item) {
        item.append(o_dom);
    } else {
        var wrapper = forms.wrapper;
        var o_wrapper = $(wrapper);
        // 设置初始样式
        o_wrapper.addClass('ui-draggable ui-draggable-handle drop-field');
        // 设置type
        o_wrapper.attr('data-type', type);
        // 移除li的样式
        o_wrapper.removeAttr('style').append(o_dom).appendTo(o_dropzone);
    }
}

/**
 * 批量设置id
 * 
 * @param obj
 *            当前li对象
 * @param id
 *            当前索引
 */
function setFieldId(obj, id) {
    obj.attr('id', 'f' + id);
}

// ********* 上移，下移 focus样式改变 ********* //
function removeFocus()
{
	o_center_form.find('.focus').removeClass('focus');
	hideTips();
	// 丢弃当前标识
	setCurrentIndex("");
}

// ********* 隐藏右侧的tips ********* //
function hideTips()
{
	o_jt.removeClass('show').addClass('hide');
	o_tips.removeClass('show').addClass('hide');	
}

// ************* 节点上移 ************* //
/**
 * @param o_up_btn
 *            上移按钮
 */
function upField(o_up_btn) {
    // 找到当前.field元素
    var o_field = o_up_btn.closest('.drop-field');
    // 找到上一个节点
    var o_prev = o_field.prev();
    if (!o_prev) {
        return;
    }
    // insertBefore
    o_field.insertBefore(o_prev);
    // 重置内容
    batchMainSetting();

    // 置换节点位置
    var tpl_id = getTplID(o_field);
    swapDomPosition(tpl_id, 1);
}

// ************* 节点下移 ************* //
function downField(o_up_btn) {
    // 找到当前.field元素
    var o_field = o_up_btn.closest('.drop-field');
    // 找到上一个节点
    var o_next = o_field.next();
    if (!o_next) {
        return;
    }
    // insertAfter
    o_field.insertAfter(o_next);
    // 重置内容
    batchMainSetting();

    // 置换节点位置
    var tpl_id = getTplID(o_field);
    swapDomPosition(tpl_id, -1);
}

// ************* 删除节点 ************* //
function delField(o_del_btn) {
    o_del_btn.closest(li_wrapper_selector).remove();
}

// ************* 上下移图标 ************* //
// 获取当前li的索引值, 如果是0 则不可以上移
// 如果时候length-1 则不可以下移
function setAtions(current, action) {
    // 获取当前li的索引值, 如果是0 则不可以上移
    // 如果时候length-1 则不可以下移
    var index = current.index();
    // 获取li的总长度
    var total_size = o_dropzone.find('li.drop-field').length;
    // 如果没有传递handle 则从current中获取
    if (!action) {
        action = current.find(action_selector);
    }
    // 第一个节点不可以上移
    var o_up = action.find(up_field_selector);
    if (index == 0) {
        o_up.addClass('hide');
    } else {
        o_up.removeClass('hide');
    }
    // 最后一个节点不可以下移
    var o_down = action.find(down_field_selector);
    if (index == (total_size - 1)) {
        o_down.addClass('hide');
    } else {
        o_down.removeClass('hide');
    }
}

// ************* 删除存储数据的数组内容 ************* //
function delFormData(index) {
    form_datas.splice(index, 1);
}

// ************* 得到其li.drop-field ************* //
function getClosestWrapper(obj) {
    return obj.closest(li_wrapper_selector);
}

// ************* 设置当前选中标识 ************* //
function setCurrentIndex(index) {
    o_current_slector.val(index);
}

// ************* 获取当前选中标识 ************* //
function getCurrentIndex() {
    return o_current_slector.val();
}

// ************* 获取当前选中的对象 ************* //
function getCurrentObj() {
    var currentIndex = getCurrentIndex();
    return getObjById(currentIndex);
}
// ************* 获取当前选中的对象的数据 - 必须是自定义组件 form_datas下的内容 ************* //
function getCurrentData()
{
	// 当前的索引值
	var currentIndex = getCurrentIndex();
	// 当前的索引值对应的对象
	var currentData = form_datas[currentIndex]
	
	if (currentIndex && currentData)
	{
		return {
			"index": currentIndex,
			"data": currentData
		};
	}
	return null;
}

// ************* 元素是否在数组中 ************* //
/**
 * 判断ele是否在arr中
 * 
 * @param arr
 * @param ele
 * @return boolean
 */
function inArray(ele, arr) {
    // 获取数组长度
    var len = arr.length;
    if (len == 0) {
        return false;
    }
    // 定义标识并遍历数组
    var flag = false;
    for (var i = 0; i < len; i++) {
        if (arr[i] == ele) {
            flag = true;
        }
    }
    return flag;
}

// ************* 得到表单数据 ************* //
/**
 * 保存表单数据
 * 
 * @param key
 *            当前选择的类型 current_index 0-是代表表单拖拽数据 字符串-是代表固定不变的顶部数据
 * @param type
 *            可能是undefined 未来是 1|2 代表着顶部数据或者表单拖拽数据
 */
function saveFormSerialize(key, type) {
    if (typeof type === 'undefined') {
        type = getDataType(key);
    }
    // 获取存储的json数据内容
    var json_obj = getInitialFormData(key, type);
    for (var name in json_obj) {
        // type字段是标识, 不算属性中,
        // zoom的存储放在了location中
    	// bodybg 在bodybg_type 中被计算
        if (name === 'type' || name === 'zoom' || name === 'bodybg') {
            continue;
        }
        
        // 组件的类型
        var component_type = json_obj.type;
        
        var o_cell = getObjByName(name);
        var val = o_cell.val();
        // body背景色、图片
        if(name === 'bodybg_type') {
        	var o_bodybg_type = getObjByName('bodybg_type');
        	var val = o_bodybg_type.val();
        	var content = '';
        	if (val == 0) {
        		// 背景图
        		var url = $('#bg_img').val();
        		if (url == '')
    			{
        			$.msg('请选择背景图片');
            		return;
    			}
        		content = url;
        	} else {
        		// 背景色
        		var color = $("#bg_color_picker").val();
        		if (color == '')
    			{
        			$.msg('请选择背景颜色');
            		return;
    			}
        		content = color;
        	}
        	json_obj['bodybg_type'] = val;
        	json_obj['bodybg'] = content;
        	continue;
        }
        
        // 最少填写
        if('v_minlength_con' === name) {
        	if(!isValidLength(val)) {
        		$.msg('最少填只能是大于0的正整数');
        		return false;
        	}
    	}
        // 最多填写
        if('v_maxlength_con' === name) {
        	if(!isValidLength(val)) {
        		$.msg('最多填只能是大于0的正整数');
        		return false;
        	}
        } 
        // 头部图片必须填写
		// if (name === 'header' && $.trim(val) === '')
		// {
		// // 必须填标题
		// $.msg('请选择顶部图片');
		// return;
		// }
        
        // 校验标题
        if (name === 'title' && !inArray(component_type, noneed_title) && $.trim(val) === '')
    	{
        	// 必须填标题
    		$.msg('请填写当前组件的标题');
    		return;
    	}
        
        // description 是描述详情, 是特殊的类型
        if (name == 'description') {
        	// ----> 发现编辑器的bug全选快速删除无法触发change事件
			// if (editor)
			// {
			// var timing_val = editor.html();
			// if (timing_val != val)
			// {
			// val = timing_val;
			// }
			// }
			//        	
			// // wangeditor 默认会有这样的标签组
			// if(val == '<p><br></p>')
			// {
			// val = '';
			// }
        	if (editor)
        	{
        		val = editor.html();
        		if(editor.isEmpty())
        		{
        			val = '';
        		}
        	}
    		
            json_obj[name] = val;
            continue;
        }
        // 级联下拉
        if (name === 'address') {
            // 获取详细地址对象
            var o_address_detail = getObjByName('address_detail');
            json_obj[name]['address_detail'] = o_address_detail.val();

            // 获取地址code
            var o_address_code = getObjByName('address_code');
            json_obj[name]['address_code'] = o_address_code.val();

            // 获取地址文本
            var o_address_text = getObjByName('address_text');
            json_obj[name]['address_text'] = o_address_text.val();

            continue;
        }

        // 经纬度
        if (name === 'location') {
            // 设置缩放
            var o_zoom = getObjByName('zoom');
            var zoom = $.trim(o_zoom.val());
            zoom = parseInt(zoom);
            json_obj['zoom'] = zoom;

            // 显示地图数据
            var o_tpl = getObjById(key);
            var token = o_tpl.data('token');
            if (!token) {
                continue;
            }
            // 根据token获取地图信息 - 设置地图缩放级别
            var o_map = getMapObj(token);
            o_map.setZoom(zoom);
            
            continue;
        }

        // items是单选列表|多选列表数据
        if (name === 'items' && (component_type === 'radio' || component_type === 'checkbox' || component_type === 'select')) {
            if (component_type === 'select') {
                component_type = 'radio';
            }
            var items = [];
            var item_list_selector = '.' + component_type + '_item_list';
            var o_item_list = $(item_list_selector);
            var item_list = o_item_list.find('.image-choice-box');
            item_list.each(function () {
                var self = $(this);
                // 选框内容
                var content_selector = '.' + component_type + '_content';
                var content = self.find(content_selector).val();
                
                // 如果选框的内容是空，则不存储
                if ($.trim(content) != '')
                {
	                var tmp = {};
	                // 选框状态
	                var checked_selector = '.' + component_type + '_checked';
	                var checked = self.find(checked_selector).prop('checked');
	                if (checked) {
	                    tmp['checked'] = 1;
	                } else {
	                    tmp['checked'] = 0;
	                }
	                tmp['val'] = content;
	                items.push(tmp);
                }
            });
            json_obj['items'] = items;
            continue;
        }
        
        if ('title' === name) 
        {
        	// 设置悬浮tips顶部标题
        	setTipsTitle(val);
        }
        
        var cell_type = o_cell.data('type');
        switch (cell_type) {
            case "input":
                json_obj[name] = val;
                break;
            case "checkbox":
                if (o_cell.prop('checked')) {
                    json_obj[name] = 1;
                } else {
                    json_obj[name] = 0;
                }
                break;
        }
    }
    // 最多 >= 最少
    if ('v_maxlength_con' in json_obj && 'v_minlength_con' in json_obj) {
    	var v_maxlength_con = json_obj['v_maxlength_con'];
    	var v_minlength_con = json_obj['v_minlength_con'];
    	if (v_maxlength_con !='' && v_minlength_con != '' && parseInt(v_maxlength_con) < parseInt(v_minlength_con)) {
    		$.msg('最多填应该不小于最少填');
    		return false;
    	}
    }

    // var stringify = JSON.stringify(json_obj);
    // 显示保存数据后 模板修改变化效果
    setTplData(json_obj, type);
    // 保存数据
    setData(key, json_obj, type);
}

// ************* 获取表单初始化数据 ************* //
/**
 * @param string
 *            key 索引
 * @param int
 *            type 1|2 1-全局数据 2-自定义表单数据
 */
function getInitialFormData(key, type) {
    var content;
    if (type == is_global) {
        content = global_form_datas[key];
    }
    if (type == is_custom) {
        content = form_datas[key];
    }
    if (!content) {
        return {};
    }
    if (typeof content === 'string') {
        // 保存表单数据
        var json_obj = JSON.parse(content);
    }
    if (typeof content === 'object') {
        json_obj = content;
    }
    return json_obj;
}

// ************* 设置提交表单数据 ************* //
function setData(key, val, type) {
    var obj = getTargetDatas(type);
    obj[key] = val;
}

// ************* 获取提交表单数据 ************* //
function getData(key, type) {
    if (typeof type === 'undefined') {
        type = getDataType(key)
    }
    var obj = getTargetDatas(type);
    return obj[key];
}

// ************* 设置右侧弹窗标题数据 ************* //
// 如果标题过长，则截断
function setTipsTitle(title) {
	if (title.length > TIPS_TITLE_LENGTH)
	{
		title =  title.substr(0, TIPS_TITLE_LENGTH) + ' ……';
	}
	o_tips_title.text(title);
}

/**
 * 获取forms中的节点原始数据
 * 
 * @param key
 */
function getFormNode(key) {
    var data_type = getDataType(key);
    if (data_type == is_global) {
        return global_forms[key];
    } else {
        return forms[key];
    }
}
/**
 * 切换标题下的提示，主题和组件的标题提示不一样
 */
function switchTitleBlock(type) {
	// 主题提示
	var o_header_block = $('.header-title-block');
	// 组件提示
	var o_component_block = $('.component-title-block');
	
	if ("page_title"=== type) {
		o_header_block.show();
		o_component_block.hide();
	} else {
		o_header_block.hide();
		o_component_block.show();
	}
}

/**
 * 切换详情下的提示，主题和组件的标题提示不一样
 */
function switchDescBlock(type) {
	// 主题提示
	var o_header_block = $('.header-desc-block');
	// 组件提示
	var o_component_block = $('.component-desc-block');
	
	if ("page_desc"=== type) {
		o_header_block.show();
		o_component_block.hide();
	} else {
		o_header_block.hide();
		o_component_block.show();
	}
}
// ************* 获取数据的类型 ************* //
/**
 * 根据唯一的id标识 获取数据类型
 * 
 * @param key
 *            string
 * @return int
 */
function getDataType(key) {
    if (inArray(key, global_types)) {
        return is_global;
    }
    return is_custom;
}

// ************* 判断当前类型并返回对应的数据集 ************* //
/**
 * @param type
 *            int 类型 1 是全局 2 是自定义
 * @return object
 */
function getTargetDatas(type) {
    if (type == is_global) {
        return global_form_datas;
    } else {
        return form_datas;
    }
}

// ************* 保存表单后设置页面中的模板数据 ************* //
/**
 * @param data
 *            array 表单数据
 * @param type
 *            int 全局数据的话 data是object 否则是 array
 */
function setTplData(data, type) {
    // 标题部分
    if (type == is_global) {
        for (var key in data) {
            // type不再规划中
            if (key === 'type' || key === 'bodybg') {
                continue;
            }
            var o_unique = getTplUnique(key);
            var value = data[key];
            // body背景色、图片
            if(key === 'bodybg_type') {
            	// 获取内容
            	o_body.removeAttr('style');
            	var content = data['bodybg'];
            	// 背景图
            	if (value == 0)
            	{
            		o_body.css('background-image', "url(" + content + ")");	
            	} else{
            		o_body.css('background-color', content);	
            	}
            	continue;
            }
            /**
			 * // 表单背景色 if(key === 'formbg') {
			 * o_center_form.css('background-color', value); continue; }
			 */
            // header是头部图片
            if (key == 'header') {
            	if ('' == value) {
            		value = default_img;
            	}
            	o_unique.find('img').attr('src', value);
                continue;
            }
            // 模板标题和描述
            if (key === 'title' || key=== 'description')
            {
                o_unique.html(value);
                continue;
            }
        }
    } else {
        // 根据当前索引得到对应的模板对象内容
        var current_index = getCurrentIndex();
        var o_tpl = getObjById(current_index);
        // 得到当前模板对象的type类型
        var tpl_type = o_tpl.data('type');
        // 遍历表单存储数据
        for (var name in data) {
            var o_unique = getTplUnique(name);
            var unique_type = o_unique.data('type');
            var val = data[name];
            // 单选选择列表内容
            if (name === 'items' && (unique_type === 'radio' || unique_type === 'checkbox' || unique_type === 'select')) {
                var radio_items = '';
                // 获取单选列表的列表数据
                var items = data['items'];
                for (var key in items) {
                    var item = items[key];
                    var flag = (item.checked == 1);
                    var checked = flag ? 'checked' : '';
                    // select 单个下拉框选中是selected
                    if (unique_type === 'select') {
                        checked = flag ? 'selected' : '';
                    }
                    var item_html = '';
                    switch (unique_type) {
                        case 'radio':
                            item_html = '<li><label class=""><input class="disabled" disabled type="radio" ' + checked + ' name="option">' + item.val + '</label></li>';
                            break;
                        case 'checkbox':
                            item_html = '<li><label class=""><input class="disabled" disabled type="checkbox" ' + checked + ' name="option[]">' + item.val + '</label></li>';
                            break;
                        case 'select':
                            item_html = '<option ' + checked + '>' + item.val + '</option>'
                            break;
                    }
                    radio_items += item_html
                }
                o_unique.html(radio_items);
                continue;
            }
            // 级联地址组件
            if (name === 'address') {
                // 详细地址
                var o_address_detail = getTplUnique('address_detail');
                var address = val;
                o_address_detail.val(address.address_detail);
                // 省市县
                var o_address_code = getTplUnique('address_code');
                var code = address['address_code'];
                // 根据, 切割
                var clazzs = {'0': '.province', '1': '.city', '2': '.county'};

                var o_region_container = $('#region_container');
                var address_text = '';

                // 不超过三个
                for (var i = 0; i < 3; i++) {
                    // 获取当前右侧表单中选中
                	var o_selector = o_region_container.find('.render-selector').eq(i);
                	if (o_selector.length > 0) {
						var o_option = o_selector.find('option:selected');
						var option_val = o_option.val();
            		}
                  
                    var text = '-请选择-';
                    var o_obj = getCurrentObj();
                    // 级联内容选择才设置
                    if (option_val != '') {
                        text = o_option.text();
                    }
                    var class_name = clazzs[i];
                    if (class_name) {
                        o_obj.find(class_name).find('option').text(text);
                    }
                }

            }
            // 分割线 样式设置
            if (inArray(name, line_styles)) {
                // 获取分割线对象
                var o_unique = getTplUnique('dividing_line');
                var val = data[name];
                // 线宽
                if (name === 'line_width') {
                    o_unique.css('border-bottom-width', val);
                }
                // 线色
                if (name === 'line_color') {
                    o_unique.css('border-bottom-color', val);
                }
                // 线型
                if (name === 'line_shape') {
                    o_unique.css('border-bottom-style', val);
                }
                continue;
            }
            switch (unique_type) {
                // 显示隐藏类型
                case "display":
                    if (val == 1) {
                        o_unique.show();
                    } else {
                        o_unique.hide();
                    }
                    break;
                // 图片展示类型
                case "image":
                    var o_img = $('<img style="max-width: 100%">');
                    o_img.attr('src', val);
                    o_unique.html(o_img);
                    break;
                // 视频展示类型
                case "video":
                    var o_video = $('<video style="width: 100%;">');
                    // 地址需要链接前缀
                    // 地址前可能都有 /
                    // str.substr(start[, length])
                    if (val.substr(0, 1) == '/')
                	{
                    	val = val.substr(1);
                	}
                    // 拼接全路径
                    val = video_url_host + val; 
                    o_video.attr('src', val);
                    o_unique.html(o_video);
                    break;
                // 布局类型
                case "class":
                    var o_ul = o_unique.find('ul');
                    var className = 'inline';
                    if (val == 'inline') {
                        o_ul.addClass(className);
                    } else {
                        o_ul.removeClass(className);
                    }
                    break;
                // 文本类型
                case "text":
                    o_unique.html(val);
                    if (val != '') {
                        o_unique.show();
                    }
                    break;
                // 输入框类型
                case "input":
                    o_unique.val(val);
                    break;
            }
        }
    }
}

// ************* 获取模板唯一标识 ************* //
// data-unique 必须与表单的name属性相对应
function getTplUnique(key) {
    var current_index = getCurrentIndex();
    var current_type = getDataType(current_index);
    if (current_type == is_global) {
        return $('#f' + current_index);
    } else {
        return $('#f' + current_index).find('[data-unique="' + key + '"]');
    }
}

// ************* 设置右侧表单编辑器 ************* //
/**
 * 设置右侧数据
 * 
 * @param key
 *            是input, textarea
 * @param id
 *            string f0或者fpage_desc
 */
function setFormEditor(key, id) {
    // 获取id
    var data_id = trimPrefix(id);
    // 显示当前组件该有的内容
    var obj = getObjById(data_id);
    var data_type = obj.data('type');
    setEditorTpl(data_type);
    // 回显视图,编辑器的内容
    setEditorData(data_id);
}

// ************* 设置编辑器的内容 [回显] ************* //
/**
 * 此key是id数据 比如 0 或者 page_desc
 * 
 * @param key
 *            string
 */
function setEditorData(key) {
    // 获取是顶部数据还是拖拽自定义数据
    var type = getDataType(key);
    // 获取对应的json数据
    var setting_datas = getInitialFormData(key, type);
    if (setting_datas) {
        // 设置表单头部标题
        var form_title = setting_datas.title;

        var component_type = setting_datas.type;
        // page_desc | page_header 没有title
        if (component_type === 'page_desc') {
            form_title = '描述';
        }
        if (component_type === 'page_header') {
            form_title = '顶部设置';
        }
        o_tips_title.text(form_title);
        // 顶部组件
        if (type == is_global) {
            // 是对象
            for (var name in setting_datas) {
                var val = setting_datas[name];
                // description是编辑器内容
                if (name === 'description') {
                	// 切换描述的提示
                	switchDescBlock('page_desc');
                    // 编辑器追加内容
                    if (editor) {
						// if(editor.isEmpty())
						// {
						// // 编辑器内容 默认会有 <p><br></p>
						// val = '<p><br></p>';
						// }
						// // 模板描述四个字不能单纯的放入编辑器 需要被p标签包裹
						// if (val == '模板描述')
						// {
						// val = '<p>模板描述</p>';
						// }
                        editor.html(val);
                    }
                }
                // 全局背景类型
                if(name === 'bodybg_type')
                {
                	// 设置选中
                	$('#bodybg_type').val(val).trigger('change');
                	// 设置颜色
                	if(val == 1) {
                		$('#bg_color_picker').colorpicker({
                            color: setting_datas['bodybg']
                        });
                	}
                }
                // 设置tips的标题内容
                if ('title' === name) 
            	{
                	switchTitleBlock('page_title');
            		setTipsTitle(val);
            	}
                // 设置常规表单元素内容
                var o_target = $('[name="' + name + '"]');
                switch (name) {
                    // 图片预览
                    case 'header':
                        // 创建预览图
                        setImgPreview(o_target, val);
                        break;
                }
                o_target.val(val);
            }
            // 自定义拖拽组件
        } else {
            for (var name in setting_datas) {
                if (name === 'zoom') {
                    continue;
                }
                // 根据name获取右侧tips中内容
                var o_tpl = getObjByName(name);
                // 获取name对应对象的type类型
                var type = o_tpl.data('type');
                // 单选列表|多选列表数据|下拉框
                if (name === 'items' && (component_type === 'radio' || component_type === 'checkbox' || component_type === 'select')) {
                    // 下拉框也与radio一样
                    if (component_type === 'select') {
                        component_type = 'radio';
                    }
                    var item_data = setting_datas[name];
                    var item_selector = '.' + component_type + '_item_list';
                    var o_item_list = $(item_selector);
                    o_item_list.html('');
                    // 动态生成每一组内容
                    $(item_data).each(function (i, v) {
                        var flag = (v.checked == 1);
                        var val = v.val;
                        var o_item = getComponentItemObj(component_type);
                        // 选项
                        var checked_selector = '.' + component_type + '_checked';
                        var content_selector = '.' + component_type + '_content';
                        o_item.find(checked_selector).prop('checked', flag);
                        // radio的内容
                        o_item.find(content_selector).val(val);
                        o_item_list.append(o_item);
                    });
                    continue;
                }
                // 获取对应的值
                var val = setting_datas[name];
                if (name === 'address') {
                    // 设置右侧的级联
                    if (selector_setting) {
                        selector_setting.value = val.address_code;
                        o_region_container.regionselector(selector_setting).reload();
                    }
                    // 设置右侧详细地址
                    var o_tpl = getObjByName('address_detail');
                    o_tpl.val(val.address_detail);
                    continue;
                }
                // 分割线颜色
                if ('line_color' === name) {
                	$('#color-picker').colorpicker({
                        color: val
                    });
                }
                // 横纵向
                if (name === 'layout') {
                    // 动态显示横纵向布局内容
                    var o_inline = o_layout_items.find('[data-layout="inline"]');
                    if (val === 'inline') {
                        o_inline.addClass('selected').siblings().removeClass('selected');
                    } else {
                        o_inline.removeClass('selected').siblings().addClass('selected');
                    }
                    continue;
                }
                // 图片回显
                if(name === 'image_url') {
                	// imagegroup销毁，重新创建内容
                	$('#image_url_container').remove();
                	// dom内容
                	var new_container = $('<div id="image_url_container" data-id="image_url" class="szy-imagegroup" data-size="1"></div>');
                	// 将新的dom插入到页面中
                	$('#image_url_box').append(new_container);
                	// 隐藏连接内容
                	var o_image_url = $('#image_url');
                	// 设置内容
                	o_image_url.val(val);
                	// 重新初始化imagegroup内容
                	new_container.imagegroup({
                		host: image_url_host,
                		size: $(this).data("size"),
                		values: val.split("|"),
                		gallery: true,
                		// 回调函数
                		callback: function(data) {
                			var url = '';
                			if (data.src) {
                				url = data.src;
                			}
                			o_image_url.val(url);
                			$.validator.clearError(o_image_url);
                		},
                		// 移除的回调函数
                		remove: function(value, values) {
                			o_image_url.val("");
                		}
                	});
                	continue;
                }
                
                if (name === 'video_url')
            	{
                	// 移除视频组件内容，重新组装
                	$('#video_container').remove();
                	// dom内容
                	var new_container = $('<div id="video_container"></div>');
                	// 将新的dom插入到页面中
                	$('#video_url_box').append(new_container);
                	// 隐藏连接内容
                	var o_video_url = $('#video_url');
                	// 设置内容
                	o_video_url.val(val);
                	// 重新初始化videogroup内容
                	new_container.videogroup({
                		host: video_url_host,
                		values: [val],
                		gallery: true,
                		options: {
                			minDuration: video_min_duration,
                			maxDuration: video_max_duration,
                		},
                		callback: function(data) {
                			var values = this.getValues();
                			var value = values.length > 0 ? values[0] : "";
                			o_video_url.val(value);
                		},
                		remove: function() {
                			o_video_url.val("");
                		}
                	});
            	}
                // 提示内容
                if (name ==='title') {
                	switchTitleBlock()
                }
                
                // 编辑器内容
                if (name === 'description') {
                	// 切换描述的提示
                	switchDescBlock();
                    // 编辑器追加内容
                    if (editor) {
                    	// 编辑器内容需要回显
                        editor.html(val);
                        // 隐藏字段需要回显
                        // o_editor_description.val(val);
                    }
                    continue;
                }
                // 经纬度内容
                if (name === 'location') {
					// 设置输入框经纬度的值
                	var lat = setting_datas[name]['lat']; 
                	var lng = setting_datas[name]['lng']; 
                	
					// 缩放
					var zoom = setting_datas['zoom'];
					if (zoom) { 
						// 设置缩放级别
						o_map_scale.slider("value", zoom);
						
						// 设置缩放隐藏值
						var o_zoom = getObjByName('zoom');
						if (o_zoom && o_zoom.length == 1)
						{
							zoom = parseInt(zoom);
							o_zoom.val(zoom);
						}
						
						// 当前map
                        var currentObj = getCurrentObj();
                        var token = currentObj.data('token');
                        var o_map = getMapObj(token);
						o_map.setZoom(zoom);
					}
                	continue;
            	}
                // 其他内容
                switch (type) {
                    case "input":
                        o_tpl.val(val);
                        break;
                    case "checkbox":
                        var flag = (val == 1);
                        o_tpl.prop('checked', flag);
                        break;

                }
            }
        }
    }
}

/**
 * 设置编辑器该显示的组件内容
 * 
 * @param type
 *            string 组件类型 比如input, textarea
 */
function setEditorTpl(type) {
    // 得到节点数据
    var form_data = getFormNode(type);
    // 得到对应的json数据
    var form_json = JSON.parse(form_data.json);
    // 右侧tips表单中所有的组件
    o_save_form_wrapper.find('[data-key]').each(function (i, v) {
        $(this).hide();
    });
    var component_type = form_json.type;
    var o_basic_title = $('.basic_content').find('.operate-tit-sm');
    if (component_type === 'page_header')
    {
    	o_basic_title.show();
    } else {
    	o_basic_title.hide();
    }
    // 隐藏校验标题
    var o_validate_title = $('.validate_content').find('.operate-tit-sm');
    if (inArray(component_type, hide_validates)) {
        o_validate_title.hide();
    } else {
        o_validate_title.show();
    }
    // 隐藏布局设置标题
    var o_style_title = $('.style_content').find('.operate-tit-sm');
    if (inArray(component_type, hide_styles)) {
        o_style_title.hide();
    } else {
        o_style_title.show();
    }
    // 显示对应该显示的内容
    for (var key in form_json) {
        var obj = getObjByKey(key);
        obj.show();
        // 如果是带有列表数据
        if (key === 'items') {
            var o_items = o_save_form_wrapper.find('[data-key="items"]');
            // select 单个下拉框需要表单数据跟radio一样
            if (type === 'select') {
                type = 'radio';
            }
            // items有多个需要隐藏不是当前的items
            o_items.each(function (i, v) {
                var self = $(this);
                var current_type = self.data('type');
                if (current_type !== type) {
                    self.hide();
                }
            });
            continue;
        }
    }
}

/**
 * 数组转对象
 * 
 * @param arr
 *            Array
 */
function arr2Object(arr) {
    var obj = {};
    var len = arr.length;
    if (len > 0) {
        for (var i = 0; i < len; i++) {
            var name = arr[i]['name'];
            var value = arr[i]['value'];
            obj[name] = value;
        }
    }
    return obj;
}

// **************** 图片预览上传 ****************//
function localImgLoad() {
    var src = this.files[0];
    var self = $(this);
    var read = new FileReader();
    read.onload = function (e) {
        var res = e.target.result;
        // 隐藏区域加入内容
        $('[name="header"]').val(res);
        // 创建预览图
        setImgPreview(self, res);
    }
    read.readAsDataURL(src)
};

// **************** 单图图片预览图设置 ****************//
function setImgPreview(obj, val) {
    var o_img = $('<img src="' + val + '"/>');
    var o_image_preview = obj.parent().prev('.image-preview');
    var inner_width = o_image_preview.innerWidth();
    o_img.css({
        width: inner_width,
    });
    o_image_preview.append(o_img);
}

// **************** 获取tip的editor内容 ****************//
function getTipTpl(key) {
    return $.trim($('#tpl_' + key).html());
}

// **************** 去除id左侧内容 ****************//
function trimPrefix(id) {
    return id.substring(1);
}

// **************** 根据name获取对象 ****************//
/**
 * 根据name 返回[表单保存区域]的对象内容
 * 
 * @param name
 *            string 名称
 * @return Object name对应的jq对象
 */
function getObjByName(name) {
    var selector = '[name="' + name + '"]';
    return o_save_form.find(selector);
}

/**
 * 根据key 返回[表单保存区域]的对象内容
 * 
 * @param key
 *            string 名称 对应data-key的内容
 */
function getObjByKey(key) {
    var selector = '[data-key="' + key + '"]';
    return o_save_form.find(selector);
}

/**
 * 获取拖拽中心节点的模板对象
 * 
 * @param id
 *            string 是id的组成如果是数字 则f+key
 */
function getObjById(key) {
    return $('#f' + key);
}

/**
 * 判断val是否是数字类型
 * 
 * @returns {boolean}
 */
function isInt(val) {
    if (val === 0 || val === "0") {
        return true;
    }
    var con = Number(val);
    if (isNaN(con) || con === 0) {
        return false;
    }
    return true;
}
/**
 * 判断数字是否大于0且为正整数
 */
function isValidLength(val) {
	if (val == '') return true;
		
	var pattern = /^[1-9]\d*$/;
	return pattern.test(val);
}

/**
 * 隐藏校验栏
 */
function hideValidate() {
    o_validate_content.hide();
}

/**
 * 显示校验栏
 */
function showValidate() {
    o_validate_content.show();
}

/**
 * 初始化组件
 */
function initComponents(type) {
    $.loading.start();
    if (type === 'static_map') {
        // 查询所有的地图是否有ID, 如果没有ID 则视为没有初始化完成
        o_dropzone.find('.map_container').each(function () {
            var self = $(this);
            // 查找到其父类的容器
            var id = self.attr('id');
            // 则视为没有初始化完成, 进行地图初始化
            if (!id) {
                // 查看当前组件的外层包裹组件是否有 data-token的值
                var o_closet_wrapper = self.closest('.drop-field');
                var component_id = self.closest('.drop-field').attr('id');
                // 获取token
                var token = getMapToken(component_id);
                o_closet_wrapper.attr('data-token', token);
                // 获取ID
                var wrapper_id = o_closet_wrapper.attr('id');
                var pure_id = getPureID(wrapper_id);
                // 给当前map组件加上ID
                self.attr('id', 'map_container_' + token);
                self.addClass('map-init');
                // 根据id获取表单内容
                var data = form_datas[pure_id];
                initMap(token, data.location.lat, data.location.lng, data.zoom, data.place);
            }
        });
    }
    $.loading.stop();
}

/**
 * 初始化地图组件 外层的id 不能用原来的ID, 必须用一个不能更改的id, 采用时间戳来代替 让map的外层 map_container 拥有ID
 * id="container_(外层的ID)" 让其初始化script有唯一ID
 * 
 * @param id
 *            string|int tpl组件的ID
 * @param lat
 *            经度
 * @param lng
 *            纬度
 */
function initMap(token, lat, lng, zoom, marker_text) {
    // 除了 textLable外, 所有参数都要设置
    if (!token || !lat || !lng || !zoom) {
        return;
    }
    // 映射的key
    var map_name = getMapkey(token);
    var text_marker_name = getMapMarkerKey(token);
    
    // zoom必须是int 不能是string
    zoom = parseInt(zoom);
    // 地图组件
    static_maps[map_name] = new AMap.Map("map_container_" + token, {
    	// 2d的zoom会返回整数，而3d的zoom可能是浮点数
        viewMode: '2D',
        zoom: zoom,
        zooms: [3, 17],
        resizeEnable: true,
        scrollWheel: false,
        dragEnable: true,
        center: [lng, lat], // 地图中心点
    });
    // ---------------- 地图事件 ---------------- //
    // 地图点击，将地图进行平移， 以及将点标记在点击点上
    static_maps[map_name].on('click', function(e) {
    	var self = this;
    	// ---------- 第一次点击不改变地址 ---------- //
    	var o_container =  getMapContainer(self);
    	if (o_container.length == 0)
    	{
    		return false;
    	}
    	if (!o_container.hasClass('focus'))
		{
    		return false;
		}
    	
    	// 获取当前点击的经纬度
    	var lnglat = e.lnglat;
    	var lng = lnglat.lng;
    	var lat = lnglat.lat;
    	
    	// 将点标记在点击点上
    	var o_lnglat = new AMap.LngLat(lng,lat);
    	if (static_maps[text_marker_name])
    	{	
    		// 标记点
    		static_maps[text_marker_name].setPosition(o_lnglat)
    		// 标记点窗体
    		var text = getMakerText();
    		openMapWindowInfo(text, self, static_maps[text_marker_name]);
    	}
    	
    	// 点击标注点会修改地图的坐标点
    	var id =o_container.attr("id");
    	if (id)
		{
    		// 修改表单数据内容
			var pure = getPureID(id);
			var data = getInitialFormData(pure, 2);
			// 设置zoom
			if (data && data.location && typeof data.location === 'object')
			{
				// 更改中心点
				data.location.lat = lat;
				data.location.lng = lng;
				form_datas[pure] = data;
			}
		}
		// 地图进行同等平移
    	this.panTo(o_lnglat)
    });
    
    // ---------------- marker事件 ---------------- //
    // 点标注
    static_maps[text_marker_name] = new AMap.Marker({
        position: new AMap.LngLat(lng, lat),
        // 小图标的高度是 19 * 33
        offset: new AMap.Pixel(-10, -33),
        // draggable
        draggable: true
    });
    
    // 点标注 点击事件
    static_maps[text_marker_name].on( "click", function(e) {
    	var self = this;
    	// ---------- 弹出窗体信息 ---------- //
    	// 获取当前的map信息
    	var o_map = self.getMap();
    	if(o_map)
		{
    		var text = getMakerText();
    		if (text!="")
    		{
    			openMapWindowInfo(text, o_map, self);
    		}
		}
    });
    
    // 点击标注，弹出窗体信息
    static_maps[map_name].add(static_maps[text_marker_name]);
    
    // 打开窗体信息
    openMapWindowInfo(marker_text, static_maps[map_name], static_maps[text_marker_name]);
}

/**
 * 移除组件
 */
function removeComponents(type, token) {
    if (type === 'static_map') {
        removeMap(token);
    }
}

/**
 * 根据ID获取对应的map对象
 */
function getMapByID(id) {
	if (!id) return null;
	var o_map_container = $('#'+id).find('.map_container');
	if (o_map_container.length == 0) return null;
	// map_container_t1539754188_f2 ， map的则是map_t1539754188_f2 丢弃_container
	var map_id = o_map_container.attr('id');
	var map_name = map_id.replace("_container", "");
	return static_maps[map_name];
}

/**
 * 获取地图外层包裹对象
 * 
 * @param object
 *            self 地图对象
 */
function getMapContainer(self)
{
	var container = self.getContainer();
	if (!container) return false;
	var o_container =  $(container).closest('.drop-field');
	return o_container;
}
/**
 * 移除地图 token
 */
function removeMap(token) {
    // 销毁移除组件
    var o_map = getMapObj(token);
    var o_marker = getMapMarkerObj(token);
    o_map.remove(o_marker);
    o_map.destroy();
    // 从static_map中移除了
    var map_key = getMapkey(token);
    var marker_key = getMapMarkerKey(token);
    delete static_maps[map_key];
    delete static_maps[marker_key];
}

/**
 * 得到最纯净的ID, f1 --> 1
 */
function getPureID(id) {
    if (!id) {
        return ''
    }
    return id.replace('f', '');
}

/**
 * 得到map的key name
 * 
 * @param token
 */
function getMapkey(token) {
    return 'map_' + token;
}

/**
 * 得到maker的key name
 * 
 * @param token
 */
function getMapMarkerKey(token) {
    return 'text_marker_' + token;
}

/**
 * 获取地址的内容
 */
function getMakerText()
{
	var text = $.trim($('#place').val());
	return text;
}

/**
 * 打开信息窗体
 */
function openMapWindowInfo(text, map, marker) {
	if (text != "")
	{
		// 构建信息窗体中显示的内容
	    var info = [];
	    info.push("<div style='font-size:12px;'>" + text + "</div>");
	    infoWindow = new AMap.InfoWindow({
	    	offset: new AMap.Pixel(2, -25),
	        content: info.join("<br/>")  // 使用默认信息窗体框样式，显示信息内容
	    });
	    infoWindow.open(map, marker.getPosition());
	}
}
/**
 * 关闭信息窗体
 */
function closeInfoWindow(map) {
    map.clearInfoWindow();
}
/**
 * 得到id对应的map对象
 * 
 * @param id
 */
function getMapObj(token) {
    var key = getMapkey(token);
    return static_maps[key];
}

/**
 * 设置地图组件可滚动状态
 * 
 * @param string
 *            id 组件的ID
 */
function enableMapScroll(id) {
	var o_map = getMapByID(id);
	if (o_map)
	{
		o_map.setStatus({
			zoomEnable: true,
		});
	}
}
/**
 * 地图禁止缩放
 */
function disabledMapScale(map)
{
	map.setStatus({
		zoomEnable: false,
	});
}

/**
 * 获取当前的map对象
 */
function getCurrentMap()
{
	// 获取当前选中的组件
	var o_current = getCurrentObj();
	if (!o_current) return null;
	// 根据当前组件获取token
	var token = o_current.data('token');
	// 根据token获取当前map对象
	return getMapObj(token);
}
/**
 * 获取当前map上的唯一maker对象
 */
function getCurrentMapMarker() {
	// 获取当前选中的组件
	var o_current = getCurrentObj();
	if (!o_current) return null;
	// 根据当前组件获取token
	var token = o_current.data('token');
	// 根据token获取当前map对象
	return getMapMarkerObj(token);
}

/**
 * 得到id对应的marker对象
 * 
 * @param id
 * @returns {*}
 */
function getMapMarkerObj(token) {
    var key = getMapMarkerKey(token);
    return static_maps[key];
}

/**
 * 初始化map 携带一个唯一的不变的token值
 * 
 * @param string
 *            id 组件的ID，回显界面遍历的时候时间可能会一致
 * @return string t+当前的时间戳
 */
function getMapToken(id) {
    var stamp = parseInt(Date.now() / 1000);
    return 't' + stamp + '_' + id;
}

/**
 * 得到模板对象的 最纯净的ID
 * 
 * @param object
 *            obj
 * @return int/string ID
 */
function getTplID(obj) {
    var wrapper_id = obj.attr('id');
    var pure_id = getPureID(wrapper_id);
    return pure_id;
}

/**
 * 上下移的时候, 置换节点位置
 * 
 * @param id
 *            int/string
 * @param offset
 *            偏移量
 */
function swapDomPosition(id, offset) {
    id = parseInt(id);
    var current = form_datas[id];
    var offsetDOM = form_datas[id + offset];
    var tmp = current;
    form_datas[id] = offsetDOM;
    form_datas[id + offset] = tmp;
}

/**
 * 得到对应类型的条目对象
 * 
 * @param component_type
 *            string 条目 类型 radio|checkbox
 * @return object
 */
function getComponentItemObj(component_type) {
    // 得到html内容
    var item = $('#tpl_' + component_type + '_item').html();
    item = $.trim(item);
    // 获取对象
    var o_item = $(item);
    return o_item;
}

/**
 * 正向地理解析编码
 * 
 * @param string
 *            text
 */
function mapDecodePlace(text)
{
	// 地图组件未初始化完毕
	if (!o_geocoder) {
		$.msg('地图组件未加载完毕，请稍后重试');
		return;
	}
	o_geocoder.getLocation(text, function(status, result) {
		if (status === 'complete' && result.info === 'OK') {
			var lnglat = result.geocodes[0].location;
			var lng = lnglat.lng;
			var lat = lnglat.lat;
			// 得到当前选中的map对象
			var o_map = getCurrentMap();
			// 得到当前选中的map对象上唯一的一个marker标注对象
			var o_marker = getCurrentMapMarker();
			if (o_map && o_marker)
			{
				// 标注移动到解析的位置
				o_marker.setPosition(lnglat);
				// 地图移动到解析的位置
				o_map.setCenter(lnglat);
				// 打开信息窗体
				openMapWindowInfo(text, o_map, o_marker)
				// 数据中修改经纬度
				var currentData = getCurrentData();
				if (currentData && typeof currentData === 'object')
				{
					// 当前组件对应的索引和值内容
					var index = currentData.index;
					var data = currentData.data;
					
					// 设置文本内容
					data.place = text;
					// 设置经纬度
					var location = data.location;
					if (location) {
						location.lat = lat;
						location.lng = lng;
						data.location = location;
					}
					forms[index] = data;
				}
			}
		}
	})
}

// ------------------ 发布网址/发布/复制网址 ------------------ //
/**
 * @param type
 *            int 1-发布表单 2-发布
 * @param obj
 *            object 当前按钮jquery对象
 */
function publish(type, obj)
{
	type = type || 1;
	// 校验顶部数据
	if (!validateHeader())
	{
		return false;
	}
	// 校验表单数据
	if (!validateForm())
	{
		return false;
	}
	var form = $('#to_submit');
    var path = form.attr('action');
    if (path)
	{
    	$.loading.start();
	    $.post(path, {
	    	is_publish: 1,
	        form_datas: JSON.stringify(form_datas),
	        global_datas: JSON.stringify(global_form_datas)
	    }, function(res) {
	    	if(res.code == 0)
    		{
	    		// 写入内容
	    		var id = res.data;
	    		var full_form_url = home_url + '/form/' + id +'.html';
	    		var form_success_wrap = $('.form-success-wrap');
	    		
	    		// 网址内容
	    		form_success_wrap.find('.url').val(full_form_url);
	    		form_success_wrap.find('.btn-open').attr('href', full_form_url);
	    		
	    		// 二维码内容
	    		var qrcode_url = '/dashboard/custom-form/form-qrcode.html?form_id=' + id;
	    		form_success_wrap.find('.qrcode-img').find('img').attr('src', qrcode_url);
	    		// 下载
	    		qrcode_url += '&download=1';
	    		form_success_wrap.find('.download').attr('href', qrcode_url);
	    		
	    		// 清除缓存
	    		if (typeof IS_BACKEND_APP !=='undefined' && IS_BACKEND_APP){
	    			clearRuntimeCache();
	    		}
	    		
	    		// 表单发布成功
	    		layer.open({
	    			type: 1,
	    			title: '表单发布',
	    			resize: false,
	    			area: ['800px', '470px'],
	    			content: form_success_wrap
	    		})
    		} else {
    			$.msg(res.message);
    		}
	    }, 'json');
	}
   
}
var $fbox = $('.module-topBar').find('.f-box');
var $release = $('.SZY-TPL-RELEASE');
// 发布按钮
$release.click(function() {
	publish(2, $(this));
});
$fbox.on('click', '.publish', function() {
	// 发布表单, 生成地址
	publish(1, $(this));
})
.on('click', '.copy', function(){
	// 头部复制网址
	var $self = $(this);
	var $input = $self.prev('input');
	copy($self, $input);
});

// 提示成功弹窗中的复制网址
$('.form-success-wrap').on('click', '.copy', function() {
	var $self = $(this);
	var $input = $self.prev('input');
	copy($self, $input);
});

// 清除运行时缓存 - 以便于让表单的去除头、底部的内容生效
function clearRuntimeCache() {
	$.post('/system/cache/clear.html', {
		codes: 'runtime'
	},function() {
		
	},'JSON');
}

/**
 * 复制功能
 * 
 * @param o_self
 *            object 当前按钮对象
 * @param o_target
 *            object 目标input对象
 */
function copy(o_self, o_target) {
	if (o_target.length == 1)
	{
		var url = $.trim(o_target.val());
		if (url != '')
		{
			// 父级对象
			var o_parent = o_self.parent();
			// 新建一个文本对象
			var $inputEle = $("<input type='text'>");
			// 设置内容
			$inputEle.val(url);
			// 添加到兄弟节点中
			o_parent.append($inputEle);
			// 选择对象
			$inputEle.select(); 
			// 执行浏览器复制命令
			document.execCommand("Copy"); 
			// 移除节点
			$inputEle.remove();
			// 提示信息
			$.msg('复制成功');
		}
	}
}
