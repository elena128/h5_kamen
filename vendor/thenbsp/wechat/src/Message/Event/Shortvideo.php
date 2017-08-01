<?php

namespace Thenbsp\Wechat\Message\Event;

use Thenbsp\Wechat\Message\Event;
use Thenbsp\Wechat\Util\OptionValidator;

class Shortvideo extends Event
{
    /**
     * 构造方法
     */
    public function __construct(array $options = array())
    {
        $required = array('ToUserName', 'FromUserName', 'CreateTime', 'MsgType', 'MediaId', 'ThumbMediaId', 'MsgId');

        $validator = new OptionValidator();
        $validator
            ->setRequired($required);

        $validtated = $validator->validate($options);

        $this->setOptions($validtated);
    }
}
