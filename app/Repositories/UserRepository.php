<?php

namespace App\Repositories;


use App\Imports\UsersImport;
use App\Models\User;
use App\Models\UserModel;
use App\Models\UserRank;
use App\Models\UserReal;
use App\Services\IP;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserRepository
{
    use BaseRepository;

    protected $model;
    protected $ipService;


    public function __construct()
    {
        $this->model = new UserModel();
        $this->ipService = new IP();
    }

    /**
     * 检查用户是否是店铺管理员
     *
     * @param $condition
     * @return bool
     */
    public function checkIsSeller($condition)
    {
        $condition[] = ['is_seller', 1];
        $data = $this->model->where($condition)->count();
        if ($data > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 检查用户是否是网点管理员
     *
     * @param $condition
     * @return bool
     */
    public function checkIsStore($condition)
    {
        $condition[] = ['is_seller', 2];
        $data = $this->model->where($condition)->count();
        if ($data > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 检查用户是否是主播
     *
     * @param $condition
     * @return bool
     */
    public function checkIsAnchor($condition)
    {
        $condition[] = ['live_verified', 1];
        $data = $this->model->where($condition)->count();
        if ($data > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 注册会员
     *
     * @param array $userData 注册信息
     * @param int $regFrom 注册来源
     * @return mixed
     */
    public function register($userData, $regFrom = 0)
    {
        DB::beginTransaction();
        try{
            // 插入会员表信息
            if (empty($userData['user_name'])) {
                // todo 邮箱注册 需要处理

                $username = $this->makeUsername($userData['mobile'], sysconf('username_prefix'));
                $userData['user_name'] = $username;
                $userData['nickname'] = $userData['user_name'];
            }
            $userData['mobile_validated'] = 1;// 已验证手机
            $userData['password'] = bcrypt($userData['password']);
            $userData['status'] = 1;
            $userData['shopping_status'] = 1;
            $userData['comment_status'] = 1;
            $userData['reg_time'] = date('Y-m-d H:i:s', time());
            $userData['reg_ip'] = $this->ipService->get();// 注册ip
            $userData['reg_from'] = $regFrom; // 注册来源
            $userRet = $this->store($userData);

            // 插入会员认证表信息
            $userRealInsert = [
                'user_id' => $userRet->user_id,
                'status' => 0 // 认证状态 默认为未认证
            ];
//            $userReal = new UserReal();
//            $userReal->fill($userRealInsert);
//            $userReal->save();
            $userRet->userReal()->create($userRealInsert);

            DB::commit();
            return $userRet->user_id;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//                echo $e->getMessage();
//                echo $e->getCode();
            return false;
        }

    }

    /**
     * 更新会员信息
     *
     * @param int $userId 会员id
     * @param $userData
     * @return \App\Repositories\User
     */
    public function modifyUser($userId, $userData)
    {
        if (empty($userData['password'])) { // 留空 则不修改密码
            unset($userData['password']);
        } else {
            $userData['password'] = bcrypt($userData['password']);
        }

        if (isset($userData['surplus_password'])) { // 留空 则不修改余额支付密码
            $userData['surplus_password'] = !empty($userData['surplus_password']) ? bcrypt($userData['surplus_password']) : null;
        }

        $ret = $this->update($userId, $userData);
        return $ret;
    }

    /**
     * 删除会员
     *
     * @param $user_id
     * @return bool
     */
    public function deleteUser($user_id)
    {
        DB::beginTransaction();
        try{
            if (is_array($user_id)) {
                // 批量删除
                // 删除会员表
                User::whereIn('user_id', $user_id)->delete();
                // 删除会员认证表
                UserReal::whereIn('user_id', $user_id)->delete();
            } else {
                // 删除单个
                // 删除会员表
                User::where(['user_id' => $user_id])->delete();
                // 删除会员认证表
                UserReal::where(['user_id' => $user_id])->delete();
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//                echo $e->getMessage();
//                echo $e->getCode();
            return false;
        }
    }

    /**
     * 生成用户名
     *
     * @param $mobile
     * @param string $prefix
     * @return string
     */
    public function makeUsername($mobile, $prefix = 'LRW')
    {
        $username = $prefix . hide_tel($mobile, get_random_words());
        // 检查用户名是否存在
        $user_info = $this->model->where('user_name', $username)->count();
        if ($user_info > 0) {
            for ($i = 1;$i < 999;$i++) {
                $username = $prefix . hide_tel($mobile, get_random_words());
                $user_info = $this->model->where('user_name', $username)->count();
                if(!$user_info) {//查询为空表示当前会员名可用
                    break;
                }
            }
        }

        return $username;
    }

    /**
     * 取会员安全级别
     *
     * @param object $user_info
     * @return int
     */
    public function getUserSecurityLevel($user_info = null)
    {
        $tmp_level = 0;
        if (!empty($user_info->email_validated)) { // 已验证邮箱
            $tmp_level += 1;
        }
        if (!empty($user_info->mobile_validated)) { // 已验证手机
            $tmp_level += 1;
        }
        if (!empty($user_info->surplus_password)) { // 余额支付密码
            $tmp_level += 1;
        }
        return $tmp_level;
    }

    /**
     * 获取某个会员的等级信息
     *
     * @param $rank_point
     * @param bool $show_progress
     * @param null $user_rank
     * @return array
     */
    public function getUserRank($rank_point, $show_progress = true, $user_rank = null)
    {
        if (empty($user_rank)) {
            $user_rank = UserRank::where('type', 0)->orderBy('rank_id', 'asc')->get();
        }

        if ($user_rank->isEmpty()){//如果会员等级设置为空
            $rank_arr['level'] = -1;
            $rank_arr['rank_name'] = '暂无等级';
            return $rank_arr;
        }
        $rank_arr = [];
		foreach ($user_rank as $k=>$v){
			if($rank_point >= $v->min_points && $rank_point < $v->max_points){
				$v->level = $k+1; // 等级
//                    $v->rank_img = get_image_url($v->rank_img);
				$rank_arr = $v->toArray();
			}
		}

        // 计算等级提升进度
        if ($show_progress) {
            if ($rank_arr['level'] >= count($user_rank)) { // 如果已达到顶级会员
                $rank_arr['downrank'] = $rank_arr['level'] - 1; // 下一级会员等级
                $rank_arr['downrank_name'] = $user_rank[$rank_arr['downrank']]['rank_name'];
                $rank_arr['downrank_exppoints'] = $user_rank[$rank_arr['downrank']]['min_points'];
                $rank_arr['uprank'] = $rank_arr['level'] - 2; // 上一级会员等级
                $rank_arr['uprank_name'] = $user_rank[$rank_arr['uprank']]['rank_name'];
                $rank_arr['uprank_exppoints'] = $user_rank[$rank_arr['uprank']]['min_points'];
                $rank_arr['less_exppoints'] = 0;
                $rank_arr['exppoints_rate'] = 100;
            } elseif (!empty($rank_arr)) {
                $rank_arr['downrank'] = $rank_arr['level']; // 下一级会员等级
                $rank_arr['downrank_name'] = $user_rank[$rank_arr['downrank']]['rank_name'];
                $rank_arr['downrank_exppoints'] = $user_rank[$rank_arr['downrank']]['min_points'];
                $rank_arr['uprank'] = $user_rank[$rank_arr['level'] -1 ]['level']; // 上一级会员等级
                $rank_arr['uprank_name'] = $user_rank[$rank_arr['uprank']]['rank_name'];
                $rank_arr['uprank_exppoints'] = $user_rank[$rank_arr['uprank']]['min_points'];
                $rank_arr['less_exppoints'] = 0;
                $rank_arr['exppoints_rate'] = 100;
                $rank_arr['less_exppoints'] = $rank_arr['uprank_exppoints'] - $rank_point;
                $rank_arr['exppoints_rate'] = round(($rank_point - $user_rank[$rank_arr['level']+1]['min_points'])/($rank_arr['uprank_exppoints'] - $user_rank[$rank_arr['level']+1]['min_points'])*100,2);
            } else {
                // 新注册会员
                $rank_arr['downrank'] = 0;//下一级会员等级
                $rank_arr['downrank_name'] = $user_rank[$rank_arr['downrank']]['rank_name'];
                $rank_arr['downrank_exppoints'] = $user_rank[$rank_arr['downrank']]['min_points'];
                $rank_arr['uprank'] = 0;//上一级会员等级
                $rank_arr['uprank_name'] = '';
                $rank_arr['uprank_exppoints'] = '';
                $rank_arr['less_exppoints'] = $rank_arr['downrank_exppoints'];
                $rank_arr['exppoints_rate'] = 0;
            }
        }
        return $rank_arr;
    }

    /**
     * 批量导入excel数据
     *
     * @param string $filename excel 文件路径
     * @param string $password 批量设置会员密码
     * @return int 返回成功条数
     */
    public function batchImport($filename, $password)
    {
        $data = Excel::toArray(new UsersImport(), $filename);
        $user_data = array_first($data);
        if (count($user_data) <= 1) { // 除去第一行，判断是否有大于1条数据
            return 0;
        }
        $success_count = 0;

        foreach ($user_data as $k=>$v) {

            if ($k == 0) continue; // 跳出第一个循环

            $mobile = $v[1]; // 会员名称字段 最好固定成手机号
            // 判断是否存在
            $usernameExist = User::where('user_name', $mobile)->count();
            $mobileExist = User::where('mobile', $mobile)->count();

            if (!$usernameExist && !$mobileExist) {
                $insert = [
                    'mobile' => $mobile,
                    'password' => $password
                ];
                $regFrom = 5; // 注册来源 5后台添加
                $ret = $this->register($insert, $regFrom);
                if ($ret !== false) {
                    $success_count++; // 成功加1
                }
            }
        }
        return $success_count;
    }

    /**
     * 主播认证
     *
     * @param $user_id
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function liveVerified($user_id, $data)
    {
        DB::beginTransaction();
        try {
            // 验证手机验证码
            $cache_id = CACHE_KEY_SMS_CAPTCHA[0].':'.$user_id.':6';
            $sms_captcha = cache()->get($cache_id);
            if (env('APP_ENV') == 'production' && $sms_captcha != $data['sms_captcha']) {
                throw new \Exception('短信验证码无效');
            }
            // 写入用户认证数据
            $user_real = UserReal::where([['user_id', $user_id]])->first();
            if (!empty($user_real)) {
                if ($user_real->status == 0) {
                    $user_real->status = 1;
                    $user_real->real_name = $data['real_name'];
                    $user_real->id_code = $data['id_code'];
                    $user_real->save();
                } else {
                    // 已完成实名认证 不做修改

                }
            } else {
                $insert = [
                    'real_name' => $data['real_name'],
                    'id_code' => $data['id_code'],
                    'user_id' => $user_id,
                    'status' => 1,
                ];
                $user_real_model = new UserReal();
                $user_real_model->fill($insert);
                $user_real_model->save();
            }

            // 更新用户主播认证状态
            $update = ['live_verified' => 2];// 认证中（待审核）
            User::where([['user_id', $user_id]])->update($update);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

}
