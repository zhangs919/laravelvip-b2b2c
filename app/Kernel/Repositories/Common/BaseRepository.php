<?php

namespace App\Kernel\Repositories\Common;


use Illuminate\Support\Facades\Schema;

/**
 * Class BaseRepository
 * @package App\Kernel\Repositories\Common
 */
class BaseRepository
{
    /**
     * 模型对象结果集转换成数组
     * @param object $query
     * @return mixed
     */
    public static function getToArray(object $query)
    {
        return $query->toArray();
    }

    /**
     * 返回数组列表
     * @param object $query
     * @return mixed
     */
    public static function getToArrayGet(object $query)
    {
        return $query->get()->toArray();
    }

    /**
     * 返回一条数据数组
     * @param object $query
     * @return array
     */
    public static function getToArrayFirst(object $query)
    {
        return !empty($query->first()) ? $query->first()->toArray() : [];
    }

    /**
     * 获取指定键值数组数据
     *
     * @param array $list
     * @param string $key
     */
    public static function getKeyPluck($list = [], $key = '')
    {
        return array_column($list, $key);
    }

    /**
     * 获取字符串转数组
     * @param string $val
     * @param string $str
     * @return false|string[]
     */
    public static function getExplode($val = '', $str = ',')
    {
        return explode($str, $val);
    }

    /**
     * 合并数组
     * @param array $list
     * @param array $row
     * @return mixed
     */
    public static function getArrayMerge($list = [], $row = [])
    {
        return array_merge($list, $row);
    }

    /**
     * 获取数组计算指定键值数量
     * @param array $list
     * @param string $str
     * @return float|int
     */
    public static function getSum($list = [], $str = '')
    {
        return array_sum(array_column($list, $str));
    }

    /**
     * 将集合拆成多个给定大小的小集合
     * @param array $list
     * @param int $size
     * @return mixed
     */
    public static function getArrayChunk($list = [], $size = 0)
    {
        return array_chunk($list, $size);
    }

    //过滤表字段数组
    public static function getArrayfilterTable($other = [], $table = '')
    {
        $result = [];
        // 获取指定表的所有字段
        $columns = Schema::getColumnListing($table);
        foreach ($other as $field=>$value) {
            if (in_array($field, $columns)) {
                $result[$field] = $value;
            }
        }

        return $result;
    }
}
