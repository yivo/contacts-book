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

Configuration::set('db.engine',         'mysql');
Configuration::set('db.user',           'root');
Configuration::set('db.password',       'root');
Configuration::set('db.host',           '127.0.0.1');
Configuration::set('db.name',           'contacts-book');

$uri    = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$pos = strrpos($uri, '?');

if ($pos !== false) {
    $uri = substr($uri, 0, $pos);
}

$viewParams = [];
global $viewParams;

if ($uri === '/' || $uri === '/users') {
    $viewParams['view'] = 'list';
    $viewParams['users'] = DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;");
} else {
    $params = [];
    if (preg_match('/\/users\/(\d+)/', $uri, $params)) {
        $id = $params[1];
        $viewParams['user'] = DatabaseConnection::getInstance()->fetchOne("SELECT * FROM users WHERE id = $id;");
        $viewParams['view'] = 'form';

        if ($viewParams['user'] === false) {
            throw new Exception("User with id $id not found!");
        }

    } else {
        http_response_code(404);
        die('No found!');
    }
}

include __DIR__ . '/../views/layout.phtml';

// 1.Вывести в списки таблицу с пользователями
// 2. Возле каждого пользователя сделать 2 кнопки (редактировать, удалить)-ссылками на новую стр.
// 3. Форма редактирования (сохранение, отмена)
// 4. Закоммитить.