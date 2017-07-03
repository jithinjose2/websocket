<?php
namespace JithinJose2\WebSocket\Interfaces;

interface WebsocketHandleInterface
{

    public function connect($data);

    public function disconnect($connectionId, $userId);

    public function loop();

    public function action($connectionId, $userID, $action, $data);

}