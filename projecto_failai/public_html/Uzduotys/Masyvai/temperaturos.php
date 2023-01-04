<?php

$temp = [78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];

//------------------------------------------------------- 1 uzduotis ------------------

echo "<h1>Uzduotis 2</h1>";
echo "<p>Parašyti skriptą kuris apskaičiuos ir atvaizduos vidutinę temperatūrą, penkias žemiausias ir aukščiausias temperatūras.</p>";

function vidutineTemparutra($temp){

    $avg_temp = array_sum($temp) / count($temp);

    return $avg_temp;
}
$avg_temp = vidutineTemparutra($temp);
echo "Vidutinė temperatūra: $avg_temp<br>";

sort($temp);
$lowest_temps = array_slice($temp, 0, 5);
$highest_temps = array_slice($temp, -5);

echo "Penkios žemiausios temperatūros: " . implode(", ", $lowest_temps) . "<br>";
echo "Penkios aukščiausios temperatūros: " . implode(", ", $highest_temps) . "<br>";

//------------------------------------------------------- 2.1 uzduotis ------------------

echo "<h1>Uzduotis 2.1 </h1>";
echo "<p>Pavaizduoti rezultatus pagal celsijų</p>";

echo "Vidutinė temperatūra: " . round(($avg_temp - 32) * 5/9, 2) . "°C<br>";

echo "Penkios žemiausios temperatūros: " . implode(", ", array_map(function($x) { return round(($x - 32) * 5/9, 2) . "°C"; }, $lowest_temps)) . "<br>";
echo "Penkios aukščiausios temperatūros: " . implode(", ", array_map(function($x) { return round(($x - 32) * 5/9, 2) . "°C"; }, $highest_temps)) . "<br>";