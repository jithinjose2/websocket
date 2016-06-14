<?php namespace JithinJose2\WebSocket\Console\Commands;

use Illuminate\Console\Command;
use JithinJose2\WebSocket\WebSocket;

class StartServer extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'websocket:serve';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Starts websocket server';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		
		$host = config('websocket.host');
		$port = config('websocket.port');
		$handler = config('websocket.handler');
		
		$this->info("Starting Websocket server AT: ws://$host:$port");
		
		$socket = new WebSocket(new $handler(), $host, $port);
		$socket->serve();
		
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