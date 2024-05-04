<?php

namespace App\Extensions;

class Page
{
	public $pageName = 'page';
	public $pageSeparator = '=';
	public $pageParameter = '&';
	public $pageSuffix = '.html';
	public $nextPage = '下一页';
	public $prePage = '上一页';
	public $firstPage = '首页';
	public $lastPage = '尾页';
	public $preBar = '<<';
	public $nextBar = '>>';
	public $isAjax = false;
	public $pageBarNum = 10;
	public $totalPage = 0;
	public $ajaxActionName = '';
	public $nowIndex = 0;
	public $url = '';
	public $requestUri = '';

	public function __construct($array = array())
	{
		if (isset($array['pageName'])) {
			$this->set('pageName', $array['pageName']);
		}

		if (isset($array['ajax']) && !empty($array['ajax'])) {
			$this->openAjax($array['ajax']);
		}
	}

	public function doPage($url, $total, $perPage, $pageBarNum)
	{
		$this->totalPage = ceil($total / $perPage);
		$this->pageBarNum = $pageBarNum;
		$this->nowIndex = $this->nowIndex == 0 ? $this->getCurPage($url) : $this->nowIndex;
	}

	public function set($var, $value)
	{
		if (in_array($var, get_object_vars($this))) {
			$this->$var = $value;
			return true;
		}
		else {
			return false;
		}
	}

	public function openAjax($action)
	{
		$this->isAjax = true;
		$this->ajaxActionName = $action;
	}

	public function nextPage($style = 'nextPage')
	{
		if ($this->nowIndex < $this->totalPage) {
			return $this->_getLink($this->_getUrl($this->nowIndex + 1), $this->nextPage, $style);
		}

		return '';
	}

	public function prePage($style = 'prePage')
	{
		if (1 < $this->nowIndex) {
			return $this->_getLink($this->_getUrl($this->nowIndex - 1), $this->prePage, $style);
		}

		return '';
	}

	public function firstPage($style = 'firstPage')
	{
		if ($this->nowIndex == 1) {
			return '';
		}

		return $this->_getLink($this->_getUrl(1), $this->firstPage, $style);
	}

	public function lastPage($style = 'lastPage')
	{
		if ($this->nowIndex == $this->totalPage) {
			return '';
		}

		return $this->_getLink($this->_getUrl($this->totalPage), $this->lastPage, $style);
	}

	public function nowBar($style = 'pages', $nowIndex_style = 'current')
	{
		$plus = ceil($this->pageBarNum / 2);

		if ($this->totalPage < (($this->pageBarNum - $plus) + $this->nowIndex)) {
			$plus = ($this->pageBarNum - $this->totalPage) + $this->nowIndex;
		}

		$begin = ($this->nowIndex - $plus) + 1;
		$begin = (1 <= $begin ? $begin : 1);
		$return = '';

		for ($i = $begin; $i < ($begin + $this->pageBarNum); $i++) {
			if ($i <= $this->totalPage) {
				if ($i != $this->nowIndex) {
					$return .= $this->_getText($this->_getLink($this->_getUrl($i), $i, $style));
				}
				else {
					$return .= $this->_getText('<span class="' . $nowIndex_style . '">' . $i . '</span>');
				}
			}
			else {
				break;
			}

			$return .= ' ';
		}

		return $return;
	}

	public function select()
	{
		if (1 < $this->totalPage) {
			$return = '<select onChange="window.location=this.options[this.selectedIndex].value">';

			for ($i = 1; $i <= $this->totalPage; $i++) {
				if ($i == $this->nowIndex) {
					$return .= '<option value="' . $this->_getUrl($i) . '" selected>' . $i . '</option>';
				}
				else {
					$return .= '<option value="' . $this->_getUrl($i) . '">' . $i . '</option>';
				}
			}

			$return .= '</select>';
			return $return;
		}
	}

	public function show($url = '', $total = 0, $perPage = 10, $pageBarNum = 10, $mode = 1)
	{
		$this->doPage($url, $total, $perPage, $pageBarNum);

		if ($this->totalPage < 1) {
			return '';
		}

		switch ($mode) {
		case 1:
			return $pager = array('page_first' => $this->firstPage(), 'page_prev' => $this->prePage(), 'page_next' => $this->nextPage(), 'page_last' => $this->lastPage(), 'page_number' => $this->showselect(), 'page' => $this->nowIndex, 'page_count' => $this->totalPage, 'count' => $total);
			break;

		case 2:
			return $this->firstPage() . $this->prePage() . '[第' . $this->nowIndex . '页]' . $this->nextPage() . $this->lastPage() . '第' . $this->select() . '页';
			break;

		case 3:
			return $this->firstPage() . $this->prePage() . $this->nextPage() . $this->lastPage();
			break;

		case 4:
			return $this->prePage() . $this->nowBar() . $this->nextPage();
			break;

		case 5:
			return $this->prePage() . $this->nowBar() . $this->nextPage() . $this->select();
			break;

		default:
			break;
		}
	}

