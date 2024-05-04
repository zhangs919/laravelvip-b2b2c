<?php

namespace App\Broadcasting;

use App\Models\Seller;

class PriceBtcusd
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\Seller  $user
     * @return array|bool
     */
    public function join(Seller $user)
    {
        //
    }
}
