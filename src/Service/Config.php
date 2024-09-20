<?php

/*
    * instead of throwing an error when the config file doens't exist, allow the user to create one!
*/

namespace Tarkov\Service;

use Exception;

class Config {
    const CONFIG_FILE = 'config.json';
    protected $config;

    public function __construct() {
        if (file_exists(self::CONFIG_FILE)) {
            $this->config = json_decode(file_get_contents(self::CONFIG_FILE), true);
        } else {
            //throw new Exception("Config file not found: " . self::CONFIG_FILE);
            header("location: /setup.php");
        }
    }

    public function __get($name) {
        $keys = explode('.', $name);
        $value = $this->config;

        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }
}