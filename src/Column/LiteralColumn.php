<?php

namespace Context\Column;

class LiteralColumn extends AbstractColumn implements ColumnInterface
{
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function resolve($record, $columnName)
    {
        return $record->getRaw($columnName);
    }
}
