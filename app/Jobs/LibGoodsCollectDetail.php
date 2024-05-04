<?php

namespace App\Jobs;

use App\Repositories\YunCollectRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LibGoodsCollectDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $yunCollect;
    protected $goods_id;
    protected $post;
    protected $source;
    protected $shop_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($goods_id,YunCollectRepository $yunCollect, $post, $source = 0, $shop_id = 0)
    {
        //
        $this->yunCollect = $yunCollect;
        $this->goods_id = $goods_id;
        $this->post = $post;
        $this->source = $source;
        $this->shop_id = $shop_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->yunCollect->doCollectSzyDetail($this->goods_id, $this->source, $this->shop_id, $this->post);
        return;
    }
}
