<?php

namespace App\Events;

use IlluminateQueueSerializesModels;
use IlluminateFoundationEventsDispatchable;
use IlluminateBroadcastingInteractsWithSockets;
use IlluminateContractsBroadcastingShouldBroadcast;

class PublicMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // 消息内容
    public $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    // 返回一个公共频道 频道名称为push
    public function broadcastOn()
    {
        return 'push';
    }

    // Laravel 默认会使用事件的类名作为广播名称来广播事件，自定义：
    // public function broadcastAs()
    // {
    //     return 'push.message';
    // }
}
