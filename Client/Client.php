<?php

/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/12
 * Time: 下午4:48
 */
//$elements = 1212312;
//$strategy = new Context();
//$strategy->algorithm($elements);
class Client
{
    private $someGraphicObject;
    private $someTextObject;

    public function __construct()
    {
        $this->someGraphicObject = new GraphicFactory();
        echo $this->someGraphicObject->startFactory();
        $this->someTextObject = new TextFactory();
        echo $this->someTextObject->startFactory();
    }
}

$worker = new Client();

