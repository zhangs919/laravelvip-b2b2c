<?php

namespace App\Extensions;

class WxHongbao
{
	const API_SEND_NORMAL = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
	const API_SEND_GROUP = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendgroupredpack';
	const API_QUERY = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gethbinfo';
	const API_PREPARE = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/hbpreorder';
	const TYPE_NORMAL = 'NORMAL';
	const TYPE_GROUP = 'GROUP';

	/**
     * 微信红包类
     *
     */
	private $parameters;
	private $configure;

	public function __construct($configure)
	{
		$this->configure = $configure;
	}

	public function creat_sendredpack($type = self::TYPE_NORMAL)
	{
		$this->setParameter('sign', $this->get_sign($this->parameters));
		$api = ($type == self::TYPE_NORMAL ? self::API_SEND_NORMAL : self::API_SEND_GROUP);
		$postXml = $this->arrayToXml($this->parameters);
		$result = $this->curl_post_ssl($api, $postXml);
		$json = (array) simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $json;
	}

	public function query_redpack()
	{
		$this->setParameter('sign', $this->get_sign($this->parameters));
		$postXml = $this->arrayToXml($this->parameters);
		$result = $this->curl_post_ssl(self::API_QUERY, $postXml);
		$json = (array) simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $json;
	}

	public function setParameter($parameter, $parameterValue)
	{
		$this->parameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
	}

	public function getParameter($parameter)
	{
		return $this->parameters[$parameter];
	}

	public function check_sign_parameters()
	{
		if (($this->parameters['nonce_str'] == null) || ($this->parameters['mch_billno'] == null) || ($this->parameters['mch_id'] == null) || ($this->parameters['wxappid'] == null) || ($this->parameters['nick_name'] == null) || ($this->parameters['send_name'] == null) || ($this->parameters['re_openid'] == null) || ($this->parameters['total_amount'] == null) || ($this->parameters['max_value'] == null) || ($this->parameters['total_num'] == null) || ($this->parameters['wishing'] == null) || ($this->parameters['client_ip'] == null) || ($this->parameters['act_name'] == null) || ($this->parameters['remark'] == null) || ($this->parameters['min_value'] == null)) {
			return false;
		}

		return true;
	}

	public function curl_post_ssl($url, $vars, $second = 30, $aHeader = array())
	{
		$ch = curl_init();
		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}

		curl_setopt($ch, CURLOPT_TIMEOUT, $second);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLCERT, ROOT_PATH . 'storage/app/certs/apiclient_cert.pem');
		curl_setopt($ch, CURLOPT_SSLKEY, ROOT_PATH . 'storage/app/certs/apiclient_key.pem');
		curl_setopt($ch, CURLOPT_CAINFO, ROOT_PATH . 'storage/app/certs/rootca.pem');

		if (1 <= count($aHeader)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		$data = curl_exec($ch);

		if ($data) {
			curl_close($ch);
			return $data;
		}
		else {
			$error = curl_errno($ch);
			echo 'curl出错，错误码:' . $error . '<br>';
			echo '<a href=\'http://curl.haxx.se/libcurl/c/libcurl-errors.html\'>错误原因查询</a></br>';
			curl_close($ch);
			return false;
		}
	}

	protected function get_sign($paraMap)
	{
		ksort($paraMap);
		$buff = '';

		foreach ($paraMap as $k => $v) {
			$buff .= $k . '=' . $v . '&';
		}

		if (0 < strlen($buff)) {
			$String = substr($buff, 0, strlen($buff) - 1);
		}

		$String = $String . '&key=' . $this->configure['partnerkey'];
		$String = md5($String);
		$result_ = strtoupper($String);
		return $result_;
	}

	public function trimString($value)
	{
		$ret = null;

		if (null != $value) {
			$ret = $value;

			if (strlen($ret) == 0) {
				$ret = null;
			}
		}

		return $ret;
	}

	public function create_noncestr($length = 32)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$str = '';

		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}

		return $str;
	}

	public function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = '';
		ksort($paraMap);

		foreach ($paraMap as $k => $v) {
			if ($urlencode) {
				$v = urlencode($v);
			}

			$buff .= strtolower($k) . '=' . $v . '&';
		}

		if (0 < strlen($buff)) {
			$reqPar = substr($buff, 0, strlen($buff) - 1);
		}

		return $reqPar;
	}

	public function arrayToXml($arr)
	{
		$xml = '<xml>';

		foreach ($arr as $key => $val) {
			if (is_numeric($val)) {
				$xml .= '<' . $key . '>' . $val . '</' . $key . '>';
			}
			else {
				$xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
			}
		}

		$xml .= '</xml>';
		return $xml;
	}

	public function setConfigure($configure)
	{
		$this->configure = $configure;
	}

	public function getConfigure()
	{
		return $this->configure;
	}
}


?>
