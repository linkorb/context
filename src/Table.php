<?php

namespace Context;

use Context\Column\ColumnInterface;

class Table
{
    protected $name;
    protected $columns = [];
    protected $context;
    protected $recordSet;

    public function __construct(string $name, Context $context)
    {
        $this->name = $name;
        $this->context = $context;
    }

    public function setRecordSet(RecordSetInterface $recordSet)
    {
        $this->recordSet = $recordSet;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addColumn(ColumnInterface $column)
    {
        $this->columns[$column->getName()] = $column;
    }

    public function getColumnByName($name)
    {
        return $this->columns[$name];
    }

    public function hasColumn($name)
    {
        return isset($this->columns[$name]);
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getRecordSet()
    {
        return $this->recordSet;
    }

    public function getContext()
    {
        return $this->context;
    }

}
