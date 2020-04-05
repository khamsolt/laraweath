<?php


namespace Khamsolt\Laraweath\Contracts\Models;


interface JsonFileExportable extends FileExportable
{
    public function exportToJson(JsonExportable $exportable): void;
}
