<?php
$mensagemSucesso = "";
$erros = [];

$email = "";
$senha = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim((string) ($_POST["email"] ?? ""));
    $senha = trim((string) ($_POST["senha"] ?? ""));

    // valida o email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros["email"] = "Informe um email válido.";
    }

    // valida a senha
    if (strlen($senha) < 6) {
        $erros["senha"] = "A senha deve ter no mínimo 6 caracteres.";
    }

    // verifica as credenciais
    if ($erros === []) {

        if (
            $email === "admin@senai.br" &&
            $senha === "senhaSegura123"
        ) {
            $mensagemSucesso = "Bem-vindo!";
        } else {
            $erros["login"] = "Credenciais inválidas";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Seguro</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f7; padding: 30px; }
        .card { max-width: 420px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input { width: 100%; padding: 10px; margin-bottom: 12px; box-sizing: border-box; }
        .erro { color: #c0392b; font-size: 0.9em; margin-top: -8px; margin-bottom: 10px; }
        .sucesso { background: #e7f9ee; color: #1f8a4c; padding: 12px; border-radius: 8px; font-weight: bold; }
        .alerta { background: #fdecea; color: #b42318; padding: 12px; border-radius: 8px; margin-bottom: 15px; }
    </style>
</head>
<body>
   <div class="card">
        <h2>Login do Sistema</h2>
        <?php if(isset($erros["login"])): ?> 
            <div class="alerta"><?=  htmlspecialchars($erros["login"], ENT_QUOTES, "UTF-8") ?></div>    
        <?php endif; ?>
        
        <?php if($mensagemSucesso): ?> 
            <div class="sucesso">Bem-vindo(a), Admin!!!</div>    
        <?php else: ?>
            <form method="POST"> 
                <label for="email">email:</label>
                <input type="email" name="email" id="email" value="<?php htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>">
                <?php if(isset($erros["email"])): ?>
                    <div class="erro"><?php htmlspecialchars($erros["email"], ENT_QUOTES,"UTF-8") ?></div>
                   <?php endif; ?> 
                
                
                <label for="senha">senha:</label>
                <input type="senha" name="senha" id="senha" value="<?php htmlspecialchars($senha, ENT_QUOTES, "UTF-8") ?>">
                <?php if(isset($erros["senha"])): ?>
                    <div class="erro"><?php htmlspecialchars($erros["senha"], ENT_QUOTES,"UTF-8") ?></div>
                   <?php endif; ?> 

                <button type="submit">Entrar</button>

            </form>

        <?php endif; ?>


    </div>
</body>
</html>