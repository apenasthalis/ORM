<?php


class Router
{
    public function getRouter($method, $rout): array
    {
        if (empty($method)) {
            $rout = 'ta doido';
        }
        $arDados = [
            'rout' => $rout,
            'method' => $method
        ];

        return $arDados;
    }
}
