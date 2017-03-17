<?php

/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/20
 * Time: 下午2:36
 */
abstract class Creator
{
    protected abstract function factoryMethod();

    public function startFactory()
    {
        $mfg = $this->factoryMethod();
        return $mfg;
    }
}