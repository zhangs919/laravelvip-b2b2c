<?php


namespace App\Console\Commands;


use GatewayWorker\BusinessWorker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use Illuminate\Console\Command;

class SocketServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 划重点 这里就是命令 work:socket [start|stop|reload] [--d]
     */
    protected $signature = 'work:socket {action} {--d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'workerman socket';

    /**
     * SocketServer constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @author mjShu
     */
    public function handle()
    {
        global $argv;
        $action = $this->argument('action');
        $argv[0] = 'worker:socket';
        $argv[1] = $action;
        $argv[2] = $this->option('d') ? '-d' : '';

        $context = array(
            'ssl' => array(
                'local_cert' => storage_path('app/certs/chat/fullchain.pem'), // 也可以是crt文件
                'local_pk' => storage_path('app/certs/chat/privkey.key'),
                'verify_peer' => false
            )
        );
        $Gateway = new Gateway('websocket://0.0.0.0:4431', $context);
        $Gateway->transport = 'ssl';

        //非ssl加密
//        $Gateway = new Gateway('websocket://0.0.0.0:4431');

        new Register('text://0.0.0.0:1238');
        $Gateway->name = 'Gateway';
        $Gateway->count = 1;
        $Gateway->lanIp = '127.0.0.1';
        $Gateway->startPort = 10000;
        $Gateway->pingInterval = 50;  //50s一次心跳
        $Gateway->registerAddress = '127.0.0.1:1238';
        $Gateway->pingNotResponseLimit = 3;
        $Gateway->pingData = '';
        $worker = new BusinessWorker();
        $worker->eventHandler = 'App\Modules\Frontend\Http\Controllers\WebSocket\WebSocketController';
        $worker->name = 'BusinessWorker';
        $worker->count = 3;
        $worker->registerAddress = '127.0.0.1:1238';
        Gateway::runAll();
    }
}
