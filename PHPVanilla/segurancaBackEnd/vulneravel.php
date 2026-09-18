<?php declare(strict_types=1);

//codigo vulneravek para fins de estudo de segurança

$nome = $_GET["nome"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina vulneravel a XSS</title>
</head>
<body>
    <h1>Perfil do Usuario</h1>

   <!-- Erro Grave: o dado é impresso diretamente sem escapar!  -->
    <p>Bem-Vindo, <?php echo $nome; ?></p>

    <form action="vulneravel.php" method="get">
        <label for="">Digite seu nome:</label>
        <input type="text" name="nome" value="<?php echo $nome ?>">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>