<?php declare(strict_types=1);
// <!-- Arquivo: ex01_mural.php
// Missão: Construa um mural de recados onde os usuários digitam o nome e uma mensagem que é salva em um array ou arquivo JSON.
// Requisitos:
// Crie a função e(string $texto): string para escapamento universal.
// Validação: Nome obrigatório (mínimo 3 caracteres) e Mensagem obrigatória (mínimo 5 caracteres).
// Renderize todas as mensagens salvas aplicando a função e() e use nl2br() para preservar quebras de linha com segurança.
// Teste a injeção de <script>alert('Mural Invadido')</script> e comprove que a mensagem é renderizada como texto inofensivo. -->



//função para codificar escape contra XSS
function e(string $texto):string{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
}

$nome = trim($_GET["nome"] ?? "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina blindada contra XSS</title>
</head>
<body>
    <h1>Perfil do Usuario</h1>
    
    <!-- blindando a função e() converte caracteres em entidades inofensivas -->
    <p>Bem-vindo, <?php echo e($nome); ?>!</p>

    <form action="ex01_mural.php" method="get">
        <label for="">Digite seu Nome</label>
        <input type="text" name="nome" value="<?php e($nome); ?>">
        <button type="submit">Atualizar</button>
    </form>

</body>
</html>