<?php

namespace App\Jobs;


use App\Repositories\ChatRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateChatMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        try {
            $routeRep = new ChatRepository();
            $routeRep->sendMessage($this->data);
            return true;
        } catch (\Exception $e) {
            // 执行失败
            Log::stack(['job'])->info('创建聊天消息失败，错误信息：' . $e->getMessage());
            return false;
        }
    }
}
