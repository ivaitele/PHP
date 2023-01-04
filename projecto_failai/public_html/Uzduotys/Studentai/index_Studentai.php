<?php

use Studentai\Grupe;
use Studentai\Student;


require __DIR__ . '/../../../vendor/autoload.php';

function printUl($arr) {
    echo '<ul>';
    foreach ($arr as $item) {
        echo '<li>'.$item->getInfo().'</li>';
    }
    echo '</ul>';
}


//---------------------2 Uzduotis---------------------------------------------------
// 2] Sukurkite keleta grupių (pvz.: “CS*V” (* grupės numeris, V-vakariniai, D-dieniniai) ) priskirkite šias grupes studentams
//----------------------------------------------------------------------------------
$grupe[] = new Grupe('PHP', 'PHP-D');
$grupe[] = new Grupe('CSS', 'CS-V');
$grupe[] = new Grupe('HTML', 'H1-D');

//---------------------1 Uzduotis---------------------------------------------------
// 1] Sukurkite masyvą sudarytą iš 20 studentų
//----------------------------------------------------------------------------------

$student[] = new Student('Jonas', 'Jonaitis', 39005121234, $grupe[0]);
$student[] = new Student('Petras', 'Petraitis', 39204151234, $grupe[1]);
$student[] = new Student('Kestas', 'Kestaitis', 39503201234, $grupe[2]);
$student[] = new Student('Ona', 'Onaityte', 49504151234, $grupe[0]);
$student[] = new Student('Marija', 'Marinaite', 49606113222, $grupe[1]);
$student[] = new Student('Antanas', 'Antanaitis', 39705151234, $grupe[2]);
$student[] = new Student('Povilas', 'Povilaitis', 38604151234, $grupe[1]);
$student[] = new Student('Zigmas', 'Zigmaitis', 38804151234, $grupe[2]);
$student[] = new Student('Simas', 'Simaitis', 39507121234, $grupe[0]);
$student[] = new Student('Tadas', 'Tadaitis',39811151234, $grupe[1]);
$student[] = new Student('Kestas', 'Kestaitis',39203201234, $grupe[2]);
$student[] = new Student('Ona', 'Onaityte',49711151234, $grupe[0]);
$student[] = new Student('Marija', 'Marinaite',49606113222, $grupe[1]);
$student[] = new Student('Antanas', 'Antanaitis',39705151234, $grupe[1]);
$student[] = new Student('Povilas', 'Povilaitis',38604151234, $grupe[0]);
$student[] = new Student('Zigmas', 'Zigmaitis',38804151234, $grupe[2]);
$student[] = new Student('Lina', 'Linaite',49905113222, $grupe[1]);
$student[] = new Student('Antanas', 'Antanaitis',39705151234, $grupe[0]);
$student[] = new Student('Povilas', 'Povilaitis',39660415123, $grupe[0]);
$student[] = new Student('Zigmas', 'Zigmaitis',39303151234, $grupe[1]);

echo '<pre>';

echo '<h2>Visi studentai</h2>';
printUl($student);

//---------------------3 Uzduotis---------------------------------------------------
// 3] Surūšiuokite ir atspausdinkite studentus pagal lytį (skirtinguose sąrašuose <ul>)
//----------------------------------------------------------------------------------
function filterByGender($students, $isMale) {
    $result = [];
    foreach ($students as $student) {
        if ($student->isMale() === $isMale) {
            $result[] = $student;
        }
    }

    return $result;
}

echo '<h2>Moterys</h2>';
printUl(filterByGender($student, false));
echo '<h2>Vyrai</h2>';
printUl(filterByGender($student, true));

//---------------------4 Uzduotis---------------------------------------------------
// 4] Raskite jauniausią ir vyriausia studentus. Atspausdinkite ekrane skirtingomis spalvomis
//----------------------------------------------------------------------------------
function getYandO($students) {
    $oldest = $students[0];
    $youngest = $students[0];

    foreach ($students as $student) {
        if ($student->getAge() < $oldest->getAge()) {
            $oldest = $student;
        }

        if ($student->getAge() > $youngest->getAge()) {
            $youngest = $student;
        }
    }

    return ['youngest' => $youngest, 'oldest' => $oldest];
}

$res = getYandO($student);

echo '<div style="color: blue;">';
echo '<h2>Vyriausias</h2>';
echo $res['oldest']->getInfo();
echo '</div>';

echo '<div style="color: red;">';
echo '<h2>Jauniausias</h2>';
echo $res['youngest']->getInfo();
echo '</div>';

//---------------------5 Uzduotis---------------------------------------------------
// 5] Sukurti Dieninių/Vakarinių  grupių filtravimo formą.
//----------------------------------------------------------------------------------
function filterByTime($students, $timeCode) {
    $result = [];
    foreach ($students as $student) {
        if ($student->grupe->getTimeCode() === $timeCode) {
            $result[] = $student;
        }
    }

    return $result;
}

echo '<h2>Dieninis</h2>';
printUl(filterByTime($student, 'D'));
echo '<h2>Vakarinis</h2>';
printUl(filterByTime($student, 'V'));



