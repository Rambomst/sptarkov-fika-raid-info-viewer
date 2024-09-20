<?php
require 'vendor/autoload.php';

const BASE_DIR = __DIR__;

use Tarkov\Controller\Index;

$controller = new Index();
$controller->index();