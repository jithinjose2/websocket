<?php
include "../vendor/autoload.php";

use JithinJose2\WebSocket\WebSocket;

echo "\033[2J";
echo "\033[0;0f";

$socket = new WebSocket('localhost', 8000);