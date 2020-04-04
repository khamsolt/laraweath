<?php


namespace Khamsolt\Laraweath\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Illuminate\Config\Repository as Config;
use Khamsolt\Laraweath\Contracts\Api\ApiRequestConfigurable;
use Khamsolt\Laraweath\Contracts\Services\Fetchable;
use Psr\Http\Message\ResponseInterface;

/**
 * Class WeatherStackService
 * @package Khamsolt\Laraweath\Services
 */
class LaraweathService implements Fetchable
{
    /** @var Config */
    private $config;
    /** @var Client */
    private $client;
    /** @var ApiRequestConfigurable */
    private $apiConfig;
    /** @var ResponseInterface */
    private $response;

    /**
     * WeatherStackService constructor.
     * @param Config $config
     * @param ApiRequestConfigurable $apiConfig
     */
    public function __construct(Config $config, ApiRequestConfigurable $apiConfig)
    {
        $this->config = $config;
        $this->apiConfig = $apiConfig;
        $this->client = new Client();
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function fetch(): void
    {
        $this->response = $this->client->get($this->apiConfig->getUrl(), [
            RequestOptions::QUERY => $this->apiConfig->getQueryParameters()
        ]);
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return ApiRequestConfigurable
     */
    public function getApiConfig(): ApiRequestConfigurable
    {
        return $this->apiConfig;
    }
}
