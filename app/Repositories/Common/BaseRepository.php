<?php

namespace App\Repositories\Common;

use App\Kernel\Repositories\Common\BaseRepository as Base;

/**
 * Class BaseRepository
 * @method static getToArray(object $query) 模型对象结果集转换成数组
 * @method static getToArrayGet(array $query = []) 返回数组列表
 * @method static getToArrayFirst(array $query = []) 返回一条数据数组
 * @method static getSortBy($list = [], $sort = '', $order = 'asc') 按指定key排序，返回排序数组数据
 * @method static getSort(array $query = []) 按数组值排序，返回排序数组数据[默认从小到大]
 * @method static sortKeys($list = [], $order = 'asc') 按key值排序，返回排序数组数据
 * @method static getTake($list = [], $mun = 0) 获取指定数组条数
 * @method static getKeyPluck($list = [], $key = '') 获取指定键值数组数据
 * @method static getGroupBy($list = [], $val = '') 获取组合数组的新数组
 * @method static getFlatten($list = [], $mun = 0) 获取多维数组转为一维数组
 * @method static getExplode($val = '', $str = ',') 获取字符串转数组
 * @method static getImplode($val = [], $where = ['str' => '', 'replace' => ',', 'is_need' => 0]) 获取字符串转数组
 * @method static getNonOneDimensionalArray($list = []) 判断是否非一维数组[【false：一维数组, true：多维数组】]
 * @method static getArrayMerge($list = [], $row = []) 合并数组
 * @method static getSum($list = [], $str = '') 获取数组计算指定键值数量
 * @method static getWhere($list = [], $where = ['str' => '', 'estimate' => '', 'val' => '']) 获取数组计算指定键值数量
 * @method static getArrayFlip($list = []) 交换数组中的键和值
 * @method static getArrayIntersect($list = [], $columns = []) 数组的「键」进行比较，计算数组的交集
 * @method static getArrayIntersectByKeys($list = [], $columns = []) 数组的「值」进行比较，计算数组的交集
 * @method static getArrayDiff($list = [], $columns = []) 数组的「值」进行比较， 计算数组的差集
 * @method static getArrayDiffKeys($list = [], $columns = []) 数组的「键」进行比较， 计算数组的差集
 * @method static getArrayUnique($list = [], $key = '') 移除数组中重复的值
 * @method static getCacheForeverlist($list = []) 存储缓存数组指定内容
 * @method static getCacheForgetlist($list = []) 清除数组指定缓存
 * @method static getBrowseUrl() 获取接口数据
 * @method static getArrayExcept($list = [], $key = []) 数组内容移除指定键名项
 * @method static setDiskForever($name = 'file', $data = []) 生成永久缓存文件
 * @method static getDiskForeverData($name = '') 获取缓存文件内容
 * @method static getDiskForeverDelete($name = '') 删除缓存文件
 * @method static getDiskForeverExists($name = '') 判断缓存文件是否存在
 * @method static getArrayMin($list = [], $str = '') 获取最小值
 * @method static getArrayMax($list = [], $str = '') 获取最大值
 * @method static getArrayCount($list = []) 计算数组数量
 * @method static getArrayCrossJoin($list = [], $page = 1, $size = 0) 多数组交集组合新数组
 * @method static getPaginate($list = [], $size = 15, $options = []) 分页
 * @method static toSql($builder) 打印SQL语句
 * @method static getArrayKeys($list = []) 返回以键名为集合的数组
 * @method static getArrayPush($list = [], $push = '') 将值添加到数组
 * @method static getArraySearch($list = [], $val = '', $bool = null) 查找指定值是否存在在数组中
 * @method static getArrayfilterTable($other = [], $table = '') 过滤表字段数组
 * @method static getDbRaw($list = []) 生成原生SQL
 * @method static getArrayCollapse($list = []) 将多个数组合并成一个数组[$list = [$arr1, $arr2] = array_merge($arr1, $arr2) 方法的强化版]
 * @method static dscUnlink($file = '', $path = '') 删除文件
 * @method static getTrimUrl($url = '') 处理Url
 * @method static getArrayAll($list = []) 返回该集合表示的底层数组
 * @method static getArrayAvg($list = [], $key = '') 返回给定键的平均值，可选值 $key 指定数组键的数值平均值
 * @method static getArrayChunk($list = [], $size = 0) 将集合拆成多个给定大小的小集合
 * @method static getArrayCombine($key = [], $value = []) 将一个集合的值作为键，再将另一个数组或集合的值作为值合并成一个集合
 * @method static getArrayConcat($list = [], $push = []) 将给定的 数组 或集合值追加到集合的末尾
 * @method static getArrayContains($list = [], $value = '') 判断集合是否包含指定的集合项
 * @method static getContainsTwoArray($list = [], $key = '', $value = '') 传递一组键 / 值对，可以判断该键 / 值对是否存在于集合中
 * @method static getArrayOnly($list = [], $key = []) 返回集合中所有指定键的集合项
 * @method static getArrayFilterData($list = []) 移除 null、false、''、[]， 0 等数据数组
 * @method static getArrayFirst($list = []) 获取集合中的第一个元素
 * @method static getArraySqlFirst($list = [], $sql = []) 二维数组仿SQL查询获取一条数据
 * @method static getArraySqlGet($list = [], $sql = [], $is_value = 0) 二维数组仿SQL查询获取多条数据[$is_value等于0时：array_values]
 * @method static getArrayForget($list = [], $key = '') 将通过指定的键来移除集合中对应的内容
 * @method static arrayGet($list = [], $key = '', $default = '') 返回指定键的集合项，如果该键在集合中不存在，则返回空
 * @method static getForPage($list = [], $page = 1, $size = 3, $type = 0) 返回一个含有指定页码数集合项的新集合。这个方法接受页码数作为其第一个参数，每页显示的项数作为其第二个参数
 * @method static getHasKey($list = [], $key = []) 判断集合中是否存在指定键
 * @method static getArrayLast($list = []) 返回集合中通过指定条件测试的最后一个元素
 * @method static getArraySum($list = [], $key = '', $symbol = '*') 将集合传给指定的回调函数并返回运算总和结果[注明：当$key是个数组时，例：$key = ['price', 'number']，则为数组的price * number之和，$symbol:+、-、*、/，默认*]
 * @method static getArrayHierarchyNum($list = []) 获取数组循环的次数
 * @method static getColumn($list = [], $val = '', $key = '') 获取二维数组的值列表
 * @method static keepSortKeys($list = [], $sort = '', $extend = '') 保持key值排序[从小到大排序] 说明：当 $extend 不为空时，则$extend是key名称sort的数组下面的key名称
 * @method static keepSortDescKeys($list = [], $sort = '', $extend = '', $extend = '') 保持key值排序[从大到小排序]
 * @method static getArrayReversed($list = []) 【数组】倒转集合项的顺序
 * @method static getArrayCompose($list = [], $key = '', $val = '') 数组中以值重新组成新数组
 * @method static SearchIntersectArray($search = [], $list = [], $type = 'key') 返回全部都存在的数组
 * @method static getKeyOrValueFilter($list = [], $where = ['value' => '', 'key' => '', 'condition' => '='], $valueOrKey = 'val') 根据key[键]或者value[值]查找新的数组集合
 * @method static recursiveNullVal($list = []) 将数组null值转为空
 * @method static valueErrorArray($arr = [], $calculationField = '', $compareField = '', $default = 1) 处理数组中指定额度总金额某个值的差额
 * @method static getQuery() 调试打印查询sql, 执行时间
 * @package App\Repositories\Common
 */
class BaseRepository extends Base
{

}
