<?php


namespace Khamsolt\Laraweath\Commands;


use Exception;
use Illuminate\Console\Command;
use Khamsolt\Laraweath\Models\WeatherStack;
use Khamsolt\Laraweath\Services\LaraweathService;

class LaraweathCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraweath:fetch {--city=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weather API';

    /**
     * Execute the console command.
     * @param LaraweathService $service
     */
    public function handle(LaraweathService $service)
    {
        $this->line('Laraweath:');
        try {
            $service->getApiConfig()->setQueryParameter($this->option('city') ?? 'Moscow');
            $service->fetch();
            $content = $service->getResponse()->getBody()->getContents();
            $json = json_decode($content, true, 10, JSON_THROW_ON_ERROR );
            if (isset($json['success'])) {
                $this->warn($json['error']['info']);
                return false;
            }
            $model = new WeatherStack($json);
            $this->info($model->render());
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
