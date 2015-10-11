<?php

class UserView {
    public function present(User $user) {
        $name = $this->presentName($user->getName());
        $email = $this->presentEmail($user->getEmail());
        $password = $this->presentPassword($user->getPassword());

        return join('', [
            'Your name is: ',       $name,       PHP_EOL,
            'Your email is: ',      $email,      PHP_EOL,
            'Your password is: ',   $password,   PHP_EOL
        ]);
    }

    private function presentName($name) {
        if ($this->mustFilter($name)) {
            return (new NameFilter())->filter($name);
        } else {
            return '<NO NAME>';
        }
    }

    private function presentEmail($email) {
        if ($this->mustFilter($email)) {
            return (new EmailFilter())->filter($email);
        } else {
            return '<NO EMAIL>';
        }
    }

    private function presentPassword($password) {
        if ($this->mustFilter($password)) {
            return (new PasswordFilter())->filter($password);
        } else {
            return '<NO PASSWORD>';
        }
    }

    private function mustFilter($data) {
        return !!$data;
    }
}
