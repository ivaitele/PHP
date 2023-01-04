<?php

use Car\Car;

include '../src/Car.php';

$bmw = new Car();
$bmw->spalva = 'Raudonas';
$bmw->greitis = '100 km/h';
$bmw->vaziuoti(1.5);
$bmw->bakas = 50;
$bmw->kuroKiekis = 40;
$bmw->kuroSanaudos = 8;
$bmw->atstumas = 86;

echo "Degalu likutis: " . $bmw->gautiLikuti() . " litrai\n";

echo '<br>Rida: ' . $bmw->gautiRida();
echo '<br>Bakas: ' . $bmw->gautiBaka();

