<?php
namespace JithinJose2\WebSocket\Console\Commands;

use Illuminate\Console\Command;
use JithinJose2\WebSocket\QueueHandles\RedisQueueHandle;

class WebSocketWorker extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'websocket:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process websockets incoming requests actions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

       $queueHandle = $this->getQueueHandle();

       while (true) {
            usleep(10000);
            while($work = $queueHandle->popInQueue()) {
                $handle = app($work['handle']);
                $this->info($work['connection_id'] .'  ' . $work['handle']);
                $handle->handle(
                    $work['connection_id'],
                    $work['user_id'],
                    $work['data'],
                    $work['meta']
                );
            }
       }

    }

    public function getQueueHandle()
    {
        $queueHandle =  app(RedisQueueHandle::class);
        $queueHandle->setQueueName(config('websocket.queue_name'));
        return $queueHandle;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}