<?php

namespace Car;
class automobilis
{
    public string $marke;
    protected $modelis;

    public function __construct($marke, $modelis)
    {
        $this->marke = $marke;
        $this->modelis = $modelis;
    }

    public function informacija(): string
    {
        return "Automobilio marke: $this->marke, modelis: $this->modelis";
    }
}
