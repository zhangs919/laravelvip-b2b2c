<?php

namespace App\Modules\Backend\Http\Controllers\System;

use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ifsnop\Mysqldump as IMysqldump;

class BackupController extends Backend
{
    protected $directory = 'backup';

    private $links = [
        ['url' => 'system/backup/list', 'text' => '备份列表'],
    ];

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        if (env('APP_ENV') != 'production' || config('lrw.backend_domain') == 'backend.shop.laravelvip.com') {
            abort(403, '非生产环境无权操作');
        }

        $title = '备份列表';
        $fixed_title = '数据库管理 - '.$title;
        $this->sublink($this->links, 'list');
        $action_span = [
            [
                'url' => 'store',
                'icon' => 'fa-cloud-upload',
                'text' => '数据库备份'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block
        $disk = Storage::disk('backup');
        // 获取目录下的文件
        $files = $disk->files($this->directory);

        $list = [];
        foreach ($files as $k => $v) {
            if (substr($v,strpos($v,'.')+1) === 'sql') {
                $list[$k]['filename'] = substr($v,strpos($v,'/')+1);
                $list[$k]['filesize'] = $this->count_size($disk->size($v)); //文件大小
                $list[$k]['time'] = date('Y-m-d H:i:s', $disk->lastModified($v)); //最后修改时间
            }
        }
        $total = count($list);

        $pageHtml = pagination($total);
        $compact = compact('title','list','pageHtml');

        if ($request->ajax()) {
            $render = view('system.backup.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('system.backup.list', $compact);
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $filename = $request->get('id');
        $disk = Storage::disk('backup');

        $exists = $disk->exists($this->directory.'/'.$filename);
        if (!$exists) {
            return result(-1, null, '文件不存在');
        }
        // 删除单条文件
        $result = $disk->delete($this->directory.'/'.$filename);

        if (!$result) {
            return result(-1, null, '删除失败');
        }

        return result(0,null, '删除成功');
    }

    /**
     * 数据库备份
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        if (env('APP_ENV') != 'production') {
            abort(403, '非生产环境无权操作');
        }
        //备份数据库配置
        $dumpSettings = array(
            'compress' => IMysqldump\Mysqldump::NONE,
            'no-data' => false,
            'add-drop-table' => true,
            'single-transaction' => true,
            'lock-tables' => true,
            'add-locks' => true,
            'extended-insert' => true,
            'disable-foreign-keys-check' => true,
            'skip-triggers' => false,
            'add-drop-trigger' => true,
            'databases' => false,
            'add-drop-database' => false,
            'hex-blob' => true
        );
        try {
            $dump = new IMysqldump\Mysqldump(
                'mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
                env('DB_USERNAME'),
                env('DB_PASSWORD'),
                $dumpSettings
            );
            $prefix = 'laravelvip-';
            $filename = date('Y') . '-' . date('m') . '-' . date('d') . '-' . date('H') . '-' . date('i') . '-' . date('s');
            $name = $prefix . $filename . ".sql";
            $dump->start(storage_path() . "/backup/" . $name);
        } catch (\Exception $e) {
            flash('error', 'mysqldump-php error: ' . $e->getMessage());
            return back();
        }

        flash('success', '数据库备份成功');
        return redirect('/system/backup/list')->with('success','数据库备份成功');
    }

    /**
     * 数据库恢复
     *
     * @param $filename
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    /*public function recover($filename)
    {
        $disk = Storage::disk('backup');

        $exists = $disk->exists($this->directory.'/'.$filename);
        if (!$exists) {
            return back()->with('error','sql文件不存在');
        }

        //导入sql文件操作
        $sql = file_get_contents(storage_path()."/backup/".$filename);
        $result = DB::unprepared($sql);

        if ($result != 1) {
            return back()->with('error', '数据库恢复失败');
        }

        return redirect('/system/backup/list')->with('success', '数据库恢复成功');
    }*/

    /**
     * 数据库备份文件下载
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request)
    {
        $filename = $request->get('filename');

        $disk = Storage::disk('backup');

        $exists = $disk->exists($this->directory.'/'.$filename);
        if (!$exists) {
            flash('error', '文件不存在');
            return back()->with('error','文件不存在');
        }
        //完整路径下载
        return response()->download(storage_path().'/'.$this->directory.'/'.$filename);
    }

    /**
     * 数据表优化
     * todo
     */
    public function optimize()
    {

    }

    /**
     * 单位换算
     *
     * @param $bit
     * @return string
     */
    private function count_size($bit)
    {
        $type = array('Bytes','KB','MB','GB','TB');
        for($i = 0; $bit >= 1024; $i++)
        {
            $bit/=1024;
        }
        return (floor($bit*100)/100).$type[$i];
    }
}
