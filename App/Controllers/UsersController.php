<?php

namespace App\Controllers;

class UsersController extends \Plus33FPS\Controller {
    public function indexAction() {
//        $viewParams['view'] = 'list';
//        $viewParams['users'] = \Library\DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;");
//        $viewParams['deletedUserID'] = isset($_GET['deletedUserID']) ? $_GET['deletedUserID'] : null;
//        $viewParams['editedUserID'] = isset($_GET['editedUserID']) ? $_GET['editedUserID'] : null;
//        $viewParams['addedUserID'] = isset($_GET['addedUserID']) ? $_GET['addedUserID'] : null;
    }
    public function showAction() {

    }
}

//    case (bool)preg_match('/^\/(users)?$/', $uri):
//        $viewParams['view'] = 'list';
//        $viewParams['users'] = Library\DatabaseConnection::getInstance()->fetchAll("SELECT * FROM users;");
//        $viewParams['deletedUserID'] = isset($_GET['deletedUserID']) ? $_GET['deletedUserID'] : null;
//        $viewParams['editedUserID'] = isset($_GET['editedUserID']) ? $_GET['editedUserID'] : null;
//        $viewParams['addedUserID'] = isset($_GET['addedUserID']) ? $_GET['addedUserID'] : null;
//        break;
//
//    case (bool)preg_match('/^\/users\/add$/', $uri):
//        if ($isPOSTMethod) {
//            Library\DatabaseConnection::getInstance()->query("INSERT INTO users (name, email, password) VALUES
//        ('$name', '$email', '$password');");
//            $user = Library\DatabaseConnection::getInstance()->fetchOne("SELECT id FROM users ORDER BY id DESC LIMIT 1;");
//            header('Location: /users?addedUserID=' . $user->id);
//        } else {
//            $viewParams['view'] = 'form';
//        }
//        break;
//
//    case (bool)preg_match('/\/users\/(\d+)\/(edit|delete)?$/', $uri, $params):
//        $userID = $params[1];
//        $user = Library\DatabaseConnection::getInstance()->fetchOne("SELECT * FROM users WHERE id = $userID;");
//
//        if ($user === false) {
//            throw new Exception("User with id $userID not found!");
//        }
//
//        $viewParams['user'] = $user;
//
//        $actionOnUser = (isset($params[2]) ? $params[2] : null) ?: 'show';
//
//        switch ($actionOnUser) {
//            case 'edit':
//                if ($isPOSTMethod) {
//                    Library\DatabaseConnection::getInstance()->execute("UPDATE users
//   SET name = '$name', email = '$email', password = '$password' WHERE id = $userID");
//                    header('Location: /users?editedUserID=' . $user->id);
//                } else {
//                    $viewParams['view'] = 'form';
//                    $viewParams['user'] = $user;
//                }
//                break;
//            case 'delete':
//                Library\DatabaseConnection::getInstance()->execute("DELETE FROM users WHERE id = $userID");
//                header('Location: /users?deletedUserID=' . $user->id);
//                break;
//            case 'show':
//                $viewParams['view'] = 'show';
//                $viewParams['user'] = $user;
//        }
//        break;