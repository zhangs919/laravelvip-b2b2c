<?php

namespace App\Policies;

use App\Models\Seller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
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

    public function own(User $user, UserAddress $userAddress)
    {
        return $userAddress->user_id == $user->user_id;
    }
}
