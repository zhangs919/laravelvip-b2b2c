<?php

namespace App\Console\Commands;

use App\Jobs\LibGoodsCollectDetail;
use App\Repositories\YunCollectRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LibGoodsCollectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lib_goods:collect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect goods to lib goods.';

    protected $yunCollect;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(YunCollectRepository $yunCollect)
    {
        parent::__construct();

        $this->yunCollect = $yunCollect;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $source = 0; // 0-平台端后台采集到商品库 1-店铺端后台采集到商品列表
        $shop_id = 0; // 店铺id

        // 手动采集商品到商品库
        $cat_id = 18; // 默认：普洱茶
        $type_id = 1; // 默认：茶叶
        $lib_cat_ids = 4; // 默认：普洱茶

        $goods_arr = [];
        for ($i = 1; $i <= 63; $i++) {
            $list_url = "https://www.xxx.cn/list.html?go=".$i;
            $res = $this->yunCollect->api_get($list_url);
            if ($res['code'] == 0 && !empty($res['data']['list'])) {
                $goods_arr = array_merge($goods_arr,array_column($res['data']['list'], 'goods_id'));
            }
        }
        $goods_arr = array_reverse($goods_arr);
        // 获取待采集商品url
        $goods_ids_arr = [];
        foreach ($goods_arr as $item) {
            $goods_ids_arr[] = "https://www.xxx.cn/goods-{$item}.html";
        }

        $goods_ids = implode("\r\n", $goods_ids_arr);
        $goods_total = count($goods_ids_arr);
        # 生成进度条 步数*1
        $progress = $this->output->createProgressBar($goods_total);

        $this->info("\n-------准备采集商品");
        $this->info("\n-------待采集商品数量为：{$goods_total}");

//        dd($goods_ids_arr);

        $post = [
            'goods_ids' => $goods_ids,
            'is_comment' => 0,
            'is_sale' => 0,
            'price' => [
                'sige' => 0,
                'num' => 0
            ],
            'stock' => [
                'sige' => 0,
                'num' => 0
            ],
            'goods_category' => $cat_id,
            'goods_type' => $type_id,
            'lib_cat_ids' => $lib_cat_ids,
            'goods_status' => 0
        ];

        $wait_collect_goods = [];
        $third_goods_id = [];
        foreach ($goods_ids_arr as $collect_url) {

            $url_arr = parse_url($collect_url);
            $path = $url_arr['path'];
            preg_match('/\d+/', $path, $arr);
            $third_goods_id[] = $arr[0];
            $wait_collect_goods[] = [
                'third_goods_id' => $arr[0],
                'url' => $collect_url,
            ];
        }

        session(['wait_collect_goods' => $wait_collect_goods]);
        session(['post_collect_goods' => $post]);

        // 开始从缓存中获取商品并采集详细信息
        $this->info("\n-------开始采集商品信息");

        if (empty($wait_collect_goods)) {
            return 0;
        }
        foreach ($wait_collect_goods as $item) {
            $ret = LibGoodsCollectDetail::dispatch($item['third_goods_id'], $this->yunCollect, $post, $source, $shop_id);
            if (!$ret) {
                $this->info("\n-------商品采集失败，商品id：".$item['third_goods_id']);
                continue;
            }
            $this->info("\n-------商品采集成功，商品id：".$item['third_goods_id']);
            $progress->advance(); // 采集成功
        }

        $this->info("\n-------商品采集完成");

        return 0;
    }
}
