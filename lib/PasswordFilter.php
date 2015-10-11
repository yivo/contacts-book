<?php

class PasswordFilter extends NullFilter {
    public function filter($password) {
        $str_length = strlen($password);
        return str_repeat('*', $str_length);
    }
}
