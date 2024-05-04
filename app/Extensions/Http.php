<?php

namespace App\Extensions;

class Http
{
	/**
     * 访问方式
     * @var integer
     */
	static public $way = 0;

	static public function setWay($way)
	{
		self::$way = intval($way);
	}

	static public function getSupport()
	{
		if (isset(self::$way) && in_array(self::$way, array(1, 2, 3))) {
			return self::$way;
		}

		if (function_exists('curl_init')) {
			return 1;
		}
		else if (function_exists('fsockopen')) {
			return 2;
		}
		else if (function_exists('file_get_contents')) {
			return 3;
		}
		else {
			return 0;
		}
	}

	static public function doGet($url, $timeout = 5, $header = '')
	{
		if (empty($url) || empty($timeout)) {
			return false;
		}

		if (!preg_match('/^(http|https)/is', $url)) {
			$url = 'http://' . $url;
		}

		$code = self::getSupport();

		switch ($code) {
		case 1:
			return self::curlGet($url, $timeout, $header);
			break;

		case 2:
			return self::socketGet($url, $timeout, $header);
			break;

		case 3:
			return self::phpGet($url, $timeout, $header);
			break;

		default:
			return false;
		}
	}

	static public function doPost($url, $post_data = array(), $timeout = 5, $header = '')
	{
		if (empty($url) || empty($post_data) || empty($timeout)) {
			return false;
		}

		if (!preg_match('/^(http|https)/is', $url)) {
			$url = 'http://' . $url;
		}

		$code = self::getSupport();

		switch ($code) {
		case 1:
			return self::curlPost($url, $post_data, $timeout, $header);
			break;

		case 2:
			return self::socketPost($url, $post_data, $timeout, $header);
			break;

		case 3:
			return self::phpPost($url, $post_data, $timeout, $header);
			break;

		default:
			return false;
		}
	}

	static public function curlGet($url, $timeout = 5, $header = '')
	{
		$header = (empty($header) ? self::defaultHeader() : $header);
		$ch = curl_init();

		if (stripos($url, 'https://') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		}

		curl_setopt($ch, CURLOPT_HTTP_VERSION, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	static public function curlPost($url, $post_data = array(), $timeout = 5, $header = '', $data_type = '')
	{
		$header = (empty($header) ? '' : $header);

		if ($data_type == 'json') {
			$post_string = json_encode($post_data);
		}
		else if (is_array($post_data)) {
			$post_string = http_build_query($post_data, '', '&');
		}
		else {
			$post_string = $post_data;
		}

		$ch = curl_init();

		if (stripos($url, 'https://') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		}

		curl_setopt($ch, CURLOPT_HTTP_VERSION, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	static public function socketGet($url, $timeout = 5, $header = '')
	{
		$header = (empty($header) ? self::defaultHeader() : $header);
		$url2 = parse_url($url);
		$url2['path'] = isset($url2['path']) ? $url2['path'] : '/';
		$url2['port'] = isset($url2['port']) ? $url2['port'] : 80;
		$url2['query'] = isset($url2['query']) ? '?' . $url2['query'] : '';
		$host_ip = @gethostbyname($url2['host']);

		if (($fsock = fsockopen($host_ip, $url2['port'], $errno, $errstr, $timeout)) < 0) {
			return false;
		}

		$request = $url2['path'] . $url2['query'];
		$in = 'GET ' . $request . " HTTP/1.0\r\n";

		if (false === strpos($header, 'Host:')) {
			$in .= 'Host: ' . $url2['host'] . "\r\n";
		}

		$in .= $header;
		$in .= "Connection: Close\r\n\r\n";

		if (!@fwrite($fsock, $in, strlen($in))) {
			@fclose($fsock);
			return false;
		}

		return self::GetHttpContent($fsock);
	}

	static public function socketPost($url, $post_data = array(), $timeout = 5, $header = '')
	{
		$header = (empty($header) ? self::defaultHeader() : $header);
		$post_string = http_build_query($post_data);
		$url2 = parse_url($url);
		$url2['path'] = $url2['path'] == '' ? '/' : $url2['path'];
		$url2['port'] = $url2['port'] == '' ? 80 : $url2['port'];
		$host_ip = @gethostbyname($url2['host']);
		$fsock_timeout = $timeout;

		if (($fsock = fsockopen($host_ip, $url2['port'], $errno, $errstr, $fsock_timeout)) < 0) {
			return false;
		}

		$request = $url2['path'] . ($url2['query'] ? '?' . $url2['query'] : '');
		$in = 'POST ' . $request . " HTTP/1.0\r\n";
		$in .= 'Host: ' . $url2['host'] . "\r\n";
		$in .= $header;
		$in .= "Content-type: application/x-www-form-urlencoded\r\n";
		$in .= 'Content-Length: ' . strlen($post_string) . "\r\n";
		$in .= "Connection: Close\r\n\r\n";
		$in .= $post_string . "\r\n\r\n";
		unset($post_string);

		if (!@fwrite($fsock, $in, strlen($in))) {
			@fclose($fsock);
			return false;
		}

		return self::GetHttpContent($fsock);
	}

	static public function phpGet($url, $timeout = 5, $header = '')
	{
		$header = (empty($header) ? self::defaultHeader() : $header);
		$opts = array(
			'http' => array('protocol_version' => '1.0', 'method' => 'GET', 'timeout' => $timeout, 'header' => $header)
			);
		$context = stream_context_create($opts);
		return @file_get_contents($url, false, $context);
	}

	static public function phpPost($url, $post_data = array(), $timeout = 5, $header = '')
	{
		$header = (empty($header) ? self::defaultHeader() : $header);
		$post_string = http_build_query($post_data);
		$header .= 'Content-length: ' . strlen($post_string);
		$opts = array(
			'http' => array('protocol_version' => '1.0', 'method' => 'POST', 'timeout' => $timeout, 'header' => $header, 'content' => $post_string)
			);
		$context = stream_context_create($opts);
		return @file_get_contents($url, false, $context);
	}

	static private function defaultHeader()
	{
		$header = "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12\r\n";
		$header .= "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n";
		$header .= "Accept-language: zh-cn,zh;q=0.5\r\n";
		$header .= "Accept-Charset: GB2312,utf-8;q=0.7,*;q=0.7\r\n";
		return $header;
	}

	static private function GetHttpContent($fsock = NULL)
	{
		$out = null;

		while ($buff = @fgets($fsock, 2048)) {
			$out .= $buff;
		}

		fclose($fsock);
		$pos = strpos($out, "\r\n\r\n");
		$head = substr($out, 0, $pos);
		$status = substr($head, 0, strpos($head, "\r\n"));
		$body = substr($out, $pos + 4, strlen($out) - ($pos + 4));

		if (preg_match('/^HTTP\\/\\d\\.\\d\\s([\\d]+)\\s.*$/', $status, $matches)) {
			if ((intval($matches[1]) / 100) == 2) {
				return $body;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	static public function download($filename, $showname = '', $expire = 1800)
	{
		if (file_exists($filename) && is_file($filename)) {
			$length = filesize($filename);
		}
		else {
			exit('下载文件不存在！');
		}

		$type = pathinfo($filename, PATHINFO_EXTENSION);
		header('Pragma: public');
		header('Cache-control: max-age=' . $expire);
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expire) . 'GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . 'GMT');
		header('Content-Disposition: attachment; filename=' . $showname);
		header('Content-Length: ' . $length);
		header('Content-type: ' . $type);
		header('Content-Encoding: none');
		header('Content-Transfer-Encoding: binary');
		readfile($filename);
		return true;
	}
}


?>
