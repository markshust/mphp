<?php

namespace App;

class Model
{
    protected string $table;

    public function __construct(private readonly Mysql $mysql)
    {
    }

    public function fetchAll(): array
    {
        $records = $this->mysql->run("SELECT * FROM $this->table");

        return $records->fetchAll();
    }
}
