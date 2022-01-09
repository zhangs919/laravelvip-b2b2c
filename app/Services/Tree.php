<?php


namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;


/**
 * 通用的树型类，可以生成任何树型结构
 */
class Tree extends Controller {

    protected $formatTree;//用于树型数组完成递归格式的全局变量

    /**
     * 把返回的数据集转换成Tree
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = [];
        if(is_array($list) || is_object($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                } else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent['childs'][] = $data[$pk];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * 将树子节点加层级成列表
     */
    protected function _toFormatTree($tree, $level = 1) {
        foreach ($tree as $key => $value) {
            $temp = $value;
            if (isset($temp['_child'])) {
                $temp['_child'] = true;
                $temp['level'] = $level;
            } else {
                $temp['_child'] = false;
                $temp['level'] = $level;
            }
            array_push($this->formatTree, $temp);
            if (isset($value['_child'])) {
                $this->_toFormatTree($value['_child'], ($level + 1));
            }
        }
    }

    protected function cat_empty_deal($cat, $next_parentid, $pid='pid', $empty = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") {
        $str = "";
        if ($cat[$pid]) {
            for ($i=2; $i < $cat['level']; $i++) {
                $str .= $empty; //."&nbsp;";
            }
            if ($cat[$pid] != $next_parentid && !$cat['_child']) {
                $str .= $empty; //."&nbsp;&nbsp;";
            } else {
                $str .= $empty;//."◢&nbsp;";
            }
        }
        return $str;
    }

    public function toFormatTree($list,$title = 'title',$pk='id',$pid = 'pid',$root = 0, $empty = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"){
        if (empty($list)) {
            return false;
        }
        $list = $this->list_to_tree($list,$pk,$pid,'_child',$root);
        $this->formatTree = $data = [];
        $this->_toFormatTree($list);
        foreach ($this->formatTree as $key => $value) {
            $index = ($key+1);
            $next_parentid = isset($this->formatTree[$index][$pid]) ? $this->formatTree[$index][$pid] : '';
            $value['level_show'] = $this->cat_empty_deal($value, $next_parentid, $pid, $empty);
            $value['title_show'] = $value['level_show'].$value[$title];
            $data[] = $value;
        }
        return $data;
    }
}