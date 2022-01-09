<?php

namespace App\Repositories;

use App\Models\Goods;
use App\Models\Shop;
use App\Models\ShopBindClass;
use App\Models\ShopFieldValue;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShopRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new Shop();

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
        $info = $this->getById($shop_id);
        $opening_hour = unserialize($info->opening_hour);
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

        $info->opening_hour = $opening_hour;

        return $info;
    }

    /**
     * 新增店铺
     *
     * @param array $shopInsert 店铺信息
     * @param array $shopFieldValueInsert 店铺认证信息
     * @return bool
     */
    public function addShop($shopInsert, $shopFieldValueInsert = [])
    {

        DB::beginTransaction();
        try {
            // 检查店铺是否存在
            $shop_result = DB::table('shop')->where('user_id',$shopInsert['user_id'])->first();

            if (!empty($shop_result)) {
                return false;
            }

            if (empty($shop_result)) {
                // 插入店铺表（shop)
                $shop_result = $this->store($shopInsert);
                if (!$shop_result) {
                    return false;
                }

                // 更新会员is_seller为1
                DB::table('user')->where('user_id', $shopInsert['user_id'])->update(['is_seller'=>1]);
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
                        if (str_contains($key, 'check-') && !empty($item)) {
                            $filename = request()->post($key, 'name');
                            $field = str_replace('check-', '', $key);
                            $file = request()->file()['ShopFieldValueModel'][$field];
                            $storePath = 'shop/'.$shop_result->shop_id.'/field'; //

                            $tools = new ToolsRepository();
                            $uploadRes = $tools->upfile($file, request(), $storePath);
                            if (isset($uploadRes['error'])) {
                                return false;
                            }
                            $shopFieldValueInsertData[$field] = $uploadRes['path'];
                        }
                    }
                }

                $shopFieldValueInsertData['shop_id'] = $shop_result->shop_id;

                $shopFieldValueModel->fill($shopFieldValueInsertData);
                $shopFieldValueModel->save();
            }

            // 添加店铺相册
            $imageDirRep = new ImageDirRepository();
            $imageDirRep->createDefaultDirs($shop_result->shop_id, 0, 'shop');

            // 添加店铺配置信息
            $shopConfigRep = new ShopConfigRepository();
            $shopConfigRep->createShopConfigData($shop_result->shop_id);

            // 添加店铺所属分类表
            if (!empty($shopInsert['cat_ids'])) {
                foreach ($shopInsert['cat_ids'] as $item) {
                    $shopBindClassInsert = [
                        'shop_id' => $shop_result->shop_id,
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
            echo $e->getMessage();
            echo $e->getCode();
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
            echo $e->getMessage();
            echo $e->getCode();
            return false;
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
        $url = route('mobile_shop_home', ['shop_id' => $shop_id]);

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
        $shop = $this->getShopInfo($shopId)->toArray();

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
        $shopCredit = new ShopCreditRepository();
        $credit = $shopCredit->getCreditInfoByScore($shop['credit']);

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
        $customer = new CustomerRepository();
        $customer_main = $customer->getCustomerMain($shopId);

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
     *
     * @param int $userId 会员id
     * @return int
     */
    public function checkShopApplyProcess($userId)
    {
        // 检查会员是否已经开店成功


        return 2;
    }
}