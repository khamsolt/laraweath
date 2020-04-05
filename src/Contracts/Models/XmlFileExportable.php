<?php


namespace Khamsolt\Laraweath\Contracts\Models;


interface XmlFileExportable extends FileExportable
{
    public function exportToXml(XmlExportable $exportable): void;
}
