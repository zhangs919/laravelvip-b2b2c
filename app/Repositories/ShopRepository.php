<?php

namespace App\Repositories;

use App\Models\Collect;
use App\Models\Goods;
use App\Models\Qcode;
use App\Models\SelfPickup;
use App\Models\Shop;
use App\Models\ShopApply;
use App\Models\ShopBindClass;
use App\Models\ShopFieldValue;
use App\Models\ShopPayment;
use App\Models\TplBackup;
use App\Models\User;
use App\Models\UserAddress;
use App\Services\WechatSDKService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopRepository
{
    use BaseRepository;

    protected $model;
    protected $goods;
    protected $user;
    protected $activity;
    protected $freight;
    protected $customer;
    protected $tools;
    protected $imageDir;
    protected $videoDir;
    protected $shopConfig;
    protected $shopCredit;

    public function __construct()
    {
        $this->model = new Shop();
        $this->goods = new GoodsRepository();
        $this->user = new UserRepository();
        $this->activity = new ActivityRepository();
        $this->freight = new FreightRepository();
        $this->customer = new CustomerRepository();
        $this->tools = new ToolsRepository();
        $this->imageDir = new ImageDirRepository();
        $this->videoDir = new VideoDirRepository();
        $this->shopConfig = new ShopConfigRepository();
        $this->shopCredit = new ShopCreditRepository();
    }

    public function getShopOpeningHour($opening_hour)
    {
//        $opening_hour = unserialize($shop->opening_hour);
        if (!empty($opening_hour)) {
            $begin_hour = $opening_hour['begin_hour'];
            $begin_minute = $opening_hour['begin_minute'];
            $end_hour = $opening_hour['end_hour'];
            $end_minute = $opening_hour['end_minute'];
            $opening_hour['time_arr'] = [];
            foreach ($begin_hour as $key=>$item) {
                $opening_hour['time_arr'][] = [
                    'begin_hour' => $item,
                    'begin_minute' => $begin_minute[$key],
                    'end_hour' => $end_hour[$key],
                    'end_minute' => $end_minute[$key],
                ];
            }
        } else {
            $opening_hour = [];
        }
        return $opening_hour;
    }

    /**
     * 验证店铺是否在营业中
     *
     * @param object $info 店铺信息
     * @return bool
     */
    public function shopIsOpening($opening_hour)
    {
        $currentWeek = date('w'); // 0-星期日 1-星期一 ...
        $currentTime = date('H:i');
        $timeFlag = false;
		if (empty($opening_hour)) {
			return false;
		}
        foreach ($opening_hour['time_arr'] as $item) {
            $beginTime = $item['begin_hour'].":".$item['begin_minute'];
            $endTime = $item['end_hour'].":".$item['end_minute'];
            if ($currentTime > $beginTime && $currentTime < $endTime) {
                $timeFlag = true;
            }
        }
        if (!empty($opening_hour['week'])) {
            $weekFlag = false;
            if (in_array($currentWeek, $opening_hour['week']) && $timeFlag) {
                $weekFlag = true;
            }
            if ($weekFlag && $timeFlag) {
                return true;
            }
        } else {
            return $timeFlag;
        }
        return $timeFlag;
    }

    /**
     * 获取店铺信息
     * 返回数据经过处理
     *
     * @param $shop_id
     * @return mixed
     */
    public function getShopInfo($shop_id)
    {
        $info = Shop::where('shop_id', $shop_id)->withCount(['collect'])->first();
        if (empty($info)) {
            return null;
        }
        $info->opening_hour = unserialize($info->opening_hour);
        $info->opening_hour = $this->getShopOpeningHour($info->opening_hour);
        $info->is_opening = $this->shopIsOpening($info->opening_hour);
        if (empty($info->shipping_time)) {
            $shipping_time = [
                'begin_hour' => 0,
                'begin_minute' => 0,
                'end_hour' => 0,
                'end_minute' => 0,
            ];
        } else {
            $shipping_time = unserialize($info->shipping_time);
        }
        $info->shipping_time = $shipping_time;
        $info->is_own_shop = $info->shop_type == 0 ? 1 : 0; // 是否自营店铺

        $info->shop_url = '/shop/'.$shop_id.'.html';
        /*$info->customer = [
            '__PHP_Incomplete_Class_Name' => 'common\models\Customer',
            'clientRuleCache' => 'cache'
        ];*/
        $info->customer = $this->customer->getCustomerMain($shop_id);
        $info->aliim_enable = shopconf('aliim_enable', false, $shop_id); // 店铺是否开启阿里云旺客服

//        $info->system_aliim_enable = sysconf('aliim_enable'); // 平台是否开启阿里云旺客服

        $pickup_list = SelfPickup::where([['is_show',1],['is_delete',0],['shop_id', $shop_id]])->get()->toArray();
        $info->delivery_enable = !empty($pickup_list) ? 1 : 0;
        $info->pickup_list = $pickup_list;
        $info->collect_num = $info->collect_count;
        $info->user_name = $info->user->user_name;
        $info->shop_type_fmt = str_replace([1, 2], ['个人店铺', '企业店铺'], $info->shop_type);

        $info->shop_image = get_image_url($info->shop_image);
        $info->shop_logo = get_image_url($info->shop_logo);
        $info->shop_poster = get_image_url($info->shop_poster);
        $info = $info->toArray();
        return $info;
    }

    /**
     * 新增店铺
     *
     * @param array $shopInsert 店铺信息
     * @param array $shopFieldValueInsert 店铺认证信息
     * @return mixed
     */
    public function addShop($shopInsert, $shopFieldValueInsert = [])
    {

        DB::beginTransaction();
        try {
            // 检查店铺是否存在
            $shop_result = DB::table('shop')->where('user_id',$shopInsert['user_id'])->first();

            if (!empty($shop_result)) {
                throw new \Exception('店铺已经存在！');
            }

            if (empty($shop_result)) {
                // 插入店铺表（shop)
                $shop_result = $this->store($shopInsert);
                if (!$shop_result) {
                    throw new \Exception('店铺数据插入失败！');
                }

                // 更新会员is_seller为1
                DB::table('user')->where('user_id', $shopInsert['user_id'])->update(['is_seller'=>1,'shop_id'=>$shop_result->shop_id]);
            }

            // 检查店铺认证信息是否存在
            $shop_auth_info = DB::table('shop_field_value')->where('shop_id', $shop_result->shop_id)->first();
            if (empty($shop_auth_info)) {
                // 插入店铺认证信息表（shop_field_value）
                $shopFieldValueModel = new ShopFieldValue();
                $shopFieldValueInsertData = @$shopFieldValueInsert['ShopFieldValueModel'];
                if ($shopFieldValueInsertData) {
                    // 上传企业营业执照和法人代表证件照片
                    foreach ($shopFieldValueInsert as $key=>$item) {
                        if (Str::contains($key, 'check-') && !empty($item)) {
                            $filename = request()->post($key, 'name');
                            $field = str_replace('check-', '', $key);
                            $file = request()->file()['ShopFieldValueModel'][$field];
                            $storePath = 'shop/'.$shop_result->shop_id.'/field'; //

                            $uploadRes = $this->tools->upfile($file, request(), $storePath);
                            if (isset($uploadRes['error'])) {
                                throw new \Exception($uploadRes['error']);
                            }
                            $shopFieldValueInsertData[$field] = $uploadRes['path'];
                        }
                    }
                }

                $shopFieldValueInsertData['shop_id'] = $shop_result->shop_id;

                $shopFieldValueModel->fill($shopFieldValueInsertData);
                $shopFieldValueModel->save();
            }

            // 添加店铺所属分类表
            if (!empty($shopUpdate['cat_ids'])) {
                foreach ($shopUpdate['cat_ids'] as $item) {
                    // 删除该店铺所有店铺所属分类
                    ShopBindClass::where('shop_id', $shop_result->shop_id)->delete();
                    // 插入数据
                    $shopBindClassInsert = [
                        'shop_id' => $shop_result->shop_id,
                        'cls_id' => $item
                    ];
                    $shopBindClass = new ShopBindClass();
                    $shopBindClass->fill($shopBindClassInsert);
                    $shopBindClass->save();
                }
            }

            // 添加店铺相册
            $this->imageDir->createDefaultDirs($shop_result->shop_id, 0, 'shop');

            // 添加店铺视频文件夹
            $this->videoDir->createDefaultDirs($shop_result->shop_id, 0, 'shop');

            // 添加店铺配置信息
            $this->shopConfig->createShopConfigData($shop_result->shop_id);



            // 添加店铺手机端首页外卖风格模板 tpl_backup
            $tplBackupInsert = TplBackup::where('back_id', 1)
                ->select(['name', 'is_sys','site_id','page','remark','type','topic_id','img','is_theme','ext_info'])
                ->first();
            if (!empty($tplBackupInsert)) {
                $tplBackupInsert = $tplBackupInsert->toArray();
                $tplBackupInsert['shop_id'] = $shop_result->shop_id;
                $tplBackupInsert['add_time'] = time();

                $tplBackup = new TplBackup();
                $tplBackup->fill($tplBackupInsert);
                $tplBackup->save();
            }


            DB::commit();
            return $shop_result;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 更新店铺
     *
     * @param int $shopId 店铺id
     * @param array $shopUpdate 店铺信息
     * @param array $shopFieldValueUpdate 店铺认证信息
     * @return bool
     */
    public function modifyShop($shopId, $shopUpdate, $shopFieldValueUpdate = [])
    {

        DB::beginTransaction();
        try {
            // 更新店铺信息
            $this->update($shopId, $shopUpdate);

            if (!empty($shopFieldValueUpdate)) {
                // 更新店铺认证信息
                ShopFieldValue::where('shop_id', $shopId)->update($shopFieldValueUpdate);
            }

            // 添加店铺所属分类表
            if (!empty($shopUpdate['cat_ids'])) {
                foreach ($shopUpdate['cat_ids'] as $item) {
                    // 删除该店铺所有店铺所属分类
                    ShopBindClass::where('shop_id', $shopId)->delete();
                    // 插入数据
                    $shopBindClassInsert = [
                        'shop_id' => $shopId,
                        'cls_id' => $item
                    ];
                    $shopBindClass = new ShopBindClass();
                    $shopBindClass->fill($shopBindClassInsert);
                    $shopBindClass->save();
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();//事务回滚
//            echo $e->getMessage();
//            echo $e->getCode();
            return false;
        }
    }

    /**
     * 平台方 彻底删除店铺
     *
     * @param int $shop_id 店铺id
     * @return bool
     */
    public function shopDelete($shop_id)
    {
        DB::beginTransaction();
        try {

            // todo 检查是否存在未完成订单 如果存在 则不允许删除
            $hasUnfinishedOrder = false;
            if ($hasUnfinishedOrder) {
                return arr_result(1, '', '此店铺存在未完成订单，不能删除');
            }
            // 检查是否存在在售商品 如果存在 则不允许删除
            $hasOnSaleGoods = $this->getShopGoodsCount($shop_id);
            if ($hasOnSaleGoods) {
                return arr_result(1, '', '此店铺存在在售商品，不能删除');
            }

            // 删除店铺关联信息
            $query = Shop::find($shop_id);
            $query->delete(); // 删除店铺表 shop
            $query->integralGoods()->delete();// 店铺关联积分商品 integral_goods
            $query->shopBindClass()->delete();// 店铺绑定分类 shop_bind_class
            $query->shopCategory()->delete(); // 店铺内分类 shop_category
            $query->member()->delete();// 店铺会员 member
            $query->printSpec()->delete();// 打印规格 print_spec
            $query->selfPickup()->delete();// 店铺自提点 self_pickup
            $query->customer()->delete(); // 店铺客服 customer
            $query->customerType()->delete(); // 店铺客服类型 customer_type
            $query->shopAddress()->delete(); // 店铺发货地址 shop_address
            $query->shopApply()->delete();// 店铺入驻申请 shop_apply
//            $query ->shopAuth()->delete();// 店铺权限 shop_auth todo 暂时未完成 先不执行删除
            $query->shopComment()->delete();// 店铺动态评价 shop_comment
            $query->shopConfig()->delete();// 店铺系统配置 shop_config
            $query->shopContract()->delete();// 店铺消费保障 shop_contract
            $query->shopFieldValue()->delete();// 店铺认证信息 shop_field_value
            $query->shopLog()->delete(); // 店铺操作日志 shop_log
            $query->shopMessageTpl()->delete();// 店铺消息模板 shop_message_tpl
            $query->shopNavigation()->delete();// 店铺导航 shop_navigation
            $query->shopPayment()->delete();// 店铺付款信息 shop_payment
            $query->shopQuestions()->delete();// 店铺问答 shop_questions
            $query->shopRank()->delete();// 店铺会员等级 shop_rank
            $query->shopRole()->delete();// 店铺账号角色 shop_role
            $query->shopShipping()->delete();// 店铺物流运单 shop_shipping
            $query->stores()->delete();// 店铺关联网点 stores
            $query->storeGroup()->delete();// 店铺网点分组 store_group
            $query->templateItem()->delete();// 店铺装修信息 template_item
            $query->topic()->delete();// 店铺专题 topic
            $query->ylyPrinter()->delete();// 易联云打印机配置 yly_printer
            $query->goodsUnit()->delete(); // 店铺商品单位 goods_unit
            $query->goodsLayout()->delete(); // 店铺商品详情版式 goods_layout
            $query->goodsTag()->delete(); // 店铺商品标签 goods_tag

            // 特殊表删除
            // 店铺关联商品信息彻底删除
            $this->goods->foreverDeleteGoods($shop_id);

            // 店铺活动
            $this->activity->deleteActivity($shop_id);

            // 运费模板
            $this->freight->deleteFreight($shop_id);

            // 店铺收藏
            Collect::where([['shop_id', $shop_id], ['collect_type', 1]])->delete();

            // xx 店主管理员账号和网点管理员账号(包括会员认证信息)
//            $user_ids = User::where('shop_id', $shop_id)->select(['user_id'])->pluck('user_id')->toArray();
//            $this->user->deleteUser($user_ids);
            // 将店主管理员账号和网点管理员账号设置为普通会员
            User::where('shop_id', $shop_id)->update(['is_seller'=>0,'shop_id'=>0,'store_id'=>0,'multi_store_id'=>0]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack(); // 事务回滚
            echo $e->getMessage();
            echo $e->getCode();
            return arr_result(-1, '', '删除失败');
        }
    }

    /**
     * 生成店铺二维码
     *
     * @param int $shop_id 店铺id
     * @return \Illuminate\Http\Response
     */
    public function generateShopQrCode($shop_id)
    {
        $url = route('pc_shop_home', ['shop_id' => $shop_id]);

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(124)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * 获取店铺在售商品数量
     *
     * @param $shopId
     * @return mixed
     */
    public function getShopGoodsCount($shopId)
    {
        $where[] = ['shop_id',$shopId];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        $count = Goods::where($where)->count();
        return $count;
    }

    /**
     * 获取店铺信息
     * 包括店铺/店主/店铺认证/店铺信誉等信息
     *
     * @param $shopId
     * @return array
     */
    public function shopInfo($shopId)
    {
        $shop = $this->getShopInfo($shopId);

        // 卖家会员账号信息
        $user = User::where('user_id', $shop['user_id'])
            ->select(['user_id','user_name','mobile','email','nickname','headimg'])
            ->first();
        // 卖家入驻认证信息
        $real = ShopFieldValue::where('shop_id', $shopId)
            ->select(['real_name','card_no','hand_card','card_side_a','card_side_b','address','special_aptitude'])
            ->first();
        if (!empty($real)) {
            $real = $real->toArray();
            $real['hand_card'] = get_image_url($real['hand_card']);
            $real['card_side_a'] = get_image_url($real['card_side_a']);
            $real['card_side_b'] = get_image_url($real['card_side_b']);
        }

        // 店铺信誉
        $credit = $this->shopCredit->getCreditInfoByScore($shop['credit']);

        // 会员收货地址
        $address = UserAddress::where('user_id', $shop['user_id'])
            ->select(['address_id','consignee','region_code','address_detail','mobile','tel','email','is_default'])
            ->orderBy('is_default', 'desc')
            ->get()->toArray();
        if (!empty($address)) {
            foreach ($address as &$v) {
                $v['shop_id'] = $shop['shop_id'];
            }
        }

        // 店铺主客服信息
        $customer_main = $this->customer->getCustomerMain($shopId);

        // 是否开启阿里云旺客服
        $aliim_enable = shopconf('aliim_enable',false,$shopId);
        $shop_info = [
            'shop' => $shop,
            'user' => !empty($user) ? $user->toArray() : null,
            'real' => $real,
            'credit' => $credit,
            'address' => $address,
            'customer_main' => $customer_main,
            'aliim_enable' => $aliim_enable,
        ];

        // 当阿里云旺客服是开启状态时,获取云旺客服配置信息
        if ($aliim_enable) {
            $shop_info['aliim'] = [
                'aliim_appkey' => shopconf('aliim_appkey',false,$shopId),
                'aliim_secret_key' => shopconf('aliim_secret_key',false,$shopId),
                'aliim_main_customer' => shopconf('aliim_main_customer',false,$shopId),
                'aliim_customer_logo' => shopconf('aliim_customer_logo',false,$shopId),
                'aliim_welcome_words' => shopconf('aliim_welcome_words',false,$shopId),
                'aliim_uid' => shopconf('aliim_uid',false,$shopId),
                'aliim_pwd' => shopconf('aliim_pwd',false,$shopId),
            ];
        }

        return $shop_info;
    }

    /**
     * 检查会员申请开店进度
     *
     * 0未申请开店
     * 1
     * 2开店申请已提交,等待平台审核通过
     * 3
     * 4平台审核通过,等待支付开店款项
     * 5开店成功
     * 6尚未缴费成功
     *
     * @param int $user_id 会员id
     * @return int
     */
    public function checkShopApplyProcess($user_id)
    {
        // 检查会员是否已经开店成功

        // 会员申请入驻信息
        $applyInfo = ShopApply::where('user_id', $user_id)->first();
        // 店铺信息
        $shop = Shop::where('user_id', $user_id)->first();


        //0未申请开店
        if (empty($applyInfo) && empty($shop)) {
            return 0;
        }

        if ($shop->shop_type == 0) { // 自营店铺 开店成功
            return 5;
        }

        //2开店申请已提交,等待平台审核通过
        if ($applyInfo->audit_status == 0) {
            return 2;
        }

        // 检查店铺开店款项支付状态
        $pay_info = ShopPayment::where('shop_id', $shop->shop_id)->orderBy('apply_time','desc')->first(); // 店铺开通/续费信息
        $pay_info = !empty($pay_info) ? $pay_info->toArray() : null;
        if ($applyInfo->audit_status == 1 && $shop->shop_audit == 1 && empty($pay_info)) {
            // 无待支付记录
            //4平台审核通过,等待支付开店款项
            return 4;
        }

        if ($applyInfo->audit_status == 1 && $shop->shop_audit == 1 && !empty($pay_info)) {
            if ($pay_info['pay_status'] == 1) {
                // 支付完成
                // 5开店成功
                return 5;
            } else {
                // 等待支付
                // 6尚未缴费成功
                return 6;
            }
        }

    }

	/**
	 * 获取店铺首页二维码
	 *
	 * @param $shop_id
	 * @return string
	 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
	 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
	 */
	public function getShopQrCode($shop_id)
	{
		$wechatSDKService = new WechatSDKService($shop_id);
		$sceneValue = Qcode::getSceneValue($shop_id, 2); // 场景值 具体的url 如商品详情页url
		$response = $wechatSDKService->getQRCode($sceneValue, 3, 6 * 24 * 3600); // 临时二维码 6天 最长30天
		$qrcode = '';
		if (!empty($response['ticket'])) {
			$qrcode = $wechatSDKService->getQRUrl($response['ticket']);
		}
		return $qrcode;
	}
}
