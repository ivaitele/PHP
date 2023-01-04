<?php

use Car\automobilis;
use Car\kupe;

include '../src/kupe.php';
include  '../src/automobilis.php';


$automobilis = new Automobilis("BMW", "M3");
echo $automobilis->informacija();

$kupe = new Kupe('bmw', 'M4', false);
echo $kupe->carInfo(); //Automobilio modelis: bmw, marke: 530, ar durys atidarytos: ne
