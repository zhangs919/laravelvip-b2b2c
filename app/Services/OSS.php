<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2019-03-17
// | Description: 阿里云OSS上传
// +----------------------------------------------------------------------

namespace App\Services;

/**
 * todo 该类未使用 考虑移除
 *
 * Class OSS
 * @package App\Services
 */
class OSS
{

    /* 城市名称：
       *
       *  经典网络下可选：杭州、上海、青岛、北京、张家口、深圳、香港、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
       *  VPC 网络下可选：杭州、上海、青岛、北京、张家口、深圳、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
       */
    private $city = '弗吉尼亚';
    // 经典网络 or VPC
    private $networkType = '经典网络';

    private $AccessKeyId = '';
    private $AccessKeySecret = '';
    private $ossClient;
    /**
     * 私有初始化 API，非 API，不用关注
     * @param boolean 是否使用内网
     */
    public function __construct($isInternal = false)
    {
        if ($this->networkType == 'VPC' && !$isInternal) {
            throw new Exception("VPC 网络下不提供外网上传、下载等功能");
        }
        $this->AccessKeyId = sysconf('alioss_access_key_id'); //env('ALI_ACCESS_KEY_ID');
        $this->AccessKeySecret = sysconf('alioss_access_key_secret'); //env('ALI_ACCESS_KEY_SECRET');
        $this->ossClient = AliyunOSS::boot(
            $this->city,
            $this->networkType,
            $isInternal,
            $this->AccessKeyId,
            $this->AccessKeySecret
        );
    }
    /**
     * 使用外网上传文件
     * @param  string bucket名称
     * @param  string 上传之后的 OSS object 名称
     * @param  string 上传文件路径
     * @return boolean 上传是否成功
     */
    public static function publicUpload($bucketName, $ossKey, $filePath, $options = [])
    {
        $oss = new OSS();
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->uploadFile($ossKey, $filePath, $options);
    }
    /**
     * 使用阿里云内网上传文件
     * @param  string bucket名称
     * @param  string 上传之后的 OSS object 名称
     * @param  string 上传文件路径
     * @return boolean 上传是否成功
     */
    public static function privateUpload($bucketName, $ossKey, $filePath, $options = [])
    {
        $oss = new OSS(true);
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->uploadFile($ossKey, $filePath, $options);
    }
    /**
     * 使用外网直接上传变量内容
     * @param  string bucket名称
     * @param  string 上传之后的 OSS object 名称
     * @param  string 上传的变量
     * @return boolean 上传是否成功
     */
    public static function publicUploadContent($bucketName, $ossKey, $content, $options = [])
    {
        $oss = new OSS();
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->uploadContent($ossKey, $content, $options);
    }
    /**
     * 使用阿里云内网直接上传变量内容
     * @param  string bucket名称
     * @param  string 上传之后的 OSS object 名称
     * @param  string 上传的变量
     * @return boolean 上传是否成功
     */
    public static function privateUploadContent($bucketName, $ossKey, $content, $options = [])
    {
        $oss = new OSS(true);
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->uploadContent($ossKey, $content, $options);
    }
    /**
     * 使用外网删除文件
     * @param  string bucket名称
     * @param  string 目标 OSS object 名称
     * @return boolean 删除是否成功
     */
    public static function publicDeleteObject($bucketName, $ossKey)
    {
        $oss = new OSS();
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->deleteObject($bucketName, $ossKey);
    }
    /**
     * 使用阿里云内网删除文件
     * @param  string bucket名称
     * @param  string 目标 OSS object 名称
     * @return boolean 删除是否成功
     */
    public static function privateDeleteObject($bucketName, $ossKey)
    {
        $oss = new OSS(true);
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->deleteObject($bucketName, $ossKey);
    }
    /**
     * -------------------------------------------------
     *
     *
     *  下面不再分公网内网出 API，也不注释了，大家自行体会吧。。。
     *
     *
     * -------------------------------------------------
     */
    public function copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
    {
        $oss = new OSS();
        return $oss->ossClient->copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
    }
    public function moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
    {
        $oss = new OSS();
        return $oss->ossClient->moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
    }
    // 获取公开文件的 URL
    public static function getPublicObjectURL($bucketName, $ossKey)
    {
        $oss = new OSS();
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->getPublicUrl($ossKey);
    }
    // 获取私有文件的URL，并设定过期时间，如 \DateTime('+1 day')
    public static function getPrivateObjectURLWithExpireTime($bucketName, $ossKey, DateTime $expire_time)
    {
        $oss = new OSS();
        $oss->ossClient->setBucket($bucketName);
        return $oss->ossClient->getUrl($ossKey, $expire_time);
    }
    public static function createBucket($bucketName)
    {
        $oss = new OSS();
        return $oss->ossClient->createBucket($bucketName);
    }
    public static function getAllObjectKey($bucketName)
    {
        $oss = new OSS();
        return $oss->ossClient->getAllObjectKey($bucketName);
    }
    public static function getObjectMeta($bucketName, $ossKey)
    {
        $oss = new OSS();
        return $oss->ossClient->getObjectMeta($bucketName, $ossKey);
    }
}
