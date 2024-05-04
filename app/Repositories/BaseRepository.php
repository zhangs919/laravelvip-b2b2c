<?php

namespace App\Repositories;

use Illuminate\Http\Request;

trait BaseRepository
{

    /**
     * 批量更新
     * 默认以数组的第一个元素为更新条件
     *
     * @param array $multipleData
     * @return mixed
     */
    public function updateBatch($multipleData = [])
    {
        return $this->model->updateBatch($multipleData);
    }

    /**
     * Get number of records
     *
     * @return array
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * Update columns in the record by id.
     *
     * @param $id
     * @param $input
     * @return mixed
     */
    public function updateColumn($id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    /**
     * Destroy a model.
     *
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Get model by id.
     *
     * @param $id
     * @return mixed
     */
    public function getById($id, $field = [])
    {
//        if (!empty($field)) {
//            return $this->model->select($field)->findOrFail($id);
//        } else {
//            return $this->model->findOrFail($id);
//        }

        if (!empty($field)) {
            return $this->model->select($field)->find($id);
        } else {
            return $this->model->find($id);
        }
    }

    /**
     * Get all the records
     *
     * @return array User
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Get number of the records
     *
     * @param  int $number
     * @param  string $sort
     * @param  string $sortColumn
     * @return Paginate
     */
    public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Store a new record.
     *
     * @param  $input
     * @return User
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * Update a record by id.
     *
     * @param  $id
     * @param  $input
     * @return User
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);
        // 清除缓存
        !empty($input['code']) && cache()->pull('sysconf_'.$input['code']);

        return $this->save($this->model, $input);
    }

    /**
     * Save the input's data.
     *
     * @param  $model
     * @param  $input
     * @return User
     */
    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
    }

    public function getByField($field, $value)
    {
        $info = $this->model->getByField($field, $value);
        return $info;
    }

    /**
     * 根据id获取指定字段值
     * @param int $id 主键id
     * @param string $field 字段名称
     * @return mixed
     */
    public function getFieldById($id, $field)
    {
        return $this->model->getFieldById($id, $field);
    }

    /**
     * 获取列表
     * 可以被重写
     *
     * @param array $condition
     * @param string $column
     * @return mixed
     */
    public function getList($condition = [], $column = '')
    {
        $data = $this->model->getList($condition, $column);
        return $data;
    }

    /**
     * 删除单条记录
     * 可以被重写
     *
     * @param $id
     * @return bool
     */
    public function del($id)
    {
        if (empty($id)) {
            return false;
        }

        $ret = $this->model->del($id);
        return $ret;
    }

    /**
     * 批量删除
     * 可以被重写
     *
     * @param $ids
     * @return bool
     */
    public function batchDel($ids)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }

        $ret = $this->model->batchDel($ids);
        return $ret;
    }

    /**
     * 检查是否显示
     * @rewritable
     *
     * @param $id
     * @return mixed
     */
    public function checkShow($id)
    {
        $result = $this->model->checkShow($id);
        return $result;
    }

    /**
     * 改变显示状态
     * @rewritable
     *
     * @param $id
     * @return mixed
     */
    public function changeShow($id)
    {
        $ret = $this->model->changeShow($id);
        return $ret;
    }

    /**
     * 检查是否启用
     * @rewritable
     *
     * @param $id
     * @return mixed
     */
    public function checkEnable($id)
    {
        $result = $this->model->checkEnable($id);
        return $result;
    }

    /**
     * 改变启用状态
     * @rewritable
     *
     * @param $id
     * @return mixed
     */
    public function changeEnable($id)
    {
        $ret = $this->model->changeEnable($id);
        return $ret;
    }

    /**
     * 检查status状态
     * @rewritable
     *
     * @param $id
     * @return mixed
     */
    public function checkStatus($id)
    {
        $result = $this->model->checkStatus($id);
        return $result;
    }

    /**
     * 改变status状态
     * @rewritable
     *
     * @param $id
     * @return mixed
     */
    public function changeStatus($id)
    {
        $ret = $this->model->changeStatus($id);
        return $ret;
    }

    /**
     * 检查状态
     * @rewritable
     *
     * @param $id
     * @param $statusField
     * @param null $primaryKey
     * @return mixed
     */
    public function checkState($id, $statusField, $primaryKey = null)
    {
        $result = $this->model->checkState($id, $statusField, $primaryKey);
        return $result;
    }

    /**
     * 改变状态
     * @rewritable
     *
     * @param $id
     * @param $statusField
     * @param null $primaryKey
     * @return mixed
     */
    public function changeState($id, $statusField, $primaryKey = null)
    {
        $ret = $this->model->changeState($id, $statusField, $primaryKey);
        return $ret;
    }

    /**
     * 改变状态(反转)
     * @rewritable
     *
     * @param $id
     * @param $statusField
     * @param null $primaryKey
     * @return mixed
     */
    public function changeStateReverse($id, $statusField, $primaryKey = null)
    {
        $ret = $this->model->changeStateReverse($id, $statusField, $primaryKey);
        return $ret;
    }

    public function clientValidate(Request $request, $requestModel, $id = null)
    {
        $result = $this->model->clientValidate($request, $requestModel, $id);
        return $result;
    }

    public function editSort(Request $request)
    {
        $ret = $this->model->editSort($request);
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
        $ret = $this->model->editInfo($request);
        return $ret;
    }

    public function batchUpdate($field, $value, $update)
    {
        $ret = $this->model->batchUpdate($field, $value, $update);
        return $ret;
    }

    public function addAll($insertAll = [])
    {
        $ret = $this->model->addAll($insertAll);
        return $ret;
    }
}
