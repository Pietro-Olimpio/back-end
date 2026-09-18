<?php declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$busca = $_GET['q'] ?? '';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
</head>
<body>

    <h1>Busca de Produtos</h1>

    <form method="GET">
        <input
            type="text"
            name="q"
            value="<?= e($busca) ?>"
        >

        <button type="submit">Buscar</button>
    </form>

    <p>Você buscou por: <?= e($busca) ?></p>

</body>
</html>

