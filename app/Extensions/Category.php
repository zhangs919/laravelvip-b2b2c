<?php

namespace App\Extensions;

class Category
{
	/**
     * 原始数据
     * @var array
     */
	private $rawList = array();
	/**
     * 格式化数据
     * @var array
     */
	private $formatList = array();
	/**
     * 分类样式
     * @var array
     */
	private $icon = array('│', '├', '└');
	/**
     * 映射字段
     * @var array
     */
	private $field = array();

	public function __construct($field = array())
	{
		$this->field['id'] = isset($field[0]) ? $field[0] : 'id';
		$this->field['pid'] = isset($field[1]) ? $field[1] : 'pid';
		$this->field['title'] = isset($field[2]) ? $field[2] : 'title';
		$this->field['fulltitle'] = isset($field[3]) ? $field[3] : 'fulltitle';
	}

	public function getChild($pid, $data = array())
	{
		$childs = array();

		if (empty($data)) {
			$data = $this->rawList;
		}

		foreach ($data as $Category) {
			if ($Category[$this->field['pid']] == $pid) {
				$childs[] = $Category;
			}
		}

		return $childs;
	}

	public function getTree($data, $id = 0)
	{
		if (empty($data)) {
			return false;
		}

		$this->rawList = array();
		$this->formatList = array();
		$this->rawList = $data;
		$this->_searchList($id);
		return $this->formatList;
	}

	public function getPath($data, $id)
	{
		$this->rawList = $data;

		while (1) {
			$id = $this->_getPid($id);

			if ($id == 0) {
				break;
			}
		}

		return array_reverse($this->formatList);
	}

	private function _searchList($id = 0, $space = '')
	{
		$childs = $this->getChild($id);

		if (!($n = count($childs))) {
			return NULL;
		}

		$cnt = 1;

		for ($i = 0; $i < $n; $i++) {
			$pre = '';
			$pad = '';

			if ($n == $cnt) {
				$pre = $this->icon[2];
			}
			else {
				$pre = $this->icon[1];
				$pad = ($space ? $this->icon[0] : '');
			}

			$childs[$i][$this->field['fulltitle']] = ($space ? $space . $pre : '') . $childs[$i][$this->field['title']];
			$this->formatList[] = $childs[$i];
			$this->_searchList($childs[$i][$this->field['id']], $space . $pad . '&nbsp;&nbsp;');
			$cnt++;
		}
	}

	private function _getPid($id)
	{
		foreach ($this->rawList as $key => $value) {
			if ($this->rawList[$key][$this->field['id']] == $id) {
				$this->formatList[] = $this->rawList[$key];
				return $this->rawList[$key][$this->field['pid']];
			}
		}

		return 0;
	}
}


?>
