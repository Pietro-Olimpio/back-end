<?php

declare(strict_types=1);

require_once __DIR__ . "/ConexaoBanco.php";

const ARQUIVO_CONFIG = __DIR__ . "/database.ini";

$conexao1 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

$conexao2 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

if ($conexao1 === $conexao2) {
    echo "São a mesma conexão";
} else {
    echo "é diferene";
}

?>