
<?php

declare(strict_types=1);

// Protege os dados exibidos no HTML
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

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

$sql = "SELECT * FROM pecas_industriais
        ORDER BY id LIMIT :limite OFFSET :offset";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limite', 5, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

echo "<h1>Catálogo de peças</h1>";

// Exibe as peças
while ($peca = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . e((string) $peca['id']) . "<br>";
    echo "Nome: " . e((string) $peca['nome']) . "<br><hr>";
}

// Navegação entre páginas
echo '<a href="?p=' . ($pagina + 1) . '">Próxima página</a>';

?>