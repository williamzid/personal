<?php

/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/20
 * Time: 下午2:46
 */
include_once('Product.php');

class GraphicProduct implements Product
{
    private $msgProduct;

    public function getPropertites()
    {
//        $this->msgProduct = "<!doctype html><html><head><meta charset='UTF-8' />";
//        $this->msgProduct .= "<title>Map Factory</title>";
//        $this->msgProduct .= "</head><body>";
//        $this->msgProduct .= "<img src='Mail.png' width='500' height='500' />";
//        $this->msgProduct .= "</body></html>";
        $this->msgProduct = "<img style='padding: 10px 10px 10px 0px';
        src='mail.png' align='left' width='256' hight='274'>";
        return $this->msgProduct;
    }

}