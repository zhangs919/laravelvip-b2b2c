<!DOCTYPE html>
<html lang="ZH-Hans">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{ $seo_title }}</title>
	<link rel="stylesheet" href="/installs/css/base.css">
	<link rel="stylesheet" href="/installs/css/install.css">
</head>
<body>
<header>
	<div class="head">
		<div class="head_left">
			<img src="/installs/images/header.png" class="head_img" alt="">
			<div>安装向导</div>
		</div>
		<div class="head_right">
			<div><a href="https://www.laravelvip.com" target="_blank">官方网站</a></div>
		</div>
	</div>
</header>
<div class="box">
	<div class="header">
		<ul>
			<li>
				<span class="header_left header_left_active">1</span>
				<span class="header_right header_right_active">许可协议</span>
			</li>
			<li>
				<span class="header_left">2</span>
				<span class="header_right">环境检测</span>
			</li>
			<li>
				<span class="header_left">3</span>
				<span class="header_right">参数配置</span>
			</li>
			<li>
				<span class="header_left">4</span>
				<span class="header_right">安装完成</span>
			</li>
		</ul>
	</div>

	<!-- 许可协议 -->
	<div class="protocol" data-index="1">
		<div class="protocol_content">
			<div class="protocol_box">
				<p class="read">许可协议</p>
				<p class="read_content mt-20">感谢您选择“乐融沃”B2B2C电子商务系统软件。希望我们的努力能为您提供一个高效快速和强大的电子商务解决方案。</p>
				<p class="read_content mt-20">
					重庆乐融沃网络科技有限公司为“乐融沃”以及其所有子产品的独立开发商，依法独立享有产品著作权，乐融沃产品已在中华人民共和国国家版权局进行登记备案，受国家法律和国际法公约保护。</p>
				<p class="read_content mt-20">
					唯一官方网站：https://www.laravelvip.com。使用者：无论个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，在理解、同意、并遵守本协议的全部条款后，方可开始使用乐融沃软件。</p>
				<p class="read_content mt-20">本授权协议适用且仅适用于乐融沃v1.0及以上版本，重庆乐融沃网络科技有限公司拥有对本授权协议的最终解释权。</p>

				<p class="read_title mt-20">I. 协议许可的权利</p>
				<p class="read_content mt-20">
					1.您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途(包括个人用户：不具备法人资格的自然人，以个人名义从事电子商务开设网店的；非盈利性用途：从事非盈利活动的商业机构及非盈利性组织，将乐融沃产品用且仅用于产品演示、展示及发布，而并不是用来买卖及盈利的运营活动的)</p>
				<p class="read_content mt-20">2.您可以在获得版权所有人许可后，在协议规定的约束和限制范围内修改乐融沃源代码(如果被提供的话)或界面风格以适应您的网站要求。</p>
				<p class="read_content mt-20">3.您拥有使用本软件构建的商店中全部会员资料、文章、商品及相关信息的所有权，并独立承担与其内容的相关法律义务。</p>
				<p class="read_content mt-20">
					4.获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自授权时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。</p>

				<p class="read_title mt-20">II. 协议规定的约束和限制</p>
				<p class="read_content mt-20">1.未获商业授权之前，不得将本软件用于商业用途(包括但不限于企业法人经营的企业网站、经营性网站、以盈利为目或实现盈利的网站)。</p>
				<p class="read_content mt-20">2.不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</p>
			</div>
		</div>
		<form method="post" action="/install/index.html">
			@csrf
			<div class="protocol_footer">
				<div class="protocol_footer_zuo">
					<label class="d-flex a-content">
						<input type="checkbox" name="agree" value="1" class="mr-10" id="protocol">我已阅读并同意此协议</label>
				</div>
				<div class="protocol_footer_you">
					<button id="protocol_next" disabled>下一步</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/installs/js/layui/layui.js" type="text/javascript"></script>
<script src="/installs/js/Validform_min.js" type="text/javascript"></script>
<script src="/installs/js/install.js" type="text/javascript"></script>
</body>
</html>