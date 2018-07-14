<?php

namespace app\model;

interface ModelInterface
{
    /**
     * @return string
     */
    function getTable(): string;
}