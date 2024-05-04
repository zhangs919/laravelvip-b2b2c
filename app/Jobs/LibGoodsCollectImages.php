<?php

namespace App\Jobs;

use App\Models\Goods;
use App\Models\LibGoodsSpec;
use App\Repositories\LibGoodsImageRepository;
use App\Repositories\ToolsRepository;
use App\Repositories\YunCollectRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LibGoodsCollectImages implements ShouldQueue
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

        $goods_specs = LibGoodsSpec::where('goods_id', $goods_id)->select('spec_id')->pluck('spec_id')->toArray();
        $goods_images = $this->goods->goods_images;

        $res_goods_images = [];
        $insert_goods_images = [];

        if (!empty($goods_images)) {
            $i = 0;
            foreach ($goods_images as $k => $v) {
                // 下载图片
                foreach ($v as $kk=>$vv) {
                    if (empty($vv)) {
                        continue;
                    }
                    $gi = $this->tools->uploadRemoteImage(YunCollectRepository::getImageUrl($vv), YunCollectRepository::COLLECT_DIR.'/images')['data']['path'] ?? '';
                    if ($k == 'default') {
                        // 无规格
                        $insert_goods_images['default'][] = [
                            'path' => $gi,
                            'is_default' => $kk == 0 ? 1 : 0,
                            'sort' => $kk+1
                        ];
                        $res_goods_images['default'][] = $gi;
                    } else {
                        if (!isset($goods_specs[$i])) {
                            continue;
                        }
                        $insert_goods_images[$goods_specs[$i]][] = $gi;
                        $res_goods_images[$goods_specs[$i]][] = $gi;
                    }
                }

                $i++;
            }

            (new LibGoodsImageRepository())->addGoodsImage($insert_goods_images, $goods_id);
        }
        if (empty($res_goods_images)) {
            Log::stack(['job'])->info('LibGoodsCollectImages upload fail goods_id:'.$goods_id);
            return;
        }

        DB::table('lib_goods')->where('goods_id', $goods_id)->update(['goods_images'=>serialize($res_goods_images)]);

        Log::stack(['job'])->info('LibGoodsCollectImages success goods_id:'.$goods_id);
        return;
    }
}
