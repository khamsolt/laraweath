<?php


namespace Khamsolt\Laraweath\Contracts\Models;


interface JsonExportable extends Exportable
{
    public function convertedJsonData(): array;
}
