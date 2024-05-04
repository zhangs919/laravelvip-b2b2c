<?php

class BaseController extends Controller
{
    protected $lockFile = '/storage/app/seeder/install.lock';

    public function init()
    {
        $base_path = BASE_PATH.DS.'..'.DS.'..';
        if (file_exists($base_path . $this->lockFile) && request('a') != 'done') {
            $this->error('已经成功安装了，请不要重复安装!', '../');
        }
    }

    public function error($msg, $url)
    {
        $url = "location.href=\"{$url}\";";
        exit("<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");{$url}}</script></head><body onload=\"sptips()\"></body></html>");
    }

    public function redirect($url, $delay = 0)
    {
        exit("<html><head><meta http-equiv='refresh' content='{$delay};url={$url}'></head><body></body></html>");
    }
}
