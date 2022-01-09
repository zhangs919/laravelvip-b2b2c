<?php

namespace App\Policies;

use App\Models\OrderInfo;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function own(User $user, OrderInfo $orderInfo)
    {
        return $orderInfo->user_id == $user->user_id;
    }
}
