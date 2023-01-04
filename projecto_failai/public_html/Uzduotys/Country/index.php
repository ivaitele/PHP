<?php
$ceu = [
    "Italy" => "Rome",
    "Luxembourg" => "Luxembourg",
    "Belgium" => "Brussels",
    "Denmark" => "Copenhagen",
    "Finland" => "Helsinki",
    "France" => "Paris",
    "Slovakia" => "Bratislava",
    "Slovenia" => "Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland" => "Dublin",
    "Netherlands" => "Amsterdam",
    "Portugal" => "Lisbon",
    "Spain" => "Madrid",
    "Sweden" => "Stockholm",
    "United Kingdom" => "London",
    "Cyprus" => "Nicosia",
    "Lithuania" => "Vilnius",
    "Czech Republic" => "Prague",
    "Estonia" => "Tallin",
    "Hungary" => "Budapest",
    "Latvia" => "Riga",
    "Malta" => "Valetta",
    "Austria" => "Vienna",
    "Poland" => "Warsaw",
];

//------------------------------------------------------- 1 uzduotis ------------------

echo "<h1>Uzduotis 1</h1>";
echo "<p>Sukurti PHP skriptą kuris atvaizduotų valstybių sostines ir pačias valstybes</p>";

echo '<ul>';
foreach ($ceu as $country => $capital) {
    echo "<li>$country sostine yra $capital</li>";
}
echo'</ul>';
echo "<hr>";


//------------------------------------------------------- 2 uzduotis ------------------
echo "<h1>Uzduotis 2</h1>";
echo "<p>Surikiuoti šalis abėcėlės tvarka ir atspausdinti.</p>";

$copyCeu = $ceu;
ksort($copyCeu);

echo '<ul>';
foreach ($copyCeu as $country => $capital) {
    echo "<li>$country sostine yra $capital</li>";
}
echo'</ul>';

echo "<hr>";

//------------------------------------------------------- 3 uzduotis ------------------
$x = 4;
$count = 0;

echo "<h1>Uzduotis 3</h1>";
echo "<p>Spausdinti kas \$x = ($x) -tąjį masyvo elementą</p>";


echo '<ul>';
foreach ($ceu as $country => $capital) {
    $count = $count + 1;

    if ($count % $x == 0) {
        echo "<li>$count = $country sostine yra $capital</li>";
    }
}
echo'</ul>';

echo "<hr>";

//------------------------------------------------------- 4 uzduotis ------------------
$char = "A";

echo "<h1>Uzduotis 4</h1>";
echo "<p>Visus variantus kurie turi raidę \$char = “A”; (Case sensitive)</p>";


echo '<ul>';
foreach ($ceu as $country => $capital) {
    $validCountry = strpos($country, $char) !== false;
    $validCapital = strpos($capital, $char) !== false;

    if ( $validCountry || $validCapital ) {
        echo "<li>$country sostine yra $capital</li>";
    }
}
echo'</ul>';

echo "<hr>";

//------------------------------------------------------- 5 uzduotis ------------------
echo "<h1>Uzduotis 5</h1>";
echo "<p>Atskirti masyvus per pusę ir juos spausdinti atskirose sekcijose tačiau jos turi būti inline stiliaus (viena šalia kitos)</p>";

function printList($arr) {
    echo '<ul>';
    foreach ($arr as $country => $capital) {
        echo "<li>$country sostine yra $capital</li>";
    }
    echo'</ul>';
}

$count = count($ceu);
$halfNr = intdiv($count, 2);

$start = array_slice($ceu, 0, $halfNr);
$end = array_slice($ceu, $halfNr);

echo "Vidurys apytiksliai: $halfNr";

echo "<div style='display: flex;'>";
printList($start);
printList($end);
echo "</div>";

echo "<hr>";

