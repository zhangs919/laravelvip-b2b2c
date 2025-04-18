<?php

namespace App\Services;

class WechatSDKService
{
	private $api;
	const QRCODE_IMG_URL = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';

	public function __construct($shop_id = 0)
	{
//		$app = WechatService::app($shop_id);
//		$this->api = $app->getClient();
	}

	/**
	 * 生成二维码
	 *
	 * @param int|string $scene_id 场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
	 * @param int $type 二维码类型，QR_SCENE为临时的整型参数值，QR_STR_SCENE为临时的字符串参数值，QR_LIMIT_SCENE为永久的整型参数值，QR_LIMIT_STR_SCENE为永久的字符串参数值
	 * @param int $expire 该二维码有效时间，以秒为单位。 最大不超过2592000（即30天）
	 * @return false|mixed
	 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
	 */
	public function getQRCode($scene_id, $type = 0, $expire = 604800)
	{

	    return false;
		if (!isset($scene_id)) {
			return false;
		}

		switch ($type) {
			case '0':
				if (!is_numeric($scene_id)) {
					return false;
				}

				$action_name = 'QR_SCENE';
				$action_info = [
					'scene' => ['scene_id' => $scene_id]
				];
				break;

			case '1':
				if (!is_numeric($scene_id)) {
					return false;
				}

				$action_name = 'QR_LIMIT_SCENE';
				$action_info = [
					'scene' => ['scene_id' => $scene_id]
				];
				break;

			case '2':
				if (!is_string($scene_id)) {
					return false;
				}

				$action_name = 'QR_LIMIT_STR_SCENE';
				$action_info = [
					'scene' => ['scene_str' => $scene_id]
				];
				break;

			case '3':
				if (!is_string($scene_id)) {
					return false;
				}

				$action_name = 'QR_STR_SCENE';
				$action_info = [
					'scene' => ['scene_str' => $scene_id]
				];
				break;

			default:
				return false;
		}

		$data = ['action_name' => $action_name, 'expire_seconds' => $expire, 'action_info' => $action_info];
		if (($type == 1) || ($type == 2)) {
			unset($data['expire_seconds']);
		}

		try {
			$response = $this->api->post('/cgi-bin/qrcode/create', [
				'json' => $data
			]);
			$resp = $response->getContent();
			$json = json_decode($resp, true);
			if (!$json || !empty($json['errcode'])) {
				throw new \Exception($json['errmsg']);
			}

			return $json;
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * 根据ticket获取二维码链接
	 *
	 * @param string $ticket 获取的二维码ticket，凭借此ticket可以在有效时间内换取二维码。
	 * @return string
	 */
	public function getQRUrl($ticket)
	{
		return self::QRCODE_IMG_URL . urlencode($ticket);
	}
}
