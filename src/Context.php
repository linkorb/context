<?php

namespace Context;

class Context
{
    protected $tables = [];

    public function addTable(Table $table)
    {
        $this->tables[$table->getName()] = $table;
    }

    public function getTables()
    {
        return $this->tables;
    }

    public function getTableByName($name)
    {
        return $this->tables[$name];
    }
}
