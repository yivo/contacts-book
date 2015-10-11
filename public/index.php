<?php

require __DIR__ . '/../lib/EmailValidator.php';
require __DIR__ . '/../lib/User.php';
require __DIR__ . '/../lib/UserCLI.php';
require __DIR__ . '/../lib/UserView.php';
require __DIR__ . '/../lib/NullFilter.php';
require __DIR__ . '/../lib/NameFilter.php';
require __DIR__ . '/../lib/EmailFilter.php';
require __DIR__ . '/../lib/PasswordFilter.php';

$user = new User();
$cli = new UserCLI($user);
$cli->requestName();
$cli->requestEmail();
$cli->requestPassword();
$userView = new UserView();
echo $userView->present($user);