<?php


namespace Khamsolt\Laraweath\Services;


use Khamsolt\Laraweath\Contracts\Client\Fetchable;
use Khamsolt\Laraweath\Contracts\Models\FileExportable;

/**
 * Class WeatherStackService
 * @package Khamsolt\Laraweath\Client
 */
class LaraweathService
{
    private $apiFetch;
    private $fileExport;

    /**
     * WeatherStackService constructor.
     * @param Fetchable $apiFetch
     * @param FileExportable $fileExport
     */
    public function __construct(Fetchable $apiFetch, FileExportable $fileExport)
    {
        $this->apiFetch   = $apiFetch;
        $this->fileExport = $fileExport;
    }

    public function currentWeather()
    {
        //TODO For controller
    }
}
