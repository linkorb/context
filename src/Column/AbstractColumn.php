<?php

namespace Context\Column;

abstract class AbstractColumn
{
    protected $name;
    protected $description;

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

}