	public function showselect()
	{
		$_pagenum = $this->pageBarNum;
		$_offset = 2;
		$_from = $_to = 0;

		if ($this->totalPage < $_pagenum) {
			$_from = 1;
			$_to = $this->totalPage;
		}
		else {
			$_from = $this->nowIndex - $_offset;
			$_to = ($_from + $_pagenum) - 1;

			if ($_from < 1) {
				$_to = ($this->nowIndex + 1) - $_from;
				$_from = 1;

				if (($_to - $_from) < $_pagenum) {
					$_to = $_pagenum;
				}
			}
			else if ($this->totalPage < $_to) {
				$_from = ($this->totalPage - $_pagenum) + 1;
				$_to = $this->totalPage;
			}
		}

		$page_number = array();

		for ($i = $_from; $i <= $_to; ++$i) {
			$page_number[$i] = $this->_getUrl($i);
		}

		return $page_number;
	}

	public function getCurPage($url = '')
	{
		$this->_setUrl($url);
		$nowIndex = 1;
		if (isset($_GET[$this->pageName]) && (0 < intval($_GET[$this->pageName]))) {
			return intval($_GET[$this->pageName]);
		}

		$pattern = str_replace('\\{page\\}', '(\\d{1,})', preg_quote($this->url, '/'));

		if (preg_match('/' . $pattern . '/i', $this->requestUri, $matches)) {
			if (isset($matches[1]) && (0 < $matches[1])) {
				return $matches[1];
			}
		}

		return $nowIndex;
	}

	public function contentPage($content, $separator = '[page]', $url = '', $pageBarNum = 10, $mode = 1)
	{
		$content_array = explode($separator, $content);
		unset($content);
		$total = count($content_array);
		$this->nowIndex = $this->getCurPage($url);
		$index = $this->nowIndex - 1;
		$content = (isset($content_array[$index]) ? $content_array[$index] : '');
		unset($content_array);

		if (1 < $total) {
			$page = $this->show($url, $total, $perPage = 1, $pageBarNum, $mode);
		}
		else {
			$page = '';
		}

		return array('content' => $content, 'page' => $page);
	}

	private function _requestUri($url)
	{
		if (isset($url)) {
			$uri = $url;
		}
		else if (isset($_SERVER['argv'])) {
			$uri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['argv'][0];
		}
		else {
			$uri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
		}

		if (isset($_SERVER['HTTPS'])) {
			$protocol = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off') ? 'https://' : 'http://');
		}
		else if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
			$protocol = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) != 'off') ? 'https://' : 'http://');
		}
		else {
			$protocol = $_SERVER['REQUEST_SCHEME'] . '://';
		}

		return $protocol . $_SERVER['HTTP_HOST'] . $uri;
	}

	private function _setUrl($url = '')
	{
		$this->requestUri = $this->_requestUri($url);
		if (!empty($url) && preg_match('/\\{page\\}/', $url)) {
			$this->url = $url;
		}
		else {
			$page_str = '&' . $this->pageName . '=';

			if (($url = preg_replace('/' . preg_quote($page_str, '/') . '(\\d{1,})/', $page_str . '{page}', $this->requestUri)) == $this->requestUri) {
				if (($url = str_replace($this->pageSuffix, $page_str . '{page}' . $this->pageSuffix, $this->requestUri)) == $this->requestUri) {
					$uri_arr = explode('?', $this->requestUri, 2);
					$str1 = rtrim($uri_arr[0], '/');

					if (0 < ($pos = @strrpos($url, $_GET['_action']))) {
						$str1 = substr($str1, 0, $pos);
					}

					$str1 = rtrim($str1, '/') . '/' . $_GET['_action'];
					$str1 = rtrim($str1, '/');
					$str2 = '';

					if (isset($uri_arr[1])) {
						$str2 = '?' . $uri_arr[1];
					}

					$url = $str1 . $str2 . $page_str . '{page}';
				}
			}

			$this->url = $url;
		}
	}

	private function _getUrl($pageNum = 1)
	{
		$url = $this->url;

		if (1 < $pageNum) {
			$url = str_replace('{page}', $pageNum, $this->url);
		}
		else {
			$url = str_replace($this->pageSeparator . '{page}', '', $this->url);
			$url = str_replace($this->pageParameter . $this->pageName, '', $url);
		}

		return $url;
	}

	public function _getText($str)
	{
		return $str;
	}

	public function _getLink($url, $text, $style = '')
	{
		$style = (empty($style) ? '' : 'class="' . $style . '"');

		if ($this->isAjax) {
			return '<a ' . $style . ' href="javascript:' . $this->ajaxActionName . '(\'' . $url . '\')">' . $text . '</a>';
		}
		else {
			return $url;
		}
	}
}


?>
