<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{


    /**
     * 批量更新 todo 是否有bug 有待检查
     * 更新条件为数组的第一个元素
     *
     * @param array $multipleData
     * @return bool
     */
    public function updateBatch($multipleData = [])
    {
        try {
            if (empty($multipleData)) {
                throw new \Exception("数据不能为空");
            }
            $tableName = DB::getTablePrefix() . $this->getTable(); // 表名
            $firstRow  = current($multipleData);

            $updateColumn = array_keys($firstRow);
            // 默认以id为条件更新，如果没有ID则以第一个字段为条件
            $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
            unset($updateColumn[0]);
            // 拼接sql语句
            $updateSql = "UPDATE " . $tableName . " SET ";
            $sets      = [];
            $bindings  = [];
            foreach ($updateColumn as $uColumn) {
                $setSql = "`" . $uColumn . "` = CASE ";
                foreach ($multipleData as $data) {
                    $setSql .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                    $bindings[] = $data[$referenceColumn];
                    $bindings[] = $data[$uColumn];
                }
                $setSql .= "ELSE `" . $uColumn . "` END ";
                $sets[] = $setSql;
            }
            $updateSql .= implode(', ', $sets);
            $whereIn   = collect($multipleData)->pluck($referenceColumn)->values()->all();
            $bindings  = array_merge($bindings, $whereIn);
            $whereIn   = rtrim(str_repeat('?,', count($whereIn)), ',');
            $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
            // 传入预处理sql语句和对应绑定数据
            return DB::update($updateSql, $bindings);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getByField($field, $value)
    {
        $info = $this->where($field, $value)->first();
        return $info;
    }

    public function getList($condition = [], $column = '')
    {
//        dd($condition);
        $pageArr = request()->all();
        $curPage = !empty($pageArr['page']['cur_page']) ? $pageArr['page']['cur_page'] : 1;
        $pageSize = !empty($pageArr['page']['page_size']) ? $pageArr['page']['page_size'] : 10;

        if (isset($condition['cur_page'])) {
            $curPage = $condition['cur_page'];
        }
        if (isset($condition['page_size'])) {
            $pageSize = $condition['page_size'];
        }

//        $offset = ($curPage - 1) * $pageSize; // 从第几条数据开始查询
        $field = !empty($condition['field']) ? $condition['field'] : '*';
        $where = !empty($condition['where']) ? $condition['where'] : [];
//        $sortname = isset($condition['sortname']) ? $condition['sortname'] : request('sortname', $this->primaryKey);
//        $sortorder = isset($condition['sortorder']) ? $condition['sortorder'] : request('sortorder', 'asc');

        $sortname = request('sortname', $this->primaryKey);
        $sortorder = request('sortorder', 'desc');

        // 排序规则
        $sortname = !empty($condition['sortname']) ? $condition['sortname'] : $sortname;
        $sortorder = !empty($condition['sortorder']) ? $condition['sortorder'] : $sortorder;

        $query = $this->select($field)->where($where);

        if (!empty($condition['where_raw'])) { // 查询某个字段中包含某个值
            $query = $query->whereRaw($condition['where_raw']['field'], $condition['where_raw']['condition']);
        }

        if (!empty($condition['not_in'])) {
            $query = $query->whereNotIn($condition['not_in']['field'], $condition['not_in']['condition']);
        }

        if (!empty($condition['in'])) {
            $query = $query->whereIn($condition['in']['field'], $condition['in']['condition']);
        }

        if (!empty($condition['between'])) {
            $query = $query->whereBetween($condition['between']['field'], $condition['between']['condition']);
        }

        // 链接查询
        if (!empty($condition['join'])) {
            extract($condition['join']);
            $query = $query->join($join_table, $join_first, $join_operator, $join_second, $join_type, $join_where);
        }

        // 关联查询数量
        if (!empty($condition['relation'])) {
            $query = $query->withCount($condition['relation']);
        }
        // 关联查询其他表 支持关联多个表 多个为数组
        if (!empty($condition['with'])) {
            if (is_array($condition['with'])) {
                // 关联多个表
                foreach ($condition['with'] as $with) {
                    // todo
                    $query = $query->with($with);
                }
            } elseif (is_string($condition['with'])) {
                // 关联单个表
                $query = $query->with($condition['with']);
            }
        }

        $count = $query->count();

        // 将总的记录条数写入缓存 session('list_total')
        session('list_total', $count);


        if (isset($condition['limit']) && $condition['limit'] == 0) {
            // 查询全部数据
            $list = $query
//            ->offset($offset)
//            ->limit($pageSize)
                ->orderBy($sortname, $sortorder)
                ->get();
        } else {
            $list = $query
//            ->offset($offset)
//            ->limit($pageSize)
                ->forPage($curPage, $pageSize)
                ->orderBy($sortname, $sortorder)
                ->get();
        }

        if ($column != '') {//dd(DB::table($this->table));
            // 以某个字段名为键名返回列表
            $newList = [];
            foreach ($list as &$value) {
                $newList[$value->$column][] = $value;
            }
            $list = $newList;
//            dd($list);
        }

        return [$list, $count];
    }

    public function del($id)
    {
        if (empty($id)) {
            return false;
        }

        $ret = $this->where([$this->primaryKey=>$id])->delete();
        return $ret;
    }

    public function batchDel($ids)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }

        $ret = $this->whereIn($this->primaryKey, $ids)->delete();
        return $ret;
    }

    public function checkShow($id)
    {
        $result = $this->checkState($id, 'is_show');
        return $result;
    }

    public function changeShow($id)
    {
        $ret = $this->changeState($id, 'is_show');
        return $ret;
    }

    public function checkEnable($id)
    {
        $result = $this->checkState($id, 'is_enable');
        return $result;
    }

    public function changeEnable($id)
    {
        $ret = $this->changeState($id, 'is_enable');
        return $ret;
    }

    public function checkStatus($id)
    {
        $result = $this->checkState($id, 'status');
        return $result;
    }

    public function ChangeStatus($id)
    {
        $ret = $this->changeState($id, 'status');
        return $ret;
    }


    public function checkState($id, $statusField, $primaryKey = null)
    {
        if ($primaryKey == null) {
            $primaryKey = $this->primaryKey;
        }
        $result = $result = $this->where($primaryKey, $id)->first([$statusField]); // 查询当前状态
        return $result[$statusField];
    }

    public function changeState($id, $statusField, $primaryKey = null)
    {
        if ($primaryKey == null) {
            $primaryKey = $this->primaryKey;
        }

        $isValid = $this->checkState($id, $statusField, $primaryKey); // 查询当前状态
        if ($isValid) {
            // 当前状态是1，则设置为否0
            $ret = $result = $this->where($primaryKey, $id)->update([$statusField => 0]);
        } else {
            // 当前状态是0，则设置为是1
            $ret = $result = $this->where($primaryKey, $id)->update([$statusField => 1]);
        }

        if ($ret === false) {
            return false;
        }
        return $isValid ? 0 : 1;
    }

    public function clientValidate(Request $request, $requestModel, $id = null)
    {
        $attribute = $request->get('attribute');
        $requestModel = $request->get($requestModel);
        $scenario = $request->get('scenario');
        if (!$id) {
            $id = !empty($requestModel[$this->primaryKey]) ? $requestModel[$this->primaryKey] : '';
        }
        $name = $requestModel[$attribute];
        $result = true;
        if ($scenario == 'update' || $id != '') {
            // 更新操作 验证重复
            $condition = [
                [$attribute,'=', $name],
                [$this->primaryKey, '!=', $id]
            ];
            $result = $this->where($condition)->count();
        } elseif($scenario == 'create') {
            $result = $this->where($attribute, $name)->count();
        } else {
            // 默认是新增
            $result = $this->where($attribute, $name)->count();
        }
        if ($result) {
            $msg = trans('global.'.$attribute).'"'.$name.'"已经被占用了。';
            return result(false, '', $msg, [], false);
//            return false;
        }
        return result(true, '', '', [], false);
//        return true;
    }

    public function editSort(Request $request)
    {
        // 如果传入的是id为空 则使用主键id
        $primaryKey = !empty($request->post('id', 0)) ? 'id' : $this->primaryKey;
        $id = intval($request->post($primaryKey));

        $title = $request->post('title');
        $value = intval($request->post('value'));

        $ret = $this->where($this->primaryKey, $id)->update([$title => $value]);

        return $ret;
    }

    /**
     * 修改信息 如：名称/排序等
     *
     * @param Request $request
     * @return mixed
     */
    public function editInfo(Request $request)
    {
        // 如果传入的是id为空 则使用主键id
        $primaryKey = !empty($request->post('id', 0)) ? 'id' : $this->primaryKey;
        $id = intval($request->post($primaryKey));

        $title = $request->post('title');
        $value = $request->post('value');

        $ret = $this->where($this->primaryKey, $id)->update([$title => $value]);

        return $ret;
    }

    public function batchUpdate($field, $value, $update)
    {
        if (is_array($value)) {
            // 如果是数组 批量处理
            $query = $this->whereIn($field, $value);
        } else {
            $query = $this->where($field, $value);
        }
        $ret = $query->update($update);
        return $ret;
    }

    /**
     * 批量插入数据
     *
     * @param $data
     * @return mixed
     */
    public function addAll($data)
    {
        $rs = DB::table($this->getTable())->insert($data);
        return $rs;
    }
}
