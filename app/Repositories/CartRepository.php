<?php

namespace App\Repositories;


use App\Models\Cart;
use App\Models\Goods;
use App\Models\GoodsSku;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;


class CartRepository
{
    use BaseRepository;

    protected $model;

    protected $goods; // 商品模型
    protected $goodsSku; // 商品规格模型
    protected $goodsBuyNum; // 购买的商品数量
    protected $session_id; // session_id
    protected $user_id = 0; // 用户id
    protected $userGoodsTypeCount = 0;//用户购物车的全部商品种类

    /*选中购物车商品时 处理数据*/
    protected $goods_amount = 0; // 商品单价总和
    protected $goods_number = 0; // 商品数量
    protected $goods_price = "0.00"; // 购物车最后一个商品的价格
    protected $goods_price_format = "￥0"; // 商品价格格式
    protected $select_goods_amount = 0; // 选中商品总价格
    protected $select_goods_amount_format = "￥0"; // 选中商品价格格式
    protected $select_goods_number = 0; // 选中商品数量


    public function __construct()
    {
        $this->model = new Cart();

    }

    /**
     * 设置包含商品信息的模型
     * @param $goods_id
     */
    public function setGoodsModel($goods_id)
    {
        $this->goods = Goods::where('goods_id',$goods_id)->first();
    }

    /**
     * 包含一个商品规格信息的模型
     *
     * @param $skuId
     */
    public function setGoodsSkuModel($skuId)
    {
        $this->goodsSku = GoodsSku::where('sku_id', $skuId)->first();
    }

    /**
     * 设置购买的商品数量
     * @param $goodsBuyNum
     */
    public function setGoodsBuyNum($goodsBuyNum)
    {
        $this->goodsBuyNum = $goodsBuyNum;
    }

    /**
     * 将session_id改成unique_id
     * @param $uniqueId|api唯一id 类似于 pc端的session id
     */
    public function setUniqueId($uniqueId)
    {
        $this->session_id = $uniqueId;
    }

    /**
     * 设置用户id
     * @param $userId
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * 加入购物车
     *
     * @return array
     */
    public function addGoodsToCart()
    {
        if (empty($this->goods)) {
            return arr_result(-3, null, '购买商品不存在');
        }
        $condition = [
            ['user_id', $this->user_id],
            ['session_id', $this->session_id]
        ];
        $userCartCount = Cart::where($condition)->count();//获取用户购物车的商品有多少种
        if ($userCartCount >= 20) {
            return arr_result(-9, null, '购物车最多只能加入20种商品！');
        }
        // 判断是否有规格
        if ($this->goodsSku) {
            // 有规格
            if($this->goodsSku->prom_type == 1){
                $result = $this->addFlashSaleCart();
            }elseif($this->goodsSku->prom_type == 2){
                $result = $this->addGroupBuyCart();
            }elseif($this->goodsSku->prom_type == 3){
                $result = $this->addPromGoodsCart();
            }else{
                $result = $this->addNormalCart();
            }
        } else {
            // 无规格
            if($this->goods->prom_type == 1){
                $result = $this->addFlashSaleCart();
            }elseif($this->goods->prom_type == 2){
                $result = $this->addGroupBuyCart();
            }elseif($this->goods->prom_type == 3){
                $result = $this->addPromGoodsCart();
            }else{
                $result = $this->addNormalCart();
            }
        }
        $result['data'] = $UserCartGoodsNum = $this->getUserCartGoodsNum(); // 查找购物车数量
//        \cookie('cart_goods_num', $UserCartGoodsNum, 0, null, '/');

        setcookie('cart_goods_num', (int)$UserCartGoodsNum, null, '/');
        return $result;
    }

    /**
     * 获取用户购物车商品总数
     * @return float|int
     */
    public function getUserCartGoodsNum()
    {

        if (!empty($_COOKIE['cart_goods_num'])) {
            return (int)$_COOKIE['cart_goods_num'];
        }
        if ($this->user_id) {
            $goods_num = Cart::where('user_id', $this->user_id)->sum('goods_number');
        } else {
            $goods_num = Cart::where('session_id', $this->session_id)->sum('goods_number');
        }
        return empty($goods_num) ? 0 : (int)$goods_num;
    }

