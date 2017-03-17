<?php

class FurryPets
{
    protected $sound;

    protected function fourlegs()
    {
        return "walk on all fours";
    }

    protected function makesound($petnoise)
    {
        $this->sound = $petnoise;
        return $this->sound;
    }

}