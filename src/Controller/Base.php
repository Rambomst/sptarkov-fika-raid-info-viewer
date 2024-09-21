<?php

namespace Tarkov\Controller;

use Smarty\Smarty;
use Tarkov\Service\Config;

class Base {
    protected $view;
    public static $routes = [];

    public function __construct() {
        $this->view = new Smarty();
        $this->view->setTemplateDir(BASE_DIR . '/tpl');
        $this->view->assign('config', new Config());
    }
}