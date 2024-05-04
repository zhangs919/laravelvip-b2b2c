<?php

namespace App\Api\V1\Controllers;

use App\Api\Foundation\Controllers\BaseController;
use App\Models\UserPush;
use Illuminate\Http\Request;

class PushController extends BaseController
{
    /**
     * Create a new PushController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api');
    }

    public function updateCid(Request $request)
    {
        $cid = $request->input('cid');
        $client = $request->input('client');
        if (!$cid || !$client) {
            return result(-1, null, INVALID_PARAM);
        }

        $user_id = auth()->user()->user_id ?? 0;
        $first = UserPush::where(["cid" => $cid, "user_id" => $user_id, 'client' => $client])->first();
        if (empty($first)) {
            $first = UserPush::create(["cid" => $cid, "user_id" => $user_id, 'client' => $client]);
        } else {
            $first->updated_at = date("Y-m-d H:i:s", time());
            $first->save();
        }

        return $this->success($first);
    }
}