    /**
     * 加入购物车 - 普通商品
     * @return array
     */
    private function addNormalCart()
    {
        if (empty($this->goodsSku)) {
            $price = $this->goods->goods_price;
            $goods_number = $this->goods->goods_number;
        } else {
            //如果有规格价格，就使用规格价格，否则使用本店价
            $price = $this->goodsSku->goods_price;
            $goods_number = $this->goodsSku->goods_number;
        }
        // 查询购物车是否存在该商品
        if (!$this->user_id) {
            $condition = [
                ['user_id',$this->user_id],
                ['session_id',$this->session_id],
                ['goods_id',$this->goods->goods_id],
                ['sku_id',$this->goods->sku_id]
//                ['spec_key', (!empty($this->goodsSku) ? $this->goodsSku->key : null)]
            ];

            $userCartGoods = Cart::where($condition)->first();
        } else {
            $condition = [
                ['user_id',$this->user_id],
                ['goods_id',$this->goods->goods_id],
                ['sku_id',$this->goods->sku_id],
//                ['spec_key', (!empty($this->goodsSku) ? $this->goodsSku->key : null)]
            ];

            $userCartGoods = Cart::where($condition)->first();
        }

        if (count($userCartGoods) > 0) {

            // 该商品已经加入购物车
            $userWantGoodsNum = $this->goodsBuyNum + $userCartGoods['goods_number'];//本次要购买的数量加上购物车的本身存在的数量
            if($userWantGoodsNum > 200){ // 限制购物车总数量不大于200
                $userWantGoodsNum = 200;
            }
            if ($userWantGoodsNum > $goods_number) {
                return arr_result(-4, '', '商品库存不足，剩余'.$goods_number.',当前购物车已有'.$userCartGoods['goods_number'].'件');
            }
            $update = ['goods_number' => $userWantGoodsNum,'goods_price'=>$price,'member_goods_price'=>$price];
//            $cartRes = Cart::where($condition)->update($update);
            $cartRes = $userCartGoods->update($update); // 更新购物车商品信息
        } else {
            // 该商品未加入购物车
            if ($this->goodsBuyNum > $goods_number) {
                return arr_result(-4, '', '商品库存不足，剩余'.$this->goods['store_count']);
            }
            $cartInsertData = array(
                'user_id' => $this->user_id,   // 用户id
                'session_id' => $this->session_id,   // session_id
                'shop_id' => $this->goods->shop_id,   // 店铺id
                'goods_id' => $this->goods->goods_id,   // 商品id
                'sku_id' => $this->goods->sku_id,
                'cart_act_id' => 0, // 活动id
                'goods_name' => $this->goods->goods_name,   // 商品名称
                'goods_number' => $this->goodsBuyNum, // 购买数量
                'goods_price' => $price,  // 原价
                'goods_type' => 0, // 商品类型
                'parent_id' => 0, // 父id
                'is_gift' => 0, // 是否赠品
                'buyer_type' => 0, // 买家类型 0-个人 1-店铺
                'add_time' => time(),
                'select' => 1, // 是否选中

//                'goods_sn' => $this->goods->goods_sn,   // 商品货号
//                'member_goods_price' => $price,  // 会员折扣价 默认为 购买价
//                'prom_type' => 0,   // 0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠
//                'prom_id' => 0,   // 活动id
            );
//            if(!empty($this->goodsSku)){
//                $cartInsertData['spec_key'] = $this->goodsSku->key;
//                $cartInsertData['spec_key_name'] = $this->goodsSku->key_name; // 规格 key_name
//                $cartInsertData['sku'] = $this->goodsSku->sku; // todo 不知道是什么
//            }
            $cartRes = Cart::create($cartInsertData);
            if (!empty($cartRes->cart_id)) {
                $cartRes = true;
            } else {
                $cartRes = false;
            }
        }
        if (!$cartRes) {
            return arr_result(-1, '', '加入购物车失败！');
        }

        return arr_result(0, '', '加入购物车成功！');
    }

