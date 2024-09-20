<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dedicated_clients  = explode(",",$_POST['tarkov']['dedicated_clients']);
    $_POST['tarkov']['dedicated_clients']   = $dedicated_clients;

    $handle = fopen("config.json","w");
    fwrite($handle,json_encode($_POST));
    fclose($handle);
    header("location: index.php");
    exit;
}


const BASE_DIR = __DIR__;

use Tarkov\Controller\Index;

$controller = new Index(true);
$controller->setup();