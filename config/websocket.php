<?php

/**
 * Your package config would go here
 */

return [
    
    // Websocket hostname
    'host'  => 'localhost',
    
    // Port at which websocket server is listening on
    'port'  => '8000',
    
    // Need to use ssl for wss connections
    'ssl'   => false,
    
    'handler' => '\Chat\Wshandle'
];
