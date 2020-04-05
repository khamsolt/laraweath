<?php


namespace Khamsolt\Laraweath\Api\Client;


use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Illuminate\Config\Repository as Config;
use Khamsolt\Laraweath\Contracts\Client\Fetchable;

/**
 * Class WeatherStack
 * @package Khamsolt\Laraweath\Api\Client
 */
class WeatherStack implements Fetchable
{
    protected const URL_API              = 'http://api.weatherstack.com/current';
    protected const PARAM_GET_QUERY      = 'query';
    protected const PARAM_GET_ACCESS_KEY = 'access_key';

    /** @var string */
    private $accessKey;
    /** @var string */
    private $query;
    /** @var string */
    private $content;
    /** @var ClientInterface */
    private $client;

    /**
     * WeatherStack constructor.
     * @param Config $config
     * @param ClientInterface $client
     */
    public function __construct(Config $config, ClientInterface $client)
    {
        $this->client = $client;
        $this->accessKey = $config->get('laraweath.token', '');
    }

    /**
     *  Http Request
     */
    public function fetch(): void
    {
        $response = $this->client->get(self::URL_API, [
            RequestOptions::QUERY => [
                static::PARAM_GET_ACCESS_KEY => $this->accessKey,
                static::PARAM_GET_QUERY      => $this->query,
            ]
        ]);
        $this->content = $response->getBody()->getContents();
    }

    /**
     * @return array
     * @throws Exception
     */
    public function responseToArray(): array
    {
        $array = json_decode($this->content, true, 10, JSON_THROW_ON_ERROR);
        if (isset($array['success'])) {
            throw new Exception('Response api invalid!');
        }
        return $array;
    }

    /**
     * @param string $parameter
     */
    public function setLocation(string $parameter): void
    {
        $this->query = $parameter;
    }
}
