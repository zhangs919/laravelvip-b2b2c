<?php


namespace App\Services\Enum;


/**
 * 消息模版消息类型枚举类
 *
 * Class MessageTemplateMsgTypeEnum
 * @package App\Services\Enum
 */
class MessageTemplateMsgTypeEnum
{

    const TYPE_SYS='sys'; // 站内信
    const TYPE_SMS='sms'; // 短信
    const TYPE_WX='wx'; // 微信
    const TYPE_EMAIL='email'; // 邮箱
}
