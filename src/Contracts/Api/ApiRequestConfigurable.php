<?php


namespace Khamsolt\Laraweath\Contracts\Api;


interface ApiRequestConfigurable
{
    public function getUrl(): string;

    public function getQueryParameters(): array;
}
