<?php

/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/12
 * Time: 下午4:45
 */
class Context
{
    private $strategy;

    public function __construct(IStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function algorithm($elements)
    {
        $this->strategy->algorithm($elements);

    }
}