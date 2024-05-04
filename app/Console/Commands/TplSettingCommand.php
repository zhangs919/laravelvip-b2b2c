<?php

namespace App\Console\Commands;

use App\Models\Shop;
use App\Models\Topic;
use App\Repositories\TemplateItemRepository;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class TplSettingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tpl:setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto publish the tpl settings.';

    protected $templateItem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TemplateItemRepository $templateItem)
    {
        parent::__construct();

        $this->templateItem = $templateItem;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Request $request)
    {
        $pageArr = [
            'site',
            'm_site',
            'app',
            'news',
            'm_news'
        ];
        $pageShopArr = [
            'shop',
            'm_shop'
        ];
        $pageTopicArr = [
            'topic',
            'm_topic',
//            'app_topic'
        ];

        foreach ($pageArr as $item) {
            $this->tplSetting($item);
        }

        $shopList = Shop::whereIn('shop_type', [1,2])->get();
        foreach ($shopList as $item) {
            foreach ($pageShopArr as $v) {
                $this->tplSetting($v, $item->shop_id, 0, '店铺ID:'.$item->shop_id);
            }
        }

        $topicList = Topic::all();
        foreach ($topicList as $item) {
            foreach ($pageTopicArr as $v) {
                $this->tplSetting($v, $item->shop_id, $item->topic_id, '专题ID:'.$item->topic_id);
            }
        }

        return 0;
    }

    private function tplSetting($page, $shop_id = 0, $topic_id = 0, $msg = '')
    {

        // 保存模板数据 并生成html文件
        // 从 template_item 表中获取模板数据
        $where[] = ['page', $page];
        if ($shop_id > 0) {
            $where[] = ['shop_id', $shop_id];
        }
        if ($topic_id > 0) {
            $where[] = ['topic_id', $topic_id];
        }
        $condition = [
            'field' => ['uid', 'data', 'shop_id', 'page', 'sort', 'ext_info', 'tpl_title', 'is_valid', 'site_id', 'code', 'file'],
            'where' => $where,
            'limit' => 0, // 查询全部
            'sortname' => 'sort',
            'sortorder' => 'asc'
        ];
        list($templateItems, $itemCount) = $this->templateItem->getList($condition);

        $tplUpdate = [];
        foreach ($templateItems as &$item)
        {
            if (empty($item->data) || !$item->is_valid) {
                // 如果数据为空或者is_valid为0 直接跳出循环继续进行
                $render = "";
            } else {
                $render = $this->templateItem->getTemplateItemHtml($item->uid, $page);
            }

            $tplUpdate[] = [
                'uid' => $item->uid,
                'file' => $render
            ];
        }
        if (!empty($tplUpdate)) { // todo 待优化 将更新操作放到队列中处理
            $ret = $this->templateItem->updateBatch($tplUpdate);
            if ($ret === false) {
                $this->info('自动发布页面装修失败 '.$msg);
                return false;
            }
            $this->info('自动发布页面装修成功 '.$msg);
            return true;
        }
        return false;
    }
}
