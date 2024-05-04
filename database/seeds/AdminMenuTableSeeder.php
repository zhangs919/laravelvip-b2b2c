<?php

namespace Database\Seeders;

use App\Models\AdminMenu;
use Illuminate\Database\Seeder;

/**
 * 填充平台方后台菜单数据
 *
 * Class AdminMenuTableSeeder
 * @package Database\Seeders
 */
class AdminMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backend_menu = backend_menu();
        // 子菜单
        foreach ($backend_menu as $item) {
            // 一级菜单
            $pid1 = AdminMenu::insertGetId([
                'title' => $item['name'],
                'name' => $item['menus'],
                'icon' => null,
                'pid' => 0,
                'parent_name' => 'root',
                'url' => null,
                'route' => !empty(array_first($item['child'])['child']) ? array_first(array_first($item['child'])['child'])['menus'] : null,
                'target' => $item['target'] ?? '_self',
                'sort' => 255,
                'is_show' => 1,
                'created_at' => format_time(time()),
                'updated_at' => format_time(time()),
            ]);
            foreach ($item['child'] as $child) {
                // 二级菜单
                $is_show = 1;
                if (in_array($child['menus'], [
                    'subsite',
                    'mall-distrib',
                    'user-operative',
                    'app-pack',
                ])) {
                    $is_show = 0;
                }
                $pid2 = AdminMenu::insertGetId([
                    'title' => $child['name'],
                    'name' => $child['menus'],
                    'icon' => $child['icon'],
                    'pid' => $pid1,
                    'parent_name' => $item['menus'],
                    'url' => $item['url'] ?? null,
                    'route' => !empty($child['child']) ? array_first($child['child'])['menus'] : null,
                    'target' => $child['target'] ?? '_self',
                    'sort' => 255,
                    'is_show' => $is_show,
                    'created_at' => format_time(time()),
                    'updated_at' => format_time(time()),
                ]);

                if (!empty($child['child'])) {
                    foreach ($child['child'] as $cc) {
                        $is_show = 1;
                        if (in_array($cc['menus'], [
                            'system-setting-dada',
                            'system-setting-application-service',
                            'system-setting-oauth',

                            'system-setting-subsite',
                            'system-subsite-list',
                            'system-subsite-admin-list',

                            'mall-freebuy-order',
                            'mall-reachbuy-order',
                            'mall-shop-recommend-shop',
                            'mall-recommend-shop-msg',

                            'mall-shop-logistics',
                            'mall-shop-cash-oauth',
                            'mall-shop-dada',

                            'distrib-set',
                            'distrib-goods-list',
                            'distrib-distributor-list',
                            'distrib-order-list',

                            'user-user-label',
                            'user-operative-smart',
                            'user-operative-district',

                            'user-analyse-statistics',
                            'user-group-analysis',
                            'user-analyse-area-analysis',

                            'finance-offline-bill',

                            'finance-users-statistics',
                            'finance-sales-statistics',

                            'app-pack-course',
                            'app-seller-push-message',
                            'app-store-push-message',

                            'mobile-weixin-qcode',
                        ])) {
                            $is_show = 0;
                        }
                        // 三级菜单
                        AdminMenu::insert([
                            'title' => $cc['name'],
                            'name' => $cc['menus'],
                            'icon' => null,
                            'pid' => $pid2,
                            'parent_name' => $child['menus'],
                            'url' => $cc['url'] ?? null,
                            'route' => $cc['menus'],
                            'target' => $cc['target'] ?? '_self',
                            'sort' => 255,
                            'is_show' => $is_show,
                            'created_at' => format_time(time()),
                            'updated_at' => format_time(time()),
                        ]);
                    }
                }
            }
        }
    }
}
