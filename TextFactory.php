<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/20
 * Time: 下午2:39
 */
include_once('Creator.php');
include_once('TextProduct.php');

class TextFactory extends Creator
{
    protected function factoryMethod()
    {
        // TODO: Implement factoryMethod() method.
        $product = new TextProduct();
        return ($product->getPropertites());
    }
}