<?php

namespace AppListeners;

use AppEventsPublicMessage;
use IlluminateQueueInteractsWithQueue;
use IlluminateContractsQueueShouldQueue;

use Log;
class PublicPusherNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $connection = 'redis';

    public $queue = 'default';

    public function __construct()
    {
        //
    }

    public function handle(PublicMessage $event)
    {
        Log::alert('Listen',['Listen' => func_get_args()]);
    }
}
