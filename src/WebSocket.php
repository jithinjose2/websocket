<?php
namespace JithinJose2\WebSocket;

use JithinJose2\WebSocket\Events\WebSocketClientConnect;

class WebSocket {
	
	private $connections = array();	// Array to save 
	
	public $server;
	
	public $handler;
	
	public function __construct($handler, $host = 'localhost', $port = 8000, $ssl = false)
	{
		$this->server = new Server($host, $port, $ssl);
		$this->server->setMaxClients(100);
		$this->server->setCheckOrigin(false);
		$this->server->setAllowedOrigin('192.168.1.153');
		$this->server->setMaxConnectionsPerIp(100);
		$this->server->setMaxRequestsPerMinute(2000);
		$this->server->setHook($this);
		$this->handler = $handler;
		$this->handler->server = $this;
	}
	
	public function serve()
	{
		$this->server->run();
	}
	
	/* Fired when a socket trying to connect */
	public function onConnect($connection_id)
	{
        return true;
    }
    
	/* Fired when a socket disconnected */
    public function onDisconnect($connection_id)
	{
		if(isset($this->connections[$connection_id])) {
			$this->handler->onDisconnect($this->connections[$connection_id]);
			unset($this->connections[$connection_id]);
		}
    }
    
	/* Fired when data received */
    public function onDataReceive($connection_id,$data)
	{
		echo "\nData received from $connection_id :";
		
		$data = json_decode($data,true);
		print_r($data);
		
		if(isset($data['action'])){
			
			$action = 'action_' . $data['action'];
			if($data['action'] == 'register') {
				
				if(($data = $this->handler->onConnect($data))!==false) {
					$this->connections[$connection_id] = $data['key'];
					$data['message'] = "Registration confirmed";
					$data['id'] = $data['key'];
					$this->server->sendData($connection_id, 'registred', $data);
				}
				
			} elseif(method_exists($this->handler, $action)) {
				
				if(isset($this->connections[$connection_id])) {
					$this->handler->$action($connection_id, $data);
				}
				
			} else {
				echo "\n Caution : Action handler '$action' not found!";
			}
		}
		
    }
	
	/* Used to send data to particular connection */
	public function sendData($key, $action, $data)
	{
		if(($id = $this->findBYKey($key)) !== false) {
			echo "Data sending to $id". json_encode($data);
			$this->server->sendData($id, $action, $data);
		}
	}

	public function findBYKey($key)
	{
		$keys = array_flip($this->connections);
		if(isset($keys[$key])){
			return $keys[$key];
		}
		return false;
	}
	
}