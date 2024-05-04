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

class LibGoodsCollectImage implements ShouldQueue
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

        $res = $this->tools->uploadRemoteImage(YunCollectRepository::getImageUrl($this->goods->goods_image), YunCollectRepository::COLLECT_DIR.'/images');
        if ($res['code'] == -1) {
            Log::stack(['job'])->info('LibGoodsCollectImage fail goods_id:'.$goods_id);
            return;
        }
        $path = $res['data']['path'] ?? '';
        DB::table('lib_goods')->where('goods_id', $goods_id)->update(['goods_image'=>$path]);


        Log::stack(['job'])->info('LibGoodsCollectImage success goods_id:'.$goods_id);
        return;
    }
}
