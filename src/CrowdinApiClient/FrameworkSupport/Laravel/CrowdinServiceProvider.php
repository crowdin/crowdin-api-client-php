<?php

namespace CrowdinApiClient\FrameworkSupport\Laravel;

use CrowdinApiClient\Crowdin;
use Illuminate\Support\ServiceProvider;

class CrowdinServiceProvider extends ServiceProvider
{

    /**
     * Crowdin if loading of the provider is deferred.
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
        $config = __DIR__ . '/config/config.php';
        $this->mergeConfigFrom($config, 'crowdin');
        $this->publishes([$config => config_path('crowdin.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('crowdin', function ($app) {
            return new Crowdin(config('crowdin'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['crowdin'];
    }
}
