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
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;


class Video extends BaseModel
{
    protected $table = 'video';

    protected $fillable = [
        //add_time: 1552792944

        //audio_bit_rate: "45222"
        //audio_channels: 2
        //audio_codec: "AAC (Advanced Audio Coding)"
        //audio_desc: "AAC (Advanced Audio Coding) 48000Hz 立体声 44.162109375Kbps"
        //audio_duration: "41.770000"
        //bit_rate: "482591"
        //dir_id: "16"
        //dirname: "/videos/shop/1/gallery/2019/03/17/"
        //display_ratio: "0:1"
        //duration: "41.792000"
        //extension: "mp4"
        //file_name: "15527929444336"
        //frame_rate: 24
        //height: 368
        //host: "http://xxx.oss-cn-beijing.aliyuncs.com/images/"
        //name: "1515480321852459"
        //path: "/videos/shop/1/gallery/2019/03/17/15527929444336.mp4"
        //poster: "http://xxx.oss-cn-beijing.aliyuncs.com/images/videos/shop/1/gallery/2019/03/17/15527929444336.mp4!poster.png"
        //sample_rate: "48000"
        //shop_id: 1
        //site_id: 0
        //size: "2521057"
        //sort: 255
        //url: "http://xxx.oss-cn-beijing.aliyuncs.com/images/videos/shop/1/gallery/2019/03/17/15527929444336.mp4"
        //video_bit_rate: "435573"
        //video_codec: "H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10"
        //video_desc: "H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10 640x368 24fps 425.3642578125Kbps"
        //video_id: 8
        //width: 640

        'add_time',
//        'audio_bit_rate','audio_channels','audio_codec','audio_desc', 'audio_duration','bit_rate',
        'dir_id', 'dirname',
//        'display_ratio','duration',
        'extension', 'file_name',
//        'frame_rate',
        'height',
//        'host',
        'name', 'path',
//        'poster',
//        'sample_rate',
//        'shop_id','site_id',
        'size', 'sort',
        'width', 'is_delete',

        /*'add_time',
        'audio_bit_rate','audio_channels','audio_codec','audio_desc', 'audio_duration','bit_rate',
        'dir_id', 'dirname', 'display_ratio','duration',
        'extension', 'file_name', 'frame_rate', 'height',
        'host',
        'name', 'path',
        'poster',
        'sample_rate','shop_id','site_id',
        'size', 'sort',
        'url',
        'video_bit_rate','video_codec','video_desc',
        'width', 'is_delete',*/
    ];

    protected $primaryKey = 'video_id';

//    public function videoDir()
//    {
//        return $this->belongsTo(VideoDir::class, 'dir_id');
//    }
}
