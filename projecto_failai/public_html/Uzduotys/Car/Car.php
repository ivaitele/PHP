<?php

namespace Car;
class Car
{
    public string $spalva;
    public string $greitis;
    private float $rida;
    public $bakas;
    public $kuroSanaudos;
    public $kuroKiekis;
    public $atstumas;

    public function __construct()
    {
        $this->rida = 0;
        $this->kuroKiekis = 40;
//        $this->kuroSanaudos = 8;
    }

    public function vaziuoti(float $valandos): void
    {
        echo $this->gautiSpalva() . " Automobilis važiuoja " . $this->greitis . " greičiu";
        $this->rida += (int)$this->greitis * $valandos;
    }

    public function kuroSanaudos($atstumas)
    {
        $sunaudotasKuras = $atstumas * $this->kuroSanaudos / 100;
        $this->kuroKiekis -= $sunaudotasKuras;
    }

    public function gautiLikuti()
    {
        return $this->kuroKiekis;
    }

    public function gautiSpalva(): string
    {
        return $this->spalva;
    }

    public function gautiRida(): float
    {
        return $this->rida;
    }

    public function gautiBaka(): float
    {
        return $this->bakas;
    }
}