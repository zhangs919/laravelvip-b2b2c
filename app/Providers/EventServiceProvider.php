<?php

namespace App\Providers;

use App\Events\OrderShipped;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use function Illuminate\Events\queueable;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
//        ],

        'App\Events\OrderShipped' => [
            'App\Listeners\SendShipmentNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


        // 使用 队列 执行侦听器
//		Event::listen(queueable(function (OrderShipped $event){
//			//
//		})->onConnection('redis')->onQueue('order_shipped')->delay(now()->addSeconds(30)));
    }

    /**
     * 确定是否应用自动发现事件和侦听器
     *
     * @return bool
     */
    public function shouldDiscoverEvents(){
        return true;
    }

    /**
     * 获取应用于发现事件的监听器的目录
     *
     * @return array
     */
    protected function discoverEventsWithin(){
        return [
            $this->app->path('Listeners')
        ];
    }
}
