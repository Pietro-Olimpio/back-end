<?php

declare(strict_types=1);

// Busca vulnerável
function buscarVulneravel(PDO $pdo, string $termo): void {
    $sql = "SELECT * FROM usuarios WHERE nome = '$termo'";

    echo "\nBusca vulnerável:\n";

    $stmt = $pdo->query($sql);

    while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Registro encontrado: " . $resultado['nome'] . "\n";
    }
}

// Busca protegida
function buscarProtegido(PDO $pdo, string $termo): void {
    $sql = "SELECT * FROM usuarios WHERE nome = :nome";

    echo "\nBusca protegida:\n";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $termo]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        echo "Registro encontrado: " . $resultado['nome'] . "\n";
    } else {
        echo "Nenhum registro encontrado.\n";
    }
}

// Conexão com o banco
$pdo = new PDO(
    "pgsql:host=localhost;dbname=seu_banco",
    "seu_usuario",
    "sua_senha"
);

// Teste das duas consultas
$termo = "' OR '1'='1";

buscarVulneravel($pdo, $termo);
buscarProtegido($pdo, $termo);

?>