<?php

namespace Tarkov\Controller;

use Smarty\Smarty;
use Tarkov\Service\Config;

class Base {
    protected $view;
    protected $config;
    public static $routes = [];

    public $error_messages = [];

    public function __construct() {
        $this->config = new Config();

        $this->view = new Smarty();
        $this->view->setEscapeHtml(true);
        $this->view->setCacheDir(sys_get_temp_dir() . '/smarty/cache');
        $this->view->setCompileDir(sys_get_temp_dir() . '/smarty/compile');
        $this->view->setTemplateDir(BASE_DIR . '/tpl');
        $this->view->assign('config', new Config());
        $this->view->assign('error_messages', []);
    }

    public function getErrorMessages() { return $this->error_messages; }

    public function setErrorMessage($message) {
        $this->error_messages[] = $message;

        // Update the error_messages array within the view
        $this->view->assign('error_messages', $this->error_messages);
    }
}