<?php
declare(strict_types=1);

// Conexão com o banco
$pdo = new PDO(
    "pgsql:host=localhost;dbname=seu_banco",
    "seu_usuario",
    "sua_senha"
);

// Captura a página
$pagina = (int) ($_GET['p'] ?? 1);

if ($pagina < 1) {
    $pagina = 1;
}

// Calcula o deslocamento
$offset = ($pagina - 1) * 5;

// Busca as peças
$sql = "SELECT * FROM pecas_industriais
        ORDER BY id
        LIMIT :limite OFFSET :offset";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':limite', 5, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();

// Exibe as peças
while ($peca = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . $peca['id'] . "\n";
    echo "Nome: " . $peca['nome'] . "\n";
    echo "--------------------\n";
}

?>
