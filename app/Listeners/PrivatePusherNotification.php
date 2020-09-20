<?php

namespace AppListeners;

use AppEventsPrivatePusher;
use IlluminateQueueInteractsWithQueue;
use IlluminateContractsQueueShouldQueue;

use Log;
class PrivatePusherNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public $connection = 'redis';

    public $queue = 'default';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TriggerAlarm  $event
     * @return void
     */
    public function handle(PrivatePusher $event)
    {
        Log::alert('Listen',['Listen' => func_get_args()]);
    }
}
