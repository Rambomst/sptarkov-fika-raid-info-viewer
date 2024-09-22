<?php

namespace Tarkov\Controller;

use Smarty\Smarty;
use Tarkov\Service\Config;

class Base {
    protected $view;
    protected $config;
    public static $routes = [];

    public $error_message = false;

    public function __construct() {
        $this->config = new Config();

        $this->view = new Smarty();
        $this->view->setTemplateDir(BASE_DIR . '/tpl');
        $this->view->assign('config', new Config());
    }
}