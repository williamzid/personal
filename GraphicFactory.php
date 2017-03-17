<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/20
 * Time: 下午2:49
 */
include_once('Creator.php');

include_once('GraphicProduct.php');

class GraphicFactory extends Creator
{
    protected function factoryMethod()
    {
        // TODO: Implement factoryMethod() method.
        $product = new GraphicProduct();
        return ($product->getPropertites());
    }
}