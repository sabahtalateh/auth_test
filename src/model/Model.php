<?php

namespace app\model;


abstract class Model implements ModelInterface
{
    public $id;

    /**
     * @return string
     */
    abstract function getTable(): string;
}