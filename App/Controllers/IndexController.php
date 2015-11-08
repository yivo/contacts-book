<?php

namespace App\Controllers;

class IndexController extends \Plus33FPS\Controller {
    public function indexAction() {
        include __DIR__ . '/../Views/index.phtml';
    }
}