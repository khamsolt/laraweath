<?php


namespace Khamsolt\Laraweath\Contracts\Client;


interface Fetchable
{
    public function fetch(): void;

    public function responseToArray(): array;

    public function setLocation(string $parameter): void;
}
