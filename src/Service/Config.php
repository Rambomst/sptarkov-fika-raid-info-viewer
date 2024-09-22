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

    public function get($name, $default = null) {
        $keys = explode('.', $name);
        $value = $this->config;

        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return $default;
            }
        }

        return $value;
    }
}