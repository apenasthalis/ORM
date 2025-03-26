<?php
$vault_url = "http://vault:8200/v1/secret/data/myapp"; // Nome do container Vault
$vault_token = "s.mytokensecreto"; // Token definido no docker-compose

// Inicializa o cURL
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $vault_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-Vault-Token: $vault_token",
    "Accept: application/json"
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($http_code == 200) {
    $data = json_decode($response, true);
    $username = $data['data']['data']['username'];
    $password = $data['data']['data']['password'];

    echo "Usuário: $username <br>";
    echo "Senha: $password <br>";
} else {
    echo "Erro ao acessar o Vault: HTTP $http_code <br>";
    echo "Resposta: $response";
}
