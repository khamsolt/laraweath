<?php


namespace Khamsolt\Laraweath\Models;


use Khamsolt\Laraweath\Traits\WithSymbolsDecode;

/**
 * Class WeatherStack
 * @package Khamsolt\Laraweath\Models
 */
class WeatherStack
{
    use WithSymbolsDecode;

    public $windDirection;
    public $windDegree;
    public $windSpeed;
    public $temperature;
    public $region;
    public $location;

    /**
     * WeatherStack constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->windDirection = $data['current']['wind_dir'] ?? '';
        $this->windDegree = $data['current']['wind_degree'] ?? '';
        $this->windSpeed = $data['current']['wind_speed'] ?? '';
        $this->temperature = $data['current']['temperature'] ?? 0;
        $this->region = $data['location']['region'] ?? '';
        $this->location = $data['location']['name'] ?? '';
    }

    public function render(): string
    {
        return sprintf('Current weather in %s, %s %s, wind: direction %s, speed %s',
            $this->region,
            $this->location,
            $this->temperature($this->temperature),
            $this->wind($this->windDirection),
            $this->speed($this->windSpeed)
        );
    }
}