    /**
     * 获取用户购物车列表
     *
     * @param int $select 是否被用户勾选中的 0 为全部 1为选中  一般没有查询不选中的商品情况
     * @return mixed
     */
    public function getCartList($select = 0)
    {
        if ($this->user_id) {
            $cartCondition[] = ['user_id', $this->user_id];
        } else {
            $cartCondition[] = ['session_id', $this->session_id];
        }
        if ($select != 0) {
            $cartCondition[] = ['select', 1];
        }
        $cartList = Cart::with(['goods','shop'])->where($cartCondition)->get();
        $afterCheckCartList = $this->checkCartList($cartList);
//        dd(Cookie::get('cart_goods_num'));
        $cartGoodsTotalNum = array_sum(array_map(function($val){return $val['goods_number'];}, $afterCheckCartList->toArray()));//购物车购买的商品总数
//        \cookie('cart_goods_num', $cartGoodsTotalNum, 0, null, '/');
        setcookie('cart_goods_num', (int)$cartGoodsTotalNum, null, '/');
        return $afterCheckCartList->toArray(); // 转成数组返回
    }

    /**
     * 过滤无效的购物车商品
     * @param $cartList
     * @return mixed
     */
    public function checkCartList($cartList)
    {
        foreach ($cartList as $k=>$cart) {
            if ($cart->goods->count() <= 0 || $cart->goods->goods_status != 1 || $cart->goods->goods_audit != 1) {
                Cart::where('cart_id', $cart->cart_id)->delete(); // 删除
                unset($cartList[$k]);
                continue;
            }
            // 活动商品失效处理
            // todo
        }
        return $cartList;
    }

    /**
     * 获取用户购物车想购商品有多少种
     * @return mixed
     */
    public function getUserCartOrderCount()
    {
        $count = Cart::where([['user_id',$this->user_id],['select',1]])->count();
        return $count;
    }

    /**
     * 用户登录后 对购物车进行操作
     */
    public function doUserLoginHandle()
    {
        if (empty($this->session_id) || empty($this->user_id)) {
            return;
        }
        // 用户登录后 将购物车的商品 user_id 改为当前登录的user_id
        Cart::where([['session_id',$this->session_id],['user_id',0]])->update(['user_id'=>$this->user_id]);
        // 查询购物车两件完全相同的商品
        $cart_id_arr = DB::table('cart')->select('cart_id')
            ->where('user_id', $this->user_id)
            ->groupBy('goods_id', 'spec_key')
            ->havingRaw('count(goods_id) > 1')->get();
        if (!empty($cart_id_arr)) {
            $cart_id_arr = array_column($cart_id_arr->toArray(), 'cart_id');
            Cart::whereIn('cart_id', $cart_id_arr)->delete(); // 删除购物车完全相同的商品
        }
    }

    /**
     * 修改购物车商品数量
     * todo 有问题
     * @param int $sku_id 商品sku_id
     * @param int $cart_id 购物车id
     * @param int $goods_num 商品数量
     * @return array
     */
    public function changeCartNum($sku_id, $goods_num, $cart_id)
    {

        $cart = Cart::find($cart_id);
        if (empty($cart)) {
            $goodsRep = new GoodsRepository();
            $goods_id = $goodsRep->getGoodsId($sku_id);
            $cart = Cart::where('goods_id', $goods_id)->first();
        }
        if($goods_num > 200){
            $goods_num = 200;
        }
        $cart->goods_number = $goods_num;

        // 判断商品库存
        $sku_goods_number = GoodsSku::where('sku_id', $sku_id)->value('goods_number');
        if ($goods_num >= $sku_goods_number) {
            return arr_result(-1, '', '商品数量不能大于库存');
        }
        $ret = $cart->save(); // 更新数据
        if ($ret === false) {
            return arr_result(-1, '', '修改商品数量失败！');
        }
        return arr_result(0, '', '修改商品数量成功');
    }

