<?php


//$email = EmailValidator::getInstance();
//$email->check('fdf2@dsfsd,sf');


# Singleton
//3.Почитать паттерн LazyLoad и найти использование в данном коде
//4.Фильтрация пароля(наследование) - Класс для базовой фильтраци данных

//class BaseWork {
//    public function act() {
//
//    }
//}
//
//class ConcreteWork extends BaseWork {
//    public function act() {
//        echo 'Acting...';
//    }
//}



//var_dump(!1);#false
//var_dump(!'');#true
//var_dump(!0);#true
//var_dump(!false);#true
//var_dump(!true);#false
//echo PHP_EOL;
//var_dump(!!1);#true
//var_dump(!!'');#false
//var_dump(!!0);#false
//var_dump(!!false);#false
//var_dump(!!true);#true
//echo PHP_EOL;
//var_dump(!!1 && !!2);
//var_dump(0 && 1);
//var_dump(0 && 0);
//var_dump(1 && 0);
//echo PHP_EOL;
//var_dump(1 || 2);#true
//var_dump(0 || 2);#true
//var_dump(0 || 0); #false


# !0 => true
# !1 => false
# !'' => true
# !!'' => false

//var_dump($user);

//$response

//new Request($_SERVER, $_GET, $_POST);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$isGETMethod = $method === 'GET';
$isPOSTMethod = $method === 'POST';

$pos = strrpos($uri, '?');

if ($pos !== false) {
    $uri = substr($uri, 0, $pos);
}

# TODO Trim trailing slash from URI

$viewParams = [
    'isPOSTMethod' => $isPOSTMethod,
    'isGETMethod' => $isGETMethod
];
global $viewParams;

$name = isset($_POST['Name']) ? $_POST['Name'] : null;
$email = isset($_POST['Email']) ? $_POST['Email'] : null;
$password = isset($_POST['Password']) ? $_POST['Password'] : null;

switch ($uri) {
    default:
        http_response_code(404);
        die('Not found!');
}
