<?php


namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class LiveController extends UserCenter
{

    protected $userRep;

    public function __construct(UserRepository $userRep)
    {
        parent::__construct();

        $this->userRep = $userRep;
    }

    /**
     * 主播认证
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function verified(Request $request)
    {
        $post = $request->only(['mobile', 'real_name', 'id_code']);
        try {
            if ($post['mobile'] != $this->user->mobile) {
                return result(-1, [], '手机号与当前账号不一致');
            }
            if ($this->user->live_verified == 1) {
                return result(-1, [], '已完成主播认证');
            }
            $this->userRep->liveVerified($this->user_id, $post);
        } catch (\Exception $e) {
            return result(-1, [], $e->getMessage());
        }

        return result(0, [], '认证成功');
    }

}