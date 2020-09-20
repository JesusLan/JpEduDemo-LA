<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;

class PrivateMessageEvent implements ShouldBroadcast

{

    // 消息内容
    public $message;

    // 用户
    public $user;

    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    // 创建私有频道
    public function broadcastOn()
    {
        return new PrivateChannel('privatePush.' . $this->user->id);
    }

    //    //Laravel 默认会使用事件的类名作为广播名称来广播事件，自定义：
    //    public function broadcastAs()
    //    {
    //        return 'privatePush.message';
    //    }

    // 控制广播数据:
    public function broadcastWith()
    {
        return ['message' => $this->message,'status' => 'OK'];
    }

}
