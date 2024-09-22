<?php

namespace Tarkov\Controller;

use Smarty\Smarty;
use Tarkov\Service\Config;

class Base {
    protected $view;
    public static $routes = [];

    public function __construct() {
        $this->view = new Smarty();
        $this->view->setCacheDir(sys_get_temp_dir() . '/smarty/cache');
        $this->view->setCompileDir(sys_get_temp_dir() . '/smarty/compile');
        $this->view->setTemplateDir(BASE_DIR . '/tpl');
        $this->view->assign('config', new Config());
    }
}