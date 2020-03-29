<?php


namespace Khamsolt\Laraweath;


use Illuminate\Support\ServiceProvider;

class LaraweathServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laraweath.php' => config_path('laraweath.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laraweath.php', 'laraweath');
    }
}
