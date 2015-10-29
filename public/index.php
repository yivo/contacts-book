<?php

require __DIR__ . '/../autoload.php';

use Library\Configuration as Config;

Config::set('db.engine',         'mysql');
Config::set('db.user',           'root');
Config::set('db.password',       'root');
Config::set('db.host',           '127.0.0.1');
Config::set('db.name',           'contacts-book');

$request = new Plus33FPS\Request($_SERVER, $_GET, $_POST);

$router = new Plus33FPS\Routing\Router($request);

$routeStore = new Plus33FPS\Routing\RouteStore();
$routeStore->add(new Plus33FPS\Routing\Route([
    'name' => 'index', 'pattern' => '/^\/$/'
]));

$route = $router->route($request, $routeStore->getAll());


var_dump($route);
die();

//$response

//new Request($_SERVER, $_GET, $_POST);

$uri    = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$isGETMethod    = $method === 'GET';
$isPOSTMethod   = $method === 'POST';

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

    case (bool)preg_match('/^\/(users)?$/', $uri):
        $viewParams['view'] = 'list';
        $viewParams['users'] = Library\DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;");
        $viewParams['deletedUserID'] = isset($_GET['deletedUserID']) ? $_GET['deletedUserID'] : null;
        $viewParams['editedUserID'] = isset($_GET['editedUserID']) ? $_GET['editedUserID'] : null;
        $viewParams['addedUserID'] = isset($_GET['addedUserID']) ? $_GET['addedUserID'] : null;
        break;

    case (bool)preg_match('/^\/users\/add$/', $uri):
        if ($isPOSTMethod) {
            Library\DatabaseConnection::getInstance()->query("INSERT INTO users (name, email, password) VALUES
        ('$name', '$email', '$password');");
            $user = Library\DatabaseConnection::getInstance()->fetchOne("SELECT id FROM users ORDER BY id DESC LIMIT 1;");
            header('Location: /users?addedUserID=' . $user->id);
        } else {
            $viewParams['view'] = 'form';
        }
        break;

    case (bool)preg_match('/\/users\/(\d+)\/(edit|delete)?$/', $uri, $params):
        $userID = $params[1];
        $user = Library\DatabaseConnection::getInstance()->fetchOne("SELECT * FROM users WHERE id = $userID;");

        if ($user === false) {
            throw new Exception("User with id $userID not found!");
        }

        $viewParams['user'] = $user;

        $actionOnUser = (isset($params[2]) ? $params[2] : null) ?: 'show';

        switch ($actionOnUser) {
            case 'edit':
                if ($isPOSTMethod) {
                    Library\DatabaseConnection::getInstance()->execute("UPDATE users
   SET name = '$name', email = '$email', password = '$password' WHERE id = $userID");
                    header('Location: /users?editedUserID=' . $user->id);
                } else {
                    $viewParams['view'] = 'form';
                    $viewParams['user'] = $user;
                }
                break;
            case 'delete':
                Library\DatabaseConnection::getInstance()->execute("DELETE FROM users WHERE id = $userID");
                header('Location: /users?deletedUserID=' . $user->id);
                break;
            case 'show':
                $viewParams['view'] = 'show';
                $viewParams['user'] = $user;
        }
        break;
    default:
        http_response_code(404);
        die('Not found!');
}

include __DIR__ . '/../views/layout.phtml';

// 1.Вывести в списки таблицу с пользователями
// 2. Возле каждого пользователя сделать 2 кнопки (редактировать, удалить)-ссылками на новую стр.
// 3. Форма редактирования (сохранение, отмена)
// 4. Закоммитить.