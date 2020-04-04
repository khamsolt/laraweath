<?php


namespace Khamsolt\Laraweath;


use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Khamsolt\Laraweath\Api\WeatherStack;
use Khamsolt\Laraweath\Commands\LaraweathCommand;
use Khamsolt\Laraweath\Contracts\Api\ApiRequestConfigurable;
use Khamsolt\Laraweath\Services\LaraweathService;

class LaraweathServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laraweath.php' => config_path('laraweath.php'),
        ]);
        if ($this->app->runningInConsole()) {
            $this->commands([
                LaraweathCommand::class
            ]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../routes/laraweath.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laraweath.php', 'laraweath');
        $this->app->bind(ApiRequestConfigurable::class, function () {
            /** @var Config $config */
            $config = $this->app->get('config');
            switch ($config->get('laraweath.driver', 'weather-stack')) {
                case 'weather-stack':
                    return new WeatherStack($config);
                default:
                    throw new BindingResolutionException('Laraweath Driver Not Found!');
            }
        });
        $this->app->bind('Laraweath', LaraweathService::class);
    }
}
