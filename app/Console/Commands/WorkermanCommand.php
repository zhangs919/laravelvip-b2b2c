<?php

namespace App\Console\Commands;

use App\Workerman\Events;
use App\Workerman\Events4431;
use App\Workerman\Events7272;
use App\Workerman\Events8181;
use Illuminate\Support\Facades\Storage;
use stdClass;
use Workerman\Worker;
use Illuminate\Console\Command;

/**
 * 监听 4431/7272/8181 端口
 * Class WorkermanCommand
 * @package App\Console\Commands
 */
class WorkermanCommand extends Command
{

    protected $signature = 'workman {action} {--d}';
    protected $description = 'Start a Workerman server.';

    protected $ports = [
        4431,
        7272,
//        8181
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /** * Execute the console command. * * @return mixed */
    public function handle()
    {
        global $argv;
        $arg = $this->argument('action');
        $argv[1] = $argv[2];
        $argv[2] = isset($argv[3]) ? "-d" : ''; // 后台进程运行 -d
//        echo json_encode($argv)."\n";
        switch ($arg) {
            case 'start':
                $this->start();
                break;
            case 'stop':
                $this->stop();
                break;
            case 'restart':
                $this->restart();
                break;
            case 'reload':
                $this->reload();
                break;
        }
    }

    /**
     * 启动
     */
    private function start()
    {
        foreach ($this->ports as $k => $port) {
            // 创建一个Worker监听端口，不使用任何应用层协议
            // 证书最好是申请的证书
            $context = array(
                'ssl' => array(
                    'local_cert' => storage_path('app/certs/live/fullchain.pem'), // 也可以是crt文件
                    'local_pk'   => storage_path('app/certs/live/privkey.key'),
                    'verify_peer' => false
                )
            );
            $worker = new Worker("websocket://0.0.0.0:$port", $context);

            // 设置transport开启ssl，websocket+ssl即wss
            $worker->transport ='ssl';

            global $text_worker;
            $text_worker = new stdClass();
            $text_worker->connections = array();//在线用户连接对象
            $text_worker->uidInfo = array();//在线用户的用户信息
            $text_worker->uidConnections = array();//在线用户的用户信息

            // 设置实例的名称
            $worker->name = "websocket worker port:$port";

            // 启动4个进程对外提供服务
            $worker->count = 4;
            echo $worker->id . "\n";
            if ($port == 4431) {
                $handler = Events4431::class;
            } elseif ($port == 7272) {
                $handler = Events7272::class;
            } elseif ($port == 8181) {
                $handler = Events8181::class;
            }
            // 连接时回调
            $worker->onConnect = [$handler, 'onConnect'];
            // 收到客户端信息时回调
            $worker->onMessage = [$handler, 'onMessage'];
            // 进程启动后的回调
            $worker->onWorkerStart = [$handler, 'onWorkerStart'];
            // 断开时触发的回调
            $worker->onClose = [$handler, 'onClose'];
        }

        // 运行worker
        Worker::runAll();
    }

    /**
     * 关闭
     */
    private function stop()
    {
        foreach ($this->ports as $port) {
            // 证书最好是申请的证书
            $context = array(
                'ssl' => array(
                    'local_cert' => storage_path('app/certs/live/fullchain.pem'), // 也可以是crt文件
                    'local_pk'   => storage_path('app/certs/live/privkey.key'),
                    'verify_peer' => false
                )
            );
            $worker = new Worker("websocket://0.0.0.0:$port", $context);

            // 设置transport开启ssl，websocket+ssl即wss
            $worker->transport ='ssl';

            // 设置此实例收到reload信号后是否reload重启
            $worker->reloadable = false;
            $worker->onWorkerStop = function ($worker) {
                echo "Worker reload...\n";
            };
        }

        // 运行worker
        Worker::runAll();
    }

    /**
     * 重启
     */
    private function restart()
    {
        foreach ($this->ports as $port) {
            // 证书最好是申请的证书
            $context = array(
                'ssl' => array(
                    'local_cert' => storage_path('app/certs/live/fullchain.pem'), // 也可以是crt文件
                    'local_pk'   => storage_path('app/certs/live/privkey.key'),
                    'verify_peer' => false
                )
            );
            $worker = new Worker("websocket://0.0.0.0:$port", $context);

            // 设置transport开启ssl，websocket+ssl即wss
            $worker->transport ='ssl';

            // 设置此实例收到reload信号后是否reload重启
            $worker->reloadable = true;
            $worker->onWorkerStart = function ($worker) {
                echo "Worker restart...\n";
            };
        }

        // 运行worker
        Worker::runAll();
    }

    /**
     * 平滑重启
     */
    private function reload()
    {
        foreach ($this->ports as $port) {
            // 证书最好是申请的证书
            $context = array(
                'ssl' => array(
                    'local_cert' => storage_path('app/certs/live/fullchain.pem'), // 也可以是crt文件
                    'local_pk'   => storage_path('app/certs/live/privkey.key'),
                    'verify_peer' => false
                )
            );
            $worker = new Worker("websocket://0.0.0.0:$port", $context);

            // 设置transport开启ssl，websocket+ssl即wss
            $worker->transport ='ssl';

            // 设置此实例收到reload信号后是否reload重启
            $worker->reloadable = false;
            $worker->onWorkerStart = function ($worker) {
                echo "Worker reload...\n";
            };
        }

        // 运行worker
        Worker::runAll();
    }
}