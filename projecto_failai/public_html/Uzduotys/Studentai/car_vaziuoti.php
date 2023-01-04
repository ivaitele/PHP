<?php

use Car\Car;

include '../src/Car.php';

$car = new Car();
$car->spalva = 'raudona';
$car->greitis = '100 km/h';
$car->vaziuoti();
echo '<br> Automobilio spalva: ' . $car->gautiSpalva();