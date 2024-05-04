<?php

namespace App\Models;


use App\Services\WechatSDKService;

class Qcode extends BaseModel
{
	protected $table = 'qcode';

	protected $fillable = [
		'qcode_type', 'qcode_content', 'qcode'
	];

	protected $appends = [
		'qcode_type_text', 'qcode_content_text', 'qcode_url'
	];

	protected $primaryKey = 'id';

	// 二维码类型
	const QCODE_TYPE = [
		0 => '商品',
		1 => '文章',
		2 => '店铺',
	];

	public function getQcodeTypeTextAttribute()
	{
		return self::QCODE_TYPE[$this->qcode_type] ?? '';
	}

	public function getQcodeContentTextAttribute()
	{
		if ($this->qcode_type == 1) {
			// 文章
			return Article::find($this->qcode_content)['title'] ?? '';
		} else {
			// 商品
			return Goods::find($this->qcode_content)['goods_name'] ?? '';
		}
	}

	public function getQcodeUrlAttribute()
	{
		if (!$this->qcode) {
			return '';
		}
		$wechatSDKService = new WechatSDKService();
		return $wechatSDKService->getQRUrl($this->qcode); //  // https://api.weixin.qq.com/cgi-bin/showqrcode?ticket=TICKET
	}

	/**
	 * 获取场景值 具体的url 如商品详情页url
	 * @param $qcode_content
	 * @param int $qcode_type 0-商品详情页 1-文章详情页 2-店铺首页
	 * @return string
	 */
	public static function getSceneValue($qcode_content, $qcode_type = 0)
	{
		if (empty($qcode_content)) {
			return '';
		}
		if ($qcode_type == 1) {
			// 文章
			return "http://" . config('lrw.mobile_domain') . "/news/{$qcode_content}.html";
		} elseif ($qcode_type == 2) {
			// 店铺首页
			return "http://" . config('lrw.mobile_domain') . "/shop/{$qcode_content}.html";
		} else {
			// 商品
//			return route('mobile_show_goods', ['goods_id' => $qcode_content]);
			return "http://" . config('lrw.mobile_domain') . "/goods-{$qcode_content}.html";
		}
	}
}
