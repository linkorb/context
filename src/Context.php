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

    public function hasTable($name)
    {
        return isset($this->tables[$name]);
    }

    public function getTable($name)
    {
        if (!$this->hasTable($name)) {
            $tableNames = '';
            foreach ($this->getTables() as $table) {
                $tableNames .= ', ' . $table->getName();
            }
            throw new RuntimeException("No such table in Context: " . $name . ' (available: ' . $tableNames . ')');
        }
        return $this->tables[$name];
    }
}
