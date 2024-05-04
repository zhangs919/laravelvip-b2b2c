<?php

namespace App\Services;

use Illuminate\Http\Request;

class IP
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * IP constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get the client ip.
     *
     * @return mixed|string
     */
    public function get()
    {
        $ip = \request()->getClientIp();

        if($ip == '::1' || empty($ip)) {
            $ip = '127.0.0.1';
        }

        return $ip;
    }
}
