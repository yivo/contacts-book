<?php

class UserCLI {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function requestName() {
        $name = readline('Input your name:');
        if ($name) {
            $this->user->setName($name);
        } else {
            echo('No name. Try again!' . PHP_EOL);
            $this->requestName();
        }
    }

    public function requestEmail() {
        $email = readline('Input your email:');
        $validator = EmailValidator::getInstance();
        $valid = $validator->check($email);

        if ($valid) {
            $this->user->setEmail($email);
        } else {
            echo('Wrong email. Try again!' . PHP_EOL);
            $this->requestEmail();
        }
    }

    public function requestPassword() {
        $this->user->setPassword(readline('Input your password:'));
    }
}
