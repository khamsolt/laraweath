<?php


namespace Khamsolt\Laraweath\Contracts\Api;


interface WeatherStackConfigurable extends ApiRequestConfigurable
{
    public function setQueryParameter(string $parameter): void;

    public function setTokenParameter(string $parameter): void;
}
