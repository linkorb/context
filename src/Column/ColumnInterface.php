<?php

namespace Context\Column;

use Context\RecordInterface;

interface ColumnInterface
{
    public function getName();
    public function getDescription();
    public function resolve($record, $columnName);
}
