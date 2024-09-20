<?php

namespace Tarkov\Controller;

use Smarty\Smarty;
use Tarkov\Service\Config;
use Tarkov\Raid;

class Index {
    private $view;

    public function __construct($setup=false) {
        $this->view = new Smarty();
        $this->view->setTemplateDir(BASE_DIR . '/tpl');
        ( !$setup ? $this->view->assign('config', new Config()) : "" );
    }

    public function index() {
        $this->view->assign('raids', Raid::fetchRaids());
        $this->view->display('index.tpl');
    }

    public function setup() {
        $this->view->display('setup.tpl');
    }
}