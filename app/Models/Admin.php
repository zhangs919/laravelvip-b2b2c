<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
//class Admin extends BaseModel
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'role_id', 'user_type', 'user_name', 'password', 'real_name', 'mobile', 'email',
        'tel', 'status', 'visit_count', 'valid_time', 'valid_time_format', 'last_time',
        'last_ip', 'access_token', 'auth_key', 'auth_codes', 'ec_salt'
    ];

    protected $hidden = ['password','remember_token'];

    protected $primaryKey = 'user_id'; // 主键id

    public function adminRole()
    {
        return $this->belongsTo(AdminRole::class, 'role_id', 'role_id');
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
        $sortname = isset($condition['sortname']) ? $condition['sortname'] : request('sortname', $this->primaryKey);
        $sortorder = isset($condition['sortorder']) ? $condition['sortorder'] : request('sortorder', 'asc');

        $query = $this->select($field)->where($where)->with('adminRole');

        // 关联查询数量
        if (isset($condition['relation'])) {
            $query = $query->withCount($condition['relation']);
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
                $newList[$value->$column] = $value;
            }
            $list = $newList;
//            dd($list);
        }

        return [$list, $count];
    }

    public function clientValidate(Request $request, $requestModel)
    {
        $attribute = $request->get('attribute');
        $requestModel = $request->get($requestModel);
        $scenario = $request->get('scenario');
        $id = !empty($requestModel[$this->primaryKey]) ? $requestModel[$this->primaryKey] : '';
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
            return false;
        }

        return true;
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

}
