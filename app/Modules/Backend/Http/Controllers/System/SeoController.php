<?php

namespace app\Modules\Backend\Http\Controllers\System;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class SeoController extends Backend
{

    private $links = [];



    public function __construct()
    {
        parent::__construct();

    }


    public function sitemap()
    {
        $title = '网站地图';
        $fixed_title = '网站地图 - '.$title;

        $action_span = [];
        $explain_panel = [
            '网站地图（Sitemaps）服务旨在使用 Feed 文件 sitemap.xml 通知 Google、Yahoo! 以及 Microsoft 等 Crawler(爬虫)网站上哪些文件需要索引、这些文件的最后修订时间、
更改频度、文件位置、相对优先索引权，这些信息将帮助他们建立索引范围和索引的行为习惯。详细信息请查看 sitemaps.org 网站上的说明',
            '网站地图中定义的更新时间是能够让蜘蛛规律性的来爬取整个网站，检查网站有没有更新的信息'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.seo.sitemap', compact('title'));
    }

    public function saveData(Request $request)
    {


        return result(0, '', 'sitemap生成成功');
    }
}