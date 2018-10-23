<?php

namespace Context;

class ArrayRecordSet implements RecordSetInterface
{
    protected $records;
    protected $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function loadFromArray(array $rows)
    {
        foreach ($rows as $row) {
            $record = new Record($this->table, $row);
            $this->records[] = $record;
        }
    }

    public function findWhere(array $filters)
    {
        $res = [];
        foreach ($this->records as $record) {
            $match = true;
            foreach ($filters as $key => $value) {
                if (!$this->matchFilter($record, $key, $value)) {
                    $match = false;
                }
            }
            if ($match) {
                $res[] = $record;
            }
        }
        return $res;
    }

    public function matchFilter(Record $record, $key, $value)
    {
        if ($record[$key]==$value) {
            return true;
        }
        return false;
    }
}
