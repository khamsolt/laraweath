<?php


namespace Khamsolt\Laraweath;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Khamsolt\Laraweath\Api\Client\WeatherStack;
use Khamsolt\Laraweath\Commands\Fetch;
use Khamsolt\Laraweath\Contracts\Client\Fetchable;
use Khamsolt\Laraweath\Contracts\Models\FileExportable;
use Khamsolt\Laraweath\Services\ExportService;
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
                Fetch::class,
            ]);
        }
        $this->loadRoutesFrom(__DIR__ . '/../routes/laraweath.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laraweath.php', 'laraweath');
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(Fetchable::class, WeatherStack::class);
        $this->app->bind(FileExportable::class, ExportService::class);
        $this->app->bind('Laraweath', LaraweathService::class);
    }
}
