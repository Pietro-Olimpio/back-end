<?php declare(strict_types=1);
//FUNÇÃO
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}

$nome = "";
$linkValido = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST['nome'] ?? '');
    $url = trim($_POST['url'] ?? '');

    // Valida se a URL possui formato válido
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        $erro = 'Digite uma URL válida.';
    }

    // Verifica se começa estritamente com http:// ou https://
    elseif (
        !str_starts_with($url, "http://") &&
        !str_starts_with($url, "https://")
    ) {
        $erro = "A URL deve começar com http:// ou https://.";
    }

    else {
        $linkValido = $url;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validador de Portfólio</title>
</head>
<body>

    <h1>Cadastro de Portfólio</h1>

    <form method="POST">

        <label for="nome">Nome:</label>
        <input
            type="text"
            id="nome"
            name="nome"
            value="<?= e($nome) ?>"
            required
        >

        <br><br>

        <label for="url">Link do GitHub ou LinkedIn:</label>
        <input type="text" name="nome" value="<?php e($nome) ?>">

        <button type="submit">Cadastrar</button>

    </form>

    <?php if ($erro !== ''): ?>
        <p><?= e($erro) ?></p>
    <?php endif; ?>

    <?php if ($linkValido !== ''): ?>

        <h2>Portfólio cadastrado</h2>

        <p>Nome: <?= e($nome) ?></p>

        <a href="<?= e($linkValido) ?>" target="_blank">
            Visitar Portfólio
        </a>

    <?php endif; ?>

</body>
</html>
