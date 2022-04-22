<?php
namespace App\Console\Commands;

use App\Workerman\Events;
use Workerman\Worker;
use Illuminate\Console\Command;

class Workerman1Command extends Command {

    private $server;
    protected $signature = 'workman1 {action} {--d}';
    protected $description = 'Start a Workerman server.';

    public function __construct() {
        parent::__construct();
    }

    /** * Execute the console command. * * @return mixed */
    public function handle() {
        global $argv;
        $arg = $this->argument('action');
        $argv[1] = $argv[2];
        $argv[2] = isset($argv[3]) ? "-{$argv[3]}" : '';

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
    private function start() {
        // 创建一个Worker监听20002端口，不使用任何应用层协议
        $this->server = new Worker("websocket://0.0.0.0:7272");
        // 启动4个进程对外提供服务
        $this->server->count = 4;
        $handler = Events::class;
        // 连接时回调
        $this->server->onConnect = [$handler, 'onConnect'];
        // 收到客户端信息时回调
        $this->server->onMessage = [$handler, 'onMessage'];
        // 进程启动后的回调
        $this->server->onWorkerStart = [$handler, 'onWorkerStart'];
        // 断开时触发的回调
        $this->server->onClose = [$handler, 'onClose'];
        // 运行worker
        Worker::runAll();
    }

    /**
     * 关闭
     */
    private function stop() {
        $worker = new Worker('websocket://0.0.0.0:8181');
        // 设置此实例收到reload信号后是否reload重启
        $worker->reloadable = false;
        $worker->onWorkerStop = function($worker)
        {
            echo "Worker reload...\n";
        };
        // 运行worker
        Worker::runAll();
    }

    /**
     * 重启
     */
    private function restart() {
        $worker = new Worker('websocket://0.0.0.0:8181');
        // 设置此实例收到reload信号后是否reload重启
        $worker->reloadable = true;
        $worker->onWorkerStart = function($worker)
        {
            echo "Worker restart...\n";
        };
        // 运行worker
        Worker::runAll();
    }

    /**
     * 平滑重启
     */
    private function reload() {
        $worker = new Worker('websocket://0.0.0.0:8181');
        // 设置此实例收到reload信号后是否reload重启
        $worker->reloadable = false;
        $worker->onWorkerStart = function($worker)
        {
            echo "Worker reload...\n";
        };
        // 运行worker
        Worker::runAll();
    }
}