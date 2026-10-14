<?php
declare(strict_types=1);

require_once __DIR__ . '/src/ConexaoBanco.php';
require_once __DIR__ . '/src/UsuarioDAO.php';
require_once __DIR__ . '/src/AuthService.php';

const CONFIG_PATH = __DIR__ . '/config/database.ini';

AuthService::iniciarSessaoSegura();

// Se ja estiver logado, redireciona para a dashboard
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erro = '';
$sucesso = '';
$mensagens = [
    'restrito' => 'Efetue o login para acessar a área restrita do sistema.',
    'expirado' => 'Sua sessão expirou por inatividade. Faça login novamente.',
    'logout'   => 'Sessão encerrada com segurança.'
];

if (isset($_GET['erro']) && isset($mensagens[$_GET['erro']])) {
    $erro = $mensagens[$_GET['erro']];
}

if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'cadastrado') {
    $sucesso = 'Usuário cadastrado com sucesso! Efetue seu login para continuar.';
}

//método para fazer login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = (string)($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        $erro = 'Preencha o e-mail e a senha corporativa.';
    } else {
        //estabelece a conexão
        $pdo = ConexaoBanco::obterConexao(CONFIG_PATH);
        $usuarioDAO = new UsuarioDAO($pdo);
        //busca os dados do usuário
        $usuario = $usuarioDAO->buscarPorEmail($email);

        // estou comparando a senha digitada no login com a senha descriptografada do banco
        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            AuthService::autenticar($usuario);
            header('Location: dashboard.php');
            exit;
        }
        $erro = 'Credenciais incorretas ou usuário desativado.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Corporativo — SENAI TechPortal</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0f172a; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; color: #f8fafc; }
        .card-login { background: #1e293b; padding: 35px; border-radius: 10px; width: 100%; max-width: 380px; box-shadow: 0 10px 25px rgba(0,0,0,0.4); border: 1px solid #334155; }
        h1 { color: #38bdf8; font-size: 1.5rem; text-align: center; margin-top: 0; }
        p.subtitulo { text-align: center; color: #94a3b8; font-size: 0.85rem; margin-bottom: 25px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px; color: #cbd5e1; }
        input { width: 100%; padding: 10px; border: 1px solid #475569; border-radius: 5px; background: #0f172a; color: #f8fafc; box-sizing: border-box; }
        input:focus { border-color: #38bdf8; outline: none; }
        button { width: 100%; padding: 12px; background: #0284c7; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 10px; font-size: 0.95rem; }
        button:hover { background: #0369a1; }
        .alerta-erro { background: #7f1d1d; border: 1px solid #dc2626; color: #fecaca; padding: 10px; border-radius: 5px; font-size: 0.85rem; margin-bottom: 18px; text-align: center; }
        .alerta-sucesso { background: #14532d; border: 1px solid #16a34a; color: #bbf7d0; padding: 10px; border-radius: 5px; font-size: 0.85rem; margin-bottom: 18px; text-align: center; }
        .rodape-link { margin-top: 20px; text-align: center; font-size: 0.85rem; color: #94a3b8; }
        .rodape-link a { color: #38bdf8; text-decoration: none; font-weight: bold; }
        .rodape-link a:hover { text-decoration: underline; }
        .demo-box { background: #0f172a; padding: 10px; border-radius: 4px; font-size: 0.75rem; color: #94a3b8; margin-top: 20px; text-align: center; border: 1px dashed #475569; }
    </style>
</head>
<body>
<div class="card-login">
    <h1>🛡️ SENAI TechPortal</h1>
    <p class="subtitulo">Acesso seguro com Sessões e Hashing Argon2id</p>

    <?php if (!empty($sucesso)): ?>
        <div class="alerta-sucesso"><?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if (!empty($erro)): ?>
        <div class="alerta-erro"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">E-mail Corporativo</label>
            <input type="email" id="email" name="email" required placeholder="admin@senai.br">
        </div>
        <div class="form-group">
            <label for="senha">Senha de Acesso</label>
            <input type="password" id="senha" name="senha" required placeholder="••••••••">
        </div>
        <button type="submit">Autenticar no Sistema</button>
    </form>

    <div class="rodape-link">
        Ainda não tem conta? <a href="cadastro.php">Cadastre-se aqui</a>
    </div>

    <div class="demo-box">
        Credencial de teste: <strong>admin@senai.br</strong> | Senha: <strong>Senai@2026</strong>
    </div>
</div>
</body>
</html>