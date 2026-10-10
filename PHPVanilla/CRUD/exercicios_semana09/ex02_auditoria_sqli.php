<?php

declare(strict_types=1);

// Cria a conexão com o banco
function conectar(): PDO {
    return new PDO(
        "pgsql:host=localhost;dbname=seu_banco",
        "seu_usuario",
        "sua_senha"
    );
}

// Busca vulnerável: concatenação intencional para o teste
function buscarVulneravel(string $termo): void {
    $pdo = conectar();
    $sql = "SELECT * FROM usuarios WHERE nome = '$termo'";

    echo "\nBusca vulnerável:\n";
    $stmt = $pdo->query($sql);

    while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Registro encontrado: " . $resultado['nome'] . "\n";
    }
}

// Busca protegida
function buscarProtegido(string $termo): void {
    $pdo = conectar();
    $sql = "SELECT * FROM usuarios WHERE nome = :nome";

    echo "\nBusca protegida:\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $termo]);

    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Registro encontrado.\n";
    } else {
        echo "Nenhum registro encontrado.\n";
    }
}

// Executa o teste
$termo = "' OR '1'='1";

buscarVulneravel($termo);
buscarProtegido($termo);

?>