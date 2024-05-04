<?php

namespace App\Jobs;

use App\Models\Goods;
use App\Repositories\ToolsRepository;
use App\Repositories\YunCollectRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LibGoodsCollectVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $goods;
    protected $oss_url;
    protected $tools;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($goods, $oss_url)
    {
        $this->goods = $goods;
        $this->oss_url = $oss_url;
        $this->tools = new ToolsRepository();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->goods)) {
            return;
        }
        $goods_id = $this->goods->goods_id;
        if (empty($this->goods->goods_video)) {
            return;
        }
        $res = $this->tools->uploadRemoteVideo(YunCollectRepository::getImageUrl($this->goods->goods_video), YunCollectRepository::COLLECT_DIR.'/video');
        if ($res['code'] == -1) {
            Log::stack(['job'])->info('LibGoodsCollectVideo fail goods_id:'.$goods_id);
            return;
        }
        $path = $res['data']['path'] ?? '';
        DB::table('lib_goods')->where('goods_id', $goods_id)->update(['goods_video'=>$path]);


        Log::stack(['job'])->info('LibGoodsCollectVideo success goods_id:'.$goods_id);
        return;
    }
}
