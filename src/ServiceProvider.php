<?php namespace JithinJose2\WebSocket;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        // Bind any implementations.
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
