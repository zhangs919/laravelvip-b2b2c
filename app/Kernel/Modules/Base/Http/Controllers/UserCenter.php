<?php

namespace App\Kernel\Modules\Base\Http\Controllers;



class UserCenter extends Frontend
{

    protected $need_auth = true; // 是否需要登录 默认否

    public function __construct()
    {
        parent::__construct();


        if ($this->need_auth) {
            // 用户中心 所有页面需要登录
//            $this->middleware('auth.user:user');
        }

        // 用户中心 左侧菜单
        $left_menus = $this->menus();


        view()->share('left_menus', $left_menus);
    }

    protected final function menus() {
        $menus = [
            /*会员中心*/
            1 => [
                'title' => '会员中心',
                'url' => '',
                'child' => [
                    [
                        'title' => '欢迎页',
                        'url' => '/user/center.html'
                    ],
                    [
                        'title' => '个人资料',
                        'url' => '/user/profile.html'
                    ],
                    [
                        'title' => '账户安全',
                        'url' => '/user/security.html'
                    ],
                    [
                        'title' => '账号绑定',
                        'url' => '/user/bind.html'
                    ],
                    [
                        'title' => '收货地址',
                        'url' => '/user/address.html'
                    ],
                    [
                        'title' => '我的消息',
                        'url' => '/user/message/internal.html'
                    ],
//                    [
//                        'title' => '我的会员卡',
//                        'url' => '/user/rights-card.html'
//                    ],
                    [
                        'title' => '我的成长值',
                        'url' => '/user/growth-value.html'
                    ],
//                    [
//                        'title' => '我的提货券',
//                        'url' => '/user/gift-card/index.html'
//                    ],
                ]
            ],

            /*交易中心*/
            2 => [
                'title' => '交易中心',
                'url' => '',
                'child' => [
                    [
                        'title' => '我的订单',
                        'url' => '/user/order.html'
                    ],
//                    [
//                        'title' => '虚拟兑换订单',
//                        'url' => '/user/virtual-order.html'
//                    ],
//                    [
//                        'title' => '缴费记录',
//                        'url' => '/user/prepaid.html'
//                    ],
                    [
                        'title' => '我的评价',
                        'url' => '/user/evaluate/index.html'
                    ],
                    [
                        'title' => '退款退货',
                        'url' => '/user/back.html'
                    ],
                    [
                        'title' => '换货维修',
                        'url' => '/user/back.html?type=1'
                    ],
                    [
                        'title' => '我的投诉',
                        'url' => '/user/complaint.html'
                    ],
                    [
                        'title' => '我的收藏',
                        'url' => '/user/collect/goods.html'
                    ],
                ]
            ],

            /*资金中心*/
            3 => [
                'title' => '资金中心',
                'url' => '',
                'child' => [
//                    [
//                        'title' => '我的资金账户',
//                        'url' => '/user/capital-account.html'
//                    ],
//                    [
//                        'title' => '我的充值',
//                        'url' => '/user/recharge.html'
//                    ],
//                    [
//                        'title' => '我的提现账户',
//                        'url' => '/user/deposit-account.html'
//                    ],
//                    [
//                        'title' => '我的提现',
//                        'url' => '/user/deposit.html'
//                    ],
                    [
                        'title' => '我的积分',
                        'url' => '/user/integral/detail.html'
                    ],
                    [
                        'title' => '我的红包',
                        'url' => '/user/bonus.html'
                    ],
//                    [
//                        'title' => '我的储值卡',
//                        'url' => '/user/recharge-card.html'
//                    ],
                ]
            ],

//            4 => [
//                'title' => '我的分销',
//                'url' => '',
//                'child' => [
//                    [
//                        'title' => '分销中心',
//                        'url' => '/distrib/order.html'
//                    ],
//
//                ]
//            ],

            /*服务中心*/
            5 => [
                'title' => '服务中心',
                'url' => '',
                'child' => [
                    [
                        'title' => '我要开店',
                        'url' => '/shop/apply/index.html',
                        'target' => '_blank' // 打开方式 新窗口打开
                    ],
                    /*[
                        'title' => '推荐开店',
                        'url' => '/user/recommend-shop.html'
                    ],
                    [
                        'title' => '我的代理',
                        'url' => '/user/agent.html'
                    ],*/
                ]
            ],
        ];

        return $menus;
    }


}
