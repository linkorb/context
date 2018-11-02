<?php

namespace Context\Column;

use Context\Table;
use RuntimeException;

class ReferenceColumn extends AbstractColumn implements ColumnInterface
{
    protected $name;

    public function __construct($name, $localColumnName, Table $remoteTable, $remoteColumnName)
    {
        $this->name = $name;
        $this->localColumnName = $localColumnName;
        $this->remoteTable = $remoteTable;
        $this->remoteColumnName = $remoteColumnName;
    }

    public function resolve($record, $columnName)
    {
        $value = $record->getRaw($this->localColumnName);
        //echo "Value of " . $this->localColumnName . ": [$value]\n";
        $recordSet = $this->remoteTable->getRecordSet();
        $records = $recordSet->findWhere([$this->remoteColumnName => $value]);
        if (count($records)>1) {
            throw new RuntimeException("Multiple records found. " . $this->remoteTable->getName() . '.' . $this->remoteColumnName . ' is not unique for ' . $value);
        }
        if (count($records)==0) {
            return null;
            // throw new RuntimeException("No records found. " . $this->remoteTable->getName() . '.' . $this->remoteColumnName . ' with value "' . $value . '"');
        }
        return $records[0];
    }

}
