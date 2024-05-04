<?php


namespace App\Services;

use Illuminate\Support\Facades\Redis;

/**
 * 分布式锁服务
 *
 * Class RedisLockService
 * @package App\Services
 */
class RedisLockService
{
    public $redis;
    public $lockedNames = [];

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * 加锁
     *
     * @param $name
     * @param int $timeout
     * @param int $expire
     * @param int $waitIntervalUs
     * @return bool
     */
    public function lock($name, $timeout = 10, $expire = 15, $waitIntervalUs = 100000)
    {
        if ($name == null) return false;
        //获取当前时间
        $now = time();
        //获取锁失败时的等待超时时刻
        $timeoutAt = $now + $timeout;
        //锁的最大生存时刻
        $expireAt = $now + $expire;

        $redisKey = "Lock:{$name}";
        while (true) {
            // 将redisKey的最大生存时刻存到redis里，过了这个时刻该锁会被自动释放
            $result = $this->redis->setnx($redisKey, $expireAt);

            if ($result) {
                // 设置key的失效时间
                $this->redis->expire($redisKey, $expire);
                // 将锁标志放到lockedNames数组里
                $this->lockedNames[$name] = $expireAt;
                //以秒为单位，返回给定key的剩余生存时间
                $ttl = $this->redis->ttl($redisKey);
                /*
                 * ttl小于0 表示key上没有设置生存时间（key是不会不存在的，因为前面setnx会自动创建）
                 * 如果出现这种情况，那就是进程的某个实例setnx成功后crash导致紧跟着的expire没有被调用
                 * 这时可以直接设置expire并把锁纳为己用
                 */
                if ($ttl < 0) {
                    $this->redis->set($redisKey, $expireAt);
                    $this->lockedNames[$name] = $expireAt;
                    return true;
                }
                return true;
            }
            // 如果没设置锁失败的等待时间 或者 已超过最大等待时间了，就退出
            if ($timeout <= 0 || $timeoutAt < microtime(true)) break;
            // 隔$waitIntervalUs后继续请求
            usleep($waitIntervalUs);
        }
        return false;
    }

    /**
     * 判断锁是否存在
     * @param $name
     * @return bool
     */
    public function isLocking($name)
    {
        return key_exists($name, $this->lockedNames);
    }

    /**
     * 解锁
     *
     * @param $name
     * @return bool
     */
    public function unlock($name)
    {
        //先判断是否存在此锁
        if ($this->isLocking($name)) {
            // 删除锁
            if ($this->redis->del("Lock:$name")) {
                // 清掉lockedNames里的锁标志
                unset($this->lockedNames[$name]);
                return true;
            }
        }
        return false;
    }
}