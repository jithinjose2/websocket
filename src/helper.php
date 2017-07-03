<?php
if (! function_exists('websocket')) {


    function websocket($websocketName = '')
    {
        $queueHandle = app(\JithinJose2\WebSocket\QueueHandles\RedisQueueHandle::class);
        $queueHandle->setQueueName(config('websocket.queue_name'));
        return $queueHandle;
    }


}