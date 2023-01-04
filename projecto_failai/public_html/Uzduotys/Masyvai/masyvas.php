<?php

function printList($arr) {
    echo '<ul>';
    foreach ($arr as $value) {
        echo "<li>$value</li>";
    }
    echo'</ul>';
}

//------------------------------------------------------- 3 uzduotis ------------------

echo "<h1>Uzduotis 3 </h1>";
echo "<p>Rasti Trumpiausią ir ilgiausą masyvo elementą.</p>";

$arr = ["abcd", "abc", "de", "hjjj", "g", "wer"];

$arrByLen = [];

foreach ($arr as $value) {
    $length = strlen($value);

    if (!array_key_exists($length, $arrByLen)) {
        $arrByLen[$length] = [];
    }

    $arrByLen[$length][] = $value;
}

ksort($arrByLen);

$shortest = reset($arrByLen);
$longest = end($arrByLen);

echo "Trumpiausi masyvo elementai";
printList($shortest);
echo "Ilgiausi masyvo elementai ";
printList($longest);
echo "<hr>";

//------------------------------------------------------- 4 uzduotis ------------------

echo "<h1>Uzduotis 4 </h1>";
echo "<pre>Sukurkite naują masyvą \$rezult sujungiant \$vardai ir \$pavardes masyvus, 
vadovaujantis masyvo \$map taisyklėmis. Išveskite masyvo \$rezult rezultatus</pre>";

$vardai = ["Jonas", "Petras", "Kazys", "Zigmas", "Ona", "Janina", "Kristina"];

$pavardes = ["Joninis", "Petrinis", "Kazinis", "Zigminis", "Onienė",  "Jonė", "Kristė"];

$map = [1, 1, 2, 2, 1, 2, 2, 3, 1, 3, 2, 1, 1, 4, 2, 4, 1, 5, 2, 7, 1, 6, 2, 5, 1, 7, 2, 6];

$result = [];
$length = count($map);

for ($x = 0; $x < $length; $x = $x + 2) {
    $vardoIndex = $map[$x] - 1;
    $pavardesIndex = $map[$x + 1] - 1;

    $vardas = $vardai[$vardoIndex];
    $pavarde = $pavardes[$pavardesIndex];

    $result[] = "$vardas $pavarde";
}
printList($result);

echo "<pre>";
var_dump($result);