<?php
namespace JithinJose2\WebSocket\Interfaces;

interface WebsocketActionInterface
{

    public function handle($connectionId, $userId, $data, $meta);

}