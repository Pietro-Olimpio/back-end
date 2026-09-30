<?php
declare(strict_types=1);

require "ConexaoBanco.php";

function registrarLog(string $nivel, string $mensagem): void
{
    if (
        $nivel != "INFO" &&
        $nivel != "WARNING" &&
        $nivel != "ERROR"
    ) {
        return;
    }

    $dataHora = date("Y-m-d H:i:s");

    $linha = "[$dataHora] [$nivel] $mensagem" . PHP_EOL;

    file_put_contents(
        "logs/sistema.log",$linha,FILE_APPEND
        );
}


try {

    $pdo = ConexaoBanco::obterConexao("database.ini");

    echo "Conexão realizada com sucesso!";

    registrarLog(
        "INFO",
        "Conexão com o banco de dados realizada com sucesso."
    );

} catch (PDOException $erro) {

    echo "Erro ao conectar com o banco de dados.";

    registrarLog(
        "ERROR",
        "Falha na conexão com o banco de dados."
    );
}

