<?php

namespace App\Model;


class Role
{
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