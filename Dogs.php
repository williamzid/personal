<?php
/**
 * Created by PhpStorm.
 * User: williamzid
 * Date: 16/5/9
 * Time: 上午10:37
 */
include_once('FurryPets.php');

class Dogs extends FurryPets
{
    function __construct()
    {
        echo "Dogs" . $this->fourlegs() . "<br/>";
        echo $this->makesound("Woof, woof") . "<br/>";
        echo $this->guardHouse() . "<br/>";
    }

    private function guardHouse()
    {
        return "Grrrrr" . "<br/>";
    }
}