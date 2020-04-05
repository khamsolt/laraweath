<?php


namespace Khamsolt\Laraweath\Services;


use Illuminate\Filesystem\FilesystemManager;
use Khamsolt\Laraweath\Contracts\Models\JsonExportable;
use Khamsolt\Laraweath\Contracts\Models\JsonFileExportable;
use Khamsolt\Laraweath\Contracts\Models\XmlExportable;
use Khamsolt\Laraweath\Contracts\Models\XmlFileExportable;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * Class ExportService
 * @package Khamsolt\Laraweath\Services
 */
class ExportService implements JsonFileExportable, XmlFileExportable
{
    /** @var FilesystemManager */
    private $filesystem;

    /**
     * WeatherStackService constructor.
     * @param FilesystemManager $filesystem
     */
    public function __construct(FilesystemManager $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param JsonExportable $exportable
     */
    public function exportToJson(JsonExportable $exportable): void
    {
        $content = json_encode($exportable->convertedJsonData());
        $this->filesystem->disk()
            ->put('weather.json', $content);
    }

    /**
     * @param XmlExportable $exportable
     */
    public function exportToXml(XmlExportable $exportable): void
    {
        $content = ArrayToXml::convert($exportable->convertedXmlData(), 'Laraweath');
        $this->filesystem->disk()
            ->put('weather.xml', $content);
    }
}
