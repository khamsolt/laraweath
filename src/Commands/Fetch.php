<?php


namespace Khamsolt\Laraweath\Commands;


use Exception;
use Illuminate\Console\Command;
use Khamsolt\Laraweath\Contracts\Client\Fetchable;
use Khamsolt\Laraweath\Contracts\Models\Exportable;
use Khamsolt\Laraweath\Contracts\Models\FileExportable;
use Khamsolt\Laraweath\Models\WeatherStack;
use Khamsolt\Laraweath\Traits\WithSymbolsDecode;

class Fetch extends Command
{
    use WithSymbolsDecode;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraweath:fetch {--city=} {--J|json} {--X|xml}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'WeatherStack API';

    /**
     * Execute the console command.
     * @param Fetchable $api
     * @param FileExportable $fileExport
     */
    public function handle(Fetchable $api, FileExportable $fileExport): void
    {
        $this->line('Laraweath 1.0.0');
        try {
            $api->setLocation($this->option('city') ?? 'Moscow');
            $api->fetch();
            $model = WeatherStack::create($api->responseToArray());
            $this->info($this->render($model));
            $this->export($fileExport, $model);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @param FileExportable $fileExport
     * @param Exportable $exportable
     */
    public function export(FileExportable $fileExport, Exportable $exportable)
    {
        if ($this->option('json')) {
            $fileExport->exportToJson($exportable);
            $this->info('Export json file success!');
        }
        if ($this->option('xml')) {
            $fileExport->exportToXml($exportable);
            $this->info('Export xml file success!');
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
