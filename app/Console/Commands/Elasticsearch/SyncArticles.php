<?php

namespace App\Console\Commands\Elasticsearch;

use App\Models\Article;
use Illuminate\Console\Command;

class SyncArticles extends Command
{
    protected $signature = 'es:sync-articles {--index=articles}';

    protected $description = '将文章数据同步到 Elasticsearch';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // 获取 Elasticsearch 对象
        $es = app('es');

        Article::query()
            // 使用 chunkById 避免一次性加载过多数据
            ->chunkById(100, function ($articles) use ($es) {
                $this->info(sprintf('正在同步 ID 范围为 %s 至 %s 的文章', $articles->first()->article_id, $articles->last()->article_id));

                // 初始化请求体
                $req = ['body' => []];
                // 遍历文章
                foreach ($articles as $article) {
                    // 将文章模型转为 Elasticsearch 所用的数组
                    $data = $article->toESArray();

                    $req['body'][] = [
                        'index' => [
                            // 从参数中读取索引名称
                            '_index'    => $this->option('index'),
                            '_type'     => '_doc',
                            '_id'       => $data['article_id'],
                        ],
                    ];
                }
                try {
                    // 使用 bulk 方法批量创建
                    $es->bulk($req);
                } catch (\Exception $e) {
                    $this->error($e->getMessage());
                }
            });
        $this->info('同步完成');
    }
}