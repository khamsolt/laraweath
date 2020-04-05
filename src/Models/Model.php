<?php


namespace Khamsolt\Laraweath\Models;


abstract class Model
{
    /**
     * @param array $data
     * @return static
     */
    public static function create(array $data): self
    {
        return new static($data);
    }
}
