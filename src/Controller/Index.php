<?php

namespace Tarkov\Controller;

use Tarkov\Raid;

class Index extends Base {
    public static $routes = [
        'GET' => [
            '/' => [self::class, 'index']
        ]
    ];

    public function index() {
        $this->view->assign('raids', Raid::fetchRaids());
        $this->view->display('index.tpl');
    }

    public function error() {
        $this->view->assign('error_messages', $this->getErrorMessages());
        $this->view->display('error.tpl');
    }
}