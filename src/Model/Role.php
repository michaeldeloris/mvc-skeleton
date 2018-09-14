<?php

namespace App\Model;


class Role
{
    const NAME = "/^[a-z]{3,10}$/";
    const VALUE = "/^[R][O][L][E][_][A-Z]{3,10}$/";

    private $id;
    private $name;
    private $value;

    public function getId()
    {

        return $this->id;
    }

    public function getName()
    {

        return $this->name;
    }

    public function getValue()
    {

        return $this->value;
    }
}