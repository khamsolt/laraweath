<?php


namespace Khamsolt\Laraweath\Models;


use Khamsolt\Laraweath\Contracts\Models\JsonExportable;
use Khamsolt\Laraweath\Contracts\Models\XmlExportable;

/**
 * Class WeatherStack
 * @package Khamsolt\Laraweath\Models
 */
final class WeatherStack extends Model implements JsonExportable, XmlExportable
{
    /** @var string */
    public $windDirection;
    /** @var int|float */
    public $windDegree;
    /** @var int|float */
    public $windSpeed;
    /** @var int|float */
    public $temperature;
    /** @var string */
    public $region;
    /** @var string */
    public $location;

    /**
     * WeatherStack constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->windDirection = $data['current']['wind_dir'] ?? '';
        $this->windDegree    = $data['current']['wind_degree'] ?? 0;
        $this->windSpeed     = $data['current']['wind_speed'] ?? 0;
        $this->temperature   = $data['current']['temperature'] ?? 0;
        $this->region        = $data['location']['region'] ?? '';
        $this->location      = $data['location']['name'] ?? '';
    }

    /**
     * @return array
     */
    public function convertedJsonData(): array
    {
        return [
            'region' => $this->region,
            'location' => $this->location,
            'temperature' => $this->temperature,
            'windDirection' => $this->windDirection,
            'windDegree' => $this->windDegree,
            'windSpeed' => $this->windSpeed
        ];
    }

    /**
     * @return array
     */
    public function convertedXmlData(): array
    {
        return [
            'Region'         => $this->region,
            'Location'       => $this->location,
            'Temperature'    => $this->temperature,
            'WindDegree'     => $this->windDegree,
            'WindSpeed'      => $this->windSpeed,
            'WindDirection'  => $this->windDirection,
        ];
    }
}
