<?php declare(strict_types=1);

// Função para escapar o texto antes de mostrar na página
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$arquivo = 'chat.json';
$erro = '';

// Se o arquivo não existir, cria um array vazio
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([]));
}

// Lê as mensagens salvas
$conteudo = file_get_contents($arquivo);
$mensagens = json_decode($conteudo, true);

// Garante que mensagens seja um array
if (!is_array($mensagens)) {
    $mensagens = [];
}

// Valores iniciais do formulário
$nome = '';
$mensagem = '';

// Quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // Verifica se o nome está vazio
    if ($nome === '') {
        $erro = 'Digite seu nome.';
    }

    // Verifica se a mensagem está vazia
    elseif ($mensagem === '') {
        $erro = 'Digite uma mensagem.';
    }

    // Verifica se a mensagem possui mais de 250 caracteres
    elseif (strlen($mensagem) > 250) {
        $erro = 'A mensagem não pode ultrapassar 250 caracteres.';
    }

    else {

        // Cria uma nova mensagem
        $novaMensagem = [
            'nome' => $nome,
            'mensagem' => $mensagem
        ];

        // Adiciona a mensagem ao array
        $mensagens[] = $novaMensagem;

        // Salva novamente no arquivo JSON
        file_put_contents(
            $arquivo,
            json_encode(
                $mensagens,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

        // Limpa o formulário depois de salvar
        $nome = '';
        $mensagem = '';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Chat Industrial</title>
</head>

<body>

    <h1>Chat Industrial</h1>

    <?php if ($erro !== ''): ?>
        <p><?= e($erro) ?></p>
    <?php endif; ?>

    <form method="POST">

        <label for="nome">Nome:</label>

        <input type="text" id="nome" name="nome" value="<?= e($nome) ?>">

        <label for="mensagem">Mensagem:</label>

        <br>

        <textarea id="mensagem" name="mensagem" rows="5" cols="50" maxlength="250" ><?= e($mensagem) ?></textarea>
        
        <button type="submit">Enviar</button>

    </form>

    <hr>

    <h2>Mensagens</h2>

    <?php foreach ($mensagens as $item): ?>

        <div>

            <strong><?= e($item['nome']) ?></strong>

            <p>
                <?= nl2br(e($item['mensagem'])) ?>
            </p>

        </div>

        <hr>

    <?php endforeach; ?>

</body>

</html>