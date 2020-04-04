<?php


namespace Khamsolt\Laraweath\Api;


use Illuminate\Config\Repository as Config;
use Khamsolt\Laraweath\Contracts\Api\WeatherStackConfigurable;

class WeatherStack implements WeatherStackConfigurable
{
    protected const URL_API                = 'http://api.weatherstack.com/current';
    protected const PARAM_GET_QUERY        = 'query';
    protected const PARAM_GET_ACCESS_KEY   = 'access_key';

    /** @var string */
    private $accessKey;
    /** @var string */
    private $query;

    /**
     * WeatherStack constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->accessKey = $config->get('laraweath.token', '');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return static::URL_API;
    }

    /**
     * @return array
     */
    public function getQueryParameters(): array
    {
        return [
            static::PARAM_GET_ACCESS_KEY => $this->accessKey,
            static::PARAM_GET_QUERY => $this->query,
        ];
    }

    /**
     * @param string $parameter
     */
    public function setQueryParameter(string $parameter): void
    {
        $this->query = $parameter;
    }

    /**
     * @param string $parameter
     */
    public function setTokenParameter(string $parameter): void
    {
        $this->accessKey = $parameter;
    }
}
