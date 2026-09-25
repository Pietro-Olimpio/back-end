<?php declare(strict_types=1);

function carregarAmbiente(string $ambiente): array
{
    // Carregar o arquivo database.ini
    $cfg = parse_ini_file(__DIR__ . "/database.ini", true);

    // Verificar se o ambiente existe
    if (!isset($cfg[$ambiente])) {
        throw new Exception("Ambiente não encontrado.");
    }

    // Montar o endereço de conexão
    $dsn = sprintf(
        "pgsql:host=%s;port=%s;dbname=%s",
        $cfg[$ambiente]["db_host"],
        $cfg[$ambiente]["db_port"],
        $cfg[$ambiente]["db_name"]
    );

    return [
        "dsn" => $dsn,
        "host" => $cfg[$ambiente]["db_host"],
        "port" => $cfg[$ambiente]["db_port"],
        "name" => $cfg[$ambiente]["db_name"]
    ];
}


// Testando o ambiente development
$ambiente = carregarAmbiente("development");

echo "host: " . $ambiente["host"] . PHP_EOL;
echo "port: " . $ambiente["port"] . PHP_EOL;
echo "banco: " . $ambiente["name"] . PHP_EOL;


?>