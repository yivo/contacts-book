<?php

require __DIR__ . '/../lib/EmailValidator.php';
require __DIR__ . '/../lib/User.php';
require __DIR__ . '/../lib/UserCLI.php';
require __DIR__ . '/../lib/UserView.php';
require __DIR__ . '/../lib/NullFilter.php';
require __DIR__ . '/../lib/NameFilter.php';
require __DIR__ . '/../lib/EmailFilter.php';
require __DIR__ . '/../lib/PasswordFilter.php';
require __DIR__ . '/../lib/Configuration.php';
require __DIR__ . '/../lib/DatabaseConnection.php';


//$a = [1,2,3];
//
//$b = array_map(function ($num) {
//    return $num * 2;
//}, $a);
//
//var_dump($a);
//var_dump($b);
//die;





Configuration::set('db.engine',         'mysql');
Configuration::set('db.user',           'root');
Configuration::set('db.password',       'root');
Configuration::set('db.host',           '127.0.0.1');
Configuration::set('db.name',           'contacts-book');



//var_dump(DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;"));
//$array = DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;");
//die;



$uri    = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$pos = strrpos($uri, '?');

if ($pos !== false) {
    $uri = substr($uri, 0, $pos);
}

$viewParams = [];
global $viewParams;

if ($uri === '/' || $uri === '/users' || $uri === '/users/') {
    $viewParams['view'] = 'list';
    $viewParams['users'] = DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;");
    $viewParams['deletedUserID'] = isset($_GET['deletedUserID']) ? $_GET['deletedUserID'] : null;
 } else {
    $params = [];
    if (preg_match('/\/users\/(\d+)\/(edit|delete)?/', $uri, $params)) {
        $userID = $params[1];
        $user = DatabaseConnection::getInstance()->fetchOne("SELECT * FROM users WHERE id = $userID;");

        if ($user === false) {
            throw new Exception("User with id $userID not found!");
        }

        $actionOnUser = (isset($params[2]) ? $params[2] : null) ?: 'show';
        switch ($actionOnUser) {
            case 'edit':
                $viewParams['view'] = 'form';
                $viewParams['user'] = $user;
                break;
            case 'delete':
                DatabaseConnection::getInstance()->execute("DELETE FROM users WHERE id = $userID");
                header('Location: /users?deletedUserID=' . $user->id);
                break;
            case 'show':
                $viewParams['view'] = 'show';
                $viewParams['user'] = $user;
        }
    } else {
        http_response_code(404);
        die('Not found!');
    }
}

include __DIR__ . '/../views/layout.phtml';

// 1.Вывести в списки таблицу с пользователями
// 2. Возле каждого пользователя сделать 2 кнопки (редактировать, удалить)-ссылками на новую стр.
// 3. Форма редактирования (сохранение, отмена)
// 4. Закоммитить.