<?php
namespace Library;

class EmailValidator {

    private static $_instance;

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        if (self::$_instance) {
            throw new Exception('Sorry, only one instance of EmailValidator can be created!');
        } else {
            self::$_instance = $this;
        }
    }

    public function check($email) {
        return !!preg_match('/^\w+@\w+.\w+$/', $email);
    }
}
