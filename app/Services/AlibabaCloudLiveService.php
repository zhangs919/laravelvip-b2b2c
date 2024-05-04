<?php


namespace App\Services;


use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class AlibabaCloudLiveService
{

    protected $accessKeyId = '';
    protected $accessKeySecret = '';

    protected $host = 'live.aliyuncs.com';

    public function __construct()
    {
        $this->accessKeyId = sysconf('alioss_access_key_id'); //env('ALI_ACCESS_KEY_ID');
        $this->accessKeySecret = sysconf('alioss_access_key_secret'); //env('ALI_ACCESS_KEY_SECRET');

        // Set up a global client
        AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessKeySecret)
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
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
//            echo $e->getErrorMessage() . PHP_EOL;
            return false;
        } catch (ServerException $e) {
//            echo $e->getErrorMessage() . PHP_EOL;
            return false;
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
            'DomainName' => "living.laravelvip.com",
        ];
        return $this->execute("DescribeLiveDomainDetail", $query);
    }

    /**
     * 禁止某条流的推送，可以预设某个时刻将流恢复。
     *
     * @return array|false
     */
    public function forbidLiveStream()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'AppName' => "lrw",
            'StreamName' => "room1",
            'LiveStreamType' => "publisher",
            'DomainName' => "living.laravelvip.com",
            'ResumeTime' => "2015-12-01T17:37:00Z", // 恢复流的时间 可选
        ];
        return $this->execute("ForbidLiveStream", $query);
    }

    /**
     * 恢复某条流的推送
     *
     * @return array|false
     */
    public function resumeLiveStream()
    {
        $query = [
            'RegionId' => "cn-hangzhou",
            'AppName' => "lrw",
            'StreamName' => "room1",
            'LiveStreamType' => "publisher",
            'DomainName' => "living.laravelvip.com",
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
            'DomainName' => "live.laravelvip.com",
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
            'DomainName' => "live.laravelvip.com", // 加速域名
        ];
        return $this->execute("DescribeLiveStreamsNotifyUrlConfig", $query);
    }
    /******** 推流回调 end *******/


    /**
     * 生成推/播流URL
     *
     * @param $id
     * @param int $type 0-推流 1-播流
     * @param string $playType 'm3u8、flv'
     * @return string
     */
    public function createStreamUrl($id, $type = 0, $playType = 'm3u8')
    {
        $pushDomain = 'rtmp://live.laravelvip.com';
        $playDomain = 'https://living.laravelvip.com';
        $rtmpPlayDomain = "rtmp://living.laravelvip.com";

        $appName = "lrw";
        $streamName = "room{$id}";
        $uriStr = "/{$appName}/{$streamName}";
        $domainInfo = [
            'push_auth_expire' => 3600*24, // 推流鉴权有效期：1天
            'play_auth_expire' => 3600, // 播流鉴权有效期：1小时
            'auth_key' => 'Q90vEPQt1l',
            'app_name' => $appName,
            'stream_name' => $streamName,
        ];

        if ($type == 0) {
            return $pushDomain . $this->getPushAuthUri($uriStr, $domainInfo);
        } else {
            if ($playType == 'm3u8') {
                return $playDomain . $this->getPlayAuthUri($uriStr, $domainInfo, 'm3u8');
            } elseif ($playType == 'flv') {
                return $playDomain . $this->getPlayAuthUri($uriStr, $domainInfo,'flv');
            } else {
                return $rtmpPlayDomain . $this->getPlayAuthUri($uriStr, $domainInfo);
            }
        }
    }


    /**
     * 播流 url 鉴权生成
     *
     * @param $uri
     * @param $domainInfo
     * @param string $type
     * @return string
     */
    private function getPlayAuthUri($uri, $domainInfo, $type = '')
    {
        $expressTime = time() + $domainInfo['play_auth_expire'];
        $liveSessionKey = 'live_'.$domainInfo['app_name'].'_'.$domainInfo['stream_name'];
        // 先从缓存中读取 auth_key
        $authKey = session($liveSessionKey);

        if ($type) {
            if (!$authKey) {
                // 不存在
                $authKey = $expressTime . '-0-0-' . md5($uri . '.' . $type . '-' . $expressTime. '-0-0-' . $domainInfo['auth_key']);
                // 写入缓存
                session([$liveSessionKey=>$authKey]);
            }
            $url = $uri . '.' . $type . '?auth_key='.$authKey;
        } else {
            if (!$authKey) {
                // 不存在
                $authKey = $expressTime . '-0-0-' .md5($uri . '-' . $expressTime. '-0-0-' . $domainInfo['auth_key']);
                // 写入缓存
                session([$liveSessionKey=>$authKey]);
            }
            $url = $uri . $type . '?auth_key=' .  $authKey;
        }

        return $url;
    }

    /**
     * 推流 url 鉴权生成
     *
     * @param $uri
     * @param $domainInfo
     * @return string
     */
    private function getPushAuthUri($uri, $domainInfo)
    {
        $expressTime = time() + $domainInfo['push_auth_expire'];
        $preMd5Str = $uri . '-' . $expressTime. '-0-0-' . $domainInfo['auth_key'];
        return $uri . '?auth_key=' . $expressTime . '-0-0-' . md5($preMd5Str);
    }
}
