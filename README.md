# Scalable WebSocket server for Laravel.

## Installation

Require this package with composer:

```shell
composer require jithinjose2/websocket
```

After updating composer, add the ServiceProvider to the providers array in config/app.php

```php
JithinJose2\WebSocket\ServiceProvider::class
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish
```

## Usage

After adding configuration in config/websocket.php, start the websocket server,

```shell
php artisan websocket:serve
```
The above command will start websocket server and start listing to the specified port. 
Next need to add start websocket worker using follwing command this command will wait for any messages in queue.
This worker should be always running similar to laravel queue worker. Better to user supervisor to manage this commands.

```shell
php artisan websocket:work
```

In this version, queue handling is done using Redis driver only, so it is mandatory to add redis connection config in `app/database.php`