<?php

namespace Car;

class kupe extends automobilis
{

    public bool $openDoor;

    public function __construct($marke, $modelis, $openDoor)
    {
        parent::__construct($marke, $modelis);
        $this->openDoor = $openDoor;
    }

    public function carInfo()
    {
        $doorBool = $this->openDoor ? "Taip" : "Ne";
        return "Automobilio modelis: " . $this->modelis . ", marke: " . $this->marke . ", ar durys atidarytos: " . $doorBool;
    }

}


