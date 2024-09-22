<?php

namespace Tarkov\Service;

use Exception;

class Server {
    public static function getData($url, array $body = [], $session_id = null) {
        $config = new Config();
        if (!$config->get('tarkov.host') || !$config->get('tarkov.port')) {
            $error_message = '';
            if (!$config->get('tarkov.host')) {
                $error_message .= 'No host is defined';
            }

            if (!$config->get('tarkov.port')) {
                $error_message .= ($error_message ? PHP_EOL : '') . 'No port is defined';
            }

            throw new \Tarkov\Exception\Config\Invalid($error_message);
        }
        
        $url = "http://{$config->get('tarkov.host')}:{$config->get('tarkov.port')}/{$url}";
        $headers = [
            'Content-Type: application/json',
            'requestcompressed: 0'
        ];

        if ($session_id) {
            $headers[] = 'Cookie: PHPSESSID=' . $session_id;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($body) {
            curl_setopt($ch, CURLOPT_POST, 1);

            $data = json_encode($body);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
            curl_close($ch);
            exit;
        }

        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($http_status_code !== 200) {
            echo "HTTP error! Status: $http_status_code";
            exit;
        }

        $decompressed_data = gzuncompress($response);

        if ($decompressed_data === false) {
            echo 'An error occurred during decompression.';
        } else {
            $data = json_decode($decompressed_data, true);
            // Handle the case where the response contains "err" key
            if (isset($data['err']) && $data['err'] !== 0) {
                throw new \Exception('Error fetching player data: ' . $data['err']);
            }

            if (isset($data['data'])) {
                return $data['data'];
            }

            return $data;
        }
    }
}