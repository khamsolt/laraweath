<?php


namespace Khamsolt\Laraweath\Traits;


trait WithSymbolsDecode
{
    /**
     * @var array
     */
    protected $symbolsDecode = [
        'N' => 'North',
        'E' => 'East',
        'S' => 'South',
        'W' => 'West',
    ];

    /**
     * @param string $windSymbols
     * @return string
     */
    public function wind(string $windSymbols): string
    {
        $chars = str_split($windSymbols);
        $decodeString = '';
        if (count($chars) === 0) {
            return '';
        }
        foreach ($chars as $char) {
            if (empty($decodeString)) {
                $decodeString = $this->symbolsDecode[$char];
                continue;
            }
            $decodeString .= '-' . $this->symbolsDecode[$char];
        }
        return $decodeString;
    }

    public function temperature(float $temperature): string
    {
        return $temperature . ' С°';
    }

    public function speed(float $speed): string
    {
        return $speed . ' km/h';
    }
}
