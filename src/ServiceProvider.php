<?php namespace JithinJose2\WebSocket;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use JithinJose2\WebSocket\Console\Commands\StartServer;
use JithinJose2\WebSocket\Console\Commands\WebSocketWorker;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    protected $commands = [
		StartServer::class,
        WebSocketWorker::class
	];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        // $this->handleMigrations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge configuration
        $this->mergeConfigFrom(__DIR__.'/../config/websocket.php', 'websocket');
        
        // Register commands.
        $this->commands($this->commands);

        require __DIR__ . '/helper.php';
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function handleConfigs()
    {

        $configPath = __DIR__ . '/../config/websocket.php';

        $this->publishes([$configPath => config_path('websocket.php')]);

        $this->mergeConfigFrom($configPath, 'websocket');
    }


    private function handleMigrations()
    {

        $this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')]);
    }
}
