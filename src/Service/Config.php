<?php

namespace Tarkov\Service;

use Exception;

class Config {
    const CONFIG_FILE = 'config.json';
    protected $config;

    public function __construct() {
        if (file_exists(self::CONFIG_FILE)) {
            $this->config = json_decode(file_get_contents(self::CONFIG_FILE), true);
        } else {
            throw new Exception("Config file not found: " . self::CONFIG_FILE);
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

    public function test_config($host,$port) {
        if( $host == "" || $port == "" ) { // no config data exists
            return "Config missing host and/or port value(s)";
        }

        $waitTimeoutInSeconds = 1; 
        if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
            return true; // no errors, set the error value in config to false
        } 
        fclose($fp);
        return "Unable to connect to server";
    }
}