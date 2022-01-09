<?php

namespace App\Modules\Seller\Http\Controllers;

use App\Http\Controllers\Controller;
use Workerman\Worker;

class WorkerManController extends Controller
{


//    protected $redirectTo = '/main';
//    protected $username;

    public function __construct()
    {

    }

    public function test()
    {
        // 创建一个 Websocket Server
        $ws_worker = new Worker("websoket://0.0.0.0:2346");
        // 4 process
        $ws_worker->count = 4;

        $ws_worker->onConnect = function ($connection) {
            echo "New Connection\n";
        };

        $ws_worker->onMessage = function ($connection, $data) {
            $connection->send('Hello '.$data);
        };

        $ws_worker->onClose = function ($connection) {
            echo "Connection Closed\n";
        };

        // Run Server
        Worker::runAll();
    }

    public function test_view()
    {
        return view('workerman.test');
    }



}