<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Ifsnop\Mysqldump as IMysqldump;
use Illuminate\Support\Facades\Log;


/**
 * 备份数据库
 *
 * Class BackupDatabaseCommand
 * @package App\Console\Commands
 */
class BackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '备份数据库';

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
            Log::info("database backup fail:".$e->getMessage());
            return back();
        }

        # 提示
        $this->info('备份数据库完成');

    }
}
