<?php


namespace Khamsolt\Laraweath\Commands;


use Exception;
use Illuminate\Console\Command;
use Khamsolt\Laraweath\Models\WeatherStack;
use Khamsolt\Laraweath\Services\LaraweathService;
use Khamsolt\Laraweath\Traits\WithSymbolsDecode;

class LaraweathCommand extends Command
{
    use WithSymbolsDecode;

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
    public function handle(LaraweathService $service): void
    {
        $this->line('Laraweath:');
        try {
            $service->getApiConfig()->setQueryParameter($this->option('city') ?? 'Moscow');
            $service->fetch();
            $content = $service->getResponse()->getBody()->getContents();
            $json = json_decode($content, true, 10, JSON_THROW_ON_ERROR);
            if (isset($json['success'])) {
                $this->warn($json['error']['info']);
                return;
            }
            $this->info($this->render(new WeatherStack($json)));
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param WeatherStack $model
     * @return string
     */
    public function render(WeatherStack $model): string
    {
        return sprintf('Current weather in %s, %s %s, wind: direction %s, speed %s',
            $model->region,
            $model->location,
            $this->temperature($model->temperature),
            $this->wind($model->windDirection),
            $this->speed($model->windSpeed)
        );
    }
}
