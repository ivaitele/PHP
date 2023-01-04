<?php

//session_start();

require __DIR__ . '/../../../vendor/autoload.php';

// one
function tpl($templateName, $data) {
    $templateContent = file_get_contents('tpls/'.$templateName.'.html');

    foreach ($data as $key => $value) {
        $value = gettype($value) === 'array' ? join('', $value) : $value ;
        $templateContent = str_replace("{{".$key."}}", $value, $templateContent);
    }

    return $templateContent;
}

// many
function tplMap($tempalteName, $list) {
    $i = 0;
    $result = [];

    foreach ($list as $key => $value) {
        $value['$i'] = $i;
        $value['$index'] = $i + 1;
        $value['$key'] = $key;
        $i++;
        $result[] = tpl($tempalteName, $value);
    }

    return $result;
}
//============================================================================================================
$zmones = [
    [
        'Vardas' => 'Tadas',
        'Amžius' => 23,
        'Profesija' => 'Studentas'
    ],
    [
        'Vardas' => 'Jonas',
        'Amžius' => 33,
        'Profesija' => 'Mechanikas'
    ],
    [
        'Vardas' => 'Gabija',
        'Amžius' => 27,
        'Profesija' => 'Buhalterė'
    ],
    [
        'Vardas' => 'Tomas',
        'Amžius' => 48,
        'Profesija' => 'Santechnikas'
    ],
    [
        'Vardas' => 'Petras',
        'Amžius' => 37,
        'Profesija' => 'Vadybininkas'
    ],
    [
        'Vardas' => 'Ieva',
        'Amžius' => 21,
        'Profesija' => 'Studentė'
    ],
    [
        'Vardas' => 'Kęstutis',
        'Amžius' => 30,
        'Profesija' => 'Programuotojas'
    ]
];

$getPage1 = function() use ($zmones) {
    $age = isset($_GET['age']) ? (int) $_GET['age'] : 0;
//    $age = isset($_POST['age']) ? (int) $_POST['age'] : 0;

//    var_dump($age);

    $zmones = array_filter($zmones, function($value) use ($age) {
        return $value['Amžius'] > $age;
    });

    $tableRaw = tplMap('table.row', $zmones);
    $table = tpl('table', ["tableRow" => $tableRaw]);

    $form = tpl('form', ['age' => $age]);

    return [$form, $table];
};

/*  $isLoggedIn = true;

function login() {
//    print_r($_SESSION);
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

    // LOGIN
    if (isset($_POST['login']) && $_POST['login'] === 'on') {
        $user = [
            "firstName" => $_POST['firstName'],
            "lastName" => $_POST['lastName']
        ];

        $_SESSION['user'] = $user;
    }

    // LOGOUT
    if (isset($_POST['login']) && $_POST['login'] === 'off') {
        $user = false;
        $_SESSION['user'] = false;
    }

    return $user;
}

$isLoggedIn = login();
*/

//$body = '<h1>Please login in</h1>';
//$user = tpl('user.login', []);

//if ($isLoggedIn) {
//    $body = $getPage1();
//    $user = tpl('user.logout', $isLoggedIn);
//}

$body = $getPage1();

//=======================================================================================

echo tpl('layout', ["body" => $body]);