    /**
     * 购物车商品 删除
     *
     * @param array $cart_ids 购物车ids
     * @return mixed
     */
    public function delete($cart_ids = [])
    {
        if ($this->user_id) {
            $cartCondition[] = ['user_id', $this->user_id];
        } else {
            $cartCondition[] = ['session_id', $this->session_id];
            $cartCondition[] = ['user_id', 0];
        }
        if (is_array($cart_ids)) {
            $ret = Cart::where($cartCondition)->whereIn('cart_id', $cart_ids)->delete();
        } else {
            $cartCondition[] = ['cart_id', $cart_ids];
            $ret = Cart::where($cartCondition)->delete();
        }

        return $ret;
    }

    /**
     * 获取购物车的价格详情
     * @param null $cartList 购物车列表
     * @return array
     */
    public function getCartPriceInfo($cartList = null)
    {
        $total_fee = $goods_number = 0;//初始化数据。商品总额/商品总共数量
        if($cartList){
            foreach ($cartList as $cartKey => $cartItem) {
                if ($cartItem['select'] == 1) {
                    $total_fee += $cartItem['goods_number'] * $cartItem['goods_price'];
                    $goods_number += $cartItem['goods_number'];
                }
            }
        }
        return compact('total_fee', 'goods_number');
    }

    /**
     * 选中购物车商品
     * @param string $cart_ids 购物车ids 多个以逗号分隔
     * @return mixed
     */
    public function cartSelect($cart_ids = '')
    {
        if ($this->user_id) {
            $condition = [['user_id', $this->user_id]];
        } else {
            $condition = [['session_id', $this->session_id]];
        }
        if ($cart_ids != '') {
            // 如果cart_ids 不为空 则将传入的购物车id设置为选中状态
            $cart_ids_arr = explode(',', $cart_ids);

            DB::beginTransaction();
            try{
                Cart::where($condition)->whereIn('cart_id', $cart_ids_arr)->update(['select' => 1]);
                Cart::where($condition)->whereNotIn('cart_id', $cart_ids_arr)->update(['select' => 0]); // 将未选中商品设置为0
                DB::commit();
                $ret = true;
            } catch (\Exception $e) {
                DB::rollback();//事务回滚
                echo $e->getMessage();
                echo $e->getCode();
                $ret = false;
            }
        } else {
            // 如果cart_ids 为空 则将用户所有购物车商品取消选中
            $ret = Cart::where($condition)->update(['select' => 0]);
        }

        if ($ret === false) {
            return result(-1, '', '选中商品失败！', [], false);
        }

        // 处理选中商品信息
        $cart_list = $this->getCartList();

        // 购物车商品以店铺ID分组显示
        $select_shop_amount = $shop_delivery_enable = [];
        $goods_amount = $select_goods_amount = 0;
        $count = $goods_num = $select_goods_number = 0;
        $goods_price = "0.00";
        foreach ($cart_list as $cart) {
            if ($cart['select']) {
                // 选中商品
                $select_goods_amount += $cart['goods_price'];
                $select_shop_amount[$cart['shop_id']] = $select_goods_amount;
                $select_goods_number += $cart['goods_number'];
            }
            // 全部商品
            $count = $goods_num = $this->getUserCartGoodsNum();
            $goods_amount += $cart['goods_price'];
            $shop_delivery_enable[$cart['shop_id']] = 1; // todo 如何获取值
        }


        $data = [
            'count' => $count,
            'dif_price' => -101,
            'dif_price_format' => "￥-101",
            'goods_amount' => $goods_amount,
            'goods_number' => $goods_num,
            'goods_price' => $goods_price,
            'goods_price_format' => "￥0",
            'select_goods_amount' => $select_goods_amount,
            'select_goods_amount_format' => "￥".$select_goods_amount,
            'select_goods_number' => $select_goods_number,
            'select_shop_amount' => $select_shop_amount,
            'shop_delivery_enable' => $shop_delivery_enable,
//            'start_price' => "49.00",
//            'start_price_format' => "￥49.00",
            'submit_enable' => 1
        ];
        return result(0, $data, '选中商品成功！', [], false);
    }
}