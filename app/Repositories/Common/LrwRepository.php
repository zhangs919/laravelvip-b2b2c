<?php

namespace App\Repositories\Common;

use App\Kernel\Repositories\Common\LrwRepository as Base;

/**
 * Class LrwRepository
 * @method getPriceFormat($price = 0, $change_price = true, $format = true) 格式化商品价格[$change_price：false 默认保留两位，true 根据商店设置控制处理小数点位数|$format：false 不带价格符号，true 带价格符号]
 * @method getImagePath($image = '') 重新获得商品图片与商品相册的地址
 * @method getContentImgReplace($content) 正则批量替换详情内图片为 绝对路径
 * @method getDdownloadTemplate($path = '') 处理指定目录文件数据调取
 * @method objectToArray($obj) 对象转数组
 * @method getReturnMobile($url = '') 跳转H5方法
 * @method pageArray($page_size = 1, $page = 1, $array = [], $order = 0, $filter_arr = []) 数组分页函数 核心函数 array_slice
 * @method getPatch() 升级补丁SQL
 * @method readModules($directory = '.') 获得所有模块的名称以及链接地址
 * @method objectArray($array = null) 对象转数组
 * @method getInciseDirectory($list = []) 切割目录文件
 * @method mysqlLikeQuote($str) 对 MYSQL LIKE 的内容进行转义
 * @method stringToStar($string = '', $num = 3, $start_len = '') 将字符串以 * 号格式显示 配合msubstr_ect函数使用
 * @method msubstrEct($str = '', $start = 0, $length = 1, $charset = "utf-8", $suffix = '***', $position = 1) 字符串截取，支持中文和其他编码
 * @method dscIp() 获取用户IP ：可能会出现误差
 * @method contentStyleReplace($content) 正则过滤内容样式 style = '' width = '' height = ''
 * @method helpersLang($files = [], $module = '', $langPath = 0) 组合语言包信息
 * @method readStaticCache($cache_path = '', $cache_name = '', $storage_path = 'common_cache/', $prefix = "php") 读结果缓存文件
 * @method writeStaticCache($cache_path = '', $cache_name = '', $caches = '', $storage_path = 'common_cache/', $prefix = "php") 写结果缓存文件
 * @method getHttpBasename($url = '', $path = '', $goods_lib = '') 下载远程图片
 * @method remoteLinkExists($url) 判断远程链接|判断本地链接 -- 是否存在
 * @method pluginsLang($plugin, $dir) 调取插件语言包[插件名称(Alipay/), __DIR__]
 * @method subStr($str, $length = 0, $append = true) 截取UTF-8编码下字符串的函数
 * @method trimRight($str) 去除字符串右侧可能出现的乱码
 * @method strLen($str = '') 计算字符串的长度（汉字按照两个字符计算）
 * @method delStrComma($str = '', $delstr = ',') 去除字符串中首尾逗号[去除字符串中出现两个连续逗号]
 * @method getBucketInfo()【云存储】获取存储信息
 * @method getOssAddFile($file = [])【云存储】上传文件
 * @method getOssDelFile($file = [])【云存储】删除文件
 * @method getDelBatch($checkboxs = '', $val_id = '', $select = '', $id = '', $query, $del = 0, $fileDir = '')【云存储】单个或批量删除图片
 * @method getDelVisualTemplates($ip = [], $suffix = '', $act = 'del_hometemplates', $seller_id = 0)【云存储】删除可视化模板OSS标识文件
 * @method getOssListFile($file = [])【云存储】下载文件
 * @method lrwEmpower(string $app_key, string $activate_time) 生成授权证书
 * @method checkEmpower(string $from = 0, string $app_key = '') 校验授权
 * @method collateOrderGoodsBonus($bonus_list = [], $orderBonus = 0, $goods_bonus = 0) 核对均摊红包商品金额是否大于订单红包金额
 * @method collateOrderGoodsCoupons($coupons_list = [], $orderCoupons = 0, $goods_coupons = 0) 核对均摊优惠券商品金额是否大于订单红包金额
 * @method dscConfig($str = '') $str默认值空，多个示例:xx, xx, xx字符串组成
 * @method dscUrl($str = '') 获取网站地址[域名]
 * @method turnPluckFlattenOne($goods_list = [], $key = 'goods_list') 提取数组数据
 * @method chatQq($basic_info) 处理系统设置[QQ客服/旺旺客服]
 * @method shippingFee($shipping_code = '', $shipping_config = '', $goods_weight = 0, $goods_amount = 0, $goods_number = 0) 计算运费
 * @method valueOfIntegral($integral = 0) 计算积分的价值（能抵多少钱）
 * @method integralOfValue($value = 0) 计算指定的金额需要多少积分
 * @method changeFloat($float = 0) 转浮点值，保存两位
 * @method dscHttp($server = '') 获取http|https
 * @method isJsonp($back_act = '', $exp = '|', $strpos = 'is_jsonp') 获取店铺二级域名跨域关键值
 * @method hostDomain($url = '') 获取主域名
 * @method getUrlHtml($list = ['index', 'user']) 返回html链接： http://www.xxx.com/,http://www.xxx.com/user.html
 * @method filterFilePhp() 过滤上传含有php文件
 * @method filterAccountChangeOrder($order_sn = '', $user_id = 0, $user_money = 0, $pay_points = 0, $is_go = true) 防止会员订单退款金额重复操作
 * @method getLinkImgList($list = []) 返回过滤数组中不存在的链接远程图片地址信息
 * @method getDirectoryFileList($dir = '', $ext = ['png', 'jpg', 'jpeg', 'gif'], $disk = '') 获取目录下的文件
 * @method getGoodsConsumptionPrice($consumption_list = [], $goods_amount = 0) 返回商品优惠后最终金额
 * @package App\Repositories\Common
 */
class LrwRepository extends Base
{

}
