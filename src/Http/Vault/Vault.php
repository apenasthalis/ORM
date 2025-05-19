<?php

namespace Pericao\Orm\Http\Vault;

class Vault
{
    public function init()
    {
        $url = "http://192.168.1.45:8200/v1/kv/data/calica";
        $token = 'hvs.omSFcI8NQkZKyeaFU0lW21hK'; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($token)) {
            $headers = [
                "X-Vault-Token: $token",
                "Content-Type: application/json"
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        if ($response === false) {
            $errNo  = curl_errno($ch);
            $errMsg = curl_error($ch);
            echo "cURL Erro ({$errNo}): {$errMsg}";
            curl_close($ch);
            exit;
        }
        if (curl_errno($ch)) {
            echo 'Erro na requisição: ' . curl_error($ch);
        } else {
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code == 200) {
                $data = json_decode($response, true);
                print_r($data);
            } else {
                echo "HTTP Code: $http_code. Resposta: $response";
            }
        }
        curl_close($ch);
    }
}
