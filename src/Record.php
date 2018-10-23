<?php

namespace Context;

use ArrayAccess;

class Record implements ArrayAccess
{
    public function __construct(Table $table, array $data)
    {
        $this->table = $table;
        $this->data = $data;
    }

    public function resolve($key)
    {
        $column = $this->table->getColumnByName($key);
        return $column->resolve($this, $key);
    }

    public function getRaw($key)
    {
        return $this->data[$key] ?? null;
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->resolve($offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new RuntimeException("Records are immutable");
    }
    public function offsetUnset($offset)
    {
        throw new RuntimeException("Records are immutable");
    }

    public function __has($key)
    {
        return $this->offsetExists($key);
    }

    public function __get($key)
    {
        return $this->offsetGet($key);
    }

}
