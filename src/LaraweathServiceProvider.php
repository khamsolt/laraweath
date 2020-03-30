<?php


namespace Khamsolt\Laraweath;


use Illuminate\Support\ServiceProvider;
use Khamsolt\Laraweath\Commands\LaraweathCommand;

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
        $this->loadRoutesFrom(__DIR__ . '/../routes/laraweather.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laraweath.php', 'laraweath');
    }
}
