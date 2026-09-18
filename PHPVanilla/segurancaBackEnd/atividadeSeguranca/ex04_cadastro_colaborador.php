<?php declare(strict_types=1);

// Sanitiza textos
function sanitizarTexto(string $dado): string
{
    return trim(strip_tags($dado));
}

// Valida os dados do colaborador
function validarColaborador(array $dados): array
{
    $erros = [];

    // Validar nome
    if ($dados['nome'] === '') {
        $erros[] = 'O nome é obrigatório.';
    }

    // Validar email
    if (filter_var($dados['email'], FILTER_VALIDATE_EMAIL) === false) {
        $erros[] = 'O email é inválido.';
    }

    // Validar matrícula
    if (filter_var($dados['matricula'], FILTER_VALIDATE_INT) === false) {
        $erros[] = 'A matrícula deve ser um número inteiro.';
    }

    // Validar salário
    if (filter_var($dados['salario'], FILTER_VALIDATE_FLOAT) === false) {
        $erros[] = 'O salário deve ser um número decimal.';
    }

    return $erros;
}

$nome = '';
$email = '';
$matricula = '';
$salario = '';

$erros = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Receber e sanitizar os dados
    $nome = sanitizarTexto($_POST['nome'] ?? '');
    $email = sanitizarTexto($_POST['email'] ?? '');
    $matricula = sanitizarTexto($_POST['matricula'] ?? '');
    $salario = sanitizarTexto($_POST['salario'] ?? '');

    $dados = [
        'nome' => $nome,
        'email' => $email,
        'matricula' => $matricula,
        'salario' => $salario
    ];

    // Validar
    $erros = validarColaborador($dados);

    if (empty($erros)) {
        $sucesso = true;
    }
}

// Função para escapar o que será exibido na tela
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaborador</title>
</head>
<body>

    <h1>Cadastro de Colaborador</h1>

    <?php if (!empty($erros)): ?>
        <h2>Erros encontrados:</h2>

        <ul>
            <?php foreach ($erros as $erro): ?>
                <li><?= e($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <h2>Colaborador cadastrado com sucesso!</h2>

        <p>Nome: <?= e($nome) ?></p>
        <p>Email: <?= e($email) ?></p>
        <p>Matrícula: <?= e($matricula) ?></p>
        <p>Salário: R$ <?= e($salario) ?></p>
    <?php endif; ?>

    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php e($nome) ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php e($email) ?>">

        <label for="matricula">Matrícula:</label>
       <input type="text" name="matricula" value="<?php e($matricula) ?>">
    

        <label for="salario">Salário:</label>
        <input type="text" name="salario" value="<?php e($salario) ?>">

        <button type="submit">Cadastrar</button>

    </form>

</body>
</html>
