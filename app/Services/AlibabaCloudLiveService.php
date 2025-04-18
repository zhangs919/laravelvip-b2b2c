<?php


namespace App\Services;


use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Storage;

class AlibabaCloudLiveService
{

    protected $accessKeyId = '';
    protected $accessKeySecret = '';

    protected $host = 'live.aliyuncs.com';

    protected $push_domain = 'live.xxx.com';
    protected $play_domain = 'living.xxx.com';
    protected $push_auth_key = 'xxxxxxxx';
    protected $play_auth_key = 'xxxxxxxx';
    protected $push_auth_expire = 1440; // 推流鉴权有效期：1天 阿里云后台设置的是：1,440 分钟
    protected $play_auth_expire = 3600; // 播流鉴权有效期：1小时 阿里云后台设置的是：60 分钟

    public function __construct()
    {
        // 已完成安装
        if (Storage::disk('local')->exists('seeder/install.lock')) {
            $this->accessKeyId = sysconf('alioss_access_key_id');
            $this->accessKeySecret = sysconf('alioss_access_key_secret');

            // Set up a global client
            AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessKeySecret)
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
        }
    }

    /**
     * 执行接口方法
     *
     * @param string|null $action 接口方法名称
     * @param array $query 接口参数
     * @return array|false
     */
    public function execute(?string $action, $query = [])
    {

        try {
            $result = AlibabaCloud::rpc()
                ->product('live')
                // ->scheme('https') // https | http
                ->version('2016-11-01')
                ->action($action)
                ->method('POST')
                ->host('live.aliyuncs.com')
                ->options([
                    'query' => $query
                ])
                ->request();

            return $result->toArray();
        } catch (ClientException $e) {
            throw new \Exception($e->getErrorMessage());
//            echo $e->getErrorMessage() . PHP_EOL;
//            return false;
        } catch (ServerException $e) {
            throw new \Exception($e->getErrorMessage());
//            echo $e->getErrorMessage() . PHP_EOL;
//            return false;
        }

    }

    /******** 直播流管理 start *******/
    /**
     * 查询域名下拉流配置信息
     *
     * @return array|false
     */
    public function describeLiveDomainDetail()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'DomainName' => $this->play_domain,
        ];
        return $this->execute("DescribeLiveDomainDetail", $query);
    }

    /**
     * 禁止某条流的推送，可以预设某个时刻将流恢复。
     *
     * @param string $appName 推流所属应用名称 格式：user(表示用户发起的直播)/shop(表示商家发起的直播)
     * @param string $streamName 推流名称 格式：room+对应id（如：文章ID）
     * @param string $oneshot 是否只断流不加入黑名单。取值：yes：只断流不加黑名单（支持上行推送或上行播流）。no：断流加入黑名单。
     * @param string $resumeTime // 恢复流的时间 可选 格式为：yyyy-MM-ddTHH:mm:ssZ（UTC时间）
     * @return array|false
     */
    public function forbidLiveStream($appName, $streamName, $oneshot = 'no', $resumeTime = '')
    {
        $query = [
            'DomainName' => $this->push_domain,//推流域名
            'AppName' => $appName,//推流所属应用名称
            'StreamName' => $streamName,//推流名称
            'LiveStreamType' => "publisher", //用于指定主播推流还是客户端播流。目前仅支持：publisher（主播推流）
            'Oneshot' => $oneshot,
            'ResumeTime' => $resumeTime
        ];
        return $this->execute("ForbidLiveStream", $query);
    }

    /**
     * 恢复某条流的推送
     *
     * @param string $appName 推流所属应用名称
     * @param string $streamName 推流名称
     * @return array|false
     */
    public function resumeLiveStream($appName, $streamName)
    {
        $query = [
            'DomainName' => $this->push_domain,//推流域名
            'AppName' => $appName,//推流所属应用名称
            'StreamName' => $streamName,//推流名称
            'LiveStreamType' => "publisher", //用于指定主播推流还是客户端播流。目前仅支持：publisher（主播推流）
        ];
        return $this->execute("ResumeLiveStream", $query);
    }

    /**
     * 查询直播域名下流帧率和码率数据
     *
     * @return array|false
     */
    public function describeLiveDomainFrameRateAndBitRateData()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'QueryTime' => "2019-02-21T08:00:00Z",
            'DomainName' => "live.laravelviip.com",
        ];
        return $this->execute("DescribeLiveDomainFrameRateAndBitRateData", $query);
    }

    /**
     * 查询域名下所有流某分钟的在线人数信息
     *
     * @return array|false
     */
    public function describeLiveDomainOnlineUserNum()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'QueryTime' => "2019-02-21T08:00:00Z",
            'DomainName' => "living.laravelviip.com",
        ];
        return $this->execute("DescribeLiveDomainOnlineUserNum", $query);
    }
    /******** 直播流管理 end *******/


    /******** 推流回调 start *******/
    /**
     * 设置推流回调配置
     *
     * @return array|false
     */
    public function setLiveStreamsNotifyUrlConfig()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'NotifyUrl' => "http://play.aliyunlive.com/notify",
            'DomainName' => $this->push_domain,
        ];
        return $this->execute("SetLiveStreamsNotifyUrlConfig", $query);
    }

    /**
     * 查询推流回调配置
     *
     * @return array|false
     */
    public function describeLiveStreamsNotifyUrlConfig()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'NotifyUrl' => "http://play.aliyunlive.com/notify",
            'DomainName' => $this->push_domain, // 加速域名
        ];
        return $this->execute("DescribeLiveStreamsNotifyUrlConfig", $query);
    }
    /******** 推流回调 end *******/


    /**
     * 生成推/播流URL
     *
     * @param $id
     * @param string $appName shop-商家直播 user-用户直播
     * @param int $type 0-推流 1-播流
     * @return array
     */
    public function createStreamUrl($id, $type = 0, $appName = 'shop')
    {
        $streamName = "room{$id}";
        $domainInfo = [
            'push_domain' => $this->push_domain,
            'play_domain' => $this->play_domain,
            'push_auth_expire' => $this->push_auth_expire,
            'play_auth_expire' => $this->play_auth_expire,
            'push_auth_key' => $this->push_auth_key,
            'play_auth_key' => $this->play_auth_key,
            'app_name' => $appName,
            'stream_name' => $streamName,
        ];
        if ($type == 0) {
            return $this->getPushUrl($domainInfo);
        } else {
            return $this->getPlayAUrl($domainInfo);

        }
    }

    /**
     * 播流 url 鉴权生成
     *
     * @param $domainInfo
     * @return string[]
     */
    function getPlayAUrl($domainInfo)
    {
        $play_domain = $domainInfo['play_domain'];
        $play_key = $domainInfo['play_auth_key'];
        $appName = $domainInfo['app_name'];
        $streamName = $domainInfo['stream_name'];
        $expireTime = $domainInfo['play_auth_expire'];
        //未开启鉴权Key的情况下
        if ($play_key == '') {
            $rtmp_play_url = 'rtmp://' . $play_domain . '/' . $appName . '/' . $streamName;
            $flv_play_url = 'http://' . $play_domain . '/' . $appName . '/' . $streamName . '.flv';
            $hls_play_url = 'http://' . $play_domain . '/' . $appName . '/' . $streamName . '.m3u8';
        } else {
            $timeStamp = time() + $expireTime;

            $rtmp_sstring = '/' . $appName . '/' . $streamName . '-' . $timeStamp . '-0-0-' . $play_key;
            $rtmp_md5hash = md5($rtmp_sstring);
            $rtmp_play_url = 'rtmp://' . $play_domain . '/' . $appName . '/' . $streamName . '?auth_key=' . $timeStamp . '-0-0-' . $rtmp_md5hash;

            $flv_sstring = '/' . $appName . '/' . $streamName . '.flv-' . $timeStamp . '-0-0-' . $play_key;
            $flv_md5hash = md5($flv_sstring);
            $flv_play_url = 'http://' . $play_domain . '/' . $appName . '/' . $streamName . '.flv?auth_key=' . $timeStamp . '-0-0-' . $flv_md5hash;

            $hls_sstring = '/' . $appName . '/' . $streamName . '.m3u8-' . $timeStamp . '-0-0-' . $play_key;
            $hls_md5hash = md5($hls_sstring);
            $hls_play_url = 'http://' . $play_domain . '/' . $appName . '/' . $streamName . '.m3u8?auth_key=' . $timeStamp . '-0-0-' . $hls_md5hash;
        }
        return [
            'rtmp' => $rtmp_play_url,
            'flv' => $flv_play_url,
            'hls' => $hls_play_url,
        ];
    }

    /**
     * 推流 url 鉴权生成
     *
     * @param $domainInfo
     * @return string[]
     */
    private function getPushUrl($domainInfo)
    {
        $push_domain = $domainInfo['push_domain'];
        $push_key = $domainInfo['push_auth_key'];
        $appName = $domainInfo['app_name'];
        $streamName = $domainInfo['stream_name'];
        $expireTime = $domainInfo['push_auth_expire'];
        if (empty($push_key)) {
            $push_url = 'rtmp://' . $push_domain . '/' . $appName . '/' . $streamName;
        } else {
            $timeStamp = time() + $expireTime;
            $sstring = '/' . $appName . '/' . $streamName . '-' . $timeStamp . '-0-0-' . $push_key;
            $md5hash = md5($sstring);
            $push_url = 'rtmp://' . $push_domain . '/' . $appName . '/' . $streamName . '?auth_key=' . $timeStamp . '-0-0-' . $md5hash;
        }
        return [
            'rtmp' => $push_url
        ];
    }
}
