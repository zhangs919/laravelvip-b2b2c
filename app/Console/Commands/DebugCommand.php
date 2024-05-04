<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Console\Command;

class DebugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run temp debug codes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        # 生成进度条 步数*5
        $progress = $this->output->createProgressBar(5);

        # prepare to run
        $this->info("\nprepare to run.");
        $progress->advance(2);

        # begin run
        $this->info("\nbegin run...");

//        $result = $this->tempUpdateAdminAuthKey();

        // $result = $this->tempUpdateSellerAuthKey();
        $result = false;

        if (is_string($result)) {
            $progress->finish();
            $this->info("\n{$result}");
        } else {
            $progress->finish();
            $result = json_encode($result);
            $this->info("\nrun successful. records:{$result}");
        }
    }

    /**
     * 临时批量更新平台方后台 管理员auth_key
     *
     * @return array|string
     */
    protected function tempUpdateAdminAuthKey()
    {
        $admins = Admin::all();
        $result = [];
        foreach ($admins as $item) {

            $ret = Admin::where('user_id', $item->user_id)->update(['auth_key'=>md5($item->user_name),'auth_codes'=>null,'ec_salt'=>null]);
            if ($ret === false) {
                return "update fail.";
            }
            $result[] = $item->user_id;
        }

        return $result;
    }

    /**
     * 临时批量更新商家后台 管理员auth_key
     *
     * @return array|string
     */
    protected function tempUpdateSellerAuthKey()
    {
        $admins = User::all();
        $result = [];
        foreach ($admins as $item) {

            $ret = User::where('user_id', $item->user_id)->update(['auth_key'=>md5($item->user_name),'auth_codes'=>null,'salt'=>null]);
            if ($ret === false) {
                return "update fail.";
            }
            $result[] = $item->user_id;
        }

        return $result;
    }
}
