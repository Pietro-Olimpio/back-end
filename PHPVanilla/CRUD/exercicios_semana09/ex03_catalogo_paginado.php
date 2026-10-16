<?php
declare(strict_types=1);

// Protege os dados exibidos no HTML
function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

// Conexão com o banco de dados
$pdo = new PDO(
    "pgsql:host=localhost;dbname=almoxarifado_senai",
    "postgres",
    "postgres"
);

// Captura o número da página
$pagina = (int) ($_GET['p'] ?? 1);

// Garante que a página seja pelo menos 1
if ($pagina < 1) {
    $pagina = 1;
}

// Calcula o deslocamento
$offset = ($pagina - 1) * 5;

// Consulta as peças com paginação
$sql = "SELECT * FROM pecas_industriais
        ORDER BY id
        LIMIT :limite OFFSET :offset";

$stmt = $pdo->prepare($sql);

// Vincula os parâmetros como inteiros
$stmt->bindValue(':limite', 5, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();

// Título do catálogo
echo "<h1>Catálogo de peças industriais</h1>";

// Exibe as peças encontradas
while ($peca = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . e((string) $peca['id']) . "<br>";
    echo "Nome: " . e((string) $peca['nome']) . "<br>";
    echo "<hr>";
}

// Link para a próxima página
echo '<a href="?p=' . ($pagina + 1) . '">Próxima página</a>';

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Peças</title>
</head>
<body>

    <h1>Catálogo de Peças Industriais</h1>

    <form action="ex03_catalogo_paginado.php" method="GET">
        <label for="p">Número da página:</label>
        <input type="number" id="p" name="p" min="1" value="1" required>

        <button type="submit">Consultar peças</button>
    </form>

</body>
</html>
