<?php


namespace Khamsolt\Laraweath\Commands;


use Illuminate\Console\Command;
use Khamsolt\Laraweath\Services\WeatherStackService;

class LaraweathCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraweath:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weather API';

    protected $service;

    public function __construct(WeatherStackService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'This is laraweath package' . PHP_EOL;
        $json = $this->service->fetch();
    }
}
