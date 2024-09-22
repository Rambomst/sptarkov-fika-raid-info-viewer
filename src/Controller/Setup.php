<?php
namespace Tarkov\Controller;

class Setup extends Base {
    public static $routes = [
        'GET' => [
            '/setup' => [self::class, 'setup']
        ],
        'POST' => [
            '/setup/save' => [self::class,'saveConfigData']
        ]
    ];

    public function setup() {
        $this->view->display('setup.tpl');
    }

    public function saveConfigData() {
        $title      = htmlspecialchars($_POST['title']);
        $host       = $_POST['host'];
        $port       = $_POST['port'];
        
        $clients    = explode(",",$_POST['dedicated_clients']);

        if(!filter_var(gethostbyname($host), FILTER_VALIDATE_IP) && !filter_var($host, FILTER_VALIDATE_IP)) {
            header("location: /setup");
            exit;
        }

        if($port < 0 || $port > 65545) {
            header("location: /setup");
            exit;
        }

        $array  = [
            "ui"    => [
                "title" => $title
            ],
            "tarkov"    => [
                "host"  => $host,
                "port"  => $port,
                "dedicated_clients" => $clients
            ]
        ];

        $json   = json_encode($array);
        file_put_contents(BASE_DIR . "/config.json",$json);
        header("location: /");
    }
}