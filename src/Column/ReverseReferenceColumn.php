<?php

namespace Context\Column;

use Context\Table;


class ReverseReferenceColumn extends AbstractColumn implements ColumnInterface
{
    protected $name;

    public function __construct($name, $localColumnName, Table $remoteTable, $remoteColumnName)
    {
        $this->name = $name;
        $this->localColumnName = $localColumnName;
        $this->remoteTable = $remoteTable;
        $this->remoteColumnName = $remoteColumnName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function resolve($record, $columnName)
    {
        $value = $record->getRaw($this->localColumnName);
        $recordSet = $this->remoteTable->getRecordSet();
        $records = $recordSet->findWhere([$this->remoteColumnName => $value]);
        return $records;
    }

}
